<!DOCTYPE html>
<html <?php language_attributes(); ?>>

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
                    <div class="header-action" style="position:relative;">
                        <ul class="action-list" style="gap:18px; display:flex; align-items:center;">

                            <!-- Header Right Icons -->
                            <!-- Header Right Icons -->
                            <!-- Header Right Icons -->
                            <div class="header-action">
                                <ul class="action-list">

                                    <!-- Search -->
                                    <li class="axil-search">
                                        <a href="#" class="header-search-icon">
                                            <i class="far fa-search"></i>
                                        </a>
                                    </li>

                                    <!-- Account -->
                                    <li class="axil-user-area menu-account">
                                        <a href="javascript:void(0)" class="account-toggle">
                                            <?php if (is_user_logged_in()): ?>
                                                <?php
                                                $current_user = wp_get_current_user();
                                                $avatar = get_avatar_url($current_user->ID, ['size' => 40]);
                                                ?>
                                                <img src="<?php echo esc_url($avatar); ?>" alt="Avatar"
                                                    style="width:28px;height:28px;border-radius:50%;object-fit:cover;">
                                            <?php else: ?>
                                                <i class="far fa-user"></i>
                                            <?php endif; ?>
                                        </a>

                                        <ul class="account-dropdown">

                                            <?php if (is_user_logged_in()): ?>

                                                <li class="dropdown-header">
                                                    👋 Xin chào,
                                                    <strong><?php echo esc_html($current_user->display_name); ?></strong>
                                                </li>
                                                <li>
                                                    <a href="<?php echo site_url('/change-password'); ?>">
                                                        Đổi mật khẩu
                                                    </a>
                                                </li>


                                                <li class="separator"></li>

                                                <li>
                                                    <a href="<?php echo wp_logout_url(home_url('/login')); ?>"
                                                        class="text-danger">
                                                        Đăng xuất
                                                    </a>

                                                </li>

                                            <?php endif; ?>

                                        </ul>
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



                            <!-- 🔍 SEARCH ICON -->
                            <li class="menu-search" style="cursor:pointer;">
                                <a href="#" class="search-toggle">
                                    <i class="fas fa-search" style="font-size:20px;"></i>
                                </a>
                            </li>


                            <!-- 👤 USER -->
                            <li class="axil-user-area menu-account" style="position:relative;">
                                <a href="javascript:void(0)" class="account-toggle">

                                    <?php if (is_user_logged_in()): ?>
                                        <?php
                                        $current_user = wp_get_current_user();
                                        $avatar = get_avatar_url($current_user->ID, ['size' => 40]);
                                        ?>
                                        <img src="<?php echo esc_url($avatar); ?>"
                                            style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                                    <?php else: ?>
                                        <i class="far fa-user" style="font-size:20px;"></i>
                                    <?php endif; ?>

                                </a>

                                <ul class="account-dropdown">
                                    <?php if (is_user_logged_in()): ?>

                                        <li class="dropdown-header">
                                            👋 Xin chào
                                            <strong><?php echo esc_html($current_user->display_name); ?></strong>
                                        </li>

                                        <li>
                                            <a
                                                href="<?php echo wc_get_endpoint_url('edit-account', '', wc_get_page_permalink('myaccount')); ?>">Đổi
                                                mật khẩu</a>
                                        </li>

                                        <li class="separator"></li>

                                        <li><a class="text-danger"
                                                href="<?php echo wp_logout_url(home_url('/login')); ?>">Đăng xuất</a></li>

                                    <?php else: ?>

                                        <li><a href="<?php echo site_url('/login'); ?>">Đăng nhập</a></li>
                                        <li><a href="<?php echo site_url('/register'); ?>">Đăng ký</a></li>
                                        <li><a href="<?php echo site_url('/forgot-password'); ?>">Quên mật khẩu</a></li>

                                    <?php endif; ?>
                                </ul>
                            </li>


                            <!-- 🛒 CART -->
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


                        <!-- 🔍 SEARCH BOX  -->
                        <div class="header-search-box" style="display:none; position:absolute; top:35px; right:-10px; background:#fff;
                                padding:18px; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.15);
                                width:300px; animation:fadeIn 0.2s; z-index:9999;">

                            <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">

                                <div style="display:flex; gap:10px;">

                                    <input type="search" name="s" placeholder="Tìm xe theo tên, hãng hoặc giá..."
                                        required
                                        style="padding:12px 15px; flex:1; border:1px solid #ddd; border-radius:8px; font-size:14px;">

                                    <input type="hidden" name="post_type" value="product">

                                    <button type="submit" style="padding:12px 15px; border:none; background:#000; 
                                               color:#fff; border-radius:8px; cursor:pointer;">
                                        <i class="fas fa-search"></i>
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        </div>


        <!-- JS FIX -->
        <script>
            jQuery(document).ready(function ($) {

                $('body').off('click', '.axil-search');

                $(document).on('click', '.search-toggle', function (e) {
                    e.preventDefault();
                    $('.header-search-box').fadeToggle(150);
                });

            });
        </script>

    </header>
</body>
