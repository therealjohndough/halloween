<?php
/**
 * Template Name: Single Product
 * Description: Individual product page (spoke)
 */

get_header();

while (have_posts()) : the_post();
    $product_type_terms = wp_get_post_terms(get_the_ID(), 'product_type');
    $strain_type_terms = wp_get_post_terms(get_the_ID(), 'strain_type');
    
    // Product fields
    $batch_number = get_field('batch_number');
    $strain_name = get_field('strain_name');
    $lineage = get_field('lineage');
    $package_sizes = get_field('package_sizes');
    $lab_name = get_field('lab_name');
    $related_strain = get_field('related_strain');
    
    // Cannabinoids
    $thc_percent = get_field('thc_percent');
    $cbd_percent = get_field('cbd_percent');
    $cbg_percent = get_field('cbg_percent');
    $thcv_percent = get_field('thcv_percent');
    $terp_total = get_field('terp_total');
    
    // Top 3 terpenes
    $terp1_name = get_field('terp1_name');
    $terp1_percent = get_field('terp1_percent');
    $terp2_name = get_field('terp2_name');
    $terp2_percent = get_field('terp2_percent');
    $terp3_name = get_field('terp3_name');
    $terp3_percent = get_field('terp3_percent');
    ?>

    <main class="single-product">
        <!-- Hero Section -->
        <section class="product-hero">
            <div class="container">
                <div class="product-hero-content">
                    <div class="product-hero-text">
                        <div class="product-meta">
                            <?php if ($product_type_terms) : ?>
                                <span class="product-type"><?php echo esc_html($product_type_terms[0]->name); ?></span>
                            <?php endif; ?>
                            <?php if ($package_sizes) : ?>
                                <span class="package-size"><?php echo esc_html($package_sizes); ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <h1 class="product-title"><?php the_title(); ?></h1>
                        
                        <!-- Strain Link (Hub Connection) -->
                        <?php if ($related_strain) : ?>
                            <p class="product-strain">
                                <strong>Strain:</strong> 
                                <a href="<?php echo get_permalink($related_strain); ?>" class="strain-link">
                                    <?php echo esc_html(get_the_title($related_strain)); ?>
                                </a>
                            </p>
                        <?php elseif ($strain_name) : ?>
                            <p class="product-strain">
                                <strong>Strain:</strong> <?php echo esc_html($strain_name); ?>
                            </p>
                        <?php endif; ?>
                        
                        <?php if ($lineage) : ?>
                            <p class="product-lineage">
                                <strong>Genetics:</strong> <?php echo esc_html($lineage); ?>
                            </p>
                        <?php endif; ?>
                        
                        <div class="product-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <div class="product-actions">
                            <a href="#lab-results" class="btn btn-primary">Lab Results</a>
                            <a href="#find-near-me" class="btn btn-secondary">Find Near Me</a>
                        </div>
                    </div>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="product-hero-image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Cannabinoid Profile -->
        <section id="lab-results" class="cannabinoid-profile">
            <div class="container">
                <h2>Lab Results & Cannabinoid Profile</h2>
                
                <div class="cannabinoid-grid">
                    <!-- Main Cannabinoids -->
                    <div class="cannabinoid-section">
                        <h3>Primary Cannabinoids</h3>
                        <div class="cannabinoid-bars">
                            <?php if ($thc_percent) : ?>
                                <div class="cannabinoid-item">
                                    <div class="cannabinoid-label">THC</div>
                                    <div class="cannabinoid-bar">
                                        <div class="cannabinoid-fill thc-fill" style="width: <?php echo esc_attr(min($thc_percent * 2.5, 100)); ?>%"></div>
                                    </div>
                                    <div class="cannabinoid-value"><?php echo esc_html($thc_percent); ?>%</div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($cbd_percent) : ?>
                                <div class="cannabinoid-item">
                                    <div class="cannabinoid-label">CBD</div>
                                    <div class="cannabinoid-bar">
                                        <div class="cannabinoid-fill cbd-fill" style="width: <?php echo esc_attr(min($cbd_percent * 10, 100)); ?>%"></div>
                                    </div>
                                    <div class="cannabinoid-value"><?php echo esc_html($cbd_percent); ?>%</div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($cbg_percent) : ?>
                                <div class="cannabinoid-item">
                                    <div class="cannabinoid-label">CBG</div>
                                    <div class="cannabinoid-bar">
                                        <div class="cannabinoid-fill cbg-fill" style="width: <?php echo esc_attr(min($cbg_percent * 20, 100)); ?>%"></div>
                                    </div>
                                    <div class="cannabinoid-value"><?php echo esc_html($cbg_percent); ?>%</div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($thcv_percent) : ?>
                                <div class="cannabinoid-item">
                                    <div class="cannabinoid-label">THCV</div>
                                    <div class="cannabinoid-bar">
                                        <div class="cannabinoid-fill thcv-fill" style="width: <?php echo esc_attr(min($thcv_percent * 50, 100)); ?>%"></div>
                                    </div>
                                    <div class="cannabinoid-value"><?php echo esc_html($thcv_percent); ?>%</div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Terpenes -->
                    <?php if ($terp1_name || $terp2_name || $terp3_name) : ?>
                        <div class="terpene-section">
                            <h3>Top Terpenes</h3>
                            <?php if ($terp_total) : ?>
                                <p class="terpene-total">Total Terpenes: <?php echo esc_html($terp_total); ?>%</p>
                            <?php endif; ?>
                            
                            <div class="terpene-bars">
                                <?php if ($terp1_name && $terp1_percent) : ?>
                                    <div class="terpene-item">
                                        <div class="terpene-label"><?php echo esc_html($terp1_name); ?></div>
                                        <div class="terpene-bar">
                                            <div class="terpene-fill" style="width: <?php echo esc_attr(min($terp1_percent * 50, 100)); ?>%"></div>
                                        </div>
                                        <div class="terpene-value"><?php echo esc_html($terp1_percent); ?>%</div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($terp2_name && $terp2_percent) : ?>
                                    <div class="terpene-item">
                                        <div class="terpene-label"><?php echo esc_html($terp2_name); ?></div>
                                        <div class="terpene-bar">
                                            <div class="terpene-fill" style="width: <?php echo esc_attr(min($terp2_percent * 50, 100)); ?>%"></div>
                                        </div>
                                        <div class="terpene-value"><?php echo esc_html($terp2_percent); ?>%</div>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($terp3_name && $terp3_percent) : ?>
                                    <div class="terpene-item">
                                        <div class="terpene-label"><?php echo esc_html($terp3_name); ?></div>
                                        <div class="terpene-bar">
                                            <div class="terpene-fill" style="width: <?php echo esc_attr(min($terp3_percent * 50, 100)); ?>%"></div>
                                        </div>
                                        <div class="terpene-value"><?php echo esc_html($terp3_percent); ?>%</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Lab Info & COA -->
                <div class="lab-info">
                    <?php if ($batch_number) : ?>
                        <div class="batch-info">
                            <strong>Batch Number:</strong> <?php echo esc_html($batch_number); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($lab_name) : ?>
                        <div class="lab-name">
                            <strong>Tested by:</strong> <?php echo esc_html($lab_name); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- COA Download -->
                    <?php 
                    $coa_file = '';
                    if ($batch_number) {
                        $coa_path = get_template_directory() . '/assets/coas/' . $batch_number . '.pdf';
                        if (file_exists($coa_path)) {
                            $coa_file = get_template_directory_uri() . '/assets/coas/' . $batch_number . '.pdf';
                        }
                    }
                    ?>
                    
                    <?php if ($coa_file) : ?>
                        <div class="coa-download">
                            <a href="<?php echo esc_url($coa_file); ?>" target="_blank" class="btn btn-outline">
                                Download Full COA (PDF)
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Product Details -->
        <section class="product-details">
            <div class="container">
                <div class="product-details-grid">
                    <div class="product-main-content">
                        <h2>Product Details</h2>
                        <div class="product-description">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    
                    <div class="product-sidebar">
                        <div class="product-info-card">
                            <h3>Product Information</h3>
                            
                            <div class="product-info-list">
                                <?php if ($product_type_terms) : ?>
                                    <div class="info-item">
                                        <strong>Product Type:</strong>
                                        <span><?php echo esc_html($product_type_terms[0]->name); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($strain_type_terms) : ?>
                                    <div class="info-item">
                                        <strong>Strain Type:</strong>
                                        <span><?php echo esc_html($strain_type_terms[0]->name); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($package_sizes) : ?>
                                    <div class="info-item">
                                        <strong>Package Size:</strong>
                                        <span><?php echo esc_html($package_sizes); ?></span>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($batch_number) : ?>
                                    <div class="info-item">
                                        <strong>Batch:</strong>
                                        <span><?php echo esc_html($batch_number); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Related Strain (Back to Hub) -->
        <?php if ($related_strain) : ?>
            <section class="related-strain">
                <div class="container">
                    <h2>About the Strain</h2>
                    <div class="strain-card-large">
                        <div class="strain-card-content">
                            <div class="strain-info">
                                <h3>
                                    <a href="<?php echo get_permalink($related_strain); ?>">
                                        <?php echo esc_html(get_the_title($related_strain)); ?>
                                    </a>
                                </h3>
                                
                                <?php 
                                $strain_excerpt = get_the_excerpt($related_strain);
                                if ($strain_excerpt) : ?>
                                    <p><?php echo esc_html($strain_excerpt); ?></p>
                                <?php endif; ?>
                                
                                <a href="<?php echo get_permalink($related_strain); ?>" class="btn btn-outline">
                                    View All <?php echo esc_html(get_the_title($related_strain)); ?> Products
                                </a>
                            </div>
                            
                            <?php if (has_post_thumbnail($related_strain)) : ?>
                                <div class="strain-image">
                                    <a href="<?php echo get_permalink($related_strain); ?>">
                                        <?php echo get_the_post_thumbnail($related_strain, 'medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Find Near Me CTA -->
        <section id="find-near-me" class="find-near-me-section">
            <div class="container">
                <div class="find-near-me-content">
                    <h2>Find This Product Near You</h2>
                    <p>Locate authorized retailers carrying <?php the_title(); ?> in your area.</p>
                    <a href="/store-locator" class="btn btn-primary btn-large">Find Retailers</a>
                </div>
            </div>
        </section>
    </main>

    <?php
endwhile;

get_footer(); ?>