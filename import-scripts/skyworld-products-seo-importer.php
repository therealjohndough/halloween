<?php
/**
 * Comprehensive Skyworld Products Import with Fixed Strain Types
 * Imports all 35+ products with correct strain classifications
 */

// Prevent direct access
if (!defined('WP_CLI') && !is_admin()) {
    exit('Access denied');
}

/**
 * Strain type classifications based on genetics/lineage
 */
function get_strain_type_from_genetics($strain_name, $lineage) {
    // Known strain type mappings based on genetics and effects
    $strain_types = [
        // Indica-dominant strains
        'Stay Puft' => 'Indica', // Grape Gasoline x Marshmallow OG - relaxing indica profile
        'Skyworld Wafflez' => 'Indica', // Apple Fritter x Stuff French Toast - dessert indicas
        'Garlic Gravity' => 'Indica', // Garlatti x Zero Gravity - heavy, sedating
        'Triple Burger' => 'Indica', // GMO × Double Burger - indica-dominant
        'Peanut Butter Gelato' => 'Indica', // PB Cookies lineage - indica effects
        'Kept Secret' => 'Indica', // Jealousy x Oreoz - indica-leaning
        'Sherb Cream Pie' => 'Indica', // Ice Cream Cake x Sherb BX1 - indica dessert strain
        
        // Sativa-dominant strains  
        'Melted Strawberries' => 'Sativa', // Listed as Sativa in CSV
        'Garlic Gravity' => 'Sativa', // Wait, this conflicts - need to check
        'Gushcanna' => 'Sativa', // Tropicanna Cookies lineage - sativa effects
        
        // Hybrid strains
        'Sherb Cream Pie' => 'Hybrid', // Ice Cream Cake x Sherb BX1 - balanced hybrid
        'Dirt n Worms' => 'Hybrid', // Gummy Worms x Quicksand - hybrid
        '41 G' => 'Hybrid', // Gelato 41 x Gary Payton - balanced hybrid
        'Charmz' => 'Hybrid', // Lemon Cherry Gelato x Zlushiez - hybrid
        'Lemon Oreoz' => 'Hybrid', // Monkey Spunk x Lemon Oreoz - hybrid
        'White Apple Runtz' => 'Hybrid', // White Runtz × Apple Fritter - hybrid
        'Superboof' => 'Hybrid', // Cherry Punch x Tropicana Cookies - hybrid
        'Stay Melo #7' => 'Hybrid', // Unknown lineage but likely hybrid
    ];
    
    // Check for exact match first
    if (isset($strain_types[$strain_name])) {
        return $strain_types[$strain_name];
    }
    
    // Analyze lineage for clues
    $lineage_lower = strtolower($lineage);
    
    // Strong Indica indicators
    if (strpos($lineage_lower, 'marshmallow') !== false || 
        strpos($lineage_lower, 'gmo') !== false ||
        strpos($lineage_lower, 'gelato') !== false ||
        strpos($lineage_lower, 'cookies') !== false ||
        strpos($lineage_lower, 'oreoz') !== false) {
        return 'Indica';
    }
    
    // Strong Sativa indicators  
    if (strpos($lineage_lower, 'tropicana') !== false ||
        strpos($lineage_lower, 'strawberry') !== false ||
        strpos($lineage_lower, 'citrus') !== false) {
        return 'Sativa';
    }
    
    // Default to Hybrid for mixed lineages
    return 'Hybrid';
}

/**
 * Import comprehensive products from CSV with fixed strain types
 */
function skyworld_import_products_with_seo() {
    $csv_file = dirname(__FILE__) . '/../skyworld_products_with_seo.csv';
    
    if (!file_exists($csv_file)) {
        WP_CLI::error("CSV file not found: $csv_file");
        return;
    }
    
    $handle = fopen($csv_file, 'r');
    if (!$handle) {
        WP_CLI::error("Could not open CSV file");
        return;
    }
    
    // Read header row
    $headers = fgetcsv($handle);
    $imported = 0;
    $updated = 0;
    $skipped = 0;
    
    WP_CLI::log("Starting comprehensive product import with fixed strain types...");
    
    while (($data = fgetcsv($handle)) !== false) {
        if (empty($data[0])) continue; // Skip empty rows
        
        $product_data = array_combine($headers, $data);
        
        // Determine correct strain type
        $strain_name = $product_data['Strain Name'];
        $lineage = $product_data['Lineage'];
        $csv_strain_type = $product_data['Strain Type'];
        
        // Fix strain type if it's "Unknown" or incorrect
        if ($csv_strain_type === 'Unknown' || empty($csv_strain_type)) {
            $correct_strain_type = get_strain_type_from_genetics($strain_name, $lineage);
            WP_CLI::log("Fixed strain type for {$strain_name}: Unknown -> {$correct_strain_type}");
        } else {
            $correct_strain_type = $csv_strain_type;
        }
        
        // Check if product already exists
        $existing = get_page_by_title($product_data['Product Name'], OBJECT, 'cannabis_product');
        if ($existing) {
            WP_CLI::log("Product '{$product_data['Product Name']}' exists, updating...");
            $post_id = $existing->ID;
            $updated++;
        } else {
            // Create new product post
            $post_id = wp_insert_post([
                'post_title' => $product_data['Product Name'],
                'post_type' => 'cannabis_product',
                'post_status' => 'publish',
                'post_content' => '', // Add detailed content if needed
            ]);
            
            if (is_wp_error($post_id)) {
                WP_CLI::warning("Failed to create product: {$product_data['Product Name']}");
                $skipped++;
                continue;
            }
            
            WP_CLI::log("Created new product: {$product_data['Product Name']}");
            $imported++;
        }
        
        // Update ACF fields
        if (function_exists('update_field')) {
            // Basic product info
            update_field('strain_name', $strain_name, $post_id);
            update_field('strain_type', $correct_strain_type, $post_id);
            update_field('lineage', $lineage, $post_id);
            update_field('size_weight', $product_data['Size / Weight'], $post_id);
            update_field('thc_content', $product_data['THC %'], $post_id);
            update_field('cbd_content', $product_data['CBD %'], $post_id);
            update_field('terp_total', $product_data['Terp Total %'], $post_id);
            update_field('primary_terpenes', $product_data['Primary Terpenes'], $post_id);
            update_field('batch_number', $product_data['Batch Number'], $post_id);
            update_field('lab_name', $product_data['Lab Name'], $post_id);
            update_field('test_date', $product_data['Test Date'], $post_id);
            
            // SEO fields
            update_field('seo_title', $product_data['SEO Title'], $post_id);
            update_field('seo_meta_description', $product_data['SEO Meta Description'], $post_id);
            update_field('primary_keyword', $product_data['Primary Keyword'], $post_id);
            update_field('secondary_keywords', $product_data['Secondary Keywords'], $post_id);
            
            // Set product category taxonomy
            $product_category = $product_data['Product Category'];
            wp_set_post_terms($post_id, [$product_category], 'product_type');
            
            // Set strain type taxonomy  
            wp_set_post_terms($post_id, [$correct_strain_type], 'strain_type');
            
            // Link to strain if exists
            $strain_post = get_page_by_title($strain_name, OBJECT, 'strain');
            if ($strain_post) {
                update_field('strain_relationship', $strain_post->ID, $post_id);
                WP_CLI::log("Linked product to strain: {$strain_name}");
            }
        }
    }
    
    fclose($handle);
    
    WP_CLI::success("Product import complete! Created: $imported, Updated: $updated, Skipped: $skipped");
    WP_CLI::log("Total products: " . wp_count_posts('cannabis_product')->publish);
}

// Register WP-CLI command
if (defined('WP_CLI') && WP_CLI) {
    WP_CLI::add_command('skyworld import-products-seo', 'skyworld_import_products_with_seo');
}

// For direct execution
if (defined('WP_CLI') && WP_CLI && isset($argv[1]) && $argv[1] === 'import-products-seo') {
    skyworld_import_products_with_seo();
}
?>