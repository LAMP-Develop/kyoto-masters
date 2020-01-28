<?php $home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>

<aside id="sidebar">
<?php if (!is_user_logged_in()) : ?>
<!-- <div class="inner">
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-9618133012525488" data-ad-slot="3757511529" data-ad-format="auto" data-full-width-responsive="false"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> -->
<?php endif; ?>
<div class="inner">
<h3>今週のアクセスランキング</h3>
<ul class="popular-posts">
<?php
$args = get_popular_args('weekly', '5');
$posts = get_posts($args);
$no = 1;
foreach ($posts as $post):
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
<img src="<?php echo $img; ?>" alt="<?php echo $ttl; ?>">
<div class="txt">
<p class="color-sky"><span>No.<?php echo $no; ?></span><span></span></p>
<h4><?php echo $ttl; ?></h4>
</div>
</a>
</li>
<?php
$no++;
endforeach;
wp_reset_query();
?>
</ul>
</div>
<?php if (is_single()):
$category = get_the_category();
$cat_id  = $category[0]->cat_ID;
if (get_ancestors($cat_id, 'category')) {
    $cat_id = get_ancestors($cat_id, 'category');
    $category = get_category($cat_id);
    $cat_name = $category->cat_name;
    $cat_slug = $category->category_nicename;
} else {
    $cat_name = $category[0]->cat_name;
    $cat_slug = $category[0]->category_nicename;
}
$cat_child = get_term_children($cat_id, 'category');
if (count($cat_child) != 0):
?>
<div class="inner">
<h3><?php echo $cat_name; ?></h3>
<ul class="irui-list">
<?php
foreach ($cat_child as $key => $cats):
$cats_arry = get_category($cats);
$tag_name = $cats_arry->name;
$tag_slug = $cats_arry->slug;
?>
<li><a href="<?php echo $home.'/'.$tag_slug; ?>" class="bg-sky color-white"><?php echo $tag_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; endif; ?>
<div class="inner">
<h3>話題のキーワード</h3>
<ul class="tag-list">
<?php
$args = array(
  'orderby' => 'count',
  'order' => 'DESC',
  'number' => 10,
);
$tags_array = get_tags($args);
foreach ($tags_array as $key => $tag):
$tag_name = $tag->name;
$tag_slug = $tag->slug;
?>
<li><a href="<?php echo $home.'/tag/'.$tag_slug; ?>"><?php echo $tag_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</aside>
