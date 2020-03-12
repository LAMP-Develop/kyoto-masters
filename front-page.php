<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();

$now_month = (int)date('n');
$lang = ICL_LANGUAGE_CODE;
$lang_flag = false;
if ($lang === 'en') {
    $ttl = 'Delivering the ”now” of Kyoto to the world.';
    $migoro_str = 'Best time';
} elseif ($lang === 'ko') {
    $ttl = '교토의 현재를 세계에 전달';
    $migoro_str = '예년의 절정';
} elseif ($lang === 'zh-hans') {
    $ttl = '向世界传达京都的”现在”';
    $migoro_str = '一年中最好的时间';
} elseif ($lang === 'zh-hant') {
    $ttl = '向世界傳達京都的”現在”';
    $migoro_str = '一年中最好的時間';
} else {
    $lang_flag = true;
    $ttl = '京都の”今”を<br class="sp-only">世界に届けるメディア';
    $migoro_str = '例年の見頃';
}
get_header(); ?>
<section id="mv">
<div class="wrap">
<div class="inner">
<h2 class="mincho w-normal"><?php echo $ttl; ?></h2>
<?php get_search_form(); ?>
<div class="search-tag mt-2">
<span class="mr-1">HOT WORD</span>
<a href="<?php echo $home; ?>/flowering-info/" class="hot-word">桜</a>
</div>
</div>
</div>
</section>

<section id="flowering" class="sec">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">桜の開花情報</span><span>KYOTO SAKURA INFOMATION</span></h2>
<?php else: ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">KYOTO SAKURA INFOMATION</span></h2>
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
$terms = get_the_terms(get_the_ID(), 'flowering_info_cat')[0];
$term_name = $terms->name;
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
<span><i class="fas fa-map-marker-alt"></i> <?php echo $term_name; ?></span>
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
<a href="<?php echo $home; ?>/flowering-info/" class="btn">もっと見る</a>
<?php else: ?>
<a href="<?php echo $home; ?>/flowering-info/" class="btn">More</a>
<?php endif; ?>
</div>
</div>
</section>

<section id="ranking" class="sec bg-gray-a">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">人気のスポット</span><span>RANKING</span></h2>
<?php else: ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">RANKING</span></h2>
<?php endif; ?>
<ul class="post-list ranking-list flowering-list">
<?php
$no = 1;
$args = get_popular_blooming('weekly', '4', 'flowering_info');
query_posts($args);
while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$terms = get_the_terms(get_the_ID(), 'flowering_info_cat')[0];
$term_name = $terms->name;
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
<span class="txt-c">0<?php echo $no; ?></span>
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
<?php $no++; endwhile; wp_reset_query(); ?>
</ul>
</div>
</section>

<section id="sort-area" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">エリアから探す</span><span>SEARCH BY AREA</span></h2>
<ul class="tag-list">
<?php
$args = [
    'slug' => 'area',
    'hide_empty' => 0,
];
$parent = get_terms('flowering_info_cat', $args);
$args = [
    'orderby' => 'name',
    'orderby' => 'ASC',
    'parent' => icl_object_id($parent[0]->term_id, 'flowering_info_cat', false)
];
$terms = get_terms('flowering_info_cat', $args);
foreach ($terms as $term):
  $area_name = $term->name;
  $area_slug = get_term_link($term->slug, 'flowering_info_cat');
?>
<li class="mb-05"><a href="<?php echo $area_slug; ?>"><i class="fas fa-map-marker-alt mr-05"></i><?php echo $area_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</section>

<section id="other-flowers" class="sec bg-gray-a">
<div class="wrap">
<?php if ($lang_flag): ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">いま見頃の花</span><span>SEASONAL OTHER FLOWERS</span></h2>
<?php else: ?>
<h2 class="ttl2 txt-c"><span class="color-sky d-block">SEASONAL OTHER FLOWERS</span></h2>
<?php endif; ?>
<ul class="post-list ranking-list flowering-list">
<?php
$args = [
    'slug' => 'area',
    'hide_empty' => 0,
];
$parent = get_terms('other_flowers_cat', $args);
$args = [
    'orderby' => 'ID',
    'order' => 'ASC',
    'exclude_tree' => (String)icl_object_id($parent[0]->term_id, 'category', false)
];
$other_terms = get_terms('other_flowers_cat', $args);
if (count($other_terms) !== 0):
foreach ($other_terms as $key => $term):
$term_id = 'other_flowers_cat_'.icl_object_id($term->term_id, 'other_flowers_cat', false);
$best_month = (array)get_field('best_month', $term_id);
$month_arr = [$now_month];
if (count($best_month) === 0 || count(array_intersect($best_month, $month_arr)) === 0) {
    continue;
}
$term_url = get_term_link($term->term_id, 'other_flowers_cat');
$term_name = $term->name;
$pic = get_field('other_flower_cat_pic', $term_id);
?>
<li class="mb-2">
<a class="relative" href="<?php echo $term_url; ?>">
<div class="post-thumbnail">
<img src="<?php echo $pic['sizes']['medium']; ?>" alt="<?php echo $term_name; ?>">
</div>
<div class="txt">
<h3 class="mincho"><?php echo $term_name; ?></h3>
</div>
</a>
</li>
<?php endforeach; endif; ?>
</ul>
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
  'posts_per_page' => 3,
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
<a href="<?php echo $home; ?>/new-post/" class="btn">もっと見る</a>
<?php else: ?>
<a href="<?php echo $home; ?>/new-post/" class="btn">More</a>
<?php endif; ?>
</div>
</div>
</section>
<?php get_footer();