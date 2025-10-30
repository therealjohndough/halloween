<?php
/**
 * Template Name: Single Strain Enhanced
 * Description: Individual strain page with enhanced styling
 */

get_header();

while (have_posts()) : the_post();
    $genetics = get_field('genetics');
    $breeder = get_field('breeder');
    $flowering_time = get_field('flowering_time');
    $aroma_profile = get_field('aroma_profile');
    $flavor_profile = get_field('flavor_profile');
    $terpene_profile = get_field('terpene_profile');
    $thc_content = get_field('thc_content');
    $cbd_content = get_field('cbd_content');
    $strain_type = get_field('strain_type');
    ?>

    <main id="main" class="site-main">
        <!-- Product Container -->
        <div class="product-container">
            <!-- Breadcrumb -->
            <div class="breadcrumb">
                <a href="<?php echo home_url(); ?>">Home</a>
                <span>/</span>
                <a href="<?php echo get_post_type_archive_link('strain'); ?>">Strains</a>
                <span>/</span>
                <span><?php the_title(); ?></span>
            </div>

            <!-- Product Main -->
            <div class="product-main">
                <!-- Product Image Section -->
                <div class="product-image-section">
                    <div class="product-main-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('large'); ?>
                        <?php else : ?>
                            <span>Image Coming Soon</span>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Product Thumbnails (if multiple images available) -->
                    <div class="product-thumbnails">
                        <!-- Placeholder for additional images -->
                        <div class="thumbnail active"></div>
                        <div class="thumbnail"></div>
                        <div class="thumbnail"></div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="product-details">
                    <h1><?php the_title(); ?></h1>
                    
                    <?php if ($genetics) : ?>
                        <div class="product-genetics">
                            <strong>Genetics:</strong> <?php echo esc_html($genetics); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Product Specs -->
                    <div class="product-specs">
                        <?php if ($strain_type) : ?>
                            <div class="spec-row">
                                <span class="spec-label">Type</span>
                                <span class="spec-value"><?php echo esc_html($strain_type); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($thc_content) : ?>
                            <div class="spec-row">
                                <span class="spec-label">THC Content</span>
                                <span class="spec-value"><?php echo esc_html($thc_content); ?>%</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($cbd_content) : ?>
                            <div class="spec-row">
                                <span class="spec-label">CBD Content</span>
                                <span class="spec-value"><?php echo esc_html($cbd_content); ?>%</span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($breeder) : ?>
                            <div class="spec-row">
                                <span class="spec-label">Breeder</span>
                                <span class="spec-value"><?php echo esc_html($breeder); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($flowering_time) : ?>
                            <div class="spec-row">
                                <span class="spec-label">Flowering Time</span>
                                <span class="spec-value"><?php echo esc_html($flowering_time); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($aroma_profile) : ?>
                            <div class="spec-row">
                                <span class="spec-label">Aroma Profile</span>
                                <span class="spec-value"><?php echo esc_html($aroma_profile); ?></span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($flavor_profile) : ?>
                            <div class="spec-row">
                                <span class="spec-label">Flavor Profile</span>
                                <span class="spec-value"><?php echo esc_html($flavor_profile); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Find Store Button -->
                    <button class="find-store-btn" onclick="window.location.href='#store-locator'">
                        Find Near Me
                    </button>
                </div>
            </div>

            <!-- Strain Description -->
            <?php if (get_the_content()) : ?>
                <div class="strain-description-section">
                    <h2>About <?php the_title(); ?></h2>
                    <div class="strain-description-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Terpene Profile -->
            <?php if ($terpene_profile && is_array($terpene_profile)) : ?>
                <div class="terpene-section">
                    <h2>Terpene Profile</h2>
                    <div class="terpene-chart">
                        <?php foreach ($terpene_profile as $terpene) : ?>
                            <div class="terpene-item">
                                <div class="terpene-info">
                                    <span class="terpene-name"><?php echo esc_html($terpene['terpene_name']); ?></span>
                                    <span class="terpene-percentage"><?php echo esc_html($terpene['terpene_percentage']); ?>%</span>
                                </div>
                                <div class="terpene-bar">
                                    <div class="terpene-fill" style="width: <?php echo esc_attr(($terpene['terpene_percentage'] / 2) * 100); ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Related Products -->
            <?php
            $related_products = get_posts([
                'post_type' => 'cannabis_product',
                'meta_query' => [
                    [
                        'key' => 'strain_relationship',
                        'value' => get_the_ID(),
                        'compare' => '='
                    ]
                ],
                'posts_per_page' => 4
            ]);
            ?>
            
            <?php if ($related_products) : ?>
                <div class="related-products-section">
                    <h2>Available Products</h2>
                    <div class="related-products-grid">
                        <?php foreach ($related_products as $product) : 
                            $product_thc = get_field('thc_content', $product->ID);
                            $product_cbd = get_field('cbd_content', $product->ID);
                            $size_weight = get_field('size_weight', $product->ID);
                            $batch_number = get_field('batch_number', $product->ID);
                        ?>
                            <div class="related-product-card">
                                <div class="related-product-image">
                                    <?php if (has_post_thumbnail($product->ID)) : ?>
                                        <?php echo get_the_post_thumbnail($product->ID, 'medium'); ?>
                                    <?php else : ?>
                                        <span>Image Coming Soon</span>
                                    <?php endif; ?>
                                    
                                    <?php if ($size_weight) : ?>
                                        <div class="product-badge"><?php echo esc_html($size_weight); ?></div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="related-product-info">
                                    <h3 class="related-product-name"><?php echo esc_html($product->post_title); ?></h3>
                                    
                                    <div class="related-product-specs">
                                        <?php if ($product_thc) : ?>
                                            <span class="spec">THC: <?php echo esc_html($product_thc); ?>%</span>
                                        <?php endif; ?>
                                        <?php if ($product_cbd) : ?>
                                            <span class="spec">CBD: <?php echo esc_html($product_cbd); ?>%</span>
                                        <?php endif; ?>
                                        <?php if ($batch_number) : ?>
                                            <span class="spec">Batch: <?php echo esc_html($batch_number); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <a href="<?php echo get_permalink($product->ID); ?>" class="view-product-btn">
                                        View Product
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <style>
    /* Additional styles for strain-specific elements */
    .strain-description-section {
        margin: 60px 0;
        padding: 40px;
        background: #0a0a0a;
        border: 2px solid #1a1a1a;
    }
    
    .strain-description-section h2 {
        font-family: 'SkyFont', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #f15b27;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
    
    .strain-description-content {
        font-family: 'SkyFont', sans-serif;
        color: #aaa;
        line-height: 1.8;
    }
    
    .terpene-section {
        margin: 60px 0;
        padding: 40px;
        background: #0a0a0a;
        border: 2px solid #1a1a1a;
    }
    
    .terpene-section h2 {
        font-family: 'SkyFont', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #f15b27;
        margin-bottom: 30px;
        text-transform: uppercase;
    }
    
    .terpene-chart {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .terpene-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .terpene-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .terpene-name {
        font-family: 'SkyFont', sans-serif;
        font-weight: 600;
        color: #fff;
    }
    
    .terpene-percentage {
        font-family: 'SkyFont', sans-serif;
        font-weight: 700;
        color: #f15b27;
    }
    
    .terpene-bar {
        height: 8px;
        background: #1a1a1a;
        border-radius: 4px;
        overflow: hidden;
    }
    
    .terpene-fill {
        height: 100%;
        background: linear-gradient(90deg, #f15b27, #54a5db);
        transition: width 0.8s ease;
    }
    
    .related-products-section {
        margin: 60px 0;
    }
    
    .related-products-section h2 {
        font-family: 'SkyFont', sans-serif;
        font-size: 32px;
        font-weight: 700;
        color: #f15b27;
        margin-bottom: 30px;
        text-transform: uppercase;
        text-align: center;
    }
    
    .related-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }
    
    .related-product-card {
        background: #0a0a0a;
        border: 2px solid #1a1a1a;
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .related-product-card:hover {
        transform: translateY(-5px);
        border-color: #f15b27;
        box-shadow: 0 10px 30px rgba(241, 91, 39, 0.2);
    }
    
    .related-product-image {
        position: relative;
        height: 200px;
        background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-family: 'SkyFont', sans-serif;
    }
    
    .related-product-info {
        padding: 20px;
    }
    
    .related-product-name {
        font-family: 'SkyFont', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: #f15b27;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    
    .related-product-specs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .related-product-specs .spec {
        padding: 4px 8px;
        background: rgba(241, 91, 39, 0.1);
        border: 1px solid #f15b27;
        color: #f15b27;
        font-family: 'SkyFont', sans-serif;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        border-radius: 8px;
    }
    </style>

    <?php
endwhile;

get_footer();
?>