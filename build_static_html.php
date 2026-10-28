<?php
/**
 * Static HTML Generator for GitHub Pages
 * Run this via CLI: php build_static_html.php
 * Or open in browser: http://localhost/about%20dwarka/build_static_html.php
 */
ob_start();
include __DIR__ . '/index.php';
$html = ob_get_clean();

$dest = __DIR__ . '/index.html';
file_put_contents($dest, $html);

$msg = "સફળતા! index.html ફાઇલ સફળતાપૂર્વક બની ગઈ છે (" . round(strlen($html) / 1024, 1) . " KB). હવે તમે આખી વેબસાઇટ GitHub પર અપલોડ કરી શકો છો.";

if (php_sapi_name() === 'cli') {
    echo $msg . PHP_EOL;
} else {
    echo "<!DOCTYPE html><html lang='gu'><head><meta charset='UTF-8'><title>HTML Generated</title></head><body style='font-family: sans-serif; padding: 40px; text-align: center;'>";
    echo "<h2 style='color: #16a34a;'>✅ " . htmlspecialchars($msg) . "</h2>";
    echo "<p><a href='index.html' style='font-size: 1.1rem; color: #e65100; font-weight: bold;'>નવી બનેલી index.html ખોલો &rarr;</a></p>";
    echo "</body></html>";
}
