<?php
/**
 * Single Strain Template
 * Template for displaying single strain posts
 */

get_header(); ?>

<style>
/* Strain Page Styles - Similar to product but strain-focused */
.strain-container {
    max-width: 1400px;
    margin: 120px auto 80px;
    padding: 0 50px;
}

.strain-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    margin-bottom: 80px;
}

.strain-image-section {
    position: sticky;
    top: 120px;
    height: fit-content;
}

.strain-image {
    width: 100%;
    aspect-ratio: 1;
    background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
    border: 2px solid #222;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    font-size: 14px;
    margin-bottom: 20px;
    overflow: hidden;
}

.strain-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.strain-info {
    padding-top: 20px;
}

.strain-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: 48px;
    font-weight: 900;
    color: var(--color-primary);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.strain-subtitle {
    font-size: 18px;
    color: #aaa;
    margin-bottom: 30px;
}

.strain-type-badge {
    display: inline-block;
    padding: 12px 24px;
    background: rgba(241, 91, 39, 0.1);
    border: 2px solid var(--color-primary);
    color: var(--color-primary);
    font-size: 16px;
    font-weight: 700;
    border-radius: 30px;
    margin-bottom: 30px;
    text-transform: uppercase;
}

.strain-products {
    padding: 60px 50px;
    background: #0a0a0a;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
}

.product-card {
    background: #000;
    border: 1px solid #222;
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

.product-card-image {
    width: 100%;
    height: 200px;
    background: linear-gradient(135deg, #1a1a1a, #0a0a0a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    overflow: hidden;
}

.product-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-card-info {
    padding: 25px;
}

.product-card-info h4 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 20px;
    color: var(--color-primary);
    margin-bottom: 10px;
    font-weight: 700;
}

.product-card-info p {
    color: #aaa;
    font-size: 14px;
    margin-bottom: 10px;
}

.product-batch {
    font-size: 12px;
    color: #666;
    font-family: monospace;
}

@media (max-width: 1024px) {
    .strain-main {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .strain-image-section {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .strain-container {
        padding: 0 20px;
        margin-top: 100px;
    }
    
    .strain-title {
        font-size: 36px;
    }
    
    .strain-products {
        padding: 40px 20px;
    }
}
</style>

<?php while (have_posts()) : the_post(); ?>

<div class="strain-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="<?php echo home_url(); ?>">Home</a>
        <span>/</span>
        <a href="<?php echo get_post_type_archive_link('strains'); ?>">Strains</a>
        <span>/</span>
        <span style="color: var(--color-primary);"><?php the_title(); ?></span>
    </div>

    <!-- Strain Main Section -->
    <div class="strain-main">
        <!-- Strain Image -->
        <div class="strain-image-section">
            <div class="strain-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    [Strain Image - <?php the_title(); ?>]
                <?php endif; ?>
            </div>
        </div>

        <!-- Strain Info -->
        <div class="strain-info">
            <h1 class="strain-title"><?php the_title(); ?></h1>
            <p class="strain-subtitle">Premium Cannabis Strain</p>

            <?php 
            // Get strain data
            $thc_percent = get_field('thc_percent') ?: get_field('thc_percentage');
            $cbd_percent = get_field('cbd_percent') ?: get_field('cbd_percentage');
            $strain_description = get_field('strain_description');
            
            // Get strain type
            $strain_terms = wp_get_object_terms(get_the_ID(), 'strain_type');
            $strain_type = '';
            if (!is_wp_error($strain_terms) && !empty($strain_terms)) {
                $strain_type = $strain_terms[0]->name;
            }
            ?>

            <!-- Strain Type -->
            <?php if ($strain_type) : ?>
                <div class="strain-type-badge"><?php echo $strain_type; ?></div>
            <?php endif; ?>

            <!-- THC/CBD Info -->
            <?php if ($thc_percent || $cbd_percent) : ?>
            <div class="product-effects">
                <?php if ($thc_percent) : ?>
                    <div class="effect-badge">THC: <?php echo $thc_percent; ?>%</div>
                <?php endif; ?>
                <?php if ($cbd_percent) : ?>
                    <div class="effect-badge">CBD: <?php echo $cbd_percent; ?>%</div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Strain Description -->
            <?php if ($strain_description) : ?>
            <div class="detail-section">
                <h3>About This Strain</h3>
                <p><?php echo wp_kses_post($strain_description); ?></p>
            </div>
            <?php elseif (get_the_content()) : ?>
            <div class="detail-section">
                <h3>About This Strain</h3>
                <p><?php echo wp_strip_all_tags(get_the_content()); ?></p>
            </div>
            <?php endif; ?>

            <!-- Terpenes -->
            <?php 
            $terpenes = array();
            for ($i = 1; $i <= 3; $i++) {
                $terp_name = get_field("terp{$i}_name");
                $terp_percent = get_field("terp{$i}_percent");
                if ($terp_name && $terp_percent) {
                    $terpenes[] = array('name' => $terp_name, 'percent' => $terp_percent);
                }
            }
            
            if (!empty($terpenes)) : ?>
            <div class="detail-section">
                <h3>Dominant Terpenes</h3>
                <ul class="terpenes-list">
                    <?php foreach ($terpenes as $terpene) : ?>
                    <li class="terpene-item">
                        <span class="terpene-name"><?php echo esc_html($terpene['name']); ?></span>
                        <span class="terpene-percentage"><?php echo esc_html($terpene['percent']); ?>%</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>

            <!-- CTA -->
            <div class="cta-section">
                <h3>Find <?php the_title(); ?> Products Near You</h3>
                <a href="/store-locator/" class="find-stores-btn">Find Stores</a>
            </div>
        </div>
    </div>
</div>

<!-- Available Products -->
<section class="strain-products">
    <h2 class="section-title">Available <?php the_title(); ?> Products</h2>
    <div class="products-grid">
        <?php
        // Get products for this strain
        $strain_products_args = array(
            'post_type' => 'products',
            'posts_per_page' => 12,
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
            )
        );
        
        $strain_products = new WP_Query($strain_products_args);
        
        if ($strain_products->have_posts()) :
            while ($strain_products->have_posts()) : $strain_products->the_post();
                $batch_number = get_field('batch_number');
                $product_thc = get_field('thc_percent');
                $product_cbd = get_field('cbd_percent');
        ?>
        <a href="<?php the_permalink(); ?>" class="product-card">
            <div class="product-card-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    [Product Image]
                <?php endif; ?>
            </div>
            <div class="product-card-info">
                <h4><?php the_title(); ?></h4>
                <p><?php 
                    $effects = array();
                    if ($product_thc) $effects[] = "THC: {$product_thc}%";
                    if ($product_cbd) $effects[] = "CBD: {$product_cbd}%";
                    echo implode(' • ', $effects);
                ?></p>
                <?php if ($batch_number) : ?>
                    <div class="product-batch">Batch: <?php echo $batch_number; ?></div>
                <?php endif; ?>
            </div>
        </a>
        <?php 
            endwhile;
            wp_reset_postdata();
        else :
        ?>
        <div style="grid-column: 1 / -1; text-align: center; color: #666; padding: 40px;">
            <p>No products available for this strain at the moment.</p>
            <a href="/store-locator/" style="color: var(--color-primary);">Check our store locator for availability →</a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>