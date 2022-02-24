/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */

//WP Customizer
( function( $ ) {
	
	dpWebSafeFonts = ['Arial, Helvetica, sans-serif',
		'"Arial Black", Gadget, sans-serif',
		'"Comic Sans MS", cursive, sans-serif',
		'Impact, Charcoal, sans-serif',
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif',
		'Tahoma, Geneva, sans-serif',
		'"Trebuchet MS", Helvetica, sans-serif',
		'Verdana, Geneva, sans-serif',
		'Georgia, serif',
		'"Palatino Linotype", "Book Antiqua", Palatino, serif',
		'"Times New Roman", Times, serif',
		'"Courier New", Courier, monospace',
		'"Lucida Console", Monaco, monospace'
	];
	
	dpShadows = ['0px 3px 15px 0px #777777',
	 '0px 6px 15px 0px #777777',
	 '0px 7px 12px 0px #777777',
	 '0 10px 6px -6px #777777',
	 '0px 17px 14px -10px #777777',
	 '0px 20px 11px -10px #777777',
	 '0px 10px 20px -6px #000000',
	 '0px 12px 20px -6px #000000',
	 '0px 15px 20px -6px #000000',
	];
	
	dpHoverShadows = ['none',
	 'inset 0px 2px 5px 0px #000000',
	 'inset 0px 2px 10px 1px #000000',
	 'inset 0px 0px 20px 5px rgba(0,0,0,0.75)',
	];
	
	
	dp_font_style = [
		"",
		 
		"text-shadow: 3px 3px 0px rgba(0,0,0,0.2);",

		"text-shadow: 4px 3px 0px #fff, 5px 4px 0px rgba(0,0,0,0.15);",

		"text-shadow: 0 1px 0 #fff,\
		0 2px 0 #fff,\
		0 3px 0 #fff,\
		0 4px 0 #aaa,\
		0 5px 0 #bbb,\
		0 6px 1px rgba(0,0,0,.1),\
		0 0 5px rgba(0,0,0,.1),\
		0 1px 3px rgba(0,0,0,.3),\
		0 3px 5px rgba(0,0,0,.2),\
		0 5px 10px rgba(0,0,0,.0),\
		0 10px 10px rgba(0,0,0,.0),\
		0 20px 20px rgba(0,0,0,.0);",

		"text-shadow: 0px 4px 3px rgba(0,0,0,0.4),\
		0px 8px 13px rgba(0,0,0,0.1),\
		0px 18px 23px rgba(0,0,0,0.1);",

		"text-shadow: 3px 3px 0px #2c2e38, 5px 5px 0px #5c5f72;",

		"background-color: #5a5a5a;\
		-webkit-background-clip: text;\
		-moz-background-clip: text;\
		background-clip: text;\
		color: transparent;\
		text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;",

		"text-shadow: 2px 8px 6px rgba(0,0,0,0.2),\
		0px 1px 15px rgba(255,255,255,0.3);",

		"text-shadow: -1px -1px 0px rgba(255,255,255,0.1), 2px 2px 0px rgba(0,0,0,0.8);",

		"text-shadow: 0px 1px 0px #FFF, 0px 2px 0px #FFF, 0px 3px 0px #EEE, 0px 4px 0px #DDD, 0px 5px 0px #DDD, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;"

	];


	function dpApplyFont( selector, font_field, required_field ) {
		
		if( required_field == '') {
			var required = false;
		} else {
			var required = wp.customize.value( required_field )();
		}
		
		
		if( required != false ) {
			var font = wp.customize.value( 'dp_typography_font_family' )();
			var font_css = font.replace(/\+/g, " ");
			
			if( jQuery.inArray( font_css, dpWebSafeFonts ) === -1 && font != '') {
				$( 'head' ).append( '<link href="https://fonts.googleapis.com/css?family=' + font + '" rel="stylesheet" type="text/css">' );
				$( selector ).css('font-family', '"' + font_css + '"');

			} else if ( font != '' || font != ' ' ) {
				$( selector ).css('font-family', font_css);
			}
			
		} else {
			var font = wp.customize.value( font_field )();
			var font_css = font.replace(/\+/g, " ");
			
			if( jQuery.inArray( font_css, dpWebSafeFonts ) === -1 && font != '') {
				$( 'head' ).append( '<link href="https://fonts.googleapis.com/css?family=' + font + '" rel="stylesheet" type="text/css">' );
				$( selector ).css('font-family', '"' + font_css + '"');

			} else if ( font != '' || font != ' ' ) {
				$( selector ).css('font-family', font_css);
			}
			
		}
		
	}
	/**
	 * Adjusting search form to use full height so dividers go full lenght.
	 * Height based on font size mutliplied by 2
	 */
	
	function dpAdjustSearchFieldHeight( css_selector, get_auto_height_toggle, get_search_field_height, get_font_size ) {
		
		if ( wp.customize.value( get_auto_height_toggle )() == false ) {
			var height = parseInt( wp.customize.value( get_font_size )() ) * 2;
		} else {
			var height = parseInt( wp.customize.value( get_search_field_height )() );
		}
	
		$.stylesheet( css_selector + ' .search-field' ).css( 'height', height + 'px' );
		$.stylesheet( css_selector + ' .search-submit' ).css( 'height', height + 'px' );
		$.stylesheet( css_selector + ' .search-submit' ).css( 'width', height + 'px' );
		$.stylesheet( css_selector + ' .search-submit' ).css( 'margin-left', '-' + height + 'px' );
	}
	
	function dpAdjustSearchFont( selector, auto_font_toggle, menu_font_size, search_font_size ) {
		
		if ( wp.customize.value( auto_font_toggle )() == false ) {
			var font_size = parseInt( wp.customize.value( menu_font_size )() );
		} else {
			var font_size = parseInt( wp.customize.value( search_font_size )() );
		}
			
		$( selector + ' .search-field' ).css( 'font-size', font_size + 'px' );
		$( selector + ' .search-submit' ).css( 'font-size', font_size + 4 + 'px' );
	}
	
	//dpAdjustMenuPadding
	function dpMenuWidthWrap ( selector ) {
		
		
		
		
		
		
// 		var site_layout = wp.customize.value( 'dp_site_layout' )();
			
// 		if ( newval == true && site_layout == '3' ) {
// 			var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )() * 2;

// 			$.stylesheet( '.nav-primary' ).css( 'max-width', 'calc(100% - ' + padding + 'px' );
// 			$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

// 		} else if ( newval == true ) {
// 			var width = wp.customize.value( 'dp_site_container_width' )();
// 			var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
// 			var maxwidth = width - (padding * 2);

// 			$.stylesheet( '.nav-primary' ).css( 'max-width', maxwidth + 'px' );
// 			$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

// 		} else {
// 			var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();

// 			$.stylesheet( '.nav-primary' ).css( 'max-width', 'none' );
// 			$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px', } );
// 		}
		
		
		
// 		var boxed = wp.customize.value( 'dp_primary_menu_boxed' )();
			
// 			// Only procceed if Primary Menu Boxed Width is false. No need to adjust first item alignment in boxed mode.
// 			if ( boxed == false ) {
				
// 				if ( newval == true ) {
// 					var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
// 					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px', } );
// 				} else {
// 					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );
// 				}
				
// 			}

	}
	
	function apply_bg (selector, prefix, height) {
		
		if ( typeof height === 'undefined') { 
			var height = false;
		} else {
			var height = wp.customize.value( prefix +'_height' )();
		}
		
		var color_style = wp.customize.value( prefix +'_color_style' )();
		var color = wp.customize.value( prefix + '_color' )();
		var color2 = wp.customize.value( prefix +'_color2' )();
		var shade_strenght = wp.customize.value( prefix +'_shade_strenght' )();
		var gradient_style = wp.customize.value( prefix +'_gradient_style' )();
		var gradient_advanced_toggle = wp.customize.value( prefix +'_gradient_advanced_toggle' )();
		var gradient_position_parameter1 = wp.customize.value( prefix +'_gradient_position_parameter1' )();
		var gradient_position_parameter2 = wp.customize.value( prefix +'_gradient_position_parameter2' )();
		var gradient_reverse_color = wp.customize.value( prefix +'_gradient_reverse_color' )();
		var img_panel = wp.customize.value( prefix +'_img_panel' )();
		var pattern = wp.customize.value( prefix +'_pattern' )();
		var img_upload = wp.customize.value( prefix +'_img_upload' )();
		var img_repeat = wp.customize.value( prefix +'_img_repeat' )();
		var img_size = wp.customize.value( prefix +'_img_size' )();
		var img_attachment = wp.customize.value( prefix +'_img_attachment' )();
		var img_position = wp.customize.value( prefix +'_img_position' )();
		
		if( color_style == '1' ) {
			var shape = '0';
		} else {
			var shape = gradient_style;
		}
		var inIframe = false;
		
		return bg_gradient(selector, shape, color, color2, color_style, img_panel, pattern, img_upload, img_position, img_size, img_repeat, img_attachment, gradient_position_parameter1, gradient_position_parameter2, shade_strenght, gradient_reverse_color, gradient_advanced_toggle, inIframe);
	
	}
	// Background No Images
	function apply_bg_no_img (selector, prefix, height) {
		
		if ( typeof height === 'undefined') { 
			var height = false;
		} else {
			var height = wp.customize.value( prefix +'_height' )();
		}
		
		var color_style = wp.customize.value( prefix +'_color_style' )();
		var color = wp.customize.value( prefix + '_color' )();
		var color2 = wp.customize.value( prefix +'_color2' )();
		var shade_strenght = wp.customize.value( prefix +'_shade_strenght' )();
		var gradient_style = wp.customize.value( prefix +'_gradient_style' )();
		var gradient_advanced_toggle = wp.customize.value( prefix +'_gradient_advanced_toggle' )();
		var gradient_position_parameter1 = wp.customize.value( prefix +'_gradient_position_parameter1' )();
		var gradient_position_parameter2 = wp.customize.value( prefix +'_gradient_position_parameter2' )();
		var gradient_reverse_color = wp.customize.value( prefix +'_gradient_reverse_color' )();
		var img_panel = '1';
		var pattern = '0';
		var img_upload = '';
		var img_repeat = '';
		var img_size = '';
		var img_attachment = '';
		var img_position = '';
		
		if( color_style == '1' ) {
			var shape = '0';
		} else {
			var shape = gradient_style;
		}
		var inIframe = false;
		
		return bg_gradient(selector, shape, color, color2, color_style, img_panel, pattern, img_upload, img_position, img_size, img_repeat, img_attachment, gradient_position_parameter1, gradient_position_parameter2, shade_strenght, gradient_reverse_color, gradient_advanced_toggle, inIframe);
	
	}
	
	
	function dpApplyBorder(selector, color, style, top, right, bottom, left) {
		
		if ( color == '') {
			var color = '#000';
		} else if ( color.includes("#") ) {
			var color = color;
		} else {
			var color = wp.customize.value( color )();
		}
		var style = wp.customize.value( style )();

		
		if ( top != '' ) {
			if( !jQuery.isNumeric(top) ) {
				var top = wp.customize.value( top )();
			}
			$.stylesheet( selector ).css( 'border-top', top+'px ' + style + ' ' + color );
		}
		
		if ( top != '' ) {
			if( !jQuery.isNumeric(right) ) {
				var right = wp.customize.value( right )();
			}
			$.stylesheet( selector ).css( 'border-right', right+'px ' + style + ' ' + color );
		}
		
		if ( top != '' ) {
			if( !jQuery.isNumeric(bottom) ) {
				var bottom = wp.customize.value( bottom )();
			}
			$.stylesheet( selector ).css( 'border-bottom', bottom+'px ' + style + ' ' + color );
		}
		
		if ( top != '' ) {
			if( !jQuery.isNumeric(left) ) {
				var left = wp.customize.value( left )();
			}
			$.stylesheet( selector ).css( 'border-left', left+'px ' + style + ' ' + color );
		}	
	}
	
	//Box Shadow
	function dpBoxShadow (selector, horizontal, vertical, blurradius, spreadradius, opacity, inset) {
		
		if( !jQuery.isNumeric(horizontal)) {
			var horizontal = wp.customize.value( horizontal )();
		}
		
		if( !jQuery.isNumeric(vertical)) {
			var vertical = wp.customize.value( vertical )();
		}
		
		if( !jQuery.isNumeric(blurradius)) {
			var blurradius = wp.customize.value( blurradius )();
		}
		
		if( !jQuery.isNumeric(spreadradius)) {
			var spreadradius = wp.customize.value( spreadradius )();
		}
		
		if( !jQuery.isNumeric(opacity)) {
			var opacity = wp.customize.value( opacity )();
		}
		
		if( !jQuery.isNumeric(inset)) {
			var inset = wp.customize.value( inset )();
		} else {
			if(inset == "1") {
				var inset = 'inset ';
			} else {
				var inset = '';
			}
		}
		
		$.stylesheet( selector ).css( 'box-shadow', inset + horizontal + 'px ' + vertical + 'px ' + blurradius + 'px ' + spreadradius + 'px rgba(0, 0, 0, ' + opacity +')' );
		
	}
	
function DPApplyBlur (selector, blursize, scale) {

	if(scale == 'noscale') {
		
	} else if(scale == 'auto') {
		
		var scalesize = Math.ceil(blursize / 25);

		$(selector).css( '-webkit-transform', 'scale(1.' + scalesize + ')' );
		$(selector).css( '-moz-transform', 'scale(1.' + scalesize + ')' );
		$(selector).css( '-ms-transform', 'scale(1.' + scalesize + ')' );
		$(selector).css( 'transform', 'scale(1.' + scalesize + ')' );
		
	} else {
		$(selector).css( '-webkit-transform', 'scale(' + scale + ')' );
		$(selector).css( '-moz-transform', 'scale(' + scale + ')' );
		$(selector).css( '-ms-transform', 'scale(' + scale + ')' );
		$(selector).css( 'transform', 'scale(' + scale + ')' );
	}
		
	$(selector).css('filter','' );
	$(selector).css( '-webkit-filter', 'blur(' + blursize + 'px)' );
	$(selector).css( '-moz-filter', 'blur(' + blursize + 'px)' );
	$(selector).css( '-ms-filter', 'blur(' + blursize + 'px)' );
	$(selector).css( 'filter', 'blur(' + blursize + 'px)' );
}
	
	

	function dpMenuItemDividers ( selector, color_selector, color2_selector, colortoggle_in, style_in, open_in, close_in, top_in, bottom_in, search_toggle, search_open, search_close, search_selector, boxshadow ) {
		
		var color = dp_rgb2hex( wp.customize.value( color_selector )() );
		var color2 = dp_rgb2hex( wp.customize.value( color2_selector )() );
		var style = wp.customize.value( style_in )();
		var open = wp.customize.value( open_in )();
		var close = wp.customize.value( close_in )();
		var top = wp.customize.value( top_in )();
		var bottom = wp.customize.value( bottom_in )();
		var colortoggle = wp.customize.value( colortoggle_in )();
		var search = wp.customize.value( search_toggle )();
		var search_open = wp.customize.value( search_open )();
		var search_close = wp.customize.value( search_close )();
		var boxshadow = wp.customize.value( boxshadow )();

		if ( colortoggle == false ) {
			var newcolor = shading( color, -0.4);
			var newcolor2 = shading( color, 0.3);
			
		} else {
			var newcolor = shading( color2, -0.4);
			var newcolor2 = shading( color2, 0.3);
		}
		
		if ( search == '0' ) {
			var selector_last = ':last-child';
		} else {
			var selector_last = ':nth-last-child(2)';
		}
		
		if ( style == '0' ) {
			$.stylesheet( selector ).css('box-shadow', 'none');
			$.stylesheet( selector + ':first-child' ).css('box-shadow', 'none');
			$.stylesheet( selector + ':last-child' ).css('box-shadow', 'none');
			
			$.stylesheet( selector + ':first-child' ).css('border-left', 'none');
			$.stylesheet( selector + ':last-child' ).css('border-right', 'none');
			
			$.stylesheet( selector ).css('border-top', 'none');
			$.stylesheet( selector ).css('border-bottom', 'none');
		} 
			
		if ( style == '1' ) {
			$.stylesheet( selector ).css('box-shadow', 'none');	
			
			$.stylesheet( selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset');
			//$( selector + ':first-child' ).css('box-shadow', 'none');
			
			if ( open == true ) {
				$( selector + ':first-child' ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset');
				
			} else {
				$.stylesheet( selector + ':first-child' ).css('box-shadow', 'none');
			}
			
			if ( close == true ) {
				$.stylesheet( selector + selector_last ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor + ' -1px 0px 0px 0px inset');
			} else {
				$.stylesheet( selector + selector_last ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset');
			}
			
			if ( search == '1' ) {
			
				if ( search_open == true && search_close == true ) {
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor + ' -1px 0px 0px 0px inset');
				} else if ( search_open == true ) {
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset');
				} else if ( search_close == true ) {
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' -1px 0px 0px 0px inset');
				} else {
					$.stylesheet( search_selector ).css('box-shadow', 'none');
				}
				
			}
			
			if ( top == true ) {
				$.stylesheet( selector ).css('border-top', '1px solid ' + newcolor);
			} else {
				$.stylesheet( selector ).css('border-top', 'none');
			}
			
			if ( bottom == true ) {
				$.stylesheet( selector ).css('border-bottom', '1px solid ' + newcolor );
			} else {
				$.stylesheet( selector ).css('border-bottom', 'none');
			}
			
		}
		
		if ( style == '2' ) {
			$.stylesheet( selector ).css('box-shadow', 'none');	

			if ( top == true ) {
				$.stylesheet( selector ).css('border-top', '1px solid ' + newcolor );
				var border_top = ', ' + newcolor2 + ' 0px 1px 0px 0px inset';
			} else {
				$.stylesheet( selector ).css('border-top', 'none');
				var border_top = '';
			}
			
			if ( bottom == true ) {
				$.stylesheet( selector ).css('border-bottom', '1px solid ' + newcolor );
			} else {
				$.stylesheet( selector ).css('border-bottom', 'none');
			}
			
			if ( boxshadow == '0') {
				$.stylesheet( selector ).css('box-shadow', newcolor + ' -1px 0px 0px 0px, ' + newcolor2 + ' -2px 0px 0px 0px' + border_top );
			} else {
				$.stylesheet( selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset' + border_top );
			}
			
			if ( open == true ) {
				if ( boxshadow == '0') {
				 $.stylesheet( selector ).css('box-shadow', newcolor + ' -1px 0px 0px 0px, ' + newcolor2 + ' -2px 0px 0px 0px' + border_top );
				} else {
					$.stylesheet( selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset' + border_top );
				}
				
			} else {
				$.stylesheet( selector + ':first-child' ).css('box-shadow', 'none');
			}
			
			if ( close == true ) {
				
				if ( boxshadow == '0') {
					$.stylesheet( selector + selector_last ).css('box-shadow', newcolor + ' -1px 0px 0px 0px, ' + newcolor2 + ' -2px 0px 0px 0px, ' + newcolor2 + ' 1px 0px 0px 0px, ' + newcolor + ' 2px 0px 0px 0px' + border_top );
				} else {
					$.stylesheet( selector + selector_last ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset, ' + newcolor2 + ' -1px 0px 0px 0px inset, ' + newcolor + ' -2px 0px 0px 0px inset' + border_top );
				}
				
			} else {
				$.stylesheet( selector + selector_last ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset' + border_top );
			//	$( selector + ':last-child' ).css('box-shadow', newcolor2 + ' 1px 0px 0px 0px inset' + border_top );
			}
			
			if ( search == '1' ) {
			
				if ( search_open == true && search_close == true ) {
					
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset, ' + newcolor2 + ' -1px 0px 0px 0px inset, ' + newcolor + ' -2px 0px 0px 0px inset' + border_top );
				} else if ( search_open == true ) {
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' 1px 0px 0px 0px inset, ' + newcolor2 + ' 2px 0px 0px 0px inset' + border_top );
				} else if ( search_close == true ) {
					$.stylesheet( search_selector ).css('box-shadow', newcolor + ' -1px 0px 0px 0px inset, ' + newcolor2 + ' -2px 0px 0px 0px inset' + border_top );
				} else {
					$.stylesheet( search_selector ).css('box-shadow', 'none');
				}
				
			}
		}
	}
	
	/**
	* Section: Site Container
	* Field: Website Layout
	*/
	wp.customize( 'dp_site_layout', function( value ) {
		value.bind( function( newval ) {

			var container_width = wp.customize.value( 'dp_site_container_width' )();
			var padding_top_bottom = wp.customize.value( 'dp_site_container_margin_top_bottom' )();

			// If boxed layout is selected.
			if ( newval == '1' ) {
				$.stylesheet('.site-container').css('max-width', container_width + 'px' );
				$.stylesheet('.wrap').css('max-width', container_width + 'px' );
			}

			// If wide layout is selected.
			if ( newval == '2' ) {
				$.stylesheet('.site-container').css('max-width', '100%' );
				$.stylesheet('.wrap').css('max-width', container_width + 'px' );
			}

			// If full width layout is selected.
			if ( newval == '3' ) {
				$.stylesheet('.site-container').css('max-width', '100%' );
				$.stylesheet('.wrap').css('max-width', '100%' );
			}





			var site_layout = newval;
			var boxed = wp.customize.value( 'dp_primary_menu_boxed' )();

			if ( boxed == true && site_layout == '3' ) {
				var padding_left_right = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )() * 2;

				$.stylesheet( '.nav-primary' ).css( 'max-width', 'calc(100% - ' + padding_left_right + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else if ( boxed == true ) {
				var width = wp.customize.value( 'dp_site_container_width' )();
				var padding_left_right = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )() * 2;
				//var padding = newval;
				var maxwidth = width - padding_left_right;

				$.stylesheet( '.nav-primary' ).css( 'max-width', maxwidth + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else {
				//var padding = newval;

				$.stylesheet( '.nav-primary' ).css( 'max-width', 'none' );
				var alignment_padding = wp.customize.value( 'dp_primary_menu_item_alignment_padding' )();
				if ( alignment_padding == true ) {
					var padding_left_right = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();

					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding_left_right + 'px', 'padding-right': padding_left_right + 'px', } );
				} else {
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );
				}
			}


		} );
	} );

	/**
	* Section: Site Container
	* Field: Container Width
	*/
	wp.customize( 'dp_site_container_width', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.wrap' ).css( 'max-width', newval + 'px' );

			var dp_site_layout = wp.customize.value( 'dp_site_layout' )();

			// Adjust max-width of .site-container if boxed layout is selected.
			if ( dp_site_layout == '1' ) {
				$.stylesheet( '.site-container' ).css( 'max-width', newval + 'px' );
			}



		} );
	} );

    /**
     * Section: Site Container
     * Field: Padding Top (Site Inner)
     */
    wp.customize( 'dp_site_container_site_inner_padding_top', function( value ) {
        value.bind( function( newval ) {

            $.stylesheet( '.site-inner' ).css( 'padding-top', newval + 'px' );
        } );
    } );

	/**
	* Section: Site Container
	* Field: Container Wrap Padding Left & Right
	*/
	wp.customize( 'dp_site_container_wrap_padding_left_right', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.wrap' ).css( { 'padding-left': newval + 'px', 'padding-right': newval + 'px' } );

			var site_layout = wp.customize.value( 'dp_site_layout' )();
			var boxed = wp.customize.value( 'dp_primary_menu_boxed' )();

			if ( boxed == true && site_layout == '3' ) {
				//var padding = newval * 2;

				//$.stylesheet( '.nav-primary' ).css( 'max-width', 'calc(100% - ' + padding + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else if ( boxed == true ) {
				//var width = wp.customize.value( 'dp_site_container_width' )();
				//var padding = newval;
				//var maxwidth = width - (padding * 2);

				//$.stylesheet( '.nav-primary' ).css( 'max-width', maxwidth + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else {
				//var padding = newval;

				//$.stylesheet( '.nav-primary' ).css( 'max-width', 'none' );
				var alignment_padding = wp.customize.value( 'dp_primary_menu_item_alignment_padding' )();
				if ( alignment_padding == true ) {
					var padding = newval;
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px', } );
				} else {
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );
				}

			}

			/*dpAdjustMenuPadding (
				'.nav-primary .wrap',
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_item_alignment_padding',
				'dp_site_container_wrap_padding_left_right',
				'dp_primary_menu_item_padding_left_right'
			);*/

		} );
	} );

	// Container Margin Top Bottom
	wp.customize( 'dp_site_container_margin_top_bottom', function( value ) {
		value.bind( function( newval ) {
			$('.body-container').css('padding-top', newval + 'px' );
			$('.body-container').css('padding-bottom', newval + 'px' );
		} );
	} );

	// Container Margin Left Right
	wp.customize( 'dp_site_container_margin_left_right', function( value ) {
		value.bind( function( newval ) {
			$('.body-container').css('padding-left', newval + 'px' );
			$('.body-container').css('padding-right', newval + 'px' );
		} );
	} );

	// Container Border Style
	wp.customize( 'dp_site_container_border_style', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-container',
				'dp_site_container_border_color',
				'dp_site_container_border_style',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right'
			)
		} );
	} );

	// Container Border Width Left Right
	wp.customize( 'dp_site_container_border_width_left_right', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-container',
				'dp_site_container_border_color',
				'dp_site_container_border_style',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right'
			)
		} );
	} );

	// Container Border Width Top Bottom
	wp.customize( 'dp_site_container_border_width_top_bottom', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-container',
				'dp_site_container_border_color',
				'dp_site_container_border_style',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right'
			)
		} );
	} );

	// Container Border Color
	wp.customize( 'dp_site_container_border_color', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-container',
				'dp_site_container_border_color',
				'dp_site_container_border_style',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right',
				'dp_site_container_border_width_top_bottom',
				'dp_site_container_border_width_left_right'
			)
		} );
	} );

	// Container Box Shadow Blur Radius
	wp.customize( 'dp_site_container_box_shadow_blur_radius', function( value ) {
		value.bind( function( newval ) {

			dpBoxShadow ('.site-container',
				'0',
				'0',
				'dp_site_container_box_shadow_blur_radius',
				'dp_site_container_box_shadow_spread_radius',
				'dp_site_container_box_shadow_opacity',
				'0'
			)
		} );
	} );

	// Container Box Shadow Spread Radius
	wp.customize( 'dp_site_container_box_shadow_spread_radius', function( value ) {
		value.bind( function( newval ) {

			dpBoxShadow ('.site-container',
				'0',
				'0',
				'dp_site_container_box_shadow_blur_radius',
				'dp_site_container_box_shadow_spread_radius',
				'dp_site_container_box_shadow_opacity',
				'0'
			)
		} );
	} );

	// Container Box Shadow Opacity
	wp.customize( 'dp_site_container_box_shadow_opacity', function( value ) {
		value.bind( function( newval ) {

			dpBoxShadow ('.site-container',
				'0',
				'0',
				'dp_site_container_box_shadow_blur_radius',
				'dp_site_container_box_shadow_spread_radius',
				'dp_site_container_box_shadow_opacity',
				'0'
			)
		} );
	} );

	wp.customize( 'dp_site_container_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-container').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_site_container_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$('.site-container').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_site_container_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$('.site-container').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_site_container_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-container').css('border-bottom-left-radius', newval + 'px');
		} );
	} );



	wp.customize( 'dp_site_container_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_panel', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_pattern', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_upload', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_repeat', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_size', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_attachment', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

	wp.customize( 'dp_site_container_img_position', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-container', 'dp_site_container');
		} );
	} );

/**
 * Background
 */
// 	wp.customize( 'dp_bg_color_style', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_color', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_color2', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_shade_strenght', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_gradient_style', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_gradient_advanced_toggle', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_gradient_position_parameter1', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_gradient_position_parameter2', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_gradient_reverse_color', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_panel', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_pattern', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_upload', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_repeat', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_size', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_attachment', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

// 	wp.customize( 'dp_bg_img_position', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg('.body-container', 'dp_bg');
// 		} );
// 	} );

wp.customize( 'dp_bg_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_panel', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_pattern', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_upload', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_repeat', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_size', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_attachment', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	wp.customize( 'dp_bg_img_position', function( value ) {
		value.bind( function( newval ) {
			apply_bg('body', 'dp_bg');
		} );
	} );

	/**
 * Background 2
 */
	wp.customize( 'dp_bg2_height_panel', function( value ) {
		value.bind( function( newval ) {
			var dp_bg2_height = wp.customize.value( 'dp_bg2_height' )();
			var dp_bg2_border_bottom_color = wp.customize.value( 'dp_bg2_border_bottom_color' )();
			var dp_bg2_border_bottom_size = wp.customize.value( 'dp_bg2_border_bottom_size' )();

			if ( newval == '1') {
				$('.body-background-2').css('min-height', '0px' );
				$('.body-background-2').css('background', 'none' );
				$('.body-background-2').css('border-bottom', 'none' );
				dpBoxShadow ('.body-background-2',
				'0',
				'0',
				'0',
				'0',
				'0',
				'0'
			)

			} else if ( newval == '2') {
				$('.body-background-2').css('min-height', '100vh' );
				$('.body-background-2').css('border-bottom', dp_bg2_border_bottom_size + 'px solid ' + dp_bg2_border_bottom_color);
				apply_bg('.body-background-2', 'dp_bg2');
				dpBoxShadow ('.body-background-2',
					'0',
					'dp_bg2_shadow_bottom_vertical',
					'dp_bg2_shadow_bottom_blur_radius',
					'dp_bg2_shadow_bottom_spread_radius',
					'dp_bg2_shadow_bottom_opacity',
					'0'
				);

			} else if ( newval == '3') {
				$('.body-background-2').css('min-height', '100%' );
				$('.body-background-2').css('border-bottom', dp_bg2_border_bottom_size + 'px solid ' + dp_bg2_border_bottom_color);
				apply_bg('.body-background-2', 'dp_bg2');
				dpBoxShadow ('.body-background-2',
					'0',
					'dp_bg2_shadow_bottom_vertical',
					'dp_bg2_shadow_bottom_blur_radius',
					'dp_bg2_shadow_bottom_spread_radius',
					'dp_bg2_shadow_bottom_opacity',
					'0'
				);

			} else if ( newval == '4') {
				$('.body-background-2').css('min-height', dp_bg2_height + 'px' );
				$('.body-background-2').css('border-bottom', dp_bg2_border_bottom_size + 'px solid ' + dp_bg2_border_bottom_color);
				apply_bg('.body-background-2', 'dp_bg2');
				dpBoxShadow ('.body-background-2',
					'0',
					'dp_bg2_shadow_bottom_vertical',
					'dp_bg2_shadow_bottom_blur_radius',
					'dp_bg2_shadow_bottom_spread_radius',
					'dp_bg2_shadow_bottom_opacity',
					'0'
				);
			}
		} );
	} );

	wp.customize( 'dp_bg2_height', function( value ) {
		value.bind( function( newval ) {
			$('.body-background-2').css('min-height', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_bg2_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_panel', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_pattern', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_upload', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_repeat', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_size', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_attachment', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	wp.customize( 'dp_bg2_img_position', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.body-background-2', 'dp_bg2');
		} );
	} );

	// Background 2 Box Shadow Vertrical
	wp.customize( 'dp_bg2_shadow_bottom_vertical', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.body-background-2',
				'0',
				'dp_bg2_shadow_bottom_vertical',
				'dp_bg2_shadow_bottom_blur_radius',
				'dp_bg2_shadow_bottom_spread_radius',
				'dp_bg2_shadow_bottom_opacity',
				'0'
			)
		} );
	} );

	// Background 2 Box Shadow Bottom Blur Radius
	wp.customize( 'dp_bg2_shadow_bottom_blur_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.body-background-2',
				'0',
				'dp_bg2_shadow_bottom_vertical',
				'dp_bg2_shadow_bottom_blur_radius',
				'dp_bg2_shadow_bottom_spread_radius',
				'dp_bg2_shadow_bottom_opacity',
				'0'
			)
		} );
	} );

	// Background 2 Box Shadow Bottom Spread Radius
	wp.customize( 'dp_bg2_shadow_bottom_spread_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.body-background-2',
				'0',
				'dp_bg2_shadow_bottom_vertical',
				'dp_bg2_shadow_bottom_blur_radius',
				'dp_bg2_shadow_bottom_spread_radius',
				'dp_bg2_shadow_bottom_opacity',
				'0'
			)
		} );
	} );

	// Background 2 Box Shadow Bottom Opacity
	wp.customize( 'dp_bg2_shadow_bottom_opacity', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.body-background-2',
				'0',
				'dp_bg2_shadow_bottom_vertical',
				'dp_bg2_shadow_bottom_blur_radius',
				'dp_bg2_shadow_bottom_spread_radius',
				'dp_bg2_shadow_bottom_opacity',
				'0'
			)
		} );
	} );

// 	//Background 2 Apply Blur
// 	wp.customize( 'dp_bg2_blur', function( value ) {
// 		value.bind( function( newval ) {
// 			DPApplyBlur('.body-background-2', newval, 'auto');
// 		} );
// 	} );

	// Background 2 Border Bottom Size
	wp.customize( 'dp_bg2_border_bottom_size', function( value ) {
		value.bind( function( newval ) {

			var color = wp.customize.value( 'dp_bg2_border_bottom_color' )();
			$('.body-background-2').css('border-bottom', newval + 'px solid ' + color);

		} );
	} );

	// Background 2 Border Bottom Color
	wp.customize( 'dp_bg2_border_bottom_color', function( value ) {
		value.bind( function( newval ) {

			var size = wp.customize.value( 'dp_bg2_border_bottom_size' )();
			$('.body-background-2').css('border-bottom', size + 'px solid ' + newval);

		} );
	} );











	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Header Logo
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	/**
	* Section: Header Logo
	* Field: Toggle Logo
	*/
// 	wp.customize( 'dp_header_logo_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 		if ( newval === true ) {
// 			//$( '.site-header .dp-site-header-logo' ).remove();
// 			//$.stylesheet( '.site-header .title-area' ).css( 'display', 'table-cell' );
// 			var logo_url = wp.customize.value( 'dp_header_logo_upload' )();
// 			var logo_title = wp.customize.value( 'dp_header_logo_title_toggle' )();
// 			var logo_title_style = wp.customize.value( 'dp_header_logo_title_style' )();
// 			var logo_tagline = wp.customize.value( 'dp_header_logo_tagline_toggle' )();
// 			var home_url = location.protocol + '//' + location.host;

// 			// Get Blogname
// 			if ( logo_title == '1') {
// 				var blogname = '';
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'none' );
// 			} else if ( logo_title == '2' ) {
// 				var blogname = wp.customize.value( 'blogname' )();
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
// 			} else if ( logo_title == '3' ) {
// 				var blogname = wp.customize.value( 'dp_header_logo_title_custom' )();
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
// 			}

// 			// Get Blog Description
// 			if ( logo_tagline == '1') {
// 				var blogdescription = '';
// 				$.stylesheet('.site-header .site-description').css('display', 'none');
// 			} else if ( logo_tagline == '2' ) {
// 				var blogdescription = wp.customize.value( 'blogdescription' )();
// 				$.stylesheet('.site-header .site-description').css('display', 'block');
// 			} else if ( logo_tagline == '3' ) {
// 				var blogdescription = wp.customize.value( 'dp_header_logo_tagline_custom' )();
// 				$.stylesheet('.site-header .site-description').css('display', 'block');
// 			}

// 			var output = '<div class="title-area">';

// 			output+= '<div class="title-logo"><a href="' + home_url + '" rel="home"><div class="title-logo-img"></div></a></div>';

// 			if ( logo_url ) {
// 				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'inline-block' );
// 				//$.stylesheet( '.site-header .title-logo-img' ).css( 'background-image', 'url(' + logo_url + ')' );
// 			} else {
// 				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'none' );
// 			}

// 			output += '<div class="site-title-wrap">';
// 			output += '<div class="site-title"><a href="' + home_url + '" rel="home" class="dp-font-style-' + logo_title_style + '">' + blogname + '</a></div>';
// 			output += '<div class="site-description">' + blogdescription + '</div></div></div>';

// 			$( '.site-header .disruptpress-nav-menu' ).prepend( output );

// 		} else {
// 			$( '.site-header .dp-site-header-logo' ).remove();
// 		}

// 		} );
// 	} );

	/**
	* Section: Header Logo
	* Field: Logo Upload
	*/
	wp.customize( 'dp_header_logo_upload', function( value ) {
		value.bind( function( newval ) {

			if ( newval != '' ) {

				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'inline-block' );
				$.stylesheet( '.site-header .title-logo-img' ).css( 'background-image', 'url(' + newval + ')' );
			} else {
				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'none' );
			}

		} );
	} );

	/**
	* Section: Header Logo
	* Field: Logo Width
	*/
	wp.customize( 'dp_header_logo_width', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-header .title-logo' ).css( 'width', newval + 'px' );
		} );
	} );

	/**
	* Section: Header Logo
	* Field: Logo Margin Right
	*/
	wp.customize( 'dp_header_logo_margin_right', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-header .title-logo' ).css( 'margin-right', newval + 'px' );
		} );
	} );

	/**
	* Section: Header Logo
	* Field: Logo Padding Left
	*/
	wp.customize( 'dp_header_logo_padding_left', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				var padding = wp.customize.value( 'dp_header_item_padding_left_right' )();
				$.stylesheet( '.site-header .dp-site-header-logo' ).css( 'padding-left', padding + 'px' );
			} else {
				$.stylesheet( '.site-header .dp-site-header-logo' ).css( 'padding-left', '0px' );
			}
		} );
	} );

	/**
	* Section: Header Logo
	* Field: Logo Padding Right
	*/
	wp.customize( 'dp_header_logo_padding_right', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				var padding = wp.customize.value( 'dp_header_item_padding_left_right' )();
				$.stylesheet( '.site-header .dp-site-header-logo' ).css( 'padding-right', padding + 'px' );
			} else {
				$.stylesheet( '.site-header .dp-site-header-logo' ).css( 'padding-right', '0px' );
			}
		} );
	} );

	/**
	* Section: Header Logo
	* Field: Title Area Width
	*/
	/*wp.customize( 'dp_header_logo_title_area_width', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-header .title-area' ).css( 'width', newval + 'px' );
		} );
	} );*/

	/**
	* Section: Header Logo
	* Field: Title Toggle
	*/
	wp.customize( 'dp_header_logo_title_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == '1') {
				$.stylesheet( '.site-header .site-title' ).css( 'display', 'none' );

			} else if ( newval == '2' ) {

				var blogname = wp.customize.value( 'blogname' )();
				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
				$( '.site-header .site-title a' ).text( blogname );

			} else if ( newval == '3' ) {

				var title_custom = wp.customize.value( 'dp_header_logo_title_custom' )();
				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
				$( '.site-header .site-title a' ).text( title_custom );
			}

		} );
	} );

	/**
	* Section: Header Logo
	* Field: Title Custom
	*/
	wp.customize( 'dp_header_logo_title_custom', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title a' ).text( newval );
		} );
	} );

	// Header Logo Title Font Family Toggle
	wp.customize( 'dp_header_logo_title_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-header .site-title', 'dp_header_logo_title_font_family', 'dp_header_logo_title_font_family_toggle' );
		} );
	} );

	// Header Logo Title Font Family
	wp.customize( 'dp_header_logo_title_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-header .site-title', 'dp_header_logo_title_font_family', 'dp_header_logo_title_font_family_toggle' );
		} );
	} );

	// Header Logo Title Font Size
	wp.customize( 'dp_header_logo_title_font_size', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title' ).css('font-size', newval + 'px');
		} );
	} );

	// Header Logo Title Font Weight
	wp.customize( 'dp_header_logo_title_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title' ).css('font-weight', newval );
		} );
	} );

	// Header Logo Title Font Color
	wp.customize( 'dp_header_logo_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title a' ).css( 'color', newval );
		} );
	} );

	// Header Logo Title Font Style
	wp.customize( 'dp_header_logo_title_style', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title a' ).removeClass().addClass( 'dp-font-style-' + newval );
		} );
	} );

	// Header Logo Title Margin Bottom
	wp.customize( 'dp_header_logo_title_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-title' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );





	// Header Logo Tagline Toggle
	wp.customize( 'dp_header_logo_tagline_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == '1') {
				$('.site-header .site-description').css('display', 'none');

			} else if ( newval == '2' ) {

				var blogdescription = wp.customize.value( 'blogdescription' )();
				$('.site-header .site-description').css('display', 'block');
				$('.site-header .site-description').text( blogdescription );

			} else if ( newval == '3' ) {

				var tagline_custom = wp.customize.value( 'dp_header_logo_tagline_custom' )();
				$('.site-header .site-description').css('display', 'block');
				$('.site-header .site-description').text( tagline_custom );
			}

		} );
	} );

	// Header Logo tagline Custom
	wp.customize( 'dp_header_logo_tagline_custom', function( value ) {
		value.bind( function( newval ) {
			$('.site-header .site-description').text( newval );
		} );
	} );

	// Header Logo tagline Font Family Toggle
	wp.customize( 'dp_header_logo_tagline_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-header .site-description', 'dp_header_logo_tagline_font_family', 'dp_header_logo_tagline_font_family_toggle' );
		} );
	} );

	// Header Logo tagline Font Family
	wp.customize( 'dp_header_logo_tagline_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-header .site-description', 'dp_header_logo_tagline_font_family', 'dp_header_logo_tagline_font_family_toggle' );
		} );
	} );

	// Header Logo tagline Font Size
	wp.customize( 'dp_header_logo_tagline_font_size', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-description' ).css('font-size', newval + 'px');
		} );
	} );

	// Header Logo tagline Font Weight
	wp.customize( 'dp_header_logo_tagline_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-description' ).css('font-weight', newval );
		} );
	} );

	// Header Logo tagline Font Color
	wp.customize( 'dp_header_logo_tagline_color', function( value ) {
		value.bind( function( newval ) {
			$( '.site-header .site-description' ).css( 'color', newval );
		} );
	} );

















// 	/**
// 	* Section: Header Logo
// 	* Field: Toggle Logo
// 	*/
// 	wp.customize( 'dp_header_logo_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 		if ( newval === true ) {
// 			$( '.site-header .dp-nav-primary-logo' ).remove();
// 			//$.stylesheet( '.nav-primary .title-area' ).css( 'display', 'table-cell' );
// 			var logo_url = wp.customize.value( 'dp_primary_menu_logo_upload' )();
// 			var logo_title = wp.customize.value( 'dp_primary_menu_logo_title_toggle' )();
// 			var logo_title_style = wp.customize.value( 'dp_primary_menu_logo_title_style' )();
// 			var logo_tagline = wp.customize.value( 'dp_primary_menu_logo_tagline_toggle' )();
// 			var home_url = location.protocol + '//' + location.host;

// 			// Get Blogname
// 			if ( logo_title == '1') {
// 				var blogname = '';
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'none' );
// 			} else if ( logo_title == '2' ) {
// 				var blogname = wp.customize.value( 'blogname' )();
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
// 			} else if ( logo_title == '3' ) {
// 				var blogname = wp.customize.value( 'dp_primary_menu_logo_title_custom' )();
// 				$.stylesheet( '.site-header .site-title' ).css( 'display', 'block' );
// 			}

// 			// Get Blog Description
// 			if ( logo_tagline == '1') {
// 				var blogdescription = '';
// 				$.stylesheet('.site-header .site-description').css('display', 'none');
// 			} else if ( logo_tagline == '2' ) {
// 				var blogdescription = wp.customize.value( 'blogdescription' )();
// 				$.stylesheet('.site-header .site-description').css('display', 'block');
// 			} else if ( logo_tagline == '3' ) {
// 				var blogdescription = wp.customize.value( 'dp_primary_menu_logo_tagline_custom' )();
// 				$.stylesheet('.site-header .site-description').css('display', 'block');
// 			}

// 			var output = '<div class="title-area">';

// 			output += '<div class="title-logo"><a href="' + home_url + '" rel="home"><div class="title-logo-img"></div></a></div>';

// 			if ( logo_url ) {
// 				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'inline-block' );
// 				$.stylesheet( '.site-header .title-logo-img' ).css( 'background-image', 'url(' + logo_url + ')' );
// 			} else {
// 				$.stylesheet( '.site-header .title-logo' ).css( 'display', 'none' );
// 			}

// 			output += '<div class="site-title-wrap">';
// 			output += '<div class="site-title"><a href="' + home_url + '" rel="home" class="dp-font-style-' + logo_title_style + '">' + blogname + '</a></div>';
// 			output += '<div class="site-description">' + blogdescription + '</div></div></div>';

// 			$( '.nav-primary .disruptpress-nav-menu' ).prepend( output );

// 		} else {
// 			$( '.nav-primary .dp-nav-primary-logo' ).remove();
// 		}

// 		} );
// 	} );

// 	// Header Logo Upload
// 	wp.customize( 'dp_header_logo_upload', function( value ) {
// 		value.bind( function( newval ) {

// 			if ( newval != '') {
// 				$( '.site-header .title-logo' ).remove();

// 				var logo_url = wp.customize.value( 'dp_header_logo_upload' )();
// 				var logo_height = wp.customize.value( 'dp_header_logo_height' )();

//   			$( '.site-header .title-area' ).prepend( '<div class="title-logo"><img src="' + logo_url + '"></div>' ).find( 'img' ).css('height', logo_height + 'px');

// 			} else {
// 				$( '.site-header .title-logo' ).remove();
// 			}

// 		} );
// 	} );

// 	// Header Logo Width
// 	wp.customize( 'dp_header_logo_width', function( value ) {
// 		value.bind( function( newval ) {
// 			$('.site-header .title-logo img').css('height', newval + 'px');
// 		} );
// 	} );
// 	wp.customize( 'dp_primary_menu_logo_width', function( value ) {
// 		value.bind( function( newval ) {
// 			$.stylesheet( '.nav-primary .title-logo' ).css( 'width', newval + 'px' );
// 		} );
// 	} );

// 	// Header Title Area
// 	wp.customize( 'dp_header_logo_title_area_width', function( value ) {
// 		value.bind( function( newval ) {
// 			$('.site-header .title-area').css('width', newval + 'px');
// 		} );
// 	} );

// 	// Header Title Toggle
// 	wp.customize( 'dp_header_logo_title_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 			if ( newval == '1') {
// 				$('.site-header .site-title').css('display', 'none');

// 			} else if ( newval == '2' ) {

// 				var blogname = wp.customize.value( 'blogname' )();
// 				$('.site-header .site-title').css('display', 'block');
// 				$('.site-header .site-title a').text( blogname );

// 			} else if ( newval == '3' ) {

// 				var title_custom = wp.customize.value( 'dp_header_logo_title_custom' )();
// 				$('.site-header .site-title').css('display', 'block');
// 				$('.site-header .site-title a').text( title_custom );
// 			}

// 		} );
// 	} );

// 	// Header Title Custom
// 	wp.customize( 'dp_header_logo_title_custom', function( value ) {
// 		value.bind( function( newval ) {
// 			$('.site-header .site-title a').text( newval );
// 		} );
// 	} );

// 	// Header Title Font Family Toggle
// 	wp.customize( 'dp_header_logo_title_font_family_toggle', function( value ) {
// 		value.bind( function( newval ) {
// 			dpApplyFont( '.site-header .site-title', 'dp_header_logo_title_font_family', 'dp_header_logo_title_font_family_toggle' );
// 		} );
// 	} );

// 	// Header Title Font Family
// 	wp.customize( 'dp_header_logo_title_font_family', function( value ) {
// 		value.bind( function( newval ) {
// 			dpApplyFont( '.site-header .site-title', 'dp_header_logo_title_font_family', 'dp_header_logo_title_font_family_toggle' );
// 		} );
// 	} );

// 	// Header Title Font Size
// 	wp.customize( 'dp_header_logo_title_font_size', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-title' ).css('font-size', newval + 'px');
// 		} );
// 	} );

// 	// Header Title Font Weight
// 	wp.customize( 'dp_header_logo_title_font_weight', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-title' ).css('font-weight', newval );
// 		} );
// 	} );

// 	// Header Title Font Color
// 	wp.customize( 'dp_header_logo_title_color', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-title a' ).css( 'color', newval );
// 		} );
// 	} );

// 	// Header Title Font Style
// 	wp.customize( 'dp_header_logo_title_style', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-title a' ).removeClass().addClass( 'dp-font-style-' + newval );
// 		} );
// 	} );

// 	// Header Title Margin Bottom
// 	wp.customize( 'dp_header_logo_title_margin_bottom', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-title' ).css( 'margin-bottom', newval + 'px' );
// 		} );
// 	} );





// 	// Header Tagline Toggle
// 	wp.customize( 'dp_header_logo_tagline_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 			if ( newval == '1') {
// 				$('.site-header .site-description').css('display', 'none');

// 			} else if ( newval == '2' ) {

// 				var blogdescription = wp.customize.value( 'blogdescription' )();
// 				$('.site-header .site-description').css('display', 'block');
// 				$('.site-header .site-description').text( blogdescription );

// 			} else if ( newval == '3' ) {

// 				var tagline_custom = wp.customize.value( 'dp_header_logo_tagline_custom' )();
// 				$('.site-header .site-description').css('display', 'block');
// 				$('.site-header .site-description').text( tagline_custom );
// 			}

// 		} );
// 	} );

// 	// Header tagline Custom
// 	wp.customize( 'dp_header_logo_tagline_custom', function( value ) {
// 		value.bind( function( newval ) {
// 			$('.site-header .site-description').text( newval );
// 		} );
// 	} );

// 	// Header tagline Font Family Toggle
// 	wp.customize( 'dp_header_logo_tagline_font_family_toggle', function( value ) {
// 		value.bind( function( newval ) {
// 			dpApplyFont( '.site-header .site-description', 'dp_header_logo_tagline_font_family', 'dp_header_logo_tagline_font_family_toggle' );
// 		} );
// 	} );

// 	// Header tagline Font Family
// 	wp.customize( 'dp_header_logo_tagline_font_family', function( value ) {
// 		value.bind( function( newval ) {
// 			dpApplyFont( '.site-header .site-description', 'dp_header_logo_tagline_font_family', 'dp_header_logo_tagline_font_family_toggle' );
// 		} );
// 	} );

// 	// Header tagline Font Size
// 	wp.customize( 'dp_header_logo_tagline_font_size', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-description' ).css('font-size', newval + 'px');
// 		} );
// 	} );

// 	// Header tagline Font Weight
// 	wp.customize( 'dp_header_logo_tagline_font_weight', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-description' ).css('font-weight', newval );
// 		} );
// 	} );

// 	// Header tagline Font Color
// 	wp.customize( 'dp_header_logo_tagline_color', function( value ) {
// 		value.bind( function( newval ) {
// 			$( '.site-header .site-description' ).css( 'color', newval );
// 		} );
// 	} );



















	// Header Boxed
	wp.customize( 'dp_header_boxed', function( value ) {
		value.bind( function( newval ) {
			if ( newval == true ) {
				var maxwidth = wp.customize.value( 'dp_site_container_width' )();
				$('.site-header').css('max-width', maxwidth + 'px');

			} else {
				$('.site-header').css('max-width', 'none');

			}

		} );
	} );

	// Header Height
	wp.customize( 'dp_header_height', function( value ) {
		value.bind( function( newval ) {
			//$('.site-header').css('min-height', newval + 'px');
			//$('.site-header .title-area').css('line-height', newval + 'px');
			$.stylesheet('.site-header').css('min-height', newval + 'px');
			$.stylesheet('.site-header .title-area').css('line-height', newval + 'px');
		} );
	} );

	// Header Padding
	wp.customize( 'dp_header_padding_top', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('padding-top', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_padding_right', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('padding-right', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('padding-bottom', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_padding_left', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('padding-left', newval + 'px');
		} );
	} );

	// Header Margin
	wp.customize( 'dp_header_margin_top', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('margin-top', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('margin-bottom', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_panel', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_pattern', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_upload', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_repeat', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_size', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_attachment', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_img_position', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-header', 'dp_header');
		} );
	} );

	wp.customize( 'dp_header_border_style', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_width_top', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_width_right', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_width_bottom', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_width_left', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_color', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-header',
				'dp_header_border_color',
				'dp_header_border_style',
				'dp_header_border_width_top',
				'dp_header_border_width_right',
				'dp_header_border_width_bottom',
				'dp_header_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_header_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_header_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Primary Menu Logo
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	/**
	* Section: Primary Menu Logo
	* Field: Toggle Logo
	*/
	wp.customize( 'dp_primary_menu_logo_toggle', function( value ) {
		value.bind( function( newval ) {

		if ( newval === true ) {
			$( '.nav-primary .dp-nav-primary-logo' ).remove();
			//$.stylesheet( '.nav-primary .title-area' ).css( 'display', 'table-cell' );
			var logo_url = wp.customize.value( 'dp_primary_menu_logo_upload' )();
			var logo_title = wp.customize.value( 'dp_primary_menu_logo_title_toggle' )();
			var logo_title_style = wp.customize.value( 'dp_primary_menu_logo_title_style' )();
			var logo_tagline = wp.customize.value( 'dp_primary_menu_logo_tagline_toggle' )();
			var home_url = location.protocol + '//' + location.host;

			// Get Blogname
			if ( logo_title == '1') {
				var blogname = '';
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'none' );
			} else if ( logo_title == '2' ) {
				var blogname = wp.customize.value( 'blogname' )();
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'block' );
			} else if ( logo_title == '3' ) {
				var blogname = wp.customize.value( 'dp_primary_menu_logo_title_custom' )();
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'block' );
			}

			// Get Blog Description
			if ( logo_tagline == '1') {
				var blogdescription = '';
				$.stylesheet('.nav-primary .site-description').css('display', 'none');
			} else if ( logo_tagline == '2' ) {
				var blogdescription = wp.customize.value( 'blogdescription' )();
				$.stylesheet('.nav-primary .site-description').css('display', 'block');
			} else if ( logo_tagline == '3' ) {
				var blogdescription = wp.customize.value( 'dp_primary_menu_logo_tagline_custom' )();
				$.stylesheet('.nav-primary .site-description').css('display', 'block');
			}

			var output = '<li class="dp-nav-primary-logo"><div class="title-area">';

			output += '<div class="title-logo"><a href="' + home_url + '" rel="home"><div class="title-logo-img"></div></a></div>';

			if ( logo_url ) {
				$.stylesheet( '.nav-primary .title-logo' ).css( 'display', 'inline-block' );
				$.stylesheet( '.nav-primary .title-logo-img' ).css( 'background-image', 'url(' + logo_url + ')' );
			} else {
				$.stylesheet( '.nav-primary .title-logo' ).css( 'display', 'none' );
			}

			output += '<div class="site-title-wrap">';
			output += '<div class="site-title"><a href="' + home_url + '" rel="home" class="dp-font-style-' + logo_title_style + '">' + blogname + '</a></div>';
			output += '<div class="site-description">' + blogdescription + '</div></div></div></li>';

			$( '.nav-primary .disruptpress-nav-menu' ).prepend( output );

		} else {
			$( '.nav-primary .dp-nav-primary-logo' ).remove();
		}

		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Logo Upload
	*/
	wp.customize( 'dp_primary_menu_logo_upload', function( value ) {
		value.bind( function( newval ) {

			if ( newval != '' ) {

				$.stylesheet( '.nav-primary .title-logo' ).css( 'display', 'inline-block' );
				$.stylesheet( '.nav-primary .title-logo-img' ).css( 'background-image', 'url(' + newval + ')' );
			} else {
				$.stylesheet( '.nav-primary .title-logo' ).css( 'display', 'none' );
			}

		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Logo Width
	*/
	wp.customize( 'dp_primary_menu_logo_width', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .title-logo' ).css( 'width', newval + 'px' );
		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Logo Margin Right
	*/
	wp.customize( 'dp_primary_menu_logo_margin_right', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .title-logo' ).css( 'margin-right', newval + 'px' );
		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Logo Padding Left
	*/
	wp.customize( 'dp_primary_menu_logo_padding_left', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-left', padding + 'px' );
			} else {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-left', '0px' );
			}
		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Logo Padding Right
	*/
	wp.customize( 'dp_primary_menu_logo_padding_right', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-right', padding + 'px' );
			} else {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-right', '0px' );
			}
		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Title Area Width
	*/
	/*wp.customize( 'dp_primary_menu_logo_title_area_width', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .title-area' ).css( 'width', newval + 'px' );
		} );
	} );*/

	/**
	* Section: Primary Menu Logo
	* Field: Title Toggle
	*/
	wp.customize( 'dp_primary_menu_logo_title_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == '1') {
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'none' );

			} else if ( newval == '2' ) {

				var blogname = wp.customize.value( 'blogname' )();
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'block' );
				$( '.nav-primary .site-title a' ).text( blogname );

			} else if ( newval == '3' ) {

				var title_custom = wp.customize.value( 'dp_primary_menu_logo_title_custom' )();
				$.stylesheet( '.nav-primary .site-title' ).css( 'display', 'block' );
				$( '.nav-primary .site-title a' ).text( title_custom );
			}

		} );
	} );

	/**
	* Section: Primary Menu Logo
	* Field: Title Custom
	*/
	wp.customize( 'dp_primary_menu_logo_title_custom', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title a' ).text( newval );
		} );
	} );

	// Header Title Font Family Toggle
	wp.customize( 'dp_primary_menu_logo_title_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary .site-title', 'dp_primary_menu_logo_title_font_family', 'dp_primary_menu_logo_title_font_family_toggle' );
		} );
	} );

	// Header Title Font Family
	wp.customize( 'dp_primary_menu_logo_title_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary .site-title', 'dp_primary_menu_logo_title_font_family', 'dp_primary_menu_logo_title_font_family_toggle' );
		} );
	} );

	// Header Title Font Size
	wp.customize( 'dp_primary_menu_logo_title_font_size', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title' ).css('font-size', newval + 'px');
		} );
	} );

	// Header Title Font Weight
	wp.customize( 'dp_primary_menu_logo_title_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title' ).css('font-weight', newval );
		} );
	} );

	// Header Title Font Color
	wp.customize( 'dp_primary_menu_logo_title_color', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title a' ).css( 'color', newval );
		} );
	} );

	// Header Title Font Style
	wp.customize( 'dp_primary_menu_logo_title_style', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title a' ).removeClass().addClass( 'dp-font-style-' + newval );
		} );
	} );

	// Header Title Margin Bottom
	wp.customize( 'dp_primary_menu_logo_title_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-title' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );





	// Header Tagline Toggle
	wp.customize( 'dp_primary_menu_logo_tagline_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == '1') {
				$('.nav-primary .site-description').css('display', 'none');

			} else if ( newval == '2' ) {

				var blogdescription = wp.customize.value( 'blogdescription' )();
				$('.nav-primary .site-description').css('display', 'block');
				$('.nav-primary .site-description').text( blogdescription );

			} else if ( newval == '3' ) {

				var tagline_custom = wp.customize.value( 'dp_primary_menu_logo_tagline_custom' )();
				$('.nav-primary .site-description').css('display', 'block');
				$('.nav-primary .site-description').text( tagline_custom );
			}

		} );
	} );

	// Header tagline Custom
	wp.customize( 'dp_primary_menu_logo_tagline_custom', function( value ) {
		value.bind( function( newval ) {
			$('.nav-primary .site-description').text( newval );
		} );
	} );

	// Header tagline Font Family Toggle
	wp.customize( 'dp_primary_menu_logo_tagline_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary .site-description', 'dp_primary_menu_logo_tagline_font_family', 'dp_primary_menu_logo_tagline_font_family_toggle' );
		} );
	} );

	// Header tagline Font Family
	wp.customize( 'dp_primary_menu_logo_tagline_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary .site-description', 'dp_primary_menu_logo_tagline_font_family', 'dp_primary_menu_logo_tagline_font_family_toggle' );
		} );
	} );

	// Header tagline Font Size
	wp.customize( 'dp_primary_menu_logo_tagline_font_size', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-description' ).css('font-size', newval + 'px');
		} );
	} );

	// Header tagline Font Weight
	wp.customize( 'dp_primary_menu_logo_tagline_font_weight', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-description' ).css('font-weight', newval );
		} );
	} );

	// Header tagline Font Color
	wp.customize( 'dp_primary_menu_logo_tagline_color', function( value ) {
		value.bind( function( newval ) {
			$( '.nav-primary .site-description' ).css( 'color', newval );
		} );
	} );



	/**
	* Section: Primary Menu
	* Field: Primary Menu Boxed
	*/
	wp.customize( 'dp_primary_menu_boxed', function( value ) {
		value.bind( function( newval ) {

			var site_layout = wp.customize.value( 'dp_site_layout' )();

			if ( newval == true && site_layout == '3' ) {
				var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )() * 2;

				$.stylesheet( '.nav-primary' ).css( 'max-width', 'calc(100% - ' + padding + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else if ( newval == true ) {
				var width = wp.customize.value( 'dp_site_container_width' )();
				var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
				var maxwidth = width - (padding * 2);

				$.stylesheet( '.nav-primary' ).css( 'max-width', maxwidth + 'px' );
				$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );

			} else {
				var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
				var alignment_padding = wp.customize.value( 'dp_primary_menu_item_alignment_padding' )();

				$.stylesheet( '.nav-primary' ).css( 'max-width', 'none' );

				if ( alignment_padding == true ) {
					var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px', } );
				} else {
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );
				}

			}

		} );
	} );
		/**
	* Section: Primary Menu
	* Field: Primary Menu Width
	*/
// 	wp.customize( 'dp_primary_menu_width', function( value ) {
// 		value.bind( function( newval ) {

// 			if ( newval == '1' ) {
// 				var width = wp.customize.value( 'dp_site_container_width' )();
// 				var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
// 				var maxwidth = width - (padding * 2);
// 				$.stylesheet( '.nav-primary' ).css( 'max-width', maxwidth + 'px' );

// 			} else if ( newval == '2' ) {
// 				var width = wp.customize.value( 'dp_site_container_width' )();
// 				//var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
// 				//var maxwidth = width + (padding * 2);
// 				$.stylesheet( '.nav-primary' ).css( 'max-width', width + 'px' );

// 			} else {
// 				$.stylesheet( '.nav-primary' ).css( 'max-width', '100%' );
// 			}

// 		} );
// 	} );

	/**
	* Section: Primary Menu
	* Field: Submenu Indicator
	*/
	wp.customize( 'dp_primary_menu_submenu_indicator', function( value ) {
		value.bind( function( newval ) {
			var font_size = wp.customize.value( 'dp_primary_menu_font_size' )();

			// Add pixels to font size of submenu icon, as original icon size is too small.
			var font_size_submenu = Math.round( ( parseInt(font_size) * 0.5 ) + 12 );

			if ( newval === false ) {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item-has-children > a:after' ).css( 'display', 'none' );
				$.stylesheet( '.nav-primary .sub-menu > .menu-item-has-children > a:after' ).css( 'display', 'none' );
			} else {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item-has-children > a:after' ).css( {
					'font-size': font_size_submenu + 'px',
					'line-height': font_size + 'px',
					'display': 'inline-block'
				} );
				$.stylesheet( '.nav-primary .sub-menu > .menu-item-has-children > a:after' ).css( 'display', 'inline-block' );
			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Home Button
	*/
	wp.customize( 'dp_primary_menu_home_icon', function( value ) {
		value.bind( function( newval ) {

			if ( newval === false ) {
				$( '.dp-nav-primary-home-icon' ).remove();
			} else {

				var home_url = location.protocol + '//' + location.host;
				var font_size = wp.customize.value( 'dp_primary_menu_font_size' )();
				// Add 12 pixels to font size of home icon, as original icon size is too small.
				var font_size_home_icon = parseInt(font_size) + 8;

				$( '.dp-nav-primary-home-icon' ).remove();

				// If menu logo exists, prepend after menu logo.
				if ( $( '.nav-primary .dp-nav-primary-logo' ).length ) {
					var selector = ':nth-child(2)';
				} else {
					var selector = ':first-child';
				}

				$( '.nav-primary .disruptpress-nav-menu > li' + selector ).before( '<li class="dp-nav-primary-home-icon menu-item"><a href="' + home_url + '" rel="home"><span class="dashicons dashicons-admin-home"></span></a></li>' );

				$.stylesheet( '.dp-nav-primary-home-icon .dashicons' ).css( {
					'font-size' : font_size_home_icon + 'px',
					'width' : font_size_home_icon + 'px',
					'height' : font_size_home_icon + 'px'
				} );

			}

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);


		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Underline Text
	*/
	wp.customize( 'dp_primary_menu_link_text_decoration', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li > a' ).css( 'text-decoration', 'underline' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a:hover' ).css( 'text-decoration', 'underline' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a:focus' ).css( 'text-decoration', 'underline' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) > a' ).css( 'text-decoration', 'underline' );
				$.stylesheet( '.disruptpress-nav-menu .sub-menu a ' ).css( 'text-decoration', 'underline' );
			} else {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li > a' ).css( 'text-decoration', 'none' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a:hover' ).css( 'text-decoration', 'none' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a:focus' ).css( 'text-decoration', 'none' );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) > a' ).css( 'text-decoration', 'none' );
				$.stylesheet( '.disruptpress-nav-menu .sub-menu a ' ).css( 'text-decoration', 'none' );
			}
			} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Height
	*/
	wp.customize( 'dp_primary_menu_height', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary' ).css( 'height', newval + 'px');
			$.stylesheet( '.nav-primary .disruptpress-nav-menu' ).css( 'height', newval + 'px');
			$.stylesheet( '.nav-primary .title-area' ).css( 'height', newval + 'px' );
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > li > a' ).css( 'height', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary-wrap .search-form' ).css( 'height', newval + 'px' );

			var home_icon_smart_padding = wp.customize.value( 'dp_primary_menu_home_icon_smart_padding' )();

			if ( home_icon_smart_padding == true ) {
				var padding = newval / 2;
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px' } );
			} else {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px' } );
			}

			//var height = wp.customize.value( 'dp_primary_menu_height' )();
			//var padding_home_icon = height / 2;
			//$.stylesheet( '.nav-primary li.dp-nav-primary-home-icon a' ).css( { 'padding-left': padding_home_icon + 'px', 'padding-right': padding_home_icon + 'px' } );

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Item Padding Left & Right
	*/
	wp.customize( 'dp_primary_menu_item_padding_left_right', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a' ).css( { 'padding-left': newval + 'px', 'padding-right': newval + 'px' } );

			var logo_padding_left = wp.customize.value( 'dp_primary_menu_logo_padding_left' )();
			if ( logo_padding_left === true ) {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-left', newval + 'px' );
			} else {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-left', '0px' );
			}

			var logo_padding_right = wp.customize.value( 'dp_primary_menu_logo_padding_right' )();
			if ( logo_padding_right === true ) {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-right', newval + 'px' );
			} else {
				$.stylesheet( '.nav-primary .dp-nav-primary-logo' ).css( 'padding-right', '0px' );
			}

			var home_icon_smart_padding = wp.customize.value( 'dp_primary_menu_home_icon_smart_padding' )();
			if ( home_icon_smart_padding == true ) {
				var padding = wp.customize.value( 'dp_primary_menu_height' )() / 2;
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px' } );
			} else {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': newval + 'px', 'padding-right': newval + 'px' } );
			}
			/*dpAdjustMenuPadding (
				'.nav-primary .wrap',
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_item_alignment_padding',
				'dp_site_container_wrap_padding_left_right',
				'dp_primary_menu_item_padding_left_right'
			);*/

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Font Size
	*/
	wp.customize( 'dp_primary_menu_font_size', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.nav-primary .disruptpress-nav-menu > li' ).css( { 'font-size': newval + 'px', 'line-height': newval + 'px' } );


			// Adjust font size of home icon
			var font_size_home_icon = parseInt(newval) + 8;
			$.stylesheet( '.dp-nav-primary-home-icon .dashicons' ).css( {
					'font-size' : font_size_home_icon + 'px',
					'width' : font_size_home_icon + 'px',
					'height' : font_size_home_icon + 'px'
				} );

			// Adjust font size of submenu icon
			var font_size_submenu = Math.round( ( parseInt(newval) * 0.5 ) + 12 );
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item-has-children > a:after' ).css( {
				'font-size': font_size_submenu + 'px',
				'line-height': newval + 'px'
			} );

			// Adjust font size of search form
			var height = wp.customize.value( 'dp_primary_menu_height' )();

			$.stylesheet( '.dp-search-nav-primary-wrap .search-form' ).css( 'height', height + 'px' );


			dpAdjustSearchFont( '.dp-search-nav-primary', 'dp_primary_menu_search_font_size_toggle', 'dp_primary_menu_font_size', 'dp_primary_menu_search_font_size' );

			dpAdjustSearchFieldHeight( '.dp-search-nav-primary',
				'dp_primary_menu_search_field_height_toggle',
				'dp_primary_menu_search_field_height',
				'dp_primary_menu_font_size'
			 );

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Font Weight
	*/
	wp.customize( 'dp_primary_menu_font_weight', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > li' ).css( 'font-weight', newval );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Regular Link Color
	*/
	wp.customize( 'dp_primary_menu_link_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > li:not(.current-menu-item) > a' ).css( 'color', newval );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Active/Hover Link Color
	*/
	wp.customize( 'dp_primary_menu_link_color_active', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item > a:hover,\
								.nav-primary .disruptpress-nav-menu > .menu-item > a:focus,\
								.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) > a' ).css( 'color', newval );
		} );

	} );

	/**
	* Section: Primary Menu
	* Field: Use Global Font Family
	*/
	wp.customize( 'dp_primary_menu_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary', 'dp_primary_menu_font_family', 'dp_primary_menu_font_family_toggle' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Font Family
	*/
	wp.customize( 'dp_primary_menu_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.nav-primary', 'dp_primary_menu_font_family', 'dp_primary_menu_font_family_toggle' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Style
	*/
	wp.customize( 'dp_primary_menu_bg_color_style', function( value ) {
		value.bind( function( newval ) {
				apply_bg_no_img( '.nav-primary', 'dp_primary_menu_bg' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Primary Color
	*/
	wp.customize( 'dp_primary_menu_bg_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Secondary Color
	*/
	wp.customize( 'dp_primary_menu_bg_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Shade Strenght
	*/
	wp.customize( 'dp_primary_menu_bg_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Gradient Style
	*/
	wp.customize( 'dp_primary_menu_bg_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Advanced Toggle
	*/
	wp.customize( 'dp_primary_menu_bg_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Gradient Position Parameter 1
	*/
	wp.customize( 'dp_primary_menu_bg_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Gradient Position Parameter 2
	*/
	wp.customize( 'dp_primary_menu_bg_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Reverse Colors
	*/
	wp.customize( 'dp_primary_menu_bg_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img('.nav-primary ', 'dp_primary_menu_bg');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Style Active Item
	*/
	wp.customize( 'dp_primary_menu_bg_active_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Primary Color
	*/
	wp.customize( 'dp_primary_menu_bg_active_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item -
	*/
	wp.customize( 'dp_primary_menu_bg_active_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Secondary Color
	*/
	wp.customize( 'dp_primary_menu_bg_active_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Gradient Style
	*/
	wp.customize( 'dp_primary_menu_bg_active_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Advanced Toggle
	*/
	wp.customize( 'dp_primary_menu_bg_active_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Gradient Position Parameter 1
	*/
	wp.customize( 'dp_primary_menu_bg_active_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Gradient Position Parameter 2
	*/
	wp.customize( 'dp_primary_menu_bg_active_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Reverse Colors
	*/
	wp.customize( 'dp_primary_menu_bg_active_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
												.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)', 'dp_primary_menu_bg_active' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Box Shadow
	*/
	wp.customize( 'dp_primary_menu_bg_active_boxshadow', function( value ) {
		value.bind( function( newval ) {

			if ( newval != '0') {
				var val = parseInt( newval );
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
													.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
													.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)' ).css( 'box-shadow', dpHoverShadows[val] );
			} else {
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > .menu-item:hover,\
													.nav-primary .disruptpress-nav-menu > .menu-item:focus,\
													.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home)' ).css( 'box-shadow', 'inherit' );
			}
// 			apply_bg_no_img( '.nav-primary .disruptpress-nav-menu > .menu-item > a:hover,\
// 												.nav-primary .disruptpress-nav-menu > .menu-item > a:focus,\
// 												.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) > a', 'dp_primary_menu_bg_active' );

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Background Color Active Item - Workaround function for hover. Needs to be replaced.
	*/
/*	$( '.site-container' ).on('mouseenter','.nav-primary .disruptpress-nav-menu > .menu-item > a',function() {

		var color_active = wp.customize.value( 'dp_primary_menu_link_color_active' )();
		var boxshadow = parseInt( wp.customize.value( 'dp_primary_menu_bg_active_boxshadow' )() );

		$(this).css('color', color_active);

		apply_bg_no_img(this, 'dp_primary_menu_bg_active');

		$(this).css( 'box-shadow', dpHoverShadows[boxshadow] );

	});

	$( '.site-container' ).on('mouseleave','.nav-primary .disruptpress-nav-menu > .menu-item > a',function() {
		var color = wp.customize.value( 'dp_primary_menu_link_color' )();
		var boxshadow = parseInt( wp.customize.value( 'dp_primary_menu_bg_active_boxshadow' )() );

		$(this).css('color', color);
		$(this).css('background', 'none');
		$(this).css('box-shadow', 'none');

		var color_active = wp.customize.value( 'dp_primary_menu_link_color_active' )();
		$('.nav-primary .disruptpress-nav-menu > .current-menu-item > a').css('color', color_active);
		apply_bg_no_img('.nav-primary .disruptpress-nav-menu > .current-menu-item > a', 'dp_primary_menu_bg_active');

		$('.nav-primary .disruptpress-nav-menu > .current-menu-item > a').css( 'box-shadow', dpHoverShadows[boxshadow] );
	});
	*/
	/**
	* Section: Primary Menu
	* Field: Item Dividers Options - None / Single Line / Dual Line
	*/
	wp.customize( 'dp_primary_menu_item_dividers', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers - Opening Divider on First Item
	*/
	wp.customize( 'dp_primary_menu_item_dividers_firstchild', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers - Closing Divider on Last Item
	*/
	wp.customize( 'dp_primary_menu_item_dividers_lastchild', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers - Border Top
	*/
	wp.customize( 'dp_primary_menu_item_dividers_top', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers - Border Bottom
	*/
	wp.customize( 'dp_primary_menu_item_dividers_bottom', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers - Adjust Divider Color Manually
	*/
	wp.customize( 'dp_primary_menu_item_dividers_color_toggle', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Item Dividers -Manual Color
	*/
	wp.customize( 'dp_primary_menu_item_dividers_color', function( value ) {
		value.bind( function( newval ) {
			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Item Alignment
	*/
	wp.customize( 'dp_primary_menu_item_alignment', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary .disruptpress-nav-menu' ).css( 'text-align', newval );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Item Alignment Padding (first & last menu items)
	*/
	wp.customize( 'dp_primary_menu_item_alignment_padding', function( value ) {
		value.bind( function( newval ) {

			var boxed = wp.customize.value( 'dp_primary_menu_boxed' )();

			// Only procceed if Primary Menu Boxed Width is false. No need to adjust first item alignment in boxed mode.
			if ( boxed == false ) {

				if ( newval == true ) {
					var padding = wp.customize.value( 'dp_site_container_wrap_padding_left_right' )();
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px', } );
				} else {
					$.stylesheet( '.nav-primary .wrap' ).css( { 'padding-left': '0px', 'padding-right': '0px', } );
				}

			}

			//$.stylesheet( '.nav-primary' ).css( 'max-width', 'none' );


			/*dpAdjustMenuPadding (
				'.nav-primary .wrap',
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_item_alignment_padding',
				'dp_site_container_wrap_padding_left_right',
				'dp_primary_menu_item_padding_left_right'
			);*/

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Home Icon Smart Padding
	*/
	wp.customize( 'dp_primary_menu_home_icon_smart_padding', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				var padding = wp.customize.value( 'dp_primary_menu_height' )() / 2;
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px' } );
			} else {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a' ).css( { 'padding-left': padding + 'px', 'padding-right': padding + 'px' } );
			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Margin Top
	*/
	wp.customize( 'dp_primary_menu_margin_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary' ).css( 'margin-top', newval + 'px' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Margin Botton
	*/
	wp.customize( 'dp_primary_menu_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.nav-primary' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Radius Top Left
	*/
	wp.customize( 'dp_primary_menu_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.nav-primary').css('border-top-left-radius', newval + 'px');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Radius Top Right
	*/
	wp.customize( 'dp_primary_menu_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.nav-primary').css('border-top-right-radius', newval + 'px');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Radius Bottom Right
	*/
	wp.customize( 'dp_primary_menu_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.nav-primary').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Radius Bottom Left
	*/
	wp.customize( 'dp_primary_menu_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.nav-primary').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Style
	*/
	wp.customize( 'dp_primary_menu_border_style', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Width Top
	*/
	wp.customize( 'dp_primary_menu_border_width_top', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Width Right
	*/
	wp.customize( 'dp_primary_menu_border_width_right', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Width Bottom
	*/
	wp.customize( 'dp_primary_menu_border_width_bottom', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Width Left
	*/
	wp.customize( 'dp_primary_menu_border_width_left', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Border Color
	*/
	wp.customize( 'dp_primary_menu_border_color', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.nav-primary',
				'dp_primary_menu_border_color',
				'dp_primary_menu_border_style',
				'dp_primary_menu_border_width_top',
				'dp_primary_menu_border_width_right',
				'dp_primary_menu_border_width_bottom',
				'dp_primary_menu_border_width_left'
			)
		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow Style Options
	*/
	wp.customize( 'dp_primary_menu_shadow_bottom_style', function( value ) {
		value.bind( function( newval ) {

			/* Remove shadow from primary menu */
			if ( newval == 'none' ) {
				$.stylesheet( '.nav-primary' ).css( 'box-shadow', 'none' );

			/* Apply shadow presets to primary menu */
			} else if ( newval == 'presets' ) {
				var preset = parseInt( wp.customize.value( 'dp_primary_menu_shadow_presets' )() ) - 1;
				$.stylesheet( '.nav-primary' ).css( 'box-shadow', dpShadows[preset] );

			/* Apply custom shadow to primary menu */
			} else if ( newval == 'custom' ) {
				dpBoxShadow ( '.nav-primary',
					'0',
					'dp_primary_menu_shadow_bottom_vertical',
					'dp_primary_menu_shadow_bottom_blur_radius',
					'dp_primary_menu_shadow_bottom_spread_radius',
					'dp_primary_menu_shadow_bottom_opacity',
					'0'
				);
			}

// 			/* If sticky menu option "Hide Shadow" is true, remove shadow for primary sticky menu */
// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet( '.nav-primary-sticky' ).css( 'box-shadow', 'none' );
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow - Presets
	*/
	wp.customize( 'dp_primary_menu_shadow_presets', function( value ) {
		value.bind( function( newval ) {

			/* Get preset shadow settings from "dpShadow" array and apply to primary menu */
			$.stylesheet( '.nav-primary' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );

// 			/* If sticky menu option "Hide Shadow" is true, remove shadow for primary sticky menu */
// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet( '.nav-primary-sticky' ).css( 'box-shadow', 'none' );
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow - Blur Radius
	*/
	wp.customize( 'dp_primary_menu_shadow_bottom_blur_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.nav-primary',
					'0',
					'dp_primary_menu_shadow_bottom_vertical',
					'dp_primary_menu_shadow_bottom_blur_radius',
					'dp_primary_menu_shadow_bottom_spread_radius',
					'dp_primary_menu_shadow_bottom_opacity',
					'0'
				);

// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet('.nav-primary-sticky').css('box-shadow', 'none');
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow - Spread Radius
	*/
	wp.customize( 'dp_primary_menu_shadow_bottom_spread_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.nav-primary',
					'0',
					'dp_primary_menu_shadow_bottom_vertical',
					'dp_primary_menu_shadow_bottom_blur_radius',
					'dp_primary_menu_shadow_bottom_spread_radius',
					'dp_primary_menu_shadow_bottom_opacity',
					'0'
				);

// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet('.nav-primary-sticky').css('box-shadow', 'none');
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow - Opacity
	*/
	wp.customize( 'dp_primary_menu_shadow_bottom_opacity', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.nav-primary',
					'0',
					'dp_primary_menu_shadow_bottom_vertical',
					'dp_primary_menu_shadow_bottom_blur_radius',
					'dp_primary_menu_shadow_bottom_spread_radius',
					'dp_primary_menu_shadow_bottom_opacity',
					'0'
				);

// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet('.nav-primary-sticky').css('box-shadow', 'none');
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Menu Shadow - Vertical
	*/
	wp.customize( 'dp_primary_menu_shadow_bottom_vertical', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ('.nav-primary',
					'0',
					'dp_primary_menu_shadow_bottom_vertical',
					'dp_primary_menu_shadow_bottom_blur_radius',
					'dp_primary_menu_shadow_bottom_spread_radius',
					'dp_primary_menu_shadow_bottom_opacity',
					'0'
				);

// 			var sticky_shadow_bottom = wp.customize.value( 'dp_primary_menu_sticky_shadow_bottom' )();
// 			if ( sticky_shadow_bottom == true ) {
// 				$.stylesheet('.nav-primary-sticky').css('box-shadow', 'none');
// 			}

		} );
	} );

	/**
	* Section: Primary Menu
	* Field: Sticky Menu - Transition
	*/
// 	wp.customize( 'dp_primary_menu_sticky', function( value ) {
// 		value.bind( function( newval ) {

// 			// If "Use Different Menu Height" is true
// 			if ( newval === true ) {
// 				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( 'height', height + 'px');


// 			//If "Use Different Menu Height" is false
// 			} else {
// 				var height = wp.customize.value( 'dp_primary_menu_height' )();
// 				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( 'height', height + 'px');
// 				//$.stylesheet( '.nav-primary.nav-primary-sticky .title-area' ).css( 'line-height', height + 'px' );
// 				$.stylesheet( '.nav-primary.nav-primary-sticky .disruptpress-nav-menu > li > a' ).css( 'height', height + 'px' );
// 				$.stylesheet( '.nav-primary-sticky .dp-search-nav-primary .search-form' ).css( 'height', height + 'px' );
// 			}
// 		} );
// 	} );

	/**
	* Section: Primary Menu
	* Field: Sticky Menu - Height Toggle
	*/
// 	wp.customize( 'dp_primary_menu_sticky_height_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 			// If "Use Different Menu Height" is true
// 			if ( newval === true ) {
// 				var height = wp.customize.value( 'dp_primary_menu_sticky_height' )();
// 				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( 'height', height + 'px');
// 				//$.stylesheet( '.nav-primary.nav-primary-sticky .title-area' ).css( 'line-height', height + 'px' );
// 				$.stylesheet( '.nav-primary.nav-primary-sticky .disruptpress-nav-menu > li > a' ).css( 'height', height + 'px' );
// 				$.stylesheet( '.nav-primary-sticky .dp-search-nav-primary .search-form' ).css( 'height', height + 'px' );

// 			//If "Use Different Menu Height" is false
// 			} else {
// 				var height = wp.customize.value( 'dp_primary_menu_height' )();
// 				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( 'height', height + 'px');
// 				//$.stylesheet( '.nav-primary.nav-primary-sticky .title-area' ).css( 'line-height', height + 'px' );
// 				$.stylesheet( '.nav-primary.nav-primary-sticky .disruptpress-nav-menu > li > a' ).css( 'height', height + 'px' );
// 				$.stylesheet( '.nav-primary-sticky .dp-search-nav-primary .search-form' ).css( 'height', height + 'px' );
// 			}
// 		} );
// 	} );

	/**
	* Section: Primary Menu
	* Field: Sticky Menu - Height
	*/
// 	wp.customize( 'dp_primary_menu_sticky_height', function( value ) {
// 		value.bind( function( newval ) {
// 			$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( 'height', newval + 'px');
// 			$.stylesheet( '.nav-primary.nav-primary-sticky .title-area' ).css( 'line-height', newval + 'px' );
// 			$.stylesheet( '.nav-primary.nav-primary-sticky .disruptpress-nav-menu > li > a' ).css( 'height', newval + 'px' );
// 			$.stylesheet( '.nav-primary-sticky .dp-search-nav-primary .search-form' ).css( 'height', newval + 'px' );
// 		} );
// 	} );




// 	wp.customize( 'dp_primary_menu_sticky_menu_width', function( value ) {
// 		value.bind( function( newval ) {

// 			if( newval  == true ) {
// 				var maxwidth = '100%';
// 			} else {
// 				var maxwidth = wp.customize.value( 'dp_site_container_width' )() + 'px';
// 			}

// 			$.stylesheet( '.nav-primary-sticky' ).css( 'max-width', maxwidth );

// 		} );
// 	} );



// 	wp.customize( 'dp_primary_menu_sticky_border', function( value ) {
// 		value.bind( function( newval ) {

// 			if( newval  == true ) {
// 				$.stylesheet( '.nav-primary-sticky' ).css( { 'border-top': '0', 'border-right': '0', 'border-bottom': '0', 'border-left': '0',  } );
// 			} else {
// 				dpApplyBorder('.nav-primary-sticky',
// 					'dp_primary_menu_border_color',
// 					'dp_primary_menu_border_style',
// 					'dp_primary_menu_border_width_top',
// 					'dp_primary_menu_border_width_right',
// 					'dp_primary_menu_border_width_bottom',
// 					'dp_primary_menu_border_width_left'
// 				);
// 			}

// 		} );
// 	} );

// 	/*
// 	 * Primary Menu: Sticky Menu - Use Different Menu Height - Toggle On/Off
// 	 */
// 	wp.customize( 'dp_primary_menu_sticky_item_padding_top_bottom_toggle', function( value ) {
// 		value.bind( function( newval ) {

// 			if( newval  == true ) {
// 				var padding = wp.customize.value( 'dp_primary_menu_sticky_item_padding_top_bottom' )();
// 			} else {
// 				var padding = wp.customize.value( 'dp_primary_menu_item_padding_top_bottom' )();
// 			}

// 			$.stylesheet( '.nav-primary-sticky .disruptpress-nav-menu > .menu-item > a' ).css( 'padding-top', padding + 'px' );
// 			$.stylesheet( '.nav-primary-sticky .disruptpress-nav-menu > .menu-item > a' ).css( 'padding-bottom', padding + 'px' );

// 		} );
// 	} );

	/*
	 * Primary Menu: Sticky Menu - Use Different Menu Height - Apply new value
	 */
// 	wp.customize( 'dp_primary_menu_sticky_item_padding_top_bottom', function( value ) {
// 		value.bind( function( newval ) {

// 			$.stylesheet( '.nav-primary-sticky .disruptpress-nav-menu > .menu-item > a' ).css( 'padding-top', newval + 'px' );
// 			$.stylesheet( '.nav-primary-sticky .disruptpress-nav-menu > .menu-item > a' ).css( 'padding-bottom', newval + 'px' );

// 		} );
// 	} );



	/*
	 * Primary Menu Sticky Shadow
	 */
// 	wp.customize( 'dp_primary_menu_sticky_shadow_bottom', function( value ) {
// 		value.bind( function( newval ) {

// 			/* If "Hide Shadow" is true, remove shadow from sticky menu */
// 			if( newval  == true ) {
// 				$.stylesheet( '.nav-primary-sticky' ).css( 'box-shadow', 'none' );

// 			/* If "Hide Shadow" is false, apply primary menu shadow settings to stick menu */
// 			} else {

// 				/* Check which primary menu shadow style is selected */
// 				var style = wp.customize.value( 'dp_primary_menu_shadow_bottom_style' )();

// 				/* Remove Shadow from primary sticky menu*/
// 				if ( style == 'none') {
// 					$.stylesheet( '.nav-primary-sticky' ).css( 'box-shadow', 'none' );

// 				/* Apply shadow presets to primary sticky menu */
// 				} else if ( style == 'presets') {
// 					var preset = parseInt( wp.customize.value( 'dp_primary_menu_shadow_presets' )() ) - 1;

// 					$.stylesheet( '.nav-primary-sticky' ).css( 'box-shadow', dpShadows[preset] );

// 				/* Apply custom shadow to primary sticky menu */
// 				} else if ( style == 'custom') {
// 					dpBoxShadow ('.nav-primary-sticky',
// 						'0',
// 						'dp_primary_menu_shadow_bottom_vertical',
// 						'dp_primary_menu_shadow_bottom_blur_radius',
// 						'dp_primary_menu_shadow_bottom_spread_radius',
// 						'dp_primary_menu_shadow_bottom_opacity',
// 						'0'
// 					);
// 				}
// 			}

// 		} );
// 	} );


	/**
	* Section: Primary Menu Sticky
	* Field: Background Color Style
	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_color_style', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

	/**
	* Section: Primary Menu Sticky
	* Field: Background Color Primary Color
	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_color', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );

// // 			dpMenuItemDividers (
// // 				'.nav-primary .disruptpress-nav-menu > li',
// // 				'dp_primary_menu_sticky_bg_color',
// // 				'dp_primary_menu_sticky_item_dividers_color',
// // 				'dp_primary_menu_sticky_item_dividers_color_toggle',
// // 				'dp_primary_menu_sticky_item_dividers',
// // 				'dp_primary_menu_sticky_item_dividers_firstchild',
// // 				'dp_primary_menu_sticky_item_dividers_lastchild',
// // 				'dp_primary_menu_sticky_item_dividers_top',
// // 				'dp_primary_menu_sticky_item_dividers_bottom',
// // 				'dp_primary_menu_sticky_search_toggle',
// // 				'dp_primary_menu_sticky_search_opening_divider',
// // 				'dp_primary_menu_sticky_search_closing_divider',
// // 				'.dp-search-nav-primary',
// // 				'dp_primary_menu_sticky_bg_active_boxshadow'
// // 			);
// 		} );
// 	} );

	/**
	* Section: Primary Menu Sticky
	* Field: Background Color Secondary Color
	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_color2', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

// 	/**
// 	* Section: Primary Menu Sticky
// 	* Field: Background Color Shade Strenght
// 	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_shade_strenght', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

// 	/**
// 	* Section: Primary Menu Sticky
// 	* Field: Background Color Gradient Style
// 	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_gradient_style', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

// 	/**
// 	* Section: Primary Menu Sticky
// 	* Field: Background Color Advanced Toggle
// 	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_gradient_advanced_toggle', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

// 	/**
// 	* Section: Primary Menu Sticky
// 	* Field: Background Color Gradient Position Parameter 1
// 	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_gradient_position_parameter1', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );

// 	/**
// 	* Section: Primary Menu Sticky
// 	* Field: Background Color Gradient Position Parameter 2
// 	*/
// 	wp.customize( 'dp_primary_menu_sticky_bg_gradient_position_parameter2', function( value ) {
// 		value.bind( function( newval ) {
// 			apply_bg_no_img( '.nav-primary.nav-primary-sticky', 'dp_primary_menu_sticky_bg' );
// 		} );
// 	} );




	/*
	 * Primary Menu Search Box
	 */
	wp.customize( 'dp_primary_menu_search_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == '0') {
				$( '.dp-search-nav-primary' ).remove();
			} else {

				//Before applying search box, double check if it does not already exist
				if ( !$( '.dp-search-nav-primary' ).length ) {
  				$( '.nav-primary .disruptpress-nav-menu' ).append( '<li class="dp-search-nav-primary"><div class="dp-search-nav-primary-wrap"><form role="search" method="get" class="search-form" action=""><input type="search" class="search-field" placeholder="Search …" value="" name="s"><input type="submit" class="search-submit" value="&#xf179;"></form></div></li>' );
				}
			}

			/* Adjusting search form to use full height so dividers go full lenght. Height based on font size of primary menu plus padding top plus padding bottom of menu items */
			var height = wp.customize.value( 'dp_primary_menu_height' )();
			$.stylesheet( '.dp-search-nav-primary-wrap .search-form' ).css( 'height', height + 'px' );

			dpAdjustSearchFieldHeight( '.dp-search-nav-primary',
				'dp_primary_menu_search_field_height_toggle',
				'dp_primary_menu_search_field_height',
				'dp_primary_menu_font_size'
			 );

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);

		} );
	} );

	/*
	 * Primary Menu Search Box Height Toggle
	 */
	wp.customize( 'dp_primary_menu_search_field_height_toggle', function( value ) {
		value.bind( function( newval ) {

			dpAdjustSearchFieldHeight( '.dp-search-nav-primary',
				'dp_primary_menu_search_field_height_toggle',
				'dp_primary_menu_search_field_height',
				'dp_primary_menu_font_size'
			 );

		} );
	} );

	/*
	 * Primary Menu Search Box Height Manual Adjustment
	 */
	wp.customize( 'dp_primary_menu_search_field_height', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'height', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'height', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'width', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'margin-left', '-' + newval + 'px' );

		} );
	} );

	/*
	 * Primary Menu Search Box Font Size Toggle
	 */
	wp.customize( 'dp_primary_menu_search_font_size_toggle', function( value ) {
		value.bind( function( newval ) {

			dpAdjustSearchFont( '.dp-search-nav-primary', 'dp_primary_menu_search_font_size_toggle', 'dp_primary_menu_font_size', 'dp_primary_menu_search_font_size' );

		} );
	} );

	/*
	 * Primary Menu Search Box Font Size Manual Adjustment
	 */
	wp.customize( 'dp_primary_menu_search_font_size', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'font-size', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'font-size', parseInt( newval ) + 4 + 'px' );

		} );
	} );

	/*
	 * Primary Menu Search Box Width
	 */
	wp.customize( 'dp_primary_menu_search_field_width', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'width', newval + 'px' );

		} );
	} );

	/*
	 * Primary Menu Search Border Radius
	 */
	wp.customize( 'dp_primary_menu_search_border_radius', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-radius', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'border-top-right-radius', newval + 'px' );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'border-bottom-right-radius', newval + 'px' );

		} );
	} );

	/*
	 * Primary Menu Search Border Toggle
	 */
	wp.customize( 'dp_primary_menu_search_border_toggle', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				var border_color = wp.customize.value( 'dp_primary_menu_search_border_color' )();

				$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-style', 'solid' );
				$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-width', '1px' );
				$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-color', border_color );
			} else {
				$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-style', 'none' );
				$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-width', '0px' );
			}
		} );
	} );

	/*
	 * Primary Menu Search Border Color & Icon Background Color
	 */
	wp.customize( 'dp_primary_menu_search_border_color', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-field' ).css( 'border-color', newval );
			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'background-color', newval );

		} );
	} );

	/*
	 * Primary Menu Search Icon Color
	 */
	wp.customize( 'dp_primary_menu_search_submit_font_color', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-search-nav-primary .search-submit' ).css( 'color', newval );

		} );
	} );

	/*
	 * Primary Menu Search Opening Dividers
	 */
	wp.customize( 'dp_primary_menu_search_opening_divider', function( value ) {
		value.bind( function( newval ) {

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);

		} );
	} );

	/*
	 * Primary Menu Search Closing Dividers
	 */
	wp.customize( 'dp_primary_menu_search_closing_divider', function( value ) {
		value.bind( function( newval ) {

			dpMenuItemDividers (
				'.nav-primary .disruptpress-nav-menu > li',
				'dp_primary_menu_bg_color',
				'dp_primary_menu_item_dividers_color',
				'dp_primary_menu_item_dividers_color_toggle',
				'dp_primary_menu_item_dividers',
				'dp_primary_menu_item_dividers_firstchild',
				'dp_primary_menu_item_dividers_lastchild',
				'dp_primary_menu_item_dividers_top',
				'dp_primary_menu_item_dividers_bottom',
				'dp_primary_menu_search_toggle',
				'dp_primary_menu_search_opening_divider',
				'dp_primary_menu_search_closing_divider',
				'.dp-search-nav-primary',
				'dp_primary_menu_bg_active_boxshadow'
			);

		} );
	} );

	/*
	 * Primary Menu Search Padding Left
	 */
	wp.customize( 'dp_primary_menu_search_padding_left', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.dp-search-nav-primary' ).css( 'padding-left', padding + 'px' );
			} else {
				$.stylesheet( '.dp-search-nav-primary' ).css( 'padding-left', '0px' );
			}

		} );
	} );

	/*
	 * Primary Menu Search Padding Left
	 */
	wp.customize( 'dp_primary_menu_search_padding_right', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				var padding = wp.customize.value( 'dp_primary_menu_item_padding_left_right' )();
				$.stylesheet( '.dp-search-nav-primary' ).css( 'padding-right', padding + 'px' );
			} else {
				$.stylesheet( '.dp-search-nav-primary' ).css( 'padding-right', '0px' );
			}

		} );
	} );


	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Primary Menu Sticky
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	/*
	 * Primary Menu Sticky Enable
	 */
	wp.customize( 'dp_primary_menu_sticky_enabled', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				$.stylesheet( '.nav-primary-scroll-wrap-sticky' ).css( 'position', 'fixed' );
			} else {
				$.stylesheet( '.nav-primary-scroll-wrap-sticky' ).css( 'position', 'static' );
			}

		} );
	} );

	/*
	 * Primary Menu Sticky Enable
	 */
	wp.customize( 'dp_primary_menu_sticky_boxed', function( value ) {
		value.bind( function( newval ) {

			if ( newval == true ) {
				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( { 'width':'100%', 'max-width':'100%' } );
			} else {
				$.stylesheet( '.nav-primary.nav-primary-sticky' ).css( { 'width':'', 'max-width':'' } );
			}

		} );
	} );


	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Primary Sidebar
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	function dp_sidebar_primary_width () {
		var width = wp.customize.value( 'dp_primary_sidebar_width' )();
		var width_custom = parseInt( wp.customize.value( 'dp_primary_sidebar_width_custom' )() );
		var padding = parseInt( wp.customize.value( 'dp_primary_sidebar_padding' )() );
		var margin = parseInt( wp.customize.value( 'dp_primary_sidebar_margin_to_content' )() );

		if ( width != 'custom' ) {
			//var width_sidebar = parseInt( width ) + ( padding * 2 );
			var width_sidebar = parseInt( width );
		} else {
			//var width_sidebar = width_custom + ( padding * 2 );
			var width_sidebar = width_custom;
		}
		var width_content = parseInt( width_sidebar ) + margin;

		$.stylesheet( '.sidebar-primary' ).css( { 'width': width_sidebar + 'px', 'padding': padding + 'px' } );

		$.stylesheet( '.content-sidebar1 .sidebar-primary' ).css( { 'margin-left': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.sidebar1-content .sidebar-primary' ).css( { 'margin-right': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.content-sidebar1-sidebar2 .sidebar-primary' ).css( { 'margin-left': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.content-sidebar2-sidebar1 .sidebar-primary' ).css( { 'margin-left': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' });
		$.stylesheet( '.sidebar1-content-sidebar2 .sidebar-primary' ).css( { 'margin-right': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.sidebar2-content-sidebar1 .sidebar-primary' ).css( { 'margin-left': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.sidebar1-sidebar2-content .sidebar-primary' ).css( { 'margin-right': '-' + width_sidebar + 'px', 'width': width_sidebar + 'px' } );
		$.stylesheet( '.sidebar2-sidebar1-content .sidebar-primary' ).css( { 'margin-right': '-' + width_sidebar + 'px' , 'width': width_sidebar + 'px' } );


		$.stylesheet( '.content-sidebar1 .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-right': width_content + 'px' } );
		$.stylesheet( '.sidebar1-content .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-left': width_content + 'px' } );
		$.stylesheet( '.content-sidebar1-sidebar2 .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-right': width_content + 'px' } );
		//$.stylesheet( '.content-sidebar2-sidebar1 .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-right': width_content + 'px' } );
		$.stylesheet( '.sidebar1-content-sidebar2 .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-left': width_content + 'px' } );
		$.stylesheet( '.sidebar2-content-sidebar1 .content' ).css( { 'width': 'calc(100% - ' + width_content + 'px)', 'margin-right': width_content + 'px' } );

	}

	wp.customize( 'dp_primary_sidebar_width_custom', function( value ) {
		value.bind( function( newval ) {
			dp_sidebar_primary_width();
		} );
	} );

	wp.customize( 'dp_primary_sidebar_width', function( value ) {
		value.bind( function( newval ) {
			dp_sidebar_primary_width();
		} );
	} );

	wp.customize( 'dp_primary_sidebar_margin_to_content', function( value ) {
		value.bind( function( newval ) {
			dp_sidebar_primary_width();
		} );
	} );

	wp.customize( 'dp_primary_sidebar_padding', function( value ) {
		value.bind( function( newval ) {
			dp_sidebar_primary_width();
		} );
	} );

	wp.customize( 'dp_primary_sidebar_margin_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary' ).css( 'margin-top', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );

			var background = wp.customize.value( 'dp_primary_sidebar_widgets_title_container_background' )();
			if ( background === true ) {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'background': 'transparent' } );
			} else {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'background': newval } );
			}

		} );
	} );


	wp.customize( 'dp_primary_sidebar_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary', 'dp_primary_sidebar' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_style', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_color', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_width_top', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_width_right', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_width_bottom', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_width_left', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary',
				'dp_primary_sidebar_border_color',
				'dp_primary_sidebar_border_style',
				'dp_primary_sidebar_border_width_top',
				'dp_primary_sidebar_border_width_right',
				'dp_primary_sidebar_border_width_bottom',
				'dp_primary_sidebar_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_style', function( value ) {
		value.bind( function( newval ) {

			/* Remove shadow from primary menu */
			if ( newval == 'none' ) {
				$.stylesheet( '.sidebar-primary' ).css( 'box-shadow', 'none' );

			/* Apply shadow presets to primary menu */
			} else if ( newval == 'presets' ) {
				var preset = parseInt( wp.customize.value( 'dp_primary_sidebar_shadow_presets' )() ) - 1;
				$.stylesheet( '.sidebar-primary' ).css( 'box-shadow', dpShadows[preset] );

			/* Apply custom shadow to primary menu */
			} else if ( newval == 'custom' ) {
				dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_presets', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_horizontal', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_vertical', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_blur_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_spread_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_shadow_bottom_opacity', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary',
					'dp_primary_sidebar_shadow_bottom_horizontal',
					'dp_primary_sidebar_shadow_bottom_vertical',
					'dp_primary_sidebar_shadow_bottom_blur_radius',
					'dp_primary_sidebar_shadow_bottom_spread_radius',
					'dp_primary_sidebar_shadow_bottom_opacity',
					'0'
				);
		} );
	} );


	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Primary Sidebar Widgets
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/


	wp.customize( 'dp_primary_sidebar_widgets_padding_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'padding-top', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'padding-bottom', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_padding_leftright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( { 'padding-left': newval + 'px', 'padding-right': newval + 'px' } );

			if ( wp.customize.value( 'dp_primary_sidebar_widgets_title_width' )() === true ) {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'margin-left': '-' + newval + 'px', 'margin-right': '-' + newval + 'px' } );
			} else {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'margin-left': '0px', 'margin-right': '0px' } );
			}
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_margin_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'margin-top', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_style', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_color', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_width_top', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_width_right', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_width_bottom', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_width_left', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget',
				'dp_primary_sidebar_widgets_border_color',
				'dp_primary_sidebar_widgets_border_style',
				'dp_primary_sidebar_widgets_border_width_top',
				'dp_primary_sidebar_widgets_border_width_right',
				'dp_primary_sidebar_widgets_border_width_bottom',
				'dp_primary_sidebar_widgets_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_style', function( value ) {
		value.bind( function( newval ) {

			/* Remove shadow from primary menu */
			if ( newval == 'none' ) {
				$.stylesheet( '.sidebar-primary .widget' ).css( 'box-shadow', 'none' );

			/* Apply shadow presets to primary menu */
			} else if ( newval == 'presets' ) {
				var preset = parseInt( wp.customize.value( 'dp_primary_sidebar_widgets_shadow_presets' )() ) - 1;
				$.stylesheet( '.sidebar-primary .widget' ).css( 'box-shadow', dpShadows[preset] );

			/* Apply custom shadow to primary menu */
			} else if ( newval == 'custom' ) {
				dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_presets', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_horizontal', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_vertical', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_blur_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_spread_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_opacity', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget',
					'dp_primary_sidebar_widgets_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_font_size', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'font-size', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_font_weight', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'font-weight', newval );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_font_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_link_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget a' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_link_color_hover', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget a:hover' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets_font_family', 'dp_primary_sidebar_widgets_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets_font_family', 'dp_primary_sidebar_widgets_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_link_underline', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				$.stylesheet( '.sidebar-primary .widget a' ).css( 'text-decoration', 'underline' );
			} else {
				$.stylesheet( '.sidebar-primary .widget a' ).css( 'text-decoration', 'none' );
			}
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_link_hover_underline', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				$.stylesheet( '.sidebar-primary .widget a:hover' ).css( 'text-decoration', 'underline' );
			} else {
				$.stylesheet( '.sidebar-primary .widget a:hover' ).css( 'text-decoration', 'none' );
			}
		} );
	} );


	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Primary Sidebar Widgets Title
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	wp.customize( 'dp_primary_sidebar_widgets_title_width', function( value ) {
		value.bind( function( newval ) {

			if ( newval === true ) {
				var padding_leftright = wp.customize.value( 'dp_primary_sidebar_widgets_padding_leftright' )();
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'margin-left': '-' + padding_leftright + 'px', 'margin-right': '-' + padding_leftright + 'px' } );
			} else {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'margin-left': '0px', 'margin-right': '0px' } );
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_content_width', function( value ) {
		value.bind( function( newval ) {

			if ( newval === true ) {
				$.stylesheet( '.sidebar-primary .widget-title span' ).css( { 'display': 'block' } );
			} else {
				$.stylesheet( '.sidebar-primary .widget-title span' ).css( { 'display': 'inline-block' } );
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_container_background', function( value ) {
		value.bind( function( newval ) {

			if ( newval === true ) {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'background': 'transparent' } );
			} else {
				var background = wp.customize.value( 'dp_primary_sidebar_color' )();
				$.stylesheet( '.sidebar-primary .widget-title' ).css( { 'background': background } );
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_padding', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title span' ).css( 'padding', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_margin_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'margin-top', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg_no_img( '.sidebar-primary .widget-title span', 'dp_primary_sidebar_widgets_title' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_style', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_color', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_width_top', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_width_right', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_width_bottom', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_width_left', function( value ) {
		value.bind( function( newval ) {
			dpApplyBorder('.sidebar-primary .widget-title',
				'dp_primary_sidebar_widgets_title_border_color',
				'dp_primary_sidebar_widgets_title_border_style',
				'dp_primary_sidebar_widgets_title_border_width_top',
				'dp_primary_sidebar_widgets_title_border_width_right',
				'dp_primary_sidebar_widgets_title_border_width_bottom',
				'dp_primary_sidebar_widgets_title_border_width_left'
			);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget-title span').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget-title span').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget-title span').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet('.sidebar-primary .widget-title span').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_style', function( value ) {
		value.bind( function( newval ) {

			/* Remove shadow from primary menu */
			if ( newval == 'none' ) {
				$.stylesheet( '.sidebar-primary .widget-title' ).css( 'box-shadow', 'none' );

			/* Apply shadow presets to primary menu */
			} else if ( newval == 'presets' ) {
				var preset = parseInt( wp.customize.value( 'dp_primary_sidebar_widgets_title_shadow_presets' )() ) - 1;
				$.stylesheet( '.sidebar-primary .widget-title' ).css( 'box-shadow', dpShadows[preset] );

			/* Apply custom shadow to primary menu */
			} else if ( newval == 'custom' ) {
				dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
			}

		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_presets', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_vertical', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_opacity', function( value ) {
		value.bind( function( newval ) {
			dpBoxShadow ( '.sidebar-primary .widget-title',
					'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
					'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
					'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
					'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
					'0'
				);
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_font_size', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'font-size', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_font_weight', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'font-weight', newval );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_font_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.sidebar-primary .widget-title' ).css( 'color', newval );
		} );
	} );


	wp.customize( 'dp_primary_sidebar_widgets_title_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.sidebar-primary .widget-title', 'dp_primary_sidebar_widgets_title_font_family', 'dp_primary_sidebar_widgets_title_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_primary_sidebar_widgets_title_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.sidebar-primary .widget-title', 'dp_primary_sidebar_widgets_title_font_family', 'dp_primary_sidebar_widgets_title_font_family_toggle' );
		} );
	} );




	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Footer
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/

	wp.customize( 'dp_footer_padding_top', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('padding-top', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_padding_right', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('padding-right', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_padding_bottom', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('padding-bottom', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_padding_left', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('padding-left', newval + 'px');
		} );
	} );

	// Footer Margin
	wp.customize( 'dp_footer_margin_top', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('margin-top', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('margin-bottom', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_color_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_color2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_shade_strenght', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_gradient_style', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_gradient_advanced_toggle', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_gradient_position_parameter1', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_gradient_position_parameter2', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_gradient_reverse_color', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_panel', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_pattern', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_upload', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_repeat', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_size', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_attachment', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_img_position', function( value ) {
		value.bind( function( newval ) {
			apply_bg('.site-footer', 'dp_footer');
		} );
	} );

	wp.customize( 'dp_footer_border_style', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_width_top', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_width_right', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_width_bottom', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_width_left', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_color', function( value ) {
		value.bind( function( newval ) {

			dpApplyBorder('.site-footer',
				'dp_footer_border_color',
				'dp_footer_border_style',
				'dp_footer_border_width_top',
				'dp_footer_border_width_right',
				'dp_footer_border_width_bottom',
				'dp_footer_border_width_left'
			)
		} );
	} );

	wp.customize( 'dp_footer_border_radius_topleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('border-top-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_border_radius_topright', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('border-top-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_border_radius_bottomright', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('border-bottom-right-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_border_radius_bottomleft', function( value ) {
		value.bind( function( newval ) {
			$('.site-footer').css('border-bottom-left-radius', newval + 'px');
		} );
	} );

	wp.customize( 'dp_footer_font_size', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer' ).css( 'font-size', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_footer_font_weight', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer' ).css( 'font-weight', newval );
		} );
	} );

	wp.customize( 'dp_footer_font_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_footer_link_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer a' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_footer_link_color_hover', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer a:hover' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_footer_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-footer', 'dp_footer_font_family', 'dp_footer_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_footer_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-footer', 'dp_footer_font_family', 'dp_footer_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_footer_link_underline', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				$.stylesheet( '.site-footer a' ).css( 'text-decoration', 'underline' );
			} else {
				$.stylesheet( '.site-footer a' ).css( 'text-decoration', 'none' );
			}
		} );
	} );

	wp.customize( 'dp_footer_link_hover_underline', function( value ) {
		value.bind( function( newval ) {
			if ( newval === true ) {
				$.stylesheet( '.site-footer a:hover' ).css( 'text-decoration', 'underline' );
			} else {
				$.stylesheet( '.site-footer a:hover' ).css( 'text-decoration', 'none' );
			}
		} );
	} );

	wp.customize( 'dp_footer_widget_title_font_size', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer .widget-title' ).css( 'font-size', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_footer_widget_title_font_weight', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer .widget-title' ).css( 'font-weight', newval );
		} );
	} );

	wp.customize( 'dp_footer_widget_title_font_color', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.site-footer .widget-title' ).css( 'color', newval );
		} );
	} );

	wp.customize( 'dp_footer_widget_title_font_family_toggle', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-footer .widget-title', 'dp_footer_widget_title_font_family', 'dp_footer_widget_title_font_family_toggle' );
		} );
	} );

	wp.customize( 'dp_footer_widget_title_font_family', function( value ) {
		value.bind( function( newval ) {
			dpApplyFont( '.site-footer .widget-title', 'dp_footer_widget_title_font_family', 'dp_footer_widget_title_font_family_toggle' );
		} );
	} );






	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Front Page Grid
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/
	wp.customize( 'dp_front_page_grid_container_margin_top', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.dp-custom-post-loop-wrap' ).css( 'margin-top', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_front_page_grid_container_margin_bottom', function( value ) {
		value.bind( function( newval ) {
			$.stylesheet( '.dp-custom-post-loop-wrap-bottom' ).css( 'margin-bottom', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_front_page_grid_items_per_line', function( value ) {
		value.bind( function( newval ) {
			//var width = Math.round( 100 / newval * 100) / 100 ;
			$.stylesheet( '.dp-custom-post-loop-wrap-parent' ).css( 'width', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_dimensions', function( value ) {
			value.bind( function( newval ) {
				//var width = Math.round( 100 / newval * 100) / 100 ;
				$.stylesheet( '.dp-custom-post-loop-wrap-child' ).css( 'padding-bottom', 'calc(100% * ' + newval + ')' );

			} );
		} );

	wp.customize( 'dp_front_page_grid_item_padding', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-wrap-parent' ).css( 'padding', newval + 'px' );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_border_radius', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-wrap-child' ).css( 'border-radius', newval + 'px' );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_title_background_height', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-content-wrap' ).css( 'height', newval + 'px' );
			console.log(newval);
		} );
	} );

	wp.customize( 'dp_front_page_grid_item_title_background_color', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-content-wrap' ).css( 'background', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_title_font_color', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-title' ).css( 'color', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_meta_font_color', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-meta' ).css( 'color', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_title_font_size', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-title' ).css( 'font-size', newval + 'px' );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_title_font_weight', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-title' ).css( 'font-weight', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_meta_font_size', function( value ) {
		value.bind( function( newval ) {

			$.stylesheet( '.dp-custom-post-loop-meta' ).css( 'font-size', newval + 'px' );

		} );
	} );


	/**
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* Section:  Front Page Grid - Custom Options
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	*/



	wp.customize( 'dp_front_page_grid_items_nth_per_line', function( value ) {
		value.bind( function( newval ) {
			//var width = Math.round( 100 / newval * 100) / 100 ;
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ')' ).css( 'width', newval );

		} );
	} );


	wp.customize( 'dp_front_page_grid_item_nth_title_background_height', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-content-wrap' ).css( 'height', newval + 'px' );
		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_title_background_color', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-content-wrap' ).css( 'background', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_title_font_color', function( value ) {
		value.bind( function( newval ) {
				var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-title' ).css( 'color', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_meta_font_color', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-meta' ).css( 'color', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_title_font_size', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-title' ).css( 'font-size', newval + 'px' );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_title_font_weight', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-title' ).css( 'font-weight', newval );

		} );
	} );

	wp.customize( 'dp_front_page_grid_item_nth_meta_font_size', function( value ) {
		value.bind( function( newval ) {
			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
			var nth_selector = wp.customize.value( 'dp_front_page_grid_item_nth_selector' )();

			if ( nth_selector == "1") {
				var nth = '-n+' + items;
			} else {
				var nth = items + 'n+1' ;
			}

			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(' + nth + ') .dp-custom-post-loop-meta' ).css( 'font-size', newval + 'px' );

		} );
	} );







// 		wp.customize( 'dp_front_page_grid_item_nth_title_background_color', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-content-wrap' ).css( 'background', newval );

// 		} );
// 	} );

// 	wp.customize( 'dp_front_page_grid_item_nth_title_font_color', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-title' ).css( 'color', newval );

// 		} );
// 	} );

// 	wp.customize( 'dp_front_page_grid_item_nth_meta_font_color', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-meta' ).css( 'color', newval );

// 		} );
// 	} );

// 	wp.customize( 'dp_front_page_grid_item_nth_title_font_size', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-title' ).css( 'font-size', newval + 'px' );

// 		} );
// 	} );

// 	wp.customize( 'dp_front_page_grid_item_nth_title_font_weight', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-title' ).css( 'font-weight', newval );

// 		} );
// 	} );

// 	wp.customize( 'dp_front_page_grid_item_nth_meta_font_size', function( value ) {
// 		value.bind( function( newval ) {
// 			var items = wp.customize.value( 'dp_front_page_grid_item_nth_limit' )();
// 			$.stylesheet( '.dp-custom-post-loop-wrap-parent:nth-child(-n+' + items + ') .dp-custom-post-loop-meta' ).css( 'font-size', newval + 'px' );

// 		} );
// 	} );

    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Page
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */
    // wp.customize( 'dp_page_typography_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         var globalValue = wp.customize.value( 'dp_typography_font_size' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-size', globalValue + 'px' );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-size', newval + 'px' );
    //         }
    //
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_size', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_font_size' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-size', globalValue + 'px' );
		// 	} else {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-size', newval + 'px' );
		// 	}
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_weight', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_font_weight' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-weight', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'font-weight', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_line_height', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_font_line_height' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'line-height', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'line-height', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_color', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_font_color' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'color', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content' ).css( 'color', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_link_color', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_link_color' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content a' ).css( 'color', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content a' ).css( 'color', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_link_color_hover', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_link_color_hover' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content a:hover' ).css( 'color', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content a:hover' ).css( 'color', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_link_underline', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_link_underline' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content a' ).css( 'text-decoration', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content a' ).css( 'text-decoration', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_link_hover_underline', function( value ) {
    //     value.bind( function( newval ) {
    //         var globalToggle = wp.customize.value( 'dp_page_typography_toggle' )();
    //         var globalValue = wp.customize.value( 'dp_typography_link_hover_underline' )();
    //
    //         if ( globalToggle == true ) {
    //             $.stylesheet( '.single .content, .page .content a:hover' ).css( 'text-decoration', globalValue );
    //         } else {
    //             $.stylesheet( '.single .content, .page .content a:hover' ).css( 'text-decoration', newval );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_family_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyFont( '.single .content, .page .content', 'dp_page_font_family', 'dp_page_font_family_toggle' );
    //
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_page_font_family', function( value ) {
    //     value.bind( function( newval ) {
    //         dpApplyFont( '.single .content, .page .content', 'dp_page_font_family', 'dp_page_font_family_toggle' );
    //
    //     } );
    // } );







    wp.customize( 'dp_page_padding_top', function( value ) {
        value.bind( function( newval ) {
			$.stylesheet( '.single .content, .page .content' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_page_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );

	wp.customize( 'dp_page_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .content, .page .content',
                'dp_page_border_color',
                'dp_page_border_style',
                'dp_page_border_top',
                'dp_page_border_right',
                'dp_page_border_bottom',
                'dp_page_border_left'
            )

        } );
    } );



    wp.customize( 'dp_page_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .content, .page .content').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .content, .page .content').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .content, .page .content').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .content, .page .content').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_page_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.single .content, .page .content' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_page_shadow_presets' )() ) - 1;
                $.stylesheet( '.single .content, .page .content' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.single .content, .page .content',
                    'dp_page_shadow_horizontal',
                    'dp_page_shadow_vertical',
                    'dp_page_shadow_blur_radius',
                    'dp_page_shadow_spread_radius',
                    'dp_page_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_page_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .content, .page .content' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_page_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .content, .page .content',
                'dp_page_shadow_horizontal',
                'dp_page_shadow_vertical',
                'dp_page_shadow_blur_radius',
                'dp_page_shadow_spread_radius',
                'dp_page_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .content, .page .content',
                'dp_page_shadow_horizontal',
                'dp_page_shadow_vertical',
                'dp_page_shadow_blur_radius',
                'dp_page_shadow_spread_radius',
                'dp_page_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .content, .page .content',
                'dp_page_shadow_horizontal',
                'dp_page_shadow_vertical',
                'dp_page_shadow_blur_radius',
                'dp_page_shadow_spread_radius',
                'dp_page_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .content, .page .content',
                'dp_page_shadow_horizontal',
                'dp_page_shadow_vertical',
                'dp_page_shadow_blur_radius',
                'dp_page_shadow_spread_radius',
                'dp_page_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .content, .page .content',
                'dp_page_shadow_horizontal',
                'dp_page_shadow_vertical',
                'dp_page_shadow_blur_radius',
                'dp_page_shadow_spread_radius',
                'dp_page_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_page_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_page' );
        } );
    } );

    wp.customize( 'dp_page_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .content, .page .content', 'dp_primary_sidebar_widgets_title' );
        } );
    } );




    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Page Featured Image
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    // wp.customize( 'dp_page_featured_image_margin_bottom', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.post-featured-image' ).css( 'margin-bottom', newval + 'px' );
    //     } );
    // } );

    wp.customize( 'dp_page_featured_image_max_height', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'max-height', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_page_featured_image_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_featured_image_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_featured_image_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_featured_image_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_featured_image_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_featured_image_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.post-featured-image',
                'dp_page_featured_image_border_color',
                'dp_page_featured_image_border_style',
                'dp_page_featured_image_border_top',
                'dp_page_featured_image_border_right',
                'dp_page_featured_image_border_bottom',
                'dp_page_featured_image_border_left'
            )

        } );
    } );



    wp.customize( 'dp_page_featured_image_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.post-featured-image').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_featured_image_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.post-featured-image').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_featured_image_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.post-featured-image').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_featured_image_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.post-featured-image').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_page_featured_image_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.post-featured-image' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_page_featured_image_shadow_presets' )() ) - 1;
                $.stylesheet( '.post-featured-image' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.post-featured-image',
                    'dp_page_featured_image_shadow_horizontal',
                    'dp_page_featured_image_shadow_vertical',
                    'dp_page_featured_image_shadow_blur_radius',
                    'dp_page_featured_image_shadow_spread_radius',
                    'dp_page_featured_image_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.post-featured-image',
                'dp_page_featured_image_shadow_horizontal',
                'dp_page_featured_image_shadow_vertical',
                'dp_page_featured_image_shadow_blur_radius',
                'dp_page_featured_image_shadow_spread_radius',
                'dp_page_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.post-featured-image',
                'dp_page_featured_image_shadow_horizontal',
                'dp_page_featured_image_shadow_vertical',
                'dp_page_featured_image_shadow_blur_radius',
                'dp_page_featured_image_shadow_spread_radius',
                'dp_page_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.post-featured-image',
                'dp_page_featured_image_shadow_horizontal',
                'dp_page_featured_image_shadow_vertical',
                'dp_page_featured_image_shadow_blur_radius',
                'dp_page_featured_image_shadow_spread_radius',
                'dp_page_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.post-featured-image',
                'dp_page_featured_image_shadow_horizontal',
                'dp_page_featured_image_shadow_vertical',
                'dp_page_featured_image_shadow_blur_radius',
                'dp_page_featured_image_shadow_spread_radius',
                'dp_page_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.post-featured-image',
                'dp_page_featured_image_shadow_horizontal',
                'dp_page_featured_image_shadow_vertical',
                'dp_page_featured_image_shadow_blur_radius',
                'dp_page_featured_image_shadow_spread_radius',
                'dp_page_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_page_featured_image_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_page_featured_image' );
        } );
    } );

    wp.customize( 'dp_page_featured_image_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.post-featured-image', 'dp_primary_sidebar_widgets_title' );
        } );
    } );



    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Page Title
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_page_header_location_inside_image_vertical', function( value ) {
        value.bind( function( newval ) {

            if ( newval == 'top' ) {
            	$.stylesheet( '.post-featured-image .entry-header-wrap' ).css( { 'top': '0', 'bottom': 'initial' } );
            } else if ( newval == 'middle' ) {
                $.stylesheet( '.post-featured-image .entry-header-wrap' ).css( { 'top': '40%', 'bottom': 'initial' } );
			} else {
                $.stylesheet( '.post-featured-image .entry-header-wrap' ).css( { 'top': 'initial', 'bottom': '0' } );
			}

        } );
    } );

    wp.customize( 'dp_page_header_location_inside_image_horizontal', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image .entry-header-wrap' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_page_header_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-title, .page .entry-title' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_page_header_width', function( value ) {
        value.bind( function( newval ) {

            if ( newval == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_header_margin_left' )() );
				var margin_right =  parseInt( wp.customize.value( 'dp_page_header_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'width', 'calc(100% - ' + margin + 'px)' );
            } else {
                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'width', 'auto' );
			}


            // if ( newval == '100%') {
            //     var margin_left =  wp.customize.value( 'dp_page_header_margin_left' )();
            //     var margin_right =  wp.customize.value( 'dp_page_header_margin_right' )();
				//
            //     $.stylesheet( '.post-featured-image .entry-header-wrap' ).css( { 'left': margin_left + 'px', 'right': margin_right + 'px', 'width': 'auto' } );
            //     $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'width', '100%' );
            //     $.stylesheet( '.single .post-featured-image  .entry-header, .page .post-featured-image .entry-header' ).css( { 'margin-right': '0px', 'margin-left': '0px' } );
            //
            // } else {
            //     $.stylesheet( '.post-featured-image .entry-header-wrap' ).css( { 'left': 'initial', 'right': 'initial', 'width': '100%' } );
            //     $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'width', 'auto' );
            //     $.stylesheet( '.single .post-featured-image  .entry-header, .page .post-featured-image .entry-header' ).css( { 'margin-right': '', 'margin-left': '' } );
            //
            // }


        } );
    } );

    wp.customize( 'dp_page_header_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-title, .page .entry-title' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-title, .page .entry-title' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_page_header_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-title, .page .entry-title' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_page_header_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_page_header_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_margin_right', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'margin-right', newval + 'px' );

            var header_width = wp.customize.value( 'dp_page_header_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_header_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_page_header_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-right': newval + 'px' } );
            } else {
                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( { 'width':'auto', 'margin-right': newval + 'px' } );
            }

        } );
    } );

    wp.customize( 'dp_page_header_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_margin_left', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'margin-left', newval + 'px' );

            var header_width = wp.customize.value( 'dp_page_header_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_header_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_page_header_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-left': newval + 'px' } );
            } else {
                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( { 'width':'auto', 'margin-left': newval + 'px' } );
            }
        } );
    } );

    wp.customize( 'dp_page_header_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.single .entry-header, .page .entry-header',
                'dp_page_header_border_color',
                'dp_page_header_border_style',
                'dp_page_header_border_top',
                'dp_page_header_border_right',
                'dp_page_header_border_bottom',
                'dp_page_header_border_left'
            )

        } );
    } );



    wp.customize( 'dp_page_header_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .entry-header, .page .entry-header').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .entry-header, .page .entry-header').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .entry-header, .page .entry-header').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.single .entry-header, .page .entry-header').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_page_header_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_page_header_shadow_presets' )() ) - 1;
                $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.single .entry-header, .page .entry-header',
                    'dp_page_header_shadow_horizontal',
                    'dp_page_header_shadow_vertical',
                    'dp_page_header_shadow_blur_radius',
                    'dp_page_header_shadow_spread_radius',
                    'dp_page_header_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_page_header_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.single .entry-header, .page .entry-header' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_page_header_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .entry-header, .page .entry-header',
                'dp_page_header_shadow_horizontal',
                'dp_page_header_shadow_vertical',
                'dp_page_header_shadow_blur_radius',
                'dp_page_header_shadow_spread_radius',
                'dp_page_header_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .entry-header, .page .entry-header',
                'dp_page_header_shadow_horizontal',
                'dp_page_header_shadow_vertical',
                'dp_page_header_shadow_blur_radius',
                'dp_page_header_shadow_spread_radius',
                'dp_page_header_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .entry-header, .page .entry-header',
                'dp_page_header_shadow_horizontal',
                'dp_page_header_shadow_vertical',
                'dp_page_header_shadow_blur_radius',
                'dp_page_header_shadow_spread_radius',
                'dp_page_header_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .entry-header, .page .entry-header',
                'dp_page_header_shadow_horizontal',
                'dp_page_header_shadow_vertical',
                'dp_page_header_shadow_blur_radius',
                'dp_page_header_shadow_spread_radius',
                'dp_page_header_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.single .entry-header, .page .entry-header',
                'dp_page_header_shadow_horizontal',
                'dp_page_header_shadow_vertical',
                'dp_page_header_shadow_blur_radius',
                'dp_page_header_shadow_spread_radius',
                'dp_page_header_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_page_header_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_page_header' );
        } );
    } );

    wp.customize( 'dp_page_header_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.single .entry-header, .page .entry-header', 'dp_primary_sidebar_widgets_title' );
        } );
    } );


    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Page Title Meta
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_page_header_meta_show_date', function( value ) {
        value.bind( function( newval ) {
        	if ( newval == true ) {
            	$.stylesheet( '.entry-header .entry-meta .entry-time' ).css( 'display','inline' );
            } else {
        		$.stylesheet( '.entry-header .entry-meta .entry-time' ).css( 'display','none' );
            }
        } );
    } );

    wp.customize( 'dp_page_header_meta_show_author', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $.stylesheet( '.entry-header .entry-meta .byline' ).css( 'display','inline' );
            } else {
                $.stylesheet( '.entry-header .entry-meta .byline' ).css( 'display','none' );
            }
        } );
    } );

    wp.customize( 'dp_page_header_meta_show_comment_count', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $.stylesheet( '.entry-header .entry-meta .entry-comments-link' ).css( 'display','inline' );
            } else {
                $.stylesheet( '.entry-header .entry-meta .entry-comments-link' ).css( 'display','none' );
            }
        } );
    } );


    wp.customize( 'dp_page_header_meta_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_page_header_meta_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_page_header_meta_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_page_header_meta_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_meta_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_meta_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_meta_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_meta_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_header_meta_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-header .entry-meta',
                'dp_page_header_meta_border_color',
                'dp_page_header_meta_border_style',
                'dp_page_header_meta_border_top',
                'dp_page_header_meta_border_right',
                'dp_page_header_meta_border_bottom',
                'dp_page_header_meta_border_left'
            )

        } );
    } );



    wp.customize( 'dp_page_header_meta_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-header .entry-meta').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_meta_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-header .entry-meta').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_meta_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-header .entry-meta').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_header_meta_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-header .entry-meta').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_page_header_meta_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.entry-header .entry-meta' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_page_header_meta_shadow_presets' )() ) - 1;
                $.stylesheet( '.entry-header .entry-meta' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.entry-header .entry-meta',
                    'dp_page_header_meta_shadow_horizontal',
                    'dp_page_header_meta_shadow_vertical',
                    'dp_page_header_meta_shadow_blur_radius',
                    'dp_page_header_meta_shadow_spread_radius',
                    'dp_page_header_meta_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-header .entry-meta' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-header .entry-meta',
                'dp_page_header_meta_shadow_horizontal',
                'dp_page_header_meta_shadow_vertical',
                'dp_page_header_meta_shadow_blur_radius',
                'dp_page_header_meta_shadow_spread_radius',
                'dp_page_header_meta_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-header .entry-meta',
                'dp_page_header_meta_shadow_horizontal',
                'dp_page_header_meta_shadow_vertical',
                'dp_page_header_meta_shadow_blur_radius',
                'dp_page_header_meta_shadow_spread_radius',
                'dp_page_header_meta_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-header .entry-meta',
                'dp_page_header_meta_shadow_horizontal',
                'dp_page_header_meta_shadow_vertical',
                'dp_page_header_meta_shadow_blur_radius',
                'dp_page_header_meta_shadow_spread_radius',
                'dp_page_header_meta_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-header .entry-meta',
                'dp_page_header_meta_shadow_horizontal',
                'dp_page_header_meta_shadow_vertical',
                'dp_page_header_meta_shadow_blur_radius',
                'dp_page_header_meta_shadow_spread_radius',
                'dp_page_header_meta_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-header .entry-meta',
                'dp_page_header_meta_shadow_horizontal',
                'dp_page_header_meta_shadow_vertical',
                'dp_page_header_meta_shadow_blur_radius',
                'dp_page_header_meta_shadow_spread_radius',
                'dp_page_header_meta_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_page_header_meta_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_page_header_meta' );
        } );
    } );

    wp.customize( 'dp_page_header_meta_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-header .entry-meta', 'dp_primary_sidebar_widgets_title' );
        } );
    } );





    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Page Categories
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_page_category_location_inside_image_vertical', function( value ) {
        value.bind( function( newval ) {

            if ( newval == 'top' ) {
                $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( { 'top': '0', 'bottom': 'initial' } );
            } else if ( newval == 'middle' ) {
                $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( { 'top': '40%', 'bottom': 'initial' } );
            } else {
                $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( { 'top': 'initial', 'bottom': '0' } );
            }

        } );
    } );

    wp.customize( 'dp_page_category_location_inside_image_horizontal', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_page_category_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_page_category_width', function( value ) {
        value.bind( function( newval ) {

            if ( newval == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_page_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'width', 'calc(100% - ' + margin + 'px)' );
            } else {
                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'width', 'auto' );
            }


            // if ( newval == '100%') {
            //     var margin_left =  wp.customize.value( 'dp_page_category_margin_left' )();
            //     var margin_right =  wp.customize.value( 'dp_page_category_margin_right' )();
            //
            //     $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( { 'left': margin_left + 'px', 'right': margin_right + 'px', 'width': 'auto' } );
            //     $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'width', '100%' );
            //     $.stylesheet( '.single .post-featured-image  .entry-header, .page .post-featured-image .entry-header' ).css( { 'margin-right': '0px', 'margin-left': '0px' } );
            //
            // } else {
            //     $.stylesheet( '.post-featured-image .entry-categories-wrap' ).css( { 'left': 'initial', 'right': 'initial', 'width': '100%' } );
            //     $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'width', 'auto' );
            //     $.stylesheet( '.single .post-featured-image  .entry-header, .page .post-featured-image .entry-header' ).css( { 'margin-right': '', 'margin-left': '' } );
            //
            // }


        } );
    } );

    wp.customize( 'dp_page_category_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_page_category_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap, .entry-categories-wrap a' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_page_category_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_page_category_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_margin_right', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'margin-right', newval + 'px' );

            var header_width = wp.customize.value( 'dp_page_category_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_page_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-right': newval + 'px' } );
            } else {
                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( { 'width':'auto', 'margin-right': newval + 'px' } );
            }

        } );
    } );

    wp.customize( 'dp_page_category_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_page_category_margin_left', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'margin-left', newval + 'px' );

            var header_width = wp.customize.value( 'dp_page_category_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_page_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_page_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-left': newval + 'px' } );
            } else {
                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( { 'width':'auto', 'margin-left': newval + 'px' } );
            }
        } );
    } );

    wp.customize( 'dp_page_category_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_category_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_category_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_category_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_category_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_page_category_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.entry-categories-wrap .entry-categories',
                'dp_page_category_border_color',
                'dp_page_category_border_style',
                'dp_page_category_border_top',
                'dp_page_category_border_right',
                'dp_page_category_border_bottom',
                'dp_page_category_border_left'
            )

        } );
    } );



    wp.customize( 'dp_page_category_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-categories-wrap .entry-categories').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_category_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-categories-wrap .entry-categories').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_category_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-categories-wrap .entry-categories').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_page_category_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.entry-categories-wrap .entry-categories').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_page_category_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_page_category_shadow_presets' )() ) - 1;
                $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                    'dp_page_category_shadow_horizontal',
                    'dp_page_category_shadow_vertical',
                    'dp_page_category_shadow_blur_radius',
                    'dp_page_category_shadow_spread_radius',
                    'dp_page_category_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_page_category_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.entry-categories-wrap .entry-categories' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_page_category_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                'dp_page_category_shadow_horizontal',
                'dp_page_category_shadow_vertical',
                'dp_page_category_shadow_blur_radius',
                'dp_page_category_shadow_spread_radius',
                'dp_page_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_category_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                'dp_page_category_shadow_horizontal',
                'dp_page_category_shadow_vertical',
                'dp_page_category_shadow_blur_radius',
                'dp_page_category_shadow_spread_radius',
                'dp_page_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_category_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                'dp_page_category_shadow_horizontal',
                'dp_page_category_shadow_vertical',
                'dp_page_category_shadow_blur_radius',
                'dp_page_category_shadow_spread_radius',
                'dp_page_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_category_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                'dp_page_category_shadow_horizontal',
                'dp_page_category_shadow_vertical',
                'dp_page_category_shadow_blur_radius',
                'dp_page_category_shadow_spread_radius',
                'dp_page_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_page_category_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.entry-categories-wrap .entry-categories',
                'dp_page_category_shadow_horizontal',
                'dp_page_category_shadow_vertical',
                'dp_page_category_shadow_blur_radius',
                'dp_page_category_shadow_spread_radius',
                'dp_page_category_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_page_category_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_page_category' );
        } );
    } );

    wp.customize( 'dp_page_category_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.entry-categories-wrap .entry-categories', 'dp_primary_sidebar_widgets_title' );
        } );
    } );


    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Typography
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_typography_font_family', function( value ) {
        value.bind( function( newval ) {

            dpApplyFont( 'body', 'dp_typography_font_family', '' );
            dpApplyFont( '.nav-primary', 'dp_primary_menu_font_family', 'dp_primary_menu_font_family_toggle' );
            //dpApplyFont( '.single .content, .page .content', 'dp_page_font_family', 'dp_page_font_family_toggle' );
            dpApplyFont( '.site-header .site-title', 'dp_header_logo_title_font_family', 'dp_header_logo_title_font_family_toggle' );
            dpApplyFont( '.site-header .site-description', 'dp_header_logo_tagline_font_family', 'dp_header_logo_tagline_font_family_toggle' );
            dpApplyFont( '.nav-primary .site-title', 'dp_primary_menu_logo_title_font_family', 'dp_primary_menu_logo_title_font_family_toggle' );
            dpApplyFont( '.nav-primary .site-description', 'dp_primary_menu_logo_tagline_font_family', 'dp_primary_menu_logo_tagline_font_family_toggle' );
            dpApplyFont( '.sidebar-primary .widget', 'dp_primary_sidebar_widgets_font_family', 'dp_primary_sidebar_widgets_font_family_toggle' );
            dpApplyFont( '.sidebar-primary .widget-title', 'dp_primary_sidebar_widgets_title_font_family', 'dp_primary_sidebar_widgets_title_font_family_toggle' );
            dpApplyFont( '.site-footer', 'dp_footer_font_family', 'dp_footer_font_family_toggle' );
            dpApplyFont( '.site-footer .widget-title', 'dp_footer_widget_title_font_family', 'dp_footer_widget_title_font_family_toggle' );




        } );
    } );

    wp.customize( 'dp_typography_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'body, body > div' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'body' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_typography_font_line_height', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'body' ).css( 'line-height', newval );
        } );
    } );

    wp.customize( 'dp_typography_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'body' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_typography_link_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'a' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_typography_link_color_hover', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'a:hover, a:active' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_typography_link_underline', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'a' ).css( 'text-decoration', newval );
        } );
    } );

    wp.customize( 'dp_typography_link_hover_underline', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'a:hover, a:active' ).css( 'text-decoration', newval );
        } );
    } );

    wp.customize( 'dp_typography_h1_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h1' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_h2_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h2' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_h3_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h3' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_h4_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h4' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_h5_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h5' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_typography_h_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h1, h2, h3, h4, h5, h6' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_typography_h_font_line_height', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( 'h1, h2, h3, h4, h5, h6' ).css( 'line-height', newval );
        } );
    } );

    wp.customize( 'dp_typography_h_font_family', function( value ) {
        value.bind( function( newval ) {

            dpApplyFont( 'h1, h2, h3, h4, h5, h6', 'dp_typography_h_font_family', '' );

        } );
    } );





    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */


    wp.customize( 'dp_blog_roll_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_link_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content a, .blog .content a' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_link_color_hover', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content a:hover, .blog .content a:hover' ).css( 'color', newval );
        } );
    } );





    wp.customize( 'dp_blog_roll_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive .content, .blog .content',
                'dp_blog_roll_border_color',
                'dp_blog_roll_border_style',
                'dp_blog_roll_border_top',
                'dp_blog_roll_border_right',
                'dp_blog_roll_border_bottom',
                'dp_blog_roll_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive .content, .blog .content').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive .content, .blog .content').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive .content, .blog .content').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive .content, .blog .content').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.archive .content, .blog .content' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_shadow_presets' )() ) - 1;
                $.stylesheet( '.archive .content, .blog .content' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.archive .content, .blog .content',
                    'dp_blog_roll_shadow_horizontal',
                    'dp_blog_roll_shadow_vertical',
                    'dp_blog_roll_shadow_blur_radius',
                    'dp_blog_roll_shadow_spread_radius',
                    'dp_blog_roll_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive .content, .blog .content' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive .content, .blog .content',
                'dp_blog_roll_shadow_horizontal',
                'dp_blog_roll_shadow_vertical',
                'dp_blog_roll_shadow_blur_radius',
                'dp_blog_roll_shadow_spread_radius',
                'dp_blog_roll_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive .content, .blog .content',
                'dp_blog_roll_shadow_horizontal',
                'dp_blog_roll_shadow_vertical',
                'dp_blog_roll_shadow_blur_radius',
                'dp_blog_roll_shadow_spread_radius',
                'dp_blog_roll_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive .content, .blog .content',
                'dp_blog_roll_shadow_horizontal',
                'dp_blog_roll_shadow_vertical',
                'dp_blog_roll_shadow_blur_radius',
                'dp_blog_roll_shadow_spread_radius',
                'dp_blog_roll_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive .content, .blog .content',
                'dp_blog_roll_shadow_horizontal',
                'dp_blog_roll_shadow_vertical',
                'dp_blog_roll_shadow_blur_radius',
                'dp_blog_roll_shadow_spread_radius',
                'dp_blog_roll_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive .content, .blog .content',
                'dp_blog_roll_shadow_horizontal',
                'dp_blog_roll_shadow_vertical',
                'dp_blog_roll_shadow_blur_radius',
                'dp_blog_roll_shadow_spread_radius',
                'dp_blog_roll_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_blog_roll_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_blog_roll' );
        } );
    } );

    wp.customize( 'dp_blog_roll_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive .content, .blog .content', 'dp_primary_sidebar_widgets_title' );
        } );
    } );


    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Archive Title
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */


    wp.customize( 'dp_archive_title_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_archive_title_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_archive_title_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_archive_title_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_archive_title_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_archive_title_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_archive_title_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_archive_title_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_archive_title_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_archive_title_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.archive-title',
                'dp_archive_title_border_color',
                'dp_archive_title_border_style',
                'dp_archive_title_border_top',
                'dp_archive_title_border_right',
                'dp_archive_title_border_bottom',
                'dp_archive_title_border_left'
            )

        } );
    } );



    wp.customize( 'dp_archive_title_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive-title').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_archive_title_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive-title').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_archive_title_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive-title').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_archive_title_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.archive-title').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_archive_title_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.archive-title' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_archive_title_shadow_presets' )() ) - 1;
                $.stylesheet( '.archive-title' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.archive-title',
                    'dp_archive_title_shadow_horizontal',
                    'dp_archive_title_shadow_vertical',
                    'dp_archive_title_shadow_blur_radius',
                    'dp_archive_title_shadow_spread_radius',
                    'dp_archive_title_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_archive_title_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.archive-title' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_archive_title_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive-title',
                'dp_archive_title_shadow_horizontal',
                'dp_archive_title_shadow_vertical',
                'dp_archive_title_shadow_blur_radius',
                'dp_archive_title_shadow_spread_radius',
                'dp_archive_title_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_archive_title_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive-title',
                'dp_archive_title_shadow_horizontal',
                'dp_archive_title_shadow_vertical',
                'dp_archive_title_shadow_blur_radius',
                'dp_archive_title_shadow_spread_radius',
                'dp_archive_title_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_archive_title_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive-title',
                'dp_archive_title_shadow_horizontal',
                'dp_archive_title_shadow_vertical',
                'dp_archive_title_shadow_blur_radius',
                'dp_archive_title_shadow_spread_radius',
                'dp_archive_title_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_archive_title_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive-title',
                'dp_archive_title_shadow_horizontal',
                'dp_archive_title_shadow_vertical',
                'dp_archive_title_shadow_blur_radius',
                'dp_archive_title_shadow_spread_radius',
                'dp_archive_title_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_archive_title_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.archive-title',
                'dp_archive_title_shadow_horizontal',
                'dp_archive_title_shadow_vertical',
                'dp_archive_title_shadow_blur_radius',
                'dp_archive_title_shadow_spread_radius',
                'dp_archive_title_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_archive_title_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_archive_title' );
        } );
    } );

    wp.customize( 'dp_archive_title_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.archive-title', 'dp_primary_sidebar_widgets_title' );
        } );
    } );



    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Wrap
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */


    // wp.customize( 'dp_blog_roll_wrap_font_size', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'font-size', newval + 'px' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_wrap_font_color', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'color', newval );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_wrap_link_color', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.archive .content a, .blog .content a' ).css( 'color', newval );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_wrap_link_color_hover', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.archive .content a:hover, .blog .content a:hover' ).css( 'color', newval );
    //     } );
    // } );





    wp.customize( 'dp_blog_roll_wrap_width', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.blog .entry, .archive .entry' ).css( 'width', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_wrap_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_border_color',
                'dp_blog_roll_wrap_border_style',
                'dp_blog_roll_wrap_border_top',
                'dp_blog_roll_wrap_border_right',
                'dp_blog_roll_wrap_border_bottom',
                'dp_blog_roll_wrap_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_wrap_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-wrap').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-wrap').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-wrap').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-wrap').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_wrap_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_wrap_shadow_presets' )() ) - 1;
                $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                    'dp_blog_roll_wrap_shadow_horizontal',
                    'dp_blog_roll_wrap_shadow_vertical',
                    'dp_blog_roll_wrap_shadow_blur_radius',
                    'dp_blog_roll_wrap_shadow_spread_radius',
                    'dp_blog_roll_wrap_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-wrap' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_shadow_horizontal',
                'dp_blog_roll_wrap_shadow_vertical',
                'dp_blog_roll_wrap_shadow_blur_radius',
                'dp_blog_roll_wrap_shadow_spread_radius',
                'dp_blog_roll_wrap_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_shadow_horizontal',
                'dp_blog_roll_wrap_shadow_vertical',
                'dp_blog_roll_wrap_shadow_blur_radius',
                'dp_blog_roll_wrap_shadow_spread_radius',
                'dp_blog_roll_wrap_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_shadow_horizontal',
                'dp_blog_roll_wrap_shadow_vertical',
                'dp_blog_roll_wrap_shadow_blur_radius',
                'dp_blog_roll_wrap_shadow_spread_radius',
                'dp_blog_roll_wrap_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_shadow_horizontal',
                'dp_blog_roll_wrap_shadow_vertical',
                'dp_blog_roll_wrap_shadow_blur_radius',
                'dp_blog_roll_wrap_shadow_spread_radius',
                'dp_blog_roll_wrap_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-wrap',
                'dp_blog_roll_wrap_shadow_horizontal',
                'dp_blog_roll_wrap_shadow_vertical',
                'dp_blog_roll_wrap_shadow_blur_radius',
                'dp_blog_roll_wrap_shadow_spread_radius',
                'dp_blog_roll_wrap_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_blog_roll_wrap_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_blog_roll_wrap' );
        } );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-wrap', 'dp_primary_sidebar_widgets_title' );
        } );
    } );




    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Container 1
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_blog_roll_container_1_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_1_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_border_color',
                'dp_blog_roll_container_1_border_style',
                'dp_blog_roll_container_1_border_top',
                'dp_blog_roll_container_1_border_right',
                'dp_blog_roll_container_1_border_bottom',
                'dp_blog_roll_container_1_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_container_1_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-1').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-1').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-1').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-1').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_container_1_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_container_1_shadow_presets' )() ) - 1;
                $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                    'dp_blog_roll_container_1_shadow_horizontal',
                    'dp_blog_roll_container_1_shadow_vertical',
                    'dp_blog_roll_container_1_shadow_blur_radius',
                    'dp_blog_roll_container_1_shadow_spread_radius',
                    'dp_blog_roll_container_1_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-1' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_shadow_horizontal',
                'dp_blog_roll_container_1_shadow_vertical',
                'dp_blog_roll_container_1_shadow_blur_radius',
                'dp_blog_roll_container_1_shadow_spread_radius',
                'dp_blog_roll_container_1_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_shadow_horizontal',
                'dp_blog_roll_container_1_shadow_vertical',
                'dp_blog_roll_container_1_shadow_blur_radius',
                'dp_blog_roll_container_1_shadow_spread_radius',
                'dp_blog_roll_container_1_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_shadow_horizontal',
                'dp_blog_roll_container_1_shadow_vertical',
                'dp_blog_roll_container_1_shadow_blur_radius',
                'dp_blog_roll_container_1_shadow_spread_radius',
                'dp_blog_roll_container_1_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_shadow_horizontal',
                'dp_blog_roll_container_1_shadow_vertical',
                'dp_blog_roll_container_1_shadow_blur_radius',
                'dp_blog_roll_container_1_shadow_spread_radius',
                'dp_blog_roll_container_1_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-1',
                'dp_blog_roll_container_1_shadow_horizontal',
                'dp_blog_roll_container_1_shadow_vertical',
                'dp_blog_roll_container_1_shadow_blur_radius',
                'dp_blog_roll_container_1_shadow_spread_radius',
                'dp_blog_roll_container_1_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_1_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_blog_roll_container_1' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-1', 'dp_primary_sidebar_widgets_title' );
        } );
    } );


    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Container 2
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_blog_roll_container_2_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_2_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_border_color',
                'dp_blog_roll_container_2_border_style',
                'dp_blog_roll_container_2_border_top',
                'dp_blog_roll_container_2_border_right',
                'dp_blog_roll_container_2_border_bottom',
                'dp_blog_roll_container_2_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_container_2_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-2').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-2').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-2').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-2').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_container_2_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_container_2_shadow_presets' )() ) - 1;
                $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                    'dp_blog_roll_container_2_shadow_horizontal',
                    'dp_blog_roll_container_2_shadow_vertical',
                    'dp_blog_roll_container_2_shadow_blur_radius',
                    'dp_blog_roll_container_2_shadow_spread_radius',
                    'dp_blog_roll_container_2_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-2' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_shadow_horizontal',
                'dp_blog_roll_container_2_shadow_vertical',
                'dp_blog_roll_container_2_shadow_blur_radius',
                'dp_blog_roll_container_2_shadow_spread_radius',
                'dp_blog_roll_container_2_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_shadow_horizontal',
                'dp_blog_roll_container_2_shadow_vertical',
                'dp_blog_roll_container_2_shadow_blur_radius',
                'dp_blog_roll_container_2_shadow_spread_radius',
                'dp_blog_roll_container_2_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_shadow_horizontal',
                'dp_blog_roll_container_2_shadow_vertical',
                'dp_blog_roll_container_2_shadow_blur_radius',
                'dp_blog_roll_container_2_shadow_spread_radius',
                'dp_blog_roll_container_2_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_shadow_horizontal',
                'dp_blog_roll_container_2_shadow_vertical',
                'dp_blog_roll_container_2_shadow_blur_radius',
                'dp_blog_roll_container_2_shadow_spread_radius',
                'dp_blog_roll_container_2_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-2',
                'dp_blog_roll_container_2_shadow_horizontal',
                'dp_blog_roll_container_2_shadow_vertical',
                'dp_blog_roll_container_2_shadow_blur_radius',
                'dp_blog_roll_container_2_shadow_spread_radius',
                'dp_blog_roll_container_2_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_2_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_blog_roll_container_2' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-2', 'dp_primary_sidebar_widgets_title' );
        } );
    } );





    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Container 3
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_blog_roll_container_3_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_3_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_border_color',
                'dp_blog_roll_container_3_border_style',
                'dp_blog_roll_container_3_border_top',
                'dp_blog_roll_container_3_border_right',
                'dp_blog_roll_container_3_border_bottom',
                'dp_blog_roll_container_3_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_container_3_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-3').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-3').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-3').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-container-3').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_container_3_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_container_3_shadow_presets' )() ) - 1;
                $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                    'dp_blog_roll_container_3_shadow_horizontal',
                    'dp_blog_roll_container_3_shadow_vertical',
                    'dp_blog_roll_container_3_shadow_blur_radius',
                    'dp_blog_roll_container_3_shadow_spread_radius',
                    'dp_blog_roll_container_3_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-container-3' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_shadow_horizontal',
                'dp_blog_roll_container_3_shadow_vertical',
                'dp_blog_roll_container_3_shadow_blur_radius',
                'dp_blog_roll_container_3_shadow_spread_radius',
                'dp_blog_roll_container_3_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_shadow_horizontal',
                'dp_blog_roll_container_3_shadow_vertical',
                'dp_blog_roll_container_3_shadow_blur_radius',
                'dp_blog_roll_container_3_shadow_spread_radius',
                'dp_blog_roll_container_3_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_shadow_horizontal',
                'dp_blog_roll_container_3_shadow_vertical',
                'dp_blog_roll_container_3_shadow_blur_radius',
                'dp_blog_roll_container_3_shadow_spread_radius',
                'dp_blog_roll_container_3_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_shadow_horizontal',
                'dp_blog_roll_container_3_shadow_vertical',
                'dp_blog_roll_container_3_shadow_blur_radius',
                'dp_blog_roll_container_3_shadow_spread_radius',
                'dp_blog_roll_container_3_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-container-3',
                'dp_blog_roll_container_3_shadow_horizontal',
                'dp_blog_roll_container_3_shadow_vertical',
                'dp_blog_roll_container_3_shadow_blur_radius',
                'dp_blog_roll_container_3_shadow_spread_radius',
                'dp_blog_roll_container_3_shadow_opacity',
                '0'
            );
        } );
    } );




    wp.customize( 'dp_blog_roll_container_3_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_blog_roll_container_3' );
        } );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-container-3', 'dp_primary_sidebar_widgets_title' );
        } );
    } );




    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Title
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_blog_roll_title_location_inside_image_vertical', function( value ) {
        value.bind( function( newval ) {

            if ( newval == 'top' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-title-wrap' ).css( { 'top': '0', 'bottom': 'initial' } );
            } else if ( newval == 'middle' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-title-wrap' ).css( { 'top': '40%', 'bottom': 'initial' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-title-wrap' ).css( { 'top': 'initial', 'bottom': '0' } );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_title_location_inside_image_horizontal', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-title-wrap' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title h2' ).css( 'text-align', newval );
        } );
    } );


    wp.customize( 'dp_blog_roll_title_width', function( value ) {
        value.bind( function( newval ) {

            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'display', newval );


        } );
    } );

    wp.customize( 'dp_blog_roll_title_height_auto', function( value ) {
        value.bind( function( newval ) {

        	if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'height', 'auto' );
			} else {
                var height =  wp.customize.value( 'dp_blog_roll_title_height' )();
                $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'height', height + 'px' );
			}

        } );
    } );

    wp.customize( 'dp_blog_roll_title_height', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'height', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title h2' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title h2' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title h2' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_blog_roll_title_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_title_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_margin_right', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.dp-blog-roll-loop-title h1' ).css( 'margin-right', newval + 'px' );

            var header_width = wp.customize.value( 'dp_blog_roll_title_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_title_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_title_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-title' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-right': newval + 'px' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-title' ).css( { 'width':'auto', 'margin-right': newval + 'px' } );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_title_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-title' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_margin_left', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.dp-blog-roll-loop-title h1' ).css( 'margin-left', newval + 'px' );

            var header_width = wp.customize.value( 'dp_blog_roll_title_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_title_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_title_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-title' ).css( { 'width':'calc(100% - ' + margin + 'px)', 'margin-left': newval + 'px' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-title' ).css( { 'width':'auto', 'margin-left': newval + 'px' } );
            }
        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-title',
                'dp_blog_roll_title_border_color',
                'dp_blog_roll_title_border_style',
                'dp_blog_roll_title_border_top',
                'dp_blog_roll_title_border_right',
                'dp_blog_roll_title_border_bottom',
                'dp_blog_roll_title_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_title_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-title').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-title').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-title').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_title_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-title').css('border-bottom-left-radius', newval + 'px');
        } );
    } );


    //
    // wp.customize( 'dp_blog_roll_title_shadow_style', function( value ) {
    //     value.bind( function( newval ) {
    //
		// 	/* Remove shadow from primary menu */
    //         if ( newval == 'none' ) {
    //             $.stylesheet( '.dp-blog-roll-loop-title h1' ).css( 'box-shadow', 'none' );
    //
		// 		/* Apply shadow presets to primary menu */
    //         } else if ( newval == 'presets' ) {
    //             var preset = parseInt( wp.customize.value( 'dp_blog_roll_title_shadow_presets' )() ) - 1;
    //             $.stylesheet( '.dp-blog-roll-loop-title h1' ).css( 'box-shadow', dpShadows[preset] );
    //
		// 		/* Apply custom shadow to primary menu */
    //         } else if ( newval == 'custom' ) {
    //             dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //                 'dp_blog_roll_title_shadow_horizontal',
    //                 'dp_blog_roll_title_shadow_vertical',
    //                 'dp_blog_roll_title_shadow_blur_radius',
    //                 'dp_blog_roll_title_shadow_spread_radius',
    //                 'dp_blog_roll_title_shadow_opacity',
    //                 '0'
    //             );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_presets', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-title h1' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_horizontal', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //             'dp_blog_roll_title_shadow_horizontal',
    //             'dp_blog_roll_title_shadow_vertical',
    //             'dp_blog_roll_title_shadow_blur_radius',
    //             'dp_blog_roll_title_shadow_spread_radius',
    //             'dp_blog_roll_title_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_vertical', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //             'dp_blog_roll_title_shadow_horizontal',
    //             'dp_blog_roll_title_shadow_vertical',
    //             'dp_blog_roll_title_shadow_blur_radius',
    //             'dp_blog_roll_title_shadow_spread_radius',
    //             'dp_blog_roll_title_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_blur_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //             'dp_blog_roll_title_shadow_horizontal',
    //             'dp_blog_roll_title_shadow_vertical',
    //             'dp_blog_roll_title_shadow_blur_radius',
    //             'dp_blog_roll_title_shadow_spread_radius',
    //             'dp_blog_roll_title_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_spread_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //             'dp_blog_roll_title_shadow_horizontal',
    //             'dp_blog_roll_title_shadow_vertical',
    //             'dp_blog_roll_title_shadow_blur_radius',
    //             'dp_blog_roll_title_shadow_spread_radius',
    //             'dp_blog_roll_title_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_title_shadow_opacity', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-title h1',
    //             'dp_blog_roll_title_shadow_horizontal',
    //             'dp_blog_roll_title_shadow_vertical',
    //             'dp_blog_roll_title_shadow_blur_radius',
    //             'dp_blog_roll_title_shadow_spread_radius',
    //             'dp_blog_roll_title_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );




    wp.customize( 'dp_blog_roll_title_color_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_color2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_shade_strenght', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_style', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_advanced_toggle', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_position_parameter1', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_position_parameter2', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_blog_roll_title' );
        } );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_reverse_color', function( value ) {
        value.bind( function( newval ) {
            apply_bg_no_img( '.dp-blog-roll-loop-title', 'dp_primary_sidebar_widgets_title' );
        } );
    } );





    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Featured Image
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    // wp.customize( 'dp_blog_roll_featured_image_max_height', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'max-height', newval + 'px' );
    //     } );
    // } );



    wp.customize( 'dp_blog_roll_featured_image_width_100', function( value ) {
        value.bind( function( newval ) {

            if ( newval == true ) {
                var width_calc = '100%';
                var float = 'none';
                var width = 'auto';
            } else {
                var width_calc = wp.customize.value( 'dp_blog_roll_featured_image_width' )() + 'px';
                var float = 'left';
                var width = width_calc;
            }
            var ratio = wp.customize.value( 'dp_blog_roll_featured_image_aspect_ratio' )();
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( { 'padding-bottom': 'calc(' + width_calc + ' * ' + ratio + ')', 'width': width, 'float': float } );

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_width', function( value ) {
        value.bind( function( newval ) {

			var ratio = wp.customize.value( 'dp_blog_roll_featured_image_aspect_ratio' )();
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( { 'padding-bottom': 'calc(' + newval + 'px * ' + ratio + ')', 'width': newval + 'px'  } );

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_aspect_ratio', function( value ) {
        value.bind( function( newval ) {


            if ( wp.customize.value( 'dp_blog_roll_featured_image_width_100' )() == true ) {
                var width_calc = '100%';
                var float = 'none';
                var width = 'auto';
            } else {
                var width_calc = wp.customize.value( 'dp_blog_roll_featured_image_width' )() + 'px';
                var float = 'left';
                var width = width_calc;
            }

            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( { 'padding-bottom': 'calc(' + width_calc + ' * ' + newval + ')', 'width': width, 'float': float  } );

        } );
    } );

    // wp.customize( 'dp_blog_roll_featured_image_height_auto', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         if ( newval == true ) {
    //             $.stylesheet( '.dp-blog-roll-loop-featured-image img' ).css( 'height', 'auto' );
    //         } else {
    //             var height =  wp.customize.value( 'dp_blog_roll_featured_image_height' )();
    //             $.stylesheet( '.dp-blog-roll-loop-featured-image img' ).css( 'height', height + 'px' );
    //         }
    //
    //     } );
    // } );

    // wp.customize( 'dp_blog_roll_featured_image_height', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-featured-image img' ).css( 'height', newval + 'px' );
    //     } );
    // } );




    wp.customize( 'dp_blog_roll_featured_image_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_featured_image_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_border_color',
                'dp_blog_roll_featured_image_border_style',
                'dp_blog_roll_featured_image_border_top',
                'dp_blog_roll_featured_image_border_right',
                'dp_blog_roll_featured_image_border_bottom',
                'dp_blog_roll_featured_image_border_left'
            )

        } );
    } );



    wp.customize( 'dp_blog_roll_featured_image_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-featured-image').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-featured-image').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-featured-image').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-featured-image').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    wp.customize( 'dp_blog_roll_featured_image_shadow_style', function( value ) {
        value.bind( function( newval ) {

			/* Remove shadow from primary menu */
            if ( newval == 'none' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'box-shadow', 'none' );

				/* Apply shadow presets to primary menu */
            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_blog_roll_featured_image_shadow_presets' )() ) - 1;
                $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'box-shadow', dpShadows[preset] );

				/* Apply custom shadow to primary menu */
            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                    'dp_blog_roll_featured_image_shadow_horizontal',
                    'dp_blog_roll_featured_image_shadow_vertical',
                    'dp_blog_roll_featured_image_shadow_blur_radius',
                    'dp_blog_roll_featured_image_shadow_spread_radius',
                    'dp_blog_roll_featured_image_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-featured-image' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_shadow_horizontal',
                'dp_blog_roll_featured_image_shadow_vertical',
                'dp_blog_roll_featured_image_shadow_blur_radius',
                'dp_blog_roll_featured_image_shadow_spread_radius',
                'dp_blog_roll_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_shadow_horizontal',
                'dp_blog_roll_featured_image_shadow_vertical',
                'dp_blog_roll_featured_image_shadow_blur_radius',
                'dp_blog_roll_featured_image_shadow_spread_radius',
                'dp_blog_roll_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_shadow_horizontal',
                'dp_blog_roll_featured_image_shadow_vertical',
                'dp_blog_roll_featured_image_shadow_blur_radius',
                'dp_blog_roll_featured_image_shadow_spread_radius',
                'dp_blog_roll_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_shadow_horizontal',
                'dp_blog_roll_featured_image_shadow_vertical',
                'dp_blog_roll_featured_image_shadow_blur_radius',
                'dp_blog_roll_featured_image_shadow_spread_radius',
                'dp_blog_roll_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.dp-blog-roll-loop-featured-image',
                'dp_blog_roll_featured_image_shadow_horizontal',
                'dp_blog_roll_featured_image_shadow_vertical',
                'dp_blog_roll_featured_image_shadow_blur_radius',
                'dp_blog_roll_featured_image_shadow_spread_radius',
                'dp_blog_roll_featured_image_shadow_opacity',
                '0'
            );
        } );
    } );



    //
    // wp.customize( 'dp_blog_roll_featured_image_color_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_color2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_shade_strenght', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_advanced_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_position_parameter1', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_position_parameter2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_blog_roll_featured_image' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_reverse_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-featured-image', 'dp_primary_sidebar_widgets_title' );
    //     } );
    // } );



    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Excerpt
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_blog_roll_excerpt_display', function( value ) {
        value.bind( function( newval ) {

            if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'display', 'none' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'display', 'block' );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_width', function( value ) {
        value.bind( function( newval ) {

            if ( newval == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_excerpt_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_excerpt_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'width', 'calc(100% - ' + margin + 'px)' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'width', 'auto' );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_height_auto', function( value ) {
        value.bind( function( newval ) {

            if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-excerpt' ).css( 'height', 'auto' );
            } else {
                var height =  wp.customize.value( 'dp_blog_roll_excerpt_height' )();
                $.stylesheet( '.dp-blog-roll-loop-excerpt' ).css( 'height', height + 'px' );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_height', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt' ).css( 'height', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap, .dp-blog-roll-loop-excerpt-wrap a:hover' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_link_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap a' ).css( 'color', newval );
        } );
    } );

    // wp.customize( 'dp_blog_roll_excerpt_link_hover_color', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap a:hover' ).css( 'color', newval );
    //     } );
    // } );


    wp.customize( 'dp_blog_roll_excerpt_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_excerpt_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_excerpt_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'margin-left', newval + 'px' );
        } );
    } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_style', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_top', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_right', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_bottom', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_left', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_color', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_border_color',
    //             'dp_blog_roll_excerpt_border_style',
    //             'dp_blog_roll_excerpt_border_top',
    //             'dp_blog_roll_excerpt_border_right',
    //             'dp_blog_roll_excerpt_border_bottom',
    //             'dp_blog_roll_excerpt_border_left'
    //         )
    //
    //     } );
    // } );
    //
    //
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_radius_top_left', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-excerpt-wrap').css('border-top-left-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_radius_top_right', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-excerpt-wrap').css('border-top-right-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_radius_bottom_right', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-excerpt-wrap').css('border-bottom-right-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_border_radius_bottom_left', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-excerpt-wrap').css('border-bottom-left-radius', newval + 'px');
    //     } );
    // } );
    //
    //
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_style', function( value ) {
    //     value.bind( function( newval ) {
    //
		// 	/* Remove shadow from primary menu */
    //         if ( newval == 'none' ) {
    //             $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'box-shadow', 'none' );
    //
		// 		/* Apply shadow presets to primary menu */
    //         } else if ( newval == 'presets' ) {
    //             var preset = parseInt( wp.customize.value( 'dp_blog_roll_excerpt_shadow_presets' )() ) - 1;
    //             $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'box-shadow', dpShadows[preset] );
    //
		// 		/* Apply custom shadow to primary menu */
    //         } else if ( newval == 'custom' ) {
    //             dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //                 'dp_blog_roll_excerpt_shadow_horizontal',
    //                 'dp_blog_roll_excerpt_shadow_vertical',
    //                 'dp_blog_roll_excerpt_shadow_blur_radius',
    //                 'dp_blog_roll_excerpt_shadow_spread_radius',
    //                 'dp_blog_roll_excerpt_shadow_opacity',
    //                 '0'
    //             );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_presets', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-excerpt-wrap' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_horizontal', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_shadow_horizontal',
    //             'dp_blog_roll_excerpt_shadow_vertical',
    //             'dp_blog_roll_excerpt_shadow_blur_radius',
    //             'dp_blog_roll_excerpt_shadow_spread_radius',
    //             'dp_blog_roll_excerpt_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_vertical', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_shadow_horizontal',
    //             'dp_blog_roll_excerpt_shadow_vertical',
    //             'dp_blog_roll_excerpt_shadow_blur_radius',
    //             'dp_blog_roll_excerpt_shadow_spread_radius',
    //             'dp_blog_roll_excerpt_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_blur_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_shadow_horizontal',
    //             'dp_blog_roll_excerpt_shadow_vertical',
    //             'dp_blog_roll_excerpt_shadow_blur_radius',
    //             'dp_blog_roll_excerpt_shadow_spread_radius',
    //             'dp_blog_roll_excerpt_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_spread_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_shadow_horizontal',
    //             'dp_blog_roll_excerpt_shadow_vertical',
    //             'dp_blog_roll_excerpt_shadow_blur_radius',
    //             'dp_blog_roll_excerpt_shadow_spread_radius',
    //             'dp_blog_roll_excerpt_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shadow_opacity', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-excerpt-wrap',
    //             'dp_blog_roll_excerpt_shadow_horizontal',
    //             'dp_blog_roll_excerpt_shadow_vertical',
    //             'dp_blog_roll_excerpt_shadow_blur_radius',
    //             'dp_blog_roll_excerpt_shadow_spread_radius',
    //             'dp_blog_roll_excerpt_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    //
    //
    //
    // wp.customize( 'dp_blog_roll_excerpt_color_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_color2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_shade_strenght', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_gradient_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_gradient_advanced_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_gradient_position_parameter1', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_gradient_position_parameter2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_blog_roll_excerpt' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_excerpt_gradient_reverse_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-excerpt-wrap', 'dp_primary_sidebar_widgets_title' );
    //     } );
    // } );




    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Title Meta
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_blog_roll_meta_show_date', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-meta .entry-time' ).css( 'display','inline' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-meta .entry-time' ).css( 'display','none' );
            }
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_show_author', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-meta .byline' ).css( 'display','inline' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-meta .byline' ).css( 'display','none' );
            }
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_show_comment_count', function( value ) {
        value.bind( function( newval ) {
            if ( newval == true ) {
                $.stylesheet( '.dp-blog-roll-loop-meta .entry-comments-link' ).css( 'display','inline' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-meta .entry-comments-link' ).css( 'display','none' );
            }
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_width', function( value ) {
        value.bind( function( newval ) {

            if ( newval == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_meta_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_meta_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'width', 'calc(100% - ' + margin + 'px)' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'width', 'auto' );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_meta_display', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'display', newval );
        } );
    } );


    wp.customize( 'dp_blog_roll_meta_float', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'float', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta, .dp-blog-roll-loop-meta a:hover' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_link_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta a' ).css( 'color', newval );
        } );
    } );

    // wp.customize( 'dp_blog_roll_meta_link_hover_color', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-meta a:hover' ).css( 'color', newval );
    //     } );
    // } );


    wp.customize( 'dp_blog_roll_meta_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_meta_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_meta_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    // wp.customize( 'dp_blog_roll_meta_border_style', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_top', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_right', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_bottom', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_left', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_color', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_border_color',
    //             'dp_blog_roll_meta_border_style',
    //             'dp_blog_roll_meta_border_top',
    //             'dp_blog_roll_meta_border_right',
    //             'dp_blog_roll_meta_border_bottom',
    //             'dp_blog_roll_meta_border_left'
    //         )
    //
    //     } );
    // } );



    // wp.customize( 'dp_blog_roll_meta_border_radius_top_left', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-meta').css('border-top-left-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_radius_top_right', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-meta').css('border-top-right-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_radius_bottom_right', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-meta').css('border-bottom-right-radius', newval + 'px');
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_radius_bottom_left', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet('.dp-blog-roll-loop-meta').css('border-bottom-left-radius', newval + 'px');
    //     } );
    // } );



    // wp.customize( 'dp_blog_roll_meta_shadow_style', function( value ) {
    //     value.bind( function( newval ) {
    //
		// 	/* Remove shadow from primary menu */
    //         if ( newval == 'none' ) {
    //             $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'box-shadow', 'none' );
    //
		// 		/* Apply shadow presets to primary menu */
    //         } else if ( newval == 'presets' ) {
    //             var preset = parseInt( wp.customize.value( 'dp_blog_roll_meta_shadow_presets' )() ) - 1;
    //             $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'box-shadow', dpShadows[preset] );
    //
		// 		/* Apply custom shadow to primary menu */
    //         } else if ( newval == 'custom' ) {
    //             dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //                 'dp_blog_roll_meta_shadow_horizontal',
    //                 'dp_blog_roll_meta_shadow_vertical',
    //                 'dp_blog_roll_meta_shadow_blur_radius',
    //                 'dp_blog_roll_meta_shadow_spread_radius',
    //                 'dp_blog_roll_meta_shadow_opacity',
    //                 '0'
    //             );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_presets', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_horizontal', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_shadow_horizontal',
    //             'dp_blog_roll_meta_shadow_vertical',
    //             'dp_blog_roll_meta_shadow_blur_radius',
    //             'dp_blog_roll_meta_shadow_spread_radius',
    //             'dp_blog_roll_meta_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_vertical', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_shadow_horizontal',
    //             'dp_blog_roll_meta_shadow_vertical',
    //             'dp_blog_roll_meta_shadow_blur_radius',
    //             'dp_blog_roll_meta_shadow_spread_radius',
    //             'dp_blog_roll_meta_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_blur_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_shadow_horizontal',
    //             'dp_blog_roll_meta_shadow_vertical',
    //             'dp_blog_roll_meta_shadow_blur_radius',
    //             'dp_blog_roll_meta_shadow_spread_radius',
    //             'dp_blog_roll_meta_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_spread_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_shadow_horizontal',
    //             'dp_blog_roll_meta_shadow_vertical',
    //             'dp_blog_roll_meta_shadow_blur_radius',
    //             'dp_blog_roll_meta_shadow_spread_radius',
    //             'dp_blog_roll_meta_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_opacity', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-meta',
    //             'dp_blog_roll_meta_shadow_horizontal',
    //             'dp_blog_roll_meta_shadow_vertical',
    //             'dp_blog_roll_meta_shadow_blur_radius',
    //             'dp_blog_roll_meta_shadow_spread_radius',
    //             'dp_blog_roll_meta_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );




    // wp.customize( 'dp_blog_roll_meta_color_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );

    wp.customize( 'dp_blog_roll_meta_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-meta' ).css( 'background', newval );
        } );
    } );

    // wp.customize( 'dp_blog_roll_meta_color2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shade_strenght', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_advanced_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_position_parameter1', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_position_parameter2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_blog_roll_meta' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_reverse_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-meta', 'dp_primary_sidebar_widgets_title' );
    //     } );
    // } );



    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Blog Roll Categories
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

    wp.customize( 'dp_blog_roll_category_location_inside_image_vertical', function( value ) {
        value.bind( function( newval ) {

            if ( newval == 'top' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( { 'top': '0', 'bottom': 'initial' } );
            } else if ( newval == 'middle' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( { 'top': '40%', 'bottom': 'initial' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( { 'top': 'initial', 'bottom': '0' } );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_category_location_inside_image_horizontal', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( 'text-align', newval );

            if ( newval == 'left' ) {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( { 'left': '0', 'right': 'initial' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories' ).css( { 'left': 'initial', 'right': '0' } );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_category_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'text-align', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_width', function( value ) {
        value.bind( function( newval ) {

            if ( newval == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'width', 'calc(100% - ' + margin + 'px)' );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'width', 'auto' );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_category_display', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'display', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_float', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'float', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories, .dp-blog-roll-loop-categories a, .dp-blog-roll-loop-categories a:hover' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_blog_roll_category_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_blog_roll_category_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_margin_right', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'margin-right', newval + 'px' );

            var header_width = wp.customize.value( 'dp_blog_roll_category_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( { 'margin-right': newval + 'px' } );
                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( { 'width':'calc(100% - ' + margin + 'px)' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( { 'margin-right': newval + 'px' } );
                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( { 'width':'auto' } );
            }

        } );
    } );

    wp.customize( 'dp_blog_roll_category_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_blog_roll_category_margin_left', function( value ) {
        value.bind( function( newval ) {
            //$.stylesheet( '.dp-blog-roll-loop-categories' ).css( 'margin-left', newval + 'px' );

            var header_width = wp.customize.value( 'dp_blog_roll_category_width' )();

            if ( header_width == '100%') {
                var margin_left =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_left' )() );
                var margin_right =  parseInt( wp.customize.value( 'dp_blog_roll_category_margin_right' )() );
                var margin = margin_left + margin_right;

                $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( { 'margin-left': newval + 'px' } );
                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( { 'width':'calc(100% - ' + margin + 'px)' } );
            } else {
                $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( { 'margin-left': newval + 'px' } );
                $.stylesheet( '.dp-blog-roll-loop-categories' ).css( { 'width':'auto' } );
            }
        } );
    } );

    // wp.customize( 'dp_blog_roll_category_border_style', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_border_top', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_border_right', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_border_bottom', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_border_left', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_border_color', function( value ) {
    //     value.bind( function( newval ) {
    //
    //         dpApplyBorder('.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_border_color',
    //             'dp_blog_roll_category_border_style',
    //             'dp_blog_roll_category_border_top',
    //             'dp_blog_roll_category_border_right',
    //             'dp_blog_roll_category_border_bottom',
    //             'dp_blog_roll_category_border_left'
    //         )
    //
    //     } );
    // } );



    wp.customize( 'dp_blog_roll_category_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-categories a').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_category_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-categories a').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_category_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-categories a').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_blog_roll_category_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-blog-roll-loop-categories a').css('border-bottom-left-radius', newval + 'px');
        } );
    } );



    // wp.customize( 'dp_blog_roll_category_shadow_style', function( value ) {
    //     value.bind( function( newval ) {
    //
		// 	/* Remove shadow from primary menu */
    //         if ( newval == 'none' ) {
    //             $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'box-shadow', 'none' );
    //
		// 		/* Apply shadow presets to primary menu */
    //         } else if ( newval == 'presets' ) {
    //             var preset = parseInt( wp.customize.value( 'dp_blog_roll_category_shadow_presets' )() ) - 1;
    //             $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'box-shadow', dpShadows[preset] );
    //
		// 		/* Apply custom shadow to primary menu */
    //         } else if ( newval == 'custom' ) {
    //             dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //                 'dp_blog_roll_category_shadow_horizontal',
    //                 'dp_blog_roll_category_shadow_vertical',
    //                 'dp_blog_roll_category_shadow_blur_radius',
    //                 'dp_blog_roll_category_shadow_spread_radius',
    //                 'dp_blog_roll_category_shadow_opacity',
    //                 '0'
    //             );
    //         }
    //
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_presets', function( value ) {
    //     value.bind( function( newval ) {
    //         $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_horizontal', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_shadow_horizontal',
    //             'dp_blog_roll_category_shadow_vertical',
    //             'dp_blog_roll_category_shadow_blur_radius',
    //             'dp_blog_roll_category_shadow_spread_radius',
    //             'dp_blog_roll_category_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_vertical', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_shadow_horizontal',
    //             'dp_blog_roll_category_shadow_vertical',
    //             'dp_blog_roll_category_shadow_blur_radius',
    //             'dp_blog_roll_category_shadow_spread_radius',
    //             'dp_blog_roll_category_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_blur_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_shadow_horizontal',
    //             'dp_blog_roll_category_shadow_vertical',
    //             'dp_blog_roll_category_shadow_blur_radius',
    //             'dp_blog_roll_category_shadow_spread_radius',
    //             'dp_blog_roll_category_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_spread_radius', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_shadow_horizontal',
    //             'dp_blog_roll_category_shadow_vertical',
    //             'dp_blog_roll_category_shadow_blur_radius',
    //             'dp_blog_roll_category_shadow_spread_radius',
    //             'dp_blog_roll_category_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shadow_opacity', function( value ) {
    //     value.bind( function( newval ) {
    //         dpBoxShadow ( '.dp-blog-roll-loop-categories a',
    //             'dp_blog_roll_category_shadow_horizontal',
    //             'dp_blog_roll_category_shadow_vertical',
    //             'dp_blog_roll_category_shadow_blur_radius',
    //             'dp_blog_roll_category_shadow_spread_radius',
    //             'dp_blog_roll_category_shadow_opacity',
    //             '0'
    //         );
    //     } );
    // } );



    //
    // wp.customize( 'dp_blog_roll_category_color_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );

    wp.customize( 'dp_blog_roll_category_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-blog-roll-loop-categories a' ).css( 'background', newval );
        } );
    } );

    // wp.customize( 'dp_blog_roll_category_color2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_shade_strenght', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_style', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_advanced_toggle', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_position_parameter1', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_position_parameter2', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_blog_roll_category' );
    //     } );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_reverse_color', function( value ) {
    //     value.bind( function( newval ) {
    //         apply_bg_no_img( '.dp-blog-roll-loop-categories a', 'dp_primary_sidebar_widgets_title' );
    //     } );
    // } );



    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section:  Pagination
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_pagination_text_align', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination' ).css( 'text-align', newval );
        } );
    } );



    wp.customize( 'dp_pagination_font_size', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li' ).css( 'font-size', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_font_weight', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li' ).css( 'font-weight', newval );
        } );
    } );

    wp.customize( 'dp_pagination_font_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li, .dp-pagination li a' ).css( 'color', newval );
        } );
    } );

    wp.customize( 'dp_pagination_font_color_active', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li a:hover, .dp-pagination li.active a' ).css( 'color', newval );
        } );
    } );


    wp.customize( 'dp_pagination_padding_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li a' ).css( 'padding-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_padding_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li a' ).css( 'padding-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_padding_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li a' ).css( 'padding-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_padding_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li a' ).css( 'padding-left', newval + 'px' );
        } );
    } );




    wp.customize( 'dp_pagination_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination' ).css( 'margin-top', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li' ).css( 'margin-right', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination' ).css( 'margin-bottom', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.dp-pagination li' ).css( 'margin-left', newval + 'px' );
        } );
    } );

    wp.customize( 'dp_pagination_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );

    wp.customize( 'dp_pagination_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );

    wp.customize( 'dp_pagination_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );

    wp.customize( 'dp_pagination_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );

    wp.customize( 'dp_pagination_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );

    wp.customize( 'dp_pagination_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.dp-pagination li a',
                'dp_pagination_border_color',
                'dp_pagination_border_style',
                'dp_pagination_border_top',
                'dp_pagination_border_right',
                'dp_pagination_border_bottom',
                'dp_pagination_border_left'
            )

        } );
    } );



    wp.customize( 'dp_pagination_border_radius_top_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li a').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_pagination_border_radius_top_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li	a').css('border-top-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_pagination_border_radius_bottom_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li a').css('border-bottom-right-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_pagination_border_radius_bottom_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li a').css('border-bottom-left-radius', newval + 'px');
        } );
    } );


    wp.customize( 'dp_pagination_color', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li a').css('background', newval );
        } );
    } );

    wp.customize( 'dp_pagination_color_active', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.dp-pagination li a:hover, .dp-pagination li.active a').css('background', newval );
        } );
    } );




    /**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section: Social Share
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */



    wp.customize( 'dp_social_share_display_name', function( value ) {
        value.bind( function( newval ) {

        	if ( newval == true ) {
        		var display = 'inline-block';
			} else {
                var display = 'none';
			}

            $.stylesheet( '.dp-social-media-share-text' ).css( 'display', display );
        } );
    } );

    wp.customize( 'dp_social_share_alignment', function( value ) {
        value.bind( function( newval ) {

        	if ( newval == 'full' ) {
        		//var padding =  '0';
        		var width = '100%';
        		var margin_left = '0px';
        		var margin_right = '0px';
			} else if ( newval == 'left' ) {
               	// if ( wp.customize.value( 'dp_social_share_space_between_buttons' )() == true ) {
                 //    var padding = '15px';
				// } else {
               	// 	var padding = '0';
				// }
                var width = '';
                var margin_left = '0px';
                var margin_right = 'auto';

			} else if ( newval == 'right' ) {
                var width = 'auto';
                var margin_left = 'auto';
                var margin_right = '0px';

			} else {
                var width = 'auto';
                var margin_left = 'auto';
                var margin_right = 'auto';
			}

            $.stylesheet( '.dp-social-media-share-wrap' ).css( {'width': width, 'margin-left': margin_left, 'margin-right': margin_right } );


        } );
    } );

    wp.customize( 'dp_social_share_space_between_buttons', function( value ) {
        value.bind( function( newval ) {

        	if ( newval == true ) {
        		var padding = '5px';

			} else {
                var padding = '0';
			}

            $.stylesheet( '.dp-social-media-share-button' ).css( { 'padding-left': padding, 'padding-right': padding } );
        } );
    } );

 		/**
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Section: WooCommerce Category
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     */

		wp.customize( 'dp_woocommerce_category_padding', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('padding', newval + 'px');
        } );
    } );
	
		wp.customize( 'dp_woocommerce_category_margin_top', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('margin-top', newval + 'px');
        } );
    } );

		wp.customize( 'dp_woocommerce_category_margin_right', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('margin-right', newval + 'px');
        } );
    } );

		wp.customize( 'dp_woocommerce_category_margin_bottom', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('margin-bottom', newval + 'px');
        } );
    } );

		wp.customize( 'dp_woocommerce_category_margin_left', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('margin-left', newval + 'px');
        } );
    } );


	wp.customize( 'dp_woocommerce_category_shadow_style', function( value ) {
        value.bind( function( newval ) {


            if ( newval == 'none' ) {
                $.stylesheet( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' ).css( 'box-shadow', 'none' );


            } else if ( newval == 'presets' ) {
                var preset = parseInt( wp.customize.value( 'dp_woocommerce_category_shadow_presets' )() ) - 1;
                $.stylesheet( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' ).css( 'box-shadow', dpShadows[preset] );


            } else if ( newval == 'custom' ) {
                dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                    'dp_woocommerce_category_shadow_horizontal',
                    'dp_woocommerce_category_shadow_vertical',
                    'dp_woocommerce_category_shadow_blur_radius',
                    'dp_woocommerce_category_shadow_spread_radius',
                    'dp_woocommerce_category_shadow_opacity',
                    '0'
                );
            }

        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_presets', function( value ) {
        value.bind( function( newval ) {
            $.stylesheet( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product' ).css( 'box-shadow', dpShadows[parseInt(newval) - 1] );
        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_horizontal', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_shadow_horizontal',
                'dp_woocommerce_category_shadow_vertical',
                'dp_woocommerce_category_shadow_blur_radius',
                'dp_woocommerce_category_shadow_spread_radius',
                'dp_woocommerce_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_vertical', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_shadow_horizontal',
                'dp_woocommerce_category_shadow_vertical',
                'dp_woocommerce_category_shadow_blur_radius',
                'dp_woocommerce_category_shadow_spread_radius',
                'dp_woocommerce_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_blur_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_shadow_horizontal',
                'dp_woocommerce_category_shadow_vertical',
                'dp_woocommerce_category_shadow_blur_radius',
                'dp_woocommerce_category_shadow_spread_radius',
                'dp_woocommerce_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_spread_radius', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_shadow_horizontal',
                'dp_woocommerce_category_shadow_vertical',
                'dp_woocommerce_category_shadow_blur_radius',
                'dp_woocommerce_category_shadow_spread_radius',
                'dp_woocommerce_category_shadow_opacity',
                '0'
            );
        } );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_opacity', function( value ) {
        value.bind( function( newval ) {
            dpBoxShadow ( '.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_shadow_horizontal',
                'dp_woocommerce_category_shadow_vertical',
                'dp_woocommerce_category_shadow_blur_radius',
                'dp_woocommerce_category_shadow_spread_radius',
                'dp_woocommerce_category_shadow_opacity',
                '0'
            );
        } );
    } );
	
	wp.customize( 'dp_woocommerce_category_border_style', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_woocommerce_category_border_top', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            );
					
					 $.stylesheet('.woocommerce ul.products li.product .onsale').css('top', '-' + newval + 'px');

        } );
    } );

    wp.customize( 'dp_woocommerce_category_border_right', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_woocommerce_category_border_bottom', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            )

        } );
    } );

    wp.customize( 'dp_woocommerce_category_border_left', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            );
					
					$.stylesheet('.woocommerce ul.products li.product .onsale').css('left', '-' + newval + 'px');

        } );
    } );

    wp.customize( 'dp_woocommerce_category_border_color', function( value ) {
        value.bind( function( newval ) {

            dpApplyBorder('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product',
                'dp_woocommerce_category_border_color',
                'dp_woocommerce_category_border_style',
                'dp_woocommerce_category_border_top',
                'dp_woocommerce_category_border_right',
                'dp_woocommerce_category_border_bottom',
                'dp_woocommerce_category_border_left'
            )

        } );
    } );



    wp.customize( 'dp_woocommerce_category_border_radius', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('border-radius', newval + 'px');
					$.stylesheet('.woocommerce ul.products li.product .onsale').css('border-top-left-radius', newval + 'px');
        } );
    } );

    wp.customize( 'dp_woocommerce_category_color', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce ul.products li.product, .woocommerce-page ul.products li.product').css('background', newval );
        } );
    } );

	
	 wp.customize( 'dp_woocommerce_category_sale_bg_color', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce span.onsale').css('background', newval );
        } );
    } );

	 wp.customize( 'dp_woocommerce_category_sale_font_color', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce span.onsale').css('color', newval );
        } );
    } );

	 wp.customize( 'dp_woocommerce_category_cart_bg_color', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button').css('background', newval );
        } );
    } );

	 wp.customize( 'dp_woocommerce_category_cart_font_color', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button').css('color', newval );
        } );
    } );

	 wp.customize( 'dp_woocommerce_category_product_font_size', function( value ) {
        value.bind( function( newval ) {
          $.stylesheet('.woocommerce div.product .product_title').css('font-size', newval + 'px' );
        } );
    } );

	 wp.customize( 'dp_primary_menu_home_font_uppercase', function( value ) {
        value.bind( function( newval ) {
					if(newval == true) {
						var text_transform = 'uppercase';
					} else {
						var text_transform = 'none';
					}
          $.stylesheet('.nav-primary .disruptpress-nav-menu > li').css('text-transform', text_transform );
        } );
    } );

	 wp.customize( 'dp_primary_menu_logo_title_uppercase', function( value ) {
        value.bind( function( newval ) {
					if(newval == true) {
						var text_transform = 'uppercase';
					} else {
						var text_transform = 'none';
					}
          $.stylesheet('.nav-primary .site-title').css('text-transform', text_transform );
        } );
    } );

	 wp.customize( 'dp_primary_menu_logo_tagline_uppercase', function( value ) {
        value.bind( function( newval ) {
					if(newval == true) {
						var text_transform = 'uppercase';
					} else {
						var text_transform = 'none';
					}
          $.stylesheet('.nav-primary .site-description').css('text-transform', text_transform );
        } );
    } );
	
	 wp.customize( 'dp_header_logo_title_uppercase', function( value ) {
        value.bind( function( newval ) {
					if(newval == true) {
						var text_transform = 'uppercase';
					} else {
						var text_transform = 'none';
					}
          $.stylesheet('.site-header .site-title').css('text-transform', text_transform );
        } );
    } );

	 wp.customize( 'dp_header_logo_tagline_uppercase', function( value ) {
        value.bind( function( newval ) {
					if(newval == true) {
						var text_transform = 'uppercase';
					} else {
						var text_transform = 'none';
					}
          $.stylesheet('.site-header .site-description').css('text-transform', text_transform );
        } );
    } );

	
 

} )( jQuery );

