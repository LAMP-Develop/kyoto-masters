<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $rank = 'Access Ranking';
    $area = 'Search from the area';
} elseif ($lang === 'ko') {
    $rank = '액세스 랭킹';
    $area = '지역에서 찾는다';
} elseif ($lang === 'zh-hans') {
    $rank = '访问排名';
    $area = '按地区搜索';
} elseif ($lang === 'zh-hant') {
    $rank = '訪問排名';
    $area = '按地區搜索';
} else {
    $rank = '今週のアクセスランキング';
    $area = 'エリアで絞る';
}
?>

<aside id="sidebar">
<div class="inner">
<h3><?php echo $area; ?></h3>
<ul class="side-cat">
<?php
$args = [
    'slug' => 'area',
    'hide_empty' => 0,
];
$parent = get_categories($args);
$args = [
    'parent' => icl_object_id($parent[0]->term_id, 'category', false),
    'hide_empty' => 0
];
$categories = get_categories($args);
foreach ($categories as $val):
  $name = $val->name;
  $slug = get_category_link($val->term_id);
?>
<li><a href="<?php echo $slug; ?>"><?php echo $name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<div class="inner">
<h3><?php echo $rank; ?></h3>
<ul class="popular-posts">
<?php
$args = get_popular_args('weekly', '5');
$no = 1;
query_posts($args);
while (have_posts()): the_post();
$ttl = get_the_title();
$permalink = get_the_permalink();
$comment = get_comments_number(get_the_ID());
$excerpt = get_the_excerpt();
$img = '';
if (has_post_thumbnail()) {
    $img = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
} else {
    $img = $wp_url.'/lib/images/no-img.png';
}
?>
<li>
<a href="<?php echo $permalink; ?>">
<span>0<?php echo $no; ?></span>
<div class="post-thumbnail">
<img src="<?php echo $img; ?>" alt="<?php echo $ttl; ?>">
</div>
<div class="txt">
<h4><?php echo $ttl; ?></h4>
</div>
</a>
</li>
<?php $no++; endwhile; wp_reset_query(); ?>
</ul>
</div>
</aside>
