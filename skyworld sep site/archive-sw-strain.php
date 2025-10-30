<?php
/**
 * Template: archive-sw-strain.php
 */
if (!defined('ABSPATH')) exit;
get_header();
?>
<main class="sw-archive sw-strains">
  <header class="sw-header"><h1 class="sw-title"><?php post_type_archive_title(); ?></h1></header>
  <div class="sw-grid">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article class="sw-card sw-strain">
        <a href="<?php the_permalink(); ?>" class="sw-card__media">
          <?php if (has_post_thumbnail()) the_post_thumbnail('medium_large'); ?>
        </a>
        <div class="sw-card__body">
          <h3 class="sw-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <a class="sw-link" href="<?php the_permalink(); ?>">View strain</a>
        </div>
      </article>
    <?php endwhile; else: echo '<p>No strains found.</p>'; endif; ?>
  </div>
  <nav class="sw-pagination"><?php the_posts_pagination(); ?></nav>
</main>
<?php get_footer(); ?>
