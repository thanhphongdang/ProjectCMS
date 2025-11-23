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
                            <li class="axil-breadcrumb-item">
                                <a href="<?php echo home_url(); ?>">Home</a>
                            </li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">
                                Blog Detail
                            </li>
                        </ul>

                        <h1 class="title"><?php the_title(); ?></h1>
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

    <!-- Blog Content Area -->
    <div class="axil-blog-area axil-section-gap">
        <div class="container">
            <div class="row">

                <!-- LEFT CONTENT -->
                <div class="col-lg-8">
                    <div class="axil-blog-details-area">

                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            <!-- Thumbnail -->
                            <div class="post-thumbnail mb--30">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                                <?php endif; ?>
                            </div>

                            <!-- Meta -->
                            <div class="post-meta-wrapper mb--20">
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fal fa-user"></i> <?php the_author(); ?></li>
                                        <li><i class="fal fa-calendar-alt"></i> <?php echo get_the_date(); ?></li>
                                        <li><i class="fal fa-tags"></i> <?php the_category(', '); ?></li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Title -->
                            <h1 class="title mb--20"><?php the_title(); ?></h1>

                            <!-- Content -->
                            <div class="post-content mb--50">
                                <?php the_content(); ?>
                            </div>

                            <!-- Post Navigation -->
                            <div class="post-navigation d-flex justify-content-between mb--50">
                                <div class="prev-post">
                                    <?php previous_post_link('%link', '<i class="fal fa-arrow-left"></i> Prev'); ?>
                                </div>

                                <div class="next-post">
                                    <?php next_post_link('%link', 'Next <i class="fal fa-arrow-right"></i>'); ?>
                                </div>
                            </div>

                            <!-- Related Posts -->
                            <div class="related-post-area mt--40">
                                <h3 class="title mb--20">Related Articles</h3>

                                <div class="row row--15">
                                    <?php
                                    $related = new WP_Query([
                                        'category__in'   => wp_get_post_categories(get_the_ID()),
                                        'posts_per_page' => 3,
                                        'post__not_in'   => [get_the_ID()]
                                    ]);

                                    if ($related->have_posts()) :
                                        while ($related->have_posts()) : $related->the_post();
                                    ?>
                                            <div class="col-lg-4 col-sm-6 mb--20">
                                                <div class="axil-blog-list">
                                                    <div class="thumbnail">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php
                                                            if (has_post_thumbnail()) the_post_thumbnail('medium');
                                                            else echo '<img src="' . get_template_directory_uri() . '/assets/images/product/default-car.jpg">';
                                                            ?>
                                                        </a>
                                                    </div>

                                                    <h6 class="title mt--10">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>

                                    <?php endwhile; endif;
                                    wp_reset_postdata();
                                    ?>
                                </div>

                            </div>

                        <?php endwhile; endif; ?>

                    </div>
                </div>

                <!-- SIDEBAR -->
                <div class="col-lg-4">
                    <aside class="axil-sidebar">
                        <?php get_sidebar(); ?>
                    </aside>
                </div>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
