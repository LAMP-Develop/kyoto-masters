<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();

$lang = ICL_LANGUAGE_CODE;
$post_name = [];
if ($lang === 'en') {
    $post_name = ['Tourist information', 'Blooming information'];
} elseif ($lang === 'ko') {
    $post_name = ['관광 정보', '개화 정보'];
} elseif ($lang === 'zh-hans') {
    $post_name = ['旅游信息', '开花信息'];
} elseif ($lang === 'zh-hant') {
    $post_name = ['旅遊信息', '開花信息'];
} else {
    $post_name = ['観光情報', '開花情報'];
}

?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<?php
$count = $wp_query->found_posts;
?>
<h2 class="ttlcat">検索：<?php the_search_query(); ?><small class="ml-1"><?php echo $count; ?>件</small></h2>
<ul class="post-list">
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
if (have_posts()): while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$type = get_post_type();
if ($type === 'post') {
    $type_name = $post_name[0];
} else {
    $type_name = $post_name[1];
}
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
?>
<li>
<span class="mv-ribbon"><?php echo $type_name; ?></span>
<a href="<?php echo $p; ?>">
<div class="post-thumbnail">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>
<div class="txt">
<h3 class="mb-0"><?php echo $t; ?></h3>
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
<?php get_sidebar(); ?>
</div>
</section>
<?php get_footer();