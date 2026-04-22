<?php require_once __DIR__ . '/backend/ad_helpers.php'; ?>
<?php require_once __DIR__ . '/partials/site_chrome.php'; ?>
<?php require_once __DIR__ . '/backend/track_visit.php'; ?>
<?php trackVisit('Privacy Page'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | Any2Convert</title>
    <meta name="description" content="Read the Any2Convert privacy policy covering account data, local on-device file processing, analytics, advertising, and security practices.">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <link rel="canonical" href="https://any2convert.com/privacy.php">
    <meta property="og:title" content="Privacy Policy | Any2Convert">
    <meta property="og:description" content="Read the Any2Convert privacy policy covering account data, local on-device file processing, analytics, advertising, and security practices.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="https://any2convert.com/privacy.php">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Privacy Policy | Any2Convert">
    <meta name="twitter:description" content="Read the Any2Convert privacy policy covering account data, local on-device file processing, analytics, advertising, and security practices.">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="https://any2convert.com/privacy.php">
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"WebPage","name":"Privacy Policy | Any2Convert","url":"https://any2convert.com/privacy.php","description":"Read the Any2Convert privacy policy covering account data, local on-device file processing, analytics, advertising, and security practices.","isPartOf":{"@type":"WebSite","name":"Any2Convert","url":"https://any2convert.com/"}}</script>
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
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel-bg: rgba(255,255,255,.72); --panel-soft: rgba(241,244,255,.86); --panel-border: rgba(17,17,24,.08); --text-main:#111118; --text-soft:#626280; --nav-bg:rgba(255,255,255,.70); --nav-border:rgba(17,17,24,.08); --pill-bg:rgba(255,255,255,.84); --pill-text:#20253d; --glow:rgba(108,99,255,.16); --accent:#6c63ff; --green:#10b981; --border:rgba(17,17,24,.08); --bg-surface:rgba(255,255,255,.72); --text-muted:#626280; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel-bg: rgba(14,18,36,.70); --panel-soft: rgba(18,24,44,.92); --panel-border: rgba(255,255,255,.08); --text-main:#eef2ff; --text-soft:#a7afcf; --nav-bg:rgba(11,15,29,.84); --nav-border:rgba(255,255,255,.08); --pill-bg:rgba(16,21,41,.92); --pill-text:#eef2ff; --glow:rgba(96,165,250,.20); --accent:#8b7cff; --border:rgba(255,255,255,.08); --bg-surface:rgba(14,18,36,.70); --text-muted:#a7afcf; }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
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
        'badge' => 'Privacy',
    ]); ?>
    <main class="page-shell">
        <div class="max-w-4xl mx-auto px-6 py-12 relative z-10">
            <div class="panel rounded-[2.75rem] p-8 md:p-12">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Privacy</p>
                <h1 class="text-4xl font-black mt-4 text-slate-900 tracking-tight">Privacy Policy</h1>
                <div class="space-y-6 text-slate-600 leading-relaxed font-medium mt-8">
                    <p>This policy explains what information Any2Convert may collect, how files are handled when you use the tools, how analytics and advertising technologies may be used, and what practical choices users have when they browse the site or create an account.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Information We Collect</h2>
                    <p>If you create an account, we may store your name, email address, password hash, profile preferences, and tool-related account activity needed to keep the service working. If you contact us, we may store the information you submit in your message so we can respond and improve support quality.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">How Files Are Handled</h2>
                    <p>Many tools are designed to run locally in your browser, which means the file is processed on your device and does not need to be uploaded to our server first. That local-first approach is used where it makes sense because it can reduce privacy risk and make simple tasks faster.</p>
                    <p>Some tools may require server-side processing or trusted third-party conversion infrastructure to produce better output for advanced workflows such as document conversion, OCR, or heavier PDF tasks. When a workflow depends on server processing, we aim to make that clear on the tool page so the user understands the difference before starting.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Cookies, Analytics, And Ads</h2>
                    <p>We use analytics services to understand which pages are useful, which tools are failing, and how visitors move through the website. We may also use advertising technologies, including Google services, to support the site. These services can use cookies, device information, and similar technologies according to their own policies and applicable law.</p>
                    <p>If ad personalization, consent banners, or regional cookie controls apply in your location, those controls may influence how advertising cookies are used. Blocking cookies in your browser may also affect some non-essential analytics or ad functionality.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Third-Party Services</h2>
                    <p>Any2Convert may rely on third-party providers for analytics, authentication, conversion infrastructure, or payment-related features if those are introduced. Those providers process information under their own terms and privacy policies. We try to limit these integrations to services that are relevant to operating or improving the platform.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Retention And Security</h2>
                    <p>We keep account and support information only as long as needed for operational, legal, security, or product-improvement reasons. We take reasonable technical and administrative steps to protect data, but no online service can promise absolute security in every scenario.</p>
                    <h2 class="text-xl font-bold text-slate-900 uppercase">Your Questions And Requests</h2>
                    <p>If you have a privacy question, need clarification about file handling, or want to contact us about account data, you can use the support page on this website. We review legitimate privacy and account requests as reasonably as possible.</p>
                </div>
            </div>
        </div>
    </main>
    <?php any2convertRenderFooter(); ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
