<?php
/* 
 Template Name: Forgot Password
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
                    <h3 class="title">Forgot Password?</h3>
                    <p class="b2 mb--55">
                        Enter the email you used when you joined. We’ll send you reset instructions.
                    </p>

                    <form class="signin-form">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" />
                        </div>

                        <div class="form-group">
                            <button type="submit" class="axil-btn btn-bg-primary submit-btn">
                                Send Reset Instructions
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</div>

<?php get_footer(); ?>
