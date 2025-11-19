<?php
/* Template Name: Home Page */
get_header();
?>

<main class="main-wrapper">

    <!-- SLIDER AREA -->
    <?php get_template_part('template-parts/home/slider'); ?>

    <!-- CATEGORY AREA -->
    <?php get_template_part('template-parts/home/categories'); ?>

    <!-- POSTER COUNTDOWN -->
    <?php get_template_part('template-parts/home/poster-countdown'); ?>

    <!-- EXPLORE PRODUCTS -->
    <?php get_template_part('template-parts/home/explore-products'); ?>

    <!-- TESTIMONIAL -->
    <?php get_template_part('template-parts/home/testimonial'); ?>

    <!-- NEW ARRIVALS -->
    <?php get_template_part('template-parts/home/new-arrivals'); ?>

</main>

<?php
get_footer();
?>
