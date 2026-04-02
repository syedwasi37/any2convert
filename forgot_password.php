<?php
require_once __DIR__ . '/backend/auth_helpers.php';
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
        :root { --bg-accent: radial-gradient(circle at top left, rgba(14,165,233,.18), transparent 28%), radial-gradient(circle at bottom right, rgba(99,102,241,.16), transparent 26%), linear-gradient(180deg, #f7fbff 0%, #eef5ff 100%); --panel: rgba(255,255,255,.88); --border: rgba(148,163,184,.18); --text: #0f172a; --muted: #64748b; --accent: #2563eb; }
        html.dark { --bg-accent: radial-gradient(circle at top left, rgba(37,99,235,.28), transparent 28%), radial-gradient(circle at bottom right, rgba(14,165,233,.18), transparent 24%), linear-gradient(180deg, #081121 0%, #020617 100%); --panel: rgba(7,18,36,.8); --border: rgba(148,163,184,.18); --text: #e2e8f0; --muted: #94a3b8; --accent: #60a5fa; }
        body { margin:0; min-height:100vh; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 28px 80px rgba(15,23,42,.10); }
        .input { width:100%; padding:16px 18px; border-radius:18px; border:1px solid var(--border); background:rgba(255,255,255,.92); color:var(--text); outline:none; font-size:1rem; font-weight:600; }
        html.dark .input { background:rgba(15,23,42,.92); }
        .input:focus { box-shadow:0 0 0 4px rgba(37,99,235,.12); border-color:rgba(37,99,235,.45); }
        .btn { width:100%; border:0; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; background:linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; box-shadow:0 18px 35px rgba(37,99,235,.24); cursor:pointer; }
        .flash { border-radius:18px; padding:14px 16px; font-size:.92rem; font-weight:600; margin-top:18px; }
        .flash.error { background:rgba(239,68,68,.08); color:#dc2626; } .flash.success { background:rgba(34,197,94,.08); color:#15803d; }
    </style>
</head>
<body>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <button type="button" id="themeToggle" class="w-11 h-11 rounded-full bg-white border border-slate-200 font-bold">Theme</button>
        </div>
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
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('themeToggle');
        const applyThemeLabel = () => { themeToggle.textContent = document.documentElement.classList.contains('dark') ? 'Light' : 'Dark'; };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeLabel();
        });
    </script>
</body>
</html>
