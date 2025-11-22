<?php
ob_start();
defined('ABSPATH') || exit;

get_header();

/**
 * HANDLE LOGIN SUBMISSION
 */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['shopcar_login_nonce']) &&
    wp_verify_nonce($_POST['shopcar_login_nonce'], 'shopcar_login')
) {
    $username = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
    $password = isset($_POST['password']) ? (string) $_POST['password'] : '';

    if (empty($username) || empty($password)) {
        wc_add_notice('Vui lòng nhập đầy đủ Email và Mật khẩu.', 'error');

    } else {

        $login_data = [
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => true,
        ];

        $user = wp_signon($login_data, false);

        if (is_wp_error($user)) {
            wc_add_notice('Email hoặc mật khẩu không đúng!', 'error');
        } else {
            // Đăng nhập thành công -> điều hướng về trang chủ hoặc tài khoản
            wp_safe_redirect(wc_get_page_permalink('/'));
            exit;
        }
    }
}
?>

<main class="main-wrapper">
    <div class="container mt--80 mb--80" style="max-width: 520px">

        <div class="axil-auth-wrapper">
            <h2 class="title mb--20 text-center">Đăng nhập</h2>

            <div class="axil-auth-card axil-single-widget p-4" style="background:#fff;border-radius:12px;">

                <?php wc_print_notices(); ?>

                <form method="post" class="woocommerce-form woocommerce-form-login">

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username">Email <span class="required">*</span></label>
                        <input type="text"
                               name="username"
                               id="username"
                               class="input-text"
                               autocomplete="username"
                               required
                               value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
                    </p>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password">Mật khẩu <span class="required">*</span></label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="input-text"
                               autocomplete="current-password"
                               required>
                    </p>

                    <?php wp_nonce_field('shopcar_login', 'shopcar_login_nonce'); ?>

                    <p class="form-row mt--10">
                        <button type="submit"
                                class="axil-btn btn-primary w-100"
                                name="login"
                                value="1">
                            Đăng nhập
                        </button>
                    </p>

                    <p class="mt--10 text-center">
                        <a href="<?php echo site_url('/forgot-password'); ?>">Quên mật khẩu?</a>
                    </p>

                    <p class="mt--10 text-center">
                        Chưa có tài khoản?
                        <a href="<?php echo site_url('/register'); ?>">Đăng ký</a>
                    </p>

                </form>

            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
