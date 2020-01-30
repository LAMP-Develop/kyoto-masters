<?php $home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>

<aside id="sidebar">
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
<span>0<?php echo $no; ?></span>
<img src="<?php echo $img; ?>" alt="<?php echo $ttl; ?>">
<div class="txt">
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
<li><a href="<?php echo $home.'/tag/'.$tag_slug; ?>"><i class="fas fa-tag"></i> <?php echo $tag_name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</aside>
