<?php
/**
 * Template: single-sw-strain.php
 * Minimal strain hub page listing related products.
 */
if (!defined('ABSPATH')) exit;
get_header();
the_post();
$lineage = get_post_meta(get_the_ID(), 'lineage', true);
?>
<main class="sw-single sw-strain">
  <article <?php post_class('sw-article'); ?>>
    <header class="sw-header">
      <h1 class="sw-title"><?php the_title(); ?></h1>
      <?php if ($lineage): ?><p class="sw-meta">Lineage: <?php echo esc_html($lineage); ?></p><?php endif; ?>
    </header>
    <div class="sw-media"><?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?></div>
    <div class="sw-content"><?php the_content(); ?></div>

    <section class="sw-related">
      <h2 class="sw-h2">Available Products</h2>
      <div class="sw-grid">
      <?php
        $q = new WP_Query([
          'post_type' => 'sw-product',
          'posts_per_page' => -1,
          'meta_query' => [[
            'key' => 'related_strain',
            'value' => get_the_ID(),
            'compare' => '='
          ]]
        ]);
        if ($q->have_posts()):
          while ($q->have_posts()): $q->the_post(); ?>
            <article class="sw-card sw-product">
              <a href="<?php the_permalink(); ?>" class="sw-card__media">
                <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
              </a>
              <div class="sw-card__body">
                <h3 class="sw-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <a class="sw-link" href="<?php the_permalink(); ?>">View product</a>
              </div>
            </article>
          <?php endwhile; wp_reset_postdata();
        else:
          echo '<p>No products yet.</p>';
        endif;
      ?>
      </div>
    </section>
  </article>
</main>
<?php get_footer(); ?>
