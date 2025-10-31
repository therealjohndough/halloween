<?php
/**
 * Archive Products Template
 * Template for displaying product archive pages
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

.product-count {
    color: var(--color-text-subtle);
    font-size: 14px;
    margin-left: auto;
}

/* Products Archive */
.products-archive {
    padding: 80px 50px;
    max-width: 1400px;
    margin: 0 auto;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 40px;
}

.product-card {
    background: var(--color-card);
    border: 2px solid var(--color-border);
    overflow: hidden;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.product-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-primary);
    box-shadow: 0 15px 40px rgba(241, 91, 39, 0.2);
}

.product-image {
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

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--color-primary);
    color: #000;
    padding: 5px 12px;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-info {
    padding: 25px;
}

.product-name {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 24px;
    font-weight: 700;
    color: var(--color-primary);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.product-effects {
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

.product-description {
    color: var(--color-text-muted);
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.view-product-btn {
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

.view-product-btn:hover {
    background: var(--color-primary);
    color: #000;
}

/* Load More */
.load-more-section {
    text-align: center;
    padding: 60px 0;
}

.load-more-btn {
    padding: 18px 50px;
    background: transparent;
    color: var(--color-primary);
    border: 2px solid var(--color-primary);
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
    text-decoration: none;
}

.load-more-btn:hover {
    background: var(--color-primary);
    color: #000;
    transform: translateY(-3px);
}

.no-products {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 20px;
    color: var(--color-text-muted);
}

.no-products h3 {
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

    .products-archive {
        padding: 40px 20px;
    }

    .products-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}
</style>

<!-- Archive Hero -->
<section class="archive-hero">
    <h1><?php 
        if (is_post_type_archive('products')) {
            echo 'Our Products';
        } elseif (is_post_type_archive('strains')) {
            echo 'Our Strains';
        } else {
            post_type_archive_title();
        }
    ?></h1>
    <p>Premium indoor cultivation from New York. Explore our curated selection of high-quality cannabis strains.</p>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="filter-container">
        <div class="filter-group">
            <span class="filter-label">Filter by:</span>
            <a href="<?php echo get_post_type_archive_link(get_post_type()); ?>" class="filter-btn <?php echo !isset($_GET['strain_type']) ? 'active' : ''; ?>">All</a>
            <?php
            $strain_types = get_terms(array(
                'taxonomy' => 'strain_type',
                'hide_empty' => true,
            ));
            
            if (!is_wp_error($strain_types) && !empty($strain_types)) {
                foreach ($strain_types as $type) {
                    $is_active = isset($_GET['strain_type']) && $_GET['strain_type'] === $type->slug;
                    $filter_url = add_query_arg('strain_type', $type->slug, get_post_type_archive_link(get_post_type()));
                    echo '<a href="' . esc_url($filter_url) . '" class="filter-btn ' . ($is_active ? 'active' : '') . '">' . esc_html($type->name) . '</a>';
                }
            }
            ?>
        </div>
        
        <?php if (is_post_type_archive('products')) : ?>
        <div class="filter-group">
            <span class="filter-label">Type:</span>
            <?php
            $product_types = get_terms(array(
                'taxonomy' => 'product_type',
                'hide_empty' => true,
            ));
            
            if (!is_wp_error($product_types) && !empty($product_types)) {
                foreach ($product_types as $type) {
                    $is_active = isset($_GET['product_type']) && $_GET['product_type'] === $type->slug;
                    $filter_url = add_query_arg('product_type', $type->slug);
                    echo '<a href="' . esc_url($filter_url) . '" class="filter-btn ' . ($is_active ? 'active' : '') . '">' . esc_html($type->name) . '</a>';
                }
            }
            ?>
        </div>
        <?php endif; ?>
        
        <span class="product-count">
            <?php
            global $wp_query;
            echo 'Showing ' . $wp_query->found_posts . ' ' . (is_post_type_archive('products') ? 'products' : 'strains');
            ?>
        </span>
    </div>
</section>

<!-- Products/Strains Archive -->
<section class="products-archive">
    <div class="products-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="product-card">
                    <div class="product-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('medium'); ?>
                        <?php else : ?>
                            [<?php echo is_post_type_archive('products') ? 'Product' : 'Strain'; ?> Image]
                        <?php endif; ?>
                        
                        <?php
                        // Show badge for new products (less than 30 days old)
                        if (get_post_time() > strtotime('-30 days')) :
                        ?>
                            <span class="product-badge">New</span>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-info">
                        <h3 class="product-name"><?php the_title(); ?></h3>
                        
                        <?php
                        // Get THC/CBD percentages
                        $thc_percent = get_field('thc_percent') ?: get_field('thc_percentage');
                        $cbd_percent = get_field('cbd_percent') ?: get_field('cbd_percentage');
                        
                        if ($thc_percent || $cbd_percent) :
                        ?>
                        <div class="product-effects">
                            <?php if ($thc_percent) : ?>
                                <span class="effect-tag">THC: <?php echo $thc_percent; ?>%</span>
                            <?php endif; ?>
                            <?php if ($cbd_percent) : ?>
                                <span class="effect-tag">CBD: <?php echo $cbd_percent; ?>%</span>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="product-description">
                            <?php 
                            $description = get_field('strain_description') ?: get_field('product_description');
                            if ($description) {
                                echo wp_trim_words(wp_strip_all_tags($description), 20, '...');
                            } elseif (has_excerpt()) {
                                echo wp_trim_words(get_the_excerpt(), 20, '...');
                            } elseif (get_the_content()) {
                                echo wp_trim_words(wp_strip_all_tags(get_the_content()), 20, '...');
                            } else {
                                echo 'Premium quality cannabis ' . (is_post_type_archive('products') ? 'product' : 'strain') . ' from SkyWorld.';
                            }
                            ?>
                        </div>
                        
                        <button class="view-product-btn">View Details</button>
                    </div>
                </a>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="no-products">
                <h3>No <?php echo is_post_type_archive('products') ? 'Products' : 'Strains'; ?> Found</h3>
                <p>We're always adding new products. Check back soon or visit our store locator to find availability near you.</p>
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