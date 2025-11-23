<?php

/**
 * Template: Single Product Content (Car Version – Premium Light UI)
 */
defined('ABSPATH') || exit;

global $product;

/* ===== Custom Car Fields ===== */
$car_year     = get_post_meta($product->get_id(), 'car_year', true);
$car_km       = get_post_meta($product->get_id(), 'car_km', true);
$car_engine   = get_post_meta($product->get_id(), 'car_engine', true);
$car_gearbox  = get_post_meta($product->get_id(), 'car_gearbox', true);
$car_fuel     = get_post_meta($product->get_id(), 'car_fuel', true);
$car_specs    = get_post_meta($product->get_id(), 'car_specs', true);

$categories   = wp_get_post_terms($product->get_id(), 'product_cat');

/* ===== Sale Percent ===== */
$sale_percent = "";
if ($product->is_on_sale()) {
    $regular = $product->get_regular_price();
    $sale    = $product->get_sale_price();

    if ($regular && $sale) {
        $sale_percent = round((($regular - $sale) / $regular) * 100);
    }
}
?>

<!-- ============================================================
     PREMIUM LIGHT UI FOR SINGLE PRODUCT PAGE
============================================================ -->
<style>
    /* ===== GLOBAL WRAPPER ===== */
    .single-product-area,
    .product-comments {
        background: #ffffff;
        color: #222;
        padding: 30px;
        border-radius: 16px;
        margin-top: 30px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    .single-product-content h1,
    .product-title {
        color: #0d2a4d !important;
        font-weight: 800;
        line-height: 1.2;
    }

    /* ===== TABLE ===== */
    .car-info-table table {
        background: #f8f9fc;
        border-radius: 12px;
        overflow: hidden;
    }

    .car-info-table table td {
        background: #f8f9fc !important;
        color: #333;
        border-color: rgba(0, 0, 0, 0.08);
        padding: 12px 16px;
        font-size: 15px;
    }

    .car-info-table strong {
        color: #0d6efd;
    }

    /* ===== PRICE ===== */
    .price-amount {
        font-size: 28px;
        color: #0d6efd;
        font-weight: 900;
        margin-bottom: 15px;
    }

    /* ===== COMMENT FORM ===== */
    #shopcar-comment-form {
        background: #f6f7fb;
        padding: 20px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    #shopcar-comment-form input,
    #shopcar-comment-form textarea {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.1);
        color: #222;
    }

    #shopcar-comment-form button {
        background: #0d6efd;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
    }

    /* ===== COMMENT LIST ===== */
    .single-comment {
        background: #f6f7fb;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 18px;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .single-comment strong {
        color: #0d6efd;
        font-size: 16px;
    }

    .single-comment p {
        margin: 6px 0 0;
        color: #444;
    }

    .delete-comment {
        margin-top: 8px;
        background: #d90429 !important;
        border: none;
    }

    .section-title-wrapper h2 {
        color: #0d2a4d !important;
    }
</style>



<div class="single-product-area">

    <div class="row">

        <!-- ==============================
             GALLERY
        =============================== -->
        <div class="col-lg-6 mb--40">
            <div class="single-product-gallery-wrapper" style="position: relative;">

                <?php if ($sale_percent): ?>
                    <span class="product-badge sale-badge"
                        style="background:#d90429;color:white;padding:8px 14px;border-radius:8px;position:absolute;top:20px;left:20px;font-size:16px;font-weight:600;">
                        -<?php echo $sale_percent; ?>%
                    </span>
                <?php endif; ?>

                <?php do_action('woocommerce_before_single_product_summary'); ?>
            </div>
        </div>

        <!-- ==============================
             PRODUCT INFO – LIGHT PREMIUM UI
        =============================== -->
        <div class="col-lg-6 mb--40">
            <div class="single-product-content">
                <div class="inner">

                    <h1 class="product-title"><?php the_title(); ?></h1>

                    <div class="price-amount">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <div class="product-rating mb--10">
                        <?php woocommerce_template_single_rating(); ?>
                    </div>

                    <div class="car-info-table mt--20">
                        <table class="table table-bordered">
                            <tbody>
                                <?php if ($categories): ?>
                                    <tr>
                                        <td><strong>Brand:</strong></td>
                                        <td><?php echo esc_html($categories[0]->name); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_year): ?>
                                    <tr>
                                        <td><strong>Year:</strong></td>
                                        <td><?php echo esc_html($car_year); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_km): ?>
                                    <tr>
                                        <td><strong>Km:</strong></td>
                                        <td><?php echo esc_html($car_km); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_engine): ?>
                                    <tr>
                                        <td><strong>Engine:</strong></td>
                                        <td><?php echo esc_html($car_engine); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_gearbox): ?>
                                    <tr>
                                        <td><strong>Gearbox:</strong></td>
                                        <td><?php echo esc_html($car_gearbox); ?></td>
                                    </tr>
                                <?php endif; ?>

                                <?php if ($car_fuel): ?>
                                    <tr>
                                        <td><strong>Fuel:</strong></td>
                                        <td><?php echo esc_html($car_fuel); ?></td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="description mt--20">
                        <?php the_content(); ?>
                    </div>

                    <?php if ($car_specs): ?>
                        <div class="mt--20">
                            <h5 style="color:#0d2a4d;"><strong>Technical Specs</strong></h5>
                            <p><?php echo nl2br(esc_html($car_specs)); ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="product-action-wrapper mt--20">
                        <?php woocommerce_template_single_add_to_cart(); ?>

                        <!-- =====================================
                             ⭐ BUTTON: PLACE ORDER (Option A)
                        ====================================== -->
                        <a href="<?php echo wc_get_checkout_url(); ?>?place_order_product=<?php echo $product->get_id(); ?>"
                            class="btn btn-primary"
                            style="
                                margin-top:15px;
                                display:inline-block;
                                width:100%;
                                text-align:center;
                                background:#0d6efd;
                                font-weight:600;
                                padding:12px 18px;
                                border-radius:8px;
                           ">
                            <!-- 🚗 Place Order -->
                            Buy Now
                        </a>
                        <!-- ===================================== -->

                    </div>

                    <div class="product-meta-info pt--20">
                        <?php woocommerce_template_single_meta(); ?>
                    </div>

                    <div class="product-wishlist mt--20">
                        <a href="#"
                            class="wishlist-btn"
                            data-product-id="<?php echo get_the_ID(); ?>"
                            style="
            display:inline-flex;
            align-items:center;
            padding:10px 18px;
            border:1px solid #000;
            border-radius:30px;
            font-weight:600;
            cursor:pointer;
       ">
                            ❤️ Yêu thích
                        </a>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const btn = document.querySelector(".wishlist-btn");

                            if (btn) {
                                btn.addEventListener("click", function(e) {
                                    e.preventDefault();

                                    let id = this.getAttribute("data-product-id");

                                    fetch("<?php echo home_url('/wp-json/wishlist/add'); ?>?id=" + id)
                                        .then(res => res.json())
                                        .then(data => {
                                            alert("Đã thêm vào danh sách yêu thích!");
                                        });
                                });
                            }
                        });
                    </script>


                    <div class="product-desc-wrapper pt--40">
                        <?php woocommerce_output_product_data_tabs(); ?>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


<!-- ============================================================
     RECENTLY VIEWED
============================================================ -->
<div class="axil-product-area bg-color-white axil-section-gap pb--50" style="background:#ffffff;">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="title-highlighter highlighter-primary">
                <i class="far fa-shopping-basket"></i> Your Recently
            </span>
            <h2 class="title">Viewed Items</h2>
        </div>

        <?php echo do_shortcode('[products limit="4" columns="4" orderby="rand" visibility="visible"]'); ?>
    </div>
</div>


<!-- ============================================================
     ⭐ COMMENT SYSTEM – PREMIUM LIGHT UI
============================================================ -->
<div class="product-comments container mt--50">
    <h3 class="mb--20" style="color:#0d6efd;">Bình luận sản phẩm</h3>

    <form id="shopcar-comment-form">
        <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">

        <?php if (!is_user_logged_in()): ?>
            <div class="row">
                <div class="col-md-6 mb--15">
                    <input type="text" class="form-control" name="author" placeholder="Tên của bạn" required>
                </div>
                <div class="col-md-6 mb--15">
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
            </div>
        <?php endif; ?>

        <textarea name="content" class="form-control mb--15" rows="4" placeholder="Nhập bình luận..." required></textarea>

        <button type="submit" class="btn btn-primary">Gửi bình luận</button>
    </form>

    <hr class="mt--30 mb--30">

    <div id="shopcar-comment-list">
        <?php
        $comments = get_comments([
            'post_id' => $product->get_id(),
            'status'  => 'approve'
        ]);

        if ($comments):
            foreach ($comments as $c):
        ?>
                <div class="single-comment mb--20" id="comment-<?php echo $c->comment_ID; ?>">
                    <strong><?php echo esc_html($c->comment_author); ?></strong>
                    <p><?php echo esc_html($c->comment_content); ?></p>

                    <?php if (is_user_logged_in() && get_current_user_id() == $c->user_id || current_user_can('administrator')): ?>
                        <button class="btn btn-sm btn-danger delete-comment"
                            data-id="<?php echo $c->comment_ID; ?>">
                            Xóa
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach;
        else: ?>
            <p style="color:#777;">Chưa có bình luận nào.</p>
        <?php endif; ?>
    </div>
</div>


<script>
    jQuery(document).ready(function($) {

        $("#shopcar-comment-form").on("submit", function(e) {
            e.preventDefault();

            $.post(ShopCarAjax.ajax_url, {
                action: "shopcar_add_comment",
                product_id: $("input[name='product_id']").val(),
                author: $("input[name='author']").val(),
                email: $("input[name='email']").val(),
                content: $("textarea[name='content']").val(),
            }, function(res) {
                if (res.success) {
                    location.reload();
                } else {
                    alert(res.data);
                }
            });
        });

        $(".delete-comment").on("click", function() {
            if (!confirm("Bạn chắc chắn muốn xóa?")) return;

            const id = $(this).data("id");

            $.post(ShopCarAjax.ajax_url, {
                action: "shopcar_delete_comment",
                comment_id: id,
            }, function(res) {
                if (res.success) {
                    $("#comment-" + id).remove();
                } else {
                    alert(res.data);
                }
            });
        });

    });
</script>