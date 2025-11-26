<?php
/*
Template Name: Service Page
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
                            <li class="axil-breadcrumb-item active">Service</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('service_page_title', 'Professional Car Services')); ?></h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4 text-end">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-main.jpg"
                                 alt="Service"
                                 style="border-radius:10px;width:260px;height:auto;object-fit:cover;">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Service Intro -->
    <div class="axil-about-area axil-section-gap">
        <div class="container">

            <div class="row align-items-center">

                <div class="col-xl-6 col-lg-6 mb--20">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-garage.jpg"
                         alt="Car Service" 
                         style="width:100%;border-radius:10px;">
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <span class="title-highlighter highlighter-primary2">
                            <i class="fas fa-tools"></i> Our Services
                        </span>
                        <h3 class="title"><?php echo esc_html(get_theme_mod('service_page_title', 'Chăm sóc & bảo dưỡng xe toàn diện')); ?></h3>

                        <p>
                            <?php echo esc_html(get_theme_mod('service_page_description', 'Showroom của chúng tôi cung cấp đầy đủ dịch vụ từ bảo dưỡng định kỳ, sửa chữa kỹ thuật, thay thế phụ tùng chính hãng cho đến chăm sóc ngoại thất – nội thất. Đội ngũ kỹ thuật viên chuyên nghiệp cam kết mang lại chất lượng cao nhất cho chiếc xe của bạn.')); ?>
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- Service List -->
    <div class="axil-product-area bg-color-white axil-section-gap">
        <div class="container">

            <div class="section-title-wrapper text-center mb--40">
                <span class="title-highlighter highlighter-primary">
                    <i class="fas fa-wrench"></i> Car Services
                </span>
                <h2 class="title">Our Professional Services</h2>
            </div>

            <div class="row row--20">

                <!-- 1. Maintenance -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-maintenance.jpg"
                             alt="Maintenance" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-oil-can"></i> Bảo dưỡng định kỳ</h4>
                        <p>Thay nhớt, lọc gió, kiểm tra hệ thống phanh, điện và toàn bộ xe.</p>
                    </div>
                </div>

                <!-- 2. Repair -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-repair.jpg"
                             alt="Repair" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-cogs"></i> Sửa chữa kỹ thuật</h4>
                        <p>Chẩn đoán và sửa chữa động cơ, hộp số, hệ thống treo và các vấn đề phức tạp.</p>
                    </div>
                </div>

                <!-- 3. Parts -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-parts.jpg"
                             alt="Parts" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-car-battery"></i> Phụ tùng chính hãng</h4>
                        <p>Cung cấp phụ tùng thay thế chính hãng, đảm bảo độ bền và an toàn.</p>
                    </div>
                </div>

                <!-- 4. Detailing -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-detailing.jpg"
                             alt="Detailing" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-spray-can"></i> Detailing – làm đẹp xe</h4>
                        <p>Vệ sinh nội thất, đánh bóng, phủ ceramic, chăm sóc ngoại thất toàn diện.</p>
                    </div>
                </div>

                <!-- 5. Inspection -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-inspection.jpg"
                             alt="Inspection" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-clipboard-check"></i> Kiểm tra xe tổng quát</h4>
                        <p>Kiểm tra toàn bộ xe trước khi mua – bán hoặc chuẩn bị hành trình dài.</p>
                    </div>
                </div>

                <!-- 6. Rescue -->
                <div class="col-lg-4 col-md-6 mb--30">
                    <div class="axil-service-box">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/service-rescue.jpg"
                             alt="Rescue" style="width:100%;border-radius:10px;">
                        <h4 class="title mt--20"><i class="fas fa-truck-pickup"></i> Cứu hộ 24/7</h4>
                        <p>Hỗ trợ cứu hộ nhanh chóng trong khu vực với xe chuyên dụng.</p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- Booking Section -->
    <div class="axil-newsletter-area axil-section-gap">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--8">

                <div class="newsletter-content text-center">
                    <span class="title-highlighter highlighter-primary2">
                        <i class="fas fa-calendar-check"></i> Booking
                    </span>

                    <h2 class="title mb--20"><?php echo esc_html(get_theme_mod('service_booking_title', 'Đặt lịch bảo dưỡng / kiểm tra xe')); ?></h2>
                    <p class="mb--30"><?php echo esc_html(get_theme_mod('service_booking_description', 'Chúng tôi sẽ liên hệ xác nhận trong vòng 15 phút.')); ?></p>

                    <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                        Đặt lịch ngay
                    </a>
                </div>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
