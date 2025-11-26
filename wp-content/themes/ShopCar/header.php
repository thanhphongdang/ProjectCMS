<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<style>
    /* === HEADER CUSTOM STYLES === */
    
    /* Dynamic Colors from Customizer */
    .header-top-bar {
        background-color: <?php echo esc_attr(get_theme_mod('header_top_bar_bg', '#1a1a1a')); ?>;
        color: <?php echo esc_attr(get_theme_mod('header_top_bar_text_color', '#ffffff')); ?>;
        padding: 10px 0;
        font-size: 13px;
    }
    
    .header-top-bar-left a,
    .header-top-bar-right a {
        color: <?php echo esc_attr(get_theme_mod('header_top_bar_text_color', '#ffffff')); ?>;
    }
    
    .header.axil-header {
        background-color: <?php echo esc_attr(get_theme_mod('header_bg_color', '#ffffff')); ?> !important;
        padding-top: <?php echo esc_attr(get_theme_mod('header_padding_top', '16')); ?>px;
        padding-bottom: <?php echo esc_attr(get_theme_mod('header_padding_bottom', '16')); ?>px;
    }
    
    .header.axil-header.sticky {
        background-color: <?php echo esc_attr(get_theme_mod('header_bg_color', '#ffffff')); ?> !important;
    }
    
    .header-logo img {
        height: <?php echo esc_attr(get_theme_mod('header_logo_height', '48')); ?>px;
    }
    
    .header-top-bar .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .header-top-bar-left {
        display: flex;
        gap: 24px;
        align-items: center;
    }
    
    .header-top-bar-left a {
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: opacity 0.2s;
    }
    
    .header-top-bar-left a:hover {
        opacity: 0.8;
    }
    
    .header-top-bar-right {
        display: flex;
        gap: 16px;
        align-items: center;
    }
    
    .header-top-bar-right a {
        color: #fff;
        text-decoration: none;
        font-size: 12px;
    }
    
    /* Sticky Header */
    .header.axil-header {
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    
    .header.axil-header.sticky {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        background: #fff !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        animation: slideDown 0.3s ease;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }
    
    /* Header Main */
    .axil-mainmenu {
        padding: <?php echo esc_attr(get_theme_mod('header_padding_top', '16')); ?>px 0 <?php echo esc_attr(get_theme_mod('header_padding_bottom', '16')); ?>px 0;
    }
    
    .header-navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 30px;
    }
    
    .header-logo img {
        transition: transform 0.2s;
    }
    
    .header-logo:hover img {
        transform: scale(1.05);
    }
    
    /* Navigation Menu */
    .header-nav {
        flex: 1;
        display: flex;
        justify-content: center;
    }
    
    .header-nav .mainmenu {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 8px;
    }
    
    .header-nav .mainmenu li {
        position: relative;
    }
    
    .header-nav .mainmenu li {
        position: relative;
    }
    
    .header-nav .mainmenu li a {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 12px 18px;
        color: <?php echo esc_attr(get_theme_mod('header_menu_text_color', '#222222')); ?>;
        text-decoration: none;
        font-weight: 500;
        font-size: <?php echo esc_attr(get_theme_mod('header_menu_font_size', '15')); ?>px;
        border-radius: 8px;
        transition: all 0.2s;
        white-space: nowrap;
    }
    
    .header-nav .mainmenu li a i {
        font-size: 11px;
        opacity: 0.6;
        transition: transform 0.2s;
    }
    
    .header-nav .mainmenu li:hover > a i {
        transform: rotate(180deg);
    }
    
    .header-nav .mainmenu li a:hover {
        background: <?php echo esc_attr(get_theme_mod('header_menu_hover_bg', '#f5f5f5')); ?>;
        color: <?php echo esc_attr(get_theme_mod('header_menu_hover_color', '#000000')); ?>;
    }
    
    .header-nav .mainmenu li.current-menu-item > a,
    .header-nav .mainmenu li.current-page-ancestor > a {
        color: #000;
        font-weight: 600;
    }
    
    /* Dropdown Menu */
    .header-nav .mainmenu .sub-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: #fff;
        min-width: 220px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        border-radius: 12px;
        padding: 8px 0;
        margin: 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        z-index: 999;
        list-style: none;
    }
    
    .header-nav .mainmenu li:hover > .sub-menu,
    .header-nav .mainmenu li.has-submenu:hover .sub-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .header-nav .mainmenu .sub-menu li {
        margin: 0;
        list-style: none;
    }
    
    .header-nav .mainmenu .sub-menu li a {
        padding: 12px 20px;
        border-radius: 0;
        display: block;
        gap: 0;
    }
    
    .header-nav .mainmenu .sub-menu li a:hover {
        background: #f5f5f5;
        padding-left: 24px;
    }
    
    .header-nav .mainmenu .sub-menu li.current-menu-item > a {
        background: #f0f0f0;
        color: #000;
        font-weight: 600;
    }
    
    /* Action List */
    .header-action {
        display: flex;
        align-items: center;
    }
    
    .action-list {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
        gap: 18px;
        align-items: center;
    }
    
    .action-list li {
        position: relative;
    }
    
    .action-list li a {
        color: <?php echo esc_attr(get_theme_mod('header_action_icons_color', '#222222')); ?>;
        font-size: 20px;
        transition: color 0.2s;
        display: flex;
        align-items: center;
    }
    
    .action-list li a:hover {
        color: <?php echo esc_attr(get_theme_mod('header_menu_hover_color', '#000000')); ?>;
    }
    
    /* Search Box */
    .header-search-box {
        position: absolute;
        top: calc(100% + 10px);
        right: -10px;
        background: #fff;
        padding: 18px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        width: 320px;
        z-index: 9999;
        animation: fadeIn 0.2s;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .header-search-box form {
        display: flex;
        gap: 10px;
    }
    
    .header-search-box input[type="search"] {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
    }
    
    .header-search-box input[type="search"]:focus {
        border-color: #000;
    }
    
    .header-search-box button {
        padding: 12px 15px;
        border: none;
        background: <?php echo esc_attr(get_theme_mod('header_search_button_color', '#000000')); ?>;
        color: #fff;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .header-search-box button:hover {
        background: <?php echo esc_attr(get_theme_mod('header_menu_hover_color', '#000000')); ?>;
    }
    
    /* Account Dropdown */
    .account-dropdown {
        display: none !important;
        position: absolute;
        right: 0;
        top: calc(100% + 10px);
        background: #fff;
        border: 1px solid #eee;
        box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
        border-radius: 12px;
        padding: 0;
        width: 240px;
        z-index: 9999;
        overflow: hidden;
        animation: fadeIn 0.2s;
    }
    
    .menu-account.active .account-dropdown {
        display: block !important;
    }
    
    .account-dropdown .dropdown-header {
        font-size: 14px;
        color: #444;
        padding: 16px 18px;
        background: #fafafa;
        border-bottom: 1px solid #eee;
        display: block;
        font-weight: 500;
    }
    
    .account-dropdown li {
        list-style: none;
        margin: 0;
    }
    
    .account-dropdown li a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        font-size: 15px;
        color: #222;
        text-decoration: none;
        transition: all 0.15s ease;
    }
    
    .account-dropdown li a:hover {
        background: #f5f5f5;
        padding-left: 22px;
    }
    
    .account-dropdown li a i {
        width: 18px;
        text-align: center;
    }
    
    .account-dropdown .separator {
        height: 1px;
        background: #eee;
        margin: 6px 0;
    }
    
    .account-dropdown li a.text-danger {
        color: #d90429 !important;
        font-weight: 600;
    }
    
    /* Cart Count Badge */
    .cart-count {
        position: absolute;
        top: -6px;
        right: -10px;
        background: <?php echo esc_attr(get_theme_mod('header_cart_badge_color', '#ff497c')); ?>;
        color: white;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
        line-height: 1.4;
    }
    
    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 24px;
        color: #222;
        cursor: pointer;
        padding: 8px;
    }
    
    /* Responsive */
    @media (max-width: 991px) {
        .header-top-bar {
            display: none;
        }
        
        .mobile-menu-toggle {
            display: block;
        }
        
        .header-nav {
            display: none;
        }
        
        .header-nav.active {
            display: block;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 20px;
            z-index: 999;
        }
        
        .header-nav .mainmenu {
            flex-direction: column;
            gap: 0;
        }
        
        .header-nav .mainmenu li a {
            padding: 14px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-nav .mainmenu li a i {
            font-size: 12px;
        }
        
        /* Mobile Dropdown */
        .header-nav .mainmenu .sub-menu {
            position: static;
            display: none;
            opacity: 1;
            visibility: visible;
            transform: none;
            box-shadow: none;
            background: #f9f9f9;
            border-radius: 0;
            margin: 0;
            padding: 0;
            margin-left: 20px;
            border-left: 2px solid #eee;
        }
        
        .header-nav .mainmenu li.menu-open > .sub-menu {
            display: block;
        }
        
        .header-nav .mainmenu .sub-menu li a {
            padding: 12px 0 12px 20px;
        }
        
        .header-nav .mainmenu .sub-menu li a:hover {
            padding-left: 24px;
        }
        
        .header-search-box {
            width: calc(100% - 40px);
            right: 20px;
        }
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

    <!-- TOP BAR -->
    <?php if (get_theme_mod('header_top_bar_enable', true)): ?>
    <div class="header-top-bar" style="background-color: <?php echo esc_attr(get_theme_mod('header_top_bar_bg', '#1a1a1a')); ?>;">
        <div class="container">
            <div class="header-top-bar-left">
                <?php 
                $phone = get_theme_mod('header_top_bar_phone', '1900 123 456');
                $phone_link = preg_replace('/[^0-9+]/', '', $phone);
                ?>
                <a href="tel:<?php echo esc_attr($phone_link); ?>">
                    <i class="fas fa-phone"></i>
                    <span>Hotline: <?php echo esc_html($phone); ?></span>
                </a>
                <?php 
                $email = get_theme_mod('header_top_bar_email', 'info@shopcar.com');
                ?>
                <a href="mailto:<?php echo esc_attr($email); ?>">
                    <i class="far fa-envelope"></i>
                    <span><?php echo esc_html($email); ?></span>
                </a>
            </div>
            <div class="header-top-bar-right">
                <?php if (is_user_logged_in() && get_theme_mod('header_top_bar_show_wishlist', true)): ?>
                    <a href="<?php echo site_url('/yeu-thich'); ?>">
                        <i class="far fa-heart"></i> Wishlist
                    </a>
                <?php endif; ?>
                <?php if (get_theme_mod('header_top_bar_show_order_tracking', true)): ?>
                    <a href="<?php echo site_url('/page-order-tracking'); ?>">
                        <i class="fas fa-truck"></i> Tra cứu đơn hàng
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- HEADER MAIN -->
    <header class="header axil-header header-style-1 <?php echo get_theme_mod('header_sticky_enable', true) ? 'sticky-enabled' : ''; ?>" 
            style="background-color: <?php echo esc_attr(get_theme_mod('header_bg_color', '#ffffff')); ?>;">
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">

                    <!-- Mobile Menu Toggle -->
                    <button class="mobile-menu-toggle" aria-label="Toggle Menu">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Logo -->
                    <div class="header-logo">
                        <a href="<?php echo home_url('/'); ?>">
                            <?php 
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                $logo_url = get_template_directory_uri() . '/assets/images/logo/Fulllogo.png';
                            ?>
                                <img src="<?php echo esc_url($logo_url); ?>"
                                    alt="<?php bloginfo('name'); ?>" style="height:<?php echo esc_attr(get_theme_mod('header_logo_height', '48')); ?>px;">
                            <?php } ?>
                        </a>
                    </div>

                    <!-- MAIN MENU -->
                    <nav class="header-nav">
                        <?php
                        // Tạo fallback menu nếu chưa có menu được tạo
                        if (!has_nav_menu('primary')) {
                            echo '<ul class="mainmenu">';
                            
                            // Menu items mặc định
                            $default_menu_items = [
                                ['title' => 'Home', 'url' => home_url('/'), 'icon' => ''],
                                ['title' => 'Shop', 'url' => wc_get_page_permalink('shop') ?: home_url('/shop'), 'icon' => ''],
                                ['title' => 'About', 'url' => get_permalink(get_page_by_path('about') ?: 0) ?: home_url('/about'), 'icon' => ''],
                                ['title' => 'Contact', 'url' => get_permalink(get_page_by_path('contact') ?: 0) ?: home_url('/contact'), 'icon' => ''],
                                ['title' => 'Blog', 'url' => get_permalink(get_option('page_for_posts')) ?: home_url('/blog'), 'icon' => ''],
                                [
                                    'title' => 'Checkout', 
                                    'url' => '#', 
                                    'icon' => '<i class="fas fa-chevron-down"></i>',
                                    'submenu' => [
                                        ['title' => 'Cart', 'url' => wc_get_cart_url() ?: home_url('/cart')],
                                        ['title' => 'Checkout', 'url' => wc_get_checkout_url() ?: home_url('/checkout')],
                                        ['title' => 'My Account', 'url' => wc_get_page_permalink('myaccount') ?: home_url('/my-account')],
                                    ]
                                ],
                                ['title' => 'Service', 'url' => get_permalink(get_page_by_path('service') ?: 0) ?: home_url('/service'), 'icon' => ''],
                                ['title' => 'Chat', 'url' => get_permalink(get_page_by_path('chat') ?: 0) ?: home_url('/chat'), 'icon' => ''],
                            ];
                            
                            foreach ($default_menu_items as $item) {
                                $has_submenu = !empty($item['submenu']);
                                echo '<li' . ($has_submenu ? ' class="menu-item-has-children"' : '') . '>';
                                echo '<a href="' . esc_url($item['url']) . '">';
                                echo esc_html($item['title']);
                                if ($item['icon']) {
                                    echo ' ' . $item['icon'];
                                }
                                echo '</a>';
                                
                                if ($has_submenu) {
                                    echo '<ul class="sub-menu">';
                                    foreach ($item['submenu'] as $subitem) {
                                        echo '<li><a href="' . esc_url($subitem['url']) . '">' . esc_html($subitem['title']) . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                
                                echo '</li>';
                            }
                            
                            echo '</ul>';
                        } else {
                            // Hiển thị menu đã được tạo trong WordPress
                            wp_nav_menu([
                                'theme_location' => 'primary',
                                'container' => false,
                                'menu_class' => 'mainmenu',
                                'fallback_cb' => false,
                                'depth' => 2, // Hỗ trợ 2 cấp menu
                                'walker' => new ShopCar_Walker_Nav_Menu(),
                            ]);
                        }
                        ?>
                    </nav>

                    <!-- RIGHT AREA -->
                    <div class="header-action">
                        <ul class="action-list">

                            <!-- SEARCH ICON -->
                            <li class="menu-search">
                                <a href="#" class="search-toggle" aria-label="Search">
                                    <i class="fas fa-search"></i>
                                </a>
                                
                                <!-- SEARCH BOX -->
                                <div class="header-search-box" style="display:none;">
                                    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                                        <input type="search" name="s"
                                               placeholder="<?php echo esc_attr(get_theme_mod('header_search_placeholder', 'Tìm xe theo tên, hãng hoặc giá...')); ?>"
                                               required>
                                        <input type="hidden" name="post_type" value="product">
                                        <button type="submit" aria-label="Submit Search">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>

                            <!-- USER ACCOUNT -->
                            <li class="axil-user-area menu-account">
                                <a href="javascript:void(0)" class="account-toggle" aria-label="Account Menu">
                                    <?php if (is_user_logged_in()):
                                        $current_user = wp_get_current_user();
                                        $avatar = get_avatar_url($current_user->ID, ['size' => 40]); ?>
                                        <img src="<?php echo esc_url($avatar); ?>"
                                            style="width:32px;height:32px;border-radius:50%;object-fit:cover;"
                                            alt="<?php echo esc_attr($current_user->display_name); ?>">
                                    <?php else: ?>
                                        <i class="far fa-user"></i>
                                    <?php endif; ?>
                                </a>

                                <ul class="account-dropdown">
                                    <?php if (is_user_logged_in()): ?>
                                        <li class="dropdown-header">
                                            👋 Xin chào <strong><?php echo esc_html($current_user->display_name); ?></strong>
                                        </li>
                                        <li>
                                            <a href="<?php echo wc_get_page_permalink('myaccount'); ?>">
                                                <i class="far fa-user"></i> Tài khoản của tôi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('/yeu-thich'); ?>">
                                                <i class="far fa-heart"></i> Wishlist
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('/change-password'); ?>">
                                                <i class="fas fa-key"></i> Đổi mật khẩu
                                            </a>
                                        </li>
                                        <li class="separator"></li>
                                        <li>
                                            <a class="text-danger" href="<?php echo wp_logout_url(home_url('/login')); ?>">
                                                <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li>
                                            <a href="<?php echo site_url('/login'); ?>">
                                                <i class="fas fa-sign-in-alt"></i> Đăng nhập
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('/register'); ?>">
                                                <i class="far fa-user-plus"></i> Đăng ký
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo site_url('/forgot-password'); ?>">
                                                <i class="fas fa-question-circle"></i> Quên mật khẩu
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>

                            <!-- CART -->
                            <li class="axil-cart">
                                <a href="<?php echo wc_get_cart_url(); ?>" class="cart-link" aria-label="Shopping Cart">
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

        <!-- JS FIX -->
<script>
jQuery(document).ready(function($){

    // Search Toggle
    $('body').off('click', '.axil-search');
    $(document).on('click', '.search-toggle', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.header-search-box').fadeToggle(150);
    });

    // Close search box when clicking outside
    $(document).on('click', function(e){
        if (!$(e.target).closest('.menu-search').length) {
            $('.header-search-box').fadeOut(150);
        }
    });

    // Sticky Header (chỉ bật nếu có class sticky-enabled)
    var $header = $('.header.axil-header.sticky-enabled');
    if ($header.length) {
        var headerOffset = $header.offset().top;
        var $body = $('body');
        
        $(window).on('scroll', function(){
            if ($(window).scrollTop() > headerOffset) {
                $header.addClass('sticky');
                $body.css('padding-top', $header.outerHeight() + 'px');
            } else {
                $header.removeClass('sticky');
                $body.css('padding-top', '0');
            }
        });
    }

    // Mobile Menu Toggle
    $('.mobile-menu-toggle').on('click', function(e){
        e.preventDefault();
        $('.header-nav').toggleClass('active');
        $(this).find('i').toggleClass('fa-bars fa-times');
    });

    // Close mobile menu when clicking outside
    $(document).on('click', function(e){
        if (!$(e.target).closest('.header-nav, .mobile-menu-toggle').length) {
            $('.header-nav').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });

    // Close mobile menu when clicking on a link (không có submenu)
    $('.header-nav .mainmenu > li > a').on('click', function(e){
        if ($(window).width() <= 991) {
            // Nếu menu item có submenu, không đóng menu mà toggle submenu
            if ($(this).parent().hasClass('has-submenu') || $(this).parent().find('.sub-menu').length > 0) {
                e.preventDefault();
                $(this).parent().toggleClass('menu-open');
                return false;
            }
            // Nếu không có submenu, đóng menu
            $('.header-nav').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
        }
    });
    
    // Xử lý click vào submenu item trên mobile
    $('.header-nav .mainmenu .sub-menu a').on('click', function(){
        if ($(window).width() <= 991) {
            // Đóng menu sau khi click vào submenu item
            $('.header-nav').removeClass('active');
            $('.mobile-menu-toggle i').removeClass('fa-times').addClass('fa-bars');
            // Đóng tất cả submenu
            $('.header-nav .mainmenu li').removeClass('menu-open');
        }
    });

});
</script>
    </header>

</body>