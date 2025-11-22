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
});

function loadAdminChats() {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'get_admin_chats',
            nonce: '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>'
        },
        success: function(response) {
            if (response.success) {
                displayAdminChats(response.data);
            }
        }
    });
}

function displayAdminChats(chats) {
    var container = $('.admin-chat-list');
    container.find('.admin-chat-item').remove(); // Remove existing items except header
    chats.forEach(function(chat) {
        var chatHtml = '<div class="admin-chat-item" data-chat-id="' + chat.id + '" style="padding: 10px; border: 1px solid #ddd; margin-bottom: 5px; cursor: pointer; background: white;">' +
            '<strong>' + chat.user_name + '</strong><br>' +
            '<small>' + chat.last_message + '</small>' +
            '</div>';
        container.append(chatHtml);
    });
}

function loadChatMessages(chatId) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'get_chat_messages',
            chat_id: chatId,
            nonce: '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>'
        },
        success: function(response) {
            if (response.success) {
                displayMessages(response.data);
            }
        }
    });
}

function displayMessages(messages) {
    var container = $('#admin-chat-messages');
    container.empty();
    messages.forEach(function(msg) {
        var messageClass = msg.sender === 'user' ? 'user' : 'admin';
        var messageHtml = '<div class="chat-message ' + messageClass + '" style="margin-bottom: 10px; padding: 8px; border-radius: 5px; ' +
            (messageClass === 'user' ? 'background: #e3f2fd; text-align: right;' : 'background: #f5f5f5;') + '">' +
            '<strong>' + msg.sender_name + ':</strong> ' + msg.message +
            '<br><small>(' + msg.timestamp + ')</small>' +
            '</div>';
        container.append(messageHtml);
    });
    container.scrollTop(container[0].scrollHeight);
}

function sendAdminMessage(message, chatId) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'send_admin_message',
            message: message,
            chat_id: chatId,
            nonce: '<?php echo wp_create_nonce('shopcar_chat_nonce'); ?>'
        },
        success: function(response) {
            if (response.success) {
                $('#admin-chat-message').val('');
                loadChatMessages(chatId);
                loadAdminChats(); // Refresh chat list
            }
        }
    });
}
</script>
