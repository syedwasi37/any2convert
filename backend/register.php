<?php
require_once 'auth_helpers.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim(strtolower($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Password ko secure (hash) karna

    try {
        // Data insert karne ki query
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $email, $password]);

        authSetFlash('success', 'Account created successfully. Please log in.');
        authRedirect('../login.php');
    } catch(PDOException $e) {
        if ($e->getCode() == 23000) { // Agar email pehle se exist karti ho
            authSetFlash('error', 'Email already exists!');
            authRedirect('../signup.php');
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
