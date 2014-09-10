(function ($, Drupal, window, document, undefined) {
Drupal.behaviors.bg_potd_behavior = {
  attach: function(context, settings) {
		$('#potd-landing', context).parents('body').append("<div id='potd-pop'></div>");
		$('#potd-wrapper #load-more').click(function(){
			var more = $(this);
			var startNum = more.attr('data-start');
			$.get('/ajax/potd/get-many/' + startNum, function(data){
				$('#potd-landing ul').append(data);
				more.attr('data-start', parseInt(startNum) + parseInt(12));
			});
		});
		
		$('#potd-pop').on('click', '#rw-nav a', function(){
			$.get('/ajax/potd/get-single/' + $(this).attr('rel'), function(data){
				$('#potd-pop').fadeOut('normal', function(){
					$(this).html(data);
					$('#potd-pop').fadeIn();
				});							
			});	
			return false;
		});
		
  }
};
})(jQuery, Drupal, this, this.document);
