<?php
/**
 * Template: Single Product Content (Car Version - Optimized)
 */
defined('ABSPATH') || exit;

global $product;

/* ===== Custom Car Fields ===== */
$fields = [
    'car_year'    => 'Year',
    'car_km'      => 'Km',
    'car_engine'  => 'Engine',
    'car_gearbox' => 'Gearbox',
    'car_fuel'    => 'Fuel',
    'car_specs'   => 'Technical Specs',
];

$data = [];
foreach ($fields as $key => $label) {
    $val = get_post_meta($product->get_id(), $key, true);
    if (!empty($val)) {
        $data[$label] = $val;
    }
}

$categories = wp_get_post_terms($product->get_id(), 'product_cat');

/* ===== Sale Percent ===== */
$sale_percent = "";
if ($product->is_on_sale()) {
    $regular = floatval($product->get_regular_price());
    $sale    = floatval($product->get_sale_price());
    if ($regular > 0 && $sale > 0 && $sale < $regular) {
        $sale_percent = round((($regular - $sale) / $regular) * 100);
    }
}
?>

<div class="single-product-area">

    <div class="row">
        <!-- GALLERY -->
        <div class="col-lg-6 mb--40">
            <div class="single-product-gallery-wrapper position-relative">

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

                    <!-- Title -->
                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <!-- Price -->
                    <div class="price-amount mb--10">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <!-- Rating -->
                    <div class="product-rating mb--20">
                        <?php woocommerce_template_single_rating(); ?>
                    </div>

                    <!-- Brand -->
                    <?php if (!empty($categories)) : ?>
                        <div class="car-brand mb--10">
                            <strong>Brand:</strong> <?php echo esc_html($categories[0]->name); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Car Details Grid -->
                    <div class="car-specs-grid mt--20">

                        <?php foreach ($data as $label => $value) : ?>
                            <?php if ($label !== "Technical Specs") : ?>
                                <div class="car-spec-item">
                                    <span class="spec-label"><?php echo esc_html($label); ?>:</span>
                                    <span class="spec-value"><?php echo esc_html($value); ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>

                    <!-- Technical Specs -->
                    <?php if (!empty($data['Technical Specs'])) : ?>
                        <div class="technical-specs mt--25">
                            <h5><strong>Technical Specs</strong></h5>
                            <p><?php echo nl2br(esc_html($data['Technical Specs'])); ?></p>
                        </div>
                    <?php endif; ?>

                    <!-- Description -->
                    <div class="description mt--25">
                        <?php the_content(); ?>
                    </div>

                    <!-- Add to cart -->
                    <div class="product-action-wrapper mt--25">
                        <?php woocommerce_template_single_add_to_cart(); ?>
                    </div>

                    <!-- Meta -->
                    <div class="product-meta-info mt--20">
                        <?php woocommerce_template_single_meta(); ?>
                    </div>

                    <!-- Tabs -->
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

        <?php echo do_shortcode('[products limit="6" columns="4" orderby="rand" visibility="visible"]'); ?>
    </div>
</div>

<style>
/* Sale badge */
.sale-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: #e60023;
    color: #fff;
    padding: 6px 12px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 3px;
    z-index: 5;
}

/* Car spec grid */
.car-specs-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px 12px;
}

.car-spec-item {
    background: #f7f7f7;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 14px;
}

.spec-label {
    font-weight: 600;
    margin-right: 5px;
}
</style>
