<?php
/**
 * Template Name: Page Builder
 * Description: Flexible page builder template using ACF layouts
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

get_header(); ?>

<main class="page-builder-content" role="main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('page-builder-article'); ?>>
            
            <?php
            // Check if ACF flexible content field exists and has content
            if (function_exists('have_rows') && have_rows('pb_flexible_content')) :
                
                $section_count = 0;
                
                while (have_rows('pb_flexible_content')) : the_row();
                    
                    $section_count++;
                    $layout = get_row_layout();
                    
                    // Add section wrapper with unique ID and classes
                    echo '<section class="pb-section pb-section-' . esc_attr($layout) . ' pb-section-' . $section_count . '" id="section-' . $section_count . '">';
                    
                    // Load the appropriate template part for this layout
                    $template_file = 'template-parts/blocks/' . $layout . '.php';
                    
                    if (locate_template($template_file)) {
                        get_template_part('template-parts/blocks/' . $layout);
                    } else {
                        // Fallback if template part doesn't exist
                        echo '<div class="pb-error">';
                        echo '<p><strong>Template Missing:</strong> ' . esc_html($template_file) . '</p>';
                        echo '<p>Layout: ' . esc_html($layout) . '</p>';
                        echo '</div>';
                    }
                    
                    echo '</section>';
                    
                endwhile;
                
            else :
                
                // Fallback content if no flexible content is set
                ?>
                <div class="page-builder-empty">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>
                        <?php if (get_the_content()) : ?>
                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div>
                        <?php else : ?>
                            <p class="pb-instructions">
                                <?php if (current_user_can('edit_posts')) : ?>
                                    <strong>Page Builder Ready:</strong> Edit this page and add content sections using the Page Builder Components below the editor.
                                <?php else : ?>
                                    This page is currently being built. Please check back soon.
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
                
            endif; ?>
            
        </article>
        
    <?php endwhile; endif; ?>
</main>

<?php
// Add schema markup for page builder pages
if (function_exists('get_field')) {
    $schema_data = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => get_the_title(),
        'description' => get_the_excerpt() ?: wp_trim_words(get_the_content(), 20),
        'url' => get_permalink(),
        'mainEntity' => array(
            '@type' => 'Organization',
            'name' => 'Skyworld Cannabis',
            'url' => home_url()
        )
    );
    
    echo '<script type="application/ld+json">' . json_encode($schema_data, JSON_UNESCAPED_SLASHES) . '</script>';
}

get_footer(); ?>