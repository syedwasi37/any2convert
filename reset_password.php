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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); } html.dark body { background: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); } html.dark .panel { background: rgba(15,23,42,0.84) !important; border-color: rgba(148,163,184,0.16) !important; } html.dark .bg-slate-50, html.dark .bg-slate-100 { background: rgba(15,23,42,0.92) !important; } html.dark .text-slate-900 { color: #e2e8f0 !important; } html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-700 { color: #94a3b8 !important; } html.dark input { color:#e2e8f0 !important; }</style>
</head>
<body class="min-h-screen">
    <div class="max-w-3xl mx-auto px-6 py-10">
        <div class="flex justify-between items-center mb-8"><a href="index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a><button type="button" id="themeToggle" class="w-11 h-11 rounded-full bg-white border border-slate-200 font-bold">☾</button></div>
        <div class="panel max-w-xl mx-auto bg-white border border-white rounded-[2.5rem] shadow-2xl shadow-blue-100 p-8 md:p-10">
            <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Password Reset</p>
            <h1 class="text-3xl font-black mt-4 text-slate-900">Choose your next step</h1>
            <p class="text-slate-500 mt-3">OTP verified for <?= htmlspecialchars($verifiedEmail) ?>. You can change your password now or continue without changing it.</p>
            <?php if ($flash): ?><div class="mt-6 rounded-2xl px-4 py-3 text-sm font-medium <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-700' ?>"><?= htmlspecialchars($flash['message']) ?></div><?php endif; ?>
            <form action="backend/update_password.php" method="POST" class="space-y-4 mt-6">
                <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">New Password</label><input type="password" name="password" required minlength="6" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                <div><label class="block text-[10px] font-black uppercase text-slate-400 mb-2 ml-2">Confirm Password</label><input type="password" name="confirm_password" required minlength="6" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium"></div>
                <button type="submit" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold hover:bg-slate-900 transition-all shadow-lg uppercase tracking-widest text-sm">Change Password</button>
            </form>
            <a href="backend/skip_password_reset.php" class="block mt-4 text-center w-full bg-slate-100 text-slate-700 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-all uppercase tracking-widest text-sm">Continue Without Changing</a>
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
