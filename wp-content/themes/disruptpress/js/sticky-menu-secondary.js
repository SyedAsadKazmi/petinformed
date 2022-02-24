jQuery(document).ready(function() {
	var stickyNavSecondaryTop = jQuery('.nav-secondary').offset().top;

	var stickyNavSecondary = function(){
	var scrollTop = jQuery(window).scrollTop();

	if ( scrollTop > stickyNavSecondaryTop ) { 
		 jQuery('.nav-secondary').addClass('nav-secondary-sticky');
	} else {
			jQuery('.nav-secondary').removeClass('nav-secondary-sticky');
	}
	};

	stickyNavSecondary();

	jQuery(window).scroll(function() {
		stickyNavSecondary();
	});
});
