<?php

function jwtBase64UrlEncode(string $data): string
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function jwtBase64UrlDecode(string $data): string|false
{
    $padding = strlen($data) % 4;
    if ($padding > 0) {
        $data .= str_repeat('=', 4 - $padding);
    }

    return base64_decode(strtr($data, '-_', '+/'), true);
}

function jwtSecret(): string
{
    $secret = function_exists('envValue') ? envValue('JWT_SECRET') : null;
    if (!empty($secret)) {
        return $secret;
    }

    $fallback = function_exists('envValue') ? envValue('DB_PASS', 'any2convert-dev-secret') : 'any2convert-dev-secret';
    return hash('sha256', 'any2convert-jwt|' . $fallback);
}

function jwtIssuer(): string
{
    return function_exists('envValue') ? envValue('JWT_ISSUER', 'any2convert.com') : 'any2convert.com';
}

function jwtAudience(): string
{
    return function_exists('envValue') ? envValue('JWT_AUDIENCE', 'any2convert-users') : 'any2convert-users';
}

function jwtTtlSeconds(): int
{
    $ttl = function_exists('envValue') ? (int) envValue('JWT_TTL_SECONDS', '604800') : 604800;
    return max(300, $ttl);
}

function jwtCreateToken(array $user): string
{
    $now = time();
    $payload = [
        'iss' => jwtIssuer(),
        'aud' => jwtAudience(),
        'iat' => $now,
        'nbf' => $now,
        'exp' => $now + jwtTtlSeconds(),
        'sub' => (string) ($user['id'] ?? ''),
        'email' => $user['email'] ?? '',
        'name' => $user['name'] ?? '',
        'is_premium' => (int) ($user['is_premium'] ?? 0),
    ];

    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $segments = [
        jwtBase64UrlEncode(json_encode($header, JSON_UNESCAPED_SLASHES)),
        jwtBase64UrlEncode(json_encode($payload, JSON_UNESCAPED_SLASHES)),
    ];
    $signature = hash_hmac('sha256', implode('.', $segments), jwtSecret(), true);
    $segments[] = jwtBase64UrlEncode($signature);

    return implode('.', $segments);
}

function jwtDecodeToken(string $token): ?array
{
    $parts = explode('.', $token);
    if (count($parts) !== 3) {
        return null;
    }

    [$header64, $payload64, $signature64] = $parts;
    $signingInput = $header64 . '.' . $payload64;
    $expected = jwtBase64UrlEncode(hash_hmac('sha256', $signingInput, jwtSecret(), true));
    if (!hash_equals($expected, $signature64)) {
        return null;
    }

    $payloadJson = jwtBase64UrlDecode($payload64);
    if ($payloadJson === false) {
        return null;
    }

    $payload = json_decode($payloadJson, true);
    if (!is_array($payload)) {
        return null;
    }

    $now = time();
    if (($payload['iss'] ?? null) !== jwtIssuer() || ($payload['aud'] ?? null) !== jwtAudience()) {
        return null;
    }
    if (!empty($payload['nbf']) && (int) $payload['nbf'] > $now) {
        return null;
    }
    if (empty($payload['exp']) || (int) $payload['exp'] < $now) {
        return null;
    }

    return $payload;
}

function jwtExtractTokenFromRequest(): ?string
{
    $header = $_SERVER['HTTP_AUTHORIZATION'] ?? $_SERVER['Authorization'] ?? '';
    if (preg_match('/Bearer\s+(.+)/i', $header, $matches)) {
        return trim($matches[1]);
    }

    if (!empty($_COOKIE['any2convert_token'])) {
        return trim((string) $_COOKIE['any2convert_token']);
    }

    return null;
}

function jwtSetAuthCookie(string $token): void
{
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    setcookie('any2convert_token', $token, [
        'expires' => time() + jwtTtlSeconds(),
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}

function jwtClearAuthCookie(): void
{
    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    setcookie('any2convert_token', '', [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
}
