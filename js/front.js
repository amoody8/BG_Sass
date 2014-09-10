(function ($, Drupal, window, document, undefined) {
// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.bg_front_behavior = {
  attach: function(context, settings) {
    $('.front .hp-buzzing-region .item-list ul').bxSlider({
      maxSlides: 1,
      minSlides: 1,
      slideMargin: 5,
      speed: 400,
      mode: 'vertical',
      auto: true,
      controls: false,
      pager: false
     });
    $('#hp-tabbed-block').on('click', 'li:not(.active)', function(){
      $('#hp-tabbed-block li.tab.active').removeClass('active');
      $(this).addClass('active');
      var rel = $(this).attr('rel');
      $('#hp-tabbed-block .tab-content').removeClass('active');
      $('#hp-tabbed-block #' + rel).addClass('active');
    });
    
    $('.front .hp-ig-block ul').bxSlider({
      minSlides: 1,
      maxSlides: 4,
      slideMargin: 50,
      slideWidth: 250,
      preloadImages: 'all',
      controls: true,
      pager: false,
      moveSlides: 1
     });

  }
};


})(jQuery, Drupal, this, this.document);
