<?php
/**
 * Template Name: Tin tức & Blog
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
                            <li class="axil-breadcrumb-item"><a href="<?php echo home_url('/'); ?>">Home</a></li>
                            <li class="separator"></li>
                            <li class="axil-breadcrumb-item active">Tin tức</li>
                        </ul>
                        <h1 class="title"><?php echo esc_html(get_theme_mod('blog_page_title', 'Tin tức & Blog')); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Section -->
    <div class="axil-section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-intro mb--40">
                        <p class="lead"><?php echo esc_html(get_theme_mod('blog_page_description', 'Cập nhật tin tức mới nhất về thị trường xe hơi, đánh giá xe và mẹo sử dụng xe.')); ?></p>
                    </div>

                    <!-- Blog Posts -->
                    <?php
                    $blog_query = new WP_Query([
                        'post_type' => 'post',
                        'posts_per_page' => get_theme_mod('blog_posts_per_page', 6),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ]);

                    if ($blog_query->have_posts()) :
                        while ($blog_query->have_posts()) : $blog_query->the_post();
                    ?>
                        <article class="blog-post mb--40">
                            <div class="row">
                                <div class="col-md-4">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded']); ?>
                                        <?php else : ?>
                                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog/default.jpg" alt="<?php the_title(); ?>" class="img-fluid rounded">
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="post-meta mb--15">
                                        <span><i class="far fa-calendar"></i> <?php echo get_the_date(); ?></span>
                                        <span class="ml--20"><i class="far fa-user"></i> <?php the_author(); ?></span>
                                    </div>
                                    <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="axil-btn btn-bg-lighter"><?php echo esc_html(get_theme_mod('blog_read_more_text', 'Đọc thêm')); ?></a>
                                </div>
                            </div>
                        </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
                        <p><?php echo esc_html(get_theme_mod('blog_no_posts_text', 'Chưa có bài viết nào.')); ?></p>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="sidebar-widget mb--40">
                            <h4><?php echo esc_html(get_theme_mod('blog_sidebar_title', 'Bài viết mới nhất')); ?></h4>
                            <?php
                            $recent_posts = new WP_Query([
                                'post_type' => 'post',
                                'posts_per_page' => 5,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ]);
                            if ($recent_posts->have_posts()) :
                                echo '<ul class="recent-posts">';
                                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                endwhile;
                                echo '</ul>';
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>

                        <div class="sidebar-widget">
                            <h4><?php echo esc_html(get_theme_mod('blog_categories_title', 'Danh mục')); ?></h4>
                            <ul class="categories">
                                <?php
                                $categories = get_categories();
                                foreach ($categories as $category) {
                                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $category->name . ' (' . $category->count . ')</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<style>
.blog-post {
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
}
.post-meta {
    color: #666;
    font-size: 14px;
}
.recent-posts, .categories {
    list-style: none;
    padding: 0;
}
.recent-posts li, .categories li {
    padding: 8px 0;
    border-bottom: 1px solid #eee;
}
</style>

<?php get_footer(); ?>

