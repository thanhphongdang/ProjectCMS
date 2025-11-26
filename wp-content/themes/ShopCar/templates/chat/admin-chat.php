<style>
    .admin-chat-item:hover {
        background: #f0f0f0 !important;
    }

    .admin-chat-item.active {
        background: #0073aa !important;
        color: white;
        border-color: #0073aa !important;
    }

    .admin-chat-item.active strong,
    .admin-chat-item.active small {
        color: white !important;
    }

    .chat-input {
        display: flex;
        gap: 10px;
    }

    .chat-input textarea {
        flex: 1;
    }
</style>

<div class="wrap">
    <h1>Chat Hỗ trợ Khách hàng</h1>

    <div class="admin-chat-container" style="display: flex; gap: 20px;">
        <!-- Chat List -->
        <div class="admin-chat-list" style="flex: 1; max-width: 300px;">
            <h3>Danh sách Chat</h3>
            <!-- Chat items will be loaded here via AJAX -->
        </div>

        <!-- Chat Interface -->
        <div class="admin-chat-interface" style="flex: 2;">
            <div class="chat-container">
                <div class="chat-messages" id="admin-chat-messages" style="height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; background: white; border-radius: 5px;">
                    <!-- Messages will be loaded here -->
                </div>

                <div class="chat-input">
                    <textarea id="admin-chat-message" placeholder="Nhập phản hồi..." rows="3" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;"></textarea>
                    <button id="admin-send-message" class="button button-primary" style="padding: 10px 20px;">Gửi</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Load admin chats on page load
        loadAdminChats();

        // Handle chat item click
        $(document).on('click', '.admin-chat-item', function() {
            var chatId = $(this).data('chat-id');
            $('.admin-chat-item').removeClass('active');
            $(this).addClass('active');
            loadChatMessages(chatId);
        });

        // Handle send message
        $('#admin-send-message').on('click', function() {
            var message = $('#admin-chat-message').val().trim();
            var chatId = $('.admin-chat-item.active').data('chat-id');
            if (message && chatId) {
                sendAdminMessage(message, chatId);
            }
        });

        $('#admin-chat-message').on('keypress', function(e) {
            if (e.which == 13 && !e.shiftKey) {
                e.preventDefault();
                $('#admin-send-message').click();
            }
        });

        // Auto refresh chat list every 5 seconds
        setInterval(function() {
            if ($('.admin-chat-item.active').length) {
                var activeChatId = $('.admin-chat-item.active').data('chat-id');
                if (activeChatId) {
                    loadChatMessages(activeChatId);
                }
            }
            loadAdminChats();
        }, 5000);
    });

    function loadAdminChats() {
        var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
        var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>';
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_admin_chats',
                nonce: nonce
            },
            success: function(response) {
                if (response.success) {
                    displayAdminChats(response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tải danh sách chat:', error);
            }
        });
    }

    function displayAdminChats(chats) {
        var container = $('.admin-chat-list');
        container.find('h3').nextAll().remove(); // Remove existing items except header

        if (!chats || chats.length === 0) {
            container.append('<div class="text-muted" style="padding: 10px;">Chưa có cuộc trò chuyện nào.</div>');
            return;
        }

        chats.forEach(function(chat) {
            var lastMsg = chat.last_message || 'Chưa có tin nhắn';
            if (lastMsg.length > 50) {
                lastMsg = lastMsg.substring(0, 50) + '...';
            }
            var chatHtml = '<div class="admin-chat-item" data-chat-id="' + chat.id + '" style="padding: 10px; border: 1px solid #ddd; margin-bottom: 5px; cursor: pointer; background: white; border-radius: 3px;">' +
                '<strong>' + escapeHtml(chat.user_name || 'Unknown') + '</strong><br>' +
                '<small style="color: #666;">' + escapeHtml(lastMsg) + '</small>' +
                '</div>';
            container.append(chatHtml);
        });
    }

    function loadChatMessages(chatId) {
        var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
        var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>';
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_chat_messages',
                chat_id: chatId,
                nonce: nonce
            },
            success: function(response) {
                if (response.success) {
                    displayMessages(response.data);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tải tin nhắn:', error);
            }
        });
    }

    function displayMessages(messages) {
        var container = $('#admin-chat-messages');
        container.empty();

        if (!messages || messages.length === 0) {
            container.html('<div class="text-center text-muted">Chưa có tin nhắn nào. Hãy bắt đầu cuộc trò chuyện!</div>');
            return;
        }

        messages.forEach(function(msg) {
            var messageClass = msg.sender === 'user' ? 'user' : 'admin';
            var timestamp = msg.timestamp ? formatTimestamp(msg.timestamp) : '';
            var messageHtml = '<div class="chat-message ' + messageClass + '" style="margin-bottom: 10px; padding: 8px; border-radius: 5px; ' +
                (messageClass === 'user' ? 'background: #e3f2fd; text-align: right;' : 'background: #f5f5f5;') + '">' +
                '<strong>' + (msg.sender_name || msg.sender) + ':</strong> ' + escapeHtml(msg.message) +
                (timestamp ? '<br><small>(' + timestamp + ')</small>' : '') +
                '</div>';
            container.append(messageHtml);
        });

        if (container.length && container[0].scrollHeight) {
            container.scrollTop(container[0].scrollHeight);
        }
    }

    function formatTimestamp(timestamp) {
        if (!timestamp) return '';

        // CHUẨN HÓA FORMAT MySQL -> ISO, thêm Z để tránh lệch +7h
        let isoString = timestamp.replace(' ', 'T') + 'Z';

        // Tạo object Date theo UTC
        let date = new Date(isoString);

        if (isNaN(date.getTime())) return timestamp;

        // Chuyển giờ UTC -> Múi giờ Việt Nam (UTC+7)
        let vnDate = new Date(date.getTime() + 7 * 60 * 60 * 1000);

        let now = new Date();
        let diff = now - vnDate;

        let minutes = Math.floor(diff / 60000);
        let hours = Math.floor(diff / 3600000);
        let days = Math.floor(diff / 86400000);

        if (minutes < 1) return 'Vừa xong';
        if (minutes < 60) return minutes + ' phút trước';
        if (hours < 24) return hours + ' giờ trước';
        if (days < 7) return days + ' ngày trước';

        return vnDate.toLocaleDateString('vi-VN') + ' ' +
            vnDate.toLocaleTimeString('vi-VN', {
                hour: '2-digit',
                minute: '2-digit'
            });
    }


    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) {
            return map[m];
        });
    }

    function sendAdminMessage(message, chatId) {
        var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
        var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>';
        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'send_admin_message',
                message: message,
                chat_id: chatId,
                nonce: nonce
            },
            success: function(response) {
                if (response.success) {
                    $('#admin-chat-message').val('');
                    loadChatMessages(chatId);
                    loadAdminChats(); // Refresh chat list
                } else {
                    alert('Không thể gửi tin nhắn. Vui lòng thử lại.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi gửi tin nhắn:', error);
                alert('Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại.');
            }
        });
    }
</script>