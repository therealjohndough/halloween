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

function skyworld_enqueue_assets() {
    wp_enqueue_style('skyworld-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Only load if files exist
    if (file_exists(get_template_directory() . '/assets/css/design-system.css')) {
        wp_enqueue_style('skyworld-design-system', 
            get_template_directory_uri() . '/assets/css/design-system.css', 
            array('skyworld-style'), '1.0.0');
    }
    
    if (file_exists(get_template_directory() . '/assets/css/main.css')) {
        wp_enqueue_style('skyworld-main', 
            get_template_directory_uri() . '/assets/css/main.css', 
            array('skyworld-style'), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'skyworld_enqueue_assets');

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
