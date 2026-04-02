<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/partials/site_chrome.php';
$flash = authGetFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel: rgba(255,255,255,.70); --panel-strong: rgba(255,255,255,.88); --border: rgba(17,17,24,.08); --text: #111118; --muted: #626280; --accent: #6c63ff; --accent-strong: #3b82f6; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel: rgba(14,18,36,.68); --panel-strong: rgba(11,15,29,.88); --border: rgba(255,255,255,.08); --text: #eef2ff; --muted: #a7afcf; --accent: #8b7cff; --accent-strong: #60a5fa; }
        body { margin:0; min-height:100vh; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 30px 80px rgba(27,39,94,.12); }
        .input { width:100%; padding:16px 18px; border-radius:18px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 96%, transparent); color:var(--text); outline:none; font-size:1rem; font-weight:600; }
        .input:focus { box-shadow:0 0 0 4px rgba(37,99,235,.12); border-color:rgba(37,99,235,.45); }
        .btn { width:100%; border:0; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; background:linear-gradient(135deg, var(--accent), var(--accent-strong)); color:#fff; box-shadow:0 18px 35px rgba(108,99,255,.24); cursor:pointer; }
        .flash { border-radius:18px; padding:14px 16px; font-size:.92rem; font-weight:600; margin-top:18px; }
        .flash.error { background:rgba(239,68,68,.08); color:#dc2626; } .flash.success { background:rgba(34,197,94,.08); color:#15803d; }
        .theme-toggle { width:46px; height:46px; display:inline-flex; align-items:center; justify-content:center; border-radius:999px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 92%, transparent); color:var(--text); }
        .theme-toggle svg { width:18px; height:18px; }
        .brand-mark { display:inline-flex; align-items:center; gap:10px; text-decoration:none; }
        .brand-icon { width:30px; height:30px; border-radius:8px; background:var(--accent); color:#fff; display:inline-flex; align-items:center; justify-content:center; flex-shrink:0; box-shadow:0 12px 24px rgba(108,99,255,.24); }
        .brand-text { font-weight:700; font-size:1.05rem; letter-spacing:-0.02em; color:var(--text); }
        .brand-dot { color:var(--accent); }
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body>
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => 'login.php', 'label' => 'Back to Login'],
        ],
        'badge' => 'Recovery',
    ]); ?>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="panel max-w-2xl mx-auto rounded-[2.4rem] p-8 md:p-10">
            <p class="text-xs font-black uppercase tracking-[0.30em] text-blue-500">Recovery</p>
            <h1 class="text-3xl md:text-4xl font-black mt-4">Reset access with email OTP</h1>
            <p class="mt-3 leading-7" style="color:var(--muted);">Enter your account email and we will send a 6-digit verification code so you can continue securely.</p>
            <?php if ($flash): ?>
                <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?>"><?= htmlspecialchars($flash['message']) ?></div>
            <?php endif; ?>
            <form action="backend/request_password_reset.php" method="POST" class="space-y-4 mt-6">
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-[0.24em] mb-2" style="color:var(--muted);">Email Address</label>
                    <input type="email" name="email" required class="input" autocomplete="email">
                </div>
                <button type="submit" class="btn">Send OTP</button>
            </form>
            <p class="mt-8 text-center text-sm font-medium" style="color:var(--muted);">
                Remembered it?
                <a href="login.php" class="text-blue-600 font-bold hover:underline">Back to Login</a>
            </p>
        </div>
    </div>
    <?php any2convertRenderFooter(); ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
