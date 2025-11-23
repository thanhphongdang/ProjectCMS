<?php
/*
Template Name: Blank Template
*/
?>

<!DOCTYPE html>
<html>
<head>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
while (have_posts()) : the_post();
    the_content();
endwhile;
?>

<?php wp_footer(); ?>
</body>
</html>
