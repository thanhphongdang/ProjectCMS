<?php
defined('ABSPATH') || exit;

get_header();

/**
 * XỬ LÝ SUBMIT FORM ĐĂNG KÝ
 */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['shopcar_register_nonce']) &&
    wp_verify_nonce($_POST['shopcar_register_nonce'], 'shopcar_register')
) {
    $email            = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $password         = isset($_POST['password']) ? (string) $_POST['password'] : '';
    $password_confirm = isset($_POST['password_confirm']) ? (string) $_POST['password_confirm'] : '';

    // Validate cơ bản
    if (empty($email) || empty($password) || empty($password_confirm)) {
        wc_add_notice('Vui lòng nhập đầy đủ Email, Mật khẩu và Xác nhận mật khẩu.', 'error');

    } elseif (!is_email($email)) {
        wc_add_notice('Email không hợp lệ.', 'error');

    } elseif ($password !== $password_confirm) {
        wc_add_notice('Mật khẩu xác nhận không khớp.', 'error');

    } elseif (strlen($password) < 6) {
        wc_add_notice('Mật khẩu phải có ít nhất 6 ký tự.', 'error');

    } elseif (email_exists($email)) {
        wc_add_notice('Email này đã tồn tại. Hãy dùng email khác hoặc đăng nhập.', 'error');

    } else {

        // Dùng phần trước @ làm username
        $username = sanitize_user(current(explode('@', $email)), true);

        // Nếu username đã tồn tại, thêm số random cho chắc
        if (username_exists($username)) {
            $username .= '_' . wp_generate_password(4, false);
        }

        // Tạo customer đúng chuẩn WooCommerce
        $user_id = wc_create_new_customer($email, $username, $password);

        if (is_wp_error($user_id)) {
            wc_add_notice($user_id->get_error_message(), 'error');
        } else {
            wc_add_notice('Tạo tài khoản thành công! Hãy đăng nhập.', 'success');

            // Nếu muốn auto login sau khi đăng ký, bỏ comment 3 dòng dưới:
            // wc_set_customer_auth_cookie($user_id);
            // wp_safe_redirect(home_url('/'));
            // exit;
        }
    }
}
?>

<main class="main-wrapper">
    <div class="container mt--80 mb--80" style="max-width: 520px">

        <div class="axil-auth-wrapper">
            <h2 class="title mb--20 text-center">Đăng ký tài khoản</h2>

            <div class="axil-auth-card axil-single-widget mt--10 p-4" style="background:#fff;border-radius:12px;">
                <?php
                // Hiển thị tất cả thông báo từ wc_add_notice
                wc_print_notices();
                ?>

                <form method="post" class="woocommerce-form woocommerce-form-register">

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email">Email <span class="required">*</span></label>
                        <input type="email"
                               name="email"
                               id="reg_email"
                               class="input-text"
                               autocomplete="email"
                               required
                               value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                    </p>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password">Mật khẩu <span class="required">*</span></label>
                        <input type="password"
                               name="password"
                               id="reg_password"
                               class="input-text"
                               autocomplete="new-password"
                               required>
                    </p>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_password_confirm">Xác nhận mật khẩu <span class="required">*</span></label>
                        <input type="password"
                               name="password_confirm"
                               id="reg_password_confirm"
                               class="input-text"
                               autocomplete="new-password"
                               required>
                    </p>

                    <?php wp_nonce_field('shopcar_register', 'shopcar_register_nonce'); ?>

                    <p class="form-row mt--10">
                        <button type="submit"
                                class="axil-btn btn-primary w-100"
                                name="register"
                                value="1">
                            Đăng ký
                        </button>
                    </p>

                    <p class="mt--10 text-center">
                        Đã có tài khoản?
                        <a href="<?php echo esc_url(site_url('/login')); ?>">Đăng nhập</a>
                    </p>

                </form>
            </div>
        </div>

    </div>
</main>

<?php get_footer(); ?>
