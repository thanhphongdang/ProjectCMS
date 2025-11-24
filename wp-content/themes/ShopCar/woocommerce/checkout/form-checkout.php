<?php
defined('ABSPATH') || exit;

// 🔥 Detect Order (nếu đang ở trang order-received)
$order_id = isset($_GET['order-received']) ? intval($_GET['order-received']) : 0;
$order = $order_id ? wc_get_order($order_id) : null;

do_action('woocommerce_before_checkout_form', $checkout);

// Nếu user chưa đăng nhập và checkout yêu cầu login
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html__('Bạn phải đăng nhập để thanh toán.', 'woocommerce');
    return;
}
?>

<main class="main-wrapper" style="background:#f8f5ef;">

    <!-- Breadcrumb -->
    <div class="axil-breadcrumb-area" style="padding:40px 0;background:#111;">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="inner">

                        <ul class="axil-breadcrumb" style="color:#d4af37;font-weight:600;font-size:15px;">
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url('/'); ?>" style="color:#d4af37;">Home</a>
                            </li>
                            <li class="separator" style="color:#d4af37;">/</li>
                            <li class="axil-breadcrumb-item active" style="color:white;">Checkout</li>
                        </ul>

                        <h1 class="title" style="color:white;font-size:42px;font-weight:700;margin-top:10px;">
                            Thanh Toán
                        </h1>

                        <!-- 🔥 HIỂN THỊ NÚT HỦY ĐƠN -->
                        <?php if ($order && in_array($order->get_status(), ['pending', 'on-hold'])): ?>

                            <div
                                style="padding:18px;background:#fbeaea;border:1px solid #ffb9b9;margin:25px 0;border-radius:10px;">
                                <strong style="color:#cc0000;font-size:17px;">
                                    Đơn hàng #<?php echo $order_id; ?> đã được tạo thành công!
                                </strong><br>
                                <span style="color:#333;">Bạn có thể hủy đơn nếu muốn.</span>
                            </div>

                            <a href="<?php echo home_url('/my-account/?cancel_order=' . $order_id); ?>" style="background:#c60000;color:#fff;padding:12px 22px;border-radius:8px;
                                    display:inline-block;margin-bottom:20px;text-decoration:none;font-weight:600;">
                                ❌ Hủy đơn hàng
                            </a>

                        <?php endif; ?>
                        <!-- END -->

                    </div>
                </div>

                <div class="col-lg-6 text-end">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt=""
                        style="max-width:200px;opacity:0.9;">
                </div>

            </div>
        </div>
    </div>

    <div class="axil-checkout-area" style="padding:60px 0;">
        <div class="container">

            <form name="checkout" method="post" class="checkout woocommerce-checkout"
                action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data"
                style="background:white;padding:40px;border-radius:18px;box-shadow:0 10px 30px rgba(0,0,0,0.08);">

                <div class="row">

                    <!-- Billing Details -->
                    <div class="col-lg-7">

                        <div class="axil-checkout-billing" style="padding-right:25px;">
                            <h4 class="title mb--20"
                                style="font-size:26px;color:#333;font-weight:700;border-left:5px solid #d4af37;padding-left:12px;">
                                Thông tin thanh toán
                            </h4>

                            <?php if ($checkout->get_checkout_fields()): ?>

                                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                <div id="customer_details" style="background:#faf7f2;padding:20px;border-radius:12px;">

                                    <?php do_action('woocommerce_checkout_billing'); ?>

                                    <div class="mt--30"></div>

                                    <?php do_action('woocommerce_checkout_shipping'); ?>

                                </div>

                                <?php do_action('woocommerce_checkout_after_customer_details'); ?>

                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-5">

                        <div class="axil-order-summery order-checkout-summery"
                            style="background:#111;color:white;padding:30px;border-radius:14px;">

                            <h5 class="title mb--20" style="color:#d4af37;font-size:24px;font-weight:600;">
                                Tóm tắt đơn hàng
                            </h5>

                            <div class="summery-table-wrap" style="background:#1a1a1a;padding:20px;border-radius:10px;">
                                <table class="table summery-table" style="color:white;">
                                    <tbody>

                                        <?php
                                        do_action('woocommerce_review_order_before_cart_contents');

                                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                            $_product = $cart_item['data'];
                                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0):
                                                ?>

                                                <tr class="cart_item">
                                                    <td class="product-name" style="width:65%;font-size:16px;color:#eee;">
                                                        <?php echo $_product->get_name(); ?>
                                                        <strong class="product-quantity"> ×
                                                            <?php echo $cart_item['quantity']; ?></strong>
                                                    </td>

                                                    <td class="product-total" style="color:#d4af37;font-weight:600;">
                                                        <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                    </td>
                                                </tr>

                                                <?php
                                            endif;
                                        }

                                        do_action('woocommerce_review_order_after_cart_contents');
                                        ?>

                                        <tr class="order-subtotal">
                                            <td style="color:#ccc;">Subtotal</td>
                                            <td style="color:#fff;"><?php wc_cart_totals_subtotal_html(); ?></td>
                                        </tr>

                                        <?php wc_cart_totals_fee_html(); ?>
                                        <?php wc_cart_totals_shipping_html(); ?>
                                        <?php wc_cart_totals_taxes_total_html(); ?>

                                        <tr class="order-total">
                                            <td style="color:#d4af37;font-size:18px;font-weight:600;">Total</td>
                                            <td style="color:#d4af37;font-size:18px;font-weight:700;">
                                                <?php wc_cart_totals_order_total_html(); ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- Voucher Code -->
                            <div class="checkout-voucher"
                                style="margin-top:20px;padding:15px;background:#222;border-radius:10px;">
                                <h5 style="color:#d4af37;">🎁 Mã giảm giá</h5>
                                <input type="text" id="checkout_voucher_code" placeholder="Nhập mã giảm giá..."
                                    style="width:70%;padding:10px;border-radius:6px;border:1px solid #ddd;">
                                <button type="button" id="apply_checkout_voucher"
                                    style="padding:10px 15px;margin-left:10px;background:#ee4d2d;color:#fff;border:none;border-radius:6px;cursor:pointer;">Áp
                                    dụng</button>
                                <div id="checkout_voucher_result" style="margin-top:10px;color:#fff;"></div>
                            </div>

                            <script>
                                jQuery(document).ready(function ($) {
                                    $('#apply_checkout_voucher').on('click', function () {
                                        var code = $('#checkout_voucher_code').val();

                                        if (!code) { alert('Vui lòng nhập mã voucher'); return; }

                                        $.post('<?php echo admin_url("admin-ajax.php"); ?>', {
                                            action: 'apply_checkout_voucher',
                                            code: code
                                        }, function (response) {
                                            $('#checkout_voucher_result').html(response);
                                            // Reload để WC cập nhật totals
                                            location.reload();
                                        });
                                    });
                                });
                            </script>

                            <!-- Payment + Place Order -->
                            <div id="payment" class="woocommerce-checkout-payment" style="margin-top:25px;">
                                <?php if (!is_ajax()):
                                    do_action('woocommerce_review_order_before_payment'); endif; ?>

                                <?php woocommerce_checkout_payment(); ?>

                                <?php if (!is_ajax()):
                                    do_action('woocommerce_review_order_after_payment'); endif; ?>
                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</main>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>