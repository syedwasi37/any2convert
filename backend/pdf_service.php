<?php

if (!function_exists('envLoad')) {
    function envLoad(string $path): void
    {
        static $loaded = [];

        if (isset($loaded[$path]) || !is_file($path) || !is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '') {
                continue;
            }

            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            if (getenv($key) === false) {
                putenv($key . '=' . $value);
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }

        $loaded[$path] = true;
    }
}

if (!function_exists('envValue')) {
    function envValue(string $key, ?string $default = null): ?string
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return $value;
    }
}

envLoad(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env');
envLoad(__DIR__ . DIRECTORY_SEPARATOR . '.env');

function pdfServiceJsonError(string $message, int $status = 400, array $extra = []): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array_merge(['error' => $message], $extra));
    exit;
}

function pdfServiceBaseName(string $fileName, string $fallback = 'converted'): string
{
    $baseName = pathinfo($fileName, PATHINFO_FILENAME);
    $baseName = preg_replace('/[^A-Za-z0-9._ -]/', '', (string) $baseName);
    $baseName = trim((string) $baseName);
    return $baseName !== '' ? $baseName : $fallback;
}

function pdfServiceDetectExtension(string $fileName): string
{
    return strtolower((string) pathinfo($fileName, PATHINFO_EXTENSION));
}

function pdfServiceDownloadName(string $action, array $files): string
{
    $firstName = $files[0]['name'] ?? 'converted';
    $base = pdfServiceBaseName($firstName);

    return match ($action) {
        'pdf_to_word' => $base . '.docx',
        'pdf_to_excel' => $base . '.xlsx',
        'pdf_to_ppt' => $base . '.pptx',
        'word_to_pdf' => $base . '.pdf',
        'protect_pdf' => $base . '-protected.pdf',
        'unlock_pdf' => $base . '-unlocked.pdf',
        'ocr_pdf' => $base . '-ocr.pdf',
        'compress_pdf' => $base . '-compressed.pdf',
        'merge_pdf' => count($files) > 1 ? 'merged.pdf' : ($base . '-merged.pdf'),
        default => $base . '.bin',
    };
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    pdfServiceJsonError('Only POST requests are allowed.', 405);
}

$convertApiSecret = envValue('CONVERTAPI_SECRET', '');
if ($convertApiSecret === '') {
    pdfServiceJsonError('Server-side PDF processing is not configured yet. Add CONVERTAPI_SECRET to .env.', 503);
}

$action = trim((string) ($_POST['action'] ?? ''));

$actionConfig = [
    'pdf_to_word' => [
        'mode' => 'single',
        'output' => 'docx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/docx',
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'pdf_to_excel' => [
        'mode' => 'single',
        'output' => 'xlsx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/xlsx',
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'pdf_to_ppt' => [
        'mode' => 'single',
        'output' => 'pptx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/pptx',
        'extra_fields' => static function (): array {
            return [
                'StoreFile' => 'false',
                'OcrMode' => trim((string) ($_POST['ocr_mode'] ?? 'auto')),
            ];
        },
    ],
    'word_to_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['doc', 'docx'],
        'endpoint' => static function (array $files): string {
            $ext = pdfServiceDetectExtension($files[0]['name'] ?? '');
            return $ext === 'doc' ? 'doc/to/pdf' : 'docx/to/pdf';
        },
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'merge_pdf' => [
        'mode' => 'multi',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/merge',
        'extra_fields' => static function (): array {
            $bookmarks = trim((string) ($_POST['bookmarks_toc'] ?? 'filename'));
            $pageSize = trim((string) ($_POST['page_size'] ?? 'default'));
            $orientation = trim((string) ($_POST['page_orientation'] ?? 'default'));

            return [
                'StoreFile' => 'false',
                'BookmarksToc' => in_array($bookmarks, ['disabled', 'filename', 'title'], true) ? $bookmarks : 'filename',
                'PageSize' => in_array($pageSize, ['default', 'a4', 'letter', 'legal'], true) ? $pageSize : 'default',
                'PageOrientation' => in_array($orientation, ['default', 'portrait', 'landscape'], true) ? $orientation : 'default',
                'RemoveDuplicateFonts' => !empty($_POST['remove_duplicate_fonts']) ? 'true' : 'false',
            ];
        },
    ],
    'compress_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/compress',
        'extra_fields' => static function (): array {
            $presetMap = [
                'low' => 'lossless',
                'medium' => 'web',
                'high' => 'ebook',
            ];
            $level = trim((string) ($_POST['compression_level'] ?? 'medium'));
            $preset = $presetMap[$level] ?? 'web';

            return [
                'StoreFile' => 'false',
                'Preset' => $preset,
            ];
        },
    ],
    'protect_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/protect',
        'extra_fields' => static function (): array {
            $userPassword = trim((string) ($_POST['user_password'] ?? ''));
            $ownerPassword = trim((string) ($_POST['owner_password'] ?? $userPassword));
            if ($userPassword === '') {
                pdfServiceJsonError('Please provide a PDF password.');
            }

            return [
                'StoreFile' => 'false',
                'UserPassword' => $userPassword,
                'OwnerPassword' => $ownerPassword !== '' ? $ownerPassword : $userPassword,
                'PrintDocument' => !empty($_POST['allow_print']) ? 'true' : 'false',
                'CopyContent' => !empty($_POST['allow_copy']) ? 'true' : 'false',
            ];
        },
    ],
    'unlock_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/unprotect',
        'extra_fields' => static function (): array {
            return [
                'StoreFile' => 'false',
                'Password' => trim((string) ($_POST['password'] ?? '')),
            ];
        },
    ],
    'ocr_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/ocr',
        'extra_fields' => static function (): array {
            return [
                'StoreFile' => 'false',
                'OutputType' => trim((string) ($_POST['output_type'] ?? 'pdf')),
                'OcrLanguage' => trim((string) ($_POST['ocr_language'] ?? 'auto')),
            ];
        },
    ],
];

if (!isset($actionConfig[$action])) {
    pdfServiceJsonError('Unsupported PDF service action.');
}

$config = $actionConfig[$action];
$files = [];

if ($config['mode'] === 'single') {
    if (!isset($_FILES['file']) || !is_array($_FILES['file']) || ($_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        pdfServiceJsonError('Please upload a valid file.');
    }

    $files[] = $_FILES['file'];
} else {
    if (!isset($_FILES['files'])) {
        pdfServiceJsonError('Please upload at least two PDF files.');
    }

    $fileGroup = $_FILES['files'];
    if (!is_array($fileGroup['name'] ?? null)) {
        pdfServiceJsonError('Please upload at least two PDF files.');
    }

    foreach ($fileGroup['name'] as $index => $name) {
        $error = $fileGroup['error'][$index] ?? UPLOAD_ERR_NO_FILE;
        if ($error !== UPLOAD_ERR_OK) {
            continue;
        }

        $files[] = [
            'name' => $name,
            'type' => $fileGroup['type'][$index] ?? 'application/octet-stream',
            'tmp_name' => $fileGroup['tmp_name'][$index] ?? '',
            'error' => $error,
            'size' => $fileGroup['size'][$index] ?? 0,
        ];
    }

    if (count($files) < 2) {
        pdfServiceJsonError('Please upload at least two PDF files to merge.');
    }
}

foreach ($files as $file) {
    $extension = pdfServiceDetectExtension($file['name'] ?? '');
    if (!in_array($extension, $config['allowed_ext'], true)) {
        pdfServiceJsonError('Unsupported file type for this tool.');
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        pdfServiceJsonError('Uploaded file could not be verified.');
    }
}

$endpoint = ($config['endpoint'])($files);
$extraFields = ($config['extra_fields'])();
$postFields = [];

if ($config['mode'] === 'single') {
    $file = $files[0];
    $postFields['File'] = new CURLFile(
        $file['tmp_name'],
        $file['type'] ?: 'application/octet-stream',
        $file['name']
    );
} else {
    foreach ($files as $index => $file) {
        $postFields["Files[$index]"] = new CURLFile(
            $file['tmp_name'],
            $file['type'] ?: 'application/octet-stream',
            $file['name']
        );
    }
}

foreach ($extraFields as $key => $value) {
    $postFields[$key] = $value;
}

$url = 'https://v2.convertapi.com/convert/' . $endpoint;
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $convertApiSecret,
    ],
    CURLOPT_POSTFIELDS => $postFields,
    CURLOPT_TIMEOUT => 300,
    CURLOPT_CONNECTTIMEOUT => 30,
]);

$responseBody = curl_exec($ch);
$curlError = curl_error($ch);
$httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

if ($responseBody === false || $curlError !== '') {
    pdfServiceJsonError('PDF service request failed: ' . $curlError, 502);
}

$isJson = str_contains(strtolower($contentType), 'application/json');
if ($isJson) {
    $decoded = json_decode($responseBody, true);
    $message = $decoded['Message'] ?? $decoded['error'] ?? 'Conversion failed.';
    pdfServiceJsonError($message, $httpCode >= 400 ? $httpCode : 502);
}

if ($httpCode < 200 || $httpCode >= 300) {
    pdfServiceJsonError('PDF service returned an unexpected response.', 502, [
        'status' => $httpCode,
    ]);
}

$downloadName = pdfServiceDownloadName($action, $files);
$contentTypeOut = $config['output'] === 'docx'
    ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    : ($config['output'] === 'xlsx'
        ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        : ($config['output'] === 'pptx'
            ? 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
            : 'application/pdf'));

header('Content-Type: ' . $contentTypeOut);
header('Content-Length: ' . strlen($responseBody));
header('Content-Disposition: attachment; filename="' . rawurlencode($downloadName) . '"; filename*=UTF-8\'\'' . rawurlencode($downloadName));
header('X-File-Name: ' . rawurlencode($downloadName));
header('X-Tool-Engine: convertapi');
echo $responseBody;
