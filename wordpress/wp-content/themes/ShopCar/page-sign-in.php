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

                        <form class="signin-form">

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="form-group d-flex align-items-center justify-content-between mt--20">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn">
                                    Sign In
                                </button>

                                <a href="<?php echo site_url('/reset-password'); ?>" class="forgot-btn">
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
