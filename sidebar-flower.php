<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $others = 'Seasonal other flowers';
    $rank = 'Access Ranking';
    $area = 'Search from the area';
} elseif ($lang === 'ko') {
    $others = '계절 다른 꽃';
    $rank = '액세스 랭킹';
    $area = '지역에서 찾는다';
} elseif ($lang === 'zh-hans') {
    $others = '时令他人花';
    $rank = '访问排名';
    $area = '按地区搜索';
} elseif ($lang === 'zh-hant') {
    $others = '時令他人花';
    $rank = '訪問排名';
    $area = '按地區搜索';
} else {
    $others = 'いま見頃の花';
    $rank = '今週のアクセスランキング';
    $area = 'エリアで絞る';
}
?>

<aside id="sidebar">
<!-- sort -->
<div class="inner">
<h3><?php echo $area; ?></h3>
<ul class="side-cat">
<?php
$args = [
    'orderby' => 'name',
    'orderby' => 'ASC',
    'parent' => '32',
];
$terms = get_terms('flowering_info_cat', $args);
foreach ($terms as $key => $term):
  $flower_name = $term->name;
  $flower_slug = get_term_link($term->slug, 'flowering_info_cat');
?>
<li><a href="<?php echo $flower_slug; ?>"><?php echo $flower_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<!-- others -->
<div class="inner">
<h3><?php echo $others; ?></h3>
<ul class="tag-list">
<?php
$now_month = (int)date('n');
$args = [
    'hide_empty' => false,
];
$terms = get_terms('other_flowers_cat', $args);
foreach ($terms as $term):
    $term_id = 'other_flowers_cat_'.$term->term_id;
    $best_month = (int)get_field('best_month', $term_id);
    if ($best_month === 0 || $now_month !== $best_month) {
        continue;
    }
    $flower_name = $term->name;
    $flower_slug = get_term_link($term->slug, 'other_flowers_cat');
?>
<li class="mb-05"><a href="<?php echo $flower_slug; ?>"><?php echo $flower_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<!-- ranking -->
<div class="inner">
<h3><?php echo $rank; ?></h3>
<ul class="popular-posts">
<?php
$args = get_popular_blooming('weekly', '5');
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
