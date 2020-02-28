<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();

$lang = ICL_LANGUAGE_CODE;
$lang_flag = false;
if ($lang === 'en') {
    $modified_time = 'Updated date';
    $migoro_str = 'Best time';
    $kaika = 'Flowering status';
} elseif ($lang === 'ko') {
    $modified_time = '업데이트 날짜';
    $migoro_str = '예년의 절정';
    $kaika = '개화 상황';
} elseif ($lang === 'zh-hans') {
    $modified_time = '更新日期';
    $migoro_str = '一年中最好的时间';
    $kaika = '开花状况';
} elseif ($lang === 'zh-hant') {
    $modified_time = '更新日期';
    $migoro_str = '一年中最好的時間';
    $kaika = '開花狀況';
} else {
    $modified_time = '更新日';
    $migoro_str = '例年の見頃';
    $kaika = '開花状況';
    $lang_flag = true;
}

if (have_posts()): the_post();
// 記事情報
$t = get_the_title();
$p = get_the_permalink();
$id = get_the_ID();
$time = get_the_modified_time('Y-m-d');
$terms = get_the_terms($id, 'flowering_info_cat')[0];
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

$pictures = [];
for ($j=1; $j <= 5; $j++) {
    if (get_field('picture_'.$j)) {
        $pictures[] = get_field('picture_'.$j);
    }
}
?>
<section class="sec">
<div id="single-wrap" class="wrap main-wrap">
<article id="main-content" class="post-main">
<!-- 画像 -->
<div class="slider-for">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<?php foreach ($pictures as $key => $pic): ?>
<img src="<?php echo $pic; ?>" alt="<?php echo $t; ?>の桜">
<?php endforeach; ?>
</div>
<div class="slider-nav">
<img src="<?php echo $i; ?>" alt="<?php echo $t; ?>">
<?php foreach ($pictures as $key => $pic): ?>
<img src="<?php echo $pic; ?>" alt="<?php echo $t; ?>の桜">
<?php endforeach; ?>
</div>

<h2 class="postttl"><?php echo $t; ?></h2>
<div class="meta">
<time class="color-sky" datetime="<?php echo $time; ?>"><?php echo $modified_time; ?>：<?php the_modified_time('Y.m.d'); ?></time>
<span class="ml-05"><i class="fas fa-map-marker-alt"></i> <?php echo $term_name; ?></span>
</div>
<!-- 開花情報 -->
<div class="post-flowering">
<div class="flowering">
<span><?php echo $kaika; ?></span>
<span><img src="<?php echo $wp_url; ?>/lib/images/sakura_<?php echo $flower_level['value']; ?>.svg" alt="桜の開花情報"></span>
<span><?php echo $flower_level['label']; ?></span>
</div>
<div class="migoro">
<span><?php echo $migoro_str; ?></span>
<span><?php echo $migoro; ?></span>
</div>
</div>
<!-- メインコンテンツ -->
<div class="post-inner mb-3">
<?php the_content(); ?>
</div>
<div class="post-inner mb-3">
<!-- 施設概要 -->
<table>
<tbody>
<?php if(get_field('build-name')): ?>
<tr><th><?php echo get_field_object('build-name')['label']; ?></th>
<td><?php the_field('build-name'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('address')): ?>
<tr><th><?php echo get_field_object('address')['label']; ?></th>
<td><?php the_field('address'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('tell')): ?>
<tr><th><?php echo get_field_object('tell')['label']; ?></th>
<td><a href="tel:<?php the_field('tell'); ?>"><?php the_field('tell'); ?></a></td></tr>
<?php endif; ?>
<?php if(get_field('station')): ?>
<tr><th><?php echo get_field_object('station')['label']; ?></th>
<td><?php the_field('station'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('url')): ?>
<tr><th><?php echo get_field_object('url')['label']; ?></th>
<td><a href="<?php the_field('url'); ?>" target="_blank"><?php the_field('url'); ?></a></td></tr>
<?php endif; ?>
<?php if(get_field('bas')): ?>
<tr><th><?php echo get_field_object('bas')['label']; ?></th>
<td><?php the_field('bas'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('time')): ?>
<tr><th><?php echo get_field_object('time')['label']; ?></th>
<td><?php the_field('time'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('holiday')): ?>
<tr><th><?php echo get_field_object('holiday')['label']; ?></th>
<td><?php the_field('holiday'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('money')): ?>
<tr><th><?php echo get_field_object('money')['label']; ?></th>
<td><?php the_field('money'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('other')): ?>
<tr><th><?php echo get_field_object('other')['label']; ?></th>
<td><?php the_field('other'); ?></td></tr>
<?php endif; ?>
</tbody>
</table>
<!-- GoogleMap -->
<?php if (get_field('geocode')): ?>
<div class="gmap">
<iframe src="https://www.google.com/maps?q=<?php echo get_field('geocode'); ?>&hl=jp&output=embed"></iframe>
</div>
<?php endif; ?>
</div>

<!-- CTA -->
<?php get_template_part('templates/cta-mk'); ?>

<div class="sns-share mt-3 mb-3">
<?php if ($lang_flag): ?>
<p class="mb-1 txt-c sns-share-str">この記事が気に入ったら<span>SNSでシェアしよう！</span></p>
<?php else: ?>
<p class="mb-1 txt-c sns-share-str">If you like this post<span>Let's share！</span></p>
<?php endif; ?>
<ul class="txt-c">
<li class="fb">
<a href="https://www.facebook.com/sharer.php?src=bm&u=<?php echo $p; ?>&t=<?php echo $t; ?>" target="_blank">
<i class="fab fa-facebook-f"></i>
</a>
</li>
<li class="tw">
<a href="https://twitter.com/intent/tweet?url=<?php echo $p; ?>&text=<?php echo $t; ?>" target="_blank">
<i class="fab fa-twitter"></i>
</a>
</li>
<li class="pi">
<a rel="nofollow" target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo $p; ?>&media=<?php echo $i_l; ?>&description=">
<i class="fab fa-pinterest-p"></i>
</a>
</li>
</ul>
</div>

<section id="relation-post">
<?php if ($lang_flag): ?>
<h3 class="ttl3">周辺情報</h3>
<?php else: ?>
<h3 class="ttl3">Nearby information</h3>
<?php endif; ?>
<ul class="post-list">
<?php
$args = [
  'post_type' => 'post',
  'posts_per_page' => '4',
  'orderby' => 'rand',
];
query_posts($args);
while (have_posts()): the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
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
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endforeach; ?>
<h3><?php echo $t; ?></h3>
</div>
</a>
</li>
<?php endwhile; wp_reset_query(); ?>
</ul>
</section>
</article>
<!-- サイドバー -->
<?php get_sidebar('flower'); ?>
</div>
</section>
<?php endif; get_footer();