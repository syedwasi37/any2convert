<?php
session_start();
require_once 'backend/db.php';
require_once 'backend/ad_helpers.php';
require_once 'backend/track_visit.php';
require_once __DIR__ . '/partials/site_chrome.php';
trackVisit('Contact Page');

$isAdminUser = isset($_SESSION['email']) && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com';
$backHref = 'index.php';
$backLabel = 'Back Home';
if (isset($_SESSION['user_id'])) {
    $backHref = $isAdminUser ? 'admin/dashboard.php' : 'dashboard.php';
    $backLabel = 'Back to Dashboard';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact & Feedback | Any2Convert</title>
    <meta name="description" content="Contact the Any2Convert team, submit feedback, report issues, and get support for the website and its local-first on-device tools.">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <link rel="canonical" href="https://any2convert.com/contact.php">
    <meta property="og:title" content="Contact & Feedback | Any2Convert">
    <meta property="og:description" content="Contact the Any2Convert team, submit feedback, report issues, and get support for the website and its local-first on-device tools.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="https://any2convert.com/contact.php">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Contact & Feedback | Any2Convert">
    <meta name="twitter:description" content="Contact the Any2Convert team, submit feedback, report issues, and get support for the website and its local-first on-device tools.">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="https://any2convert.com/contact.php">
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"ContactPage","name":"Contact Any2Convert","url":"https://any2convert.com/contact.php","description":"Contact the Any2Convert team, submit feedback, report issues, and get support.","isPartOf":{"@type":"WebSite","name":"Any2Convert","url":"https://any2convert.com/"}}</script>
    <script>
    tailwind.config = {
        darkMode: 'class'
    };
</script>
<script src="https://cdn.tailwindcss.com"></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GNWNK7QZTD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GNWNK7QZTD');
    </script>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-accent: radial-gradient(circle at 10% 10%, rgba(108,99,255,.18), transparent 24%), radial-gradient(circle at 86% 14%, rgba(34,211,238,.16), transparent 22%), radial-gradient(circle at 50% 0%, rgba(59,130,246,.12), transparent 36%), linear-gradient(180deg, #f8f8fc 0%, #eef3ff 100%);
            --panel-bg: rgba(255,255,255,.72);
            --panel-soft: rgba(241,244,255,.86);
            --panel-border: rgba(17,17,24,.08);
            --text-main: #111118;
            --text-soft: #626280;
            --nav-bg: rgba(255,255,255,.70);
            --nav-border: rgba(17,17,24,.08);
            --pill-bg: rgba(255,255,255,.84);
            --pill-text: #20253d;
            --glow: rgba(108,99,255,.16);
            --accent: #6c63ff;
            --green: #10b981;
            --border: rgba(17,17,24,.08);
            --bg-surface: rgba(255,255,255,.72);
            --text-muted: #626280;
        }
        html.dark {
            --bg-accent: radial-gradient(circle at 10% 10%, rgba(139,124,255,.24), transparent 24%), radial-gradient(circle at 86% 14%, rgba(103,232,249,.18), transparent 22%), radial-gradient(circle at 50% 0%, rgba(96,165,250,.14), transparent 36%), linear-gradient(180deg, #060816 0%, #0a1022 100%);
            --panel-bg: rgba(14,18,36,.70);
            --panel-soft: rgba(18,24,44,.92);
            --panel-border: rgba(255,255,255,.08);
            --text-main: #eef2ff;
            --text-soft: #a7afcf;
            --nav-bg: rgba(11,15,29,.84);
            --nav-border: rgba(255,255,255,.08);
            --pill-bg: rgba(16,21,41,.92);
            --pill-text: #eef2ff;
            --glow: rgba(96,165,250,.20);
            --accent: #8b7cff;
            --border: rgba(255,255,255,.08);
            --bg-surface: rgba(14,18,36,.70);
            --text-muted: #a7afcf;
        }
        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg-accent);
            color: var(--text-main);
        }
        .contact-shell { position: relative; }
        .contact-shell::before {
            content: '';
            position: absolute;
            inset: 0 auto auto 50%;
            width: 58rem;
            height: 18rem;
            transform: translateX(-50%);
            background: radial-gradient(circle, var(--glow) 0%, transparent 70%);
            filter: blur(24px);
            pointer-events: none;
            z-index: 0;
        }
        .panel {
            background: var(--panel-bg);
            backdrop-filter: blur(18px);
            border: 1px solid var(--panel-border);
            box-shadow: 0 24px 70px rgba(15,23,42,0.08);
        }
        .star-rating { direction: rtl; display: inline-flex; }
        .star-rating input { display: none; }
        .star-rating label { color: #cbd5e1; cursor: pointer; font-size: 2rem; transition: 0.2s; }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label { color: #f59e0b; }
        html.dark .bg-white,
        html.dark .bg-slate-50 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900,
        html.dark .text-slate-800 { color: var(--text-main) !important; }
        html.dark .text-slate-500,
        html.dark .text-slate-400,
        html.dark .text-slate-600 { color: var(--text-soft) !important; }
        html.dark .border-slate-100,
        html.dark .border-white,
        html.dark .border-blue-100 { border-color: var(--panel-border) !important; }
        html.dark .bg-blue-50 { background: rgba(37,99,235,0.18) !important; }
        html.dark .text-blue-800 { color: #dbeafe !important; }
        html.dark .text-blue-400 { color: #93c5fd !important; }
        html.dark input,
        html.dark textarea { background: rgba(15,23,42,0.92) !important; color: var(--text-main) !important; }
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body class="min-h-screen">
    <?php any2convertRenderTopbar([
        'home_href' => 'index.php',
        'links' => [
            ['href' => $backHref, 'label' => $backLabel],
        ],
        'badge' => 'Support',
    ]); ?>

    <main class="contact-shell">
        <div class="max-w-6xl mx-auto px-6 py-12 relative z-10">
            <div class="mb-10 text-center">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Support & Feedback</p>
                <h1 class="text-4xl font-black tracking-tight mt-3 text-slate-900">Talk to the Any2Convert team</h1>
                <p class="text-slate-500 mt-3 max-w-3xl mx-auto">Use this page to report bugs, ask for help with a tool, suggest improvements, or tell us where a workflow is confusing. The more specific your message is, the easier it is for us to reproduce and fix the issue.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1.15fr)_minmax(300px,0.85fr)] gap-12">
                <div class="panel p-8 md:p-12 rounded-[3rem] h-fit">
                    <h2 class="text-3xl font-black mb-2 text-slate-900 tracking-tight">Send Feedback</h2>
                    <p class="text-slate-400 mb-8 font-medium italic">Good support reports save time for everyone.</p>

                    <div class="mb-8 rounded-[2rem] border border-white/60 bg-white/70 px-5 py-5 text-left text-sm leading-7 text-slate-600">
                        <p class="font-bold text-slate-900 mb-2">Helpful things to include</p>
                        <ul class="list-disc pl-5 space-y-1">
                            <li>The exact tool page you used.</li>
                            <li>What file type you uploaded, if any.</li>
                            <li>What you expected to happen and what happened instead.</li>
                            <li>The exact error message if one appeared.</li>
                        </ul>
                    </div>

                    <form action="backend/contact_logic.php" method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="text" name="name" placeholder="Full Name" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                            <input type="email" name="email" placeholder="Email Address" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                        </div>

                        <div class="bg-slate-50 p-4 rounded-2xl text-center">
                            <p class="text-[10px] font-black uppercase text-slate-400 mb-2">Rate our Service</p>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5"><label for="star5">&#9733;</label>
                                <input type="radio" id="star4" name="rating" value="4"><label for="star4">&#9733;</label>
                                <input type="radio" id="star3" name="rating" value="3"><label for="star3">&#9733;</label>
                                <input type="radio" id="star2" name="rating" value="2"><label for="star2">&#9733;</label>
                                <input type="radio" id="star1" name="rating" value="1"><label for="star1">&#9733;</label>
                            </div>
                        </div>

                        <input type="text" name="subject" placeholder="Subject" required class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                        <textarea name="message" placeholder="Write your comment..." required rows="4" class="w-full p-4 bg-slate-50 rounded-2xl outline-none focus:ring-2 focus:ring-blue-500 font-medium"></textarea>

                        <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-3xl font-black text-lg hover:bg-slate-900 transition-all shadow-xl shadow-blue-100 uppercase tracking-tighter">
                            Submit Feedback
                        </button>
                    </form>
                </div>

                <div class="space-y-6">
                    <div class="panel p-8 rounded-[2.5rem]">
                        <h2 class="text-2xl font-black text-slate-900 mb-3">Support notes</h2>
                        <div class="space-y-3 text-slate-600 leading-relaxed">
                            <p>We read bug reports, account issues, tool suggestions, and conversion-quality feedback here. Support quality improves a lot when the report includes the tool name, file type, and the exact step where things failed.</p>
                            <p>If your message is about a broken conversion, include whether the issue happened before upload, during processing, or after download. That makes it easier to tell whether the problem is in the interface, browser processing, or a server-side conversion step.</p>
                            <p>We do not turn this page into a public comment feed. Support messages are reviewed manually, and only actionable issues are kept in our internal queue.</p>
                        </div>
                    </div>

                    <div class="panel p-8 rounded-[2.5rem]">
                        <h2 class="text-2xl font-black text-slate-900 mb-3">What happens after you send a message</h2>
                        <div class="space-y-3 text-slate-600 leading-relaxed">
                            <p>Bug reports and broken workflow messages are reviewed manually. Reports that include the exact tool name, file type, and error step are much easier to reproduce and usually move faster.</p>
                            <p>For conversion-quality issues, it helps to mention whether the input was a scan, an exported PDF, a photo, or an office file. That often changes the likely cause.</p>
                            <p>Feature requests are grouped by theme so we can prioritize what would genuinely improve the site instead of adding surface-level filler.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php any2convertRenderFooter(); ?>
    <?php any2convertRenderThemeScript(); ?>
</body>
</html>
