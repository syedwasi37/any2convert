<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/backend/ad_helpers.php';
require_once __DIR__ . '/partials/site_chrome.php';
$flash = authGetFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Any2Convert</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel: rgba(255,255,255,.68); --panel-strong: rgba(255,255,255,.86); --border: rgba(17,17,24,.08); --text: #111118; --muted: #626280; --soft: rgba(241,244,255,.82); --accent: #6c63ff; --accent-strong: #3b82f6; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel: rgba(14,18,36,.66); --panel-strong: rgba(11,15,29,.86); --border: rgba(255,255,255,.08); --text: #eef2ff; --muted: #a7afcf; --soft: rgba(18,24,44,.92); --accent: #8b7cff; --accent-strong: #60a5fa; }
        body { margin:0; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); min-height:100vh; }
        .topbar { position:sticky; top:0; z-index:30; backdrop-filter:blur(18px); background:color-mix(in srgb, var(--panel-strong) 84%, transparent); border-bottom:1px solid var(--border); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 28px 80px rgba(15,23,42,.10); }
        .pill,.theme-toggle { display:inline-flex; align-items:center; justify-content:center; gap:8px; border-radius:999px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 92%, transparent); color:var(--text); text-decoration:none; font-weight:700; }
        .pill { padding:10px 16px; font-size:.9rem; } .theme-toggle { width:46px; height:46px; }
        .theme-toggle svg { width:18px; height:18px; }
        .brand-mark { display:inline-flex; align-items:center; gap:10px; text-decoration:none; }
        .brand-icon { width:30px; height:30px; border-radius:8px; background:var(--accent); color:#fff; display:inline-flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 12px 24px rgba(108,99,255,.24); }
        .brand-text { font-weight:700; font-size:1.05rem; letter-spacing:-0.02em; color:var(--text); }
        .brand-dot { color:var(--accent); }
        .label { font-size:.7rem; font-weight:800; text-transform:uppercase; letter-spacing:.24em; color:var(--muted); margin-bottom:10px; display:block; }
        .input { width:100%; padding:16px 18px; border-radius:18px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 96%, transparent); color:var(--text); font-size:1rem; font-weight:600; outline:none; transition:border-color .18s ease, box-shadow .18s ease, transform .18s ease; }
        .input:focus { border-color:color-mix(in srgb, var(--accent) 55%, white); box-shadow:0 0 0 4px rgba(37,99,235,.12); transform:translateY(-1px); }
        .primary-btn { width:100%; border:0; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; background:linear-gradient(135deg, var(--accent), var(--accent-strong)); color:white; box-shadow:0 18px 35px rgba(37,99,235,.24); cursor:pointer; transition:transform .18s ease, box-shadow .18s ease; }
        .primary-btn:hover { transform:translateY(-1px); }
        .flash { border-radius:18px; padding:14px 16px; font-size:.92rem; font-weight:600; border:1px solid transparent; }
        .flash.error { background:rgba(239,68,68,.08); color:#dc2626; border-color:rgba(239,68,68,.14); }
        .flash.success { background:rgba(34,197,94,.08); color:#15803d; border-color:rgba(34,197,94,.14); }
        html.dark .flash.error { color:#fca5a5; } html.dark .flash.success { color:#86efac; }
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body>
    <?= adsRenderPosition($conn, 'header') ?>
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => 'index.php', 'label' => 'Home'],
            ['href' => 'login.php', 'label' => 'Login'],
        ],
    ]); ?>
    <main class="max-w-6xl mx-auto px-6 py-10 md:py-14">
        <div class="grid grid-cols-1 xl:grid-cols-[0.96fr_1.04fr] gap-8 items-stretch">
            <section class="panel rounded-[2.4rem] p-8 md:p-10">
                <p class="text-xs font-black uppercase tracking-[0.30em] text-blue-500">Create Account</p>
                <h1 class="text-4xl md:text-5xl font-black tracking-tight mt-4">Join the Any2Convert workspace</h1>
                <p class="mt-4 text-base leading-8" style="color:var(--muted);">Create your account to track tool activity, manage profile security, and keep your workflow in one place.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    <div class="rounded-[1.6rem] p-5" style="background:var(--soft);">
                        <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--muted);">History</p>
                        <p class="font-black mt-2">Track recent tool usage</p>
                    </div>
                    <div class="rounded-[1.6rem] p-5" style="background:var(--soft);">
                        <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--muted);">Security</p>
                        <p class="font-black mt-2">Enable OTP on login</p>
                    </div>
                </div>
            </section>
            <section class="panel rounded-[2.4rem] p-8 md:p-10">
                <div class="mb-8">
                    <p class="text-xs font-black uppercase tracking-[0.28em] text-blue-500">Signup</p>
                    <h2 class="text-3xl font-black mt-3">Create your free account</h2>
                    <p class="mt-2" style="color:var(--muted);">It only takes a minute to get started.</p>
                </div>
                <?php if ($flash): ?>
                    <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?> mb-5">
                        <?= htmlspecialchars($flash['message']) ?>
                    </div>
                <?php endif; ?>
                <form action="backend/register.php" method="POST" class="space-y-4">
                    <div>
                        <label class="label">Full Name</label>
                        <input type="text" name="name" required class="input" autocomplete="name">
                    </div>
                    <div>
                        <label class="label">Email Address</label>
                        <input type="email" name="email" required class="input" autocomplete="email">
                    </div>
                    <div>
                        <label class="label">Password</label>
                        <input type="password" name="password" required class="input" autocomplete="new-password">
                    </div>
                    <button type="submit" class="primary-btn">Join Now</button>
                </form>
                <p class="mt-8 text-center text-sm font-medium" style="color:var(--muted);">
                    Already a member?
                    <a href="login.php" class="text-blue-600 font-bold hover:underline">Login</a>
                </p>
            </section>
        </div>
    </main>
    <?php any2convertRenderFooter(); ?>
    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
