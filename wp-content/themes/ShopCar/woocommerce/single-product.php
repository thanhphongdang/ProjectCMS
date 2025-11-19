<?php
/**
 * Template for displaying single product page (based on eTrade single-product-2.html)
 */
defined('ABSPATH') || exit;

get_header(); // header.php
?>

<main class="main-wrapper">
    <div class="axil-single-product-area bg-color-white">
        <div class="single-product-thumb axil-section-gap pb--20 pb_sm--0 bg-vista-white">
            <div class="container">
                <div class="row">
                    <!-- Left: Product Images -->
                    <div class="col-lg-6 mb--40">
                        <div class="woocommerce-product-gallery">
                            <?php
                                /**
                                 * WooCommerce hook: woocommerce_before_single_product_summary
                                 * This outputs the product gallery (images, sale badge, etc.)
                                 */
                                do_action('woocommerce_before_single_product_summary');
                            ?>
                        </div>
                    </div>

                    <!-- Right: Product Info -->
                    <div class="col-lg-6 mb--40">
                        <div class="single-product-content">
                            <div class="inner">
                                <h2 class="product-title"><?php the_title(); ?></h2>

                                <span class="price-amount">
                                    <?php global $product; echo $product->get_price_html(); ?>
                                </span>

                                <div class="product-rating">
                                    <?php woocommerce_template_single_rating(); ?>
                                </div>

                                <ul class="product-meta">
                                    <li><i class="fal fa-check"></i>In stock</li>
                                    <li><i class="fal fa-check"></i>Free delivery available</li>
                                    <li><i class="fal fa-check"></i>Sales 30% Off Use Code: MOTIVE30</li>
                                </ul>

                                <div class="description">
                                    <?php the_content(); ?>
                                </div>

                                <!-- Quantity + Add to Cart -->
                                <div class="product-action-wrapper d-flex-center">
                                    <?php woocommerce_template_single_add_to_cart(); ?>
                                </div>

                                <!-- Meta (Categories, Tags) -->
                                <div class="product-meta-info pt--30">
                                    <?php woocommerce_template_single_meta(); ?>
                                </div>

                                <!-- Description / Additional Info / Reviews Tabs -->
                                <div class="product-desc-wrapper pt--80 pt_sm--60">
                                    <?php woocommerce_output_product_data_tabs(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed (optional WooCommerce shortcode) -->
    <div class="axil-product-area bg-color-white axil-section-gap pb--50 pb_sm--30">
        <div class="container">
            <div class="section-title-wrapper">
                <span class="title-highlighter highlighter-primary">
                    <i class="far fa-shopping-basket"></i> Your Recently
                </span>
                <h2 class="title">Viewed Items</h2>
            </div>

            <?php echo do_shortcode('[products limit="6" columns="4" orderby="rand" visibility="visible"]'); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
