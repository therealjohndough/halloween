<?php
/**
 * Complete Skyworld Product Import with Taxonomies and Metadata
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
    require_once(ABSPATH . 'wp-admin/includes/taxonomy.php');
}

echo "<h1>Skyworld Complete Product Import</h1>";
echo "<p>Starting comprehensive import with taxonomies and metadata...</p>";

// Check if files exist
if (!file_exists('skyworld_products_with_seo.csv')) {
    die('<p style="color:red;">ERROR: skyworld_products_with_seo.csv not found in root directory</p>');
}

echo "<p>✓ CSV file found</p>";

// Set up WordPress environment
wp_set_current_user(1); // Assume user ID 1 is admin

// Read and process CSV
$csv_file = 'skyworld_products_with_seo.csv';
$csv_data = array_map('str_getcsv', file($csv_file));
$headers = array_shift($csv_data);

echo "<p>Found " . count($csv_data) . " products in CSV</p>";
echo "<p>Headers: " . implode(', ', $headers) . "</p>";

$imported_count = 0;
$strain_count = 0;
$created_strains = array();

// Create default taxonomies if they don't exist
$product_types = array('Flower', 'Pre-Roll', 'Concentrate', 'Edible');
foreach ($product_types as $type) {
    if (!term_exists($type, 'product_type')) {
        wp_insert_term($type, 'product_type');
        echo "<p>✓ Created product type: {$type}</p>";
    }
}

$strain_types = array('Indica', 'Sativa', 'Hybrid');
foreach ($strain_types as $type) {
    if (!term_exists($type, 'strain_type')) {
        wp_insert_term($type, 'strain_type');
        echo "<p>✓ Created strain type: {$type}</p>";
    }
}

echo "<hr>";

foreach ($csv_data as $row_index => $row) {
    $product_data = array_combine($headers, $row);
    
    $batch_number = trim($product_data['Batch Number']);
    $strain_name = trim($product_data['Strain']);
    $strain_type = trim($product_data['Strain Type']);
    $weight = trim($product_data['Weight']);
    $thc_percent = floatval($product_data['THC %']);
    $cbd_percent = floatval($product_data['CBD %']);
    $terpenes = trim($product_data['Terpenes'] ?? '');
    
    echo "<div style='background:#f9f9f9; padding:10px; margin:10px 0; border-left:4px solid #0073aa;'>";
    echo "<h3>Processing Row " . ($row_index + 1) . ": {$strain_name} ({$batch_number})</h3>";
    
    // Create strain if it doesn't exist
    $strain_id = null;
    if (!in_array($strain_name, $created_strains)) {
        $strain_post = array(
            'post_title' => $strain_name,
            'post_type' => 'strains',
            'post_status' => 'publish',
            'post_content' => "Premium {$strain_type} cannabis strain from Skyworld Cannabis.",
            'meta_input' => array(
                'strain_description' => "Premium {$strain_type} strain with {$thc_percent}% THC",
                'thc_percentage' => $thc_percent,
                'cbd_percentage' => $cbd_percent,
            )
        );
        
        $strain_id = wp_insert_post($strain_post);
        if ($strain_id) {
            $created_strains[$strain_name] = $strain_id;
            $strain_count++;
            
            // Set strain type taxonomy
            if ($strain_type && $strain_type !== 'Unknown') {
                wp_set_object_terms($strain_id, $strain_type, 'strain_type');
                echo "<p>✓ Set strain type: {$strain_type}</p>";
            }
            
            // Parse and add terpenes
            if ($terpenes) {
                $terpene_pairs = explode(';', $terpenes);
                $terpene_data = array();
                foreach ($terpene_pairs as $pair) {
                    if (strpos($pair, ' ') !== false) {
                        list($terpene_name, $terpene_value) = explode(' ', trim($pair), 2);
                        $terpene_data[$terpene_name] = floatval($terpene_value);
                        
                        // Add individual terpene fields
                        update_field(strtolower($terpene_name), floatval($terpene_value), $strain_id);
                    }
                }
                update_field('terpenes_raw', $terpenes, $strain_id);
                echo "<p>✓ Added terpenes: " . implode(', ', array_keys($terpene_data)) . "</p>";
            }
            
            echo "<p><strong>✓ Created strain: {$strain_name}</strong></p>";
        }
    } else {
        $strain_id = $created_strains[$strain_name];
        echo "<p>↻ Using existing strain: {$strain_name}</p>";
    }
    
    // Determine product category from weight field
    $category = 'Flower'; // Default
    if (stripos($weight, 'pre-roll') !== false || stripos($weight, 'preroll') !== false) {
        $category = 'Pre-Roll';
    } elseif (stripos($weight, 'hash hole') !== false) {
        $category = 'Hash Hole';
    }
    
    // Clean size from weight field
    $size = $weight;
    if ($category === 'Pre-Roll') {
        // Extract size like "1g" from "1g Pre-Roll" or keep "2-Pack"
        if (preg_match('/(\d+\.?\d*g|\d+-Pack)/', $weight, $matches)) {
            $size = $matches[1];
        }
    }
    
    // Create product name: Strain + Category + Size
    $product_title = $strain_name . ' ' . $category . ' ' . $size;
    
    $product_post = array(
        'post_title' => $product_title,
        'post_type' => 'products',
        'post_status' => 'publish',
        'post_content' => "Premium {$strain_type} cannabis product from Skyworld Cannabis.\n\nBatch: {$batch_number}\nTHC: {$thc_percent}%\nCBD: {$cbd_percent}%",
        'meta_input' => array(
            'batch_number' => $batch_number,
            'strain_name' => $strain_name,
            'weight' => $weight,
            'thc_percent' => $thc_percent,
            'cbd_percent' => $cbd_percent,
            'thc_content' => $thc_percent, // Alternative field name
            'cbd_content' => $cbd_percent, // Alternative field name
            'strain_type' => $strain_type,
            'product_strain' => $strain_id, // Link to strain
        )
    );
    
    $product_id = wp_insert_post($product_post);
    
    if ($product_id) {
        // Set product type taxonomy
        wp_set_object_terms($product_id, $product_type, 'product_type');
        echo "<p>✓ Set product type: {$product_type}</p>";
        
        // Add all CSV data as meta fields
        foreach ($product_data as $key => $value) {
            if (!empty(trim($value)) && $value !== 'Unknown') {
                $meta_key = strtolower(str_replace([' ', '%', '#'], ['_', '_percent', '_number'], $key));
                update_post_meta($product_id, $meta_key, trim($value));
            }
        }
        
        // Parse and add terpenes to product too
        if ($terpenes) {
            $terpene_pairs = explode(';', $terpenes);
            foreach ($terpene_pairs as $pair) {
                if (strpos($pair, ' ') !== false) {
                    list($terpene_name, $terpene_value) = explode(' ', trim($pair), 2);
                    update_field(strtolower($terpene_name), floatval($terpene_value), $product_id);
                }
            }
            update_field('terpenes_raw', $terpenes, $product_id);
        }
        
        // Create relationship between product and strain
        if ($strain_id) {
            update_field('related_strain', $strain_id, $product_id);
            update_post_meta($product_id, 'strain_id', $strain_id);
        }
        
        $imported_count++;
        echo "<p><strong>✓ Created product: {$product_title}</strong></p>";
        echo "<p>  - THC: {$thc_percent}% | CBD: {$cbd_percent}% | Type: {$product_type}</p>";
    } else {
        echo "<p style='color:red;'>✗ Failed to create product: {$product_title}</p>";
    }
    
    echo "</div>";
    
    // Flush output for real-time display
    if (ob_get_level()) {
        ob_flush();
    }
    flush();
}

echo "<hr>";
echo "<h2 style='color:green;'>Import Complete!</h2>";
echo "<div style='background:#d4edda; padding:20px; border:1px solid #c3e6cb; border-radius:5px;'>";
echo "<h3>Import Results:</h3>";
echo "<ul>";
echo "<li><strong>Strains created:</strong> {$strain_count}</li>";
echo "<li><strong>Products imported:</strong> {$imported_count}</li>";
echo "<li><strong>Product types:</strong> " . implode(', ', $product_types) . "</li>";
echo "<li><strong>Strain types:</strong> " . implode(', ', $strain_types) . "</li>";
echo "</ul>";
echo "</div>";

echo "<p style='color:red; font-weight:bold; font-size:18px;'>IMPORTANT: Delete this file (run-complete-import.php) immediately for security!</p>";

echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li>Go to WordPress Admin → Products to verify all products are imported</li>";
echo "<li>Go to WordPress Admin → Strains to verify all strains are created</li>";
echo "<li>Check that strain types (Indica/Sativa/Hybrid) are properly assigned</li>";
echo "<li>Verify product types (Flower/Pre-Roll) are correctly categorized</li>";
echo "<li>Test that ACF fields are populated with terpene data</li>";
echo "</ol>";

?>