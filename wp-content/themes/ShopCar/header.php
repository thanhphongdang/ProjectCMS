<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="header axil-header header-style-1">
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">

                    <!-- Logo -->
                    <div class="header-logo">
                        <a href="<?php echo home_url('/'); ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/logo.png"
                                alt="ShopCar Logo">
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

                    <!-- Header Right Icons -->
                    <div class="header-action">
                        <ul class="action-list">

                            <!-- Search -->
                            <li class="axil-search">
                                <a href="#" class="header-search-icon"><i class="far fa-search"></i></a>
                            </li>

                            <!-- Account -->
                            <!-- Account -->
                            <li class="axil-user-area menu-account">
                                <?php if (is_user_logged_in()): ?>
                                    <?php
                                    $current_user = wp_get_current_user();
                                    $display_name = $current_user->display_name ?: $current_user->user_login;
                                    ?>
                                    <a href="#" class="account-toggle logged-in-user">
                                        <i class="far fa-user"></i>
                                        <span class="username"><?php echo esc_html($display_name); ?></span>
                                    </a>
                                    <ul class="account-dropdown">
                                        <li><a href="<?php echo wc_get_account_endpoint_url('dashboard'); ?>">Dashboard</a>
                                        </li>
                                        <li><a href="<?php echo wc_get_account_endpoint_url('orders'); ?>">Orders</a></li>
                                        <li><a href="<?php echo wc_get_account_endpoint_url('edit-account'); ?>">Edit
                                                Account</a></li>
                                        <li><a href="<?php echo wc_logout_url(); ?>">Logout</a></li>
                                    </ul>
                                <?php else: ?>
                                    <a href="#" class="account-toggle">
                                        <i class="far fa-user"></i>
                                    </a>
                                    <ul class="account-dropdown">
                                        <li><a href="<?php echo site_url('/sign-in'); ?>">Login</a></li>
                                        <li><a href="<?php echo site_url('/signup'); ?>">Register</a></li>
                                    </ul>
                                <?php endif; ?>
                            </li>



                            <!-- Cart -->
                            <li class="axil-cart">
                                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link">
                                    <i class="far fa-shopping-cart"></i>
                                    <span class="cart-count">
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