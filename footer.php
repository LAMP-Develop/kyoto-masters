<?php
$home = esc_url(home_url());
$wp_url = get_template_directory_uri(); ?>
</main>
<!-- メインコンテンツ終了 -->

<!-- CTA -->
<!-- <div class="foot-bnr pt-2 pb-2">
<div class="wrap txt-c">
<a href="https://rinavis.com/" onclick="gtag('event', 'click', {'event_category': 'bnr', 'event_label': '画像広告クリック', 'value': '0'});" target="_blank">
<img class="pc-only" src="<?php echo $wp_url; ?>/lib/images/bnr.png" alt="宅配クリーニングリナビス">
<img class="sp-only" src="<?php echo $wp_url; ?>/lib/images/bnr_sp.png" alt="宅配クリーニングリナビス">
</a>
</div>
</div> -->

<section class="common-bg-campaign sec">
<div class="wrap relative">
<div class="content_area common-box-campaign">
<div class="ft-campaign-about">
<h2 class="ttl-ft-campaign01">"おせっかいな"宅配クリーニングサービス「リナビス」</h2>
<p>せんたくのーとを手がける熟練のクリーニング職人達があなたの衣類・布団類を綺麗に洗濯致します。</p>
<div class="btn-campaign"><a href="https://rinavis.com/s/irui.html?utm_source=sentaku_note&utm_medium=owned&utm_campaign=sentaku_note_owned_iruilp&argument=wGZDXC6e&dmai=a5d1f0f66a8808" onclick="gtag('event', 'click', {'event_category': 'bnr', 'event_label': '画像広告クリック', 'value': '0'});" target="blank">宅配クリーニングを詳しく見る</a></div>
</div>
<div class="common-campaign-phone">
<img src="<?php echo $wp_url; ?>/lib/images/common/ph_smp01.png" alt="せんたくのーと">
</div>
</div>
</div>
</section>

<!-- フッター -->
<footer id="footer" class="sec bg-sky">
<div class="wrap">
<h2 class="txt-c"><a href="<?php echo $home; ?>/"><img src="<?php echo $wp_url; ?>/lib/images/foot-logo.png" alt="せんたくのーと"></a></h2>
<ul class="txt-c foot-link">
<li class="d-i-block"><a href="<?php echo $home; ?>/" class="color-white">せんたくのーとトップ</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/question/" class="color-white">質問箱</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/contact/" class="color-white">お問い合わせ</a></li>
<li class="d-i-block"><a href="https://rinavis.com/?utm_source=sentaku_note&utm_medium=owned&utm_campaign=sentaku_note_owned_top&argument=wGZDXC6e&dmai=a5d1f0f66a64e2" class="color-white" target="_blank">運営会社</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/privacy-policy/" class="color-white">プライバシーポリシー</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/term/" class="color-white">利用規約</a></li>
<li class="d-i-block"><a href="<?php echo $home; ?>/sitemap/" class="color-white">サイトマップ</a></li>
</ul>
<ul class="foot-sns txt-c color-white">
<li class="mr-1 d-i-block"><a href="https://twitter.com/sentakunote" target="_blank"><i class="fab fa-twitter"></i></a></li>
<li class="mr-1 d-i-block"><a href="https://www.instagram.com/sentakunote/" target="_blank"><i class="fab fa-instagram"></i></a></li>
<!-- <li class="mr-1 d-i-block"><a href="http://nav.cx/aWJilRW" target="_blank"><i class="fab fa-line"></i></a></li> -->
<li class="d-i-block"><a href="https://www.youtube.com/channel/UCbR9BM2mH_KN_h7tainxYCg" target="_blank"><i class="fab fa-youtube"></i></a></li>
</ul>
<p class="m-0 txt-c">
<small class="color-white">©2019 <a href="<?php echo $home; ?>/">洗いのお悩み解決WEBメディア『せんたくのーと』</a></small>
</p>
</div>
</footer>
<!-- フッター終了 -->
<?php wp_footer(); ?>
<script src="<?php echo $wp_url; ?>/lib/js/jquery.min.js"></script>
<script src="<?php echo $wp_url; ?>/lib/js/modaal.min.js"></script>
<script src="<?php echo $wp_url; ?>/lib/js/slick.min.js"></script>
<script src="<?php echo $wp_url; ?>/lib/js/sticky-sidebar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<script>
// Scroll event
$(window).on('load scroll', function() {
  var s = $(window).scrollTop();
  if (s >= 100) {
    $('#header').addClass('scroll-on');
  } else {
    $('#header').removeClass('scroll-on');
  }
});
// 検索
$('#search-sbmit').on('click', function() {
  $('#searchform').submit();
});
// モーダル
$('.modaal').modaal();
var options = {
  valueNames: ['cats']
}
var itemList = new List('irui-search', options);
var itemList2 = new List('sozai-search', options);
var itemList3 = new List('brand-search', options);
var itemList4 = new List('nayami-search', options);
var itemList5 = new List('clothes-search', options);
var itemList6 = new List('relation-search', options);
// スマホメニュー
$(window).on('load resize', function() {
  var w = $(window).width();
  if (w <= 768) {
    $('.drawer').drawer();
  }
});
$('.cat-link a').on('click', function() {
  $('.drawer').drawer('close');
});
<?php // if(!is_front_page() && !is_home()): ?>
// サイドバー
// $(function() {
//   $(window).on('load resize', function() {
//     var w = $(window).width();
//     if (w > 980) {
//       var sidebar = new StickySidebar('#sidebar', {
//         containerSelector: '#single-wrap',
//         topSpacing: 30,
//         bottomSpacing: 30
//       });
//     }
//   });
// });
<?php // endif; ?>
// 特集記事、レシピ記事
$('.recipe-posts').slick({
  centerMode: true,
  slidesToShow: 3,
  dots: true,
  infinite: true,
  autoplay: true,
  arrows: false,
  responsive: [
    {
      breakpoint: 769,
      settings: {
        slidesToShow: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        autoplay: false,
      }
    }
  ]
});
<?php if(is_single()): ?>
// 画像の疑似セレクタ消去
$('.post-inner img').each(function(index, element){
  if ($(this).closest('a').length > 0) {
    $(this).closest('a').addClass('pseudo');
  }
});
<?php endif; ?>
// 非同期CSS

window.WebFontConfig = {
  google: { families: ['Noto+Sans+JP:400,700','Roboto+Condensed:400,700'] },
  active: function() {
    sessionStorage.fonts = true;
  }
};
(function() {
  var wf = document.createElement('script');
  wf.src = '//ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();

requestAnimationFrame(function(a) {
  a = document.createElement('link');
  a.rel = 'stylesheet';
  a.href = '//use.fontawesome.com/releases/v5.8.1/css/all.css';
  document.head.appendChild(a);
});
</script>
</body>
</html>