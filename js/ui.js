/* project Grav Theme Pure
 * copyright 2016 kaleb heitzman
 */
(function (window, document) {

    jQuery('.showcase').slippry({
      // general elements & wrapper
      slippryWrapper: '<div class="sy-box showcase-slider" />', // wrapper to wrap everything, including pager
      elements: 'article', // elments cointaining slide content

      // options
      adaptiveHeight: false, // height of the sliders adapts to current
      captions: false,

      // transitions
      transition: 'horizontal', // fade, horizontal, kenburns, false
      speed: 1200,
      pause: 8000,

      // slideshow
      autoDirection: 'prev'
    });

}(this, this.document));
