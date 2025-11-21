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
                            <li class="axil-breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">
                                <?php single_cat_title(); ?>
                            </li>
                        </ul>

                        <h1 class="title"><?php single_cat_title(); ?></h1>
                        <p class="subtitle"><?php echo category_description(); ?></p>

                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/product-45.png" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Blog Posts -->
    <div class="axil-product-area axil-section-gap">
        <div class="container">

            <div class="row row--15">

                <?php if ( have_posts() ) : ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <div class="col-xl-3 col-lg-4 col-sm-6 mb--30">

                            <div class="axil-product product-style-one">

                                <div class="thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                </div>

                                <div class="product-content">
                                    <h5 class="title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>

                                    <p class="product-excerpt">
                                        <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                    </p>

                                    <a href="<?php the_permalink(); ?>" class="axil-btn btn-outline">View Details</a>
                                </div>

                            </div>

                        </div>

                    <?php endwhile; ?>

                <?php else : ?>

                    <div class="col-12 text-center">
                        <h3>No posts found</h3>
                    </div>

                <?php endif; ?>

            </div>

            <div class="text-center mt--20">
                <?php the_posts_pagination(); ?>
            </div>

        </div>
    </div>

</main>

<?php get_footer(); ?>
