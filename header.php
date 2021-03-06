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
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body class="drawer drawer--right">

<!-- ヘッダー -->
<header id="header" class="<?php if (!is_home() && !is_front_page()) {
    echo 'txt-l';
} else {
    echo 'txt-c';
} ?>">
<div class="wrap relative">
<h1 class="txt-c d-i-block">
<a href="<?php echo $home; ?>">
<img src="<?php echo $wp_url; ?>/lib/images/logo.svg" alt="<?php bloginfo('name'); ?>">
</a>
</h1>
<?php
if (!is_home() && !is_front_page()) {
    get_search_form();
}
?>

<!-- language -->
<div class="head-language abs-cr">
<?php
$languages = icl_get_languages('skip_missing=0&orderby=id&order=desc&link_empty_to=0');
?>
<ul class="dropdwn pc-only">
<li>
<a href="#"><i class="fas fa-globe-americas mr-05"></i>Languages <i class="fas fa-caret-down"></i></a>
<ul class="dropdwn-menu">
<?php foreach ($languages as $key => $val): ?>
<li>
<a href="<?php echo $val['url']; ?>"><img class="mr-05" src="<?php echo $val['country_flag_url']; ?>" alt="<?php echo $val['native_name']; ?>"><?php echo $val['native_name']; ?></a>
</li>
<?php endforeach; ?>
</ul>
</li>
</ul>
</div>

<button type="button" class="sp-only drawer-toggle drawer-hamburger">
<span class="drawer-hamburger-icon"></span>
</button>
<nav class="sp-only sp-mneu drawer-nav bg-sky color-white" role="navigation">
<ul class="drawer-menu">
<li class="cat-link">
<a class="drawer-menu-item" href="<?php echo $home; ?>/flowering-info/"><?php echo $flowering; ?></a>
</li>
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
foreach ($categories as $kye => $category) { ?>
<li class="cat-link">
<a class="drawer-menu-item" href="<?php echo get_category_link(icl_object_id($category->term_id, 'category', false)); ?>">
<?php echo $category->name; ?>
</a>
</li>
<?php } ?>
<li class="drawer-menu-item mt-2"><a class="drawer-menu-item" href="<?php echo $home; ?>">Top</a></li>
<li class="drawer-menu-item"><a class="drawer-menu-item" href="https://lamp.jp" target="_blank">Company</a></li>
<li class="drawer-menu-item"><a class="drawer-menu-item" href="<?php echo $home; ?>/privacy-policy/">Privacypolicy</a></li>
<hr class="mb-2">
<?php foreach ($languages as $key => $val): ?>
<li class="drawer-menu-item">
<a class="drawer-menu-item" href="<?php echo $val['url']; ?>"><img class="mr-05" src="<?php echo $val['country_flag_url']; ?>" alt="<?php echo $val['native_name']; ?>"><?php echo $val['native_name']; ?></a>
</li>
<?php endforeach; ?>
</ul>
</nav>
</div>
</header>
<div class="pc-only"><?php get_template_part('templates/menu'); ?></div>
<!-- ヘッダー終了 -->
<?php
if (!is_home() && !is_front_page()) {
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
}
?>
<!-- メインコンテンツ -->
<main>