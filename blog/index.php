<?php
require_once __DIR__ . '/../backend/track_visit.php';
trackVisit('Blog Index Page');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog | Any2Convert</title>
    <meta name="description" content="Read focused Any2Convert articles about privacy, QR codes, and practical document workflows.">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="theme-color" content="#3B82F6">
    <meta name="application-name" content="Any2Convert">
    <link rel="canonical" href="https://any2convert.com/blog/">
    <meta property="og:title" content="Blog | Any2Convert">
    <meta property="og:description" content="Read focused Any2Convert articles about privacy, QR codes, and practical document workflows.">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Any2Convert">
    <meta property="og:url" content="https://any2convert.com/blog/">
    <meta property="og:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Blog | Any2Convert">
    <meta name="twitter:description" content="Read focused Any2Convert articles about privacy, QR codes, and practical document workflows.">
    <meta name="twitter:image" content="https://any2convert.com/mylogo.png">
    <meta name="twitter:url" content="https://any2convert.com/blog/">
    <script type="application/ld+json">{"@context":"https://schema.org","@type":"CollectionPage","name":"Any2Convert Blog","url":"https://any2convert.com/blog/","description":"Focused articles about privacy, QR codes, and practical document workflows.","isPartOf":{"@type":"WebSite","name":"Any2Convert","url":"https://any2convert.com/"}}</script>
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <style>
        :root { --bg-accent: radial-gradient(circle at top, #dbeafe 0%, #f8fafc 35%, #eef2ff 100%); --panel-bg: rgba(255,255,255,0.92); --panel-soft:#f8fafc; --panel-border: rgba(148,163,184,0.16); --text-main:#0f172a; --text-soft:#64748b; --nav-bg:rgba(255,255,255,0.72); --nav-border:rgba(148,163,184,0.14); --pill-bg:rgba(255,255,255,0.86); --pill-text:#334155; --glow:rgba(59,130,246,0.16);}
        html.dark { --bg-accent: radial-gradient(circle at top, #1d4ed8 0%, #0f172a 32%, #020617 100%); --panel-bg: rgba(15,23,42,0.82); --panel-soft: rgba(15,23,42,0.92); --panel-border: rgba(148,163,184,0.16); --text-main:#e2e8f0; --text-soft:#94a3b8; --nav-bg:rgba(2,6,23,0.76); --nav-border:rgba(148,163,184,0.16); --pill-bg:rgba(15,23,42,0.92); --pill-text:#cbd5e1; --glow:rgba(96,165,250,0.18); }
        body { font-family: 'DM Sans', sans-serif; background: var(--bg-accent); color: var(--text-main); }
        .page-shell { position: relative; }
        .page-shell::before { content:''; position:absolute; inset:0 auto auto 50%; width:64rem; height:22rem; transform:translateX(-50%); background:radial-gradient(circle, var(--glow) 0%, transparent 70%); filter:blur(24px); pointer-events:none; z-index:0; }
        .topbar { position: sticky; top:0; z-index:40; backdrop-filter:blur(18px); background:var(--nav-bg); border-bottom:1px solid var(--nav-border); }
        .nav-pill, .theme-toggle { display:inline-flex; align-items:center; justify-content:center; gap:8px; padding:10px 16px; border-radius:999px; background:var(--pill-bg); color:var(--pill-text); border:1px solid var(--panel-border); font-weight:700; font-size:.88rem; text-decoration:none; }
        .theme-toggle { width:46px; height:46px; padding:0; }
        .panel { background: var(--panel-bg); backdrop-filter: blur(18px); border: 1px solid var(--panel-border); box-shadow: 0 24px 70px rgba(15,23,42,0.08); }
        html.dark .bg-white, html.dark .bg-slate-50, html.dark .bg-white\/70 { background: var(--panel-soft) !important; }
        html.dark .text-slate-900, html.dark .text-slate-800, html.dark .text-slate-700 { color: var(--text-main) !important; }
        html.dark .text-slate-500, html.dark .text-slate-400, html.dark .text-slate-600 { color: var(--text-soft) !important; }
        html.dark [class*='border-[var(--panel-border)]'] { border-color: var(--panel-border) !important; }
    </style>
</head>
<body class="min-h-screen">
    <nav class="topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <a href="../index.php" class="text-2xl font-extrabold text-blue-600 tracking-tighter italic">ANY2CONVERT</a>
            <div class="flex flex-wrap items-center gap-3">
                <a href="../index.php" class="nav-pill">Home</a>
                <a href="../contact.php" class="nav-pill">Support</a>
                <button type="button" id="themeToggle" class="theme-toggle" aria-label="Toggle theme"></button>
            </div>
        </div>
    </nav>

    <main class="page-shell">
        <div class="max-w-6xl mx-auto px-6 py-12 relative z-10">
            <section class="mb-10">
                <p class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Blog</p>
                <h1 class="text-4xl md:text-5xl font-black tracking-tight mt-4 text-slate-900">Guides, tips, and practical help</h1>
                <p class="text-slate-500 mt-4 max-w-3xl">Read focused articles about privacy, QR codes, and practical file workflows. We are intentionally trimming generic, auto-generated pages so the blog stays useful instead of turning into filler.</p>
            </section>

            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="security-benefits.php" class="panel rounded-[2.5rem] p-8 block hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center mb-5">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Tech Insights</p>
                    <h2 class="text-2xl font-black text-slate-900 mt-3">Why Converting Images to PDF is Better for Security</h2>
                    <p class="text-slate-500 mt-4 leading-7">Understand why PDFs are usually a safer format for sharing sensitive image-based documents and how browser-side conversion improves privacy even more.</p>
                    <div class="mt-6 text-blue-600 font-bold">Read article</div>
                </a>

                <a href="qr-guide.php" class="panel rounded-[2.5rem] p-8 block hover:-translate-y-1 transition-transform">
                    <div class="w-12 h-12 rounded-2xl bg-violet-50 text-violet-500 flex items-center justify-center mb-5">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="3" height="3"/></svg>
                    </div>
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Business Guide</p>
                    <h2 class="text-2xl font-black text-slate-900 mt-3">How to Create High-Quality QR Codes for Business</h2>
                    <p class="text-slate-500 mt-4 leading-7">Learn the basics of clean QR code design, print-friendly output, and practical steps that help your codes scan more reliably in the real world.</p>
                    <div class="mt-6 text-blue-600 font-bold">Read article</div>
                </a>
            </section>
        </div>
    </main>
    <footer style="border-top:1px solid var(--border);background:var(--bg-surface);">
    <div style="max-width:1280px;margin:0 auto;padding:48px 20px 32px;">

        <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px;" class="footer-grid">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                    <div style="width:28px;height:28px;background:var(--accent);border-radius:7px;display:flex;align-items:center;justify-content:center;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <span style="font-weight:700;font-size:0.95rem;color:var(--text-primary);">Any2Convert</span>
                </div>
                <p style="font-size:0.8rem;color:var(--text-muted);line-height:1.7;max-width:220px;">Free online tools with local on-device processing, cleaner workflows, and privacy-first defaults.</p>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Tools</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="/image-to-pdf" class="footer-link">Image to PDF</a>
                    <a href="/pdf-to-word" class="footer-link">PDF to Word</a>
                    <a href="/merge-pdf" class="footer-link">Merge PDF</a>
                    <a href="/ocr-image-to-text" class="footer-link">OCR Tool</a>
                </div>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Company</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="about.php" class="footer-link">About</a>
                    <a href="contact.php" class="footer-link">Contact</a>
                    <a href="privacy.php" class="footer-link">Privacy Policy</a>
                    <a href="terms.php" class="footer-link">Terms</a>
                </div>
            </div>

            <div>
                <div style="font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:var(--text-muted);margin-bottom:14px;">Resources</div>
                <div style="display:flex;flex-direction:column;gap:9px;">
                    <a href="blog/index.php" class="footer-link">Blog</a>
                </div>
            </div>
        </div>

        <div style="border-top:1px solid var(--border);padding-top:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
            <span style="font-size:0.78rem;color:var(--text-muted);">&copy; <?= date('Y') ?> Any2Convert. All rights reserved. Made with love in Karachi, Pakistan.</span>
            <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;color:var(--text-muted);">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Local-first processing on your device
            </div>
        </div>

    </div>
</footer>
    <script>
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') document.documentElement.classList.add('dark');
        const themeToggle = document.getElementById('themeToggle');
        const moonIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';
        const sunIcon = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"/><path d="M12 1v2"/><path d="M12 21v2"/><path d="M4.22 4.22l1.42 1.42"/><path d="M18.36 18.36l1.42 1.42"/><path d="M1 12h2"/><path d="M21 12h2"/><path d="M4.22 19.78l1.42-1.42"/><path d="M18.36 5.64l1.42-1.42"/></svg>';
        const applyThemeLabel = () => { themeToggle.innerHTML = document.documentElement.classList.contains('dark') ? sunIcon : moonIcon; };
        applyThemeLabel();
        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
            applyThemeLabel();
        });
    </script>
    <style>
@media(max-width:768px){
    .footer-grid { grid-template-columns: 1fr 1fr !important; }
}
@media(max-width:480px){
    .footer-grid { grid-template-columns: 1fr !important; }
}
</style>
</body>
</html>
