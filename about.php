<?php require_once __DIR__ . '/backend/ad_helpers.php'; ?>
<?php require_once __DIR__ . '/partials/site_chrome.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Any2Convert</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel-bg: rgba(255,255,255,.72); --panel-soft: rgba(241,244,255,.86); --panel-border: rgba(17,17,24,.08); --text-main:#111118; --text-soft:#626280; --nav-bg:rgba(255,255,255,.70); --nav-border:rgba(17,17,24,.08); --pill-bg:rgba(255,255,255,.84); --pill-text:#20253d; --glow:rgba(108,99,255,.16); --accent:#6c63ff; --green:#10b981; --border:rgba(17,17,24,.08); --bg-surface:rgba(255,255,255,.72); --text-muted:#626280; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel-bg: rgba(14,18,36,.70); --panel-soft: rgba(18,24,44,.92); --panel-border: rgba(255,255,255,.08); --text-main:#eef2ff; --text-soft:#a7afcf; --nav-bg:rgba(11,15,29,.84); --nav-border:rgba(255,255,255,.08); --pill-bg:rgba(16,21,41,.92); --pill-text:#eef2ff; --glow:rgba(96,165,250,.20); --accent:#8b7cff; --border:rgba(255,255,255,.08); --bg-surface:rgba(14,18,36,.70); --text-muted:#a7afcf; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .page-shell { position: relative; }
        .page-shell::before { content:''; position:absolute; inset:0 auto auto 50%; width:60rem; height:20rem; transform:translateX(-50%); background:radial-gradient(circle, var(--glow) 0%, transparent 70%); filter:blur(24px); pointer-events:none; z-index:0; }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-600 { color: var(--text-soft) !important; }
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body class="min-h-screen">
    <?= adsRenderPosition($conn, 'header') ?>
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => 'index.php', 'label' => 'Home'],
            ['href' => 'contact.php', 'label' => 'Support'],
        ],
        'badge' => 'About',
    ]); ?>
    <main class="page-shell">
        <div class="max-w-4xl mx-auto px-6 py-12 relative z-10">
            <?= adsRenderPosition($conn, 'top_content') ?>
            <div class="panel rounded-[2.75rem] p-8 md:p-12">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">About</p>
                <h1 class="text-4xl font-black mt-4 text-slate-900 tracking-tight">About Any2Convert</h1>
                <div class="space-y-6 text-slate-600 leading-relaxed font-medium mt-8">
                    <p>Any2Convert is designed to make file conversion fast, practical, and easier to trust. We focus on tools that feel simple to use without looking basic.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Why We Built It</h2>
                    <p>Too many converter sites feel cluttered, slow, or unclear about privacy. Our goal is to build a cleaner experience with tools that work quickly and stay straightforward.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">How We Think</h2>
                    <p>We care about privacy-first browser workflows, lightweight interfaces, and features that are actually useful for everyday work.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Where We Are Going</h2>
                    <p>Any2Convert will keep growing as an all-in-one workspace for PDF, image, and utility tools with a better user experience than typical converter sites.</p>
                </div>
            </div>
        </div>
    </main>
    <?= adsRenderPosition($conn, 'under_content') ?>
    <?php any2convertRenderFooter(); ?>
    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
