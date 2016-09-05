(function() {
  $(document).ready(function() {
    $('.expander-trigger').click(function() {
      $(this).toggleClass('expander-hidden');
    });
  });

}).call(this);

(function() {
  $(function() {
    $('a.dropdown-selector').click(function(e) {
      var $anchor, $dropdownElement, active, activeAnchor, activeMobile, dropdown;
      $anchor = $(this);
      active = $('.nav-dropdowns').attr('data-nav-dropdowns');
      activeAnchor = $anchor.hasClass('active');
      activeMobile = $('#nav-toggle').is(':visible');
      $('.dropdown-selector').removeClass('active');
      dropdown = $(this).attr('data-nav-dropdown');
      if (activeAnchor) {
        $("li[data-nav-dropdown='" + dropdown + "']").slideUp().removeClass('active');
        $('.nav-dropdowns').attr('data-nav-dropdowns', null).removeClass('active');
        return;
      } else {
        $anchor.addClass('active');
      }
      if (activeMobile) {
        $('li[data-nav-dropdown]').slideUp();
        $dropdownElement = $("li[data-nav-dropdown='" + dropdown + "']");
        $anchor.after($dropdownElement);
        $dropdownElement.slideDown();
        e.stopPropagation();
        return;
      }
      if (active === "active") {
        $('li[data-nav-dropdown]').hide().removeClass('active');
        $("li[data-nav-dropdown='" + dropdown + "']").show().addClass('active');
      } else {
        $('.nav-dropdowns').attr('data-nav-dropdowns', 'active').addClass('active');
        $("li[data-nav-dropdown='" + dropdown + "']").slideToggle().addClass('active');
      }
      e.stopPropagation();
    });
    $('html').click(function(e) {
      $("li[data-nav-dropdown]").slideUp().removeClass('active');
      $('.nav-dropdowns').attr('data-nav-dropdowns', null).removeClass('active');
      return $('.dropdown-selector').removeClass('active');
    });
    return $('#nav-toggle').click(function() {
      $(this).toggleClass('active');
      return $('.nav-menu ul').slideToggle();
    });
  });

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
