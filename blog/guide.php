<?php
require_once __DIR__ . '/../seo_data.php';
require_once __DIR__ . '/../backend/track_visit.php';

$slug = $_GET['slug'] ?? '';
$tool = $seo_tools[$slug] ?? null;

if (!$tool) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Blog post not found.</h1><a href='/blog/'>Return to Blog</a>";
    exit;
}

$toolUrl = "https://any2convert.com/" . $slug;
$pageTitle = $tool['h1'] . " Guide | Any2Convert";
$pageDesc = "Practical notes about " . strtolower($tool['h1']) . ", including where it helps and what to check before using the tool page.";
$canonical = $toolUrl;
$faqText = '';
if (!empty($tool['faqs']) && is_array($tool['faqs'])) {
    foreach ($tool['faqs'] as $faq) {
        $faqText .= ' ' . ($faq['q'] ?? '') . ' ' . ($faq['a'] ?? '');
    }
}
$detectionText = strtolower(($tool['meta_desc'] ?? '') . ' ' . ($tool['content'] ?? '') . ' ' . $faqText);
$usesServerProcessing = str_contains($detectionText, 'server-side')
    || str_contains($detectionText, 'server side')
    || str_contains($detectionText, 'uploaded')
    || str_contains($detectionText, 'upload')
    || str_contains($detectionText, 'conversion engine');
$bestFor = $tool['best_for'] ?? [];
$steps = $tool['steps'] ?? [];
$sections = $tool['sections'] ?? [];
if (empty($bestFor)) {
    $bestFor = [
        'Handling one focused file or utility task without extra software.',
        'Finishing a workflow quickly before the next admin, school, or sharing step.',
        'Reducing friction for uploads, reporting, or file cleanup work.',
        'Using a single-purpose tool page with enough guidance to review the result properly.',
    ];
}
if (empty($steps)) {
    $steps = [
        'Open the tool page and add the file, text, or input the workflow needs.',
        'Adjust any option that affects the output or quality of the result.',
        'Run the task and wait for the browser or server processing step to finish.',
        'Review the result carefully before downloading, copying, or sharing it.',
    ];
}
if (empty($sections)) {
    $sections = [
        [
            'title' => 'When This Tool Helps Most',
            'paragraphs' => [
                'This tool is most helpful when you have one clear job to finish and want the interface, explanation, and output steps on one page. That usually makes the workflow easier to follow than jumping between unrelated apps or tabs.',
                'It is especially useful for everyday admin work, quick content preparation, and simple tasks where speed matters but you still want enough context to review the output properly.',
            ],
        ],
        [
            'title' => 'What To Review Before Using The Result',
            'paragraphs' => [
                'Always check the final output once before you send, publish, upload, or archive it. Common issues are easier to catch immediately than after someone else receives the result.',
                $usesServerProcessing
                    ? 'If this workflow depends on server-side processing, only upload files you are comfortable handling online and avoid including unnecessary sensitive material.'
                    : 'If the task stays in the browser, that can reduce friction and help keep simple jobs local to your device, but you should still handle sensitive content carefully.',
            ],
        ],
    ];
}
trackVisit('Blog Guide Page', $slug);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta name="robots" content="noindex, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="<?= htmlspecialchars($canonical) ?>">
    <script>tailwind.config = { darkMode: 'class' };</script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNWNK7QZTD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNWNK7QZTD');
    </script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebPage",
      "name": "<?= htmlspecialchars($pageTitle) ?>",
      "description": "<?= htmlspecialchars($pageDesc) ?>",
      "url": "<?= htmlspecialchars($canonical) ?>",
      "isPartOf": { "@type": "WebSite", "name": "Any2Convert", "url": "https://any2convert.com/" }
    }
    </script>
    <style>
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --text-strong:#1e293b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; --faq-bg:#f8fafc; --faq-border:#e2e8f0; }
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --text-strong:#f8fafc; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; --faq-bg:rgba(30,41,59,0.55); --faq-border:rgba(71,85,105,0.7); }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        .guide-body { color: var(--text-soft); }
        .guide-body h1, .guide-body h2, .guide-body h3, .guide-body h4, .guide-body strong { color: var(--text-strong); }
        .guide-body a { color: #2563eb; }
        .guide-body a:hover { color: #1d4ed8; }
        .guide-intro { color: var(--text-strong); }
        .guide-faq { background: var(--faq-bg); border-color: var(--faq-border); }
    </style>
</head>
<body class="min-h-screen">
    <nav class="sticky top-0 z-40 backdrop-blur-[18px] bg-[var(--nav-bg)] border-b border-[var(--nav-border)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="../index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="px-4 py-2 rounded-full font-bold text-sm bg-[var(--pill-bg)] text-[var(--pill-text)] border border-[var(--panel-border)]">All Blogs</a>
                <a href="<?= htmlspecialchars($toolUrl) ?>" class="px-4 py-2 rounded-full font-bold text-sm bg-blue-600 text-white">Open Tool</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <article class="panel guide-body rounded-[2.75rem] p-8 md:p-12">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Tool Guide</p>
            <h1 class="text-4xl md:text-5xl font-black mt-4 leading-tight"><?= htmlspecialchars($tool['h1']) ?></h1>
            
            <div class="max-w-none mt-10 text-lg leading-relaxed">
                <p class="guide-intro text-xl font-medium mb-8"><?= htmlspecialchars($tool['meta_desc']) ?></p>
                
                <h2 class="text-2xl font-bold mt-10 mb-4">What this page is for</h2>
                <p>This page is a lightweight companion to the actual tool. It explains where <?= htmlspecialchars($tool['h1']) ?> tends to help most, what to double-check, and when you should use the real tool page instead of relying on a summary.</p>
                <p class="mt-4"><?= htmlspecialchars($tool['content']) ?></p>

                <?php if (!empty($bestFor)): ?>
                    <h2 class="text-2xl font-bold mt-10 mb-4">Best For</h2>
                    <ul class="list-disc pl-6 space-y-3 mt-4">
                        <?php foreach ($bestFor as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2 class="text-2xl font-bold mt-10 mb-4">How to Use the Tool</h2>
                <ul class="list-disc pl-6 space-y-3 mt-4">
                    <?php if (!empty($steps)): ?>
                        <?php foreach ($steps as $index => $step): ?>
                            <li><strong>Step <?= $index + 1 ?>:</strong> <?= htmlspecialchars($step) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><strong>Step 1:</strong> Open the tool page and add the file, text, or input the workflow needs.</li>
                        <li><strong>Step 2:</strong> Adjust any option that affects the output or quality of the result.</li>
                        <li><strong>Step 3:</strong> Start the task and wait for the processing step to finish.</li>
                        <li><strong>Step 4:</strong> Review the output carefully before downloading or sharing it.</li>
                    <?php endif; ?>
                </ul>

                <?php foreach ($sections as $section): ?>
                    <?php if (empty($section['title']) || empty($section['paragraphs']) || !is_array($section['paragraphs'])) continue; ?>
                    <h2 class="text-2xl font-bold mt-10 mb-4"><?= htmlspecialchars($section['title']) ?></h2>
                    <?php foreach ($section['paragraphs'] as $paragraph): ?>
                        <p class="mt-4"><?= htmlspecialchars($paragraph) ?></p>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <div class="my-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-[2rem] border border-blue-100 dark:border-blue-800 text-center">
                    <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-2">Need the actual result?</h3>
                    <p class="text-sm text-blue-600 dark:text-blue-300 mb-6"><?= $usesServerProcessing ? 'Use the tool page for upload, processing, and download. Review processing details first if the workflow uses server-side conversion.' : 'Use the tool page for upload, processing, and download. This guide is intentionally secondary.' ?></p>
                    <a href="<?= htmlspecialchars($toolUrl) ?>" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                        Open Tool
                    </a>
                </div>

                <h2 class="text-2xl font-bold mt-10 mb-4">Frequently Asked Questions</h2>
                <div class="space-y-6 mt-6">
                    <?php foreach(($tool['faqs'] ?? []) as $faq): ?>
                        <div class="guide-faq p-5 rounded-2xl border">
                            <h4 class="font-bold"><?= htmlspecialchars($faq['q']) ?></h4>
                            <p class="mt-2 text-base"><?= htmlspecialchars($faq['a']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </article>
    </main>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
    </script>
</body>
</html>
