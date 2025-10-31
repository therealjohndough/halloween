<?php
/**
 * Skyworld Products Import - Fix Unknown Strain Types
 * Uses authentic Skyworld data to properly classify all strain types
 */

require_once dirname(__FILE__) . '/../wp-content/themes/skyworld-cannabis/functions.php';

/**
 * Comprehensive strain type classifications based on authentic Skyworld genetics
 */
function get_skyworld_strain_classifications() {
    return [
        // INDICA-DOMINANT STRAINS
        'Stay Puft' => [
            'type' => 'Indica',
            'genetics' => 'Marshmallow OG × Grape Gasoline',
            'reasoning' => 'Marshmallow OG indica dominant, high Myrcene (0.74%) = relaxing effects'
        ],
        'Garlic Gravity' => [
            'type' => 'Indica', 
            'genetics' => 'Garlatti × Zero Gravity',
            'reasoning' => 'Savory umami profile, high β-Caryophyllene (0.91%) + Myrcene (0.76%) = indica sedation'
        ],
        'Triple Burger' => [
            'type' => 'Indica',
            'genetics' => 'GMO × Double Burger', 
            'reasoning' => 'GMO is indica-dominant, savory/diesel profile, high Myrcene (0.76%)'
        ],
        'Kept Secret' => [
            'type' => 'Indica',
            'genetics' => 'Jealousy × Oreoz',
            'reasoning' => 'Both parents indica-leaning, high Myrcene (0.68%), earthy profile'
        ],
        'Skyworld Wafflez' => [
            'type' => 'Indica',
            'genetics' => 'Apple Fritter × Stuffed French Toast',
            'reasoning' => 'Dessert strain lineage, Apple Fritter indica-dominant'
        ],
        'Peanut Butter Gelato' => [
            'type' => 'Indica',
            'genetics' => 'PB Cookies × Starfighter × Sherb × Gelato',
            'reasoning' => 'Cookies + Gelato lineage = indica effects, high β-Caryophyllene (0.89%)'
        ],
        
        // SATIVA-DOMINANT STRAINS  
        'Melted Strawberries' => [
            'type' => 'Sativa',
            'genetics' => 'GMO × Strawberry Guava',
            'reasoning' => 'Strawberry Guava sativa-dominant, high Limonene (1.12%) = uplifting'
        ],
        'Gushcanna' => [
            'type' => 'Sativa', 
            'genetics' => 'Tropicanna Cookies × Gushers',
            'reasoning' => 'Tropicanna Cookies sativa-dominant, citrus profile, energizing effects'
        ],
        
        // HYBRID STRAINS
        'Sherb Cream Pie' => [
            'type' => 'Hybrid',
            'genetics' => 'Ice Cream Cake × Sherb BX1',
            'reasoning' => 'Balanced hybrid, high Limonene (0.89%) + β-Caryophyllene (0.67%)'
        ],
        'Dirt n Worms' => [
            'type' => 'Hybrid',
            'genetics' => 'Gummy Worms × Quicksand', 
            'reasoning' => 'Balanced terpene profile, moderate effects'
        ],
        '41 G' => [
            'type' => 'Hybrid',
            'genetics' => 'Gelato #41 × Gary Payton',
            'reasoning' => 'Gelato hybrids typically balanced, sweet-cream gas profile'
        ],
        'Charmz' => [
            'type' => 'Hybrid',
            'genetics' => 'Lemon Cherry Gelato × Zlushiez',
            'reasoning' => 'Balanced hybrid, high Limonene (0.88%) + Linalool (0.62%)'
        ],
        'Lemon Oreoz' => [
            'type' => 'Hybrid',
            'genetics' => 'Oreoz × Monkey Spunk',
            'reasoning' => 'Balanced citrus-cream profile, high Limonene (0.89%)'
        ],
        'White Apple Runtz' => [
            'type' => 'Hybrid',
            'genetics' => 'White Runtz × Apple Fritter',
            'reasoning' => 'Runtz typically balanced hybrid, crisp apple/candy profile'
        ],
        'Superboof' => [
            'type' => 'Hybrid',
            'genetics' => 'Black Cherry Punch × Tropicana Cookies',
            'reasoning' => 'Cherry with tropical balance, high Myrcene (0.89%) but energizing tropicana'
        ],
        'Stay Melo #7' => [
            'type' => 'Hybrid',
            'genetics' => 'Unknown hybrid selection',
            'reasoning' => 'Balanced mellow profile, moderate β-Caryophyllene (0.78%) + Myrcene (0.65%)'
        ]
    ];
}

/**
 * Import and fix all Skyworld products with correct strain types
 */
function skyworld_import_fix_products() {
    $strain_classifications = get_skyworld_strain_classifications();
    
    // Get all existing products
    $products = get_posts([
        'post_type' => 'cannabis_product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);
    
    $updated = 0;
    $fixed_unknown = 0;
    
    echo "Starting product strain type fixes...\n";
    
    foreach ($products as $product) {
        $strain_name = get_field('strain_name', $product->ID) ?: get_field('strain_relationship', $product->ID);
        $current_type = get_field('strain_type', $product->ID);
        
        if (is_object($strain_name)) {
            $strain_name = $strain_name->post_title;
        }
        
        // Check if we have a classification for this strain
        if (isset($strain_classifications[$strain_name])) {
            $correct_type = $strain_classifications[$strain_name]['type'];
            $genetics = $strain_classifications[$strain_name]['genetics'];
            $reasoning = $strain_classifications[$strain_name]['reasoning'];
            
            // Fix if current type is Unknown or incorrect
            if ($current_type === 'Unknown' || empty($current_type) || $current_type !== $correct_type) {
                update_field('strain_type', $correct_type, $product->ID);
                update_field('genetics', $genetics, $product->ID);
                
                // Update taxonomies
                wp_set_post_terms($product->ID, [$correct_type], 'strain_type');
                
                if ($current_type === 'Unknown') {
                    echo "✅ Fixed UNKNOWN: {$product->post_title} -> {$strain_name} = {$correct_type}\n";
                    echo "   Reasoning: {$reasoning}\n";
                    $fixed_unknown++;
                } else {
                    echo "🔄 Updated: {$product->post_title} -> {$current_type} to {$correct_type}\n";
                }
                $updated++;
            } else {
                echo "✓ Correct: {$product->post_title} -> {$strain_name} = {$correct_type}\n";
            }
        } else {
            echo "❓ Unknown strain: {$product->post_title} -> '{$strain_name}' (needs manual classification)\n";
        }
    }
    
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "STRAIN TYPE FIX COMPLETE!\n";
    echo "Total products updated: {$updated}\n";
    echo "Unknown types fixed: {$fixed_unknown}\n";
    echo str_repeat("=", 60) . "\n";
    
    // Show summary by strain type
    $type_counts = [];
    foreach ($strain_classifications as $strain => $data) {
        $type = $data['type'];
        $type_counts[$type] = ($type_counts[$type] ?? 0) + 1;
    }
    
    echo "\nSTRAIN TYPE DISTRIBUTION:\n";
    foreach ($type_counts as $type => $count) {
        echo "• {$type}: {$count} strains\n";
    }
}

/**
 * Create comprehensive product dataset from existing data
 */
function skyworld_create_comprehensive_products() {
    $strain_classifications = get_skyworld_strain_classifications();
    
    // Define authentic Skyworld product catalog
    $products_data = [
        // FLOWER PRODUCTS (3.5g)
        ['name' => 'Stay Puft Flower', 'strain' => 'Stay Puft', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW3725J-SP'],
        ['name' => 'Garlic Gravity Flower', 'strain' => 'Garlic Gravity', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW3725J-GG'],
        ['name' => 'Triple Burger Flower', 'strain' => 'Triple Burger', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 31.0, 'cbd' => 0.2, 'batch' => 'SW063025-J35-TB'],
        ['name' => 'Sherb Cream Pie Flower', 'strain' => 'Sherb Cream Pie', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 24.7, 'cbd' => 0.5, 'batch' => 'SW3725J-SCP'],
        ['name' => 'Charmz Flower', 'strain' => 'Charmz', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 27.2, 'cbd' => 0.5, 'batch' => 'SW3725J-CMZ'],
        ['name' => 'Melted Strawberries Flower', 'strain' => 'Melted Strawberries', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 35.2, 'cbd' => 0.3, 'batch' => 'SW063025-J35-MS'],
        ['name' => 'Peanut Butter Gelato Flower', 'strain' => 'Peanut Butter Gelato', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 28.0, 'cbd' => 0.5, 'batch' => 'SW3725J-PBG'],
        ['name' => 'Kept Secret Flower', 'strain' => 'Kept Secret', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 24.2, 'cbd' => 0.8, 'batch' => 'SW3725J-KS'],
        ['name' => 'Dirt n Worms Flower', 'strain' => 'Dirt n Worms', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 24.9, 'cbd' => 0.6, 'batch' => 'SW3725J-DNW'],
        ['name' => '41 G Flower', 'strain' => '41 G', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 26.1, 'cbd' => 0.5, 'batch' => 'SW3725J-41G'],
        ['name' => 'Gushcanna Flower', 'strain' => 'Gushcanna', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 25.5, 'cbd' => 0.4, 'batch' => 'SW3725J-GC'],
        ['name' => 'Lemon Oreoz Flower', 'strain' => 'Lemon Oreoz', 'category' => 'Flower', 'size' => '3.5g', 'thc' => 26.8, 'cbd' => 0.5, 'batch' => 'SW3725J-LO'],
        
        // PRE-ROLL PRODUCTS (various sizes)
        ['name' => 'Stay Puft Pre-roll 1g', 'strain' => 'Stay Puft', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW040725-PRE1-SP'],
        ['name' => 'Stay Puft Pre-roll 2pk', 'strain' => 'Stay Puft', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW040725-PRE05X2-SP'],
        ['name' => 'Stay Puft Pre-roll 6pk', 'strain' => 'Stay Puft', 'category' => 'Pre-roll', 'size' => '0.5g, 6pk', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW040725-PRE05X6-SP'],
        ['name' => 'Garlic Gravity Pre-roll 1g', 'strain' => 'Garlic Gravity', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW031725-PRE1-GG'],
        ['name' => 'Garlic Gravity Pre-roll 2pk', 'strain' => 'Garlic Gravity', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW051925-PRE05X2-GG'],
        ['name' => 'Garlic Gravity Pre-roll 6pk', 'strain' => 'Garlic Gravity', 'category' => 'Pre-roll', 'size' => '0.5g, 6pk', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW040725-PRE05X6-GG'],
        ['name' => 'Sherb Cream Pie Pre-roll 1g', 'strain' => 'Sherb Cream Pie', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 24.7, 'cbd' => 0.5, 'batch' => 'SW031725-PRE1-SCP'],
        ['name' => 'Sherb Cream Pie Pre-roll 2pk', 'strain' => 'Sherb Cream Pie', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 24.7, 'cbd' => 0.5, 'batch' => 'SW040725-PRE05X2-SCP'],
        ['name' => 'Triple Burger Pre-roll 2pk', 'strain' => 'Triple Burger', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 31.0, 'cbd' => 0.2, 'batch' => 'SW063025-PRE05X2-TB'],
        ['name' => 'Melted Strawberries Pre-roll 2pk', 'strain' => 'Melted Strawberries', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 35.2, 'cbd' => 0.3, 'batch' => 'SW063025-PRE05X2-MS'],
        ['name' => 'Peanut Butter Gelato Pre-roll 2pk', 'strain' => 'Peanut Butter Gelato', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 28.0, 'cbd' => 0.5, 'batch' => 'SW060925-PRE05X2-PBG'],
        ['name' => 'Peanut Butter Gelato Pre-roll 6pk', 'strain' => 'Peanut Butter Gelato', 'category' => 'Pre-roll', 'size' => '0.5g, 6pk', 'thc' => 28.0, 'cbd' => 0.5, 'batch' => 'SW060925-PRE5X6-PBG'],
        ['name' => 'White Apple Runtz Pre-roll', 'strain' => 'White Apple Runtz', 'category' => 'Pre-roll', 'size' => '0.5g', 'thc' => 29.8, 'cbd' => 0.4, 'batch' => 'SW063025-PRE05-WAR'],
        ['name' => 'Superboof Pre-roll 2pk', 'strain' => 'Superboof', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 31.0, 'cbd' => 0.2, 'batch' => 'SW060925-PRE05X2-SB'],
        
        // HASH HOLE PRODUCTS
        ['name' => 'Stay Puft Hash Hole', 'strain' => 'Stay Puft', 'category' => 'Hash Hole', 'size' => '1g', 'thc' => 36.6, 'cbd' => 0.4, 'batch' => 'SW051925-HH-SPXPR'],
        ['name' => 'Sherb Cream Pie Hash Hole', 'strain' => 'Sherb Cream Pie', 'category' => 'Hash Hole', 'size' => '1g', 'thc' => 39.1, 'cbd' => 0.3, 'batch' => 'SW051925-HH-SCPXPR'],
    ];
    
    $created = 0;
    $updated = 0;
    
    echo "Creating comprehensive Skyworld product catalog...\n";
    
    foreach ($products_data as $product_info) {
        $strain_name = $product_info['strain'];
        $product_name = $product_info['name'];
        
        // Get strain classification
        $strain_data = $strain_classifications[$strain_name] ?? null;
        if (!$strain_data) {
            echo "❌ No classification for strain: {$strain_name}\n";
            continue;
        }
        
        // Check if product exists
        $existing = get_page_by_title($product_name, OBJECT, 'cannabis_product');
        
        if ($existing) {
            $post_id = $existing->ID;
            echo "🔄 Updating: {$product_name}\n";
            $updated++;
        } else {
            // Create new product
            $post_id = wp_insert_post([
                'post_title' => $product_name,
                'post_type' => 'cannabis_product',
                'post_status' => 'publish',
                'post_content' => "Premium {$strain_data['type']} {$product_info['category']} from our {$strain_name} strain. {$strain_data['genetics']} genetics deliver exceptional quality and consistency.",
            ]);
            
            if (is_wp_error($post_id)) {
                echo "❌ Failed to create: {$product_name}\n";
                continue;
            }
            
            echo "✅ Created: {$product_name}\n";
            $created++;
        }
        
        // Update all fields with correct data
        update_field('strain_name', $strain_name, $post_id);
        update_field('strain_type', $strain_data['type'], $post_id);
        update_field('genetics', $strain_data['genetics'], $post_id);
        update_field('product_category', $product_info['category'], $post_id);
        update_field('size_weight', $product_info['size'], $post_id);
        update_field('thc_content', $product_info['thc'], $post_id);
        update_field('cbd_content', $product_info['cbd'], $post_id);
        update_field('batch_number', $product_info['batch'], $post_id);
        update_field('lab_name', 'SJR Horticulture', $post_id);
        update_field('cultivation_notes', 'Indoor · Skyworld Standard', $post_id);
        
        // Set taxonomies
        wp_set_post_terms($post_id, [$product_info['category']], 'product_type');
        wp_set_post_terms($post_id, [$strain_data['type']], 'strain_type');
        
        // Link to strain post if exists
        $strain_post = get_page_by_title($strain_name, OBJECT, 'strain');
        if ($strain_post) {
            update_field('strain_relationship', $strain_post->ID, $post_id);
        }
    }
    
    echo "\n" . str_repeat("=", 60) . "\n";
    echo "COMPREHENSIVE CATALOG COMPLETE!\n";
    echo "Products created: {$created}\n";
    echo "Products updated: {$updated}\n";
    echo "Total products: " . wp_count_posts('cannabis_product')->publish . "\n";
    echo str_repeat("=", 60) . "\n";
}

// Run the fixes
if (php_sapi_name() === 'cli') {
    echo "SKYWORLD PRODUCT CATALOG IMPORT & FIX\n";
    echo str_repeat("=", 60) . "\n";
    
    // First fix existing products
    skyworld_import_fix_products();
    
    echo "\n";
    
    // Then create comprehensive catalog
    skyworld_create_comprehensive_products();
}
?>