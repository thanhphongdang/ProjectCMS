<?php wp_footer(); ?>

</main>

<footer class="axil-footer-area footer-style-2" style="background-color: <?php echo esc_attr(get_theme_mod('footer_bg_color', '#1a1a1a')); ?>; color: <?php echo esc_attr(get_theme_mod('footer_text_color', '#ffffff')); ?>;">

    <!-- Start Footer Top Area -->
    <div class="footer-top separator-top">
        <div class="container">
            <div class="row">

                <!-- Support -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Support</h5>
                        <div class="inner">
                            <p>
                                685 Market Street, <br/>
                                Las Vegas, LA 95820, <br/>
                                United States.
                            </p>

                            <ul class="support-list-item">
                                <li>
                                    <a href="mailto:<?php echo esc_attr(get_theme_mod('footer_email', 'example@domain.com')); ?>" class="footer-email">
                                        <i class="fal fa-envelope-open"></i> <?php echo esc_html(get_theme_mod('footer_email', 'example@domain.com')); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('footer_phone', '(+01) 850-315-5862'))); ?>" class="footer-phone">
                                        <i class="fal fa-phone-alt"></i> <?php echo esc_html(get_theme_mod('footer_phone', '(+01) 850-315-5862')); ?>
                                    </a>
                                </li>
                            </ul>
                            <?php if (get_theme_mod('footer_address')): ?>
                            <p class="footer-address" style="margin-top: 10px;">
                                <?php echo esc_html(get_theme_mod('footer_address', '685 Market Street, Las Vegas, LA 95820, United States.')); ?>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Account -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Account</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="<?php echo wc_get_page_permalink('myaccount'); ?>">My Account</a></li>
                                <li><a href="<?php echo site_url('/login'); ?>">Login</a></li>
                                <li><a href="<?php echo site_url('/register'); ?>">Register</a></li>
                                <li><a href="<?php echo wc_get_page_permalink('cart'); ?>">Cart</a></li>
                                <li><a href="<?php echo wc_get_page_permalink('shop'); ?>">Shop</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Quick Link -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Quick Links</h5>
                        <div class="inner">
                            <ul>
                                <li><a href="<?php echo site_url('/contact'); ?>">FAQ</a></li>
                                <li><a href="<?php echo site_url('/contact'); ?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Download App -->
                <div class="col-lg-3 col-sm-6">
                    <div class="axil-footer-widget">
                        <h5 class="widget-title">Download App</h5>
                        <div class="inner">
                            <span>Save $3 With App &amp; New User only</span>

                            <div class="download-btn-group">
                                <div class="qr-code">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/others/qr.png" alt="QR Code">
                                </div>

                                <div class="app-link">
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/others/app-store.png" alt="App Store">
                                    </a>
                                    <a href="#">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/others/play-store.png" alt="Play Store">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </div>
    <!-- End Footer Top Area -->

    <!-- Copyright -->
    <div class="copyright-area copyright-default separator-top">
        <div class="container">
            <div class="row align-items-center">

                <!-- Social -->
                <div class="col-xl-4">
                    <div class="social-share">
                        <a href="<?php echo esc_url(get_theme_mod('footer_social_facebook', '#')); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?php echo esc_url(get_theme_mod('footer_social_instagram', '#')); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="<?php echo esc_url(get_theme_mod('footer_social_twitter', '#')); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="<?php echo esc_url(get_theme_mod('footer_social_linkedin', '#')); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="<?php echo esc_url(get_theme_mod('footer_social_discord', '#')); ?>" target="_blank" rel="noopener"><i class="fab fa-discord"></i></a>
                    </div>
                </div>

                <!-- Text -->
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-center">
                        <ul class="quick-link">
                            <li class="footer-copyright">
                                <?php echo esc_html(get_theme_mod('footer_copyright', '© ' . date("Y") . '. All rights reserved by Axilthemes.')); ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Payment Icons -->
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-right d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                        <span class="card-text">Accept For</span>
                        <ul class="payment-icons-bottom quick-link">
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cart/cart-1.png" alt=""></li>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cart/cart-2.png" alt=""></li>
                            <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/icons/cart/cart-5.png" alt=""></li>
                        </ul>
                    </div>
                </div>

            </div> <!-- row -->
        </div> <!-- container -->
    </div>
</footer>

<?php wp_footer(); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const accountToggle = document.querySelector(".menu-account .account-toggle");
    const menuAccount = document.querySelector(".menu-account");

    if (accountToggle && menuAccount) {
        accountToggle.addEventListener("click", function (e) {
            e.preventDefault();
            menuAccount.classList.toggle("active");
        });

        document.addEventListener("click", function (e) {
            if (!menuAccount.contains(e.target)) {
                menuAccount.classList.remove("active");
            }
        });
    }
});
</script>

</body>
</html>
