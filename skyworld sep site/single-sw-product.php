<?php
/**
 * Template: single-sw-product.php
 * Minimal product page pulling parent strain + lab stats.
 */
if (!defined('ABSPATH')) exit;
get_header();
the_post();
$rel = get_post_meta(get_the_ID(), 'related_strain', true);
$pkg = get_post_meta(get_the_ID(), 'package_size', true);
$thc = get_post_meta(get_the_ID(), 'thc_percent', true);
$cbd = get_post_meta(get_the_ID(), 'cbd_percent', true);
$cbg = get_post_meta(get_the_ID(), 'cbg_percent', true);
$terp = get_post_meta(get_the_ID(), 'total_terpenes_percent', true);
?>
<main class="sw-single sw-product">
  <article <?php post_class('sw-article'); ?>>
    <header class="sw-header">
      <h1 class="sw-title"><?php the_title(); ?></h1>
      <?php if ($rel): ?><p class="sw-meta">Strain: <a href="<?php echo esc_url(get_permalink($rel)); ?>"><?php echo esc_html(get_the_title($rel)); ?></a></p><?php endif; ?>
      <?php if ($pkg): ?><p class="sw-meta"><?php echo esc_html($pkg); ?></p><?php endif; ?>
    </header>
    <div class="sw-media"><?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?></div>
    <div class="sw-content"><?php the_content(); ?></div>
    <section class="sw-stats">
      <ul class="sw-statlist">
        <?php if ($thc !== ''): ?><li>THC: <?php echo esc_html($thc); ?>%</li><?php endif; ?>
        <?php if ($cbd !== ''): ?><li>CBD: <?php echo esc_html($cbd); ?>%</li><?php endif; ?>
        <?php if ($cbg !== ''): ?><li>CBG: <?php echo esc_html($cbg); ?>%</li><?php endif; ?>
        <?php if ($terp !== ''): ?><li>Total Terpenes: <?php echo esc_html($terp); ?>%</li><?php endif; ?>
      </ul>
    </section>
  </article>
</main>
<?php get_footer(); ?>
