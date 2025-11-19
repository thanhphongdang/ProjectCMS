<div class="axil-single-widget">
    <h5 class="widget-title">Search</h5>
    <?php get_search_form(); ?>
</div>

<div class="axil-single-widget">
    <h5 class="widget-title">Recent Posts</h5>
    <ul class="recent-post-list">
        <?php
        $recent = wp_get_recent_posts(['numberposts' => 5]);
        foreach ($recent as $post) :
        ?>
            <li>
                <a href="<?php echo get_permalink($post['ID']); ?>">
                    <?php echo $post['post_title']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
