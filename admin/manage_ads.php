<?php
session_start();
require_once __DIR__ . '/../backend/db.php';
require_once __DIR__ . '/../backend/ad_helpers.php';

if (($_SESSION['email'] ?? '') !== 'syedwasiulhassanshah@any2convert.com') {
    header('Location: ../login.php');
    exit();
}

$action = $_POST['action'] ?? '';

function adsFlashAndBack(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    header('Location: dashboard.php#ads');
    exit();
}

switch ($action) {
    case 'create':
        $title = trim($_POST['title'] ?? '');
        $position = $_POST['position_key'] ?? '';
        $targetUrl = trim($_POST['target_url'] ?? '');
        $width = (int) ($_POST['width_px'] ?? 0);
        $height = (int) ($_POST['height_px'] ?? 0);
        $adType = $_POST['ad_type'] ?? 'banner';
        $useCustomSize = isset($_POST['use_custom_size']);
        $enabled = isset($_POST['is_enabled']) ? 1 : 0;
        $allowedPositions = ['header', 'top_content', 'under_content', 'footer_sticky_bottom'];
        $typePresets = [
            'banner' => [728, 90],
            'card' => [320, 250],
            'sticky_banner' => [728, 90],
            'side_banner' => [300, 600],
            'vertical' => [160, 600],
            'horizontal' => [970, 250],
        ];

        if ($title === '' || !in_array($position, $allowedPositions, true) || empty($_FILES['ad_image']['tmp_name'])) {
            adsFlashAndBack('error', 'Please fill all required ad fields.');
        }

        if (!$useCustomSize && isset($typePresets[$adType])) {
            [$width, $height] = $typePresets[$adType];
        }

        $file = $_FILES['ad_image'];
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            adsFlashAndBack('error', 'Ad image upload failed.');
        }

        $mime = mime_content_type($file['tmp_name']);
        $allowedMimes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp', 'image/gif' => 'gif'];
        if (!isset($allowedMimes[$mime])) {
            adsFlashAndBack('error', 'Only JPG, PNG, WEBP, and GIF ads are supported.');
        }

        $uploadDir = adsEnsureUploadDir();
        $fileName = 'ad_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $allowedMimes[$mime];
        $targetPath = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            adsFlashAndBack('error', 'Could not save ad image.');
        }

        $publicPath = '/uploads/ads/' . $fileName;
        $stmt = $conn->prepare("
            INSERT INTO site_ads (title, position_key, image_path, target_url, width_px, height_px, is_enabled)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $title,
            $position,
            $publicPath,
            $targetUrl !== '' ? $targetUrl : null,
            $width > 0 ? $width : null,
            $height > 0 ? $height : null,
            $enabled
        ]);

        adsFlashAndBack('success', 'Ad uploaded successfully.');
        break;

    case 'toggle_legacy':
        $legacyKey = $_POST['legacy_key'] ?? '';
        $enabled = (int) ($_POST['is_enabled'] ?? 0) === 1 ? '1' : '0';
        $allowedKeys = array_column(adsLegacyDefinitions(), 'key');
        if (!in_array($legacyKey, $allowedKeys, true)) {
            adsFlashAndBack('error', 'Unknown legacy ad slot.');
        }
        $stmt = $conn->prepare("
            INSERT INTO site_ad_settings (setting_key, setting_value)
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)
        ");
        $stmt->execute([$legacyKey, $enabled]);
        adsFlashAndBack('success', $enabled === '1' ? 'Legacy ad enabled.' : 'Legacy ad disabled.');
        break;

    case 'toggle':
        $adId = (int) ($_POST['ad_id'] ?? 0);
        $enabled = (int) ($_POST['is_enabled'] ?? 0) === 1 ? 1 : 0;
        $stmt = $conn->prepare("UPDATE site_ads SET is_enabled = ? WHERE id = ?");
        $stmt->execute([$enabled, $adId]);
        adsFlashAndBack('success', $enabled ? 'Ad enabled.' : 'Ad disabled.');
        break;

    case 'delete':
        $adId = (int) ($_POST['ad_id'] ?? 0);
        $stmt = $conn->prepare("SELECT image_path FROM site_ads WHERE id = ?");
        $stmt->execute([$adId]);
        $ad = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($ad) {
            $conn->prepare("DELETE FROM site_ads WHERE id = ?")->execute([$adId]);
            $relativePath = ltrim($ad['image_path'], '/\\');
            $fullPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $relativePath);
            if (is_file($fullPath)) {
                @unlink($fullPath);
            }
        }
        adsFlashAndBack('success', 'Ad deleted.');
        break;
}

adsFlashAndBack('error', 'Unsupported ad action.');
