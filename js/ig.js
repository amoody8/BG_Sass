(function ($, Drupal, window, document, undefined) {
Drupal.behaviors.bg_ig_behavior = {
  attach: function(context, settings) {
		$('body.page-photos-get-inspired-inspiration-gallery', context).append("<div id='ig-pop'></div>");
		$('.ig-page .view-content', context).on('click', ".views-row:not('.ad') img", function(e){
			data = "<div class='pop-img'><a href='" + $(this).attr('target') + "'><img src='" + $(this).attr('src') + "' /></a></div><p class='ig-pop-title'><a href='" + $(this).attr('target') + "'>" + $(this).attr('title') + "</a></p>";
			$('#ig-pop').html(data);
			$.fancybox( $("#ig-pop"), {
				padding: 0,
				margin: 15,
				helpers:  {
					title:  null
				}
			});				
			return false;
		});
		var $container = $('div.autopager div.view-content .item-list ul');
		$container.imagesLoaded( function(){
			$container.masonry({
				columnWidth: 	'.views-row',
				gutter:				0,
			});
			$container.infinitescroll({
				navSelector  : 'div.autopager .pager',    // selector for the paged navigation
				nextSelector : 'div.autopager .pager-next a',  // selector for the NEXT link (to page 2)
				itemSelector : 'div.autopager .views-row',     // selector for all items you'll retrieve
				loading: {
					finishedMsg: 'No more pages to load.',
					img: Drupal.settings.basePath + 'sites/all/themes/custom/bg_zen/images/ajax-loader.gif'
				}
			},
			function( newElements ) {
				// hide new items while they are loading
				var $newElems = $( newElements ).css({ opacity: 0 });
				// ensure that images load before adding to masonry layout
				
				//style new ads
				$newElems.each(function(item){
					if ($(this).hasClass('manual-ad')) {
						var term = $(this).attr('data-term');
						var num = $(this).attr('data-num');
						get_ads(this, term, num);
					}
				});
				$newElems.imagesLoaded(function(){
					// show elems now they're ready
					$newElems.animate({ opacity: 1 });
					$container.masonry( 'appended', $newElems, true ); 
				});
			});
		});
  }
};


})(jQuery, Drupal, this, this.document);
