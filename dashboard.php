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

function dashboardAvatarUrl(array $user): string
{
    if (!empty($user['avatar_path'])) {
        return $user['avatar_path'];
    }

    return '';
}

function dashboardInitials(string $name): string
{
    $parts = preg_split('/\s+/', trim($name)) ?: [];
    $initials = '';
    foreach (array_slice($parts, 0, 2) as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    return $initials !== '' ? $initials : 'U';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard | Any2Convert</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-base: #f8f8fc;
            --bg-surface: rgba(255,255,255,0.68);
            --bg-soft: rgba(255,255,255,0.84);
            --bg-muted: rgba(243,243,250,0.88);
            --border: rgba(17,17,24,0.08);
            --border-strong: rgba(108,99,255,0.26);
            --text-main: #111118;
            --text-soft: #565676;
            --text-faint: #7a7a98;
            --accent: #6c63ff;
            --accent-blue: #3b82f6;
            --accent-cyan: #22d3ee;
            --success: #10b981;
            --danger: #ef4444;
            --shadow: 0 24px 60px rgba(27, 39, 94, 0.10);
        }
        html.dark {
            --bg-base: #060816;
            --bg-surface: rgba(14,18,36,0.66);
            --bg-soft: rgba(11,15,29,0.82);
            --bg-muted: rgba(18,24,44,0.92);
            --border: rgba(255,255,255,0.08);
            --border-strong: rgba(96,165,250,0.35);
            --text-main: #eef2ff;
            --text-soft: #a7afcf;
            --text-faint: #7b86af;
            --accent: #8b7cff;
            --accent-blue: #60a5fa;
            --accent-cyan: #67e8f9;
            --shadow: 0 30px 70px rgba(0, 0, 0, 0.35);
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            min-height: 100vh;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-main);
            background:
                radial-gradient(circle at 10% 10%, rgba(108,99,255,0.16), transparent 22%),
                radial-gradient(circle at 88% 12%, rgba(34,211,238,0.12), transparent 18%),
                radial-gradient(circle at 50% 0%, rgba(59,130,246,0.12), transparent 34%),
                linear-gradient(180deg, var(--bg-base) 0%, color-mix(in srgb, var(--bg-base) 88%, #eef2ff) 100%);
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(18px);
            background: color-mix(in srgb, var(--bg-soft) 88%, transparent);
            border-bottom: 1px solid var(--border);
        }
        .glass {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            backdrop-filter: blur(22px);
            box-shadow: var(--shadow);
        }
        .soft-card {
            background: var(--bg-muted);
            border: 1px solid var(--border);
        }
        .nav-pill, .icon-btn, .cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform .18s ease, border-color .18s ease, background .18s ease;
        }
        .nav-pill {
            padding: 10px 16px;
            color: var(--text-main);
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg-soft) 92%, transparent);
        }
        .icon-btn {
            width: 48px;
            height: 48px;
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg-soft) 92%, transparent);
            color: var(--text-main);
        }
        .cta-btn {
            padding: 14px 18px;
            border-radius: 18px;
            font-size: .88rem;
            text-transform: uppercase;
            letter-spacing: .12em;
            border: 1px solid transparent;
        }
        .cta-btn.primary {
            color: #fff;
            background: linear-gradient(135deg, var(--accent), var(--accent-blue));
            box-shadow: 0 18px 36px rgba(108,99,255,0.22);
        }
        .cta-btn.secondary {
            color: var(--text-main);
            background: color-mix(in srgb, var(--bg-soft) 94%, transparent);
            border-color: var(--border);
        }
        .nav-pill:hover, .icon-btn:hover, .cta-btn:hover { transform: translateY(-1px); }
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
            color: var(--text-main);
        }
        .brand-dot { color: var(--accent); }
        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.2fr) minmax(320px, 0.8fr);
            gap: 24px;
        }
        .metric-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }
        .tab-btn {
            border-radius: 16px;
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg-soft) 92%, transparent);
            color: var(--text-soft);
            font-size: .82rem;
            font-weight: 800;
            letter-spacing: .14em;
            text-transform: uppercase;
            padding: 13px 18px;
        }
        .tab-btn.active {
            color: #fff;
            background: linear-gradient(135deg, var(--accent), var(--accent-blue));
            border-color: transparent;
        }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; }
        .avatar-shell {
            position: relative;
            width: 108px;
            height: 108px;
            border-radius: 28px;
            padding: 4px;
            background: linear-gradient(135deg, rgba(108,99,255,.45), rgba(34,211,238,.38));
            box-shadow: 0 18px 36px rgba(108,99,255,.18);
        }
        .avatar-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 24px;
            background: var(--bg-muted);
        }
        .avatar-fallback {
            width: 100%;
            height: 100%;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: .08em;
            color: #1f3f98;
            background:
                radial-gradient(circle at 30% 25%, rgba(255,255,255,.85), transparent 34%),
                linear-gradient(135deg, rgba(255,255,255,.92), rgba(203,213,255,.95));
        }
        html.dark .avatar-fallback {
            color: #eef2ff;
            background:
                radial-gradient(circle at 30% 25%, rgba(139,124,255,.35), transparent 34%),
                linear-gradient(135deg, rgba(37,56,123,.96), rgba(16,93,140,.92));
        }
        .upload-input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: color-mix(in srgb, var(--bg-soft) 94%, transparent);
            color: var(--text-main);
        }
        .upload-input::file-selector-button {
            margin-right: 12px;
            border: 0;
            border-radius: 12px;
            padding: 10px 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-blue));
            color: #fff;
            font-weight: 700;
            cursor: pointer;
        }
        .switch-row {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px;
            border-radius: 20px;
            background: var(--bg-muted);
            border: 1px solid var(--border);
        }
        .history-item, .feedback-item {
            border-radius: 22px;
            padding: 18px 20px;
            background: var(--bg-muted);
            border: 1px solid var(--border);
        }
        .flash {
            border-radius: 20px;
            padding: 14px 16px;
            font-size: .94rem;
            font-weight: 700;
            border: 1px solid transparent;
        }
        .flash.error { background: rgba(239,68,68,.08); color: var(--danger); border-color: rgba(239,68,68,.14); }
        .flash.success { background: rgba(16,185,129,.08); color: var(--success); border-color: rgba(16,185,129,.14); }
        @media (max-width: 1200px) {
            .hero-grid { grid-template-columns: 1fr; }
            .metric-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 768px) {
            .metric-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <?= adsRenderPosition($conn, 'header') ?>
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="index.php" class="brand-mark" aria-label="Any2Convert home">
                    <span class="brand-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="8" y1="13" x2="16" y2="13"/>
                            <line x1="8" y1="17" x2="13" y2="17"/>
                        </svg>
                    </span>
                    <span class="brand-text">Any2Convert<span class="brand-dot">.</span></span>
                </a>
                <span class="hidden md:inline-flex px-3 py-1 rounded-full glass text-xs font-black uppercase tracking-[0.22em]">Dashboard</span>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="index.php" class="nav-pill">Home</a>
                <a href="index.php#tools" class="nav-pill">Tools</a>
                <a href="contact.php" class="nav-pill">Support</a>
                <button type="button" id="themeToggle" class="icon-btn" aria-label="Toggle theme">
                    <svg id="iconMoon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    <svg id="iconSun" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none"><circle cx="12" cy="12" r="5"/><path d="M12 1v2"/><path d="M12 21v2"/><path d="M4.22 4.22l1.42 1.42"/><path d="M18.36 18.36l1.42 1.42"/><path d="M1 12h2"/><path d="M21 12h2"/><path d="M4.22 19.78l1.42-1.42"/><path d="M18.36 5.64l1.42-1.42"/></svg>
                </button>
                <a href="backend/logout.php" class="nav-pill">Logout</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 py-8">
        <?php if ($flash): ?>
            <div class="flash <?= $flash['type'] === 'error' ? 'error' : 'success' ?> mb-6">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <section class="hero-grid mb-8">
            <div class="glass rounded-[2rem] p-7">
                <div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-6">
                    <div class="flex items-start gap-5">
                        <div class="avatar-shell">
                            <?php if (dashboardAvatarUrl($user) !== ''): ?>
                                <img src="<?= htmlspecialchars(dashboardAvatarUrl($user)) ?>" alt="Profile photo" class="avatar-image">
                            <?php else: ?>
                                <div class="avatar-fallback"><?= htmlspecialchars(dashboardInitials((string) $user['name'])) ?></div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p class="text-xs font-black uppercase tracking-[0.30em] text-[var(--accent-blue)]">User Dashboard</p>
                            <h1 class="text-4xl font-black tracking-tight mt-3">Welcome back, <?= htmlspecialchars(explode(' ', $user['name'])[0]) ?></h1>
                            <p class="mt-3 max-w-2xl leading-7 text-[color:var(--text-soft)]">A cleaner space for your profile, activity, and account controls. Your dashboard now follows the same airy glassmorphism vibe as the homepage, with stronger contrast in dark mode.</p>
                            <div class="flex flex-wrap gap-3 mt-6">
                                <button type="button" class="cta-btn primary" onclick="activateDashTab('security')">Security Settings</button>
                                <a href="forgot_password.php" class="cta-btn secondary">Reset Password</a>
                            </div>
                        </div>
                    </div>
                    <div class="glass rounded-[1.6rem] p-5 min-w-[280px]">
                        <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[color:var(--text-faint)]">Profile Photo</p>
                        <p class="text-sm leading-6 mt-2 text-[color:var(--text-soft)]">Upload JPG, PNG, or WEBP under 4 MB. Your avatar will show here after saving.</p>
                        <form action="backend/update_profile_photo.php" method="POST" enctype="multipart/form-data" class="space-y-3 mt-4">
                            <input type="file" name="avatar" accept="image/jpeg,image/png,image/webp" class="upload-input" required>
                            <button type="submit" class="cta-btn primary w-full" style="width:100%;">Save Photo</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="glass rounded-[2rem] p-7">
                <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Profile Snapshot</p>
                <div class="space-y-4 mt-5">
                    <div class="soft-card rounded-[1.4rem] p-4">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Public Account ID</p>
                        <p class="text-2xl font-black mt-2"><?= htmlspecialchars(dashboardPublicUserId((int) $user['id'])) ?></p>
                    </div>
                    <div class="soft-card rounded-[1.4rem] p-4">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Email</p>
                        <p class="font-bold mt-2 break-all"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                    <div class="soft-card rounded-[1.4rem] p-4">
                        <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Email Auth</p>
                        <p class="font-bold mt-2"><?= !empty($user['email_auth_enabled']) ? 'Enabled' : 'Disabled' ?></p>
                        <p class="text-sm mt-1 text-[color:var(--text-soft)]"><?= !empty($user['email_auth_enabled']) ? 'Login OTP is active.' : 'One-click sign-in flow only.' ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="metric-grid mb-8">
            <div class="glass rounded-[1.7rem] p-5">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[color:var(--text-faint)]">Tool Actions</p>
                <h2 class="text-4xl font-black mt-3"><?= (int) ($stats['total_actions'] ?? 0) ?></h2>
                <p class="text-sm mt-2 text-[color:var(--text-soft)]">Tracked visits and tool opens</p>
            </div>
            <div class="glass rounded-[1.7rem] p-5">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[color:var(--text-faint)]">Unique Tools</p>
                <h2 class="text-4xl font-black mt-3"><?= (int) ($stats['unique_tools'] ?? 0) ?></h2>
                <p class="text-sm mt-2 text-[color:var(--text-soft)]">Different tools explored so far</p>
            </div>
            <div class="glass rounded-[1.7rem] p-5">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[color:var(--text-faint)]">Favorite Tool</p>
                <h2 class="text-2xl font-black mt-3"><?= $favoriteTool ? htmlspecialchars(dashboardFormatTool($favoriteTool['tool_used'])) : 'No history yet' ?></h2>
                <p class="text-sm mt-2 text-[color:var(--text-soft)]"><?= $favoriteTool ? (int) $favoriteTool['total'] . ' visits' : 'Start using tools to build history' ?></p>
            </div>
            <div class="glass rounded-[1.7rem] p-5">
                <p class="text-[11px] font-black uppercase tracking-[0.22em] text-[color:var(--text-faint)]">Last Activity</p>
                <h2 class="text-xl font-black mt-3"><?= !empty($stats['last_activity']) ? htmlspecialchars(date('d M Y', strtotime($stats['last_activity']))) : 'No activity yet' ?></h2>
                <p class="text-sm mt-2 text-[color:var(--text-soft)]"><?= !empty($stats['last_activity']) ? htmlspecialchars(date('h:i A', strtotime($stats['last_activity']))) : 'Use a tool to get started' ?></p>
            </div>
        </section>

        <section class="mb-6 flex flex-wrap gap-3">
            <button type="button" class="tab-btn active" data-tab="overview">Overview</button>
            <button type="button" class="tab-btn" data-tab="history">History</button>
            <button type="button" class="tab-btn" data-tab="feedback">Feedback</button>
            <button type="button" class="tab-btn" data-tab="security">Security</button>
        </section>

        <section id="overview" class="tab-pane active">
            <div class="grid grid-cols-1 xl:grid-cols-[1.2fr_0.8fr] gap-6">
                <div class="glass rounded-[2rem] p-7">
                    <div class="flex items-center justify-between gap-4 mb-6">
                        <div>
                            <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Recent Activity</p>
                            <h2 class="text-2xl font-black mt-2">Latest tools you opened</h2>
                        </div>
                        <span class="px-3 py-2 rounded-2xl soft-card text-xs font-black uppercase tracking-[0.2em]"><?= count($history) ?> items</span>
                    </div>
                    <?php if (!$history): ?>
                        <div class="history-item text-center text-[color:var(--text-soft)] font-semibold">No tool history yet. Start using Any2Convert tools and your activity will appear here.</div>
                    <?php else: ?>
                        <div class="space-y-4">
                            <?php foreach (array_slice($history, 0, 5) as $item): ?>
                                <div class="history-item">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                        <div>
                                            <p class="text-lg font-black"><?= htmlspecialchars(dashboardFormatTool($item['tool_used'])) ?></p>
                                            <p class="text-sm text-[color:var(--text-soft)]"><?= htmlspecialchars($item['page_name']) ?></p>
                                        </div>
                                        <div class="text-sm font-semibold text-[color:var(--text-soft)]"><?= htmlspecialchars(date('d M Y, h:i A', strtotime($item['visit_date']))) ?></div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="glass rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Account Card</p>
                    <div class="soft-card rounded-[1.7rem] p-5 mt-5">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-[1.2rem] overflow-hidden border border-[color:var(--border)] bg-[color:var(--bg-muted)] flex items-center justify-center">
                                <?php if (dashboardAvatarUrl($user) !== ''): ?>
                                    <img src="<?= htmlspecialchars(dashboardAvatarUrl($user)) ?>" alt="Avatar" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <span class="text-lg font-black text-[var(--accent-blue)]"><?= htmlspecialchars(dashboardInitials((string) $user['name'])) ?></span>
                                <?php endif; ?>
                            </div>
                            <div>
                                <p class="text-xl font-black"><?= htmlspecialchars($user['name']) ?></p>
                                <p class="text-sm text-[color:var(--text-soft)]"><?= htmlspecialchars($user['email']) ?></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3 mt-5">
                            <div class="soft-card rounded-[1rem] p-4">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Initials</p>
                                <p class="text-2xl font-black mt-2"><?= htmlspecialchars(dashboardInitials((string) $user['name'])) ?></p>
                            </div>
                            <div class="soft-card rounded-[1rem] p-4">
                                <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Premium</p>
                                <p class="text-2xl font-black mt-2"><?= !empty($user['is_premium']) ? 'Yes' : 'No' ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="history" class="tab-pane">
            <div class="glass rounded-[2rem] p-7">
                <div class="mb-6">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">History</p>
                    <h2 class="text-2xl font-black mt-2">Full recent activity log</h2>
                </div>
                <?php if (!$history): ?>
                    <div class="history-item text-center text-[color:var(--text-soft)] font-semibold">No tool history yet.</div>
                <?php else: ?>
                    <div class="space-y-4">
                        <?php foreach ($history as $item): ?>
                            <div class="history-item">
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                                    <div>
                                        <p class="text-lg font-black"><?= htmlspecialchars(dashboardFormatTool($item['tool_used'])) ?></p>
                                        <p class="text-sm text-[color:var(--text-soft)]"><?= htmlspecialchars($item['page_name']) ?></p>
                                    </div>
                                    <div class="text-sm font-semibold text-[color:var(--text-soft)]"><?= htmlspecialchars(date('d M Y, h:i A', strtotime($item['visit_date']))) ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="feedback" class="tab-pane">
            <div class="glass rounded-[2rem] p-7">
                <div class="mb-6">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Feedback</p>
                    <h2 class="text-2xl font-black mt-2">Your comments and admin replies</h2>
                </div>
                <?php if (!$feedbacks): ?>
                    <div class="feedback-item text-center text-[color:var(--text-soft)] font-semibold">No feedback posted yet.</div>
                <?php else: ?>
                    <div class="space-y-5">
                        <?php foreach ($feedbacks as $feedback): ?>
                            <article class="feedback-item">
                                <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                                    <div>
                                        <h3 class="text-lg font-black"><?= htmlspecialchars($feedback['subject']) ?></h3>
                                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-[color:var(--text-faint)]"><?= htmlspecialchars(date('d M Y', strtotime($feedback['created_at']))) ?></p>
                                    </div>
                                    <div class="text-yellow-500 text-sm">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?= $i <= (int) $feedback['rating'] ? '★' : '☆' ?>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <p class="leading-7 text-[color:var(--text-soft)]"><?= nl2br(htmlspecialchars($feedback['message'])) ?></p>
                                <?php if (!empty($feedback['reply'])): ?>
                                    <div class="mt-4 rounded-[1.2rem] px-4 py-4 border border-[color:var(--border)] bg-[rgba(59,130,246,0.09)]">
                                        <p class="text-[11px] font-black uppercase tracking-[0.2em] text-[var(--accent-blue)] mb-1">Admin Reply</p>
                                        <p class="font-medium"><?= nl2br(htmlspecialchars($feedback['reply'])) ?></p>
                                    </div>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section id="security" class="tab-pane">
            <div class="grid grid-cols-1 xl:grid-cols-[1fr_0.88fr] gap-6">
                <div class="glass rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Security</p>
                    <h2 class="text-2xl font-black mt-2">Account protection</h2>
                    <p class="mt-3 leading-7 text-[color:var(--text-soft)]">Enable email authentication if you want every login to require a one-time code from your inbox.</p>
                    <form action="backend/update_security_settings.php" method="POST" class="mt-6 space-y-4">
                        <label class="switch-row">
                            <input type="checkbox" name="email_auth_enabled" value="1" class="mt-1 h-5 w-5" <?= !empty($user['email_auth_enabled']) ? 'checked' : '' ?>>
                            <span>
                                <span class="block font-bold">Require OTP on every login</span>
                                <span class="block text-sm mt-1 text-[color:var(--text-soft)]">Adds an extra verification step so account access depends on both password and inbox access.</span>
                            </span>
                        </label>
                        <button type="submit" class="cta-btn primary w-full" style="width:100%;">Save Security Settings</button>
                    </form>
                </div>
                <div class="glass rounded-[2rem] p-7">
                    <p class="text-[11px] font-black uppercase tracking-[0.25em] text-[color:var(--text-faint)]">Quick Tips</p>
                    <div class="space-y-4 mt-5">
                        <div class="soft-card rounded-[1.4rem] p-4">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Best Practice</p>
                            <p class="font-bold mt-2">Use a unique password with OTP enabled.</p>
                        </div>
                        <div class="soft-card rounded-[1.4rem] p-4">
                            <p class="text-xs font-black uppercase tracking-[0.18em] text-[color:var(--text-faint)]">Recovery</p>
                            <a href="forgot_password.php" class="inline-flex mt-2 font-bold text-[var(--accent-blue)]">Reset by Email OTP</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>

    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.classList.add('dark');
        }

        const themeToggle = document.getElementById('themeToggle');
        const iconMoon = document.getElementById('iconMoon');
        const iconSun = document.getElementById('iconSun');
        function applyThemeIcon() {
            const dark = document.documentElement.classList.contains('dark');
            iconMoon.style.display = dark ? 'none' : 'block';
            iconSun.style.display = dark ? 'block' : 'none';
        }
        applyThemeIcon();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeIcon();
        });

        function activateDashTab(tabName) {
            const safeTab = document.getElementById(tabName) ? tabName : 'overview';
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.toggle('active', el.dataset.tab === safeTab));
            document.querySelectorAll('.tab-pane').forEach(el => el.classList.toggle('active', el.id === safeTab));
            if (window.location.hash !== '#' + safeTab) {
                history.replaceState(null, '', '#' + safeTab);
            }
        }

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => activateDashTab(btn.dataset.tab));
        });

        activateDashTab(window.location.hash ? window.location.hash.substring(1) : 'overview');
    </script>
</body>
</html>
