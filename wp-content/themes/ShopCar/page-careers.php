<?php
/**
 * Template Name: Tuyển dụng
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
                            <li class="axil-breadcrumb-item active">Tuyển dụng</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('careers_page_title', 'Tuyển dụng')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Careers Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="careers-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('careers_page_description', 'Cơ hội nghề nghiệp tại showroom xe hơi hàng đầu. Chúng tôi đang tìm kiếm những tài năng để cùng phát triển.')); ?></p>
                    </div>

                    <!-- Why Join Us -->
                    <div class="why-join mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('why_join_title', 'Tại sao nên làm việc với chúng tôi?')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-dollar-sign fa-3x mb--15" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('career_benefit1_title', 'Lương thưởng hấp dẫn')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('career_benefit1_desc', 'Mức lương cạnh tranh, thưởng theo doanh số')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-graduation-cap fa-3x mb--15" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('career_benefit2_title', 'Đào tạo chuyên nghiệp')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('career_benefit2_desc', 'Chương trình đào tạo bài bản, nâng cao kỹ năng')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="benefit-box text-center">
                                    <i class="fas fa-chart-line fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('career_benefit3_title', 'Cơ hội thăng tiến')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('career_benefit3_desc', 'Môi trường làm việc năng động, cơ hội phát triển')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Job Openings -->
                    <div class="job-openings mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('job_openings_title', 'Vị trí đang tuyển dụng')); ?></h3>
                        <div class="job-list">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                $job_title = get_theme_mod('job' . $i . '_title', '');
                                if ($job_title) {
                            ?>
                            <div class="job-item mb--20">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h4><?php echo esc_html($job_title); ?></h4>
                                        <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('job' . $i . '_location', 'Hà Nội / TP.HCM')); ?></p>
                                        <p><?php echo esc_html(get_theme_mod('job' . $i . '_description', '')); ?></p>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a href="<?php echo esc_url(get_theme_mod('job' . $i . '_apply_url', site_url('/contact'))); ?>" class="axil-btn btn-primary">
                                            <?php echo esc_html(get_theme_mod('careers_apply_button_text', 'Ứng tuyển ngay')); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Application Form -->
                    <div class="application-form">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('application_form_title', 'Gửi CV ứng tuyển')); ?></h3>
                        <form class="career-form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb--20">
                                    <label>Họ và tên *</label>
                                    <input type="text" name="applicant_name" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Email *</label>
                                    <input type="email" name="applicant_email" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Số điện thoại *</label>
                                    <input type="tel" name="applicant_phone" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb--20">
                                    <label>Vị trí ứng tuyển *</label>
                                    <input type="text" name="applicant_position" class="form-control" required>
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Kinh nghiệm làm việc</label>
                                    <textarea name="applicant_experience" class="form-control" rows="4"></textarea>
                                </div>
                                <div class="col-md-12 mb--20">
                                    <label>Upload CV (PDF, DOC, DOCX)</label>
                                    <input type="file" name="applicant_cv" class="form-control" accept=".pdf,.doc,.docx">
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="axil-btn btn-primary">
                                        <?php echo esc_html(get_theme_mod('careers_submit_button_text', 'Gửi đơn ứng tuyển')); ?>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['applicant_name'])) {
                            echo '<div class="alert alert-success mt--20">Cảm ơn bạn đã ứng tuyển! Chúng tôi sẽ liên hệ trong thời gian sớm nhất.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.job-item {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
    border-left: 4px solid #007bff;
}
.benefit-box {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
}
</style>

<?php get_footer(); ?>

