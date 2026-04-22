<?php
declare(strict_types=1);

$any2convertToolOverride = [
    'related_slugs' => [
        'merge-pdf',
        'split-pdf',
        'pdf-to-word',
        'protect-pdf',
        'remove-pdf-pages',
    ],
];

$any2convertToolSlug = 'compress-pdf';
require __DIR__ . '/../../tool-template.php';
