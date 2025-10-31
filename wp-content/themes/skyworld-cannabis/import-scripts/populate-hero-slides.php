<?php
/**
 * Populate ACF Hero Slider with First 3 Slides
 * Uses authentic Skyworld content and uploaded strain images
 */

// Ensure this is run in WordPress context
if (!defined('WPINC')) {
    die('Direct access not allowed');
}

// Get front page ID
$front_page_id = get_option('page_on_front');
if (!$front_page_id) {
    // Get existing front page or create one
    $front_page = get_page_by_path('home');
    if (!$front_page) {
        $front_page_id = wp_insert_post([
            'post_title' => 'Home',
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_content' => ''
        ]);
        update_option('page_on_front', $front_page_id);
        update_option('show_on_front', 'page');
    } else {
        $front_page_id = $front_page->ID;
    }
}

echo "🏠 Working with front page ID: $front_page_id\n";

// Process and upload images to WordPress media library
function skyworld_upload_strain_image($image_path, $image_name) {
    if (!file_exists($image_path)) {
        echo "⚠️  Image not found: $image_path\n";
        return false;
    }
    
    // Check if image already exists in media library
    $existing = get_posts([
        'post_type' => 'attachment',
        'meta_query' => [
            [
                'key' => '_wp_attached_file',
                'value' => basename($image_path),
                'compare' => 'LIKE'
            ]
        ],
        'posts_per_page' => 1
    ]);
    
    if (!empty($existing)) {
        echo "✅ Using existing image: " . basename($image_path) . "\n";
        return wp_get_attachment_url($existing[0]->ID);
    }
    
    // Upload new image
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    $file_array = [
        'name' => basename($image_path),
        'tmp_name' => $image_path,
        'type' => mime_content_type($image_path)
    ];
    
    $attachment_id = media_handle_sideload($file_array, 0, $image_name);
    
    if (is_wp_error($attachment_id)) {
        echo "❌ Failed to upload: " . $attachment_id->get_error_message() . "\n";
        return false;
    }
    
    echo "✅ Uploaded: " . basename($image_path) . " (ID: $attachment_id)\n";
    return wp_get_attachment_url($attachment_id);
}

// Define the 3 hero slides with authentic Skyworld content
$hero_slides_data = [
    [
        'slide_headline' => 'Premium New York Indoor Cannabis',
        'slide_subheadline' => 'Rooted in Indigenous Tradition. Grown with intention. Crafted with respect.',
        'slide_cta_primary' => [
            'text' => 'Explore Our Flower',
            'url' => '/strains/'
        ],
        'slide_cta_secondary' => [
            'text' => 'Find Skyworld Near You',
            'url' => '/store-locator/'
        ],
        'slide_background_path' => '/images/cannabis product images/SKYWORLD-STAY-PUFT-PREMIUM-INDOOR-CANNABIS.avif',
        'slide_featured_strain' => [
            'name' => 'Stay Puft',
            'type' => 'Hybrid',
            'thc' => '25.9%'
        ]
    ],
    [
        'slide_headline' => 'Stay Puft & Garlic Gravity',
        'slide_subheadline' => 'Featured Strains. Premium genetics meet expert cultivation for an unforgettable experience.',
        'slide_cta_primary' => [
            'text' => 'Shop Strains',
            'url' => '/strains/'
        ],
        'slide_cta_secondary' => [
            'text' => 'Learn Our Process',
            'url' => '/our-story/'
        ],
        'slide_background_path' => '/images/cannabis product images/GARLIC-GRAVITY-SKYWORLD-CANNABIS-3.5g.avif',
        'slide_featured_strain' => [
            'name' => 'Garlic Gravity',
            'type' => 'Indica',
            'thc' => '28.2%'
        ]
    ],
    [
        'slide_headline' => 'Find Skyworld Near You',
        'slide_subheadline' => '95+ Store Locations. Your favorite Skyworld strains are closer than you think.',
        'slide_cta_primary' => [
            'text' => 'Store Locator',
            'url' => '/store-locator/'
        ],
        'slide_cta_secondary' => [
            'text' => 'View All Products',
            'url' => '/products/'
        ],
        'slide_background_path' => '/images/cannabis product images/SHERB-CREAM-PIE-35.5G-SKYWORLD-CANNABIS.avif',
        'slide_featured_strain' => [
            'name' => 'Sherb Cream Pie',
            'type' => 'Hybrid',
            'thc' => '24.8%'
        ]
    ]
];

// Process images and prepare ACF data
$acf_hero_slides = [];
$base_path = '/Users/dough/VS Studio Projects/oct30-sw';

foreach ($hero_slides_data as $index => $slide_data) {
    $full_image_path = $base_path . $slide_data['slide_background_path'];
    
    echo "\n--- Processing Slide " . ($index + 1) . ": {$slide_data['slide_headline']} ---\n";
    
    // Upload background image
    $image_url = skyworld_upload_strain_image($full_image_path, $slide_data['slide_featured_strain']['name'] . ' Hero Background');
    
    // Prepare ACF slide data
    $acf_slide = [
        'slide_headline' => $slide_data['slide_headline'],
        'slide_subheadline' => $slide_data['slide_subheadline'],
        'slide_cta_primary' => $slide_data['slide_cta_primary'],
        'slide_cta_secondary' => $slide_data['slide_cta_secondary']
    ];
    
    // Add background image if successfully uploaded
    if ($image_url) {
        // Get attachment ID for ACF image field
        $attachment_id = attachment_url_to_postid($image_url);
        if ($attachment_id) {
            $acf_slide['slide_background'] = $attachment_id;
        }
    }
    
    // Add featured strain info
    $acf_slide['slide_featured_strain'] = $slide_data['slide_featured_strain'];
    
    $acf_hero_slides[] = $acf_slide;
    
    echo "✅ Slide " . ($index + 1) . " prepared: {$slide_data['slide_headline']}\n";
}

// Sample press logos for marquee (you can replace with actual press logos later)
$press_logos_data = [
    [
        'press_logo_name' => 'High Times',
        'press_logo_url' => 'https://hightimes.com'
    ],
    [
        'press_logo_name' => 'Cannabis Business Times',
        'press_logo_url' => 'https://cannabisbusinesstimes.com'
    ],
    [
        'press_logo_name' => 'Leafly',
        'press_logo_url' => 'https://leafly.com'
    ],
    [
        'press_logo_name' => 'MJBizDaily',
        'press_logo_url' => 'https://mjbizdaily.com'
    ],
    [
        'press_logo_name' => 'New York Cannabis Insider',
        'press_logo_url' => '#'
    ]
];

// Update ACF fields
if (function_exists('update_field')) {
    echo "\n🎯 Updating ACF hero slider fields...\n";
    
    // Update hero slides
    $result = update_field('hero_slides', $acf_hero_slides, $front_page_id);
    
    if ($result) {
        echo "✅ Successfully added " . count($acf_hero_slides) . " hero slides\n";
        
        // Display what was added
        foreach ($acf_hero_slides as $index => $slide) {
            echo "   Slide " . ($index + 1) . ": {$slide['slide_headline']}\n";
            echo "   - Featured strain: {$slide['slide_featured_strain']['name']} ({$slide['slide_featured_strain']['type']}, {$slide['slide_featured_strain']['thc']} THC)\n";
        }
    } else {
        echo "❌ Failed to update hero slides\n";
    }
    
    // Update press logos
    $press_result = update_field('press_logos', $press_logos_data, $front_page_id);
    
    if ($press_result) {
        echo "✅ Successfully added " . count($press_logos_data) . " press logos\n";
    } else {
        echo "⚠️  Press logos not updated (may need to configure ACF field first)\n";
    }
    
} else {
    echo "❌ ACF not available - make sure Advanced Custom Fields Pro is installed and activated\n";
}

// Update front page content
$page_content = '<!-- wp:heading {"level":1,"className":"u-d-none"} -->
<h1 class="u-d-none">Skyworld Cannabis - Premium New York Indoor Cannabis</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"u-d-none"} -->
<p class="u-d-none">Premium indoor flower with super-premium quality and love-based cultivation ethos. Rooted in Indigenous tradition.</p>
<!-- /wp:paragraph -->';

wp_update_post([
    'ID' => $front_page_id,
    'post_content' => $page_content
]);

echo "\n✅ Front page content updated with SEO-friendly but hidden text\n";
echo "\n🚀 Hero slider should now be live on the homepage with 3 authentic slides!\n";
echo "📱 Visit your site to see the Jeeter-inspired hero slider in action.\n";

?>