<?php
/**
 * Hero Section Template Part
 * Square-inspired clean, modern hero section
 */
?>

<!-- Square-inspired Hero Section -->
<section class="hero-section-modern" id="hero">
    <div class="container">
        <div class="hero-grid">
            <!-- Left Column: Content -->
            <div class="hero-content-modern">
                <div class="hero-badge">
                    <span class="badge-text">Premium NY Cannabis</span>
                </div>
                
                <h1 class="hero-title-modern">
                    The future of cannabis is 
                    <span class="highlight-text">Skyworld</span>
                </h1>
                
                <p class="hero-description">
                    Indoor flower, super-premium quality. Love-based cultivation ethos 
                    meets cutting-edge growing techniques for the ultimate cannabis experience.
                </p>
                
                <div class="hero-cta-group">
                    <a href="<?php echo get_post_type_archive_link('products') ?: '#products'; ?>" 
                       class="btn-modern btn-modern--primary">
                        Explore Products
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9,18 15,12 9,6"></polyline>
                        </svg>
                    </a>
                    
                    <a href="#store-locator" class="btn-modern btn-modern--outline">
                        Find Stores
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="hero-trust">
                    <div class="trust-item">
                        <span class="trust-number">95+</span>
                        <span class="trust-label">NY Locations</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-number">100%</span>
                        <span class="trust-label">Indoor Grown</span>
                    </div>
                    <div class="trust-item">
                        <span class="trust-number">Lab</span>
                        <span class="trust-label">Tested</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Visual -->
            <div class="hero-visual">
                <div class="visual-container">
                    <!-- Animated Cannabis Leaf -->
                    <div class="cannabis-visual">
                        <svg class="cannabis-leaf" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                            <g class="leaf-group">
                                <!-- Central stem -->
                                <path d="M100 180 L100 120" stroke="var(--skyworld-orange)" stroke-width="3" fill="none"/>
                                
                                <!-- Main leaves -->
                                <path d="M100 120 Q70 100 60 80 Q70 85 100 100 Q130 85 140 80 Q130 100 100 120" 
                                      fill="var(--skyworld-orange)" opacity="0.8"/>
                                
                                <!-- Side leaves -->
                                <path d="M85 110 Q60 95 50 75 Q65 80 85 95" 
                                      fill="var(--skyworld-orange)" opacity="0.6"/>
                                <path d="M115 110 Q140 95 150 75 Q135 80 115 95" 
                                      fill="var(--skyworld-orange)" opacity="0.6"/>
                                
                                <!-- Top leaves -->
                                <path d="M100 100 Q85 85 75 65 Q90 70 100 85" 
                                      fill="var(--skyworld-orange)" opacity="0.7"/>
                                <path d="M100 100 Q115 85 125 65 Q110 70 100 85" 
                                      fill="var(--skyworld-orange)" opacity="0.7"/>
                                
                                <!-- Center leaf -->
                                <path d="M100 85 Q95 70 90 50 Q100 55 100 70 Q100 55 110 50 Q105 70 100 85" 
                                      fill="var(--skyworld-orange)" opacity="0.9"/>
                            </g>
                        </svg>
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="floating-element floating-1">
                        <div class="float-card">
                            <span class="float-label">THC</span>
                            <span class="float-value">25.9%</span>
                        </div>
                    </div>
                    
                    <div class="floating-element floating-2">
                        <div class="float-card">
                            <span class="float-label">Terpenes</span>
                            <span class="float-value">3.2%</span>
                        </div>
                    </div>
                    
                    <div class="floating-element floating-3">
                        <div class="float-card">
                            <span class="float-label">Premium</span>
                            <span class="float-value">Indoor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Background Gradient -->
    <div class="hero-background">
        <div class="gradient-orb gradient-orb-1"></div>
        <div class="gradient-orb gradient-orb-2"></div>
    </div>
</section>