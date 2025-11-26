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
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url('/'); ?>">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Contact</li>
                        </ul>
                        <h1 class="title">Contact Our Dealership</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4 text-end">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/showroom.jpg" 
                                 style="border-radius:10px; width:250px; height:auto; object-fit:cover;"
                                 alt="Showroom">
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

                    <!-- Contact Form -->
                    <div class="col-lg-8">
                        <div class="contact-form">

                            <h3 class="title mb--10">Gửi tin nhắn cho chúng tôi</h3>
                            <p>Chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>

                            <!-- FORM CONTACT (Contact Form 7) -->
                            <?php echo do_shortcode('[contact-form-7 id="b134d05" title="Contact form 1"]'); ?>

                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-4">
                        <div class="contact-location mb--40">

                            <h4 class="title mb--20">Thông tin showroom</h4>

                            <span class="address mb--10">
                                <strong>Địa chỉ:</strong><br>
                                <?php echo esc_html(get_theme_mod('contact_page_address', '685 Market Street, Las Vegas, LA 95820, USA')); ?>
                            </span>

                            <span class="phone mb--10">
                                <strong>Hotline:</strong><br>
                                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', get_theme_mod('contact_page_phone', '(+01) 850-315-5862'))); ?>">
                                    <?php echo esc_html(get_theme_mod('contact_page_phone', '(+01) 850-315-5862')); ?>
                                </a>
                            </span>

                            <span class="email mb--10">
                                <strong>Email:</strong><br>
                                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_page_email', 'hello@cardealer.com')); ?>">
                                    <?php echo esc_html(get_theme_mod('contact_page_email', 'hello@cardealer.com')); ?>
                                </a>
                            </span>

                            <span class="zalo mb--10">
                                <strong>Zalo tư vấn:</strong><br>
                                <a href="<?php echo esc_url(get_theme_mod('contact_page_zalo', '#')); ?>">Zalo Chat</a>
                            </span>

                        </div>

                        <div class="opening-hour">
                            <h4 class="title mb--20">Giờ làm việc</h4>
                            <p>
                                <?php echo nl2br(esc_html(get_theme_mod('contact_page_working_hours', 'Thứ 2 – Thứ 7: 8:00 - 20:00\nChủ nhật: 9:00 - 17:00'))); ?>
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Google Map -->
            <div class="axil-google-map-wrap axil-section-gap pb--0">
                <iframe 
                    width="100%" 
                    height="450" 
                    style="border:0; border-radius:10px;"
                    loading="lazy"
                    allowfullscreen
                    src="<?php echo esc_url(get_theme_mod('contact_page_map_url', 'https://www.google.com/maps?q=toyota%20showroom&t=&z=12&ie=UTF8&iwloc=&output=embed')); ?>">
                </iframe>
            </div>

        </div>
    </div>

</main>

<?php get_footer(); ?>
