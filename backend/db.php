<?php
$host = "localhost";
$dbname = "u966926210_users_db"; // Ye tumhare hPanel mein likha hoga
$username = "u966926210_wasi_admin"; // Ye bhi hPanel se dekhna
$password = "*S1vK!VJU#";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>