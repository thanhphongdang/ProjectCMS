<?php
/**
 * Template Name: Thu mua xe cũ
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
                            <li class="axil-breadcrumb-item active">Thu mua xe cũ</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('trade_in_page_title', 'Thu mua xe cũ')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trade In Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="trade-in-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('trade_in_page_description', 'Bán xe cũ của bạn với giá tốt nhất, đổi xe mới dễ dàng hơn.')); ?></p>
                    </div>

                    <!-- Benefits -->
                    <div class="trade-in-benefits mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('trade_in_benefits_title', 'Lợi ích khi bán xe cho chúng tôi')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-dollar-sign fa-3x mb--15" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_benefit1_title', 'Giá cao nhất')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_benefit1_desc', 'Định giá chính xác, giá cao nhất thị trường')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-clock fa-3x mb--15" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_benefit2_title', 'Thanh toán nhanh')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_benefit2_desc', 'Thanh toán ngay trong ngày, thủ tục đơn giản')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-exchange-alt fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_benefit3_title', 'Đổi xe mới')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_benefit3_desc', 'Ưu đãi đặc biệt khi đổi xe mới tại showroom')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Process -->
                    <div class="trade-in-process mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('trade_in_process_title', 'Quy trình thu mua')); ?></h3>
                        <div class="row">
                            <div class="col-md-3 mb--20">
                                <div class="process-step text-center">
                                    <div class="step-number">1</div>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_step1_title', 'Liên hệ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_step1_desc', 'Gọi hotline hoặc điền form đăng ký')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 mb--20">
                                <div class="process-step text-center">
                                    <div class="step-number">2</div>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_step2_title', 'Kiểm tra xe')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_step2_desc', 'Chuyên gia kiểm tra tình trạng xe')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 mb--20">
                                <div class="process-step text-center">
                                    <div class="step-number">3</div>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_step3_title', 'Định giá')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_step3_desc', 'Báo giá chính xác, minh bạch')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-3 mb--20">
                                <div class="process-step text-center">
                                    <div class="step-number">4</div>
                                    <h5><?php echo esc_html(get_theme_mod('trade_in_step4_title', 'Hoàn tất')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('trade_in_step4_desc', 'Ký hợp đồng và thanh toán')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Valuation Form -->
                    <div class="valuation-form">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('valuation_form_title', 'Đăng ký định giá xe')); ?></h3>
                        <form class="trade-in-form" method="post">
                            <div class="row">
                                <div class="col-md-6 mb--20">
                                    <label>Họ và tên *</label>
                                    <input type="text" name="seller_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Số điện thoại *</label>
                                    <input type="tel" name="seller_phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Email</label>
                                    <input type="email" name="seller_email" class="form-control">
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Hãng xe *</label>
                                    <input type="text" name="car_brand" class="form-control" placeholder="VD: Toyota, Honda..." required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Model / Dòng xe *</label>
                                    <input type="text" name="car_model" class="form-control" placeholder="VD: Camry, Civic..." required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Năm sản xuất *</label>
                                    <input type="number" name="car_year" class="form-control" min="1990" max="<?php echo date('Y'); ?>" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Số km đã đi *</label>
                                    <input type="number" name="car_mileage" class="form-control" placeholder="VD: 50000" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Tình trạng xe *</label>
                                    <select name="car_condition" class="form-control" required>
                                        <option value="">Chọn tình trạng</option>
                                        <option value="excellent">Rất tốt</option>
                                        <option value="good">Tốt</option>
                                        <option value="fair">Khá</option>
                                        <option value="poor">Cần sửa chữa</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Mô tả thêm về xe</label>
                                    <textarea name="car_description" class="form-control" rows="4" placeholder="Mô tả về tình trạng, lịch sử sửa chữa, phụ kiện..."></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="axil-btn btn-primary">
                                        <?php echo esc_html(get_theme_mod('trade_in_submit_button_text', 'Gửi yêu cầu định giá')); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seller_name'])) {
                            echo '<div class="alert alert-success mt--20">Cảm ơn bạn đã đăng ký! Chúng tôi sẽ liên hệ trong thời gian sớm nhất để định giá xe của bạn.</div>';
                        }
                        ?>
                    </div>

                    <!-- Accepted Brands -->
                    <div class="accepted-brands mt--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('accepted_brands_title', 'Chúng tôi thu mua tất cả các hãng xe')); ?></h3>
                        <div class="brands-list text-center">
                            <p><?php echo esc_html(get_theme_mod('accepted_brands_description', 'Toyota, Honda, Mazda, Ford, Hyundai, Kia, Mitsubishi, Nissan, Suzuki, VinFast và nhiều hãng khác.')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.benefit-box {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
}
.process-step {
    padding: 20px;
}
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
    margin-bottom: 15px;
}
</style>

<?php get_footer(); ?>

