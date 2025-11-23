<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order woocommerce-thankyou-order">

    <?php if ( $order ) : ?>

        <?php if ( $order->has_status( 'failed' ) ) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed">
                <?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?>
            </p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay">
                    <?php esc_html_e( 'Pay', 'woocommerce' ); ?>
                </a>

                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button">
                        <?php esc_html_e( 'My account', 'woocommerce' ); ?>
                    </a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <h2 class="woocommerce-notice woocommerce-notice--success">
                🎉 Cảm ơn bạn! Đơn hàng của bạn đã được nhận.
            </h2>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
                <li class="woocommerce-order-overview__order order">
                    <strong>Mã đơn:</strong> <?php echo $order->get_order_number(); ?>
                </li>
                <li class="woocommerce-order-overview__date date">
                    <strong>Ngày đặt:</strong> <?php echo wc_format_datetime( $order->get_date_created() ); ?>
                </li>
                <li class="woocommerce-order-overview__email email">
                    <strong>Email:</strong> <?php echo $order->get_billing_email(); ?>
                </li>
                <li class="woocommerce-order-overview__total total">
                    <strong>Tổng tiền:</strong> <?php echo $order->get_formatted_order_total(); ?>
                </li>
                <li class="woocommerce-order-overview__payment-method method">
                    <strong>Thanh toán:</strong> <?php echo wp_kses_post( $order->get_payment_method_title() ); ?>
                </li>
            </ul>

            <!-- 🔥 Nút Hủy Đơn Hàng -->
            <?php if ( in_array( $order->get_status(), ['pending', 'on-hold'] ) ) : ?>

                <div style="padding:15px;background:#ffecec;border:1px solid #ff9999;margin:25px 0;">
                    <strong>Đơn hàng #<?php echo $order->get_id(); ?> đang chờ xử lý.</strong><br>
                    Bạn có thể hủy đơn ngay bây giờ.
                </div>

                <a href="<?php echo home_url('/my-account/?cancel_order=' . $order->get_id()); ?>"
                    style="background:red;color:#fff;padding:12px 20px;border-radius:8px;
                        display:inline-block;font-size:15px;text-decoration:none;margin-bottom:30px;">
                    ❌ Hủy đơn hàng
                </a>

            <?php endif; ?>
            <!-- 🔥 END -->

            <h3 class="mt--20">Order details</h3>
            <?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
            <?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

        <?php endif; ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
            <?php esc_html_e( 'Thank you. Your order has been received.', 'woocommerce' ); ?>
        </p>

    <?php endif; ?>

</div>