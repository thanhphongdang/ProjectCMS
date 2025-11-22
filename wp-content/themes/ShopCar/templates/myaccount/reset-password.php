<?php
defined('ABSPATH') || exit;
get_header();
?>

<main class="main-wrapper">
    <div class="container mt--80 mb--80" style="max-width: 520px">a

        <h2 class="text-center mb--20" style="font-weight:700;">ĐỔI MẬT KHẨU</h2>

        <div class="p-4" style="background:#fff;border-radius:12px; border:1px solid #000;">

            <?php wc_print_notices(); ?>

            <form method="post" class="woocommerce-ResetPassword" style="margin-top:20px;">

                <p>
                    <label>Mật khẩu hiện tại *</label>
                    <input type="password" name="current_pass"
                           style="width:100%;padding:10px;border:1px solid #000;border-radius:6px;background:#fff;color:#000;">
                </p>

                <p>
                    <label>Mật khẩu mới *</label>
                    <input type="password" name="new_pass"
                           style="width:100%;padding:10px;border:1px solid #000;border-radius:6px;background:#fff;color:#000;">
                </p>

                <p>
                    <label>Xác nhận mật khẩu mới *</label>
                    <input type="password" name="confirm_pass"
                           style="width:100%;padding:10px;border:1px solid #000;border-radius:6px;background:#fff;color:#000;">
                </p>

                <?php wp_nonce_field('save_new_password', 'password_nonce'); ?>

                <button type="submit"
                        style="width:100%;padding:12px;border:none;background:#000;color:#fff;border-radius:6px;margin-top:10px;">
                    Lưu mật khẩu
                </button>

            </form>

        </div>
    </div>
</main>

<?php get_footer(); ?>
