<?php
/**
 * Template Name: About Page - Ready to Use
 * Description: Complete about page with founder bios and company story
 */

get_header(); ?>

<main class="about-page-content">
    
    <!-- Hero Section with Glass Morphism -->
    <section class="hero-section about-hero u-minh-100vh u-d-flex u-full-height-center u-position-relative">
        <div class="hero-overlay u-position-absolute" style="top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(255,140,0,0.1)); z-index: 1;"></div>
        <div class="hero-content glass-card u-position-relative" style="z-index: 2; max-width: 800px; text-align: center;">
            <span class="eyebrow u-text-primary">Our Story</span>
            <h1 class="h1 u-text-white u-mb-md">A Brand With Roots. A Future With Purpose.</h1>
            <p class="paragraph-xl u-text-light">Skyworld exists because the plant deserves respect—and the communities who built this culture deserve better than corporate cannabis pretending to care.</p>
        </div>
    </section>

    <!-- Company Story with Matte Black Design -->
    <section class="company-story-section u-bg-secondary u-pt-2xl u-pb-2xl">
        <div class="container">
            <div class="row row-align-center">
                <div class="col-6">
                    <div class="u-mode-matte-black u-p-xl">
                        <span class="eyebrow cannabis-accent">Empire State</span>
                        <h2 class="h2 u-text-primary u-mb-lg">Born in the Empire State</h2>
                        <div class="story-copy">
                            <p class="paragraph-lg u-mb-md">We are New Yorkers—building New York cannabis. Our name comes from the <strong class="u-text-primary">Skyworld</strong> in Tuscarora creation stories—a sacred place of origin and return.</p>
                            
                            <p class="paragraph-lg u-mb-md">We honor that story by cultivating with respect and intention. The goal isn't just great flower. It's <strong class="u-text-cannabis">integrity in every decision</strong>, seed to store.</p>
                            
                            <p class="paragraph-lg u-mb-md">We're guided by ancestral knowledge, cultural responsibility, and a belief that cannabis connects us—to land, tradition, and each other.</p>
                            
                            <p class="paragraph-lg"><strong class="u-text-primary">Skyworld is more than a brand. It's a reminder: find your way, honor where you come from, and move forward together.</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="glass-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/ny-landscape.jpg" 
                             alt="New York landscape with Skyworld Cannabis facility" 
                             class="u-img-cover u-w-100" 
                             style="border-radius: var(--radius-lg); height: 400px;" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Founder Bios -->
    <section class="founders-section">
        <div class="container">
            
            <!-- Alex Anderson -->
            <div class="founder-bio alex-bio">
                <div class="founder-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/alex-anderson.webp" 
                         alt="Alex Anderson - Co-Founder & CEO, Tuscarora Nation" 
                         class="founder-img" />
                </div>
                <div class="founder-info">
                    <h3 class="founder-name">Alex Anderson</h3>
                    <p class="founder-title">Co-Founder & CEO | Tuscarora Nation</p>
                    <div class="founder-bio-text">
                        <p>Alex is the visionary behind Skyworld—a brand born from Indigenous heritage and built with intention. His leadership blends cultural responsibility, plant knowledge, and a commitment to elevating New York cannabis with integrity.</p>
                        
                        <p>Alex created Skyworld not as a product, but as a return to meaning: honoring tradition, protecting community, and cultivating with care, compassion, and purpose.</p>
                    </div>
                </div>
            </div>

            <!-- Eric Steenstra -->
            <div class="founder-bio eric-bio">
                <div class="founder-info">
                    <h3 class="founder-name">Eric Steenstra</h3>
                    <p class="founder-title">Co-Founder & COO | Hemp Industry Pioneer</p>
                    <div class="founder-bio-text">
                        <p>Eric helped build the modern hemp movement—co-founding Ecolution, leading Vote Hemp, shaping federal hemp policy, and supporting Tribal agriculture initiatives.</p>
                        
                        <p>He brings decades of cannabis advocacy, operational leadership, and industry integrity to Skyworld—ensuring growth that's ethical, community-driven, and culturally respectful.</p>
                    </div>
                </div>
                <div class="founder-photo">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/eric-steenstra.webp" 
                         alt="Eric Steenstra - Co-Founder & COO, Hemp Industry Pioneer" 
                         class="founder-img" />
                </div>
            </div>

        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-headline">Under One Sky</h2>
            <div class="values-grid">
                <div class="value-item">
                    <div class="value-icon">🌱</div>
                    <h4>Rooted in Tradition</h4>
                    <p>Indigenous wisdom guides our cultivation practices and business decisions.</p>
                </div>
                <div class="value-item">
                    <div class="value-icon">🏔️</div>
                    <h4>Grown for the Future</h4>
                    <p>Sustainable practices that protect the land for generations to come.</p>
                </div>
                <div class="value-item">
                    <div class="value-icon">🤝</div>
                    <h4>Community First</h4>
                    <p>Supporting the communities who built cannabis culture from the beginning.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section about-cta">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-headline">Experience Skyworld Cannabis</h2>
                <p class="cta-text">Find our premium indoor flower at licensed dispensaries across New York State.</p>
                <div class="cta-buttons">
                    <a href="/store-locator/" class="btn-primary">Find Retailers</a>
                    <a href="/strains/" class="btn-secondary">View Our Strains</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>