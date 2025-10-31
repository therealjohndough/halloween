<?php
/**
 * EMERGENCY SAFE MODE - Skyworld Cannabis Theme
 * Minimal functions to prevent crashes
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Minimal theme setup to prevent crashes
 */
function skyworld_emergency_setup() {
    // Only the most basic theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'skyworld_emergency_setup');

/**
 * Safe CSS loading - only load files that exist
 */
function skyworld_emergency_styles() {
    // Main theme stylesheet
    wp_enqueue_style('skyworld-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Only load main.css if it exists
    $main_css = get_template_directory() . '/assets/css/main.css';
    if (file_exists($main_css)) {
        wp_enqueue_style(
            'skyworld-main',
            get_template_directory_uri() . '/assets/css/main.css',
            array('skyworld-style'),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'skyworld_emergency_styles');

/**
 * Safe custom logo function
 */
function skyworld_custom_logo() {
    if (function_exists('the_custom_logo') && has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">';
        echo esc_html(get_bloginfo('name'));
        echo '</a>';
    }
}

/**
 * Emergency fallback menu
 */
function skyworld_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about/')) . '">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact/')) . '">Contact</a></li>';
    echo '</ul>';
}