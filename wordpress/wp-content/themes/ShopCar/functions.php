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

/* ============================================
 * 🔍 HÀM SEARCH SẢN PHẨM THEO TÊN XE – HÃNG – GIÁ
 * ============================================ */
function shopcar_custom_product_search( $query ) {

    // Chỉ chạy ở trang search frontend
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {

        $keyword = $query->get('s'); // từ khóa người dùng nhập
        if ( empty($keyword) ) return;

        // Reset kết quả search mặc định của WordPress
        $query->set('post_type', 'product');

        // === TÌM THEO GIÁ (Nếu nhập số) ===
        if ( is_numeric($keyword) ) {

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

add_action( 'pre_get_posts', 'shopcar_custom_product_search' );


/* ============================================================
 * 📝 hàm comment item – ShopCar
 * Cho phép bình luận sản phẩm như bài viết bình thường
 * ============================================================ */

// 1) Bật comment cho sản phẩm WooCommerce
add_filter('woocommerce_product_tabs', function($tabs) {
    unset($tabs['reviews']); // bỏ tab review mặc định
    return $tabs;
});

add_action('init', function() {
    add_post_type_support('product', 'comments');
});

// 2) Xử lý gửi bình luận (cả khách và user)
add_action('wp_ajax_shopcar_add_comment', 'shopcar_add_comment');
add_action('wp_ajax_nopriv_shopcar_add_comment', 'shopcar_add_comment');

function shopcar_add_comment() {

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

function shopcar_delete_comment() {

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
add_action('wp_enqueue_scripts', function() {
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

function shopcar_load_fake_gateway() {

    if (!class_exists('WC_Payment_Gateway')) return;

    class WC_Gateway_Fake extends WC_Payment_Gateway {

        public function __construct() {
            $this->id                 = 'fake_payment';
            $this->method_title       = 'Thanh toán khi đặt xe (Fake)';
            $this->method_description = 'Phương thức thanh toán ảo dành cho website bán xe.';
            $this->title              = 'Thanh toán khi đặt xe';
            $this->enabled            = 'yes';
            $this->has_fields         = false;
        }

        public function process_payment($order_id) {

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

add_filter('woocommerce_payment_gateways', function($methods) {
    $methods[] = 'WC_Gateway_Fake';
    return $methods;
});

add_filter('woocommerce_cod_process_payment_order_status', function($status, $order) {
    return 'pending'; // ép COD luôn ở trạng thái Pending
}, 10, 2);