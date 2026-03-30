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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); } html.dark body { background: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); } html.dark .panel { background: rgba(15,23,42,0.84) !important; border-color: rgba(148,163,184,0.16) !important; } html.dark .bg-slate-50 { background: rgba(15,23,42,0.92) !important; } html.dark .text-slate-900 { color: #e2e8f0 !important; } html.dark .text-slate-500, html.dark .text-slate-400 { color: #94a3b8 !important; } html.dark input { color:#e2e8f0 !important; }</style>
</head>
<body class="min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8"><a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a><button type="button" id="themeToggle" class="w-11 h-11 rounded-full bg-white border border-slate-200 font-bold">☾</button></div>
        <div class="panel max-w-xl mx-auto bg-white border border-white rounded-[2.5rem] shadow-2xl shadow-blue-100 p-8 md:p-10">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Verification</p>
            <h1 class="text-3xl font-black mt-4 text-slate-900">Enter your OTP</h1>
            <p class="text-slate-500 mt-3">We sent a code to <?= htmlspecialchars($email) ?>.</p>
            <?php if ($flash): ?><div class="mt-6 rounded-2xl px-4 py-3 text-sm font-medium <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-700' ?>"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
            <form action="backend/verify_otp.php" method="POST" class="space-y-4 mt-6">
                <input type="hidden" name="purpose" value="<?= htmlspecialchars($purpose) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">6-Digit OTP</label><input type="text" name="otp" required maxlength="6" pattern="\d{6}" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium tracking-[0.4em] text-center text-xl"></div>
                <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-blue-600 transition-all shadow-lg uppercase tracking-widest text-sm">Verify OTP</button>
            </form>
            <p class="mt-8 text-center text-sm font-medium text-slate-500">
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
        const applyThemeLabel = () => { themeToggle.textContent = document.documentElement.classList.contains('dark') ? '☀' : '☾'; };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => { document.documentElement.classList.toggle('dark'); localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light'); applyThemeLabel(); });
    </script>
</body>
</html>
