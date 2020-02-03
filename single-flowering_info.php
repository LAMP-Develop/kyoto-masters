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
<div class="slider-for i-catch">
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
<!-- CTA -->
<?php get_template_part('templates/cta-mk'); ?>
<div class="post-inner mb-3">
<!-- 施設概要 -->
<table>
<tbody>
<?php if(get_field('build-name')): ?>
<tr><th>施設名</th>
<td><?php the_field('build-name'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('address')): ?>
<tr><th>住所</th>
<td><?php the_field('address'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('tell')): ?>
<tr><th>電話番号</th>
<td><?php the_field('tell'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('station')): ?>
<tr><th>最寄り駅</th>
<td><?php the_field('station'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('url')): ?>
<tr><th>URL</th>
<td><?php the_field('url'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('bas')): ?>
<tr><th>最寄りバス停</th>
<td><?php the_field('bas'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('time')): ?>
<tr><th>営業時間</th>
<td><?php the_field('time'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('holiday')): ?>
<tr><th>定休日</th>
<td><?php the_field('holiday'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('money')): ?>
<tr><th>入場料</th>
<td><?php the_field('money'); ?></td></tr>
<?php endif; ?>
<?php if(get_field('other')): ?>
<tr><th>備考</th>
<td><?php the_field('other'); ?></td></tr>
<?php endif; ?>
</tbody>
</table>

<?php if (get_field('geocode')): ?>
<div class="gmap">
<iframe src="https://www.google.com/maps?q=<?php echo get_field('geocode'); ?>&hl=jp&output=embed"></iframe>
</div>
<?php endif; ?>

</div>

<?php if ($tags != ''): ?>
<div class="single-tags">
<h3>この記事のタグ</h3>
<ul>
<?php foreach ($tags as $key => $tag): ?>
<li>
<a href="<?php echo $home.'/tag/'.$tag->slug; ?>"><i class="fas fa-tag"></i> <?php echo $tag->name; ?></a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>

<div class="sns-share mt-3 mb-3">
<p class="mb-1 txt-c sns-share-str">この記事が気に入ったら<span>SNSでシェアしよう！</span></p>
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
<h3 class="ttl3">他の開花情報</h3>
<?php else: ?>
<h3 class="ttl3">Others</h3>
<?php endif; ?>
<ul class="post-list">
<?php
$args = [
  'post_type' => 'flowering_info',
  'posts_per_page' => '4',
  'orderby' => 'rand'
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
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
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
<h3 class="mincho txt-c"><?php echo $t; ?></h3>
</div>
</a>
</li>
<?php endwhile; wp_reset_query(); ?>
</ul>
</section>
</article>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php endif; get_footer();