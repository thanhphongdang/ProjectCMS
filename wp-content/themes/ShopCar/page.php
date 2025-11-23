<?php
/**
 * The template for displaying all pages
 */

get_header();

?>

<div class="content-area">
    <main class="site-main">

        <?php
        // WooCommerce pages như Cart, Checkout, My Account
        if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            woocommerce_content();
        } else {
            // Các trang Page bình thường
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
        }
        ?>

    </main>
</div>

<?php get_footer(); ?>
