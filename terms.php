<?php require_once __DIR__ . '/backend/ad_helpers.php'; ?>
<?php require_once __DIR__ . '/partials/site_chrome.php'; ?>
<?php require_once __DIR__ . '/backend/track_visit.php'; ?>
<?php trackVisit('Terms Page'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | Any2Convert</title>
    <meta name="description" content="Review the Any2Convert terms of service, acceptable use expectations, account responsibilities, and platform availability terms.">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <link rel="canonical" href="https://any2convert.com/terms.php">
    <meta property="og:title" content="Terms of Service | Any2Convert">
    <meta property="og:description" content="Review the Any2Convert terms of service, acceptable use expectations, account responsibilities, and platform availability terms.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="https://any2convert.com/terms.php">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Terms of Service | Any2Convert">
    <meta name="twitter:description" content="Review the Any2Convert terms of service, acceptable use expectations, account responsibilities, and platform availability terms.">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="https://any2convert.com/terms.php">
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"Terms of Service | Any2Convert","url":"https://any2convert.com/terms.php","description":"Review the Any2Convert terms of service, acceptable use expectations, account responsibilities, and platform availability terms.","isPartOf":{"@type":"WebSite","name":"Any2Convert","url":"https://any2convert.com/"}}</script>
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
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => 'index.php', 'label' => 'Home'],
            ['href' => 'contact.php', 'label' => 'Support'],
        ],
        'badge' => 'Terms',
    ]); ?>
    <main class="page-shell">
        <div class="max-w-4xl mx-auto px-6 py-12 relative z-10">
            <div class="panel rounded-[2.75rem] p-8 md:p-12">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Terms</p>
                <h1 class="text-4xl font-black mt-4 text-slate-900 tracking-tight">Terms of Service</h1>
                <div class="space-y-6 text-slate-600 leading-relaxed font-medium mt-8">
                    <p>These terms describe the basic rules for using Any2Convert. They are meant to set reasonable expectations around acceptable use, accounts, file processing, and service availability. By using the site, you agree to follow them.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Acceptable Use</h2>
                    <p>You may use the platform only for lawful purposes and in ways that do not abuse the service, interfere with other users, attempt unauthorized access, distribute harmful material, or violate the rights of another person or organization.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Your Files And Content</h2>
                    <p>You are responsible for the files, text, and content you upload or process. You should only use files you have the legal right to use. If a tool handles sensitive documents, it is your responsibility to decide whether that workflow is appropriate for the material involved.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Accounts And Security</h2>
                    <p>If you create an account, you are responsible for maintaining the security of your login details and for activity that happens under your account. If you believe your account has been accessed without permission, you should contact support as soon as possible.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Tool Accuracy And Availability</h2>
                    <p>We work to keep the service useful and available, but converters, OCR tools, AI-assisted features, and document-processing workflows are not guaranteed to be perfect for every file type or use case. Some outputs may require manual review, especially for scanned, damaged, or unusual documents.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Changes To The Service</h2>
                    <p>We may improve, remove, limit, or replace features over time. We may also update these terms if the product changes. Continued use of the site after those updates means you accept the revised terms.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Liability And Practical Limits</h2>
                    <p>Any2Convert is provided on an as-available basis. We try to keep the tools helpful and safe, but we cannot promise uninterrupted access, error-free conversion, or suitability for every business, legal, academic, or compliance workflow. Users should review important outputs before relying on them.</p>
                </div>
            </div>
        </div>
    </main>
    <?php any2convertRenderFooter(); ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
