<?php
declare(strict_types=1);

$any2convertToolOverride = [
    'related_slugs' => [
        'merge-pdf',
        'remove-pdf-pages',
        'extract-pdf-pages',
        'organize-pdf',
        'compress-pdf',
    ],
];

$any2convertToolSlug = 'split-pdf';
require __DIR__ . '/../../tool-template.php';
