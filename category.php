<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();

$category = get_category($cat);
$cat_id   = $category->cat_ID;
$cat_name = $category->cat_name;
$cat_slug = $category->category_nicename;
$cat_child = get_term_children($cat_id, 'category');
?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<h2 class="ttlcat"><?php single_cat_title(); ?></h2>
<?php if (count($cat_child) != 0): ?>
<ul class="cat-child mb-2">
<?php foreach ($cat_child as $key => $cat_childs):
$cat = get_category($cat_childs);
$name = $cat->cat_name;
$slug = $cat->category_nicename;
?>
<li class="d-i-block mb-05 mr-05"><a href="<?php echo $home.'/'.$cat_slug.'/'.$slug; ?>" class="bg-sky color-white"><?php echo $name; ?></a></li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
<ul class="post-list">
<?php
if (have_posts()): while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt">
<?php foreach ($category as $key => $val): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<time datetime="<?php echo $time; ?>"><?php echo $time; ?></time>
</div>
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
<?php
if (function_exists('wp_pagenavi')) {
    wp_pagenavi();
}
wp_reset_query();
?>
</section>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php get_footer();
