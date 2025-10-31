<?php
/**
 * Hero Slider Template Part
 * ACF-powered animated cannabis industry hero with Jeeter-inspired layout
 */

$hero_slides = get_field('hero_slides');
$press_logos = get_field('press_logos');

if (!$hero_slides) {
    // Fallback content if ACF not configured
    $hero_slides = array(
        array(
            'slide_headline' => 'Premium New York Indoor Cannabis',
            'slide_subheadline' => 'Rooted in Indigenous Tradition. Grown with Intention.',
            'slide_cta_primary' => array('text' => 'Explore Our Flower', 'url' => '/strains/'),
            'slide_cta_secondary' => array('text' => 'Find Skyworld Near You', 'url' => '/store-locator/'),
        )
    );
}
?>

<section class="hero-slider u-relative u-overflow-hidden" id="hero-slider">
    <!-- Hero Slides -->
    <div class="hero-slides-container u-relative">
        <?php foreach ($hero_slides as $index => $slide): ?>
            <div class="hero-slide <?php echo $index === 0 ? 'active' : ''; ?>" 
                 data-slide="<?php echo esc_attr($index); ?>"
                 <?php if (!empty($slide['slide_background'])): ?>
                 style="background-image: url('<?php echo esc_url($slide['slide_background']['sizes']['large']); ?>');"
                 <?php endif; ?>>
                
                <!-- Glass Morphism Overlay -->
                <div class="hero-overlay u-glass-dark"></div>
                
                <!-- Hero Content -->
                <div class="hero-content u-container u-relative u-z-10">
                    <div class="hero-content-inner u-text-center">
                        
                        <?php if (!empty($slide['slide_headline'])): ?>
                            <h1 class="hero-headline u-fs-6xl u-fw-bold u-text-white u-mb-md">
                                <?php echo esc_html($slide['slide_headline']); ?>
                            </h1>
                        <?php endif; ?>
                        
                        <?php if (!empty($slide['slide_subheadline'])): ?>
                            <p class="hero-subheadline u-fs-xl u-text-white u-opacity-90 u-mb-xl u-max-w-3xl u-mx-auto">
                                <?php echo esc_html($slide['slide_subheadline']); ?>
                            </p>
                        <?php endif; ?>
                        
                        <!-- CTA Buttons -->
                        <div class="hero-ctas u-flex u-flex-wrap u-justify-center u-gap-md">
                            <?php if (!empty($slide['slide_cta_primary']['text'])): ?>
                                <a href="<?php echo esc_url($slide['slide_cta_primary']['url'] ?: '#'); ?>" 
                                   class="glass-button u-btn u-btn-primary u-btn-lg">
                                    <?php echo esc_html($slide['slide_cta_primary']['text']); ?>
                                </a>
                            <?php endif; ?>
                            
                            <?php if (!empty($slide['slide_cta_secondary']['text'])): ?>
                                <a href="<?php echo esc_url($slide['slide_cta_secondary']['url'] ?: '#'); ?>" 
                                   class="glass-button u-btn u-btn-outline u-btn-lg">
                                    <?php echo esc_html($slide['slide_cta_secondary']['text']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Featured Strain Highlight -->
                        <?php if (!empty($slide['slide_strain_highlight'])): 
                            $strain = $slide['slide_strain_highlight'];
                            $thc_percent = get_field('thc_percent', $strain->ID);
                            $strain_type = wp_get_post_terms($strain->ID, 'strain_type', array('fields' => 'names'));
                        ?>
                            <div class="hero-strain-highlight u-mt-xl">
                                <div class="strain-card-glass u-inline-flex u-align-center u-gap-sm u-p-md">
                                    <span class="strain-tag-glass">
                                        <?php echo esc_html($strain_type[0] ?? 'Premium'); ?>
                                    </span>
                                    <span class="strain-name u-text-white u-fw-semibold">
                                        <?php echo esc_html($strain->post_title); ?>
                                    </span>
                                    <?php if ($thc_percent): ?>
                                        <div class="cannabinoid-indicator-glass">
                                            <span class="cannabinoid-label">THC</span>
                                            <span class="cannabinoid-value"><?php echo esc_html($thc_percent); ?>%</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
                
                <!-- Cannabis Leaf Accent -->
                <div class="hero-leaf-accent">
                    <svg class="cannabis-leaf-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50,20 Q35,25 25,40 Q30,50 50,55 Q70,50 75,40 Q65,25 50,20 Z" 
                              fill="rgba(255, 140, 0, 0.1)" />
                        <path d="M50,55 Q40,65 35,80 Q45,85 50,70 Q55,85 65,80 Q60,65 50,55 Z" 
                              fill="rgba(255, 140, 0, 0.08)" />
                    </svg>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Slider Navigation -->
    <?php if (count($hero_slides) > 1): ?>
        <div class="hero-navigation u-absolute u-bottom-lg u-left-50 u-transform-translate-x-neg-50 u-z-20">
            <div class="hero-dots u-flex u-gap-sm">
                <?php foreach ($hero_slides as $index => $slide): ?>
                    <button class="hero-dot <?php echo $index === 0 ? 'active' : ''; ?>" 
                            data-slide="<?php echo esc_attr($index); ?>"
                            aria-label="Go to slide <?php echo esc_attr($index + 1); ?>">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Arrow Navigation -->
        <button class="hero-arrow hero-arrow-prev u-absolute u-left-lg u-top-50 u-transform-translate-y-neg-50 u-z-20" 
                aria-label="Previous slide">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
        <button class="hero-arrow hero-arrow-next u-absolute u-right-lg u-top-50 u-transform-translate-y-neg-50 u-z-20" 
                aria-label="Next slide">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    <?php endif; ?>
</section>

<!-- Press & Media Marquee -->
<?php if ($press_logos && count($press_logos) > 0): ?>
    <section class="press-marquee u-bg-black u-py-lg u-border-t u-border-gray-800">
        <div class="press-label u-text-center u-mb-sm">
            <span class="u-fs-sm u-text-gray-400 u-uppercase u-tracking-wide u-fw-medium">
                As Featured In
            </span>
        </div>
        
        <div class="press-marquee-container u-overflow-hidden u-relative">
            <div class="press-marquee-track" data-speed="30">
                <?php 
                // Duplicate logos for seamless loop
                $all_logos = array_merge($press_logos, $press_logos);
                foreach ($all_logos as $logo): 
                ?>
                    <div class="press-logo-item">
                        <?php if (!empty($logo['logo_url'])): ?>
                            <a href="<?php echo esc_url($logo['logo_url']); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="press-logo-link">
                        <?php endif; ?>
                        
                        <img src="<?php echo esc_url($logo['logo_image']['sizes']['medium'] ?? $logo['logo_image']['url']); ?>" 
                             alt="<?php echo esc_attr($logo['logo_name']); ?>" 
                             class="press-logo-img" 
                             loading="lazy">
                        
                        <?php if (!empty($logo['logo_url'])): ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>