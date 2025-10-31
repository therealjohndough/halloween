<?php
/**
 * Skyworld Cannabis - SEO & Structured Data Enhancement
 * Adds JSON-LD structured data, meta tags, and performance optimizations
 */

// Add structured data to head
add_action('wp_head', 'skyworld_add_structured_data');

function skyworld_add_structured_data() {
    global $post;
    
    if (is_front_page()) {
        skyworld_organization_schema();
        skyworld_website_schema();
    } elseif (is_singular('products')) {
        skyworld_product_schema($post->ID);
    } elseif (is_singular('strains')) {
        skyworld_strain_schema($post->ID);
    } elseif (is_post_type_archive('products') || is_post_type_archive('strains')) {
        skyworld_catalog_schema();
    }
}

/**
 * Organization Schema
 */
function skyworld_organization_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Skyworld Cannabis',
        'legalName' => 'Skyworld Cannabis LLC',
        'url' => home_url(),
        'logo' => get_theme_file_uri('assets/images/skyworld-logo.png'),
        'description' => 'Premium New York cannabis products featuring indoor flower, super-premium quality, and love-based cultivation ethos.',
        'foundingDate' => '2023',
        'founders' => [
            [
                '@type' => 'Person',
                'name' => 'Skyworld Team'
            ]
        ],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'New York',
            'addressRegion' => 'NY',
            'addressCountry' => 'US'
        ],
        'contactPoint' => [
            '@type' => 'ContactPoint',
            'contactType' => 'customer service',
            'areaServed' => 'US-NY',
            'availableLanguage' => 'English'
        ],
        'sameAs' => [
            'https://instagram.com/skyworldcannabis',
            'https://tiktok.com/@skyworldcannabis'
        ],
        'hasCredential' => [
            [
                '@type' => 'EducationalOccupationalCredential',
                'name' => 'NY State Cannabis License',
                'credentialCategory' => 'license',
                'recognizedBy' => [
                    '@type' => 'Organization',
                    'name' => 'New York State Office of Cannabis Management'
                ]
            ]
        ]
    ];
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Website Schema
 */
function skyworld_website_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Skyworld Cannabis',
        'url' => home_url(),
        'description' => 'Premium New York cannabis products with indoor cultivation and super-premium quality.',
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Skyworld Cannabis'
        ],
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => home_url('?s={search_term_string}')
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ];
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Product Schema (Cannabis-specific)
 */
function skyworld_product_schema($product_id) {
    $strain_name = get_field('strain_name', $product_id) ?: get_the_title($product_id);
    $product_type = get_field('product_type', $product_id) ?: 'Cannabis Product';
    $batch_number = get_field('batch_number', $product_id);
    $thc_percent = get_field('thc_percent', $product_id);
    $cbd_percent = get_field('cbd_percent', $product_id);
    $size = get_field('size', $product_id);
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => get_the_title($product_id),
        'description' => get_the_excerpt($product_id) ?: get_the_content($product_id),
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Skyworld Cannabis'
        ],
        'manufacturer' => [
            '@type' => 'Organization',
            'name' => 'Skyworld Cannabis'
        ],
        'category' => $product_type,
        'additionalProperty' => []
    ];
    
    // Add cannabis-specific properties
    if ($thc_percent) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'THC Content',
            'value' => $thc_percent . '%'
        ];
    }
    
    if ($cbd_percent) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'CBD Content',
            'value' => $cbd_percent . '%'
        ];
    }
    
    if ($batch_number) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Batch Number',
            'value' => $batch_number
        ];
    }
    
    if ($size) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Size',
            'value' => $size
        ];
    }
    
    // Add strain information
    if ($strain_name) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Cannabis Strain',
            'value' => $strain_name
        ];
    }
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Cannabis Strain Schema
 */
function skyworld_strain_schema($strain_id) {
    $strain_type = get_field('strain_type', $strain_id);
    $genetics = get_field('genetics', $strain_id);
    $thc_range = get_field('thc_range', $strain_id);
    $effects = get_field('effects', $strain_id);
    $terpene_profile = get_field('terpene_profile', $strain_id);
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        '@id' => get_permalink($strain_id),
        'name' => get_the_title($strain_id),
        'description' => get_the_excerpt($strain_id) ?: get_the_content($strain_id),
        'brand' => [
            '@type' => 'Brand',
            'name' => 'Skyworld Cannabis'
        ],
        'category' => 'Cannabis Strain',
        'additionalProperty' => []
    ];
    
    if ($strain_type) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Strain Type',
            'value' => $strain_type
        ];
    }
    
    if ($genetics) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Genetics',
            'value' => $genetics
        ];
    }
    
    if ($thc_range) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'THC Range',
            'value' => $thc_range
        ];
    }
    
    if ($effects) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Effects',
            'value' => $effects
        ];
    }
    
    if ($terpene_profile) {
        $schema['additionalProperty'][] = [
            '@type' => 'PropertyValue',
            'name' => 'Terpene Profile',
            'value' => $terpene_profile
        ];
    }
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Catalog Schema for Archive Pages
 */
function skyworld_catalog_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => get_the_archive_title(),
        'description' => get_the_archive_description() ?: 'Browse our collection of premium cannabis products.',
        'url' => get_permalink(),
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Skyworld Cannabis'
        ]
    ];
    
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}

/**
 * Enhanced Meta Tags
 */
add_action('wp_head', 'skyworld_enhanced_meta_tags');

function skyworld_enhanced_meta_tags() {
    global $post;
    
    // Open Graph tags
    echo '<meta property="og:site_name" content="Skyworld Cannabis">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";
    
    if (is_singular()) {
        echo '<meta property="og:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr(get_the_excerpt() ?: wp_trim_words(get_the_content(), 20)) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        
        if (has_post_thumbnail()) {
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            echo '<meta property="og:image" content="' . esc_url($image[0]) . '">' . "\n";
        }
    }
    
    // Twitter Card tags
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:site" content="@skyworldcannabis">' . "\n";
    
    // Cannabis-specific meta tags
    if (is_singular('products')) {
        $batch_number = get_field('batch_number');
        $thc_percent = get_field('thc_percent');
        
        if ($batch_number) {
            echo '<meta name="cannabis:batch" content="' . esc_attr($batch_number) . '">' . "\n";
        }
        
        if ($thc_percent) {
            echo '<meta name="cannabis:thc" content="' . esc_attr($thc_percent) . '%">' . "\n";
        }
    }
    
    // NY Cannabis compliance
    echo '<meta name="age-gate:required" content="21">' . "\n";
    echo '<meta name="cannabis:jurisdiction" content="NY">' . "\n";
    echo '<meta name="cannabis:license" content="OCM-PROC-24-000030">' . "\n";
}

/**
 * Core Web Vitals Optimization
 */
add_action('wp_enqueue_scripts', 'skyworld_performance_optimizations');

function skyworld_performance_optimizations() {
    // Preload critical fonts
    echo '<link rel="preload" href="' . get_theme_file_uri('assets/fonts/Sky_Font_Bd.ttf') . '" as="font" type="font/ttf" crossorigin>' . "\n";
    
    // Preconnect to external domains
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    
    // Resource hints for images
    if (is_front_page()) {
        echo '<link rel="prefetch" href="' . get_theme_file_uri('assets/images/hero-bg.jpg') . '">' . "\n";
    }
}

/**
 * Image Optimization
 */
add_filter('wp_get_attachment_image_attributes', 'skyworld_lazy_load_images', 10, 3);

function skyworld_lazy_load_images($attr, $attachment, $size) {
    // Add loading="lazy" to all images except hero images
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }
    
    return $attr;
}

/**
 * Cache Optimization Headers
 */
add_action('send_headers', 'skyworld_cache_headers');

function skyworld_cache_headers() {
    if (!is_admin()) {
        // Cache static assets for 1 year
        if (preg_match('/\.(css|js|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf)$/', $_SERVER['REQUEST_URI'])) {
            header('Cache-Control: public, max-age=31536000');
            header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
        }
        
        // Cache HTML for 1 hour
        if (!is_user_logged_in()) {
            header('Cache-Control: public, max-age=3600');
        }
    }
}

/**
 * Sitemap Enhancement
 */
add_filter('wp_sitemaps_posts_entry', 'skyworld_sitemap_entry', 10, 3);

function skyworld_sitemap_entry($sitemap_entry, $post, $post_type) {
    if (in_array($post_type, ['products', 'strains'])) {
        // Higher priority for product/strain pages
        $sitemap_entry['priority'] = 0.8;
        
        // More frequent updates for product pages
        $sitemap_entry['changefreq'] = 'weekly';
    }
    
    return $sitemap_entry;
}

echo "✅ SEO & Performance optimizations loaded\n";
?>