<?php
/**
 * Custom Sale Flash for Product Loop (Car Theme)
 */

defined('ABSPATH') || exit;

global $product;

// Không sale → không hiển thị
if (!$product || !$product->is_on_sale()) {
    return;
}

$percentage = 0;

/**
 * Tính % giảm giá theo từng loại sản phẩm
 */
if ($product->is_type('variable')) {
    $regular_price = $product->get_variation_regular_price('max');
    $sale_price    = $product->get_variation_sale_price('max');
} else {
    $regular_price = $product->get_regular_price();
    $sale_price    = $product->get_sale_price();
}

// Tránh lỗi chia 0
if ($regular_price && $sale_price && $regular_price > $sale_price) {
    $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}
?>

<?php if ($percentage > 0) : ?>
    <span class="product-badge sale-badge">-<?php echo esc_html($percentage); ?>%</span>
<?php endif; ?>

<style>
/* Badge style (giữ nguyên cái bạn đã dùng) */
.sale-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    z-index: 10;
}
</style>