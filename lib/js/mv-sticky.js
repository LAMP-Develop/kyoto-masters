$(function() {
  var $fixElement = $('.youtube-wrap');
  var baseFixPoint = $fixElement.offset().top;
  var fixClass = 'is-fixed';

  function fixFunction() {
    var windowScrolltop = $(window).scrollTop();
    if (windowScrolltop >= baseFixPoint) {
      $fixElement.addClass(fixClass);
    } else {
      $fixElement.removeClass(fixClass);
    }
  }
  $(window).on('load scroll', function() {
    fixFunction();
  });
});