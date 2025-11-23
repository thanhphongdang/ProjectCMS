<?php
// Test file for chat AJAX endpoints
require_once('wp-load.php');

if (!is_user_logged_in()) {
    wp_die('User not logged in');
}

$user_id = get_current_user_id();
echo "User ID: $user_id<br>";
echo "User Name: " . wp_get_current_user()->display_name . "<br>";

// Test nonce
$nonce = wp_create_nonce('shopcar_chat_nonce');
echo "Nonce: $nonce<br>";

// Test AJAX URL
$ajax_url = admin_url('admin-ajax.php');
echo "AJAX URL: $ajax_url<br>";

// Test chat creation
$chat_query = new WP_Query(array(
    'post_type' => 'support_chat',
    'meta_query' => array(
        array(
            'key' => '_user_id',
            'value' => $user_id,
            'compare' => '='
        )
    ),
    'posts_per_page' => 1
));

if ($chat_query->have_posts()) {
    $chat_id = $chat_query->posts[0]->ID;
    echo "Existing Chat ID: $chat_id<br>";
} else {
    $chat_id = wp_insert_post(array(
        'post_type' => 'support_chat',
        'post_title' => 'Chat với ' . wp_get_current_user()->display_name,
        'post_status' => 'publish'
    ));
    update_post_meta($chat_id, '_user_id', $user_id);
    echo "New Chat ID: $chat_id<br>";
}

// Test messages
$messages = get_post_meta($chat_id, '_messages', true);
if (!$messages) $messages = array();
echo "Current messages: " . count($messages) . "<br>";

// Add test message
$messages[] = array(
    'sender' => 'user',
    'sender_name' => wp_get_current_user()->display_name,
    'message' => 'Test message from user',
    'timestamp' => current_time('mysql')
);
update_post_meta($chat_id, '_messages', $messages);

echo "Added test message<br>";

// Test AJAX call simulation
$_POST['action'] = 'get_chat_messages';
$_POST['nonce'] = $nonce;

try {
    shopcar_get_chat_messages();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "<br>";
}

echo "Test completed";
?>
