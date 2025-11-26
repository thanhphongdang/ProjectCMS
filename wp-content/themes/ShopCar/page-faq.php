<?php
/**
 * Template Name: Câu hỏi thường gặp
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
                            <li class="axil-breadcrumb-item active">FAQ</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('faq_page_title', 'Câu hỏi thường gặp')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="faq-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('faq_page_description', 'Tổng hợp các câu hỏi thường gặp về mua bán, bảo hành và dịch vụ xe hơi.')); ?></p>
                    </div>

                    <!-- FAQ Items -->
                    <div class="faq-accordion">
                        <div class="accordion" id="faqAccordion">
                            <?php
                            for ($i = 1; $i <= 10; $i++) {
                                $question = get_theme_mod('faq_question_' . $i, '');
                                $answer = get_theme_mod('faq_answer_' . $i, '');
                                
                                if ($question && $answer) {
                            ?>
                                <div class="card mb--15">
                                    <div class="card-header" id="heading<?php echo $i; ?>">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $i; ?>" aria-expanded="<?php echo $i === 1 ? 'true' : 'false'; ?>">
                                                <?php echo esc_html($question); ?>
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapse<?php echo $i; ?>" class="collapse <?php echo $i === 1 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $i; ?>" data-parent="#faqAccordion">
                                        <div class="card-body">
                                            <?php echo wpautop(esc_html($answer)); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Contact CTA -->
                    <div class="faq-cta text-center mt--50">
                        <h3><?php echo esc_html(get_theme_mod('faq_cta_title', 'Vẫn còn thắc mắc?')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('faq_cta_description', 'Liên hệ với chúng tôi để được tư vấn chi tiết hơn.')); ?></p>
                        <a href="<?php echo site_url('/contact'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('faq_cta_button_text', 'Liên hệ ngay')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.faq-accordion .card {
    border: 1px solid #ddd;
    border-radius: 8px;
}
.faq-accordion .card-header {
    background: #f9f9f9;
    border-bottom: 1px solid #ddd;
}
.faq-accordion .btn-link {
    color: #333;
    text-decoration: none;
    width: 100%;
    text-align: left;
    font-weight: 600;
}
.faq-accordion .btn-link:hover {
    color: #007bff;
}
</style>

<?php get_footer(); ?>

