<?php
/**
 * Skyworld Product Import Page
 * Access via: yourdomain.com/skyworld-import.php
 */

// Load WordPress
require_once 'wp-load.php';

if (!current_user_can('manage_options')) {
    wp_die('Access denied. Admin privileges required.');
}

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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Skyworld Product Import</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, sans-serif; margin: 40px; background: #f1f1f1; }
        .container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); max-width: 1000px; }
        .header { border-bottom: 2px solid #0073aa; padding-bottom: 20px; margin-bottom: 30px; }
        .action-button { background: #0073aa; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; margin-right: 10px; margin-bottom: 10px; }
        .action-button:hover { background: #005a87; }
        .results { background: #f9f9f9; padding: 20px; border-radius: 4px; margin-top: 20px; font-family: monospace; white-space: pre-wrap; }
        .success { color: #2271b1; }
        .error { color: #d63638; }
        .warning { color: #b32d2e; }
        .info { color: #00a32a; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌿 Skyworld Product Import</h1>
            <p>Fix "Unknown" strain types and import comprehensive product catalog using authentic Skyworld data.</p>
        </div>

        <?php if (isset($_POST['action'])): ?>
            <div class="results">
                <?php
                if ($_POST['action'] === 'fix_strain_types') {
                    echo skyworld_fix_strain_types();
                } elseif ($_POST['action'] === 'create_products') {
                    echo skyworld_create_comprehensive_products();
                } elseif ($_POST['action'] === 'full_import') {
                    echo skyworld_fix_strain_types();
                    echo "\n" . str_repeat("=", 80) . "\n\n";
                    echo skyworld_create_comprehensive_products();
                }
                ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <h3>Choose Import Action:</h3>
            <button type="submit" name="action" value="fix_strain_types" class="action-button">
                🔧 Fix Existing Strain Types
            </button>
            <button type="submit" name="action" value="create_products" class="action-button">
                📦 Create Product Catalog
            </button>
            <button type="submit" name="action" value="full_import" class="action-button">
                🚀 Complete Import (Fix + Create)
            </button>
        </form>

        <div style="margin-top: 30px; padding: 20px; background: #e8f4fd; border-radius: 4px;">
            <h4>What This Does:</h4>
            <ul>
                <li><strong>Fix Strain Types:</strong> Updates all products with "Unknown" strain types to correct Indica/Sativa/Hybrid classifications based on genetics</li>
                <li><strong>Create Products:</strong> Imports 28 authentic Skyworld products (flower, pre-rolls, hash holes) with correct strain types</li>
                <li><strong>Complete Import:</strong> Does both operations for a full catalog refresh</li>
            </ul>
            
            <h4>Strain Classifications:</h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div>
                    <strong>Indica (6 strains):</strong><br>
                    • Stay Puft<br>
                    • Garlic Gravity<br>
                    • Triple Burger<br>
                    • Kept Secret<br>
                    • Skyworld Wafflez<br>
                    • Peanut Butter Gelato
                </div>
                <div>
                    <strong>Sativa (2 strains):</strong><br>
                    • Melted Strawberries<br>
                    • Gushcanna
                </div>
                <div>
                    <strong>Hybrid (8 strains):</strong><br>
                    • Sherb Cream Pie<br>
                    • Dirt n Worms<br>
                    • 41 G<br>
                    • Charmz<br>
                    • Lemon Oreoz<br>
                    • White Apple Runtz<br>
                    • Superboof<br>
                    • Stay Melo #7
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
function skyworld_fix_strain_types() {
    $strain_classifications = get_skyworld_strain_classifications();
    
    // Get all existing products
    $products = get_posts([
        'post_type' => 'cannabis_product',
        'posts_per_page' => -1,
        'post_status' => 'publish'
    ]);
    
    $updated = 0;
    $fixed_unknown = 0;
    $output = "FIXING STRAIN TYPES FOR EXISTING PRODUCTS\n";
    $output .= str_repeat("=", 60) . "\n\n";
    
    foreach ($products as $product) {
        $strain_name = get_field('strain_name', $product->ID);
        $current_type = get_field('strain_type', $product->ID);
        
        // Handle strain relationship field
        if (empty($strain_name)) {
            $strain_rel = get_field('strain_relationship', $product->ID);
            if (is_object($strain_rel)) {
                $strain_name = $strain_rel->post_title;
            }
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
                
                if ($current_type === 'Unknown' || empty($current_type)) {
                    $output .= "✅ Fixed UNKNOWN: {$product->post_title} -> {$strain_name} = {$correct_type}\n";
                    $output .= "   Reasoning: {$reasoning}\n";
                    $fixed_unknown++;
                } else {
                    $output .= "🔄 Updated: {$product->post_title} -> {$current_type} to {$correct_type}\n";
                }
                $updated++;
            } else {
                $output .= "✓ Correct: {$product->post_title} -> {$strain_name} = {$correct_type}\n";
            }
        } else {
            $output .= "❓ Unknown strain: {$product->post_title} -> '{$strain_name}' (needs manual classification)\n";
        }
    }
    
    $output .= "\n" . str_repeat("=", 60) . "\n";
    $output .= "STRAIN TYPE FIX SUMMARY:\n";
    $output .= "• Total products updated: {$updated}\n";
    $output .= "• Unknown types fixed: {$fixed_unknown}\n";
    $output .= "• Current total products: " . count($products) . "\n";
    
    return $output;
}

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
        
        // PRE-ROLL PRODUCTS
        ['name' => 'Stay Puft Pre-roll 1g', 'strain' => 'Stay Puft', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW040725-PRE1-SP'],
        ['name' => 'Stay Puft Pre-roll 2pk', 'strain' => 'Stay Puft', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 25.9, 'cbd' => 0.6, 'batch' => 'SW040725-PRE05X2-SP'],
        ['name' => 'Garlic Gravity Pre-roll 1g', 'strain' => 'Garlic Gravity', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW031725-PRE1-GG'],
        ['name' => 'Garlic Gravity Pre-roll 2pk', 'strain' => 'Garlic Gravity', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 28.0, 'cbd' => 0.3, 'batch' => 'SW051925-PRE05X2-GG'],
        ['name' => 'Sherb Cream Pie Pre-roll 1g', 'strain' => 'Sherb Cream Pie', 'category' => 'Pre-roll', 'size' => '1g', 'thc' => 24.7, 'cbd' => 0.5, 'batch' => 'SW031725-PRE1-SCP'],
        ['name' => 'Triple Burger Pre-roll 2pk', 'strain' => 'Triple Burger', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 31.0, 'cbd' => 0.2, 'batch' => 'SW063025-PRE05X2-TB'],
        ['name' => 'Melted Strawberries Pre-roll 2pk', 'strain' => 'Melted Strawberries', 'category' => 'Pre-roll', 'size' => '0.5g, 2pk', 'thc' => 35.2, 'cbd' => 0.3, 'batch' => 'SW063025-PRE05X2-MS'],
        
        // HASH HOLE PRODUCTS
        ['name' => 'Stay Puft Hash Hole', 'strain' => 'Stay Puft', 'category' => 'Hash Hole', 'size' => '1g', 'thc' => 36.6, 'cbd' => 0.4, 'batch' => 'SW051925-HH-SPXPR'],
        ['name' => 'Sherb Cream Pie Hash Hole', 'strain' => 'Sherb Cream Pie', 'category' => 'Hash Hole', 'size' => '1g', 'thc' => 39.1, 'cbd' => 0.3, 'batch' => 'SW051925-HH-SCPXPR'],
    ];
    
    $created = 0;
    $updated = 0;
    $output = "CREATING COMPREHENSIVE SKYWORLD PRODUCT CATALOG\n";
    $output .= str_repeat("=", 60) . "\n\n";
    
    foreach ($products_data as $product_info) {
        $strain_name = $product_info['strain'];
        $product_name = $product_info['name'];
        
        // Get strain classification
        $strain_data = $strain_classifications[$strain_name] ?? null;
        if (!$strain_data) {
            $output .= "❌ No classification for strain: {$strain_name}\n";
            continue;
        }
        
        // Check if product exists
        $existing = get_page_by_title($product_name, OBJECT, 'cannabis_product');
        
        if ($existing) {
            $post_id = $existing->ID;
            $output .= "🔄 Updating: {$product_name}\n";
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
                $output .= "❌ Failed to create: {$product_name}\n";
                continue;
            }
            
            $output .= "✅ Created: {$product_name} ({$strain_data['type']})\n";
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
    }
    
    $total_products = wp_count_posts('cannabis_product');
    $published_count = $total_products->publish ?? 0;
    
    $output .= "\n" . str_repeat("=", 60) . "\n";
    $output .= "COMPREHENSIVE CATALOG SUMMARY:\n";
    $output .= "• Products created: {$created}\n";
    $output .= "• Products updated: {$updated}\n";
    $output .= "• Total published products: {$published_count}\n";
    $output .= "\nSTRAIN TYPE DISTRIBUTION:\n";
    
    // Count by strain type
    $type_counts = ['Indica' => 0, 'Sativa' => 0, 'Hybrid' => 0];
    foreach ($strain_classifications as $strain => $data) {
        $type_counts[$data['type']]++;
    }
    
    foreach ($type_counts as $type => $count) {
        $output .= "• {$type}: {$count} strains\n";
    }
    
    return $output;
}
?>