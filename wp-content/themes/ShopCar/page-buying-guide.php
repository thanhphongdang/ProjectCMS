<?php
/**
 * Template Name: Hướng dẫn mua hàng
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
                            <li class="axil-breadcrumb-item active">Hướng dẫn mua hàng</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('buying_guide_page_title', 'Hướng dẫn mua hàng')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Buying Guide Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="guide-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('buying_guide_description', 'Hướng dẫn chi tiết quy trình mua xe tại showroom của chúng tôi.')); ?></p>
                    </div>

                    <!-- Steps -->
                    <div class="buying-steps">
                        <div class="step-item mb--40">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="step-number">1</div>
                                </div>
                                <div class="col-md-10">
                                    <h3><?php echo esc_html(get_theme_mod('buying_step1_title', 'Tư vấn & Chọn xe')); ?></h3>
                                    <p><?php echo esc_html(get_theme_mod('buying_step1_desc', 'Liên hệ với chúng tôi để được tư vấn và chọn mẫu xe phù hợp với nhu cầu và ngân sách của bạn.')); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb--40">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="step-number">2</div>
                                </div>
                                <div class="col-md-10">
                                    <h3><?php echo esc_html(get_theme_mod('buying_step2_title', 'Xem xe & Test drive')); ?></h3>
                                    <p><?php echo esc_html(get_theme_mod('buying_step2_desc', 'Đến showroom để xem xe trực tiếp và thử lái để cảm nhận chất lượng xe.')); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb--40">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="step-number">3</div>
                                </div>
                                <div class="col-md-10">
                                    <h3><?php echo esc_html(get_theme_mod('buying_step3_title', 'Báo giá & Đàm phán')); ?></h3>
                                    <p><?php echo esc_html(get_theme_mod('buying_step3_desc', 'Nhận báo giá chi tiết và thương lượng các điều khoản mua bán, bảo hành, phụ kiện.')); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb--40">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="step-number">4</div>
                                </div>
                                <div class="col-md-10">
                                    <h3><?php echo esc_html(get_theme_mod('buying_step4_title', 'Ký hợp đồng & Thanh toán')); ?></h3>
                                    <p><?php echo esc_html(get_theme_mod('buying_step4_desc', 'Ký hợp đồng mua bán và thanh toán theo phương thức đã thỏa thuận (tiền mặt, trả góp, vay ngân hàng).')); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="step-item mb--40">
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center">
                                    <div class="step-number">5</div>
                                </div>
                                <div class="col-md-10">
                                    <h3><?php echo esc_html(get_theme_mod('buying_step5_title', 'Giao xe & Bàn giao')); ?></h3>
                                    <p><?php echo esc_html(get_theme_mod('buying_step5_desc', 'Nhận xe tại showroom hoặc giao xe tận nhà, nhận đầy đủ giấy tờ và hướng dẫn sử dụng.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="payment-methods mt--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('payment_methods_title', 'Phương thức thanh toán')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="payment-box text-center">
                                    <i class="fas fa-money-bill-wave fa-3x mb--15" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('payment_method1_title', 'Tiền mặt')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('payment_method1_desc', 'Thanh toán trực tiếp tại showroom')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="payment-box text-center">
                                    <i class="fas fa-credit-card fa-3x mb--15" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('payment_method2_title', 'Trả góp')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('payment_method2_desc', 'Trả góp linh hoạt, lãi suất ưu đãi')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="payment-box text-center">
                                    <i class="fas fa-university fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('payment_method3_title', 'Vay ngân hàng')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('payment_method3_desc', 'Hỗ trợ vay ngân hàng với lãi suất tốt')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt--50">
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('buying_guide_button_text', 'Liên hệ tư vấn')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.step-number {
    width: 60px;
    height: 60px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: bold;
}
.payment-box {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
}
</style>

<?php get_footer(); ?>

