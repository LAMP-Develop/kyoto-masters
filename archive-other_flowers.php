<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();

$lang = ICL_LANGUAGE_CODE;
$lang_flag = false;
if ($lang === 'en') {
    $others = 'Seasonal other flowers';
    $migoro_str = 'Best time';
} elseif ($lang === 'ko') {
    $others = '계절 다른 꽃';
    $migoro_str = '예년의 절정';
} elseif ($lang === 'zh-hans') {
    $others = '时令他人花';
    $migoro_str = '一年中最好的时间';
} elseif ($lang === 'zh-hant') {
    $others = '時令他人花';
    $migoro_str = '一年中最好的時間';
} else {
    $lang_flag = true;
    $others = 'いま見頃の花';
    $migoro_str = '例年の見頃';
}

get_header();
?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<h2 class="ttlcat"><?php echo $others; ?></h2>
<ul class="post-list flowering-list">
<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
if (have_posts()): while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img.png';
}
$terms = get_the_terms(get_the_ID(), 'other_flowers_cat');
$area_name = '';
$flower_name = '';
foreach ($terms as $key => $term) {
    if ($term->parent) {
        $area_name = $term->name;
    } else {
        $flower_name = $term->name;
    }
}
?>
<li>
<a class="relative" href="<?php echo $p; ?>">
<div class="post-thumbnail">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>
<div class="flower-info">
<div class="flower"><span><?php echo $flower_name; ?></span></div>
<div class="migoro">
<span><i class="fas fa-map-marker-alt"></i> <?php echo $area_name; ?></span>
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
<?php get_sidebar('others'); ?>
</div>
</section>
<?php get_footer();
