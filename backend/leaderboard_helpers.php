<?php

require_once __DIR__ . '/auth_helpers.php';

function leaderboardToolConfigs(): array
{
    return [
        'reaction_time_test' => [
            'label' => 'Reaction Time Test',
            'primary_order' => 'ASC',
            'secondary_order' => 'ASC',
        ],
        'cps_test' => [
            'label' => 'CPS Test',
            'primary_order' => 'DESC',
            'secondary_order' => 'DESC',
        ],
        'memory_match_game' => [
            'label' => 'Memory Match Game',
            'primary_order' => 'ASC',
            'secondary_order' => 'ASC',
        ],
        'typing_speed_test' => [
            'label' => 'Typing Speed Test',
            'primary_order' => 'DESC',
            'secondary_order' => 'DESC',
        ],
    ];
}

function leaderboardGetConfig(string $toolKey): ?array
{
    $configs = leaderboardToolConfigs();
    return $configs[$toolKey] ?? null;
}

function leaderboardIsBetter(string $toolKey, float $primary, ?float $secondary, ?array $existing): bool
{
    if (!$existing) {
        return true;
    }

    $currentPrimary = (float) ($existing['primary_score'] ?? 0);
    $currentSecondary = isset($existing['secondary_score']) ? (float) $existing['secondary_score'] : null;

    switch ($toolKey) {
        case 'reaction_time_test':
            return $primary < $currentPrimary;

        case 'cps_test':
            return $primary > $currentPrimary;

        case 'memory_match_game':
            if ($primary < $currentPrimary) {
                return true;
            }
            if ($primary > $currentPrimary) {
                return false;
            }
            if ($secondary === null) {
                return false;
            }
            if ($currentSecondary === null) {
                return true;
            }
            return $secondary < $currentSecondary;

        case 'typing_speed_test':
            if ($primary > $currentPrimary) {
                return true;
            }
            if ($primary < $currentPrimary) {
                return false;
            }
            if ($secondary === null) {
                return false;
            }
            if ($currentSecondary === null) {
                return true;
            }
            return $secondary > $currentSecondary;
    }

    return false;
}

function leaderboardFetchEntries(PDO $conn, string $toolKey, int $limit = 10): array
{
    $config = leaderboardGetConfig($toolKey);
    if (!$config) {
        return [];
    }

    $secondaryOrder = $config['secondary_order'];
    $primaryOrder = $config['primary_order'];

    $sql = "
        SELECT
            tl.user_id,
            COALESCE(NULLIF(TRIM(u.name), ''), CONCAT('User ', tl.user_id)) AS display_name,
            tl.primary_score,
            tl.secondary_score,
            tl.score_label,
            tl.score_meta,
            tl.updated_at
        FROM tool_leaderboards tl
        INNER JOIN users u ON u.id = tl.user_id
        WHERE tl.tool_key = ?
        ORDER BY tl.primary_score {$primaryOrder}, tl.secondary_score {$secondaryOrder}, tl.updated_at ASC
        LIMIT " . (int) $limit;

    $stmt = $conn->prepare($sql);
    $stmt->execute([$toolKey]);

    $entries = [];
    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) ?: [] as $index => $row) {
        $entries[] = [
            'rank' => $index + 1,
            'user_id' => (int) $row['user_id'],
            'display_name' => (string) $row['display_name'],
            'score_label' => (string) $row['score_label'],
            'score_meta' => $row['score_meta'] !== null ? (string) $row['score_meta'] : '',
            'updated_at' => (string) $row['updated_at'],
        ];
    }

    return $entries;
}
