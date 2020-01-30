<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header();
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
// カテゴリー
$category = get_the_category();
// タグ
$tags = get_the_tags();
?>
<section class="sec">
<div id="single-wrap" class="wrap main-wrap">
<article id="main-content" class="post-main">
<h2 class="postttl"><?php echo $t; ?></h2>
<div class="meta">
<time class="color-sky" datetime="<?php echo $time; ?>"><?php the_modified_time('Y.m.d'); ?></time>
<?php foreach ($category as $key => $val): ?>
<span class="ml-1 single-cat color-white bg-sky"><?php echo $val->cat_name; ?></span>
<?php endforeach; ?>
</div>
<div class="i-catch">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
</div>

<!-- メインコンテンツ -->
<div class="post-inner mb-3">
<?php for ($i=1; $i <= 5; $i++): ?>
<?php if (get_field('h_0'.$i)): ?>
<h2><?php echo get_field('h_0'.$i); ?></h2>
<?php if (get_field('img_0'.$i)): ?>
<img src="<?php echo get_field('img_0'.$i); ?>" alt="<?php echo get_field('h_0'.$i); ?>">
<?php endif; ?>
<?php if (get_field('body_0'.$i)): ?>
<p><?php echo get_field('body_0'.$i); ?></p>
<?php endif; ?>
<?php endif; ?>
<?php endfor; ?>

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
<h3 class="ttl3">関連記事</h3>
<ul class="post-list">
<?php
$catkwds = [];
foreach ($category as $cat) {
    $catkwds[] = $cat->term_id;
}
$args = [
  'post_type' => 'post',
  'posts_per_page' => '4',
  'post__not_in' => [$id],
  'category__in' => $catkwds,
  'orderby' => 'rand',
];
$posts = get_posts($args);
foreach ($posts as $post): setup_postdata($post);
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
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt">
<?php foreach ($category as $key => $val): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endforeach; ?>
<h3><?php echo $t; ?></h3>
</div>
</a>
</li>
<?php endforeach; wp_reset_postdata(); ?>
</ul>
</section>
</article>
<!-- サイドバー -->
<?php get_sidebar(); ?>
</div>
</section>
<?php endif; get_footer();