<?php

/**
 * ShopCar Theme setup and assets enqueue
 */

if (!defined('CAR_THEME_VERSION')) {
    define('CAR_THEME_VERSION', '1.0.0');
}

function shopcar_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'shopcar_add_woocommerce_support');


// === Theme Supports ===
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('woocommerce');
    add_theme_support('custom-logo', [
        'height'      => 48,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'ShopCar'),
        'footer' => __('Footer Menu', 'ShopCar'),
    ]);
});

// === CUSTOM MENU WALKER ===
class ShopCar_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    // Bắt đầu một menu item
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }
    
    // Kết thúc một menu item
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    // Bắt đầu một element
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Thêm class cho menu item có submenu
        $has_children = in_array('menu-item-has-children', $classes);
        if ($has_children) {
            $classes[] = 'has-submenu';
        }
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)       ? ' href="'   . esc_attr($item->url        ) .'"' : '';
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes .'>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        
        // Thêm icon dropdown nếu có submenu
        if ($has_children && $depth === 0) {
            $item_output .= ' <i class="fas fa-chevron-down"></i>';
        }
        
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    // Kết thúc một element
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

// === HEADER CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_header_customizer_settings');
function shopcar_header_customizer_settings($wp_customize) {
    
    // === HEADER SECTION ===
    $wp_customize->add_section('shopcar_header_settings', [
        'title'    => __('Header Settings', 'ShopCar'),
        'priority' => 30,
    ]);

    // Top Bar Enable
    $wp_customize->add_setting('header_top_bar_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('header_top_bar_enable', [
        'label'    => __('Hiển thị Top Bar', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'checkbox',
    ]);

    // Top Bar Phone
    $wp_customize->add_setting('header_top_bar_phone', [
        'default'           => '1900 123 456',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_top_bar_phone', [
        'label'    => __('Số điện thoại Hotline', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'text',
    ]);

    // Top Bar Email
    $wp_customize->add_setting('header_top_bar_email', [
        'default'           => 'info@shopcar.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_top_bar_email', [
        'label'    => __('Email liên hệ', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'email',
    ]);

    // Top Bar Background Color
    $wp_customize->add_setting('header_top_bar_bg', [
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_top_bar_bg', [
        'label'    => __('Màu nền Top Bar', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // Header Background Color
    $wp_customize->add_setting('header_bg_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', [
        'label'    => __('Màu nền Header', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // Sticky Header Enable
    $wp_customize->add_setting('header_sticky_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('header_sticky_enable', [
        'label'    => __('Bật Sticky Header', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'checkbox',
    ]);

    // Top Bar Text Color
    $wp_customize->add_setting('header_top_bar_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_top_bar_text_color', [
        'label'    => __('Màu chữ Top Bar', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // === TOP BAR RIGHT LINKS ===
    $wp_customize->add_setting('header_top_bar_show_wishlist', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('header_top_bar_show_wishlist', [
        'label'    => __('Hiển thị link Wishlist trong Top Bar', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'checkbox',
    ]);

    $wp_customize->add_setting('header_top_bar_show_order_tracking', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('header_top_bar_show_order_tracking', [
        'label'    => __('Hiển thị link Tra cứu đơn hàng trong Top Bar', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'checkbox',
    ]);

    // === MENU SETTINGS ===
    $wp_customize->add_setting('header_menu_text_color', [
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_menu_text_color', [
        'label'    => __('Màu chữ Menu', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    $wp_customize->add_setting('header_menu_hover_color', [
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_menu_hover_color', [
        'label'    => __('Màu chữ Menu khi hover', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    $wp_customize->add_setting('header_menu_hover_bg', [
        'default'           => '#f5f5f5',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_menu_hover_bg', [
        'label'    => __('Màu nền Menu khi hover', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    $wp_customize->add_setting('header_menu_font_size', [
        'default'           => '15',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_menu_font_size', [
        'label'    => __('Kích thước chữ Menu (px)', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ],
    ]);

    // === SEARCH SETTINGS ===
    $wp_customize->add_setting('header_search_placeholder', [
        'default'           => 'Tìm xe theo tên, hãng hoặc giá...',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_search_placeholder', [
        'label'    => __('Placeholder Search Box', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('header_search_button_color', [
        'default'           => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_search_button_color', [
        'label'    => __('Màu nút Search', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // === CART SETTINGS ===
    $wp_customize->add_setting('header_cart_badge_color', [
        'default'           => '#ff497c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_cart_badge_color', [
        'label'    => __('Màu Badge Cart', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // === ACTION ICONS COLOR ===
    $wp_customize->add_setting('header_action_icons_color', [
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_action_icons_color', [
        'label'    => __('Màu Icon (Search, Account, Cart)', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
    ]));

    // === HEADER PADDING ===
    $wp_customize->add_setting('header_padding_top', [
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_padding_top', [
        'label'    => __('Padding Top Header (px)', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ],
    ]);

    $wp_customize->add_setting('header_padding_bottom', [
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_padding_bottom', [
        'label'    => __('Padding Bottom Header (px)', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ],
    ]);

    // === LOGO HEIGHT ===
    $wp_customize->add_setting('header_logo_height', [
        'default'           => '48',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('header_logo_height', [
        'label'    => __('Chiều cao Logo (px)', 'ShopCar'),
        'section'  => 'shopcar_header_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 20,
            'max'  => 100,
            'step' => 1,
        ],
    ]);

    // Logo Upload (sử dụng custom-logo support)
    // Logo đã được hỗ trợ tự động qua add_theme_support('custom-logo')
}

// === FOOTER CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_footer_customizer_settings');
function shopcar_footer_customizer_settings($wp_customize) {
    
    // === FOOTER SECTION ===
    $wp_customize->add_section('shopcar_footer_settings', [
        'title'    => __('Footer Settings', 'ShopCar'),
        'priority' => 40,
    ]);

    // Footer Background Color
    $wp_customize->add_setting('footer_bg_color', [
        'default'           => '#1a1a1a',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', [
        'label'    => __('Màu nền Footer', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
    ]));

    // Footer Text Color
    $wp_customize->add_setting('footer_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color', [
        'label'    => __('Màu chữ Footer', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
    ]));

    // Footer Address
    $wp_customize->add_setting('footer_address', [
        'default'           => '685 Market Street, Las Vegas, LA 95820, United States.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('footer_address', [
        'label'    => __('Địa chỉ', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
        'type'     => 'textarea',
    ]);

    // Footer Email
    $wp_customize->add_setting('footer_email', [
        'default'           => 'example@domain.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('footer_email', [
        'label'    => __('Email liên hệ', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
        'type'     => 'email',
    ]);

    // Footer Phone
    $wp_customize->add_setting('footer_phone', [
        'default'           => '(+01) 850-315-5862',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('footer_phone', [
        'label'    => __('Số điện thoại', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
        'type'     => 'text',
    ]);

    // Copyright Text
    $wp_customize->add_setting('footer_copyright', [
        'default'           => '© ' . date('Y') . '. All rights reserved by Axilthemes.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('footer_copyright', [
        'label'    => __('Copyright Text', 'ShopCar'),
        'section'  => 'shopcar_footer_settings',
        'type'     => 'text',
    ]);

    // Social Media Links
    $social_networks = ['facebook', 'instagram', 'twitter', 'linkedin', 'discord'];
    foreach ($social_networks as $network) {
        $wp_customize->add_setting('footer_social_' . $network, [
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('footer_social_' . $network, [
            'label'    => sprintf(__('Link %s', 'ShopCar'), ucfirst($network)),
            'section'  => 'shopcar_footer_settings',
            'type'     => 'url',
        ]);
    }
}

// === HOMEPAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_homepage_customizer_settings');
function shopcar_homepage_customizer_settings($wp_customize) {
    
    // === HOMEPAGE SECTION ===
    $wp_customize->add_section('shopcar_homepage_settings', [
        'title'    => __('Homepage Settings', 'ShopCar'),
        'priority' => 50,
    ]);

    // Slider Title
    $wp_customize->add_setting('homepage_slider_title', [
        'default'           => 'Discover Premium Cars',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_slider_title', [
        'label'    => __('Tiêu đề Slider', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Slider Subtitle
    $wp_customize->add_setting('homepage_slider_subtitle', [
        'default'           => 'Luxury • Performance • Quality',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_slider_subtitle', [
        'label'    => __('Phụ đề Slider', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Slider Button Text
    $wp_customize->add_setting('homepage_slider_button_text', [
        'default'           => 'Shop Now',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_slider_button_text', [
        'label'    => __('Text nút Slider', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Slider Image
    $wp_customize->add_setting('homepage_slider_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'homepage_slider_image', [
        'label'    => __('Hình ảnh Slider', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
    ]));

    // Categories Section Title
    $wp_customize->add_setting('homepage_categories_title', [
        'default'           => 'Browse by Category',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_categories_title', [
        'label'    => __('Tiêu đề Section Categories', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Products Section Title
    $wp_customize->add_setting('homepage_products_title', [
        'default'           => 'Explore Our Products',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_products_title', [
        'label'    => __('Tiêu đề Section Products', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Products Count
    $wp_customize->add_setting('homepage_products_count', [
        'default'           => '6',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('homepage_products_count', [
        'label'    => __('Số lượng sản phẩm hiển thị', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 3,
            'max'  => 12,
            'step' => 1,
        ],
    ]);

    // Newsletter Title
    $wp_customize->add_setting('homepage_newsletter_title', [
        'default'           => 'Get Weekly Updates',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_newsletter_title', [
        'label'    => __('Tiêu đề Newsletter', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);

    // Newsletter Placeholder
    $wp_customize->add_setting('homepage_newsletter_placeholder', [
        'default'           => 'example@gmail.com',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('homepage_newsletter_placeholder', [
        'label'    => __('Placeholder Newsletter', 'ShopCar'),
        'section'  => 'shopcar_homepage_settings',
        'type'     => 'text',
    ]);
}

// === PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_page_customizer_settings');
function shopcar_page_customizer_settings($wp_customize) {
    
    // === CONTACT PAGE SECTION ===
    $wp_customize->add_section('shopcar_contact_page_settings', [
        'title'    => __('Contact Page Settings', 'ShopCar'),
        'priority' => 60,
    ]);

    // Contact Address
    $wp_customize->add_setting('contact_page_address', [
        'default'           => '685 Market Street, Las Vegas, LA 95820, USA',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('contact_page_address', [
        'label'    => __('Địa chỉ Showroom', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'textarea',
    ]);

    // Contact Phone
    $wp_customize->add_setting('contact_page_phone', [
        'default'           => '(+01) 850-315-5862',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('contact_page_phone', [
        'label'    => __('Hotline', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'text',
    ]);

    // Contact Email
    $wp_customize->add_setting('contact_page_email', [
        'default'           => 'hello@cardealer.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('contact_page_email', [
        'label'    => __('Email liên hệ', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'email',
    ]);

    // Contact Zalo
    $wp_customize->add_setting('contact_page_zalo', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('contact_page_zalo', [
        'label'    => __('Link Zalo', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'url',
    ]);

    // Working Hours
    $wp_customize->add_setting('contact_page_working_hours', [
        'default'           => 'Thứ 2 – Thứ 7: 8:00 - 20:00\nChủ nhật: 9:00 - 17:00',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('contact_page_working_hours', [
        'label'    => __('Giờ làm việc', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'textarea',
    ]);

    // Google Maps URL
    $wp_customize->add_setting('contact_page_map_url', [
        'default'           => 'https://www.google.com/maps?q=toyota%20showroom&t=&z=12&ie=UTF8&iwloc=&output=embed',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('contact_page_map_url', [
        'label'    => __('Google Maps Embed URL', 'ShopCar'),
        'section'  => 'shopcar_contact_page_settings',
        'type'     => 'url',
        'description' => __('Dán URL embed từ Google Maps', 'ShopCar'),
    ]);

    // === ABOUT PAGE SECTION ===
    $wp_customize->add_section('shopcar_about_page_settings', [
        'title'    => __('About Page Settings', 'ShopCar'),
        'priority' => 61,
    ]);

    // About Title
    $wp_customize->add_setting('about_page_title', [
        'default'           => 'Chúng tôi là đại lý ô tô uy tín – nơi bạn tìm được chiếc xe phù hợp nhất.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('about_page_title', [
        'label'    => __('Tiêu đề chính', 'ShopCar'),
        'section'  => 'shopcar_about_page_settings',
        'type'     => 'text',
    ]);

    // About Description
    $wp_customize->add_setting('about_page_description', [
        'default'           => 'Với nhiều năm kinh nghiệm trong lĩnh vực mua bán xe hơi, chúng tôi cam kết mang đến cho khách hàng những mẫu xe chất lượng, giá tốt, kèm theo chính sách bảo hành – bảo dưỡng tối ưu.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('about_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_about_page_settings',
        'type'     => 'textarea',
    ]);

    // Stats - Cars Sold
    $wp_customize->add_setting('about_page_stats_cars', [
        'default'           => '5,000+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('about_page_stats_cars', [
        'label'    => __('Số xe đã bán', 'ShopCar'),
        'section'  => 'shopcar_about_page_settings',
        'type'     => 'text',
    ]);

    // Stats - Years Experience
    $wp_customize->add_setting('about_page_stats_years', [
        'default'           => '10+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('about_page_stats_years', [
        'label'    => __('Số năm kinh nghiệm', 'ShopCar'),
        'section'  => 'shopcar_about_page_settings',
        'type'     => 'text',
    ]);

    // Stats - Satisfaction
    $wp_customize->add_setting('about_page_stats_satisfaction', [
        'default'           => '98%',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('about_page_stats_satisfaction', [
        'label'    => __('Tỷ lệ hài lòng', 'ShopCar'),
        'section'  => 'shopcar_about_page_settings',
        'type'     => 'text',
    ]);
}

// === COLOR SCHEME SETTINGS ===
add_action('customize_register', 'shopcar_color_scheme_settings');
function shopcar_color_scheme_settings($wp_customize) {
    
    // === COLOR SCHEME SECTION ===
    $wp_customize->add_section('shopcar_color_scheme', [
        'title'    => __('Color Scheme', 'ShopCar'),
        'priority' => 70,
    ]);

    // Primary Color
    $wp_customize->add_setting('color_primary', [
        'default'           => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_primary', [
        'label'    => __('Màu chính (Primary)', 'ShopCar'),
        'section'  => 'shopcar_color_scheme',
    ]));

    // Secondary Color
    $wp_customize->add_setting('color_secondary', [
        'default'           => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_secondary', [
        'label'    => __('Màu phụ (Secondary)', 'ShopCar'),
        'section'  => 'shopcar_color_scheme',
    ]));

    // Accent Color
    $wp_customize->add_setting('color_accent', [
        'default'           => '#ff497c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_accent', [
        'label'    => __('Màu nhấn (Accent)', 'ShopCar'),
        'section'  => 'shopcar_color_scheme',
    ]));

    // Text Color
    $wp_customize->add_setting('color_text', [
        'default'           => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_text', [
        'label'    => __('Màu chữ chính', 'ShopCar'),
        'section'  => 'shopcar_color_scheme',
    ]));

    // Background Color
    $wp_customize->add_setting('color_background', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'color_background', [
        'label'    => __('Màu nền chính', 'ShopCar'),
        'section'  => 'shopcar_color_scheme',
    ]));
}

// === TYPOGRAPHY SETTINGS ===
add_action('customize_register', 'shopcar_typography_settings');
function shopcar_typography_settings($wp_customize) {
    
    // === TYPOGRAPHY SECTION ===
    $wp_customize->add_section('shopcar_typography', [
        'title'    => __('Typography', 'ShopCar'),
        'priority' => 80,
    ]);

    // Body Font Size
    $wp_customize->add_setting('typography_body_size', [
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('typography_body_size', [
        'label'    => __('Kích thước chữ Body (px)', 'ShopCar'),
        'section'  => 'shopcar_typography',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ],
    ]);

    // Heading Font Size
    $wp_customize->add_setting('typography_heading_size', [
        'default'           => '32',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('typography_heading_size', [
        'label'    => __('Kích thước chữ Heading (px)', 'ShopCar'),
        'section'  => 'shopcar_typography',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 20,
            'max'  => 60,
            'step' => 1,
        ],
    ]);

    // Font Family
    $wp_customize->add_setting('typography_font_family', [
        'default'           => 'Arial, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('typography_font_family', [
        'label'    => __('Font Family', 'ShopCar'),
        'section'  => 'shopcar_typography',
        'type'     => 'select',
        'choices'  => [
            'Arial, sans-serif' => 'Arial',
            'Georgia, serif' => 'Georgia',
            '"Times New Roman", serif' => 'Times New Roman',
            '"Helvetica Neue", Helvetica, Arial, sans-serif' => 'Helvetica',
            '"Roboto", sans-serif' => 'Roboto',
            '"Open Sans", sans-serif' => 'Open Sans',
        ],
    ]);
}

// === SERVICE PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_service_page_customizer_settings');
function shopcar_service_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_service_page_settings', [
        'title'    => __('Service Page Settings', 'ShopCar'),
        'priority' => 62,
    ]);

    $wp_customize->add_setting('service_page_title', [
        'default'           => 'Chăm sóc & bảo dưỡng xe toàn diện',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('service_page_title', [
        'label'    => __('Tiêu đề chính', 'ShopCar'),
        'section'  => 'shopcar_service_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('service_page_description', [
        'default'           => 'Showroom của chúng tôi cung cấp đầy đủ dịch vụ từ bảo dưỡng định kỳ, sửa chữa kỹ thuật, thay thế phụ tùng chính hãng cho đến chăm sóc ngoại thất – nội thất.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('service_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_service_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('service_booking_title', [
        'default'           => 'Đặt lịch bảo dưỡng / kiểm tra xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('service_booking_title', [
        'label'    => __('Tiêu đề Booking', 'ShopCar'),
        'section'  => 'shopcar_service_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('service_booking_description', [
        'default'           => 'Chúng tôi sẽ liên hệ xác nhận trong vòng 15 phút.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('service_booking_description', [
        'label'    => __('Mô tả Booking', 'ShopCar'),
        'section'  => 'shopcar_service_page_settings',
        'type'     => 'text',
    ]);
}

// === VOUCHER PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_voucher_page_customizer_settings');
function shopcar_voucher_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_voucher_page_settings', [
        'title'    => __('Voucher Page Settings', 'ShopCar'),
        'priority' => 63,
    ]);

    $wp_customize->add_setting('voucher_page_title', [
        'default'           => 'Mã giảm giá',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('voucher_page_title', [
        'label'    => __('Tiêu đề', 'ShopCar'),
        'section'  => 'shopcar_voucher_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('voucher_placeholder', [
        'default'           => 'Nhập mã giảm giá...',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('voucher_placeholder', [
        'label'    => __('Placeholder input', 'ShopCar'),
        'section'  => 'shopcar_voucher_page_settings',
        'type'     => 'text',
    ]);

    // Voucher suggestions
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('voucher_suggestion_' . $i . '_code', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('voucher_suggestion_' . $i . '_code', [
            'label'    => sprintf(__('Mã voucher %d', 'ShopCar'), $i),
            'section'  => 'shopcar_voucher_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('voucher_suggestion_' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('voucher_suggestion_' . $i . '_desc', [
            'label'    => sprintf(__('Mô tả voucher %d', 'ShopCar'), $i),
            'section'  => 'shopcar_voucher_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('voucher_suggestions_title', [
        'default'           => 'Gợi ý voucher',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('voucher_suggestions_title', [
        'label'    => __('Tiêu đề Suggestions', 'ShopCar'),
        'section'  => 'shopcar_voucher_page_settings',
        'type'     => 'text',
    ]);
}

// === ORDER TRACKING PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_order_tracking_page_customizer_settings');
function shopcar_order_tracking_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_order_tracking_page_settings', [
        'title'    => __('Order Tracking Page Settings', 'ShopCar'),
        'priority' => 65,
    ]);

    $wp_customize->add_setting('order_tracking_page_title', [
        'default'           => 'Tra cứu đơn hàng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('order_tracking_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_order_tracking_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('order_tracking_order_id_placeholder', [
        'default'           => 'Nhập mã đơn hàng (VD: 2536)',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('order_tracking_order_id_placeholder', [
        'label'    => __('Placeholder Mã đơn hàng', 'ShopCar'),
        'section'  => 'shopcar_order_tracking_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('order_tracking_email_placeholder', [
        'default'           => 'Email hoặc số điện thoại',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('order_tracking_email_placeholder', [
        'label'    => __('Placeholder Email/SĐT', 'ShopCar'),
        'section'  => 'shopcar_order_tracking_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('order_tracking_button_text', [
        'default'           => 'Tra cứu',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('order_tracking_button_text', [
        'label'    => __('Text nút', 'ShopCar'),
        'section'  => 'shopcar_order_tracking_page_settings',
        'type'     => 'text',
    ]);
}

// === FAQ PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_faq_page_customizer_settings');
function shopcar_faq_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_faq_page_settings', [
        'title'    => __('FAQ Page Settings', 'ShopCar'),
        'priority' => 64,
    ]);

    $wp_customize->add_setting('faq_page_title', [
        'default'           => 'Câu hỏi thường gặp',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('faq_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_faq_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('faq_page_description', [
        'default'           => 'Tổng hợp các câu hỏi thường gặp về mua bán, bảo hành và dịch vụ xe hơi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('faq_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_faq_page_settings',
        'type'     => 'textarea',
    ]);

    // FAQ Items (10 items)
    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting('faq_question_' . $i, [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('faq_question_' . $i, [
            'label'    => sprintf(__('Câu hỏi %d', 'ShopCar'), $i),
            'section'  => 'shopcar_faq_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('faq_answer_' . $i, [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('faq_answer_' . $i, [
            'label'    => sprintf(__('Câu trả lời %d', 'ShopCar'), $i),
            'section'  => 'shopcar_faq_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('faq_cta_title', [
        'default'           => 'Vẫn còn thắc mắc?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('faq_cta_title', [
        'label'    => __('CTA Tiêu đề', 'ShopCar'),
        'section'  => 'shopcar_faq_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('faq_cta_description', [
        'default'           => 'Liên hệ với chúng tôi để được tư vấn chi tiết hơn.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('faq_cta_description', [
        'label'    => __('CTA Mô tả', 'ShopCar'),
        'section'  => 'shopcar_faq_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('faq_cta_button_text', [
        'default'           => 'Liên hệ ngay',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('faq_cta_button_text', [
        'label'    => __('CTA Button Text', 'ShopCar'),
        'section'  => 'shopcar_faq_page_settings',
        'type'     => 'text',
    ]);
}

// === BLOG PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_blog_page_customizer_settings');
function shopcar_blog_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_blog_page_settings', [
        'title'    => __('Blog Page Settings', 'ShopCar'),
        'priority' => 65,
    ]);

    $wp_customize->add_setting('blog_page_title', [
        'default'           => 'Tin tức & Blog',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('blog_page_description', [
        'default'           => 'Cập nhật tin tức mới nhất về thị trường xe hơi, đánh giá xe và mẹo sử dụng xe.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('blog_posts_per_page', [
        'default'           => '6',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('blog_posts_per_page', [
        'label'    => __('Số bài viết mỗi trang', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'number',
        'input_attrs' => [
            'min'  => 3,
            'max'  => 20,
            'step' => 1,
        ],
    ]);

    $wp_customize->add_setting('blog_read_more_text', [
        'default'           => 'Đọc thêm',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_read_more_text', [
        'label'    => __('Text nút "Đọc thêm"', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('blog_no_posts_text', [
        'default'           => 'Chưa có bài viết nào.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_no_posts_text', [
        'label'    => __('Text khi không có bài viết', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('blog_sidebar_title', [
        'default'           => 'Bài viết mới nhất',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_sidebar_title', [
        'label'    => __('Tiêu đề Sidebar', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('blog_categories_title', [
        'default'           => 'Danh mục',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('blog_categories_title', [
        'label'    => __('Tiêu đề Categories', 'ShopCar'),
        'section'  => 'shopcar_blog_page_settings',
        'type'     => 'text',
    ]);
}

// === FINANCING PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_financing_page_customizer_settings');
function shopcar_financing_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_financing_page_settings', [
        'title'    => __('Financing Page Settings', 'ShopCar'),
        'priority' => 66,
    ]);

    $wp_customize->add_setting('financing_page_title', [
        'default'           => 'Tài chính & Trả góp',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('financing_page_description', [
        'default'           => 'Giải pháp tài chính linh hoạt, giúp bạn sở hữu chiếc xe mơ ước dễ dàng hơn.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('financing_options_title', [
        'default'           => 'Các gói tài chính',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_options_title', [
        'label'    => __('Tiêu đề Options', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);

    // Financing Options (3 options)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('financing_option' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('financing_option' . $i . '_title', [
            'label'    => sprintf(__('Option %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_financing_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('financing_option' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('financing_option' . $i . '_desc', [
            'label'    => sprintf(__('Option %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_financing_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('financing_calculator_title', [
        'default'           => 'Tính toán trả góp',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_calculator_title', [
        'label'    => __('Tiêu đề Calculator', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('financing_calculate_button_text', [
        'default'           => 'Tính toán',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_calculate_button_text', [
        'label'    => __('Text nút Calculator', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('financing_requirements_title', [
        'default'           => 'Điều kiện vay',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_requirements_title', [
        'label'    => __('Tiêu đề Requirements', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);

    // Requirements (4 items)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('requirement' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('requirement' . $i . '_title', [
            'label'    => sprintf(__('Requirement %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_financing_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('requirement' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('requirement' . $i . '_desc', [
            'label'    => sprintf(__('Requirement %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_financing_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('financing_button_text', [
        'default'           => 'Đăng ký tư vấn tài chính',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('financing_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_financing_page_settings',
        'type'     => 'text',
    ]);
}

// === WARRANTY PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_warranty_page_customizer_settings');
function shopcar_warranty_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_warranty_page_settings', [
        'title'    => __('Warranty Page Settings', 'ShopCar'),
        'priority' => 67,
    ]);

    $wp_customize->add_setting('warranty_page_title', [
        'default'           => 'Bảo hành & Bảo dưỡng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('warranty_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('warranty_intro_title', [
        'default'           => 'Chính sách bảo hành toàn diện',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('warranty_intro_title', [
        'label'    => __('Tiêu đề Intro', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('warranty_intro_description', [
        'default'           => 'Chúng tôi cam kết mang đến dịch vụ bảo hành và bảo dưỡng tốt nhất cho chiếc xe của bạn.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('warranty_intro_description', [
        'label'    => __('Mô tả Intro', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('warranty_policies_title', [
        'default'           => 'Chính sách bảo hành',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('warranty_policies_title', [
        'label'    => __('Tiêu đề Policies', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'text',
    ]);

    // Warranty Policies (4 items)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('warranty_policy' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('warranty_policy' . $i . '_title', [
            'label'    => sprintf(__('Policy %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_warranty_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('warranty_policy' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('warranty_policy' . $i . '_desc', [
            'label'    => sprintf(__('Policy %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_warranty_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('maintenance_services_title', [
        'default'           => 'Dịch vụ bảo dưỡng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('maintenance_services_title', [
        'label'    => __('Tiêu đề Maintenance Services', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'text',
    ]);

    // Maintenance Services (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('maintenance_service' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('maintenance_service' . $i . '_title', [
            'label'    => sprintf(__('Service %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_warranty_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('maintenance_service' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('maintenance_service' . $i . '_desc', [
            'label'    => sprintf(__('Service %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_warranty_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('warranty_page_button_text', [
        'default'           => 'Liên hệ đặt lịch',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('warranty_page_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_warranty_page_settings',
        'type'     => 'text',
    ]);
}

// === SHOWROOM PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_showroom_page_customizer_settings');
function shopcar_showroom_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_showroom_page_settings', [
        'title'    => __('Showroom Page Settings', 'ShopCar'),
        'priority' => 68,
    ]);

    $wp_customize->add_setting('showroom_page_title', [
        'default'           => 'Showroom & Đại lý',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('showroom_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('showroom_page_description', [
        'default'           => 'Hệ thống showroom và đại lý trên toàn quốc, sẵn sàng phục vụ bạn.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('showroom_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('main_showroom_title', [
        'default'           => 'Showroom chính',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('main_showroom_title', [
        'label'    => __('Tiêu đề Main Showroom', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'text',
    ]);

    // Showrooms (2 main showrooms)
    for ($i = 1; $i <= 2; $i++) {
        $wp_customize->add_setting('showroom' . $i . '_name', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('showroom' . $i . '_name', [
            'label'    => sprintf(__('Showroom %d - Tên', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('showroom' . $i . '_address', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('showroom' . $i . '_address', [
            'label'    => sprintf(__('Showroom %d - Địa chỉ', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('showroom' . $i . '_phone', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('showroom' . $i . '_phone', [
            'label'    => sprintf(__('Showroom %d - SĐT', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('showroom' . $i . '_hours', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('showroom' . $i . '_hours', [
            'label'    => sprintf(__('Showroom %d - Giờ làm việc', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('dealers_title', [
        'default'           => 'Hệ thống đại lý',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('dealers_title', [
        'label'    => __('Tiêu đề Dealers', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'text',
    ]);

    // Dealers (6 dealers)
    for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_setting('dealer' . $i . '_name', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('dealer' . $i . '_name', [
            'label'    => sprintf(__('Dealer %d - Tên', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('dealer' . $i . '_address', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('dealer' . $i . '_address', [
            'label'    => sprintf(__('Dealer %d - Địa chỉ', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('dealer' . $i . '_phone', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('dealer' . $i . '_phone', [
            'label'    => sprintf(__('Dealer %d - SĐT', 'ShopCar'), $i),
            'section'  => 'shopcar_showroom_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('showroom_map_title', [
        'default'           => 'Bản đồ showroom',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('showroom_map_title', [
        'label'    => __('Tiêu đề Map', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('showroom_map_url', [
        'default'           => 'https://www.google.com/maps?q=car+showroom&t=&z=12&ie=UTF8&iwloc=&output=embed',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('showroom_map_url', [
        'label'    => __('Google Maps URL', 'ShopCar'),
        'section'  => 'shopcar_showroom_page_settings',
        'type'     => 'url',
    ]);
}

// === BUYING GUIDE PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_buying_guide_page_customizer_settings');
function shopcar_buying_guide_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_buying_guide_page_settings', [
        'title'    => __('Buying Guide Page Settings', 'ShopCar'),
        'priority' => 69,
    ]);

    $wp_customize->add_setting('buying_guide_page_title', [
        'default'           => 'Hướng dẫn mua hàng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('buying_guide_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_buying_guide_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('buying_guide_description', [
        'default'           => 'Hướng dẫn chi tiết quy trình mua xe tại showroom của chúng tôi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('buying_guide_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_buying_guide_page_settings',
        'type'     => 'textarea',
    ]);

    // Buying Steps (5 steps)
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('buying_step' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('buying_step' . $i . '_title', [
            'label'    => sprintf(__('Bước %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_buying_guide_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('buying_step' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('buying_step' . $i . '_desc', [
            'label'    => sprintf(__('Bước %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_buying_guide_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('payment_methods_title', [
        'default'           => 'Phương thức thanh toán',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('payment_methods_title', [
        'label'    => __('Tiêu đề Payment Methods', 'ShopCar'),
        'section'  => 'shopcar_buying_guide_page_settings',
        'type'     => 'text',
    ]);

    // Payment Methods (3 methods)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('payment_method' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('payment_method' . $i . '_title', [
            'label'    => sprintf(__('Payment Method %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_buying_guide_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('payment_method' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('payment_method' . $i . '_desc', [
            'label'    => sprintf(__('Payment Method %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_buying_guide_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('buying_guide_button_text', [
        'default'           => 'Liên hệ tư vấn',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('buying_guide_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_buying_guide_page_settings',
        'type'     => 'text',
    ]);
}

// === PARTS PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_parts_page_customizer_settings');
function shopcar_parts_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_parts_page_settings', [
        'title'    => __('Parts Page Settings', 'ShopCar'),
        'priority' => 70,
    ]);

    $wp_customize->add_setting('parts_page_title', [
        'default'           => 'Phụ tùng & Phụ kiện',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('parts_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_parts_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('parts_page_description', [
        'default'           => 'Cung cấp phụ tùng chính hãng và phụ kiện chất lượng cao cho mọi dòng xe.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('parts_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_parts_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('parts_categories_title', [
        'default'           => 'Danh mục phụ tùng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('parts_categories_title', [
        'label'    => __('Tiêu đề Categories', 'ShopCar'),
        'section'  => 'shopcar_parts_page_settings',
        'type'     => 'text',
    ]);

    // Parts Categories (8 categories)
    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting('parts_category' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('parts_category' . $i . '_title', [
            'label'    => sprintf(__('Category %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_parts_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('parts_category' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('parts_category' . $i . '_desc', [
            'label'    => sprintf(__('Category %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_parts_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('accessories_title', [
        'default'           => 'Phụ kiện xe hơi',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('accessories_title', [
        'label'    => __('Tiêu đề Accessories', 'ShopCar'),
        'section'  => 'shopcar_parts_page_settings',
        'type'     => 'text',
    ]);

    // Accessories (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('accessory' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('accessory' . $i . '_title', [
            'label'    => sprintf(__('Accessory %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_parts_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('accessory' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('accessory' . $i . '_desc', [
            'label'    => sprintf(__('Accessory %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_parts_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('parts_page_button_text', [
        'default'           => 'Xem sản phẩm',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('parts_page_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_parts_page_settings',
        'type'     => 'text',
    ]);
}

// === COMPARE PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_compare_page_customizer_settings');
function shopcar_compare_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_compare_page_settings', [
        'title'    => __('Compare Page Settings', 'ShopCar'),
        'priority' => 71,
    ]);

    $wp_customize->add_setting('compare_page_title', [
        'default'           => 'So sánh xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('compare_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_compare_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('compare_page_description', [
        'default'           => 'So sánh các mẫu xe để tìm ra lựa chọn phù hợp nhất với nhu cầu của bạn.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('compare_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_compare_page_settings',
        'type'     => 'textarea',
    ]);

    // Compare Cars (3 cars)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('compare_car' . $i . '_price', [
            'default'           => 'Liên hệ',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('compare_car' . $i . '_price', [
            'label'    => sprintf(__('Xe %d - Giá', 'ShopCar'), $i),
            'section'  => 'shopcar_compare_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('compare_car' . $i . '_brand', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('compare_car' . $i . '_brand', [
            'label'    => sprintf(__('Xe %d - Hãng', 'ShopCar'), $i),
            'section'  => 'shopcar_compare_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('compare_car' . $i . '_engine', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('compare_car' . $i . '_engine', [
            'label'    => sprintf(__('Xe %d - Động cơ', 'ShopCar'), $i),
            'section'  => 'shopcar_compare_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('compare_car' . $i . '_transmission', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('compare_car' . $i . '_transmission', [
            'label'    => sprintf(__('Xe %d - Hộp số', 'ShopCar'), $i),
            'section'  => 'shopcar_compare_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('compare_car' . $i . '_fuel', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('compare_car' . $i . '_fuel', [
            'label'    => sprintf(__('Xe %d - Tiêu thụ nhiên liệu', 'ShopCar'), $i),
            'section'  => 'shopcar_compare_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('compare_page_button_text', [
        'default'           => 'Xem tất cả xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('compare_page_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_compare_page_settings',
        'type'     => 'text',
    ]);
}

// === CONSULTATION PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_consultation_page_customizer_settings');
function shopcar_consultation_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_consultation_page_settings', [
        'title'    => __('Consultation Page Settings', 'ShopCar'),
        'priority' => 72,
    ]);

    $wp_customize->add_setting('consultation_page_title', [
        'default'           => 'Tư vấn mua xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('consultation_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_consultation_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('consultation_page_description', [
        'default'           => 'Điền thông tin để nhận tư vấn miễn phí từ chuyên gia của chúng tôi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('consultation_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_consultation_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('consultation_benefits_title', [
        'default'           => 'Lợi ích khi tư vấn với chúng tôi',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('consultation_benefits_title', [
        'label'    => __('Tiêu đề Benefits', 'ShopCar'),
        'section'  => 'shopcar_consultation_page_settings',
        'type'     => 'text',
    ]);

    // Benefits (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('consultation_benefit' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('consultation_benefit' . $i . '_title', [
            'label'    => sprintf(__('Benefit %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_consultation_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('consultation_benefit' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('consultation_benefit' . $i . '_desc', [
            'label'    => sprintf(__('Benefit %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_consultation_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('consultation_page_button_text', [
        'default'           => 'Gửi yêu cầu tư vấn',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('consultation_page_button_text', [
        'label'    => __('Text nút Submit', 'ShopCar'),
        'section'  => 'shopcar_consultation_page_settings',
        'type'     => 'text',
    ]);
}

// === TRADE IN PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_trade_in_page_customizer_settings');
function shopcar_trade_in_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_trade_in_page_settings', [
        'title'    => __('Trade In Page Settings', 'ShopCar'),
        'priority' => 73,
    ]);

    $wp_customize->add_setting('trade_in_page_title', [
        'default'           => 'Thu mua xe cũ',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('trade_in_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('trade_in_page_description', [
        'default'           => 'Bán xe cũ của bạn với giá tốt nhất, đổi xe mới dễ dàng hơn.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('trade_in_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('trade_in_benefits_title', [
        'default'           => 'Lợi ích khi bán xe cho chúng tôi',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('trade_in_benefits_title', [
        'label'    => __('Tiêu đề Benefits', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    // Benefits (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('trade_in_benefit' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('trade_in_benefit' . $i . '_title', [
            'label'    => sprintf(__('Benefit %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_trade_in_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('trade_in_benefit' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('trade_in_benefit' . $i . '_desc', [
            'label'    => sprintf(__('Benefit %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_trade_in_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('trade_in_process_title', [
        'default'           => 'Quy trình thu mua',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('trade_in_process_title', [
        'label'    => __('Tiêu đề Process', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    // Process Steps (4 steps)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('trade_in_step' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('trade_in_step' . $i . '_title', [
            'label'    => sprintf(__('Step %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_trade_in_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('trade_in_step' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('trade_in_step' . $i . '_desc', [
            'label'    => sprintf(__('Step %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_trade_in_page_settings',
            'type'     => 'text',
        ]);
    }

    $wp_customize->add_setting('valuation_form_title', [
        'default'           => 'Đăng ký định giá xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('valuation_form_title', [
        'label'    => __('Tiêu đề Form', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('trade_in_submit_button_text', [
        'default'           => 'Gửi yêu cầu định giá',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('trade_in_submit_button_text', [
        'label'    => __('Text nút Submit', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('accepted_brands_title', [
        'default'           => 'Chúng tôi thu mua tất cả các hãng xe',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('accepted_brands_title', [
        'label'    => __('Tiêu đề Accepted Brands', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('accepted_brands_description', [
        'default'           => 'Toyota, Honda, Mazda, Ford, Hyundai, Kia, Mitsubishi, Nissan, Suzuki, VinFast và nhiều hãng khác.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('accepted_brands_description', [
        'label'    => __('Mô tả Accepted Brands', 'ShopCar'),
        'section'  => 'shopcar_trade_in_page_settings',
        'type'     => 'text',
    ]);
}

// === TESTIMONIALS PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_testimonials_page_customizer_settings');
function shopcar_testimonials_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_testimonials_page_settings', [
        'title'    => __('Testimonials Page Settings', 'ShopCar'),
        'priority' => 74,
    ]);

    $wp_customize->add_setting('testimonials_page_title', [
        'default'           => 'Đánh giá khách hàng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_page_description', [
        'default'           => 'Những phản hồi chân thực từ khách hàng đã sử dụng dịch vụ của chúng tôi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'textarea',
    ]);

    // Testimonials (9 items)
    for ($i = 1; $i <= 9; $i++) {
        $wp_customize->add_setting('testimonial' . $i . '_name', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('testimonial' . $i . '_name', [
            'label'    => sprintf(__('Testimonial %d - Tên khách hàng', 'ShopCar'), $i),
            'section'  => 'shopcar_testimonials_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('testimonial' . $i . '_text', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('testimonial' . $i . '_text', [
            'label'    => sprintf(__('Testimonial %d - Nội dung', 'ShopCar'), $i),
            'section'  => 'shopcar_testimonials_page_settings',
            'type'     => 'textarea',
        ]);

        $wp_customize->add_setting('testimonial' . $i . '_car', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('testimonial' . $i . '_car', [
            'label'    => sprintf(__('Testimonial %d - Xe đã mua', 'ShopCar'), $i),
            'section'  => 'shopcar_testimonials_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('testimonial' . $i . '_rating', [
            'default'           => 5,
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('testimonial' . $i . '_rating', [
            'label'    => sprintf(__('Testimonial %d - Đánh giá (1-5)', 'ShopCar'), $i),
            'section'  => 'shopcar_testimonials_page_settings',
            'type'     => 'number',
            'input_attrs' => [
                'min'  => 1,
                'max'  => 5,
                'step' => 1,
            ],
        ]);
    }

    // Stats
    $wp_customize->add_setting('testimonials_total', [
        'default'           => '500+',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_total', [
        'label'    => __('Tổng số đánh giá', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_total_label', [
        'default'           => 'Khách hàng đánh giá',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_total_label', [
        'label'    => __('Label tổng số', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_rating', [
        'default'           => '4.8',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_rating', [
        'label'    => __('Điểm đánh giá trung bình', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_rating_label', [
        'default'           => 'Điểm đánh giá trung bình',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_rating_label', [
        'label'    => __('Label điểm đánh giá', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_satisfaction', [
        'default'           => '98%',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_satisfaction', [
        'label'    => __('Tỷ lệ hài lòng', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_satisfaction_label', [
        'default'           => 'Khách hàng hài lòng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_satisfaction_label', [
        'label'    => __('Label tỷ lệ hài lòng', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_cta_title', [
        'default'           => 'Bạn cũng muốn chia sẻ trải nghiệm?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_cta_title', [
        'label'    => __('Tiêu đề CTA', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_cta_description', [
        'default'           => 'Hãy để lại đánh giá của bạn về dịch vụ của chúng tôi.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_cta_description', [
        'label'    => __('Mô tả CTA', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('testimonials_cta_button_text', [
        'default'           => 'Gửi đánh giá',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('testimonials_cta_button_text', [
        'label'    => __('Text nút CTA', 'ShopCar'),
        'section'  => 'shopcar_testimonials_page_settings',
        'type'     => 'text',
    ]);
}

// === PARTNERSHIP PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_partnership_page_customizer_settings');
function shopcar_partnership_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_partnership_page_settings', [
        'title'    => __('Partnership Page Settings', 'ShopCar'),
        'priority' => 75,
    ]);

    $wp_customize->add_setting('partnership_page_title', [
        'default'           => 'Hợp tác kinh doanh',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('partnership_page_description', [
        'default'           => 'Cơ hội hợp tác kinh doanh với showroom xe hơi hàng đầu. Cùng nhau phát triển và thành công.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('partnership_types_title', [
        'default'           => 'Các hình thức hợp tác',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_types_title', [
        'label'    => __('Tiêu đề Types', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'text',
    ]);

    // Partnership Types (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('partnership_type' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('partnership_type' . $i . '_title', [
            'label'    => sprintf(__('Type %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_partnership_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('partnership_type' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('partnership_type' . $i . '_desc', [
            'label'    => sprintf(__('Type %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_partnership_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('partnership_benefits_title', [
        'default'           => 'Lợi ích khi hợp tác',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_benefits_title', [
        'label'    => __('Tiêu đề Benefits', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'text',
    ]);

    // Benefits (4 items)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('partnership_benefit' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('partnership_benefit' . $i . '_title', [
            'label'    => sprintf(__('Benefit %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_partnership_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('partnership_benefit' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('partnership_benefit' . $i . '_desc', [
            'label'    => sprintf(__('Benefit %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_partnership_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('partnership_form_title', [
        'default'           => 'Đăng ký hợp tác',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_form_title', [
        'label'    => __('Tiêu đề Form', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('partnership_submit_button_text', [
        'default'           => 'Gửi yêu cầu hợp tác',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('partnership_submit_button_text', [
        'label'    => __('Text nút Submit', 'ShopCar'),
        'section'  => 'shopcar_partnership_page_settings',
        'type'     => 'text',
    ]);
}

// === RETURN POLICY PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_return_policy_page_customizer_settings');
function shopcar_return_policy_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_return_policy_page_settings', [
        'title'    => __('Return Policy Page Settings', 'ShopCar'),
        'priority' => 76,
    ]);

    $wp_customize->add_setting('return_policy_page_title', [
        'default'           => 'Chính sách đổi trả',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('return_policy_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('return_policy_description', [
        'default'           => 'Chúng tôi cam kết đảm bảo quyền lợi của khách hàng với chính sách đổi trả minh bạch và công bằng.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('return_policy_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('return_conditions_title', [
        'default'           => 'Điều kiện đổi trả',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('return_conditions_title', [
        'label'    => __('Tiêu đề Conditions', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);

    // Conditions (4 items)
    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting('return_condition' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('return_condition' . $i . '_title', [
            'label'    => sprintf(__('Condition %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_return_policy_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('return_condition' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('return_condition' . $i . '_desc', [
            'label'    => sprintf(__('Condition %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_return_policy_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('return_process_title', [
        'default'           => 'Quy trình đổi trả',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('return_process_title', [
        'label'    => __('Tiêu đề Process', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);

    // Process Steps (3 steps)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('return_process_step' . $i, [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('return_process_step' . $i, [
            'label'    => sprintf(__('Step %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_return_policy_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('return_process_step' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('return_process_step' . $i . '_desc', [
            'label'    => sprintf(__('Step %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_return_policy_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('refund_policy_title', [
        'default'           => 'Chính sách hoàn tiền',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('refund_policy_title', [
        'label'    => __('Tiêu đề Refund Policy', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('refund_policy_note', [
        'default'           => 'Lưu ý:',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('refund_policy_note', [
        'label'    => __('Note Refund Policy', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('refund_policy_description', [
        'default'           => 'Hoàn tiền sẽ được thực hiện qua tài khoản ngân hàng hoặc tiền mặt trong vòng 7-10 ngày làm việc. Phí vận chuyển (nếu có) sẽ không được hoàn lại.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('refund_policy_description', [
        'label'    => __('Mô tả Refund Policy', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('return_policy_button_text', [
        'default'           => 'Liên hệ hỗ trợ',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('return_policy_button_text', [
        'label'    => __('Text nút', 'ShopCar'),
        'section'  => 'shopcar_return_policy_page_settings',
        'type'     => 'text',
    ]);
}

// === CAREERS PAGE CUSTOMIZER SETTINGS ===
add_action('customize_register', 'shopcar_careers_page_customizer_settings');
function shopcar_careers_page_customizer_settings($wp_customize) {
    
    $wp_customize->add_section('shopcar_careers_page_settings', [
        'title'    => __('Careers Page Settings', 'ShopCar'),
        'priority' => 77,
    ]);

    $wp_customize->add_setting('careers_page_title', [
        'default'           => 'Tuyển dụng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('careers_page_title', [
        'label'    => __('Tiêu đề trang', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('careers_page_description', [
        'default'           => 'Cơ hội nghề nghiệp tại showroom xe hơi hàng đầu. Chúng tôi đang tìm kiếm những tài năng để cùng phát triển.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('careers_page_description', [
        'label'    => __('Mô tả', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'textarea',
    ]);

    $wp_customize->add_setting('why_join_title', [
        'default'           => 'Tại sao nên làm việc với chúng tôi?',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('why_join_title', [
        'label'    => __('Tiêu đề Why Join', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);

    // Career Benefits (3 items)
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('career_benefit' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('career_benefit' . $i . '_title', [
            'label'    => sprintf(__('Benefit %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('career_benefit' . $i . '_desc', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('career_benefit' . $i . '_desc', [
            'label'    => sprintf(__('Benefit %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'textarea',
        ]);
    }

    $wp_customize->add_setting('job_openings_title', [
        'default'           => 'Vị trí đang tuyển dụng',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('job_openings_title', [
        'label'    => __('Tiêu đề Job Openings', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);

    // Jobs (5 items)
    for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_setting('job' . $i . '_title', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('job' . $i . '_title', [
            'label'    => sprintf(__('Job %d - Tiêu đề', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('job' . $i . '_location', [
            'default'           => 'Hà Nội / TP.HCM',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('job' . $i . '_location', [
            'label'    => sprintf(__('Job %d - Địa điểm', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'text',
        ]);

        $wp_customize->add_setting('job' . $i . '_description', [
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('job' . $i . '_description', [
            'label'    => sprintf(__('Job %d - Mô tả', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'textarea',
        ]);

        $wp_customize->add_setting('job' . $i . '_apply_url', [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage',
        ]);
        $wp_customize->add_control('job' . $i . '_apply_url', [
            'label'    => sprintf(__('Job %d - URL ứng tuyển', 'ShopCar'), $i),
            'section'  => 'shopcar_careers_page_settings',
            'type'     => 'url',
        ]);
    }

    $wp_customize->add_setting('careers_apply_button_text', [
        'default'           => 'Ứng tuyển ngay',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('careers_apply_button_text', [
        'label'    => __('Text nút Apply', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('application_form_title', [
        'default'           => 'Gửi CV ứng tuyển',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('application_form_title', [
        'label'    => __('Tiêu đề Form', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);

    $wp_customize->add_setting('careers_submit_button_text', [
        'default'           => 'Gửi đơn ứng tuyển',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control('careers_submit_button_text', [
        'label'    => __('Text nút Submit', 'ShopCar'),
        'section'  => 'shopcar_careers_page_settings',
        'type'     => 'text',
    ]);
}

// === CUSTOMIZER PREVIEW JS ===
add_action('customize_preview_init', 'shopcar_header_customizer_preview_js');
function shopcar_header_customizer_preview_js() {
    wp_enqueue_script(
        'shopcar-header-customizer-preview',
        get_template_directory_uri() . '/assets/js/customizer-preview.js',
        ['customize-preview'],
        CAR_THEME_VERSION,
        true
    );
}

// === CUSTOMIZER PREVIEW CSS ===
add_action('wp_head', 'shopcar_header_customizer_css');
function shopcar_header_customizer_css() {
    if (!is_customize_preview()) {
        return;
    }
    ?>
    <style id="shopcar-header-customizer-css">
        .header-top-bar {
            background-color: <?php echo esc_attr(get_theme_mod('header_top_bar_bg', '#1a1a1a')); ?> !important;
            color: <?php echo esc_attr(get_theme_mod('header_top_bar_text_color', '#ffffff')); ?> !important;
        }
        .header-top-bar-left a,
        .header-top-bar-right a {
            color: <?php echo esc_attr(get_theme_mod('header_top_bar_text_color', '#ffffff')); ?> !important;
        }
        .header.axil-header {
            background-color: <?php echo esc_attr(get_theme_mod('header_bg_color', '#ffffff')); ?> !important;
            padding-top: <?php echo esc_attr(get_theme_mod('header_padding_top', '16')); ?>px !important;
            padding-bottom: <?php echo esc_attr(get_theme_mod('header_padding_bottom', '16')); ?>px !important;
        }
        .header.axil-header.sticky {
            background-color: <?php echo esc_attr(get_theme_mod('header_bg_color', '#ffffff')); ?> !important;
        }
        .header-logo img {
            height: <?php echo esc_attr(get_theme_mod('header_logo_height', '48')); ?>px !important;
        }
        .header-nav .mainmenu li a {
            color: <?php echo esc_attr(get_theme_mod('header_menu_text_color', '#222222')); ?> !important;
            font-size: <?php echo esc_attr(get_theme_mod('header_menu_font_size', '15')); ?>px !important;
        }
        .header-nav .mainmenu li a:hover {
            background: <?php echo esc_attr(get_theme_mod('header_menu_hover_bg', '#f5f5f5')); ?> !important;
            color: <?php echo esc_attr(get_theme_mod('header_menu_hover_color', '#000000')); ?> !important;
        }
        .action-list li a {
            color: <?php echo esc_attr(get_theme_mod('header_action_icons_color', '#222222')); ?> !important;
        }
        .header-search-box button {
            background: <?php echo esc_attr(get_theme_mod('header_search_button_color', '#000000')); ?> !important;
        }
        .cart-count {
            background: <?php echo esc_attr(get_theme_mod('header_cart_badge_color', '#ff497c')); ?> !important;
        }
    </style>
    <?php
}

// === DYNAMIC CSS FOR CUSTOMIZER SETTINGS ===
add_action('wp_head', 'shopcar_dynamic_customizer_css');
function shopcar_dynamic_customizer_css() {
    ?>
    <style id="shopcar-dynamic-customizer-css">
        /* Color Scheme */
        :root {
            --color-primary: <?php echo esc_attr(get_theme_mod('color_primary', '#007bff')); ?>;
            --color-secondary: <?php echo esc_attr(get_theme_mod('color_secondary', '#6c757d')); ?>;
            --color-accent: <?php echo esc_attr(get_theme_mod('color_accent', '#ff497c')); ?>;
        }
        
        body {
            color: <?php echo esc_attr(get_theme_mod('color_text', '#222222')); ?>;
            background-color: <?php echo esc_attr(get_theme_mod('color_background', '#ffffff')); ?>;
            font-size: <?php echo esc_attr(get_theme_mod('typography_body_size', '16')); ?>px;
            font-family: <?php echo esc_attr(get_theme_mod('typography_font_family', 'Arial, sans-serif')); ?>;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-size: <?php echo esc_attr(get_theme_mod('typography_heading_size', '32')); ?>px;
        }
        
        .axil-btn.btn-primary {
            background-color: <?php echo esc_attr(get_theme_mod('color_primary', '#007bff')); ?>;
        }
        
        .axil-btn.btn-primary:hover {
            background-color: <?php echo esc_attr(get_theme_mod('color_primary', '#007bff')); ?>;
            opacity: 0.9;
        }
        
        /* Footer Styles */
        .axil-footer-area {
            background-color: <?php echo esc_attr(get_theme_mod('footer_bg_color', '#1a1a1a')); ?> !important;
            color: <?php echo esc_attr(get_theme_mod('footer_text_color', '#ffffff')); ?> !important;
        }
        
        .axil-footer-area a {
            color: <?php echo esc_attr(get_theme_mod('footer_text_color', '#ffffff')); ?> !important;
        }
        
        .axil-footer-area a:hover {
            opacity: 0.8;
        }
    </style>
    <?php
}


// === Enqueue Scripts & Styles (GỘP LẠI 1 HÀM) ===
add_action('wp_enqueue_scripts', function () {

    $theme_uri = get_template_directory_uri();

    // 🟩 FONT AWESOME — bản đầy đủ, load đầu tiên để không bị đè
    wp_enqueue_style(
        'font-awesome-5',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css',
        [],
        '5.15.4'
    );

    // ===== CSS =====
    wp_enqueue_style('shopcar-bootstrap', $theme_uri . '/assets/css/vendor/bootstrap.min.css', [], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-slick', $theme_uri . '/assets/css/vendor/slick.css', [], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-slick-theme', $theme_uri . '/assets/css/vendor/slick-theme.css', ['shopcar-slick'], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-magnific', $theme_uri . '/assets/css/vendor/magnific-popup.css', [], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-sal', $theme_uri . '/assets/css/vendor/sal.css', [], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-style-min', $theme_uri . '/assets/css/style.min.css', [], CAR_THEME_VERSION);
    wp_enqueue_style('shopcar-style', $theme_uri . '/assets/css/style.css', [], CAR_THEME_VERSION);

    // Theme style.css
    wp_enqueue_style('shopcar-style', get_stylesheet_uri(), [], CAR_THEME_VERSION);


    // ===== JS =====
    wp_enqueue_script('jquery');
    wp_enqueue_script('shopcar-bootstrap', $theme_uri . '/assets/js/vendor/bootstrap.bundle.min.js', ['jquery'], CAR_THEME_VERSION, true);
    wp_enqueue_script('shopcar-slick', $theme_uri . '/assets/js/vendor/slick.min.js', ['jquery'], CAR_THEME_VERSION, true);
    wp_enqueue_script('shopcar-magnific', $theme_uri . '/assets/js/vendor/jquery.magnific-popup.min.js', ['jquery'], CAR_THEME_VERSION, true);
    wp_enqueue_script('shopcar-sal', $theme_uri . '/assets/js/vendor/sal.js', ['jquery'], CAR_THEME_VERSION, true);
    wp_enqueue_script('shopcar-main', $theme_uri . '/assets/js/main.js', ['jquery'], CAR_THEME_VERSION, true);
});


// === Menu helper ===
function ShopCar_menu($location = 'primary')
{
    if (has_nav_menu($location)) {
        wp_nav_menu([
            'theme_location' => $location,
            'container' => false,
            'menu_class' => 'menu ' . $location,
            'fallback_cb' => false,
        ]);
    } else {
        echo '<ul class="menu placeholder"><li><a href="' . esc_url(home_url('/')) . '">Home</a></li></ul>';
    }
}

add_action('widgets_init', function () {
    register_sidebar([
        'name' => 'Blog Sidebar',
        'id' => 'blog-sidebar',
        'before_widget' => '<div class="axil-single-widget mt--40">',
        'after_widget' => '</div>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ]);
});

//myaccount
add_filter('page_template', function ($template) {
    if (is_page('register')) {
        return get_template_directory() . '/templates/myaccount/register.php';
    }

    if (is_page('login')) {
        return get_template_directory() . '/templates/myaccount/login.php';
    }

    if (is_page('forgot-password')) {
        return get_template_directory() . '/templates/myaccount/forgot-password.php';
    }

    if (is_page('reset-password')) {
        return get_template_directory() . '/templates/myaccount/reset-password.php';
    }

    return $template;
});

// Thêm rewrite rule cho /login và /register để load template tùy chỉnh mà không cần tạo page
add_action('init', function () {
    add_rewrite_rule('^login/?$', 'index.php?custom_login=1', 'top');
    add_rewrite_rule('^register/?$', 'index.php?custom_register=1', 'top');
});

add_filter('query_vars', function ($vars) {
    $vars[] = 'custom_login';
    $vars[] = 'custom_register';
    return $vars;
});

add_filter('template_include', function ($template) {
    if (get_query_var('custom_login')) {
        return get_template_directory() . '/templates/myaccount/login.php';
    }
    if (get_query_var('custom_register')) {
        return get_template_directory() . '/templates/myaccount/register.php';
    }
    return $template;
});

// Redirect sau khi logout về /login
add_filter('woocommerce_logout_redirect', function ($redirect_url) {
    return home_url('/login');
});


// bui-tham-ky1-view-count
function shopcar_track_product_views()
{
    if (is_admin() && !wp_doing_ajax()) {
        return;
    }

    if (!is_product()) {
        return;
    }

    $product_id = get_queried_object_id();

    if (!$product_id) {
        return;
    }

    $current_views = (int) get_post_meta($product_id, '_view_count', true);
    $new_views = $current_views + 1;

    update_post_meta($product_id, '_view_count', $new_views);
}
add_action('template_redirect', 'shopcar_track_product_views');

function shopcar_append_view_count_to_price($price_html, $product)
{
    if (!is_product()) {
        return $price_html;
    }

    if (empty($product) || !$product instanceof WC_Product) {
        return $price_html;
    }

    $views = (int) get_post_meta($product->get_id(), '_view_count', true);
    $view_block = sprintf(
        '<div class="shopcar-product-view-meta"><span class="view-icon" aria-hidden="true">👁</span><span class="view-label">%s</span><span class="view-count">%s</span></div>',
        esc_html__('Số lượt xem:', 'shopcar'),
        esc_html(number_format_i18n($views))
    );

    $share_block = shopcar_get_social_share_markup($product);

    return $price_html . $view_block . $share_block;
}
add_filter('woocommerce_get_price_html', 'shopcar_append_view_count_to_price', 20, 2);

function shopcar_product_view_styles()
{
    $custom_css = '
        .shopcar-product-view-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            background: transparent;
            padding: 0;
            border-radius: 0;
            font-weight: 600;
            color: #1d1d1f;
            margin-top: 12px;
            box-shadow: none;
            width: 100%;
        }
        .shopcar-product-view-meta .view-icon {
            font-size: 16px;
        }
        .shopcar-product-view-meta .view-label {
            text-transform: uppercase;
            letter-spacing: .05em;
            font-size: 12px;
            color: #86868b;
        }
        .shopcar-product-view-meta .view-count {
            font-size: 16px;
            color: #ff4500;
        }
        .single-product .price-amount {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .single-product .price-amount .price {
            line-height: 1.3;
        }
    ';

    wp_add_inline_style('shopcar-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'shopcar_product_view_styles', 20);
// End bui-tham-ky1-view-count


// bui-tham-ky/2-social-sharing
function shopcar_get_social_share_markup($product)
{
    if (empty($product) || !$product instanceof WC_Product) {
        return '';
    }

    $permalink = get_permalink($product->get_id());
    $encoded = rawurlencode($permalink);
    $title = rawurlencode($product->get_name());

    $facebook = sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', $encoded);
    $share_x = sprintf('https://twitter.com/intent/tweet?url=%s&text=%s', $encoded, $title);
    $linkedin = sprintf('https://www.linkedin.com/sharing/share-offsite/?url=%s', $encoded);
    $mailto = sprintf('mailto:?subject=%s&body=%s', rawurlencode($product->get_name()), $encoded);

    ob_start();
?>
    <div class="yt-share-block" data-share-block>
        <button type="button" class="yt-share-trigger" data-share-toggle>
            <span class="yt-share-trigger__icon" aria-hidden="true">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13 5L19 11L13 17" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
            <span class="yt-share-trigger__text"><?php esc_html_e('Chia sẻ', 'shopcar'); ?></span>
        </button>

        <div class="yt-share-popover" data-share-popover>
            <button type="button" class="yt-share-close" data-share-close
                aria-label="<?php esc_attr_e('Đóng', 'shopcar'); ?>">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="yt-share-icons">
                <a class="yt-share-item share-facebook" href="<?php echo esc_url($facebook); ?>" target="_blank"
                    rel="noopener noreferrer">
                    <span class="circle">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    </span>
                    <span>Facebook</span>
                </a>
                <a class="yt-share-item share-x" href="<?php echo esc_url($share_x); ?>" target="_blank"
                    rel="noopener noreferrer">
                    <span class="circle">
                        <svg width="16" height="16" viewBox="0 0 512 512" aria-hidden="true">
                            <path fill="currentColor"
                                d="M389.2 48H470L305.8 242.9 499 464H346.5L233.3 330.4 104.5 464H23.4l174-201.5L10 48h155.1l99.3 118.9z" />
                        </svg>
                    </span>
                    <span>X</span>
                </a>
                <a class="yt-share-item share-linkedin" href="<?php echo esc_url($linkedin); ?>" target="_blank"
                    rel="noopener noreferrer">
                    <span class="circle">
                        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
                    </span>
                    <span>LinkedIn</span>
                </a>
                <a class="yt-share-item share-mail" href="<?php echo esc_url($mailto); ?>">
                    <span class="circle">
                        <i class="far fa-envelope" aria-hidden="true"></i>
                    </span>
                    <span><?php esc_html_e('Gửi mail', 'shopcar'); ?></span>
                </a>
            </div>

            <div class="yt-share-link">
                <button type="button" class="yt-share-copy" data-share-copy="<?php echo esc_url($permalink); ?>">
                    <?php esc_html_e('Sao chép đường dẫn', 'shopcar'); ?>
                </button>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function shopcar_social_share_assets()
{
    $share_css = '
        .yt-share-block {
            margin-top: 12px;
            width: 100%;
            position: relative;
        }
        .yt-share-trigger {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 14px;
            border: 1px solid #dedede;
            background: #fff;
            color: #0f0f0f;
            border-radius: 999px;
            font-weight: 600;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .2s ease;
            width: auto;
        }
        .yt-share-trigger__icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #0f0f0f;
            color: #fff;
        }
        .yt-share-trigger:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.15);
        }
        .yt-share-popover {
            display: none;
            max-width: 420px;
            margin-top: 12px;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.15);
            padding: 24px;
            position: relative;
        }
        .yt-share-block.is-open .yt-share-popover {
            display: block;
            animation: ytShareFade .25s ease;
        }
        @keyframes ytShareFade {
            from {opacity:0; transform: translateY(-8px);}
            to {opacity:1; transform: translateY(0);}
        }
        .yt-share-close {
            position: absolute;
            top: 8px;
            right: 8px;
            border: none;
            background: rgba(255,255,255,0.85);
            width: 26px;
            height: 26px;
            border-radius: 50%;
            font-size: 16px;
            color: #555;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
            z-index: 2;
        }
        .yt-share-icons {
            display: grid;
            grid-template-columns: repeat(4, minmax(0,1fr));
            gap: 12px;
            margin-bottom: 20px;
        }
        .yt-share-item {
            text-align: center;
            text-decoration: none;
            color: #0f0f0f;
            font-weight: 600;
            font-size: 12px;
        }
        .yt-share-item .circle {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 20px;
            box-shadow: 0 12px 20px rgba(0,0,0,0.1);
            transition: transform .2s ease;
        }
        .yt-share-item:hover .circle {
            transform: translateY(-3px);
        }
        .yt-share-item.share-facebook .circle {background:#1877f2;}
        .yt-share-item.share-x .circle {background:#0f0f0f;}
        .yt-share-item.share-linkedin .circle {background:#0a66c2;}
        .yt-share-item.share-mail .circle {background:#5f6368;}
        .yt-share-link {
            display: flex;
            justify-content: flex-start;
        }
        .yt-share-copy {
            border: none;
            border-radius: 999px;
            padding: 10px 24px;
            background: #0f0f0f;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
            font-size: 14px;
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        .yt-share-copy:hover {opacity:.85;}
    ';

    wp_add_inline_style('shopcar-style', $share_css);

    $copied_text = esc_js(__('Đã sao chép', 'shopcar'));
    $copy_text = esc_js(__('Sao chép đường dẫn', 'shopcar'));

    $share_js = '
        document.addEventListener("click", function(event) {
            var toggle = event.target.closest("[data-share-toggle]");
            if (toggle) {
                var block = toggle.closest("[data-share-block]");
                if (block) {
                    block.classList.toggle("is-open");
                }
                return;
            }

            var closeBtn = event.target.closest("[data-share-close]");
            if (closeBtn) {
                var block = closeBtn.closest("[data-share-block]");
                if (block) {
                    block.classList.remove("is-open");
                }
                return;
            }

            var copyBtn = event.target.closest("[data-share-copy]");
            if (!copyBtn) {
                var openBlock = document.querySelector("[data-share-block].is-open");
                if (openBlock && !openBlock.contains(event.target)) {
                    openBlock.classList.remove("is-open");
                }
                return;
            }

            event.preventDefault();
            var url = copyBtn.getAttribute("data-share-copy");
            if (!url || !navigator.clipboard) {
                return;
            }
            navigator.clipboard.writeText(url).then(function() {
                var original = copyBtn.innerHTML;
                copyBtn.innerHTML = \'' . $copied_text . '\';
                setTimeout(function() {
                    copyBtn.innerHTML = original || \'' . $copy_text . '\';
                }, 2000);
            });
        });
    ';

    wp_add_inline_script('jquery', $share_js);
}
add_action('wp_enqueue_scripts', 'shopcar_social_share_assets', 25);
// End bui-tham/2-social-sharing


// bui-tham-ky/3-change-password
add_action('init', function () {

    if (
        isset($_POST['password_nonce']) &&
        wp_verify_nonce($_POST['password_nonce'], 'save_new_password')
    ) {
        $user = wp_get_current_user();

        $current = isset($_POST['current_pass']) ? trim($_POST['current_pass']) : '';
        $new = isset($_POST['new_pass']) ? trim($_POST['new_pass']) : '';
        $confirm = isset($_POST['confirm_pass']) ? trim($_POST['confirm_pass']) : '';

        // Validate
        if (empty($current)) {
            wc_add_notice('Hãy điền mật khẩu hiện tại.', 'error');
            return;
        }

        if (!wp_check_password($current, $user->user_pass, $user->ID)) {
            wc_add_notice('Sai mật khẩu hiện tại.', 'error');
            return;
        }

        if (empty($new)) {
            wc_add_notice('Vui lòng nhập mật khẩu mới.', 'error');
            return;
        }

        if ($new !== $confirm) {
            wc_add_notice('Xác nhận mật khẩu không khớp.', 'error');
            return;
        }

        // Đổi mật khẩu
        wp_set_password($new, $user->ID);

        wc_add_notice('Lưu mật khẩu thành công.', 'success');

        // Sau khi đổi mật khẩu → tự đăng nhập lại
        wp_set_auth_cookie($user->ID);

        return;
    }
});
// End bui-tham-ky/3-change-password

// bui-tham-ky/4-forget-password
// Kích hoạt gửi email dạng HTML
add_filter('wp_mail_content_type', function () {
    return "text/html";
});

// End bui-tham-ky/4-forget-password

// bui-tham-ky/5-wishlist
/* ==========================================================
   API: Thêm sản phẩm vào Wishlist (Cookie)
========================================================== */
add_action('rest_api_init', function () {
    register_rest_route('wishlist', '/add', [
        'methods' => 'GET',
        'callback' => function () {

            // ID sản phẩm
            $id = intval($_GET['id']);
            if (!$id) return ['error' => 'Missing ID'];

            // Lấy dữ liệu wishlist hiện tại
            $wishlist = isset($_COOKIE['wishlist'])
                ? json_decode(stripslashes($_COOKIE['wishlist']), true)
                : [];

            // Nếu chưa có thì thêm vào
            if (!in_array($id, $wishlist)) {
                $wishlist[] = $id;
            }

            // Lưu cookie 30 ngày
            setcookie('wishlist', json_encode($wishlist), time() + 86400 * 30, "/");

            return ['success' => true, 'wishlist' => $wishlist];
        }
    ]);
});


/* ==========================================================
   API: Xóa sản phẩm khỏi Wishlist (Cookie)
========================================================== */
add_action('rest_api_init', function () {
    register_rest_route('wishlist', '/remove', [
        'methods' => 'GET',
        'callback' => function () {

            // ID sản phẩm
            $id = intval($_GET['id']);
            if (!$id) return ['error' => 'Missing ID'];

            // Lấy danh sách hiện tại
            $wishlist = isset($_COOKIE['wishlist'])
                ? json_decode(stripslashes($_COOKIE['wishlist']), true)
                : [];

            // Loại bỏ sản phẩm
            $wishlist = array_filter($wishlist, function ($pid) use ($id) {
                return $pid != $id;
            });

            // Lưu lại cookie
            setcookie('wishlist', json_encode($wishlist), time() + 86400 * 30, "/");

            return ['success' => true];
        }
    ]);
});

// End bui-tham-ky/5-wishlist

// Tách riêng login frontend và wp-admin
// Khi login ở wp-admin, đánh dấu là login từ admin
add_action('wp_login', function ($user_login, $user) {
    // Kiểm tra nếu có nonce từ frontend form
    if (isset($_POST['shopcar_login_nonce'])) {
        // Login từ frontend - đã được set trong login.php
        return;
    }

    // Nếu không có nonce frontend, có thể là login từ wp-admin
    // Kiểm tra referer hoặc request URI
    $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    $request_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

    if (
        strpos($referer, '/wp-admin') !== false ||
        strpos($referer, '/wp-login.php') !== false ||
        strpos($request_uri, '/wp-admin') !== false ||
        strpos($request_uri, '/wp-login.php') !== false
    ) {
        update_user_meta($user->ID, '_shopcar_login_source', 'admin');
    }
}, 10, 2);

// Chặn truy cập wp-admin nếu user login từ frontend (trừ admin users)
add_action('admin_init', function () {
    // Bỏ qua nếu đang ở AJAX hoặc đang logout
    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }

    if (isset($_GET['action']) && $_GET['action'] === 'logout') {
        return;
    }

    // Chỉ áp dụng cho users đã login
    if (!is_user_logged_in()) {
        return;
    }

    $user_id = get_current_user_id();
    $login_source = get_user_meta($user_id, '_shopcar_login_source', true);

    // Nếu user có quyền admin (manage_options), cho phép truy cập wp-admin
    if (current_user_can('manage_options')) {
        return;
    }

    // Nếu user login từ frontend, redirect về frontend
    if ($login_source === 'frontend') {
        wp_safe_redirect(home_url('/?admin_redirect=1'));
        exit;
    }
}, 1);

// Khi logout, xóa flag
add_action('wp_logout', function () {
    $user_id = get_current_user_id();
    if ($user_id) {
        delete_user_meta($user_id, '_shopcar_login_source');
    }
});














// Start nhhh/1-login
function shopcar_scripts()
{
    // Đảm bảo jQuery được load trước
    wp_enqueue_script('jquery');

    // Sửa đường dẫn đúng đến file jQuery UI trong thư mục vendor
    wp_enqueue_script(
        'jquery-ui',
        get_template_directory_uri() . '/assets/js/vendor/jquery-ui.min.js',
        array('jquery'),
        '1.13.2',
        true
    );

    // Enqueue imagesLoaded
    wp_enqueue_script(
        'imagesloaded',
        get_template_directory_uri() . '/assets/js/vendor/imagesloaded.pkgd.min.js',
        array('jquery'),
        '4.1.4',
        true
    );

    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/assets/js/vendor/bootstrap.bundle.min.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'main',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery', 'jquery-ui', 'imagesloaded', 'bootstrap'),
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'shopcar_scripts');

// Chat Support System
function shopcar_register_chat_post_type()
{
    register_post_type('support_chat', array(
        'labels' => array(
            'name' => 'Chat Hỗ trợ',
            'singular_name' => 'Chat',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'supports' => array('title', 'editor'),
        'capability_type' => 'post',
    ));
}
add_action('init', 'shopcar_register_chat_post_type');

// AJAX handlers for chat
function shopcar_send_chat_message()
{
    check_ajax_referer('shopcar_chat_nonce', 'nonce');

    if (!is_user_logged_in()) {
        wp_die('Unauthorized');
    }

    $user_id = get_current_user_id();
    $message = sanitize_text_field($_POST['message']);

    if (empty($message)) {
        wp_die('Empty message');
    }

    // Create or get chat post
    $chat_query = new WP_Query(array(
        'post_type' => 'support_chat',
        'meta_query' => array(
            array(
                'key' => '_user_id',
                'value' => $user_id,
                'compare' => '='
            )
        ),
        'posts_per_page' => 1
    ));

    if ($chat_query->have_posts()) {
        $chat_id = $chat_query->posts[0]->ID;
    } else {
        $chat_id = wp_insert_post(array(
            'post_type' => 'support_chat',
            'post_title' => 'Chat với ' . wp_get_current_user()->display_name,
            'post_status' => 'publish'
        ));
        update_post_meta($chat_id, '_user_id', $user_id);
    }

    // Add message
    $messages = get_post_meta($chat_id, '_messages', true);
    if (!$messages) $messages = array();

    $messages[] = array(
        'sender' => 'user',
        'sender_name' => wp_get_current_user()->display_name,
        'message' => $message,
        'timestamp' => current_time('mysql', true)
    );

    update_post_meta($chat_id, '_messages', $messages);

    wp_send_json_success();
}
add_action('wp_ajax_send_chat_message', 'shopcar_send_chat_message');

function shopcar_get_chat_messages()
{
    check_ajax_referer('shopcar_chat_nonce', 'nonce');

    $chat_id = isset($_POST['chat_id']) ? intval($_POST['chat_id']) : 0;

    if ($chat_id > 0) {
        // Admin requesting specific chat
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
    } else {
        // User requesting their own chat
        if (!is_user_logged_in()) {
            wp_die('Unauthorized');
        }
        $user_id = get_current_user_id();

        $chat_query = new WP_Query(array(
            'post_type' => 'support_chat',
            'meta_query' => array(
                array(
                    'key' => '_user_id',
                    'value' => $user_id,
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        ));

        if ($chat_query->have_posts()) {
            $chat_id = $chat_query->posts[0]->ID;
        } else {
            wp_send_json_success(array());
            return;
        }
    }

    $messages = get_post_meta($chat_id, '_messages', true);
    if (!$messages) $messages = array();

    wp_send_json_success($messages);
}
add_action('wp_ajax_get_chat_messages', 'shopcar_get_chat_messages');

// Admin AJAX handlers
function shopcar_get_admin_chats()
{
    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    $chats = get_posts(array(
        'post_type' => 'support_chat',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_user_id',
                'compare' => 'EXISTS'
            )
        )
    ));

    $chat_data = array();
    foreach ($chats as $chat) {
        $user_id = get_post_meta($chat->ID, '_user_id', true);
        $user = get_user_by('id', $user_id);
        $messages = get_post_meta($chat->ID, '_messages', true);
        $last_message = !empty($messages) ? end($messages)['message'] : 'Chưa có tin nhắn';

        $chat_data[] = array(
            'id' => $chat->ID,
            'user_name' => $user ? $user->display_name : 'Unknown',
            'last_message' => $last_message
        );
    }

    wp_send_json_success($chat_data);
}
add_action('wp_ajax_get_admin_chats', 'shopcar_get_admin_chats');

function shopcar_send_admin_message()
{
    check_ajax_referer('shopcar_chat_nonce', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_die('Unauthorized');
    }

    $chat_id = intval($_POST['chat_id']);
    $message = sanitize_text_field($_POST['message']);

    $messages = get_post_meta($chat_id, '_messages', true);
    if (!$messages) $messages = array();

    $messages[] = array(
        'sender' => 'admin',
        'sender_name' => 'Admin',
        'message' => $message,
        'timestamp' => current_time('mysql')
    );

    update_post_meta($chat_id, '_messages', $messages);

    wp_send_json_success();
}
add_action('wp_ajax_send_admin_message', 'shopcar_send_admin_message');

// Enqueue chat assets
function shopcar_enqueue_chat_assets()
{
    // Kiểm tra nhiều điều kiện để đảm bảo load trên trang chat
    $is_chat_page = is_page_template('templates/chat/user-chat.php')
        || is_page_template('templates/chat/admin-chat.php')
        || (is_page() && get_page_template_slug() === 'templates/chat/user-chat.php')
        || (is_page() && get_page_template_slug() === 'templates/chat/admin-chat.php')
        || (isset($_GET['page']) && $_GET['page'] === 'shopcar-chat');

    if ($is_chat_page || ($GLOBALS['pagenow'] === 'admin.php' && isset($_GET['page']) && $_GET['page'] === 'shopcar-chat')) {
        // Đảm bảo jQuery được load trước
        wp_enqueue_script('jquery');

        if (file_exists(get_template_directory() . '/assets/css/chat.css')) {
            wp_enqueue_style('shopcar-chat', get_template_directory_uri() . '/assets/css/chat.css', array(), '1.0.2');
        }
        // Load chat.js với dependency jQuery, đảm bảo load sau jQuery
        wp_enqueue_script('shopcar-chat', get_template_directory_uri() . '/assets/js/chat.js', array('jquery'), '1.0.2', true);

        wp_localize_script('shopcar-chat', 'shopcar_chat', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('shopcar_chat_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'shopcar_enqueue_chat_assets', 20); // Priority 20 để load sau shopcar_scripts

// Add chat page template
add_filter('page_template', function ($template) {
    if (is_page('chat')) {
        return get_template_directory() . '/templates/chat/user-chat.php';
    }
    if (is_page('admin-chat')) {
        return get_template_directory() . '/templates/chat/admin-chat.php';
    }
    return $template;
});

// Add admin menu for chat
function shopcar_add_chat_admin_menu()
{
    add_menu_page(
        'Chat Hỗ trợ',
        'Chat Hỗ trợ',
        'manage_options',
        'shopcar-chat',
        'shopcar_chat_admin_page',
        'dashicons-format-chat',
        30
    );
}
add_action('admin_menu', 'shopcar_add_chat_admin_menu');

function shopcar_chat_admin_page()
{
    // Enqueue scripts for admin page
    wp_enqueue_script('jquery');
    wp_enqueue_script('shopcar-chat', get_template_directory_uri() . '/assets/js/chat.js', array('jquery'), '1.0.0', true);

    wp_localize_script('shopcar-chat', 'shopcar_chat', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('shopcar_chat_nonce')
    ));

    include get_template_directory() . '/templates/chat/admin-chat.php';
}

// ============================================
// EMAIL REGISTRATION FOR NEW PRODUCTS
// ============================================

// Register custom post type for email subscriptions
function shopcar_register_email_subscription_post_type()
{
    register_post_type('email_subscription', array(
        'labels' => array(
            'name' => 'Email Đăng ký',
            'singular_name' => 'Email Đăng ký',
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-email-alt',
        'supports' => array('title'),
        'capability_type' => 'post',
    ));
}
add_action('init', 'shopcar_register_email_subscription_post_type');

// AJAX handler: Đăng ký email
function shopcar_register_email_subscription()
{
    check_ajax_referer('shopcar_email_subscription_nonce', 'nonce');

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';

    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Email không hợp lệ.'));
    }

    // Kiểm tra email đã tồn tại chưa
    $existing = get_posts(array(
        'post_type' => 'email_subscription',
        'post_status' => 'publish',
        'meta_query' => array(
            array(
                'key' => '_email_address',
                'value' => $email,
                'compare' => '='
            )
        ),
        'posts_per_page' => 1
    ));

    if (!empty($existing)) {
        wp_send_json_error(array('message' => 'Email này đã được đăng ký rồi.'));
    }

    // Tạo subscription mới
    $post_id = wp_insert_post(array(
        'post_type' => 'email_subscription',
        'post_title' => $email,
        'post_status' => 'publish'
    ));

    if (is_wp_error($post_id)) {
        wp_send_json_error(array('message' => 'Có lỗi xảy ra. Vui lòng thử lại.'));
    }

    // Lưu email address và thời gian đăng ký
    update_post_meta($post_id, '_email_address', $email);
    update_post_meta($post_id, '_subscription_date', current_time('mysql'));
    update_post_meta($post_id, '_is_active', '1');

    wp_send_json_success(array('message' => 'Đăng ký thành công! Bạn sẽ nhận được thông báo khi có sản phẩm mới.'));
}
add_action('wp_ajax_shopcar_register_email_subscription', 'shopcar_register_email_subscription');
add_action('wp_ajax_nopriv_shopcar_register_email_subscription', 'shopcar_register_email_subscription');

// Gửi email thông báo khi có sản phẩm mới
function shopcar_notify_new_product($post_id)
{
    // Chỉ xử lý khi sản phẩm được publish lần đầu
    if (get_post_type($post_id) !== 'product') {
        return;
    }

    // Kiểm tra xem đã gửi thông báo chưa
    if (get_post_meta($post_id, '_new_product_notified', true) === '1') {
        return;
    }

    // Lấy thông tin sản phẩm
    $product = wc_get_product($post_id);
    if (!$product) {
        return;
    }

    $product_name = $product->get_name();
    $product_url = get_permalink($post_id);
    $product_price = $product->get_price_html();
    $product_image = get_the_post_thumbnail_url($post_id, 'medium');

    // Lấy danh sách email đăng ký
    $subscriptions = get_posts(array(
        'post_type' => 'email_subscription',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_is_active',
                'value' => '1',
                'compare' => '='
            )
        )
    ));

    if (empty($subscriptions)) {
        return;
    }

    $site_name = get_bloginfo('name');
    $site_url = home_url();

    // Gửi email cho từng subscriber
    $sent_count = 0;
    foreach ($subscriptions as $subscription) {
        $email = get_post_meta($subscription->ID, '_email_address', true);

        if (empty($email) || !is_email($email)) {
            continue;
        }

        $subject = sprintf('[%s] Sản phẩm mới: %s', $site_name, $product_name);

        $message = sprintf(
            "Xin chào,\n\n" .
                "Chúng tôi vui mừng thông báo về sản phẩm mới:\n\n" .
                "Tên sản phẩm: %s\n" .
                "Giá: %s\n" .
                "Xem chi tiết: %s\n\n" .
                "Cảm ơn bạn đã quan tâm!\n\n" .
                "Trân trọng,\n" .
                "%s",
            $product_name,
            $product_price,
            $product_url,
            $site_name
        );

        // HTML email
        $html_message = sprintf(
            '<!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <style>
                    body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background: #007bff; color: white; padding: 20px; text-align: center; }
                    .content { background: #f9f9f9; padding: 20px; }
                    .product { background: white; padding: 20px; margin: 20px 0; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
                    .product-image { max-width: 100%%; height: auto; border-radius: 5px; margin-bottom: 15px; }
                    .product-name { font-size: 24px; font-weight: bold; color: #007bff; margin-bottom: 10px; }
                    .product-price { font-size: 20px; color: #28a745; font-weight: bold; margin-bottom: 15px; }
                    .button { display: inline-block; padding: 12px 30px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 15px; }
                    .footer { text-align: center; padding: 20px; color: #666; font-size: 12px; }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>%s</h1>
                    </div>
                    <div class="content">
                        <h2>Sản phẩm mới!</h2>
                        <p>Chúng tôi vui mừng thông báo về sản phẩm mới:</p>
                        <div class="product">
                            %s
                            <div class="product-name">%s</div>
                            <div class="product-price">%s</div>
                            <a href="%s" class="button">Xem chi tiết</a>
                        </div>
                        <p>Cảm ơn bạn đã quan tâm!</p>
                    </div>
                    <div class="footer">
                        <p>Bạn nhận được email này vì đã đăng ký nhận thông báo sản phẩm mới từ %s</p>
                        <p><a href="%s?unsubscribe=%s">Hủy đăng ký</a></p>
                    </div>
                </div>
            </body>
            </html>',
            $site_name,
            $product_image ? '<img src="' . esc_url($product_image) . '" alt="' . esc_attr($product_name) . '" class="product-image">' : '',
            esc_html($product_name),
            $product_price,
            esc_url($product_url),
            $site_name,
            home_url(),
            base64_encode($email)
        );

        $headers = array('Content-Type: text/html; charset=UTF-8');

        if (wp_mail($email, $subject, $html_message, $headers)) {
            $sent_count++;
        }
    }

    // Đánh dấu đã gửi thông báo
    update_post_meta($post_id, '_new_product_notified', '1');
    update_post_meta($post_id, '_notification_sent_count', $sent_count);
}
// Hook khi sản phẩm được publish lần đầu
add_action('transition_post_status', function ($new_status, $old_status, $post) {
    if ($new_status === 'publish' && $old_status !== 'publish' && $post->post_type === 'product') {
        shopcar_notify_new_product($post->ID);
    }
}, 10, 3);

// Admin menu để quản lý email subscriptions
function shopcar_add_email_subscription_admin_menu()
{
    add_submenu_page(
        'edit.php?post_type=email_subscription',
        'Quản lý Email Đăng ký',
        'Quản lý Email',
        'manage_options',
        'shopcar-email-subscriptions',
        'shopcar_email_subscriptions_admin_page'
    );
}
add_action('admin_menu', 'shopcar_add_email_subscription_admin_menu');

// Shortcode để hiển thị form đăng ký email
function shopcar_email_subscription_shortcode($atts)
{
    ob_start();
    include get_template_directory() . '/templates/email-subscription-form.php';
    return ob_get_clean();
}
add_shortcode('shopcar_email_subscription', 'shopcar_email_subscription_shortcode');

// Xử lý unsubscribe từ email link
add_action('init', function () {
    if (isset($_GET['unsubscribe']) && !empty($_GET['unsubscribe'])) {
        $email_encoded = sanitize_text_field($_GET['unsubscribe']);
        $email = base64_decode($email_encoded);

        if (is_email($email)) {
            $subscriptions = get_posts(array(
                'post_type' => 'email_subscription',
                'meta_query' => array(
                    array(
                        'key' => '_email_address',
                        'value' => $email,
                        'compare' => '='
                    )
                ),
                'posts_per_page' => 1
            ));

            if (!empty($subscriptions)) {
                update_post_meta($subscriptions[0]->ID, '_is_active', '0');
                $unsubscribed = true;
            } else {
                $unsubscribed = false;
            }

            // Hiển thị trang thông báo
            get_header();
    ?>
            <div class="container mt-5 mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card" style="padding: 30px; text-align: center;">
                            <?php if ($unsubscribed): ?>
                                <div class="alert alert-success">
                                    <h3>Đã hủy đăng ký thành công!</h3>
                                    <p>Email <strong><?php echo esc_html($email); ?></strong> đã được hủy đăng ký nhận thông báo sản phẩm mới.</p>
                                    <p>Bạn sẽ không còn nhận được email thông báo từ chúng tôi nữa.</p>
                                </div>
                            <?php else: ?>
                                <div class="alert alert-warning">
                                    <h3>Không tìm thấy email đăng ký</h3>
                                    <p>Email này không có trong danh sách đăng ký của chúng tôi.</p>
                                </div>
                            <?php endif; ?>
                            <p><a href="<?php echo home_url(); ?>" class="btn btn-primary">Về trang chủ</a></p>
                        </div>
                    </div>
                </div>
            </div>
    <?php
            get_footer();
            exit;
        }
    }
});

// Enqueue script cho form subscription
function shopcar_enqueue_subscription_scripts()
{
    if (is_singular() || is_home() || is_front_page()) {
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'shopcar_enqueue_subscription_scripts');

function shopcar_email_subscriptions_admin_page()
{
    // Xử lý unsubscribe
    if (isset($_GET['unsubscribe']) && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'unsubscribe_email')) {
        $email = sanitize_email($_GET['unsubscribe']);
        $subscriptions = get_posts(array(
            'post_type' => 'email_subscription',
            'meta_query' => array(
                array(
                    'key' => '_email_address',
                    'value' => $email,
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        ));

        if (!empty($subscriptions)) {
            update_post_meta($subscriptions[0]->ID, '_is_active', '0');
            echo '<div class="notice notice-success"><p>Đã hủy đăng ký thành công!</p></div>';
        }
    }

    // Xử lý activate lại
    if (isset($_GET['activate']) && isset($_GET['_wpnonce']) && wp_verify_nonce($_GET['_wpnonce'], 'activate_email')) {
        $email = sanitize_email($_GET['activate']);
        $subscriptions = get_posts(array(
            'post_type' => 'email_subscription',
            'meta_query' => array(
                array(
                    'key' => '_email_address',
                    'value' => $email,
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1
        ));

        if (!empty($subscriptions)) {
            update_post_meta($subscriptions[0]->ID, '_is_active', '1');
            echo '<div class="notice notice-success"><p>Đã kích hoạt lại đăng ký thành công!</p></div>';
        }
    }

    // Lấy danh sách subscriptions
    $subscriptions = get_posts(array(
        'post_type' => 'email_subscription',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    ));

    ?>
    <div class="wrap">
        <h1>Quản lý Email Đăng ký Sản phẩm Mới</h1>

        <div class="tablenav top">
            <div class="alignleft actions">
                <p>Tổng số email đăng ký: <strong><?php echo count($subscriptions); ?></strong></p>
            </div>
        </div>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Ngày đăng ký</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($subscriptions)): ?>
                    <tr>
                        <td colspan="4">Chưa có email nào đăng ký.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($subscriptions as $sub):
                        $email = get_post_meta($sub->ID, '_email_address', true);
                        $date = get_post_meta($sub->ID, '_subscription_date', true);
                        $is_active = get_post_meta($sub->ID, '_is_active', true);
                    ?>
                        <tr>
                            <td><?php echo esc_html($email); ?></td>
                            <td><?php echo $date ? date('d/m/Y H:i', strtotime($date)) : 'N/A'; ?></td>
                            <td>
                                <?php if ($is_active === '1'): ?>
                                    <span style="color: green;">✓ Đang hoạt động</span>
                                <?php else: ?>
                                    <span style="color: red;">✗ Đã hủy</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($is_active === '1'): ?>
                                    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=shopcar-email-subscriptions&unsubscribe=' . urlencode($email)), 'unsubscribe_email'); ?>"
                                        onclick="return confirm('Bạn có chắc muốn hủy đăng ký email này?');">
                                        Hủy đăng ký
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=shopcar-email-subscriptions&activate=' . urlencode($email)), 'activate_email'); ?>">
                                        Kích hoạt lại
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php
}


/* ============================================
 * 🔍 HÀM SEARCH SẢN PHẨM THEO TÊN XE – HÃNG – GIÁ
 * ============================================ */
function shopcar_custom_product_search($query)
{

    // Chỉ chạy ở trang search frontend
    if (! is_admin() && $query->is_main_query() && $query->is_search()) {

        $keyword = $query->get('s'); // từ khóa người dùng nhập
        if (empty($keyword)) return;

        // Reset kết quả search mặc định của WordPress
        $query->set('post_type', 'product');

        // === TÌM THEO GIÁ (Nếu nhập số) ===
        if (is_numeric($keyword)) {

            $query->set('meta_query', [
                [
                    'key'     => '_price',
                    'value'   => (int)$keyword,
                    'compare' => '<=',
                    'type'    => 'NUMERIC'
                ]
            ]);

            return;
        }

        // === TÌM THEO TÊN XE HOẶC HÃNG (category) ===
        $query->set('tax_query', [
            'relation' => 'OR',
            [
                'taxonomy' => 'product_cat',
                'field'    => 'name',
                'terms'    => $keyword,
                'operator' => 'LIKE',
            ]
        ]);
    }
}

add_action('pre_get_posts', 'shopcar_custom_product_search');


/* ============================================================
 * 📝 hàm comment item – ShopCar
 * Cho phép bình luận sản phẩm như bài viết bình thường
 * ============================================================ */

// 1) Bật comment cho sản phẩm WooCommerce
add_filter('woocommerce_product_tabs', function ($tabs) {
    unset($tabs['reviews']); // bỏ tab review mặc định
    return $tabs;
});

add_action('init', function () {
    add_post_type_support('product', 'comments');
});

// 2) Xử lý gửi bình luận (cả khách và user)
add_action('wp_ajax_shopcar_add_comment', 'shopcar_add_comment');
add_action('wp_ajax_nopriv_shopcar_add_comment', 'shopcar_add_comment');

function shopcar_add_comment()
{

    $product_id = intval($_POST['product_id']);
    $author     = sanitize_text_field($_POST['author']);
    $email      = sanitize_email($_POST['email']);
    $content    = sanitize_textarea_field($_POST['content']);

    if (!$product_id || empty($content)) {
        wp_send_json_error("Bạn phải nhập nội dung bình luận.");
    }

    // Nếu user đã đăng nhập → tự lấy tên + email
    if (is_user_logged_in()) {
        $user      = wp_get_current_user();
        $author    = $user->display_name;
        $email     = $user->user_email;
        $user_id   = $user->ID;
    } else {
        $user_id = 0;
    }

    // Lưu vào wp_comments
    $comment_id = wp_insert_comment([
        'comment_post_ID' => $product_id,
        'comment_author'  => $author,
        'comment_author_email' => $email,
        'comment_content' => $content,
        'user_id'         => $user_id,
        'comment_approved' => 1,
        'comment_date'     => current_time('mysql'),
        'comment_date_gmt' => current_time('mysql', 1),
    ]);

    if ($comment_id) {
        wp_send_json_success("Đã gửi bình luận!");
    }

    wp_send_json_error("Gửi bình luận thất bại!");
}


// 3) Hàm xóa bình luận (chỉ người tạo hoặc admin)
add_action('wp_ajax_shopcar_delete_comment', 'shopcar_delete_comment');
add_action('wp_ajax_nopriv_shopcar_delete_comment', 'shopcar_delete_comment');

function shopcar_delete_comment()
{

    $comment_id = intval($_POST['comment_id']);
    $comment = get_comment($comment_id);

    if (!$comment) wp_send_json_error("Không tìm thấy bình luận!");

    // Người tạo bình luận hoặc admin mới được xóa
    if (
        (is_user_logged_in() && get_current_user_id() == $comment->user_id)
        || current_user_can('administrator')
    ) {
        wp_delete_comment($comment_id, true);
        wp_send_json_success("Đã xóa bình luận!");
    }

    wp_send_json_error("Bạn không có quyền xóa bình luận này!");
}


// 4) Gửi AJAX URL xuống frontend
add_action('wp_enqueue_scripts', function () {
    wp_localize_script('shopcar-main', 'ShopCarAjax', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
});



/* ============================================================
 * 🟦 HÀM PLACE ORDER — Xử lý khi người dùng bấm nút Place Order
 * - Xóa cart cũ
 * - Thêm đúng sản phẩm vào cart
 * - Chuyển sang trang Checkout
 * ============================================================ */
add_action('init', function () {

    if (!isset($_GET['place_order_product'])) return;

    $product_id = intval($_GET['place_order_product']);
    if ($product_id <= 0) return;

    // XÓA GIỎ HÀNG CŨ
    WC()->cart->empty_cart();

    // THÊM SẢN PHẨM ĐANG ĐẶT VÀO CART
    WC()->cart->add_to_cart($product_id, 1);

    // REDIRECT → CHECKOUT
    wp_safe_redirect(wc_get_checkout_url());
    exit;
});


/* ============================================================
 * 🟥 HÀM CANCEL ORDER — Hủy đơn hàng (User/Admin)
 * - Sử dụng URL: /my-account/?cancel_order=ORDER_ID
 * ============================================================ */
add_action('init', function () {

    if (!isset($_GET['cancel_order'])) return;

    $order_id = intval($_GET['cancel_order']);
    if ($order_id <= 0) return;

    $order = wc_get_order($order_id);
    if (!$order) return;

    // Kiểm tra quyền user có được hủy đơn không
    if ($order->get_user_id() != get_current_user_id() && !current_user_can('administrator')) {
        return; // Không có quyền
    }

    // Chỉ cho phép hủy nếu đơn đang pending hoặc on-hold
    if (!in_array($order->get_status(), ['pending', 'on-hold'])) {
        return;
    }

    // Hủy đơn
    $order->update_status('cancelled', 'Order cancelled by user/admin.');

    // Redirect về My Account
    wp_safe_redirect(wc_get_page_permalink('myaccount'));
    exit;
});



/* ============================================================
 * 🟩 PAYMENT GATEWAY ẢO – Fake Payment
 * ============================================================ */
add_action('plugins_loaded', 'shopcar_load_fake_gateway');

function shopcar_load_fake_gateway()
{

    if (!class_exists('WC_Payment_Gateway')) return;

    class WC_Gateway_Fake extends WC_Payment_Gateway
    {

        public function __construct()
        {
            $this->id                 = 'fake_payment';
            $this->method_title       = 'Thanh toán khi đặt xe (Fake)';
            $this->method_description = 'Phương thức thanh toán ảo dành cho website bán xe.';
            $this->title              = 'Thanh toán khi đặt xe';
            $this->enabled            = 'yes';
            $this->has_fields         = false;
        }

        public function process_payment($order_id)
        {

            $order = wc_get_order($order_id);

            // Set trạng thái đơn hàng thành "processing"
            $order->update_status('pending', 'Fake payment completed.');

            // Clear cart
            WC()->cart->empty_cart();

            // Redirect to Order Received
            return array(
                'result'   => 'success',
                'redirect' => $this->get_return_url($order)
            );
        }
    }
}

add_filter('woocommerce_payment_gateways', function ($methods) {
    $methods[] = 'WC_Gateway_Fake';
    return $methods;
});

add_filter('woocommerce_cod_process_payment_order_status', function ($status, $order) {
    return 'pending'; // ép COD luôn ở trạng thái Pending
}, 10, 2);

function order_tracking_form()
{
    ob_start();
?>

    <form method="post">
        <label>Mã đơn hàng:</label>
        <input type="text" name="order_id" required>

        <label>Email hoặc SĐT:</label>
        <input type="text" name="order_email" required>

        <button type="submit">Tra cứu</button>
    </form>

    <?php
    if ($_POST) {
        $order_id = sanitize_text_field($_POST['order_id']);
        $email = sanitize_text_field($_POST['order_email']);

        $order = wc_get_order($order_id);

        if ($order) {
            $billing_email = $order->get_billing_email();
            $billing_phone = $order->get_billing_phone();

            if ($email === $billing_email || $email === $billing_phone) {
                echo "<p>Trạng thái đơn hàng: " . wc_get_order_status_name($order->get_status()) . "</p>";
            } else {
                echo "<p style='color:red;'>Email/SĐT không đúng.</p>";
            }
        } else {
            echo "<p style='color:red;'>Không tìm thấy đơn hàng.</p>";
        }
    }

    return ob_get_clean();
}
add_shortcode('order_tracking', 'order_tracking_form');
function shopee_coupon_box()
{
    ob_start();
    ?>

    <style>
        .shopee-voucher-box {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin: 25px 0;
        }

        .shopee-voucher-title {
            font-size: 20px;
            font-weight: 600;
            color: #ee4d2d;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .shopee-input-voucher {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 15px;
        }

        .shopee-apply-btn {
            background: #ee4d2d;
            color: #fff;
            border: none;
            padding: 12px 18px;
            border-radius: 8px;
            margin-top: 10px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .shopee-apply-btn:hover {
            background: #d84325;
        }

        .shopee-result-box {
            margin-top: 15px;
            padding: 12px;
            background: #fff6f5;
            border-left: 4px solid #ee4d2d;
            border-radius: 8px;
        }

        .shopee-voucher-list {
            margin-top: 20px;
        }

        .shopee-voucher-item {
            display: flex;
            background: #fff7f5;
            border-left: 4px solid #ee4d2d;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
            justify-content: space-between;
            align-items: center;
        }

        .shopee-voucher-item .left {
            font-weight: 600;
        }

        .shopee-voucher-item .right button {
            background: #ee4d2d;
            border: none;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
        }
    </style>

    <div class="shopee-voucher-box">
        <div class="shopee-voucher-title">🎁 Mã giảm giá</div>

        <form method="post">
            <input type="text" name="voucher" class="shopee-input-voucher" placeholder="Nhập mã giảm giá...">
            <button class="shopee-apply-btn">Áp dụng</button>
        </form>

        <?php
        if (!empty($_POST['voucher'])) {
            $code = sanitize_text_field($_POST['voucher']);

            // Lấy coupon WooCommerce
            $coupon = new WC_Coupon($code);

            if ($coupon->get_id()) {
                $discount = $coupon->get_amount();
                $type = $coupon->get_discount_type();

                $type_label = ($type === 'percent') ? "% giảm" : "₫ giảm";

                echo "<div class='shopee-result-box'>
                    🎉 Mã hợp lệ: <strong>$code</strong><br>
                    Giảm: <strong>$discount$type_label</strong>
                  </div>";
            } else {
                echo "<div class='shopee-result-box' style='border-left-color:red;'>
                    ❌ Mã không hợp lệ hoặc đã hết hạn!
                  </div>";
            }
        }
        ?>

        <!-- Gợi ý voucher -->
        <div class="shopee-voucher-list">
            <h4>Voucher dành cho bạn:</h4>

            <div class="shopee-voucher-item">
                <div class="left">GIAM10K</div>
                <div class="right">
                    <button onclick="copyVoucher('GIAM10K')">Copy</button>
                </div>
            </div>

            <div class="shopee-voucher-item">
                <div class="left">SALE20K</div>
                <div class="right">
                    <button onclick="copyVoucher('SALE20K')">Copy</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyVoucher(code) {
            navigator.clipboard.writeText(code);
            alert("Đã copy mã: " + code);
        }
    </script>

<?php
    return ob_get_clean();
}
add_shortcode('shopee-voucher', 'shopee_coupon_box');
// Hiển thị giao diện Voucher kiểu Shopee trong Order Details
// Hiển thị form voucher trong trang order
add_action('woocommerce_order_details_after_order_table', 'order_voucher_form');
function order_voucher_form($order)
{
?>
    <div id="voucher-box" style="margin-top:20px;padding:15px;border:1px solid #ddd;border-radius:10px;">
        <h3>🎁 Nhập mã giảm giá</h3>
        <input type="text" id="voucher_code" placeholder="Nhập mã voucher...">
        <button type="button" id="apply_voucher">Áp dụng</button>
        <div id="voucher_result" style="margin-top:10px;"></div>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#apply_voucher').on('click', function() {
                var code = $('#voucher_code').val();
                var order_id = <?php echo $order->get_id(); ?>;

                $.post('<?php echo admin_url("admin-ajax.php"); ?>', {
                    action: 'apply_order_voucher',
                    code: code,
                    order_id: order_id,
                }, function(response) {
                    $('#voucher_result').html(response);
                    location.reload(); // reload để cập nhật tổng tiền
                });
            });
        });
    </script>
<?php
}

// AJAX xử lý voucher
add_action('wp_ajax_apply_order_voucher', 'apply_order_voucher');
add_action('wp_ajax_nopriv_apply_order_voucher', 'apply_order_voucher');

function apply_order_voucher()
{
    if (!isset($_POST['code']) || !isset($_POST['order_id'])) wp_die();

    $order_id = intval($_POST['order_id']);
    $code     = sanitize_text_field($_POST['code']);

    $order = wc_get_order($order_id);
    if (!$order) wp_die('Order không tồn tại');

    // Tránh áp dụng nhiều lần
    if ($order->get_meta('voucher_applied')) wp_die('Bạn đã áp voucher trước đó!');

    $coupon = new WC_Coupon($code);
    if (!$coupon->get_id()) wp_die('Mã giảm giá không hợp lệ!');

    // Tính giá trị giảm
    $amount = $coupon->get_amount();
    $type   = $coupon->get_discount_type();

    if ($type == 'percent') $discount = ($order->get_subtotal() * $amount) / 100;
    else $discount = floatval($amount);

    $discount = min($discount, $order->get_total());

    // Thêm fee âm để trừ tiền
    $item = new WC_Order_Item_Fee();
    $item->set_name('Mã giảm giá: ' . $code);
    $item->set_total(-$discount);
    $order->add_item($item);

    $order->calculate_totals();
    $order->update_meta_data('voucher_applied', 1);
    $order->save();

    echo '🎉 Mã hợp lệ! Giảm: ' . $discount;
    wp_die();
}
