<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<style>
    /* === DROPDOWN UI CLEAN === */

    .account-dropdown {
        display: none !important;
        position: absolute;
        right: 0;
        top: 45px;
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .08);
        border-radius: 12px;
        padding: 0;
        width: 220px;
        z-index: 9999;
        overflow: hidden;
    }

    /* Active */
    .menu-account.active .account-dropdown {
        display: block !important;
    }

    /* Header Xin chào */
    .account-dropdown .dropdown-header {
        font-size: 14px;
        color: #444;
        padding: 14px 16px;
        background: #fafafa;
        border-bottom: 1px solid #eee;
        display: block;
        font-weight: 500;
    }

    /* Item */
    .account-dropdown li {
        list-style: none;
    }

    .account-dropdown li a {
        display: block;
        padding: 14px 16px;
        font-size: 15px;
        color: #222;
        text-decoration: none;
        transition: 0.15s ease;
    }

    .account-dropdown li a:hover {
        background: #f5f5f5;
    }

    /* Gạch phân cách */
    .account-dropdown .separator {
        height: 1px;
        background: #eee;
        margin: 4px 0;
    }

    /* Log Out */
    .account-dropdown li a.text-danger {
        color: #d90429 !important;
        font-weight: 600;
    }
</style>

<script>
    jQuery(document).ready(function($) {

        /* CLICK avatar toggle dropdown */
        $(".account-toggle").on("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            $(".menu-account").toggleClass("active");
        });

        /* Prevent close when clicking inside dropdown */
        $(".account-dropdown").on("click", function(e) {
            e.stopPropagation();
        });

        /* Click outside closes dropdown */
        $(document).on("click", function() {
            $(".menu-account").removeClass("active");
        });
    });
</script>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="header axil-header header-style-1" style="background:white;">
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar" style="display:flex; align-items:center; justify-content:space-between;">

                    <!-- Logo -->
                    <div class="header-logo">
                        <a href="<?php echo home_url('/'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/Fulllogo.png"
                                alt="ShopCar Logo" style="height:48px;">
                        </a>
                    </div>

                    <!-- MAIN MENU -->
                    <nav class="header-nav">
                        <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'mainmenu',
                            'fallback_cb' => false
                        ]);
                        ?>
                    </nav>

                    <!-- RIGHT AREA -->
                    <div class="header-action">
                        <ul class="action-list" style="gap:18px; display:flex; align-items:center;">

                            <!-- SEARCH ICON -->
                            <li class="menu-search">
                                <a href="#" class="search-toggle">
                                    <i class="fas fa-search"></i>
                                </a>
                            </li>

                            <!-- USER ACCOUNT -->
                            <li class="axil-user-area menu-account">

                                <a href="javascript:void(0)" class="account-toggle">
                                    <?php if (is_user_logged_in()):
                                        $current_user = wp_get_current_user();
                                        $avatar = get_avatar_url($current_user->ID, ['size' => 40]); ?>
                                        <img src="<?php echo esc_url($avatar); ?>"
                                            style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                    <?php else: ?>
                                        <i class="far fa-user" style="font-size:20px;"></i>
                                    <?php endif; ?>
                                </a>

                                <ul class="account-dropdown">

                                    <?php if (is_user_logged_in()): ?>

                                        <li class="dropdown-header">
                                            👋 Xin chào <strong><?php echo esc_html($current_user->display_name); ?></strong>
                                        </li>

                                        <li><a href="<?php echo site_url('/yeu-thich'); ?>">Wishlist</a></li>
                                        <li><a href="<?php echo site_url('/change-password'); ?>">Change Password</a></li>

                                        <li class="separator"></li>

                                        <li>
                                            <a class="text-danger"
                                                href="<?php echo wp_logout_url(home_url('/login')); ?>">
                                                Log Out
                                            </a>
                                        </li>

                                    <?php else: ?>

                                        <li><a href="<?php echo site_url('/login'); ?>">Login</a></li>
                                        <li><a href="<?php echo site_url('/register'); ?>">Register</a></li>
                                        <li><a href="<?php echo site_url('/forgot-password'); ?>">Forgot Password</a></li>

                                    <?php endif; ?>

                                </ul>
                            </li>

                            <!-- CART -->
                            <li class="axil-cart">
                                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link" style="position:relative;">
                                    <i class="far fa-shopping-cart" style="font-size:20px;"></i>
                                    <span class="cart-count"
                                        style="position:absolute; top:-6px; right:-10px; background:#ff497c; color:white; font-size:12px; padding:2px 6px; border-radius:50%;">
                                        <?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?>
                                    </span>
                                </a>
                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </header>

</body>