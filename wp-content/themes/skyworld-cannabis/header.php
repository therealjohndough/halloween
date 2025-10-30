<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Skyworld Cannabis - Premium indoor flower, super-premium quality, love-based cultivation ethos">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    
    <!-- Age Gate Integration Point -->
    <div id="age-gate-container"></div>
    
    <header class="site-header" role="banner">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="site-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-text">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Hamburger Navigation (All Devices) -->
                <div class="header-actions">
                    <!-- Search Icon -->
                    <button class="search-toggle" aria-label="Search">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="21 21l-4.35-4.35"></path>
                        </svg>
                    </button>
                    
                    <!-- Hamburger Menu Button -->
                    <button class="hamburger-toggle" aria-label="Menu" aria-expanded="false">
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                        <span class="hamburger-line"></span>
                    </button>
                </div>
                
                <!-- Full Screen Menu Overlay -->
                <div class="menu-overlay" id="menu-overlay">
                    <div class="menu-content">
                        <div class="menu-main">
                            <nav class="main-navigation" role="navigation">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'primary',
                                    'menu_id' => 'primary-menu',
                                    'container' => false,
                                    'menu_class' => 'nav-menu mobile-nav',
                                    'fallback_cb' => 'skyworld_fallback_menu',
                                ));
                                ?>
                            </nav>
                        </div>
                        
                        <div class="menu-sidebar">
                            <!-- Search Bar -->
                            <div class="menu-search">
                                <form class="search-form" role="search">
                                    <input type="search" placeholder="Search Skyworld" class="search-input">
                                    <button type="submit" class="search-submit" aria-label="Search">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="21 21l-4.35-4.35"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            
                            <!-- Locations with NY State Outline -->
                            <div class="menu-locations">
                                <h3 class="locations-title">Locations</h3>
                                <div class="locations-list">
                                    <div class="location-item-container">
                                        <span class="location-item">New York</span>
                                        <!-- NY State Outline -->
                                        <svg class="ny-state-outline-menu" viewBox="0 0 200 150" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M20,80 L30,70 L45,65 L60,60 L80,55 L100,50 L120,55 L140,60 L160,70 L170,80 L165,100 L150,120 L130,130 L110,135 L90,130 L70,125 L50,115 L35,100 Z" 
                                                  fill="rgba(84, 165, 219, 0.1)" 
                                                  stroke="rgba(241, 91, 39, 0.6)" 
                                                  stroke-width="2"/>
                                            <circle cx="140" cy="85" r="3" fill="rgba(241, 91, 39, 0.8)"/> <!-- NYC area -->
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Social Links -->
                            <div class="menu-social">
                                <a href="#" class="social-link" aria-label="Instagram">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
                                        <path d="M12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4z"/>
                                        <circle cx="18.406" cy="5.594" r="1.44"/>
                                    </svg>
                                </a>
                                <a href="#" class="social-link" aria-label="TikTok">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                    </svg>
                                </a>
                            </div>
                            
                            <!-- Brand Footer -->
                            <div class="menu-footer">
                                <div class="brand-tagline">
                                    <p>Premium New York Cannabis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main id="main" class="site-main" role="main">