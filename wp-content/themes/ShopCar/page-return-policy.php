<?php
/**
 * Template Name: Chính sách đổi trả
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
                            <li class="axil-breadcrumb-item active">Chính sách đổi trả</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('return_policy_page_title', 'Chính sách đổi trả')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Return Policy Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="policy-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('return_policy_description', 'Chúng tôi cam kết đảm bảo quyền lợi của khách hàng với chính sách đổi trả minh bạch và công bằng.')); ?></p>
                    </div>

                    <!-- Return Conditions -->
                    <div class="return-conditions mb--50">
                        <h3 class="mb--30"><?php echo esc_html(get_theme_mod('return_conditions_title', 'Điều kiện đổi trả')); ?></h3>
                        <div class="row">
                            <div class="col-md-6 mb--20">
                                <div class="condition-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('return_condition1_title', 'Thời gian đổi trả')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('return_condition1_desc', 'Đổi trả trong vòng 7 ngày kể từ ngày nhận xe, với điều kiện xe chưa sử dụng hoặc có lỗi kỹ thuật.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="condition-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('return_condition2_title', 'Tình trạng xe')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('return_condition2_desc', 'Xe phải còn nguyên vẹn, chưa sửa chữa, chưa thay đổi phụ tùng gốc.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="condition-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('return_condition3_title', 'Giấy tờ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('return_condition3_desc', 'Cần có đầy đủ hóa đơn, hợp đồng mua bán và giấy tờ xe gốc.')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--20">
                                <div class="condition-box">
                                    <h5><i class="fas fa-check-circle text-success"></i> <?php echo esc_html(get_theme_mod('return_condition4_title', 'Lỗi kỹ thuật')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('return_condition4_desc', 'Nếu xe có lỗi kỹ thuật từ nhà sản xuất, chúng tôi sẽ đổi xe mới hoặc hoàn tiền 100%.')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Return Process -->
                    <div class="return-process mb--50">
                        <h3 class="mb--30"><?php echo esc_html(get_theme_mod('return_process_title', 'Quy trình đổi trả')); ?></h3>
                        <ol class="process-steps">
                            <li>
                                <strong><?php echo esc_html(get_theme_mod('return_process_step1', 'Liên hệ')); ?></strong>
                                <p><?php echo esc_html(get_theme_mod('return_process_step1_desc', 'Gọi hotline hoặc đến showroom để thông báo yêu cầu đổi trả.')); ?></p>
                            </li>
                            <li>
                                <strong><?php echo esc_html(get_theme_mod('return_process_step2', 'Kiểm tra')); ?></strong>
                                <p><?php echo esc_html(get_theme_mod('return_process_step2_desc', 'Chúng tôi sẽ kiểm tra tình trạng xe và xác nhận điều kiện đổi trả.')); ?></p>
                            </li>
                            <li>
                                <strong><?php echo esc_html(get_theme_mod('return_process_step3', 'Xử lý')); ?></strong>
                                <p><?php echo esc_html(get_theme_mod('return_process_step3_desc', 'Thực hiện đổi xe hoặc hoàn tiền trong vòng 3-5 ngày làm việc.')); ?></p>
                            </li>
                        </ol>
                    </div>

                    <!-- Refund Policy -->
                    <div class="refund-policy">
                        <h3 class="mb--30"><?php echo esc_html(get_theme_mod('refund_policy_title', 'Chính sách hoàn tiền')); ?></h3>
                        <div class="alert alert-info">
                            <p><strong><?php echo esc_html(get_theme_mod('refund_policy_note', 'Lưu ý:')); ?></strong></p>
                            <p><?php echo esc_html(get_theme_mod('refund_policy_description', 'Hoàn tiền sẽ được thực hiện qua tài khoản ngân hàng hoặc tiền mặt trong vòng 7-10 ngày làm việc. Phí vận chuyển (nếu có) sẽ không được hoàn lại.')); ?></p>
                        </div>
                    </div>

                    <div class="text-center mt--50">
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('return_policy_button_text', 'Liên hệ hỗ trợ')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.condition-box {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    height: 100%;
}
.process-steps {
    padding-left: 20px;
}
.process-steps li {
    margin-bottom: 20px;
    padding-left: 10px;
}
</style>

<?php get_footer(); ?>

