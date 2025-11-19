<?php get_header(); ?>

<div class="container" style="padding:60px 0;">
    <h1 class="page-title">Blog</h1>

    <div class="row">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="col-lg-4 col-md-6 mb--40">
                    <article class="single-blog">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                            <?php endif; ?>
                        </a>

                        <h3 class="blog-title mt--20">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <p class="excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                        </p>

                        <a class="axil-btn btn-bg-lighter" href="<?php the_permalink(); ?>">Read More</a>
                    </article>
                </div>

            <?php endwhile; ?>
        <?php else : ?>

            <p>No posts found.</p>

        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
            