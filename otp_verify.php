<?php
require_once __DIR__ . '/backend/auth_helpers.php';
$purpose = $_GET['purpose'] ?? '';
$email = trim(strtolower($_GET['email'] ?? ''));
$allowedPurposes = ['password_reset', 'login_2fa'];
if (!in_array($purpose, $allowedPurposes, true) || !$email) {
    authSetFlash('error', 'Invalid verification request.');
    authRedirect('login.php');
}
$flash = authGetFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%); --panel: rgba(255,255,255,.72); --panel-strong: rgba(255,255,255,.92); --border: rgba(17,17,24,.08); --text: #111118; --muted: #626280; --accent: #6c63ff; --accent-strong: #3b82f6; }
        html.dark { --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%); --panel: rgba(14,18,36,.70); --panel-strong: rgba(11,15,29,.92); --border: rgba(255,255,255,.08); --text: #eef2ff; --muted: #a7afcf; --accent: #8b7cff; --accent-strong: #60a5fa; }
        body { margin:0; min-height:100vh; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 30px 80px rgba(27,39,94,.12); }
        .otp-input {
            width: 100%;
            padding: 18px 20px;
            border-radius: 24px;
            border: 2px solid rgba(37,99,235,.22);
            background: color-mix(in srgb, var(--panel-strong) 98%, transparent);
            color: var(--text);
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: .55em;
            outline: none;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.7);
        }
        html.dark .otp-input { border-color: rgba(96,165,250,.35); }
        .otp-input:focus { box-shadow: 0 0 0 5px rgba(37,99,235,.12); border-color: rgba(37,99,235,.5); }
        .btn { width:100%; border:0; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; background:linear-gradient(135deg, var(--accent), var(--accent-strong)); color:#fff; box-shadow:0 18px 35px rgba(108,99,255,.24); cursor:pointer; }
        .flash { border-radius:18px; padding:14px 16px; font-size:.92rem; font-weight:600; margin-top:18px; }
        .flash.error { background:rgba(239,68,68,.08); color:#dc2626; } .flash.success { background:rgba(34,197,94,.08); color:#15803d; }
        .otp-hint {
            display:grid;
            grid-template-columns:repeat(6,minmax(0,1fr));
            gap:10px;
            margin-top:16px;
        }
        .otp-box {
            height:54px;
            border-radius:16px;
            border:1px dashed var(--border);
            background: color-mix(in srgb, var(--panel-strong) 70%, transparent);
        }
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
            <p class="text-xs font-black uppercase tracking-[0.30em] text-blue-500">Verification</p>
            <h1 class="text-3xl md:text-4xl font-black mt-4">Enter your OTP</h1>
            <p class="mt-3 leading-7" style="color:var(--muted);">We sent a verification code to <?= htmlspecialchars($email) ?>. Enter all 6 digits below.</p>
            <?php if ($flash): ?>
                <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?>"><?= htmlspecialchars($flash['message']) ?></div>
            <?php endif; ?>
            <form action="backend/verify_otp.php" method="POST" class="space-y-4 mt-6">
                <input type="hidden" name="purpose" value="<?= htmlspecialchars($purpose) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <div>
                    <label class="block text-[11px] font-black uppercase tracking-[0.24em] mb-3" style="color:var(--muted);">6-Digit OTP</label>
                    <input id="otpInput" type="text" name="otp" required maxlength="6" inputmode="numeric" pattern="\d{6}" class="otp-input" placeholder="000000" autocomplete="one-time-code">
                    <div class="otp-hint" aria-hidden="true">
                        <div class="otp-box"></div>
                        <div class="otp-box"></div>
                        <div class="otp-box"></div>
                        <div class="otp-box"></div>
                        <div class="otp-box"></div>
                        <div class="otp-box"></div>
                    </div>
                </div>
                <button type="submit" class="btn">Verify OTP</button>
            </form>
            <p class="mt-8 text-center text-sm font-medium" style="color:var(--muted);">
                Need a new code?
                <?php if ($purpose === 'password_reset'): ?>
                    <a href="forgot_password.php" class="text-blue-600 font-bold hover:underline">Request again</a>
                <?php else: ?>
                    <a href="login.php" class="text-blue-600 font-bold hover:underline">Restart login</a>
                <?php endif; ?>
            </p>
        </div>
    </div>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('themeToggle');
        const otpInput = document.getElementById('otpInput');
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
        otpInput.addEventListener('input', () => {
            otpInput.value = otpInput.value.replace(/\D/g, '').slice(0, 6);
        });
    </script>
</body>
</html>
