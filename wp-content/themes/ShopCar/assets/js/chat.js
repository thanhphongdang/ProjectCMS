jQuery(document).ready(function($) {
    // User Chat Functionality
    if ($('.chat-container').length) {
        loadMessages();
        setInterval(loadMessages, 5000); // Poll every 5 seconds

        $('#send-message').on('click', function() {
            var message = $('#chat-message').val().trim();
            if (message) {
                sendMessage(message);
            }
        });

        $('#chat-message').on('keypress', function(e) {
            if (e.which == 13 && !e.shiftKey) {
                e.preventDefault();
                $('#send-message').click();
            }
        });
    }

    // Admin Chat Functionality
    if ($('.admin-chat-container').length) {
        loadAdminChats();

        $(document).on('click', '.admin-chat-item', function() {
            var chatId = $(this).data('chat-id');
            loadChatMessages(chatId);
            $('.admin-chat-item').removeClass('active');
            $(this).addClass('active');
        });

        $('#admin-send-message').on('click', function() {
            var message = $('#admin-chat-message').val().trim();
            var chatId = $('.admin-chat-item.active').data('chat-id');
            if (message && chatId) {
                sendAdminMessage(message, chatId);
            }
        });
    }
});

function loadMessages() {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'get_chat_messages',
            nonce: shopcar_chat.nonce
        },
        success: function(response) {
            if (response.success) {
                displayMessages(response.data);
            }
        }
    });
}

function sendMessage(message) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'send_chat_message',
            message: message,
            nonce: shopcar_chat.nonce
        },
        success: function(response) {
            if (response.success) {
                $('#chat-message').val('');
                loadMessages();
            }
        }
    });
}

function displayMessages(messages) {
    var container = $('.chat-messages');
    container.empty();
    messages.forEach(function(msg) {
        var messageClass = msg.sender === 'user' ? 'user' : 'admin';
        var messageHtml = '<div class="chat-message ' + messageClass + '">' +
            '<strong>' + msg.sender_name + ':</strong> ' + msg.message +
            '<small>(' + msg.timestamp + ')</small>' +
            '</div>';
        container.append(messageHtml);
    });
    container.scrollTop(container[0].scrollHeight);
}

function loadAdminChats() {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'get_admin_chats',
            nonce: shopcar_chat.nonce
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
    container.empty();
    chats.forEach(function(chat) {
        var chatHtml = '<div class="admin-chat-item" data-chat-id="' + chat.id + '">' +
            chat.user_name + ' - ' + chat.last_message +
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
            nonce: shopcar_chat.nonce
        },
        success: function(response) {
            if (response.success) {
                displayMessages(response.data);
            }
        }
    });
}

function sendAdminMessage(message, chatId) {
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'send_admin_message',
            message: message,
            chat_id: chatId,
            nonce: shopcar_chat.nonce
        },
        success: function(response) {
            if (response.success) {
                $('#admin-chat-message').val('');
                loadChatMessages(chatId);
            }
        }
    });
}
