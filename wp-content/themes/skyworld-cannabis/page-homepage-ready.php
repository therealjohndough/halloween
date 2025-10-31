<?php
/**
 * Template Name: Homepage Sections - Ready to Use
 * Description: Complete homepage with all content sections ready
 */

get_header(); ?>

<main class="homepage-content">
    
    <!-- Hero Section -->
    <section class="hero-section homepage-hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-headline">Premium New York Indoor Cannabis, Rooted in Indigenous Tradition</h1>
            <p class="hero-subhead">Grown with intention. Crafted with respect. Designed for people who actually care what goes into their lungs.</p>
            <div class="hero-cta-group">
                <a href="/products/" class="hero-cta hero-cta-primary">Explore Our Flower</a>
                <a href="/store-locator/" class="hero-cta hero-cta-secondary">Find Skyworld Near You</a>
            </div>
        </div>
    </section>

    <!-- Brand Statement -->
    <section class="brand-statement-section">
        <div class="container">
            <div class="brand-content">
                <div class="brand-text">
                    <div class="brand-copy">
                        <p><strong>Skyworld is cannabis with a backbone.</strong> Born in New York and rooted in Indigenous tradition, we cultivate small-batch indoor flower with purpose—not shortcuts. Every strain is chosen for depth, expression, and real character.</p>
                        
                        <p>We don't chase hype. We don't cut corners. We honor the plant, the culture, and the communities we serve.</p>
                        
                        <p><strong>Skyworld isn't here to fit in. We're here to elevate the standard and unite people under one sky.</strong></p>
                    </div>
                </div>
                <div class="brand-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/brand-image.jpg" 
                         alt="Skyworld Cannabis cultivation with Indigenous roots" 
                         class="brand-img" />
                </div>
            </div>
        </div>
    </section>

    <!-- Premium Cultivation -->
    <section class="cultivation-section">
        <div class="container">
            <h2 class="section-headline">Premium Indoor Cultivation</h2>
            <h3 class="section-subtitle">What We Grow For</h3>
            
            <div class="cultivation-content">
                <div class="cultivation-text">
                    <p><strong>Flavor. Purity. Chemistry. Complexity.</strong> The kind of flower you smell once and know someone gave a damn.</p>
                    
                    <ul class="cultivation-features">
                        <li><span class="feature-icon">✓</span> Exclusive genetic selections</li>
                        <li><span class="feature-icon">✓</span> True indoor environment—dialed for peak terpene + trichome expression</li>
                        <li><span class="feature-icon">✓</span> Slow-cured, hand-trimmed, never rushed</li>
                        <li><span class="feature-icon">✓</span> COAs on every batch because transparency beats trust-me marketing</li>
                    </ul>
                    
                    <p class="cultivation-closing">If you're looking for "good enough," we're not for you.<br>
                    If you want cannabis that means something—you're home.</p>
                    
                    <div class="section-cta">
                        <a href="/coas/" class="btn-secondary">View COAs</a>
                    </div>
                </div>
                <div class="cultivation-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/cultivation.jpg" 
                         alt="Premium indoor cannabis cultivation facility" 
                         class="cultivation-img" />
                </div>
            </div>
        </div>
    </section>

    <!-- Our Genetics -->
    <section class="genetics-section">
        <div class="container">
            <h2 class="section-headline">Our Genetics</h2>
            <h3 class="section-subtitle">Only the Real Ones</h3>
            
            <div class="genetics-content">
                <div class="genetics-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/genetics.jpg" 
                         alt="Exclusive cannabis genetics and phenotype selection" 
                         class="genetics-img" />
                </div>
                <div class="genetics-text">
                    <p>We hunt and grow exclusive cultivars built for depth, not just THC flexing. <strong>Exceptionally expressive phenotypes. No cookie-cutter genetics. No rinse-repeat strains everyone else grows.</strong></p>
                    
                    <p>Each drop is hand-selected to honor the plant and thrill those who actually taste their flower instead of bragging about percentages.</p>
                    
                    <ul class="genetics-features">
                        <li><span class="feature-icon">🧬</span> Hand-selected genetics</li>
                        <li><span class="feature-icon">🔬</span> Exclusive phenotypes</li>
                        <li><span class="feature-icon">🌿</span> Terpene-focused selection</li>
                        <li><span class="feature-icon">⭐</span> Quality over quantity</li>
                    </ul>
                    
                    <div class="section-cta">
                        <a href="/strains/" class="btn-secondary">View Our Strains</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- COAs & Accountability -->
    <section class="coa-section">
        <div class="container">
            <h2 class="section-headline">COAs & Accountability</h2>
            <h3 class="section-subtitle">Test Results Don't Lie. Neither Do We.</h3>
            
            <div class="coa-content">
                <div class="coa-text">
                    <p>Every batch is lab-tested for purity, potency, and terpene profile—no surprises, no cut corners, no synthetic nonsense.</p>
                    
                    <p><strong>See the data. Respect the plant. Make informed decisions. That's the standard.</strong></p>
                    
                    <div class="coa-features">
                        <div class="coa-feature">
                            <h4>Purity Testing</h4>
                            <p>Pesticides, heavy metals, microbials</p>
                        </div>
                        <div class="coa-feature">
                            <h4>Potency Analysis</h4>
                            <p>Cannabinoid profiles and percentages</p>
                        </div>
                        <div class="coa-feature">
                            <h4>Terpene Profiles</h4>
                            <p>Complete terpene breakdowns</p>
                        </div>
                    </div>
                    
                    <div class="section-cta">
                        <a href="/coas/" class="btn-primary">View COAs</a>
                    </div>
                </div>
                <div class="coa-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholders/coa-lab.jpg" 
                         alt="Cannabis laboratory testing and COA documentation" 
                         class="coa-img" />
                </div>
            </div>
        </div>
    </section>

    <!-- Store Locator CTA -->
    <section class="store-locator-section">
        <div class="container">
            <div class="locator-content">
                <h2 class="cta-headline">Find Skyworld Near You</h2>
                <p class="cta-text">Craft cannabis, cultivated in New York. Available at select licensed dispensaries.</p>
                <div class="cta-buttons">
                    <a href="/store-locator/" class="btn-primary">Store Locator</a>
                    <a href="/wholesale/" class="btn-secondary">Become a Partner</a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>