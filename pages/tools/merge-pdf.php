<?php
declare(strict_types=1);

$any2convertToolOverride = [
    'related_slugs' => [
        'split-pdf',
        'compress-pdf',
        'remove-pdf-pages',
        'organize-pdf',
        'pdf-to-word',
    ],
];

$any2convertToolSlug = 'merge-pdf';
require __DIR__ . '/../../tool-template.php';
