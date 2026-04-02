<?php
require_once __DIR__ . '/backend/auth_helpers.php';
if (!isset($_SESSION['password_reset_verified_email'])) {
    authSetFlash('error', 'Please verify your OTP first.');
    authRedirect('forgot_password.php');
}
$flash = authGetFlash();
$verifiedEmail = $_SESSION['password_reset_verified_email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel: rgba(255,255,255,.70); --panel-strong: rgba(255,255,255,.90); --border: rgba(17,17,24,.08); --text: #111118; --muted: #626280; --accent: #6c63ff; --accent-strong: #3b82f6; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel: rgba(14,18,36,.68); --panel-strong: rgba(11,15,29,.90); --border: rgba(255,255,255,.08); --text: #eef2ff; --muted: #a7afcf; --accent: #8b7cff; --accent-strong: #60a5fa; }
        body { margin:0; min-height:100vh; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 30px 80px rgba(27,39,94,.12); }
        .input { width:100%; padding:16px 18px; border-radius:18px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 96%, transparent); color:var(--text); outline:none; font-size:1rem; font-weight:600; }
        .input:focus { box-shadow:0 0 0 4px rgba(37,99,235,.12); border-color:rgba(37,99,235,.45); }
        .btn-primary, .btn-secondary { width:100%; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; text-decoration:none; display:flex; align-items:center; justify-content:center; }
        .btn-primary { border:0; background:linear-gradient(135deg, var(--accent), var(--accent-strong)); color:#fff; box-shadow:0 18px 35px rgba(108,99,255,.24); }
        .btn-secondary { border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 94%, transparent); color:var(--text); margin-top:14px; }
        .flash { border-radius:18px; padding:14px 16px; font-size:.92rem; font-weight:600; margin-top:18px; }
        .flash.error { background:rgba(239,68,68,.08); color:#dc2626; } .flash.success { background:rgba(34,197,94,.08); color:#15803d; }
        .theme-toggle { width:46px; height:46px; display:inline-flex; align-items:center; justify-content:center; border-radius:999px; border:1px solid var(--border); background:color-mix(in srgb, var(--panel-strong) 92%, transparent); color:var(--text); }
        .theme-toggle svg { width:18px; height:18px; }
    </style>
</head>
<body>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">
                <svg id="iconMoon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg id="iconSun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none"><circle cx="12" cy="12" r="5"/><path d="M12 1v2"/><path d="M12 21v2"/><path d="M4.22 4.22l1.42 1.42"/><path d="M18.36 18.36l1.42 1.42"/><path d="M1 12h2"/><path d="M21 12h2"/><path d="M4.22 19.78l1.42-1.42"/><path d="M18.36 5.64l1.42-1.42"/></svg>
            </button>
        </div>
        <div class="panel max-w-2xl mx-auto rounded-[2.4rem] p-8 md:p-10">
            <p class="text-xs font-black uppercase tracking-[0.30em] text-blue-500">Password Reset</p>
            <h1 class="text-3xl md:text-4xl font-black mt-4">Choose your next step</h1>
            <p class="mt-3 leading-7" style="color:var(--muted);">OTP verified for <?= htmlspecialchars($verifiedEmail) ?>. You can set a new password now or continue without changing it.</p>
            <?php if ($flash): ?>
                <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?>"><?= htmlspecialchars($flash['message']) ?></div>
            <?php endif; ?>
            <form action="backend/update_password.php" method="POST" class="space-y-4 mt-6">
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-[0.24em] mb-2" style="color:var(--muted);">New Password</label>
                    <input type="password" name="password" required minlength="6" class="input" autocomplete="new-password">
                </div>
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-[0.24em] mb-2" style="color:var(--muted);">Confirm Password</label>
                    <input type="password" name="confirm_password" required minlength="6" class="input" autocomplete="new-password">
                </div>
                <button type="submit" class="btn-primary">Change Password</button>
            </form>
            <a href="backend/skip_password_reset.php" class="btn-secondary">Continue Without Changing</a>
        </div>
    </div>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('themeToggle');
        const iconMoon = document.getElementById('iconMoon');
        const iconSun = document.getElementById('iconSun');
        const applyThemeIcon = () => {
            const dark = document.documentElement.classList.contains('dark');
            iconMoon.style.display = dark ? 'none' : 'block';
            iconSun.style.display = dark ? 'block' : 'none';
        };
        applyThemeIcon();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeIcon();
        });
    </script>
</body>
</html>
