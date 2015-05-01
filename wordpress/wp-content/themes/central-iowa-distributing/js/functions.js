;(function($, window, document, undefined) {
	var $win = $(window);
	var $doc = $(document);

	$doc.ready(function() {
		//Header Search
		$('.wrapper .search').on('click', function(e) {
			e.preventDefault();
			$(this).addClass('active');
			$(this).find('.search-field').focus();
		});
		$('.search input').on('click', function(e) {
			e.stopPropagation();
		});
		$('.search-field').on('focusout', function() {
			if($(this).val() == "") {
				$(this).parents('.search').removeClass('active');
			}
		});

		//Widget Categories
		var activeItemClass = 'accordion-expanded';
	    var accordionItemSelector = '.widget_nav_menu .menu > li';
	    var toggleSelector = '.widget_nav_menu .menu > li > a';
	 
	    $(toggleSelector).on('click', function(e) {
	 		e.preventDefault();

	        $(this)
	            .closest(accordionItemSelector)
	            .toggleClass(activeItemClass)
	                .siblings()
	                .removeClass(activeItemClass);
	    });

		//Slider
		$('.slider .slides').bxSlider({
			pager: false,
			prevText: '',
			nextText: '',
			auto: false
		});

		// Select
		$('select').selecter();

		//Mobile Nav Button
		$('.btn-menu').on('click', function (event) {
		    $(this).toggleClass('active');  
		    $(this).parent().toggleClass('active');
		    
		    event.preventDefault();
		});

		$win.on('load resize', function() {
	  		if ($win.width() > 767) {
				$.fn.equalizeHeight = function() {
				    var maxHeight = 0, itemHeight;
				 
				    for (var i = 0; i < this.length; i++) {
				        itemHeight = $(this[i]).outerHeight();
				        if (maxHeight < itemHeight) {
				            maxHeight = itemHeight;
				        }
				    }
				 
				    return this.outerHeight(maxHeight);
				}
				 
				$('.sidebar, .content').equalizeHeight();
			}
		});
	});
})(jQuery, window, document);
