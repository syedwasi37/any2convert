<?php

function any2convertBootstrapAuthSchema(PDO $conn): void
{
    static $bootstrapped = false;
    if ($bootstrapped) {
        return;
    }
    $bootstrapped = true;

    try {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS auth_otps (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NULL,
                email VARCHAR(255) NOT NULL,
                purpose VARCHAR(50) NOT NULL,
                code_hash VARCHAR(255) NOT NULL,
                expires_at DATETIME NOT NULL,
                verified_at DATETIME NULL,
                used_at DATETIME NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_auth_otps_lookup (email, purpose, used_at, expires_at),
                INDEX idx_auth_otps_user (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } catch (Throwable $e) {
        return;
    }

    try {
        $dbName = $conn->query("SELECT DATABASE()")->fetchColumn();
    } catch (Throwable $e) {
        return;
    }
    if (!$dbName) {
        return;
    }

    $requiredColumns = [
        'email_auth_enabled' => "ALTER TABLE users ADD COLUMN email_auth_enabled TINYINT(1) NOT NULL DEFAULT 0",
        'email_verified_at' => "ALTER TABLE users ADD COLUMN email_verified_at DATETIME NULL",
        'blocked_until' => "ALTER TABLE users ADD COLUMN blocked_until DATETIME NULL",
        'avatar_path' => "ALTER TABLE users ADD COLUMN avatar_path VARCHAR(255) NULL",
    ];

    try {
        $stmt = $conn->prepare("
            SELECT COLUMN_NAME
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'users'
        ");
        $stmt->execute([$dbName]);
        $existing = $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    } catch (Throwable $e) {
        return;
    }

    foreach ($requiredColumns as $column => $sql) {
        if (!in_array($column, $existing, true)) {
            try {
                $conn->exec($sql);
            } catch (Throwable $e) {
            }
        }
    }

    $analyticsColumns = [
        'user_id' => "ALTER TABLE site_analytics ADD COLUMN user_id INT NULL",
        'user_email' => "ALTER TABLE site_analytics ADD COLUMN user_email VARCHAR(255) NULL",
    ];
    try {
        $stmt = $conn->prepare("
            SELECT COLUMN_NAME
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'site_analytics'
        ");
        $stmt->execute([$dbName]);
        $existingAnalytics = $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    } catch (Throwable $e) {
        $existingAnalytics = [];
    }
    foreach ($analyticsColumns as $column => $sql) {
        if (!in_array($column, $existingAnalytics, true)) {
            try {
                $conn->exec($sql);
            } catch (Throwable $e) {
            }
        }
    }

    $contactColumns = [
        'user_id' => "ALTER TABLE contact_messages ADD COLUMN user_id INT NULL",
    ];
    try {
        $stmt = $conn->prepare("
            SELECT COLUMN_NAME
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'contact_messages'
        ");
        $stmt->execute([$dbName]);
        $existingContact = $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    } catch (Throwable $e) {
        $existingContact = [];
    }
    foreach ($contactColumns as $column => $sql) {
        if (!in_array($column, $existingContact, true)) {
            try {
                $conn->exec($sql);
            } catch (Throwable $e) {
            }
        }
    }

    try {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS site_ads (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                position_key VARCHAR(50) NOT NULL,
                image_path VARCHAR(255) NOT NULL,
                target_url VARCHAR(500) NULL,
                width_px INT NULL,
                height_px INT NULL,
                is_enabled TINYINT(1) NOT NULL DEFAULT 1,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_site_ads_position (position_key, is_enabled)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } catch (Throwable $e) {
    }

    $adColumns = [
        'title' => "ALTER TABLE site_ads ADD COLUMN title VARCHAR(255) NOT NULL DEFAULT 'Site Ad'",
        'position_key' => "ALTER TABLE site_ads ADD COLUMN position_key VARCHAR(50) NOT NULL DEFAULT 'top_content'",
        'image_path' => "ALTER TABLE site_ads ADD COLUMN image_path VARCHAR(255) NOT NULL DEFAULT ''",
        'target_url' => "ALTER TABLE site_ads ADD COLUMN target_url VARCHAR(500) NULL",
        'width_px' => "ALTER TABLE site_ads ADD COLUMN width_px INT NULL",
        'height_px' => "ALTER TABLE site_ads ADD COLUMN height_px INT NULL",
        'is_enabled' => "ALTER TABLE site_ads ADD COLUMN is_enabled TINYINT(1) NOT NULL DEFAULT 1",
        'created_at' => "ALTER TABLE site_ads ADD COLUMN created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP",
        'updated_at' => "ALTER TABLE site_ads ADD COLUMN updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
    ];
    try {
        $stmt = $conn->prepare("
            SELECT COLUMN_NAME
            FROM information_schema.COLUMNS
            WHERE TABLE_SCHEMA = ? AND TABLE_NAME = 'site_ads'
        ");
        $stmt->execute([$dbName]);
        $existingAds = $stmt->fetchAll(PDO::FETCH_COLUMN) ?: [];
    } catch (Throwable $e) {
        $existingAds = [];
    }
    foreach ($adColumns as $column => $sql) {
        if (!in_array($column, $existingAds, true)) {
            try {
                $conn->exec($sql);
            } catch (Throwable $e) {
            }
        }
    }

    try {
        $conn->exec("
            CREATE TABLE IF NOT EXISTS site_ad_settings (
                setting_key VARCHAR(100) PRIMARY KEY,
                setting_value VARCHAR(255) NOT NULL,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    } catch (Throwable $e) {
    }
}
