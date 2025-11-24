<?php
/**
 * Template Name: User Reset Password Page
 */
defined('ABSPATH') || exit;
get_header();

$message = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = sanitize_email($_POST['email']);

    // check email
    if (empty($email)) {
        $error = "Hãy nhập Email của bạn.";
    } elseif (!email_exists($email)) {
        $error = "Email không tồn tại trên hệ thống!";
    } else {
        $user = get_user_by('email', $email);

        // tạo mật khẩu ngẫu nhiên
        $new_pass = wp_generate_password(10); 

        // cập nhật mật khẩu cho user
        wp_set_password($new_pass, $user->ID);

        // gửi email cho người dùng
        $subject = "Mật khẩu mới của bạn";
        $body = "Đây là mật khẩu mới của bạn: <strong>$new_pass</strong><br>Vui lòng quay lại trang đăng nhập.";
        $headers = ['Content-Type: text/html; charset=UTF-8'];

        wp_mail($email, $subject, $body, $headers);

        $message = "Mật khẩu mới đã được gửi tới email của bạn.";
    }
}
?>

<style>
.forgot-box {
    max-width: 420px;
    margin: 60px auto;
    padding: 30px;
    border: 2px solid #000;
    border-radius: 6px;
    background: #fff;
}

.forgot-title {
    text-align: center;
    font-size: 28px;
    margin-bottom: 20px;
    font-weight: 800; 
    color: #000;
}

.forgot-box input {
    width: 100%;
    padding: 6px;
    margin-top: 10px;
    border: 1px solid #aaa;
    border-radius: 4px;
    font-size: 15px;
}

.forgot-box button {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.error-text {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}

.success-text {
    color: green;
    text-align: center;
    margin-bottom: 10px;
}

.back-login {
    text-align: center;
    margin-top: 15px;
}

.back-login a {
    color: #007bff;
    text-decoration: underline;
}

.back-login a:hover {
    opacity: 0.8;
}
</style>

<div class="forgot-box">

    <div class="forgot-title">QUÊN MẬT KHẨU</div>

    <?php if ($message): ?>
        <p class="success-text" id="successMessage"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nhập Email của bạn</label>
        <input type="email" name="email" placeholder="example@gmail.com">

        <?php if ($error): ?>
            <div class="error-text"><?= $error ?></div>
        <?php endif; ?>

        <button type="submit">Gửi</button>
    </form>

    <div class="back-login">
        <a href="<?php echo site_url('/login'); ?>">Quay trở lại Đăng Nhập</a>
    </div>
</div>

<script>
// Ẩn thông báo thành công sau 3 giây
document.addEventListener("DOMContentLoaded", function () {
    let msg = document.getElementById("successMessage");
    if (msg) {
        setTimeout(() => {
            msg.style.display = "none";
        }, 3000);
    }
});
</script>

<?php get_footer(); ?>
