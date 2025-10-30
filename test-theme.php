<?php
/**
 * Simple theme tester - loads the front-page.php template directly
 * This allows us to preview the theme without full WordPress setup
 */

// Mock WordPress functions for testing
function get_template_directory_uri() {
    return '/wp-content/themes/skyworld-cannabis';
}

function wp_head() {
    echo '<link rel="stylesheet" href="/wp-content/themes/skyworld-cannabis/style.css">';
    echo '<link rel="stylesheet" href="/wp-content/themes/skyworld-cannabis/assets/css/main.css">';
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
}

function wp_footer() {
    echo '<script src="/wp-content/themes/skyworld-cannabis/assets/js/main.js"></script>';
}

function home_url($path = '') {
    return 'http://localhost:3000' . $path;
}

function esc_url($url) {
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

function bloginfo($show) {
    if ($show === 'name') {
        return 'Skyworld Cannabis';
    }
    return '';
}

function has_custom_logo() {
    return false;
}

function wp_nav_menu($args) {
    echo '<ul class="nav-menu mobile-nav">';
    echo '<li><a href="/strains">Our Flower</a></li>';
    echo '<li><a href="/products">Products</a></li>';
    echo '<li><a href="/our-story">Our Story</a></li>';
    echo '<li><a href="/store-locator">Where to Find Us</a></li>';
    echo '<li><a href="/contact">Contact</a></li>';
    echo '</ul>';
}

function skyworld_fallback_menu() {
    wp_nav_menu(array());
}

function get_field($field_name) {
    // Mock ACF data for testing
    $mock_data = array(
        'hero_slides' => array(
            array(
                'title' => 'Premium Cannabis Products',
                'subtitle' => 'Discover our curated selection',
                'cta_text' => 'Find Near Me',
                'cta_link' => '#store-locator',
                'background_image' => '/wp-content/themes/skyworld-cannabis/assets/images/hero-bg-1.jpg'
            )
        ),
        'press_logos' => array(
            array('logo' => '/wp-content/themes/skyworld-cannabis/assets/images/press-logo-1.png'),
            array('logo' => '/wp-content/themes/skyworld-cannabis/assets/images/press-logo-2.png'),
        ),
        'story_title' => 'Our Cultivation Story',
        'story_content' => 'From seed to shelf, we maintain the highest standards...',
        'story_video' => '/wp-content/themes/skyworld-cannabis/assets/videos/cultivation.mp4'
    );
    
    return isset($mock_data[$field_name]) ? $mock_data[$field_name] : null;
}

function __($text, $domain = '') {
    return $text;
}

function language_attributes() {
    echo 'lang="en-US"';
}

function wp_body_open() {
    // Hook for plugins/themes
}

function body_class($class = '') {
    echo 'class="home page-template-default page page-id-1 skyworld-cannabis"';
}

function is_front_page() {
    return true;
}

function wp_enqueue_script($handle, $src = '', $deps = array(), $ver = false, $in_footer = false) {
    // Mock function - scripts loaded in wp_footer
}

function wp_enqueue_style($handle, $src = '', $deps = array(), $ver = false, $media = 'all') {
    // Mock function - styles loaded in wp_head
}

function get_theme_file_uri($file = '') {
    return '/wp-content/themes/skyworld-cannabis/' . ltrim($file, '/');
}

function wp_localize_script($handle, $object_name, $l10n) {
    // Mock function for script localization
}

function get_header() {
    include 'wp-content/themes/skyworld-cannabis/header.php';
}

function get_footer() {
    include 'wp-content/themes/skyworld-cannabis/footer.php';
}

function get_template_part($slug, $name = null) {
    $template = $slug;
    if ($name) {
        $template .= '-' . $name;
    }
    $template .= '.php';
    
    $file_path = 'wp-content/themes/skyworld-cannabis/' . $template;
    if (file_exists($file_path)) {
        include $file_path;
    }
}

// WordPress security functions
function esc_attr($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function esc_html($text) {
    return htmlspecialchars($text, ENT_NOQUOTES, 'UTF-8');
}

function esc_url($url) {
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

function wp_kses_post($data) {
    return $data; // For testing, just return as-is
}

function sanitize_text_field($str) {
    return trim(strip_tags($str));
}

function wp_create_nonce($action) {
    return 'test_nonce_12345';
}

function admin_url($path) {
    return '/wp-admin/' . ltrim($path, '/');
}

function wp_get_theme() {
    return new class {
        public function get($header) {
            if ($header === 'Version') {
                return '1.0.0';
            }
            return '';
        }
    };
}

function have_posts() {
    return false; // No posts for testing
}

function the_post() {
    // Mock function
}

function the_ID() {
    return 1;
}

function post_class($class = '') {
    echo 'class="post-1 page type-page status-publish hentry"';
}

function the_content() {
    echo '<p>This is mock content for testing.</p>';
}

// Set content type
header('Content-Type: text/html; charset=utf-8');

// Include the front page template (which calls get_header and get_footer)
include 'wp-content/themes/skyworld-cannabis/front-page.php';
?>