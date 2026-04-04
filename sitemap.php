<?php
require_once 'seo_data.php';

header("Content-Type: text/xml;charset=iso-8859-1");
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

$base_url = "https://any2convert.com/";
$date = date("Y-m-d"); // Current date for lastmod

// 1. Core Static Pages
$static_pages = ['', 'about.php', 'privacy.php', 'terms.php', 'contact.php', 'blog/'];
foreach ($static_pages as $page) {
    echo "  <url>\n";
    echo "    <loc>" . $base_url . $page . "</loc>\n";
    echo "    <lastmod>" . $date . "</lastmod>\n";
    echo "    <priority>" . ($page === '' ? '1.0' : '0.8') . "</priority>\n";
    echo "  </url>\n";
}

// 2. Dynamic Tool Pages & Their Blogs
foreach ($seo_tools as $slug => $data) {
    // The Tool Page
    echo "  <url>\n";
    echo "    <loc>" . $base_url . htmlspecialchars($slug) . "</loc>\n";
    echo "    <lastmod>" . $date . "</lastmod>\n";
    echo "    <priority>0.9</priority>\n";
    echo "  </url>\n";

    // The Tool's Blog/Guide Page
    echo "  <url>\n";
    echo "    <loc>" . $base_url . "blog/guide.php?slug=" . htmlspecialchars($slug) . "</loc>\n";
    echo "    <lastmod>" . $date . "</lastmod>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';
?>