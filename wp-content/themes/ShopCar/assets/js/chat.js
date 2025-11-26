jQuery(document).ready(function($) {

    function formatTimestamp(timestamp) {
        if (!timestamp) return '';

        // Convert MySQL -> ISO (UTC)
        const isoString = timestamp.replace(' ', 'T') + 'Z';
        const date = new Date(isoString);

        if (isNaN(date.getTime())) return timestamp;

        // Convert UTC -> Vietnam time
        const vnDate = new Date(date.getTime() + 7 * 60 * 60 * 1000);

        const now = new Date();
        const diff = now - vnDate;

        const minutes = Math.floor(diff / 60000);
        const hours   = Math.floor(diff / 3600000);
        const days    = Math.floor(diff / 86400000);

        if (minutes < 1) return 'Vừa xong';
        if (minutes < 60) return minutes + ' phút trước';
        if (hours < 24)   return hours + ' giờ trước';
        if (days < 7)     return days + ' ngày trước';

        return vnDate.toLocaleDateString('vi-VN') + ' ' +
               vnDate.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
    }

    // Load messages
    function loadMessages() {
        $.post(shopcar_chat.ajaxurl, {
            action: "get_chat_messages",
            nonce: shopcar_chat.nonce
        }, function(response) {

            if (!response.success) return;

            const messages = response.data || [];
            const container = $("#chat-messages");
            container.html("");

            if (messages.length === 0) {
                container.html('<div class="text-center text-muted">Chưa có tin nhắn...</div>');
                return;
            }

            messages.forEach(msg => {
                const senderClass = msg.sender === "admin" ? "admin" : "user";

                const html = `
                    <div class="chat-message ${senderClass}">
                        <strong>${msg.sender === "admin" ? "Admin" : msg.sender_name}:</strong>
                        <span>${msg.message}</span>
                        <small>${formatTimestamp(msg.timestamp)}</small>
                    </div>
                `;

                container.append(html);
            });

            container.scrollTop(container[0].scrollHeight);
        });
    }

    // Send message
    $("#send-message").click(function() {
        const message = $("#chat-message").val().trim();
        if (!message) return;

        $("#send-message").prop("disabled", true);

        $.post(shopcar_chat.ajaxurl, {
            action: "send_chat_message",
            nonce: shopcar_chat.nonce,
            message: message
        }, function(response) {

            $("#send-message").prop("disabled", false);
            $("#chat-message").val("");

            if (response.success) {
                loadMessages();
            }
        });
    });

    // Enter to send
    $("#chat-message").keypress(function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            $("#send-message").click();
        }
    });

    // Auto load every 3s
    loadMessages();
    setInterval(loadMessages, 3000);
});
