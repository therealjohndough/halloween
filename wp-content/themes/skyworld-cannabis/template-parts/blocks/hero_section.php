<?php
/**
 * Block: Hero Section
 * 
 * @package Skyworld_Cannabis
 * @since 1.0.0
 */

// Get ACF fields
$headline = get_sub_field('pb_hero_headline');
$subhead = get_sub_field('pb_hero_subhead');
$cta_buttons = get_sub_field('pb_hero_cta_buttons');
$background_image = get_sub_field('pb_hero_background_image');
$overlay_opacity = get_sub_field('pb_hero_overlay_opacity') ?: 60;

// Build inline styles for background
$bg_styles = array();
if ($background_image) {
    $bg_styles[] = 'background-image: url(' . esc_url($background_image['sizes']['large'] ?: $background_image['url']) . ')';
}
$bg_styles[] = '--hero-overlay-opacity: ' . ($overlay_opacity / 100);

$style_attr = !empty($bg_styles) ? 'style="' . implode('; ', $bg_styles) . '"' : '';
?>

<div class="hero-section-wrapper" <?php echo $style_attr; ?>>
    <div class="hero-overlay"></div>
    <div class="hero-content-container">
        <div class="hero-content">
            
            <?php if ($headline) : ?>
                <h1 class="hero-headline"><?php echo esc_html($headline); ?></h1>
            <?php endif; ?>
            
            <?php if ($subhead) : ?>
                <p class="hero-subhead"><?php echo esc_html($subhead); ?></p>
            <?php endif; ?>
            
            <?php if ($cta_buttons && is_array($cta_buttons)) : ?>
                <div class="hero-cta-group">
                    <?php foreach ($cta_buttons as $index => $button) : 
                        $text = $button['pb_cta_text'] ?? '';
                        $url = $button['pb_cta_url'] ?? '';
                        
                        if ($text && $url) :
                            $button_class = $index === 0 ? 'hero-cta-primary' : 'hero-cta-secondary';
                        ?>
                            <a href="<?php echo esc_url($url); ?>" 
                               class="hero-cta <?php echo esc_attr($button_class); ?>"
                               <?php if (strpos($url, home_url()) === false) : ?>target="_blank" rel="noopener"<?php endif; ?>>
                                <?php echo esc_html($text); ?>
                            </a>
                        <?php endif; 
                    endforeach; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
    <?php if ($background_image && !empty($background_image['alt'])) : ?>
        <!-- Hidden image for SEO -->
        <img src="<?php echo esc_url($background_image['url']); ?>" 
             alt="<?php echo esc_attr($background_image['alt']); ?>" 
             style="display: none;" />
    <?php endif; ?>
</div>