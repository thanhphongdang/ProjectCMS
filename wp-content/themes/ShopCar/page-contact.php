<?php
/* 
Template Name: Contact Page
*/
get_header();
?>

<main class="main-wrapper">

    <!-- Breadcrumb -->
    <div class="axil-breadcrumb-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8">
                    <div class="inner">
                        <ul class="axil-breadcrumb">
                            <li class="axil-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Contact</li>
                        </ul>
                        <h1 class="title">Contact With Us</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="axil-contact-page-area axil-section-gap">
        <div class="container">
            <div class="axil-contact-page">
                <div class="row row--30">
                    
                    <!-- Contact form -->
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <h3 class="title mb--10">We would love to hear from you.</h3>
                            <p>Send us a message and we’ll reply soon.</p>

                            <!-- FORM SUBMIT xử lý bằng plugin Contact Form 7 -->
                            <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form"]'); ?>
                        </div>
                    </div>

                    <!-- Contact info -->
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">
                            <h4 class="title mb--20">Our Store</h4>
                            <span class="address mb--20">8212 E. Glen Creek Street Orchard Park, NY 14127</span>
                            <span class="phone">Phone: +123 456 7890</span>
                            <span class="email">Email: Hello@etrade.com</span>
                        </div>

                        <div class="opening-hour">
                            <h4 class="title mb--20">Opening Hours</h4>
                            <p>Mon–Sat: 9am - 10pm <br/> Sunday: 10am - 6pm</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- GOOGLE MAP -->
            <div class="axil-google-map-wrap axil-section-gap pb--0">
                <iframe width="100%" height="500" src="https://maps.google.com/maps?q=melbourne&z=13&output=embed"></iframe>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
