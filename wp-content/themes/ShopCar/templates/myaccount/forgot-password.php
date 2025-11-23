<?php
defined('ABSPATH') || exit;

get_header();

/**
 * HANDLE FORGOT PASSWORD REQUEST
 */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['shopcar_forgot_nonce']) &&
    wp_verify_nonce($_POST['shopcar_forgot_nonce'], 'shopcar_forgot')
) {
    $user_login = isset($_POST['user_login']) ? sanitize_text_field($_POST['user_login']) : '';

    if (empty($user_login)) {
        wc_add_notice('Vui lòng nhập email để đặt lại mật khẩu.', 'error');

    } elseif (!is_email($user_login)) {
        wc_add_notice('Email không hợp lệ.', 'error');

    } elseif (!email_exists($user_login)) {
        wc_add_notice('Email không tồn tại trong hệ thống!', 'error');

    } else {
        // Gửi email reset mật khẩu
        $result = retrieve_password($user_login);

        if ($result === true) {
            wc_add_notice('Email đặt lại mật khẩu đã được gửi. Vui lòng kiểm tra hộp thư.', 'success');
        } else {
            wc_add_notice('Không thể gửi email. Vui lòng thử lại!', 'error');
        }
    }
}
?>

<main class="main-wrapper">
    <div class="container mt--80 mb--80" style="max-width: 520px">

        <div class="axil-auth-wrapper">

            <h2 class="title mb--20 text-center">Quên mật khẩu</h2>

            <div class="axil-auth-card axil-single-widget p-4" style="background:#fff;border-radius:12px;">
                <?php wc_print_notices(); ?>

                <form method="post" class="woocommerce-form woocommerce-form-lost-password">

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="user_login">Nhập email của bạn <span class="required">*</span></label>
                        <input type="email"
                               name="user_login"
                               id="user_login"
                               autocomplete="email"
                               class="input-text"
                               required
                               value="<?php echo isset($_POST['user_login']) ? esc_attr($_POST['user_login']) : ''; ?>">
                    </p>

                    <?php wp_nonce_field('shopcar_forgot', 'shopcar_forgot_nonce'); ?>

                    <p class="form-row mt--10">
                        <button type="submit"
                                class="axil-btn btn-primary w-100">
                            Gửi yêu cầu đặt lại mật khẩu
                        </button>
                    </p>

                    <p class="mt--10 text-center">
                        <a href="<?php echo site_url('/login'); ?>">Quay lại đăng nhập</a>
                    </p>

                </form>

            </div>

        </div>
    </div>
</main>

<?php get_footer(); ?>
