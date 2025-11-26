<?php
/**
 * Template Name: Tư vấn mua xe
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
                            <li class="axil-breadcrumb-item active">Tư vấn mua xe</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('consultation_page_title', 'Tư vấn mua xe')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Consultation Form Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="consultation-intro text-center mb--40">
                        <p class="lead"><?php echo esc_html(get_theme_mod('consultation_page_description', 'Điền thông tin để nhận tư vấn miễn phí từ chuyên gia của chúng tôi.')); ?></p>
                    </div>

                    <div class="consultation-form-wrapper">
                        <form class="consultation-form" method="post">
                            <div class="row">
                                <div class="col-md-6 mb--20">
                                    <label>Họ và tên *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Số điện thoại *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Ngân sách dự kiến</label>
                                    <select name="budget" class="form-control">
                                        <option value="">Chọn mức giá</option>
                                        <option value="under-500">Dưới 500 triệu</option>
                                        <option value="500-1000">500 triệu - 1 tỷ</option>
                                        <option value="1000-2000">1 tỷ - 2 tỷ</option>
                                        <option value="over-2000">Trên 2 tỷ</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Loại xe quan tâm</label>
                                    <input type="text" name="car_type" class="form-control" placeholder="VD: Sedan, SUV, Hatchback...">
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Nhu cầu sử dụng</label>
                                    <textarea name="needs" class="form-control" rows="4" placeholder="Mô tả nhu cầu sử dụng xe của bạn..."></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="axil-btn btn-primary">
                                        <?php echo esc_html(get_theme_mod('consultation_page_button_text', 'Gửi yêu cầu tư vấn')); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
                            echo '<div class="alert alert-success mt--20">Cảm ơn bạn đã gửi yêu cầu! Chúng tôi sẽ liên hệ trong thời gian sớm nhất.</div>';
                        }
                        ?>
                    </div>

                    <!-- Benefits -->
                    <div class="consultation-benefits mt--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('consultation_benefits_title', 'Lợi ích khi tư vấn với chúng tôi')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-user-tie fa-3x mb--10" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('consultation_benefit1_title', 'Chuyên gia tư vấn')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('consultation_benefit1_desc', 'Đội ngũ tư vấn chuyên nghiệp, giàu kinh nghiệm')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-dollar-sign fa-3x mb--10" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('consultation_benefit2_title', 'Giá tốt nhất')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('consultation_benefit2_desc', 'Báo giá minh bạch, cạnh tranh nhất thị trường')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-shield-alt fa-3x mb--10" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('consultation_benefit3_title', 'Bảo hành uy tín')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('consultation_benefit3_desc', 'Chính sách bảo hành toàn diện, lâu dài')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>

