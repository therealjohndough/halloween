<?php
/**
 * Skyworld Cannabis Theme Functions - STABLE VERSION
 */

if (!defined('ABSPATH')) {
    exit;
}

function skyworld_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    
    register_nav_menus(array(
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ));
}
add_action('after_setup_theme', 'skyworld_theme_setup');

/**
 * Enqueue styles and scripts
 */
function skyworld_cannabis_scripts() {
    // Main theme stylesheet
    wp_enqueue_style('skyworld-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
    
    // Design system
    wp_enqueue_style('skyworld-design-system', get_template_directory_uri() . '/assets/css/design-system.css', array(), '1.0.0');
    
    // Hero slider styles and scripts (only on front page)
    if (is_front_page()) {
        wp_enqueue_style('skyworld-hero-slider', get_template_directory_uri() . '/assets/css/hero-slider.css', array('skyworld-design-system'), '1.0.0');
        wp_enqueue_script('skyworld-hero-slider', get_template_directory_uri() . '/assets/js/hero-slider.js', array(), '1.0.0', true);
    }
    
    // Main theme script
    wp_enqueue_script('skyworld-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'skyworld_cannabis_scripts');

/**
 * Register Custom Post Types
 */
function skyworld_register_post_types() {
    // Strains CPT
    register_post_type('strains', array(
        'labels' => array(
            'name' => 'Strains',
            'singular_name' => 'Strain',
            'add_new' => 'Add New Strain',
            'add_new_item' => 'Add New Strain',
            'edit_item' => 'Edit Strain',
            'new_item' => 'New Strain',
            'view_item' => 'View Strain',
            'search_items' => 'Search Strains',
            'not_found' => 'No strains found',
            'not_found_in_trash' => 'No strains found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'strains'),
        'menu_icon' => 'dashicons-carrot',
        'capability_type' => 'post',
        'hierarchical' => false,
    ));
    
    // Products CPT
    register_post_type('products', array(
        'labels' => array(
            'name' => 'Products',
            'singular_name' => 'Product',
            'add_new' => 'Add New Product',
            'add_new_item' => 'Add New Product',
            'edit_item' => 'Edit Product',
            'new_item' => 'New Product',
            'view_item' => 'View Product',
            'search_items' => 'Search Products',
            'not_found' => 'No products found',
            'not_found_in_trash' => 'No products found in trash'
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'rewrite' => array('slug' => 'products'),
        'menu_icon' => 'dashicons-products',
        'capability_type' => 'post',
        'hierarchical' => false,
    ));
    
    // Flush rewrite rules on theme activation
    flush_rewrite_rules();
}
add_action('init', 'skyworld_register_post_types');

/**
 * Register Custom Taxonomies
 */
function skyworld_register_taxonomies() {
    // Strain Types
    register_taxonomy('strain_type', 'strains', array(
        'labels' => array(
            'name' => 'Strain Types',
            'singular_name' => 'Strain Type',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'strain-type'),
    ));
    
    // Product Types
    register_taxonomy('product_type', 'products', array(
        'labels' => array(
            'name' => 'Product Types',
            'singular_name' => 'Product Type',
        ),
        'hierarchical' => true,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'product-type'),
    ));
    
    // Effects
    register_taxonomy('effects', array('strains', 'products'), array(
        'labels' => array(
            'name' => 'Effects',
            'singular_name' => 'Effect',
        ),
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'effects'),
    ));
}
add_action('init', 'skyworld_register_taxonomies');

/**
 * Include ACF field definitions
 */
if (function_exists('acf_add_local_field_group')) {
    include_once get_template_directory() . '/includes/acf-hero-fields.php';
}

/**
 * Theme activation hook - ensure CPTs are registered
 */
function skyworld_theme_activation() {
    // Re-register CPTs and flush rewrite rules
    skyworld_register_post_types();
    skyworld_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'skyworld_theme_activation');

function skyworld_custom_logo() {
    if (function_exists('the_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>';
    }
}

function skyworld_fallback_menu() {
    echo '<ul class="nav-menu mobile-nav">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="/products">Products</a></li>';
    echo '<li><a href="/about">About</a></li>';
    echo '<li><a href="/store-locator">Store Locator</a></li>';
    echo '</ul>';
}
