// CSSインポート
import 'jquery-drawer/dist/css/drawer.min.css';
import '../sass/app.scss';

// JSインポート
FontAwesomeConfig = {
  searchPseudoElements: true
};
import '@fortawesome/fontawesome-free/js/all.js';
import 'jquery-drawer';

// jQuery
$(function() {
  $('.drawer').drawer();
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