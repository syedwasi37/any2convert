<?php
session_start();
require_once __DIR__ . '/../backend/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com') {
    $msg_id = $_POST['msg_id'];
    $reply_text = $_POST['reply_text'];

    try {
        $stmt = $conn->prepare("UPDATE contact_messages SET reply = ? WHERE id = ?");
        $stmt->execute([$reply_text, $msg_id]);
        header("Location: dashboard.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
