<?php
/**
 * Complete Skyworld Product Import from CSV
 * Import all 35 authentic products from skyworld_products_with_seo.csv
 */

// This will be run on the live server to import the complete catalog
require_once 'wp-load.php';

if (!current_user_can('manage_options')) {
    wp_die('Access denied. Admin privileges required.');
}

function skyworld_import_complete_catalog() {
    $csv_file = dirname(__FILE__) . '/skyworld_products_with_seo.csv';
    
    if (!file_exists($csv_file)) {
        return "❌ CSV file not found: {$csv_file}";
    }
    
    $output = "IMPORTING COMPLETE SKYWORLD CATALOG\n";
    $output .= str_repeat("=", 60) . "\n\n";
    
    $created = 0;
    $updated = 0;
    $errors = 0;
    
    // Read CSV
    if (($handle = fopen($csv_file, "r")) !== FALSE) {
        $header = fgetcsv($handle); // Skip header row
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            $product_data = array_combine($header, $data);
            
            $product_name = $product_data['Product Name'];
            $category = $product_data['Product Category'];
            $strain_name = $product_data['Strain Name'];
            $strain_type = $product_data['Strain Type'];
            $lineage = $product_data['Lineage'];
            $size = $product_data['Size / Weight'];
            $thc = floatval($product_data['THC %']);
            $cbd = floatval($product_data['CBD %']);
            $terp_total = floatval($product_data['Terp Total %']);
            $primary_terpenes = $product_data['Primary Terpenes'];
            $batch_number = $product_data['Batch Number'];
            $lab_name = $product_data['Lab Name'];
            $test_date = $product_data['Test Date'];
            $cultivation_notes = $product_data['Cultivation Notes'];
            $seo_title = $product_data['SEO Title'];
            $seo_description = $product_data['SEO Meta Description'];
            
            // Fix "Unknown" strain types based on live site data
            if ($strain_type === 'Unknown') {
                $strain_type = fix_unknown_strain_type($strain_name, $lineage, $primary_terpenes);
            }
            
            // Check if product exists by batch number (primary identifier)
            $existing = get_posts([
                'post_type' => 'cannabis_product',
                'meta_query' => [
                    [
                        'key' => 'batch_number',
                        'value' => $batch_number,
                        'compare' => '='
                    ]
                ],
                'posts_per_page' => 1
            ]);
            
            if (!empty($existing)) {
                $post_id = $existing[0]->ID;
                $output .= "🔄 Updating: {$product_name} (Batch: {$batch_number})\n";
                $updated++;
            } else {
                // Create new product
                $post_data = [
                    'post_title' => $product_name,
                    'post_type' => 'cannabis_product',
                    'post_status' => 'publish',
                    'post_content' => generate_product_description($strain_name, $strain_type, $category, $lineage),
                    'meta_input' => [
                        '_yoast_wpseo_title' => $seo_title,
                        '_yoast_wpseo_metadesc' => $seo_description,
                    ]
                ];
                
                $post_id = wp_insert_post($post_data);
                
                if (is_wp_error($post_id)) {
                    $output .= "❌ Failed to create: {$product_name} - " . $post_id->get_error_message() . "\n";
                    $errors++;
                    continue;
                }
                
                $output .= "✅ Created: {$product_name} (Batch: {$batch_number}, {$strain_type})\n";
                $created++;
            }
            
            // Update ACF fields (matching theme field names)
            update_field('strain_name', $strain_name, $post_id);
            update_field('strain_type', $strain_type, $post_id);
            update_field('genetics', $lineage, $post_id);
            update_field('lineage', $lineage, $post_id); // Also set lineage field
            update_field('product_category', $category, $post_id);
            update_field('package_sizes', $size, $post_id); // Theme expects package_sizes
            update_field('thc_percent', $thc, $post_id); // Theme expects thc_percent
            update_field('cbd_percent', $cbd, $post_id); // Theme expects cbd_percent
            update_field('terp_total', $terp_total, $post_id);
            update_field('batch_number', $batch_number, $post_id);
            update_field('lab_name', $lab_name, $post_id);
            update_field('test_date', $test_date, $post_id);
            update_field('cultivation_notes', $cultivation_notes, $post_id);
            
            // Parse and set individual terpenes
            parse_and_set_terpenes($primary_terpenes, $post_id);
            
            // Set taxonomies
            wp_set_post_terms($post_id, [$category], 'product_type');
            wp_set_post_terms($post_id, [$strain_type], 'strain_type');
            
            // Link to strain if exists
            $strain_post = get_page_by_title($strain_name, OBJECT, 'strain');
            if ($strain_post) {
                update_field('strain_relationship', $strain_post->ID, $post_id);
            }
        }
        
        fclose($handle);
    }
    
    $total_products = wp_count_posts('cannabis_product');
    $published_count = $total_products->publish ?? 0;
    
    $output .= "\n" . str_repeat("=", 60) . "\n";
    $output .= "IMPORT COMPLETE!\n";
    $output .= "• Products created: {$created}\n";
    $output .= "• Products updated: {$updated}\n";
    $output .= "• Errors: {$errors}\n";
    $output .= "• Total published products: {$published_count}\n";
    $output .= str_repeat("=", 60) . "\n";
    
    return $output;
}

function fix_unknown_strain_type($strain_name, $lineage, $terpenes) {
    // Based on live site classifications and genetics
    $classifications = [
        // SATIVA
        'Garlic Gravity' => 'Sativa', // Live site shows Sativa
        'Gushcanna' => 'Sativa',      // Live site shows Sativa
        'Melted Strawberries' => 'Hybrid', // Live site shows Hybrid
        
        // INDICA  
        'Triple Burger' => 'Indica',    // Live site shows Indica
        'Sherb Cream Pie' => 'Indica',  // Live site shows Indica
        'Peanut Butter Gelato' => 'Indica', // Live site shows Indica
        'Stay Puft' => 'Hybrid',        // Live site shows Hybrid
        
        // HYBRID
        'White Apple Runtz' => 'Hybrid', // Live site shows Hybrid
        'Dirt n Worms' => 'Hybrid',     // Live site shows Hybrid
        'Charmz' => 'Hybrid',           // Live site shows Hybrid
        'Kept Secret' => 'Hybrid',      // Live site shows Hybrid
        '41 G' => 'Hybrid',
        'Skyworld Wafflez' => 'Indica',
        'Lemon Oreoz' => 'Hybrid',
        'Superboof' => 'Hybrid',
        'Stay Melo #7' => 'Hybrid',
    ];
    
    return $classifications[$strain_name] ?? 'Hybrid'; // Default to Hybrid if unknown
}

function generate_product_description($strain_name, $strain_type, $category, $genetics) {
    $type_desc = [
        'Indica' => 'relaxing and body-focused effects',
        'Sativa' => 'energizing and uplifting effects', 
        'Hybrid' => 'balanced effects combining the best of both worlds'
    ];
    
    $effects = $type_desc[$strain_type] ?? 'premium cannabis effects';
    
    return "Premium {$strain_type} {$category} featuring our {$strain_name} strain. With {$genetics} genetics, this product delivers {$effects}. Cultivated indoors using Skyworld's rigorous standards for exceptional quality and consistency.";
}

function parse_and_set_terpenes($terpene_string, $post_id) {
    // Parse "Myrcene 0.74; Linalool 0.52" format
    if (empty($terpene_string)) return;
    
    $terpenes = explode(';', $terpene_string);
    $terpene_count = 1;
    
    foreach ($terpenes as $terpene) {
        if ($terpene_count > 3) break; // Only set first 3 terpenes
        
        $terpene = trim($terpene);
        if (preg_match('/(.+?)\s+([\d.]+)/', $terpene, $matches)) {
            $terp_name = trim($matches[1]);
            $terp_percent = floatval($matches[2]);
            
            update_field("terp{$terpene_count}_name", $terp_name, $post_id);
            update_field("terp{$terpene_count}_percent", $terp_percent, $post_id);
            
            $terpene_count++;
        }
    }
}

// CLI execution
if (php_sapi_name() === 'cli' || (isset($_POST['import_all']) && $_POST['import_all'] === 'true')) {
    echo skyworld_import_complete_catalog();
}
?>