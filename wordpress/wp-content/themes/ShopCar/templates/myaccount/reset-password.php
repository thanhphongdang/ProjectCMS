<?php
defined('ABSPATH') || exit;

get_header();

/**
 * Lấy key và user_login từ URL
 */
$rp_key   = isset($_GET['key']) ? sanitize_text_field($_GET['key']) : '';
$rp_login = isset($_GET['login']) ? sanitize_text_field($_GET['login']) : '';

/**
 * Kiểm tra hợp lệ key reset password
 */
$validate = check_password_reset_key($rp_key, $rp_login);

if (is_wp_error($validate)) {
    wc_add_notice('Link đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.', 'error');
    $rp_key = $rp_login = '';
}

/**
 * HANDLE RESET PASSWORD FORM SUBMISSION
 */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['shopcar_reset_nonce']) &&
    wp_verify_nonce($_POST['shopcar_reset_nonce'], 'shopcar_reset')
) {
    $password1 = isset($_POST['password_1']) ? (string) $_POST['password_1'] : '';
    $password2 = isset($_POST['password_2']) ? (string) $_POST['password_2'] : '';
    $reset_key = isset($_POST['reset_key']) ? sanitize_text_field($_POST['reset_key']) : '';
    $reset_login = isset($_POST['reset_login']) ? sanitize_text_field($_POST['reset_login']) : '';

    $user = check_password_reset_key($reset_key, $reset_login);

    // Validate form
    if (is_wp_error($user)) {
        wc_add_notice('Link đặt lại mật khẩu không chính xác hoặc đã hết hạn.', 'error');

    } elseif (empty($password1) || empty($password2)) {
        wc_add_notice('Vui lòng nhập đủ cả hai mật khẩu.', 'error');

    } elseif ($password1 !== $password2) {
        wc_add_notice('Mật khẩu xác nhận không khớp.', 'error');

    } elseif (strlen($password1) < 6) {
        wc_add_notice('Mật khẩu phải có ít nhất 6 ký tự.', 'error');

    } else {
        // Đặt mật khẩu mới
        reset_password($user, $password1);

        wc_add_notice('Đổi mật khẩu thành công! Hãy đăng nhập.', 'success');

        // Redirect sau 2 giây
        wp_safe_redirect(site_url('/login'));
        exit;
    }
}
?>

<main class="main-wrapper">
    <div class="container mt--80 mb--80" style="max-width: 520px">

        <h2 class="title mb--20 text-center">Đặt lại mật khẩu</h2>

        <div class="axil-auth-card axil-single-widget p-4" style="background:#fff;border-radius:12px;">
            
            <?php wc_print_notices(); ?>

            <?php if (!empty($rp_key) && !empty($rp_login)) : ?>

                <form method="post" class="woocommerce-ResetPassword woocommerce-form reset_password">

                    <input type="hidden" name="reset_key" value="<?php echo esc_attr($rp_key); ?>">
                    <input type="hidden" name="reset_login" value="<?php echo esc_attr($rp_login); ?>">

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password_1">Mật khẩu mới <span class="required">*</span></label>
                        <input type="password"
                               name="password_1"
                               id="password_1"
                               class="input-text"
                               autocomplete="new-password"
                               required>
                    </p>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password_2">Xác nhận mật khẩu <span class="required">*</span></label>
                        <input type="password"
                               name="password_2"
                               id="password_2"
                               class="input-text"
                               autocomplete="new-password"
                               required>
                    </p>

                    <?php wp_nonce_field('shopcar_reset', 'shopcar_reset_nonce'); ?>

                    <p class="form-row mt--10">
                        <button type="submit"
                                class="axil-btn btn-primary w-100">
                            Đổi mật khẩu
                        </button>
                    </p>
                </form>

            <?php else : ?>
                <p class="text-center">Link đặt lại mật khẩu đã hết hạn hoặc không hợp lệ.</p>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php get_footer(); ?>
