<?php
require_once 'auth_helpers.php';

$client_id = envValue('GOOGLE_CLIENT_ID', '1035171361659-scrunl9467itq9ifg5ae11sij9ljjiu3.apps.googleusercontent.com');
$client_secret = envValue('GOOGLE_CLIENT_SECRET', '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');
$redirect_uri = envValue('GOOGLE_REDIRECT_URI', 'https://any2convert.com/backend/google_login.php');

if (isset($_GET['code'])) {
    // 1. Exchange code for access token
    $token_url = 'https://oauth2.googleapis.com/token';
    $post_data = [
        'code' => $_GET['code'],
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code'
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response, true);

    if (isset($data['access_token'])) {
        // 2. Get user info from Google
        $user_info_url = 'https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . $data['access_token'];
        $user_info = json_decode(file_get_contents($user_info_url), true);

        $google_id = $user_info['sub'];
        $email = $user_info['email'];
        $name = $user_info['name'];

        // 3. Check if user already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            // Naya user banayein agar nahi hai
            $stmt = $conn->prepare("INSERT INTO users (name, email, google_id) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $google_id]);
            
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
        }

        // 4. Session start
        if (authUserIsBlocked($user)) {
            authSetFlash('error', 'Your account is temporarily blocked. Please contact support.');
            authRedirect('../login.php');
        }

        if (!empty($user['email_auth_enabled'])) {
            $code = authGenerateOtpCode();
            authStoreOtp($conn, (int) $user['id'], $user['email'], 'login_2fa', $code, 10);

            if (!authSendOtpEmail($user['email'], $code, 'login_2fa')) {
                authSetFlash('error', 'Google sign-in worked, but OTP email sending failed. Please try again.');
                authRedirect('../login.php');
            }

            $_SESSION['pending_login_user_id'] = $user['id'];
            $_SESSION['pending_login_email'] = $user['email'];
            $_SESSION['pending_login_name'] = $user['name'];
            authSetFlash('success', 'We sent a login OTP to your email.');
            authRedirect('../otp_verify.php?purpose=login_2fa&email=' . urlencode($user['email']));
        }

        authStartUserSession($user);
        if ($user['email'] === 'syedwasiulhassanshah@any2convert.com') {
            authRedirect('../admin/dashboard.php');
        }
        authRedirect('../index.php');
    } else {
        echo "Google Login Failed!";
    }
}
?>
