<?php
require_once __DIR__ . '/leaderboard_helpers.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Please log in to save leaderboard scores.']);
    exit;
}

$raw = file_get_contents('php://input');
$payload = json_decode($raw ?: '', true);
if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON payload.']);
    exit;
}

$toolKey = trim((string) ($payload['tool'] ?? ''));
$config = leaderboardGetConfig($toolKey);
if (!$config) {
    http_response_code(400);
    echo json_encode(['error' => 'Unsupported leaderboard tool.']);
    exit;
}

$primary = isset($payload['primary_score']) ? (float) $payload['primary_score'] : null;
$secondary = isset($payload['secondary_score']) && $payload['secondary_score'] !== '' ? (float) $payload['secondary_score'] : null;
$scoreLabel = trim((string) ($payload['score_label'] ?? ''));
$scoreMeta = trim((string) ($payload['score_meta'] ?? ''));

if ($primary === null || !is_finite($primary) || $scoreLabel === '') {
    http_response_code(422);
    echo json_encode(['error' => 'Missing or invalid score data.']);
    exit;
}

$userId = (int) $_SESSION['user_id'];

$existingStmt = $conn->prepare("
    SELECT id, primary_score, secondary_score
    FROM tool_leaderboards
    WHERE tool_key = ? AND user_id = ?
    LIMIT 1
");
$existingStmt->execute([$toolKey, $userId]);
$existing = $existingStmt->fetch(PDO::FETCH_ASSOC) ?: null;

if (!leaderboardIsBetter($toolKey, $primary, $secondary, $existing)) {
    echo json_encode([
        'saved' => false,
        'reason' => 'not_better',
        'entries' => leaderboardFetchEntries($conn, $toolKey, 10),
    ]);
    exit;
}

if ($existing) {
    $update = $conn->prepare("
        UPDATE tool_leaderboards
        SET primary_score = ?, secondary_score = ?, score_label = ?, score_meta = ?
        WHERE id = ?
    ");
    $update->execute([$primary, $secondary, $scoreLabel, $scoreMeta !== '' ? $scoreMeta : null, (int) $existing['id']]);
} else {
    $insert = $conn->prepare("
        INSERT INTO tool_leaderboards (tool_key, user_id, primary_score, secondary_score, score_label, score_meta)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $insert->execute([$toolKey, $userId, $primary, $secondary, $scoreLabel, $scoreMeta !== '' ? $scoreMeta : null]);
}

echo json_encode([
    'saved' => true,
    'entries' => leaderboardFetchEntries($conn, $toolKey, 10),
]);
