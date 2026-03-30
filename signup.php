<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/backend/ad_helpers.php';
$flash = authGetFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Any2Convert</title>
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
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-soft:#f8fafc; --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; --glow:rgba(59,130,246,0.16);}
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-soft: rgba(15,23,42,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; --glow:rgba(96,165,250,0.18);}
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .auth-shell { position: relative; } .auth-shell::before { content: ''; position: absolute; inset: 0 auto auto 50%; width: 60rem; height: 24rem; transform: translateX(-50%); background: radial-gradient(circle, var(--glow) 0%, transparent 70%); filter: blur(24px); pointer-events: none; z-index: 0; }
        .topbar { position: sticky; top: 0; z-index: 40; backdrop-filter: blur(18px); background: var(--nav-bg); border-bottom: 1px solid var(--nav-border); }
        .nav-pill, .theme-toggle { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; border-radius: 999px; background: var(--pill-bg); color: var(--pill-text); border: 1px solid var(--panel-border); font-weight: 700; font-size: .88rem; text-decoration: none; }
        .theme-toggle { width: 46px; height: 46px; padding: 0; }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        html.dark .bg-white, html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-600 { color: var(--text-soft) !important; }
        html.dark .border-slate-200, html.dark .border-white, html.dark .border-blue-100, html.dark .border-red-100, html.dark .border-green-100 { border-color: var(--panel-border) !important; }
        html.dark .bg-red-50 { background: rgba(239,68,68,0.16) !important; }
        html.dark .bg-green-50 { background: rgba(16,185,129,0.16) !important; }
        html.dark input { background: rgba(15,23,42,0.92) !important; color: var(--text-main) !important; }
    </style>
</head>
<body class="min-h-screen">
    <?= adsRenderPosition($conn, 'header') ?>
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="nav-pill">Home</a>
                <a href="login.php" class="nav-pill">Login</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">☾</button>
            </div>
        </div>
    </nav>
    <main class="auth-shell">
        <div class="max-w-6xl mx-auto px-6 py-10 md:py-14 relative z-10">
            <div class="grid grid-cols-1 xl:grid-cols-[0.95fr_1.05fr] gap-8 items-stretch">
                <section class="panel rounded-[2.5rem] p-8 md:p-10">
                    <div class="mb-8">
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Create Account</p>
                        <h1 class="text-4xl md:text-5xl font-black tracking-tight mt-4 text-slate-900">Join the Any2Convert workspace</h1>
                        <p class="text-slate-500 mt-4">Create a free account to keep your activity in one place and unlock better account security.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-[1.5rem] bg-slate-50 p-5"><p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">History</p><p class="font-black text-slate-900 mt-2">Track your recent tool usage</p></div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5"><p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Security</p><p class="font-black text-slate-900 mt-2">Enable email OTP protection</p></div>
                    </div>
                </section>
                <section class="panel rounded-[2.5rem] p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-3xl font-black text-slate-900">Create your free account</h2>
                        <p class="text-slate-500 mt-2">It only takes a minute to get started.</p>
                    </div>
                    <?php if ($flash): ?>
                        <div class="mb-5 rounded-2xl px-4 py-3 text-sm font-medium <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-green-50 text-green-700 border border-green-100' ?>">
                            <?= htmlspecialchars($flash['message']) ?>
                        </div>
                    <?php endif; ?>
                    <form action="backend/register.php" method="POST" class="space-y-4">
                        <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Full Name</label><input type="text" name="name" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                        <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Email Address</label><input type="email" name="email" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                        <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Password</label><input type="password" name="password" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                        <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-slate-900 transition-all shadow-lg uppercase tracking-widest text-sm">Join Now</button>
                    </form>
                    <p class="mt-8 text-center text-sm font-medium text-slate-500">Already a member? <a href="login.php" class="text-blue-600 font-bold hover:underline">Login</a></p>
                </section>
            </div>
        </div>
    </main>
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
