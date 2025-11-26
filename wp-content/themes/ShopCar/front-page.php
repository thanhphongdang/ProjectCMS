<?php
get_header();
?>

<main class="main-wrapper">

    <!-- ============ SLIDER ============ -->
    <div class="axil-main-slider-area main-slider-style-1 mb--40">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7 col-sm-12">
                    <div class="main-slider-content">
                        <h1 class="title"><?php echo esc_html(get_theme_mod('homepage_slider_title', 'Discover Premium Cars')); ?></h1>
                        <p class="subtitle"><?php echo esc_html(get_theme_mod('homepage_slider_subtitle', 'Luxury • Performance • Quality')); ?></p>
                        <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-primary mt--20">
                            <?php echo esc_html(get_theme_mod('homepage_slider_button_text', 'Shop Now')); ?>
                        </a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-5 col-sm-12 text-center">
                    <?php 
                    $slider_image = get_theme_mod('homepage_slider_image');
                    if ($slider_image) {
                        echo '<img class="img-fluid" src="' . esc_url($slider_image) . '" alt="Car Showcase">';
                    } else {
                        echo '<img class="img-fluid" src="' . get_template_directory_uri() . '/assets/images/product/product-45.png" alt="Car Showcase">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- ============ CATEGORIES ============ -->
    <section class="axil-categorie-area bg-color-white axil-section-gap">
        <div class="container">

            <div class="section-title-wrapper text-center mb--40">
                <span class="title-highlighter highlighter-secondary">
                    <i class="far fa-tags"></i> Categories
                </span>
                <h2 class="title"><?php echo esc_html(get_theme_mod('homepage_categories_title', 'Browse by Category')); ?></h2>
            </div>

            <div class="row justify-content-center">

                <?php
                $categories = get_terms([
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => false
                ]);

                foreach ($categories as $cat):
                    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                    $img = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                ?>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 mb--30">
                    <a href="<?php echo get_term_link($cat); ?>" class="category-box text-center">
                        <div class="category-thumb">
                            <img src="<?php echo esc_url($img); ?>"
                                 style="width:100px;height:100px;object-fit:contain;"
                                 class="img-fluid"
                                 alt="<?php echo esc_attr($cat->name); ?>">
                        </div>
                        <h6 class="cat-title mt--10"><?php echo esc_html($cat->name); ?></h6>
                    </a>
                </div>
                <?php endforeach; ?>

            </div>

        </div>
    </section>

    <!-- ============ FEATURED PRODUCTS ============ -->
    <section class="axil-product-area bg-color-white axil-section-gap">
        <div class="container">

            <div class="section-title-wrapper text-center mb--40">
                <span class="title-highlighter highlighter-primary">
                    <i class="far fa-shopping-basket"></i> Our Products
                </span>
                <h2 class="title"><?php echo esc_html(get_theme_mod('homepage_products_title', 'Explore Our Products')); ?></h2>
            </div>

            <div class="axil-product-list d-flex flex justify-content-center gap-4">
                <?php
                $products = wc_get_products([
                    'limit'   => absint(get_theme_mod('homepage_products_count', 6)),
                    'orderby' => 'date',
                    'order'   => 'DESC'
                ]);

                foreach ($products as $product):
                    setup_postdata($GLOBALS['post'] = get_post($product->get_id()));
                    wc_get_template_part('content', 'product');
                endforeach;

                wp_reset_postdata();
                ?>
            </div>

            <div class="text-center mt--30">
                <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="axil-btn btn-bg-lighter btn-load-more">
                    View All Products
                </a>
            </div>

        </div>
    </section>

    <!-- ============ NEW ARRIVALS ============ -->
    <section class="axil-new-arrivals-product-area axil-section-gap pb--0">
        <div class="container">
            <div class="section-title-wrapper text-center mb--40">
                <span class="title-highlighter highlighter-primary">
                    <i class="far fa-shopping-basket"></i>This Week’s
                </span>
                <h2 class="title">New Arrivals</h2>
            </div>

            <div class="axil-product-list d-flex flex-wrap justify-content-center gap-4">
                <?php
                $new_products = wc_get_products([
                    'limit'   => 6,
                    'orderby' => 'date',
                    'order'   => 'DESC'
                ]);

                foreach ($new_products as $product):
                    setup_postdata($GLOBALS['post'] = get_post($product->get_id()));
                    wc_get_template_part('content', 'product');
                endforeach;

                wp_reset_postdata();
                ?>
            </div>

        </div>
    </section>

    <!-- ============ NEWSLETTER ============ -->
    <section class="axil-newsletter-area axil-section-gap pt--0">
        <div class="container">
            <div class="etrade-newsletter-wrapper bg_image bg_image--8">
                <div class="newsletter-content text-center">
                    <span class="title-highlighter highlighter-primary2">
                        <i class="fas fa-envelope-open"></i>Newsletter
                    </span>

                    <h2 class="title mb--40"><?php echo esc_html(get_theme_mod('homepage_newsletter_title', 'Get Weekly Updates')); ?></h2>

                    <div class="newsletter-form d-flex justify-content-center">
                        <input type="email" placeholder="<?php echo esc_attr(get_theme_mod('homepage_newsletter_placeholder', 'example@gmail.com')); ?>" class="newsletter-input">
                        <button type="submit" class="axil-btn">Subscribe</button>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
