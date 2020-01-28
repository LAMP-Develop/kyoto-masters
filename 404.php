<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header(); ?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<div class="post-main mb-3">
<h2 class="ttl3">ページが見つかりません</h2>
<div class="post-inner">
<p>お探しのページは見つかりませんでした。</p>
<p>サイト上部の検索フォームなどで他のページを御覧ください！</p>
</div>
</div>

<h2 class="ttlcat">最近の投稿記事</h2>
<ul class="post-list">
<?php
$args = array(
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => $paged,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'post',
  'post_status' => 'publish',
  'cat' => '-549'
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
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
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time>
</div>
</div>
</a>
</li>
<?php endwhile; endif; ?>
</ul>
</section>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php get_footer();