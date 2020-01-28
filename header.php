<?php
error_reporting(0); // エラーの非表示
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="msvalidate.01" content="E2751C1BBE103C711B8987938E596CE6">
<meta name="p:domain_verify" content="b1d7bb08c6355bfda3fce49648544cab">
<?php wp_head(); ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
<link rel="stylesheet" href="<?php echo $wp_url; ?>/lib/css/modaal.min.css?20190606">
<link rel="stylesheet" href="<?php echo $wp_url; ?>/lib/css/slick.css?20190606">
<link rel="stylesheet" href="<?php echo $wp_url; ?>/lib/css/slick-theme.css?20190606">
<link rel="stylesheet" href="<?php echo $wp_url; ?>/lib/css/reset.css?20190606">
<link rel="stylesheet" href="<?php echo $wp_url; ?>/lib/css/style.css?20190725">

<!-- script -->
<?php if (!is_user_logged_in()) : ?>
<!-- juicer -->
<script src="//kitchen.juicer.cc/?color=i4CZ1G4t9/s=" async></script>
<!-- google ad -->
<!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4794912991373101",
    enable_page_level_ads: true
  });
</script> -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-92629108-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag('js', new Date());
gtag('config', 'UA-92629108-1', {'optimize_id': 'GTM-NNFNCFB'});
</script>
<?php endif; ?>
<?php if (is_single()): ?>
<script>
// youtubeの埋め込み処理
function init() {
var vidDefer = document.getElementsByTagName('iframe');
for (var i=0; i<vidDefer.length; i++) {
if(vidDefer[i].getAttribute('data-src')) {
vidDefer[i].setAttribute('src',vidDefer[i].getAttribute('data-src'));
}}}
window.onload = init;
</script>
<?php endif; ?>
</head>
<body class="drawer drawer--right">

<!-- ヘッダー -->
<header id="header" class="<?php if (!is_home() && !is_front_page()) {
  echo 'txt-l';
} else {
  echo 'txt-c';
} ?>">
<div class="wrap relative">
<h1 class="txt-c d-i-block"><a href="<?php echo $home; ?>/"><img src="<?php echo $wp_url; ?>/lib/images/logo.png" alt="せんたくのーと"></a></h1>

<?php
if (!is_home() && !is_front_page()) {
  get_search_form();
}
?>

<div class="head-sns abs-cr">
<ul class="color-sky pc-only">
<li class="mr-1"><a href="https://twitter.com/sentakunote" target="_blank"><i class="fab fa-twitter"></i></a></li>
<li class="mr-1"><a href="https://www.instagram.com/sentakunote/" target="_blank"><i class="fab fa-instagram"></i></a></li>
<!-- <li class="mr-1"><a href="http://nav.cx/aWJilRW" target="_blank"><i class="fab fa-line"></i></a></li> -->
<li><a href="https://www.youtube.com/channel/UCbR9BM2mH_KN_h7tainxYCg" target="_blank"><i class="fab fa-youtube"></i></a></li>
</ul>
</div>
<button type="button" class="sp-only drawer-toggle drawer-hamburger">
<span class="drawer-hamburger-icon"></span>
</button>
<nav class="sp-only sp-mneu drawer-nav bg-sky color-white" role="navigation">
<ul class="drawer-menu">
<li class="cat-link"><a class="drawer-menu-item modaal" href="#irui-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_01.png" alt="衣類の種類から探す">衣類の種類から探す</a></li>
<li class="cat-link"><a class="drawer-menu-item modaal" href="#sozai-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_02.png" alt="素材から探す">素材から探す</a></li>
<li class="cat-link"><a class="drawer-menu-item modaal" href="#brand-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_03.png" alt="ブランド名から探す">ブランド名から探す</a></li>
<li class="cat-link"><a class="drawer-menu-item modaal" href="#nayami-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_04.png" alt="お悩みワードから探す">お悩みワードから探す</a></li>
<li class="cat-link"><a class="drawer-menu-item modaal" href="#clothes-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_05.png" alt="洋服以外の種類から探す">洋服以外の種類から探す</a></li>
<li class="cat-link mb-2"><a class="drawer-menu-item modaal" href="#relation-search"><img src="<?php echo $wp_url; ?>/lib/images/icon/ico_nav_06.png" alt="関連キーワードから探す">関連キーワードから探す</a></li>
<li><a class="drawer-menu-item" href="<?php echo $home; ?>/">トップページ</a></li>
<li><a class="drawer-menu-item" href="<?php echo $home; ?>/question/">質問箱</a></li>
<li><a class="drawer-menu-item" href="<?php echo $home; ?>/contact/">お問い合わせ</a></li>
<li><a class="drawer-menu-item" href="https://rinavis.com/?utm_source=sentaku_note&utm_medium=owned&utm_campaign=sentaku_note_owned_top&argument=wGZDXC6e&dmai=a5d1f0f66a64e2" target="_blank">運営会社</a></li>
<li><a class="drawer-menu-item" href="<?php echo $home; ?>/privacy-policy/">プライバシーポリシー</a></li>
<li><a class="drawer-menu-item" href="<?php echo $home; ?>/sitemap/">サイトマップ</a></li>
<li><ul class="nav-sns txt-c color-white mb-1">
<li class="mr-1 d-i-block"><a href="https://twitter.com/sentakunote" target="_blank"><i class="fab fa-twitter"></i></a></li>
<li class="mr-1 d-i-block"><a href="https://www.instagram.com/sentakunote/" target="_blank"><i class="fab fa-instagram"></i></a></li>
<!-- <li class="mr-1 d-i-block"><a href="http://nav.cx/aWJilRW" target="_blank"><i class="fab fa-line"></i></a></li> -->
<li class="d-i-block"><a href="https://www.youtube.com/channel/UCbR9BM2mH_KN_h7tainxYCg" target="_blank"><i class="fab fa-youtube"></i></a></li>
</ul></li>
<li>
<a href="https://rinavis.com/s/irui.html?utm_source=sentaku_note&utm_medium=owned&utm_campaign=sentaku_note_owned_iruilp&argument=wGZDXC6e&dmai=a5d1f0f66a8808" target="_blank" class="btn-2" onclick="gtag('event', 'click', {'event_category': 'bnr', 'event_label': 'ボタンクリック', 'value': '0'});">クリーニングにお困りの方はこちら</a>
</li>
</ul>
</nav>
</div>
</header>
<!-- ヘッダー終了 -->
<?php if (!is_home() && !is_front_page()) { ?>
<div class="pc-only"><?php get_template_part('menu'); ?></div>
<?php if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
} ?>
<!-- メインコンテンツ -->
<main>
