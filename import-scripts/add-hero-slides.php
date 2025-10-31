<?php
/**
 * Add Default Hero Slides for Front Page
 * Run this with WP-CLI: wp eval-file import-scripts/add-hero-slides.php
 */

if (!function_exists('get_field')) {
    echo "ACF not available!\n";
    exit;
}

// Get or create front page
$front_page = get_page_by_path('home');
if (!$front_page) {
    $front_page_id = get_option('page_on_front');
    if (!$front_page_id) {
        // Create front page
        $front_page_id = wp_insert_post([
            'post_title' => 'Home',
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);
        
        // Set as front page
        update_option('page_on_front', $front_page_id);
        update_option('show_on_front', 'page');
        
        echo "Created front page with ID: $front_page_id\n";
    }
} else {
    $front_page_id = $front_page->ID;
}

// Sample hero slides data
$hero_slides = [
    [
        'slide_title' => 'Premium New York Cannabis',
        'slide_subtitle' => 'Skyworld Cannabis',
        'slide_cta_text' => 'Explore Our Flower',
        'slide_cta_link' => '/products/',
        'slide_media_type' => 'image'
    ],
    [
        'slide_title' => 'Stay Puft & Garlic Gravity',
        'slide_subtitle' => 'Featured Strains',
        'slide_cta_text' => 'Shop Strains',
        'slide_cta_link' => '/strains/',
        'slide_media_type' => 'image'
    ],
    [
        'slide_title' => 'Find Skyworld Near You',
        'slide_subtitle' => '95+ Store Locations',
        'slide_cta_text' => 'Store Locator',
        'slide_cta_link' => '/store-locator/',
        'slide_media_type' => 'image'
    ]
];

// Update the hero slides field
if (function_exists('update_field')) {
    $result = update_field('hero_slides', $hero_slides, $front_page_id);
    
    if ($result) {
        echo "✅ Successfully added " . count($hero_slides) . " hero slides to front page (ID: $front_page_id)\n";
        
        // Display what was added
        foreach ($hero_slides as $index => $slide) {
            echo "   Slide " . ($index + 1) . ": {$slide['slide_title']} - {$slide['slide_subtitle']}\n";
        }
    } else {
        echo "❌ Failed to add hero slides\n";
    }
} else {
    echo "❌ update_field function not available\n";
}

// Also add some basic page content
$page_content = '<!-- wp:heading {"level":1} -->
<h1>Welcome to Skyworld Cannabis</h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Premium indoor flower with super-premium quality and love-based cultivation ethos.</p>
<!-- /wp:paragraph -->';

wp_update_post([
    'ID' => $front_page_id,
    'post_content' => $page_content
]);

echo "✅ Front page content updated\n";
echo "🚀 Hero slider should now be visible on the homepage!\n";
?>