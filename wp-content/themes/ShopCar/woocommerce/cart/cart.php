<?php
defined('ABSPATH') || exit;

wc_print_notices();

do_action('woocommerce_before_cart');
?>

<main class="main-wrapper">

    <!-- Breadcrumb -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url(); ?>">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Cart</li>
                        </ul>
                        <h1 class="title">Your Cart</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="axil-cart-area axil-section-gap">
        <div class="container">

            <?php if ( WC()->cart->is_empty() ) : ?>

                <div class="empty-cart text-center mb--60">
                    <h3 class="mb--20">Giỏ hàng của bạn đang trống</h3>
                    <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-primary">
                        Tiếp tục mua sắm
                    </a>
                </div>

            <?php else : ?>

                <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">

                    <div class="cart-table table-responsive">
                        <table class="table axil-cart-table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Car</th>
                                    <th class="product-name">Model</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Qty</th>
                                    <th class="product-subtotal">Subtotal</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

                                    $_product   = $cart_item['data'];
                                    $product_id = $cart_item['product_id'];

                                    if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] <= 0 ) {
                                        continue;
                                    }
                                ?>

                                <tr <?php echo wc_get_cart_item_class( '', $cart_item, $cart_item_key ); ?>>

                                    <!-- Image -->
                                    <td class="product-thumbnail">
                                        <a href="<?php echo get_permalink($product_id); ?>">
                                            <?php echo $_product->get_image('medium'); ?>
                                        </a>
                                    </td>

                                    <!-- Name -->
                                    <td class="product-name">
                                        <a href="<?php echo get_permalink($product_id); ?>">
                                            <h6><?php echo $_product->get_name(); ?></h6>
                                        </a>
                                    </td>

                                    <!-- Price -->
                                    <td class="product-price">
                                        <span><?php echo $_product->get_price_html(); ?></span>
                                    </td>

                                    <!-- Quantity -->
                                    <td class="product-quantity">
                                        <?php
                                        echo woocommerce_quantity_input(
                                            array(
                                                'input_name'  => "cart[{$cart_item_key}][quantity]",
                                                'input_value' => $cart_item['quantity'],
                                                'min_value'   => 1,
                                                'max_value'   => $_product->get_max_purchase_quantity(),
                                            ),
                                            $_product,
                                            false
                                        );
                                        ?>
                                    </td>

                                    <!-- Subtotal -->
                                    <td class="product-subtotal">
                                        <?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
                                    </td>

                                    <!-- Remove -->
                                    <td class="product-remove">
                                        <a href="<?php echo esc_url( wc_get_cart_remove_url($cart_item_key) ); ?>" class="remove">
                                            <i class="fal fa-times"></i>
                                        </a>
                                    </td>

                                </tr>

                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>


                    <!-- Buttons -->
                    <div class="cart-button-group d-flex justify-content-between mt--30">
                        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-outline">
                            Continue Shopping
                        </a>

                        <button type="submit" class="axil-btn btn-primary" name="update_cart" value="1">
                            Update Cart
                        </button>

                        <?php do_action('woocommerce_cart_actions'); ?>
                    </div>

                    <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                </form>


                <!-- Cart Totals -->
                <div class="row justify-content-end mt--50">
                    <div class="col-lg-6">
                        <div class="axil-order-summery">

                            <h5 class="title">Cart Totals</h5>

                            <div class="summery-table-wrap">
                                <table class="table summery-table">
                                    <tbody>
                                        <tr>
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

                            <div class="summery-footer">
                                <a href="<?php echo wc_get_checkout_url(); ?>" class="axil-btn btn-primary">
                                    Proceed To Checkout
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>

</main>
