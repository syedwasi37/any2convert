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
        :root { --bg-accent: radial-gradient(circle at top left, rgba(14,165,233,.18), transparent 28%), radial-gradient(circle at bottom right, rgba(99,102,241,.16), transparent 26%), linear-gradient(180deg, #f7fbff 0%, #eef5ff 100%); --panel: rgba(255,255,255,.9); --border: rgba(148,163,184,.18); --text: #0f172a; --muted: #64748b; }
        html.dark { --bg-accent: radial-gradient(circle at top left, rgba(37,99,235,.28), transparent 28%), radial-gradient(circle at bottom right, rgba(14,165,233,.18), transparent 24%), linear-gradient(180deg, #081121 0%, #020617 100%); --panel: rgba(7,18,36,.84); --border: rgba(148,163,184,.18); --text: #e2e8f0; --muted: #94a3b8; }
        body { margin:0; min-height:100vh; font-family:'Plus Jakarta Sans', sans-serif; background:var(--bg-accent); color:var(--text); }
        .panel { background:var(--panel); border:1px solid var(--border); backdrop-filter:blur(24px); box-shadow:0 28px 80px rgba(15,23,42,.10); }
        .otp-input {
            width: 100%;
            padding: 18px 20px;
            border-radius: 24px;
            border: 2px solid rgba(37,99,235,.22);
            background: rgba(255,255,255,.96);
            color: #0f172a;
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: .55em;
            outline: none;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,.7);
        }
        html.dark .otp-input { background: rgba(15,23,42,.95); color:#f8fafc; border-color: rgba(96,165,250,.35); }
        .otp-input:focus { box-shadow: 0 0 0 5px rgba(37,99,235,.12); border-color: rgba(37,99,235,.5); }
        .btn { width:100%; border:0; border-radius:18px; padding:15px 18px; font-size:.88rem; font-weight:800; letter-spacing:.16em; text-transform:uppercase; background:linear-gradient(135deg, #2563eb, #1d4ed8); color:#fff; box-shadow:0 18px 35px rgba(37,99,235,.24); cursor:pointer; }
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
            background: rgba(255,255,255,.55);
        }
        html.dark .otp-box { background: rgba(15,23,42,.72); }
    </style>
</head>
<body>
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8">
            <a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <button type="button" id="themeToggle" class="w-11 h-11 rounded-full bg-white border border-slate-200 font-bold">Theme</button>
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
        const applyThemeLabel = () => { themeToggle.textContent = document.documentElement.classList.contains('dark') ? 'Light' : 'Dark'; };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeLabel();
        });
        otpInput.addEventListener('input', () => {
            otpInput.value = otpInput.value.replace(/\D/g, '').slice(0, 6);
        });
    </script>
</body>
</html>
