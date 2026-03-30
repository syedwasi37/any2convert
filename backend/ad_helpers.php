<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth_bootstrap.php';

try {
    any2convertBootstrapAuthSchema($conn);
} catch (Throwable $e) {
}

function adsFetchByPosition(PDO $conn, string $position): array
{
    try {
        $stmt = $conn->prepare("
            SELECT *
            FROM site_ads
            WHERE position_key = ? AND is_enabled = 1
            ORDER BY created_at DESC
        ");
        $stmt->execute([$position]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (Throwable $e) {
        return [];
    }
}

function adsRenderPosition(PDO $conn, string $position): string
{
    $ads = adsFetchByPosition($conn, $position);
    if (!$ads) {
        return '';
    }

    static $slotCounter = 0;
    $slotCounter++;
    $slotId = 'site-ad-slot-' . $position . '-' . $slotCounter;

    $wrapperStyle = [
        'header' => 'max-width:1280px;margin:12px auto 0;padding:0 20px;',
        'top_content' => 'max-width:1000px;margin:18px auto 0;padding:0 20px;',
        'under_content' => 'max-width:1000px;margin:24px auto 0;padding:0 20px;',
        'footer_sticky_bottom' => 'position:fixed;left:0;right:0;bottom:0;z-index:60;padding:10px 12px 12px;background:rgba(15,23,42,0.08);backdrop-filter:blur(12px);',
    ];
    $innerStyle = $position === 'footer_sticky_bottom'
        ? 'max-width:1280px;margin:0 auto;display:flex;justify-content:center;gap:12px;flex-wrap:wrap;'
        : 'display:flex;flex-direction:column;gap:12px;';

    $html = '<div id="' . htmlspecialchars($slotId) . '" class="site-ad-slot site-ad-slot-' . htmlspecialchars($position) . '" style="' . ($wrapperStyle[$position] ?? '') . '">';
    if ($position === 'footer_sticky_bottom') {
        $html .= '<button type="button" aria-label="Close ad" style="position:absolute;top:8px;right:10px;width:32px;height:32px;border:none;border-radius:999px;background:rgba(15,23,42,0.78);color:#fff;font-size:18px;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 24px rgba(15,23,42,0.2);" onclick="(function(){var slot=document.getElementById(\'' . htmlspecialchars($slotId) . '\');if(!slot){return;}slot.style.display=\'none\';document.body.style.paddingBottom=\'\';})()">&#215;</button>';
    }
    $html .= '<div style="' . $innerStyle . '">';

    foreach ($ads as $ad) {
        $style = 'display:block;border-radius:18px;overflow:hidden;box-shadow:0 14px 40px rgba(15,23,42,0.12);';
        if (!empty($ad['width_px'])) {
            $style .= 'width:' . (int) $ad['width_px'] . 'px;max-width:100%;';
        } else {
            $style .= 'width:100%;';
        }

        $imgStyle = 'display:block;width:100%;height:auto;';
        if (!empty($ad['height_px'])) {
            $imgStyle .= 'height:' . (int) $ad['height_px'] . 'px;object-fit:cover;';
        }

        $img = '<img src="' . htmlspecialchars($ad['image_path']) . '" alt="' . htmlspecialchars($ad['title']) . '" style="' . $imgStyle . '">';
        if (!empty($ad['target_url'])) {
            $html .= '<a href="' . htmlspecialchars($ad['target_url']) . '" target="_blank" rel="noopener sponsored" style="' . $style . '">' . $img . '</a>';
        } else {
            $html .= '<div style="' . $style . '">' . $img . '</div>';
        }
    }

    $html .= '</div>';
    if ($position === 'footer_sticky_bottom') {
        $html .= '<script>(function(){var slot=document.getElementById(' . json_encode($slotId) . ');if(!slot){return;}function syncStickyOffset(){if(slot.style.display==="none"){document.body.style.paddingBottom="";return;}var banner=slot.querySelector("a, div[style*=\"box-shadow\"]");var bannerHeight=banner?banner.offsetHeight:0;var slotPadding=22;var offset=Math.ceil((bannerHeight||slot.offsetHeight)+slotPadding)+"px";document.body.style.paddingBottom=offset;}syncStickyOffset();window.addEventListener("load",syncStickyOffset);window.addEventListener("resize",syncStickyOffset);})();</script>';
    }
    $html .= '</div>';
    return $html;
}

function adsEnsureUploadDir(): string
{
    $dir = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'ads';
    if (!is_dir($dir)) {
        @mkdir($dir, 0775, true);
    }
    return $dir;
}

function adsSettingValue(PDO $conn, string $key, string $default = '1'): string
{
    try {
        $stmt = $conn->prepare("SELECT setting_value FROM site_ad_settings WHERE setting_key = ? LIMIT 1");
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $default : (string) $value;
    } catch (Throwable $e) {
        return $default;
    }
}

function adsLegacyEnabled(PDO $conn, string $key): bool
{
    return adsSettingValue($conn, $key, '1') === '1';
}

function adsLegacyDefinitions(): array
{
    return [
        [
            'key' => 'legacy_header_network_ad',
            'title' => 'Legacy Header Network Ad',
            'description' => 'Existing profitablecpmratenetwork container shown above the hero on the home page.',
            'page' => 'Home',
        ],
        [
            'key' => 'legacy_post_hero_network_ad',
            'title' => 'Legacy Post-Hero Network Ad',
            'description' => 'Existing profitablecpmratenetwork container shown below the hero on the home page.',
            'page' => 'Home',
        ],
        [
            'key' => 'legacy_mid_content_iframe_ad',
            'title' => 'Legacy Mid-Content Iframe Ad',
            'description' => 'Existing responsive highperformanceformat iframe ad in the middle of the home page.',
            'page' => 'Home',
        ],
    ];
}
