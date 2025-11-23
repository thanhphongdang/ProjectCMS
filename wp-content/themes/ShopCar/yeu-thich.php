<?php


/**
 * Template Name: Wishlist Page
 */
if (!is_user_logged_in()) {
    wp_redirect(site_url('/login'));
    exit;
}

get_header();

$wishlist = isset($_COOKIE['wishlist'])
    ? json_decode(stripslashes($_COOKIE['wishlist']), true)
    : [];
?>

<style>
    .wishlist-wrap {
        max-width: 900px;
        margin: 40px auto;
    }

    .wish-item {
        display: flex;
        border: 1px solid #ddd;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        position: relative;
        background: #fff;
    }

    .wish-item img {
        width: 130px;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        margin-right: 15px;
        cursor: pointer;
    }

    .wish-info {
        flex: 1;
    }

    .wish-info h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        cursor: pointer;
    }

    .wish-info p {
        margin: 5px 0;
        font-size: 15px;
        color: #333;
    }

    .wish-desc {
        max-height: 60px;
        overflow-y: auto;
        padding-right: 10px;
        line-height: 1.3;
        color: #444;
        border: 1px solid #eee;
        padding: 8px;
        border-radius: 6px;
    }

    .wish-remove {
        color: red;
        text-decoration: underline;
        cursor: pointer;
        position: absolute;
        right: 18px;
        top: 15px;
        font-weight: 600;
    }
</style>

<div class="wishlist-wrap">
    <h2>Favorites List</h2>

    <?php if (!$wishlist): ?>
        <p>Bạn chưa có sản phẩm nào trong danh sách yêu thích.</p>
    <?php endif; ?>

    <?php foreach ($wishlist as $pid):
        $p = wc_get_product($pid);
        if (!$p) continue;

        // Lấy brand từ taxonomy product_cat (giống trang chi tiết của bạn)
        $brand = "";
        $cats = wp_get_post_terms($pid, 'product_cat');
        if (!empty($cats)) {
            $brand = $cats[0]->name;
        }
    ?>
        <div class="wish-item" data-id="<?= $pid ?>">

            <!-- ẢNH → click vào sẽ vào trang chi tiết -->
            <a href="<?= get_permalink($pid); ?>">
                <img src="<?= wp_get_attachment_url($p->get_image_id()); ?>">
            </a>

            <div class="wish-info">

                <!-- TÊN → click vào sẽ vào trang chi tiết -->
                <a href="<?= get_permalink($pid); ?>" style="text-decoration:none; color:#000;">
                    <h3><?= $p->get_name(); ?></h3>
                </a>

                <p><strong>Hãng xe:</strong> <?= $brand ?: 'Đang cập nhật'; ?></p>

                <div class="wish-desc">
                    <?= wp_trim_words($p->get_description(), 50); ?>
                </div>
            </div>

            <span class="wish-remove">Xóa</span>
        </div>
    <?php endforeach; ?>
</div>

<script>
    document.querySelectorAll(".wish-remove").forEach(btn => {
        btn.addEventListener("click", function() {
            const item = this.closest(".wish-item");
            const id = item.getAttribute("data-id");

            fetch("<?php echo home_url('/wp-json/wishlist/remove'); ?>?id=" + id)
                .then(() => item.remove());
        });
    });
</script>

<?php get_footer(); ?>