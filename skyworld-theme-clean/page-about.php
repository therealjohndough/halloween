<?php
/**
 * Template Name: About Us
 * 
 * Template for about page
 */

get_header(); ?>

<main class="main-content about-page">
    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="page-title">About Skyworld Cannabis</h1>
                <p class="hero-subtitle">Indigenous-owned premium cannabis cultivated with expertise, transparency, and respect for the plant</p>
            </div>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="our-story">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <h2>Our Story</h2>
                    <p>Skyworld Cannabis is a New York-based cannabis brand rooted in Indigenous tradition, drawing its name and inspiration from the Skyworld—a place of origin and unity found in Native creation stories.</p>
                    
                    <p>We believe New Yorkers deserve access to consistent, high-quality cannabis grown with expertise and transparency. As an Indigenous-owned operation, we honor traditional cultivation practices while embracing modern techniques to deliver exceptional products that embody the truest expression of their origins.</p>
                    
                    <p>Our approach to cultivation is guided by respect for the plant, a deep sense of stewardship, and a belief that true quality comes from care, compassion, and community.</p>
                </div>
                <div class="story-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cultivation/Skyworld_Courtesy_of_Skyworld_005.webp" 
                         alt="Skyworld Cannabis Cultivation Facility" 
                         style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <?php get_template_part('template-parts/team-section'); ?>

    <!-- Values Section -->
    <section class="our-values">
        <div class="container">
            <h2 class="section-title">Our Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">🌱</div>
                    <h3>Quality First</h3>
                    <p>Every strain is cultivated using rigorous indoor standards with meticulous attention to genetics, environment, and processing.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🔬</div>
                    <h3>Transparency</h3>
                    <p>Full lab testing and batch tracking ensure you know exactly what you're getting with detailed cannabinoid and terpene profiles.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🏛️</div>
                    <h3>Licensed & Compliant</h3>
                    <p>Fully licensed by New York State Office of Cannabis Management with all proper permits and regulatory compliance.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Community Focused</h3>
                    <p>As an indigenous-owned business, we're committed to supporting our community and advancing social equity in cannabis.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Licenses Section -->
    <section class="licenses">
        <div class="container">
            <div class="licenses-content">
                <h2>Licensed Operations</h2>
                <div class="license-info">
                    <div class="license-item">
                        <strong>Processing License:</strong> #OCM-PROC-24-000030
                    </div>
                    <div class="license-item">
                        <strong>Cultivation License:</strong> #OCM-CULT-2023-000179
                    </div>
                </div>
                <p>Licensed by the New York State Office of Cannabis Management. All operations are conducted in full compliance with state regulations.</p>
            </div>
        </div>
    </section>

    <!-- Contact CTA -->
    <section class="contact-cta">
        <div class="container">
            <div class="cta-content">
                <h2>Get In Touch</h2>
                <p>Interested in carrying Skyworld products? Questions about our cultivation process?</p>
                <div class="cta-buttons">
                    <a href="/contact/" class="cta-button primary">Contact Us</a>
                    <a href="/supply-agreement/" class="cta-button secondary">Retail Onboarding</a>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
/* About Page Styles */
.about-page {
    background: var(--color-background);
    color: var(--color-text);
}

.about-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.about-hero .page-title {
    font-family: 'SkyFont-Black', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    margin-bottom: 1.5rem;
    letter-spacing: -0.02em;
}

.about-hero .hero-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

.our-story {
    padding: 5rem 0;
}

.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.story-content h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2.5rem;
    margin-bottom: 2rem;
    color: var(--color-text);
}

.story-content p {
    font-size: 1.125rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    margin-bottom: 1.5rem;
}

.image-placeholder {
    background: var(--color-surface);
    border: 2px dashed var(--color-border);
    border-radius: 12px;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-text-muted);
    font-weight: 500;
}

.our-values {
    background: var(--color-surface);
    padding: 5rem 0;
}

.section-title {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 3rem;
    color: var(--color-text);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.value-card {
    background: var(--color-background);
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    border: 1px solid var(--color-border);
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0,0,0,0.1);
}

.value-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.value-card h3 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--color-text);
}

.value-card p {
    color: var(--color-text-muted);
    line-height: 1.6;
}

.licenses {
    padding: 5rem 0;
    background: var(--color-background);
}

.licenses-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.licenses-content h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2.5rem;
    margin-bottom: 2rem;
    color: var(--color-text);
}

.license-info {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.license-item {
    background: var(--color-surface);
    padding: 1rem 1.5rem;
    border-radius: 8px;
    border: 1px solid var(--color-border);
    font-size: 1rem;
    color: var(--color-text);
}

.licenses-content p {
    color: var(--color-text-muted);
    font-size: 1.125rem;
    line-height: 1.6;
}

.contact-cta {
    background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
    color: white;
    padding: 5rem 0;
    text-align: center;
}

.cta-content h2 {
    font-family: 'SkyFont-Bold', sans-serif;
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.cta-content p {
    font-size: 1.25rem;
    opacity: 0.9;
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1.125rem;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cta-button.primary {
    background: white;
    color: var(--color-primary);
}

.cta-button.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(255,255,255,0.2);
}

.cta-button.secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.cta-button.secondary:hover {
    background: white;
    color: var(--color-primary);
}

/* Responsive */
@media (max-width: 768px) {
    .story-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .license-info {
        flex-direction: column;
        gap: 1rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .about-hero {
        padding: 80px 0;
    }
    
    .our-story,
    .our-values,
    .licenses,
    .contact-cta {
        padding: 3rem 0;
    }
}
</style>

<?php get_footer(); ?>