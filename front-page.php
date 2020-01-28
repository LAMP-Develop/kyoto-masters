<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
get_header(); ?>
<section id="mv" class="sec color-white">
<div class="wrap">
<div class="inner">
<h2>せんたくに関する全てのお悩みに</h2>
<?php get_search_form(); ?>
<div class="search-tag mt-2">
<span class="mr-1">HOT WORD</span>
<a href="<?php echo $home.'/tag/水着/'; ?>" class="hot-word">水着</a>
<a href="<?php echo $home.'/tag/浴衣/'; ?>" class="hot-word">浴衣</a>
<a href="<?php echo $home.'/tag/マジックソープ/'; ?>" class="hot-word">マジックソープ</a>
<a href="<?php echo $home.'/tag/油汚れ/'; ?>" class="hot-word">油汚れ</a>
</div>
</div>
</div>
</section>
<?php
// メガメニュー
get_template_part('menu'); ?>

<section id="new-posts" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block uppercase">RECENT POSTS</span>新着記事</h2>
<ul class="post-list mb-2">
<?php
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 6,
  'cat' => '-549'
);
$query = new WP_Query($args);
if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li>
<?php if (has_category('recipe')): ?>
<span class="mv-ribbon"><i class="far fa-play-circle"></i> 動画で分かる！</span>
<?php endif; ?>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt bg-gray-b">
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<!-- <time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time> -->
</div>
</div>
</a>
</li>
<?php endwhile; endif; wp_reset_query(); ?>
</ul>
<div class="txt-c">
<a href="<?php echo $home; ?>/new-post/" class="btn">一覧を見る</a>
</div>
</div>
</section>

<section id="ranking" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">RANKING</span>今週のアクセスランキング</h2>
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
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li class="mb-0">
<p class="txt-c">No.<?php echo $no; ?></p>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt">
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<!-- <time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time> -->
</div>
</div>
</a>
</li>
<?php $no++; endforeach; wp_reset_query(); ?>
</ul>
</div>
</section>

<section id="recipe" class="sec bg-sky">
<div class="wrap">
<h2 class="ttl2 txt-c color-white"><span class="color-white d-block">MOVIE</span>動画でわかる洗濯術</h2>
</div>
<ul class="recipe-posts post-list">
<?php
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 5,
  'category_name' => 'recipe',
  'cat' => '-549'
);
$query = new WP_Query($args);
if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li>
<span class="mv-ribbon"><i class="far fa-play-circle"></i> 動画で分かる！</span>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt bg-gray-b">
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<!-- <time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time> -->
</div>
</div>
</a>
</li>
<?php endwhile; endif; wp_reset_query(); ?>
</ul>
<div class="txt-c">
<a href="<?php echo $home; ?>/recipe/" class="btn btn-3">一覧を見る</a>
</div>
</section>

<section id="feature" class="sec">
<div class="wrap">
<h2 class="ttl2 txt-c"><span class="color-sky d-block">FEATURE</span>特集</h2>
</div>
<ul class="feature-posts recipe-posts post-list">
<?php
$args = array(
'post_type' => 'post',
'posts_per_page' => 6,
'category_name' => 'special',
'cat' => '-549'
);
$query = new WP_Query($args);
if ($query->have_posts()): while ($query->have_posts()): $query->the_post();
$p = get_the_permalink();
$t = get_the_title();
$time = get_the_time('Y-m-d');
if (has_post_thumbnail()) {
    $i = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $i_l = get_the_post_thumbnail_url(get_the_ID(), 'large');
} else {
    $i = $wp_url.'/lib/images/no-img.png';
    $i_l = $wp_url.'/lib/images/no-img-2.png';
}
$category = get_the_category();
?>
<li>
<a href="<?php echo $p; ?>">
<img src="<?php echo $i; ?>" srcset="<?php echo $i; ?> 1x,<?php echo $i_l; ?> 2x" alt="<?php echo $t; ?>">
<div class="txt">
<?php foreach ($category as $key => $val):
if ($val->parent): ?>
<span class="d-i-block color-white bg-sky mr-05"><?php echo $val->cat_name; ?></span>
<?php endif;
endforeach; ?>
<h3><?php echo $t; ?></h3>
<div class="meta">
<!-- <time datetime="<?php echo $time; ?>"><i class="far fa-clock"></i> <?php echo $time; ?></time> -->
</div>
</div>
</a>
</li>
<?php endwhile; endif; wp_reset_query(); ?>
</ul>
<div class="txt-c">
<a href="<?php echo $home; ?>/special/" class="btn">一覧を見る</a>
</div>
</section>

<section id="keyword" class="sec bg-sky">
<div class="wrap">
<h2 class="ttl2 txt-c color-white"><span class="color-sky d-block color-white">KEYWORD</span>話題のキーワード</h2>
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
</section>
<?php get_footer();