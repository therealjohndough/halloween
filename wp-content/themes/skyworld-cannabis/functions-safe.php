<?php
/**
 * SAFE MODE - Skyworld Cannabis Theme Functions
 * Minimal version to prevent crashes while debugging
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Basic Theme Setup - Safe Mode
 */
function skyworld_safe_theme_setup() {
    // Essential theme support only
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Simple menu registration
    register_nav_menus(array(
        'primary' => 'Primary Menu',
    ));
}
add_action('after_setup_theme', 'skyworld_safe_theme_setup');

/**
 * Safe Asset Enqueuing
 */
function skyworld_safe_enqueue_assets() {
    // Only enqueue if files exist
    $stylesheet_uri = get_stylesheet_uri();
    if ($stylesheet_uri) {
        wp_enqueue_style('skyworld-style', $stylesheet_uri, array(), '1.0.0');
    }
    
    // Check if design system CSS exists before enqueuing
    $design_system_path = get_template_directory() . '/assets/css/design-system.css';
    if (file_exists($design_system_path)) {
        wp_enqueue_style(
            'skyworld-design-system',
            get_template_directory_uri() . '/assets/css/design-system.css',
            array('skyworld-style'),
            '1.0.0'
        );
    }
    
    // Check if main CSS exists before enqueuing
    $main_css_path = get_template_directory() . '/assets/css/main.css';
    if (file_exists($main_css_path)) {
        wp_enqueue_style(
            'skyworld-main',
            get_template_directory_uri() . '/assets/css/main.css',
            array('skyworld-style'),
            '1.0.0'
        );
    }
}
add_action('wp_enqueue_scripts', 'skyworld_safe_enqueue_assets');

/**
 * Safe Custom Logo Function
 */
function skyworld_safe_custom_logo() {
    if (function_exists('the_custom_logo')) {
        the_custom_logo();
    } else {
        echo '<a href="' . esc_url(home_url('/')) . '" class="site-title">' . esc_html(get_bloginfo('name')) . '</a>';
    }
}

/**
 * Safe Fallback Menu
 */
function skyworld_safe_fallback_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="#">Products</a></li>';
    echo '<li><a href="#">About</a></li>';
    echo '<li><a href="#">Contact</a></li>';
    echo '</ul>';
}

/**
 * Disable problematic features temporarily
 */
function skyworld_disable_problematic_features() {
    // Remove any hooks that might be causing issues
    remove_all_actions('wp_head', 999);
    remove_all_actions('wp_footer', 999);
}
// Uncomment if needed: add_action('init', 'skyworld_disable_problematic_features');

/**
 * Error logging for debugging
 */
function skyworld_log_error($message) {
    if (WP_DEBUG && WP_DEBUG_LOG) {
        error_log('Skyworld Theme: ' . $message);
    }
}

/**
 * Check for required plugins
 */
function skyworld_check_requirements() {
    $missing_plugins = array();
    
    // Check for ACF
    if (!function_exists('get_field')) {
        $missing_plugins[] = 'Advanced Custom Fields';
    }
    
    if (!empty($missing_plugins)) {
        add_action('admin_notices', function() use ($missing_plugins) {
            echo '<div class="notice notice-warning"><p>';
            echo 'Skyworld Theme: The following plugins are recommended: ' . implode(', ', $missing_plugins);
            echo '</p></div>';
        });
    }
}
add_action('admin_init', 'skyworld_check_requirements');