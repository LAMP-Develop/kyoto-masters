<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();
?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<?php
$queried_object = get_queried_object();
$term_name = $queried_object->name;
?>
<h2 class="ttlcat"><?php echo $term_name; ?>の桜開花情報</h2>
<ul class="post-list flowering-list">
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
if (have_posts()): while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$terms = get_the_terms(get_the_ID(), 'flowering_info_cat')[0];
$term_name = $terms->name;
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img.png';
}
if (get_field('migoro', get_the_ID())) {
    $migoro = get_field('migoro', get_the_ID());
} else {
    $migoro = '';
}
if (get_field('flower_level', get_the_ID())) {
    $flower_level = get_field('flower_level', get_the_ID());
} else {
    $flower_level = '';
}
?>
<li>
<a class="relative" href="<?php echo $p; ?>">
<div class="post-thumbnail">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>
<div class="flower-info">
<div class="flower">
<span><img src="<?php echo $wp_url; ?>/lib/images/sakura_<?php echo $flower_level['value']; ?>.svg" alt="桜の開花情報"></span>
<span><?php echo $flower_level['label']; ?></span>
</div>
<div class="migoro">
<span><i class="fas fa-map-marker-alt"></i> <?php echo $term_name; ?></span>
</div>
</div>
<div class="txt">
<h3 class="mincho"><?php echo $t; ?></h3>
</div>
</a>
</li>
<?php endwhile; ?>
<?php else: ?>
<li>
<p class="mb-1">まだ記事が投稿されていません。</p>
<p><a href="<?php echo $home; ?>" class="color-sky">他の記事を探す ></a></p>
</li>
<?php endif; ?>
</ul>
<?php if (function_exists('wp_pagenavi')) {
    wp_pagenavi();
} ?>
</section>
<!-- サイドバー -->
<?php get_sidebar('flower'); ?>
</div>
</section>
<?php get_footer();
