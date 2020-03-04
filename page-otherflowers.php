<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();

$lang = ICL_LANGUAGE_CODE;
$lang_flag = false;
if ($lang === 'en') {
    $other_ttl = 'Seasonal other flowers';
} elseif ($lang === 'ko') {
    $other_ttl = '계절 다른 꽃';
} elseif ($lang === 'zh-hans') {
    $other_ttl = '时令其他花';
} elseif ($lang === 'zh-hant') {
    $other_ttl = '時令其他花';
} else {
    $other_ttl = 'いま見頃の花';
    $lang_flag = true;
}

get_header(); ?>
<section class="sec">
<div class="wrap main-wrap">
<section id="main-content">
<?php $paged = get_query_var('paged') ? get_query_var('paged') : 1; ?>
<h2 class="ttlcat"><?php echo $other_ttl; ?></h2>
<ul class="post-list flowering-list">
<?php
$args = [
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => $paged,
  'orderby' => 'post_date',
  'order' => 'DESC',
  'post_type' => 'other_flowers',
  'post_status' => 'publish',
];
$the_query = new WP_Query($args);
if ($the_query->have_posts()): while ($the_query->have_posts()): $the_query->the_post();
$p = get_the_permalink();
$t = get_the_title();
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
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
<?php endwhile; endif; ?>
</ul>
<?php if (function_exists('wp_pagenavi')) {
    wp_pagenavi(array('query'=>$the_query));
}
wp_reset_query();
?>
</section>
<!-- サイドバー -->
<?php get_sidebar('others'); ?>
</div>
</section>
<?php get_footer();