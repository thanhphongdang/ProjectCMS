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

                    <!-- FORM SIGN UP -->
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

                    <?php
                    // XỬ LÝ TẠO TÀI KHOẢN
                    if ( isset($_POST['signup_submit']) ) {
                        $username = sanitize_user($_POST['username']);
                        $email    = sanitize_email($_POST['email']);
                        $password = $_POST['password'];

                        if ( username_exists($username) || email_exists($email) ) {
                            echo "<p style='color:red'>Account already exists!</p>";
                        } else {
                            wp_create_user($username, $password, $email);
                            echo "<p style='color:green'>Account created successfully!</p>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>

</div>

<?php get_footer(); ?>
