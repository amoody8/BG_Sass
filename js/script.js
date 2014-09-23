(function ($, Drupal, window, document, undefined) {
// To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.bg_script_behavior = {
    attach: function(context, settings) {
      
      if (Modernizr.touch) {
        $('body').addClass('touch');
      }
      $('#navigation', context).sticky({topSpacing:0});
      //if (Modernizr.mq('only screen and (max-width: 1024px)')) {
        $("#mobile-menu").mmenu();
      //}
      $('#search-icon').click(function(){
        $('#search-block form').toggle();
        $('#search-block form #edit-search-block-form--2').val('Talk to me, baby!');
      });
      $('#search-block form #edit-search-block-form--2').focus(function(){
        $(this).val('');
      });
			
			//Manual ad placement
			var ads = $('.manual-ad');
			if (ads.length > 0) {
				ads.each(function(){
					var term = $(this).attr('data-term');
					var num = $(this).attr('data-num');
					get_ads(this, term, num);
				});
			}
			      
      //Newsletter Sign-up
      $('#content-newsletter-form #form-fields input.text, #sidebar-newsletter #form-fields input.text').click(function(){
        $(this).val('');
      });
      
      //Twitter
      $('.tweets li').mouseenter(function(){
        $(this).find('.views-field-web-intents').show();
      });
      $('.tweets li').mouseleave(function(){
        $(this).find('.views-field-web-intents').hide();
      });
      $('.footer-container .footer-list .footer-title').click(function(e){
        $('.footer-container .footer-list .menu').slideUp();
        $(this).next('ul').slideDown();
      });
      
      /**
       *Pinterest in content
       **/
			//$('body:not(.bridal-gowns, .front) #content img').each(
			$('article img').each(
        function(index){
					if (((($(this).width() >= 400 && $(this).height() > 200) || $(this).height() >= 400)  && ($(this).css('float') != 'left' && $(this).css('float') != 'right')) || $(this).hasClass('slide-image')) {
 					  var here = location.href;
            var src = $(this).attr('src');
            if (src.indexOf('http:') == -1) {
              src = "http://www.bridalguide.com" + src;
            }
            var alt = $(this).attr('alt');
            if (!$(this).parent('.p-container').length) {
              $(this).wrap('<div class="p-container" />');
              //$(this).parent('.p-container').css('width', $(this).width());
              $(this).parent('.p-container').css('width', 'auto');
              $(this).before("<div class='pin-it'><a class='p-button' href='javascript:void();'></a></div>");
            }
            $(this).parent('.p-container').children('.pin-it').on('click', '.p-button', function(){
              var mywin = window.open('http://pinterest.com/pin/create/button/?url=' + here + '&media=' + src + '&description=' + alt, 'signin', 'width=665,height=300');
            });
            $(this).hover(
              function(){
                $(this).prev('.pin-it').show().hover(function(){$(this).show()});
              },
              function(){
                $('.pin-it').hide();
              }
            );
          }
        }
      );
			//Destination search
			function get_dest_results(search_term, here, cur_page) {
				$.get('/ajax/destination-search', {term: search_term, channel: here, page: cur_page}, function(data){
					$('#destination-results').html(data).slideDown();
					var page = $('#destination-results #pager').attr('page');
					var count = $('#destination-results #pager').attr('count');
					if (page < count-1) {
						$('#destination-results #controls #next').show();
					}
					if (page > 0) {
						$('#destination-results #controls #prev').show();
					}
					
					$('#destination-results #controls #prev').click(function(){
						var page = $('#destination-results #pager').attr('page');
						page = page*1;
						if (page > 0) {
							page = page - 1;
							var here = $('#channel-input').val();;
							var search_term = $('#destination-input').val();
							get_dest_results(search_term, here, page);
						}	
					});
					$('#destination-results #controls #next').click(function(){
						var page = $('#destination-results #pager').attr('page');
						var count = $('#destination-results #pager').attr('count');
						count = count*1;
						page = page*1;
						if (page < count-1) {
							page = page + 1;
							var here = $('#channel-input').val();;
							var search_term = $('#destination-input').val();
							get_dest_results(search_term, here, page);
						}	
					});
				});
			}

			$("#destination-input").keyup(function (e) {
				if (e.which == 13) {
					$('#destination-submit').click();
				}
			});
			$('#destination-submit').click(function(event){
				var here = $('#channel-input').val();
				var search_term = $('#destination-input').val();
				get_dest_results(search_term, here, 0);
				return false;
			});
			
			$('body.honeymoons-landing #honeymoons-switcher .slider-wrapper .slides').bxSlider({
				minSlides: 1,
				maxSlides: 3,
				slideMargin: 30,
				slideWidth: 260,
				preloadImages: 'all',
				controls: true,
				pager: false,
				moveSlides: 1
			});
			$('body.honeymoons-landing #switcher-target').load('ajax/get-honeymoons-content?pane=travel-tips');
			$('body.honeymoons-landing #honeymoons-switcher .slider-wrapper .slides .slide').click(function(){
				var target = $(this).find('a').eq(0).attr('href');
				$('body.honeymoons-landing #switcher-target').load('ajax/get-honeymoons-content?pane=' + target);
				return false;
			});

			
			//YP search functions
			$('#yp-search-form input[type="text"]').focus(function(){
				$(this).val('');
			});
			
			$('#show-reviews').click(function(){
				if ($('#reviews').html() == '') {
					$.get('/ajax/yp/get-reviews/' + $(this).attr('rel') + '?b=' + $(this).attr('base_click'), function(data){
						$('#reviews').html(data);
					});
				}
				$('#reviews').slideToggle();
				return false;
			});

			$('.twit').click(function(event) {
				var width  = 575,
        height = 400,
        left   = ($(window).width()  - width)  / 2,
        top    = ($(window).height() - height) / 2,
        url    = this.href,
        opts   = 'status=1' +
                 ',width='  + width  +
                 ',height=' + height +
                 ',top='    + top    +
                 ',left='   + left;
    
				window.open(url, 'twitter', opts);
				return false;
			});
			
			// Get RID of all WYSIWYG styling
			//$('article img').removeAttr('style', 'height', 'width');
			
			//Youtube vides
			$("body.page-videos .youtube").fancybox({
				maxWidth	: 800,
				maxHeight	: 600,
				fitToView	: true,
				autoResize: true,
				autoSize	: true,
				closeBtn	: false,
				closeClick	: false,
				openEffect	: 'none',
				helpers : {
					media : {}
				}
			});

			$('body.page-beauty-health #b-h-fitness .latest-list .channel-latest, body.page-dresses #d-accessories .latest-list .channel-latest').bxSlider({
				minSlides: 1,
				maxSlides: 4,
				slideMargin: 20,
				slideWidth: 190,
				preloadImages: 'all',
				controls: true,
				pager: false,
				moveSlides: 2
			});

			$('body.page-beauty-health #b-h-wellness .latest-list .channel-latest, body.page-dresses #d-dress-trends .latest-list .channel-latest').bxSlider({
				minSlides: 1,
				maxSlides: 3,
				slideMargin: 10,
				slideWidth: 270,
				preloadImages: 'all',
				controls: true,
				pager: false,
				moveSlides: 1
			});
			
			$('body.page-planning .view-inspiration-gallery .content-ig-block .content-ig-list').bxSlider({
				minSlides: 1,
				maxSlides: 3,
				slideMargin: 10,
				slideWidth: 220,
				preloadImages: 'all',
				controls: true,
				pager: false,
				moveSlides: 1
			});

			//Article share links
			$('.share-link').click(function(){
				var url = $(this).attr('href');
				window.open(url, 'share', 'width=640,height=320');
				return false;
			});
			
			$('body.planning-landing #switcher-target').load('ajax/get-planning-content?pane=getting-started');
			$('body.planning-landing #planning-ops li a').click(function(){
				var target = $(this).attr('href');
				$('body.planning-landing #switcher-target').load('ajax/get-planning-content?pane=' + target);
				return false;
			});
    }
  };
})(jQuery, Drupal, this, this.document);

/*
 *Placed here in case of simpleAds upgrade.  Move to simpleads.js
 *Replacement for _simpleads_load
 * elem - Ad container
 * tid  - term id
 * num - numer of ads to display
 * img_loader - image (ad load indicator), should be HTML tag <img src="loader.gif">
 *
 * Allows for device checking
 **/
/*
 function get_ads(elem, tid, num, img_loader) {
  mobile = Modernizr.touch;
  platform = "desktop";
  mobile = true;
  if (mobile) {
    if (Modernizr.mq('only all and (max-width: 767px)')) {
      platform = "phone";	
    } else if (Modernizr.mq('only all and (min-width: 768px) and (max-width: 1024px)')) {
      platform = "tablet";
    }
  }
  (function ($) {
    basepath = Drupal.settings.basePath;
    if (tid > 0 && num > 0) {
      if (img_loader != '')
        $(elem).html(img_loader);
      $.get(basepath + '?q=ajax/load_ads', {group: tid, count: num, device: platform}, function (data) {
        $(elem).html(data);
      });
    }
  }(jQuery));
}
*/