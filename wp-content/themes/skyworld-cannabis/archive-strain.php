<?php
/**
 * Template Name: Strains Archive
 * Description: Display all strains in grid layout
 */

get_header(); ?>

<?php get_header(); ?>

<main id="main" class="site-main">
    <!-- Archive Hero -->
    <div class="archive-hero">
        <h1>Our Premium Strains</h1>
        <p>Hand-selected genetics delivering unmatched flavor, potency, and experience. Each strain cultivated with precision in our New York indoor facilities.</p>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="filter-container">
            <div class="filter-group">
                <span class="filter-label">Filter by:</span>
                <button class="filter-btn active" data-filter="all">All Strains</button>
                <button class="filter-btn" data-filter="indica">Indica</button>
                <button class="filter-btn" data-filter="sativa">Sativa</button>
                <button class="filter-btn" data-filter="hybrid">Hybrid</button>
            </div>
            <div class="product-count">
                Showing <?php echo $wp_query->found_posts; ?> strains
            </div>
        </div>
    </div>

    <!-- Products Archive -->
    <div class="products-archive">
        <div class="products-grid">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="strain-<?php the_ID(); ?>" <?php post_class('product-card'); ?>>
                        <div class="product-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('large'); ?>
                                </a>
                            <?php else : ?>
                                <span>Image Coming Soon</span>
                            <?php endif; ?>
                            
                            <?php if (function_exists('get_field')) : ?>
                                <?php $strain_type = get_field('strain_type'); ?>
                                <?php if ($strain_type) : ?>
                                    <div class="product-badge"><?php echo esc_html($strain_type); ?></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="product-info">
                            <h2 class="product-name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            
                            <?php if (function_exists('get_field')) : ?>
                                <?php
                                $genetics = get_field('genetics');
                                $thc_content = get_field('thc_content');
                                $cbd_content = get_field('cbd_content');
                                $effects = get_field('effects');
                                ?>
                                
                                <?php if ($effects && is_array($effects)) : ?>
                                    <div class="product-effects">
                                        <?php foreach (array_slice($effects, 0, 3) as $effect) : ?>
                                            <span class="effect-tag"><?php echo esc_html($effect); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($genetics) : ?>
                                    <div class="product-description">
                                        <strong>Genetics:</strong> <?php echo esc_html($genetics); ?>
                                        <?php if ($thc_content || $cbd_content) : ?>
                                            <br><strong>Cannabinoids:</strong>
                                            <?php if ($thc_content) : ?>THC <?php echo esc_html($thc_content); ?>%<?php endif; ?>
                                            <?php if ($thc_content && $cbd_content) : ?> • <?php endif; ?>
                                            <?php if ($cbd_content) : ?>CBD <?php echo esc_html($cbd_content); ?>%<?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            
                            <a href="<?php the_permalink(); ?>" class="view-product-btn">View Details</a>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="no-products">
                    <p>No strains found. Check back soon for updates!</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            
            productCards.forEach(card => {
                if (filter === 'all') {
                    card.style.display = 'block';
                } else {
                    const badge = card.querySelector('.product-badge');
                    if (badge && badge.textContent.toLowerCase().includes(filter.toLowerCase())) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>

<script>
// Strain filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const typeFilter = document.getElementById('strain-type-filter');
    const searchInput = document.getElementById('strain-search');
    const strainsContainer = document.getElementById('strains-container');
    const strainCards = strainsContainer.querySelectorAll('.strain-card');
    
    function filterStrains() {
        const selectedType = typeFilter.value.toLowerCase();
        const searchTerm = searchInput.value.toLowerCase();
        
        strainCards.forEach(card => {
            const strainType = card.getAttribute('data-strain-type');
            const title = card.querySelector('.strain-title').textContent.toLowerCase();
            const genetics = card.querySelector('.strain-genetics');
            const geneticsText = genetics ? genetics.textContent.toLowerCase() : '';
            
            const matchesType = !selectedType || strainType === selectedType;
            const matchesSearch = !searchTerm || 
                                title.includes(searchTerm) || 
                                geneticsText.includes(searchTerm);
            
            if (matchesType && matchesSearch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    typeFilter.addEventListener('change', filterStrains);
    searchInput.addEventListener('input', filterStrains);
});
</script>

<?php get_footer(); ?>