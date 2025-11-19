<?php
/**
 * Template Name: Blog Grid
 */
get_header();
?>

<div class="axil-breadcrumb-area">
    <div class="container">
        <h1 class="title">Blog</h1>
    </div>
</div>

<div class="axil-blog-area axil-section-gap">
    <div class="container">
        <div class="row">

            <!-- LEFT CONTENT -->
            <div class="col-lg-8">
                <div class="row g-5">

                    <?php
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    $blog_query = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => 6,
                        'paged'          => $paged
                    ]);

                    if ($blog_query->have_posts()):
                        while ($blog_query->have_posts()): $blog_query->the_post();
                    ?>

                    <div class="col-md-6">
                        <div class="content-blog blog-grid">
                            <div class="inner">

                                <!-- Thumbnail -->
                                <div class="thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()): ?>
                                            <?php the_post_thumbnail('medium'); ?>
                                        <?php else: ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/blog-10.png">
                                        <?php endif; ?>
                                    </a>

                                    <!-- Category -->
                                    <div class="blog-category">
                                        <?php
                                        $cats = get_the_category();
                                        if (!empty($cats)):
                                            echo '<a href="' . get_category_link($cats[0]->term_id) . '">'
                                                . $cats[0]->name .
                                            '</a>';
                                        endif;
                                        ?>
                                    </div>
                                </div>

                                <div class="content">
                                    <h5 class="title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>

                                    <div class="read-more-btn">
                                        <a class="axil-btn right-icon" href="<?php the_permalink(); ?>">
                                            Read More <i class="fal fa-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <?php endwhile; endif; wp_reset_postdata(); ?>

                </div>

                <!-- PAGINATION -->
                <div class="post-pagination">
                    <?php
                        echo paginate_links([
                            'total'   => $blog_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => '<i class="fal fa-arrow-left"></i>',
                            'next_text' => '<i class="fal fa-arrow-right"></i>',
                        ]);
                    ?>
                </div>
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>
