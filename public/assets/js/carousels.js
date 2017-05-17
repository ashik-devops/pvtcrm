$(document).ready(function() {
	'use strict';

	/* ======= Flexslider ======= */
	/* ref: http://flexslider.woothemes.com/index.html */
	$('.flexslider').flexslider({
			animation: "slide"
	});

	/* ======= Owl ========= */
	 $("#owl-demo").owlCarousel({

				autoPlay: 3000, //Set AutoPlay to 3 seconds
				items : 4,
				itemsDesktop : [1199,3],
				itemsDesktopSmall : [979,3]

		});
});
