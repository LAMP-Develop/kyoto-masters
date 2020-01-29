<?php
error_reporting(0); // エラーの非表示
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>
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
<a href="<?php echo $home; ?>/">
<img src="<?php echo $wp_url; ?>/lib/images/logo.svg" alt="<?php bloginfo('name'); ?>">
</a>
</h1>
<?php
if (!is_home() && !is_front_page()) {
    get_search_form();
}
?>
<div class="head-sns abs-cr">
<ul class="color-sky pc-only">
</ul>
</div>
<button type="button" class="sp-only drawer-toggle drawer-hamburger">
<span class="drawer-hamburger-icon"></span>
</button>
<nav class="sp-only sp-mneu drawer-nav bg-sky color-white" role="navigation">
<ul class="drawer-menu">
<?php
$args = array(
  'orderby' => 'ID',
  'order' => 'ASC',
  'hide_empty' => 0,
  'exclude' => '1,2'
);
$categories = get_categories($args);
foreach ($categories as $kye => $category) { ?>
<li class="cat-link">
<a class="drawer-menu-item" href="<?php echo get_category_link($category->term_id); ?>">
<?php if ($kye == 0) {
    echo '<i class="fas fa-chair mr-1"></i>';
} elseif ($kye == 1) {
    echo '<i class="fas fa-pencil-alt mr-1"></i>';
} elseif ($kye == 2) {
    echo '<i class="fas fa-th mr-1"></i>';
} elseif ($kye == 3) {
    echo '<i class="fas fa-border-all mr-1"></i>';
} elseif ($kye == 4) {
    echo '<i class="fas fa-tools mr-1"></i>';
} elseif ($kye == 5) {
    echo '<i class="fas fa-home mr-1"></i>';
} ?>
<?php echo $category->name; ?>
</a>
</li>
<?php } ?>
<li class="drawer-menu-item mt-2"><a class="drawer-menu-item" href="<?php echo $home; ?>/">トップ</a></li>
<li class="drawer-menu-item"><a class="drawer-menu-item" href="https://www.estorage.co.jp/?utm_source=shunomagazine&utm_medium=owned&utm_campaign=shunomagazine_owned" target="_blank">運営会社</a></li>
<li class="drawer-menu-item"><a class="drawer-menu-item" href="<?php echo $home; ?>/site-map/">サイトマップ</a></li>
<li class="drawer-menu-item"><a class="drawer-menu-item" href="<?php echo $home; ?>/privacy-policy/">プライバシーポリシー</a></li>
<li class="mt-2"><ul class="nav-sns txt-c color-white mb-1">
<li class="mr-1 d-i-block"><a href="https://www.facebook.com/shunolabo/" target="_blank"><i class="fab fa-facebook"></i></a></li>
<li class="mr-1 d-i-block"><a href="https://www.instagram.com/shunolabo/" target="_blank"><i class="fab fa-instagram"></i></a></li>
<li class="d-i-block"><a href="https://www.pinterest.jp/pin/find/?description=&media=&url=https%3A%2F%2Fwww.estorage.co.jp%2F" target="_blank"><i class="fab fa-pinterest"></i></a></li>
</ul></li>
</ul>
</nav>
</div>
</header>
<div class="pc-only"><?php get_template_part('menu'); ?></div>
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
