<?php
/**
 * Template Name: So sánh xe
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
                            <li class="axil-breadcrumb-item active">So sánh xe</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('compare_page_title', 'So sánh xe')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Compare Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="compare-intro mb--40">
                        <p class="lead"><?php echo esc_html(get_theme_mod('compare_page_description', 'So sánh các mẫu xe để tìm ra lựa chọn phù hợp nhất với nhu cầu của bạn.')); ?></p>
                    </div>

                    <!-- Compare Table -->
                    <div class="compare-table-wrapper">
                        <table class="table table-bordered compare-table">
                            <thead>
                                <tr>
                                    <th>Tiêu chí</th>
                                    <th>Xe 1</th>
                                    <th>Xe 2</th>
                                    <th>Xe 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Giá bán</strong></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car1_price', 'Liên hệ')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car2_price', 'Liên hệ')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car3_price', 'Liên hệ')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Hãng xe</strong></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car1_brand', 'Toyota')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car2_brand', 'Honda')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car3_brand', 'Mazda')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Dung tích động cơ</strong></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car1_engine', '1.5L')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car2_engine', '1.8L')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car3_engine', '2.0L')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Hộp số</strong></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car1_transmission', 'CVT')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car2_transmission', 'CVT')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car3_transmission', '6 cấp')); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Tiêu thụ nhiên liệu</strong></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car1_fuel', '6.5L/100km')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car2_fuel', '7.0L/100km')); ?></td>
                                    <td><?php echo esc_html(get_theme_mod('compare_car3_fuel', '7.5L/100km')); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-center mt--40">
                        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('compare_page_button_text', 'Xem tất cả xe')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.compare-table {
    width: 100%;
    margin-top: 30px;
}
.compare-table th {
    background: #f5f5f5;
    font-weight: 600;
    padding: 15px;
}
.compare-table td {
    padding: 15px;
    text-align: center;
}
</style>

<?php get_footer(); ?>

