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

/* ======================================================
   SHORTCODE FORM ĐĂNG KÝ
====================================================== */
function shopcar_register_form()
{
    if (is_user_logged_in()) {
        return "<p>Bạn đã đăng nhập rồi!</p>";
    }

    ob_start();
    ?>

    <form method="POST" class="shopcar-register">
        <p>
            <label>Username</label><br>
            <input type="text" name="reg_username" required>
        </p>
        <p>
            <label>Email</label><br>
            <input type="email" name="reg_email" required>
        </p>
        <p>
            <label>Mật khẩu</label><br>
            <input type="password" name="reg_password" required>
        </p>

        <button type="submit" name="shopcar_register_btn">Đăng ký</button>
    </form>

    <?php
    return ob_get_clean();
}
add_shortcode('shopcar_register', 'shopcar_register_form');


/* ======================================================
   XỬ LÝ ĐĂNG KÝ
====================================================== */
function shopcar_handle_register()
{
    if (isset($_POST['shopcar_register_btn'])) {

        $username = sanitize_user($_POST['reg_username']);
        $email = sanitize_email($_POST['reg_email']);
        $password = sanitize_text_field($_POST['reg_password']);

        $errors = new WP_Error();

        if (username_exists($username)) {
            $errors->add('username', 'Tên đăng nhập đã tồn tại!');
        }

        if (email_exists($email)) {
            $errors->add('email', 'Email đã tồn tại!');
        }

        if (empty($password)) {
            $errors->add('password', 'Mật khẩu không được để trống!');
        }

        if (!empty($errors->errors)) {
            foreach ($errors->errors as $err) {
                echo '<p style="color:red;">' . $err[0] . '</p>';
            }
            return;
        }

        // Tạo user
        wp_create_user($username, $password, $email);

        echo '<p style="color:green;">Đăng ký thành công! Bạn có thể đăng nhập.</p>';
    }
}
add_action('init', 'shopcar_handle_register');



/* ======================================================
   SHORTCODE FORM ĐĂNG NHẬP
====================================================== */
function shopcar_handle_signup() {

    if ( isset($_POST['signup_submit']) ) {

        $username = sanitize_user($_POST['username']);
        $email    = sanitize_email($_POST['email']);
        $password = sanitize_text_field($_POST['password']);

        $errors = new WP_Error();

        // Kiểm tra trống
        if ( empty($username) || empty($email) || empty($password) ) {
            $errors->add('empty', 'Vui lòng nhập đầy đủ thông tin!');
        }

        // Kiểm tra email hợp lệ
        if ( !is_email($email) ) {
            $errors->add('email', 'Email không hợp lệ!');
        }

        // Username hoặc email đã tồn tại
        if ( username_exists($username) ) {
            $errors->add('user_exists', 'Username đã tồn tại!');
        }
        if ( email_exists($email) ) {
            $errors->add('email_exists', 'Email đã tồn tại!');
        }

        // Nếu có lỗi → đẩy vào biến global để hiển thị
        if ( ! empty($errors->errors) ) {
            $GLOBALS['shopcar_signup_error'] = $errors;
            return;
        }

        // Tạo user
        $user_id = wp_create_user($username, $password, $email);

        if ( is_wp_error($user_id) ) {
            $GLOBALS['shopcar_signup_error'] = new WP_Error('create', 'Không thể tạo tài khoản!');
            return;
        }

        // Tự động đăng nhập sau khi đăng ký
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);

        // Redirect về trang chủ hoặc trang bạn muốn
        wp_redirect(home_url());
        exit;
    }
}
add_action('init', 'shopcar_handle_signup');



/* ======================================================
   XỬ LÝ ĐĂNG NHẬP
====================================================== */
function shopcar_handle_login_page()
{
    if (isset($_POST['shopcar_login_submit'])) {

        $email_or_user = sanitize_text_field($_POST['email']);
        $password = sanitize_text_field($_POST['password']);

        // Cho phép nhập Email hoặc Username
        if (is_email($email_or_user)) {
            $user_obj = get_user_by('email', $email_or_user);
            $username = $user_obj ? $user_obj->user_login : $email_or_user;
        } else {
            $username = $email_or_user;
        }

        $credentials = [
            'user_login' => $username,
            'user_password' => $password,
            'remember' => true
        ];

        $login = wp_signon($credentials, false);

        if (is_wp_error($login)) {
            $GLOBALS['shopcar_login_error'] = "Email hoặc mật khẩu không đúng!";
        } else {
            wp_redirect(home_url());
            exit;
        }
    }
}
add_action('init', 'shopcar_handle_login_page');


