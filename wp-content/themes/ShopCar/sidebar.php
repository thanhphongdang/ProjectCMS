<div class="axil-single-widget">
    <h5 class="widget-title"><i class="far fa-search"></i> Search</h5>

    <form class="blog-search" method="get" action="<?php echo home_url('/'); ?>">
        <div class="search-group" style="position:relative;">
            <input 
                type="text" 
                name="s" 
                class="search-input" 
                placeholder="Search articles..."
                value="<?php echo get_search_query(); ?>"
                style="width:100%;padding:12px 45px 12px 15px;border-radius:6px;border:1px solid #ddd;">
            
            <button type="submit" 
                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;font-size:16px;color:#666;">
                <i class="far fa-search"></i>
            </button>
        </div>
    </form>
</div>

<!-- Recent Posts -->
<div class="axil-single-widget">
    <h5 class="widget-title"><i class="far fa-clock"></i> Recent Posts</h5>

    <ul class="axil-post-list">

        <?php
        $recent_posts = wp_get_recent_posts([
            'numberposts' => 5,
            'post_status' => 'publish'
        ]);

        foreach ($recent_posts as $post) :
            $thumb = get_the_post_thumbnail($post['ID'], 'thumbnail');
        ?>
            <li class="single-post" style="display:flex;gap:15px;margin-bottom:15px;">

                <!-- Thumbnail -->
                <div class="post-thumbnail" style="flex-shrink:0;">
                    <a href="<?php echo get_permalink($post['ID']); ?>">
                        <?php if ($thumb) : ?>
                            <?php echo $thumb; ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product/default-car.jpg"
                                 alt="Thumbnail"
                                 style="width:80px;height:80px;object-fit:cover;border-radius:6px;">
                        <?php endif; ?>
                    </a>
                </div>

                <!-- Content -->
                <div class="post-content">
                    <h6 class="title" style="font-size:15px;font-weight:600;margin-bottom:5px;">
                        <a href="<?php echo get_permalink($post['ID']); ?>" style="color:#111;">
                            <?php echo esc_html($post['post_title']); ?>
                        </a>
                    </h6>

                    <div class="meta" style="font-size:13px;color:#777;">
                        <i class="far fa-calendar-alt"></i>
                        <?php echo get_the_date('', $post['ID']); ?>
                    </div>
                </div>

            </li>
        <?php endforeach; ?>

    </ul>
</div>
