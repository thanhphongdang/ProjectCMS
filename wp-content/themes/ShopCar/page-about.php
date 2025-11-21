<?php
/*
Template Name: About Page
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
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url(); ?>">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">About Us</li>
                        </ul>
                        <h1 class="title">About Our Dealership</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner text-end">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/about-banner.jpg" 
                                 alt="Showroom">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="axil-about-area about-style-1 axil-section-gap">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left Image -->
                <div class="col-xl-5 col-lg-6 mb--30">
                    <div class="about-thumbnail">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/car/showroom.jpg"
                             class="img-fluid rounded"
                             alt="Showroom Car">
                    </div>
                </div>

                <!-- Right Content -->
                <div class="col-xl-7 col-lg-6">
                    <div class="about-content content-right">

                        <span class="title-highlighter highlighter-primary2">
                            <i class="far fa-car"></i> Who We Are
                        </span>

                        <h3 class="title">
                            Chúng tôi là đại lý ô tô uy tín – nơi bạn tìm được chiếc xe phù hợp nhất.
                        </h3>

                        <p class="text-heading">
                            Với nhiều năm kinh nghiệm trong lĩnh vực mua bán xe hơi,
                            chúng tôi cam kết mang đến cho khách hàng những mẫu xe chất lượng,
                            giá tốt, kèm theo chính sách bảo hành – bảo dưỡng tối ưu.
                        </p>

                        <div class="row mt--20">
                            <div class="col-md-6">
                                <p>✔ Xe mới – xe lướt – xe cũ chất lượng cao</p>
                                <p>✔ Hỗ trợ trả góp lên đến 70%</p>
                                <p>✔ Kiểm định kỹ thuật chuyên sâu</p>
                            </div>
                            <div class="col-md-6">
                                <p>✔ Báo giá nhanh – minh bạch</p>
                                <p>✔ Bảo hành chính hãng</p>
                                <p>✔ Giao xe tận nhà toàn quốc</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Stats -->
    <div class="about-info-area">
        <div class="container">
            <div class="row row--20">

                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/shape-01.png">
                        </div>
                        <div class="content">
                            <h6 class="title">5,000+ Xe đã bán</h6>
                            <p>Hơn 5,000 khách hàng tin tưởng và lựa chọn.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/shape-02.png">
                        </div>
                        <div class="content">
                            <h6 class="title">10+ Năm kinh nghiệm</h6>
                            <p>Đội ngũ chuyên gia tư vấn xe chuyên nghiệp.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="about-info-box">
                        <div class="thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about/shape-03.png">
                        </div>
                        <div class="content">
                            <h6 class="title">98% Khách hàng hài lòng</h6>
                            <p>Uy tín tạo nên thương hiệu.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Team -->
    <div class="axil-team-area bg-wild-sand axil-section-gap">
        <div class="container">
            
            <div class="section-title-wrapper text-center">
                <span class="title-highlighter highlighter-primary">
                    <i class="fas fa-users"></i> Our Team
                </span>
                <h3 class="title">Đội ngũ tư vấn chuyên nghiệp</h3>
            </div>

            <div class="row row--20 team-wrapper mt--20">

                <div class="col-lg-3 col-md-6">
                    <div class="axil-team-member">
                        <div class="thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-01.png">
                        </div>
                        <div class="team-content">
                            <span class="subtitle">Sale Manager</span>
                            <h5 class="title">Đặng Thanh Phong</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="axil-team-member">
                        <div class="thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-02.png">
                        </div>
                        <div class="team-content">
                            <span class="subtitle">Consultant</span>
                            <h5 class="title">Bùi Thẩm Kỳ</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="axil-team-member">
                        <div class="thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-03.png">
                        </div>
                        <div class="team-content">
                            <span class="subtitle">Technical Expert</span>
                            <h5 class="title">Nguyễn Hữu Hào Hùng</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="axil-team-member">
                        <div class="thumbnail">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/team/team-03.png">
                        </div>
                        <div class="team-content">
                            <span class="subtitle">Founder</span>
                            <h5 class="title">Nguyễn Thanh Lân</h5>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</main>

<?php get_footer(); ?>
