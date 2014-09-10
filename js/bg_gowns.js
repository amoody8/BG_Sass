(function ($, Drupal, window, document, undefined) {

Drupal.behaviors.bg_gowns_behavior = {
  attach: function(context, settings) {
	
		$('body.bridal-gowns', context).append("<div id='gown-pop'></div>");
    $('.views-exposed-widget').each(function(e){
      label = $(this).children('label').html();
      select_element = $(this).find('select');
      $(select_element).children("option[value='All']").html(label);
      $(this).children('label').hide();
    });
		$('.gown-results-item-list .views-field-field-images .field-content a, .gown-results-item-list .caption a').click(function(e){
			$.get($(this).attr('rel'), function(data){
				$('#gown-pop').html(data);
				$.fancybox( $("#gown-pop"), {
					padding: 0,
					margin: 15,
					helpers:  {
						title:  null
					}
				});
				var here = location.href;
				var src = $('#gown-image img').attr('src');
				if (src.indexOf('http:') == -1) {
					src = "http://www.bridalguide.com" + src;
				}
				var alt = $('#gown-image img').attr('alt');
				$('#gown-pop .pin-it .p-button').click(function(){
					var mywin = window.open('http://pinterest.com/pin/create/button/?url=' + here + '&media=' + src + '&description=' + alt, 'signin', 'width=665,height=300');
				});
				$('#gown-image img').hover(
					function(){
						$(this).prev('.pin-it').show().hover(function(){$(this).show()});
					},
					function(){
						$('.pin-it').hide();
					}
				);
			});
			return false;
		});
		$('body.bridal-gowns', context).on('click', '#supporting a', function(e){
			var sup_rel = $(this).attr('rel');
			var main_src = $('#gown-image img').attr('src');
			var main_rel = $('#gown-image img').attr('rel');
			var sup_img = $(this).children('img:first');
			var sup_src = sup_img.attr('src');
			$('#gown-image img').attr('src', sup_rel);
			$('#gown-image img').attr('rel', sup_src);
			sup_img.attr('src', main_rel);
			$(this).attr('rel', main_src);
			return false;
		});
		$('body.bridal-gowns').on('click', '#collection-more a', function(e){
			$.get($(this).attr('rel'), function(data){
				$('#gown-pop').fadeOut('normal', function(){
					$(this).html(data).fadeIn('normal');
				})
			});	
			return false;
		});
		$('body.bridal-gowns').on('click', '#gown-nav a, #upper-gown-nav a', function(e){
			$.get($(this).attr('rel'), function(more_data){
				$('#gown-details').fadeOut('normal', function(){
					$(this).html(more_data);
					$('#gown-details').fadeIn();
				});							
			});	
			return false;
		});
		
		$('.spotlight-carousel .view-content').bxSlider({
			slideWidth: 300,
			minSlides: 1,
			maxSlides: 3,
			slideMargin: 0,
			infiniteLoop: false,
			randomStart: true,
			moveSlides: 1
		});
		
		if (Modernizr.mq('only all and (max-width: 767px)')) {
			if ($("#designers").length) {
				$("#designers .designer-section img:first").load(function(){
					var height = $(this).height();
					$('#designers').css('height', height + 240);
					$('#designers .designer-section:first').css('height', height + 'px').addClass('active');
					$('#designers .designer-section').click(function(){
						if (!$(this).hasClass('active')) {
							$('#designers .designer-section.active').animate({height:80},400).removeClass('active');
							$(this).animate({height:height},400).addClass('active');
						}
					});
				}); 
			}
		}	else {
			if ($("#designers").length) {
				$("#designers").zAccordion({
					width: "100%",
					speed: 600,
					auto: false,
					//slideWidth: "50%",
					height: 450,
					trigger: "mouseover"
				});
			}
		}
  }
};

})(jQuery, Drupal, this, this.document);
