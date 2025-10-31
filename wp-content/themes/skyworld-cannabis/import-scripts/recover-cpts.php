<?php
/**
 * Flush WordPress rewrite rules and re-register CPTs
 * Run this after updating Custom Post Types
 */

// Ensure this is run in WordPress context
if (!defined('WPINC')) {
    die('Direct access not allowed');
}

echo "🔄 Flushing WordPress rewrite rules and re-registering CPTs...\n";

// Force re-registration of CPTs
do_action('init');

// Flush rewrite rules
flush_rewrite_rules(false);

echo "✅ Rewrite rules flushed!\n";
echo "✅ Custom Post Types should now be visible in WordPress admin\n";

// Check if CPTs are registered
$post_types = get_post_types(array('public' => true), 'names');

echo "\n📋 Currently registered public post types:\n";
foreach ($post_types as $post_type) {
    echo "  - $post_type\n";
}

// Check for strains and products specifically
if (in_array('strains', $post_types)) {
    echo "\n✅ Strains CPT is registered\n";
    
    $strains_count = wp_count_posts('strains');
    echo "   Published strains: " . $strains_count->publish . "\n";
    echo "   Draft strains: " . $strains_count->draft . "\n";
} else {
    echo "\n❌ Strains CPT not found\n";
}

if (in_array('products', $post_types)) {
    echo "✅ Products CPT is registered\n";
    
    $products_count = wp_count_posts('products');
    echo "   Published products: " . $products_count->publish . "\n";
    echo "   Draft products: " . $products_count->draft . "\n";
} else {
    echo "❌ Products CPT not found\n";
}

echo "\n🎯 CPT recovery complete! Check WordPress admin > Strains and Products\n";

?>