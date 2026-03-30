<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/backend/ad_helpers.php';
$flash = authGetFlash();
$client_id = "1035171361659-scrunl9467itq9ifg5ae11sij9ljjiu3.apps.googleusercontent.com";
$redirect_uri = "https://any2convert.com/backend/google_login.php";
$google_url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=" . $client_id . "&redirect_uri=" . $redirect_uri . "&response_type=code&scope=email%20profile";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Any2Convert</title>
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
        .auth-shell { position: relative; }
        .auth-shell::before { content: ''; position: absolute; inset: 0 auto auto 50%; width: 60rem; height: 24rem; transform: translateX(-50%); background: radial-gradient(circle, var(--glow) 0%, transparent 70%); filter: blur(24px); pointer-events: none; z-index: 0; }
        .topbar { position: sticky; top: 0; z-index: 40; backdrop-filter: blur(18px); background: var(--nav-bg); border-bottom: 1px solid var(--nav-border); }
        .nav-pill, .theme-toggle { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 10px 16px; border-radius: 999px; background: var(--pill-bg); color: var(--pill-text); border: 1px solid var(--panel-border); font-weight: 700; font-size: .88rem; text-decoration: none; }
        .theme-toggle { width: 46px; height: 46px; padding: 0; }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        html.dark .bg-white, html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-600 { color: var(--text-soft) !important; }
        html.dark .border-slate-200, html.dark .border-white, html.dark .border-blue-100, html.dark .border-red-100, html.dark .border-green-100 { border-color: var(--panel-border) !important; }
        html.dark .bg-blue-50 { background: rgba(37,99,235,0.18) !important; }
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
                <a href="signup.php" class="nav-pill">Create Account</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">☾</button>
            </div>
        </div>
    </nav>
    <main class="auth-shell">
        <div class="max-w-6xl mx-auto px-6 py-10 md:py-14 relative z-10">
            <div class="grid grid-cols-1 xl:grid-cols-[1.05fr_0.95fr] gap-8 items-stretch">
                <section class="panel rounded-[2.5rem] p-8 md:p-10 flex flex-col justify-between">
                    <div>
                        <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Account Access</p>
                        <h1 class="text-4xl md:text-5xl font-black tracking-tight mt-4 text-slate-900">Welcome back to your workspace</h1>
                        <p class="text-slate-500 mt-4 max-w-xl">Sign in to view your history, manage security settings, and continue where you left off.</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                        <div class="rounded-[1.5rem] bg-slate-50 p-5"><p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Private</p><p class="font-black text-slate-900 mt-2">Browser-first tools</p></div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5"><p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Faster</p><p class="font-black text-slate-900 mt-2">Quick access to your tools</p></div>
                        <div class="rounded-[1.5rem] bg-slate-50 p-5"><p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Safer</p><p class="font-black text-slate-900 mt-2">Optional email OTP security</p></div>
                    </div>
                </section>
                <section class="panel rounded-[2.5rem] p-8 md:p-10">
                    <div class="mb-8">
                        <h2 class="text-3xl font-black text-slate-900">Login</h2>
                        <p class="text-slate-500 mt-2">Use your Any2Convert account credentials.</p>
                    </div>
                    <?php if ($flash): ?>
                        <div class="mb-5 rounded-2xl px-4 py-3 text-sm font-medium <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-green-50 text-green-700 border border-green-100' ?>">
                            <?= htmlspecialchars($flash['message']) ?>
                        </div>
                    <?php endif; ?>
                    <form action="backend/login_logic.php" method="POST" class="space-y-4">
                        <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Email Address</label><input type="email" name="email" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                        <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Password</label><input type="password" name="password" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                        <div class="flex items-center justify-between gap-4 flex-wrap"><span class="text-sm text-slate-400">Forgot your password?</span><a href="forgot_password.php" class="text-sm font-bold text-blue-600 hover:underline">Reset with OTP</a></div>
                        <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-600 transition-all shadow-lg uppercase tracking-widest text-sm">Login Now</button>
                    </form>
                    <div class="flex items-center my-6"><div class="flex-grow border-t border-slate-200"></div><span class="mx-4 text-[10px] font-black text-slate-300 uppercase">Or</span><div class="flex-grow border-t border-slate-200"></div></div>
                    <a href="<?= htmlspecialchars($google_url) ?>" class="w-full flex items-center justify-center gap-3 bg-white border border-slate-200 py-4 rounded-2xl font-bold hover:bg-slate-50 transition-all shadow-sm group">
                        <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" class="w-5 h-5 group-hover:scale-110 transition-transform" alt="Google">
                        <span class="text-sm text-slate-700 font-bold uppercase tracking-tight">Continue with Google</span>
                    </a>
                    <p class="mt-8 text-center text-sm font-medium text-slate-500">New here? <a href="signup.php" class="text-blue-600 font-bold hover:underline">Create Account</a></p>
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
