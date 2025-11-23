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

    register_nav_menus([
        'primary' => __('Primary Menu', 'ShopCar'),
        'footer' => __('Footer Menu', 'ShopCar'),
    ]);
});


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
add_filter('wp_mail_content_type', function () {
    return "text/html";
});
// End bui-tham-ky/4-forget-password



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
        'timestamp' => current_time('mysql')
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
