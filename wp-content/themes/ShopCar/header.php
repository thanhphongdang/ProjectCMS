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

                            <!-- SEARCH ICON -->
                            <li class="menu-search">
                                <a href="#" class="search-toggle"><i class="fas fa-search"></i></a>
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
                                        <li class="dropdown-header">👋 Xin chào
                                            <strong><?php echo esc_html($current_user->display_name); ?></strong></li>
                                        <li><a href="<?php echo site_url('/change-password'); ?>">Đổi mật khẩu</a></li>
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