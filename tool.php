<?php
session_start();
require_once 'seo_data.php';
require_once 'backend/track_visit.php';
require_once 'backend/ad_helpers.php';

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
            --text-primary:   #111118;
            --text-secondary: #464666;
            --text-muted:     #707096;
            --accent:         #6C63FF;
            --accent-light:   rgba(108,99,255,0.08);
            --accent-glow:    rgba(108,99,255,0.3);
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
            --text-primary:   #F0F0F8;
            --text-secondary: #8B8BA7;
            --text-muted:     #4A4A62;
            --accent-light:   rgba(108,99,255,0.15);
            --accent-glow:    rgba(108,99,255,0.4);
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
</head>
<body>
<?= adsRenderPosition($conn, 'header') ?>

<?php
$isAdminUser = isset($_SESSION['email']) && $_SESSION['email'] === 'syedwasiulhassanshah@any2convert.com';
$dashboardHref = $isAdminUser ? 'admin/dashboard.php' : 'dashboard.php';
?>

<nav class="navbar sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-15 py-3">
        <a href="/" style="text-decoration:none" class="flex items-center gap-2">
            <div style="width:30px;height:30px;background:var(--accent);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="8" y1="13" x2="16" y2="13"/><line x1="8" y1="17" x2="13" y2="17"/>
                </svg>
            </div>
            <span class="logo-text">Any2Convert<span class="logo-dot">.</span></span>
        </a>
        <div class="flex items-center gap-2">
			<!-- Dark Mode Toggle -->
            <button id="themeToggle" onclick="toggleDarkMode()" title="Toggle dark mode" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:transparent;border:1px solid var(--border);color:var(--text-secondary);cursor:pointer;flex-shrink:0;">
                <svg id="iconMoon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                <svg id="iconSun" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
            </button>
            <?php if (isset($_SESSION['user_name'])): ?>
                <a href="<?= htmlspecialchars($dashboardHref) ?>" class="nav-pill">Dashboard</a>
            <?php else: ?>
                <a href="login.php" class="nav-pill">Sign in</a>
                <a href="signup.php" class="btn-primary">Get started</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<header style="text-align:center; padding: 60px 20px 20px;">
    <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--text-primary); margin-bottom: 12px;"><?= htmlspecialchars($tool_data['h1']) ?></h1>
    <p style="color: var(--text-secondary); font-size: 1.1rem;">Fast, secure, and powered locally in your browser.</p>
</header>

<main style="max-width: 1000px; margin: 0 auto; padding: 0 20px;">
    <?= adsRenderPosition($conn, 'top_content') ?>
    <!-- TOOL INTERFACE -->
    <div class="tool-container" id="modalContent">
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

<footer style="border-top:1px solid var(--border); background:var(--bg-surface); padding: 40px 20px; text-align:center; margin-top: 60px;">
    <p style="color:var(--text-muted); font-size: 0.9rem;">© <?= date('Y') ?> Any2Convert. All rights reserved.</p>
</footer>
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

function toggleDarkMode() {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    document.getElementById('iconMoon').style.display = isDark ? 'none'  : '';
    document.getElementById('iconSun').style.display  = isDark ? ''      : 'none';
}
(function(){
    const saved = localStorage.getItem('theme');
    if (saved === 'dark') {
        document.documentElement.classList.add('dark');
        document.getElementById('iconMoon').style.display = 'none';
        document.getElementById('iconSun').style.display  = '';
    }
})();

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
</body>
</html>
