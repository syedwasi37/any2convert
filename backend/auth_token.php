<?php
require_once __DIR__ . '/auth_helpers.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'], $_SESSION['jwt_token'])) {
    http_response_code(401);
    echo json_encode([
        'error' => 'Not authenticated.',
    ]);
    exit;
}

echo json_encode([
    'token' => $_SESSION['jwt_token'],
    'token_type' => 'Bearer',
    'expires_in' => jwtTtlSeconds(),
    'user' => [
        'id' => (int) $_SESSION['user_id'],
        'name' => (string) ($_SESSION['user_name'] ?? ''),
        'email' => (string) ($_SESSION['email'] ?? ''),
        'is_premium' => (int) ($_SESSION['is_premium'] ?? 0),
    ],
]);
