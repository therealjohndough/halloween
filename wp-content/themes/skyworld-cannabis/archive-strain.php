<?php
/**
 * Template Name: Strains Archive
 * Description: Display all strains in grid layout
 */

get_header(); ?>

<main class="strains-archive">
    <div class="container">
        <div class="archive-header">
            <h1 class="archive-title">Our Strains</h1>
            <p class="archive-description">
                Discover our premium cannabis genetics, carefully cultivated for exceptional quality and unique characteristics.
            </p>
        </div>

        <!-- Filter Bar -->
        <div class="strain-filters">
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
                <label for="strain-search">Search Strains:</label>
                <input type="text" id="strain-search" placeholder="Search by name or genetics..." class="filter-input">
            </div>
        </div>

        <!-- Strains Grid -->
        <div class="strains-grid" id="strains-container">
            <?php
            $strains_query = new WP_Query([
                'post_type' => 'strain',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'title',
                'order' => 'ASC'
            ]);

            if ($strains_query->have_posts()) :
                while ($strains_query->have_posts()) : $strains_query->the_post();
                    $strain_types = wp_get_post_terms(get_the_ID(), 'strain_type');
                    $strain_type = $strain_types ? $strain_types[0]->slug : '';
                    $genetics = get_field('genetics');
                    $related_products = get_field('related_products');
                    $product_count = $related_products ? count($related_products) : 0;
                    ?>
                    <article class="strain-card" data-strain-type="<?php echo esc_attr($strain_type); ?>">
                        <div class="strain-card-inner">
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="strain-image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="strain-content">
                                <div class="strain-meta">
                                    <?php if ($strain_types) : ?>
                                        <span class="strain-type strain-type-<?php echo esc_attr($strain_type); ?>">
                                            <?php echo esc_html($strain_types[0]->name); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                                
                                <h2 class="strain-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                
                                <?php if ($genetics) : ?>
                                    <p class="strain-genetics">
                                        <strong>Genetics:</strong> <?php echo esc_html($genetics); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <div class="strain-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>
                                
                                <div class="strain-footer">
                                    <div class="product-count">
                                        <?php printf(
                                            _n('%d Product', '%d Products', $product_count, 'skyworld-cannabis'),
                                            $product_count
                                        ); ?>
                                    </div>
                                    
                                    <a href="<?php the_permalink(); ?>" class="strain-link">
                                        Learn More <span class="arrow">→</span>
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
                <div class="no-strains">
                    <p>No strains found. Check back soon for our latest genetics!</p>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <?php if ($strains_query->found_posts === 0) : ?>
            <div class="empty-state">
                <h3>No Strains Available</h3>
                <p>We're constantly adding new strains to our collection. Check back soon!</p>
            </div>
        <?php endif; ?>
    </div>
</main>

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