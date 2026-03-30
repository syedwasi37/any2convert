<?php
require_once 'db.php';
require_once __DIR__ . '/auth_bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

any2convertBootstrapAuthSchema($conn);

function trackVisit($page, $tool = 'Home') {
    global $conn;
    $ip = $_SERVER['REMOTE_ADDR'];
    $userId = $_SESSION['user_id'] ?? null;
    $userEmail = $_SESSION['email'] ?? null;
    
    // Duplicate entry se bachne ke liye (optional: agar 1 ghante mein wapas aaye toh count na karein)
    $stmt = $conn->prepare("INSERT INTO site_analytics (page_name, visitor_ip, tool_used, user_id, user_email) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$page, $ip, $tool, $userId, $userEmail]);
}
?>
