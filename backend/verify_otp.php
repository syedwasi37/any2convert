<?php
require_once __DIR__ . '/auth_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    authRedirect('../login.php');
}

$purpose = $_POST['purpose'] ?? '';
$email = trim(strtolower($_POST['email'] ?? ''));
$otp = preg_replace('/\D+/', '', $_POST['otp'] ?? '');

if (!$email || !$purpose || strlen($otp) !== 6) {
    authSetFlash('error', 'Please enter a valid 6-digit OTP.');
    authRedirect('../otp_verify.php?purpose=' . urlencode($purpose) . '&email=' . urlencode($email));
}

$otpRow = authVerifyOtp($conn, $email, $purpose, $otp);
if (!$otpRow) {
    authSetFlash('error', 'Invalid or expired OTP. Please try again.');
    authRedirect('../otp_verify.php?purpose=' . urlencode($purpose) . '&email=' . urlencode($email));
}

if ($purpose === 'password_reset') {
    $_SESSION['password_reset_verified_email'] = $email;
    authSetFlash('success', 'OTP verified. You can change your password now or continue.');
    authRedirect('../reset_password.php');
}

if ($purpose === 'login_2fa') {
    if (!isset($_SESSION['pending_login_email']) || $_SESSION['pending_login_email'] !== $email) {
        authSetFlash('error', 'Your login session expired. Please log in again.');
        authRedirect('../login.php');
    }

    $user = authFindUserByEmail($conn, $email);
    if (!$user) {
        authSetFlash('error', 'We could not finish your login. Please try again.');
        authRedirect('../login.php');
    }

    authStartUserSession($user);
    authSetFlash('success', 'Email authentication complete.');
    if ($user['email'] === 'syedwasiulhassanshah@any2convert.com') {
        authRedirect('../admin/dashboard.php');
    }
    authRedirect('../index.php');
}

authSetFlash('error', 'Unsupported OTP purpose.');
authRedirect('../login.php');
