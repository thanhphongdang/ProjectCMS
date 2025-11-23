<?php
/**
 * Template Name: Shopee Order Tracking
 */

get_header();
?>

<style>
/* Shopee style */
.shopee-box {
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    margin-top: 40px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.shopee-title {
    font-size: 22px;
    font-weight: 600;
    color: #ee4d2d;
}
.shopee-input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin-bottom: 15px;
}
.shopee-btn {
    background: #ee4d2d;
    border: none;
    padding: 12px 20px;
    color: #fff;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}
.shopee-btn:hover {
    background: #d84325;
}
.shopee-timeline {
    position: relative;
    margin-top: 25px;
    padding-left: 20px;
}
.shopee-step {
    margin-bottom: 25px;
    position: relative;
}
.shopee-step:before {
    content: "";
    width: 14px;
    height: 14px;
    background: #ccc;
    border-radius: 50%;
    position: absolute;
    left: -20px;
    top: 3px;
}
.shopee-step.active:before {
    background: #ee4d2d;
}
.shopee-step-line {
    width: 2px;
    background: #ddd;
    height: 100%;
    position: absolute;
    left: -13px;
    top: 16px;
}
.shopee-step:last-child .shopee-step-line {
    display: none;
}
.shopee-status-title {
    font-weight: 600;
    color: #333;
}
</style>

<div class="container" style="max-width:700px; margin: 40px auto;">
    <div class="shopee-box">
        <h3 class="shopee-title">Tra cứu đơn hàng</h3>

        <form method="post">
            <input type="text" name="order_id" class="shopee-input" placeholder="Nhập mã đơn hàng (VD: 2536)" required>
            <input type="text" name="order_email" class="shopee-input" placeholder="Email hoặc số điện thoại" required>

            <button class="shopee-btn">Tra cứu</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $order_id = sanitize_text_field($_POST['order_id']);
            $email = sanitize_text_field($_POST['order_email']);
            $order = wc_get_order($order_id);

            if (!$order) {
                echo "<p style='color:red;margin-top:10px;'>❌ Không tìm thấy đơn hàng.</p>";
            } else {
                $billing_email = $order->get_billing_email();
                $billing_phone = $order->get_billing_phone();

                if ($email !== $billing_email && $email !== $billing_phone) {
                    echo "<p style='color:red;margin-top:10px;'>❌ Email hoặc số điện thoại không đúng.</p>";
                } else {

                    $status = wc_get_order_status_name($order->get_status());
                    $date = $order->get_date_created()->date('d/m/Y H:i');
                    $total = wc_price($order->get_total());

                    echo "<div style='margin-top:20px; padding:15px; border-radius:10px; background:#fff7f5; border-left:4px solid #ee4d2d;'>
                            <p><strong>Mã đơn hàng:</strong> #$order_id</p>
                            <p><strong>Trạng thái:</strong> $status</p>
                            <p><strong>Ngày đặt:</strong> $date</p>
                            <p><strong>Tổng tiền:</strong> $total</p>
                          </div>";

                    // TIMELINE SHOPEE
                    $steps = [
                        'pending' => 'Chờ xác nhận',
                        'processing' => 'Đang chuẩn bị hàng',
                        'on-hold' => 'Tạm giữ',
                        'completed' => 'Giao hàng thành công',
                        'cancelled' => 'Đã hủy',
                        'refunded' => 'Hoàn tiền',
                    ];

                    echo '<div class="shopee-timeline">';
                    foreach ($steps as $key => $label) {

                        $active = ($order->get_status() === $key || array_search($order->get_status(), array_keys($steps)) >= array_search($key, array_keys($steps)))
                            ? 'active' : '';

                        echo "
                        <div class='shopee-step $active'>
                            <div class='shopee-step-line'></div>
                            <div class='shopee-status-title'>$label</div>
                        </div>";
                    }
                    echo '</div>';
                }
            }
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>
