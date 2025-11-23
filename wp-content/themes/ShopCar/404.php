<?php
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
                            <li class="axil-breadcrumb-item active">404 Not Found</li>
                        </ul>

                        <h1 class="title">Page Not Found</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner text-end">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 404 Content -->
    <section class="axil-error-area axil-section-gap">
        <div class="container text-center">

            <h1 class="error-title" style="font-size:100px;font-weight:700;color:#292930;">
                404
            </h1>

            <p class="mb--20" style="font-size:18px;color:#555;">
                Xin lỗi! Trang bạn đang tìm không tồn tại hoặc đã bị xóa.
            </p>

            <div class="mt--30">
                <a href="<?php echo home_url('/'); ?>" class="axil-btn btn-primary">
                    ⇦ Quay về trang chủ
                </a>
                <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-outline ms--10">
                    Xem sản phẩm
                </a>
            </div>

            <!-- Search Form -->
            <div class="mt--40" style="max-width: 400px; margin: 0 auto;">
                <form action="<?php echo home_url('/'); ?>" method="get" class="search-form">
                    <input type="text" name="s" class="input-text"
                           placeholder="Search for cars, posts..." 
                           style="width:100%;padding:12px;border-radius:6px;border:1px solid #ddd;">
                </form>
            </div>

        </div>
    </section>

</main>

<?php
get_footer();
?>
