<?php
/**
 * Press Section Template Part
 * "In the Press" logos section below hero
 */

$press_logos = get_field('press_logos');
if (!$press_logos) return;
?>

<section class="press-section" id="press">
    <div class="container">
        <div class="press-content">
            <h2 class="press-title">In the Press</h2>
            
            <div class="press-logos">
                <?php foreach ($press_logos as $press_item) : 
                    $logo = $press_item['press_logo'] ?? null;
                    $name = $press_item['press_name'] ?? '';
                    $link = $press_item['press_link'] ?? '';
                    
                    if (!$logo) continue;
                ?>
                    <div class="press-logo-item">
                        <?php if ($link) : ?>
                            <a href="<?php echo esc_url($link); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="press-logo-link"
                               aria-label="Read <?php echo esc_attr($name); ?> article">
                        <?php endif; ?>
                        
                        <img 
                            src="<?php echo esc_url($logo['sizes']['press-logo'] ?? $logo['url']); ?>" 
                            alt="<?php echo esc_attr($name); ?> logo"
                            class="press-logo-img"
                            loading="lazy"
                        >
                        
                        <?php if ($link) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>