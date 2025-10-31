<?php
/**
 * Block: Founder Bio
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$founder_name = get_sub_field('pb_founder_name');
$founder_title = get_sub_field('pb_founder_title');
$founder_bio = get_sub_field('pb_founder_bio');
$founder_photo = get_sub_field('pb_founder_photo');

$has_photo = !empty($founder_photo);
?>

<div class="founder-bio-wrapper">
    <div class="container">
        
        <div class="founder-bio-content <?php echo $has_photo ? 'has-photo' : 'text-only'; ?>">
            
            <?php if ($has_photo) : ?>
                <div class="founder-photo-area">
                    <img src="<?php echo esc_url($founder_photo['sizes']['medium_large'] ?: $founder_photo['url']); ?>" 
                         alt="<?php echo esc_attr($founder_photo['alt'] ?: $founder_name . ' - Skyworld Cannabis'); ?>" 
                         class="founder-photo" />
                </div>
            <?php endif; ?>
            
            <div class="founder-info-area">
                
                <?php if ($founder_name) : ?>
                    <h3 class="founder-name"><?php echo esc_html($founder_name); ?></h3>
                <?php endif; ?>
                
                <?php if ($founder_title) : ?>
                    <p class="founder-title"><?php echo esc_html($founder_title); ?></p>
                <?php endif; ?>
                
                <?php if ($founder_bio) : ?>
                    <div class="founder-bio-text">
                        <?php echo wp_kses_post($founder_bio); ?>
                    </div>
                <?php endif; ?>
                
            </div>
            
        </div>
        
    </div>
</div>