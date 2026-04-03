<?php
session_start();
require_once __DIR__ . '/partials/site_chrome.php';

$topic = $_GET['topic'] ?? '';
$highlights = [
    'no-file-uploads' => [
        'label' => 'No file uploads',
        'eyebrow' => 'Privacy first',
        'title' => 'Your files stay on your device from start to finish.',
        'intro' => 'Any2Convert is designed to work in the browser, so your private documents and images are not uploaded to a remote processing queue just to finish a basic task.',
        'accent' => '#10b981',
        'glow' => 'rgba(16,185,129,0.16)',
        'points' => [
            'Sensitive PDFs, IDs, invoices, and screenshots are handled locally in the tab.',
            'There is no waiting for a server upload just to begin a conversion.',
            'This keeps the experience faster and reduces privacy risk at the same time.',
        ],
        'details' => [
            ['title' => 'Why it matters', 'body' => 'A lot of online tools ask for uploads even when the job can be done on-device. That adds delay and forces users to trust a third party with personal files.'],
            ['title' => 'How Any2Convert handles it', 'body' => 'We rely on browser APIs, JavaScript, and WebAssembly-based processing where possible, so the work happens where the file already is.'],
            ['title' => 'Best for', 'body' => 'Private PDFs, resumes, contracts, statements, screenshots, and quick one-off conversions where privacy matters.'],
        ],
    ],
    'instant-processing' => [
        'label' => 'Instant processing',
        'eyebrow' => 'Speed built in',
        'title' => 'The tool starts working right away, without a remote queue slowing you down.',
        'intro' => 'Instead of uploading, waiting, converting on a remote server, and then downloading again, many Any2Convert tools begin processing immediately inside the browser.',
        'accent' => '#6c63ff',
        'glow' => 'rgba(108,99,255,0.18)',
        'points' => [
            'No upload queue or server-side backlog before a conversion starts.',
            'Fast feedback loops for repetitive tasks and bulk edits.',
            'A smoother experience on both desktop and mobile connections.',
        ],
        'details' => [
            ['title' => 'What makes it feel fast', 'body' => 'The file is already local, so there is no extra round trip before the actual work begins. That removes the slowest step in many traditional tools.'],
            ['title' => 'Where it helps most', 'body' => 'Quick PDF edits, image changes, text extraction, calculators, and daily utility actions where waiting even a few seconds feels annoying.'],
            ['title' => 'Why users come back', 'body' => 'Fast tools feel trustworthy. When the result appears immediately, people are much more likely to reuse the site.'],
        ],
    ],
    'free-forever' => [
        'label' => 'Free forever',
        'eyebrow' => 'No paywall surprise',
        'title' => 'Useful tools should stay usable without forcing upgrades or stamping watermarks.',
        'intro' => 'Any2Convert is meant to be genuinely useful, not a bait-and-switch where users finish their work and then discover a locked download button.',
        'accent' => '#f59e0b',
        'glow' => 'rgba(245,158,11,0.18)',
        'points' => [
            'No watermark slapped onto finished files.',
            'No last-step payment wall after the work is already done.',
            'A better experience for students, freelancers, and casual users.',
        ],
        'details' => [
            ['title' => 'Why this matters', 'body' => 'People use utility tools in urgent moments. A hidden fee at the end destroys trust and turns a simple task into friction.'],
            ['title' => 'How we keep it simple', 'body' => 'The experience is built around direct access, clean outputs, and no unnecessary lock-in for common everyday jobs.'],
            ['title' => 'What users get', 'body' => 'Fast tools, usable exports, and a cleaner overall experience without branding added to the result.'],
        ],
    ],
    'works-in-browser' => [
        'label' => 'Works in browser',
        'eyebrow' => 'No app required',
        'title' => 'Open the page, use the tool, and finish the job without installing anything.',
        'intro' => 'The site is built to be usable right away in a normal browser session, whether someone is on a work laptop, a shared machine, or a phone.',
        'accent' => '#3b82f6',
        'glow' => 'rgba(59,130,246,0.18)',
        'points' => [
            'No installer, desktop app, or extension required.',
            'Works across modern desktop and mobile browsers.',
            'Great for fast tasks when users do not want extra setup.',
        ],
        'details' => [
            ['title' => 'Why browser-first helps', 'body' => 'Users can go from search result to completed task in one flow instead of stopping to download software or register for access.'],
            ['title' => 'Who benefits', 'body' => 'Students, office users, travelers, and anyone working from a locked-down machine or temporary device.'],
            ['title' => 'What it enables', 'body' => 'Faster discovery, lower friction, and more repeat usage because the site is always one tab away.'],
        ],
    ],
    'files-never-leave-your-device' => [
        'label' => 'Files never leave your device',
        'eyebrow' => 'Client-side safety',
        'title' => 'Private file handling should not require blind trust.',
        'intro' => 'For many tools, Any2Convert keeps processing local so your file remains in your environment instead of being uploaded elsewhere for routine work.',
        'accent' => '#10b981',
        'glow' => 'rgba(16,185,129,0.16)',
        'points' => [
            'More peace of mind for tax files, resumes, personal photos, and contracts.',
            'Less delay because there is no large upload to wait on first.',
            'A simpler workflow for users who just want the job done quickly.',
        ],
        'details' => [
            ['title' => 'Security mindset', 'body' => 'Privacy is not just a legal box to tick. It is a product decision that shapes how users feel every time they drag in a file.'],
            ['title' => 'Why local matters', 'body' => 'A local-first workflow reduces unnecessary exposure and gives users a clearer mental model of where their content is being handled.'],
            ['title' => 'Everyday value', 'body' => 'People can use sensitive tools with less hesitation, which increases trust and repeat visits.'],
        ],
    ],
    'instant-results' => [
        'label' => 'Instant results',
        'eyebrow' => 'Frictionless flow',
        'title' => 'The result appears fast enough that the tool feels effortless.',
        'intro' => 'Good utility products should not make users wait through extra network delays for tiny tasks. Any2Convert aims to keep the path from input to result as short as possible.',
        'accent' => '#6c63ff',
        'glow' => 'rgba(108,99,255,0.18)',
        'points' => [
            'Fast interactions keep users in the flow.',
            'Ideal for repetitive work like resizing, converting, or extracting.',
            'Helps the site feel modern and responsive.',
        ],
        'details' => [
            ['title' => 'Performance goal', 'body' => 'When a tool reacts immediately, it feels better to use and more reliable, even before users think about the underlying technology.'],
            ['title' => 'Best examples', 'body' => 'Calculators, JSON tools, converters, image edits, and quick PDF utilities benefit the most from low-latency behavior.'],
            ['title' => 'Why it improves retention', 'body' => 'People remember when a site saves time. Fast feedback is one of the strongest reasons they come back.'],
        ],
    ],
    'always-free-no-watermarks' => [
        'label' => 'Always free, no watermarks',
        'eyebrow' => 'Transparent value',
        'title' => 'A simple promise: use the tool and keep the output clean.',
        'intro' => 'A lot of converter sites look free until the end. This approach keeps the experience straightforward, so the finished file is actually usable.',
        'accent' => '#f59e0b',
        'glow' => 'rgba(245,158,11,0.18)',
        'points' => [
            'No ugly watermark covering the final output.',
            'No forced upgrade after the conversion is already complete.',
            'A better fit for everyday practical use.',
        ],
        'details' => [
            ['title' => 'Why users hate paywalls late in the flow', 'body' => 'By the time a person reaches the result step, they are already invested. Hiding the real cost there feels deceptive and creates abandonment.'],
            ['title' => 'How this helps the brand', 'body' => 'Clear value builds trust faster than any marketing copy. If the file comes out clean, users notice immediately.'],
            ['title' => 'Who benefits most', 'body' => 'Students, freelancers, job seekers, and anyone who needs quick utility work without subscription fatigue.'],
        ],
    ],
    'works-on-any-device' => [
        'label' => 'Works on any device',
        'eyebrow' => 'Cross-device friendly',
        'title' => 'The experience stays usable whether someone is on desktop, tablet, or phone.',
        'intro' => 'Any2Convert is built for flexible access so people can get work done from the device they already have in front of them.',
        'accent' => '#3b82f6',
        'glow' => 'rgba(59,130,246,0.18)',
        'points' => [
            'Useful on office desktops, school laptops, tablets, and phones.',
            'No separate app install needed for each platform.',
            'Ideal for people who switch devices throughout the day.',
        ],
        'details' => [
            ['title' => 'Why this increases usage', 'body' => 'A tool becomes more useful when it is available everywhere. That means fewer drop-offs when users are away from their usual machine.'],
            ['title' => 'Design implication', 'body' => 'Layouts, buttons, and processing flows have to remain practical across screen sizes, not just look good on desktop.'],
            ['title' => 'What users feel', 'body' => 'Consistency. If the tool works on whatever device they grab, the product feels dependable.'],
        ],
    ],
];

$data = $highlights[$topic] ?? null;
if ($data === null) {
    http_response_code(404);
}

$pageTitle = $data ? ($data['label'] . ' | Any2Convert') : 'Page not found | Any2Convert';
$isLoggedIn = isset($_SESSION['user_id']) || isset($_SESSION['email']);
$isAdminUser = isset($_SESSION['email']) && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com';
$dashboardHref = $isAdminUser ? 'admin/dashboard.php' : 'dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="icon" type="image/png" href="mylogo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php any2convertRenderChromeStyles(); ?>
    <style>
        :root {
            --accent: #6c63ff;
            --green: #10b981;
            --amber: #f59e0b;
            --blue: #3b82f6;
            --bg: #f6f7ff;
            --bg-soft: rgba(255,255,255,.82);
            --bg-card: rgba(255,255,255,.92);
            --panel-bg: rgba(255,255,255,.74);
            --panel-strong: rgba(255,255,255,.94);
            --panel-border: rgba(108,99,255,.12);
            --nav-bg: rgba(255,255,255,.72);
            --nav-border: rgba(108,99,255,.12);
            --pill-bg: rgba(255,255,255,.86);
            --pill-text: #171722;
            --text-main: #12121a;
            --text-primary: #12121a;
            --text-soft: #63637d;
            --text-muted: #6f7088;
            --border: rgba(17,17,24,.08);
            --border-strong: rgba(108,99,255,.22);
        }
        .dark {
            --bg: #090911;
            --bg-soft: rgba(20,20,33,.82);
            --bg-card: rgba(18,20,34,.9);
            --panel-bg: rgba(14,16,29,.8);
            --panel-strong: rgba(16,18,32,.92);
            --panel-border: rgba(148,163,184,.16);
            --nav-bg: rgba(10,11,20,.82);
            --nav-border: rgba(148,163,184,.14);
            --pill-bg: rgba(24,26,41,.92);
            --pill-text: #f7f8ff;
            --text-main: #f5f7ff;
            --text-primary: #f5f7ff;
            --text-soft: #c5cadb;
            --text-muted: #98a2b8;
            --border: rgba(148,163,184,.14);
            --border-strong: rgba(148,163,184,.22);
        }
        body {
            background:
                radial-gradient(circle at top left, rgba(108,99,255,.18), transparent 30%),
                radial-gradient(circle at top right, rgba(16,185,129,.12), transparent 26%),
                linear-gradient(180deg, color-mix(in srgb, var(--bg) 88%, #ffffff 12%), var(--bg));
            color: var(--text-main);
        }
        .highlight-shell {
            position: relative;
            overflow: hidden;
            border-radius: 32px;
            border: 1px solid var(--panel-border);
            background: linear-gradient(180deg, color-mix(in srgb, var(--panel-strong) 88%, transparent), color-mix(in srgb, var(--panel-bg) 92%, transparent));
            box-shadow: 0 28px 80px rgba(15,23,42,.12);
            backdrop-filter: blur(22px);
        }
        .highlight-shell::before {
            content: "";
            position: absolute;
            inset: -10% auto auto -8%;
            width: 320px;
            height: 320px;
            border-radius: 999px;
            background: var(--topic-glow, rgba(108,99,255,.16));
            filter: blur(48px);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border-radius: 999px;
            border: 1px solid var(--panel-border);
            background: color-mix(in srgb, var(--panel-strong) 78%, transparent);
            color: var(--text-main);
            font-size: .84rem;
            font-weight: 700;
        }
        .hero-badge-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--topic-accent, var(--accent));
            box-shadow: 0 0 0 6px color-mix(in srgb, var(--topic-accent, var(--accent)) 18%, transparent);
        }
        .info-card {
            border-radius: 24px;
            border: 1px solid var(--panel-border);
            background: color-mix(in srgb, var(--panel-strong) 86%, transparent);
            padding: 22px;
            box-shadow: 0 18px 38px rgba(15,23,42,.08);
            transition: transform .34s cubic-bezier(.22,1,.36,1), border-color .24s ease, box-shadow .24s ease;
        }
        .info-card:hover {
            transform: translateY(-6px);
            border-color: color-mix(in srgb, var(--topic-accent, var(--accent)) 24%, var(--panel-border));
            box-shadow: 0 24px 42px rgba(15,23,42,.14);
        }
        .list-chip {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 18px;
            background: color-mix(in srgb, var(--panel-strong) 84%, transparent);
            border: 1px solid var(--panel-border);
        }
        .list-chip-mark {
            width: 22px;
            height: 22px;
            margin-top: 2px;
            flex-shrink: 0;
            border-radius: 999px;
            background: color-mix(in srgb, var(--topic-accent, var(--accent)) 18%, transparent);
            color: var(--topic-accent, var(--accent));
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .cta-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 20px;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 700;
            transition: transform .32s cubic-bezier(.22,1,.36,1), box-shadow .24s ease, border-color .24s ease, background .24s ease, color .24s ease;
        }
        .cta-link-primary {
            background: linear-gradient(135deg, var(--topic-accent, var(--accent)), color-mix(in srgb, var(--topic-accent, var(--accent)) 72%, #ffffff 28%));
            color: #fff;
            box-shadow: 0 18px 38px color-mix(in srgb, var(--topic-accent, var(--accent)) 34%, transparent);
        }
        .cta-link-secondary {
            background: color-mix(in srgb, var(--panel-strong) 82%, transparent);
            color: var(--text-main);
            border: 1px solid var(--panel-border);
        }
        .cta-link:hover {
            transform: translateY(-3px);
        }
        .highlight-copy p,
        .highlight-copy li {
            color: var(--text-soft);
        }
        @media (max-width: 900px) {
            .highlight-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
</head>
<body style="min-height:100vh;">
<?php
any2convertRenderTopbar([
    'home_href' => 'index.php',
    'badge' => 'Trust & Product Details',
    'links' => [
        ['href' => 'index.php#tools', 'label' => 'Browse tools'],
        ['href' => 'index.php#categories', 'label' => 'Categories'],
        ['href' => 'contact.php', 'label' => 'Contact'],
    ],
    'cta_html' => $isLoggedIn
        ? '<a href="' . htmlspecialchars($dashboardHref) . '" class="site-nav-pill">Dashboard</a>'
        : '<a href="login.php" class="site-nav-pill">Sign in</a><a href="signup.php" class="site-nav-pill" style="background:linear-gradient(135deg,var(--accent),#857dff);color:#fff;border-color:transparent;">Get started</a>',
]);
?>
<main style="max-width:1180px;margin:0 auto;padding:40px 20px 80px;">
    <?php if ($data === null): ?>
        <section class="highlight-shell" style="padding:48px 28px;--topic-accent: var(--accent);--topic-glow: rgba(108,99,255,.18);">
            <div style="position:relative;z-index:1;max-width:780px;">
                <span class="hero-badge"><span class="hero-badge-dot"></span>Page not found</span>
                <h1 style="margin:18px 0 10px;font-size:clamp(2rem,5vw,3.4rem);font-weight:800;letter-spacing:-.04em;">That details page does not exist.</h1>
                <p style="font-size:1.02rem;line-height:1.8;color:var(--text-soft);max-width:60ch;">The topic link may be outdated, but the homepage trust sections are still available and everything important is one click away.</p>
                <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:28px;">
                    <a href="index.php" class="cta-link cta-link-primary">Back to home</a>
                    <a href="index.php#tools" class="cta-link cta-link-secondary">Explore tools</a>
                </div>
            </div>
        </section>
    <?php else: ?>
        <section class="highlight-shell" style="padding:clamp(28px,4vw,42px);--topic-accent: <?= htmlspecialchars($data['accent']) ?>;--topic-glow: <?= htmlspecialchars($data['glow']) ?>;">
            <div class="highlight-grid" style="position:relative;z-index:1;display:grid;grid-template-columns:minmax(0,1.4fr) minmax(280px,.9fr);gap:24px;align-items:start;">
                <div class="highlight-copy">
                    <span class="hero-badge"><span class="hero-badge-dot"></span><?= htmlspecialchars($data['eyebrow']) ?></span>
                    <h1 style="margin:18px 0 12px;font-size:clamp(2.1rem,5.2vw,4rem);font-weight:800;letter-spacing:-.055em;line-height:1.02;max-width:14ch;"><?= htmlspecialchars($data['title']) ?></h1>
                    <p style="font-size:1.04rem;line-height:1.85;max-width:62ch;"><?= htmlspecialchars($data['intro']) ?></p>
                    <div style="display:flex;flex-wrap:wrap;gap:12px;margin-top:28px;">
                        <a href="index.php" class="cta-link cta-link-primary">Back to homepage</a>
                        <a href="index.php#tools" class="cta-link cta-link-secondary">Try the tools</a>
                    </div>
                </div>
                <aside class="info-card" style="position:relative;z-index:1;">
                    <div style="font-size:.74rem;font-weight:900;letter-spacing:.22em;text-transform:uppercase;color:var(--topic-accent, var(--accent));margin-bottom:12px;">At a glance</div>
                    <div style="display:grid;gap:12px;">
                        <?php foreach ($data['points'] as $point): ?>
                            <div class="list-chip">
                                <span class="list-chip-mark">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5L20 7"/></svg>
                                </span>
                                <div style="font-size:.95rem;line-height:1.7;color:var(--text-main);"><?= htmlspecialchars($point) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </aside>
            </div>
        </section>

        <section style="margin-top:34px;display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:18px;">
            <?php foreach ($data['details'] as $detail): ?>
                <article class="info-card">
                    <div style="font-size:1rem;font-weight:800;letter-spacing:-.02em;color:var(--text-main);margin-bottom:10px;"><?= htmlspecialchars($detail['title']) ?></div>
                    <p style="font-size:.95rem;line-height:1.8;color:var(--text-soft);"><?= htmlspecialchars($detail['body']) ?></p>
                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>
<?php any2convertRenderFooter(); ?>
<?php any2convertRenderThemeScript(); ?>
</body>
</html>
