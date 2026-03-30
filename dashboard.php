<?php
require_once __DIR__ . '/backend/auth_helpers.php';
require_once __DIR__ . '/backend/ad_helpers.php';
authRequireLogin();

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    session_destroy();
    authRedirect('login.php');
}

$flash = authGetFlash();

$historyStmt = $conn->prepare("
    SELECT tool_used, page_name, visit_date
    FROM site_analytics
    WHERE user_id = ?
    ORDER BY visit_date DESC
    LIMIT 12
");
$historyStmt->execute([$user['id']]);
$history = $historyStmt->fetchAll(PDO::FETCH_ASSOC);

$statsStmt = $conn->prepare("
    SELECT COUNT(*) AS total_actions,
           COUNT(DISTINCT tool_used) AS unique_tools,
           MAX(visit_date) AS last_activity
    FROM site_analytics
    WHERE user_id = ?
");
$statsStmt->execute([$user['id']]);
$stats = $statsStmt->fetch(PDO::FETCH_ASSOC) ?: ['total_actions' => 0, 'unique_tools' => 0, 'last_activity' => null];

$feedbackStmt = $conn->prepare("
    SELECT id, subject, message, rating, reply, created_at
    FROM contact_messages
    WHERE user_id = ? OR email = ?
    ORDER BY created_at DESC
    LIMIT 8
");
$feedbackStmt->execute([$user['id'], $user['email']]);
$feedbacks = $feedbackStmt->fetchAll(PDO::FETCH_ASSOC);

$favoriteStmt = $conn->prepare("
    SELECT tool_used, COUNT(*) AS total
    FROM site_analytics
    WHERE user_id = ?
    GROUP BY tool_used
    ORDER BY total DESC, tool_used ASC
    LIMIT 1
");
$favoriteStmt->execute([$user['id']]);
$favoriteTool = $favoriteStmt->fetch(PDO::FETCH_ASSOC);

function dashboardFormatTool(string $tool): string
{
    return ucwords(str_replace('_', ' ', $tool));
}

function dashboardPublicUserId(int $id): string
{
    return 'A2C-' . str_pad((string) ($id * 73 + 10000), 7, '0', STR_PAD_LEFT);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #eef4ff;
            --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%);
            --panel-bg: rgba(255,255,255,0.88);
            --panel-soft: #f8fafc;
            --panel-border: rgba(148,163,184,0.16);
            --text-main: #0f172a;
            --text-soft: #64748b;
            --text-faint: #94a3b8;
            --nav-bg: rgba(255,255,255,0.72);
            --nav-border: rgba(148,163,184,0.14);
            --pill-bg: rgba(255,255,255,0.86);
            --pill-text: #334155;
            --hero-glow: rgba(59,130,246,0.16);
        }
        html.dark {
            --bg-main: #020617;
            --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%);
            --panel-bg: rgba(15,23,42,0.82);
            --panel-soft: rgba(15,23,42,0.92);
            --panel-border: rgba(148,163,184,0.16);
            --text-main: #e2e8f0;
            --text-soft: #94a3b8;
            --text-faint: #64748b;
            --nav-bg: rgba(2,6,23,0.7);
            --nav-border: rgba(148,163,184,0.16);
            --pill-bg: rgba(15,23,42,0.92);
            --pill-text: #cbd5e1;
            --hero-glow: rgba(96,165,250,0.2);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-accent);
            color: var(--text-main);
            transition: background .2s ease, color .2s ease;
        }
        .dashboard-shell { position: relative; }
        .dashboard-shell::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 50%;
            width: 58rem;
            height: 20rem;
            transform: translateX(-50%);
            background: radial-gradient(circle, var(--hero-glow) 0%, transparent 70%);
            filter: blur(20px);
            pointer-events: none;
            z-index: 0;
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(18px);
            background: var(--nav-bg);
            border-bottom: 1px solid var(--nav-border);
        }
        .nav-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            background: var(--pill-bg);
            color: var(--pill-text);
            border: 1px solid var(--panel-border);
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
        }
        .theme-toggle {
            width: 46px;
            height: 46px;
            border-radius: 999px;
            border: 1px solid var(--panel-border);
            background: var(--pill-bg);
            color: var(--pill-text);
            font-size: 1rem;
            font-weight: 700;
        }
        .panel {
            background: var(--panel-bg);
            backdrop-filter: blur(18px);
            border: 1px solid var(--panel-border);
            box-shadow: 0 24px 70px rgba(15,23,42,0.08);
        }
        .dash-tab {
            background: var(--pill-bg);
            color: var(--pill-text);
            border-color: var(--panel-border);
        }
        .dash-tab.active { background:#0f172a; color:#fff; border-color:#0f172a; }
        .dash-pane { display:none; }
        .dash-pane.active { display:block; }
        html.dark .dash-tab.active { background: #2563eb; border-color: #2563eb; }
        html.dark .bg-white,
        html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900,
        html.dark .text-slate-800,
        html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500,
        html.dark .text-slate-400 { color: var(--text-soft) !important; }
        html.dark .border-slate-200,
        html.dark .border-slate-300,
        html.dark .border-blue-100 { border-color: var(--panel-border) !important; }
        html.dark .bg-blue-50 { background: rgba(37,99,235,0.18) !important; }
        html.dark .text-blue-900 { color: #dbeafe !important; }
        html.dark .text-blue-600,
        html.dark .text-blue-500 { color: #93c5fd !important; }
        html.dark input,
        html.dark textarea,
        html.dark select {
            background: rgba(15,23,42,0.92);
            color: var(--text-main);
        }
    </style>
</head>
<body class="min-h-screen text-slate-900">
    <?= adsRenderPosition($conn, 'header') ?>
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="index.php" class="text-2xl font-extrabold tracking-tighter italic text-blue-600">ANY2CONVERT</a>
                <span class="hidden md:inline-flex px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-black uppercase tracking-[0.22em]">User Space</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="nav-pill">Home</a>
                <a href="contact.php" class="nav-pill">Support</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">☾</button>
                <a href="backend/logout.php" class="px-5 py-3 rounded-full bg-slate-900 text-white font-bold text-sm hover:bg-blue-600">Logout</a>
            </div>
        </div>
    </nav>
    <div class="dashboard-shell">
    <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">
            <div>
                <div class="mt-5">
                    <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">User Dashboard</p>
                    <h1 class="text-4xl font-black tracking-tight mt-2">Welcome back, <?= htmlspecialchars(explode(' ', $user['name'])[0]) ?></h1>
                    <p class="text-slate-500 mt-3 max-w-2xl">Track your recent tool activity, monitor replies to your feedback, and keep your account secure with email authentication.</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="index.php" class="px-5 py-3 rounded-2xl bg-white text-slate-800 font-bold text-sm shadow-sm border border-slate-200 hover:border-blue-300">Go Back</a>
                <a href="forgot_password.php" class="px-5 py-3 rounded-2xl bg-white text-slate-800 font-bold text-sm shadow-sm border border-slate-200 hover:border-blue-300">Reset Password</a>
                <a href="backend/logout.php" class="px-5 py-3 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-blue-600">Logout</a>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="mb-6 rounded-3xl px-5 py-4 text-sm font-semibold <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-green-50 text-green-700 border border-green-100' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
            <div class="panel rounded-[2rem] p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Public Account ID</p>
                <h2 class="text-3xl font-black mt-3"><?= htmlspecialchars(dashboardPublicUserId((int) $user['id'])) ?></h2>
                <p class="text-sm text-slate-500 mt-3"><?= htmlspecialchars($user['email']) ?></p>
            </div>
            <div class="panel rounded-[2rem] p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Tool Actions</p>
                <h2 class="text-3xl font-black mt-3"><?= (int) ($stats['total_actions'] ?? 0) ?></h2>
                <p class="text-sm text-slate-500 mt-3">Tracked visits and tool opens on your account</p>
            </div>
            <div class="panel rounded-[2rem] p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Favorite Tool</p>
                <h2 class="text-2xl font-black mt-3"><?= $favoriteTool ? htmlspecialchars(dashboardFormatTool($favoriteTool['tool_used'])) : 'No history yet' ?></h2>
                <p class="text-sm text-slate-500 mt-3"><?= $favoriteTool ? (int) $favoriteTool['total'] . ' visits' : 'Start using tools to build history' ?></p>
            </div>
            <div class="panel rounded-[2rem] p-6">
                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Email Auth</p>
                <h2 class="text-3xl font-black mt-3"><?= !empty($user['email_auth_enabled']) ? 'On' : 'Off' ?></h2>
                <p class="text-sm text-slate-500 mt-3"><?= !empty($user['email_auth_enabled']) ? 'Login OTP is active' : 'Extra protection is currently disabled' ?></p>
            </div>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            <button type="button" class="dash-tab active px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="overview">Overview</button>
            <button type="button" class="dash-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="history">History</button>
            <button type="button" class="dash-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="feedback">Feedback</button>
            <button type="button" class="dash-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="security">Security</button>
        </div>

        <div id="overview" class="dash-pane active">
            <div class="grid grid-cols-1 xl:grid-cols-[1.35fr_0.95fr] gap-6">
                <div class="space-y-6">
                    <section class="panel rounded-[2rem] p-7">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div>
                                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Conversion History</p>
                                <h2 class="text-2xl font-black mt-2">Recent tool activity</h2>
                            </div>
                            <span class="px-3 py-2 rounded-2xl bg-blue-50 text-blue-600 text-xs font-black uppercase tracking-[0.2em]"><?= count($history) ?> items</span>
                        </div>

                        <?php if (!$history): ?>
                            <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No tool history yet. Start using Any2Convert tools and your activity will appear here.</div>
                        <?php else: ?>
                            <div class="space-y-4">
                                <?php foreach (array_slice($history, 0, 5) as $item): ?>
                                    <div class="rounded-[1.75rem] bg-slate-50 px-5 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                        <div>
                                            <p class="text-lg font-black text-slate-900"><?= htmlspecialchars(dashboardFormatTool($item['tool_used'])) ?></p>
                                            <p class="text-sm text-slate-500"><?= htmlspecialchars($item['page_name']) ?></p>
                                        </div>
                                        <div class="text-sm font-semibold text-slate-500"><?= htmlspecialchars(date('d M Y, h:i A', strtotime($item['visit_date']))) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>

                    <section class="panel rounded-[2rem] p-7">
                        <div class="mb-6">
                            <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Feedback History</p>
                            <h2 class="text-2xl font-black mt-2">Latest conversation with admin</h2>
                        </div>

                        <?php if (!$feedbacks): ?>
                            <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No feedback posted yet.</div>
                        <?php else: ?>
                            <?php $feedback = $feedbacks[0]; ?>
                            <article class="rounded-[1.8rem] bg-slate-50 p-5">
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                    <div>
                                        <h3 class="text-lg font-black text-slate-900"><?= htmlspecialchars($feedback['subject']) ?></h3>
                                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400"><?= htmlspecialchars(date('d M Y', strtotime($feedback['created_at']))) ?></p>
                                    </div>
                                    <div class="text-yellow-500 text-sm">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?= $i <= (int) $feedback['rating'] ? '★' : '☆' ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="text-slate-600 leading-7"><?= nl2br(htmlspecialchars($feedback['message'])) ?></p>
                                <?php if (!empty($feedback['reply'])): ?>
                                    <div class="mt-4 rounded-[1.5rem] bg-blue-50 border border-blue-100 px-4 py-4">
                                        <p class="text-[11px] font-black uppercase tracking-[0.2em] text-blue-500 mb-1">Admin Reply</p>
                                        <p class="text-blue-900 font-medium"><?= nl2br(htmlspecialchars($feedback['reply'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </article>
                        <?php endif; ?>
                    </section>
                </div>

                <aside class="space-y-6">
                    <section class="panel rounded-[2rem] p-7">
                        <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Quick Summary</p>
                        <div class="mt-5 space-y-4">
                            <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Unique Tools Used</p>
                                <p class="text-2xl font-black mt-2"><?= (int) ($stats['unique_tools'] ?? 0) ?></p>
                            </div>
                            <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Last Activity</p>
                                <p class="text-lg font-black mt-2"><?= !empty($stats['last_activity']) ? htmlspecialchars(date('d M Y, h:i A', strtotime($stats['last_activity']))) : 'No activity yet' ?></p>
                            </div>
                            <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Password Help</p>
                                <a href="forgot_password.php" class="inline-flex mt-2 text-blue-600 font-black">Reset by Email OTP</a>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>
        </div>

        <div id="history" class="dash-pane">
            <section class="panel rounded-[2rem] p-7">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Conversion History</p>
                            <h2 class="text-2xl font-black mt-2">Recent tool activity</h2>
                        </div>
                        <span class="px-3 py-2 rounded-2xl bg-blue-50 text-blue-600 text-xs font-black uppercase tracking-[0.2em]"><?= count($history) ?> items</span>
                    </div>

                    <?php if (!$history): ?>
                        <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No tool history yet. Start using Any2Convert tools and your activity will appear here.</div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach ($history as $item): ?>
                                <div class="rounded-[1.75rem] bg-slate-50 px-5 py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                    <div>
                                        <p class="text-lg font-black text-slate-900"><?= htmlspecialchars(dashboardFormatTool($item['tool_used'])) ?></p>
                                        <p class="text-sm text-slate-500"><?= htmlspecialchars($item['page_name']) ?></p>
                                    </div>
                                    <div class="text-sm font-semibold text-slate-500"><?= htmlspecialchars(date('d M Y, h:i A', strtotime($item['visit_date']))) ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
            </section>
        </div>

        <div id="feedback" class="dash-pane">
            <section class="panel rounded-[2rem] p-7">
                    <div class="mb-6">
                        <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Feedback History</p>
                        <h2 class="text-2xl font-black mt-2">Your comments and admin replies</h2>
                    </div>

                    <?php if (!$feedbacks): ?>
                        <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No feedback posted yet.</div>
                    <?php else: ?>
                        <div class="space-y-5">
                            <?php foreach ($feedbacks as $feedback): ?>
                                <article class="rounded-[1.8rem] bg-slate-50 p-5">
                                    <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                        <div>
                                            <h3 class="text-lg font-black text-slate-900"><?= htmlspecialchars($feedback['subject']) ?></h3>
                                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400"><?= htmlspecialchars(date('d M Y', strtotime($feedback['created_at']))) ?></p>
                                        </div>
                                        <div class="text-yellow-500 text-sm">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <?= $i <= (int) $feedback['rating'] ? '★' : '☆' ?>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <p class="text-slate-600 leading-7"><?= nl2br(htmlspecialchars($feedback['message'])) ?></p>
                                    <?php if (!empty($feedback['reply'])): ?>
                                        <div class="mt-4 rounded-[1.5rem] bg-blue-50 border border-blue-100 px-4 py-4">
                                            <p class="text-[11px] font-black uppercase tracking-[0.2em] text-blue-500 mb-1">Admin Reply</p>
                                            <p class="text-blue-900 font-medium"><?= nl2br(htmlspecialchars($feedback['reply'])) ?></p>
                                        </div>
                                    <?php endif; ?>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
            </section>
        </div>

        <div id="security" class="dash-pane">
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_0.9fr] gap-6">
                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Security</p>
                    <h2 class="text-2xl font-black mt-2">Account protection</h2>
                    <p class="text-slate-500 mt-3">Turn on email authentication if you want every login to require a one-time OTP from your inbox.</p>

                    <form action="backend/update_security_settings.php" method="POST" class="mt-6 space-y-4">
                        <label class="flex items-start gap-3 p-4 rounded-[1.5rem] bg-slate-50">
                            <input type="checkbox" name="email_auth_enabled" value="1" class="mt-1 h-5 w-5" <?= !empty($user['email_auth_enabled']) ? 'checked' : '' ?>>
                            <span>
                                <span class="block font-bold text-slate-800">Require OTP on every login</span>
                                <span class="block text-sm text-slate-500 mt-1">Adds an extra verification step for better account safety.</span>
                            </span>
                        </label>
                        <button type="submit" class="w-full rounded-2xl bg-blue-600 text-white py-4 font-black uppercase tracking-[0.18em] text-sm hover:bg-slate-900">Save Security Settings</button>
                    </form>
                </section>

                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Quick Summary</p>
                    <div class="mt-5 space-y-4">
                        <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Unique Tools Used</p>
                            <p class="text-2xl font-black mt-2"><?= (int) ($stats['unique_tools'] ?? 0) ?></p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Last Activity</p>
                            <p class="text-lg font-black mt-2"><?= !empty($stats['last_activity']) ? htmlspecialchars(date('d M Y, h:i A', strtotime($stats['last_activity']))) : 'No activity yet' ?></p>
                        </div>
                        <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-slate-400">Password Help</p>
                            <a href="forgot_password.php" class="inline-flex mt-2 text-blue-600 font-black">Reset by Email OTP</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        const themeToggle = document.getElementById('themeToggle');
        const applyThemeLabel = () => {
            themeToggle.textContent = document.documentElement.classList.contains('dark') ? '☀' : '☾';
        };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeLabel();
        });

        function activateDashTab(tabName) {
            const safeTab = document.getElementById(tabName) ? tabName : 'overview';
            document.querySelectorAll('.dash-tab').forEach(el => el.classList.toggle('active', el.dataset.tab === safeTab));
            document.querySelectorAll('.dash-pane').forEach(el => el.classList.toggle('active', el.id === safeTab));
            if (window.location.hash !== '#' + safeTab) {
                history.replaceState(null, '', '#' + safeTab);
            }
        }

        document.querySelectorAll('.dash-tab').forEach(btn => {
            btn.addEventListener('click', () => activateDashTab(btn.dataset.tab));
        });

        activateDashTab(window.location.hash ? window.location.hash.substring(1) : 'overview');
    </script>
</body>
</html>
