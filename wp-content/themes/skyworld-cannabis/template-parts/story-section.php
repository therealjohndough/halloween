<?php
/**
 * Story Section Template Part
 * 2-column layout with text + cultivation video
 */

$story_title = get_field('story_title') ?: 'Our Story';
$story_content = get_field('story_content');
$story_video = get_field('story_video');
?>

<section class="story-section" id="story">
    <div class="container">
        <div class="story-content">
            <div class="story-text">
                <h2 class="story-title"><?php echo esc_html($story_title); ?></h2>
                
                <?php if ($story_content) : ?>
                    <div class="story-body">
                        <?php echo wp_kses_post($story_content); ?>
                    </div>
                <?php else : ?>
                    <!-- Default story content if ACF is empty -->
                    <div class="story-body">
                        <p>At Skyworld Cannabis, we believe in the power of super-premium indoor flower grown with a love-based cultivation ethos. Our commitment to quality starts with our proprietary genetics and extends through every step of our meticulous growing process.</p>
                        
                        <p>Inspired by Indigenous cultivation wisdom and modern agricultural science, we create an environment where each plant can reach its full potential. Every strain is carefully tended in our climate-controlled facilities, ensuring consistency, potency, and the exceptional quality that defines the Skyworld experience.</p>
                        
                        <p>From seed to harvest, our team pours passion into every plant, resulting in cannabis that doesn't just meet expectations—it transcends them.</p>
                    </div>
                <?php endif; ?>
                
                <div class="story-cta">
                    <a href="/our-story" class="btn btn--outline">
                        Learn More About Us
                    </a>
                </div>
            </div>
            
            <div class="story-media">
                <?php if ($story_video) : ?>
                    <div class="story-video-container">
                        <video 
                            class="story-video" 
                            autoplay 
                            muted 
                            loop 
                            playsinline
                            preload="metadata"
                        >
                            <source src="<?php echo esc_url($story_video['url']); ?>" type="<?php echo esc_attr($story_video['mime_type']); ?>">
                            <!-- Fallback message -->
                            <p>Your browser doesn't support video playback.</p>
                        </video>
                        
                        <!-- Video Controls Overlay -->
                        <div class="video-controls">
                            <button class="video-play-pause" aria-label="Play/Pause video">
                                <svg class="play-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="5,3 19,12 5,21"></polygon>
                                </svg>
                                <svg class="pause-icon" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                                    <rect x="6" y="4" width="4" height="16"></rect>
                                    <rect x="14" y="4" width="4" height="16"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- Placeholder if no video is set -->
                    <div class="story-image-placeholder">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cultivation-placeholder.jpg" 
                             alt="Skyworld Cannabis cultivation"
                             class="story-placeholder-img"
                             loading="lazy">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>