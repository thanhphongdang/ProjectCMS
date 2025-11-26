<?php
/**
 * Template Name: Showroom & Đại lý
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
                            <li class="axil-breadcrumb-item active">Showroom & Đại lý</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('showroom_page_title', 'Showroom & Đại lý')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Showroom Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="showroom-intro text-center mb--50">
                        <p class="lead"><?php echo esc_html(get_theme_mod('showroom_page_description', 'Hệ thống showroom và đại lý trên toàn quốc, sẵn sàng phục vụ bạn.')); ?></p>
                    </div>

                    <!-- Main Showroom -->
                    <div class="main-showroom mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('main_showroom_title', 'Showroom chính')); ?></h3>
                        <div class="row">
                            <div class="col-md-6 mb--30">
                                <div class="showroom-box">
                                    <h4><?php echo esc_html(get_theme_mod('showroom1_name', 'Showroom Hà Nội')); ?></h4>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('showroom1_address', '123 Đường ABC, Quận XYZ, Hà Nội')); ?></p>
                                    <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('showroom1_phone', '024.1234.5678')); ?></p>
                                    <p><i class="fas fa-clock"></i> <?php echo esc_html(get_theme_mod('showroom1_hours', '8:00 - 20:00 hàng ngày')); ?></p>
                                </div>
                            </div>
                            <div class="col-md-6 mb--30">
                                <div class="showroom-box">
                                    <h4><?php echo esc_html(get_theme_mod('showroom2_name', 'Showroom TP.HCM')); ?></h4>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('showroom2_address', '456 Đường DEF, Quận UVW, TP.HCM')); ?></p>
                                    <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('showroom2_phone', '028.9876.5432')); ?></p>
                                    <p><i class="fas fa-clock"></i> <?php echo esc_html(get_theme_mod('showroom2_hours', '8:00 - 20:00 hàng ngày')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dealers -->
                    <div class="dealers-section mb--50">
                        <h3 class="text-center mb--40"><?php echo esc_html(get_theme_mod('dealers_title', 'Hệ thống đại lý')); ?></h3>
                        <div class="row">
                            <?php
                            for ($i = 1; $i <= 6; $i++) {
                                $dealer_name = get_theme_mod('dealer' . $i . '_name', '');
                                if ($dealer_name) {
                            ?>
                            <div class="col-md-4 mb--30">
                                <div class="dealer-box">
                                    <h5><?php echo esc_html($dealer_name); ?></h5>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_theme_mod('dealer' . $i . '_address', '')); ?></p>
                                    <p><i class="fas fa-phone"></i> <?php echo esc_html(get_theme_mod('dealer' . $i . '_phone', '')); ?></p>
                                </div>
                            </div>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="showroom-map mb--50">
                        <h3 class="text-center mb--30"><?php echo esc_html(get_theme_mod('showroom_map_title', 'Bản đồ showroom')); ?></h3>
                        <iframe 
                            width="100%" 
                            height="450" 
                            style="border:0; border-radius:10px;"
                            loading="lazy"
                            allowfullscreen
                            src="<?php echo esc_url(get_theme_mod('showroom_map_url', 'https://www.google.com/maps?q=car+showroom&t=&z=12&ie=UTF8&iwloc=&output=embed')); ?>">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.showroom-box, .dealer-box {
    padding: 25px;
    background: #f9f9f9;
    border-radius: 10px;
    height: 100%;
}
.showroom-box h4, .dealer-box h5 {
    color: #007bff;
    margin-bottom: 15px;
}
</style>

<?php get_footer(); ?>

