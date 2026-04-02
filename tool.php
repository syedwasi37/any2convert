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
];
$isWideTool = in_array($tool_id, $wideToolIds, true);

require_once 'backend/tool_handlers.php';
$tool_html = renderToolHandlerHTML($tool_id);

// Get the rest of index.css and navbar
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tool_data['title']) ?></title>
    <link rel="icon" type="image/png" href="mylogo.png">
    <meta name="description" content="<?= htmlspecialchars($tool_data['meta_desc']) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta property="og:title" content="<?= htmlspecialchars($tool_data['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($tool_data['meta_desc']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://any2convert.com/<?= htmlspecialchars($slug) ?>">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($tool_data['title']) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($tool_data['meta_desc']) ?>">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <link rel="canonical" href="https://any2convert.com/<?= htmlspecialchars($slug) ?>">

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
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebApplication",
      "name": "<?= htmlspecialchars($tool_data['h1']) ?>",
      "applicationCategory": "UtilitiesApplication",
      "operatingSystem": "All",
      "browserRequirements": "Requires HTML5 support",
      "offers": {
        "@type": "Offer",
        "price": "0"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        <?php foreach ($tool_data['faqs'] as $index => $faq): ?>
        {
          "@type": "Question",
          "name": "<?= htmlspecialchars($faq['q']) ?>",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "<?= htmlspecialchars($faq['a']) ?>"
          }
        }<?= $index < count($tool_data['faqs']) - 1 ? ',' : '' ?>
        <?php endforeach; ?>
      ]
    }
    </script>

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
        body { background-color: var(--bg-base); color: var(--text-primary); min-height: 100vh; }
        
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
        }
        .tool-container.tool-container-wide {
            max-width: 1180px;
            padding: 34px;
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
        
        .seo-content {
            max-width: 800px; margin: 40px auto;
            color: var(--text-secondary);
            line-height: 1.8;
            font-size: 1.05rem;
        }
        .seo-content h2 { color: var(--text-primary); font-size: 1.6rem; font-weight: 700; margin-top: 40px; margin-bottom: 20px; }
        .seo-content p { margin-bottom: 20px; }
        .faq-item { border-bottom: 1px solid var(--border); padding: 16px 0; }
        .faq-q { font-weight: 600; color: var(--text-primary); font-size: 1.1rem; margin-bottom: 8px; }

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
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }
        .tool-container input[type="file"]:focus,
        .tool-container input[type="text"]:focus,
        .tool-container input[type="number"]:focus,
        .tool-container select:focus,
        .tool-container textarea:focus {
            outline: none;
            border-color: var(--border-hover);
            box-shadow: 0 0 0 3px var(--accent-light);
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
            transition: transform 0.16s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .tool-container button:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 28px rgba(59, 130, 246, 0.3);
            filter: saturate(1.05);
        }
        .tool-container button:active {
            transform: translateY(0);
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

<header style="text-align:center; padding: 60px 20px 20px;">
    <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 12px;"><?= htmlspecialchars($tool_data['h1']) ?></h1>
    <p style="color: var(--text-secondary); font-size: 1.1rem;">Fast, secure, and powered locally in your browser.</p>
</header>

<main style="max-width: <?= $isWideTool ? '1280px' : '1000px' ?>; margin: 0 auto; padding: 0 20px;">
    <?= adsRenderPosition($conn, 'top_content') ?>
    <!-- TOOL INTERFACE -->
    <div class="tool-container<?= $isWideTool ? ' tool-container-wide' : '' ?>" id="modalContent">
        <?= $tool_html ?>
    </div>
    
    <!-- SEO CONTENT -->
    <div class="seo-content">
        <h2>What is this tool?</h2>
        <p><?= $tool_data['content'] ?></p>
        
        <h2>Why use Any2Convert?</h2>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
            <div style="border: 1px solid var(--border); padding: 20px; border-radius: 12px; background: var(--bg-card);">
                <strong style="color:var(--text-primary); font-size:1.1rem; display:block; margin-bottom:8px;">100% Privacy</strong>
                All operations execute using Javascript and WebAssembly right on your machine. Your files are not uploaded to our cloud servers.
            </div>
            <div style="border: 1px solid var(--border); padding: 20px; border-radius: 12px; background: var(--bg-card);">
                <strong style="color:var(--text-primary); font-size:1.1rem; display:block; margin-bottom:8px;">Unlimited Free Usage</strong>
                Enjoy lifetime free conversions. We do not enforce paid tiers, size limits, or watermarks on your generated files.
            </div>
        </div>
        
        <h2>Frequently Asked Questions</h2>
        <div class="faq-container">
            <?php foreach ($tool_data['faqs'] as $faq): ?>
            <div class="faq-item">
                <div class="faq-q"><?= htmlspecialchars($faq['q']) ?></div>
                <div class="faq-a"><?= htmlspecialchars($faq['a']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
<?= adsRenderPosition($conn, 'under_content') ?>

<?php any2convertRenderFooter(); ?>

<?= adsRenderPosition($conn, 'footer_sticky_bottom') ?>

<script>
const toolDependencyMap = {
    img_to_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"],
    protect_pdf: ["https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"]
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

