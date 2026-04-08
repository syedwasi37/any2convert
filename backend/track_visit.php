<?php
require_once 'db.php';
require_once __DIR__ . '/auth_bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

any2convertBootstrapAuthSchema($conn);

function any2convertGetClientIp(): string {
    $candidates = [];

    $cfIp = $_SERVER['HTTP_CF_CONNECTING_IP'] ?? '';
    if ($cfIp !== '') {
        $candidates[] = trim($cfIp);
    }

    $xForwardedFor = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '';
    if ($xForwardedFor !== '') {
        foreach (explode(',', $xForwardedFor) as $ipPart) {
            $ipPart = trim($ipPart);
            if ($ipPart !== '') {
                $candidates[] = $ipPart;
            }
        }
    }

    $xRealIp = $_SERVER['HTTP_X_REAL_IP'] ?? '';
    if ($xRealIp !== '') {
        $candidates[] = trim($xRealIp);
    }

    $remoteAddr = $_SERVER['REMOTE_ADDR'] ?? '';
    if ($remoteAddr !== '') {
        $candidates[] = trim($remoteAddr);
    }

    foreach ($candidates as $candidateIp) {
        if (filter_var($candidateIp, FILTER_VALIDATE_IP)) {
            return $candidateIp;
        }
    }

    return '0.0.0.0';
}

function trackVisit($page, $tool = 'Home') {
    global $conn;
    $ip = any2convertGetClientIp();
    $userId = $_SESSION['user_id'] ?? null;
    $userEmail = $_SESSION['email'] ?? null;
    
    try {
        $stmt = $conn->prepare("INSERT INTO site_analytics (page_name, visitor_ip, tool_used, user_id, user_email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$page, $ip, $tool, $userId, $userEmail]);
    } catch (Throwable $e) {
        // Analytics failures should never break page rendering.
    }
}
?>
