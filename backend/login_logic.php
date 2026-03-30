<?php
require_once 'auth_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim(strtolower($_POST['email'] ?? ''));
    $password = $_POST['password'];

    $user = authFindUserByEmail($conn, $email);

    if ($user && authUserIsBlocked($user)) {
        authSetFlash('error', 'Your account is temporarily blocked. Please contact support.');
        authRedirect('../login.php');
    }

    if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
        if (!empty($user['email_auth_enabled'])) {
            $code = authGenerateOtpCode();
            authStoreOtp($conn, (int) $user['id'], $user['email'], 'login_2fa', $code, 10);

            if (!authSendOtpEmail($user['email'], $code, 'login_2fa')) {
                authSetFlash('error', 'We could not send the login OTP email. Please try again.');
                authRedirect('../login.php');
            }

            $_SESSION['pending_login_user_id'] = $user['id'];
            $_SESSION['pending_login_email'] = $user['email'];
            $_SESSION['pending_login_name'] = $user['name'];
            authSetFlash('success', 'We sent a login OTP to your email.');
            authRedirect('../otp_verify.php?purpose=login_2fa&email=' . urlencode($user['email']));
        }

        authStartUserSession($user);

        if ($email === 'syedwasiulhassanshah@any2convert.com') {
            authRedirect('../admin/dashboard.php');
        }
        authRedirect('../index.php');
    } else {
        authSetFlash('error', 'Invalid credentials.');
        authRedirect('../login.php');
    }
}
?>
