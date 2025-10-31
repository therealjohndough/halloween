<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php if (function_exists('wp_body_open')) wp_body_open(); ?>
    
    <header class="site-header">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
            <div class="header-content" style="display: flex; align-items: center; justify-content: space-between; padding: 20px 0;">
                
                <!-- Safe Logo -->
                <div class="site-logo">
                    <?php 
                    if (function_exists('skyworld_safe_custom_logo')) {
                        skyworld_safe_custom_logo();
                    } else {
                        echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html(get_bloginfo('name')) . '</a>';
                    }
                    ?>
                </div>
                
                <!-- Simple Navigation -->
                <nav class="main-navigation">
                    <?php
                    if (function_exists('wp_nav_menu')) {
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'nav-menu',
                            'fallback_cb' => 'skyworld_safe_fallback_menu',
                        ));
                    } else {
                        skyworld_safe_fallback_menu();
                    }
                    ?>
                </nav>
                
            </div>
        </div>
    </header>

    <main id="main" class="site-main">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">