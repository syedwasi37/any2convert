<?php
require_once __DIR__ . '/auth_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    authRedirect('../forgot_password.php');
}

$email = trim(strtolower($_POST['email'] ?? ''));
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    authSetFlash('error', 'Please enter a valid email address.');
    authRedirect('../forgot_password.php');
}

$user = authFindUserByEmail($conn, $email);
if ($user) {
    $code = authGenerateOtpCode();
    authStoreOtp($conn, (int) $user['id'], $email, 'password_reset', $code, 10);
    if (!authSendOtpEmail($email, $code, 'password_reset')) {
        authSetFlash('error', 'We could not send the OTP email right now. Please try again.');
        authRedirect('../forgot_password.php');
    }
}

authSetFlash('success', 'If that email exists, we sent a 6-digit OTP.');
authRedirect('../otp_verify.php?purpose=password_reset&email=' . urlencode($email));

