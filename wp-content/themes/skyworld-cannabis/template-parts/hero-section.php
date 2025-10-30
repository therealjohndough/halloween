<?php
/**
 * Hero Section Template Part
 * Full-width hero with ACF slides, Jeeter-inspired layout
 */

$hero_slides = get_field('hero_slides');
if (!$hero_slides) return;
?>

<section class="hero-section" id="hero">
    <div class="hero-slider">
        <?php foreach ($hero_slides as $index => $slide) : 
            $is_active = $index === 0 ? 'active' : '';
            $media_type = $slide['slide_media_type'] ?? 'image';
            $slide_image = $slide['slide_image'] ?? null;
            $slide_video = $slide['slide_video'] ?? null;
            $slide_title = $slide['slide_title'] ?? '';
            $slide_subtitle = $slide['slide_subtitle'] ?? '';
            $cta_text = $slide['slide_cta_text'] ?? 'Explore Our Flower';
            $cta_link = $slide['slide_cta_link'] ?? '#';
        ?>
            <div class="hero-slide <?php echo esc_attr($is_active); ?>" data-slide="<?php echo esc_attr($index); ?>">
                <!-- Background Media -->
                <div class="hero-media">
                    <?php if ($media_type === 'video' && $slide_video) : ?>
                        <video 
                            class="hero-video" 
                            autoplay 
                            muted 
                            loop 
                            playsinline 
                            preload="metadata"
                            poster="<?php echo esc_url($slide_image['sizes']['hero-slide'] ?? $slide_image['url'] ?? ''); ?>"
                        >
                            <source src="<?php echo esc_url($slide_video['url']); ?>" type="<?php echo esc_attr($slide_video['mime_type']); ?>">
                            <!-- Fallback image if video fails -->
                            <?php if ($slide_image) : ?>
                                <img src="<?php echo esc_url($slide_image['sizes']['hero-slide'] ?? $slide_image['url']); ?>" 
                                     alt="<?php echo esc_attr($slide_title); ?>">
                            <?php endif; ?>
                        </video>
                    <?php elseif ($slide_image) : ?>
                        <img 
                            src="<?php echo esc_url($slide_image['sizes']['hero-slide'] ?? $slide_image['url']); ?>" 
                            alt="<?php echo esc_attr($slide_title); ?>"
                            class="hero-image"
                            loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"
                        >
                    <?php endif; ?>
                    
                    <!-- Overlay for better text readability -->
                    <div class="hero-overlay"></div>
                </div>
                
                <!-- Content -->
                <div class="hero-content">
                    <div class="container">
                        <div class="hero-text">
                            <?php if ($slide_subtitle) : ?>
                                <p class="hero-subtitle"><?php echo esc_html($slide_subtitle); ?></p>
                            <?php endif; ?>
                            
                            <?php if ($slide_title) : ?>
                                <h1 class="hero-title"><?php echo esc_html($slide_title); ?></h1>
                            <?php endif; ?>
                            
                            <?php if ($cta_text && $cta_link) : 
                                $link_url = is_array($cta_link) ? $cta_link['url'] : $cta_link;
                                $link_target = is_array($cta_link) ? $cta_link['target'] : '_self';
                            ?>
                                <div class="hero-cta">
                                    <a href="<?php echo esc_url($link_url); ?>" 
                                       class="btn btn--primary btn--large hero-cta-btn"
                                       target="<?php echo esc_attr($link_target); ?>">
                                        <?php echo esc_html($cta_text); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- Slider Navigation -->
    <?php if (count($hero_slides) > 1) : ?>
        <div class="hero-navigation">
            <div class="container">
                <!-- Dots Indicator -->
                <div class="hero-dots">
                    <?php foreach ($hero_slides as $index => $slide) : 
                        $is_active = $index === 0 ? 'active' : '';
                    ?>
                        <button 
                            class="hero-dot <?php echo esc_attr($is_active); ?>" 
                            data-slide="<?php echo esc_attr($index); ?>"
                            aria-label="Go to slide <?php echo esc_attr($index + 1); ?>"
                        ></button>
                    <?php endforeach; ?>
                </div>
                
                <!-- Arrow Navigation -->
                <button class="hero-arrow hero-arrow--prev" aria-label="Previous slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15,18 9,12 15,6"></polyline>
                    </svg>
                </button>
                <button class="hero-arrow hero-arrow--next" aria-label="Next slide">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9,18 15,12 9,6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Scroll Indicator -->
    <div class="hero-scroll-indicator">
        <div class="container">
            <button class="scroll-down-btn" aria-label="Scroll to content">
                <span class="scroll-text">Scroll</span>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6,9 12,15 18,9"></polyline>
                </svg>
            </button>
        </div>
    </div>
</section>