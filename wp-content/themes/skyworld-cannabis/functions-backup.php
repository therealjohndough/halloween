<?php
/**
 * Skyworld Cannabis Theme Functions
 * 
 * Handles theme setup, ACF fields, enqueues, and age gate integration
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function skyworld_theme_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'skyworld-cannabis'),
        'footer' => __('Footer Menu', 'skyworld-cannabis'),
    ));
    
    // Image sizes
    add_image_size('hero-slide', 1920, 1080, true);
    add_image_size('product-thumb', 400, 400, true);
    add_image_size('press-logo', 200, 100, false);
}

/**
 * Fallback menu for primary navigation
 */
function skyworld_fallback_menu() {
    echo '<ul class="nav-menu mobile-nav">';
    echo '<li><a href="/strains">Our Flower</a></li>';
    echo '<li><a href="/products">Products</a></li>';
    echo '<li><a href="/our-story">Our Story</a></li>';
    echo '<li><a href="/store-locator">Where to Find Us</a></li>';
    echo '<li><a href="/contact">Contact</a></li>';
    echo '</ul>';
}
add_action('after_setup_theme', 'skyworld_theme_setup');

/**
 * Get Hero Slider Data
 */
function skyworld_get_hero_slider_data() {
    return [
        [
            'card_id' => 1,
            'badge_text' => 'OUR STORY',
            'headline' => 'PREMIUM INDOOR CULTIVATION',
            'subheadline' => 'Born from a passion for the plant',
            'description' => 'True indoor growing. Maximum trichome development. Uncompromising quality, rooted in New York.',
            'button_text' => 'LEARN MORE',
            'button_link' => '/about/'
        ],
        [
            'card_id' => 2,
            'badge_text' => 'NEW MERCH JUST DROPPED',
            'headline' => 'SKYWORLD APPAREL',
            'subheadline' => 'Rep the brand. Wear the legacy.',
            'description' => 'Premium streetwear meets cannabis culture. Official SkyWorld collection available now.',
            'button_text' => 'SHOP NOW',
            'button_link' => 'https://skyworldgallery.com/collections/skyworld-merch'
        ],
        [
            'card_id' => 3,
            'badge_text' => 'ROOTED IN TRADITION',
            'headline' => 'INDIGENOUS-OWNED',
            'subheadline' => 'Honoring our heritage. Elevating the craft.',
            'description' => 'From the Tuscarora tradition of Skyworld—a sacred place of origin and return. We cultivate with intention and purpose.',
            'button_text' => 'OUR STORY',
            'button_link' => '/about/'
        ],
        [
            'card_id' => 4,
            'badge_text' => 'EXCLUSIVE STRAINS',
            'headline' => 'CURATED GENETICS',
            'subheadline' => 'Strains you won\'t find anywhere else',
            'description' => 'From Charmz to Garlic Gravity—our hand-selected genetics deliver unmatched flavor, potency, and experience.',
            'button_text' => 'EXPLORE STRAINS',
            'button_link' => '/products/'
        ],
        [
            'card_id' => 5,
            'badge_text' => 'EXCLUSIVE DROP',
            'headline' => 'HALL OF FLAME',
            'subheadline' => 'SkyWorld × StayMelo Collaboration',
            'description' => 'Two legends unite. Limited edition strains and exclusive drops from this groundbreaking partnership.',
            'button_text' => 'GET NOTIFIED',
            'button_link' => '/hall-of-flame/'
        ]
    ];
}

/**
 * Enqueue Scripts and Styles
 */
function skyworld_enqueue_assets() {
    // Main stylesheet
    wp_enqueue_style(
        'skyworld-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Design System CSS (load first)
    wp_enqueue_style(
        'skyworld-design-system',
        get_template_directory_uri() . '/assets/css/design-system.css',
        array('skyworld-style'),
        wp_get_theme()->get('Version')
    );
    
    // Main CSS
    wp_enqueue_style(
        'skyworld-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('skyworld-design-system'),
        wp_get_theme()->get('Version')
    );
    
    // Page Builder CSS (only on page builder pages)
    if (is_page_template('template-page-builder.php')) {
        wp_enqueue_style(
            'skyworld-page-builder',
            get_template_directory_uri() . '/assets/css/page-builder.css',
            array('skyworld-main'),
            wp_get_theme()->get('Version')
        );
    }
    
    // Main JavaScript
    wp_enqueue_script(
        'skyworld-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Localize script for AJAX
    wp_localize_script('skyworld-main', 'skyworld_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('skyworld_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'skyworld_enqueue_assets');

/**
 * Register Custom Post Types
 */
function skyworld_register_post_types() {
    // Strains CPT
    register_post_type('strains', array(
        'labels' => array(
            'name' => __('Strains', 'skyworld-cannabis'),
            'singular_name' => __('Strain', 'skyworld-cannabis'),
            'menu_name' => __('Strains', 'skyworld-cannabis'),
            'add_new' => __('Add New Strain', 'skyworld-cannabis'),
            'add_new_item' => __('Add New Strain', 'skyworld-cannabis'),
            'edit_item' => __('Edit Strain', 'skyworld-cannabis'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-carrot',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'strains'),
    ));
    
    // Products CPT
    register_post_type('products', array(
        'labels' => array(
            'name' => __('Products', 'skyworld-cannabis'),
            'singular_name' => __('Product', 'skyworld-cannabis'),
            'menu_name' => __('Products', 'skyworld-cannabis'),
            'add_new' => __('Add New Product', 'skyworld-cannabis'),
            'add_new_item' => __('Add New Product', 'skyworld-cannabis'),
            'edit_item' => __('Edit Product', 'skyworld-cannabis'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-products',
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'products'),
    ));
}
add_action('init', 'skyworld_register_post_types');

/**
 * Register Taxonomies
 */
function skyworld_register_taxonomies() {
    // Product Type taxonomy
    register_taxonomy('product_type', array('products'), array(
        'labels' => array(
            'name' => __('Product Types', 'skyworld-cannabis'),
            'singular_name' => __('Product Type', 'skyworld-cannabis'),
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'product-type'),
    ));
    
    // Strain Type taxonomy
    register_taxonomy('strain_type', array('strains'), array(
        'labels' => array(
            'name' => __('Strain Types', 'skyworld-cannabis'),
            'singular_name' => __('Strain Type', 'skyworld-cannabis'),
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'strain-type'),
    ));
    
    // Effects taxonomy
    register_taxonomy('effects', array('strains', 'products'), array(
        'labels' => array(
            'name' => __('Effects', 'skyworld-cannabis'),
            'singular_name' => __('Effect', 'skyworld-cannabis'),
        ),
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'effects'),
    ));
}
add_action('init', 'skyworld_register_taxonomies');

/**
 * ACF Field Groups
 */
function skyworld_register_acf_fields() {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }
    
    // Homepage Fields
    acf_add_local_field_group(array(
        'key' => 'group_homepage',
        'title' => 'Homepage Sections',
        'fields' => array(
            // Hero Section
            array(
                'key' => 'field_hero_slides',
                'label' => 'Hero Slides',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'Slide Title',
                        'name' => 'slide_title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_slide_subtitle',
                        'label' => 'Slide Subtitle',
                        'name' => 'slide_subtitle',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_slide_media_type',
                        'label' => 'Media Type',
                        'name' => 'slide_media_type',
                        'type' => 'select',
                        'choices' => array(
                            'image' => 'Image',
                            'video' => 'Video',
                        ),
                        'default_value' => 'image',
                    ),
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'Background Image',
                        'name' => 'slide_image',
                        'type' => 'image',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_slide_media_type',
                                    'operator' => '==',
                                    'value' => 'image',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_slide_video',
                        'label' => 'Background Video',
                        'name' => 'slide_video',
                        'type' => 'file',
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_slide_media_type',
                                    'operator' => '==',
                                    'value' => 'video',
                                ),
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_slide_cta_text',
                        'label' => 'CTA Text',
                        'name' => 'slide_cta_text',
                        'type' => 'text',
                        'default_value' => 'Explore Our Flower',
                    ),
                    array(
                        'key' => 'field_slide_cta_link',
                        'label' => 'CTA Link',
                        'name' => 'slide_cta_link',
                        'type' => 'link',
                    ),
                ),
                'min' => 1,
                'max' => 5,
                'layout' => 'block',
            ),
            
            // Press Section
            array(
                'key' => 'field_press_logos',
                'label' => 'Press Logos',
                'name' => 'press_logos',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_press_logo',
                        'label' => 'Logo',
                        'name' => 'press_logo',
                        'type' => 'image',
                    ),
                    array(
                        'key' => 'field_press_name',
                        'label' => 'Publication Name',
                        'name' => 'press_name',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_press_link',
                        'label' => 'Article Link',
                        'name' => 'press_link',
                        'type' => 'url',
                    ),
                ),
                'min' => 3,
                'max' => 6,
                'layout' => 'block',
            ),
            
            // Story Section
            array(
                'key' => 'field_story_title',
                'label' => 'Our Story Title',
                'name' => 'story_title',
                'type' => 'text',
                'default_value' => 'Our Story',
            ),
            array(
                'key' => 'field_story_content',
                'label' => 'Story Content',
                'name' => 'story_content',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_story_video',
                'label' => 'Story Video',
                'name' => 'story_video',
                'type' => 'file',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
    ));
    
    // Strain Fields
    acf_add_local_field_group(array(
        'key' => 'group_strain',
        'title' => 'Strain Information',
        'fields' => array(
            array(
                'key' => 'field_strain_description',
                'label' => 'Description',
                'name' => 'strain_description',
                'type' => 'wysiwyg',
            ),
            array(
                'key' => 'field_thc_percentage',
                'label' => 'THC Percentage',
                'name' => 'thc_percentage',
                'type' => 'number',
                'min' => 0,
                'max' => 100,
                'step' => 0.1,
            ),
            array(
                'key' => 'field_cbd_percentage',
                'label' => 'CBD Percentage',
                'name' => 'cbd_percentage',
                'type' => 'number',
                'min' => 0,
                'max' => 100,
                'step' => 0.1,
            ),
            array(
                'key' => 'field_strain_lineage',
                'label' => 'Lineage',
                'name' => 'strain_lineage',
                'type' => 'text',
            ),
            array(
                'key' => 'field_strain_effects',
                'label' => 'Effects',
                'name' => 'strain_effects',
                'type' => 'repeater',
                'sub_fields' => array(
                    array(
                        'key' => 'field_effect_name',
                        'label' => 'Effect',
                        'name' => 'effect_name',
                        'type' => 'text',
                    ),
                ),
                'min' => 3,
                'max' => 6,
                'layout' => 'table',
            ),
            array(
                'key' => 'field_coa_file',
                'label' => 'COA Document',
                'name' => 'coa_file',
                'type' => 'file',
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'strains',
                ),
            ),
        ),
    ));
}
add_action('acf/init', 'skyworld_register_acf_fields');

/**
 * Security: Disable file editing in admin
 */
define('DISALLOW_FILE_EDIT', true);

/**
 * Custom excerpt length
 */
function skyworld_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'skyworld_excerpt_length');

/**
 * Custom excerpt more
 */
function skyworld_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'skyworld_excerpt_more');

/**
 * Customizer Settings
 */
function skyworld_customize_register($wp_customize) {
    // Logo Section
    $wp_customize->add_section('skyworld_logo_section', array(
        'title' => __('Logo Settings', 'skyworld-cannabis'),
        'priority' => 30,
        'description' => __('Upload and customize your SVG logo', 'skyworld-cannabis'),
    ));
    
    // SVG Logo Upload
    $wp_customize->add_setting('skyworld_logo_svg', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'skyworld_logo_svg', array(
        'label' => __('SVG Logo', 'skyworld-cannabis'),
        'description' => __('Upload your SVG logo file', 'skyworld-cannabis'),
        'section' => 'skyworld_logo_section',
        'settings' => 'skyworld_logo_svg',
    )));
    
    // Logo Size
    $wp_customize->add_setting('skyworld_logo_size', array(
        'default' => 180,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('skyworld_logo_size', array(
        'type' => 'range',
        'label' => __('Logo Size (px)', 'skyworld-cannabis'),
        'description' => __('Adjust the width of your logo', 'skyworld-cannabis'),
        'section' => 'skyworld_logo_section',
        'input_attrs' => array(
            'min' => 80,
            'max' => 400,
            'step' => 10,
        ),
    ));
    
    // Logo Color
    $wp_customize->add_setting('skyworld_logo_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'skyworld_logo_color', array(
        'label' => __('Logo Color', 'skyworld-cannabis'),
        'description' => __('Choose the color for your SVG logo', 'skyworld-cannabis'),
        'section' => 'skyworld_logo_section',
        'settings' => 'skyworld_logo_color',
    )));
    
    // Logo Mobile Size
    $wp_customize->add_setting('skyworld_logo_mobile_size', array(
        'default' => 140,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('skyworld_logo_mobile_size', array(
        'type' => 'range',
        'label' => __('Mobile Logo Size (px)', 'skyworld-cannabis'),
        'description' => __('Adjust the width of your logo on mobile devices', 'skyworld-cannabis'),
        'section' => 'skyworld_logo_section',
        'input_attrs' => array(
            'min' => 60,
            'max' => 300,
            'step' => 10,
        ),
    ));
}
add_action('customize_register', 'skyworld_customize_register');

/**
 * Output custom logo styles
 */
function skyworld_logo_custom_styles() {
    $logo_size = get_theme_mod('skyworld_logo_size', 180);
    $logo_mobile_size = get_theme_mod('skyworld_logo_mobile_size', 140);
    $logo_color = get_theme_mod('skyworld_logo_color', '#ffffff');
    
    ?>
    <style type="text/css">
        .custom-logo-svg {
            width: <?php echo esc_attr($logo_size); ?>px;
            height: auto;
            fill: <?php echo esc_attr($logo_color); ?>;
            transition: all 0.3s ease;
        }
        
        .custom-logo-svg path,
        .custom-logo-svg g,
        .custom-logo-svg polygon,
        .custom-logo-svg circle,
        .custom-logo-svg rect {
            fill: <?php echo esc_attr($logo_color); ?>;
        }
        
        .site-logo a {
            display: block;
            line-height: 1;
        }
        
        .logo-text {
            font-family: 'SkyFont-Black', sans-serif;
            font-size: 2rem;
            color: <?php echo esc_attr($logo_color); ?>;
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        
        @media (max-width: 768px) {
            .custom-logo-svg {
                width: <?php echo esc_attr($logo_mobile_size); ?>px;
            }
            
            .logo-text {
                font-size: 1.5rem;
            }
        }
        
        /* Hover effects */
        .site-logo a:hover .custom-logo-svg {
            opacity: 0.8;
            transform: scale(1.05);
        }
        
        .site-logo a:hover .logo-text {
            opacity: 0.8;
        }
    </style>
    <?php
}
add_action('wp_head', 'skyworld_logo_custom_styles');

/**
 * Custom logo function that handles SVG
 */
function skyworld_custom_logo() {
    $custom_logo_svg = get_theme_mod('skyworld_logo_svg');
    $custom_logo_id = get_theme_mod('custom_logo');
    
    if ($custom_logo_svg) {
        // Use custom SVG logo
        $svg_content = file_get_contents($custom_logo_svg);
        if ($svg_content) {
            // Add custom class to SVG
            $svg_content = str_replace('<svg', '<svg class="custom-logo-svg"', $svg_content);
            echo '<a href="' . esc_url(home_url('/')) . '" class="custom-logo-link">' . $svg_content . '</a>';
        }
    } elseif ($custom_logo_id) {
        // Use standard WordPress custom logo
        the_custom_logo();
    } else {
        // Fallback to text logo
        echo '<a href="' . esc_url(home_url('/')) . '" class="logo-text">' . get_bloginfo('name') . '</a>';
    }
}

// Include SEO enhancements
require_once get_template_directory() . '/includes/seo-enhancements.php';