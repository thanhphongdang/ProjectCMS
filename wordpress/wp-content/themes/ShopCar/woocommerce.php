<?php
/**
 * WooCommerce Page Wrapper for ShopCar Theme
 */
defined('ABSPATH') || exit;

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
                                <a href="<?php echo home_url('/'); ?>">Home</a>
                            </li>

                            <li class="separator"></li>

                            <li class="axil-breadcrumb-item active">
                                <?php 
                                if ( is_shop() ) {
                                    echo 'Shop';
                                } elseif ( is_product_category() ) {
                                    single_cat_title();
                                } elseif ( is_product() ) {
                                    the_title();
                                } else {
                                    woocommerce_page_title();
                                }
                                ?>
                            </li>
                        </ul>

                        <h1 class="title">
                            <?php 
                            if ( is_shop() ) {
                                echo 'Our Products';
                            } elseif ( is_product_category() ) {
                                single_cat_title();
                            } elseif ( is_product() ) {
                                the_title();
                            } else {
                                woocommerce_page_title();
                            }
                            ?>
                        </h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="Shop">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- WooCommerce Content -->
    <div class="axil-product-area axil-section-gap">
        <div class="container">
            <?php woocommerce_content(); ?>
        </div>
    </div>

</main>

<?php get_footer(); ?>
