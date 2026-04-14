<?php
declare(strict_types=1);

$any2convertToolSlug = $_GET['slug'] ?? ($_GET['page'] ?? '');
require __DIR__ . '/tool-template.php';
