<?php
/**
 * Archive Strains Template  
 * Template for displaying strain archive pages
 */

get_header(); ?>

<style>
/* Archive Page Styles */
:root {
    --color-primary: #F15B27;
    --color-bg: #000;
    --color-card: #0a0a0a;
    --color-border: #1a1a1a;
    --color-text: #fff;
    --color-text-muted: #aaa;
    --color-text-subtle: #666;
}

/* Archive Hero */
.archive-hero {
    padding: 150px 50px 80px;
    text-align: center;
    background: linear-gradient(135deg, #0a0a0a 0%, #000 100%);
    border-bottom: 2px solid var(--color-border);
}

.archive-hero h1 {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: 64px;
    font-weight: 900;
    color: var(--color-primary);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 20px;
}

.archive-hero p {
    font-size: 18px;
    color: var(--color-text-muted);
    max-width: 700px;
    margin: 0 auto;
}

/* Filter Section */
.filter-section {
    padding: 40px 50px;
    background: var(--color-card);
    border-bottom: 1px solid var(--color-border);
    position: sticky;
    top: 80px;
    z-index: 100;
}

.filter-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 30px;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    align-items: center;
}

.filter-label {
    color: var(--color-text-muted);
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-right: 10px;
}

.filter-btn {
    padding: 10px 20px;
    background: transparent;
    color: var(--color-text-muted);
    border: 2px solid #333;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
    text-decoration: none;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--color-primary);
    color: #000;
    border-color: var(--color-primary);
}

.strain-count {
    color: var(--color-text-subtle);
    font-size: 14px;
    margin-left: auto;
}

/* Strains Archive */
.strains-archive {
    padding: 80px 50px;
    max-width: 1400px;
    margin: 0 auto;
}

.strains-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 40px;
}

.strain-card {
    background: var(--color-card);
    border: 2px solid var(--color-border);
    overflow: hidden;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.strain-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-primary);
    box-shadow: 0 15px 40px rgba(241, 91, 39, 0.2);
}

.strain-image {
    width: 100%;
    height: 320px;
    background: linear-gradient(135deg, var(--color-border) 0%, var(--color-card) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-subtle);
    font-size: 14px;
    position: relative;
    overflow: hidden;
}

.strain-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.strain-type-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--color-primary);
    color: #000;
    padding: 8px 16px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-radius: 20px;
}

.strain-info {
    padding: 25px;
}

.strain-name {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.strain-effects {
    display: flex;
    gap: 8px;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.effect-tag {
    padding: 5px 12px;
    background: rgba(241, 91, 39, 0.1);
    border: 1px solid var(--color-primary);
    color: var(--color-primary);
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 12px;
}

.strain-description {
    color: var(--color-text-muted);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.strain-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    padding: 15px;
    background: rgba(241, 91, 39, 0.05);
    border: 1px solid rgba(241, 91, 39, 0.2);
    border-radius: 8px;
}

.strain-stat {
    text-align: center;
}

.strain-stat-label {
    font-size: 11px;
    color: var(--color-text-subtle);
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 5px;
}

.strain-stat-value {
    font-size: 16px;
    color: var(--color-primary);
    font-weight: 700;
}

.view-strain-btn {
    width: 100%;
    padding: 12px;
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.view-strain-btn:hover {
    background: var(--color-primary);
    color: #000;
}

.no-strains {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: var(--color-text-muted);
}

.no-strains h3 {
    color: var(--color-primary);
    margin-bottom: 20px;
    font-size: 24px;
}

@media (max-width: 768px) {
    .archive-hero {
        padding: 120px 20px 60px;
    }

    .archive-hero h1 {
        font-size: 42px;
    }

    .filter-section {
        padding: 20px;
    }

    .filter-container {
        flex-direction: column;
        align-items: flex-start;
    }

    .strains-archive {
        padding: 40px 20px;
    }

    .strains-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}
</style>

<!-- Archive Hero -->
<section class="archive-hero">
    <h1>Our Strains</h1>
    <p>Discover our premium strain library. Each strain is carefully cultivated in our New York facilities for exceptional quality and consistency.</p>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="filter-container">
        <div class="filter-group">
            <span class="filter-label">Filter by:</span>
            <a href="<?php echo get_post_type_archive_link('strains'); ?>" class="filter-btn <?php echo !isset($_GET['strain_type']) ? 'active' : ''; ?>">All</a>
            <?php
            $strain_types = get_terms(array(
                'taxonomy' => 'strain_type',
                'hide_empty' => true,
            ));
            
            if (!is_wp_error($strain_types) && !empty($strain_types)) {
                foreach ($strain_types as $type) {
                    $is_active = isset($_GET['strain_type']) && $_GET['strain_type'] === $type->slug;
                    $filter_url = add_query_arg('strain_type', $type->slug, get_post_type_archive_link('strains'));
                    echo '<a href="' . esc_url($filter_url) . '" class="filter-btn ' . ($is_active ? 'active' : '') . '">' . esc_html($type->name) . '</a>';
                }
            }
            ?>
        </div>
        
        <span class="strain-count">
            <?php
            global $wp_query;
            echo 'Showing ' . $wp_query->found_posts . ' strains';
            ?>
        </span>
    </div>
</section>

<!-- Strains Archive -->
<section class="strains-archive">
    <div class="strains-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="strain-card">
                    <div class="strain-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            [Strain Image]
                        <?php endif; ?>
                        
                        <?php
                        // Get strain type for badge
                        $strain_terms = wp_get_object_terms(get_the_ID(), 'strain_type');
                        if (!is_wp_error($strain_terms) && !empty($strain_terms)) :
                        ?>
                            <span class="strain-type-badge"><?php echo esc_html($strain_terms[0]->name); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="strain-info">
                        <h3 class="strain-name"><?php the_title(); ?></h3>
                        
                        <?php
                        // Get THC/CBD percentages
                        $thc_percent = get_field('thc_percent') ?: get_field('thc_percentage');
                        $cbd_percent = get_field('cbd_percent') ?: get_field('cbd_percentage');
                        
                        if ($thc_percent || $cbd_percent) :
                        ?>
                        <div class="strain-stats">
                            <?php if ($thc_percent) : ?>
                                <div class="strain-stat">
                                    <div class="strain-stat-label">THC</div>
                                    <div class="strain-stat-value"><?php echo $thc_percent; ?>%</div>
                                </div>
                            <?php endif; ?>
                            <?php if ($cbd_percent) : ?>
                                <div class="strain-stat">
                                    <div class="strain-stat-label">CBD</div>
                                    <div class="strain-stat-value"><?php echo $cbd_percent; ?>%</div>
                                </div>
                            <?php endif; ?>
                            <div class="strain-stat">
                                <div class="strain-stat-label">Products</div>
                                <div class="strain-stat-value">
                                    <?php
                                    // Count related products
                                    $related_products = new WP_Query(array(
                                        'post_type' => 'products',
                                        'meta_query' => array(
                                            'relation' => 'OR',
                                            array(
                                                'key' => 'strain_name',
                                                'value' => get_the_title(),
                                                'compare' => '='
                                            ),
                                            array(
                                                'key' => 'related_strain',
                                                'value' => get_the_ID(),
                                                'compare' => '='
                                            )
                                        ),
                                        'posts_per_page' => -1
                                    ));
                                    echo $related_products->found_posts;
                                    wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="strain-description">
                            <?php 
                            $description = get_field('strain_description');
                            if ($description) {
                                echo wp_trim_words(wp_strip_all_tags($description), 20, '...');
                            } elseif (has_excerpt()) {
                                echo wp_trim_words(get_the_excerpt(), 20, '...');
                            } elseif (get_the_content()) {
                                echo wp_trim_words(wp_strip_all_tags(get_the_content()), 20, '...');
                            } else {
                                echo 'Premium quality cannabis strain crafted with care in New York.';
                            }
                            ?>
                        </div>
                        
                        <button class="view-strain-btn">View Strain</button>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="no-strains">
                <h3>No Strains Found</h3>
                <p>We're always adding new strains to our library. Check back soon or visit our store locator to find availability near you.</p>
                <a href="/store-locator/" class="load-more-btn" style="display: inline-block; margin-top: 20px;">Find Stores</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if (get_next_posts_link() || get_previous_posts_link()) : ?>
    <div class="load-more-section">
        <?php
        // Custom pagination
        $big = 999999999;
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'prev_text' => '← Previous',
            'next_text' => 'Next →',
            'type' => 'list',
            'end_size' => 1,
            'mid_size' => 2
        ));
        ?>
    </div>
    <?php endif; ?>
</section>

<?php get_footer(); ?>