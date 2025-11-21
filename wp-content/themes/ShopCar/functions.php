<?php
/**
 * ShopCar Theme setup and assets enqueue
 */

if ( ! defined( 'CAR_THEME_VERSION' ) ) {
    define( 'CAR_THEME_VERSION', '1.0.0' );
}

function shopcar_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'shopcar_add_woocommerce_support' );


// === Theme Supports ===
add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('woocommerce');

    register_nav_menus([
        'primary' => __('Primary Menu', 'ShopCar'),
        'footer'  => __('Footer Menu', 'ShopCar'),
    ]);
});


// === Enqueue Scripts & Styles (GỘP LẠI 1 HÀM) ===
add_action('wp_enqueue_scripts', function() {

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
function ShopCar_menu($location = 'primary') {
    if ( has_nav_menu($location) ) {
        wp_nav_menu([
            'theme_location' => $location,
            'container'      => false,
            'menu_class'     => 'menu ' . $location,
            'fallback_cb'    => false,
        ]);
    } else {
        echo '<ul class="menu placeholder"><li><a href="'.esc_url(home_url('/')).'">Home</a></li></ul>';
    }
}

add_action('widgets_init', function() {
    register_sidebar([
        'name' => 'Blog Sidebar',
        'id'   => 'blog-sidebar',
        'before_widget' => '<div class="axil-single-widget mt--40">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="widget-title">',
        'after_title'   => '</h6>',
    ]);
});

//myaccount
add_filter('page_template', function($template) {
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

// Redirect sau khi logout về /login
add_filter('woocommerce_logout_redirect', function($redirect_url){
    return home_url('/login');
});


// bui-tham-ky1-view-count
/**
 * === WooCommerce Product View Counter ===
 */
function shopcar_track_product_views() {
    if ( is_admin() && ! wp_doing_ajax() ) {
        return;
    }

    if ( ! is_product() ) {
        return;
    }

    $product_id = get_queried_object_id();

    if ( ! $product_id ) {
        return;
    }

    $current_views = (int) get_post_meta( $product_id, '_view_count', true );
    $new_views     = $current_views + 1;

    update_post_meta( $product_id, '_view_count', $new_views );
}
add_action( 'template_redirect', 'shopcar_track_product_views' );


function shopcar_append_view_count_to_price( $price_html, $product ) {
    if ( ! is_product() ) {
        return $price_html;
    }

    if ( empty( $product ) || ! $product instanceof WC_Product ) {
        return $price_html;
    }

    $views      = (int) get_post_meta( $product->get_id(), '_view_count', true );
    $view_block = sprintf(
        '<div class="shopcar-product-view-meta"><span class="view-icon" aria-hidden="true">👁</span><span class="view-label">%s</span><span class="view-count">%s</span></div>',
        esc_html__( 'Số lượt xem:', 'shopcar' ),
        esc_html( number_format_i18n( $views ) )
    );

    return $price_html . $view_block;
}
add_filter( 'woocommerce_get_price_html', 'shopcar_append_view_count_to_price', 20, 2 );


function shopcar_product_view_styles() {
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

    wp_add_inline_style( 'shopcar-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'shopcar_product_view_styles', 20 );
// End bui-tham-ky1-view-count