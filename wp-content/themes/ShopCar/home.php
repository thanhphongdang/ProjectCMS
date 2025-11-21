<?php get_header(); ?>

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
                            <li class="axil-breadcrumb-item active">Blog</li>
                        </ul>

                        <h1 class="title">Latest Articles</h1>
                    </div>
                </div>

                <div class="col-lg-6 col-md-4">
                    <div class="inner">
                        <div class="bradcrumb-thumb">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/breadcrumb-blog.png" alt="Blog">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Blog List -->
    <div class="axil-product-area axil-section-gap">
        <div class="container">
            <div class="row row--15">

                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 mb--30">
                    <div class="axil-blog blog-style-one">

                        <!-- Thumbnail -->
                        <div class="thumbnail">
                            <a href="<?php the_permalink(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/default.jpg" alt="Blog">
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- Content -->
                        <div class="blog-content">
                            <h5 class="title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h5>

                            <div class="blog-meta">
                                <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="far fa-user"></i> <?php the_author(); ?></span>
                            </div>

                            <p class="excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="axil-btn btn-outline">
                                Read More
                            </a>
                        </div>

                    </div>
                </div>

                <?php endwhile; else: ?>

                <div class="col-12 text-center">
                    <h3>No blogs found</h3>
                </div>

                <?php endif; ?>

            </div>

            <!-- Pagination -->
            <div class="text-center mt--20">
                <?php the_posts_pagination(); ?>
            </div>

        </div>
    </div>

</main>

<?php get_footer(); ?>
