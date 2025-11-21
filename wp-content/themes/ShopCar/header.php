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
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo/Fulllogo.png" alt="ShopCar Logo" >
                    </a>
                </div>

                <!-- MAIN MENU -->
                <nav class="header-nav">
                    <?php
                        wp_nav_menu([
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_class'     => 'mainmenu',
                            'fallback_cb'    => false
                        ]);
                    ?>
                </nav>

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
                <?php if (is_user_logged_in()) : ?>
                    <?php
                        $current_user = wp_get_current_user();
                        $avatar = get_avatar_url($current_user->ID, ['size' => 40]);
                    ?>
                    <img src="<?php echo esc_url($avatar); ?>" 
                         alt="Avatar" 
                         style="width:28px;height:28px;border-radius:50%;object-fit:cover;">
                <?php else : ?>
                    <i class="far fa-user"></i>
                <?php endif; ?>
                </a>

            <ul class="account-dropdown">

                <?php if (is_user_logged_in()) : ?>
                    
                    <li class="dropdown-header">
                        👋 Xin chào,
                        <strong><?php echo esc_html($current_user->display_name); ?></strong>
                    </li>
                    <li>
                        <a href="<?php echo wc_get_endpoint_url('edit-account', '', wc_get_page_permalink('myaccount')); ?>">
                            Đổi mật khẩu
                        </a>
                    </li>

                    <li class="separator"></li>

                    <li>
                     <a href="<?php echo wp_logout_url( home_url('/login') ); ?>" class="text-danger">
    Đăng xuất
</a>

                    </li>

                <?php else : ?>

                    <li>
                        <a href="<?php echo site_url('/login'); ?>">
                            Đăng nhập
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('/register'); ?>">
                            Đăng ký
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo site_url('/forgot-password'); ?>">
                            Quên mật khẩu
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



            </div>
        </div>
    </div>
</header>
