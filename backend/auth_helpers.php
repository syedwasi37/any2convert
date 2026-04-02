<?php
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth_bootstrap.php';
require_once __DIR__ . '/jwt_helpers.php';

any2convertBootstrapAuthSchema($conn);

function authSetFlash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function authGetFlash(): ?array
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

function authRedirect(string $path): void
{
    header("Location: $path");
    exit();
}

function authFindUserByEmail(PDO $conn, string $email): ?array
{
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([trim(strtolower($email))]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ?: null;
}

function authStartUserSession(array $user): void
{
    $token = jwtCreateToken($user);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['is_premium'] = $user['is_premium'] ?? 0;
    $_SESSION['jwt_token'] = $token;
    jwtSetAuthCookie($token);
    unset($_SESSION['pending_login_user_id'], $_SESSION['pending_login_email'], $_SESSION['pending_login_name']);
}

function authUserIsBlocked(array $user): bool
{
    return !empty($user['blocked_until']) && strtotime($user['blocked_until']) > time();
}

function authLogoutPendingFlow(): void
{
    unset($_SESSION['pending_login_user_id'], $_SESSION['pending_login_email'], $_SESSION['pending_login_name']);
    unset($_SESSION['password_reset_verified_email']);
}

function authGenerateOtpCode(): string
{
    return str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
}

function authStoreOtp(PDO $conn, ?int $userId, string $email, string $purpose, string $code, int $expiryMinutes = 10): void
{
    $email = trim(strtolower($email));
    $conn->prepare("UPDATE auth_otps SET used_at = NOW() WHERE email = ? AND purpose = ? AND used_at IS NULL")
        ->execute([$email, $purpose]);

    $stmt = $conn->prepare("
        INSERT INTO auth_otps (user_id, email, purpose, code_hash, expires_at)
        VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL ? MINUTE))
    ");
    $stmt->execute([
        $userId,
        $email,
        $purpose,
        password_hash($code, PASSWORD_DEFAULT),
        $expiryMinutes
    ]);
}

function authVerifyOtp(PDO $conn, string $email, string $purpose, string $code): ?array
{
    $email = trim(strtolower($email));
    $stmt = $conn->prepare("
        SELECT *
        FROM auth_otps
        WHERE email = ? AND purpose = ? AND used_at IS NULL AND expires_at >= NOW()
        ORDER BY id DESC
        LIMIT 1
    ");
    $stmt->execute([$email, $purpose]);
    $otp = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$otp || !password_verify($code, $otp['code_hash'])) {
        return null;
    }

    $conn->prepare("UPDATE auth_otps SET verified_at = NOW(), used_at = NOW() WHERE id = ?")->execute([$otp['id']]);
    return $otp;
}

function authPurposeLabel(string $purpose): string
{
    return $purpose === 'login_2fa' ? 'login verification' : 'password reset';
}

function authSendHtmlEmail(string $to, string $subject, string $html, string $plainText): bool
{
    $headers = [];
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=UTF-8";
    $headers[] = "From: Any2Convert Security <noreply@any2convert.com>";
    $headers[] = "Reply-To: support@any2convert.com";

    return mail($to, $subject, $html, implode("\r\n", $headers));
}

function authSendOtpEmail(string $email, string $code, string $purpose): bool
{
    $label = authPurposeLabel($purpose);
    $subject = "Your Any2Convert " . ucfirst($label) . " code";
    $html = "
        <div style='font-family:Arial,sans-serif;max-width:560px;margin:0 auto;padding:24px;color:#0f172a'>
            <h2 style='margin:0 0 12px;color:#2563eb'>Any2Convert Security Code</h2>
            <p style='font-size:15px;line-height:1.7'>Use the code below for your {$label}. This code expires in 10 minutes.</p>
            <div style='margin:24px 0;padding:18px;border-radius:16px;background:#eff6ff;border:1px solid #bfdbfe;text-align:center'>
                <div style='font-size:30px;font-weight:800;letter-spacing:8px;color:#1d4ed8'>{$code}</div>
            </div>
            <p style='font-size:14px;line-height:1.7;color:#475569'>If you did not request this, you can ignore this email.</p>
        </div>
    ";
    $plain = "Your Any2Convert {$label} code is {$code}. This code expires in 10 minutes.";
    return authSendHtmlEmail($email, $subject, $html, $plain);
}

function authRequireLogin(): void
{
    if (!isset($_SESSION['user_id'])) {
        authSetFlash('error', 'Please log in first.');
        authRedirect('login.php');
    }
}
