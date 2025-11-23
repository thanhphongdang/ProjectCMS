<?php wp_footer(); ?>

</main>

<footer class="axil-footer-area footer-style-2">

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
                                    <a href="mailto:example@domain.com">
                                        <i class="fal fa-envelope-open"></i> example@domain.com
                                    </a>
                                </li>
                                <li>
                                    <a href="tel:(+01)850-315-5862">
                                        <i class="fal fa-phone-alt"></i> (+01) 850-315-5862
                                    </a>
                                </li>
                            </ul>
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
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-discord"></i></a>
                    </div>
                </div>

                <!-- Text -->
                <div class="col-xl-4 col-lg-12">
                    <div class="copyright-left d-flex flex-wrap justify-content-center">
                        <ul class="quick-link">
                            <li>
                                © <?php echo date("Y"); ?>. All rights reserved by
                                <a href="https://axilthemes.com/" target="_blank">Axilthemes</a>.
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
