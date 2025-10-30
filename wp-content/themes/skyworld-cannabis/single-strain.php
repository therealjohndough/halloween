<?php
/**
 * Template Name: Single Strain
 * Description: Individual strain page (hub)
 */

get_header();

while (have_posts()) : the_post();
    $strain_types = wp_get_post_terms(get_the_ID(), 'strain_type');
    $genetics = get_field('genetics');
    $breeder = get_field('breeder');
    $flowering_time = get_field('flowering_time');
    $aroma_profile = get_field('aroma_profile');
    $flavor_profile = get_field('flavor_profile');
    $terpene_profile = get_field('terpene_profile');
    $related_products = get_field('related_products');
    ?>

    <main class="single-strain">
        <!-- Hero Section -->
        <section class="strain-hero">
            <div class="container">
                <div class="strain-hero-content">
                    <div class="strain-hero-text">
                        <div class="strain-meta">
                            <?php if ($strain_types) : ?>
                                <span class="strain-type strain-type-<?php echo esc_attr($strain_types[0]->slug); ?>">
                                    <?php echo esc_html($strain_types[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="strain-title"><?php the_title(); ?></h1>
                        
                        <?php if ($genetics) : ?>
                            <p class="strain-genetics">
                                <strong>Genetics:</strong> <?php echo esc_html($genetics); ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="strain-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <div class="strain-actions">
                            <a href="#products" class="btn btn-primary">View Products</a>
                            <a href="#find-near-me" class="btn btn-secondary">Find Near Me</a>
                        </div>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="strain-hero-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Strain Details -->
        <section class="strain-details">
            <div class="container">
                <div class="strain-details-grid">
                    <!-- Main Content -->
                    <div class="strain-main-content">
                        <div class="strain-description">
                            <?php the_content(); ?>
                        </div>
                        
                        <!-- Terpene Profile -->
                        <?php if ($terpene_profile && is_array($terpene_profile)) : ?>
                            <div class="terpene-section">
                                <h3>Terpene Profile</h3>
                                <div class="terpene-chart">
                                    <?php foreach ($terpene_profile as $terpene) : ?>
                                        <div class="terpene-item">
                                            <div class="terpene-name"><?php echo esc_html($terpene['terpene_name']); ?></div>
                                            <div class="terpene-bar">
                                                <div class="terpene-fill" style="width: <?php echo esc_attr($terpene['terpene_percentage'] * 20); ?>%"></div>
                                            </div>
                                            <div class="terpene-percentage"><?php echo esc_html($terpene['terpene_percentage']); ?>%</div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="strain-sidebar">
                        <div class="strain-info-card">
                            <h3>Strain Information</h3>
                            
                            <div class="strain-info-list">
                                <?php if ($genetics) : ?>
                                    <div class="info-item">
                                        <strong>Genetics:</strong>
                                        <span><?php echo esc_html($genetics); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($breeder) : ?>
                                    <div class="info-item">
                                        <strong>Breeder:</strong>
                                        <span><?php echo esc_html($breeder); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($flowering_time) : ?>
                                    <div class="info-item">
                                        <strong>Flowering Time:</strong>
                                        <span><?php echo esc_html($flowering_time); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($aroma_profile) : ?>
                                    <div class="info-item">
                                        <strong>Aroma:</strong>
                                        <span><?php echo esc_html($aroma_profile); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($flavor_profile) : ?>
                                    <div class="info-item">
                                        <strong>Flavor:</strong>
                                        <span><?php echo esc_html($flavor_profile); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related Products (Hub-and-Spoke) -->
        <?php if ($related_products && is_array($related_products)) : ?>
            <section id="products" class="related-products">
                <div class="container">
                    <h2>Available Products</h2>
                    <p class="section-subtitle">Choose from our <?php echo esc_html(get_the_title()); ?> products:</p>
                    
                    <div class="products-grid">
                        <?php foreach ($related_products as $product_id) : 
                            $product = get_post($product_id);
                            if (!$product) continue;
                            
                            $product_type_terms = wp_get_post_terms($product_id, 'product_type');
                            $product_type = $product_type_terms ? $product_type_terms[0]->name : '';
                            $thc_percent = get_field('thc_percent', $product_id);
                            $cbd_percent = get_field('cbd_percent', $product_id);
                            $package_sizes = get_field('package_sizes', $product_id);
                            ?>
                            <div class="product-card">
                                <div class="product-card-inner">
                                    <?php if (has_post_thumbnail($product_id)) : ?>
                                        <div class="product-image">
                                            <a href="<?php echo get_permalink($product_id); ?>">
                                                <?php echo get_the_post_thumbnail($product_id, 'medium'); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="product-content">
                                        <div class="product-meta">
                                            <?php if ($product_type) : ?>
                                                <span class="product-type"><?php echo esc_html($product_type); ?></span>
                                            <?php endif; ?>
                                            <?php if ($package_sizes) : ?>
                                                <span class="package-size"><?php echo esc_html($package_sizes); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <h3 class="product-title">
                                            <a href="<?php echo get_permalink($product_id); ?>">
                                                <?php echo esc_html($product->post_title); ?>
                                            </a>
                                        </h3>
                                        
                                        <div class="cannabinoid-info">
                                            <?php if ($thc_percent) : ?>
                                                <span class="thc">THC: <?php echo esc_html($thc_percent); ?>%</span>
                                            <?php endif; ?>
                                            <?php if ($cbd_percent) : ?>
                                                <span class="cbd">CBD: <?php echo esc_html($cbd_percent); ?>%</span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="product-excerpt">
                                            <?php echo wp_trim_words($product->post_excerpt, 15); ?>
                                        </div>
                                        
                                        <a href="<?php echo get_permalink($product_id); ?>" class="product-link">
                                            View Details <span class="arrow">→</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Find Near Me CTA -->
        <section id="find-near-me" class="find-near-me-section">
            <div class="container">
                <div class="find-near-me-content">
                    <h2>Find <?php the_title(); ?> Near You</h2>
                    <p>Locate authorized retailers carrying our premium <?php the_title(); ?> products.</p>
                    <a href="/store-locator" class="btn btn-primary btn-large">Find Retailers</a>
                </div>
            </div>
        </section>
    </main>

    <?php
endwhile;

get_footer(); ?>