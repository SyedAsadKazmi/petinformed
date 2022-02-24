jQuery(document).ready(function () {
	jQuery('#disruptpress-responsive-menu-toggle').sidr({
		timing: 'ease-in-out',
		speed: 150,
	//	source: 'disruptpress-responsive-menu',
		name: 'disruptpress-responsive-menu',
	});
	
	jQuery('#disruptpress-responsive-menu-toggle-inside').sidr({
		timing: 'ease-in-out',
		speed: 150,
	//	source: 'disruptpress-responsive-menu',
		name: 'disruptpress-responsive-menu',
	});
});

// jQuery( window ).resize(function () {
// 	jQuery.sidr('close', 'disruptpress-responsive-menu');
// });