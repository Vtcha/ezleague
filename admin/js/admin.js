(function( $ ){

	var EZL = {

		/**
		 * Initialize basic theme JavaScript
		 */
		init: function() {

			this.cacheElements();

		},

		/**
		 * Cache elements to object-level variables
		 */
		cacheElements: function() {

		},

		/**
		* Load Slider Images
		*/
		loadSliderImages: function() {

			$('#mobile-slider .slide').each(function() {
				var image = $(this).attr('data-background-image');
				$(this).css('background-image', 'url(' + image + ')' );
			});
		}

	};

	/**
	 * Wait until the document is ready before initializing the js
	 */
	$(document).ready(function(){

		EZL.init();

	});

}( jQuery ) );