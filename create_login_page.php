<?php
// Script to create a WordPress page with slug 'login' for custom login template

require_once('wp-load.php');

if (!is_user_logged_in()) {
    wp_die('You must be logged in to run this script.');
}

$page_title = 'Login';
$page_slug = 'login';
$page_content = '<!-- Custom login page content -->';

// Check if page already exists
$existing_page = get_page_by_path($page_slug);
if ($existing_page) {
    echo "Page with slug '$page_slug' already exists (ID: {$existing_page->ID}).\n";
    exit;
}

// Create the page
$page_id = wp_insert_post(array(
    'post_title'     => $page_title,
    'post_name'      => $page_slug,
    'post_content'   => $page_content,
    'post_status'    => 'publish',
    'post_type'      => 'page',
    'post_author'    => 1, // Assuming admin user ID 1
));

if ($page_id) {
    echo "Page created successfully with ID: $page_id\n";
    echo "Slug: $page_slug\n";
    echo "URL: " . get_permalink($page_id) . "\n";
} else {
    echo "Failed to create page.\n";
}
?>
