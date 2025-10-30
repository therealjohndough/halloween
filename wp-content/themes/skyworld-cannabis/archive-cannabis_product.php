<?php
/**
 * Template Name: Products Archive
 * Description: Display all cannabis products
 */

get_header(); ?>

<main class="products-archive">
    <div class="container">
        <div class="archive-header">
            <h1 class="archive-title">Our Products</h1>
            <p class="archive-description">
                Premium cannabis products crafted with care. All products are third-party lab tested for quality and potency.
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="product-filters">
            <div class="filter-group">
                <label for="product-type-filter">Product Type:</label>
                <select id="product-type-filter" class="filter-select">
                    <option value="">All Products</option>
                    <option value="flower">Flower</option>
                    <option value="pre-roll">Pre-roll</option>
                    <option value="concentrate">Concentrate</option>
                    <option value="edible">Edible</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="strain-type-filter">Strain Type:</label>
                <select id="strain-type-filter" class="filter-select">
                    <option value="">All Types</option>
                    <option value="indica">Indica</option>
                    <option value="sativa">Sativa</option>
                    <option value="hybrid">Hybrid</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="thc-range">THC Range:</label>
                <select id="thc-range" class="filter-select">
                    <option value="">Any THC%</option>
                    <option value="0-15">0-15%</option>
                    <option value="15-25">15-25%</option>
                    <option value="25-35">25-35%</option>
                    <option value="35+">35%+</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="product-search">Search Products:</label>
                <input type="text" id="product-search" placeholder="Search by name or strain..." class="filter-input">
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="products-container">
            <?php
            $products_query = new WP_Query([
                'post_type' => 'cannabis_product',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC'
            ]);

            if ($products_query->have_posts()) :
                while ($products_query->have_posts()) : $products_query->the_post();
                    $product_type_terms = wp_get_post_terms(get_the_ID(), 'product_type');
                    $strain_type_terms = wp_get_post_terms(get_the_ID(), 'strain_type');
                    $product_type = $product_type_terms ? $product_type_terms[0]->slug : '';
                    $strain_type = $strain_type_terms ? $strain_type_terms[0]->slug : '';
                    
                    $thc_percent = get_field('thc_percent');
                    $cbd_percent = get_field('cbd_percent');
                    $package_sizes = get_field('package_sizes');
                    $strain_name = get_field('strain_name');
                    $batch_number = get_field('batch_number');
                    $related_strain = get_field('related_strain');
                    ?>
                    <article class="product-card" 
                             data-product-type="<?php echo esc_attr($product_type); ?>"
                             data-strain-type="<?php echo esc_attr($strain_type); ?>"
                             data-thc="<?php echo esc_attr($thc_percent); ?>">
                        <div class="product-card-inner">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="product-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="product-content">
                                <div class="product-meta">
                                    <?php if ($product_type_terms) : ?>
                                        <span class="product-type"><?php echo esc_html($product_type_terms[0]->name); ?></span>
                                    <?php endif; ?>
                                    <?php if ($package_sizes) : ?>
                                        <span class="package-size"><?php echo esc_html($package_sizes); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <h2 class="product-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <?php if ($strain_name || $related_strain) : ?>
                                    <p class="product-strain">
                                        <strong>Strain:</strong> 
                                        <?php if ($related_strain) : ?>
                                            <a href="<?php echo get_permalink($related_strain); ?>">
                                                <?php echo esc_html(get_the_title($related_strain)); ?>
                                            </a>
                                        <?php elseif ($strain_name) : ?>
                                            <?php echo esc_html($strain_name); ?>
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="cannabinoid-info">
                                    <?php if ($thc_percent) : ?>
                                        <span class="cannabinoid thc">THC: <?php echo esc_html($thc_percent); ?>%</span>
                                    <?php endif; ?>
                                    <?php if ($cbd_percent) : ?>
                                        <span class="cannabinoid cbd">CBD: <?php echo esc_html($cbd_percent); ?>%</span>
                                    <?php endif; ?>
                                    <?php if ($strain_type_terms) : ?>
                                        <span class="strain-type strain-type-<?php echo esc_attr($strain_type); ?>">
                                            <?php echo esc_html($strain_type_terms[0]->name); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="product-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="product-footer">
                                    <?php if ($batch_number) : ?>
                                        <div class="batch-number">
                                            Batch: <?php echo esc_html($batch_number); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <a href="<?php the_permalink(); ?>" class="product-link">
                                        View Details <span class="arrow">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                ?>
                <div class="no-products">
                    <p>No products found. Check back soon for our latest offerings!</p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <?php if ($products_query->found_posts === 0) : ?>
            <div class="empty-state">
                <h3>No Products Available</h3>
                <p>We're constantly adding new products to our lineup. Check back soon!</p>
            </div>
        <?php endif; ?>
    </div>
</main>

<script>
// Product filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const productTypeFilter = document.getElementById('product-type-filter');
    const strainTypeFilter = document.getElementById('strain-type-filter');
    const thcRangeFilter = document.getElementById('thc-range');
    const searchInput = document.getElementById('product-search');
    const productsContainer = document.getElementById('products-container');
    const productCards = productsContainer.querySelectorAll('.product-card');
    
    function filterProducts() {
        const selectedProductType = productTypeFilter.value.toLowerCase();
        const selectedStrainType = strainTypeFilter.value.toLowerCase();
        const selectedThcRange = thcRangeFilter.value;
        const searchTerm = searchInput.value.toLowerCase();
        
        productCards.forEach(card => {
            const productType = card.getAttribute('data-product-type');
            const strainType = card.getAttribute('data-strain-type');
            const thcPercent = parseFloat(card.getAttribute('data-thc')) || 0;
            const title = card.querySelector('.product-title').textContent.toLowerCase();
            const strainElement = card.querySelector('.product-strain');
            const strainText = strainElement ? strainElement.textContent.toLowerCase() : '';
            
            // Check filters
            const matchesProductType = !selectedProductType || productType === selectedProductType;
            const matchesStrainType = !selectedStrainType || strainType === selectedStrainType;
            
            let matchesThcRange = true;
            if (selectedThcRange) {
                switch (selectedThcRange) {
                    case '0-15':
                        matchesThcRange = thcPercent >= 0 && thcPercent <= 15;
                        break;
                    case '15-25':
                        matchesThcRange = thcPercent > 15 && thcPercent <= 25;
                        break;
                    case '25-35':
                        matchesThcRange = thcPercent > 25 && thcPercent <= 35;
                        break;
                    case '35+':
                        matchesThcRange = thcPercent > 35;
                        break;
                }
            }
            
            const matchesSearch = !searchTerm || 
                                title.includes(searchTerm) || 
                                strainText.includes(searchTerm);
            
            if (matchesProductType && matchesStrainType && matchesThcRange && matchesSearch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    // Add event listeners
    productTypeFilter.addEventListener('change', filterProducts);
    strainTypeFilter.addEventListener('change', filterProducts);
    thcRangeFilter.addEventListener('change', filterProducts);
    searchInput.addEventListener('input', filterProducts);
});
</script>

<?php get_footer(); ?>