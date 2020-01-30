<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header(); ?>
<section id="mv" class="sec">
<div class="wrap">
<div class="inner">
<h2 class="mincho w-normal">京都の情報を届けるメディア</h2>
<?php get_search_form(); ?>
<div class="search-tag mt-2">
<span class="mr-1">HOT WORD</span>
<a href="<?php echo $home; ?>/tag/マンション/" class="hot-word">マンション</a>
<a href="<?php echo $home; ?>/tag/賃貸/" class="hot-word">賃貸</a>
<a href="<?php echo $home; ?>/tag/アーキテリア/" class="hot-word">アーキテリア</a>
<a href="<?php echo $home; ?>/tag/おしゃれ/" class="hot-word">おしゃれ</a>
</div>
</div>
</div>
</section>

<section id="new-posts" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">新着記事</span><span>RECENT POSTS</span></h2>
<ul class="post-list mb-2">
<?php
$args = [
  'posts_per_page' => 12,
  'orderby' => 'date',
  'order' => 'DESC'
];
$posts = get_posts($args);
foreach ($posts as $post): setup_postdata($post);
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
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
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
<?php endforeach; wp_reset_postdata(); ?>
</ul>
<div class="txt-c">
<a href="<?php echo $home; ?>/new-post/" class="btn">一覧を見る</a>
</div>
</div>
</section>

<section id="ranking" class="sec bg-gray-a">
<div class="wrap">
<h2 class="ttl2"><span class="color-sky d-block">今週の人気ランキング</span><span>RANKING</span></h2>
<ul class="post-list ranking-list">
<?php
$args = get_popular_args('weekly', '4');
$posts = get_posts($args);
$no = 1;
foreach ($posts as $post):
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'large');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'full');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li class="mb-0">
<span class="txt-c">0<?php echo $no; ?></span>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
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
<?php $no++; endforeach; wp_reset_query(); ?>
</ul>
</div>
</section>

<!-- <section id="feature" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">おすすめ記事</span><span>RECOMMEND</span></h2>
</div>
<ul class="feature-posts recipe-posts post-list">
<?php
$args = [
  'posts_per_page' => 6,
  'orderby' => 'rand'
];
$posts = get_posts($args);
foreach ($posts as $post): setup_postdata($post);
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
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x, <?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
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
<?php endforeach; wp_reset_postdata(); ?>
</ul>
</section> -->

<!-- <section id="keyword" class="sec bg-gray-a">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">話題のキーワード</span><span>KEYWORD</span></h2>
<ul class="txt-c tag-list">
<?php
$args = array(
  'orderby' => 'id',
  'order' => 'DESC',
  'number' => 20,
);
$tags_array = get_tags($args);
foreach ($tags_array as $key => $tag):
$tag_name = $tag->name;
$tag_slug = $tag->slug;
?>
<li class="mb-05"><a href="<?php echo $home.'/tag/'.$tag_slug; ?>" class=""><?php echo $tag_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</section> -->
<?php get_footer();