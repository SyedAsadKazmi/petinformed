// jQuery(document).ready(function() {
// 	var stickyNavPrimaryTop = jQuery('.nav-primary').offset().top + 90;

// 	var stickyNavPrimary = function() {
// 		var scrollTop = jQuery(window).scrollTop();

// 		if ( scrollTop > stickyNavPrimaryTop ) { 
// 			 jQuery('.nav-primary-sticky').addClass('nav-primary-sticky-slidein-transition');
// 		} else {
// 				jQuery('.nav-primary-sticky').removeClass('nav-primary-sticky-slidein-transition');
// 		}
// 	};

// 	stickyNavPrimary();
// jQuery('.nav-primary').before(jQuery('.nav-primary').clone().addClass('nav-primary-sticky nav-primary-sticky-slidein'));
// 	jQuery(window).scroll(function() {
// 		stickyNavPrimary();
// 	});
// });



// jQuery(document).ready(function() {
// 	var stickyNavPrimaryTop = jQuery('.nav-primary').offset().top + 90;

// 	var stickyNavPrimary = function() {
// 		var scrollTop = jQuery(window).scrollTop();

// 		if ( scrollTop > stickyNavPrimaryTop ) { 
// 			 //jQuery('.nav-primary-sticky').addClass('nav-primary-sticky-visible');
// 			 //jQuery('.nav-primary-sticky').css('display', 'block');
// 			 jQuery('.nav-primary-scroll-wrap').css('display', 'block');
// 			jQuery('.nav-primary-scroll-wrap').addClass('nav-primary-sticky-slidein-transition');
// 		} else {
// 				//jQuery('.nav-primary-sticky').removeClass('nav-primary-sticky-visible');
// 				jQuery('.nav-primary-scroll-wrap').css('display', 'none');
// 			jQuery('.nav-primary-scroll-wrap').removeClass('nav-primary-sticky-slidein-transition');
// 				//jQuery('.nav-primary-sticky').css('display', 'none');
// 		}
// 	};

// 	stickyNavPrimary();
// //jQuery('.nav-primary').before(jQuery('.nav-primary').clone().addClass('nav-primary-sticky'));
// 	var cloned_primary_nav = jQuery('.nav-primary').clone().addClass('nav-primary-sticky nav-primary-sticky-slidein');
// jQuery(cloned_primary_nav).insertBefore('.nav-primary').wrap( '<div class="nav-primary-scroll-wrap"></div>' );
// 	//$(orgin).wrap('<li></li>').parent().prependTo( ".images .thumbnails .slideshow");

// 	jQuery(window).scroll(function() {
// 		stickyNavPrimary();
// 	});
// });

jQuery(document).ready(function() {
	var stickyNavPrimaryTop = jQuery('.nav-primary').offset().top;

	var stickyNavPrimary = function() {
		var scrollTop = jQuery(window).scrollTop();

		if ( scrollTop > stickyNavPrimaryTop ) { 
			 //jQuery('.nav-primary-sticky').addClass('nav-primary-sticky-visible');
			 //jQuery('.nav-primary-sticky').css('display', 'block');
			// jQuery('.nav-primary-scroll-wrap').css('display', 'block');
			//jQuery('.nav-primary-scroll-wrap').css('position', 'fixed');
			//jQuery('.disruptpress-nav-menu li:first-child').css('padding-left', '0px');
			//jQuery('.disruptpress-nav-menu li:last-child').css('padding-right', '0px');
			jQuery('.nav-primary-scroll-wrap').addClass('nav-primary-scroll-wrap-sticky');
			jQuery('.nav-primary').addClass('nav-primary-sticky');
		} else {
				//jQuery('.nav-primary-sticky').removeClass('nav-primary-sticky-visible');
				//jQuery('.nav-primary-scroll-wrap').css('display', 'none');
			jQuery('.nav-primary-scroll-wrap').removeClass('nav-primary-scroll-wrap-sticky');
			jQuery('.nav-primary').removeClass('nav-primary-sticky');
			//jQuery('.disruptpress-nav-menu li:first-child').css('padding-left', '20px');
			//jQuery('.disruptpress-nav-menu li:last-child').css('padding-right', '20px');
				//jQuery('.nav-primary-sticky').css('display', 'none');
		}
	};

	stickyNavPrimary();
	//var cloned_primary_nav = jQuery('.nav-primary').clone().addClass('nav-primary-sticky nav-primary-sticky-slidein');

	jQuery(window).scroll(function() {
		stickyNavPrimary();
	});
});