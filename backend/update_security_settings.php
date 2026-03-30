<?php
require_once __DIR__ . '/auth_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    authRedirect('../dashboard.php');
}

if (!isset($_SESSION['user_id'])) {
    authSetFlash('error', 'Please log in first.');
    authRedirect('../login.php');
}

$enabled = isset($_POST['email_auth_enabled']) ? 1 : 0;
$stmt = $conn->prepare("UPDATE users SET email_auth_enabled = ? WHERE id = ?");
$stmt->execute([$enabled, $_SESSION['user_id']]);

authSetFlash('success', $enabled ? 'Email authentication enabled.' : 'Email authentication disabled.');
authRedirect('../dashboard.php');

