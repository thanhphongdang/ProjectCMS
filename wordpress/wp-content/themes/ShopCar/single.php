<?php
get_header();
?>

<main class="main-wrapper">

    <div class="axil-blog-area axil-section-gap">
        <div class="container">
            <div class="row">
                
                <!-- BLOG CONTENT -->
                <div class="col-lg-8">
                    <div class="axil-blog-details-area">
                        
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            <!-- Thumbnail -->
                            <div class="post-thumbnail mb--30">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h1 class="title mb--20"><?php the_title(); ?></h1>

                            <!-- Meta -->
                            <div class="post-meta-wrapper mb--30">
                                <div class="post-meta">
                                    <ul>
                                        <li>
                                            <i class="fal fa-user"></i>
                                            <?php the_author(); ?>
                                        </li>
                                        <li>
                                            <i class="fal fa-calendar-alt"></i>
                                            <?php echo get_the_date(); ?>
                                        </li>
                                        <li>
                                            <i class="fal fa-tags"></i>
                                            <?php the_category(', '); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="post-content">
                                <?php the_content(); ?>
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

<?php
get_footer();
?>
