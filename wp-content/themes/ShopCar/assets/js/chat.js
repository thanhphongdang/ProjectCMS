jQuery(document).ready(function($) {
    // Đảm bảo shopcar_chat được định nghĩa
    if (typeof shopcar_chat === 'undefined') {
        // Fallback: tạo object mặc định
        window.shopcar_chat = {
            ajaxurl: typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php',
            nonce: ''
        };
        console.warn('shopcar_chat không được định nghĩa, sử dụng giá trị mặc định');
    }
    
    // User Chat Functionality
    if ($('.chat-container').length) {
        // Đợi một chút để đảm bảo shopcar_chat đã được load
        setTimeout(function() {
            loadMessages();
            setInterval(loadMessages, 5000); // Poll every 5 seconds
        }, 500);

        $('#send-message').on('click', function() {
            var message = $('#chat-message').val().trim();
            if (message) {
                sendMessage(message);
            } else {
                alert('Vui lòng nhập tin nhắn!');
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
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        return;
    }
    var $ = jQuery;
    
    // Đảm bảo shopcar_chat tồn tại
    if (typeof shopcar_chat === 'undefined') {
        window.shopcar_chat = {
            ajaxurl: typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php',
            nonce: ''
        };
    }
    
    var ajaxUrl = shopcar_chat.ajaxurl || (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
    var nonce = shopcar_chat.nonce || '';
    
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
            action: 'get_chat_messages',
            nonce: nonce
        },
        success: function(response) {
            if (response && response.success) {
                displayMessages(response.data || []);
            } else {
                console.error('Lỗi khi tải tin nhắn:', response);
                var container = $('#chat-messages');
                if (container.length) {
                    container.html('<div class="text-center text-danger">Lỗi khi tải tin nhắn. Vui lòng thử lại.</div>');
                }
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi tải tin nhắn:', {
                status: status,
                error: error,
                response: xhr.responseText,
                statusCode: xhr.status
            });
            var container = $('#chat-messages');
            if (container.length) {
                container.html('<div class="text-center text-danger">Không thể kết nối đến server. Vui lòng thử lại sau.</div>');
            }
        }
    });
}

function sendMessage(message) {
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        alert('Lỗi: jQuery chưa được load. Vui lòng refresh trang.');
        return;
    }
    var $ = jQuery;
    
    if (!message || message.trim() === '') {
        alert('Vui lòng nhập tin nhắn!');
        return;
    }
    
    // Đảm bảo shopcar_chat tồn tại
    if (typeof shopcar_chat === 'undefined') {
        window.shopcar_chat = {
            ajaxurl: typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php',
            nonce: ''
        };
    }
    
    // Disable button while sending
    var $sendBtn = $('#send-message');
    var originalText = $sendBtn.text();
    $sendBtn.prop('disabled', true).text('Đang gửi...');
    
    var ajaxUrl = shopcar_chat.ajaxurl || (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
    var nonce = shopcar_chat.nonce || '';
    
    $.ajax({
        url: ajaxUrl,
        type: 'POST',
        data: {
            action: 'send_chat_message',
            message: message.trim(),
            nonce: nonce
        },
        success: function(response) {
            if (response && response.success) {
                $('#chat-message').val('');
                // Reload messages immediately
                setTimeout(function() {
                    loadMessages();
                }, 300);
            } else {
                var errorMsg = 'Không thể gửi tin nhắn.';
                if (response && response.data) {
                    errorMsg += ' ' + response.data;
                }
                alert(errorMsg);
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi tin nhắn:', {
                status: status,
                error: error,
                response: xhr.responseText,
                statusCode: xhr.status
            });
            var errorMsg = 'Có lỗi xảy ra khi gửi tin nhắn.';
            if (xhr.status === 0) {
                errorMsg = 'Không thể kết nối đến server. Vui lòng kiểm tra kết nối mạng.';
            } else if (xhr.status === 403) {
                errorMsg = 'Bạn không có quyền gửi tin nhắn. Vui lòng đăng nhập lại.';
            } else if (xhr.responseJSON && xhr.responseJSON.data) {
                errorMsg += ' ' + xhr.responseJSON.data;
            }
            alert(errorMsg);
        },
        complete: function() {
            // Re-enable button
            $sendBtn.prop('disabled', false).text(originalText);
        }
    });
}

function displayMessages(messages) {
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        return;
    }
    var $ = jQuery;
    
    // Tìm container phù hợp - ưu tiên #admin-chat-messages nếu có, nếu không thì dùng .chat-messages hoặc #chat-messages
    var container = $('#admin-chat-messages').length ? $('#admin-chat-messages') : ($('#chat-messages').length ? $('#chat-messages') : $('.chat-messages'));
    
    if (!container.length) {
        console.error('Không tìm thấy container chat messages');
        return;
    }
    
    container.empty();
    
    if (!messages || messages.length === 0) {
        container.html('<div class="text-center text-muted" style="padding: 20px;">Chưa có tin nhắn nào. Hãy bắt đầu cuộc trò chuyện!</div>');
        return;
    }
    
    messages.forEach(function(msg) {
        var messageClass = msg.sender === 'user' ? 'user' : 'admin';
        var timestamp = msg.timestamp ? formatTimestamp(msg.timestamp) : '';
        var messageHtml = '<div class="chat-message ' + messageClass + '">' +
            '<strong>' + (msg.sender_name || msg.sender || 'Unknown') + ':</strong> ' + 
            '<span>' + escapeHtml(msg.message || '') + '</span>' +
            (timestamp ? '<br><small>(' + timestamp + ')</small>' : '') +
            '</div>';
        container.append(messageHtml);
    });
    
    // Scroll to bottom
    setTimeout(function() {
        if (container.length && container[0].scrollHeight) {
            container.scrollTop(container[0].scrollHeight);
        }
    }, 100);
}

function formatTimestamp(timestamp) {
    if (!timestamp) return '';
    
    // Try to parse MySQL datetime format (YYYY-MM-DD HH:MM:SS)
    var date;
    if (timestamp.match(/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/)) {
        // MySQL datetime format
        date = new Date(timestamp.replace(' ', 'T'));
    } else {
        date = new Date(timestamp);
    }
    
    if (isNaN(date.getTime())) {
        // If can't parse, return original
        return timestamp;
    }
    
    var now = new Date();
    var diff = now - date;
    var minutes = Math.floor(diff / 60000);
    var hours = Math.floor(diff / 3600000);
    var days = Math.floor(diff / 86400000);
    
    if (minutes < 1) return 'Vừa xong';
    if (minutes < 60) return minutes + ' phút trước';
    if (hours < 24) return hours + ' giờ trước';
    if (days < 7) return days + ' ngày trước';
    
    // Format: DD/MM/YYYY HH:MM
    var day = ('0' + date.getDate()).slice(-2);
    var month = ('0' + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();
    var hours = ('0' + date.getHours()).slice(-2);
    var mins = ('0' + date.getMinutes()).slice(-2);
    
    return day + '/' + month + '/' + year + ' ' + hours + ':' + mins;
}

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function loadAdminChats() {
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        return;
    }
    var $ = jQuery;
    
    var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
    var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '';
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
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        return;
    }
    var $ = jQuery;
    
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
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        return;
    }
    var $ = jQuery;
    
    var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
    var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '';
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

function sendAdminMessage(message, chatId) {
    // Đảm bảo jQuery đã sẵn sàng
    if (typeof jQuery === 'undefined') {
        console.error('jQuery chưa được load');
        alert('Lỗi: jQuery chưa được load. Vui lòng refresh trang.');
        return;
    }
    var $ = jQuery;
    
    var ajaxUrl = typeof shopcar_chat !== 'undefined' ? shopcar_chat.ajaxurl : (typeof ajaxurl !== 'undefined' ? ajaxurl : '/wp-admin/admin-ajax.php');
    var nonce = typeof shopcar_chat !== 'undefined' ? shopcar_chat.nonce : '';
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
