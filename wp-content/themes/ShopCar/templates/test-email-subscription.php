<?php
/**
 * Template Name: Test Email Subscription
 * Trang test nhanh tính năng đăng ký email
 */

get_header();
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card p-4">
                <h1 class="text-center mb-4">Đăng Ký Nhận Thông Báo Sản Phẩm Mới</h1>
                
                <?php echo do_shortcode('[shopcar_email_subscription]'); ?>
            </div>
        </div>
    </div>
</div>


<?php get_footer(); ?>

