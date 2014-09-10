(function ($, Drupal, window, document, undefined) {
	$.urlParam = function(name) {
		var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
		if (results==null){
			 return null;
		}
		else{
			 return results[1] || 0;
		}
	}
  Drupal.behaviors.slideshow_behavior = {
    attach: function(context, settings) {
			var totalSlides = $('#slides-frame').attr('data-total-slides');
			var slideshowTid = $('#slides-frame').attr('data-tid');
			var blockTotal = $('.slide-container').length * 1;
			var slideshowNid = $('#slides-frame').attr('data-nid');
			var slideshowConfig = {
        minSlides: 1,
        maxSlides: 1,
        slideMargin: 0,
        infiniteLoop: false,
        randomStart: false,
        moveSlides: 1,
				pager: false,
				prevSelector: $('#slide-data #nav .bx-prev'),
				nextSelector: $('#slide-data #nav .bx-next'),
				onSlideBefore: function($slideElement, oldIndex, newIndex){
												var slide = $($slideElement);
												//$('#slide-pagination').html("<span>" + (newIndex+1) + " / " + totalSlides + "</span>");
												$('#slide-data .side-caption').html(slide.children('.caption').html());
												$('#edit-image').attr('href', '/node/' + slide.attr('data-nid') + '/edit');
											},
				onSlideNext: function($slideElement, oldIndex, newIndex){
												if (newIndex >= blockTotal - 5) {
													$.get('/ajax/get-slides/' + slideshowNid + '/' +slideshowTid + '/' + blockTotal, function(data){
														var jsonData = JSON.parse(data);
														$.each(jsonData, function(key, value){
															$('#slides li.slide-container:not(.bx-clone)').last().after(value.slide);
														});
														slideshowConfig['startSlide'] = slideshow.getCurrentSlide();
														slideshow.reloadSlider(slideshowConfig);
															console.log($('.slide-container').length, "Num of slides");
														blockTotal = $('.slide-container').length * 1;
													});
												}
											}
			};
			var slideshow = $('#slides').bxSlider(slideshowConfig);
			$('#slide-pagination').html("<span>1 / " + totalSlides + "</span>");
			$('#slide-data .side-caption').html($('#slides li:first').children('.caption').html());
			$('#edit-image').attr('href', '/node/' + $('.slide-container:first').attr('data-nid') + '/edit');
			if ($.urlParam('s')) {
				slideshow.goToSlide($.urlParam('s')-1);
			}
		}	
  }
})(jQuery, Drupal, this, this.document);