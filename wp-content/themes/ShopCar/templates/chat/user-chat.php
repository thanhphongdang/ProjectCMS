<?php
/**
 * Template Name: User Chat
 */

get_header();

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="chat-container">
                <h2 class="text-center mb-4">Chat Hỗ trợ Khách hàng</h2>
                <div class="chat-messages" id="chat-messages">
                    <!-- Messages will be loaded here -->
                </div>
                <div class="chat-input">
                    <textarea id="chat-message" placeholder="Nhập tin nhắn của bạn..." rows="3"></textarea>
                    <button id="send-message" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
