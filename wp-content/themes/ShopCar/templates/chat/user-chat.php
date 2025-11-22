<?php
/**
 * Template Name: User Chat
 */

get_header();

if (!is_user_logged_in()) {
    wp_redirect(home_url('/login'));
    exit;
}

// Đảm bảo script được enqueue
wp_enqueue_script('jquery'); // Đảm bảo jQuery được load
if (!wp_script_is('shopcar-chat', 'enqueued')) {
    wp_enqueue_script('shopcar-chat', get_template_directory_uri() . '/assets/js/chat.js', array('jquery'), '1.0.2', true);
    wp_localize_script('shopcar-chat', 'shopcar_chat', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('shopcar_chat_nonce')
    ));
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="chat-container">
                <h2 class="text-center mb-4">Chat Hỗ trợ Khách hàng</h2>
                <div class="chat-messages" id="chat-messages" style="height: 500px; overflow-y: auto; border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #f9f9f9; border-radius: 5px;">
                    <div class="text-center text-muted">Đang tải tin nhắn...</div>
                </div>
                <div class="chat-input-wrapper">
                    <div class="chat-input">
                        <textarea id="chat-message" placeholder="Nhập tin nhắn của bạn..." rows="4"></textarea>
                        <button id="send-message" class="btn-send">Gửi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Chat Input Wrapper */
.chat-input-wrapper {
    margin-top: 15px;
}

.chat-input {
    display: flex !important;
    gap: 12px !important;
    align-items: flex-end !important;
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    width: 100%;
    box-sizing: border-box;
}

.chat-input:focus-within {
    border-color: #007bff;
    box-shadow: 0 2px 12px rgba(0, 123, 255, 0.15);
}

/* Textarea Styles */
#chat-message {
    flex: 1 1 auto !important;
    min-width: 0 !important;
    min-height: 80px !important;
    max-height: 200px !important;
    padding: 14px 16px !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 15px !important;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
    line-height: 1.6 !important;
    background: #f8f9fa !important;
    color: #212529 !important;
    resize: none !important;
    box-sizing: border-box !important;
    overflow-y: auto !important;
    transition: all 0.2s ease !important;
    outline: none !important;
}

#chat-message::placeholder {
    color: #6c757d !important;
    opacity: 0.7 !important;
}

#chat-message:focus {
    background: #fff !important;
    box-shadow: inset 0 0 0 1px #007bff !important;
}

#chat-message::-webkit-scrollbar {
    width: 6px;
}

#chat-message::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#chat-message::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#chat-message::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Send Button */
.btn-send {
    min-width: 100px !important;
    max-width: 120px !important;
    width: auto !important;
    height: 80px !important;
    padding: 0 28px !important;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    color: #fff !important;
    border: none !important;
    border-radius: 8px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    white-space: nowrap !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3) !important;
    flex: 0 0 auto !important;
    flex-shrink: 0 !important;
    align-self: flex-end !important;
    box-sizing: border-box !important;
}

.btn-send:hover {
    background: linear-gradient(135deg, #0056b3 0%, #004085 100%) !important;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4) !important;
    transform: translateY(-1px);
}

.btn-send:active {
    transform: translateY(0);
    box-shadow: 0 2px 4px rgba(0, 123, 255, 0.3) !important;
}

.btn-send:disabled {
    background: #6c757d !important;
    cursor: not-allowed !important;
    box-shadow: none !important;
    transform: none !important;
}

.chat-message {
    margin-bottom: 15px;
    padding: 12px 15px;
    border-radius: 8px;
    word-wrap: break-word;
    max-width: 75%;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
}
.chat-message.user {
    background: #007bff;
    color: white;
    text-align: right;
    margin-left: auto;
    margin-right: 0;
}
.chat-message.user strong {
    color: white;
}
.chat-message.user small {
    color: rgba(255,255,255,0.8);
}
.chat-message.admin {
    background: #f1f1f1;
    color: #333;
    text-align: left;
    margin-left: 0;
    margin-right: auto;
}
.chat-message.admin strong {
    color: #007bff;
}
.chat-message strong {
    display: block;
    margin-bottom: 5px;
    font-size: 0.9em;
}
.chat-message span {
    display: block;
    line-height: 1.5;
}
.chat-message small {
    color: #666;
    font-size: 0.8em;
    margin-top: 5px;
    display: block;
}
#chat-messages {
    font-size: 14px;
}
</style>

<?php get_footer(); ?>
