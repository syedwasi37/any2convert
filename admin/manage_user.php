<?php
session_start();
require_once __DIR__ . '/../backend/db.php';
require_once __DIR__ . '/../backend/auth_bootstrap.php';

any2convertBootstrapAuthSchema($conn);

if (($_SESSION['email'] ?? '') !== 'syedwasiulhassanshah@any2convert.com') {
    header('Location: ../login.php');
    exit();
}

$userId = (int) ($_POST['user_id'] ?? 0);
$action = $_POST['action'] ?? '';

if ($userId <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Invalid user selected.'];
    header('Location: dashboard.php');
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'User not found.'];
    header('Location: dashboard.php');
    exit();
}

if ($user['email'] === 'syedwasiulhassanshah@any2convert.com' && $action !== '') {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Admin account cannot be modified here.'];
    header('Location: dashboard.php');
    exit();
}

switch ($action) {
    case 'block':
        $days = max(1, min(365, (int) ($_POST['block_days'] ?? 7)));
        $stmt = $conn->prepare("UPDATE users SET blocked_until = DATE_ADD(NOW(), INTERVAL ? DAY) WHERE id = ?");
        $stmt->execute([$days, $userId]);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'User blocked for ' . $days . ' day(s).'];
        break;
    case 'unblock':
        $stmt = $conn->prepare("UPDATE users SET blocked_until = NULL WHERE id = ?");
        $stmt->execute([$userId]);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'User unblocked successfully.'];
        break;
    case 'delete':
        $conn->beginTransaction();
        try {
            $conn->prepare("DELETE FROM auth_otps WHERE user_id = ? OR email = ?")->execute([$userId, $user['email']]);
            $conn->prepare("DELETE FROM site_analytics WHERE user_id = ? OR user_email = ?")->execute([$userId, $user['email']]);
            $conn->prepare("DELETE FROM contact_messages WHERE user_id = ? OR email = ?")->execute([$userId, $user['email']]);
            $conn->prepare("DELETE FROM users WHERE id = ?")->execute([$userId]);
            $conn->commit();
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'User and related records deleted.'];
        } catch (Throwable $e) {
            $conn->rollBack();
            $_SESSION['flash'] = ['type' => 'error', 'message' => 'Failed to delete user.'];
        }
        break;
    default:
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Unsupported action.'];
}

header('Location: dashboard.php');
exit();
