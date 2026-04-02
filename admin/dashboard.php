<?php
session_start();
require_once __DIR__ . '/../backend/db.php';
require_once __DIR__ . '/../backend/auth_bootstrap.php';
require_once __DIR__ . '/../backend/ad_helpers.php';

try {
    any2convertBootstrapAuthSchema($conn);
} catch (Throwable $e) {
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (($_SESSION['email'] ?? '') !== 'syedwasiulhassanshah@any2convert.com') {
    die("<div style='text-align:center; padding:50px; font-family:sans-serif;'><h1 style='color:red;'>Access Denied</h1><p>Only the admin can access this dashboard.</p><a href='../index.php'>Return home</a></div>");
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$search = trim($_GET['user_query'] ?? '');
$filterBlocked = $_GET['status'] ?? 'all';

$users = [];
$messages = [];
$userCount = 0;
$blockedCount = 0;
$totalVisits = 0;
$todayVisits = 0;
$topTools = [];
$topUsers = [];
$userToolBreakdown = [];
$ads = [];
$legacyAds = [];

try {
    $userSql = "SELECT id, name, email, is_premium, email_auth_enabled, blocked_until FROM users WHERE 1=1";
    $userParams = [];
    if ($search !== '') {
        if (ctype_digit($search)) {
            $userSql .= " AND (id = ? OR name LIKE ? OR email LIKE ?)";
            $userParams[] = (int) $search;
        } else {
            $userSql .= " AND (name LIKE ? OR email LIKE ?)";
        }
        $likeSearch = '%' . $search . '%';
        $userParams[] = $likeSearch;
        $userParams[] = $likeSearch;
    }
    if ($filterBlocked === 'blocked') {
        $userSql .= " AND blocked_until IS NOT NULL AND blocked_until > NOW()";
    } elseif ($filterBlocked === 'active') {
        $userSql .= " AND (blocked_until IS NULL OR blocked_until <= NOW())";
    }
    $userSql .= " ORDER BY id DESC LIMIT 100";
    $userStmt = $conn->prepare($userSql);
    $userStmt->execute($userParams);
    $users = $userStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    try {
        $fallbackStmt = $conn->prepare("SELECT id, name, email, is_premium FROM users ORDER BY id DESC LIMIT 100");
        $fallbackStmt->execute();
        $users = array_map(function ($row) {
            $row['email_auth_enabled'] = 0;
            $row['blocked_until'] = null;
            return $row;
        }, $fallbackStmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (Throwable $inner) {
        $users = [];
    }
}

try {
    $messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 50")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $messages = [];
}
try {
    $userCount = (int) $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
} catch (Throwable $e) {
    $userCount = 0;
}
try {
    $blockedCount = (int) $conn->query("SELECT COUNT(*) FROM users WHERE blocked_until IS NOT NULL AND blocked_until > NOW()")->fetchColumn();
} catch (Throwable $e) {
    $blockedCount = 0;
}
try {
    $totalVisits = (int) $conn->query("SELECT COUNT(*) FROM site_analytics")->fetchColumn();
} catch (Throwable $e) {
    $totalVisits = 0;
}
try {
    $todayVisits = (int) $conn->query("SELECT COUNT(*) FROM site_analytics WHERE DATE(visit_date) = CURDATE()")->fetchColumn();
} catch (Throwable $e) {
    $todayVisits = 0;
}
try {
    $topTools = $conn->query("
        SELECT tool_used, COUNT(*) AS total
        FROM site_analytics
        GROUP BY tool_used
        ORDER BY total DESC, tool_used ASC
        LIMIT 8
    ")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $topTools = [];
}
try {
    $topUsers = $conn->query("
        SELECT COALESCE(u.name, sa.user_email, 'Guest') AS label,
               COALESCE(u.email, sa.user_email, 'Guest') AS email,
               COUNT(*) AS total_actions
        FROM site_analytics sa
        LEFT JOIN users u ON u.id = sa.user_id
        GROUP BY sa.user_id, sa.user_email, u.name, u.email
        ORDER BY total_actions DESC
        LIMIT 8
    ")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $topUsers = [];
}
try {
    $userToolBreakdown = $conn->query("
        SELECT COALESCE(u.name, sa.user_email, 'Guest') AS user_label,
               COALESCE(u.email, sa.user_email, 'Guest') AS user_email,
               sa.tool_used,
               COUNT(*) AS total
        FROM site_analytics sa
        LEFT JOIN users u ON u.id = sa.user_id
        GROUP BY sa.user_id, sa.user_email, u.name, u.email, sa.tool_used
        ORDER BY total DESC
        LIMIT 12
    ")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $userToolBreakdown = [];
}
try {
    $ads = $conn->query("SELECT * FROM site_ads ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (Throwable $e) {
    $ads = [];
}
$legacyAds = adsLegacyDefinitions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-accent: radial-gradient(circle at top, #e0e7ff 0%, #f8fafc 35%, #eff6ff 100%);
            --panel-bg: rgba(255,255,255,0.92);
            --panel-soft: #f8fafc;
            --panel-border: rgba(148,163,184,0.14);
            --text-main: #0f172a;
            --text-soft: #64748b;
            --nav-bg: rgba(255,255,255,0.74);
            --nav-border: rgba(148,163,184,0.14);
            --pill-bg: rgba(255,255,255,0.86);
            --pill-text: #334155;
            --glow: rgba(59,130,246,0.12);
        }
        html.dark {
            --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%);
            --panel-bg: rgba(15,23,42,0.82);
            --panel-soft: rgba(15,23,42,0.92);
            --panel-border: rgba(148,163,184,0.16);
            --text-main: #e2e8f0;
            --text-soft: #94a3b8;
            --nav-bg: rgba(2,6,23,0.76);
            --nav-border: rgba(148,163,184,0.16);
            --pill-bg: rgba(15,23,42,0.92);
            --pill-text: #cbd5e1;
            --glow: rgba(96,165,250,0.18);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-accent);
            color: var(--text-main);
        }
        .dashboard-shell { position: relative; }
        .dashboard-shell::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 50%;
            width: 62rem;
            height: 22rem;
            transform: translateX(-50%);
            background: radial-gradient(circle, var(--glow) 0%, transparent 70%);
            filter: blur(24px);
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
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 14px 18px;
            border-radius: 18px;
            font-weight: 800;
            font-size: 0.86rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            text-decoration: none;
            border: 1px solid var(--panel-border);
            background: rgba(255,255,255,0.92);
            color: var(--text-main);
        }
        .action-btn.primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            border-color: transparent;
            box-shadow: 0 18px 35px rgba(37,99,235,0.22);
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
            backdrop-filter: blur(16px);
            border: 1px solid var(--panel-border);
            box-shadow: 0 24px 70px rgba(15,23,42,0.08);
        }
        .admin-tab { background: var(--pill-bg); color: var(--pill-text); border-color: var(--panel-border); }
        .admin-tab.active { background:#0f172a; color:#fff; border-color:#0f172a; }
        .admin-pane { display:none; }
        .admin-pane.active { display:block; }
        html.dark .admin-tab.active { background:#2563eb; border-color:#2563eb; }
        html.dark .bg-white,
        html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900,
        html.dark .text-slate-800,
        html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500,
        html.dark .text-slate-400,
        html.dark .text-slate-600 { color: var(--text-soft) !important; }
        html.dark .border-slate-200,
        html.dark .border-slate-300,
        html.dark .border-blue-100,
        html.dark .border-green-100,
        html.dark .border-red-100 { border-color: var(--panel-border) !important; }
        html.dark .bg-blue-50 { background: rgba(37,99,235,0.16) !important; }
        html.dark .bg-green-50 { background: rgba(16,185,129,0.14) !important; }
        html.dark .bg-red-50 { background: rgba(239,68,68,0.14) !important; }
        html.dark input,
        html.dark textarea,
        html.dark select { background: rgba(15,23,42,0.92); color: var(--text-main); }
    </style>
</head>
<body class="min-h-screen text-slate-900">
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="../index.php" class="text-2xl font-extrabold tracking-tighter italic text-blue-600">ANY2CONVERT</a>
                <span class="hidden md:inline-flex px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-black uppercase tracking-[0.22em]">Admin Console</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="../index.php" class="nav-pill">Home</a>
                <a href="#reports" class="nav-pill" onclick="activateAdminTab('reports');return false;">Reports</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme">☾</button>
                <a href="../backend/logout.php" class="px-5 py-3 rounded-full bg-slate-900 text-white font-bold text-sm hover:bg-blue-600">Logout</a>
            </div>
        </div>
    </nav>
    <div class="dashboard-shell">
    <div class="max-w-7xl mx-auto px-6 py-8 relative z-10">
        <div class="flex flex-col xl:flex-row xl:items-center xl:justify-between gap-6 mb-8">
            <div>
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500 mt-5">Admin Console</p>
                <h1 class="text-4xl font-black tracking-tight mt-2">Operations and user management</h1>
                <p class="text-slate-500 mt-3 max-w-3xl">Monitor users, review feedback, block or remove accounts, and generate usage reports from real tool activity.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="button" class="action-btn primary" onclick="activateAdminTab('users')">Manage Users</button>
                <button type="button" class="action-btn" onclick="activateAdminTab('feedback')">Open Feedback</button>
                <a href="export_report.php" class="action-btn">Export CSV</a>
            </div>
        </div>

        <?php if ($flash): ?>
            <div class="mb-6 rounded-3xl px-5 py-4 text-sm font-semibold <?= $flash['type'] === 'error' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-green-50 text-green-700 border border-green-100' ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
            <div class="panel rounded-[2rem] p-6"><p class="text-[11px] font-black uppercase tracking-[0.22em] text-slate-400">Total Visits</p><h2 class="text-4xl font-black mt-3"><?= $totalVisits ?></h2><p class="text-sm text-slate-500 mt-2">+<?= $todayVisits ?> today</p></div>
            <div class="panel rounded-[2rem] p-6"><p class="text-[11px] font-black uppercase tracking-[0.22em] text-slate-400">Users</p><h2 class="text-4xl font-black mt-3"><?= $userCount ?></h2><p class="text-sm text-slate-500 mt-2">Registered accounts</p></div>
            <div class="panel rounded-[2rem] p-6"><p class="text-[11px] font-black uppercase tracking-[0.22em] text-slate-400">Blocked</p><h2 class="text-4xl font-black mt-3"><?= $blockedCount ?></h2><p class="text-sm text-slate-500 mt-2">Temporarily restricted users</p></div>
            <div class="panel rounded-[2rem] p-6"><p class="text-[11px] font-black uppercase tracking-[0.22em] text-slate-400">Feedback</p><h2 class="text-4xl font-black mt-3"><?= count($messages) ?></h2><p class="text-sm text-slate-500 mt-2">Latest moderation queue</p></div>
        </div>

        <div class="flex flex-wrap gap-3 mb-6">
            <button type="button" class="admin-tab active px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="users">Users</button>
            <button type="button" class="admin-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="feedback">Feedback</button>
            <button type="button" class="admin-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="reports">Reports</button>
            <button type="button" class="admin-tab px-5 py-3 rounded-2xl bg-white border border-slate-200 text-sm font-black uppercase tracking-[0.15em]" data-tab="ads">Ads</button>
        </div>

        <div id="users" class="admin-pane active">
            <section class="panel rounded-[2rem] p-7">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">User Management</p>
                            <h2 class="text-2xl font-black mt-2">Search, block, unblock, or remove users</h2>
                        </div>
                        <form method="GET" class="flex flex-col sm:flex-row gap-3">
                            <input type="text" name="user_query" value="<?= htmlspecialchars($search) ?>" placeholder="Search by ID, name, or email" class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50 min-w-[240px]">
                            <select name="status" class="px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                                <option value="all" <?= $filterBlocked === 'all' ? 'selected' : '' ?>>All users</option>
                                <option value="active" <?= $filterBlocked === 'active' ? 'selected' : '' ?>>Active only</option>
                                <option value="blocked" <?= $filterBlocked === 'blocked' ? 'selected' : '' ?>>Blocked only</option>
                            </select>
                            <button type="submit" class="px-5 py-3 rounded-2xl bg-blue-600 text-white font-bold text-sm">Search</button>
                        </form>
                    </div>

                    <div class="space-y-4">
                        <?php foreach ($users as $managedUser): ?>
                            <?php $isBlocked = !empty($managedUser['blocked_until']) && strtotime($managedUser['blocked_until']) > time(); ?>
                            <article class="rounded-[1.8rem] bg-slate-50 p-5">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2">
                                            <span class="px-3 py-1 rounded-full bg-white text-slate-500 text-xs font-black uppercase tracking-[0.2em]">ID <?= (int) $managedUser['id'] ?></span>
                                            <span class="px-3 py-1 rounded-full <?= $isBlocked ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-700' ?> text-xs font-black uppercase tracking-[0.2em]"><?= $isBlocked ? 'Blocked' : 'Active' ?></span>
                                            <span class="px-3 py-1 rounded-full <?= !empty($managedUser['email_auth_enabled']) ? 'bg-blue-100 text-blue-700' : 'bg-slate-200 text-slate-600' ?> text-xs font-black uppercase tracking-[0.2em]"><?= !empty($managedUser['email_auth_enabled']) ? 'OTP On' : 'OTP Off' ?></span>
                                        </div>
                                        <h3 class="text-xl font-black text-slate-900 mt-3"><?= htmlspecialchars($managedUser['name']) ?></h3>
                                        <p class="text-slate-500"><?= htmlspecialchars($managedUser['email']) ?></p>
                                        <?php if ($isBlocked): ?>
                                            <p class="text-sm font-semibold text-red-500 mt-2">Blocked until <?= htmlspecialchars(date('d M Y, h:i A', strtotime($managedUser['blocked_until']))) ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex flex-wrap gap-3">
                                        <?php if ($managedUser['email'] !== 'syedwasiulhassanshah@any2convert.com'): ?>
                                            <form action="manage_user.php" method="POST" class="flex gap-2 items-center">
                                                <input type="hidden" name="user_id" value="<?= (int) $managedUser['id'] ?>">
                                                <?php if ($isBlocked): ?>
                                                    <input type="hidden" name="action" value="unblock">
                                                    <button type="submit" class="px-4 py-3 rounded-2xl bg-emerald-600 text-white text-sm font-bold">Unblock</button>
                                                <?php else: ?>
                                                    <input type="hidden" name="action" value="block">
                                                    <input type="number" name="block_days" min="1" max="365" value="7" class="w-20 px-3 py-3 rounded-2xl border border-slate-200 bg-white text-sm">
                                                    <button type="submit" class="px-4 py-3 rounded-2xl bg-amber-500 text-white text-sm font-bold">Block</button>
                                                <?php endif; ?>
                                            </form>
                                            <form action="manage_user.php" method="POST" onsubmit="return confirm('Delete this user account permanently?');">
                                                <input type="hidden" name="user_id" value="<?= (int) $managedUser['id'] ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="px-4 py-3 rounded-2xl bg-red-500 text-white text-sm font-bold">Delete</button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>

                        <?php if (!$users): ?>
                            <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No users found for the current filter.</div>
                        <?php endif; ?>
                    </div>
            </section>
        </div>

        <div id="feedback" class="admin-pane">
            <section class="panel rounded-[2rem] p-7">
                    <div class="mb-6">
                        <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Feedback Moderation</p>
                        <h2 class="text-2xl font-black mt-2">Reply, edit replies, or remove comments</h2>
                    </div>

                    <div class="space-y-5">
                        <?php foreach ($messages as $msg): ?>
                            <article class="rounded-[1.8rem] bg-slate-50 p-5">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-3">
                                            <span class="px-3 py-1 rounded-full bg-white text-slate-500 text-xs font-black uppercase tracking-[0.2em]"><?= htmlspecialchars($msg['subject']) ?></span>
                                            <span class="text-yellow-500 text-sm">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <?= $i <= (int) ($msg['rating'] ?? 0) ? '★' : '☆' ?>
                                                <?php endfor; ?>
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-black text-slate-900"><?= htmlspecialchars($msg['name']) ?></h3>
                                        <p class="text-sm text-slate-500"><?= htmlspecialchars($msg['email']) ?></p>
                                        <p class="text-sm text-slate-600 leading-7 mt-4"><?= nl2br(htmlspecialchars($msg['message'])) ?></p>
                                    </div>
                                    <div class="text-sm font-semibold text-slate-400"><?= htmlspecialchars(date('d M Y, h:i A', strtotime($msg['created_at']))) ?></div>
                                </div>

                                <form action="manage_feedback.php" method="POST" class="mt-5 space-y-4">
                                    <input type="hidden" name="message_id" value="<?= (int) $msg['id'] ?>">
                                    <textarea name="reply_text" rows="4" class="w-full rounded-[1.5rem] border border-slate-200 bg-white px-4 py-4" placeholder="Write or edit your reply..."><?= htmlspecialchars($msg['reply'] ?? '') ?></textarea>
                                    <div class="flex flex-wrap gap-3">
                                        <button type="submit" name="action" value="save_reply" class="px-4 py-3 rounded-2xl bg-blue-600 text-white text-sm font-bold">Save Reply</button>
                                        <?php if (!empty($msg['reply'])): ?>
                                            <button type="submit" name="action" value="delete_reply" class="px-4 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold">Remove Reply</button>
                                        <?php endif; ?>
                                        <button type="submit" name="action" value="delete_comment" onclick="return confirm('Delete this comment permanently?');" class="px-4 py-3 rounded-2xl bg-red-500 text-white text-sm font-bold">Delete Comment</button>
                                    </div>
                                </form>
                            </article>
                        <?php endforeach; ?>
                    </div>
            </section>
        </div>

        <div id="reports" class="admin-pane">
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_1fr_1fr] gap-6">
                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Reports</p>
                    <h2 class="text-2xl font-black mt-2">Most used tools</h2>
                    <div class="mt-6 space-y-4">
                        <?php foreach ($topTools as $tool): ?>
                            <div>
                                <div class="flex items-center justify-between text-sm font-bold mb-2">
                                    <span><?= htmlspecialchars(ucwords(str_replace('_', ' ', $tool['tool_used']))) ?></span>
                                    <span class="text-blue-600"><?= (int) $tool['total'] ?></span>
                                </div>
                                <div class="h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-blue-600" style="width: <?= $totalVisits > 0 ? min(100, ((int) $tool['total'] / $totalVisits) * 100) : 0 ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Power Users</p>
                    <h2 class="text-2xl font-black mt-2">Who uses the tools most</h2>
                    <div class="mt-6 space-y-4">
                        <?php foreach ($topUsers as $reportUser): ?>
                            <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                                <p class="font-black text-slate-900"><?= htmlspecialchars($reportUser['label']) ?></p>
                                <p class="text-sm text-slate-500"><?= htmlspecialchars($reportUser['email']) ?></p>
                                <p class="text-sm font-semibold text-blue-600 mt-2"><?= (int) $reportUser['total_actions'] ?> tracked actions</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>

                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Detailed Breakdown</p>
                    <h2 class="text-2xl font-black mt-2">Most used tool by user</h2>
                    <div class="mt-6 space-y-4">
                        <?php foreach ($userToolBreakdown as $row): ?>
                            <div class="rounded-[1.5rem] bg-slate-50 px-4 py-4">
                                <p class="font-black text-slate-900"><?= htmlspecialchars($row['user_label']) ?></p>
                                <p class="text-sm text-slate-500"><?= htmlspecialchars($row['user_email']) ?></p>
                                <p class="text-sm font-semibold text-slate-700 mt-2"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $row['tool_used']))) ?> · <?= (int) $row['total'] ?> uses</p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            </div>
        </div>

        <div id="ads" class="admin-pane">
            <div class="grid grid-cols-1 xl:grid-cols-[0.95fr_1.05fr] gap-6">
                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Ad Manager</p>
                    <h2 class="text-2xl font-black mt-2">Create and place ads</h2>
                    <p class="text-slate-500 mt-3">Upload an image, choose where it shows, add a link, and control its size and enabled state.</p>

                    <form action="manage_ads.php" method="POST" enctype="multipart/form-data" class="mt-6 space-y-4">
                        <input type="hidden" name="action" value="create">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Title</label>
                            <input type="text" name="title" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Ad Type</label>
                            <select name="ad_type" id="adTypeSelect" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                                <option value="banner">Banner</option>
                                <option value="card">Card</option>
                                <option value="sticky_banner">Sticky Banner</option>
                                <option value="side_banner">Side Banner</option>
                                <option value="vertical">Vertical</option>
                                <option value="horizontal">Horizontal</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Position</label>
                            <select name="position_key" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                                <option value="header">Header</option>
                                <option value="top_content">Top of Content</option>
                                <option value="under_content">Under Content</option>
                                <option value="footer_sticky_bottom">Footer Sticky Bottom</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Image</label>
                            <input type="file" name="ad_image" accept="image/*" required class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                        </div>
                        <div>
                            <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Link</label>
                            <input type="url" name="target_url" placeholder="https://example.com" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                        </div>
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4">
                            <input type="checkbox" id="customSizeToggle" name="use_custom_size" value="1">
                            <span class="font-bold text-slate-700">Use custom size</span>
                        </label>
                        <div id="customSizeFields" class="grid grid-cols-2 gap-4 hidden">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Width (px)</label>
                                <input type="number" name="width_px" min="0" placeholder="728" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Height (px)</label>
                                <input type="number" name="height_px" min="0" placeholder="90" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-slate-50">
                            </div>
                        </div>
                        <label class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4">
                            <input type="checkbox" name="is_enabled" value="1" checked>
                            <span class="font-bold text-slate-700">Enable this ad right away</span>
                        </label>
                        <button type="submit" class="w-full px-5 py-4 rounded-2xl bg-blue-600 text-white font-bold text-sm uppercase tracking-[0.15em]">Upload Ad</button>
                    </form>
                </section>

                <section class="panel rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Existing Ads</p>
                    <h2 class="text-2xl font-black mt-2">Enable, disable, or remove</h2>
                    <div class="mt-6 space-y-4">
                        <?php foreach ($ads as $ad): ?>
                            <div class="rounded-[1.6rem] bg-slate-50 p-4">
                                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-4">
                                    <div class="flex gap-4">
                                        <img src="<?= htmlspecialchars($ad['image_path']) ?>" alt="<?= htmlspecialchars($ad['title']) ?>" class="w-28 h-20 object-cover rounded-2xl border border-slate-200 bg-white">
                                        <div>
                                            <p class="font-black text-slate-900"><?= htmlspecialchars($ad['title']) ?></p>
                                            <p class="text-sm text-slate-500"><?= htmlspecialchars($ad['position_key']) ?></p>
                                            <p class="text-xs text-slate-400 mt-1"><?= $ad['width_px'] ? (int) $ad['width_px'] . 'x' . (int) ($ad['height_px'] ?? 0) . ' px' : 'Auto size' ?></p>
                                            <p class="text-xs font-bold mt-2 <?= (int) $ad['is_enabled'] === 1 ? 'text-emerald-600' : 'text-slate-400' ?>"><?= (int) $ad['is_enabled'] === 1 ? 'Enabled' : 'Disabled' ?></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap gap-2">
                                        <form action="manage_ads.php" method="POST">
                                            <input type="hidden" name="action" value="toggle">
                                            <input type="hidden" name="ad_id" value="<?= (int) $ad['id'] ?>">
                                            <input type="hidden" name="is_enabled" value="<?= (int) $ad['is_enabled'] === 1 ? 0 : 1 ?>">
                                            <button type="submit" class="px-4 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold"><?= (int) $ad['is_enabled'] === 1 ? 'Disable' : 'Enable' ?></button>
                                        </form>
                                        <form action="manage_ads.php" method="POST" onsubmit="return confirm('Delete this ad?');">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="ad_id" value="<?= (int) $ad['id'] ?>">
                                            <button type="submit" class="px-4 py-3 rounded-2xl bg-red-500 text-white text-sm font-bold">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (!$ads): ?>
                            <div class="rounded-[1.75rem] border border-dashed border-slate-300 p-10 text-center text-slate-400 font-semibold">No ads uploaded yet.</div>
                        <?php endif; ?>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-200">
                        <p class="text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">Legacy Ads</p>
                        <h3 class="text-xl font-black mt-2">Existing hardcoded ad slots</h3>
                        <div class="mt-6 space-y-4">
                            <?php foreach ($legacyAds as $legacyAd): ?>
                                <?php $legacyEnabled = adsLegacyEnabled($conn, $legacyAd['key']); ?>
                                <div class="rounded-[1.6rem] bg-slate-50 p-4">
                                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                        <div>
                                            <p class="font-black text-slate-900"><?= htmlspecialchars($legacyAd['title']) ?></p>
                                            <p class="text-sm text-slate-500"><?= htmlspecialchars($legacyAd['description']) ?></p>
                                            <p class="text-xs font-bold mt-2 <?= $legacyEnabled ? 'text-emerald-600' : 'text-slate-400' ?>"><?= $legacyEnabled ? 'Enabled' : 'Disabled' ?></p>
                                        </div>
                                        <form action="manage_ads.php" method="POST">
                                            <input type="hidden" name="action" value="toggle_legacy">
                                            <input type="hidden" name="legacy_key" value="<?= htmlspecialchars($legacyAd['key']) ?>">
                                            <input type="hidden" name="is_enabled" value="<?= $legacyEnabled ? '0' : '1' ?>">
                                            <button type="submit" class="px-4 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold"><?= $legacyEnabled ? 'Disable' : 'Enable' ?></button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        const themeToggle = document.getElementById('themeToggle');
        const applyThemeLabel = () => {
            themeToggle.textContent = document.documentElement.classList.contains('dark') ? 'Light' : 'Dark';
        };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeLabel();
        });

        function activateAdminTab(tabName) {
            const safeTab = document.getElementById(tabName) ? tabName : 'users';
            document.querySelectorAll('.admin-tab').forEach(el => {
                el.classList.toggle('active', el.dataset.tab === safeTab);
            });
            document.querySelectorAll('.admin-pane').forEach(el => {
                el.classList.toggle('active', el.id === safeTab);
            });
            if (window.location.hash !== '#' + safeTab) {
                history.replaceState(null, '', '#' + safeTab);
            }
        }

        document.querySelectorAll('.admin-tab').forEach(btn => {
            btn.addEventListener('click', () => activateAdminTab(btn.dataset.tab));
        });

        const initialAdminTab = window.location.hash ? window.location.hash.substring(1) : 'users';
        activateAdminTab(initialAdminTab);

        const presets = {
            banner: { width: 728, height: 90 },
            card: { width: 320, height: 250 },
            sticky_banner: { width: 728, height: 90 },
            side_banner: { width: 300, height: 600 },
            vertical: { width: 160, height: 600 },
            horizontal: { width: 970, height: 250 }
        };

        const typeSelect = document.getElementById('adTypeSelect');
        const customToggle = document.getElementById('customSizeToggle');
        const customWrap = document.getElementById('customSizeFields');
        const widthInput = document.querySelector('input[name="width_px"]');
        const heightInput = document.querySelector('input[name="height_px"]');

        function syncAdPreset() {
            const preset = presets[typeSelect.value] || { width: '', height: '' };
            customWrap.classList.toggle('hidden', !customToggle.checked);
            if (!customToggle.checked) {
                widthInput.value = preset.width;
                heightInput.value = preset.height;
            }
        }

        if (typeSelect && customToggle && customWrap && widthInput && heightInput) {
            typeSelect.addEventListener('change', syncAdPreset);
            customToggle.addEventListener('change', syncAdPreset);
            syncAdPreset();
        }
    </script>
</body>
</html>
