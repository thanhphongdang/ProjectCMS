<?php
/*
Template Name: Wishlist
*/
get_header();
?>

<div class="axil-wishlist-area axil-section-gap">
    <div class="container">
        <div class="product-table-heading">
            <h4 class="title">My Wish List</h4>
        </div>

        <div class="table-responsive">
            <table class="table axil-product-table axil-wishlist-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th></th>
                        <th>Price</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    // LẤY SẢN PHẨM TRONG WISHLIST (ví dụ dùng meta user)
                    $user_id = get_current_user_id();
                    $wishlist = get_user_meta($user_id, '_wishlist', true);

                    if (!empty($wishlist)) :
                        $products = get_posts([
                            'post_type' => 'product',
                            'post__in' => $wishlist
                        ]);

                        foreach ($products as $product) :
                            $wc_product = wc_get_product($product->ID);
                    ?>
                        <tr>
                            <td><a href="#" class="remove-wishlist" data-id="<?php echo $product->ID; ?>"><i class="fal fa-times"></i></a></td>

                            <td class="product-thumbnail">
                                <a href="<?php echo get_permalink($product->ID); ?>">
                                    <?php echo get_the_post_thumbnail($product->ID, 'thumbnail'); ?>
                                </a>
                            </td>

                            <td class="product-title">
                                <a href="<?php echo get_permalink($product->ID); ?>">
                                    <?php echo $product->post_title; ?>
                                </a>
                            </td>

                            <td class="product-price"><?php echo $wc_product->get_price_html(); ?></td>

                            <td class="product-stock-status">
                                <?php echo $wc_product->is_in_stock() ? 'In Stock' : 'Out of Stock'; ?>
                            </td>

                            <td class="product-add-cart">
                                <a href="?add-to-cart=<?php echo $product->ID; ?>" class="axil-btn btn-outline">Add to Cart</a>
                            </td>
                        </tr>

                    <?php endforeach;
                    else : ?>

                        <tr>
                            <td colspan="6" class="text-center">Your wishlist is empty.</td>
                        </tr>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php get_footer(); ?>
