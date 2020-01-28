<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();
the_post();
?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content" class="post-main">
<h2 class="ttl3"><?php echo get_the_title(); ?></h2>
<div class="post-inner">
<?php the_content(); ?>
</div>
</section>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php get_footer();