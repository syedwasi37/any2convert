<?php
require_once __DIR__ . '/auth_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    authRedirect('../login.php');
}

$email = $_SESSION['password_reset_verified_email'] ?? '';
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (!$email) {
    authSetFlash('error', 'Please verify your OTP first.');
    authRedirect('../forgot_password.php');
}

if (strlen($password) < 6) {
    authSetFlash('error', 'Password must be at least 6 characters long.');
    authRedirect('../reset_password.php');
}

if ($password !== $confirmPassword) {
    authSetFlash('error', 'Passwords do not match.');
    authRedirect('../reset_password.php');
}

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->execute([password_hash($password, PASSWORD_DEFAULT), $email]);

unset($_SESSION['password_reset_verified_email']);
authSetFlash('success', 'Password updated successfully. Please log in.');
authRedirect('../login.php');

