<?php
declare(strict_types=1);

$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
$requestPath = parse_url($requestUri, PHP_URL_PATH) ?: '/';
$normalizedPath = trim($requestPath, '/');

if ($normalizedPath === '' || $normalizedPath === 'index.php') {
    require __DIR__ . '/index.php';
    return;
}

$route = $_GET['page'] ?? $_GET['slug'] ?? $normalizedPath;
$route = trim((string) $route, '/');

if ($route === '') {
    require __DIR__ . '/index.php';
    return;
}

if (!preg_match('/^[a-z0-9-]+$/', $route)) {
    http_response_code(404);
    require __DIR__ . '/pages/404.php';
    return;
}

$overridePage = __DIR__ . '/pages/tools/' . $route . '.php';
if (is_file($overridePage)) {
    require $overridePage;
    return;
}

$_GET['slug'] = $route;
require __DIR__ . '/tool.php';
