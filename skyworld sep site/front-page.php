<?php
/**
 * Front Page — Skyworld (Astra child)
 * Minimal structure: Featured Products, Featured Strains, CTAs.
 * Styling intentionally minimal (.sw- classes). JSON-LD handled by skyworld-seo.php.
 */

if (!defined('ABSPATH')) exit;
get_header();
?>
<main class="sw-front">
  <section class="sw-hero">
    <div class="sw-wrap">
      <h1 class="sw-title"><?php echo esc_html(get_bloginfo('name')); ?></h1>
      <p class="sw-tagline"><?php echo esc_html(get_bloginfo('description')); ?></p>
      <div class="sw-ctas">
        <a class="sw-btn" href="<?php echo esc_url(home_url('/products/')); ?>">Browse Products</a>
        <a class="sw-btn sw-btn--alt" href="<?php echo esc_url(home_url('/strains/')); ?>">Explore Strains</a>
      </div>
    </div>
  </section>

  <section class="sw-section sw-products">
    <div class="sw-wrap">
      <h2 class="sw-h2">Featured Products</h2>
      <div class="sw-grid">
      <?php
        $q = new WP_Query([
          'post_type' => 'sw-product',
          'posts_per_page' => 6,
          'ignore_sticky_posts' => true,
          'no_found_rows' => true,
        ]);
        if ($q->have_posts()):
          while ($q->have_posts()): $q->the_post();
            $pkg = get_post_meta(get_the_ID(), 'package_size', true);
            $thc = get_post_meta(get_the_ID(), 'thc_percent', true);
            $rel = get_post_meta(get_the_ID(), 'related_strain', true);
            $strain = $rel ? get_the_title($rel) : '';
      ?>
        <article class="sw-card sw-product">
          <a href="<?php the_permalink(); ?>" class="sw-card__media">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
          </a>
          <div class="sw-card__body">
            <h3 class="sw-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if ($strain): ?><p class="sw-meta">Strain: <?php echo esc_html($strain); ?></p><?php endif; ?>
            <p class="sw-meta">
              <?php if ($pkg): ?><?php echo esc_html($pkg); ?><?php endif; ?>
              <?php if ($thc !== ''): ?> • THC <?php echo esc_html($thc); ?>%<?php endif; ?>
            </p>
            <a class="sw-link" href="<?php the_permalink(); ?>">View product</a>
          </div>
        </article>
      <?php
          endwhile; wp_reset_postdata();
        else:
          echo '<p>No products yet.</p>';
        endif;
      ?>
      </div>
      <div class="sw-actions"><a class="sw-btn" href="<?php echo esc_url(get_post_type_archive_link('sw-product')); ?>">View all products</a></div>
    </div>
  </section>

  <section class="sw-section sw-strains">
    <div class="sw-wrap">
      <h2 class="sw-h2">Featured Strains</h2>
      <div class="sw-grid">
      <?php
        $s = new WP_Query([
          'post_type' => 'sw-strain',
          'posts_per_page' => 6,
          'ignore_sticky_posts' => true,
          'no_found_rows' => true,
        ]);
        if ($s->have_posts()):
          while ($s->have_posts()): $s->the_post();
            $lineage = get_post_meta(get_the_ID(), 'lineage', true);
      ?>
        <article class="sw-card sw-strain">
          <a href="<?php the_permalink(); ?>" class="sw-card__media">
            <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
          </a>
          <div class="sw-card__body">
            <h3 class="sw-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php if ($lineage): ?><p class="sw-meta">Lineage: <?php echo esc_html($lineage); ?></p><?php endif; ?>
            <a class="sw-link" href="<?php the_permalink(); ?>">View strain</a>
          </div>
        </article>
      <?php
          endwhile; wp_reset_postdata();
        else:
          echo '<p>No strains yet.</p>';
        endif;
      ?>
      </div>
      <div class="sw-actions"><a class="sw-btn" href="<?php echo esc_url(get_post_type_archive_link('sw-strain')); ?>">View all strains</a></div>
    </div>
  </section>

  <section class="sw-section sw-cta">
    <div class="sw-wrap">
      <h2 class="sw-h2">Find Skyworld Near You</h2>
      <p class="sw-meta">Licensed retailers across New York.</p>
      <a class="sw-btn" href="<?php echo esc_url(home_url('/where-to-find-us/')); ?>">Store Locator</a>
    </div>
  </section>
</main>
<?php get_footer(); ?>
