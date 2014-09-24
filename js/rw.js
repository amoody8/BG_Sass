(function ($, Drupal, window, document, undefined) {
Drupal.behaviors.bg_rw_behavior = {
  attach: function(context, settings) {
		$('#page.real-wedding', context).parents('body').append("<div id='rw-pop'></div>");
		$('#rw-search form').attr('action', '/photos/get-inspired/real-weddings');
		$('#masonry-container', context).on('click', ".img-title, img", function(e){
			$.get('/ajax/get-rw-details/' + $(this).attr('data-nid'), function(data){
				$('#rw-pop').html(data);
				$.fancybox( $("#rw-pop"), {
					padding: 0,
					margin: 15,
					scrolling: 'visible',
					helpers:  {
						title:  null
					}
				});
				var here = location.href;
				var src = $('#main-image img').attr('src');
				if (src.indexOf('http:') == -1) {
					src = "http://www.bridalguide.com" + src;
				}
				var alt = $('#main-image img').attr('alt');
				$('#rw-pop .pin-it .p-button').click(function(){
					var mywin = window.open('http://pinterest.com/pin/create/button/?url=' + here + '&media=' + src + '&description=' + alt, 'signin', 'width=665,height=300');
				});
				$('#main-image img').hover(
					function(){
						$(this).prev('.pin-it').show().hover(function(){$(this).show()});
					},
					function(){
						$('.pin-it').hide();
					}
				);
				$('#main-image', context).on('click', '#supporting img', function(e){
					var sup_rel = $(this).attr('rel');
					var main_src = $('#main-image #rw-image').attr('src');
					var main_rel = $('#main-image #rw-image').attr('rel');
					var sup_src = $(this).attr('src');

					$('#main-image #rw-image').attr('src', sup_rel);
					$('#main-image #rw-image').attr('rel', sup_src);
					$(this).attr('src', main_rel);
					$(this).attr('rel', main_src);
					return false;
				});
			});
			return false;
		});

		var $container = $('#masonry-container');
		
		$container.imagesLoaded( function(){
			$container.masonry({
				columnWidth: 	'.views-row',
			});
		});

		$('#page.real-wedding #load-more').click(function(){
			var more = $(this);
			var termID = more.attr('data-tid');
			var startNum = more.attr('data-start');
			$.get('/ajax/get-rw-images', {tid: termID, start: startNum}, function(data){
				var newstuff = $(data.out);
				$('#masonry-container').append(newstuff);
				$container.imagesLoaded( function(){
					$('#masonry-container div.new').removeClass('new');
					$container.masonry( 'appended', newstuff );
				});	
				if (data.last) {
					more.hide()
				} else {
					more.attr('data-start', parseInt(startNum) + parseInt(12));
				}
			});
		});
		$('#rw-pop').on('click', '#rw-nav a', function(){
			$.get('/ajax/get-rw-details/' + $(this).attr('rel'), function(data){
				$('#rw-pop').fadeOut('normal', function(){
					$(this).html(data);
					$('#rw-pop').fadeIn();
				});							
			});	
			return false;
		});
		
  }
};


})(jQuery, Drupal, this, this.document);
