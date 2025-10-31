<?php
/**
 * Block: Brand Statement
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$headline = get_sub_field('pb_brand_headline');
$content = get_sub_field('pb_brand_content');
$image = get_sub_field('pb_brand_image');
$layout = get_sub_field('pb_brand_layout') ?: 'text-left';

// Determine CSS classes based on layout
$container_class = 'brand-statement-container layout-' . $layout;
$content_class = 'brand-content';
$image_class = 'brand-image';

if (in_array($layout, array('text-center', 'text-full'))) {
    $content_class .= ' full-width';
} else {
    $content_class .= ' split-layout';
    $image_class .= ' split-layout';
}
?>

<div class="<?php echo esc_attr($container_class); ?>">
    <div class="container">
        
        <?php if ($headline) : ?>
            <h2 class="brand-headline"><?php echo esc_html($headline); ?></h2>
        <?php endif; ?>
        
        <div class="brand-statement-content">
            
            <?php if ($layout === 'text-right' && $image) : ?>
                <div class="<?php echo esc_attr($image_class); ?>">
                    <img src="<?php echo esc_url($image['sizes']['large'] ?: $image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt'] ?: 'Skyworld Cannabis'); ?>" 
                         class="brand-statement-image" />
                </div>
            <?php endif; ?>
            
            <?php if ($content) : ?>
                <div class="<?php echo esc_attr($content_class); ?>">
                    <div class="brand-text">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if ($layout !== 'text-right' && $image && !in_array($layout, array('text-center', 'text-full'))) : ?>
                <div class="<?php echo esc_attr($image_class); ?>">
                    <img src="<?php echo esc_url($image['sizes']['large'] ?: $image['url']); ?>" 
                         alt="<?php echo esc_attr($image['alt'] ?: 'Skyworld Cannabis'); ?>" 
                         class="brand-statement-image" />
                </div>
            <?php endif; ?>
            
        </div>
        
    </div>
</div>