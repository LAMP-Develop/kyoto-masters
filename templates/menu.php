<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri();
$lang = ICL_LANGUAGE_CODE;
if ($lang === 'en') {
    $flowering = 'Blooming information';
} elseif ($lang === 'ko') {
    $flowering = '개화 정보';
} elseif ($lang === 'zh-hans') {
    $flowering = '开花信息';
} elseif ($lang === 'zh-hant') {
    $flowering = '開花信息';
} else {
    $flowering = '桜開花情報';
}
?>
<nav class="pc-nav bg-sky pc-only">
<div class="wrap">
<ul>
<li><a href="<?php echo $home; ?>/flowering-info/"><?php echo $flowering; ?></a></li>
<?php
$args = [
    'slug' => 'area',
    'hide_empty' => 0,
];
$parent = get_categories($args);
$args = [
  'orderby' => 'ID',
  'order' => 'ASC',
  'hide_empty' => 0,
  'exclude' => (String)icl_object_id($parent[0]->term_id, 'category', false),
  'parent' => 0
];
$categories = get_categories($args);
foreach ($categories as $category): ?>
<li><a href="<?php echo get_category_link(icl_object_id($category->term_id, 'category', false)); ?>"><?php echo $category->name; ?></a></li>
<?php endforeach; ?>
</ul>
</div>
</nav>