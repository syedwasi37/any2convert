<?php

function any2convertRenderChromeStyles(): void
{
    ?>
    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            animation: siteFadeIn 0.55s cubic-bezier(.22,1,.36,1);
        }
        @keyframes siteFadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes chromeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-2px); }
        }
        @keyframes softPulse {
            0%, 100% { box-shadow: 0 12px 24px rgba(108,99,255,.24); }
            50% { box-shadow: 0 18px 34px rgba(108,99,255,.34); }
        }
        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: transform 0.32s cubic-bezier(.22,1,.36,1), filter 0.28s ease;
        }
        .brand-mark:hover {
            transform: translateY(-1px) scale(1.01);
            filter: saturate(1.08);
        }
        .brand-icon {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--accent, #6c63ff);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 12px 24px rgba(108,99,255,.24);
            animation: chromeFloat 4.2s ease-in-out infinite, softPulse 4.2s ease-in-out infinite;
            transition: transform 0.32s cubic-bezier(.22,1,.36,1), box-shadow 0.28s ease;
        }
        .brand-mark:hover .brand-icon {
            transform: rotate(-4deg) scale(1.04);
        }
        .brand-text {
            font-weight: 700;
            font-size: 1.05rem;
            letter-spacing: -0.02em;
            color: var(--text, var(--text-main, var(--text-primary, #111118)));
            transition: letter-spacing 0.28s ease, transform 0.28s ease;
        }
        .brand-mark:hover .brand-text {
            letter-spacing: -0.025em;
            transform: translateX(1px);
        }
        .brand-dot { color: var(--accent, #6c63ff); }
        .site-topbar {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(18px);
            background: var(--nav-bg, color-mix(in srgb, var(--panel-strong, rgba(255,255,255,.88)) 84%, transparent));
            border-bottom: 1px solid var(--nav-border, var(--border, rgba(17,17,24,.08)));
            transition: background 0.28s ease, border-color 0.28s ease, box-shadow 0.28s ease;
        }
        .site-nav-pill,
        .site-theme-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border-radius: 999px;
            border: 1px solid var(--panel-border, var(--border, rgba(17,17,24,.08)));
            background: var(--pill-bg, var(--bg-soft, color-mix(in srgb, var(--panel-strong, rgba(255,255,255,.9)) 92%, transparent)));
            color: var(--pill-text, var(--text, var(--text-main, var(--text-primary, #111118))));
            text-decoration: none;
            font-weight: 700;
            font-size: 0.88rem;
            transition: transform 0.32s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, background 0.24s ease, color 0.24s ease, box-shadow 0.24s ease;
        }
        .site-nav-pill {
            padding: 10px 16px;
        }
        .site-nav-pill:hover,
        .site-theme-toggle:hover {
            transform: translateY(-2px) scale(1.01);
            border-color: var(--border-strong, var(--panel-border, var(--border, rgba(17,17,24,.08))));
            box-shadow: 0 14px 28px rgba(15,23,42,.08);
        }
        .site-theme-toggle {
            width: 46px;
            height: 46px;
            padding: 0;
            cursor: pointer;
        }
        .site-theme-toggle svg {
            width: 18px;
            height: 18px;
        }
        .site-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid var(--panel-border, var(--border, rgba(17,17,24,.08)));
            background: color-mix(in srgb, var(--pill-bg, var(--bg-soft, rgba(255,255,255,.84))) 88%, transparent);
            color: var(--accent, #6c63ff);
            font-size: 0.72rem;
            font-weight: 900;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            transition: transform 0.3s cubic-bezier(.22,1,.36,1), border-color 0.24s ease, background 0.24s ease;
        }
        .site-badge:hover {
            transform: translateY(-2px);
        }
        .site-footer {
            border-top: 1px solid var(--panel-border, var(--border, rgba(17,17,24,.08)));
            background: var(--bg-surface, var(--panel-bg, var(--panel, rgba(255,255,255,.72))));
            transition: background 0.28s ease, border-color 0.28s ease;
        }
        .site-footer-link {
            color: var(--muted, var(--text-muted, var(--text-soft, #626280)));
            font-size: 0.82rem;
            text-decoration: none;
            transition: color 0.22s ease, transform 0.28s cubic-bezier(.22,1,.36,1);
        }
        .site-footer-link:hover {
            color: var(--text, var(--text-main, var(--text-primary, #111118)));
            transform: translateX(3px);
        }
        [data-motion-reveal] {
            opacity: 0;
            transform: translateY(18px) scale(.985);
            transition: opacity 0.55s cubic-bezier(.22,1,.36,1), transform 0.55s cubic-bezier(.22,1,.36,1);
            will-change: opacity, transform;
        }
        [data-motion-reveal].is-visible {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        .site-footer-heading {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted, var(--text-muted, var(--text-soft, #626280)));
            margin-bottom: 14px;
        }
        @media (max-width: 900px) {
            .site-footer-grid {
                grid-template-columns: 1fr 1fr !important;
            }
        }
        @media (max-width: 640px) {
            .site-footer-grid {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
    <?php
}

function any2convertRenderBrandMark(string $href = 'index.php'): void
{
    ?>
    <a href="<?= htmlspecialchars($href) ?>" class="brand-mark" aria-label="Any2Convert home">
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
    <?php
}

function any2convertRenderTopbar(array $options = []): void
{
    $homeHref = $options['home_href'] ?? 'index.php';
    $links = $options['links'] ?? [];
    $badge = $options['badge'] ?? '';
    $ctaHtml = $options['cta_html'] ?? '';
    ?>
    <nav class="site-topbar">
        <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex items-center gap-4">
                <?php any2convertRenderBrandMark($homeHref); ?>
                <?php if ($badge !== ''): ?>
                    <span class="hidden md:inline-flex site-badge"><?= htmlspecialchars($badge) ?></span>
                <?php endif; ?>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <?php foreach ($links as $link): ?>
                    <a href="<?= htmlspecialchars($link['href']) ?>" class="site-nav-pill"><?= htmlspecialchars($link['label']) ?></a>
                <?php endforeach; ?>
                <?= $ctaHtml ?>
                <button type="button" class="site-theme-toggle" data-theme-toggle="1" aria-label="Toggle theme">
                    <svg data-theme-icon="moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>
                    <svg data-theme-icon="sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none"><circle cx="12" cy="12" r="5"/><path d="M12 1v2"/><path d="M12 21v2"/><path d="M4.22 4.22l1.42 1.42"/><path d="M18.36 18.36l1.42 1.42"/><path d="M1 12h2"/><path d="M21 12h2"/><path d="M4.22 19.78l1.42-1.42"/><path d="M18.36 5.64l1.42-1.42"/></svg>
                </button>
            </div>
        </div>
    </nav>
    <?php
}

function any2convertRenderFooter(): void
{
    ?>
    <footer class="site-footer">
        <div style="max-width:1280px;margin:0 auto;padding:48px 20px 32px;">
            <div class="site-footer-grid" style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:40px;margin-bottom:40px;">
                <div>
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                        <div style="width:28px;height:28px;background:var(--accent, #6c63ff);border-radius:7px;display:flex;align-items:center;justify-content:center;color:#fff;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                        </div>
                        <span style="font-weight:700;font-size:0.95rem;color:var(--text-main, var(--text-primary, #111118));">Any2Convert<span style="color:var(--accent, #6c63ff);">.</span></span>
                    </div>
                    <p style="font-size:0.8rem;color:var(--text-muted, var(--text-soft, #626280));line-height:1.7;max-width:220px;">Free online tools with local on-device processing, cleaner workflows, and privacy-first defaults.</p>
                </div>
                <div>
                    <div class="site-footer-heading">Tools</div>
                    <div style="display:flex;flex-direction:column;gap:9px;">
                        <a href="/image-to-pdf" class="site-footer-link">Image to PDF</a>
                        <a href="/pdf-to-word" class="site-footer-link">PDF to Word</a>
                        <a href="/merge-pdf" class="site-footer-link">Merge PDF</a>
                        <a href="/ocr-image-to-text" class="site-footer-link">OCR Tool</a>
                    </div>
                </div>
                <div>
                    <div class="site-footer-heading">Company</div>
                    <div style="display:flex;flex-direction:column;gap:9px;">
                        <a href="about.php" class="site-footer-link">About</a>
                        <a href="contact.php" class="site-footer-link">Contact</a>
                        <a href="privacy.php" class="site-footer-link">Privacy Policy</a>
                        <a href="terms.php" class="site-footer-link">Terms</a>
                    </div>
                </div>
                <div>
                    <div class="site-footer-heading">Resources</div>
                    <div style="display:flex;flex-direction:column;gap:9px;">
                        <a href="/blog/" class="site-footer-link">Blog</a>
                        <a href="/sitemap.php" class="site-footer-link">Sitemap</a>
                    </div>
                </div>
            </div>
            <div style="border-top:1px solid var(--panel-border, var(--border, rgba(17,17,24,.08)));padding-top:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <span style="font-size:0.78rem;color:var(--text-muted, var(--text-soft, #626280));">&copy; <?= date('Y') ?> Any2Convert. All rights reserved. Made with love in Karachi, Pakistan.</span>
                <div style="display:flex;align-items:center;gap:6px;font-size:0.75rem;color:var(--text-muted, var(--text-soft, #626280));">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="var(--green, #10b981)" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Local-first processing on your device
                </div>
            </div>
        </div>
    </footer>
    <?php
}

function any2convertRenderThemeScript(): void
{
    ?>
    <script>
        (function () {
            const prefersReducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            }

            function syncThemeIcons() {
                const dark = document.documentElement.classList.contains('dark');
                document.querySelectorAll('[data-theme-toggle="1"]').forEach((toggle) => {
                    const moon = toggle.querySelector('[data-theme-icon="moon"]');
                    const sun = toggle.querySelector('[data-theme-icon="sun"]');
                    if (moon) moon.style.display = dark ? 'none' : 'block';
                    if (sun) sun.style.display = dark ? 'block' : 'none';
                });
            }

            document.addEventListener('click', (event) => {
                const toggle = event.target.closest('[data-theme-toggle="1"]');
                if (!toggle) return;
                document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                syncThemeIcons();
            });

            function initMotionReveal() {
                if (prefersReducedMotion) {
                    document.querySelectorAll('[data-motion-reveal]').forEach((el) => el.classList.add('is-visible'));
                    return;
                }

                const selector = [
                    'main > section',
                    'main > article',
                    'main > div',
                    '.tool-container',
                    '.seo-content',
                    '.faq-item',
                    '.site-footer'
                ].join(',');

                const targets = Array.from(document.querySelectorAll(selector)).filter((el) => {
                    if (!el || el.closest('[data-motion-reveal-parent="ignore"]')) {
                        return false;
                    }
                    if (el.matches('.site-footer')) {
                        return true;
                    }
                    return !el.hasAttribute('data-motion-reveal');
                });

                targets.forEach((el, index) => {
                    el.setAttribute('data-motion-reveal', 'auto');
                    el.style.transitionDelay = `${Math.min(index * 45, 220)}ms`;
                });

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach((entry) => {
                        if (!entry.isIntersecting) return;
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    });
                }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

                document.querySelectorAll('[data-motion-reveal]').forEach((el) => observer.observe(el));
            }

            syncThemeIcons();
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initMotionReveal, { once: true });
            } else {
                initMotionReveal();
            }
        })();
    </script>
    <?php
}
