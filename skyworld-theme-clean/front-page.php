<?php
/**
 * Template Name: Homepage
 * Description: Homepage template with Jeeter-inspired layout and ACF integration
 */

get_header(); ?>

<!-- Hero Section -->
<?php get_template_part('template-parts/hero-section'); ?>

<!-- Press Section -->
<?php get_template_part('template-parts/press-section'); ?>

<!-- Product Categories Section -->
<?php get_template_part('template-parts/product-categories'); ?>

<!-- Our Story Section -->
<?php get_template_part('template-parts/story-section'); ?>

<!-- Interactive/Education Section -->
<?php get_template_part('template-parts/interactive-section'); ?>

<!-- Store Locator Section -->
<?php get_template_part('template-parts/store-locator-section'); ?>

<?php get_footer(); ?>