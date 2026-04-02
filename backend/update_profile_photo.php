<?php
require_once __DIR__ . '/auth_helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    authRedirect('../dashboard.php#overview');
}

if (!isset($_SESSION['user_id'])) {
    authSetFlash('error', 'Please log in first.');
    authRedirect('../login.php');
}

if (!isset($_FILES['avatar']) || !is_array($_FILES['avatar'])) {
    authSetFlash('error', 'Please choose an image first.');
    authRedirect('../dashboard.php#overview');
}

$file = $_FILES['avatar'];
if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    authSetFlash('error', 'Could not upload the selected file.');
    authRedirect('../dashboard.php#overview');
}

$tmpPath = $file['tmp_name'] ?? '';
if ($tmpPath === '' || !is_uploaded_file($tmpPath)) {
    authSetFlash('error', 'Invalid upload detected.');
    authRedirect('../dashboard.php#overview');
}

$maxBytes = 4 * 1024 * 1024;
if (($file['size'] ?? 0) > $maxBytes) {
    authSetFlash('error', 'Profile image must be under 4 MB.');
    authRedirect('../dashboard.php#overview');
}

$imageInfo = @getimagesize($tmpPath);
if ($imageInfo === false) {
    authSetFlash('error', 'Please upload a valid image file.');
    authRedirect('../dashboard.php#overview');
}

$mime = $imageInfo['mime'] ?? '';
$allowedMimes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp',
];

if (!isset($allowedMimes[$mime])) {
    authSetFlash('error', 'Only JPG, PNG, and WEBP images are allowed.');
    authRedirect('../dashboard.php#overview');
}

$uploadDir = dirname(__DIR__) . '/uploads/avatars';
if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0775, true);
}

if (!is_dir($uploadDir) || !is_writable($uploadDir)) {
    authSetFlash('error', 'Avatar directory is not writable.');
    authRedirect('../dashboard.php#overview');
}

$extension = $allowedMimes[$mime];
$fileName = 'avatar_' . (int) $_SESSION['user_id'] . '_' . time() . '.' . $extension;
$targetPath = $uploadDir . '/' . $fileName;

if (!move_uploaded_file($tmpPath, $targetPath)) {
    authSetFlash('error', 'Could not save profile image.');
    authRedirect('../dashboard.php#overview');
}

$publicPath = 'uploads/avatars/' . $fileName;

$stmt = $conn->prepare("SELECT avatar_path FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$oldPath = $stmt->fetchColumn();

$update = $conn->prepare("UPDATE users SET avatar_path = ? WHERE id = ?");
$update->execute([$publicPath, $_SESSION['user_id']]);

if (is_string($oldPath) && $oldPath !== '' && str_starts_with($oldPath, 'uploads/avatars/')) {
    $oldAbsolute = dirname(__DIR__) . '/' . $oldPath;
    if (is_file($oldAbsolute)) {
        @unlink($oldAbsolute);
    }
}

authSetFlash('success', 'Profile photo updated successfully.');
authRedirect('../dashboard.php#overview');
