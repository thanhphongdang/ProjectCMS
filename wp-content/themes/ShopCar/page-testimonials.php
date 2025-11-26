<?php
/**
 * Template Name: Đánh giá khách hàng
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
                            <li class="axil-breadcrumb-item active">Đánh giá khách hàng</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('testimonials_page_title', 'Đánh giá khách hàng')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="testimonials-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('testimonials_page_description', 'Những phản hồi chân thực từ khách hàng đã sử dụng dịch vụ của chúng tôi.')); ?></p>
                    </div>

                    <!-- Testimonials Grid -->
                    <div class="testimonials-grid">
                        <div class="row">
                            <?php
                            for ($i = 1; $i <= 9; $i++) {
                                $customer_name = get_theme_mod('testimonial' . $i . '_name', '');
                                if ($customer_name) {
                            ?>
                            <div class="col-lg-4 col-md-6 mb--30">
                                <div class="testimonial-box">
                                    <div class="rating mb--15">
                                        <?php
                                        $rating = get_theme_mod('testimonial' . $i . '_rating', 5);
                                        for ($j = 1; $j <= 5; $j++) {
                                            echo $j <= $rating ? '<i class="fas fa-star text-warning"></i>' : '<i class="far fa-star text-warning"></i>';
                                        }
                                        ?>
                                    </div>
                                    <p class="testimonial-text"><?php echo esc_html(get_theme_mod('testimonial' . $i . '_text', '')); ?></p>
                                    <div class="testimonial-author">
                                        <strong><?php echo esc_html($customer_name); ?></strong>
                                        <span><?php echo esc_html(get_theme_mod('testimonial' . $i . '_car', '')); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="testimonials-stats mt--50">
                        <div class="row text-center">
                            <div class="col-md-4 mb--20">
                                <div class="stat-box">
                                    <h2><?php echo esc_html(get_theme_mod('testimonials_total', '500+')); ?></h2>
                                    <p><?php echo esc_html(get_theme_mod('testimonials_total_label', 'Khách hàng đánh giá')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="stat-box">
                                    <h2><?php echo esc_html(get_theme_mod('testimonials_rating', '4.8')); ?>/5</h2>
                                    <p><?php echo esc_html(get_theme_mod('testimonials_rating_label', 'Điểm đánh giá trung bình')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="stat-box">
                                    <h2><?php echo esc_html(get_theme_mod('testimonials_satisfaction', '98%')); ?></h2>
                                    <p><?php echo esc_html(get_theme_mod('testimonials_satisfaction_label', 'Khách hàng hài lòng')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="testimonials-cta text-center mt--50">
                        <h3><?php echo esc_html(get_theme_mod('testimonials_cta_title', 'Bạn cũng muốn chia sẻ trải nghiệm?')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('testimonials_cta_description', 'Hãy để lại đánh giá của bạn về dịch vụ của chúng tôi.')); ?></p>
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('testimonials_cta_button_text', 'Gửi đánh giá')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.testimonial-box {
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
    height: 100%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}
.testimonial-text {
    font-style: italic;
    margin-bottom: 20px;
    color: #555;
}
.testimonial-author {
    border-top: 1px solid #ddd;
    padding-top: 15px;
}
.testimonial-author strong {
    display: block;
    color: #333;
}
.testimonial-author span {
    color: #666;
    font-size: 14px;
}
.stat-box {
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
}
.stat-box h2 {
    color: #007bff;
    font-size: 48px;
    margin-bottom: 10px;
}
</style>

<?php get_footer(); ?>

