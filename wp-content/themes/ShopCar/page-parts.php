<?php
/**
 * Template Name: Phụ tùng & Phụ kiện
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
                            <li class="axil-breadcrumb-item active">Phụ tùng & Phụ kiện</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('parts_page_title', 'Phụ tùng & Phụ kiện')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Parts Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="parts-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('parts_page_description', 'Cung cấp phụ tùng chính hãng và phụ kiện chất lượng cao cho mọi dòng xe.')); ?></p>
                    </div>

                    <!-- Parts Categories -->
                    <div class="parts-categories mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('parts_categories_title', 'Danh mục phụ tùng')); ?></h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-cog fa-3x mb--15" style="color: #007bff;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category1_title', 'Động cơ')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category1_desc', 'Phụ tùng động cơ chính hãng')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-car-side fa-3x mb--15" style="color: #28a745;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category2_title', 'Hệ thống treo')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category2_desc', 'Giảm xóc, lò xo, thanh ổn định')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-tachometer-alt fa-3x mb--15" style="color: #ff497c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category3_title', 'Hệ thống phanh')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category3_desc', 'Má phanh, đĩa phanh, dầu phanh')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-lightbulb fa-3x mb--15" style="color: #ffc107;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category4_title', 'Đèn & Điện')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category4_desc', 'Đèn pha, đèn hậu, bộ điều khiển')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-wind fa-3x mb--15" style="color: #17a2b8;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category5_title', 'Hệ thống làm mát')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category5_desc', 'Tản nhiệt, quạt gió, dây đai')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-car-battery fa-3x mb--15" style="color: #6c757d;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category6_title', 'Ắc quy & Điện')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category6_desc', 'Ắc quy, máy phát, bộ sạc')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-spray-can fa-3x mb--15" style="color: #e83e8c;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category7_title', 'Nội thất')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category7_desc', 'Ghế, vô lăng, táp lô')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb--30">
                                <div class="category-box text-center">
                                    <i class="fas fa-paint-brush fa-3x mb--15" style="color: #fd7e14;"></i>
                                    <h5><?php echo esc_html(get_theme_mod('parts_category8_title', 'Ngoại thất')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('parts_category8_desc', 'Cản, gương, kính chắn gió')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Accessories -->
                    <div class="accessories-section mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('accessories_title', 'Phụ kiện xe hơi')); ?></h3>
                        <div class="row">
                            <div class="col-md-4 mb--20">
                                <div class="accessory-item">
                                    <h5><i class="fas fa-star"></i> <?php echo esc_html(get_theme_mod('accessory1_title', 'Camera hành trình')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('accessory1_desc', 'Camera chất lượng cao, ghi hình rõ nét')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="accessory-item">
                                    <h5><i class="fas fa-star"></i> <?php echo esc_html(get_theme_mod('accessory2_title', 'Dán phim cách nhiệt')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('accessory2_desc', 'Phim cách nhiệt cao cấp, bảo vệ da')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-4 mb--20">
                                <div class="accessory-item">
                                    <h5><i class="fas fa-star"></i> <?php echo esc_html(get_theme_mod('accessory3_title', 'Bọc ghế da')); ?></h5>
                                    <p><?php echo esc_html(get_theme_mod('accessory3_desc', 'Bọc ghế da cao cấp, sang trọng')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-primary">
                            <?php echo esc_html(get_theme_mod('parts_page_button_text', 'Xem sản phẩm')); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.category-box, .accessory-item {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
    transition: transform 0.3s;
}
.category-box:hover, .accessory-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
</style>

<?php get_footer(); ?>

