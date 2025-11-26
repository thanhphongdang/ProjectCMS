<?php
/**
 * Template Name: Bảo hành & Bảo dưỡng
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
                            <li class="axil-breadcrumb-item active">Bảo hành & Bảo dưỡng</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('warranty_page_title', 'Bảo hành & Bảo dưỡng')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Warranty Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="warranty-intro text-center mb--50">
                        <h2><?php echo esc_html(get_theme_mod('warranty_intro_title', 'Chính sách bảo hành toàn diện')); ?></h2>
                        <p class="lead"><?php echo esc_html(get_theme_mod('warranty_intro_description', 'Chúng tôi cam kết mang đến dịch vụ bảo hành và bảo dưỡng tốt nhất cho chiếc xe của bạn.')); ?></p>
                    </div>

                    <!-- Warranty Policies -->
                    <div class="warranty-policies mb--50">
                        <h3 class="mb--30"><?php echo esc_html(get_theme_mod('warranty_policies_title', 'Chính sách bảo hành')); ?></h3>
                        <div class="row">
                            <div class="col-md-6 mb--20">
                                <div class="policy-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('warranty_policy1_title', 'Bảo hành chính hãng')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('warranty_policy1_desc', 'Bảo hành theo tiêu chuẩn của hãng xe, thời gian từ 2-5 năm tùy hãng.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="policy-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('warranty_policy2_title', 'Bảo hành động cơ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('warranty_policy2_desc', 'Bảo hành động cơ và hệ thống truyền động trong 3 năm đầu.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="policy-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('warranty_policy3_title', 'Bảo hành phụ tùng')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('warranty_policy3_desc', 'Phụ tùng chính hãng được bảo hành 1 năm hoặc theo quy định.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="policy-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('warranty_policy4_title', 'Hỗ trợ 24/7')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('warranty_policy4_desc', 'Đội ngũ kỹ thuật hỗ trợ 24/7 khi xe gặp sự cố.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance Services -->
                    <div class="maintenance-services mb--50">
                        <h3 class="mb--30"><?php echo esc_html(get_theme_mod('maintenance_services_title', 'Dịch vụ bảo dưỡng')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="service-box text-center">
                                    <i class="fas fa-oil-can fa-3x mb--10" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('maintenance_service1_title', 'Bảo dưỡng định kỳ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('maintenance_service1_desc', 'Thay nhớt, lọc gió, kiểm tra hệ thống')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="service-box text-center">
                                    <i class="fas fa-tools fa-3x mb--10" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('maintenance_service2_title', 'Sửa chữa chuyên sâu')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('maintenance_service2_desc', 'Chẩn đoán và sửa chữa các lỗi kỹ thuật')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="service-box text-center">
                                    <i class="fas fa-car-battery fa-3x mb--10" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('maintenance_service3_title', 'Thay phụ tùng')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('maintenance_service3_desc', 'Phụ tùng chính hãng, chất lượng cao')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('warranty_page_button_text', 'Liên hệ đặt lịch')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.policy-box, .service-box {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    height: 100%;
}
</style>

<?php get_footer(); ?>

