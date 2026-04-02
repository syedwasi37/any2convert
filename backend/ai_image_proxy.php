<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    jsonError('Method not allowed.', 405);
}

$rawBody = file_get_contents('php://input');
$payload = json_decode($rawBody ?: '', true);
if (!is_array($payload)) {
    jsonError('Invalid JSON payload.', 400);
}

$prompt = trim((string) ($payload['prompt'] ?? ''));
$negativePrompt = trim((string) ($payload['negative_prompt'] ?? ''));
$width = normalizeDimension($payload['width'] ?? 1024);
$height = normalizeDimension($payload['height'] ?? 1024);

if ($prompt === '') {
    jsonError('Prompt is required.', 400);
}

$provider = strtolower((string) envValue('AI_IMAGE_PROVIDER', 'pollinations'));

switch ($provider) {
    case 'pollinations':
        proxyPollinationsImage($prompt, $negativePrompt, $width, $height);
        break;

    case 'groq':
        jsonError(
            'Groq does not currently expose an official text-to-image generation endpoint. Set AI_IMAGE_PROVIDER=pollinations for this tool or switch to another supported image provider.',
            501
        );
        break;

    default:
        jsonError('Unsupported AI image provider: ' . $provider, 500);
}

function proxyPollinationsImage(string $prompt, string $negativePrompt, int $width, int $height): void
{
    $baseUrl = 'https://gen.pollinations.ai/image/' . rawurlencode($prompt);
    $params = [
        'width' => (string) $width,
        'height' => (string) $height,
        'model' => (string) envValue('POLLINATIONS_IMAGE_MODEL', 'zimage'),
        'seed' => '0',
        'enhance' => 'false',
        'safe' => 'false',
        'quality' => 'medium',
    ];

    if ($negativePrompt !== '') {
        $params['negative_prompt'] = $negativePrompt;
    }

    $apiUrl = $baseUrl . '?' . http_build_query($params);
    $headers = ['Accept: image/jpeg, image/png'];

    $apiKey = envValue('POLLINATIONS_API_KEY');
    if ($apiKey !== null) {
        $headers[] = 'Authorization: Bearer ' . $apiKey;
    }

    [$body, $statusCode, $contentType] = performHttpRequest($apiUrl, $headers);

    if ($statusCode < 200 || $statusCode >= 300) {
        $message = extractUpstreamErrorMessage($body, $statusCode, 'Image generation failed.');
        jsonError($message, $statusCode > 0 ? $statusCode : 502);
    }

    header('Content-Type: ' . ($contentType ?: 'image/png'));
    header('Cache-Control: no-store');
    echo $body;
    exit;
}

function performHttpRequest(string $url, array $headers): array
{
    if (!function_exists('curl_init')) {
        jsonError('Server is missing cURL support, so image requests cannot be proxied right now.', 500);
    }

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 90,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_HEADER => true,
    ]);

    $response = curl_exec($ch);
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        jsonError('Upstream request failed: ' . $error, 502);
    }

    $statusCode = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    $headerSize = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $contentType = (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    $body = substr($response, $headerSize);
    return [$body, $statusCode, $contentType];
}

function extractUpstreamErrorMessage(string $body, int $statusCode, string $fallback): string
{
    $decoded = json_decode($body, true);
    if (is_array($decoded)) {
        $message = $decoded['error']['message'] ?? $decoded['message'] ?? null;
        if (is_string($message) && $message !== '') {
            return $message;
        }
    }

    $trimmed = trim($body);
    if ($trimmed !== '' && !preg_match('/^<(!doctype|html)/i', $trimmed)) {
        return 'Upstream error (' . $statusCode . '): ' . mb_substr($trimmed, 0, 300);
    }

    return $fallback;
}

function normalizeDimension($value): int
{
    $intValue = (int) $value;
    $allowed = [512, 768, 1024, 1536];
    if (!in_array($intValue, $allowed, true)) {
        return 1024;
    }

    return $intValue;
}

function jsonError(string $message, int $statusCode): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json');
    echo json_encode([
        'error' => [
            'message' => $message,
        ],
    ]);
    exit;
}
