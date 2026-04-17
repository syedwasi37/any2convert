<?php
require_once __DIR__ . '/../seo_data.php';
require_once __DIR__ . '/../partials/site_chrome.php';
require_once __DIR__ . '/../backend/ad_helpers.php';
require_once __DIR__ . '/../backend/track_visit.php';

$slug = $_GET['slug'] ?? '';
$tool = $seo_tools[$slug] ?? null;

if (!$tool) {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>Blog post not found.</h1><a href='/blog/'>Return to Blog</a>";
    exit;
}

$pageTitle = $tool['h1'] . " Guide | Any2Convert";
$pageDesc = "Learn everything about " . strtolower($tool['h1']) . ". " . $tool['meta_desc'];
$canonical = "https://any2convert.com/blog/guide.php?slug=" . urlencode($slug);
$toolUrl = "https://any2convert.com/" . $slug;
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
trackVisit('Blog Guide Page', $slug);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <link rel="canonical" href="<?= htmlspecialchars($canonical) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($pageDesc) ?>">
    <meta property="og:type" content="article">
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    
    <!-- Article Schema for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "headline": "<?= htmlspecialchars($pageTitle) ?>",
      "description": "<?= htmlspecialchars($pageDesc) ?>",
      "mainEntityOfPage": "<?= htmlspecialchars($canonical) ?>",
      "author": { "@type": "Organization", "name": "Any2Convert" },
      "publisher": { "@type": "Organization", "name": "Any2Convert", "logo": {"@type": "ImageObject", "url": "https://any2convert.com/mylogo.png"} }
    }
    </script>
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"BreadcrumbList","itemListElement":[{"@type":"ListItem","position":1,"name":"Home","item":"https://any2convert.com/"},{"@type":"ListItem","position":2,"name":"Blog","item":"https://any2convert.com/blog/"},{"@type":"ListItem","position":3,"name":"<?= htmlspecialchars($tool['h1']) ?> Guide","item":"<?= htmlspecialchars($canonical) ?>"}]}</script>
    
    <style>
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; }
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
    </style>
</head>
<body class="min-h-screen">
    <nav class="sticky top-0 z-40 backdrop-blur-[18px] bg-[var(--nav-bg)] border-b border-[var(--nav-border)]">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="../index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="px-4 py-2 rounded-full font-bold text-sm bg-[var(--pill-bg)] text-[var(--pill-text)] border border-[var(--panel-border)]">All Blogs</a>
                <a href="<?= htmlspecialchars($toolUrl) ?>" class="px-4 py-2 rounded-full font-bold text-sm bg-blue-600 text-white">Use Tool Now</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        <article class="panel rounded-[2.75rem] p-8 md:p-12">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Tool Guide</p>
            <h1 class="text-4xl md:text-5xl font-black mt-4 text-slate-900 dark:text-white leading-tight">Mastering <?= htmlspecialchars($tool['h1']) ?></h1>
            
            <div class="prose dark:prose-invert max-w-none mt-10 text-slate-600 dark:text-slate-300 text-lg leading-relaxed">
                <p class="text-xl font-medium text-slate-800 dark:text-slate-200 mb-8"><?= htmlspecialchars($tool['meta_desc']) ?></p>
                
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">Why Do You Need This?</h2>
                <p><?= htmlspecialchars($tool['content']) ?></p>
                <?php if ($usesServerProcessing): ?>
                    <p class="mt-4">This workflow may use secure server-side processing for the heavy conversion step when that produces a better result. For sensitive files, review the tool page and privacy policy first so you know whether the job stays in the browser or is handled on the server.</p>
                <?php else: ?>
                    <p class="mt-4">This tool is best when you want a fast browser workflow without installing desktop software. For everyday file tasks, keeping the process inside the browser can reduce friction and make the result easier to review immediately.</p>
                <?php endif; ?>

                <?php if (!empty($bestFor)): ?>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">Best For</h2>
                    <ul class="list-disc pl-6 space-y-3 mt-4">
                        <?php foreach ($bestFor as $item): ?>
                            <li><?= htmlspecialchars($item) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">How to Use the Tool</h2>
                <ul class="list-disc pl-6 space-y-3 mt-4">
                    <?php if (!empty($steps)): ?>
                        <?php foreach ($steps as $index => $step): ?>
                            <li><strong>Step <?= $index + 1 ?>:</strong> <?= htmlspecialchars($step) ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li><strong>Step 1:</strong> Open the <a href="<?= htmlspecialchars($toolUrl) ?>" class="text-blue-500 font-bold hover:underline"><?= htmlspecialchars($tool['title']) ?></a> page.</li>
                        <li><strong>Step 2:</strong> Add your file or enter the data the tool needs.</li>
                        <li><strong>Step 3:</strong> Start the task and wait for the tool to finish processing.</li>
                        <li><strong>Step 4:</strong> Review the output carefully before downloading or sharing it.</li>
                    <?php endif; ?>
                </ul>

                <?php foreach ($sections as $section): ?>
                    <?php if (empty($section['title']) || empty($section['paragraphs']) || !is_array($section['paragraphs'])) continue; ?>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4"><?= htmlspecialchars($section['title']) ?></h2>
                    <?php foreach ($section['paragraphs'] as $paragraph): ?>
                        <p class="mt-4"><?= htmlspecialchars($paragraph) ?></p>
                    <?php endforeach; ?>
                <?php endforeach; ?>

                <div class="my-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-[2rem] border border-blue-100 dark:border-blue-800 text-center">
                    <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-2">Ready to try it out?</h3>
                    <p class="text-sm text-blue-600 dark:text-blue-300 mb-6"><?= $usesServerProcessing ? 'Free to use. Review the tool page for processing details before uploading sensitive files.' : 'Free to use with no desktop installation required.' ?></p>
                    <a href="<?= htmlspecialchars($toolUrl) ?>" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-sm hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 dark:shadow-none">
                        Open Tool
                    </a>
                </div>

                <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-10 mb-4">Frequently Asked Questions</h2>
                <div class="space-y-6 mt-6">
                    <?php foreach($tool['faqs'] as $faq): ?>
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
