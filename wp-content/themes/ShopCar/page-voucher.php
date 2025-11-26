<?php
/**
 * Template Name: Shopee Voucher Page
 */

get_header();
?>

<style>
/* Shopee style */
.shopee-voucher-box {
    background: #fff;
    padding: 22px;
    border-radius: 12px;
    margin: 40px auto;
    max-width: 700px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.shopee-voucher-title {
    font-size: 22px;
    font-weight: 700;
    color: #ee4d2d;
    display: flex;
    align-items: center;
    gap: 10px;
}
.shopee-input-voucher {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #ddd;
    margin-top: 15px;
}
.shopee-btn {
    background: #ee4d2d;
    color: white;
    border: none;
    padding: 12px 20px;
    width: 100%;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 12px;
    font-size: 16px;
}
.shopee-btn:hover {
    background: #d84225;
}
.shopee-result {
    background: #fff6f5;
    border-left: 4px solid #ee4d2d;
    padding: 12px;
    margin-top: 20px;
    border-radius: 8px;
}
.voucher-item {
    display: flex;
    justify-content: space-between;
    background: #fff7f5;
    border-left: 4px solid #ee4d2d;
    padding: 12px;
    border-radius: 8px;
    margin-top: 12px;
}
.voucher-item button {
    background: #ee4d2d;
    border: none;
    color: #fff;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
}
</style>


<div class="shopee-voucher-box">

    <div class="shopee-voucher-title">🎁 <?php echo esc_html(get_theme_mod('voucher_page_title', 'Mã giảm giá')); ?></div>

    <form method="post">
        <input class="shopee-input-voucher" type="text" name="voucher" placeholder="<?php echo esc_attr(get_theme_mod('voucher_placeholder', 'Nhập mã giảm giá...')); ?>">
        <button class="shopee-btn">Áp dụng</button>
    </form>

    <?php
    if (!empty($_POST['voucher'])) {

        $code = sanitize_text_field($_POST['voucher']);
        $coupon = new WC_Coupon($code);

        if ($coupon->get_id()) {
            $amount = $coupon->get_amount();
            $type = $coupon->get_discount_type();

            $label = ($type == 'percent') ? "% giảm" : "₫ giảm";

            echo "<div class='shopee-result'>
                    🎉 Mã hợp lệ: <strong>$code</strong><br>
                    Giảm: <strong>$amount $label</strong>
                  </div>";
        } else {
            echo "<div class='shopee-result' style='border-left-color:red;'>
                    ❌ Mã giảm giá không đúng hoặc đã hết hạn!
                  </div>";
        }
    }
    ?>

    <h3 style="margin-top:20px; font-size:18px;"><?php echo esc_html(get_theme_mod('voucher_suggestions_title', 'Gợi ý voucher')); ?></h3>

    <?php
    for ($i = 1; $i <= 3; $i++) {
        $code = get_theme_mod('voucher_suggestion_' . $i . '_code', '');
        $desc = get_theme_mod('voucher_suggestion_' . $i . '_desc', '');
        if ($code) {
    ?>
    <div class="voucher-item">
        <div><strong><?php echo esc_html($code); ?></strong><?php echo $desc ? ' – ' . esc_html($desc) : ''; ?></div>
        <button onclick="copyVoucher('<?php echo esc_js($code); ?>')">Copy</button>
    </div>
    <?php
        }
    }
    ?>

</div>

<script>
function copyVoucher(code) {
    navigator.clipboard.writeText(code);
    alert("Đã copy mã: " + code);
}
</script>

<?php
get_footer();
?>
