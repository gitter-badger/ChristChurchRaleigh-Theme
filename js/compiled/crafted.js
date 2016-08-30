(function() {
  (function() {});

}).call(this);

(function() {
  (function($) {
    $(function() {
      $('nav ul li > a:not(:only-child)').click(function(e) {
        $(this).siblings('.nav-dropdown').toggle();
        $('.nav-dropdown').not($(this).siblings()).hide();
        e.stopPropagation();
      });
      $('html').click(function() {
        $('.nav-dropdown').hide();
      });
    });
    document.querySelector('#nav-toggle').addEventListener('click', function() {
      this.classList.toggle('active');
    });
    $('#nav-toggle').click(function() {
      $('nav ul').toggle();
    });
  })(jQuery);

}).call(this);

(function() {
  (function($) {
    var smoothScroll;
    smoothScroll = function(el, to, duration) {
      var difference, perTick;
      if (duration < 0) {
        return;
      }
      difference = to - $(window).scrollTop();
      perTick = difference / duration * 10;
      return this.scrollToTimerCache = setTimeout((function() {
        if (!isNaN(parseInt(perTick, 10))) {
          window.scrollTo(0, $(window).scrollTop() + perTick);
          smoothScroll(el, to, duration - 10);
        }
      }).bind(this), 10);
    };
  })(jQuery);

}).call(this);

(function() {


}).call(this);
