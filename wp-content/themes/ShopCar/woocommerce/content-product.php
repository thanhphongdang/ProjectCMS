<?php
/**
 * Template: Product Card (Overridden from WooCommerce)
 */
defined('ABSPATH') || exit;

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>

<li <?php wc_product_class( 'product-card', $product ); ?>>
    <div class="product-content">
        <div class="inner">

            <!-- Product Image -->
            <a href="<?php the_permalink(); ?>" class="thumbnail">
                <?php echo $product->get_image( 'medium' ); ?>
            </a>

            <!-- Product Title -->
            <h3 class="product-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h3>

            <!-- Product Price -->
            <div class="product-price-variant">
                <span class="price">
                    <?php echo $product->get_price_html(); ?>
                </span>
            </div>

            <!-- Add to cart button -->
            <div class="axil-product-action">
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>

            <!-- Example static color variants (optional) -->
            <div class="color-variant-wrapper">
                <ul class="color-variant">
                    <li class="color-extra-01 active"><span><span class="color"></span></span></li>
                    <li class="color-extra-02"><span><span class="color"></span></span></li>
                    <li class="color-extra-03"><span><span class="color"></span></span></li>
                </ul>
            </div>

        </div>
    </div>
</li>
