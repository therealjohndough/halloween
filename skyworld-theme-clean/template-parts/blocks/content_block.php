<?php
/**
 * Block: Content Block
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$headline = get_sub_field('pb_content_headline');
$subtitle = get_sub_field('pb_content_subtitle');
$content_text = get_sub_field('pb_content_text');
$content_image = get_sub_field('pb_content_image');
$features = get_sub_field('pb_content_features');
$cta = get_sub_field('pb_content_cta');

$has_image = !empty($content_image);
$has_features = !empty($features) && is_array($features);
?>

<div class="content-block-wrapper">
    <div class="container">
        
        <?php if ($headline) : ?>
            <h2 class="content-headline"><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>
        
        <?php if ($subtitle) : ?>
            <h3 class="content-subtitle"><?php echo esc_html($subtitle); ?></h3>
        <?php endif; ?>
        
        <div class="content-block-main <?php echo $has_image ? 'has-image' : 'full-width'; ?>">
            
            <div class="content-text-area">
                
                <?php if ($content_text) : ?>
                    <div class="content-text">
                        <?php echo wp_kses_post($content_text); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($has_features) : ?>
                    <ul class="content-features-list">
                        <?php foreach ($features as $feature) : 
                            $feature_text = $feature['pb_feature_text'] ?? '';
                            $feature_icon = $feature['pb_feature_icon'] ?? '✓';
                            
                            if ($feature_text) :
                        ?>
                            <li class="feature-item">
                                <span class="feature-icon"><?php echo esc_html($feature_icon); ?></span>
                                <span class="feature-text"><?php echo esc_html($feature_text); ?></span>
                            </li>
                        <?php endif; 
                        endforeach; ?>
                    </ul>
                <?php endif; ?>
                
                <?php 
                // Check if CTA has content
                $cta_text = $cta['pb_content_cta_text'] ?? '';
                $cta_url = $cta['pb_content_cta_url'] ?? '';
                
                if ($cta_text && $cta_url) : ?>
                    <div class="content-cta">
                        <a href="<?php echo esc_url($cta_url); ?>" 
                           class="content-cta-button"
                           <?php if (strpos($cta_url, home_url()) === false) : ?>target="_blank" rel="noopener"<?php endif; ?>>
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
            </div>
            
            <?php if ($has_image) : ?>
                <div class="content-image-area">
                    <img src="<?php echo esc_url($content_image['sizes']['large'] ?: $content_image['url']); ?>" 
                         alt="<?php echo esc_attr($content_image['alt'] ?: 'Skyworld Cannabis'); ?>" 
                         class="content-block-image" />
                </div>
            <?php endif; ?>
            
        </div>
        
    </div>
</div>