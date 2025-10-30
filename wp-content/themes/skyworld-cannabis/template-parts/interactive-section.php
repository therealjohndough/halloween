<?php
/**
 * Interactive/Education Section Template Part
 * Highlights genetics, terpenes, behind-the-scenes with Skyworld branding
 */
?>

<section class="interactive-section" id="interactive">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">The Skyworld Difference</h2>
            <p class="section-subtitle">Discover what makes our cannabis exceptional</p>
        </div>
        
        <div class="interactive-features">
            <!-- Genetics Feature -->
            <div class="interactive-feature genetics-feature">
                <div class="feature-icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="var(--skyworld-orange)">
                        <path d="M32 8c-2.2 0-4 1.8-4 4v8c0 2.2 1.8 4 4 4s4-1.8 4-4v-8c0-2.2-1.8-4-4-4zm0 32c-2.2 0-4 1.8-4 4v8c0 2.2 1.8 4 4 4s4-1.8 4-4v-8c0-2.2-1.8-4-4-4zm-12-8c-2.2 0-4 1.8-4 4s1.8 4 4 4h8c2.2 0 4-1.8 4-4s-1.8-4-4-4h-8zm24 0c-2.2 0-4 1.8-4 4s1.8 4 4 4h8c2.2 0 4-1.8 4-4s-1.8-4-4-4h-8z"/>
                    </svg>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Proprietary Genetics</h3>
                    <p class="feature-description">Carefully selected and bred strains that deliver consistent, premium experiences with unique terpene profiles.</p>
                    <a href="/strains" class="feature-link">Explore Our Strains</a>
                </div>
            </div>
            
            <!-- Terpenes Feature -->
            <div class="interactive-feature terpenes-feature">
                <div class="feature-icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="var(--skyworld-blue)">
                        <circle cx="32" cy="16" r="8" opacity="0.8"/>
                        <circle cx="16" cy="32" r="6" opacity="0.6"/>
                        <circle cx="48" cy="32" r="6" opacity="0.6"/>
                        <circle cx="32" cy="48" r="8" opacity="0.8"/>
                        <circle cx="32" cy="32" r="4"/>
                    </svg>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Terpene Profiles</h3>
                    <p class="feature-description">Complex aromatic compounds that define flavor, aroma, and effects. Each strain features detailed terpene breakdowns.</p>
                    <a href="/education/terpenes" class="feature-link">Learn About Terpenes</a>
                </div>
            </div>
            
            <!-- Cultivation Feature -->
            <div class="interactive-feature cultivation-feature">
                <div class="feature-icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="var(--skyworld-orange)">
                        <path d="M32 4l-4 12h-12l10 8-4 12 10-8 10 8-4-12 10-8h-12l-4-12z" opacity="0.8"/>
                        <rect x="28" y="36" width="8" height="24" fill="var(--skyworld-blue)"/>
                        <ellipse cx="32" cy="58" rx="16" ry="4" opacity="0.4"/>
                    </svg>
                </div>
                <div class="feature-content">
                    <h3 class="feature-title">Indoor Cultivation</h3>
                    <p class="feature-description">Climate-controlled environments where every variable is optimized for maximum potency, flavor, and consistency.</p>
                    <a href="/cultivation-process" class="feature-link">See Our Process</a>
                </div>
            </div>
        </div>
        
        <!-- Interactive Elements -->
        <div class="interactive-showcase">
            <div class="showcase-content">
                <h3 class="showcase-title">Experience Cannabis Knowledge</h3>
                <p class="showcase-description">Dive deeper into the science and artistry behind premium cannabis cultivation.</p>
                
                <div class="showcase-actions">
                    <a href="/education" class="btn btn--primary">
                        Cannabis Education
                    </a>
                    <a href="/lab-results" class="btn btn--outline">
                        Lab Results & COAs
                    </a>
                </div>
            </div>
            
            <div class="showcase-visual">
                <!-- Animated terpene visualization placeholder -->
                <div class="terpene-wheel">
                    <div class="wheel-center">
                        <span class="wheel-label">Terpenes</span>
                    </div>
                    <div class="wheel-segment limonene" data-terpene="limonene">
                        <span class="segment-label">Limonene</span>
                    </div>
                    <div class="wheel-segment myrcene" data-terpene="myrcene">
                        <span class="segment-label">Myrcene</span>
                    </div>
                    <div class="wheel-segment pinene" data-terpene="pinene">
                        <span class="segment-label">Pinene</span>
                    </div>
                    <div class="wheel-segment linalool" data-terpene="linalool">
                        <span class="segment-label">Linalool</span>
                    </div>
                    <div class="wheel-segment caryophyllene" data-terpene="caryophyllene">
                        <span class="segment-label">Caryophyllene</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>