<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();

$now_month = (int)date('n');
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $others = 'Seasonal other flowers';
    $other_spots = 'Other best spots';
    $area = 'Search from the area';
} elseif ($lang === 'ko') {
    $others = '계절 다른 꽃';
    $other_spots = '다른 최고의 장소';
    $area = '지역에서 찾는다';
} elseif ($lang === 'zh-hans') {
    $others = '时令他人花';
    $other_spots = '其他最佳景点';
    $area = '按地区搜索';
} elseif ($lang === 'zh-hant') {
    $others = '時令他人花';
    $other_spots = '其他最佳景點';
    $area = '按地區搜索';
} else {
    $others = '他のいま見頃の花';
    $other_spots = '他の見頃スポット';
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
    'slug' => 'area',
    'hide_empty' => 0,
];
$parent = get_terms('other_flowers_cat', $args);
$args = [
    'orderby' => 'name',
    'orderby' => 'ASC',
    'parent' => icl_object_id($parent[0]->term_id, 'other_flowers_cat', false)
];
$terms = get_terms('other_flowers_cat', $args);
foreach ($terms as $key => $term):
  $flower_name = $term->name;
  $flower_slug = get_term_link($term->slug, 'other_flowers_cat');
?>
<li><a href="<?php echo $flower_slug; ?>"><?php echo $flower_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>

<!-- other_spot -->
<div class="inner">
<h3><?php echo $other_spots; ?></h3>
<?php
$args = [
    'hide_empty' => false,
];
$terms = get_terms('other_flowers_cat', $args);
$terms_arr = [];
foreach ($terms as $val) {
  $term_id = 'other_flowers_cat_'.icl_object_id($val->term_id, 'other_flowers_cat', false);
  $best_month = (int)get_field('best_month', $term_id);
  if ($now_month === $best_month) {
      $terms_arr[] = $val->slug;
  }
}
$args = [
    'post_type' => 'other_flowers',
    'tax_query' => [
        [
            'taxonomy' => 'other_flowers_cat',
            'terms' => $terms_arr,
            'field' => 'slug',
            'operator' => 'IN',
        ],
    ],
    'posts_per_page' => 5,
]; ?>
<ul class="popular-posts">
<?php query_posts($args);
while (have_posts()): the_post();
$ttl = get_the_title();
$permalink = get_the_permalink();
$img = '';
if (has_post_thumbnail()) {
    $img = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
} else {
    $img = $wp_url.'/lib/images/no-img.png';
}
?>
<li>
<a href="<?php echo $permalink; ?>">
<div class="post-thumbnail">
<img src="<?php echo $img; ?>" alt="<?php echo $ttl; ?>">
</div>
<div class="txt">
<h4><?php echo $ttl; ?></h4>
</div>
</a>
</li>
<?php endwhile; wp_reset_query(); ?>
</ul>
</div>

<!-- others_flower -->
<div class="inner">
<h3><?php echo $others; ?></h3>
<ul class="tag-list">
<?php
$args = [
    'hide_empty' => false,
];
$terms = get_terms('other_flowers_cat', $args);
foreach ($terms as $term):
    $term_id = 'other_flowers_cat_'.icl_object_id($term->term_id, 'other_flowers_cat', false);
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
</aside>
