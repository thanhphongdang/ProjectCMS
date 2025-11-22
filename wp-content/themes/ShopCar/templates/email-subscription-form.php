<?php
/**
 * Template: Email Subscription Form
 * Shortcode: [shopcar_email_subscription]
 */
?>

<div class="shopcar-email-subscription-form">
    <form id="shopcar-email-subscription-form" class="subscription-form">
        <input 
            type="email" 
            id="subscription-email" 
            name="email" 
            placeholder="Nhập email của bạn..." 
            required
            class="subscription-input"
        >
        <button type="submit" class="subscription-button" id="subscription-submit">
            <span class="button-text">Đăng ký</span>
            <span class="button-loading" style="display: none;">Đang xử lý...</span>
        </button>
    </form>
    <div id="subscription-message" class="subscription-message" style="display: none;"></div>
</div>

<style>
.shopcar-email-subscription-form {
    max-width: 100%;
    margin: 0;
}

.subscription-form {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.subscription-input {
    flex: 1;
    min-width: 200px;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 14px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.subscription-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.1);
}

.subscription-button {
    padding: 12px 24px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.subscription-button:hover {
    background: #0056b3;
}

.subscription-button:disabled {
    background: #6c757d;
    cursor: not-allowed;
}

.subscription-message {
    margin-top: 10px;
    padding: 10px;
    border-radius: 5px;
    font-size: 13px;
    text-align: center;
}

.subscription-message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.subscription-message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

@media (max-width: 600px) {
    .subscription-form {
        flex-direction: column;
    }
    
    .subscription-input,
    .subscription-button {
        width: 100%;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    $('#shopcar-email-subscription-form').on('submit', function(e) {
        e.preventDefault();
        
        var $form = $(this);
        var $button = $('#subscription-submit');
        var $message = $('#subscription-message');
        var email = $('#subscription-email').val().trim();
        
        // Reset message
        $message.hide().removeClass('success error');
        
        // Validate email
        if (!email || !isValidEmail(email)) {
            showMessage('Vui lòng nhập email hợp lệ.', 'error');
            return;
        }
        
        // Disable button
        $button.prop('disabled', true);
        $button.find('.button-text').hide();
        $button.find('.button-loading').show();
        
        // Send AJAX request
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'shopcar_register_email_subscription',
                email: email,
                nonce: '<?php echo wp_create_nonce('shopcar_email_subscription_nonce'); ?>'
            },
            success: function(response) {
                if (response.success) {
                    showMessage(response.data.message, 'success');
                    $('#subscription-email').val('');
                } else {
                    showMessage(response.data.message || 'Có lỗi xảy ra. Vui lòng thử lại.', 'error');
                }
            },
            error: function() {
                showMessage('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
            },
            complete: function() {
                $button.prop('disabled', false);
                $button.find('.button-text').show();
                $button.find('.button-loading').hide();
            }
        });
    });
    
    function showMessage(text, type) {
        var $message = $('#subscription-message');
        $message.text(text).addClass(type).fadeIn();
        
        // Auto hide after 5 seconds
        setTimeout(function() {
            $message.fadeOut();
        }, 5000);
    }
    
    function isValidEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
</script>

