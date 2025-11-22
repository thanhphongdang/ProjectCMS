<?php

/**
 * Template Name: Change Password Page
 */
defined('ABSPATH') || exit;
get_header();

// ==========================
// XỬ LÝ LOGIC ĐỔI MẬT KHẨU
// ==========================

$errors = [];
$success_message = "";

$current_pass  = $_POST['current_pass'] ?? '';
$new_pass      = $_POST['new_pass'] ?? '';
$confirm_pass  = $_POST['confirm_pass'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current_pass  = sanitize_text_field($_POST['current_pass']);
    $new_pass      = sanitize_text_field($_POST['new_pass']);
    $confirm_pass  = sanitize_text_field($_POST['confirm_pass']);

    $user = wp_get_current_user();

    // 1. Kiểm tra mật khẩu hiện tại
    if (empty($current_pass)) {
        $errors['current_pass'] = "Vui lòng nhập mật khẩu hiện tại.";
    } elseif (!wp_check_password($current_pass, $user->data->user_pass, $user->ID)) {
        $errors['current_pass'] = "Mật khẩu hiện tại không chính xác.";
    }

    // 2. Kiểm tra mật khẩu mới
    if (empty($new_pass)) {
        $errors['new_pass'] = "Vui lòng nhập mật khẩu mới.";
    } elseif (strlen($new_pass) < 6) {
        $errors['new_pass'] = "Mật khẩu mới phải từ 6 ký tự.";
    }

    // 3. Kiểm tra xác nhận mật khẩu
    if (empty($confirm_pass)) {
        $errors['confirm_pass'] = "Vui lòng xác nhận mật khẩu mới.";
    } elseif ($new_pass !== $confirm_pass) {
        $errors['confirm_pass'] = "Mật khẩu xác nhận không khớp.";
    }

    // 4. Nếu không có lỗi → cập nhật mật khẩu
    if (empty($errors)) {

        wp_set_password($new_pass, $user->ID);
        $success_message = "Lưu mật khẩu thành công.";

        // Reset input sau khi lưu thành công
        $current_pass = $new_pass = $confirm_pass = "";
    }
}
?>

<main class="main-wrapper">

    <div class="container"
        style="
            display: flex;
            justify-content: center;      /* 🔥 CĂN GIỮA NGANG */
            align-items: center;          /* 🔥 CĂN GIỮA DỌC */
            min-height: 70vh;             /* 🔥 FORM NẰM GIỮA TRANG */
            margin-top: 40px;
            margin-bottom: 60px;
        ">

        <div style="max-width: 600px; width: 100%;">

            <h2 style="
                font-size: 28px;
                font-weight: 700;
                margin-bottom: 25px;
                text-align: center;
            ">
                ĐỔI MẬT KHẨU
            </h2>

            <!-- CARD -->
            <div style="
                background:#fff;
                padding:35px 40px;
                border-radius:14px;
                border:1px solid #e6e6e6;
                box-shadow:0 6px 20px rgba(0,0,0,0.06);
                width:100%;
            ">

                <form method="post" style="margin-top: 10px;">

                    <!-- FUNCTION INPUT RENDER -->
                    <?php
                    function render_input($label, $name, $value, $error)
                    {
                    ?>
                        <div style="margin-bottom: 22px;">
                            <label style="font-weight:600; margin-bottom:6px; display:block;">
                                <?php echo $label; ?>
                            </label>

                            <div style="position:relative;">
                                <input
                                    type="password"
                                    id="<?php echo $name; ?>"
                                    name="<?php echo $name; ?>"
                                    value="<?php echo esc_attr($value); ?>"
                                    style="
                                        width:100%;
                                        padding:10px 42px 10px 12px;
                                        font-size:15px;
                                        height:45px;
                                        border:1px solid <?php echo $error ? '#ff3b3b' : '#ccc'; ?>;
                                        border-radius:10px;
                                        background:#fafafa;
                                    ">

                                <!-- ICON MẮT -->
                                <span
                                    onclick="togglePass('<?php echo $name; ?>')"
                                    style="
                                        position:absolute;
                                        right:12px;
                                        top:50%;
                                        transform:translateY(-50%);
                                        cursor:pointer;
                                        font-size:18px;
                                        color:#666;
                                    ">👁</span>
                            </div>

                            <?php if ($error): ?>
                                <p style="color:#ff3b3b; margin-top:6px; font-size:14px;">
                                    <?php echo $error; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    <?php
                    }
                    ?>

                    <?php
                    render_input("Mật khẩu hiện tại *", "current_pass", $current_pass, $errors['current_pass'] ?? '');
                    render_input("Mật khẩu mới *", "new_pass", $new_pass, $errors['new_pass'] ?? '');
                    render_input("Xác nhận mật khẩu mới *", "confirm_pass", $confirm_pass, $errors['confirm_pass'] ?? '');
                    ?>

                    <!-- BUTTON -->
                    <button type="submit"
                        style="
                            width:100%;
                            padding:14px;
                            background:#111;
                            color:#fff;
                            border:none;
                            border-radius:10px;
                            font-size:16px;
                            font-weight:600;
                        ">
                        Lưu mật khẩu
                    </button>

                    <!-- SUCCESS MESSAGE -->
                    <?php if (!empty($success_message)) : ?>
                        <p id="successMsg" style="
                            margin-top:15px;
                            padding:12px;
                            background:#e8ffe8;
                            border:1px solid #5cb85c;
                            color:#2d7d2d;
                            border-radius:8px;
                            font-size:14px;
                            text-align:center;
                        ">
                            <?php echo $success_message; ?>
                        </p>

                        <script>
                            setTimeout(() => {
                                const msg = document.getElementById("successMsg");
                                if (msg) msg.style.display = "none";
                            }, 4000);
                        </script>
                    <?php endif; ?>

                </form>

            </div>
        </div>
    </div>
</main>

<script>
    function togglePass(id) {
        let input = document.getElementById(id);
        input.type = (input.type === "password") ? "text" : "password";
    }
</script>

<?php get_footer(); ?>