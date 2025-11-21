<?php
/**
 * Template: Single Product (Wrapper)
 */
defined('ABSPATH') || exit;

get_header(); ?>

<main class="main-wrapper">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            wc_get_template_part( 'content', 'single-product' );
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>
