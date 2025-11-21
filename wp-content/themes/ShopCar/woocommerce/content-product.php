<?php
defined('ABSPATH') || exit;

global $product;

// Bắt buộc để WooCommerce không lỗi
if ( empty($product) || !$product->is_visible() ) return;

// Sale %
$sale_percent = '';
if ($product->is_on_sale()) {
    $regular = $product->get_regular_price();
    $sale    = $product->get_sale_price();
    if ($regular && $sale) {
        $sale_percent = round((($regular - $sale) / $regular) * 100);
    }
}
?>

<div <?php wc_product_class('axil-product product-style-one product-card', $product); ?>>

    <div class="thumbnail-wrapper" style="position:relative;">

        <a href="<?php the_permalink(); ?>" class="thumbnail d-block">
            <?php echo $product->get_image('medium'); ?>
        </a>

        <?php if ($sale_percent): ?>
            <span class="product-badge sale-badge">-<?php echo $sale_percent; ?>%</span>
        <?php endif; ?>

    </div>

    <div class="product-content mt--15">

        <h5 class="title">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h5>

        <div class="product-price-variant mt--10">
            <span class="price current-price">
                <?php echo $product->get_price_html(); ?>
            </span>
        </div>

        <div class="product-action mt--15">
            <?php woocommerce_template_loop_add_to_cart(); ?>
        </div>

    </div>
</div>

<style>
.product-card {
    width: 260px;
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    transition: 0.3s;
}
.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.sale-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #E63946;
    color: #fff;
    padding: 5px 12px;
    font-size: 13px;
    font-weight: 600;
    border-radius: 5px;
    box-shadow: 0 4px 10px rgba(255,0,0,0.2);
}

.thumbnail img {
    border-radius: 10px;
    object-fit: cover;
}

.product-action a.button {
    background: #111;
    color: #fff;
    border-radius: 6px !important;
    padding: 8px 15px !important;
    font-size: 14px;
}
.product-action a.button:hover {
    background: #ff6600;
}
</style>
