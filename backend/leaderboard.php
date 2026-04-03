<?php
require_once __DIR__ . '/leaderboard_helpers.php';

header('Content-Type: application/json');

$toolKey = trim((string) ($_GET['tool'] ?? ''));
$config = leaderboardGetConfig($toolKey);

if (!$config) {
    http_response_code(400);
    echo json_encode(['error' => 'Unsupported leaderboard tool.']);
    exit;
}

$entries = leaderboardFetchEntries($conn, $toolKey, 10);

echo json_encode([
    'authenticated' => isset($_SESSION['user_id']),
    'tool' => $toolKey,
    'label' => $config['label'],
    'entries' => $entries,
]);
