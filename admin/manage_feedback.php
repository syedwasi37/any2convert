<?php
session_start();
require_once __DIR__ . '/../backend/db.php';

if (($_SESSION['email'] ?? '') !== 'syedwasiulhassanshah@any2convert.com') {
    header('Location: ../login.php');
    exit();
}

$messageId = (int) ($_POST['message_id'] ?? 0);
$action = $_POST['action'] ?? '';
$replyText = trim($_POST['reply_text'] ?? '');

if ($messageId <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => 'Invalid feedback item.'];
    header('Location: dashboard.php');
    exit();
}

switch ($action) {
    case 'save_reply':
        $stmt = $conn->prepare("UPDATE contact_messages SET reply = ? WHERE id = ?");
        $stmt->execute([$replyText, $messageId]);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Reply saved successfully.'];
        break;
    case 'delete_reply':
        $stmt = $conn->prepare("UPDATE contact_messages SET reply = NULL WHERE id = ?");
        $stmt->execute([$messageId]);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Reply removed.'];
        break;
    case 'delete_comment':
        $stmt = $conn->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->execute([$messageId]);
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Comment deleted.'];
        break;
    default:
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'Unsupported moderation action.'];
}

header('Location: dashboard.php');
exit();
