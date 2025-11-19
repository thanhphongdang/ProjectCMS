<?php
/* Template Name: Sign In */
get_header();
?>

<div class="axil-signin-area section-padding">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">

                        <h3 class="title mb--15">Sign in to eTrade.</h3>
                        <p class="b2 mb--40">Enter your details below</p>

                        <?php 
                            // Hiển thị lỗi nếu có
                            if (!empty($GLOBALS['shopcar_login_error'])) {
                                echo '<p style="color:red; margin-bottom:15px;">'. esc_html($GLOBALS['shopcar_login_error']) .'</p>';
                            }
                        ?>

                        <form method="POST" class="signin-form">

                            <div class="form-group">
                                <label>Email or Username</label>
                                <input type="text" class="form-control" name="email" required>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between mt--20">

                                <button type="submit" name="shopcar_login_submit" class="axil-btn btn-bg-primary submit-btn">
                                    Sign In
                                </button>

                                <a href="<?php echo wp_lostpassword_url(); ?>" class="forgot-btn">
                                    Forgot password?
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
