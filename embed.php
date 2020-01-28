<?php
if (!headers_sent()) {
    header('X-WP-embed: true');
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<title><?php echo wp_get_document_title(); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php do_action('embed_head'); ?>
</head>
<body>
<?php
if (have_posts()) :
while (have_posts()) : the_post();
?>
<div class="wp-embed-main">
<a target="_blank" href="<?php the_permalink(); ?>" <?php post_class('wp-embed'); ?>>
<?php
$thumbnail_id = 0;
if (has_post_thumbnail()) {
    $thumbnail_id = get_post_thumbnail_id();
}
if ('attachment' === get_post_type() && wp_attachment_is_image()) {
    $thumbnail_id = get_the_ID();
}
$image_size = 'medium';
?>
<div class="wp-embed-featured-image">
<?php echo wp_get_attachment_image($thumbnail_id, $image_size); ?>
</div>
<div class="wp-embed-heading">
<h3><?php the_title(); ?></h3>
</div>
</a>
</div>
<?php
endwhile;
endif;
do_action('embed_footer');
