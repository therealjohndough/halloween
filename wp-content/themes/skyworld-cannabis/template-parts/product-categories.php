<?php
/**
 * Product Categories Section Template Part
 * Replaces Jeeter's deals/apparel/products with: Flower, Pre-rolls, Hash Holes, Apparel
 */
?>

<section class="product-categories-section" id="product-categories">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">Explore Our Products</h2>
            <p class="section-subtitle">Premium indoor flower and carefully crafted cannabis products</p>
        </div>
        
        <div class="product-categories-grid">
            <!-- Flower Category -->
            <div class="product-category flower-category">
                <div class="category-content">
                    <div class="category-media">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/flower-category.jpg" 
                             alt="Premium indoor flower"
                             class="category-image"
                             loading="lazy">
                        <div class="category-overlay"></div>
                    </div>
                    
                    <div class="category-info">
                        <h3 class="category-title">Flower</h3>
                        <p class="category-description">Super-premium indoor flower with love-based cultivation</p>
                        <a href="/strains" class="btn btn--outline category-cta">
                            Explore Strains
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Pre-rolls Category -->
            <div class="product-category prerolls-category">
                <div class="category-content">
                    <div class="category-media">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/prerolls-category.jpg" 
                             alt="Premium pre-rolls"
                             class="category-image"
                             loading="lazy">
                        <div class="category-overlay"></div>
                    </div>
                    
                    <div class="category-info">
                        <h3 class="category-title">Pre-rolls</h3>
                        <p class="category-description">Hand-rolled perfection with our signature strains</p>
                        <a href="/products?type=pre-rolls" class="btn btn--outline category-cta">
                            Shop Pre-rolls
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Hash Holes Category -->
            <div class="product-category hashholes-category">
                <div class="category-content">
                    <div class="category-media">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hashholes-category.jpg" 
                             alt="Hash holes"
                             class="category-image"
                             loading="lazy">
                        <div class="category-overlay"></div>
                    </div>
                    
                    <div class="category-info">
                        <h3 class="category-title">Hash Holes</h3>
                        <p class="category-description">Next-level experience with premium hash-infused joints</p>
                        <a href="/products?type=hash-holes" class="btn btn--outline category-cta">
                            Discover Hash Holes
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Apparel Category -->
            <div class="product-category apparel-category">
                <div class="category-content">
                    <div class="category-media">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apparel-category.jpg" 
                             alt="Skyworld apparel"
                             class="category-image"
                             loading="lazy">
                        <div class="category-overlay"></div>
                    </div>
                    
                    <div class="category-info">
                        <h3 class="category-title">Apparel</h3>
                        <p class="category-description">Rep the brand with premium lifestyle gear</p>
                        <a href="/apparel" class="btn btn--outline category-cta">
                            Shop Apparel
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Find Near Me CTA -->
        <div class="categories-cta text-center">
            <p class="cta-text">Ready to experience Skyworld Cannabis?</p>
            <a href="/store-locator" class="btn btn--primary btn--large">
                Find Near Me
            </a>
        </div>
    </div>
</section>