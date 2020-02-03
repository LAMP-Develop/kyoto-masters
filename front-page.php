<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
$lang = ICL_LANGUAGE_CODE;
get_header(); ?>
<section id="mv" class="sec">
<div class="wrap">
<div class="inner">
<?php
$lang_flag = false;
if ($lang === 'en') {
    $ttl = 'Media that delivers information on Kyoto';
    $migoro_str = 'Best time';
} elseif ($lang === 'ko') {
    $ttl = '교토의 정보 전달 매체';
    $migoro_str = '예년의 절정';
} elseif ($lang === 'zh-hans') {
    $ttl = '传播京都信息的媒体';
    $migoro_str = '一年中最好的时间';
} elseif ($lang === 'zh-hant') {
    $ttl = '傳播京都信息的媒體';
    $migoro_str = '一年中最好的時間';
} else {
    $lang_flag = true;
    $ttl = '京都の情報を届けるメディア';
    $migoro_str = '例年の見頃';
}
?>
<h2 class="mincho w-normal"><?php echo $ttl; ?></h2>
<?php get_search_form(); ?>
<div class="search-tag mt-2">
<span class="mr-1">HOT WORD</span>
<a href="#" class="hot-word">タグ名</a>
<a href="#" class="hot-word">タグ名</a>
<a href="#" class="hot-word">タグ名</a>
<a href="#" class="hot-word">タグ名</a>
</div>
</div>
</div>
</section>

<section id="flowering" class="sec">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">開花情報</span><span>FLOWERING INFO</span></h2>
<?php else: ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">FLOWERING INFO</span></h2>
<?php endif; ?>
<ul class="post-list flowering-list mb-2">
<?php
$args = [
  'posts_per_page' => 12,
  'orderby' => 'date',
  'order' => 'DESC',
  'post_type' => 'flowering_info',
];
query_posts($args);
while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'full');
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
<span><?php echo $migoro_str; ?><br><?php echo $migoro; ?></span>
</div>
</div>
<div class="txt">
<h3 class="mincho"><?php echo $t; ?></h3>
</div>
</a>
</li>
<?php endwhile; wp_reset_query(); ?>
</ul>
<div class="txt-c">
<?php if ($lang_flag): ?>
<a href="<?php echo $home; ?>/new-post/" class="btn">すべての開花情報を見る</a>
<?php else: ?>
<a href="<?php echo $home; ?>/new-post/" class="btn">More</a>
<?php endif; ?>
</div>
</div>
</section>

<section id="new-posts" class="sec">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">新着記事</span><span>RECENT POSTS</span></h2>
<?php else: ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">RECENT POSTS</span></h2>
<?php endif; ?>
<ul class="post-list mb-2">
<?php
$args = [
  'posts_per_page' => 12,
  'orderby' => 'date',
  'order' => 'DESC'
];
query_posts($args);
while (have_posts()): the_post();
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
$category = get_the_category();
?>
<li>
<a href="<?php echo $p; ?>">
<div class="post-thumbnail">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>
<div class="txt">
<?php foreach ($category as $key => $val): ?>
<span class="d-i-block color-white bg-sky"><?php echo $val->cat_name; ?></span>
<?php break; endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<time class="color-gray-a" datetime="<?php echo $time; ?>"><?php echo $time; ?></time>
</div>
</div>
</a>
</li>
<?php endwhile; wp_reset_query(); ?>
</ul>
<div class="txt-c">
<?php if ($lang_flag): ?>
<a href="<?php echo $home; ?>/new-post/" class="btn">すべての記事記事を見る</a>
<?php else: ?>
<a href="<?php echo $home; ?>/new-post/" class="btn">More</a>
<?php endif; ?>
</div>
</div>
</section>

<section id="ranking" class="sec bg-gray-a">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2"><span class="color-sky d-block">今週の人気ランキング</span><span>RANKING</span></h2>
<?php else: ?>
<h2 class="ttl2"><span class="color-sky d-block">RANKING</span></h2>
<?php endif; ?>
<ul class="post-list ranking-list">
<?php
$args = get_popular_args('weekly', '4');
query_posts($args);
while (have_posts()): the_post();
$no = 1;
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
$category = get_the_category();
?>
<li class="mb-0">
<span class="txt-c">0<?php echo $no; ?></span>
<a href="<?php echo $p; ?>">
<div class="post-thumbnail">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>
<div class="txt">
<?php foreach ($category as $key => $val): ?>
<span class="d-i-block color-white bg-sky"><?php echo $val->cat_name; ?></span>
<?php break; endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<time class="color-gray-a" datetime="<?php echo $time; ?>"><?php echo $time; ?></time>
</div>
</div>
</a>
</li>
<?php $no++; endwhile; wp_reset_query(); ?>
</ul>
</div>
</section>
<?php get_footer();