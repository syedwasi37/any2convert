<?php
require_once 'db.php';
require_once __DIR__ . '/auth_bootstrap.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

any2convertBootstrapAuthSchema($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $rating = isset($_POST['rating']) ? $_POST['rating'] : 0; // Star rating fetch karna
    $userId = $_SESSION['user_id'] ?? null;

    try {
        $stmt = $conn->prepare("INSERT INTO contact_messages (user_id, name, email, subject, message, rating) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$userId, $name, $email, $subject, $message, $rating]);
        
        echo "<script>alert('Thank you for your feedback!'); window.location.href='../contact.php';</script>";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
