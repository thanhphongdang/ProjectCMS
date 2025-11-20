<?php
defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

// Nếu user chưa đăng nhập và checkout yêu cầu login
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html__('Bạn phải đăng nhập để thanh toán.', 'woocommerce');
    return;
}
?>

<main class="main-wrapper">

    <!-- Breadcrumb -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url('/'); ?>">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Checkout</li>
                        </ul>
                        <h1 class="title">Checkout</h1>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="inner text-end">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="axil-checkout-area axil-section-gap">
        <div class="container">

            <form name="checkout" method="post" class="checkout woocommerce-checkout"
                action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

                <div class="row">

                    <!-- Billing Details -->
                    <div class="col-lg-7">

                        <div class="axil-checkout-billing">
                            <h4 class="title mb--20">Thông tin thanh toán</h4>

                            <?php if ($checkout->get_checkout_fields()) : ?>

                                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                                <div id="customer_details">

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

                        <div class="axil-order-summery order-checkout-summery">

                            <h5 class="title mb--20">Tóm tắt đơn hàng</h5>

                            <div class="summery-table-wrap">
                                <table class="table summery-table">
                                    <tbody>

                                        <?php
                                        do_action('woocommerce_review_order_before_cart_contents');

                                        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                            $_product   = $cart_item['data'];
                                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                                        ?>

                                            <tr class="cart_item">
                                                <td class="product-name" style="width:65%;">
                                                    <?php echo $_product->get_name(); ?>
                                                    <strong class="product-quantity"> × <?php echo $cart_item['quantity']; ?></strong>
                                                </td>

                                                <td class="product-total">
                                                    <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                                </td>
                                            </tr>

                                        <?php
                                            endif;
                                        }

                                        do_action('woocommerce_review_order_after_cart_contents');
                                        ?>

                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td><?php wc_cart_totals_subtotal_html(); ?></td>
                                        </tr>

                                        <?php wc_cart_totals_fee_html(); ?>
                                        <?php wc_cart_totals_shipping_html(); ?>
                                        <?php wc_cart_totals_taxes_total_html(); ?>

                                        <tr class="order-total">
                                            <td>Total</td>
                                            <td><?php wc_cart_totals_order_total_html(); ?></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <!-- Payment + Place Order -->
                            <div id="payment" class="woocommerce-checkout-payment">
                                <?php if (!is_ajax()) : do_action('woocommerce_review_order_before_payment'); endif; ?>

                                <?php woocommerce_checkout_payment(); ?>

                                <?php if (!is_ajax()) : do_action('woocommerce_review_order_after_payment'); endif; ?>
                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</main>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
