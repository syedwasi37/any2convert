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
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; }
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
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
        <article class="panel rounded-[2.75rem] p-8 md:p-12">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Tool Guide</p>
            <h1 class="text-4xl md:text-5xl font-black mt-4 text-slate-900 dark:text-white leading-tight"><?= htmlspecialchars($tool['h1']) ?></h1>

            <div class="prose dark:prose-invert max-w-none mt-10 text-slate-600 dark:text-slate-300 text-lg leading-relaxed">
                <p class="text-xl font-medium text-slate-800 dark:text-slate-200 mb-8"><?= htmlspecialchars($tool['meta_desc']) ?></p>

                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">What this page is for</h2>
                <p>This page is a lightweight companion to the actual tool. It explains where <?= htmlspecialchars($tool['h1']) ?> tends to help most, what to double-check, and when you should use the real tool page instead of relying on a summary.</p>
                <p class="mt-4"><?= htmlspecialchars($tool['content']) ?></p>

                <?php if (!empty($tool['steps'])): ?>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">How to use the actual tool page</h2>
                    <ul class="list-disc pl-6 space-y-3 mt-4">
                        <?php foreach ($tool['steps'] as $step): ?>
                            <li><?= htmlspecialchars($step) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php if (!empty($tool['best_for'])): ?>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">Best use cases</h2>
                    <ul class="list-disc pl-6 space-y-3 mt-4">
                        <?php foreach ($tool['best_for'] as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="my-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-[2rem] border border-blue-100 dark:border-blue-800 text-center">
                    <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-2">Need the actual result?</h3>
                    <p class="text-sm text-blue-600 dark:text-blue-300 mb-6">Use the real tool page for upload, processing, and download. This guide is intentionally secondary.</p>
                    <a href="<?= htmlspecialchars($toolUrl) ?>" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                        Open Tool
                    </a>
                </div>

                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">Frequently asked questions</h2>
                <div class="space-y-6 mt-6">
                    <?php foreach(($tool['faqs'] ?? []) as $faq): ?>
                        <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                            <h4 class="font-bold text-slate-900 dark:text-white"><?= htmlspecialchars($faq['q']) ?></h4>
                            <p class="mt-2 text-base text-slate-600 dark:text-slate-400"><?= htmlspecialchars($faq['a']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </article>
    </main>
</body>
</html>
