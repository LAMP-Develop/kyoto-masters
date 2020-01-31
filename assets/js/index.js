// CSSインポート
import 'jquery-drawer/dist/css/drawer.min.css';
import '../sass/app.scss';

// JSインポート
FontAwesomeConfig = {
  searchPseudoElements: true
};
import '@fortawesome/fontawesome-free/js/all.js';
import 'jquery-drawer';
import 'slick-carousel';

// jQuery
$(function() {
  // スライドショー
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    arrows: false,
    dots: true,
    centerMode: true,
    focusOnSelect: true
  });
  // スマホメニュークリックで閉じる
  $('.cat-link a').on('click', function() {
    $('.drawer').drawer('close');
  });
  // ドロップダウン
  $('.dropdwn li').hover(function() {
    $('ul:not(:animated)', this).slideDown();
  }, function() {
    $('.dropdwn-menu', this).slideUp();
  });
});

// スマホメニュー
$(window).on('load resize', function() {
  let w = $(window).width();
  if (w <= 768) {
    $('.drawer').drawer();
  }
});

// Scroll event
$(window).on('load scroll', function() {
  var s = $(window).scrollTop();
  if (s >= 100) {
    $('#header').addClass('scroll-on');
  } else {
    $('#header').removeClass('scroll-on');
  }
});

// Google Fonts
window.WebFontConfig = {
  google: {
    families: ['Noto+Sans+JP:300,500', 'Noto+Serif+JP:400,700', 'Lato:400,700']
  },
  active: function() {
    sessionStorage.fonts = true;
  }
};
(function() {
  var wf = document.createElement('script');
  wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
  wf.type = 'text/javascript';
  wf.async = 'true';
  var s = document.getElementsByTagName('script')[0];
  s.parentNode.insertBefore(wf, s);
})();