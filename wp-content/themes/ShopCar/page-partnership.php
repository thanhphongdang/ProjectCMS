<?php
/**
 * Template Name: Hợp tác kinh doanh
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
                            <li class="axil-breadcrumb-item active">Hợp tác kinh doanh</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('partnership_page_title', 'Hợp tác kinh doanh')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Partnership Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="partnership-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('partnership_page_description', 'Cơ hội hợp tác kinh doanh với showroom xe hơi hàng đầu. Cùng nhau phát triển và thành công.')); ?></p>
                    </div>

                    <!-- Partnership Types -->
                    <div class="partnership-types mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('partnership_types_title', 'Các hình thức hợp tác')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--30">
                                <div class="partnership-box text-center">
                                    <i class="fas fa-store fa-3x mb--15" style="color: #007bff;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('partnership_type1_title', 'Đại lý phân phối')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('partnership_type1_desc', 'Trở thành đại lý phân phối chính thức, hưởng ưu đãi về giá và hỗ trợ marketing.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--30">
                                <div class="partnership-box text-center">
                                    <i class="fas fa-handshake fa-3x mb--15" style="color: #28a745;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('partnership_type2_title', 'Đối tác chiến lược')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('partnership_type2_desc', 'Hợp tác lâu dài trong các dự án lớn, cùng phát triển thị trường.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--30">
                                <div class="partnership-box text-center">
                                    <i class="fas fa-users fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h4><?php echo esc_html(get_theme_mod('partnership_type3_title', 'Cộng tác viên')); ?></h4>
                                    <p><?php echo esc_html(get_theme_mod('partnership_type3_desc', 'Trở thành cộng tác viên bán hàng, hưởng hoa hồng hấp dẫn.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Benefits -->
                    <div class="partnership-benefits mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('partnership_benefits_title', 'Lợi ích khi hợp tác')); ?></h3>
                        <div class="row">
                            <div class="col-md-6 mb--20">
                                <div class="benefit-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('partnership_benefit1_title', 'Hỗ trợ marketing')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('partnership_benefit1_desc', 'Hỗ trợ quảng cáo, banner, tài liệu marketing chuyên nghiệp.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="benefit-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('partnership_benefit2_title', 'Đào tạo đội ngũ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('partnership_benefit2_desc', 'Đào tạo kỹ năng bán hàng, kiến thức sản phẩm cho nhân viên.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="benefit-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('partnership_benefit3_title', 'Giá ưu đãi')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('partnership_benefit3_desc', 'Giá bán buôn cạnh tranh, chiết khấu cao cho đối tác.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="benefit-item">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('partnership_benefit4_title', 'Hỗ trợ kỹ thuật')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('partnership_benefit4_desc', 'Hỗ trợ kỹ thuật, bảo hành, sửa chữa cho khách hàng.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="partnership-form">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('partnership_form_title', 'Đăng ký hợp tác')); ?></h3>
                        <form class="partnership-contact-form" method="post">
                            <div class="row">
                                <div class="col-md-6 mb--20">
                                    <label>Tên công ty / Cá nhân *</label>
                                    <input type="text" name="company_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Người liên hệ *</label>
                                    <input type="text" name="contact_person" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Số điện thoại *</label>
                                    <input type="tel" name="phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Hình thức hợp tác *</label>
                                    <select name="partnership_type" class="form-control" required>
                                        <option value="">Chọn hình thức</option>
                                        <option value="dealer">Đại lý phân phối</option>
                                        <option value="strategic">Đối tác chiến lược</option>
                                        <option value="collaborator">Cộng tác viên</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Địa chỉ</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Mô tả về công ty / Dự án *</label>
                                    <textarea name="description" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="axil-btn btn-primary">
                                        <?php echo esc_html(get_theme_mod('partnership_submit_button_text', 'Gửi yêu cầu hợp tác')); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['company_name'])) {
                            echo '<div class="alert alert-success mt--20">Cảm ơn bạn đã quan tâm! Chúng tôi sẽ liên hệ trong thời gian sớm nhất.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.partnership-box {
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
    height: 100%;
    transition: transform 0.3s;
}
.partnership-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
.benefit-item {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
}
</style>

<?php get_footer(); ?>

