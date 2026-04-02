<?php
session_start();
require_once __DIR__ . '/jwt_helpers.php';

// Saare session variables ko khali kar do
$_SESSION = array();
jwtClearAuthCookie();

// Agar session cookie mojood hai toh usay bhi khatam karo
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Session destroy kar do
session_destroy();

// Seedha login page par wapas bhejo
header("Location: ../login.php");
exit();
?>
