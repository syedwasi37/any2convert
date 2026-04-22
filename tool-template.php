<?php
declare(strict_types=1);

session_start();
require_once 'seo_data.php';
require_once 'backend/track_visit.php';
require_once 'backend/ad_helpers.php';
$toolRegistryPath = __DIR__ . '/backend/tool_registry.php';
if (is_file($toolRegistryPath)) {
    require_once $toolRegistryPath;
}
require_once __DIR__ . '/partials/site_chrome.php';

$slug = $any2convertToolSlug ?? ($_GET['slug'] ?? '');
if (function_exists('any2convertResolveToolFromSlug')) {
    $resolvedTool = any2convertResolveToolFromSlug($seo_tools, (string) $slug);
    $slug = $resolvedTool['slug'];
    $tool_data = $resolvedTool['tool'];
} else {
    $tool_data = $seo_tools[$slug] ?? null;
}

if ($tool_data && isset($any2convertToolOverride) && is_array($any2convertToolOverride)) {
    $tool_data = array_replace_recursive($tool_data, $any2convertToolOverride);
}

if (!$tool_data) {
    http_response_code(404);
    require __DIR__ . '/pages/404.php';
    exit;
}

$tool_id = $tool_data['id'];
trackVisit('Tool Page', $tool_id);

$wideToolIds = [
    'currency_converter',
    'length_converter',
    'weight_converter',
    'temperature_converter',
    'area_converter',
    'volume_converter',
    'speed_converter',
    'time_converter',
    'invoice_generator',
    'ats_resume_checker',
    'social_image_resizer',
    'jwt_decoder',
    'bank_statement_to_excel',
    'grammar_checker',
    'paraphrase_tool',
    'percentage_calculator',
    'loan_calculator',
    'bmi_calculator',
    'age_calculator',
    'sensitivity_converter',
    'reaction_time_test',
    'cps_test',
    'gamer_tag_generator',
    'clip_to_gif',
    'tournament_bracket_generator',
    'spin_wheel',
    'random_name_picker',
    'typing_speed_test',
    'meme_caption_generator',
    'truth_or_dare_generator',
    'memory_match_game',
    'edit_pdf',
];
$isWideTool = in_array($tool_id, $wideToolIds, true);

require_once 'backend/tool_handlers.php';
$tool_html = renderToolHandlerHTML($tool_id);

$siteUrl = 'https://any2convert.com';
$toolUrl = $siteUrl . '/' . $slug;
$toolTitle = $tool_data['title'];
$toolDescription = $tool_data['meta_desc'];
$toolFaqs = $tool_data['faqs'] ?? [];
$toolIntro = $tool_data['intro'] ?? '';
$toolUseCases = $tool_data['use_cases'] ?? [];
$toolFeatures = $tool_data['features'] ?? [];
$toolInternalLinks = $tool_data['internal_links'] ?? [];
$toolBestFor = $tool_data['best_for'] ?? [];
$toolSteps = $tool_data['steps'] ?? [];
$toolSections = $tool_data['sections'] ?? [];
$toolSummaryText = strtolower(($tool_data['meta_desc'] ?? '') . ' ' . ($tool_data['content'] ?? '') . ' ' . implode(' ', $toolSteps));
$usesServerProcessing = str_contains($toolSummaryText, 'server-side')
    || str_contains($toolSummaryText, 'server side')
    || str_contains($toolSummaryText, 'upload')
    || str_contains($toolSummaryText, 'conversion engine');
$processingLabel = $usesServerProcessing ? 'May use secure server-side processing' : 'Usually works directly in the browser';

function buildUseCases(array $toolData): array {
    if (!empty($toolData['use_cases'])) {
        return $toolData['use_cases'];
    }

    $description = strtolower($toolData['meta_desc'] ?? '');
    $content = strtolower($toolData['content'] ?? '');
    $combined = $description . ' ' . $content;

    if (str_contains($combined, 'pdf')) {
        return [
            'Useful for email attachments, form submissions, document cleanup, and quick PDF prep before sharing.',
            'Helps with office files, school paperwork, contracts, reports, scanned pages, and admin tasks that need one clear workflow.',
            'A practical option when you want a single-purpose PDF page instead of a larger desktop suite.',
        ];
    }

    if (str_contains($combined, 'image') || str_contains($combined, 'photo')) {
        return [
            'Useful for screenshots, product images, social-media assets, scans, and everyday photo cleanup jobs.',
            'Helps when you want one image task done quickly without opening a heavier design tool.',
            'A good fit for small visual edits where speed and clarity matter more than advanced studio features.',
        ];
    }

    return [
        'Use the tool for one focused task without downloading a large desktop app first.',
        'Handle common file, text, or utility work from a page built around one job instead of a cluttered dashboard.',
        'Move from input to result quickly when you need a practical answer and not a long setup process.',
    ];
}

function buildBestFor(array $toolData): array {
    if (!empty($toolData['best_for'])) {
        return $toolData['best_for'];
    }

    $description = strtolower($toolData['meta_desc'] ?? '');
    $content = strtolower($toolData['content'] ?? '');
    $combined = $description . ' ' . $content;

    if (str_contains($combined, 'pdf')) {
        return [
            'Quick document prep before email, upload, printing, or record keeping.',
            'Office paperwork, school files, reports, contracts, and scanned documents.',
            'One-off PDF tasks where opening a larger desktop app would be overkill.',
            'Situations where you want the tool, instructions, and follow-up checks on one page.',
        ];
    }

    if (str_contains($combined, 'image') || str_contains($combined, 'photo')) {
        return [
            'Screenshots, product images, creative assets, and simple visual cleanup work.',
            'Fast browser edits when you only need one image task completed cleanly.',
            'Preparing images for uploads, forms, sharing, or presentation use.',
            'Everyday photo work where convenience matters more than a full design suite.',
        ];
    }

    if (str_contains($combined, 'converter') || str_contains($combined, 'convert')) {
        return [
            'Changing a file or data format so the next app or person can use it more easily.',
            'Quick cleanup before reporting, sharing, uploading, or continuing a workflow.',
            'Single-purpose browser tasks that do not justify installing dedicated software.',
            'Everyday admin work where speed and clarity matter more than extra features.',
        ];
    }

    return [
        'Fast browser-based tasks that only need one clear workflow.',
        'Everyday work where you want input, output, and guidance in one place.',
        'Quick checks, conversions, or generators that do not need a full desktop app.',
        'Simple jobs where a focused tool is easier than a multi-feature platform.',
    ];
}

function buildSteps(array $toolData): array {
    if (!empty($toolData['steps'])) {
        return $toolData['steps'];
    }

    $title = $toolData['h1'] ?? 'this tool';
    $description = strtolower($toolData['meta_desc'] ?? '');
    $content = strtolower($toolData['content'] ?? '');
    $combined = $description . ' ' . $content;

    if (str_contains($combined, 'upload') || str_contains($combined, 'pdf') || str_contains($combined, 'image') || str_contains($combined, 'video')) {
        return [
            'Open ' . $title . ' and add the file or content the tool needs.',
            'Adjust any relevant option so the output matches the job you are trying to finish.',
            'Run the task and wait for the processing step to complete.',
            'Review the result carefully before downloading, sharing, or reusing it.',
        ];
    }

    return [
        'Open ' . $title . ' and enter the information or content you want to work with.',
        'Choose any available option or format that matches your goal.',
        'Run the tool and inspect the generated result on the page.',
        'Copy, download, or reuse the output once it looks correct.',
    ];
}

function buildSections(array $toolData): array {
    if (!empty($toolData['sections'])) {
        return $toolData['sections'];
    }

    $title = $toolData['h1'] ?? 'This tool';
    $description = strtolower($toolData['meta_desc'] ?? '');
    $content = strtolower($toolData['content'] ?? '');
    $combined = $description . ' ' . $content;

    $firstSection = [
        'title' => 'When ' . preg_replace('/\s+online$/i', '', $title) . ' Helps',
        'paragraphs' => [
            'This tool is most useful when you have one specific job to finish and do not want to jump between multiple apps to get there. A focused workflow is often faster, easier to review, and less frustrating for everyday tasks.',
            'Instead of treating the page like a black box, use the guidance here to decide whether the tool fits your input, the kind of result you expect, and the level of review you should do before sharing the output.',
        ],
    ];

    $secondParagraphs = [
        'Always review the final output before you send, publish, upload, or archive it. Small issues such as formatting shifts, cropped content, OCR mistakes, or file-order problems are easier to catch immediately than after someone else receives the result.',
    ];

    if (str_contains($combined, 'server-side') || str_contains($combined, 'server side') || str_contains($combined, 'upload')) {
        $secondParagraphs[] = 'If the workflow depends on server-side processing, only upload files you are comfortable handling online and avoid including anything unnecessary in the source document.';
    } else {
        $secondParagraphs[] = 'If the task runs locally in the browser, that can reduce friction and help keep simple jobs on your own device, but you should still treat sensitive files carefully.';
    }

    return [
        $firstSection,
        [
            'title' => 'What To Check Before You Rely On The Result',
            'paragraphs' => $secondParagraphs,
        ],
    ];
}

function buildFeatures(array $toolData): array {
    if (!empty($toolData['features'])) {
        return $toolData['features'];
    }

    $description = strtolower($toolData['meta_desc'] ?? '');
    $content = strtolower($toolData['content'] ?? '');
    $combined = $description . ' ' . $content;

    if (str_contains($combined, 'server-side') || str_contains($combined, 'server side') || str_contains($combined, 'upload')) {
        return [
            'Focused interface for one workflow so the important controls are easier to find.',
            'Tool-specific instructions and follow-up guidance on the same page as the converter itself.',
            'Built for browser use on desktop and mobile, with heavier processing used only when the workflow needs it.',
        ];
    }

    return [
        'Focused layout that keeps the main task, guidance, and FAQs on one page.',
        'Browser-friendly workflow designed to work cleanly on desktop, tablet, and mobile.',
        'Practical supporting copy so users know what the tool is good at and what to review afterward.',
    ];
}

function buildInternalLinkPhrases(array $relatedTools, array $customPhrases = []): array {
    if (!empty($customPhrases)) {
        return $customPhrases;
    }

    $phrases = [];
    foreach ($relatedTools as $relatedSlug => $relatedTool) {
        $phrases[] = [
            'slug' => $relatedSlug,
            'anchor' => $relatedTool['h1'],
            'context' => 'Continue with ' . $relatedTool['h1'] . ' if the next step in your workflow needs it.',
        ];
    }

    return $phrases;
}

function buildFallbackFaqs(array $toolData): array {
    $toolName = $toolData['h1'] ?? 'this tool';

    return [
        [
            'q' => 'Is ' . $toolName . ' free to use?',
            'a' => 'Yes. Any2Convert offers this tool free in the browser without a forced paid upgrade for normal usage.',
        ],
        [
            'q' => 'Does ' . $toolName . ' work on mobile and desktop?',
            'a' => 'Yes. The tool is designed to run in a modern browser on phones, tablets, laptops, and desktop devices.',
        ],
        [
            'q' => 'Are my files uploaded to a server?',
            'a' => 'Many Any2Convert tools process files locally in the browser whenever possible. For server-side tools, use only files you are comfortable processing online.',
        ],
    ];
}

function buildRelatedTools(array $allTools, string $currentSlug, int $limit = 6, array $preferredSlugs = []): array {
    if (!empty($preferredSlugs)) {
        $preferred = [];
        foreach ($preferredSlugs as $slug) {
            if ($slug === $currentSlug || !isset($allTools[$slug])) {
                continue;
            }
            $preferred[$slug] = $allTools[$slug];
            if (count($preferred) >= $limit) {
                return $preferred;
            }
        }
        if (!empty($preferred)) {
            return $preferred;
        }
    }

    $slugs = array_keys($allTools);
    $currentIndex = array_search($currentSlug, $slugs, true);
    if ($currentIndex === false || count($slugs) <= 1) {
        return [];
    }

    $related = [];
    $total = count($slugs);
    $offset = 1;
    while (count($related) < min($limit, $total - 1)) {
        foreach ([$offset, -$offset] as $direction) {
            $candidateIndex = ($currentIndex + $direction + $total) % $total;
            $candidateSlug = $slugs[$candidateIndex];
            if ($candidateSlug === $currentSlug || isset($related[$candidateSlug])) {
                continue;
            }
            $related[$candidateSlug] = $allTools[$candidateSlug];
            if (count($related) >= min($limit, $total - 1)) {
                break 2;
            }
        }
        $offset++;
    }

    return $related;
}

function stripEmptyStructuredData($value) {
    if (!is_array($value)) {
        return $value;
    }

    $clean = [];
    foreach ($value as $key => $item) {
        $item = stripEmptyStructuredData($item);
        if ($item === null || $item === '' || $item === []) {
            continue;
        }
        $clean[$key] = $item;
    }

    return $clean;
}

function sanitizeSoftwareApplicationSchema(array $schema): ?array {
    $schema = stripEmptyStructuredData($schema);

    $hasAggregateRating = !empty($schema['aggregateRating']);
    $hasReview = !empty($schema['review']) || !empty($schema['reviews']);

    // Only output SoftwareApplication when the page has genuine review data.
    // Otherwise Google/SEMrush flags it as invalid because rating or review is required.
    if (!$hasAggregateRating && !$hasReview) {
        return null;
    }

    return $schema;
}

$displayFaqs = !empty($toolFaqs) ? $toolFaqs : buildFallbackFaqs($tool_data);
$relatedTools = buildRelatedTools($seo_tools, $slug, 6, $tool_data['related_slugs'] ?? []);
$toolBestFor = buildBestFor($tool_data);
$toolSteps = buildSteps($tool_data);
$toolSections = buildSections($tool_data);
$toolUseCases = buildUseCases($tool_data);
$toolFeatures = buildFeatures($tool_data);
$toolInternalLinks = buildInternalLinkPhrases($relatedTools, $toolInternalLinks);

$webPageSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $tool_data['h1'],
    'url' => $toolUrl,
    'description' => $toolDescription,
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Any2Convert',
        'url' => $siteUrl . '/',
    ],
    'breadcrumb' => [
        '@id' => $toolUrl . '#breadcrumb',
    ],
];
$softwareSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => $tool_data['h1'],
    'applicationCategory' => 'UtilitiesApplication',
    'applicationSubCategory' => 'Online File and Utility Tool',
    'operatingSystem' => 'Web',
    'url' => $toolUrl,
    'description' => $toolDescription,
    'isAccessibleForFree' => true,
    'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD',
    ],
];
$softwareSchemaExtras = $tool_data['software_schema'] ?? [];
if (is_array($softwareSchemaExtras)) {
    $softwareSchema = array_replace_recursive($softwareSchema, $softwareSchemaExtras);
}
$softwareSchema = sanitizeSoftwareApplicationSchema($softwareSchema);
$breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    '@id' => $toolUrl . '#breadcrumb',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => $siteUrl . '/',
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => $tool_data['h1'],
            'item' => $toolUrl,
        ],
    ],
];
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static function ($faq) {
        return [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }, $displayFaqs),
];

// Get the rest of index.css and navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($toolTitle) ?></title>
    <link rel="icon" type="image/png" href="mylogo.png">
    <meta name="description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <meta name="application-name" content="Any2Convert">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta property="og:title" content="<?= htmlspecialchars($toolTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="<?= htmlspecialchars($toolUrl) ?>">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($toolTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="<?= htmlspecialchars($toolUrl) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($toolUrl) ?>">

    <script>
    tailwind.config = {
        darkMode: 'class'
    };
</script>
<script src="https://cdn.tailwindcss.com"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNWNK7QZTD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNWNK7QZTD');
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Schema Markup -->
    <script type="application/ld+json"><?= json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php if ($softwareSchema !== null): ?>
    <script type="application/ld+json"><?= json_encode($softwareSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endif; ?>
    <script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php if (!empty($displayFaqs)): ?>
    <script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endif; ?>

    <link rel="stylesheet" href="assets/css/tool-page.css">
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body>
<?= adsRenderPosition($conn, 'header') ?>

<?php
$isAdminUser = isset($_SESSION['email']) && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com';
$dashboardHref = $isAdminUser ? 'admin/dashboard.php' : 'dashboard.php';
$toolTopbarCta = '';
if (isset($_SESSION['user_name'])) {
    $toolTopbarCta = '<a href="' . htmlspecialchars($dashboardHref, ENT_QUOTES) . '" class="site-nav-pill">Dashboard</a>';
} else {
    $toolTopbarCta = '<a href="login.php" class="site-nav-pill">Sign in</a><a href="signup.php" class="btn-primary" style="text-decoration:none;font-size:0.84rem;padding:9px 18px;border-radius:999px;">Get started</a>';
}
?>
<?php any2convertRenderTopbar([
    'home_href' => 'index.php',
    'cta_html' => $toolTopbarCta,
]); ?>

<header class="text-center pt-16 pb-10 px-6">
    <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight" style="color: var(--text-primary);"><?= htmlspecialchars($tool_data['h1']) ?></h1>
    <p class="text-lg max-w-4xl mx-auto" style="color: var(--text-secondary);">
        <?= htmlspecialchars($toolIntro !== '' ? $toolIntro : 'Clear steps, practical output, and tool-specific guidance for real file work.') ?>
    </p>
    <div class="mt-6 flex flex-wrap justify-center gap-3 text-sm">
        <span class="inline-flex items-center rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-2 font-medium text-slate-700 dark:text-slate-200"><?= htmlspecialchars($processingLabel) ?></span>
        <?php if (!empty($toolBestFor)): ?>
        <span class="inline-flex items-center rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-2 font-medium text-slate-700 dark:text-slate-200"><?= count($toolBestFor) ?> practical use cases covered</span>
        <?php endif; ?>
        <?php if (!empty($displayFaqs)): ?>
        <span class="inline-flex items-center rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-4 py-2 font-medium text-slate-700 dark:text-slate-200"><?= count($displayFaqs) ?> FAQs on this page</span>
        <?php endif; ?>
    </div>
</header>

<main class="mx-auto px-6 pb-20" style="max-width: <?= $isWideTool ? '1280px' : '1000px' ?>;">
    <?= adsRenderPosition($conn, 'top_content') ?>
    <!-- TOOL INTERFACE -->
    <div class="tool-container<?= $isWideTool ? ' tool-container-wide' : '' ?>" id="modalContent" data-tool-id="<?= htmlspecialchars($tool_id, ENT_QUOTES) ?>">
        <?= $tool_html ?>
    </div>
    
    <!-- SEO CONTENT -->
    <div class="seo-content max-w-4xl mx-auto mt-20 text-slate-600 dark:text-slate-400 text-lg leading-relaxed space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">What This Tool Does</h2>
        <p><?= htmlspecialchars($tool_data['content']) ?></p>
        <p><?= htmlspecialchars($tool_data['h1']) ?> is meant to solve one job cleanly, with the working interface at the top and the supporting guidance below it. The goal is to help you finish the task quickly and still understand what to check before you rely on the result.</p>
        <p><?= $usesServerProcessing ? 'Some workflows on this page may hand work off to a secure server-side step when that produces a better result. If you are handling sensitive files, review the page instructions and privacy details before uploading anything important.' : 'For lightweight jobs, browser-based processing keeps the workflow simple and lets you review the result immediately on the same device.' ?></p>

        <?php if (!empty($toolBestFor)): ?>
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Best For</h2>
            <div class="grid md:grid-cols-2 gap-4 mt-6">
                <?php foreach ($toolBestFor as $point): ?>
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 text-base">
                    <?= htmlspecialchars($point) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolUseCases)): ?>
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Real-World Use Cases</h2>
            <div class="grid md:grid-cols-2 gap-4 mt-6">
                <?php foreach ($toolUseCases as $useCase): ?>
                <div class="p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm text-base">
                    <?= htmlspecialchars($useCase) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolFeatures)): ?>
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Key Features</h2>
            <div class="space-y-4 mt-6">
                <?php foreach ($toolFeatures as $feature): ?>
                <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-900/60 border border-slate-200 dark:border-slate-800 text-base">
                    <?= htmlspecialchars($feature) ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolSteps)): ?>
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">How To Use It</h2>
            <div class="space-y-4 mt-6">
                <?php foreach ($toolSteps as $index => $step): ?>
                <div class="flex items-start gap-4 p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                    <div class="h-10 w-10 shrink-0 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold"><?= $index + 1 ?></div>
                    <div class="text-base text-slate-600 dark:text-slate-300"><?= htmlspecialchars($step) ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolSections)): ?>
        <?php foreach ($toolSections as $section): ?>
        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($section['title'] ?? 'More Information') ?></h2>
            <div class="space-y-4 mt-5">
                <?php foreach (($section['paragraphs'] ?? []) as $paragraph): ?>
                <p><?= htmlspecialchars($paragraph) ?></p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <div class="mt-10">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Practical Tips</h2>
            <div class="space-y-4 mt-5">
                <p>Before exporting the final result, review the output once on the same device where you plan to use it. That catches common issues such as page order, cropped content, unexpected formatting, readability problems, or missing details in generated files.</p>
                <p><?= $usesServerProcessing ? 'If the input contains sensitive information, avoid uploading more than you need and keep copies only as long as necessary. Use only files you are comfortable processing online when a workflow depends on server-side conversion.' : 'If the input contains sensitive information, avoid sharing the source file more widely than necessary. Local browser processing can reduce exposure, but you should still treat personal, financial, legal, and business documents carefully.' ?></p>
            </div>
        </div>
        
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-12">Why use Any2Convert?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <strong class="block text-lg text-slate-900 dark:text-white mb-2"><?= $usesServerProcessing ? 'Clear Processing Expectations' : 'Local-First Processing' ?></strong>
                <?= $usesServerProcessing ? 'The strongest output sometimes needs server-side conversion, but this page explains that tradeoff more clearly so visitors know what kind of workflow they are using.' : 'Most lightweight file operations run directly on your device, so private documents can often be handled locally instead of being sent through a remote upload queue.' ?>
            </div>
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <strong class="block text-lg text-slate-900 dark:text-white mb-2">Task-Focused Guidance</strong>
                Each page includes steps, use cases, practical tips, and FAQs so you can judge the output instead of treating the tool like a black box.
            </div>
        </div>

        <?php if (!empty($relatedTools)): ?>
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Related Tools</h2>
            <p class="mt-4">Explore other tools that solve nearby tasks, help with the next step in the workflow, or give users another way to prepare, convert, edit, or verify their files.</p>
            <div class="grid md:grid-cols-2 gap-4 mt-6">
                <?php foreach ($relatedTools as $relatedSlug => $relatedTool): ?>
                <a href="./tool.php?page=<?= urlencode($relatedSlug) ?>" class="block p-5 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:border-blue-300 dark:hover:border-blue-600 transition">
                    <div class="text-lg font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($relatedTool['h1']) ?></div>
                    <div class="mt-2 text-base text-slate-600 dark:text-slate-300"><?= htmlspecialchars($relatedTool['meta_desc']) ?></div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($toolInternalLinks)): ?>
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">You May Also Like</h2>
            <div class="space-y-4 mt-6">
                <?php foreach ($toolInternalLinks as $link): ?>
                <p>
                    <a href="./tool.php?page=<?= urlencode($link['slug']) ?>" class="font-semibold text-blue-600 dark:text-blue-300"><?= htmlspecialchars($link['anchor']) ?></a>
                    <?= htmlspecialchars(' - ' . ($link['context'] ?? 'A related tool for the next step in this workflow.')) ?>
                </p>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-12">Frequently Asked Questions</h2>
        <div class="space-y-4 mt-6">
            <?php foreach ($displayFaqs as $faq): ?>
            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                <div class="font-bold text-slate-900 dark:text-white text-lg mb-2"><?= htmlspecialchars($faq['q']) ?></div>
                <div class="text-base"><?= htmlspecialchars($faq['a']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Read Full Guide CTA (Internal Blog Link) -->
        <div class="mt-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-[2rem] border border-blue-100 dark:border-blue-800 text-center">
            <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-3">Want to learn more?</h3>
            <p class="text-blue-700 dark:text-blue-300 mb-6 max-w-2xl mx-auto text-base">Read our comprehensive guide and step-by-step tutorial on how to get the most out of <?= htmlspecialchars($tool_data['title']) ?>.</p>
            <a href="blog/guide.php?slug=<?= urlencode($slug) ?>" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 dark:shadow-none text-base">Read the Full Guide</a>
        </div>
    </div>
</main>
<?= adsRenderPosition($conn, 'under_content') ?>

<?php any2convertRenderFooter(); ?>

<?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>

<script src="assets/js/tool-page.js"></script>
<?php any2convertRenderThemeScript(); ?>
</body>
</html>
