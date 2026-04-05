<?php
session_start();
require_once 'seo_data.php';
require_once 'backend/track_visit.php';
require_once 'backend/ad_helpers.php';
require_once __DIR__ . '/partials/site_chrome.php';

$slug = $_GET['slug'] ?? '';
$tool_data = $seo_tools[$slug] ?? null;

if (!$tool_data) {
    // 404
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>";
    echo "<a href='/'>Return Home</a>";
    exit;
}

$tool_id = $tool_data['id'];
trackVisit('Tool Page', $tool_id);

$wideToolIds = [
    'currency_converter',
    'length_converter',
    'weight_converter',
    'temperature_converter',
    'area_converter',
    'volume_converter',
    'speed_converter',
    'time_converter',
    'invoice_generator',
    'ats_resume_checker',
    'social_image_resizer',
    'jwt_decoder',
    'bank_statement_to_excel',
    'grammar_checker',
    'paraphrase_tool',
    'ppt_to_pdf',
    'sql_to_json',
    'percentage_calculator',
    'loan_calculator',
    'bmi_calculator',
    'age_calculator',
    'sensitivity_converter',
    'reaction_time_test',
    'cps_test',
    'gamer_tag_generator',
    'clip_to_gif',
    'tournament_bracket_generator',
    'spin_wheel',
    'random_name_picker',
    'typing_speed_test',
    'meme_caption_generator',
    'truth_or_dare_generator',
    'memory_match_game',
];
$isWideTool = in_array($tool_id, $wideToolIds, true);

require_once 'backend/tool_handlers.php';
$tool_html = renderToolHandlerHTML($tool_id);

$siteUrl = 'https://any2convert.com';
$toolUrl = $siteUrl . '/' . $slug;
$toolTitle = $tool_data['title'];
$toolDescription = $tool_data['meta_desc'];
$toolFaqs = $tool_data['faqs'] ?? [];

// Generate dynamic keywords for SEO from H1 and Title
$clean_h1 = preg_replace('/[^a-zA-Z0-9\s]/', '', strtolower($tool_data['h1'] . ' ' . $tool_data['title']));
$dynamic_keywords = implode(', ', array_unique(array_filter(explode(' ', $clean_h1), fn($w) => strlen($w) > 2))) . ', free, online, tool, any2convert';

$webPageSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => $tool_data['h1'],
    'url' => $toolUrl,
    'description' => $toolDescription,
    'isPartOf' => [
        '@type' => 'WebSite',
        'name' => 'Any2Convert',
        'url' => $siteUrl . '/',
    ],
    'breadcrumb' => [
        '@id' => $toolUrl . '#breadcrumb',
    ],
];
$softwareSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'SoftwareApplication',
    'name' => $tool_data['h1'],
    'applicationCategory' => 'UtilitiesApplication',
    'applicationSubCategory' => 'Online File and Utility Tool',
    'operatingSystem' => 'Web',
    'url' => $toolUrl,
    'description' => $toolDescription,
    'isAccessibleForFree' => true,
    'offers' => [
        '@type' => 'Offer',
        'price' => '0',
        'priceCurrency' => 'USD',
    ],
];
$breadcrumbSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    '@id' => $toolUrl . '#breadcrumb',
    'itemListElement' => [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Home',
            'item' => $siteUrl . '/',
        ],
        [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => $tool_data['h1'],
            'item' => $toolUrl,
        ],
    ],
];
$faqSchema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static function ($faq) {
        return [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a'],
            ],
        ];
    }, $toolFaqs),
];

// Get the rest of index.css and navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($toolTitle) ?></title>
    <link rel="icon" type="image/png" href="mylogo.png">
    <meta name="description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($dynamic_keywords) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <meta name="application-name" content="Any2Convert">
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta property="og:title" content="<?= htmlspecialchars($toolTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="<?= htmlspecialchars($toolUrl) ?>">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($toolTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($toolDescription) ?>">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="<?= htmlspecialchars($toolUrl) ?>">
    <link rel="canonical" href="<?= htmlspecialchars($toolUrl) ?>">

    <script>
    tailwind.config = {
        darkMode: 'class'
    };
</script>
<script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <!-- Schema Markup -->
    <script type="application/ld+json"><?= json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <script type="application/ld+json"><?= json_encode($softwareSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php if (!empty($toolFaqs)): ?>
    <script type="application/ld+json"><?= json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
    <?php endif; ?>

    <style>
        /* Shared Styles from index.php */
        :root {
            --bg-base:        #F8F8FC;
            --bg-surface:     #FFFFFF;
            --bg-card:        #FFFFFF;
            --bg-card-hover:  #F3F3FA;
            --border:         rgba(0,0,0,0.08);
            --border-hover:   rgba(108,99,255,0.35);
            --border-strong:  rgba(108,99,255,0.28);
            --text-primary:   #111118;
            --text-secondary: #464666;
            --text-muted:     #707096;
            --text-main:      #111118;
            --accent:         #6C63FF;
            --accent-light:   rgba(108,99,255,0.08);
            --accent-glow:    rgba(108,99,255,0.3);
            --nav-bg:         rgba(248,248,252,0.9);
            --nav-border:     rgba(0,0,0,0.08);
            --pill-bg:        rgba(255,255,255,0.86);
            --pill-text:      #20253d;
            --red:            #EF4444;
            --blue:           #3B82F6;
            --violet:         #8B5CF6;
            --green:          #10B981;
            --amber:          #F59E0B;
        }
        html.dark {
            --bg-base:        #0A0A0F;
            --bg-surface:     #111118;
            --bg-card:        #16161F;
            --bg-card-hover:  #1C1C28;
            --border:         rgba(255,255,255,0.07);
            --border-hover:   rgba(255,255,255,0.15);
            --border-strong:  rgba(96,165,250,0.35);
            --text-primary:   #F0F0F8;
            --text-secondary: #8B8BA7;
            --text-muted:     #4A4A62;
            --text-main:      #F0F0F8;
            --accent-light:   rgba(108,99,255,0.15);
            --accent-glow:    rgba(108,99,255,0.4);
            --nav-bg:         rgba(10,10,15,0.85);
            --nav-border:     rgba(255,255,255,0.07);
            --pill-bg:        rgba(22,22,31,0.96);
            --pill-text:      #F0F0F8;
        }
        * { font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            min-height: 100vh;
            animation: toolPageFade 0.6s cubic-bezier(.22,1,.36,1);
        }
        @keyframes toolPageFade {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .navbar { background: rgba(248,248,252,0.9); backdrop-filter: blur(20px); border-bottom: 1px solid var(--border); }
        html.dark .navbar { background: rgba(10,10,15,0.85); }
        .logo-text { font-weight: 700; font-size: 1.1rem; color: var(--text-primary); }
        .logo-dot { color: var(--accent); }
        .nav-pill { display: inline-flex; align-items: center; gap: 6px; padding: 7px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 500; color: var(--text-secondary); border: 1px solid transparent; text-decoration: none; }
        .nav-pill:hover { color: var(--text-primary); background: rgba(255,255,255,0.05); border-color: var(--border); }
        .btn-primary { display: inline-flex; align-items: center; gap: 8px; padding: 9px 20px; background: var(--accent); color: #fff; border-radius: 9px; font-size: 0.875rem; font-weight: 600; text-decoration:none; }
        .btn-primary:hover { background: #7B73FF; box-shadow: 0 8px 25px var(--accent-glow); }

        .tool-container {
            max-width: 800px;
            margin: 40px auto;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
            transition: transform 0.35s cubic-bezier(.22,1,.36,1), box-shadow 0.35s ease, border-color 0.28s ease;
        }
        .tool-container.tool-container-wide {
            max-width: 1180px;
            padding: 34px;
        }
        .tool-container::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background: linear-gradient(135deg, rgba(108,99,255,0.08), transparent 24%, transparent 68%, rgba(59,130,246,0.08));
            opacity: 0.9;
        }
        .tool-container > * {
            position: relative;
            z-index: 1;
        }
        .tool-container:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 58px rgba(15,23,42,0.12);
            border-color: var(--border-hover);
        }
        @media (max-width: 768px) {
            .tool-container {
                padding: 16px;
                margin: 18px auto;
                border-radius: 14px;
                box-shadow: 0 6px 18px rgba(0,0,0,0.04);
            }
            header h1 {
                font-size: 1.8rem !important;
                line-height: 1.25;
            }
            .seo-content {
                font-size: 0.98rem;
                line-height: 1.7;
            }
        }
        
        /* Shared tool form polish */
        .tool-container input[type="file"],
        .tool-container input[type="text"],
        .tool-container input[type="number"],
        .tool-container select,
        .tool-container textarea {
            width: 100%;
            background: var(--bg-surface);
            color: var(--text-primary);
            border: 1px solid var(--border);
            border-radius: 14px;
            transition: transform 0.24s cubic-bezier(.22,1,.36,1), border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }
        .tool-container input[type="file"]:focus,
        .tool-container input[type="text"]:focus,
        .tool-container input[type="number"]:focus,
        .tool-container select:focus,
        .tool-container textarea:focus {
            outline: none;
            border-color: var(--border-hover);
            box-shadow: 0 0 0 3px var(--accent-light);
            transform: translateY(-1px);
        }
        .tool-container input[type="file"] {
            padding: 10px;
            cursor: pointer;
        }
        .tool-container input[type="file"]::file-selector-button {
            margin-right: 12px;
            border: 0;
            border-radius: 10px;
            padding: 9px 14px;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, var(--accent), #7b73ff);
            cursor: pointer;
            transition: transform 0.16s ease, box-shadow 0.2s ease, opacity 0.2s ease;
            box-shadow: 0 8px 18px var(--accent-glow);
        }
        .tool-container input[type="file"]::file-selector-button:hover {
            transform: translateY(-1px);
            opacity: 0.95;
        }
        .tool-container button {
            letter-spacing: 0.01em;
            border-radius: 14px;
            box-shadow: 0 12px 22px rgba(59, 130, 246, 0.25);
            transition: transform 0.22s cubic-bezier(.22,1,.36,1), box-shadow 0.24s ease, filter 0.2s ease;
        }
        .tool-container button:hover {
            transform: translateY(-2px) scale(1.01);
            box-shadow: 0 18px 32px rgba(59, 130, 246, 0.28);
            filter: saturate(1.06);
        }
        .tool-container button:active {
            transform: translateY(0);
        }

        /* Bring newer wide tools closer to the homepage visual language in light mode */
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-950"] {
            background: linear-gradient(180deg, rgba(255,255,255,0.96), rgba(241,245,255,0.92)) !important;
            color: #0f172a !important;
            border-color: rgba(148,163,184,0.24) !important;
            box-shadow: 0 24px 60px rgba(15,23,42,0.10) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-900"] {
            background: linear-gradient(180deg, rgba(248,250,255,0.94), rgba(237,242,255,0.88)) !important;
            color: #0f172a !important;
            border-color: rgba(148,163,184,0.24) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/5"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/10"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/[0.03]"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/[0.05]"] {
            background: rgba(255,255,255,0.78) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="from-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="from-slate-900"],
        html:not(.dark) .tool-container.tool-container-wide [class*="via-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="via-slate-900"],
        html:not(.dark) .tool-container.tool-container-wide [class*="to-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="to-slate-900"] {
            --tw-gradient-from: rgba(255,255,255,0.98) var(--tw-gradient-from-position) !important;
            --tw-gradient-via: rgba(244,247,255,0.94) var(--tw-gradient-via-position) !important;
            --tw-gradient-to: rgba(234,240,255,0.9) var(--tw-gradient-to-position) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-gradient-to-br"][class*="dark:from-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-gradient-to-br"][class*="dark:from-slate-900"] {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(243,247,255,0.96) 54%, rgba(231,244,255,0.92) 100%) !important;
            border-color: rgba(186,205,255,0.5) !important;
            box-shadow: 0 24px 68px rgba(15,23,42,0.08), inset 0 1px 0 rgba(255,255,255,0.8) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/92"][class*="dark:bg-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/85"][class*="dark:bg-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/80"][class*="dark:bg-slate-950"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-white/75"][class*="dark:bg-slate-950"] {
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,249,255,0.94)) !important;
            border-color: rgba(186,205,255,0.42) !important;
            box-shadow: 0 18px 44px rgba(15,23,42,0.06), inset 0 1px 0 rgba(255,255,255,0.76) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-950"][class*="text-white"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-900"][class*="text-white"] {
            background: linear-gradient(180deg, rgba(255,255,255,0.97), rgba(241,246,255,0.93)) !important;
            color: #0f172a !important;
            border-color: rgba(186,205,255,0.42) !important;
            box-shadow: 0 20px 44px rgba(15,23,42,0.08) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="text-white"] {
            color: #0f172a !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="text-slate-300"],
        html:not(.dark) .tool-container.tool-container-wide [class*="text-slate-400"] {
            color: #64748b !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="border-white/10"] {
            border-color: rgba(148,163,184,0.24) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide pre[class*="bg-slate-950"] {
            background: linear-gradient(180deg, rgba(244,247,255,0.98), rgba(233,239,252,0.94)) !important;
            border-color: rgba(148,163,184,0.24) !important;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7), 0 16px 30px rgba(15,23,42,0.08) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-50/85"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-50/80"],
        html:not(.dark) .tool-container.tool-container-wide [class*="bg-slate-50"] {
            background: linear-gradient(180deg, rgba(255,255,255,0.95), rgba(246,248,255,0.9)) !important;
        }
        html:not(.dark) .tool-container.tool-container-wide [class*="shadow-black/20"] {
            box-shadow: 0 24px 60px rgba(15,23,42,0.08) !important;
        }

        /* Premium polish layer for the newer wide tools */
        .tool-container.tool-container-wide {
            background:
                radial-gradient(circle at top left, rgba(108,99,255,0.12), transparent 22%),
                radial-gradient(circle at top right, rgba(59,130,246,0.10), transparent 20%),
                linear-gradient(180deg, rgba(255,255,255,0.82), rgba(248,250,255,0.74));
        }
        html.dark .tool-container.tool-container-wide {
            background:
                radial-gradient(circle at top left, rgba(108,99,255,0.12), transparent 22%),
                radial-gradient(circle at top right, rgba(59,130,246,0.10), transparent 20%),
                linear-gradient(180deg, rgba(15,23,42,0.78), rgba(2,6,23,0.92));
        }
        .tool-container.tool-container-wide > div[class*="max-w-"] {
            gap: 1.5rem !important;
        }
        .tool-container.tool-container-wide :is(
            div[class*="rounded-[34px]"],
            div[class*="rounded-[32px]"],
            div[class*="rounded-[28px]"],
            div[class*="rounded-[24px]"],
            label[class*="rounded-[28px]"],
            label[class*="rounded-[24px]"]
        ) {
            backdrop-filter: blur(18px);
            transition: transform 0.28s cubic-bezier(.22,1,.36,1), box-shadow 0.28s ease, border-color 0.24s ease, background 0.24s ease;
        }
        .tool-container.tool-container-wide :is(
            div[class*="rounded-[34px]"],
            div[class*="rounded-[32px]"],
            div[class*="rounded-[28px]"]
        ):hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 54px rgba(15,23,42,0.12);
        }
        html.dark .tool-container.tool-container-wide :is(
            div[class*="rounded-[34px]"],
            div[class*="rounded-[32px]"],
            div[class*="rounded-[28px]"]
        ):hover {
            box-shadow: 0 26px 56px rgba(2,6,23,0.38);
        }
        .tool-container.tool-container-wide h2,
        .tool-container.tool-container-wide h3 {
            letter-spacing: -0.03em;
        }
        .tool-container.tool-container-wide p[class*="tracking-[0.34em]"],
        .tool-container.tool-container-wide p[class*="tracking-[0.3em]"],
        .tool-container.tool-container-wide p[class*="tracking-[0.28em]"] {
            opacity: 0.98;
        }
        .tool-container.tool-container-wide :is(input, select, textarea) {
            min-height: 54px;
            border-radius: 20px !important;
        }
        .tool-container.tool-container-wide textarea {
            line-height: 1.65;
        }
        .tool-container.tool-container-wide button {
            min-height: 52px;
            font-weight: 700;
        }
        .tool-container.tool-container-wide button[id*="Start"],
        .tool-container.tool-container-wide button[id*="Analyze"],
        .tool-container.tool-container-wide button[id*="Generate"],
        .tool-container.tool-container-wide button[id*="Resize"],
        .tool-container.tool-container-wide button[id*="Download"],
        .tool-container.tool-container-wide button[id*="Extract"],
        .tool-container.tool-container-wide button[id*="Decode"] {
            box-shadow: 0 18px 34px rgba(59,130,246,0.18);
        }
        .tool-container.tool-container-wide pre {
            border-radius: 26px;
            border: 1px solid rgba(148,163,184,0.18);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.04);
        }
        .tool-container.tool-container-wide canvas,
        .tool-container.tool-container-wide video,
        .tool-container.tool-container-wide audio,
        .tool-container.tool-container-wide img {
            border-radius: 24px;
        }
        .tool-container.tool-container-wide table {
            overflow: hidden;
            border-collapse: separate;
            border-spacing: 0;
        }
        .tool-container.tool-container-wide tbody tr {
            transition: background 0.22s ease;
        }
        .tool-container.tool-container-wide tbody tr:hover {
            background: rgba(108,99,255,0.05);
        }
        .tool-container.tool-container-wide [id*="Status"],
        .tool-container.tool-container-wide [id*="status"] {
            font-weight: 500;
        }
        .tool-container.tool-container-wide [id*="Result"],
        .tool-container.tool-container-wide [id*="result"],
        .tool-container.tool-container-wide [id*="Score"],
        .tool-container.tool-container-wide [id*="score"] {
            text-wrap: balance;
        }
        @media (max-width: 768px) {
            .tool-container.tool-container-wide {
                background:
                    radial-gradient(circle at top center, rgba(108,99,255,0.10), transparent 24%),
                    linear-gradient(180deg, rgba(255,255,255,0.88), rgba(248,250,255,0.78));
            }
            html.dark .tool-container.tool-container-wide {
                background:
                    radial-gradient(circle at top center, rgba(108,99,255,0.10), transparent 24%),
                    linear-gradient(180deg, rgba(15,23,42,0.82), rgba(2,6,23,0.94));
            }
            .tool-container.tool-container-wide :is(
                div[class*="rounded-[34px]"],
                div[class*="rounded-[32px]"],
                div[class*="rounded-[28px]"],
                label[class*="rounded-[28px]"],
                label[class*="rounded-[24px]"]
            ) {
                border-radius: 24px !important;
            }
        }

        /* Need these libraries depending on tool */
    </style>
    <?php any2convertRenderChromeStyles(); ?>
</head>
<body>
<?= adsRenderPosition($conn, 'header') ?>

<?php
$isAdminUser = isset($_SESSION['email']) && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com';
$dashboardHref = $isAdminUser ? 'admin/dashboard.php' : 'dashboard.php';
$toolTopbarCta = '';
if (isset($_SESSION['user_name'])) {
    $toolTopbarCta = '<a href="' . htmlspecialchars($dashboardHref, ENT_QUOTES) . '" class="site-nav-pill">Dashboard</a>';
} else {
    $toolTopbarCta = '<a href="login.php" class="site-nav-pill">Sign in</a><a href="signup.php" class="btn-primary" style="text-decoration:none;font-size:0.84rem;padding:9px 18px;border-radius:999px;">Get started</a>';
}
?>
<?php any2convertRenderTopbar([
    'home_href' => 'index.php',
    'cta_html' => $toolTopbarCta,
]); ?>

<header class="text-center pt-16 pb-10 px-6">
    <h1 class="text-4xl md:text-5xl font-black text-slate-900 dark:text-white mb-4 tracking-tight"><?= htmlspecialchars($tool_data['h1']) ?></h1>
    <p class="text-lg text-slate-500 dark:text-slate-400">Fast, secure, and powered locally in your browser.</p>
</header>

<main class="mx-auto px-6 pb-20" style="max-width: <?= $isWideTool ? '1280px' : '1000px' ?>;">
    <?= adsRenderPosition($conn, 'top_content') ?>
    <!-- TOOL INTERFACE -->
    <div class="tool-container<?= $isWideTool ? ' tool-container-wide' : '' ?>" id="modalContent">
        <?= $tool_html ?>
    </div>
    
    <!-- SEO CONTENT -->
    <div class="max-w-4xl mx-auto mt-20 text-slate-600 dark:text-slate-400 text-lg leading-relaxed space-y-6">
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">What is this tool?</h2>
        <p><?= $tool_data['content'] ?></p>
        
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-12">Why use Any2Convert?</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <strong class="block text-lg text-slate-900 dark:text-white mb-2">100% Privacy</strong>
                All operations execute using Javascript and WebAssembly right on your machine. Your files are not uploaded to our cloud servers.
            </div>
            <div class="p-6 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm">
                <strong class="block text-lg text-slate-900 dark:text-white mb-2">Unlimited Free Usage</strong>
                Enjoy lifetime free conversions. We do not enforce paid tiers, size limits, or watermarks on your generated files.
            </div>
        </div>
        
        <h2 class="text-2xl font-bold text-slate-900 dark:text-white mt-12">Frequently Asked Questions</h2>
        <div class="space-y-4 mt-6">
            <?php foreach ($tool_data['faqs'] as $faq): ?>
            <div class="p-5 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700">
                <div class="font-bold text-slate-900 dark:text-white text-lg mb-2"><?= htmlspecialchars($faq['q']) ?></div>
                <div class="text-base"><?= htmlspecialchars($faq['a']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Read Full Guide CTA (Internal Blog Link) -->
        <div class="mt-12 p-8 bg-blue-50 dark:bg-blue-900/20 rounded-[2rem] border border-blue-100 dark:border-blue-800 text-center">
            <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-3">Want to learn more?</h3>
            <p class="text-blue-700 dark:text-blue-300 mb-6 max-w-2xl mx-auto text-base">Read our comprehensive guide and step-by-step tutorial on how to get the most out of <?= htmlspecialchars($tool_data['title']) ?>.</p>
            <a href="blog/guide.php?slug=<?= urlencode($slug) ?>" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 dark:shadow-none text-base">Read the Full Guide</a>
        </div>
        
        <!-- SEO Tags / Keywords -->
        <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800">
            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Related Keywords</h3>
            <div class="flex flex-wrap gap-2">
                <?php foreach (array_slice(explode(',', $dynamic_keywords), 0, 10) as $tag): ?>
                    <span class="px-4 py-2 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm capitalize hover:text-blue-600 dark:hover:text-blue-400 transition cursor-default border border-slate-200 dark:border-slate-700"><?= htmlspecialchars(trim($tag)) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?= adsRenderPosition($conn, 'under_content') ?>

<?php any2convertRenderFooter(); ?>

<?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>

<script>
const toolDependencyMap = {
    img_to_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"],
    protect_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"],
    bank_statement_to_excel: [
        "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js",
        "https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"
    ],
};

function loadScriptOnce(src) {
    window.__any2convertLoadedScripts = window.__any2convertLoadedScripts || {};
    if (window.__any2convertLoadedScripts[src]) {
        return window.__any2convertLoadedScripts[src];
    }
    window.__any2convertLoadedScripts[src] = new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = false;
        script.dataset.src = src;
        script.onload = () => {
            if (src.includes('/pdf.js/')) {
                window.pdfjsLib && (window.pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js");
            }
            resolve();
        };
        script.onerror = () => reject(new Error('Failed to load required library.'));
        document.body.appendChild(script);
    });
    return window.__any2convertLoadedScripts[src];
}

function ensureToolDependencies(toolId) {
    const dependencies = toolDependencyMap[toolId] || [];
    return Promise.all(dependencies.map(loadScriptOnce));
}

window.any2convertLeaderboard = {
    escape(value) {
        return String(value ?? '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    },
    async fetch(toolKey) {
        const response = await fetch(`backend/leaderboard.php?tool=${encodeURIComponent(toolKey)}`, {
            credentials: 'same-origin'
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.error || 'Could not load leaderboard.');
        }
        return data;
    },
    async save(toolKey, payload) {
        const response = await fetch('backend/save_leaderboard_score.php', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ tool: toolKey, ...payload })
        });
        const data = await response.json().catch(() => ({}));
        if (!response.ok) {
            throw new Error(data.error || 'Could not save leaderboard score.');
        }
        return data;
    },
    render(container, data, options = {}) {
        if (!container) return;
        const emptyText = options.emptyText || 'No scores yet. Be the first to set one.';
        const loginText = options.loginText || 'Log in to save your result on the public leaderboard.';
        const entries = Array.isArray(data?.entries) ? data.entries : [];

        if (!entries.length) {
            container.innerHTML = `
                <div class="rounded-2xl border border-dashed border-slate-200 dark:border-slate-800 px-4 py-5 text-sm text-slate-500 dark:text-slate-400">
                    ${this.escape(emptyText)}
                    <div class="mt-2 text-xs uppercase tracking-[0.18em] ${data?.authenticated ? 'text-emerald-500 dark:text-emerald-300' : 'text-slate-400'}">
                        ${this.escape(data?.authenticated ? 'Your next strong run can take the top spot.' : loginText)}
                    </div>
                </div>
            `;
            return;
        }

        container.innerHTML = entries.map((entry) => `
            <div class="flex items-start justify-between gap-3 rounded-2xl border border-slate-200/80 dark:border-slate-800 bg-white/80 dark:bg-slate-900/70 px-4 py-3">
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex h-7 w-7 items-center justify-center rounded-full bg-slate-900 text-xs font-black text-white dark:bg-white dark:text-slate-900">${entry.rank}</span>
                        <span class="truncate text-sm font-bold text-slate-900 dark:text-white">${this.escape(entry.display_name)}</span>
                    </div>
                    ${entry.score_meta ? `<div class="mt-2 text-xs text-slate-500 dark:text-slate-400">${this.escape(entry.score_meta)}</div>` : ''}
                </div>
                <div class="shrink-0 text-right">
                    <div class="text-sm font-black text-slate-900 dark:text-white">${this.escape(entry.score_label)}</div>
                </div>
            </div>
        `).join('');
    }
};


// Ensure dynamic javascript returned by backend actually executes
async function executeScripts(container) {
    document.querySelectorAll('script[data-dynamic-tool-script="1"]').forEach(script => script.remove());
    const scripts = Array.from(container.querySelectorAll('script'));

    for (const oldScript of scripts) {
        const newScript = document.createElement('script');
        newScript.dataset.dynamicToolScript = '1';

        if (oldScript.src) {
            await new Promise((resolve, reject) => {
                newScript.src = oldScript.src;
                newScript.async = false;
                newScript.onload = resolve;
                newScript.onerror = () => reject(new Error(`Failed to load script: ${oldScript.src}`));
                oldScript.parentNode.removeChild(oldScript);
                document.body.appendChild(newScript);
            });
        } else {
            newScript.textContent = oldScript.textContent;
            oldScript.parentNode.removeChild(oldScript);
            document.body.appendChild(newScript);
        }
    }
}

// On load, execute scripts inside modalContent
document.addEventListener('DOMContentLoaded', () => {
    ensureToolDependencies(<?= json_encode($tool_id) ?>).then(() => {
        executeScripts(document.getElementById('modalContent'));
    }).catch(() => {
        document.getElementById('modalContent').innerHTML = '<div style="padding:24px;text-align:center;color:#ef4444;">A required tool library could not be loaded.</div>';
    });
});
</script>
<?php any2convertRenderThemeScript(); ?>
</body>
</html>
