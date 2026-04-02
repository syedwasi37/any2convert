<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/backend/ad_helpers.php';
require_once __DIR__ . '/partials/site_chrome.php';

$flash = authGetFlash();
$client_id = envValue('GOOGLE_CLIENT_ID', '1035171361659-scrunl9467itq9ifg5ae11sij9ljjiu3.apps.googleusercontent.com');
$redirect_uri = envValue('GOOGLE_REDIRECT_URI', 'https://any2convert.com/backend/google_login.php');
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%);
            --panel: rgba(255,255,255,0.68);
            --panel-strong: rgba(255,255,255,0.86);
            --border: rgba(17,17,24,0.08);
            --text: #111118;
            --muted: #626280;
            --soft: rgba(241,244,255,0.82);
            --accent: #6c63ff;
            --accent-strong: #3b82f6;
        }
        html.dark {
            --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%);
            --panel: rgba(14,18,36,0.66);
            --panel-strong: rgba(11,15,29,0.86);
            --border: rgba(255,255,255,0.08);
            --text: #eef2ff;
            --muted: #a7afcf;
            --soft: rgba(18,24,44,0.92);
            --accent: #8b7cff;
            --accent-strong: #60a5fa;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-accent);
            color: var(--text);
            min-height: 100vh;
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(18px);
            background: color-mix(in srgb, var(--panel-strong) 84%, transparent);
            border-bottom: 1px solid var(--border);
        }
        .panel {
            background: var(--panel);
            border: 1px solid var(--border);
            backdrop-filter: blur(24px);
            box-shadow: 0 30px 80px rgba(27,39,94,0.12);
        }
        .pill, .theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--panel-strong) 92%, transparent);
            color: var(--text);
            text-decoration: none;
            font-weight: 700;
        }
        .pill { padding: 10px 16px; font-size: .9rem; }
        .theme-toggle { width: 46px; height: 46px; }
        .theme-toggle svg { width: 18px; height: 18px; }
        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--accent);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 12px 24px rgba(108,99,255,.24);
        }
        .brand-text {
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            color: var(--text);
        }
        .brand-dot { color: var(--accent); }
        .hero-card {
            position: relative;
            overflow: hidden;
        }
        .hero-card::before {
            content: '';
            position: absolute;
            inset: auto -10% -30% auto;
            width: 18rem;
            height: 18rem;
            background: radial-gradient(circle, rgba(37,99,235,.18) 0%, transparent 70%);
            pointer-events: none;
        }
        .label {
            font-size: .7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .24em;
            color: var(--muted);
            margin-bottom: 10px;
            display: block;
        }
        .input {
            width: 100%;
            padding: 16px 18px;
            border-radius: 18px;
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--panel-strong) 96%, transparent);
            color: var(--text);
            font-size: 1rem;
            font-weight: 600;
            outline: none;
            transition: border-color .18s ease, box-shadow .18s ease, transform .18s ease;
        }
        .input:focus {
            border-color: color-mix(in srgb, var(--accent) 55%, white);
            box-shadow: 0 0 0 4px rgba(37,99,235,.12);
            transform: translateY(-1px);
        }
        .primary-btn, .secondary-btn {
            width: 100%;
            border: 0;
            border-radius: 18px;
            padding: 15px 18px;
            font-size: .88rem;
            font-weight: 800;
            letter-spacing: .16em;
            text-transform: uppercase;
            transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
            cursor: pointer;
        }
        .primary-btn {
            background: linear-gradient(135deg, var(--accent-strong), var(--accent));
            color: white;
            box-shadow: 0 18px 35px rgba(37,99,235,.24);
        }
        .primary-btn:hover, .secondary-btn:hover { transform: translateY(-1px); }
        .secondary-btn {
            background: color-mix(in srgb, var(--panel-strong) 96%, transparent);
            color: var(--text);
            border: 1px solid var(--border);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        .flash {
            border-radius: 18px;
            padding: 14px 16px;
            font-size: .92rem;
            font-weight: 600;
            border: 1px solid transparent;
        }
        .flash.error { background: rgba(239,68,68,.08); color: #dc2626; border-color: rgba(239,68,68,.14); }
        .flash.success { background: rgba(34,197,94,.08); color: #15803d; border-color: rgba(34,197,94,.14); }
        html.dark .flash.error { color: #fca5a5; }
        html.dark .flash.success { color: #86efac; }
        .divider {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--muted);
            font-size: .72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .24em;
        }
        .divider::before, .divider::after {
            content: '';
            height: 1px;
            flex: 1;
            background: var(--border);
        }
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body>
    <?= adsRenderPosition($conn, 'header') ?>
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => 'index.php', 'label' => 'Home'],
            ['href' => 'signup.php', 'label' => 'Create Account'],
        ],
    ]); ?>

    <main class="max-w-6xl mx-auto px-6 py-10 md:py-14">
        <div class="grid grid-cols-1 xl:grid-cols-[1.06fr_0.94fr] gap-8 items-stretch">
            <section class="panel hero-card rounded-[2.4rem] p-8 md:p-10 flex flex-col justify-between">
                <div>
                    <p class="text-xs font-black uppercase tracking-[0.30em] text-blue-500">Account Access</p>
                    <h1 class="text-4xl md:text-5xl font-black tracking-tight mt-4">Welcome back to your workspace</h1>
                    <p class="mt-4 text-base leading-8" style="color:var(--muted);">Sign in to view your dashboard, manage account security, and continue from the tools you already use most.</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-8">
                    <div class="rounded-[1.6rem] p-5" style="background:var(--soft);">
                        <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--muted);">Private</p>
                        <p class="font-black mt-2">Browser-first workflow</p>
                    </div>
                    <div class="rounded-[1.6rem] p-5" style="background:var(--soft);">
                        <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--muted);">Fast</p>
                        <p class="font-black mt-2">One place for all tools</p>
                    </div>
                    <div class="rounded-[1.6rem] p-5" style="background:var(--soft);">
                        <p class="text-xs font-black uppercase tracking-[0.18em]" style="color:var(--muted);">Safe</p>
                        <p class="font-black mt-2">Optional OTP login</p>
                    </div>
                </div>
            </section>

            <section class="panel rounded-[2.4rem] p-8 md:p-10">
                <div class="mb-8">
                    <p class="text-xs font-black uppercase tracking-[0.28em] text-blue-500">Login</p>
                    <h2 class="text-3xl font-black mt-3">Sign in to Any2Convert</h2>
                    <p class="mt-2" style="color:var(--muted);">Use your account credentials to continue.</p>
                </div>

                <?php if ($flash): ?>
                    <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?> mb-5">
                        <?= htmlspecialchars($flash['message']) ?>
                    </div>
                <?php endif; ?>

                <form action="backend/login_logic.php" method="POST" class="space-y-4">
                    <div>
                        <label class="label">Email Address</label>
                        <input type="email" name="email" required class="input" autocomplete="email">
                    </div>
                    <div>
                        <label class="label">Password</label>
                        <input type="password" name="password" required class="input" autocomplete="current-password">
                    </div>
                    <div class="flex items-center justify-between gap-4 flex-wrap text-sm">
                        <span style="color:var(--muted);">Forgot your password?</span>
                        <a href="forgot_password.php" class="font-bold text-blue-600 hover:underline">Reset with OTP</a>
                    </div>
                    <button type="submit" class="primary-btn">Login Now</button>
                </form>

                <div class="divider my-6">or</div>

                <a href="<?= htmlspecialchars($google_url) ?>" class="secondary-btn">
                    <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" class="w-5 h-5" alt="Google">
                    <span>Continue with Google</span>
                </a>

                <p class="mt-8 text-center text-sm font-medium" style="color:var(--muted);">
                    New here?
                    <a href="signup.php" class="text-blue-600 font-bold hover:underline">Create Account</a>
                </p>
            </section>
        </div>
    </main>

    <?php any2convertRenderFooter(); ?>
    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
