<?php
require_once __DIR__ . '/auth_helpers.php';

header('Content-Type: application/json');

$token = jwtExtractTokenFromRequest();
if (!$token) {
    http_response_code(401);
    echo json_encode([
        'error' => 'Missing bearer token.',
    ]);
    exit;
}

$payload = jwtDecodeToken($token);
if (!$payload) {
    http_response_code(401);
    echo json_encode([
        'error' => 'Invalid or expired token.',
    ]);
    exit;
}

echo json_encode([
    'authenticated' => true,
    'user' => [
        'id' => isset($payload['sub']) ? (int) $payload['sub'] : 0,
        'email' => (string) ($payload['email'] ?? ''),
        'name' => (string) ($payload['name'] ?? ''),
        'is_premium' => (int) ($payload['is_premium'] ?? 0),
    ],
    'claims' => $payload,
]);
