<?php
/**
 * Template: Single Product Content (Car Version)
 */
defined('ABSPATH') || exit;

global $product;

/* ===== Custom Car Fields ===== */
$car_year     = get_post_meta($product->get_id(), 'car_year', true);
$car_km       = get_post_meta($product->get_id(), 'car_km', true);
$car_engine   = get_post_meta($product->get_id(), 'car_engine', true);
$car_gearbox  = get_post_meta($product->get_id(), 'car_gearbox', true);
$car_fuel     = get_post_meta($product->get_id(), 'car_fuel', true);
$car_specs    = get_post_meta($product->get_id(), 'car_specs', true);

$categories   = wp_get_post_terms($product->get_id(), 'product_cat');

/* ===== Sale Percent ===== */
$sale_percent = "";
if ($product->is_on_sale()) {
    $regular = $product->get_regular_price();
    $sale    = $product->get_sale_price();

    if ($regular && $sale) {
        $sale_percent = round((($regular - $sale) / $regular) * 100);
    }
}
?>

<div class="single-product-area">

    <div class="row">
        <!-- GALLERY -->
        <div class="col-lg-6 mb--40">
            <div class="single-product-gallery-wrapper">

                <?php if ($sale_percent): ?>
                    <span class="product-badge sale-badge">-<?php echo $sale_percent; ?>%</span>
                <?php endif; ?>

                <?php do_action('woocommerce_before_single_product_summary'); ?>
            </div>
        </div>

        <!-- INFORMATION -->
        <div class="col-lg-6 mb--40">
            <div class="single-product-content">
                <div class="inner">

                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <div class="price-amount">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <div class="product-rating">
                        <?php woocommerce_template_single_rating(); ?>
                    </div>

                    <!-- Car info -->
                    <div class="car-info-table mt--20">
                        <table class="table table-bordered">
                            <tbody>

                                <?php if ($categories): ?>
                                    <tr>
                                        <td><strong>Brand:</strong></td>
                                        <td><?php echo esc_html($categories[0]->name); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_year): ?>
                                    <tr>
                                        <td><strong>Year:</strong></td>
                                        <td><?php echo esc_html($car_year); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_km): ?>
                                    <tr>
                                        <td><strong>Km:</strong></td>
                                        <td><?php echo esc_html($car_km); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_engine): ?>
                                    <tr>
                                        <td><strong>Engine:</strong></td>
                                        <td><?php echo esc_html($car_engine); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_gearbox): ?>
                                    <tr>
                                        <td><strong>Gearbox:</strong></td>
                                        <td><?php echo esc_html($car_gearbox); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_fuel): ?>
                                    <tr>
                                        <td><strong>Fuel:</strong></td>
                                        <td><?php echo esc_html($car_fuel); ?></td>
                                    </tr>
                                <?php endif; ?>

                            </tbody>
                        </table>
                    </div>

                    <!-- Product Description -->
                    <div class="description mt--20">
                        <?php the_content(); ?>
                    </div>

                    <!-- Technical Specs -->
                    <?php if ($car_specs): ?>
                        <div class="mt--20">
                            <h5><strong>Technical Specs</strong></h5>
                            <p><?php echo nl2br(esc_html($car_specs)); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Add to cart -->
                    <div class="product-action-wrapper mt--20">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

                    <!-- Categories / Meta -->
                    <div class="product-meta-info pt--20">
                        <?php woocommerce_template_single_meta(); ?>
                    </div>

                    <!-- Tabs (Description / Reviews / Additional Info) -->
                    <div class="product-desc-wrapper pt--40">
                        <?php woocommerce_output_product_data_tabs(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed -->
<div class="axil-product-area bg-color-white axil-section-gap pb--50">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="title-highlighter highlighter-primary">
                <i class="far fa-shopping-basket"></i> Your Recently
            </span>
            <h2 class="title">Viewed Items</h2>
        </div>

        <?php echo do_shortcode('[products limit="4" columns="4" orderby="rand" visibility="visible"]'); ?>
    </div>
</div>
