<?php
/**
 * Single Product Template
 * Template for displaying single product posts
 */

get_header(); ?>

<style>
/* Product Page Styles */
.product-container {
    max-width: 1400px;
    margin: 120px auto 80px;
    padding: 0 50px;
}

.breadcrumb {
    margin-bottom: 30px;
    color: #666;
    font-size: 14px;
}

.breadcrumb a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s;
}

.breadcrumb a:hover {
    color: var(--color-primary);
}

.breadcrumb span {
    margin: 0 10px;
}

.product-main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    margin-bottom: 80px;
}

.product-image-section {
    position: sticky;
    top: 120px;
    height: fit-content;
}

.product-image {
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

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-info {
    padding-top: 20px;
}

.product-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: 48px;
    font-weight: 900;
    color: var(--color-primary);
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.product-subtitle {
    font-size: 18px;
    color: #aaa;
    margin-bottom: 30px;
}

.product-effects {
    display: flex;
    gap: 15px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.effect-badge {
    padding: 10px 20px;
    background: rgba(241, 91, 39, 0.1);
    border: 2px solid var(--color-primary);
    color: var(--color-primary);
    font-size: 14px;
    font-weight: 600;
    border-radius: 25px;
}

.product-details {
    margin-bottom: 40px;
}

.detail-section {
    background: #0a0a0a;
    border: 1px solid #222;
    padding: 30px;
    margin-bottom: 20px;
}

.detail-section h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 20px;
    color: var(--color-primary);
    margin-bottom: 15px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.detail-section p {
    color: #ccc;
    font-size: 16px;
    line-height: 1.8;
}

.terpenes-list {
    list-style: none;
    padding: 0;
}

.terpene-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #222;
}

.terpene-item:last-child {
    border-bottom: none;
}

.terpene-name {
    color: #fff;
    font-weight: 600;
}

.terpene-percentage {
    color: var(--color-primary);
    font-weight: 700;
}

.cta-section {
    background: #0a0a0a;
    border: 2px solid var(--color-primary);
    padding: 40px;
    text-align: center;
    margin-bottom: 40px;
}

.cta-section h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 24px;
    color: var(--color-primary);
    margin-bottom: 20px;
}

.find-stores-btn {
    padding: 18px 50px;
    background: var(--color-primary);
    color: #000;
    border: none;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    text-transform: uppercase;
    transition: all 0.3s;
    text-decoration: none;
    display: inline-block;
}

.find-stores-btn:hover {
    background: var(--color-primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(241, 91, 39, 0.3);
}

.related-products {
    padding: 80px 50px;
    background: #0a0a0a;
}

.section-title {
    text-align: center;
    font-family: 'SkyFont-Black', sans-serif;
    font-size: 42px;
    margin-bottom: 60px;
    color: var(--color-primary);
    text-transform: uppercase;
    font-weight: 900;
}

.related-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    max-width: 1400px;
    margin: 0 auto;
}

.related-card {
    background: #000;
    border: 1px solid #222;
    overflow: hidden;
    transition: all 0.3s;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.related-card:hover {
    transform: translateY(-10px);
    border-color: var(--color-primary);
    box-shadow: 0 15px 40px rgba(241, 91, 39, 0.2);
}

.related-image {
    width: 100%;
    height: 280px;
    background: linear-gradient(135deg, #1a1a1a, #0a0a0a);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-info {
    padding: 25px;
}

.related-info h4 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 22px;
    color: var(--color-primary);
    margin-bottom: 10px;
    text-transform: uppercase;
    font-weight: 700;
}

.related-info p {
    color: #aaa;
    font-size: 14px;
}

.batch-info {
    background: #111;
    padding: 20px;
    margin: 20px 0;
    border-left: 4px solid var(--color-primary);
}

.batch-number {
    font-family: 'SkyFont-Bold', sans-serif;
    color: var(--color-primary);
    font-size: 18px;
    margin-bottom: 10px;
}

.coa-link {
    color: var(--color-secondary);
    text-decoration: none;
    font-weight: 500;
}

.coa-link:hover {
    text-decoration: underline;
}

@media (max-width: 1024px) {
    .product-main {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .product-image-section {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .product-container {
        padding: 0 20px;
        margin-top: 100px;
    }
    
    .product-title {
        font-size: 36px;
    }
    
    .related-products {
        padding: 40px 20px;
    }
}
</style>

<?php while (have_posts()) : the_post(); ?>

<div class="product-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="<?php echo home_url(); ?>">Home</a>
        <span>/</span>
        <a href="<?php echo get_post_type_archive_link('products'); ?>">Products</a>
        <span>/</span>
        <span style="color: var(--color-primary);"><?php the_title(); ?></span>
    </div>

    <!-- Product Main Section -->
    <div class="product-main">
        <!-- Product Image -->
        <div class="product-image-section">
            <div class="product-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php else : ?>
                    [Product Image - <?php the_title(); ?>]
                <?php endif; ?>
            </div>
        </div>

        <!-- Product Info -->
        <div class="product-info">
            <h1 class="product-title"><?php the_title(); ?></h1>
            <p class="product-subtitle">by SkyWorld</p>

            <?php 
            // Get product data
            $strain_name = get_field('strain_name');
            $batch_number = get_field('batch_number');
            $thc_percent = get_field('thc_percent');
            $cbd_percent = get_field('cbd_percent');
            $strain_id = get_field('related_strain');
            
            // Get strain type if we have a related strain
            $strain_type = '';
            if ($strain_id) {
                $strain_terms = wp_get_object_terms($strain_id, 'strain_type');
                if (!is_wp_error($strain_terms) && !empty($strain_terms)) {
                    $strain_type = $strain_terms[0]->name;
                }
            }
            ?>

            <!-- THC/CBD Info -->
            <?php if ($thc_percent || $cbd_percent) : ?>
            <div class="product-effects">
                <?php if ($thc_percent) : ?>
                    <div class="effect-badge">THC: <?php echo $thc_percent; ?>%</div>
                <?php endif; ?>
                <?php if ($cbd_percent) : ?>
                    <div class="effect-badge">CBD: <?php echo $cbd_percent; ?>%</div>
                <?php endif; ?>
                <?php if ($strain_type) : ?>
                    <div class="effect-badge"><?php echo $strain_type; ?></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Product Description -->
            <?php if (get_the_content()) : ?>
            <div class="detail-section">
                <h3>Description</h3>
                <p><?php echo wp_strip_all_tags(get_the_content()); ?></p>
            </div>
            <?php endif; ?>

            <!-- Batch Info -->
            <?php if ($batch_number) : ?>
            <div class="batch-info">
                <div class="batch-number">Batch: <?php echo $batch_number; ?></div>
                <a href="/labs/?batch=<?php echo urlencode($batch_number); ?>" class="coa-link">View COA →</a>
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
                <h3>Find <?php echo $strain_name ? $strain_name : get_the_title(); ?> at a Store Near You</h3>
                <a href="/store-locator/" class="find-stores-btn">Find Stores</a>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<section class="related-products">
    <h2 class="section-title">You May Also Like</h2>
    <div class="related-grid">
        <?php
        // Get related products (same strain or same product type)
        $related_args = array(
            'post_type' => 'products',
            'posts_per_page' => 4,
            'post__not_in' => array(get_the_ID()),
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key' => 'strain_name',
                    'value' => $strain_name,
                    'compare' => '='
                ),
                array(
                    'key' => 'related_strain',
                    'value' => $strain_id,
                    'compare' => '='
                )
            )
        );
        
        $related_products = new WP_Query($related_args);
        
        if ($related_products->have_posts()) :
            while ($related_products->have_posts()) : $related_products->the_post();
        ?>
        <a href="<?php the_permalink(); ?>" class="related-card">
            <div class="related-image">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('medium'); ?>
                <?php else : ?>
                    [Product Image]
                <?php endif; ?>
            </div>
            <div class="related-info">
                <h4><?php the_title(); ?></h4>
                <p><?php 
                    $related_thc = get_field('thc_percent');
                    $related_cbd = get_field('cbd_percent');
                    $effects = array();
                    if ($related_thc) $effects[] = "THC: {$related_thc}%";
                    if ($related_cbd) $effects[] = "CBD: {$related_cbd}%";
                    echo implode(' • ', $effects);
                ?></p>
            </div>
        </a>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>