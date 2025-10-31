<?php
/**
 * Live Server Import Runner - Fixed Version
 * Upload this file to your live server root and visit it in browser
 * DELETE IMMEDIATELY AFTER USE for security
 */

// Load WordPress without redefining constants
if (!defined('ABSPATH')) {
    define('ABSPATH', dirname(__FILE__) . '/');
    require_once(ABSPATH . 'wp-config.php');
    require_once(ABSPATH . 'wp-includes/wp-db.php');
    require_once(ABSPATH . 'wp-includes/pluggable.php');
    require_once(ABSPATH . 'wp-admin/includes/admin.php');
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

// Set up WordPress environment
wp_set_current_user(1); // Assume user ID 1 is admin

// Run the import directly
echo "<p>Running import script...</p>";

// Read and process CSV directly
$csv_file = 'skyworld_products_with_seo.csv';
$csv_data = array_map('str_getcsv', file($csv_file));
$headers = array_shift($csv_data);

echo "<p>Found " . count($csv_data) . " products in CSV</p>";

$imported_count = 0;
$strain_count = 0;
$created_strains = array();

foreach ($csv_data as $row) {
    $product_data = array_combine($headers, $row);
    
    $batch_number = trim($product_data['Batch Number']);
    $strain_name = trim($product_data['Strain']);
    $strain_type = trim($product_data['Strain Type']);
    
    echo "<p>Processing: {$strain_name} ({$batch_number})</p>";
    
    // Create strain if it doesn't exist
    if (!in_array($strain_name, $created_strains)) {
        $strain_post = array(
            'post_title' => $strain_name,
            'post_type' => 'strains',
            'post_status' => 'publish',
            'post_content' => 'Premium cannabis strain from Skyworld'
        );
        
        $strain_id = wp_insert_post($strain_post);
        if ($strain_id) {
            $created_strains[] = $strain_name;
            $strain_count++;
            
            // Set strain type taxonomy
            if ($strain_type && $strain_type !== 'Unknown') {
                wp_set_object_terms($strain_id, $strain_type, 'strain_type');
            }
            
            echo "<p>✓ Created strain: {$strain_name}</p>";
        }
    }
    
    // Create product
    $product_title = $strain_name . ' - ' . trim($product_data['Weight']) . ' - ' . $batch_number;
    
    $product_post = array(
        'post_title' => $product_title,
        'post_type' => 'products',
        'post_status' => 'publish',
        'post_content' => 'Premium cannabis product from Skyworld'
    );
    
    $product_id = wp_insert_post($product_post);
    
    if ($product_id) {
        // Add ACF fields
        update_field('batch_number', $batch_number, $product_id);
        update_field('strain_name', $strain_name, $product_id);
        update_field('weight', trim($product_data['Weight']), $product_id);
        update_field('thc_percent', floatval($product_data['THC %']), $product_id);
        update_field('cbd_percent', floatval($product_data['CBD %']), $product_id);
        
        $imported_count++;
        echo "<p>✓ Created product: {$product_title}</p>";
    }
}

echo "<h3 style='color:green;'>Import Complete!</h3>";
echo "<p><strong>Results:</strong></p>";
echo "<ul>";
echo "<li>Strains created: {$strain_count}</li>";
echo "<li>Products imported: {$imported_count}</li>";
echo "</ul>";

echo "<p><strong>IMPORTANT:</strong> Delete this file (run-import-fixed.php) immediately for security!</p>";

?>