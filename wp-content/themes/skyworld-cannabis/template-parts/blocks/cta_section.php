<?php
/**
 * Block: Call-to-Action Section
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$cta_headline = get_sub_field('pb_cta_headline');
$cta_text = get_sub_field('pb_cta_text');
$cta_buttons = get_sub_field('pb_cta_buttons');
$background_image = get_sub_field('pb_cta_background_image');
$background_color = get_sub_field('pb_cta_background_color') ?: 'dark';

$has_buttons = !empty($cta_buttons) && is_array($cta_buttons);
$has_bg_image = !empty($background_image);

// Build CSS classes
$wrapper_classes = array(
    'cta-section-wrapper',
    'cta-theme-' . $background_color
);

if ($has_bg_image) {
    $wrapper_classes[] = 'has-background-image';
}

// Build inline styles for background
$bg_styles = array();
if ($has_bg_image) {
    $bg_styles[] = 'background-image: url(' . esc_url($background_image['sizes']['large'] ?: $background_image['url']) . ')';
}

$style_attr = !empty($bg_styles) ? 'style="' . implode('; ', $bg_styles) . '"' : '';
?>

<div class="<?php echo esc_attr(implode(' ', $wrapper_classes)); ?>" <?php echo $style_attr; ?>>
    
    <?php if ($has_bg_image) : ?>
        <div class="cta-background-overlay"></div>
    <?php endif; ?>
    
    <div class="container">
        <div class="cta-content">
            
            <?php if ($cta_headline) : ?>
                <h2 class="cta-headline"><?php echo esc_html($cta_headline); ?></h2>
            <?php endif; ?>
            
            <?php if ($cta_text) : ?>
                <p class="cta-supporting-text"><?php echo esc_html($cta_text); ?></p>
            <?php endif; ?>
            
            <?php if ($has_buttons) : ?>
                <div class="cta-buttons-group">
                    <?php foreach ($cta_buttons as $button) : 
                        $button_text = $button['pb_cta_button_text'] ?? '';
                        $button_url = $button['pb_cta_button_url'] ?? '';
                        $button_style = $button['pb_cta_button_style'] ?? 'primary';
                        
                        if ($button_text && $button_url) :
                            $button_class = 'cta-button cta-button-' . $button_style;
                        ?>
                            <a href="<?php echo esc_url($button_url); ?>" 
                               class="<?php echo esc_attr($button_class); ?>"
                               <?php if (strpos($button_url, home_url()) === false) : ?>target="_blank" rel="noopener"<?php endif; ?>>
                                <?php echo esc_html($button_text); ?>
                            </a>
                        <?php endif; 
                    endforeach; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
    <?php if ($has_bg_image && !empty($background_image['alt'])) : ?>
        <!-- Hidden image for SEO -->
        <img src="<?php echo esc_url($background_image['url']); ?>" 
             alt="<?php echo esc_attr($background_image['alt']); ?>" 
             style="display: none;" />
    <?php endif; ?>
    
</div>