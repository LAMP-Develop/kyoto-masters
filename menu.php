<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
?>
<nav class="pc-nav bg-sky pc-only">
<div class="wrap">
<ul>
<?php
$args = [
  'orderby' => 'ID',
  'order' => 'ASC',
  'hide_empty' => 0,
];
$categories = get_categories($args);
foreach ($categories as $category): ?>
<li><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
<li><a href="#">開花情報</a></li>
</ul>
</div>
</nav>