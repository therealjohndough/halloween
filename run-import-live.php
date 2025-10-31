<?php
/**
 * Live Server Import Runner
 * Upload this file to your live server root and visit it in browser
 * DELETE IMMEDIATELY AFTER USE for security
 */

// Security check - only run if accessed directly
if (!defined('ABSPATH')) {
    // Load WordPress
    require_once('wp-config.php');
}

echo "<h1>Skyworld Product Import</h1>";
echo "<p>Starting import...</p>";

// Check if files exist
if (!file_exists('complete-import.php')) {
    die('<p style="color:red;">ERROR: complete-import.php not found in root directory</p>');
}

if (!file_exists('skyworld_products_with_seo.csv')) {
    die('<p style="color:red;">ERROR: skyworld_products_with_seo.csv not found in root directory</p>');
}

echo "<p>✓ Import files found</p>";

// Run the import
echo "<p>Running import script...</p>";
ob_start();
include 'complete-import.php';
$output = ob_get_clean();

echo "<div style='background:#f0f0f0; padding:10px; margin:10px 0;'>";
echo "<pre>" . htmlspecialchars($output) . "</pre>";
echo "</div>";

echo "<h3 style='color:green;'>Import Complete!</h3>";
echo "<p><strong>IMPORTANT:</strong> Delete this file (run-import-live.php) immediately for security!</p>";
echo "<p>Check your WordPress admin to verify the import:</p>";
echo "<ul>";
echo "<li>Products: Should show 35 total</li>";
echo "<li>Strains: Should show 20+ unique strains</li>";
echo "<li>All strain types should be properly set (Indica/Sativa/Hybrid)</li>";
echo "</ul>";

?>