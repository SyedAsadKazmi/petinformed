jQuery(document).ready(function() {
	var stickyNavPrimaryTop = jQuery('.nav-primary').offset().top;

	var stickyNavPrimary = function() {
		var scrollTop = jQuery(window).scrollTop();

		if ( scrollTop > stickyNavPrimaryTop ) { 
			jQuery('.nav-primary-scroll-wrap').addClass('nav-primary-scroll-wrap-sticky');
			jQuery('.nav-primary').addClass('nav-primary-sticky');
		} else {
			jQuery('.nav-primary-scroll-wrap').removeClass('nav-primary-scroll-wrap-sticky');
			jQuery('.nav-primary').removeClass('nav-primary-sticky');
		}
	};

	stickyNavPrimary();

	jQuery(window).scroll(function() {
		stickyNavPrimary();
	});
});