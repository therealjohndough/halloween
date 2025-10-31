<?php
/**
 * Template Name: Strains Library
 * 
 * Template for displaying all strains
 */

get_header(); ?>

<main class="main-content strains-library">
    <!-- Hero Section -->
    <section class="strains-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="page-title">Our Strain Library</h1>
                <p class="hero-subtitle">Discover our premium cannabis genetics cultivated with expertise and transparency</p>
            </div>
        </div>
    </section>

    <!-- Strain Filter Bar -->
    <section class="strain-filters">
        <div class="container">
            <div class="filter-bar">
                <div class="filter-group">
                    <button class="filter-btn active" data-filter="all">All Strains</button>
                    <button class="filter-btn" data-filter="indica">Indica</button>
                    <button class="filter-btn" data-filter="sativa">Sativa</button>
                    <button class="filter-btn" data-filter="hybrid">Hybrid</button>
                </div>
                <div class="sort-group">
                    <select class="sort-select">
                        <option value="name">Sort by Name</option>
                        <option value="thc">Sort by THC</option>
                        <option value="type">Sort by Type</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Strains Grid -->
    <section class="strains-grid">
        <div class="container">
            <div class="strains-wrapper">
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
                        $strain_type = get_field('strain_type') ?: 'Hybrid';
                        $genetics = get_field('genetics');
                        $thc_content = get_field('thc_content');
                        $effects = get_field('effects');
                        
                        // Get related products count
                        $related_products = get_field('related_products');
                        $product_count = is_array($related_products) ? count($related_products) : 0;
                ?>
                
                <article class="strain-card" data-type="<?php echo strtolower($strain_type); ?>">
                    <div class="strain-card-inner">
                        <div class="strain-header">
                            <div class="strain-type-badge <?php echo strtolower($strain_type); ?>">
                                <?php echo $strain_type; ?>
                            </div>
                            <?php if ($product_count > 0) : ?>
                                <div class="product-count"><?php echo $product_count; ?> Products</div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="strain-content">
                            <h3 class="strain-name">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            
                            <?php if ($genetics) : ?>
                                <div class="strain-genetics">
                                    <span class="genetics-label">Genetics:</span>
                                    <span class="genetics-value"><?php echo esc_html($genetics); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($thc_content) : ?>
                                <div class="strain-thc">
                                    <span class="thc-label">THC:</span>
                                    <span class="thc-value"><?php echo esc_html($thc_content); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($effects) : ?>
                                <div class="strain-effects">
                                    <?php echo wp_trim_words($effects, 15, '...'); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="strain-footer">
                            <a href="<?php the_permalink(); ?>" class="strain-link">
                                Learn More
                                <svg width="16" height="16" fill="currentColor">
                                    <path d="M8.5 2.5L13 7l-4.5 4.5M13 7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
                
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else : ?>
                    <div class="no-strains">
                        <h3>No strains found</h3>
                        <p>Check back soon for our premium strain collection.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="strains-cta">
        <div class="container">
            <div class="cta-content">
                <h2>Find These Strains Near You</h2>
                <p>Visit our retail partners to experience Skyworld's premium cannabis products</p>
                <a href="/store-locator/" class="cta-button">Store Locator</a>
            </div>
        </div>
    </section>
</main>

<style>
/* Strains Library Styles */
.strains-library {
    background: var(--color-background);
    color: var(--color-text);
}

.strains-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    color: white;
    padding: 80px 0;
    text-align: center;
}

.strains-hero .page-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: 1rem;
    letter-spacing: -0.02em;
}

.strains-hero .hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto;
}

.strain-filters {
    background: var(--color-surface);
    padding: 2rem 0;
    border-bottom: 1px solid var(--color-border);
}

.filter-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    gap: 0.5rem;
}

.filter-btn {
    padding: 0.75rem 1.5rem;
    border: 2px solid var(--color-border);
    background: transparent;
    color: var(--color-text);
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--color-primary);
    color: white;
    border-color: var(--color-primary);
}

.sort-select {
    padding: 0.75rem 1rem;
    border: 2px solid var(--color-border);
    border-radius: 8px;
    background: var(--color-background);
    color: var(--color-text);
    font-weight: 500;
}

.strains-grid {
    padding: 4rem 0;
}

.strains-wrapper {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.strain-card {
    background: var(--color-surface);
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.3s ease;
    border: 1px solid var(--color-border);
}

.strain-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.1);
}

.strain-card-inner {
    padding: 1.5rem;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.strain-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.strain-type-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.strain-type-badge.indica {
    background: rgba(147, 51, 234, 0.1);
    color: #9333ea;
}

.strain-type-badge.sativa {
    background: rgba(34, 197, 94, 0.1);
    color: #22c55e;
}

.strain-type-badge.hybrid {
    background: rgba(251, 146, 60, 0.1);
    color: #fb923c;
}

.product-count {
    font-size: 0.875rem;
    color: var(--color-text-muted);
    font-weight: 500;
}

.strain-name {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.strain-name a {
    color: var(--color-text);
    text-decoration: none;
    transition: color 0.3s ease;
}

.strain-name a:hover {
    color: var(--color-primary);
}

.strain-genetics,
.strain-thc {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
}

.genetics-label,
.thc-label {
    font-weight: 600;
    color: var(--color-text-muted);
}

.genetics-value,
.thc-value {
    color: var(--color-text);
}

.strain-effects {
    color: var(--color-text-muted);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

.strain-footer {
    margin-top: auto;
}

.strain-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--color-primary);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.strain-link:hover {
    gap: 0.75rem;
}

.strains-cta {
    background: var(--color-surface);
    padding: 4rem 0;
    text-align: center;
}

.cta-content h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2.5rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.cta-content p {
    font-size: 1.125rem;
    color: var(--color-text-muted);
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: var(--color-primary);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.125rem;
    transition: all 0.3s ease;
}

.cta-button:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
}

.no-strains {
    grid-column: 1 / -1;
    text-align: center;
    padding: 4rem 2rem;
    color: var(--color-text-muted);
}

/* Responsive */
@media (max-width: 768px) {
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-group {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .strains-wrapper {
        grid-template-columns: 1fr;
    }
    
    .strains-hero {
        padding: 60px 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const strainCards = document.querySelectorAll('.strain-card');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active button
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            
            // Filter cards
            strainCards.forEach(card => {
                if (filter === 'all' || card.dataset.type === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Sort functionality
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const wrapper = document.querySelector('.strains-wrapper');
            const cards = Array.from(wrapper.children);
            
            cards.sort((a, b) => {
                let aValue, bValue;
                
                switch (sortBy) {
                    case 'name':
                        aValue = a.querySelector('.strain-name a').textContent;
                        bValue = b.querySelector('.strain-name a').textContent;
                        return aValue.localeCompare(bValue);
                    case 'type':
                        aValue = a.dataset.type;
                        bValue = b.dataset.type;
                        return aValue.localeCompare(bValue);
                    default:
                        return 0;
                }
            });
            
            cards.forEach(card => wrapper.appendChild(card));
        });
    }
});
</script>

<?php get_footer(); ?>