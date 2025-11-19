<?php
/* 
Template Name: Signup Page 
*/
get_header();
?>

<div class="axil-signin-area">

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="axil-signin-banner bg_image bg_image--10">
                <h3 class="title">We Offer the Best Products</h3>
            </div>
        </div>

        <div class="col-lg-6 offset-xl-2">
            <div class="axil-signin-form-wrap">
                <div class="axil-signin-form">

                    <h3 class="title">I'm New Here</h3>
                    <p class="b2 mb--55">Enter your detail below</p>

                    <!-- HIỂN THỊ LỖI -->
                    <?php
                        if (!empty($GLOBALS['shopcar_signup_error'])) {
                            echo '<div style="color:red; margin-bottom:20px;">';

                            foreach ($GLOBALS['shopcar_signup_error']->get_error_messages() as $err) {
                                echo '<p>' . esc_html($err) . '</p>';
                            }

                            echo '</div>';
                        }
                    ?>

                    <!-- HIỂN THỊ THÀNH CÔNG -->
                    <?php if (!empty($GLOBALS['shopcar_signup_success'])): ?>
                        <p style="color:green; margin-bottom:20px;">
                            <?php echo esc_html($GLOBALS['shopcar_signup_success']); ?>
                        </p>
                    <?php endif; ?>

                    <!-- FORM SIGNUP -->
                    <form class="singin-form" method="post">

                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" name="username" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="signup_submit" class="axil-btn btn-bg-primary submit-btn">
                                Create Account
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>
