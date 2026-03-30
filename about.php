<?php require_once __DIR__ . '/backend/ad_helpers.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Any2Convert</title>
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
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-soft:#f8fafc; --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; --glow:rgba(59,130,246,0.16); }
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-soft: rgba(15,23,42,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; --glow:rgba(96,165,250,0.18); }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .page-shell { position: relative; } .page-shell::before { content:''; position:absolute; inset:0 auto auto 50%; width:60rem; height:20rem; transform:translateX(-50%); background:radial-gradient(circle, var(--glow) 0%, transparent 70%); filter:blur(24px); pointer-events:none; z-index:0; }
        .topbar { position: sticky; top:0; z-index:40; backdrop-filter:blur(18px); background:var(--nav-bg); border-bottom:1px solid var(--nav-border); }
        .nav-pill, .theme-toggle { display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:10px 16px; border-radius:999px; background:var(--pill-bg); color:var(--pill-text); border:1px solid var(--panel-border); font-weight:700; font-size:.88rem; text-decoration:none; }
        .theme-toggle { width:46px; height:46px; padding:0; }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        html.dark .bg-white, html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-600 { color: var(--text-soft) !important; }
    </style>
</head>
<body class="min-h-screen">
    <?= adsRenderPosition($conn, 'header') ?>
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="nav-pill">Home</a>
                <a href="contact.php" class="nav-pill">Support</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">☾</button>
            </div>
        </div>
    </nav>
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
    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('themeToggle');
        const applyThemeLabel = () => { themeToggle.textContent = document.documentElement.classList.contains('dark') ? '☀' : '☾'; };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => { document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light'); applyThemeLabel(); });
    </script>
</body>
</html>
