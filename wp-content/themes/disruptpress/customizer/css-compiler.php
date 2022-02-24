<?PHP
/**
 * Web Safe Fonts
 */
function dp_hover_shadows() {
	return array(
	'none',
	'inset 0px 2px 5px 0px #000000;',
	'inset 0px 2px 10px 1px #000000',
	'inset 0px 0px 20px 5px rgba(0,0,0,0.75)',
	);
}

function dp_font_style() {
	
	return array(

		"",
		
		"text-shadow: 3px 3px 0px rgba(0,0,0,0.2);",

		"text-shadow: 4px 3px 0px #fff, 5px 4px 0px rgba(0,0,0,0.15);",

		"text-shadow: 0 1px 0 #fff,
		0 2px 0 #fff,
		0 3px 0 #fff,
		0 4px 0 #aaa,
		0 5px 0 #bbb,
		0 6px 1px rgba(0,0,0,.1),
		0 0 5px rgba(0,0,0,.1),
		0 1px 3px rgba(0,0,0,.3),
		0 3px 5px rgba(0,0,0,.2),
		0 5px 10px rgba(0,0,0,.0),
		0 10px 10px rgba(0,0,0,.0),
		0 20px 20px rgba(0,0,0,.0);",

		"text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
		0px 8px 13px rgba(0,0,0,0.1),
		0px 18px 23px rgba(0,0,0,0.1);",

		"text-shadow: 3px 3px 0px #2c2e38, 5px 5px 0px #5c5f72;",

		"background-color: #5a5a5a;
		-webkit-background-clip: text;
		-moz-background-clip: text;
		background-clip: text;
		color: transparent;
		text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;",

		"text-shadow: 2px 8px 6px rgba(0,0,0,0.2),
		0px 1px 15px rgba(255,255,255,0.3);",

		"text-shadow: -1px -1px 0px rgba(255,255,255,0.1), 2px 2px 0px rgba(0,0,0,0.8);",

		"text-shadow: 0px 1px 0px #FFF, 0px 2px 0px #FFF, 0px 3px 0px #EEE, 0px 4px 0px #DDD, 0px 5px 0px #DDD, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;"

	);
}

function dp_rgb2hex($rgb) {
	
	if (strpos($rgb, '#') !== false) {
		return $rgb;
	}
	
	$array = array('rgba', 'rgb', '(',')');
	$rgb = explode(',', str_replace($array, '', $rgb));

	$hex = "#";
	$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	return $hex; // returns the hex value including the number sign (#)
}

function shading($color, $percent) {
	//Percentage input between -1.00 and 1.00
	$color = str_replace("#", "", $color);
	
	$t=$percent<0?0:255;
	$p=$percent<0?$percent*-1:$percent;
	
	$RGB = str_split($color, 2);
	$R=hexdec($RGB[0]);
	$G=hexdec($RGB[1]);
	$B=hexdec($RGB[2]);
	
	return '#'.substr(dechex(0x1000000+(round(($t-$R)*$p)+$R)*0x10000+(round(($t-$G)*$p)+$G)*0x100+(round(($t-$B)*$p)+$B)),1);
}


function bg_gradient ( $shape, $color1_rgba, $color2_rgba, $style_status, $img_status, $pattern_url, $img_url, $img_pos, $img_size, $img_repeat, $img_attach, $grad_pos1, $grad_pos2, $shade_percentage, $rev_colors, $advanced ) {
	
	$color1 = $color1_rgba;
	$color2 = $color2_rgba;
	$color1_hex = dp_rgb2hex( $color1 );
	
	if( $style_status == "2" ) {
		$color2 = shading( dp_rgb2hex( $color1 ), $shade_percentage );
	}
	
	if ( $rev_colors == "1" AND $advanced == "1" AND $style_status != "1" ) {
		$color1 = $color2_rgba;
		$color2 = $color1_rgba;
		
		if( $style_status == "2" ) {
			$color1 = shading(dp_rgb2hex( $color2 ), $shade_percentage );
		}
	}

	if( $advanced == "0" ) {
		
		if( $shape == "5" OR $shape == "6" OR $shape == "7" OR $shape == "8" ) {
			$grad_per1 = 50;
			$grad_per2 = 50;
		} else {
			$grad_per1 = 0;
			$grad_per2 = 100;
		}
		
	} else {
		$grad_per1 = $grad_pos1;
		$grad_per2 = $grad_pos2;
	}
	
	if ( $img_status == "1" OR $img_url == '' ) {
 			$bg_img = '';
    } else if ( $img_status == "2" ){
		$bg_img = 'url('. get_stylesheet_directory_uri() .'/customizer/img/pattern/' . $pattern_url . ') repeat, ';
		$url_http_https = array( 'http:', 'https:');
		$bg_img = str_replace( $url_http_https, '', $bg_img );
		
	} else if ( $img_status == "3" ){
		$bg_img = 'url('. $img_url .') '. $img_pos .'/'. $img_size .' '. $img_repeat .' '. $img_attach .', ';
		$url_http_https = array( 'http:', 'https:');
		$bg_img = str_replace( $url_http_https, '', $bg_img );
	}
	
	//No Gradient
	if ( $shape == "0" ) {
		$output = 'background: '. $bg_img .' '. $color1 .';';
	}
	
	//Gradient Top to Bottom
	if ( $shape == "1" ) {
		$output = '
		background: '. $bg_img .' -o-linear-gradient('. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -moz-linear-gradient('. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -webkit-linear-gradient('. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' linear-gradient('. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		';
	}
	
	//Gradient Left to Right
	if ( $shape == "2" ) {
		$output = '
		background: '. $bg_img .' -o-linear-gradient(left, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -moz-linear-gradient(left, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -webkit-linear-gradient(left, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' linear-gradient(to right, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		';
	}
	
	//Gradient Diagonal Top Left to Bottom Right
	if ( $shape == "3" ) {
		$output = '
		background: '. $bg_img .' -o-linear-gradient(-45deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -moz-linear-gradient(-45deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -webkit-linear-gradient(-45deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' linear-gradient(135deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		';
	}
	
	//Gradient Diagonal Bottom Left to Top Right
	if ( $shape == "4" ) {
		$output = '
		background: '. $bg_img .' -o-linear-gradient(225deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -moz-linear-gradient(225deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' -webkit-linear-gradient(225deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		background: '. $bg_img .' linear-gradient(225deg, '. $color1 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%);
		';
	}
	
	//Gradient Top to Bottom Split-Mirrored
	if ( $shape == "5" ) {
		$output = '
		background: '. $bg_img .' -o-linear-gradient('. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -moz-linear-gradient('. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -webkit-linear-gradient('. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' linear-gradient('. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		';
	}
	
	//Gradient Left to Right Split-Mirrored
	if ( $shape == "6 ") {
		$output = '
		background: '. $bg_img .' -o-linear-gradient(left, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -moz-linear-gradient(left, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -webkit-linear-gradient(left, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' linear-gradient(to right, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		';
	}
	
	//Gradient Diagonal Top Left to Botton Right Split-Mirrored
	if ( $shape == "7" ) {
		$output = '
		//background: '. $bg_img .' -webkit-gradient(left top, right bottom, color-stop(0%, '. $color1 .', color-stop(100%, '. $color2 .')));
		background: '. $bg_img .' -o-linear-gradient(-45deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -moz-linear-gradient(-45deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -webkit-linear-gradient(-45deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' linear-gradient(135deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		';
	}
	
	//Gradient Diagonal Bottom Left to Top Right Split-Mirrored
	if ( $shape == "8" ) {
		$output = '
		//background: '. $bg_img .' -webkit-gradient(left top, right bottom, color-stop(0%, '. $color1 .', color-stop(100%, '. $color2 .')));
		background: '. $bg_img .' -o-linear-gradient(225deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -moz-linear-gradient(225deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' -webkit-linear-gradient(225deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		background: '. $bg_img .' linear-gradient(225deg, '. $color1 .' 0%, '. $color2 .' '. $grad_per1  .'%, '. $color2 .' '. $grad_per2  .'%, '. $color1 .' 100%);
		';
	}
	
	//Gradient Ellipse Cover Center
	if ( $shape == "9" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center center, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center center, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center center, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center center, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center center, ellipse cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Ellipse Contained Center
	if ( $shape == "10" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center center, ellipse contain, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center center, ellipse contain, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center center, ellipse contain, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center center, ellipse contain, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center center, ellipse contain, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Circle Cover Center
	if ( $shape == "11" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center center, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center center, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center center, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center center, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center center, circle cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Ellipse Cover Bottom
	if ( $shape == "12" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center bottom, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center bottom, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center bottom, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center bottom, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center bottom, ellipse cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Circle Cover Bottom
	if ( $shape == "13" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center bottom, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center bottom, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center bottom, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center bottom, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center bottom, circle cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Ellipse Cover Top
	if ( $shape == "14" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center top, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center top, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center top, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center top, ellipse cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center top, ellipse cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Circle Cover Top
	if ( $shape == "15" ) {	
		$output = '
		background: '. $bg_img .' -o-radial-gradient(center top, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -ms-radial-gradient(center top, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -moz-radial-gradient(center top, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' -webkit-radial-gradient(center top, circle cover, '. $color1 .', '. $color2 .');
		background: '. $bg_img .' radial-gradient(center top, circle cover, '. $color1 .', '. $color2 .');
		';
	}
	
	//Gradient Middle Split Style 1
	if ( $shape == "16" ) {	
		$output = '
			background: '. $bg_img .' -o-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0.1) .' 100%);
			background: '. $bg_img .' -moz-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0.1) .' 100%);
			background: '. $bg_img .' -webkit-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0.1) .' 100%);
			background: '. $bg_img .' linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0.1) .' 100%);
		';
	}
	
	//Gradient Middle Split Style 2
	if ( $shape == "17" ) {	
		$output = '
			background: '. $bg_img .' -o-linear-gradient('. shading($color1_hex, -0.1) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -moz-linear-gradient('. shading($color1_hex, 0.1) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -webkit-linear-gradient('. shading($color1_hex, 0.1) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' linear-gradient('. shading($color1_hex, 0.1) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
		';
	}
	
	//Gradient Middle Split Style 3
	if ( $shape == "18" ) {	
		$output = '
			background: '. $bg_img .' -o-linear-gradient('. shading($color1_hex, 0.2) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -moz-linear-gradient('. shading($color1_hex, 0.2) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -webkit-linear-gradient('. shading($color1_hex, 0.2) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' linear-gradient('. shading($color1_hex, 0.2) .' 0%, '. shading($color1_hex,0.20) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
		';
	}
	
	//Gradient Middle Split Style 4
	if ( $shape == "19" ) {	
		$output = '
			background: '. $bg_img .' -o-linear-gradient('. shading($color1_hex, 0.3) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -moz-linear-gradient('. shading($color1_hex, 0.3) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -webkit-linear-gradient('. shading($color1_hex, 0.3) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' linear-gradient('. shading($color1_hex, 0.3) .' 0%, '. shading($color1_hex, 0.1) .' 50%, '. shading($color1_hex, -0.2) .' 51%, '. shading($color1_hex, 0) .' 100%);
		';
	}
	
	//Gradient Middle Split Style 5
	if ( $shape == "20" ) {	
		$output = '
			background: '. $bg_img .' -o-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -moz-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' -webkit-linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
			background: '. $bg_img .' linear-gradient('. shading($color1_hex, 0) .' 0%, '. shading($color1_hex, 0.2) .' 50%, '. shading($color1_hex, 0) .' 51%, '. shading($color1_hex, 0) .' 100%);
		';
	}
	
	return $output;

}


//Theme Mod function with included default values
function dp_theme_mod( $name ) {
		global $disruptpress_theme_defaults;
    return get_theme_mod( $name, $disruptpress_theme_defaults[ $name ] );
}

// Decode Fonts
function dp_decode_fonts( $font ) {
	
	$output = html_entity_decode( $font );
	$output = str_replace( "+", " ", $output );
	
	return $output;
}


function disruptpress_create_css_file () {
	
	$time = time();
	set_theme_mod('dp_last_modified', $time);

	$url_http_https = array( 'http:', 'https:');
	//$dp_typography_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );

	$dp_site_layout = dp_theme_mod( 'dp_site_layout' );
	$dp_site_container_width = dp_theme_mod( 'dp_site_container_width' );
	$dp_site_container_wrap_padding_left_right = dp_theme_mod( 'dp_site_container_wrap_padding_left_right' );
	$dp_site_container_site_inner_padding_top = dp_theme_mod( 'dp_site_container_site_inner_padding_top' );

	if  ( $dp_site_layout  == '1' ) {
		$site_container_max_width = $dp_site_container_width.'px';
		$site_inner_max_width = $dp_site_container_width.'px';
		
	} elseif ( $dp_site_layout  == '2' ) {
		$site_container_max_width = '100%';
		$site_inner_max_width = $dp_site_container_width.'px';
		
	} elseif ( $dp_site_layout  == '3' ) {
		$site_container_max_width = '100%';
		$site_inner_max_width = '100%';
	}
	
	$dp_site_container_margin_top_bottom = dp_theme_mod( 'dp_site_container_margin_top_bottom' );
	$dp_site_container_margin_left_right = dp_theme_mod( 'dp_site_container_margin_left_right' );
	
	$dp_site_container_border_style = dp_theme_mod( 'dp_site_container_border_style' );
	$dp_site_container_border_width_left_right = dp_theme_mod( 'dp_site_container_border_width_left_right' );
	$dp_site_container_border_width_top_bottom = dp_theme_mod( 'dp_site_container_border_width_top_bottom' );
	$dp_site_container_border_color = dp_theme_mod( 'dp_site_container_border_color' );
	
	if ( $dp_site_container_border_style != 'none' ) {
		$site_container_border_style = '
			border-top: '.$dp_site_container_border_width_top_bottom.'px '.$dp_site_container_border_style.' '.$dp_site_container_border_color.';
			border-bottom: '.$dp_site_container_border_width_top_bottom.'px '.$dp_site_container_border_style.' '.$dp_site_container_border_color.';
			border-left: '.$dp_site_container_border_width_left_right.'px '.$dp_site_container_border_style.' '.$dp_site_container_border_color.';
			border-right: '.$dp_site_container_border_width_left_right.'px '.$dp_site_container_border_style.' '.$dp_site_container_border_color.';
	';
		
	} else {
		$site_container_border_style = 'border: none;';
	}
	
	$dp_site_container_box_shadow_blur_radius = dp_theme_mod( 'dp_site_container_box_shadow_blur_radius' );
	$dp_site_container_box_shadow_spread_radius = dp_theme_mod( 'dp_site_container_box_shadow_spread_radius' );
	$dp_site_container_box_shadow_opacity = dp_theme_mod( 'dp_site_container_box_shadow_opacity' );
	
	if ( $dp_site_container_box_shadow_blur_radius == '0' AND $dp_site_container_box_shadow_spread_radius == '0' ) {
		$site_container_box_shadow = 'box-shadow: none;';
	} else {
		$site_container_box_shadow = 'box-shadow: 0px 0px ' . $dp_site_container_box_shadow_blur_radius . 'px ' . $dp_site_container_box_shadow_spread_radius . 'px rgba(0, 0, 0, ' . $dp_site_container_box_shadow_opacity . ');';
	}
	
	$dp_site_container_border_radius_topleft = dp_theme_mod( 'dp_site_container_border_radius_topleft' );
	$dp_site_container_border_radius_topright = dp_theme_mod( 'dp_site_container_border_radius_topright' );
	$dp_site_container_border_radius_bottomright = dp_theme_mod( 'dp_site_container_border_radius_bottomright' );
	$dp_site_container_border_radius_bottomleft = dp_theme_mod( 'dp_site_container_border_radius_bottomleft' );
	
	if ( $dp_site_container_border_radius_topleft == '0' AND $dp_site_container_border_radius_topright == '0' AND $dp_site_container_border_radius_bottomright == '0' AND $dp_site_container_border_radius_bottomleft == '0') {
		$dp_site_container_border_radius = 'border-radius: 0;';
	} else {
		$dp_site_container_border_radius = 'border-radius: ' . $dp_site_container_border_radius_topleft . 'px ' . $dp_site_container_border_radius_topright . 'px ' . $dp_site_container_border_radius_bottomright . 'px ' . $dp_site_container_border_radius_bottomleft . 'px;';
	}
	
	//Site Container Background
	$dp_site_container_color_style = dp_theme_mod( 'dp_site_container_color_style' );
	$dp_site_container_color = dp_theme_mod( 'dp_site_container_color' );
	$dp_site_container_color2 = dp_theme_mod( 'dp_site_container_color2' );
	$dp_site_container_shade_strenght = dp_theme_mod( 'dp_site_container_shade_strenght' );
	$dp_site_container_gradient_style = dp_theme_mod( 'dp_site_container_gradient_style' );
	$dp_site_container_gradient_advanced_toggle = dp_theme_mod( 'dp_site_container_gradient_advanced_toggle' );
	$dp_site_container_gradient_position_parameter1 = dp_theme_mod( 'dp_site_container_gradient_position_parameter1' );
	$dp_site_container_gradient_position_parameter2 = dp_theme_mod( 'dp_site_container_gradient_position_parameter2' );
	$dp_site_container_gradient_reverse_color = dp_theme_mod( 'dp_site_container_gradient_reverse_color' );
	$dp_site_container_img_panel = dp_theme_mod( 'dp_site_container_img_panel' );
	$dp_site_container_pattern = dp_theme_mod( 'dp_site_container_pattern' );
	$dp_site_container_img_upload = dp_theme_mod( 'dp_site_container_img_upload' );
	$dp_site_container_img_repeat = dp_theme_mod( 'dp_site_container_img_repeat' );
	$dp_site_container_img_size = dp_theme_mod( 'dp_site_container_img_size' );
	$dp_site_container_img_attachment = dp_theme_mod( 'dp_site_container_img_attachment' );
	$dp_site_container_img_position = dp_theme_mod( 'dp_site_container_img_position' );
	
	if( $dp_site_container_color_style == "1" ) {
		$dp_site_container_shape = '0';
	} else {
		$dp_site_container_shape = $dp_site_container_gradient_style;
	}
	
	$dp_site_container_bg = bg_gradient (
		$dp_site_container_shape,
		$dp_site_container_color,
		$dp_site_container_color2,
		$dp_site_container_color_style,
		$dp_site_container_img_panel,
		$dp_site_container_pattern,
		$dp_site_container_img_upload,
		$dp_site_container_img_position,
		$dp_site_container_img_size,
		$dp_site_container_img_repeat,
		$dp_site_container_img_attachment,
		$dp_site_container_gradient_position_parameter1,
		$dp_site_container_gradient_position_parameter2,
		$dp_site_container_shade_strenght,
		$dp_site_container_gradient_reverse_color,
		$dp_site_container_gradient_advanced_toggle
	);
	
	//Body Background Colors
	$dp_bg_color_style = dp_theme_mod( 'dp_bg_color_style' );
	$dp_bg_color = dp_theme_mod( 'dp_bg_color' );
	$dp_bg_color2 = dp_theme_mod( 'dp_bg_color2' );
	$dp_bg_shade_strenght = dp_theme_mod( 'dp_bg_shade_strenght' );
	$dp_bg_gradient_style = dp_theme_mod( 'dp_bg_gradient_style' );
	$dp_bg_gradient_advanced_toggle = dp_theme_mod( 'dp_bg_gradient_advanced_toggle' );
	$dp_bg_gradient_position_parameter1 = dp_theme_mod( 'dp_bg_gradient_position_parameter1' );
	$dp_bg_gradient_position_parameter2 = dp_theme_mod( 'dp_bg_gradient_position_parameter2' );
	$dp_bg_gradient_reverse_color = dp_theme_mod( 'dp_bg_gradient_reverse_color' );
	$dp_bg_img_panel = dp_theme_mod( 'dp_bg_img_panel' );
	$dp_bg_pattern = dp_theme_mod( 'dp_bg_pattern' );
	$dp_bg_img_upload = dp_theme_mod( 'dp_bg_img_upload' );
	$dp_bg_img_repeat = dp_theme_mod( 'dp_bg_img_repeat' );
	$dp_bg_img_size = dp_theme_mod( 'dp_bg_img_size' );
	$dp_bg_img_attachment = dp_theme_mod( 'dp_bg_img_attachment' );
	$dp_bg_img_position = dp_theme_mod( 'dp_bg_img_position' );
	
	if( $dp_bg_color_style == "1" ) {
		$dp_bg_shape = '0';
	} else {
		$dp_bg_shape = $dp_bg_gradient_style;
	}
	
	$dp_bg = bg_gradient (
		$dp_bg_shape,
		$dp_bg_color,
		$dp_bg_color2,
		$dp_bg_color_style,
		$dp_bg_img_panel,
		$dp_bg_pattern,
		$dp_bg_img_upload,
		$dp_bg_img_position,
		$dp_bg_img_size,
		$dp_bg_img_repeat,
		$dp_bg_img_attachment,
		$dp_bg_gradient_position_parameter1,
		$dp_bg_gradient_position_parameter2,
		$dp_bg_shade_strenght,
		$dp_bg_gradient_reverse_color,
		$dp_bg_gradient_advanced_toggle
	);
	
	//Body Background 2 Colors
	$dp_bg2_color_style = dp_theme_mod( 'dp_bg2_color_style' );
	$dp_bg2_color = dp_theme_mod( 'dp_bg2_color' );
	$dp_bg2_color2 = dp_theme_mod( 'dp_bg2_color2' );
	$dp_bg2_shade_strenght = dp_theme_mod( 'dp_bg2_shade_strenght' );
	$dp_bg2_gradient_style = dp_theme_mod( 'dp_bg2_gradient_style' );
	$dp_bg2_gradient_advanced_toggle = dp_theme_mod( 'dp_bg2_gradient_advanced_toggle' );
	$dp_bg2_gradient_position_parameter1 = dp_theme_mod( 'dp_bg2_gradient_position_parameter1' );
	$dp_bg2_gradient_position_parameter2 = dp_theme_mod( 'dp_bg2_gradient_position_parameter2' );
	$dp_bg2_gradient_reverse_color = dp_theme_mod( 'dp_bg2_gradient_reverse_color' );
	$dp_bg2_img_panel = dp_theme_mod( 'dp_bg2_img_panel' );
	$dp_bg2_pattern = dp_theme_mod( 'dp_bg2_pattern' );
	$dp_bg2_img_upload = dp_theme_mod( 'dp_bg2_img_upload' );
	$dp_bg2_img_repeat = dp_theme_mod( 'dp_bg2_img_repeat' );
	$dp_bg2_img_size = dp_theme_mod( 'dp_bg2_img_size' );
	$dp_bg2_img_attachment = dp_theme_mod( 'dp_bg2_img_attachment' );
	$dp_bg2_img_position = dp_theme_mod( 'dp_bg2_img_position' );
	
	if( $dp_bg2_color_style == "1" ) {
		$dp_bg2_shape = '0';
	} else {
		$dp_bg2_shape = $dp_bg2_gradient_style;
	}
	
	$dp_bg2_height = dp_theme_mod( 'dp_bg2_height' );
	$dp_bg2_height_panel = dp_theme_mod( 'dp_bg2_height_panel' );
	
	if ( $dp_bg2_height_panel == '1' ) {
		$dp_bg2 = '';
	} else {
		$dp_bg2 = bg_gradient (
			$dp_bg2_shape,
			$dp_bg2_color,
			$dp_bg2_color2,
			$dp_bg2_color_style,
			$dp_bg2_img_panel,
			$dp_bg2_pattern,
			$dp_bg2_img_upload,
			$dp_bg2_img_position,
			$dp_bg2_img_size,
			$dp_bg2_img_repeat,
			$dp_bg2_img_attachment,
			$dp_bg2_gradient_position_parameter1,
			$dp_bg2_gradient_position_parameter2,
			$dp_bg2_shade_strenght,
			$dp_bg2_gradient_reverse_color,
			$dp_bg2_gradient_advanced_toggle
		);
	}
	
	if ( $dp_bg2_height_panel == '1' ) {
		$body_background_2_height = '';
		
	} elseif ( $dp_bg2_height_panel == '2' ) {
		$body_background_2_height = 'min-height: 100vh;';
		
	} elseif ( $dp_bg2_height_panel == '3' ) {
		$body_background_2_height = 'min-height: 100%;';
		
	}	elseif ( $dp_bg2_height_panel == '4' ) {
		$body_background_2_height = 'min-height: '.$dp_bg2_height . 'px;';
	}

	$dp_bg2_border_bottom_size = dp_theme_mod( 'dp_bg2_border_bottom_size' );
	$dp_bg2_border_bottom_color = dp_theme_mod( 'dp_bg2_border_bottom_color' );
	
	if ( $dp_bg2_border_bottom_size != '0' AND $dp_bg2_height_panel != '1' ) {
		$dp_bg2_border_bottom = 'border-bottom: '.$dp_bg2_border_bottom_size.'px solid '.$dp_bg2_border_bottom_color.';';
	} else {
		$dp_bg2_border_bottom = 'border-bottom: none;';
	}
	
	$dp_bg2_shadow_bottom_vertical = dp_theme_mod( 'dp_bg2_shadow_bottom_vertical' );
	$dp_bg2_shadow_bottom_blur_radius = dp_theme_mod( 'dp_bg2_shadow_bottom_blur_radius' );
	$dp_bg2_shadow_bottom_spread_radius = dp_theme_mod( 'dp_bg2_shadow_bottom_spread_radius' );
	$dp_bg2_shadow_bottom_opacity = dp_theme_mod( 'dp_bg2_shadow_bottom_opacity' );
	
	if ( $dp_bg2_height_panel == '1') {
		$dp_bg2_shadow_bottom = '';
	}
	elseif ( $dp_bg2_shadow_bottom_blur_radius == '0' AND $dp_bg2_shadow_bottom_spread_radius == '0' ) {
		$dp_bg2_shadow_bottom = '';
	} else {
		$dp_bg2_shadow_bottom = 'box-shadow: 0px ' . $dp_bg2_shadow_bottom_vertical . 'px ' . $dp_bg2_shadow_bottom_blur_radius . 'px ' . $dp_bg2_shadow_bottom_spread_radius . 'px rgba(0, 0, 0, ' . $dp_bg2_shadow_bottom_opacity . ');';
	}
	
	//Header Logo
	if ( dp_theme_mod( 'dp_header_logo_toggle' ) == true ) {
		$dp_header_logo_toggle = 'table';
	} else {
		$dp_header_logo_toggle = 'none';
	}
	
	$dp_header_logo_width = dp_theme_mod( 'dp_header_logo_width' );
	$dp_header_logo_title_area_width = dp_theme_mod( 'dp_header_logo_title_area_width' );
	$dp_header_logo_margin_right = dp_theme_mod( 'dp_header_logo_margin_right' );
	
	if ( dp_theme_mod( 'dp_header_logo_title_font_family_toggle' ) == true ) {
		$dp_header_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_header_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_header_logo_title_font_family' ) );
	}
	
	$dp_header_logo_title_font_size = dp_theme_mod( 'dp_header_logo_title_font_size' );
	$dp_header_logo_title_font_weight = dp_theme_mod( 'dp_header_logo_title_font_weight' );
	$dp_header_logo_title_color = dp_theme_mod( 'dp_header_logo_title_color' );
	$dp_header_logo_title_style = dp_font_style()[dp_theme_mod( 'dp_header_logo_title_style' )];
	$dp_header_logo_title_margin_bottom = dp_theme_mod( 'dp_header_logo_title_margin_bottom' );
	
	if ( dp_theme_mod( 'dp_header_logo_tagline_font_family_toggle' ) == true ) {
		$dp_header_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_header_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_header_logo_tagline_font_family' ) );
	}
	
	$dp_header_logo_tagline_font_size = dp_theme_mod( 'dp_header_logo_tagline_font_size' );
	$dp_header_logo_tagline_font_weight = dp_theme_mod( 'dp_header_logo_tagline_font_weight' );
	$dp_header_logo_tagline_color = dp_theme_mod( 'dp_header_logo_tagline_color' );	
	
	
	//Header
	if ( dp_theme_mod( 'dp_header_boxed' ) == true ) {
		$dp_header_max_width = dp_theme_mod( 'dp_site_container_width' ) . 'px';
	} else {
		$dp_header_max_width = '100%';
	}
	
	$dp_header_height = dp_theme_mod( 'dp_header_height' );
	$dp_header_padding_top = dp_theme_mod( 'dp_header_padding_top' );
	$dp_header_padding_right = dp_theme_mod( 'dp_header_padding_right' );
	$dp_header_padding_bottom = dp_theme_mod( 'dp_header_padding_bottom' );
	$dp_header_padding_left = dp_theme_mod( 'dp_header_padding_left' );
	$dp_header_margin_top = dp_theme_mod( 'dp_header_margin_top' );
	$dp_header_margin_bottom = dp_theme_mod( 'dp_header_margin_bottom' );
	
	$dp_header_color_style = dp_theme_mod( 'dp_header_color_style' );
	$dp_header_color = dp_theme_mod( 'dp_header_color' );
	$dp_header_color2 = dp_theme_mod( 'dp_header_color2' );
	$dp_header_shade_strenght = dp_theme_mod( 'dp_header_shade_strenght' );
	$dp_header_gradient_style = dp_theme_mod( 'dp_header_gradient_style' );
	$dp_header_gradient_advanced_toggle = dp_theme_mod( 'dp_header_gradient_advanced_toggle' );
	$dp_header_gradient_position_parameter1 = dp_theme_mod( 'dp_header_gradient_position_parameter1' );
	$dp_header_gradient_position_parameter2 = dp_theme_mod( 'dp_header_gradient_position_parameter2' );
	$dp_header_gradient_reverse_color = dp_theme_mod( 'dp_header_gradient_reverse_color' );
	$dp_header_img_panel = dp_theme_mod( 'dp_header_img_panel' );
	$dp_header_pattern = dp_theme_mod( 'dp_header_pattern' );
	$dp_header_img_upload = dp_theme_mod( 'dp_header_img_upload' );
	$dp_header_img_repeat = dp_theme_mod( 'dp_header_img_repeat' );
	$dp_header_img_size = dp_theme_mod( 'dp_header_img_size' );
	$dp_header_img_attachment = dp_theme_mod( 'dp_header_img_attachment' );
	$dp_header_img_position = dp_theme_mod( 'dp_header_img_position' );
	
	if( $dp_header_color_style == "1" ) {
		$dp_header_shape = '0';
	} else {
		$dp_header_shape = $dp_header_gradient_style;
	}
	
	$dp_header_bg = bg_gradient (
		$dp_header_shape,
		$dp_header_color,
		$dp_header_color2,
		$dp_header_color_style,
		$dp_header_img_panel,
		$dp_header_pattern,
		$dp_header_img_upload,
		$dp_header_img_position,
		$dp_header_img_size,
		$dp_header_img_repeat,
		$dp_header_img_attachment,
		$dp_header_gradient_position_parameter1,
		$dp_header_gradient_position_parameter2,
		$dp_header_shade_strenght,
		$dp_header_gradient_reverse_color,
		$dp_header_gradient_advanced_toggle
	);
	
	$dp_header_border_style = dp_theme_mod( 'dp_header_border_style' );
	$dp_header_border_width_top = dp_theme_mod( 'dp_header_border_width_top' );
	$dp_header_border_width_right = dp_theme_mod( 'dp_header_border_width_right' );
	$dp_header_border_width_bottom = dp_theme_mod( 'dp_header_border_width_bottom' );
	$dp_header_border_width_left = dp_theme_mod( 'dp_header_border_width_left' );
	$dp_header_border_color = dp_theme_mod( 'dp_header_border_color' );
	
	if ( $dp_header_border_style != 'none' ) {
		$header_border_style = '
			border-top: '.$dp_header_border_width_top.'px '.$dp_header_border_style.' '.$dp_header_border_color.';
			border-bottom: '.$dp_header_border_width_bottom.'px '.$dp_header_border_style.' '.$dp_header_border_color.';
			border-left: '.$dp_header_border_width_left.'px '.$dp_header_border_style.' '.$dp_header_border_color.';
			border-right: '.$dp_header_border_width_right.'px '.$dp_header_border_style.' '.$dp_header_border_color.';
	';
	} else {
		$header_border_style = 'border: none;';
	}
	
	$dp_header_border_radius_topleft = dp_theme_mod( 'dp_header_border_radius_topleft' );
	$dp_header_border_radius_topright = dp_theme_mod( 'dp_header_border_radius_topright' );
	$dp_header_border_radius_bottomright = dp_theme_mod( 'dp_header_border_radius_bottomright' );
	$dp_header_border_radius_bottomleft = dp_theme_mod( 'dp_header_border_radius_bottomleft' );
	
	if ( $dp_header_border_radius_topleft == '0' AND $dp_header_border_radius_topright == '0' AND $dp_header_border_radius_bottomright == '0' AND $dp_header_border_radius_bottomleft == '0') {
		$dp_header_border_radius = 'border-radius: 0;';
	} else {
		$dp_header_border_radius = 'border-radius: ' . $dp_header_border_radius_topleft . 'px ' . $dp_header_border_radius_topright . 'px ' . $dp_header_border_radius_bottomright . 'px ' . $dp_header_border_radius_bottomleft . 'px;';
	}
	
		// Header Logo URL
	if ( dp_theme_mod( 'dp_header_logo_upload' ) == true ) {
		$dp_header_logo_upload = 'background-image: url( ' . dp_theme_mod( 'dp_header_logo_upload' ) .');';
		$dp_header_logo_upload = str_replace( $url_http_https, '', $dp_header_logo_upload );
		
		$dp_header_logo_display = 'inline-block';
	} else {
		$dp_header_logo_upload = '';
		$dp_header_logo_display = 'none';
	}
	
	
	// Primary Menu Width
	if ( dp_theme_mod( 'dp_primary_menu_boxed' ) == true AND dp_theme_mod( 'dp_site_layout' ) == '3' ) {
		$dp_primary_menu_max_width = 'calc(100% - ' . ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px)';
	} elseif ( dp_theme_mod( 'dp_primary_menu_boxed' ) == true ) {
		$dp_primary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ) - ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px';
	} else {
		$dp_primary_menu_max_width = '100%';
	}
	
// 	// Primary Menu Width
// 	if ( dp_theme_mod( 'dp_primary_menu_width' ) == '1' ) {
// 		$dp_primary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ) - ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px';
// 	} elseif ( dp_theme_mod( 'dp_primary_menu_width' ) == '2' ) {
// 		$dp_primary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ). 'px';
// 	} else {
// 		$dp_primary_menu_max_width = '100%';
// 	}
	
	
	//Primary Menu Logo
// 	if ( dp_theme_mod( 'dp_primary_menu_logo_toggle' ) == true ) {
// 		$dp_primary_menu_logo_toggle = 'table-cell';
// 	} else {
// 		$dp_primary_menu_logo_toggle = 'none';
// 	}
	
	$dp_primary_menu_logo_height = dp_theme_mod( 'dp_primary_menu_logo_height' );
	$dp_primary_menu_logo_width = dp_theme_mod( 'dp_primary_menu_logo_width' );
	$dp_primary_menu_logo_title_area_width = dp_theme_mod( 'dp_primary_menu_logo_title_area_width' );
	
	if ( dp_theme_mod( 'dp_primary_menu_logo_title_font_family_toggle' ) == true ) {
		$dp_primary_menu_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_primary_menu_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_primary_menu_logo_title_font_family' ) );
	}
	
	$dp_primary_menu_logo_title_font_size = dp_theme_mod( 'dp_primary_menu_logo_title_font_size' );
	$dp_primary_menu_logo_title_font_weight = dp_theme_mod( 'dp_primary_menu_logo_title_font_weight' );
	$dp_primary_menu_logo_title_color = dp_theme_mod( 'dp_primary_menu_logo_title_color' );
	$dp_primary_menu_logo_title_style = dp_font_style()[dp_theme_mod( 'dp_primary_menu_logo_title_style' )];
	$dp_primary_menu_logo_title_margin_bottom = dp_theme_mod( 'dp_primary_menu_logo_title_margin_bottom' );
	
	if ( dp_theme_mod( 'dp_primary_menu_logo_tagline_font_family_toggle' ) == true ) {
		$dp_primary_menu_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_primary_menu_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_primary_menu_logo_tagline_font_family' ) );
	}
	
	$dp_primary_menu_logo_tagline_font_size = dp_theme_mod( 'dp_primary_menu_logo_tagline_font_size' );
	$dp_primary_menu_logo_tagline_font_weight = dp_theme_mod( 'dp_primary_menu_logo_tagline_font_weight' );
	$dp_primary_menu_logo_tagline_color = dp_theme_mod( 'dp_primary_menu_logo_tagline_color' );	
	
	
	
	// Primary Menu
	$dp_primary_menu_home_icon = dp_theme_mod( 'dp_primary_menu_home_icon' );
	$dp_primary_menu_submenu_indicator = dp_theme_mod( 'dp_primary_menu_submenu_indicator' );
	$dp_primary_menu_item_home_icon_font_size = dp_theme_mod( 'dp_primary_menu_font_size' ) + 14;
	//$dp_primary_menu_item_submenu_icon_font_size = round( ( ( dp_theme_mod( 'dp_primary_menu_font_size' ) / 20 ) * 16 ), 0, PHP_ROUND_HALF_DOWN );
	$dp_primary_menu_item_submenu_icon_font_size = round( ( ( dp_theme_mod( 'dp_primary_menu_font_size' ) * 0.5 ) + 12 ), 0, PHP_ROUND_HALF_DOWN );
	
	if ( $dp_primary_menu_home_icon == true ) {
		$dp_primary_menu_item_home_font_size = '0px';
		$dp_primary_menu_item_home_after_display = 'inline-block';
		
	} else {
		$dp_primary_menu_item_home_font_size = 'inherit';
		$dp_primary_menu_item_home_after_display = 'none';
	}
	
	if ( $dp_primary_menu_submenu_indicator == true ) {
		$dp_primary_menu_submenu_indicator_display = 'inline-block';
	} else {
		$dp_primary_menu_submenu_indicator_display = 'none';
	}
	
	if ( $dp_primary_menu_home_icon == false AND $dp_primary_menu_submenu_indicator == false ) {
		$dp_primary_menu_item_home_and_submenu_after_display = 'none';
		$dp_primary_menu_item_home_and_submenu_after_content = '';
		$dp_primary_menu_item_home_and_submenu_after_fontsize = '0';
		$dp_primary_menu_item_home_and_submenu_after_verticalalign = 'middle';
	}
	if ( $dp_primary_menu_home_icon == true AND $dp_primary_menu_submenu_indicator == false ) {
		$dp_primary_menu_item_home_and_submenu_after_display = 'inline-block';
		$dp_primary_menu_item_home_and_submenu_after_content = ' \f102';
		$dp_primary_menu_item_home_and_submenu_after_fontsize = dp_theme_mod( 'dp_primary_menu_font_size' ) + 14 . 'px';
		$dp_primary_menu_item_home_and_submenu_after_verticalalign = 'middle';
	}
	if ( $dp_primary_menu_home_icon == false AND $dp_primary_menu_submenu_indicator == true ) {
		$dp_primary_menu_item_home_and_submenu_after_display = 'inline-block';
		$dp_primary_menu_item_home_and_submenu_after_content = ' \f140';
		$dp_primary_menu_item_home_and_submenu_after_fontsize = round( ( ( dp_theme_mod( 'dp_primary_menu_font_size' ) * 0.5 ) + 12 ), 0 ) . 'px';
		$dp_primary_menu_item_home_and_submenu_after_verticalalign = 'top';
	}
	if ( $dp_primary_menu_home_icon == true AND $dp_primary_menu_submenu_indicator == true ) {
		$dp_primary_menu_item_home_and_submenu_after_display = 'inline-block';
		$dp_primary_menu_item_home_and_submenu_after_content = ' \f102';
		$dp_primary_menu_item_home_and_submenu_after_fontsize = dp_theme_mod( 'dp_primary_menu_font_size' ) + 14 . 'px';
		$dp_primary_menu_item_home_and_submenu_after_verticalalign = 'middle';
	}
	$dp_primary_menu_font_weight = dp_theme_mod( 'dp_primary_menu_font_weight' );
	
	if ( dp_theme_mod( 'dp_primary_menu_link_text_decoration' ) == true ) {
		$dp_primary_menu_link_text_decoration = 'underline';
	} else {
		$dp_primary_menu_link_text_decoration = 'none';
	}
	
	// Primary Menu Logo URL
	if ( dp_theme_mod( 'dp_primary_menu_logo_upload' ) == true && dp_theme_mod( 'dp_primary_menu_logo_toggle' ) == true ) {
		$dp_primary_menu_logo_upload = 'background-image: url( ' . dp_theme_mod( 'dp_primary_menu_logo_upload' ) .');';
		$dp_primary_menu_logo_upload = str_replace( $url_http_https, '', $dp_primary_menu_logo_upload );
		$dp_primary_menu_logo_display = 'inline-block';
	} else {
		$dp_primary_menu_logo_upload = '';
		$dp_primary_menu_logo_display = 'none';
	}
	

	
	// Primary Menu Home Icon Smart Padding
	if ( dp_theme_mod( 'dp_primary_menu_home_icon_smart_padding' ) == true ) {
		$dp_primary_menu_home_icon_padding =  dp_theme_mod( 'dp_primary_menu_height' ) / 2;
	} else {
		$dp_primary_menu_home_icon_padding = dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	}
	
	// Primary Menu Search Box Padding Left
	if ( dp_theme_mod( 'dp_primary_menu_search_padding_left' ) == true ) {
		$dp_primary_menu_search_padding_left =  dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	} else {
		$dp_primary_menu_search_padding_left = '0';
	}
	
	// Primary Menu Search Box Padding Left
	if ( dp_theme_mod( 'dp_primary_menu_search_padding_right' ) == true ) {
		$dp_primary_menu_search_padding_right =  dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	} else {
		$dp_primary_menu_search_padding_right = '0';
	}
	
	// Primary Menu Logo Margin Right
	$dp_primary_menu_logo_margin_right = dp_theme_mod( 'dp_primary_menu_logo_margin_right' );
	
	// Primary Menu Logo Padding Left
	if ( dp_theme_mod( 'dp_primary_menu_logo_padding_left' ) == true ) {
		$dp_primary_menu_logo_padding_left =  dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	} else {
		$dp_primary_menu_logo_padding_left = '0';
	}
	
	// Primary Menu Logo Padding Left
	if ( dp_theme_mod( 'dp_primary_menu_logo_padding_right' ) == true ) {
		$dp_primary_menu_logo_padding_right =  dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	} else {
		$dp_primary_menu_logo_padding_right = '0';
	}
	
	$dp_primary_menu_link_color = dp_theme_mod( 'dp_primary_menu_link_color' );
	$dp_primary_menu_link_color_active = dp_theme_mod( 'dp_primary_menu_link_color_active' );
	
	// Primary Menu Background Color
	$dp_primary_menu_bg_color_style = dp_theme_mod( 'dp_primary_menu_bg_color_style' );
	$dp_primary_menu_bg_color = dp_theme_mod( 'dp_primary_menu_bg_color' );
	$dp_primary_menu_bg_color2 = dp_theme_mod( 'dp_primary_menu_bg_color2' );
	$dp_primary_menu_bg_shade_strenght = dp_theme_mod( 'dp_primary_menu_bg_shade_strenght' );
	$dp_primary_menu_bg_gradient_style = dp_theme_mod( 'dp_primary_menu_bg_gradient_style' );
	$dp_primary_menu_bg_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_menu_bg_gradient_advanced_toggle' );
	$dp_primary_menu_bg_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_menu_bg_gradient_position_parameter1' );
	$dp_primary_menu_bg_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_menu_bg_gradient_position_parameter2' );
	$dp_primary_menu_bg_gradient_reverse_color = dp_theme_mod( 'dp_primary_menu_bg_gradient_reverse_color' );
	//$dp_primary_menu_bg_items_only = dp_theme_mod( 'dp_primary_menu_bg_items_only' );
	
	if( $dp_primary_menu_bg_color_style == "1" ) {
		$dp_primary_menu_bg_shape = '0';
	} else {
		$dp_primary_menu_bg_shape = $dp_primary_menu_bg_gradient_style;
	}
	
	$dp_primary_menu_bg = bg_gradient (
		$dp_primary_menu_bg_shape,
		$dp_primary_menu_bg_color,
		$dp_primary_menu_bg_color2,
		$dp_primary_menu_bg_color_style,
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		$dp_primary_menu_bg_gradient_position_parameter1,
		$dp_primary_menu_bg_gradient_position_parameter2,
		$dp_primary_menu_bg_shade_strenght,
		$dp_primary_menu_bg_gradient_reverse_color,
		$dp_primary_menu_bg_gradient_advanced_toggle
	);
	
	if( dp_theme_mod( 'dp_primary_menu_home_font_uppercase' ) == 'true' ) {
		$dp_primary_menu_home_font_uppercase = 'uppercase';
	} else {
		$dp_primary_menu_home_font_uppercase = 'none'; 
	}
	
	if( dp_theme_mod( 'dp_primary_menu_logo_tagline_uppercase' ) == 'true' ) {
		$dp_primary_menu_logo_tagline_uppercase = 'uppercase';
	} else {
		$dp_primary_menu_logo_tagline_uppercase = 'none'; 
	}
	
	if( dp_theme_mod( 'dp_primary_menu_logo_title_uppercase' ) == 'true' ) {
		$dp_primary_menu_logo_title_uppercase = 'uppercase';
	} else {
		$dp_primary_menu_logo_title_uppercase = 'none'; 
	}
	
	if( dp_theme_mod( 'dp_header_logo_title_uppercase' ) == 'true' ) {
		$dp_header_logo_title_uppercase = 'uppercase';
	} else {
		$dp_header_logo_title_uppercase = 'none'; 
	}
	
	if( dp_theme_mod( 'dp_header_logo_tagline_uppercase' ) == 'true' ) {
		$dp_header_logo_tagline_uppercase = 'uppercase';
	} else {
		$dp_header_logo_tagline_uppercase = 'none'; 
	}
	// Sticky Primary Menu Background Color
// 	$dp_primary_menu_sticky_bg_color_style = dp_theme_mod( 'dp_primary_menu_sticky_bg_color_style' );
// 	$dp_primary_menu_sticky_bg_color = dp_theme_mod( 'dp_primary_menu_sticky_bg_color' );
// 	$dp_primary_menu_sticky_bg_color2 = dp_theme_mod( 'dp_primary_menu_sticky_bg_color2' );
// 	$dp_primary_menu_sticky_bg_shade_strenght = dp_theme_mod( 'dp_primary_menu_sticky_bg_shade_strenght' );
// 	$dp_primary_menu_sticky_bg_gradient_style = dp_theme_mod( 'dp_primary_menu_sticky_bg_gradient_style' );
// 	$dp_primary_menu_sticky_bg_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_menu_sticky_bg_gradient_advanced_toggle' );
// 	$dp_primary_menu_sticky_bg_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_menu_sticky_bg_gradient_position_parameter1' );
// 	$dp_primary_menu_sticky_bg_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_menu_sticky_bg_gradient_position_parameter2' );
// 	$dp_primary_menu_sticky_bg_gradient_reverse_color = dp_theme_mod( 'dp_primary_menu_sticky_bg_gradient_reverse_color' );
	//$dp_primary_menu_sticky_bg_items_only = dp_theme_mod( 'dp_primary_menu_sticky_bg_items_only' );
	
// 	if( $dp_primary_menu_sticky_bg_color_style == "1" ) {
// 		$dp_primary_menu_sticky_bg_shape = '0';
// 	} else {
// 		$dp_primary_menu_sticky_bg_shape = $dp_primary_menu_sticky_bg_gradient_style;
// 	}
	
// 	$dp_primary_menu_sticky_bg = bg_gradient (
// 		$dp_primary_menu_sticky_bg_shape,
// 		$dp_primary_menu_sticky_bg_color,
// 		$dp_primary_menu_sticky_bg_color2,
// 		$dp_primary_menu_sticky_bg_color_style,
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		$dp_primary_menu_sticky_bg_gradient_position_parameter1,
// 		$dp_primary_menu_sticky_bg_gradient_position_parameter2,
// 		$dp_primary_menu_sticky_bg_shade_strenght,
// 		$dp_primary_menu_sticky_bg_gradient_reverse_color,
// 		$dp_primary_menu_sticky_bg_gradient_advanced_toggle
// 	);
	
	if ( $dp_primary_menu_bg_items_only == true ) {
		$dp_primary_menu_bg_nav = '';
		$dp_primary_menu_bg_li = $dp_primary_menu_bg;
	} else {
		$dp_primary_menu_bg_nav =  $dp_primary_menu_bg;
		$dp_primary_menu_bg_li = '';
	}
	
	
	
	$dp_primary_menu_bg_active_color_style = dp_theme_mod( 'dp_primary_menu_bg_active_color_style' );
	$dp_primary_menu_bg_active_color = dp_theme_mod( 'dp_primary_menu_bg_active_color' );
	$dp_primary_menu_bg_active_color2 = dp_theme_mod( 'dp_primary_menu_bg_active_color2' );
	$dp_primary_menu_bg_active_shade_strenght = dp_theme_mod( 'dp_primary_menu_bg_active_shade_strenght' );
	$dp_primary_menu_bg_active_gradient_style = dp_theme_mod( 'dp_primary_menu_bg_active_gradient_style' );
	$dp_primary_menu_bg_active_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_menu_bg_active_gradient_advanced_toggle' );
	$dp_primary_menu_bg_active_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_menu_bg_active_gradient_position_parameter1' );
	$dp_primary_menu_bg_active_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_menu_bg_active_gradient_position_parameter2' );
	$dp_primary_menu_bg_active_gradient_reverse_color = dp_theme_mod( 'dp_primary_menu_bg_active_gradient_reverse_color' );
	
	if( $dp_primary_menu_bg_active_color_style == "1" ) {
		$dp_primary_menu_bg_active_shape = '0';
	} else {
		$dp_primary_menu_bg_active_shape = $dp_primary_menu_bg_active_gradient_style;
	}
	
	$dp_primary_menu_bg_active = bg_gradient (
		$dp_primary_menu_bg_active_shape,
		$dp_primary_menu_bg_active_color,
		$dp_primary_menu_bg_active_color2,
		$dp_primary_menu_bg_active_color_style,
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		$dp_primary_menu_bg_active_gradient_position_parameter1,
		$dp_primary_menu_bg_active_gradient_position_parameter2,
		$dp_primary_menu_bg_active_shade_strenght,
		$dp_primary_menu_bg_active_gradient_reverse_color,
		$dp_primary_menu_bg_active_gradient_advanced_toggle
	);
	
	//$dp_primary_menu_bg_active_boxshadow = 'box-shadow: ' . dp_hover_shadows()[dp_theme_mod( 'dp_primary_menu_bg_active_boxshadow' )] . ';';
	
	if ( dp_theme_mod( 'dp_primary_menu_bg_active_boxshadow' ) == "0" ) {
		$dp_primary_menu_bg_active_boxshadow = '';
	} else {
		$dp_primary_menu_bg_active_boxshadow = 'box-shadow: ' . dp_hover_shadows()[dp_theme_mod( 'dp_primary_menu_bg_active_boxshadow' )] . ';';
	}
	
	$dp_primary_menu_margin_top = dp_theme_mod( 'dp_primary_menu_margin_top' );
	$dp_primary_menu_margin_bottom = dp_theme_mod( 'dp_primary_menu_margin_bottom' );
	$dp_primary_menu_item_padding_left_right = dp_theme_mod( 'dp_primary_menu_item_padding_left_right' );
	
	$dp_primary_menu_border_style = dp_theme_mod( 'dp_primary_menu_border_style' );
	$dp_primary_menu_border_width_top = dp_theme_mod( 'dp_primary_menu_border_width_top' );
	$dp_primary_menu_border_width_right = dp_theme_mod( 'dp_primary_menu_border_width_right' );
	$dp_primary_menu_border_width_bottom = dp_theme_mod( 'dp_primary_menu_border_width_bottom' );
	$dp_primary_menu_border_width_left = dp_theme_mod( 'dp_primary_menu_border_width_left' );
	$dp_primary_menu_border_color = dp_theme_mod( 'dp_primary_menu_border_color' );
	
	if ( $dp_primary_menu_border_style != 'none' ) {
		$primary_menu_border_style = '
			border-top: '.$dp_primary_menu_border_width_top.'px '.$dp_primary_menu_border_style.' '.$dp_primary_menu_border_color.';
			border-bottom: '.$dp_primary_menu_border_width_bottom.'px '.$dp_primary_menu_border_style.' '.$dp_primary_menu_border_color.';
			border-left: '.$dp_primary_menu_border_width_left.'px '.$dp_primary_menu_border_style.' '.$dp_primary_menu_border_color.';
			border-right: '.$dp_primary_menu_border_width_right.'px '.$dp_primary_menu_border_style.' '.$dp_primary_menu_border_color.';
		';
	} else {
		$primary_menu_border_style = 'border: none;';
	}
	
	$dp_primary_menu_border_radius_topleft = dp_theme_mod( 'dp_primary_menu_border_radius_topleft' );
	$dp_primary_menu_border_radius_topright = dp_theme_mod( 'dp_primary_menu_border_radius_topright' );
	$dp_primary_menu_border_radius_bottomright = dp_theme_mod( 'dp_primary_menu_border_radius_bottomright' );
	$dp_primary_menu_border_radius_bottomleft = dp_theme_mod( 'dp_primary_menu_border_radius_bottomleft' );
	
	
	if ( $dp_primary_menu_border_radius_topleft == '0' AND $dp_primary_menu_border_radius_topright == '0' AND $dp_primary_menu_border_radius_bottomright == '0' AND $dp_primary_menu_border_radius_bottomleft == '0') {
		$dp_primary_menu_border_radius = 'border-radius: 0;';
	} else {
		$dp_primary_menu_border_radius = 'border-radius: ' . $dp_primary_menu_border_radius_topleft . 'px ' . $dp_primary_menu_border_radius_topright . 'px ' . $dp_primary_menu_border_radius_bottomright . 'px ' . $dp_primary_menu_border_radius_bottomleft . 'px;';
	}
	
	$dp_primary_menu_font_size = dp_theme_mod( 'dp_primary_menu_font_size' );
	$dp_primary_menu_item_alignment = dp_theme_mod( 'dp_primary_menu_item_alignment' );
	
	if ( $dp_primary_menu_item_alignment == 'fullwidth' ) {
		$dp_primary_menu_item_alignment_textalign = 'center';
		$dp_primary_menu_item_alignment_display = 'flex';
		$dp_primary_menu_item_alignment_justifycontent = 'space-between';
		$dp_primary_menu_item_alignment_width = '100%';

	} else {
		$dp_primary_menu_item_alignment_textalign = $dp_primary_menu_item_alignment;
		$dp_primary_menu_item_alignment_display = 'inline-block';
		$dp_primary_menu_item_alignment_justifycontent = 'flex-start';
		$dp_primary_menu_item_alignment_width = 'auto';
	}

	
	$dp_primary_menu_item_dividers = dp_theme_mod( 'dp_primary_menu_item_dividers' );
	$dp_primary_menu_item_dividers_firstchild = dp_theme_mod( 'dp_primary_menu_item_dividers_firstchild' );
	$dp_primary_menu_item_dividers_lastchild = dp_theme_mod( 'dp_primary_menu_item_dividers_lastchild' );
	$dp_primary_menu_item_dividers_top = dp_theme_mod( 'dp_primary_menu_item_dividers_top' );
	$dp_primary_menu_item_dividers_bottom = dp_theme_mod( 'dp_primary_menu_item_dividers_bottom' );
	$dp_primary_menu_item_dividers_color_toggle = dp_theme_mod( 'dp_primary_menu_item_dividers_color_toggle' );
	$dp_primary_menu_item_dividers_color = dp_theme_mod( 'dp_primary_menu_item_dividers_color' );
	$dp_primary_menu_search_toggle = dp_theme_mod( 'dp_primary_menu_search_toggle' );
	$dp_primary_menu_search_opening_divider = dp_theme_mod( 'dp_primary_menu_search_opening_divider' );
	$dp_primary_menu_search_closing_divider = dp_theme_mod( 'dp_primary_menu_search_closing_divider' );

	if ( $dp_primary_menu_item_dividers_color_toggle == true ) {
		$dp_primary_menu_item_dividers_newcolor = shading( $dp_primary_menu_item_dividers_color, -0.4);
		$dp_primary_menu_item_dividers_newcolor2 = shading( $dp_primary_menu_item_dividers_color, 0.3);

	} else {
		$dp_primary_menu_item_dividers_newcolor = shading( $dp_primary_menu_bg_color, -0.4);
		$dp_primary_menu_item_dividers_newcolor2 = shading( $dp_primary_menu_bg_color, 0.3);
	}

	/*
	 * Primary Menu Item Dividers (None)
	 */
	if ( $dp_primary_menu_item_dividers == '0' ) {
		
		$dp_primary_menu_item_dividers_boxshadow = 'none';
		$dp_primary_menu_item_dividers_boxshadow_firstchild = 'none';
		$dp_primary_menu_item_dividers_boxshadow_lastchild = 'none';
		
		$dp_primary_menu_item_dividers_bordertop = 'none';
		$dp_primary_menu_item_dividers_borderbottom = 'none';
		
		$dp_primary_menu_search_divider_boxshadow = 'none';
		
		$dp_primary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
	} 

	/*
	 * Primary Menu Item Dividers (Single Line)
	 */
	if ( $dp_primary_menu_item_dividers == '1' ) {
		
		$dp_primary_menu_item_dividers_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
		$dp_primary_menu_item_dividers_bordertop = 'none';
		$dp_primary_menu_item_dividers_borderbottom = 'none';
		
		if ( $dp_primary_menu_item_dividers_firstchild == true ) {
			$dp_primary_menu_item_dividers_boxshadow_firstchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
		} else {
			$dp_primary_menu_item_dividers_boxshadow_firstchild = 'none';
		}

		if ( $dp_primary_menu_item_dividers_lastchild == true ) {
			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';
		} else {
			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
		}

		if ( $dp_primary_menu_item_dividers_top == true ) {
			$dp_primary_menu_item_dividers_bordertop = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
		} else {
			$dp_primary_menu_item_dividers_bordertop = 'none';
		}

		if ( $dp_primary_menu_item_dividers_bottom == true ) {
			$dp_primary_menu_item_dividers_borderbottom = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
		} else {
			$dp_primary_menu_item_dividers_borderbottom = 'none';
		}
		
		if ( $dp_primary_menu_search_toggle == true ) {
			$dp_primary_menu_item_dividers_boxshadow_lastchild_position = ':nth-last-child(2)';
			
			if ( $dp_primary_menu_search_opening_divider == true && $dp_primary_menu_search_closing_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';
			
			} elseif ( $dp_primary_menu_search_opening_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
			
			} elseif ( $dp_primary_menu_search_closing_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';
				
			} else {
				$dp_primary_menu_search_divider_boxshadow = 'none';
			}
			
		} else {
			$dp_primary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
			$dp_primary_menu_search_divider_boxshadow = 'none';
		}
		
	}

	/*
	 * Primary Menu Item Dividers (Dual Line)
	 */
	if ( $dp_primary_menu_item_dividers == '2' ) {

// 		if ( $dp_primary_menu_item_dividers_top == true ) {
// 			$dp_primary_menu_item_dividers_bordertop = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
// 			$dp_primary_menu_item_dividers_bordertop_boxshadow = ', ' . $dp_primary_menu_item_dividers_newcolor2 . ' 0px 1px 0px 0px inset';
// 		} else {
// 			$dp_primary_menu_item_dividers_bordertop = 'none';
// 			$dp_primary_menu_item_dividers_bordertop_boxshadow = '';
// 		}

// 		if ( $dp_primary_menu_item_dividers_bottom == true ) {
// 			$dp_primary_menu_item_dividers_borderbottom = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
// 		} else {
// 			$dp_primary_menu_item_dividers_borderbottom = 'none';
// 		}

// 		$dp_primary_menu_item_dividers_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
		
// 		if ( $dp_primary_menu_item_dividers_firstchild == true ) {
// 			$dp_primary_menu_item_dividers_boxshadow_firstchild = $dp_primary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
			
// 		} else {
// 			$dp_primary_menu_item_dividers_boxshadow_firstchild = $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
// 		}

// 		if ( $dp_primary_menu_item_dividers_lastchild == true ) {
// 			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
			
// 		} else {
// 			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
// 		}
		
		
	//	$dp_primary_menu_item_dividers_bordertop = 'none';
	//	$dp_primary_menu_item_dividers_borderbottom = 'none';
		
		if ( $dp_primary_menu_item_dividers_top == true ) {
			$dp_primary_menu_item_dividers_bordertop = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
 			$dp_primary_menu_item_dividers_bordertop_boxshadow = ', ' . $dp_primary_menu_item_dividers_newcolor2 . ' 0px 1px 0px 0px inset';
		} else {
			$dp_primary_menu_item_dividers_bordertop = 'none';
			$dp_primary_menu_item_dividers_bordertop_boxshadow = '';
		}
		
		if ( $dp_primary_menu_item_dividers_bottom == true ) {
			$dp_primary_menu_item_dividers_borderbottom = '1px solid ' . $dp_primary_menu_item_dividers_newcolor;
		} else {
			$dp_primary_menu_item_dividers_borderbottom = 'none';
		}
		
		if ( $dp_primary_menu_item_dividers_firstchild == true ) {
			$dp_primary_menu_item_dividers_boxshadow_firstchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
		} else {
			$dp_primary_menu_item_dividers_boxshadow_firstchild = 'none';
		}

		if ( $dp_primary_menu_item_dividers_lastchild == true ) {
			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' -1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
		} else {
			$dp_primary_menu_item_dividers_boxshadow_lastchild = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
		}

		if ( $dp_primary_menu_search_toggle == true ) {
			$dp_primary_menu_item_dividers_boxshadow_lastchild_position = ':nth-last-child(2)';
			
			if ( $dp_primary_menu_search_opening_divider == true && $dp_primary_menu_search_closing_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' -1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor . ' -2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
			
			} elseif ( $dp_primary_menu_search_opening_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
			
			} elseif ( $dp_primary_menu_search_closing_divider == true ) {
				$dp_primary_menu_search_divider_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' -2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
				
			} else {
				$dp_primary_menu_search_divider_boxshadow = 'none';
			}
			
		} else {
			$dp_primary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
			$dp_primary_menu_search_divider_boxshadow = 'none';
		}
		
		$dp_primary_menu_item_dividers_boxshadow = $dp_primary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_primary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_primary_menu_item_dividers_bordertop_boxshadow;
		
	}
	

	if ( dp_theme_mod( 'dp_primary_menu_boxed' ) == true ) {
		$dp_primary_menu_wrap_padding = '0px';
		$dp_primary_menu_item_padding_right_search_box = '0px';
	} elseif ( dp_theme_mod( 'dp_primary_menu_item_alignment_padding' ) == true ) {
		$dp_primary_menu_wrap_padding = $dp_site_container_wrap_padding_left_right . 'px';
		//$dp_primary_menu_item_padding_child = $dp_primary_menu_item_padding_left_right . 'px';
		$dp_primary_menu_item_padding_right_search_box = '0px';
		//$dp_primary_menu_item_padding_left_logo = '0px';
	} else {
		$dp_primary_menu_wrap_padding = '0px';
		//$dp_primary_menu_item_padding_child = $dp_primary_menu_item_padding_left_right . 'px';
		$dp_primary_menu_item_padding_right_search_box = $dp_site_container_wrap_padding_left_right . 'px';
		//$dp_primary_menu_item_padding_left_logo = $dp_site_container_wrap_padding_left_right . 'px';
	}
	
	if ( dp_theme_mod( 'dp_primary_menu_font_family_toggle' ) == true ) {
		$dp_primary_menu_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_primary_menu_font_family = dp_decode_fonts( dp_theme_mod( 'dp_primary_menu_font_family' ) );
	}
	
// 	if ( dp_theme_mod( 'dp_primary_menu_sticky_menu_width' ) == true ) {
// 		$dp_primary_menu_sticky_menu_width = '100%';
// 	} else {
// 		$dp_primary_menu_sticky_menu_width =  dp_theme_mod( 'dp_site_container_width' ) . 'px';
// 	}

// 	if ( dp_theme_mod( 'dp_primary_menu_sticky' ) == '1' ) {
// 		$dp_primary_menu_sticky_transition = 'transition: width 0.6s, max-width 0.6s, height 0.6s;';
// 		$dp_primary_menu_sticky_transition_logo = 'transition: all 0.4s;';
// 	} else {
// 		$dp_primary_menu_sticky_transition =  '';
// 		$dp_primary_menu_sticky_transition_logo =  '';
// 	}
	
// 	if ( dp_theme_mod( 'dp_primary_menu_sticky_border' ) == true ) {
// 		$dp_primary_menu_sticky_border = 'border: 0;';
// 	} else {
// 		$dp_primary_menu_sticky_border =  '';
// 	}

// 	if ( dp_theme_mod( 'dp_primary_menu_sticky_item_padding_top_bottom_toggle' ) == true ) {
// 		$dp_primary_menu_sticky_item_padding_top_bottom = dp_theme_mod( 'dp_primary_menu_sticky_item_padding_top_bottom' );
// 	} else {
// 		$dp_primary_menu_sticky_item_padding_top_bottom = dp_theme_mod( 'dp_primary_menu_item_padding_top_bottom' );
// 	}
	
	/*
	 * Primary Menu Shadow
	 */
	if ( dp_theme_mod( 'dp_primary_menu_shadow_bottom_style' ) == 'presets' ) {
		$dp_primary_menu_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_primary_menu_shadow_presets' ) - 1] . ';';
		
	} elseif ( dp_theme_mod( 'dp_primary_menu_shadow_bottom_style' ) == 'custom' ) {
		$vertical = dp_theme_mod( 'dp_primary_menu_shadow_bottom_vertical' );
		$blur = dp_theme_mod( 'dp_primary_menu_shadow_bottom_blur_radius' );
		$spread = dp_theme_mod( 'dp_primary_menu_shadow_bottom_spread_radius' );
		$opacity = dp_theme_mod( 'dp_primary_menu_shadow_bottom_opacity' );
		
		$dp_primary_menu_shadow = 'box-shadow: 0px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
		
	} else {
		$dp_primary_menu_shadow = 'box-shadow: none;';
	}
	
// 	if ( dp_theme_mod( 'dp_primary_menu_sticky_shadow_bottom' ) == true ) {
// 		$dp_primary_menu_stick_shadow = 'box-shadow: none;';
// 	} else {
// 		$dp_primary_menu_stick_shadow = $dp_primary_menu_shadow;
// 	}
	
	if ( dp_theme_mod( 'dp_primary_menu_search_field_height_toggle' ) == true ) {
		$dp_primary_menu_search_field_height = dp_theme_mod( 'dp_primary_menu_search_field_height' );
	} else {
		$dp_primary_menu_search_field_height = ( dp_theme_mod( 'dp_primary_menu_font_size' ) * 2 );
	}
	
	if ( dp_theme_mod( 'dp_primary_menu_search_font_size_toggle' ) == true ) {
		$dp_primary_menu_search_font_size = dp_theme_mod( 'dp_primary_menu_search_font_size' );
		$dp_primary_menu_search_font_size_icon = dp_theme_mod( 'dp_primary_menu_search_font_size' ) + 4;
	} else {
		$dp_primary_menu_search_font_size = dp_theme_mod( 'dp_primary_menu_font_size' );
		$dp_primary_menu_search_font_size_icon = dp_theme_mod( 'dp_primary_menu_font_size' ) + 4;
	}
	
	$dp_primary_menu_search_field_width = dp_theme_mod( 'dp_primary_menu_search_field_width' );
	$dp_primary_menu_search_border_radius = dp_theme_mod( 'dp_primary_menu_search_border_radius' );
	
	if ( dp_theme_mod( 'dp_primary_menu_search_border_toggle' ) == true ) {
		$dp_primary_menu_search_border = '1px solid ' . dp_theme_mod( 'dp_primary_menu_search_border_color' );
	} else {
		$dp_primary_menu_search_border = 'none';
	}
	$dp_primary_menu_search_border_color = dp_theme_mod( 'dp_primary_menu_search_border_color' );
	$dp_primary_menu_search_submit_font_color = dp_theme_mod( 'dp_primary_menu_search_submit_font_color' );
	
	$dp_primary_menu_height = dp_theme_mod( 'dp_primary_menu_height' );
	
// 	if ( dp_theme_mod( 'dp_primary_menu_sticky_height_toggle' ) == true ) {
// 		$dp_primary_menu_sticky_height = dp_theme_mod( 'dp_primary_menu_sticky_height' ) . 'px';
// 	} else {
// 		$dp_primary_menu_sticky_height = $dp_primary_menu_height . 'px';
// 	}
	
	$dp_primary_menu_home_button_title_font_size = dp_theme_mod( 'dp_primary_menu_home_button_title_font_size' );
	
	// 	$dp_site_container_border_color = dp_theme_mod( 'dp_site_container_border_color' );
// 	$dp_container_border_style = dp_theme_mod( 'dp_container_border_style' );
// 	$dp_site_container_border_width_top_bottom = dp_theme_mod( 'dp_site_container_border_width_top_bottom' );
// 	$dp_site_container_border_width_left_right = dp_theme_mod( 'dp_site_container_border_width_left_right' );
	
	
// 	$dp_site_container_box_shadow_blur_radius = dp_theme_mod( 'dp_site_container_box_shadow_blur_radius' );
// 	$dp_site_container_box_shadow_spread_radius = dp_theme_mod( 'dp_site_container_box_shadow_spread_radius' );
// 	$dp_site_container_box_shadow_opacity = dp_theme_mod( 'dp_site_container_box_shadow_opacity' );
	
	/*
	//Body Background Colors
	
	$body_bg_color1_fallback = $get_option['dp_general_body_bg_color']['color'];
	
	$body_bg_gradient  = $get_option['dp_general_body_bg_gradient'];
	$body_bg_color1 = $get_option['dp_general_body_bg_color']['rgba'];
	$body_bg_color2 = $get_option['dp_general_body_bg_color2']['rgba']; 
	$body_bg_style_status = $get_option['dp_general_body_bg_color_style']; 
	$body_bg_img_status = $get_option['dp_general_body_bg_img_panel']; 
	$body_bg_pattern_url = $get_option['dp_general_body_bg_pattern']; 
	$body_bg_img_url = $get_option['dp_general_body_bg_upload_url']['url']; 
	$body_bg_img_pos = $get_option['dp_general_body_bg_position']; 
	$body_bg_img_size = $get_option['dp_general_body_bg_size']; 
	$body_bg_img_repeat = $get_option['dp_general_body_bg_repeat']; 
	$body_bg_img_attach = $get_option['dp_general_body_bg_attachment']; 
	$body_bg_grad_pos1 = $get_option['dp_general_body_bg_gradient_pos2']['1']; 
	$body_bg_grad_pos2 = $get_option['dp_general_body_bg_gradient_pos2']['2'];
	$body_bg_shades = $get_option['dp_general_body_bg_shades'];
	$body_bg_rev_colors = $get_option['dp_general_body_bg_rev_colors'];
	$body_bg_gradient_advanced = $get_option['dp_general_body_bg_gradient_advanced'];
	
	if($body_bg_style_status == "1") {
		$body_bg_shape = '0';
	} else {
		$body_bg_shape = $body_bg_gradient;
	}
	
	$dp_general_site_container_border_style = $get_option['dp_general_site_container_border_style'];
	$dp_general_site_container_border_width_lr = $get_option['dp_general_site_container_border_width_lr'];
	$dp_general_site_container_border_width_tb = $get_option['dp_general_site_container_border_width_tb'];
	$dp_general_site_container_border_color = $get_option['dp_general_site_container_border_color']['rgba'];
	
	$dp_general_site_inner_shadow_blur = $get_option['dp_general_site_inner_shadow_blur'];
	$dp_general_site_inner_shadow_spread = $get_option['dp_general_site_inner_shadow_spread'];
	$dp_general_site_inner_shadow_opacity = $get_option['dp_general_site_inner_shadow_opacity'];
	*/

	/**
	* Section: Primary Menu Sticky
	*/
	
	// Primary Menu Stick Eynable
	if ( dp_theme_mod( 'dp_primary_menu_sticky_enabled' ) === true ) {
		$dp_primary_menu_sticky_enabled = 'fixed';
	} else {
		$dp_primary_menu_sticky_enabled = 'static';
	}
	
	// Primary Menu Stick Enable
	if ( dp_theme_mod( 'dp_primary_menu_sticky_boxed' ) === true ) {
		$dp_primary_menu_sticky_boxed = 'width: 100%;
		max-width: 100%;';
	} else {
		$dp_primary_menu_sticky_boxed = '';
	}
	
	
	/**
	* Section: Primary Sidebar
	*/
	
	$dp_primary_sidebar_width_custom =dp_theme_mod( 'dp_primary_sidebar_width_custom' );
	$dp_primary_sidebar_padding = dp_theme_mod( 'dp_primary_sidebar_padding' );
	$dp_primary_sidebar_margin_to_content = dp_theme_mod( 'dp_primary_sidebar_margin_to_content' );
		
	if ( dp_theme_mod( 'dp_primary_sidebar_width' ) != 'custom' ) {
		//$dp_primary_sidebar_width = dp_theme_mod( 'dp_primary_sidebar_width' ) + ( $dp_primary_sidebar_padding * 2 );
		$dp_primary_sidebar_width = dp_theme_mod( 'dp_primary_sidebar_width' );
	} else {
		//$dp_primary_sidebar_width = $dp_primary_sidebar_width_custom + ( $dp_primary_sidebar_padding * 2 );
		$dp_primary_sidebar_width = $dp_primary_sidebar_width_custom;
	}
	$dp_content_width = $dp_primary_sidebar_width + $dp_primary_sidebar_margin_to_content;
	
	$dp_primary_sidebar_margin_top = dp_theme_mod( 'dp_primary_sidebar_margin_top' );
	
	$dp_primary_sidebar_color_style = dp_theme_mod( 'dp_primary_sidebar_color_style' );
	$dp_primary_sidebar_color = dp_theme_mod( 'dp_primary_sidebar_color' );
	$dp_primary_sidebar_color2 = dp_theme_mod( 'dp_primary_sidebar_color2' );
	$dp_primary_sidebar_shade_strenght = dp_theme_mod( 'dp_primary_sidebar_shade_strenght' );
	$dp_primary_sidebar_gradient_style = dp_theme_mod( 'dp_primary_sidebar_gradient_style' );
	$dp_primary_sidebar_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_sidebar_gradient_advanced_toggle' );
	$dp_primary_sidebar_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_sidebar_gradient_position_parameter1' );
	$dp_primary_sidebar_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_sidebar_gradient_position_parameter2' );
	$dp_primary_sidebar_gradient_reverse_color = dp_theme_mod( 'dp_primary_sidebar_gradient_reverse_color' );
	
	if( $dp_primary_sidebar_color_style == "1" ) {
		$dp_primary_sidebar_shape = '0';
	} else {
		$dp_primary_sidebar_shape = $dp_primary_sidebar_gradient_style;
	}
	
	$dp_primary_sidebar_bg = bg_gradient (
		$dp_primary_sidebar_shape,
		$dp_primary_sidebar_color,
		$dp_primary_sidebar_color2,
		$dp_primary_sidebar_color_style,
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		$dp_primary_sidebar_gradient_position_parameter1,
		$dp_primary_sidebar_gradient_position_parameter2,
		$dp_primary_sidebar_shade_strenght,
		$dp_primary_sidebar_gradient_reverse_color,
		$dp_primary_sidebar_gradient_advanced_toggle
	);
	
	
	$dp_primary_sidebar_border_style = dp_theme_mod( 'dp_primary_sidebar_border_style' );
	$dp_primary_sidebar_border_width_top = dp_theme_mod( 'dp_primary_sidebar_border_width_top' );
	$dp_primary_sidebar_border_width_right = dp_theme_mod( 'dp_primary_sidebar_border_width_right' );
	$dp_primary_sidebar_border_width_bottom = dp_theme_mod( 'dp_primary_sidebar_border_width_bottom' );
	$dp_primary_sidebar_border_width_left = dp_theme_mod( 'dp_primary_sidebar_border_width_left' );
	$dp_primary_sidebar_border_color = dp_theme_mod( 'dp_primary_sidebar_border_color' );
	
	if ( $dp_primary_sidebar_border_style != 'none' ) {
		$dp_primary_sidebar_border = '
			border-top: '.$dp_primary_sidebar_border_width_top.'px '.$dp_primary_sidebar_border_style.' '.$dp_primary_sidebar_border_color.';
			border-bottom: '.$dp_primary_sidebar_border_width_bottom.'px '.$dp_primary_sidebar_border_style.' '.$dp_primary_sidebar_border_color.';
			border-left: '.$dp_primary_sidebar_border_width_left.'px '.$dp_primary_sidebar_border_style.' '.$dp_primary_sidebar_border_color.';
			border-right: '.$dp_primary_sidebar_border_width_right.'px '.$dp_primary_sidebar_border_style.' '.$dp_primary_sidebar_border_color.';
		';
	} else {
		$dp_primary_sidebar_border = 'border: none;';
	}
	
	$dp_primary_sidebar_border_radius_topleft = dp_theme_mod( 'dp_primary_sidebar_border_radius_topleft' );
	$dp_primary_sidebar_border_radius_topright = dp_theme_mod( 'dp_primary_sidebar_border_radius_topright' );
	$dp_primary_sidebar_border_radius_bottomright = dp_theme_mod( 'dp_primary_sidebar_border_radius_bottomright' );
	$dp_primary_sidebar_border_radius_bottomleft = dp_theme_mod( 'dp_primary_sidebar_border_radius_bottomleft' );
	
	if ( $dp_primary_sidebar_border_radius_topleft == '0' AND $dp_primary_sidebar_border_radius_topright == '0' AND $dp_primary_sidebar_border_radius_bottomright == '0' AND $dp_primary_sidebar_border_radius_bottomleft == '0') {
		$dp_primary_sidebar_border_radius = 'border-radius: 0;';
	} else {
		$dp_primary_sidebar_border_radius = 'border-radius: ' . $dp_primary_sidebar_border_radius_topleft . 'px ' . $dp_primary_sidebar_border_radius_topright . 'px ' . $dp_primary_sidebar_border_radius_bottomright . 'px ' . $dp_primary_sidebar_border_radius_bottomleft . 'px;';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_style' ) == 'presets' ) {
		$dp_primary_sidebar_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_primary_sidebar_shadow_presets' ) - 1] . ';';
		
	} elseif ( dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_style' ) == 'custom' ) {
		$horizontal = dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_horizontal' );
		$vertical = dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_vertical' );
		$blur = dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_blur_radius' );
		$spread = dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_spread_radius' );
		$opacity = dp_theme_mod( 'dp_primary_sidebar_shadow_bottom_opacity' );
		
		$dp_primary_sidebar_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
		
	} else {
		$dp_primary_sidebar_shadow = 'box-shadow: none;';
	}
	
	/**
	* Section: Primary Sidebar Widgets
	*/
	
	$dp_primary_sidebar_widgets_padding_top = dp_theme_mod( 'dp_primary_sidebar_widgets_padding_top' );
	$dp_primary_sidebar_widgets_padding_bottom = dp_theme_mod( 'dp_primary_sidebar_widgets_padding_bottom' );
	$dp_primary_sidebar_widgets_padding_leftright = dp_theme_mod( 'dp_primary_sidebar_widgets_padding_leftright' );
	$dp_primary_sidebar_widgets_margin_top = dp_theme_mod( 'dp_primary_sidebar_widgets_margin_top' );
	$dp_primary_sidebar_widgets_margin_bottom = dp_theme_mod( 'dp_primary_sidebar_widgets_margin_bottom' );
	
	$dp_primary_sidebar_widgets_color_style = dp_theme_mod( 'dp_primary_sidebar_widgets_color_style' );
	$dp_primary_sidebar_widgets_color = dp_theme_mod( 'dp_primary_sidebar_widgets_color' );
	$dp_primary_sidebar_widgets_color2 = dp_theme_mod( 'dp_primary_sidebar_widgets_color2' );
	$dp_primary_sidebar_widgets_shade_strenght = dp_theme_mod( 'dp_primary_sidebar_widgets_shade_strenght' );
	$dp_primary_sidebar_widgets_gradient_style = dp_theme_mod( 'dp_primary_sidebar_widgets_gradient_style' );
	$dp_primary_sidebar_widgets_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_sidebar_widgets_gradient_advanced_toggle' );
	$dp_primary_sidebar_widgets_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_sidebar_widgets_gradient_position_parameter1' );
	$dp_primary_sidebar_widgets_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_sidebar_widgets_gradient_position_parameter2' );
	$dp_primary_sidebar_widgets_gradient_reverse_color = dp_theme_mod( 'dp_primary_sidebar_widgets_gradient_reverse_color' );
	
	if( $dp_primary_sidebar_widgets_color_style == "1" ) {
		$dp_primary_sidebar_widgets_shape = '0';
	} else {
		$dp_primary_sidebar_widgets_shape = $dp_primary_sidebar_widgets_gradient_style;
	}
	
	$dp_primary_sidebar_widgets_bg = bg_gradient (
		$dp_primary_sidebar_widgets_shape,
		$dp_primary_sidebar_widgets_color,
		$dp_primary_sidebar_widgets_color2,
		$dp_primary_sidebar_widgets_color_style,
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		$dp_primary_sidebar_widgets_gradient_position_parameter1,
		$dp_primary_sidebar_widgets_gradient_position_parameter2,
		$dp_primary_sidebar_widgets_shade_strenght,
		$dp_primary_sidebar_widgets_gradient_reverse_color,
		$dp_primary_sidebar_widgets_gradient_advanced_toggle
	);
	
	
	$dp_primary_sidebar_widgets_border_style = dp_theme_mod( 'dp_primary_sidebar_widgets_border_style' );
	$dp_primary_sidebar_widgets_border_width_top = dp_theme_mod( 'dp_primary_sidebar_widgets_border_width_top' );
	$dp_primary_sidebar_widgets_border_width_right = dp_theme_mod( 'dp_primary_sidebar_widgets_border_width_right' );
	$dp_primary_sidebar_widgets_border_width_bottom = dp_theme_mod( 'dp_primary_sidebar_widgets_border_width_bottom' );
	$dp_primary_sidebar_widgets_border_width_left = dp_theme_mod( 'dp_primary_sidebar_widgets_border_width_left' );
	$dp_primary_sidebar_widgets_border_color = dp_theme_mod( 'dp_primary_sidebar_widgets_border_color' );
	
	if ( $dp_primary_sidebar_widgets_border_style != 'none' ) {
		$dp_primary_sidebar_widgets_border = '
			border-top: '.$dp_primary_sidebar_widgets_border_width_top.'px '.$dp_primary_sidebar_widgets_border_style.' '.$dp_primary_sidebar_widgets_border_color.';
			border-bottom: '.$dp_primary_sidebar_widgets_border_width_bottom.'px '.$dp_primary_sidebar_widgets_border_style.' '.$dp_primary_sidebar_widgets_border_color.';
			border-left: '.$dp_primary_sidebar_widgets_border_width_left.'px '.$dp_primary_sidebar_widgets_border_style.' '.$dp_primary_sidebar_widgets_border_color.';
			border-right: '.$dp_primary_sidebar_widgets_border_width_right.'px '.$dp_primary_sidebar_widgets_border_style.' '.$dp_primary_sidebar_widgets_border_color.';
		';
	} else {
		$dp_primary_sidebar_widgets_border = 'border: none;';
	}
	
	$dp_primary_sidebar_widgets_border_radius_topleft = dp_theme_mod( 'dp_primary_sidebar_widgets_border_radius_topleft' );
	$dp_primary_sidebar_widgets_border_radius_topright = dp_theme_mod( 'dp_primary_sidebar_widgets_border_radius_topright' );
	$dp_primary_sidebar_widgets_border_radius_bottomright = dp_theme_mod( 'dp_primary_sidebar_widgets_border_radius_bottomright' );
	$dp_primary_sidebar_widgets_border_radius_bottomleft = dp_theme_mod( 'dp_primary_sidebar_widgets_border_radius_bottomleft' );
	
	if ( $dp_primary_sidebar_widgets_border_radius_topleft == '0' AND $dp_primary_sidebar_widgets_border_radius_topright == '0' AND $dp_primary_sidebar_widgets_border_radius_bottomright == '0' AND $dp_primary_sidebar_widgets_border_radius_bottomleft == '0') {
		$dp_primary_sidebar_widgets_border_radius = 'border-radius: 0;';
	} else {
		$dp_primary_sidebar_widgets_border_radius = 'border-radius: ' . $dp_primary_sidebar_widgets_border_radius_topleft . 'px ' . $dp_primary_sidebar_widgets_border_radius_topright . 'px ' . $dp_primary_sidebar_widgets_border_radius_bottomright . 'px ' . $dp_primary_sidebar_widgets_border_radius_bottomleft . 'px;';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_style' ) == 'presets' ) {
		$dp_primary_sidebar_widgets_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_presets' ) - 1] . ';';
		
	} elseif ( dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_style' ) == 'custom' ) {
		$horizontal = dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_horizontal' );
		$vertical = dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_vertical' );
		$blur = dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_blur_radius' );
		$spread = dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_spread_radius' );
		$opacity = dp_theme_mod( 'dp_primary_sidebar_widgets_shadow_bottom_opacity' );
		
		$dp_primary_sidebar_widgets_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
		
	} else {
		$dp_primary_sidebar_widgets_shadow = 'box-shadow: none;';
	}
	
	$dp_primary_sidebar_widgets_font_size = dp_theme_mod( 'dp_primary_sidebar_widgets_font_size' );
	$dp_primary_sidebar_widgets_font_weight = dp_theme_mod( 'dp_primary_sidebar_widgets_font_weight' );
	$dp_primary_sidebar_widgets_font_color = dp_theme_mod( 'dp_primary_sidebar_widgets_font_color' );
	$dp_primary_sidebar_widgets_link_color = dp_theme_mod( 'dp_primary_sidebar_widgets_link_color' );
	$dp_primary_sidebar_widgets_link_color_hover = dp_theme_mod( 'dp_primary_sidebar_widgets_link_color_hover' );
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_font_family_toggle' ) == true ) {
		$dp_primary_sidebar_widgets_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_primary_sidebar_widgets_font_family = dp_decode_fonts( dp_theme_mod( 'dp_primary_sidebar_widgets_font_family' ) );
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_link_underline' ) == true ) {
		$dp_primary_sidebar_widgets_link_underline = 'underline';
	} else {
		$dp_primary_sidebar_widgets_link_underline = 'none';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_link_hover_underline' ) == true ) {
		$dp_primary_sidebar_widgets_link_hover_underline = 'underline';
	} else {
		$dp_primary_sidebar_widgets_link_hover_underline = 'none';
	}
	
	/**
	* Section: Primary Sidebar Widgets Title
	*/
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_width' ) === true ) {
		$dp_primary_sidebar_widgets_title_width = '-'. dp_theme_mod( 'dp_primary_sidebar_widgets_padding_leftright' );
	} else {
		$dp_primary_sidebar_widgets_title_width = '0';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_content_width' ) === true ) {
		$dp_primary_sidebar_widgets_title_content_width = 'block';
	} else {
		$dp_primary_sidebar_widgets_title_content_width = 'inline-block';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_container_background' ) === true ) {
		$dp_primary_sidebar_widgets_title_container_background = 'transparent';
	} else {
		$dp_primary_sidebar_widgets_title_container_background = $dp_primary_sidebar_color;
	}
	
	$dp_primary_sidebar_widgets_title_padding = dp_theme_mod( 'dp_primary_sidebar_widgets_title_padding' );
	$dp_primary_sidebar_widgets_title_margin_top = dp_theme_mod( 'dp_primary_sidebar_widgets_title_margin_top' );
	$dp_primary_sidebar_widgets_title_margin_bottom = dp_theme_mod( 'dp_primary_sidebar_widgets_title_margin_bottom' );
	
	$dp_primary_sidebar_widgets_title_color_style = dp_theme_mod( 'dp_primary_sidebar_widgets_title_color_style' );
	$dp_primary_sidebar_widgets_title_color = dp_theme_mod( 'dp_primary_sidebar_widgets_title_color' );
	$dp_primary_sidebar_widgets_title_color2 = dp_theme_mod( 'dp_primary_sidebar_widgets_title_color2' );
	$dp_primary_sidebar_widgets_title_shade_strenght = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shade_strenght' );
	$dp_primary_sidebar_widgets_title_gradient_style = dp_theme_mod( 'dp_primary_sidebar_widgets_title_gradient_style' );
	$dp_primary_sidebar_widgets_title_gradient_advanced_toggle = dp_theme_mod( 'dp_primary_sidebar_widgets_title_gradient_advanced_toggle' );
	$dp_primary_sidebar_widgets_title_gradient_position_parameter1 = dp_theme_mod( 'dp_primary_sidebar_widgets_title_gradient_position_parameter1' );
	$dp_primary_sidebar_widgets_title_gradient_position_parameter2 = dp_theme_mod( 'dp_primary_sidebar_widgets_title_gradient_position_parameter2' );
	$dp_primary_sidebar_widgets_title_gradient_reverse_color = dp_theme_mod( 'dp_primary_sidebar_widgets_title_gradient_reverse_color' );
	
	if( $dp_primary_sidebar_widgets_title_color_style == "1" ) {
		$dp_primary_sidebar_widgets_title_shape = '0';
	} else {
		$dp_primary_sidebar_widgets_title_shape = $dp_primary_sidebar_widgets_title_gradient_style;
	}
	
	$dp_primary_sidebar_widgets_title_bg = bg_gradient (
		$dp_primary_sidebar_widgets_title_shape,
		$dp_primary_sidebar_widgets_title_color,
		$dp_primary_sidebar_widgets_title_color2,
		$dp_primary_sidebar_widgets_title_color_style,
		'',
		'',
		'',
		'',
		'',
		'',
		'',
		$dp_primary_sidebar_widgets_title_gradient_position_parameter1,
		$dp_primary_sidebar_widgets_title_gradient_position_parameter2,
		$dp_primary_sidebar_widgets_title_shade_strenght,
		$dp_primary_sidebar_widgets_title_gradient_reverse_color,
		$dp_primary_sidebar_widgets_title_gradient_advanced_toggle
	);
	
	
	$dp_primary_sidebar_widgets_title_border_style = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_style' );
	$dp_primary_sidebar_widgets_title_border_width_top = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_width_top' );
	$dp_primary_sidebar_widgets_title_border_width_right = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_width_right' );
	$dp_primary_sidebar_widgets_title_border_width_bottom = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_width_bottom' );
	$dp_primary_sidebar_widgets_title_border_width_left = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_width_left' );
	$dp_primary_sidebar_widgets_title_border_color = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_color' );
	
	if ( $dp_primary_sidebar_widgets_title_border_style != 'none' ) {
		$dp_primary_sidebar_widgets_title_border = '
			border-top: '.$dp_primary_sidebar_widgets_title_border_width_top.'px '.$dp_primary_sidebar_widgets_title_border_style.' '.$dp_primary_sidebar_widgets_title_border_color.';
			border-bottom: '.$dp_primary_sidebar_widgets_title_border_width_bottom.'px '.$dp_primary_sidebar_widgets_title_border_style.' '.$dp_primary_sidebar_widgets_title_border_color.';
			border-left: '.$dp_primary_sidebar_widgets_title_border_width_left.'px '.$dp_primary_sidebar_widgets_title_border_style.' '.$dp_primary_sidebar_widgets_title_border_color.';
			border-right: '.$dp_primary_sidebar_widgets_title_border_width_right.'px '.$dp_primary_sidebar_widgets_title_border_style.' '.$dp_primary_sidebar_widgets_title_border_color.';
		';
	} else {
		$dp_primary_sidebar_widgets_title_border = 'border: none;';
	}
	
	$dp_primary_sidebar_widgets_title_border_radius_topleft = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_radius_topleft' );
	$dp_primary_sidebar_widgets_title_border_radius_topright = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_radius_topright' );
	$dp_primary_sidebar_widgets_title_border_radius_bottomright = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_radius_bottomright' );
	$dp_primary_sidebar_widgets_title_border_radius_bottomleft = dp_theme_mod( 'dp_primary_sidebar_widgets_title_border_radius_bottomleft' );
	
	if ( $dp_primary_sidebar_widgets_title_border_radius_topleft == '0' AND $dp_primary_sidebar_widgets_title_border_radius_topright == '0' AND $dp_primary_sidebar_widgets_title_border_radius_bottomright == '0' AND $dp_primary_sidebar_widgets_title_border_radius_bottomleft == '0') {
		$dp_primary_sidebar_widgets_title_border_radius = 'border-radius: 0;';
	} else {
		$dp_primary_sidebar_widgets_title_border_radius = 'border-radius: ' . $dp_primary_sidebar_widgets_title_border_radius_topleft . 'px ' . $dp_primary_sidebar_widgets_title_border_radius_topright . 'px ' . $dp_primary_sidebar_widgets_title_border_radius_bottomright . 'px ' . $dp_primary_sidebar_widgets_title_border_radius_bottomleft . 'px;';
	}
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_style' ) == 'presets' ) {
		$dp_primary_sidebar_widgets_title_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_presets' ) - 1] . ';';
		
	} elseif ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_style' ) == 'custom' ) {
		$horizontal = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal' );
		$vertical = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_vertical' );
		$blur = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius' );
		$spread = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius' );
		$opacity = dp_theme_mod( 'dp_primary_sidebar_widgets_title_shadow_bottom_opacity' );
		
		$dp_primary_sidebar_widgets_title_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
		
	} else {
		$dp_primary_sidebar_widgets_title_shadow = 'box-shadow: none;';
	}
	
	$dp_primary_sidebar_widgets_title_font_size = dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_size' );
	$dp_primary_sidebar_widgets_title_font_weight = dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_weight' );
	$dp_primary_sidebar_widgets_title_font_color = dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_color' );
	
	if ( dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_family_toggle' ) == true ) {
		$dp_primary_sidebar_widgets_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_primary_sidebar_widgets_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_family' ) );
	}
	
	// Footer
	$dp_footer_padding_top = dp_theme_mod( 'dp_footer_padding_top' );
	$dp_footer_padding_right = dp_theme_mod( 'dp_footer_padding_right' );
	$dp_footer_padding_bottom = dp_theme_mod( 'dp_footer_padding_bottom' );
	$dp_footer_padding_left = dp_theme_mod( 'dp_footer_padding_left' );
	$dp_footer_margin_top = dp_theme_mod( 'dp_footer_margin_top' );
	$dp_footer_margin_bottom = dp_theme_mod( 'dp_footer_margin_bottom' );
	
	$dp_footer_color_style = dp_theme_mod( 'dp_footer_color_style' );
	$dp_footer_color = dp_theme_mod( 'dp_footer_color' );
	$dp_footer_color2 = dp_theme_mod( 'dp_footer_color2' );
	$dp_footer_shade_strenght = dp_theme_mod( 'dp_footer_shade_strenght' );
	$dp_footer_gradient_style = dp_theme_mod( 'dp_footer_gradient_style' );
	$dp_footer_gradient_advanced_toggle = dp_theme_mod( 'dp_footer_gradient_advanced_toggle' );
	$dp_footer_gradient_position_parameter1 = dp_theme_mod( 'dp_footer_gradient_position_parameter1' );
	$dp_footer_gradient_position_parameter2 = dp_theme_mod( 'dp_footer_gradient_position_parameter2' );
	$dp_footer_gradient_reverse_color = dp_theme_mod( 'dp_footer_gradient_reverse_color' );
	$dp_footer_img_panel = dp_theme_mod( 'dp_footer_img_panel' );
	$dp_footer_pattern = dp_theme_mod( 'dp_footer_pattern' );
	$dp_footer_img_upload = dp_theme_mod( 'dp_footer_img_upload' );
	$dp_footer_img_repeat = dp_theme_mod( 'dp_footer_img_repeat' );
	$dp_footer_img_size = dp_theme_mod( 'dp_footer_img_size' );
	$dp_footer_img_attachment = dp_theme_mod( 'dp_footer_img_attachment' );
	$dp_footer_img_position = dp_theme_mod( 'dp_footer_img_position' );
	
	if( $dp_footer_color_style == "1" ) {
		$dp_footer_shape = '0';
	} else {
		$dp_footer_shape = $dp_footer_gradient_style;
	}
	
	$dp_footer_bg = bg_gradient (
		$dp_footer_shape,
		$dp_footer_color,
		$dp_footer_color2,
		$dp_footer_color_style,
		$dp_footer_img_panel,
		$dp_footer_pattern,
		$dp_footer_img_upload,
		$dp_footer_img_position,
		$dp_footer_img_size,
		$dp_footer_img_repeat,
		$dp_footer_img_attachment,
		$dp_footer_gradient_position_parameter1,
		$dp_footer_gradient_position_parameter2,
		$dp_footer_shade_strenght,
		$dp_footer_gradient_reverse_color,
		$dp_footer_gradient_advanced_toggle
	);
	
	$dp_footer_border_style = dp_theme_mod( 'dp_footer_border_style' );
	$dp_footer_border_width_top = dp_theme_mod( 'dp_footer_border_width_top' );
	$dp_footer_border_width_right = dp_theme_mod( 'dp_footer_border_width_right' );
	$dp_footer_border_width_bottom = dp_theme_mod( 'dp_footer_border_width_bottom' );
	$dp_footer_border_width_left = dp_theme_mod( 'dp_footer_border_width_left' );
	$dp_footer_border_color = dp_theme_mod( 'dp_footer_border_color' );
	
	if ( $dp_footer_border_style != 'none' ) {
		$footer_border_style = '
			border-top: '.$dp_footer_border_width_top.'px '.$dp_footer_border_style.' '.$dp_footer_border_color.';
			border-bottom: '.$dp_footer_border_width_bottom.'px '.$dp_footer_border_style.' '.$dp_footer_border_color.';
			border-left: '.$dp_footer_border_width_left.'px '.$dp_footer_border_style.' '.$dp_footer_border_color.';
			border-right: '.$dp_footer_border_width_right.'px '.$dp_footer_border_style.' '.$dp_footer_border_color.';
	';
	} else {
		$footer_border_style = 'border: none;';
	}
	
	$dp_footer_border_radius_topleft = dp_theme_mod( 'dp_footer_border_radius_topleft' );
	$dp_footer_border_radius_topright = dp_theme_mod( 'dp_footer_border_radius_topright' );
	$dp_footer_border_radius_bottomright = dp_theme_mod( 'dp_footer_border_radius_bottomright' );
	$dp_footer_border_radius_bottomleft = dp_theme_mod( 'dp_footer_border_radius_bottomleft' );
	
	if ( $dp_footer_border_radius_topleft == '0' AND $dp_footer_border_radius_topright == '0' AND $dp_footer_border_radius_bottomright == '0' AND $dp_footer_border_radius_bottomleft == '0') {
		$dp_footer_border_radius = 'border-radius: 0;';
	} else {
		$dp_footer_border_radius = 'border-radius: ' . $dp_footer_border_radius_topleft . 'px ' . $dp_footer_border_radius_topright . 'px ' . $dp_footer_border_radius_bottomright . 'px ' . $dp_footer_border_radius_bottomleft . 'px;';
	}
	
	$dp_footer_font_size = dp_theme_mod( 'dp_footer_font_size' );
	$dp_footer_font_weight = dp_theme_mod( 'dp_footer_font_weight' );
	$dp_footer_font_color = dp_theme_mod( 'dp_footer_font_color' );
	$dp_footer_link_color = dp_theme_mod( 'dp_footer_link_color' );
	$dp_footer_link_color_hover = dp_theme_mod( 'dp_footer_link_color_hover' );
	
	if ( dp_theme_mod( 'dp_footer_font_family_toggle' ) == true ) {
		$dp_footer_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_footer_font_family = dp_decode_fonts( dp_theme_mod( 'dp_footer_font_family' ) );
	}
	
	if ( dp_theme_mod( 'dp_footer_link_underline' ) == true ) {
		$dp_footer_link_underline = 'underline';
	} else {
		$dp_footer_link_underline = 'none';
	}
	
	if ( dp_theme_mod( 'dp_footer_link_hover_underline' ) == true ) {
		$dp_footer_link_hover_underline = 'underline';
	} else {
		$dp_footer_link_hover_underline = 'none';
	}
	
	
	$dp_footer_widget_title_font_size = dp_theme_mod( 'dp_footer_widget_title_font_size' );
	$dp_footer_widget_title_font_weight = dp_theme_mod( 'dp_footer_widget_title_font_weight' );
	
	
	if ( dp_theme_mod( 'dp_footer_widget_title_font_family_toggle' ) == true ) {
		$dp_footer_widget_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
	} else {
		$dp_footer_widget_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_footer_widget_title_font_family' ) );
	}
	
	// Front Page Grid
//	$dp_front_page_grid_container_margin_top = dp_theme_mod( 'dp_front_page_grid_container_margin_top' );
//	$dp_front_page_grid_container_margin_bottom = dp_theme_mod( 'dp_front_page_grid_container_margin_bottom' );
//	$dp_front_page_grid_items_per_line = dp_theme_mod( 'dp_front_page_grid_items_per_line' );
//	//$dp_front_page_grid_items_width = round( 100 / $dp_front_page_grid_items_per_line, 2 );
//	$dp_front_page_grid_item_dimensions = dp_theme_mod( 'dp_front_page_grid_item_dimensions' );
//	$dp_front_page_grid_item_padding = dp_theme_mod( 'dp_front_page_grid_item_padding' );
//	$dp_front_page_grid_item_border_radius = dp_theme_mod( 'dp_front_page_grid_item_border_radius' );
//	//$dp_front_page_grid_item_title_background_height = dp_theme_mod( 'dp_front_page_grid_item_title_background_height' );
//	$dp_front_page_grid_item_title_background_color = dp_theme_mod( 'dp_front_page_grid_item_title_background_color' );
//	$dp_front_page_grid_item_title_font_color = dp_theme_mod( 'dp_front_page_grid_item_title_font_color' );
//	$dp_front_page_grid_item_meta_font_color = dp_theme_mod( 'dp_front_page_grid_item_meta_font_color' );
//	$dp_front_page_grid_item_title_font_size = dp_theme_mod( 'dp_front_page_grid_item_title_font_size' );
//	$dp_front_page_grid_item_title_font_weight = dp_theme_mod( 'dp_front_page_grid_item_title_font_weight' );
//	$dp_front_page_grid_item_meta_font_size = dp_theme_mod( 'dp_front_page_grid_item_meta_font_size' );
//
//	$dp_front_page_grid_item_nth_toggle = dp_theme_mod( 'dp_front_page_grid_item_nth_toggle' );
//	$dp_front_page_grid_item_nth_limit = dp_theme_mod( 'dp_front_page_grid_item_nth_limit' );
//	//$dp_front_page_grid_item_nth_selector = dp_theme_mod( 'dp_front_page_grid_item_nth_selector' );
//	$dp_front_page_grid_items_nth_per_line = dp_theme_mod( 'dp_front_page_grid_items_nth_per_line' );
//	//$dp_front_page_grid_items_nth_width = round( 100 / $dp_front_page_grid_items_nth_per_line, 2 );
//	//$dp_front_page_grid_item_nth_title_background_height = dp_theme_mod( 'dp_front_page_grid_item_nth_title_background_height' );
//	$dp_front_page_grid_item_nth_title_background_color = dp_theme_mod( 'dp_front_page_grid_item_nth_title_background_color' );
//	$dp_front_page_grid_item_nth_title_font_color = dp_theme_mod( 'dp_front_page_grid_item_nth_title_font_color' );
//	$dp_front_page_grid_item_nth_meta_font_color = dp_theme_mod( 'dp_front_page_grid_item_nth_meta_font_color' );
//	$dp_front_page_grid_item_nth_title_font_size = dp_theme_mod( 'dp_front_page_grid_item_nth_title_font_size' );
//	$dp_front_page_grid_item_nth_title_font_weight = dp_theme_mod( 'dp_front_page_grid_item_nth_title_font_weight' );
//	$dp_front_page_grid_item_nth_meta_font_size = dp_theme_mod( 'dp_front_page_grid_item_nth_meta_font_size' );
//
//	if ( $dp_front_page_grid_item_nth_toggle == true ) {
//
//		if ( dp_theme_mod( 'dp_front_page_grid_item_nth_selector' ) == "1" ) {
//			$dp_front_page_grid_item_nth = '-n+' . $dp_front_page_grid_item_nth_limit;
//		} else {
//			$dp_front_page_grid_item_nth = $dp_front_page_grid_item_nth_limit . 'n+1' ;
//		}
//
//		$dp_front_page_grid_item_nth_output = '
//
//		.dp-custom-post-loop-wrap-parent:nth-child(' . $dp_front_page_grid_item_nth . ') {
//			width: ' . $dp_front_page_grid_items_nth_per_line . ';
//		}
//
//		.dp-custom-post-loop-wrap-parent:nth-child(' . $dp_front_page_grid_item_nth . ') .dp-custom-post-loop-content-wrap {
//			height: auto;
//			background: ' . $dp_front_page_grid_item_nth_title_background_color . ';
//		}
//
//		.dp-custom-post-loop-wrap-parent:nth-child(' . $dp_front_page_grid_item_nth . ') .dp-custom-post-loop-title {
//			color: ' . $dp_front_page_grid_item_nth_title_font_color . ';
//			font-size: ' . $dp_front_page_grid_item_nth_title_font_size . 'px;
//			font-weight: ' . $dp_front_page_grid_item_nth_title_font_weight . ';
//		}
//
//		.dp-custom-post-loop-wrap-parent:nth-child(' . $dp_front_page_grid_item_nth . ') .dp-custom-post-loop-meta {
//			color: ' . $dp_front_page_grid_item_nth_meta_font_color . ';
//			font-size: ' . $dp_front_page_grid_item_nth_meta_font_size . 'px;
//		}
//		';
//
//	} else {
//		$dp_front_page_grid_item_nth_output = '';
//	}

    // Page
//    $dp_page_font_family_toggle = dp_decode_fonts( dp_theme_mod( 'dp_page_font_family_toggle' ) );
//    if ( $dp_page_font_family_toggle == true ) {
//        $dp_page_font_family = dp_decode_fonts(dp_theme_mod('dp_typography_font_family'));
//    } else {
//        $dp_page_font_family = dp_decode_fonts(dp_theme_mod('dp_page_font_family'));
//    }

    $dp_page_padding_top = dp_theme_mod( 'dp_page_padding_top' );
    $dp_page_padding_right = dp_theme_mod( 'dp_page_padding_right' );
    $dp_page_padding_bottom = dp_theme_mod( 'dp_page_padding_bottom' );
    $dp_page_padding_left = dp_theme_mod( 'dp_page_padding_left' );

    $dp_page_margin_top = dp_theme_mod( 'dp_page_margin_top' );
    $dp_page_margin_right = dp_theme_mod( 'dp_page_margin_right' );
    $dp_page_margin_bottom = dp_theme_mod( 'dp_page_margin_bottom' );
    $dp_page_margin_left = dp_theme_mod( 'dp_page_margin_left' );

    $dp_page_border_radius_top_left = dp_theme_mod( 'dp_page_border_radius_top_left' );
    $dp_page_border_radius_top_right = dp_theme_mod( 'dp_page_border_radius_top_right' );
    $dp_page_border_radius_bottom_right = dp_theme_mod( 'dp_page_border_radius_bottom_right' );
    $dp_page_border_radius_bottom_left = dp_theme_mod( 'dp_page_border_radius_bottom_left' );

    if ( $dp_page_border_radius_top_left == '0' AND $dp_page_border_radius_top_right == '0' AND $dp_page_border_radius_bottom_right == '0' AND $dp_page_border_radius_bottom_left == '0') {
        $dp_page_border_radius = 'border-radius: 0;';
    } else {
        $dp_page_border_radius = 'border-radius: ' . $dp_page_border_radius_top_left . 'px ' . $dp_page_border_radius_top_right . 'px ' . $dp_page_border_radius_bottom_right . 'px ' . $dp_page_border_radius_bottom_left . 'px;';
    }

    $dp_page_border_style = dp_theme_mod( 'dp_page_border_style' );
    $dp_page_border_top = dp_theme_mod( 'dp_page_border_top' );
    $dp_page_border_right = dp_theme_mod( 'dp_page_border_right' );
    $dp_page_border_bottom = dp_theme_mod( 'dp_page_border_bottom' );
    $dp_page_border_left = dp_theme_mod( 'dp_page_border_left' );
    $dp_page_border_color = dp_theme_mod( 'dp_page_border_color' );

    if ( $dp_page_border_style != 'none' ) {
        $page_border_style = '
			border-top: '.$dp_page_border_top.'px '.$dp_page_border_style.' '.$dp_page_border_color.';
			border-bottom: '.$dp_page_border_bottom.'px '.$dp_page_border_style.' '.$dp_page_border_color.';
			border-left: '.$dp_page_border_left.'px '.$dp_page_border_style.' '.$dp_page_border_color.';
			border-right: '.$dp_page_border_right.'px '.$dp_page_border_style.' '.$dp_page_border_color.';
	';
    } else {
        $page_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_page_shadow_style' ) == 'presets' ) {
        $dp_page_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_page_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_page_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_page_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_page_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_page_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_page_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_page_shadow_opacity' );

        $dp_page_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_page_shadow = 'box-shadow: none;';
    }

    $dp_page_color_style = dp_theme_mod( 'dp_page_color_style' );
    $dp_page_color = dp_theme_mod( 'dp_page_color' );
    $dp_page_color2 = dp_theme_mod( 'dp_page_color2' );
    $dp_page_shade_strenght = dp_theme_mod( 'dp_page_shade_strenght' );
    $dp_page_gradient_style = dp_theme_mod( 'dp_page_gradient_style' );
    $dp_page_gradient_advanced_toggle = dp_theme_mod( 'dp_page_gradient_advanced_toggle' );
    $dp_page_gradient_position_parameter1 = dp_theme_mod( 'dp_page_gradient_position_parameter1' );
    $dp_page_gradient_position_parameter2 = dp_theme_mod( 'dp_page_gradient_position_parameter2' );
    $dp_page_gradient_reverse_color = dp_theme_mod( 'dp_page_gradient_reverse_color' );

    if( $dp_page_color_style == "1" ) {
        $dp_page_shape = '0';
    } else {
        $dp_page_shape = $dp_page_gradient_style;
    }

    $dp_page_bg = bg_gradient (
        $dp_page_shape,
        $dp_page_color,
        $dp_page_color2,
        $dp_page_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_page_gradient_position_parameter1,
        $dp_page_gradient_position_parameter2,
        $dp_page_shade_strenght,
        $dp_page_gradient_reverse_color,
        $dp_page_gradient_advanced_toggle
    );



    // Page Featured Image
    $dp_page_featured_image_max_height = dp_theme_mod( 'dp_page_featured_image_max_height' );

    $dp_page_featured_image_padding_top = dp_theme_mod( 'dp_page_featured_image_padding_top' );
    $dp_page_featured_image_padding_right = dp_theme_mod( 'dp_page_featured_image_padding_right' );
    $dp_page_featured_image_padding_bottom = dp_theme_mod( 'dp_page_featured_image_padding_bottom' );
    $dp_page_featured_image_padding_left = dp_theme_mod( 'dp_page_featured_image_padding_left' );

    $dp_page_featured_image_margin_top = dp_theme_mod( 'dp_page_featured_image_margin_top' );
    $dp_page_featured_image_margin_right = dp_theme_mod( 'dp_page_featured_image_margin_right' );
    $dp_page_featured_image_margin_bottom = dp_theme_mod( 'dp_page_featured_image_margin_bottom' );
    $dp_page_featured_image_margin_left = dp_theme_mod( 'dp_page_featured_image_margin_left' );

    $dp_page_featured_image_border_radius_top_left = dp_theme_mod( 'dp_page_featured_image_border_radius_top_left' );
    $dp_page_featured_image_border_radius_top_right = dp_theme_mod( 'dp_page_featured_image_border_radius_top_right' );
    $dp_page_featured_image_border_radius_bottom_right = dp_theme_mod( 'dp_page_featured_image_border_radius_bottom_right' );
    $dp_page_featured_image_border_radius_bottom_left = dp_theme_mod( 'dp_page_featured_image_border_radius_bottom_left' );

    if ( $dp_page_featured_image_border_radius_top_left == '0' AND $dp_page_featured_image_border_radius_top_right == '0' AND $dp_page_featured_image_border_radius_bottom_right == '0' AND $dp_page_featured_image_border_radius_bottom_left == '0') {
        $dp_page_featured_image_border_radius = 'border-radius: 0;';
    } else {
        $dp_page_featured_image_border_radius = 'border-radius: ' . $dp_page_featured_image_border_radius_top_left . 'px ' . $dp_page_featured_image_border_radius_top_right . 'px ' . $dp_page_featured_image_border_radius_bottom_right . 'px ' . $dp_page_featured_image_border_radius_bottom_left . 'px;';
    }

    $dp_page_featured_image_border_style = dp_theme_mod( 'dp_page_featured_image_border_style' );
    $dp_page_featured_image_border_top = dp_theme_mod( 'dp_page_featured_image_border_top' );
    $dp_page_featured_image_border_right = dp_theme_mod( 'dp_page_featured_image_border_right' );
    $dp_page_featured_image_border_bottom = dp_theme_mod( 'dp_page_featured_image_border_bottom' );
    $dp_page_featured_image_border_left = dp_theme_mod( 'dp_page_featured_image_border_left' );
    $dp_page_featured_image_border_color = dp_theme_mod( 'dp_page_featured_image_border_color' );

    if ( $dp_page_featured_image_border_style != 'none' ) {
        $page_featured_image_border_style = '
			border-top: '.$dp_page_featured_image_border_top.'px '.$dp_page_featured_image_border_style.' '.$dp_page_featured_image_border_color.';
			border-bottom: '.$dp_page_featured_image_border_bottom.'px '.$dp_page_featured_image_border_style.' '.$dp_page_featured_image_border_color.';
			border-left: '.$dp_page_featured_image_border_left.'px '.$dp_page_featured_image_border_style.' '.$dp_page_featured_image_border_color.';
			border-right: '.$dp_page_featured_image_border_right.'px '.$dp_page_featured_image_border_style.' '.$dp_page_featured_image_border_color.';
	';
    } else {
        $page_featured_image_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_page_featured_image_shadow_style' ) == 'presets' ) {
        $dp_page_featured_image_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_page_featured_image_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_page_featured_image_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_page_featured_image_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_page_featured_image_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_page_featured_image_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_page_featured_image_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_page_featured_image_shadow_opacity' );

        $dp_page_featured_image_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_page_featured_image_shadow = 'box-shadow: none;';
    }

    $dp_page_featured_image_color_style = dp_theme_mod( 'dp_page_featured_image_color_style' );
    $dp_page_featured_image_color = dp_theme_mod( 'dp_page_featured_image_color' );
    $dp_page_featured_image_color2 = dp_theme_mod( 'dp_page_featured_image_color2' );
    $dp_page_featured_image_shade_strenght = dp_theme_mod( 'dp_page_featured_image_shade_strenght' );
    $dp_page_featured_image_gradient_style = dp_theme_mod( 'dp_page_featured_image_gradient_style' );
    $dp_page_featured_image_gradient_advanced_toggle = dp_theme_mod( 'dp_page_featured_image_gradient_advanced_toggle' );
    $dp_page_featured_image_gradient_position_parameter1 = dp_theme_mod( 'dp_page_featured_image_gradient_position_parameter1' );
    $dp_page_featured_image_gradient_position_parameter2 = dp_theme_mod( 'dp_page_featured_image_gradient_position_parameter2' );
    $dp_page_featured_image_gradient_reverse_color = dp_theme_mod( 'dp_page_featured_image_gradient_reverse_color' );

    if( $dp_page_featured_image_color_style == "1" ) {
        $dp_page_featured_image_shape = '0';
    } else {
        $dp_page_featured_image_shape = $dp_page_featured_image_gradient_style;
    }

    $dp_page_featured_image_bg = bg_gradient (
        $dp_page_featured_image_shape,
        $dp_page_featured_image_color,
        $dp_page_featured_image_color2,
        $dp_page_featured_image_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_page_featured_image_gradient_position_parameter1,
        $dp_page_featured_image_gradient_position_parameter2,
        $dp_page_featured_image_shade_strenght,
        $dp_page_featured_image_gradient_reverse_color,
        $dp_page_featured_image_gradient_advanced_toggle
    );

    // Page Title
    if ( dp_theme_mod( 'dp_page_header_location_inside_image_vertical' ) == 'top' ) {
        $dp_page_header_location_inside_image_vertical = 'top: 0;';
    } elseif ( dp_theme_mod( 'dp_page_header_location_inside_image_vertical' ) == 'middle' ) {
        $dp_page_header_location_inside_image_vertical = 'top: 40%;';
    } else {
        $dp_page_header_location_inside_image_vertical = 'bottom: 0;';
    }
    $dp_page_header_text_align = dp_theme_mod( 'dp_page_header_text_align' );
    $dp_page_header_location_inside_image_horizontal = dp_theme_mod( 'dp_page_header_location_inside_image_horizontal' );


    if ( dp_theme_mod( 'dp_page_header_width' ) == '100%') {
        $dp_page_header_left = dp_theme_mod( 'dp_page_header_margin_left' ) . 'px';
        $dp_page_header_right = dp_theme_mod( 'dp_page_header_margin_right' ) . 'px';
        $dp_page_header_width_calc = $dp_page_header_left + $dp_page_header_right;
        $dp_page_header_width = 'calc(100% - ' . $dp_page_header_width_calc . 'px)';
        //$dp_page_header_wrap_width = 'auto';
        //$dp_page_header_margin_adjustment = 'margin-right: 0px;margin-left: 0px;';
    } else {
        $dp_page_header_left = 'initial';
        $dp_page_header_right = 'initial';
        $dp_page_header_width = 'auto';
        //$dp_page_header_wrap_width = '100%';
        //$dp_page_header_margin_adjustment = '';
    }

    $dp_page_header_font_size = dp_theme_mod( 'dp_page_header_font_size' );
    $dp_page_header_font_weight = dp_theme_mod( 'dp_page_header_font_weight' );
    $dp_page_header_font_color = dp_theme_mod( 'dp_page_header_font_color' );

    $dp_page_header_padding_top = dp_theme_mod( 'dp_page_header_padding_top' );
    $dp_page_header_padding_right = dp_theme_mod( 'dp_page_header_padding_right' );
    $dp_page_header_padding_bottom = dp_theme_mod( 'dp_page_header_padding_bottom' );
    $dp_page_header_padding_left = dp_theme_mod( 'dp_page_header_padding_left' );

    $dp_page_header_margin_top = dp_theme_mod( 'dp_page_header_margin_top' );
    $dp_page_header_margin_right = dp_theme_mod( 'dp_page_header_margin_right' );
    $dp_page_header_margin_bottom = dp_theme_mod( 'dp_page_header_margin_bottom' );
    $dp_page_header_margin_left = dp_theme_mod( 'dp_page_header_margin_left' );

    $dp_page_header_border_radius_top_left = dp_theme_mod( 'dp_page_header_border_radius_top_left' );
    $dp_page_header_border_radius_top_right = dp_theme_mod( 'dp_page_header_border_radius_top_right' );
    $dp_page_header_border_radius_bottom_right = dp_theme_mod( 'dp_page_header_border_radius_bottom_right' );
    $dp_page_header_border_radius_bottom_left = dp_theme_mod( 'dp_page_header_border_radius_bottom_left' );

    if ( $dp_page_header_border_radius_top_left == '0' AND $dp_page_header_border_radius_top_right == '0' AND $dp_page_header_border_radius_bottom_right == '0' AND $dp_page_header_border_radius_bottom_left == '0') {
        $dp_page_header_border_radius = 'border-radius: 0;';
    } else {
        $dp_page_header_border_radius = 'border-radius: ' . $dp_page_header_border_radius_top_left . 'px ' . $dp_page_header_border_radius_top_right . 'px ' . $dp_page_header_border_radius_bottom_right . 'px ' . $dp_page_header_border_radius_bottom_left . 'px;';
    }

    $dp_page_header_border_style = dp_theme_mod( 'dp_page_header_border_style' );
    $dp_page_header_border_top = dp_theme_mod( 'dp_page_header_border_top' );
    $dp_page_header_border_right = dp_theme_mod( 'dp_page_header_border_right' );
    $dp_page_header_border_bottom = dp_theme_mod( 'dp_page_header_border_bottom' );
    $dp_page_header_border_left = dp_theme_mod( 'dp_page_header_border_left' );
    $dp_page_header_border_color = dp_theme_mod( 'dp_page_header_border_color' );

    if ( $dp_page_header_border_style != 'none' ) {
        $page_header_border_style = '
			border-top: '.$dp_page_header_border_top.'px '.$dp_page_header_border_style.' '.$dp_page_header_border_color.';
			border-bottom: '.$dp_page_header_border_bottom.'px '.$dp_page_header_border_style.' '.$dp_page_header_border_color.';
			border-left: '.$dp_page_header_border_left.'px '.$dp_page_header_border_style.' '.$dp_page_header_border_color.';
			border-right: '.$dp_page_header_border_right.'px '.$dp_page_header_border_style.' '.$dp_page_header_border_color.';
	';
    } else {
        $page_header_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_page_header_shadow_style' ) == 'presets' ) {
        $dp_page_header_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_page_header_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_page_header_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_page_header_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_page_header_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_page_header_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_page_header_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_page_header_shadow_opacity' );

        $dp_page_header_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_page_header_shadow = 'box-shadow: none;';
    }

    $dp_page_header_color_style = dp_theme_mod( 'dp_page_header_color_style' );
    $dp_page_header_color = dp_theme_mod( 'dp_page_header_color' );
    $dp_page_header_color2 = dp_theme_mod( 'dp_page_header_color2' );
    $dp_page_header_shade_strenght = dp_theme_mod( 'dp_page_header_shade_strenght' );
    $dp_page_header_gradient_style = dp_theme_mod( 'dp_page_header_gradient_style' );
    $dp_page_header_gradient_advanced_toggle = dp_theme_mod( 'dp_page_header_gradient_advanced_toggle' );
    $dp_page_header_gradient_position_parameter1 = dp_theme_mod( 'dp_page_header_gradient_position_parameter1' );
    $dp_page_header_gradient_position_parameter2 = dp_theme_mod( 'dp_page_header_gradient_position_parameter2' );
    $dp_page_header_gradient_reverse_color = dp_theme_mod( 'dp_page_header_gradient_reverse_color' );

    if( $dp_page_header_color_style == "1" ) {
        $dp_page_header_shape = '0';
    } else {
        $dp_page_header_shape = $dp_page_header_gradient_style;
    }

    $dp_page_header_bg = bg_gradient (
        $dp_page_header_shape,
        $dp_page_header_color,
        $dp_page_header_color2,
        $dp_page_header_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_page_header_gradient_position_parameter1,
        $dp_page_header_gradient_position_parameter2,
        $dp_page_header_shade_strenght,
        $dp_page_header_gradient_reverse_color,
        $dp_page_header_gradient_advanced_toggle
    );

    // Typography
    $dp_typography_font_size = dp_theme_mod( 'dp_typography_font_size' );
    $dp_typography_font_weight = dp_theme_mod( 'dp_typography_font_weight' );
    $dp_typography_font_line_height = dp_theme_mod( 'dp_typography_font_line_height' );
    $dp_typography_font_color = dp_theme_mod( 'dp_typography_font_color' );
    $dp_typography_link_color = dp_theme_mod( 'dp_typography_link_color' );
    $dp_typography_link_color_hover = dp_theme_mod( 'dp_typography_link_color_hover' );


    if ( dp_theme_mod( 'dp_typography_link_underline' ) == true ) {
        $dp_typography_link_underline = 'underline';
    } else {
        $dp_typography_link_underline = 'none';
    }

    if ( dp_theme_mod( 'dp_typography_link_hover_underline' ) == true ) {
        $dp_typography_link_hover_underline = 'underline';
    } else {
        $dp_typography_link_hover_underline = 'none';
    }

    $dp_typography_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );

    $dp_typography_h1_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h1_font_size' ) );
    $dp_typography_h2_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h2_font_size' ) );
    $dp_typography_h3_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h3_font_size' ) );
    $dp_typography_h4_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h4_font_size' ) );
    $dp_typography_h5_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h5_font_size' ) );
    $dp_typography_h6_font_size = dp_decode_fonts( dp_theme_mod( 'dp_typography_h6_font_size' ) );
    $dp_typography_h_font_weight = dp_decode_fonts( dp_theme_mod( 'dp_typography_h_font_weight' ) );
    $dp_typography_h_font_line_height = dp_decode_fonts( dp_theme_mod( 'dp_typography_h_font_line_height' ) );
    $dp_typography_h_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_h_font_family' ) );

    // Page Title Meta
    if ( dp_theme_mod( 'dp_page_header_meta_show_date' ) == true ) {
        $dp_page_header_meta_show_date = '';
    } else {
        $dp_page_header_meta_show_date = 'display: none;';
    }

    if ( dp_theme_mod( 'dp_page_header_meta_show_author' ) == true ) {
        $dp_page_header_meta_show_author = '';
    } else {
        $dp_page_header_meta_show_author = 'display: none;';
    }

    if ( dp_theme_mod( 'dp_page_header_meta_show_comment_count' ) == true ) {
        $dp_page_header_meta_show_comment_count = '';
    } else {
        $dp_page_header_meta_show_comment_count = 'display: none;';
    }



    $dp_page_header_meta_font_size = dp_theme_mod( 'dp_page_header_meta_font_size' );
    $dp_page_header_meta_font_weight = dp_theme_mod( 'dp_page_header_meta_font_weight' );
    $dp_page_header_meta_font_color = dp_theme_mod( 'dp_page_header_meta_font_color' );
    $dp_page_header_meta_link_color = dp_theme_mod( 'dp_page_header_meta_link_color' );
    $dp_page_header_meta_link_hover_color = dp_theme_mod( 'dp_page_header_meta_link_hover_color' );

    $dp_page_header_meta_padding_top = dp_theme_mod( 'dp_page_header_meta_padding_top' );
    $dp_page_header_meta_padding_right = dp_theme_mod( 'dp_page_header_meta_padding_right' );
    $dp_page_header_meta_padding_bottom = dp_theme_mod( 'dp_page_header_meta_padding_bottom' );
    $dp_page_header_meta_padding_left = dp_theme_mod( 'dp_page_header_meta_padding_left' );

    $dp_page_header_meta_margin_top = dp_theme_mod( 'dp_page_header_meta_margin_top' );
    $dp_page_header_meta_margin_right = dp_theme_mod( 'dp_page_header_meta_margin_right' );
    $dp_page_header_meta_margin_bottom = dp_theme_mod( 'dp_page_header_meta_margin_bottom' );
    $dp_page_header_meta_margin_left = dp_theme_mod( 'dp_page_header_meta_margin_left' );

    $dp_page_header_meta_border_radius_top_left = dp_theme_mod( 'dp_page_header_meta_border_radius_top_left' );
    $dp_page_header_meta_border_radius_top_right = dp_theme_mod( 'dp_page_header_meta_border_radius_top_right' );
    $dp_page_header_meta_border_radius_bottom_right = dp_theme_mod( 'dp_page_header_meta_border_radius_bottom_right' );
    $dp_page_header_meta_border_radius_bottom_left = dp_theme_mod( 'dp_page_header_meta_border_radius_bottom_left' );

    if ( $dp_page_header_meta_border_radius_top_left == '0' AND $dp_page_header_meta_border_radius_top_right == '0' AND $dp_page_header_meta_border_radius_bottom_right == '0' AND $dp_page_header_meta_border_radius_bottom_left == '0') {
        $dp_page_header_meta_border_radius = 'border-radius: 0;';
    } else {
        $dp_page_header_meta_border_radius = 'border-radius: ' . $dp_page_header_meta_border_radius_top_left . 'px ' . $dp_page_header_meta_border_radius_top_right . 'px ' . $dp_page_header_meta_border_radius_bottom_right . 'px ' . $dp_page_header_meta_border_radius_bottom_left . 'px;';
    }

    $dp_page_header_meta_border_style = dp_theme_mod( 'dp_page_header_meta_border_style' );
    $dp_page_header_meta_border_top = dp_theme_mod( 'dp_page_header_meta_border_top' );
    $dp_page_header_meta_border_right = dp_theme_mod( 'dp_page_header_meta_border_right' );
    $dp_page_header_meta_border_bottom = dp_theme_mod( 'dp_page_header_meta_border_bottom' );
    $dp_page_header_meta_border_left = dp_theme_mod( 'dp_page_header_meta_border_left' );
    $dp_page_header_meta_border_color = dp_theme_mod( 'dp_page_header_meta_border_color' );

    if ( $dp_page_header_meta_border_style != 'none' ) {
        $page_header_meta_border_style = '
			border-top: '.$dp_page_header_meta_border_top.'px '.$dp_page_header_meta_border_style.' '.$dp_page_header_meta_border_color.';
			border-bottom: '.$dp_page_header_meta_border_bottom.'px '.$dp_page_header_meta_border_style.' '.$dp_page_header_meta_border_color.';
			border-left: '.$dp_page_header_meta_border_left.'px '.$dp_page_header_meta_border_style.' '.$dp_page_header_meta_border_color.';
			border-right: '.$dp_page_header_meta_border_right.'px '.$dp_page_header_meta_border_style.' '.$dp_page_header_meta_border_color.';
	';
    } else {
        $page_header_meta_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_page_header_meta_shadow_style' ) == 'presets' ) {
        $dp_page_header_meta_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_page_header_meta_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_page_header_meta_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_page_header_meta_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_page_header_meta_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_page_header_meta_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_page_header_meta_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_page_header_meta_shadow_opacity' );

        $dp_page_header_meta_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_page_header_meta_shadow = 'box-shadow: none;';
    }

    $dp_page_header_meta_color_style = dp_theme_mod( 'dp_page_header_meta_color_style' );
    $dp_page_header_meta_color = dp_theme_mod( 'dp_page_header_meta_color' );
    $dp_page_header_meta_color2 = dp_theme_mod( 'dp_page_header_meta_color2' );
    $dp_page_header_meta_shade_strenght = dp_theme_mod( 'dp_page_header_meta_shade_strenght' );
    $dp_page_header_meta_gradient_style = dp_theme_mod( 'dp_page_header_meta_gradient_style' );
    $dp_page_header_meta_gradient_advanced_toggle = dp_theme_mod( 'dp_page_header_meta_gradient_advanced_toggle' );
    $dp_page_header_meta_gradient_position_parameter1 = dp_theme_mod( 'dp_page_header_meta_gradient_position_parameter1' );
    $dp_page_header_meta_gradient_position_parameter2 = dp_theme_mod( 'dp_page_header_meta_gradient_position_parameter2' );
    $dp_page_header_meta_gradient_reverse_color = dp_theme_mod( 'dp_page_header_meta_gradient_reverse_color' );

    if( $dp_page_header_meta_color_style == "1" ) {
        $dp_page_header_meta_shape = '0';
    } else {
        $dp_page_header_meta_shape = $dp_page_header_meta_gradient_style;
    }

    $dp_page_header_meta_bg = bg_gradient (
        $dp_page_header_meta_shape,
        $dp_page_header_meta_color,
        $dp_page_header_meta_color2,
        $dp_page_header_meta_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_page_header_meta_gradient_position_parameter1,
        $dp_page_header_meta_gradient_position_parameter2,
        $dp_page_header_meta_shade_strenght,
        $dp_page_header_meta_gradient_reverse_color,
        $dp_page_header_meta_gradient_advanced_toggle
    );


    // Page Title Category

    if ( dp_theme_mod( 'dp_page_category_location' ) == 'disruptpress_post_featured_image' ) {
        $dp_page_category_wrap_position = 'absolute';
    } else {
        $dp_page_category_wrap_position = 'initial';
    }

    if ( dp_theme_mod( 'dp_page_category_location_inside_image_vertical' ) == 'top' ) {
        $dp_page_category_location_inside_image_vertical = 'top: 0;';
    } elseif ( dp_theme_mod( 'dp_page_category_location_inside_image_vertical' ) == 'middle' ) {
        $dp_page_category_location_inside_image_vertical = 'top: 40%;';
    } else {
        $dp_page_category_location_inside_image_vertical = 'bottom: 0;';
    }
    $dp_page_category_text_align = dp_theme_mod( 'dp_page_category_text_align' );
    $dp_page_category_location_inside_image_horizontal = dp_theme_mod( 'dp_page_category_location_inside_image_horizontal' );


    if ( dp_theme_mod( 'dp_page_category_width' ) == '100%') {
        $dp_page_category_left = dp_theme_mod( 'dp_page_category_margin_left' ) . 'px';
        $dp_page_category_right = dp_theme_mod( 'dp_page_category_margin_right' ) . 'px';
        $dp_page_category_width_calc = $dp_page_category_left + $dp_page_category_right;
        $dp_page_category_width = 'calc(100% - ' . $dp_page_category_width_calc . 'px)';
        //$dp_page_category_wrap_width = 'auto';
        //$dp_page_category_margin_adjustment = 'margin-right: 0px;margin-left: 0px;';
    } else {
        $dp_page_category_left = 'initial';
        $dp_page_category_right = 'initial';
        $dp_page_category_width = 'auto';
        //$dp_page_category_wrap_width = '100%';
        //$dp_page_category_margin_adjustment = '';
    }

    $dp_page_category_font_size = dp_theme_mod( 'dp_page_category_font_size' );
    $dp_page_category_font_weight = dp_theme_mod( 'dp_page_category_font_weight' );
    $dp_page_category_font_color = dp_theme_mod( 'dp_page_category_font_color' );

    $dp_page_category_padding_top = dp_theme_mod( 'dp_page_category_padding_top' );
    $dp_page_category_padding_right = dp_theme_mod( 'dp_page_category_padding_right' );
    $dp_page_category_padding_bottom = dp_theme_mod( 'dp_page_category_padding_bottom' );
    $dp_page_category_padding_left = dp_theme_mod( 'dp_page_category_padding_left' );

    $dp_page_category_margin_top = dp_theme_mod( 'dp_page_category_margin_top' );
    $dp_page_category_margin_right = dp_theme_mod( 'dp_page_category_margin_right' );
    $dp_page_category_margin_bottom = dp_theme_mod( 'dp_page_category_margin_bottom' );
    $dp_page_category_margin_left = dp_theme_mod( 'dp_page_category_margin_left' );

    $dp_page_category_border_radius_top_left = dp_theme_mod( 'dp_page_category_border_radius_top_left' );
    $dp_page_category_border_radius_top_right = dp_theme_mod( 'dp_page_category_border_radius_top_right' );
    $dp_page_category_border_radius_bottom_right = dp_theme_mod( 'dp_page_category_border_radius_bottom_right' );
    $dp_page_category_border_radius_bottom_left = dp_theme_mod( 'dp_page_category_border_radius_bottom_left' );

    if ( $dp_page_category_border_radius_top_left == '0' AND $dp_page_category_border_radius_top_right == '0' AND $dp_page_category_border_radius_bottom_right == '0' AND $dp_page_category_border_radius_bottom_left == '0') {
        $dp_page_category_border_radius = 'border-radius: 0;';
    } else {
        $dp_page_category_border_radius = 'border-radius: ' . $dp_page_category_border_radius_top_left . 'px ' . $dp_page_category_border_radius_top_right . 'px ' . $dp_page_category_border_radius_bottom_right . 'px ' . $dp_page_category_border_radius_bottom_left . 'px;';
    }

    $dp_page_category_border_style = dp_theme_mod( 'dp_page_category_border_style' );
    $dp_page_category_border_top = dp_theme_mod( 'dp_page_category_border_top' );
    $dp_page_category_border_right = dp_theme_mod( 'dp_page_category_border_right' );
    $dp_page_category_border_bottom = dp_theme_mod( 'dp_page_category_border_bottom' );
    $dp_page_category_border_left = dp_theme_mod( 'dp_page_category_border_left' );
    $dp_page_category_border_color = dp_theme_mod( 'dp_page_category_border_color' );

    if ( $dp_page_category_border_style != 'none' ) {
        $page_category_border_style = '
			border-top: '.$dp_page_category_border_top.'px '.$dp_page_category_border_style.' '.$dp_page_category_border_color.';
			border-bottom: '.$dp_page_category_border_bottom.'px '.$dp_page_category_border_style.' '.$dp_page_category_border_color.';
			border-left: '.$dp_page_category_border_left.'px '.$dp_page_category_border_style.' '.$dp_page_category_border_color.';
			border-right: '.$dp_page_category_border_right.'px '.$dp_page_category_border_style.' '.$dp_page_category_border_color.';
	';
    } else {
        $page_category_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_page_category_shadow_style' ) == 'presets' ) {
        $dp_page_category_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_page_category_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_page_category_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_page_category_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_page_category_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_page_category_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_page_category_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_page_category_shadow_opacity' );

        $dp_page_category_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_page_category_shadow = 'box-shadow: none;';
    }

    $dp_page_category_color_style = dp_theme_mod( 'dp_page_category_color_style' );
    $dp_page_category_color = dp_theme_mod( 'dp_page_category_color' );
    $dp_page_category_color2 = dp_theme_mod( 'dp_page_category_color2' );
    $dp_page_category_shade_strenght = dp_theme_mod( 'dp_page_category_shade_strenght' );
    $dp_page_category_gradient_style = dp_theme_mod( 'dp_page_category_gradient_style' );
    $dp_page_category_gradient_advanced_toggle = dp_theme_mod( 'dp_page_category_gradient_advanced_toggle' );
    $dp_page_category_gradient_position_parameter1 = dp_theme_mod( 'dp_page_category_gradient_position_parameter1' );
    $dp_page_category_gradient_position_parameter2 = dp_theme_mod( 'dp_page_category_gradient_position_parameter2' );
    $dp_page_category_gradient_reverse_color = dp_theme_mod( 'dp_page_category_gradient_reverse_color' );

    if( $dp_page_category_color_style == "1" ) {
        $dp_page_category_shape = '0';
    } else {
        $dp_page_category_shape = $dp_page_category_gradient_style;
    }

    $dp_page_category_bg = bg_gradient (
        $dp_page_category_shape,
        $dp_page_category_color,
        $dp_page_category_color2,
        $dp_page_category_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_page_category_gradient_position_parameter1,
        $dp_page_category_gradient_position_parameter2,
        $dp_page_category_shade_strenght,
        $dp_page_category_gradient_reverse_color,
        $dp_page_category_gradient_advanced_toggle
    );

// Blog Roll

//    $dp_blog_roll_font_size = dp_theme_mod( 'dp_blog_roll_font_size' );
//    $dp_blog_roll_font_color = dp_theme_mod( 'dp_blog_roll_font_color' );
//    //$dp_blog_roll_link_color = dp_theme_mod( 'dp_blog_roll_link_color' );
//    //$dp_blog_roll_link_color_hover = dp_theme_mod( 'dp_blog_roll_link_color_hover' );
//
//    $dp_blog_roll_padding_top = dp_theme_mod( 'dp_blog_roll_padding_top' );
//    $dp_blog_roll_padding_right = dp_theme_mod( 'dp_blog_roll_padding_right' );
//    $dp_blog_roll_padding_bottom = dp_theme_mod( 'dp_blog_roll_padding_bottom' );
//    $dp_blog_roll_padding_left = dp_theme_mod( 'dp_blog_roll_padding_left' );
//
//    $dp_blog_roll_margin_top = dp_theme_mod( 'dp_blog_roll_margin_top' );
//    $dp_blog_roll_margin_right = dp_theme_mod( 'dp_blog_roll_margin_right' );
//    $dp_blog_roll_margin_bottom = dp_theme_mod( 'dp_blog_roll_margin_bottom' );
//    $dp_blog_roll_margin_left = dp_theme_mod( 'dp_blog_roll_margin_left' );
//
//    $dp_blog_roll_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_border_radius_top_left' );
//    $dp_blog_roll_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_border_radius_top_right' );
//    $dp_blog_roll_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_border_radius_bottom_right' );
//    $dp_blog_roll_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_border_radius_bottom_left' );
//
//    if ( $dp_blog_roll_border_radius_top_left == '0' AND $dp_blog_roll_border_radius_top_right == '0' AND $dp_blog_roll_border_radius_bottom_right == '0' AND $dp_blog_roll_border_radius_bottom_left == '0') {
//        $dp_blog_roll_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_border_radius = 'border-radius: ' . $dp_blog_roll_border_radius_top_left . 'px ' . $dp_blog_roll_border_radius_top_right . 'px ' . $dp_blog_roll_border_radius_bottom_right . 'px ' . $dp_blog_roll_border_radius_bottom_left . 'px;';
//    }
//
//    $dp_blog_roll_border_style = dp_theme_mod( 'dp_blog_roll_border_style' );
//    $dp_blog_roll_border_top = dp_theme_mod( 'dp_blog_roll_border_top' );
//    $dp_blog_roll_border_right = dp_theme_mod( 'dp_blog_roll_border_right' );
//    $dp_blog_roll_border_bottom = dp_theme_mod( 'dp_blog_roll_border_bottom' );
//    $dp_blog_roll_border_left = dp_theme_mod( 'dp_blog_roll_border_left' );
//    $dp_blog_roll_border_color = dp_theme_mod( 'dp_blog_roll_border_color' );
//
//    if ( $dp_blog_roll_border_style != 'none' ) {
//        $blog_roll_border_style = '
//			border-top: '.$dp_blog_roll_border_top.'px '.$dp_blog_roll_border_style.' '.$dp_blog_roll_border_color.';
//			border-bottom: '.$dp_blog_roll_border_bottom.'px '.$dp_blog_roll_border_style.' '.$dp_blog_roll_border_color.';
//			border-left: '.$dp_blog_roll_border_left.'px '.$dp_blog_roll_border_style.' '.$dp_blog_roll_border_color.';
//			border-right: '.$dp_blog_roll_border_right.'px '.$dp_blog_roll_border_style.' '.$dp_blog_roll_border_color.';
//	';
//    } else {
//        $blog_roll_border_style = 'border: none;';
//    }
//
//    if ( dp_theme_mod( 'dp_blog_roll_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_shadow_opacity' );
//
//        $dp_blog_roll_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_shadow = 'box-shadow: none;';
//    }
//
//    $dp_blog_roll_color_style = dp_theme_mod( 'dp_blog_roll_color_style' );
//    $dp_blog_roll_color = dp_theme_mod( 'dp_blog_roll_color' );
//    $dp_blog_roll_color2 = dp_theme_mod( 'dp_blog_roll_color2' );
//    $dp_blog_roll_shade_strenght = dp_theme_mod( 'dp_blog_roll_shade_strenght' );
//    $dp_blog_roll_gradient_style = dp_theme_mod( 'dp_blog_roll_gradient_style' );
//    $dp_blog_roll_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_gradient_advanced_toggle' );
//    $dp_blog_roll_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_gradient_position_parameter1' );
//    $dp_blog_roll_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_gradient_position_parameter2' );
//    $dp_blog_roll_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_gradient_reverse_color' );
//
//    if( $dp_blog_roll_color_style == "1" ) {
//        $dp_blog_roll_shape = '0';
//    } else {
//        $dp_blog_roll_shape = $dp_blog_roll_gradient_style;
//    }
//
//    $dp_blog_roll_bg = bg_gradient (
//        $dp_blog_roll_shape,
//        $dp_blog_roll_color,
//        $dp_blog_roll_color2,
//        $dp_blog_roll_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_gradient_position_parameter1,
//        $dp_blog_roll_gradient_position_parameter2,
//        $dp_blog_roll_shade_strenght,
//        $dp_blog_roll_gradient_reverse_color,
//        $dp_blog_roll_gradient_advanced_toggle
//    );

    // Archive Title

    $dp_archive_title_font_size = dp_theme_mod( 'dp_archive_title_font_size' );
    $dp_archive_title_font_weight = dp_theme_mod( 'dp_archive_title_font_weight' );
    $dp_archive_title_font_color = dp_theme_mod( 'dp_archive_title_font_color' );


    $dp_archive_title_padding_top = dp_theme_mod( 'dp_archive_title_padding_top' );
    $dp_archive_title_padding_right = dp_theme_mod( 'dp_archive_title_padding_right' );
    $dp_archive_title_padding_bottom = dp_theme_mod( 'dp_archive_title_padding_bottom' );
    $dp_archive_title_padding_left = dp_theme_mod( 'dp_archive_title_padding_left' );

    $dp_archive_title_margin_top = dp_theme_mod( 'dp_archive_title_margin_top' );
    $dp_archive_title_margin_right = dp_theme_mod( 'dp_archive_title_margin_right' );
    $dp_archive_title_margin_bottom = dp_theme_mod( 'dp_archive_title_margin_bottom' );
    $dp_archive_title_margin_left = dp_theme_mod( 'dp_archive_title_margin_left' );

    $dp_archive_title_border_radius_top_left = dp_theme_mod( 'dp_archive_title_border_radius_top_left' );
    $dp_archive_title_border_radius_top_right = dp_theme_mod( 'dp_archive_title_border_radius_top_right' );
    $dp_archive_title_border_radius_bottom_right = dp_theme_mod( 'dp_archive_title_border_radius_bottom_right' );
    $dp_archive_title_border_radius_bottom_left = dp_theme_mod( 'dp_archive_title_border_radius_bottom_left' );

    if ( $dp_archive_title_border_radius_top_left == '0' AND $dp_archive_title_border_radius_top_right == '0' AND $dp_archive_title_border_radius_bottom_right == '0' AND $dp_archive_title_border_radius_bottom_left == '0') {
        $dp_archive_title_border_radius = 'border-radius: 0;';
    } else {
        $dp_archive_title_border_radius = 'border-radius: ' . $dp_archive_title_border_radius_top_left . 'px ' . $dp_archive_title_border_radius_top_right . 'px ' . $dp_archive_title_border_radius_bottom_right . 'px ' . $dp_archive_title_border_radius_bottom_left . 'px;';
    }

    $dp_archive_title_border_style = dp_theme_mod( 'dp_archive_title_border_style' );
    $dp_archive_title_border_top = dp_theme_mod( 'dp_archive_title_border_top' );
    $dp_archive_title_border_right = dp_theme_mod( 'dp_archive_title_border_right' );
    $dp_archive_title_border_bottom = dp_theme_mod( 'dp_archive_title_border_bottom' );
    $dp_archive_title_border_left = dp_theme_mod( 'dp_archive_title_border_left' );
    $dp_archive_title_border_color = dp_theme_mod( 'dp_archive_title_border_color' );

    if ( $dp_archive_title_border_style != 'none' ) {
        $archive_title_border_style = '
			border-top: '.$dp_archive_title_border_top.'px '.$dp_archive_title_border_style.' '.$dp_archive_title_border_color.';
			border-bottom: '.$dp_archive_title_border_bottom.'px '.$dp_archive_title_border_style.' '.$dp_archive_title_border_color.';
			border-left: '.$dp_archive_title_border_left.'px '.$dp_archive_title_border_style.' '.$dp_archive_title_border_color.';
			border-right: '.$dp_archive_title_border_right.'px '.$dp_archive_title_border_style.' '.$dp_archive_title_border_color.';
	';
    } else {
        $archive_title_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_archive_title_shadow_style' ) == 'presets' ) {
        $dp_archive_title_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_archive_title_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_archive_title_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_archive_title_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_archive_title_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_archive_title_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_archive_title_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_archive_title_shadow_opacity' );

        $dp_archive_title_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_archive_title_shadow = 'box-shadow: none;';
    }

    $dp_archive_title_color_style = dp_theme_mod( 'dp_archive_title_color_style' );
    $dp_archive_title_color = dp_theme_mod( 'dp_archive_title_color' );
    $dp_archive_title_color2 = dp_theme_mod( 'dp_archive_title_color2' );
    $dp_archive_title_shade_strenght = dp_theme_mod( 'dp_archive_title_shade_strenght' );
    $dp_archive_title_gradient_style = dp_theme_mod( 'dp_archive_title_gradient_style' );
    $dp_archive_title_gradient_advanced_toggle = dp_theme_mod( 'dp_archive_title_gradient_advanced_toggle' );
    $dp_archive_title_gradient_position_parameter1 = dp_theme_mod( 'dp_archive_title_gradient_position_parameter1' );
    $dp_archive_title_gradient_position_parameter2 = dp_theme_mod( 'dp_archive_title_gradient_position_parameter2' );
    $dp_archive_title_gradient_reverse_color = dp_theme_mod( 'dp_archive_title_gradient_reverse_color' );

    if( $dp_archive_title_color_style == "1" ) {
        $dp_archive_title_shape = '0';
    } else {
        $dp_archive_title_shape = $dp_archive_title_gradient_style;
    }

    $dp_archive_title_bg = bg_gradient (
        $dp_archive_title_shape,
        $dp_archive_title_color,
        $dp_archive_title_color2,
        $dp_archive_title_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_archive_title_gradient_position_parameter1,
        $dp_archive_title_gradient_position_parameter2,
        $dp_archive_title_shade_strenght,
        $dp_archive_title_gradient_reverse_color,
        $dp_archive_title_gradient_advanced_toggle
    );


    // Blog Roll Wrap

    $dp_blog_roll_wrap_width = dp_theme_mod( 'dp_blog_roll_wrap_width' );

    $dp_blog_roll_wrap_font_sizes = dp_theme_mod( 'dp_blog_roll_wrap_font_size' );
    $dp_blog_roll_wrap_font_color = dp_theme_mod( 'dp_blog_roll_wrap_font_color' );
    $dp_blog_roll_wrap_link_color = dp_theme_mod( 'dp_blog_roll_wrap_link_color' );
    $dp_blog_roll_wrap_link_color_hover = dp_theme_mod( 'dp_blog_roll_wrap_link_color_hover' );

    $dp_blog_roll_wrap_padding_top = dp_theme_mod( 'dp_blog_roll_wrap_padding_top' );
    $dp_blog_roll_wrap_padding_right = dp_theme_mod( 'dp_blog_roll_wrap_padding_right' );
    $dp_blog_roll_wrap_padding_bottom = dp_theme_mod( 'dp_blog_roll_wrap_padding_bottom' );
    $dp_blog_roll_wrap_padding_left = dp_theme_mod( 'dp_blog_roll_wrap_padding_left' );

    $dp_blog_roll_wrap_margin_top = dp_theme_mod( 'dp_blog_roll_wrap_margin_top' );
    $dp_blog_roll_wrap_margin_right = dp_theme_mod( 'dp_blog_roll_wrap_margin_right' );
    $dp_blog_roll_wrap_margin_bottom = dp_theme_mod( 'dp_blog_roll_wrap_margin_bottom' );
    $dp_blog_roll_wrap_margin_left = dp_theme_mod( 'dp_blog_roll_wrap_margin_left' );

    $dp_blog_roll_wrap_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_wrap_border_radius_top_left' );
    $dp_blog_roll_wrap_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_wrap_border_radius_top_right' );
    $dp_blog_roll_wrap_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_wrap_border_radius_bottom_right' );
    $dp_blog_roll_wrap_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_wrap_border_radius_bottom_left' );

    if ( $dp_blog_roll_wrap_border_radius_top_left == '0' AND $dp_blog_roll_wrap_border_radius_top_right == '0' AND $dp_blog_roll_wrap_border_radius_bottom_right == '0' AND $dp_blog_roll_wrap_border_radius_bottom_left == '0') {
        $dp_blog_roll_wrap_border_radius = 'border-radius: 0;';
    } else {
        $dp_blog_roll_wrap_border_radius = 'border-radius: ' . $dp_blog_roll_wrap_border_radius_top_left . 'px ' . $dp_blog_roll_wrap_border_radius_top_right . 'px ' . $dp_blog_roll_wrap_border_radius_bottom_right . 'px ' . $dp_blog_roll_wrap_border_radius_bottom_left . 'px;';
    }

    $dp_blog_roll_wrap_border_style = dp_theme_mod( 'dp_blog_roll_wrap_border_style' );
    $dp_blog_roll_wrap_border_top = dp_theme_mod( 'dp_blog_roll_wrap_border_top' );
    $dp_blog_roll_wrap_border_right = dp_theme_mod( 'dp_blog_roll_wrap_border_right' );
    $dp_blog_roll_wrap_border_bottom = dp_theme_mod( 'dp_blog_roll_wrap_border_bottom' );
    $dp_blog_roll_wrap_border_left = dp_theme_mod( 'dp_blog_roll_wrap_border_left' );
    $dp_blog_roll_wrap_border_color = dp_theme_mod( 'dp_blog_roll_wrap_border_color' );

    if ( $dp_blog_roll_wrap_border_style != 'none' ) {
        $blog_roll_wrap_border_style = '
			border-top: '.$dp_blog_roll_wrap_border_top.'px '.$dp_blog_roll_wrap_border_style.' '.$dp_blog_roll_wrap_border_color.';
			border-bottom: '.$dp_blog_roll_wrap_border_bottom.'px '.$dp_blog_roll_wrap_border_style.' '.$dp_blog_roll_wrap_border_color.';
			border-left: '.$dp_blog_roll_wrap_border_left.'px '.$dp_blog_roll_wrap_border_style.' '.$dp_blog_roll_wrap_border_color.';
			border-right: '.$dp_blog_roll_wrap_border_right.'px '.$dp_blog_roll_wrap_border_style.' '.$dp_blog_roll_wrap_border_color.';
	';
    } else {
        $blog_roll_wrap_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_wrap_shadow_style' ) == 'presets' ) {
        $dp_blog_roll_wrap_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_wrap_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_blog_roll_wrap_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_blog_roll_wrap_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_blog_roll_wrap_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_blog_roll_wrap_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_blog_roll_wrap_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_blog_roll_wrap_shadow_opacity' );

        $dp_blog_roll_wrap_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_blog_roll_wrap_shadow = 'box-shadow: none;';
    }

    $dp_blog_roll_wrap_color_style = dp_theme_mod( 'dp_blog_roll_wrap_color_style' );
    $dp_blog_roll_wrap_color = dp_theme_mod( 'dp_blog_roll_wrap_color' );
    $dp_blog_roll_wrap_color2 = dp_theme_mod( 'dp_blog_roll_wrap_color2' );
    $dp_blog_roll_wrap_shade_strenght = dp_theme_mod( 'dp_blog_roll_wrap_shade_strenght' );
    $dp_blog_roll_wrap_gradient_style = dp_theme_mod( 'dp_blog_roll_wrap_gradient_style' );
    $dp_blog_roll_wrap_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_wrap_gradient_advanced_toggle' );
    $dp_blog_roll_wrap_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_wrap_gradient_position_parameter1' );
    $dp_blog_roll_wrap_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_wrap_gradient_position_parameter2' );
    $dp_blog_roll_wrap_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_wrap_gradient_reverse_color' );

    if( $dp_blog_roll_wrap_color_style == "1" ) {
        $dp_blog_roll_wrap_shape = '0';
    } else {
        $dp_blog_roll_wrap_shape = $dp_blog_roll_wrap_gradient_style;
    }

    $dp_blog_roll_wrap_bg = bg_gradient (
        $dp_blog_roll_wrap_shape,
        $dp_blog_roll_wrap_color,
        $dp_blog_roll_wrap_color2,
        $dp_blog_roll_wrap_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_blog_roll_wrap_gradient_position_parameter1,
        $dp_blog_roll_wrap_gradient_position_parameter2,
        $dp_blog_roll_wrap_shade_strenght,
        $dp_blog_roll_wrap_gradient_reverse_color,
        $dp_blog_roll_wrap_gradient_advanced_toggle
    );


    // Blog Roll Container 1

    //$dp_blog_roll_container_1_width = dp_theme_mod( 'dp_blog_roll_container_1_width' );

//    $dp_blog_roll_container_1_font_sizes = dp_theme_mod( 'dp_blog_roll_container_1_font_size' );
//    $dp_blog_roll_container_1_font_color = dp_theme_mod( 'dp_blog_roll_container_1_font_color' );
//    $dp_blog_roll_container_1_link_color = dp_theme_mod( 'dp_blog_roll_container_1_link_color' );
//    $dp_blog_roll_container_1_link_color_hover = dp_theme_mod( 'dp_blog_roll_container_1_link_color_hover' );
//
//    $dp_blog_roll_container_1_padding_top = dp_theme_mod( 'dp_blog_roll_container_1_padding_top' );
//    $dp_blog_roll_container_1_padding_right = dp_theme_mod( 'dp_blog_roll_container_1_padding_right' );
//    $dp_blog_roll_container_1_padding_bottom = dp_theme_mod( 'dp_blog_roll_container_1_padding_bottom' );
//    $dp_blog_roll_container_1_padding_left = dp_theme_mod( 'dp_blog_roll_container_1_padding_left' );
//
//    $dp_blog_roll_container_1_margin_top = dp_theme_mod( 'dp_blog_roll_container_1_margin_top' );
//    $dp_blog_roll_container_1_margin_right = dp_theme_mod( 'dp_blog_roll_container_1_margin_right' );
//    $dp_blog_roll_container_1_margin_bottom = dp_theme_mod( 'dp_blog_roll_container_1_margin_bottom' );
//    $dp_blog_roll_container_1_margin_left = dp_theme_mod( 'dp_blog_roll_container_1_margin_left' );
//
//    $dp_blog_roll_container_1_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_container_1_border_radius_top_left' );
//    $dp_blog_roll_container_1_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_container_1_border_radius_top_right' );
//    $dp_blog_roll_container_1_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_container_1_border_radius_bottom_right' );
//    $dp_blog_roll_container_1_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_container_1_border_radius_bottom_left' );
//
//    if ( $dp_blog_roll_container_1_border_radius_top_left == '0' AND $dp_blog_roll_container_1_border_radius_top_right == '0' AND $dp_blog_roll_container_1_border_radius_bottom_right == '0' AND $dp_blog_roll_container_1_border_radius_bottom_left == '0') {
//        $dp_blog_roll_container_1_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_container_1_border_radius = 'border-radius: ' . $dp_blog_roll_container_1_border_radius_top_left . 'px ' . $dp_blog_roll_container_1_border_radius_top_right . 'px ' . $dp_blog_roll_container_1_border_radius_bottom_right . 'px ' . $dp_blog_roll_container_1_border_radius_bottom_left . 'px;';
//    }
//
//    $dp_blog_roll_container_1_border_style = dp_theme_mod( 'dp_blog_roll_container_1_border_style' );
//    $dp_blog_roll_container_1_border_top = dp_theme_mod( 'dp_blog_roll_container_1_border_top' );
//    $dp_blog_roll_container_1_border_right = dp_theme_mod( 'dp_blog_roll_container_1_border_right' );
//    $dp_blog_roll_container_1_border_bottom = dp_theme_mod( 'dp_blog_roll_container_1_border_bottom' );
//    $dp_blog_roll_container_1_border_left = dp_theme_mod( 'dp_blog_roll_container_1_border_left' );
//    $dp_blog_roll_container_1_border_color = dp_theme_mod( 'dp_blog_roll_container_1_border_color' );
//
//    if ( $dp_blog_roll_container_1_border_style != 'none' ) {
//        $blog_roll_container_1_border_style = '
//			border-top: '.$dp_blog_roll_container_1_border_top.'px '.$dp_blog_roll_container_1_border_style.' '.$dp_blog_roll_container_1_border_color.';
//			border-bottom: '.$dp_blog_roll_container_1_border_bottom.'px '.$dp_blog_roll_container_1_border_style.' '.$dp_blog_roll_container_1_border_color.';
//			border-left: '.$dp_blog_roll_container_1_border_left.'px '.$dp_blog_roll_container_1_border_style.' '.$dp_blog_roll_container_1_border_color.';
//			border-right: '.$dp_blog_roll_container_1_border_right.'px '.$dp_blog_roll_container_1_border_style.' '.$dp_blog_roll_container_1_border_color.';
//	';
//    } else {
//        $blog_roll_container_1_border_style = 'border: none;';
//    }
//
//    if ( dp_theme_mod( 'dp_blog_roll_container_1_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_container_1_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_container_1_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_container_1_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_container_1_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_container_1_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_container_1_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_container_1_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_container_1_shadow_opacity' );
//
//        $dp_blog_roll_container_1_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_container_1_shadow = 'box-shadow: none;';
//    }
//
//    $dp_blog_roll_container_1_color_style = dp_theme_mod( 'dp_blog_roll_container_1_color_style' );
//    $dp_blog_roll_container_1_color = dp_theme_mod( 'dp_blog_roll_container_1_color' );
//    $dp_blog_roll_container_1_color2 = dp_theme_mod( 'dp_blog_roll_container_1_color2' );
//    $dp_blog_roll_container_1_shade_strenght = dp_theme_mod( 'dp_blog_roll_container_1_shade_strenght' );
//    $dp_blog_roll_container_1_gradient_style = dp_theme_mod( 'dp_blog_roll_container_1_gradient_style' );
//    $dp_blog_roll_container_1_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_container_1_gradient_advanced_toggle' );
//    $dp_blog_roll_container_1_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_container_1_gradient_position_parameter1' );
//    $dp_blog_roll_container_1_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_container_1_gradient_position_parameter2' );
//    $dp_blog_roll_container_1_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_container_1_gradient_reverse_color' );
//
//    if( $dp_blog_roll_container_1_color_style == "1" ) {
//        $dp_blog_roll_container_1_shape = '0';
//    } else {
//        $dp_blog_roll_container_1_shape = $dp_blog_roll_container_1_gradient_style;
//    }
//
//    $dp_blog_roll_container_1_bg = bg_gradient (
//        $dp_blog_roll_container_1_shape,
//        $dp_blog_roll_container_1_color,
//        $dp_blog_roll_container_1_color2,
//        $dp_blog_roll_container_1_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_container_1_gradient_position_parameter1,
//        $dp_blog_roll_container_1_gradient_position_parameter2,
//        $dp_blog_roll_container_1_shade_strenght,
//        $dp_blog_roll_container_1_gradient_reverse_color,
//        $dp_blog_roll_container_1_gradient_advanced_toggle
//    );
//
//    // Blog Roll Container 2
//
//    //$dp_blog_roll_container_2_width = dp_theme_mod( 'dp_blog_roll_container_2_width' );
//
//    $dp_blog_roll_container_2_font_sizes = dp_theme_mod( 'dp_blog_roll_container_2_font_size' );
//    $dp_blog_roll_container_2_font_color = dp_theme_mod( 'dp_blog_roll_container_2_font_color' );
//    $dp_blog_roll_container_2_link_color = dp_theme_mod( 'dp_blog_roll_container_2_link_color' );
//    $dp_blog_roll_container_2_link_color_hover = dp_theme_mod( 'dp_blog_roll_container_2_link_color_hover' );
//
//    $dp_blog_roll_container_2_padding_top = dp_theme_mod( 'dp_blog_roll_container_2_padding_top' );
//    $dp_blog_roll_container_2_padding_right = dp_theme_mod( 'dp_blog_roll_container_2_padding_right' );
//    $dp_blog_roll_container_2_padding_bottom = dp_theme_mod( 'dp_blog_roll_container_2_padding_bottom' );
//    $dp_blog_roll_container_2_padding_left = dp_theme_mod( 'dp_blog_roll_container_2_padding_left' );
//
//    $dp_blog_roll_container_2_margin_top = dp_theme_mod( 'dp_blog_roll_container_2_margin_top' );
//    $dp_blog_roll_container_2_margin_right = dp_theme_mod( 'dp_blog_roll_container_2_margin_right' );
//    $dp_blog_roll_container_2_margin_bottom = dp_theme_mod( 'dp_blog_roll_container_2_margin_bottom' );
//    $dp_blog_roll_container_2_margin_left = dp_theme_mod( 'dp_blog_roll_container_2_margin_left' );
//
//    $dp_blog_roll_container_2_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_container_2_border_radius_top_left' );
//    $dp_blog_roll_container_2_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_container_2_border_radius_top_right' );
//    $dp_blog_roll_container_2_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_container_2_border_radius_bottom_right' );
//    $dp_blog_roll_container_2_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_container_2_border_radius_bottom_left' );
//
//    if ( $dp_blog_roll_container_2_border_radius_top_left == '0' AND $dp_blog_roll_container_2_border_radius_top_right == '0' AND $dp_blog_roll_container_2_border_radius_bottom_right == '0' AND $dp_blog_roll_container_2_border_radius_bottom_left == '0') {
//        $dp_blog_roll_container_2_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_container_2_border_radius = 'border-radius: ' . $dp_blog_roll_container_2_border_radius_top_left . 'px ' . $dp_blog_roll_container_2_border_radius_top_right . 'px ' . $dp_blog_roll_container_2_border_radius_bottom_right . 'px ' . $dp_blog_roll_container_2_border_radius_bottom_left . 'px;';
//    }
//
//    $dp_blog_roll_container_2_border_style = dp_theme_mod( 'dp_blog_roll_container_2_border_style' );
//    $dp_blog_roll_container_2_border_top = dp_theme_mod( 'dp_blog_roll_container_2_border_top' );
//    $dp_blog_roll_container_2_border_right = dp_theme_mod( 'dp_blog_roll_container_2_border_right' );
//    $dp_blog_roll_container_2_border_bottom = dp_theme_mod( 'dp_blog_roll_container_2_border_bottom' );
//    $dp_blog_roll_container_2_border_left = dp_theme_mod( 'dp_blog_roll_container_2_border_left' );
//    $dp_blog_roll_container_2_border_color = dp_theme_mod( 'dp_blog_roll_container_2_border_color' );
//
//    if ( $dp_blog_roll_container_2_border_style != 'none' ) {
//        $blog_roll_container_2_border_style = '
//			border-top: '.$dp_blog_roll_container_2_border_top.'px '.$dp_blog_roll_container_2_border_style.' '.$dp_blog_roll_container_2_border_color.';
//			border-bottom: '.$dp_blog_roll_container_2_border_bottom.'px '.$dp_blog_roll_container_2_border_style.' '.$dp_blog_roll_container_2_border_color.';
//			border-left: '.$dp_blog_roll_container_2_border_left.'px '.$dp_blog_roll_container_2_border_style.' '.$dp_blog_roll_container_2_border_color.';
//			border-right: '.$dp_blog_roll_container_2_border_right.'px '.$dp_blog_roll_container_2_border_style.' '.$dp_blog_roll_container_2_border_color.';
//	';
//    } else {
//        $blog_roll_container_2_border_style = 'border: none;';
//    }
//
//    if ( dp_theme_mod( 'dp_blog_roll_container_2_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_container_2_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_container_2_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_container_2_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_container_2_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_container_2_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_container_2_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_container_2_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_container_2_shadow_opacity' );
//
//        $dp_blog_roll_container_2_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_container_2_shadow = 'box-shadow: none;';
//    }
//
//    $dp_blog_roll_container_2_color_style = dp_theme_mod( 'dp_blog_roll_container_2_color_style' );
//    $dp_blog_roll_container_2_color = dp_theme_mod( 'dp_blog_roll_container_2_color' );
//    $dp_blog_roll_container_2_color2 = dp_theme_mod( 'dp_blog_roll_container_2_color2' );
//    $dp_blog_roll_container_2_shade_strenght = dp_theme_mod( 'dp_blog_roll_container_2_shade_strenght' );
//    $dp_blog_roll_container_2_gradient_style = dp_theme_mod( 'dp_blog_roll_container_2_gradient_style' );
//    $dp_blog_roll_container_2_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_container_2_gradient_advanced_toggle' );
//    $dp_blog_roll_container_2_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_container_2_gradient_position_parameter1' );
//    $dp_blog_roll_container_2_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_container_2_gradient_position_parameter2' );
//    $dp_blog_roll_container_2_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_container_2_gradient_reverse_color' );
//
//    if( $dp_blog_roll_container_2_color_style == "1" ) {
//        $dp_blog_roll_container_2_shape = '0';
//    } else {
//        $dp_blog_roll_container_2_shape = $dp_blog_roll_container_2_gradient_style;
//    }
//
//    $dp_blog_roll_container_2_bg = bg_gradient (
//        $dp_blog_roll_container_2_shape,
//        $dp_blog_roll_container_2_color,
//        $dp_blog_roll_container_2_color2,
//        $dp_blog_roll_container_2_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_container_2_gradient_position_parameter1,
//        $dp_blog_roll_container_2_gradient_position_parameter2,
//        $dp_blog_roll_container_2_shade_strenght,
//        $dp_blog_roll_container_2_gradient_reverse_color,
//        $dp_blog_roll_container_2_gradient_advanced_toggle
//    );
//
//    // Blog Roll Container 3
//
//    //$dp_blog_roll_container_3_width = dp_theme_mod( 'dp_blog_roll_container_3_width' );
//
//    $dp_blog_roll_container_3_font_sizes = dp_theme_mod( 'dp_blog_roll_container_3_font_size' );
//    $dp_blog_roll_container_3_font_color = dp_theme_mod( 'dp_blog_roll_container_3_font_color' );
//    $dp_blog_roll_container_3_link_color = dp_theme_mod( 'dp_blog_roll_container_3_link_color' );
//    $dp_blog_roll_container_3_link_color_hover = dp_theme_mod( 'dp_blog_roll_container_3_link_color_hover' );
//
//    $dp_blog_roll_container_3_padding_top = dp_theme_mod( 'dp_blog_roll_container_3_padding_top' );
//    $dp_blog_roll_container_3_padding_right = dp_theme_mod( 'dp_blog_roll_container_3_padding_right' );
//    $dp_blog_roll_container_3_padding_bottom = dp_theme_mod( 'dp_blog_roll_container_3_padding_bottom' );
//    $dp_blog_roll_container_3_padding_left = dp_theme_mod( 'dp_blog_roll_container_3_padding_left' );
//
//    $dp_blog_roll_container_3_margin_top = dp_theme_mod( 'dp_blog_roll_container_3_margin_top' );
//    $dp_blog_roll_container_3_margin_right = dp_theme_mod( 'dp_blog_roll_container_3_margin_right' );
//    $dp_blog_roll_container_3_margin_bottom = dp_theme_mod( 'dp_blog_roll_container_3_margin_bottom' );
//    $dp_blog_roll_container_3_margin_left = dp_theme_mod( 'dp_blog_roll_container_3_margin_left' );
//
//    $dp_blog_roll_container_3_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_container_3_border_radius_top_left' );
//    $dp_blog_roll_container_3_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_container_3_border_radius_top_right' );
//    $dp_blog_roll_container_3_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_container_3_border_radius_bottom_right' );
//    $dp_blog_roll_container_3_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_container_3_border_radius_bottom_left' );
//
//    if ( $dp_blog_roll_container_3_border_radius_top_left == '0' AND $dp_blog_roll_container_3_border_radius_top_right == '0' AND $dp_blog_roll_container_3_border_radius_bottom_right == '0' AND $dp_blog_roll_container_3_border_radius_bottom_left == '0') {
//        $dp_blog_roll_container_3_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_container_3_border_radius = 'border-radius: ' . $dp_blog_roll_container_3_border_radius_top_left . 'px ' . $dp_blog_roll_container_3_border_radius_top_right . 'px ' . $dp_blog_roll_container_3_border_radius_bottom_right . 'px ' . $dp_blog_roll_container_3_border_radius_bottom_left . 'px;';
//    }
//
//    $dp_blog_roll_container_3_border_style = dp_theme_mod( 'dp_blog_roll_container_3_border_style' );
//    $dp_blog_roll_container_3_border_top = dp_theme_mod( 'dp_blog_roll_container_3_border_top' );
//    $dp_blog_roll_container_3_border_right = dp_theme_mod( 'dp_blog_roll_container_3_border_right' );
//    $dp_blog_roll_container_3_border_bottom = dp_theme_mod( 'dp_blog_roll_container_3_border_bottom' );
//    $dp_blog_roll_container_3_border_left = dp_theme_mod( 'dp_blog_roll_container_3_border_left' );
//    $dp_blog_roll_container_3_border_color = dp_theme_mod( 'dp_blog_roll_container_3_border_color' );
//
//    if ( $dp_blog_roll_container_3_border_style != 'none' ) {
//        $blog_roll_container_3_border_style = '
//			border-top: '.$dp_blog_roll_container_3_border_top.'px '.$dp_blog_roll_container_3_border_style.' '.$dp_blog_roll_container_3_border_color.';
//			border-bottom: '.$dp_blog_roll_container_3_border_bottom.'px '.$dp_blog_roll_container_3_border_style.' '.$dp_blog_roll_container_3_border_color.';
//			border-left: '.$dp_blog_roll_container_3_border_left.'px '.$dp_blog_roll_container_3_border_style.' '.$dp_blog_roll_container_3_border_color.';
//			border-right: '.$dp_blog_roll_container_3_border_right.'px '.$dp_blog_roll_container_3_border_style.' '.$dp_blog_roll_container_3_border_color.';
//	';
//    } else {
//        $blog_roll_container_3_border_style = 'border: none;';
//    }
//
//    if ( dp_theme_mod( 'dp_blog_roll_container_3_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_container_3_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_container_3_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_container_3_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_container_3_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_container_3_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_container_3_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_container_3_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_container_3_shadow_opacity' );
//
//        $dp_blog_roll_container_3_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_container_3_shadow = 'box-shadow: none;';
//    }
//
//    $dp_blog_roll_container_3_color_style = dp_theme_mod( 'dp_blog_roll_container_3_color_style' );
//    $dp_blog_roll_container_3_color = dp_theme_mod( 'dp_blog_roll_container_3_color' );
//    $dp_blog_roll_container_3_color2 = dp_theme_mod( 'dp_blog_roll_container_3_color2' );
//    $dp_blog_roll_container_3_shade_strenght = dp_theme_mod( 'dp_blog_roll_container_3_shade_strenght' );
//    $dp_blog_roll_container_3_gradient_style = dp_theme_mod( 'dp_blog_roll_container_3_gradient_style' );
//    $dp_blog_roll_container_3_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_container_3_gradient_advanced_toggle' );
//    $dp_blog_roll_container_3_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_container_3_gradient_position_parameter1' );
//    $dp_blog_roll_container_3_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_container_3_gradient_position_parameter2' );
//    $dp_blog_roll_container_3_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_container_3_gradient_reverse_color' );
//
//    if( $dp_blog_roll_container_3_color_style == "1" ) {
//        $dp_blog_roll_container_3_shape = '0';
//    } else {
//        $dp_blog_roll_container_3_shape = $dp_blog_roll_container_3_gradient_style;
//    }
//
//    $dp_blog_roll_container_3_bg = bg_gradient (
//        $dp_blog_roll_container_3_shape,
//        $dp_blog_roll_container_3_color,
//        $dp_blog_roll_container_3_color2,
//        $dp_blog_roll_container_3_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_container_3_gradient_position_parameter1,
//        $dp_blog_roll_container_3_gradient_position_parameter2,
//        $dp_blog_roll_container_3_shade_strenght,
//        $dp_blog_roll_container_3_gradient_reverse_color,
//        $dp_blog_roll_container_3_gradient_advanced_toggle
//    );

    // Blog Roll Title
    if ( dp_theme_mod( 'dp_blog_roll_title_location_inside_image_vertical' ) == 'top' ) {
        $dp_blog_roll_title_location_inside_image_vertical = 'top: 0;';
    } elseif ( dp_theme_mod( 'dp_blog_roll_title_location_inside_image_vertical' ) == 'middle' ) {
        $dp_blog_roll_title_location_inside_image_vertical = 'top: 40%;';
    } else {
        $dp_blog_roll_title_location_inside_image_vertical = 'bottom: 0;';
    }
    $dp_blog_roll_title_text_align = dp_theme_mod( 'dp_blog_roll_title_text_align' );
    $dp_blog_roll_title_location_inside_image_horizontal = dp_theme_mod( 'dp_blog_roll_title_location_inside_image_horizontal' );
    $dp_blog_roll_title_width = dp_theme_mod( 'dp_blog_roll_title_width' );




    if ( dp_theme_mod( 'dp_blog_roll_title_height_auto' ) ) {
        $dp_blog_roll_title_height = 'auto';
    } else {
        $dp_blog_roll_title_height = dp_theme_mod( 'dp_blog_roll_title_height' ) . 'px';
    }

    //$dp_blog_roll_title_display = dp_theme_mod( 'dp_blog_roll_title_display' );

    $dp_blog_roll_title_font_size = dp_theme_mod( 'dp_blog_roll_title_font_size' );
    $dp_blog_roll_title_font_weight = dp_theme_mod( 'dp_blog_roll_title_font_weight' );
    $dp_blog_roll_title_font_color = dp_theme_mod( 'dp_blog_roll_title_font_color' );

    $dp_blog_roll_title_padding_top = dp_theme_mod( 'dp_blog_roll_title_padding_top' );
    $dp_blog_roll_title_padding_right = dp_theme_mod( 'dp_blog_roll_title_padding_right' );
    $dp_blog_roll_title_padding_bottom = dp_theme_mod( 'dp_blog_roll_title_padding_bottom' );
    $dp_blog_roll_title_padding_left = dp_theme_mod( 'dp_blog_roll_title_padding_left' );

    $dp_blog_roll_title_margin_top = dp_theme_mod( 'dp_blog_roll_title_margin_top' );
    $dp_blog_roll_title_margin_right = dp_theme_mod( 'dp_blog_roll_title_margin_right' );
    $dp_blog_roll_title_margin_bottom = dp_theme_mod( 'dp_blog_roll_title_margin_bottom' );
    $dp_blog_roll_title_margin_left = dp_theme_mod( 'dp_blog_roll_title_margin_left' );

    $dp_blog_roll_title_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_title_border_radius_top_left' );
    $dp_blog_roll_title_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_title_border_radius_top_right' );
    $dp_blog_roll_title_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_title_border_radius_bottom_right' );
    $dp_blog_roll_title_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_title_border_radius_bottom_left' );

    if ( $dp_blog_roll_title_border_radius_top_left == '0' AND $dp_blog_roll_title_border_radius_top_right == '0' AND $dp_blog_roll_title_border_radius_bottom_right == '0' AND $dp_blog_roll_title_border_radius_bottom_left == '0') {
        $dp_blog_roll_title_border_radius = 'border-radius: 0;';
    } else {
        $dp_blog_roll_title_border_radius = 'border-radius: ' . $dp_blog_roll_title_border_radius_top_left . 'px ' . $dp_blog_roll_title_border_radius_top_right . 'px ' . $dp_blog_roll_title_border_radius_bottom_right . 'px ' . $dp_blog_roll_title_border_radius_bottom_left . 'px;';
    }

    $dp_blog_roll_title_border_style = dp_theme_mod( 'dp_blog_roll_title_border_style' );
    $dp_blog_roll_title_border_top = dp_theme_mod( 'dp_blog_roll_title_border_top' );
    $dp_blog_roll_title_border_right = dp_theme_mod( 'dp_blog_roll_title_border_right' );
    $dp_blog_roll_title_border_bottom = dp_theme_mod( 'dp_blog_roll_title_border_bottom' );
    $dp_blog_roll_title_border_left = dp_theme_mod( 'dp_blog_roll_title_border_left' );
    $dp_blog_roll_title_border_color = dp_theme_mod( 'dp_blog_roll_title_border_color' );

    if ( $dp_blog_roll_title_border_style != 'none' ) {
        $blog_roll_title_border_style = '
			border-top: '.$dp_blog_roll_title_border_top.'px '.$dp_blog_roll_title_border_style.' '.$dp_blog_roll_title_border_color.';
			border-bottom: '.$dp_blog_roll_title_border_bottom.'px '.$dp_blog_roll_title_border_style.' '.$dp_blog_roll_title_border_color.';
			border-left: '.$dp_blog_roll_title_border_left.'px '.$dp_blog_roll_title_border_style.' '.$dp_blog_roll_title_border_color.';
			border-right: '.$dp_blog_roll_title_border_right.'px '.$dp_blog_roll_title_border_style.' '.$dp_blog_roll_title_border_color.';
	';
    } else {
        $blog_roll_title_border_style = 'border: none;';
    }

//    if ( dp_theme_mod( 'dp_blog_roll_title_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_title_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_title_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_title_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_title_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_title_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_title_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_title_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_title_shadow_opacity' );
//
//        $dp_blog_roll_title_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_title_shadow = 'box-shadow: none;';
//    }

    $dp_blog_roll_title_color_style = dp_theme_mod( 'dp_blog_roll_title_color_style' );
    $dp_blog_roll_title_color = dp_theme_mod( 'dp_blog_roll_title_color' );
    $dp_blog_roll_title_color2 = dp_theme_mod( 'dp_blog_roll_title_color2' );
    $dp_blog_roll_title_shade_strenght = dp_theme_mod( 'dp_blog_roll_title_shade_strenght' );
    $dp_blog_roll_title_gradient_style = dp_theme_mod( 'dp_blog_roll_title_gradient_style' );
    $dp_blog_roll_title_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_title_gradient_advanced_toggle' );
    $dp_blog_roll_title_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_title_gradient_position_parameter1' );
    $dp_blog_roll_title_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_title_gradient_position_parameter2' );
    $dp_blog_roll_title_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_title_gradient_reverse_color' );

    if( $dp_blog_roll_title_color_style == "1" ) {
        $dp_blog_roll_title_shape = '0';
    } else {
        $dp_blog_roll_title_shape = $dp_blog_roll_title_gradient_style;
    }

    $dp_blog_roll_title_bg = bg_gradient (
        $dp_blog_roll_title_shape,
        $dp_blog_roll_title_color,
        $dp_blog_roll_title_color2,
        $dp_blog_roll_title_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_blog_roll_title_gradient_position_parameter1,
        $dp_blog_roll_title_gradient_position_parameter2,
        $dp_blog_roll_title_shade_strenght,
        $dp_blog_roll_title_gradient_reverse_color,
        $dp_blog_roll_title_gradient_advanced_toggle
    );



    // Blog Roll Featured Image
    //$dp_blog_roll_featured_image_max_height = dp_theme_mod( 'dp_blog_roll_featured_image_max_height' );

    if ( dp_theme_mod( 'dp_blog_roll_featured_image_width_100' ) == true ) {
        $dp_blog_roll_featured_image_width_calc = '100%';
        $dp_blog_roll_featured_image_float = 'none';
        $dp_blog_roll_featured_image_width = 'auto';
    } else {
        $dp_blog_roll_featured_image_width_calc = dp_theme_mod( 'dp_blog_roll_featured_image_width' ) . 'px';
        $dp_blog_roll_featured_image_float = 'left';
        $dp_blog_roll_featured_image_width = $dp_blog_roll_featured_image_width_calc;
    }

//    if ( dp_theme_mod( 'dp_blog_roll_featured_image_height_auto' ) == true ) {
//        $dp_blog_roll_featured_image_height = 'auto';
//    } else {
//        $dp_blog_roll_featured_image_height = dp_theme_mod( 'dp_blog_roll_featured_image_height' ) . 'px';
//    }


    $dp_blog_roll_featured_image_aspect_ratio = dp_theme_mod( 'dp_blog_roll_featured_image_aspect_ratio' );

//    $dp_blog_roll_featured_image_padding_top = dp_theme_mod( 'dp_blog_roll_featured_image_padding_top' );
//    $dp_blog_roll_featured_image_padding_right = dp_theme_mod( 'dp_blog_roll_featured_image_padding_right' );
//    $dp_blog_roll_featured_image_padding_bottom = dp_theme_mod( 'dp_blog_roll_featured_image_padding_bottom' );
//    $dp_blog_roll_featured_image_padding_left = dp_theme_mod( 'dp_blog_roll_featured_image_padding_left' );

    $dp_blog_roll_featured_image_margin_top = dp_theme_mod( 'dp_blog_roll_featured_image_margin_top' );
    $dp_blog_roll_featured_image_margin_right = dp_theme_mod( 'dp_blog_roll_featured_image_margin_right' );
    $dp_blog_roll_featured_image_margin_bottom = dp_theme_mod( 'dp_blog_roll_featured_image_margin_bottom' );
    $dp_blog_roll_featured_image_margin_left = dp_theme_mod( 'dp_blog_roll_featured_image_margin_left' );

    $dp_blog_roll_featured_image_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_featured_image_border_radius_top_left' );
    $dp_blog_roll_featured_image_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_featured_image_border_radius_top_right' );
    $dp_blog_roll_featured_image_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_featured_image_border_radius_bottom_right' );
    $dp_blog_roll_featured_image_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_featured_image_border_radius_bottom_left' );

    if ( $dp_blog_roll_featured_image_border_radius_top_left == '0' AND $dp_blog_roll_featured_image_border_radius_top_right == '0' AND $dp_blog_roll_featured_image_border_radius_bottom_right == '0' AND $dp_blog_roll_featured_image_border_radius_bottom_left == '0') {
        $dp_blog_roll_featured_image_border_radius = 'border-radius: 0;';
    } else {
        $dp_blog_roll_featured_image_border_radius = 'border-radius: ' . $dp_blog_roll_featured_image_border_radius_top_left . 'px ' . $dp_blog_roll_featured_image_border_radius_top_right . 'px ' . $dp_blog_roll_featured_image_border_radius_bottom_right . 'px ' . $dp_blog_roll_featured_image_border_radius_bottom_left . 'px;';
    }

    $dp_blog_roll_featured_image_border_style = dp_theme_mod( 'dp_blog_roll_featured_image_border_style' );
    $dp_blog_roll_featured_image_border_top = dp_theme_mod( 'dp_blog_roll_featured_image_border_top' );
    $dp_blog_roll_featured_image_border_right = dp_theme_mod( 'dp_blog_roll_featured_image_border_right' );
    $dp_blog_roll_featured_image_border_bottom = dp_theme_mod( 'dp_blog_roll_featured_image_border_bottom' );
    $dp_blog_roll_featured_image_border_left = dp_theme_mod( 'dp_blog_roll_featured_image_border_left' );
    $dp_blog_roll_featured_image_border_color = dp_theme_mod( 'dp_blog_roll_featured_image_border_color' );

    if ( $dp_blog_roll_featured_image_border_style != 'none' ) {
        $blog_roll_featured_image_border_style = '
			border-top: '.$dp_blog_roll_featured_image_border_top.'px '.$dp_blog_roll_featured_image_border_style.' '.$dp_blog_roll_featured_image_border_color.';
			border-bottom: '.$dp_blog_roll_featured_image_border_bottom.'px '.$dp_blog_roll_featured_image_border_style.' '.$dp_blog_roll_featured_image_border_color.';
			border-left: '.$dp_blog_roll_featured_image_border_left.'px '.$dp_blog_roll_featured_image_border_style.' '.$dp_blog_roll_featured_image_border_color.';
			border-right: '.$dp_blog_roll_featured_image_border_right.'px '.$dp_blog_roll_featured_image_border_style.' '.$dp_blog_roll_featured_image_border_color.';
	';
    } else {
        $blog_roll_featured_image_border_style = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_featured_image_shadow_style' ) == 'presets' ) {
        $dp_blog_roll_featured_image_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_featured_image_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_blog_roll_featured_image_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_blog_roll_featured_image_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_blog_roll_featured_image_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_blog_roll_featured_image_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_blog_roll_featured_image_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_blog_roll_featured_image_shadow_opacity' );

        $dp_blog_roll_featured_image_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_blog_roll_featured_image_shadow = 'box-shadow: none;';
    }

//    $dp_blog_roll_featured_image_color_style = dp_theme_mod( 'dp_blog_roll_featured_image_color_style' );
//    $dp_blog_roll_featured_image_color = dp_theme_mod( 'dp_blog_roll_featured_image_color' );
//    $dp_blog_roll_featured_image_color2 = dp_theme_mod( 'dp_blog_roll_featured_image_color2' );
//    $dp_blog_roll_featured_image_shade_strenght = dp_theme_mod( 'dp_blog_roll_featured_image_shade_strenght' );
//    $dp_blog_roll_featured_image_gradient_style = dp_theme_mod( 'dp_blog_roll_featured_image_gradient_style' );
//    $dp_blog_roll_featured_image_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_featured_image_gradient_advanced_toggle' );
//    $dp_blog_roll_featured_image_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_featured_image_gradient_position_parameter1' );
//    $dp_blog_roll_featured_image_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_featured_image_gradient_position_parameter2' );
//    $dp_blog_roll_featured_image_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_featured_image_gradient_reverse_color' );
//
//    if( $dp_blog_roll_featured_image_color_style == "1" ) {
//        $dp_blog_roll_featured_image_shape = '0';
//    } else {
//        $dp_blog_roll_featured_image_shape = $dp_blog_roll_featured_image_gradient_style;
//    }
//
//    $dp_blog_roll_featured_image_bg = bg_gradient (
//        $dp_blog_roll_featured_image_shape,
//        $dp_blog_roll_featured_image_color,
//        $dp_blog_roll_featured_image_color2,
//        $dp_blog_roll_featured_image_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_featured_image_gradient_position_parameter1,
//        $dp_blog_roll_featured_image_gradient_position_parameter2,
//        $dp_blog_roll_featured_image_shade_strenght,
//        $dp_blog_roll_featured_image_gradient_reverse_color,
//        $dp_blog_roll_featured_image_gradient_advanced_toggle
//    );


    // Blog Roll Title

    $dp_blog_roll_excerpt_text_align = dp_theme_mod( 'dp_blog_roll_excerpt_text_align' );

    if ( dp_theme_mod( 'dp_blog_roll_excerpt_display' ) == true ) {
        $dp_blog_roll_excerpt_display = 'display: none;';
    } else {
        $dp_blog_roll_excerpt_display = 'display: block;';
    }


    if ( dp_theme_mod( 'dp_blog_roll_excerpt_height_auto' ) == true ) {
        $dp_blog_roll_excerpt_height = 'auto';
    } else {
        $dp_blog_roll_excerpt_height = dp_theme_mod( 'dp_blog_roll_excerpt_height' ) . 'px';
    }

    $dp_blog_roll_excerpt_font_size = dp_theme_mod( 'dp_blog_roll_excerpt_font_size' );
    $dp_blog_roll_excerpt_font_weight = dp_theme_mod( 'dp_blog_roll_excerpt_font_weight' );
    $dp_blog_roll_excerpt_font_color = dp_theme_mod( 'dp_blog_roll_excerpt_font_color' );
    $dp_blog_roll_excerpt_link_color = dp_theme_mod( 'dp_blog_roll_excerpt_link_color' );
    //$dp_blog_roll_excerpt_link_hover_color = dp_theme_mod( 'dp_blog_roll_excerpt_link_hover_color' );

    $dp_blog_roll_excerpt_padding_top = dp_theme_mod( 'dp_blog_roll_excerpt_padding_top' );
    $dp_blog_roll_excerpt_padding_right = dp_theme_mod( 'dp_blog_roll_excerpt_padding_right' );
    $dp_blog_roll_excerpt_padding_bottom = dp_theme_mod( 'dp_blog_roll_excerpt_padding_bottom' );
    $dp_blog_roll_excerpt_padding_left = dp_theme_mod( 'dp_blog_roll_excerpt_padding_left' );

    $dp_blog_roll_excerpt_margin_top = dp_theme_mod( 'dp_blog_roll_excerpt_margin_top' );
    $dp_blog_roll_excerpt_margin_right = dp_theme_mod( 'dp_blog_roll_excerpt_margin_right' );
    $dp_blog_roll_excerpt_margin_bottom = dp_theme_mod( 'dp_blog_roll_excerpt_margin_bottom' );
    $dp_blog_roll_excerpt_margin_left = dp_theme_mod( 'dp_blog_roll_excerpt_margin_left' );

    //$dp_blog_roll_excerpt_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_excerpt_border_radius_top_left' );
    //$dp_blog_roll_excerpt_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_excerpt_border_radius_top_right' );
    //$dp_blog_roll_excerpt_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_excerpt_border_radius_bottom_right' );
    //$dp_blog_roll_excerpt_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_excerpt_border_radius_bottom_left' );

//    if ( $dp_blog_roll_excerpt_border_radius_top_left == '0' AND $dp_blog_roll_excerpt_border_radius_top_right == '0' AND $dp_blog_roll_excerpt_border_radius_bottom_right == '0' AND $dp_blog_roll_excerpt_border_radius_bottom_left == '0') {
//        $dp_blog_roll_excerpt_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_excerpt_border_radius = 'border-radius: ' . $dp_blog_roll_excerpt_border_radius_top_left . 'px ' . $dp_blog_roll_excerpt_border_radius_top_right . 'px ' . $dp_blog_roll_excerpt_border_radius_bottom_right . 'px ' . $dp_blog_roll_excerpt_border_radius_bottom_left . 'px;';
//    }
//
//    $dp_blog_roll_excerpt_border_style = dp_theme_mod( 'dp_blog_roll_excerpt_border_style' );
//    $dp_blog_roll_excerpt_border_top = dp_theme_mod( 'dp_blog_roll_excerpt_border_top' );
//    $dp_blog_roll_excerpt_border_right = dp_theme_mod( 'dp_blog_roll_excerpt_border_right' );
//    $dp_blog_roll_excerpt_border_bottom = dp_theme_mod( 'dp_blog_roll_excerpt_border_bottom' );
//    $dp_blog_roll_excerpt_border_left = dp_theme_mod( 'dp_blog_roll_excerpt_border_left' );
//    $dp_blog_roll_excerpt_border_color = dp_theme_mod( 'dp_blog_roll_excerpt_border_color' );
//
//    if ( $blog_roll_excerpt_border_style != 'none' ) {
//        $blog_roll_excerpt_border_style = '
//			border-top: '.$dp_blog_roll_excerpt_border_top.'px '.$dp_blog_roll_excerpt_border_style.' '.$dp_blog_roll_excerpt_border_color.';
//			border-bottom: '.$dp_blog_roll_excerpt_border_bottom.'px '.$dp_blog_roll_excerpt_border_style.' '.$dp_blog_roll_excerpt_border_color.';
//			border-left: '.$dp_blog_roll_excerpt_border_left.'px '.$dp_blog_roll_excerpt_border_style.' '.$dp_blog_roll_excerpt_border_color.';
//			border-right: '.$dp_blog_roll_excerpt_border_right.'px '.$dp_blog_roll_excerpt_border_style.' '.$dp_blog_roll_excerpt_border_color.';
//	';
//    } else {
//        $blog_roll_excerpt_border_style = 'border: none;';
//    }
//
//    if ( dp_theme_mod( 'dp_blog_roll_excerpt_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_excerpt_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_excerpt_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_excerpt_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_excerpt_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_excerpt_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_excerpt_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_excerpt_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_excerpt_shadow_opacity' );
//
//        $dp_blog_roll_excerpt_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_excerpt_shadow = 'box-shadow: none;';
//    }
//
//    $dp_blog_roll_excerpt_color_style = dp_theme_mod( 'dp_blog_roll_excerpt_color_style' );
//    $dp_blog_roll_excerpt_color = dp_theme_mod( 'dp_blog_roll_excerpt_color' );
//    $dp_blog_roll_excerpt_color2 = dp_theme_mod( 'dp_blog_roll_excerpt_color2' );
//    $dp_blog_roll_excerpt_shade_strenght = dp_theme_mod( 'dp_blog_roll_excerpt_shade_strenght' );
//    $dp_blog_roll_excerpt_gradient_style = dp_theme_mod( 'dp_blog_roll_excerpt_gradient_style' );
//    $dp_blog_roll_excerpt_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_excerpt_gradient_advanced_toggle' );
//    $dp_blog_roll_excerpt_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_excerpt_gradient_position_parameter1' );
//    $dp_blog_roll_excerpt_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_excerpt_gradient_position_parameter2' );
//    $dp_blog_roll_excerpt_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_excerpt_gradient_reverse_color' );
//
//    if( $dp_blog_roll_excerpt_color_style == "1" ) {
//        $dp_blog_roll_excerpt_shape = '0';
//    } else {
//        $dp_blog_roll_excerpt_shape = $dp_blog_roll_excerpt_gradient_style;
//    }
//
//    $dp_blog_roll_excerpt_bg = bg_gradient (
//        $dp_blog_roll_excerpt_shape,
//        $dp_blog_roll_excerpt_color,
//        $dp_blog_roll_excerpt_color2,
//        $dp_blog_roll_excerpt_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_excerpt_gradient_position_parameter1,
//        $dp_blog_roll_excerpt_gradient_position_parameter2,
//        $dp_blog_roll_excerpt_shade_strenght,
//        $dp_blog_roll_excerpt_gradient_reverse_color,
//        $dp_blog_roll_excerpt_gradient_advanced_toggle
//    );


    // Page Title Meta
    if ( dp_theme_mod( 'dp_blog_roll_meta_show_date' ) == true ) {
        $dp_blog_roll_meta_show_date = '';
    } else {
        $dp_blog_roll_meta_show_date = 'display: none;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_meta_show_author' ) == true ) {
        $dp_blog_roll_meta_show_author = '';
    } else {
        $dp_blog_roll_meta_show_author = 'display: none;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_meta_show_comment_count' ) == true ) {
        $dp_blog_roll_meta_show_comment_count = '';
    } else {
        $dp_blog_roll_meta_show_comment_count = 'display: none;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_meta_width' ) == '100%') {
        $dp_blog_roll_meta_left = dp_theme_mod( 'dp_blog_roll_meta_margin_left' ) . 'px';
        $dp_blog_roll_meta_right = dp_theme_mod( 'dp_blog_roll_meta_margin_right' ) . 'px';
        $dp_blog_roll_meta_width_calc = $dp_blog_roll_meta_left + $dp_blog_roll_meta_right;
        $dp_blog_roll_meta_width = 'calc(100% - ' . $dp_blog_roll_meta_width_calc . 'px)';
        //$dp_blog_roll_meta_wrap_width = 'auto';
        //$dp_blog_roll_meta_margin_adjustment = 'margin-right: 0px;margin-left: 0px;';
    } else {
        $dp_blog_roll_meta_left = 'initial';
        $dp_blog_roll_meta_right = 'initial';
        $dp_blog_roll_meta_width = 'auto';
        //$dp_blog_roll_meta_wrap_width = '100%';
        //$dp_blog_roll_meta_margin_adjustment = '';
    }


    $dp_blog_roll_meta_text_align = dp_theme_mod( 'dp_blog_roll_meta_text_align' );
    $dp_blog_roll_meta_float = dp_theme_mod( 'dp_blog_roll_meta_float' );
    $dp_blog_roll_meta_display = dp_theme_mod( 'dp_blog_roll_meta_display' );

    $dp_blog_roll_meta_font_size = dp_theme_mod( 'dp_blog_roll_meta_font_size' );
    $dp_blog_roll_meta_font_weight = dp_theme_mod( 'dp_blog_roll_meta_font_weight' );
    $dp_blog_roll_meta_font_color = dp_theme_mod( 'dp_blog_roll_meta_font_color' );
    $dp_blog_roll_meta_link_color = dp_theme_mod( 'dp_blog_roll_meta_link_color' );
    //$dp_blog_roll_meta_link_hover_color = dp_theme_mod( 'dp_blog_roll_meta_link_hover_color' );

    $dp_blog_roll_meta_padding_top = dp_theme_mod( 'dp_blog_roll_meta_padding_top' );
    $dp_blog_roll_meta_padding_right = dp_theme_mod( 'dp_blog_roll_meta_padding_right' );
    $dp_blog_roll_meta_padding_bottom = dp_theme_mod( 'dp_blog_roll_meta_padding_bottom' );
    $dp_blog_roll_meta_padding_left = dp_theme_mod( 'dp_blog_roll_meta_padding_left' );

    $dp_blog_roll_meta_margin_top = dp_theme_mod( 'dp_blog_roll_meta_margin_top' );
    $dp_blog_roll_meta_margin_right = dp_theme_mod( 'dp_blog_roll_meta_margin_right' );
    $dp_blog_roll_meta_margin_bottom = dp_theme_mod( 'dp_blog_roll_meta_margin_bottom' );
    $dp_blog_roll_meta_margin_left = dp_theme_mod( 'dp_blog_roll_meta_margin_left' );

//    $dp_blog_roll_meta_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_meta_border_radius_top_left' );
//    $dp_blog_roll_meta_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_meta_border_radius_top_right' );
//    $dp_blog_roll_meta_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_meta_border_radius_bottom_right' );
//    $dp_blog_roll_meta_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_meta_border_radius_bottom_left' );
//
//    if ( $dp_blog_roll_meta_border_radius_top_left == '0' AND $dp_blog_roll_meta_border_radius_top_right == '0' AND $dp_blog_roll_meta_border_radius_bottom_right == '0' AND $dp_blog_roll_meta_border_radius_bottom_left == '0') {
//        $dp_blog_roll_meta_border_radius = 'border-radius: 0;';
//    } else {
//        $dp_blog_roll_meta_border_radius = 'border-radius: ' . $dp_blog_roll_meta_border_radius_top_left . 'px ' . $dp_blog_roll_meta_border_radius_top_right . 'px ' . $dp_blog_roll_meta_border_radius_bottom_right . 'px ' . $dp_blog_roll_meta_border_radius_bottom_left . 'px;';
//    }

//    $dp_blog_roll_meta_border_style = dp_theme_mod( 'dp_blog_roll_meta_border_style' );
//    $dp_blog_roll_meta_border_top = dp_theme_mod( 'dp_blog_roll_meta_border_top' );
//    $dp_blog_roll_meta_border_right = dp_theme_mod( 'dp_blog_roll_meta_border_right' );
//    $dp_blog_roll_meta_border_bottom = dp_theme_mod( 'dp_blog_roll_meta_border_bottom' );
//    $dp_blog_roll_meta_border_left = dp_theme_mod( 'dp_blog_roll_meta_border_left' );
//    $dp_blog_roll_meta_border_color = dp_theme_mod( 'dp_blog_roll_meta_border_color' );
//
//    if ( $dp_blog_roll_meta_border_style != 'none' ) {
//        $blog_roll_meta_border_style = '
//			border-top: '.$dp_blog_roll_meta_border_top.'px '.$dp_blog_roll_meta_border_style.' '.$dp_blog_roll_meta_border_color.';
//			border-bottom: '.$dp_blog_roll_meta_border_bottom.'px '.$dp_blog_roll_meta_border_style.' '.$dp_blog_roll_meta_border_color.';
//			border-left: '.$dp_blog_roll_meta_border_left.'px '.$dp_blog_roll_meta_border_style.' '.$dp_blog_roll_meta_border_color.';
//			border-right: '.$dp_blog_roll_meta_border_right.'px '.$dp_blog_roll_meta_border_style.' '.$dp_blog_roll_meta_border_color.';
//	';
//    } else {
//        $blog_roll_meta_border_style = 'border: none;';
//    }

//    if ( dp_theme_mod( 'dp_blog_roll_meta_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_meta_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_meta_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_meta_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_meta_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_meta_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_meta_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_meta_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_meta_shadow_opacity' );
//
//        $dp_blog_roll_meta_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_meta_shadow = 'box-shadow: none;';
//    }

    //$dp_blog_roll_meta_color_style = dp_theme_mod( 'dp_blog_roll_meta_color_style' );
    $dp_blog_roll_meta_color = dp_theme_mod( 'dp_blog_roll_meta_color' );
//    $dp_blog_roll_meta_color2 = dp_theme_mod( 'dp_blog_roll_meta_color2' );
//    $dp_blog_roll_meta_shade_strenght = dp_theme_mod( 'dp_blog_roll_meta_shade_strenght' );
//    $dp_blog_roll_meta_gradient_style = dp_theme_mod( 'dp_blog_roll_meta_gradient_style' );
//    $dp_blog_roll_meta_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_meta_gradient_advanced_toggle' );
//    $dp_blog_roll_meta_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_meta_gradient_position_parameter1' );
//    $dp_blog_roll_meta_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_meta_gradient_position_parameter2' );
//    $dp_blog_roll_meta_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_meta_gradient_reverse_color' );
//
//    if( $dp_blog_roll_meta_color_style == "1" ) {
//        $dp_blog_roll_meta_shape = '0';
//    } else {
//        $dp_blog_roll_meta_shape = $dp_blog_roll_meta_gradient_style;
//    }
//
//    $dp_blog_roll_meta_bg = bg_gradient (
//        $dp_blog_roll_meta_shape,
//        $dp_blog_roll_meta_color,
//        $dp_blog_roll_meta_color2,
//        $dp_blog_roll_meta_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_meta_gradient_position_parameter1,
//        $dp_blog_roll_meta_gradient_position_parameter2,
//        $dp_blog_roll_meta_shade_strenght,
//        $dp_blog_roll_meta_gradient_reverse_color,
//        $dp_blog_roll_meta_gradient_advanced_toggle
//    );

    // Blog Roll Category

    if ( dp_theme_mod( 'dp_blog_roll_category_location' ) == 'disruptpress_post_featured_image' ) {
        $dp_blog_roll_category_wrap_position = 'absolute';
    } else {
        $dp_blog_roll_category_wrap_position = 'initial';
    }

    if ( dp_theme_mod( 'dp_blog_roll_category_location_inside_image_vertical' ) == 'top' ) {
        $dp_blog_roll_category_location_inside_image_vertical = 'top: 0;';
    } elseif ( dp_theme_mod( 'dp_blog_roll_category_location_inside_image_vertical' ) == 'middle' ) {
        $dp_blog_roll_category_location_inside_image_vertical = 'top: 40%;';
    } else {
        $dp_blog_roll_category_location_inside_image_vertical = 'bottom: 0;';
    }

    if ( dp_theme_mod( 'dp_blog_roll_category_location_inside_image_horizontal' ) == 'left' ) {
        $dp_blog_roll_category_location_inside_image_horizontal = 'left: 0;';
    } else {
        $dp_blog_roll_category_location_inside_image_horizontal = 'right: 0;';
    }




    $dp_blog_roll_category_text_align = dp_theme_mod( 'dp_blog_roll_category_text_align' );
    $dp_blog_roll_category_display = dp_theme_mod( 'dp_blog_roll_category_display' );
    $dp_blog_roll_category_float = dp_theme_mod( 'dp_blog_roll_category_float' );


    if ( dp_theme_mod( 'dp_blog_roll_category_width' ) == '100%') {
        $dp_blog_roll_category_left = dp_theme_mod( 'dp_blog_roll_category_margin_left' ) . 'px';
        $dp_blog_roll_category_right = dp_theme_mod( 'dp_blog_roll_category_margin_right' ) . 'px';
        $dp_blog_roll_category_width_calc = $dp_blog_roll_category_left + $dp_blog_roll_category_right;
        $dp_blog_roll_category_width = 'calc(100% - ' . $dp_blog_roll_category_width_calc . 'px)';
        //$dp_blog_roll_category_wrap_width = 'auto';
        //$dp_blog_roll_category_margin_adjustment = 'margin-right: 0px;margin-left: 0px;';
    } else {
        $dp_blog_roll_category_left = 'initial';
        $dp_blog_roll_category_right = 'initial';
        $dp_blog_roll_category_width = 'auto';
        //$dp_blog_roll_category_wrap_width = '100%';
        //$dp_blog_roll_category_margin_adjustment = '';
    }

    $dp_blog_roll_category_font_size = dp_theme_mod( 'dp_blog_roll_category_font_size' );
    $dp_blog_roll_category_font_weight = dp_theme_mod( 'dp_blog_roll_category_font_weight' );
    $dp_blog_roll_category_font_color = dp_theme_mod( 'dp_blog_roll_category_font_color' );

    $dp_blog_roll_category_padding_top = dp_theme_mod( 'dp_blog_roll_category_padding_top' );
    $dp_blog_roll_category_padding_right = dp_theme_mod( 'dp_blog_roll_category_padding_right' );
    $dp_blog_roll_category_padding_bottom = dp_theme_mod( 'dp_blog_roll_category_padding_bottom' );
    $dp_blog_roll_category_padding_left = dp_theme_mod( 'dp_blog_roll_category_padding_left' );

    $dp_blog_roll_category_margin_top = dp_theme_mod( 'dp_blog_roll_category_margin_top' );
    $dp_blog_roll_category_margin_right = dp_theme_mod( 'dp_blog_roll_category_margin_right' );
    $dp_blog_roll_category_margin_bottom = dp_theme_mod( 'dp_blog_roll_category_margin_bottom' );
    $dp_blog_roll_category_margin_left = dp_theme_mod( 'dp_blog_roll_category_margin_left' );

    $dp_blog_roll_category_border_radius_top_left = dp_theme_mod( 'dp_blog_roll_category_border_radius_top_left' );
    $dp_blog_roll_category_border_radius_top_right = dp_theme_mod( 'dp_blog_roll_category_border_radius_top_right' );
    $dp_blog_roll_category_border_radius_bottom_right = dp_theme_mod( 'dp_blog_roll_category_border_radius_bottom_right' );
    $dp_blog_roll_category_border_radius_bottom_left = dp_theme_mod( 'dp_blog_roll_category_border_radius_bottom_left' );

    if ( $dp_blog_roll_category_border_radius_top_left == '0' AND $dp_blog_roll_category_border_radius_top_right == '0' AND $dp_blog_roll_category_border_radius_bottom_right == '0' AND $dp_blog_roll_category_border_radius_bottom_left == '0') {
        $dp_blog_roll_category_border_radius = 'border-radius: 0;';
    } else {
        $dp_blog_roll_category_border_radius = 'border-radius: ' . $dp_blog_roll_category_border_radius_top_left . 'px ' . $dp_blog_roll_category_border_radius_top_right . 'px ' . $dp_blog_roll_category_border_radius_bottom_right . 'px ' . $dp_blog_roll_category_border_radius_bottom_left . 'px;';
    }

//    $dp_blog_roll_category_border_style = dp_theme_mod( 'dp_blog_roll_category_border_style' );
//    $dp_blog_roll_category_border_top = dp_theme_mod( 'dp_blog_roll_category_border_top' );
//    $dp_blog_roll_category_border_right = dp_theme_mod( 'dp_blog_roll_category_border_right' );
//    $dp_blog_roll_category_border_bottom = dp_theme_mod( 'dp_blog_roll_category_border_bottom' );
//    $dp_blog_roll_category_border_left = dp_theme_mod( 'dp_blog_roll_category_border_left' );
//    $dp_blog_roll_category_border_color = dp_theme_mod( 'dp_blog_roll_category_border_color' );
//
//    if ( $dp_blog_roll_category_border_style != 'none' ) {
//        $blog_roll_category_border_style = '
//			border-top: '.$dp_blog_roll_category_border_top.'px '.$dp_blog_roll_category_border_style.' '.$dp_blog_roll_category_border_color.';
//			border-bottom: '.$dp_blog_roll_category_border_bottom.'px '.$dp_blog_roll_category_border_style.' '.$dp_blog_roll_category_border_color.';
//			border-left: '.$dp_blog_roll_category_border_left.'px '.$dp_blog_roll_category_border_style.' '.$dp_blog_roll_category_border_color.';
//			border-right: '.$dp_blog_roll_category_border_right.'px '.$dp_blog_roll_category_border_style.' '.$dp_blog_roll_category_border_color.';
//	';
//    } else {
//        $blog_roll_category_border_style = 'border: none;';
//    }

//    if ( dp_theme_mod( 'dp_blog_roll_category_shadow_style' ) == 'presets' ) {
//        $dp_blog_roll_category_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_blog_roll_category_shadow_presets' ) - 1] . ';';
//
//    } elseif ( dp_theme_mod( 'dp_blog_roll_category_shadow_style' ) == 'custom' ) {
//        $horizontal = dp_theme_mod( 'dp_blog_roll_category_shadow_horizontal' );
//        $vertical = dp_theme_mod( 'dp_blog_roll_category_shadow_vertical' );
//        $blur = dp_theme_mod( 'dp_blog_roll_category_shadow_blur_radius' );
//        $spread = dp_theme_mod( 'dp_blog_roll_category_shadow_spread_radius' );
//        $opacity = dp_theme_mod( 'dp_blog_roll_category_shadow_opacity' );
//
//        $dp_blog_roll_category_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';
//
//    } else {
//        $dp_blog_roll_category_shadow = 'box-shadow: none;';
//    }

    //$dp_blog_roll_category_color_style = dp_theme_mod( 'dp_blog_roll_category_color_style' );
    $dp_blog_roll_category_color = dp_theme_mod( 'dp_blog_roll_category_color' );
//    $dp_blog_roll_category_color2 = dp_theme_mod( 'dp_blog_roll_category_color2' );
//    $dp_blog_roll_category_shade_strenght = dp_theme_mod( 'dp_blog_roll_category_shade_strenght' );
//    $dp_blog_roll_category_gradient_style = dp_theme_mod( 'dp_blog_roll_category_gradient_style' );
//    $dp_blog_roll_category_gradient_advanced_toggle = dp_theme_mod( 'dp_blog_roll_category_gradient_advanced_toggle' );
//    $dp_blog_roll_category_gradient_position_parameter1 = dp_theme_mod( 'dp_blog_roll_category_gradient_position_parameter1' );
//    $dp_blog_roll_category_gradient_position_parameter2 = dp_theme_mod( 'dp_blog_roll_category_gradient_position_parameter2' );
//    $dp_blog_roll_category_gradient_reverse_color = dp_theme_mod( 'dp_blog_roll_category_gradient_reverse_color' );
//
//    if( $dp_blog_roll_category_color_style == "1" ) {
//        $dp_blog_roll_category_shape = '0';
//    } else {
//        $dp_blog_roll_category_shape = $dp_blog_roll_category_gradient_style;
//    }
//
//    $dp_blog_roll_category_bg = bg_gradient (
//        $dp_blog_roll_category_shape,
//        $dp_blog_roll_category_color,
//        $dp_blog_roll_category_color2,
//        $dp_blog_roll_category_color_style,
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        '',
//        $dp_blog_roll_category_gradient_position_parameter1,
//        $dp_blog_roll_category_gradient_position_parameter2,
//        $dp_blog_roll_category_shade_strenght,
//        $dp_blog_roll_category_gradient_reverse_color,
//        $dp_blog_roll_category_gradient_advanced_toggle
//    );


    // Pagination
    $dp_pagination_text_align = dp_theme_mod( 'dp_pagination_text_align' );
    $dp_pagination_font_size = dp_theme_mod( 'dp_pagination_font_size' );
    $dp_pagination_font_weight = dp_theme_mod( 'dp_pagination_font_weight' );
    $dp_pagination_font_color = dp_theme_mod( 'dp_pagination_font_color' );
    $dp_pagination_font_color_active = dp_theme_mod( 'dp_pagination_font_color_active' );

    $dp_pagination_padding_top = dp_theme_mod( 'dp_pagination_padding_top' );
    $dp_pagination_padding_right = dp_theme_mod( 'dp_pagination_padding_right' );
    $dp_pagination_padding_bottom = dp_theme_mod( 'dp_pagination_padding_bottom' );
    $dp_pagination_padding_left = dp_theme_mod( 'dp_pagination_padding_left' );

    $dp_pagination_margin_top = dp_theme_mod( 'dp_pagination_margin_top' );
    $dp_pagination_margin_right = dp_theme_mod( 'dp_pagination_margin_right' );
    $dp_pagination_margin_bottom = dp_theme_mod( 'dp_pagination_margin_bottom' );
    $dp_pagination_margin_left = dp_theme_mod( 'dp_pagination_margin_left' );

    $dp_pagination_border_top = dp_theme_mod( 'dp_pagination_border_top' );
    $dp_pagination_border_right = dp_theme_mod( 'dp_pagination_border_right' );
    $dp_pagination_border_bottom = dp_theme_mod( 'dp_pagination_border_bottom' );
    $dp_pagination_border_left = dp_theme_mod( 'dp_pagination_border_left' );
    $dp_pagination_border_color = dp_theme_mod( 'dp_pagination_border_color' );
    $dp_pagination_border_style = dp_theme_mod( 'dp_pagination_border_style' );

    if ( $dp_pagination_border_style != 'none' ) {
        $dp_pagination_border = '
			border-top: '.$dp_pagination_border_top.'px '.$dp_pagination_border_style.' '.$dp_blog_roll_category_border_color.';
			border-bottom: '.$dp_pagination_border_bottom.'px '.$dp_pagination_border_style.' '.$dp_blog_roll_category_border_color.';
			border-left: '.$dp_pagination_border_left.'px '.$dp_pagination_border_style.' '.$dp_blog_roll_category_border_color.';
			border-right: '.$dp_pagination_border_right.'px '.$dp_pagination_border_style.' '.$dp_blog_roll_category_border_color.';
	';
    } else {
        $dp_pagination_border = 'border: none;';
    }

    $dp_pagination_border_radius_top_left = dp_theme_mod( 'dp_pagination_border_radius_top_left' );
    $dp_pagination_border_radius_top_right = dp_theme_mod( 'dp_pagination_border_radius_top_right' );
    $dp_pagination_border_radius_bottom_right = dp_theme_mod( 'dp_pagination_border_radius_bottom_right' );
    $dp_pagination_border_radius_bottom_left = dp_theme_mod( 'dp_pagination_border_radius_bottom_left' );

    if ( $dp_pagination_border_radius_top_left == '0' AND $dp_pagination_border_radius_top_right == '0' AND $dp_pagination_border_radius_bottom_right == '0' AND $dp_pagination_border_radius_bottom_left == '0') {
        $dp_pagination_border_radius = 'border-radius: 0;';
    } else {
        $dp_pagination_border_radius = 'border-radius: ' . $dp_pagination_border_radius_top_left . 'px ' . $dp_pagination_border_radius_top_right . 'px ' . $dp_pagination_border_radius_bottom_right . 'px ' . $dp_pagination_border_radius_bottom_left . 'px;';
    }

    $dp_pagination_border_radius_top_left = dp_theme_mod( 'dp_pagination_border_radius_top_left' );
    $dp_pagination_border_radius_top_right = dp_theme_mod( 'dp_pagination_border_radius_top_right' );
    $dp_pagination_border_radius_bottom_right = dp_theme_mod( 'dp_pagination_border_radius_bottom_right' );
    $dp_pagination_border_radius_bottom_left = dp_theme_mod( 'dp_pagination_border_radius_bottom_left' );

    $dp_pagination_color = dp_theme_mod( 'dp_pagination_color' );


    // Social Share buttons
    $dp_pagination_color_active = dp_theme_mod( 'dp_pagination_color_active' );

    if ( dp_theme_mod( 'dp_social_share_display_name' ) ) {
        $dp_social_share_display_name = 'inline-block';
    } else {
        $dp_social_share_display_name = 'none';
    }

    if ( dp_theme_mod( 'dp_social_share_alignment' ) == 'full' ) {
        $dp_social_share_alignment_width = '100%';
        $dp_social_share_alignment_margin_left = '0px';
        $dp_social_share_alignment_margin_right = '0px';

    } else if ( dp_theme_mod( 'dp_social_share_alignment' ) == 'left' ) {
        $dp_social_share_alignment_width = 'auto';
        $dp_social_share_alignment_margin_left = '0px';
        $dp_social_share_alignment_margin_right = 'auto';

    } else if ( dp_theme_mod( 'dp_social_share_alignment' ) == 'right' ) {
        $dp_social_share_alignment_width = 'auto';
        $dp_social_share_alignment_margin_left = 'auto';
        $dp_social_share_alignment_margin_right = '0px';

    } else {
        $dp_social_share_alignment_width = 'auto';
        $dp_social_share_alignment_margin_left = 'auto';
        $dp_social_share_alignment_margin_right = 'auto';
    }

    if ( dp_theme_mod( 'dp_social_share_space_between_buttons' ) ) {
        $dp_social_share_space_between_buttons = '5px';
    } else {
        $dp_social_share_space_between_buttons = '0';
    }


    // Secondary Menu
    // secondary Menu Width
    if ( dp_theme_mod( 'dp_secondary_menu_boxed' ) == true AND dp_theme_mod( 'dp_site_layout' ) == '3' ) {
        $dp_secondary_menu_max_width = 'calc(100% - ' . ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px)';
    } elseif ( dp_theme_mod( 'dp_secondary_menu_boxed' ) == true ) {
        $dp_secondary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ) - ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px';
    } else {
        $dp_secondary_menu_max_width = '100%';
    }

// 	// secondary Menu Width
// 	if ( dp_theme_mod( 'dp_secondary_menu_width' ) == '1' ) {
// 		$dp_secondary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ) - ( dp_theme_mod( 'dp_site_container_wrap_padding_left_right' ) * 2 ) . 'px';
// 	} elseif ( dp_theme_mod( 'dp_secondary_menu_width' ) == '2' ) {
// 		$dp_secondary_menu_max_width = dp_theme_mod( 'dp_site_container_width' ). 'px';
// 	} else {
// 		$dp_secondary_menu_max_width = '100%';
// 	}


    //secondary Menu Logo
// 	if ( dp_theme_mod( 'dp_secondary_menu_logo_toggle' ) == true ) {
// 		$dp_secondary_menu_logo_toggle = 'table-cell';
// 	} else {
// 		$dp_secondary_menu_logo_toggle = 'none';
// 	}

    $dp_secondary_menu_logo_height = dp_theme_mod( 'dp_secondary_menu_logo_height' );
    $dp_secondary_menu_logo_width = dp_theme_mod( 'dp_secondary_menu_logo_width' );
    $dp_secondary_menu_logo_title_area_width = dp_theme_mod( 'dp_secondary_menu_logo_title_area_width' );

    if ( dp_theme_mod( 'dp_secondary_menu_logo_title_font_family_toggle' ) == true ) {
        $dp_secondary_menu_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
    } else {
        $dp_secondary_menu_logo_title_font_family = dp_decode_fonts( dp_theme_mod( 'dp_secondary_menu_logo_title_font_family' ) );
    }

    $dp_secondary_menu_logo_title_font_size = dp_theme_mod( 'dp_secondary_menu_logo_title_font_size' );
    $dp_secondary_menu_logo_title_font_weight = dp_theme_mod( 'dp_secondary_menu_logo_title_font_weight' );
    $dp_secondary_menu_logo_title_color = dp_theme_mod( 'dp_secondary_menu_logo_title_color' );
    $dp_secondary_menu_logo_title_style = dp_font_style()[dp_theme_mod( 'dp_secondary_menu_logo_title_style' )];
    $dp_secondary_menu_logo_title_margin_bottom = dp_theme_mod( 'dp_secondary_menu_logo_title_margin_bottom' );

    if ( dp_theme_mod( 'dp_secondary_menu_logo_tagline_font_family_toggle' ) == true ) {
        $dp_secondary_menu_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
    } else {
        $dp_secondary_menu_logo_tagline_font_family = dp_decode_fonts( dp_theme_mod( 'dp_secondary_menu_logo_tagline_font_family' ) );
    }

    $dp_secondary_menu_logo_tagline_font_size = dp_theme_mod( 'dp_secondary_menu_logo_tagline_font_size' );
    $dp_secondary_menu_logo_tagline_font_weight = dp_theme_mod( 'dp_secondary_menu_logo_tagline_font_weight' );
    $dp_secondary_menu_logo_tagline_color = dp_theme_mod( 'dp_secondary_menu_logo_tagline_color' );



    // secondary Menu
    $dp_secondary_menu_submenu_indicator = dp_theme_mod( 'dp_secondary_menu_submenu_indicator' );
    $dp_secondary_menu_item_home_icon_font_size = dp_theme_mod( 'dp_secondary_menu_font_size' ) + 14;
    //$dp_secondary_menu_item_submenu_icon_font_size = round( ( ( dp_theme_mod( 'dp_secondary_menu_font_size' ) / 20 ) * 16 ), 0, PHP_ROUND_HALF_DOWN );
    $dp_secondary_menu_item_submenu_icon_font_size = round( ( ( dp_theme_mod( 'dp_secondary_menu_font_size' ) * 0.5 ) + 12 ), 0, PHP_ROUND_HALF_DOWN );

    if ( $dp_secondary_menu_home_icon == true ) {
        $dp_secondary_menu_item_home_font_size = '0px';
        $dp_secondary_menu_item_home_after_display = 'inline-block';

    } else {
        $dp_secondary_menu_item_home_font_size = 'inherit';
        $dp_secondary_menu_item_home_after_display = 'none';
    }

    if ( $dp_secondary_menu_submenu_indicator == true ) {
        $dp_secondary_menu_submenu_indicator_display = 'inline-block';
    } else {
        $dp_secondary_menu_submenu_indicator_display = 'none';
    }

    if ( $dp_secondary_menu_home_icon == false AND $dp_secondary_menu_submenu_indicator == false ) {
        $dp_secondary_menu_item_home_and_submenu_after_display = 'none';
        $dp_secondary_menu_item_home_and_submenu_after_content = '';
        $dp_secondary_menu_item_home_and_submenu_after_fontsize = '0';
        $dp_secondary_menu_item_home_and_submenu_after_verticalalign = 'middle';
    }
    if ( $dp_secondary_menu_home_icon == true AND $dp_secondary_menu_submenu_indicator == false ) {
        $dp_secondary_menu_item_home_and_submenu_after_display = 'inline-block';
        $dp_secondary_menu_item_home_and_submenu_after_content = ' \f102';
        $dp_secondary_menu_item_home_and_submenu_after_fontsize = dp_theme_mod( 'dp_secondary_menu_font_size' ) + 14 . 'px';
        $dp_secondary_menu_item_home_and_submenu_after_verticalalign = 'middle';
    }
    if ( $dp_secondary_menu_home_icon == false AND $dp_secondary_menu_submenu_indicator == true ) {
        $dp_secondary_menu_item_home_and_submenu_after_display = 'inline-block';
        $dp_secondary_menu_item_home_and_submenu_after_content = ' \f140';
        $dp_secondary_menu_item_home_and_submenu_after_fontsize = round( ( ( dp_theme_mod( 'dp_secondary_menu_font_size' ) * 0.5 ) + 12 ), 0 ) . 'px';
        $dp_secondary_menu_item_home_and_submenu_after_verticalalign = 'top';
    }
    if ( $dp_secondary_menu_home_icon == true AND $dp_secondary_menu_submenu_indicator == true ) {
        $dp_secondary_menu_item_home_and_submenu_after_display = 'inline-block';
        $dp_secondary_menu_item_home_and_submenu_after_content = ' \f102';
        $dp_secondary_menu_item_home_and_submenu_after_fontsize = dp_theme_mod( 'dp_secondary_menu_font_size' ) + 14 . 'px';
        $dp_secondary_menu_item_home_and_submenu_after_verticalalign = 'middle';
    }
    $dp_secondary_menu_font_weight = dp_theme_mod( 'dp_secondary_menu_font_weight' );

    if ( dp_theme_mod( 'dp_secondary_menu_link_text_decoration' ) == true ) {
        $dp_secondary_menu_link_text_decoration = 'underline';
    } else {
        $dp_secondary_menu_link_text_decoration = 'none';
    }

    // secondary Menu Logo URL
    if ( dp_theme_mod( 'dp_secondary_menu_logo_upload' ) == true ) {
        $dp_secondary_menu_logo_upload = 'background-image: url( ' . dp_theme_mod( 'dp_secondary_menu_logo_upload' ) .');';
				$dp_secondary_menu_logo_upload = str_replace( $url_http_https, '', $dp_secondary_menu_logo_upload );
        $dp_secondary_menu_logo_display = 'inline-block';
    } else {
        $dp_secondary_menu_logo_upload = '';
        $dp_secondary_menu_logo_display = 'none';
    }




    // secondary Menu Search Box Padding Left
    if ( dp_theme_mod( 'dp_secondary_menu_search_padding_left' ) == true ) {
        $dp_secondary_menu_search_padding_left =  dp_theme_mod( 'dp_secondary_menu_item_padding_left_right' );
    } else {
        $dp_secondary_menu_search_padding_left = '0';
    }

    // secondary Menu Search Box Padding Left
    if ( dp_theme_mod( 'dp_secondary_menu_search_padding_right' ) == true ) {
        $dp_secondary_menu_search_padding_right =  dp_theme_mod( 'dp_secondary_menu_item_padding_left_right' );
    } else {
        $dp_secondary_menu_search_padding_right = '0';
    }

    // secondary Menu Logo Margin Right
    $dp_secondary_menu_logo_margin_right = dp_theme_mod( 'dp_secondary_menu_logo_margin_right' );

    // secondary Menu Logo Padding Left
    if ( dp_theme_mod( 'dp_secondary_menu_logo_padding_left' ) == true ) {
        $dp_secondary_menu_logo_padding_left =  dp_theme_mod( 'dp_secondary_menu_item_padding_left_right' );
    } else {
        $dp_secondary_menu_logo_padding_left = '0';
    }

    // secondary Menu Logo Padding Left
    if ( dp_theme_mod( 'dp_secondary_menu_logo_padding_right' ) == true ) {
        $dp_secondary_menu_logo_padding_right =  dp_theme_mod( 'dp_secondary_menu_item_padding_left_right' );
    } else {
        $dp_secondary_menu_logo_padding_right = '0';
    }

    $dp_secondary_menu_link_color = dp_theme_mod( 'dp_secondary_menu_link_color' );
    $dp_secondary_menu_link_color_active = dp_theme_mod( 'dp_secondary_menu_link_color_active' );

    // secondary Menu Background Color
    $dp_secondary_menu_bg_color_style = dp_theme_mod( 'dp_secondary_menu_bg_color_style' );
    $dp_secondary_menu_bg_color = dp_theme_mod( 'dp_secondary_menu_bg_color' );
    $dp_secondary_menu_bg_color2 = dp_theme_mod( 'dp_secondary_menu_bg_color2' );
    $dp_secondary_menu_bg_shade_strenght = dp_theme_mod( 'dp_secondary_menu_bg_shade_strenght' );
    $dp_secondary_menu_bg_gradient_style = dp_theme_mod( 'dp_secondary_menu_bg_gradient_style' );
    $dp_secondary_menu_bg_gradient_advanced_toggle = dp_theme_mod( 'dp_secondary_menu_bg_gradient_advanced_toggle' );
    $dp_secondary_menu_bg_gradient_position_parameter1 = dp_theme_mod( 'dp_secondary_menu_bg_gradient_position_parameter1' );
    $dp_secondary_menu_bg_gradient_position_parameter2 = dp_theme_mod( 'dp_secondary_menu_bg_gradient_position_parameter2' );
    $dp_secondary_menu_bg_gradient_reverse_color = dp_theme_mod( 'dp_secondary_menu_bg_gradient_reverse_color' );
    //$dp_secondary_menu_bg_items_only = dp_theme_mod( 'dp_secondary_menu_bg_items_only' );

    if( $dp_secondary_menu_bg_color_style == "1" ) {
        $dp_secondary_menu_bg_shape = '0';
    } else {
        $dp_secondary_menu_bg_shape = $dp_secondary_menu_bg_gradient_style;
    }

    $dp_secondary_menu_bg = bg_gradient (
        $dp_secondary_menu_bg_shape,
        $dp_secondary_menu_bg_color,
        $dp_secondary_menu_bg_color2,
        $dp_secondary_menu_bg_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_secondary_menu_bg_gradient_position_parameter1,
        $dp_secondary_menu_bg_gradient_position_parameter2,
        $dp_secondary_menu_bg_shade_strenght,
        $dp_secondary_menu_bg_gradient_reverse_color,
        $dp_secondary_menu_bg_gradient_advanced_toggle
    );

    // Sticky secondary Menu Background Color
// 	$dp_secondary_menu_sticky_bg_color_style = dp_theme_mod( 'dp_secondary_menu_sticky_bg_color_style' );
// 	$dp_secondary_menu_sticky_bg_color = dp_theme_mod( 'dp_secondary_menu_sticky_bg_color' );
// 	$dp_secondary_menu_sticky_bg_color2 = dp_theme_mod( 'dp_secondary_menu_sticky_bg_color2' );
// 	$dp_secondary_menu_sticky_bg_shade_strenght = dp_theme_mod( 'dp_secondary_menu_sticky_bg_shade_strenght' );
// 	$dp_secondary_menu_sticky_bg_gradient_style = dp_theme_mod( 'dp_secondary_menu_sticky_bg_gradient_style' );
// 	$dp_secondary_menu_sticky_bg_gradient_advanced_toggle = dp_theme_mod( 'dp_secondary_menu_sticky_bg_gradient_advanced_toggle' );
// 	$dp_secondary_menu_sticky_bg_gradient_position_parameter1 = dp_theme_mod( 'dp_secondary_menu_sticky_bg_gradient_position_parameter1' );
// 	$dp_secondary_menu_sticky_bg_gradient_position_parameter2 = dp_theme_mod( 'dp_secondary_menu_sticky_bg_gradient_position_parameter2' );
// 	$dp_secondary_menu_sticky_bg_gradient_reverse_color = dp_theme_mod( 'dp_secondary_menu_sticky_bg_gradient_reverse_color' );
    //$dp_secondary_menu_sticky_bg_items_only = dp_theme_mod( 'dp_secondary_menu_sticky_bg_items_only' );

// 	if( $dp_secondary_menu_sticky_bg_color_style == "1" ) {
// 		$dp_secondary_menu_sticky_bg_shape = '0';
// 	} else {
// 		$dp_secondary_menu_sticky_bg_shape = $dp_secondary_menu_sticky_bg_gradient_style;
// 	}

// 	$dp_secondary_menu_sticky_bg = bg_gradient (
// 		$dp_secondary_menu_sticky_bg_shape,
// 		$dp_secondary_menu_sticky_bg_color,
// 		$dp_secondary_menu_sticky_bg_color2,
// 		$dp_secondary_menu_sticky_bg_color_style,
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		'',
// 		$dp_secondary_menu_sticky_bg_gradient_position_parameter1,
// 		$dp_secondary_menu_sticky_bg_gradient_position_parameter2,
// 		$dp_secondary_menu_sticky_bg_shade_strenght,
// 		$dp_secondary_menu_sticky_bg_gradient_reverse_color,
// 		$dp_secondary_menu_sticky_bg_gradient_advanced_toggle
// 	);

    if ( $dp_secondary_menu_bg_items_only == true ) {
        $dp_secondary_menu_bg_nav = '';
        $dp_secondary_menu_bg_li = $dp_secondary_menu_bg;
    } else {
        $dp_secondary_menu_bg_nav =  $dp_secondary_menu_bg;
        $dp_secondary_menu_bg_li = '';
    }



    $dp_secondary_menu_bg_active_color_style = dp_theme_mod( 'dp_secondary_menu_bg_active_color_style' );
    $dp_secondary_menu_bg_active_color = dp_theme_mod( 'dp_secondary_menu_bg_active_color' );
    $dp_secondary_menu_bg_active_color2 = dp_theme_mod( 'dp_secondary_menu_bg_active_color2' );
    $dp_secondary_menu_bg_active_shade_strenght = dp_theme_mod( 'dp_secondary_menu_bg_active_shade_strenght' );
    $dp_secondary_menu_bg_active_gradient_style = dp_theme_mod( 'dp_secondary_menu_bg_active_gradient_style' );
    $dp_secondary_menu_bg_active_gradient_advanced_toggle = dp_theme_mod( 'dp_secondary_menu_bg_active_gradient_advanced_toggle' );
    $dp_secondary_menu_bg_active_gradient_position_parameter1 = dp_theme_mod( 'dp_secondary_menu_bg_active_gradient_position_parameter1' );
    $dp_secondary_menu_bg_active_gradient_position_parameter2 = dp_theme_mod( 'dp_secondary_menu_bg_active_gradient_position_parameter2' );
    $dp_secondary_menu_bg_active_gradient_reverse_color = dp_theme_mod( 'dp_secondary_menu_bg_active_gradient_reverse_color' );

    if( $dp_secondary_menu_bg_active_color_style == "1" ) {
        $dp_secondary_menu_bg_active_shape = '0';
    } else {
        $dp_secondary_menu_bg_active_shape = $dp_secondary_menu_bg_active_gradient_style;
    }

    $dp_secondary_menu_bg_active = bg_gradient (
        $dp_secondary_menu_bg_active_shape,
        $dp_secondary_menu_bg_active_color,
        $dp_secondary_menu_bg_active_color2,
        $dp_secondary_menu_bg_active_color_style,
        '',
        '',
        '',
        '',
        '',
        '',
        '',
        $dp_secondary_menu_bg_active_gradient_position_parameter1,
        $dp_secondary_menu_bg_active_gradient_position_parameter2,
        $dp_secondary_menu_bg_active_shade_strenght,
        $dp_secondary_menu_bg_active_gradient_reverse_color,
        $dp_secondary_menu_bg_active_gradient_advanced_toggle
    );

    //$dp_secondary_menu_bg_active_boxshadow = 'box-shadow: ' . dp_hover_shadows()[dp_theme_mod( 'dp_secondary_menu_bg_active_boxshadow' )] . ';';

    if ( dp_theme_mod( 'dp_secondary_menu_bg_active_boxshadow' ) == "0" ) {
        $dp_secondary_menu_bg_active_boxshadow = '';
    } else {
        $dp_secondary_menu_bg_active_boxshadow = 'box-shadow: ' . dp_hover_shadows()[dp_theme_mod( 'dp_secondary_menu_bg_active_boxshadow' )] . ';';
    }

    $dp_secondary_menu_margin_top = dp_theme_mod( 'dp_secondary_menu_margin_top' );
    $dp_secondary_menu_margin_bottom = dp_theme_mod( 'dp_secondary_menu_margin_bottom' );
    $dp_secondary_menu_item_padding_left_right = dp_theme_mod( 'dp_secondary_menu_item_padding_left_right' );

    $dp_secondary_menu_border_style = dp_theme_mod( 'dp_secondary_menu_border_style' );
    $dp_secondary_menu_border_width_top = dp_theme_mod( 'dp_secondary_menu_border_width_top' );
    $dp_secondary_menu_border_width_right = dp_theme_mod( 'dp_secondary_menu_border_width_right' );
    $dp_secondary_menu_border_width_bottom = dp_theme_mod( 'dp_secondary_menu_border_width_bottom' );
    $dp_secondary_menu_border_width_left = dp_theme_mod( 'dp_secondary_menu_border_width_left' );
    $dp_secondary_menu_border_color = dp_theme_mod( 'dp_secondary_menu_border_color' );

    if ( $dp_secondary_menu_border_style != 'none' ) {
        $secondary_menu_border_style = '
			border-top: '.$dp_secondary_menu_border_width_top.'px '.$dp_secondary_menu_border_style.' '.$dp_secondary_menu_border_color.';
			border-bottom: '.$dp_secondary_menu_border_width_bottom.'px '.$dp_secondary_menu_border_style.' '.$dp_secondary_menu_border_color.';
			border-left: '.$dp_secondary_menu_border_width_left.'px '.$dp_secondary_menu_border_style.' '.$dp_secondary_menu_border_color.';
			border-right: '.$dp_secondary_menu_border_width_right.'px '.$dp_secondary_menu_border_style.' '.$dp_secondary_menu_border_color.';
		';
    } else {
        $secondary_menu_border_style = 'border: none;';
    }

    $dp_secondary_menu_border_radius_topleft = dp_theme_mod( 'dp_secondary_menu_border_radius_topleft' );
    $dp_secondary_menu_border_radius_topright = dp_theme_mod( 'dp_secondary_menu_border_radius_topright' );
    $dp_secondary_menu_border_radius_bottomright = dp_theme_mod( 'dp_secondary_menu_border_radius_bottomright' );
    $dp_secondary_menu_border_radius_bottomleft = dp_theme_mod( 'dp_secondary_menu_border_radius_bottomleft' );


    if ( $dp_secondary_menu_border_radius_topleft == '0' AND $dp_secondary_menu_border_radius_topright == '0' AND $dp_secondary_menu_border_radius_bottomright == '0' AND $dp_secondary_menu_border_radius_bottomleft == '0') {
        $dp_secondary_menu_border_radius = 'border-radius: 0;';
    } else {
        $dp_secondary_menu_border_radius = 'border-radius: ' . $dp_secondary_menu_border_radius_topleft . 'px ' . $dp_secondary_menu_border_radius_topright . 'px ' . $dp_secondary_menu_border_radius_bottomright . 'px ' . $dp_secondary_menu_border_radius_bottomleft . 'px;';
    }

    $dp_secondary_menu_font_size = dp_theme_mod( 'dp_secondary_menu_font_size' );
    $dp_secondary_menu_item_alignment = dp_theme_mod( 'dp_secondary_menu_item_alignment' );

    if ( $dp_secondary_menu_item_alignment == 'fullwidth' ) {
        $dp_secondary_menu_item_alignment_textalign = 'center';
        $dp_secondary_menu_item_alignment_display = 'flex';
        $dp_secondary_menu_item_alignment_justifycontent = 'space-between';
        $dp_secondary_menu_item_alignment_width = '100%';

    } else {
        $dp_secondary_menu_item_alignment_textalign = $dp_secondary_menu_item_alignment;
        $dp_secondary_menu_item_alignment_display = 'inline-block';
        $dp_secondary_menu_item_alignment_justifycontent = 'flex-start';
        $dp_secondary_menu_item_alignment_width = 'auto';
    }


    $dp_secondary_menu_item_dividers = dp_theme_mod( 'dp_secondary_menu_item_dividers' );
    $dp_secondary_menu_item_dividers_firstchild = dp_theme_mod( 'dp_secondary_menu_item_dividers_firstchild' );
    $dp_secondary_menu_item_dividers_lastchild = dp_theme_mod( 'dp_secondary_menu_item_dividers_lastchild' );
    $dp_secondary_menu_item_dividers_top = dp_theme_mod( 'dp_secondary_menu_item_dividers_top' );
    $dp_secondary_menu_item_dividers_bottom = dp_theme_mod( 'dp_secondary_menu_item_dividers_bottom' );
    $dp_secondary_menu_item_dividers_color_toggle = dp_theme_mod( 'dp_secondary_menu_item_dividers_color_toggle' );
    $dp_secondary_menu_item_dividers_color = dp_theme_mod( 'dp_secondary_menu_item_dividers_color' );
    $dp_secondary_menu_search_toggle = dp_theme_mod( 'dp_secondary_menu_search_toggle' );
    $dp_secondary_menu_search_opening_divider = dp_theme_mod( 'dp_secondary_menu_search_opening_divider' );
    $dp_secondary_menu_search_closing_divider = dp_theme_mod( 'dp_secondary_menu_search_closing_divider' );

    if ( $dp_secondary_menu_item_dividers_color_toggle == true ) {
        $dp_secondary_menu_item_dividers_newcolor = shading( $dp_secondary_menu_item_dividers_color, -0.4);
        $dp_secondary_menu_item_dividers_newcolor2 = shading( $dp_secondary_menu_item_dividers_color, 0.3);

    } else {
        $dp_secondary_menu_item_dividers_newcolor = shading( $dp_secondary_menu_bg_color, -0.4);
        $dp_secondary_menu_item_dividers_newcolor2 = shading( $dp_secondary_menu_bg_color, 0.3);
    }

    /*
     * secondary Menu Item Dividers (None)
     */
    if ( $dp_secondary_menu_item_dividers == '0' ) {

        $dp_secondary_menu_item_dividers_boxshadow = 'none';
        $dp_secondary_menu_item_dividers_boxshadow_firstchild = 'none';
        $dp_secondary_menu_item_dividers_boxshadow_lastchild = 'none';

        $dp_secondary_menu_item_dividers_bordertop = 'none';
        $dp_secondary_menu_item_dividers_borderbottom = 'none';

        $dp_secondary_menu_search_divider_boxshadow = 'none';

        $dp_secondary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
    }

    /*
     * secondary Menu Item Dividers (Single Line)
     */
    if ( $dp_secondary_menu_item_dividers == '1' ) {

        $dp_secondary_menu_item_dividers_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
        $dp_secondary_menu_item_dividers_bordertop = 'none';
        $dp_secondary_menu_item_dividers_borderbottom = 'none';

        if ( $dp_secondary_menu_item_dividers_firstchild == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_firstchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
        } else {
            $dp_secondary_menu_item_dividers_boxshadow_firstchild = 'none';
        }

        if ( $dp_secondary_menu_item_dividers_lastchild == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';
        } else {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';
        }

        if ( $dp_secondary_menu_item_dividers_top == true ) {
            $dp_secondary_menu_item_dividers_bordertop = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
        } else {
            $dp_secondary_menu_item_dividers_bordertop = 'none';
        }

        if ( $dp_secondary_menu_item_dividers_bottom == true ) {
            $dp_secondary_menu_item_dividers_borderbottom = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
        } else {
            $dp_secondary_menu_item_dividers_borderbottom = 'none';
        }

        if ( $dp_secondary_menu_search_toggle == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild_position = ':nth-last-child(2)';

            if ( $dp_secondary_menu_search_opening_divider == true && $dp_secondary_menu_search_closing_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';

            } elseif ( $dp_secondary_menu_search_opening_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset';

            } elseif ( $dp_secondary_menu_search_closing_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset';

            } else {
                $dp_secondary_menu_search_divider_boxshadow = 'none';
            }

        } else {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
            $dp_secondary_menu_search_divider_boxshadow = 'none';
        }

    }

    /*
     * secondary Menu Item Dividers (Dual Line)
     */
    if ( $dp_secondary_menu_item_dividers == '2' ) {

// 		if ( $dp_secondary_menu_item_dividers_top == true ) {
// 			$dp_secondary_menu_item_dividers_bordertop = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
// 			$dp_secondary_menu_item_dividers_bordertop_boxshadow = ', ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 0px 1px 0px 0px inset';
// 		} else {
// 			$dp_secondary_menu_item_dividers_bordertop = 'none';
// 			$dp_secondary_menu_item_dividers_bordertop_boxshadow = '';
// 		}

// 		if ( $dp_secondary_menu_item_dividers_bottom == true ) {
// 			$dp_secondary_menu_item_dividers_borderbottom = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
// 		} else {
// 			$dp_secondary_menu_item_dividers_borderbottom = 'none';
// 		}

// 		$dp_secondary_menu_item_dividers_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

// 		if ( $dp_secondary_menu_item_dividers_firstchild == true ) {
// 			$dp_secondary_menu_item_dividers_boxshadow_firstchild = $dp_secondary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

// 		} else {
// 			$dp_secondary_menu_item_dividers_boxshadow_firstchild = $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;
// 		}

// 		if ( $dp_secondary_menu_item_dividers_lastchild == true ) {
// 			$dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

// 		} else {
// 			$dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor2 . ' 1px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;
// 		}


        //	$dp_secondary_menu_item_dividers_bordertop = 'none';
        //	$dp_secondary_menu_item_dividers_borderbottom = 'none';

        if ( $dp_secondary_menu_item_dividers_top == true ) {
            $dp_secondary_menu_item_dividers_bordertop = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
            $dp_secondary_menu_item_dividers_bordertop_boxshadow = ', ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 0px 1px 0px 0px inset';
        } else {
            $dp_secondary_menu_item_dividers_bordertop = 'none';
            $dp_secondary_menu_item_dividers_bordertop_boxshadow = '';
        }

        if ( $dp_secondary_menu_item_dividers_bottom == true ) {
            $dp_secondary_menu_item_dividers_borderbottom = '1px solid ' . $dp_secondary_menu_item_dividers_newcolor;
        } else {
            $dp_secondary_menu_item_dividers_borderbottom = 'none';
        }

        if ( $dp_secondary_menu_item_dividers_firstchild == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_firstchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;
        } else {
            $dp_secondary_menu_item_dividers_boxshadow_firstchild = 'none';
        }

        if ( $dp_secondary_menu_item_dividers_lastchild == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' -1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;
        } else {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;
        }

        if ( $dp_secondary_menu_search_toggle == true ) {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild_position = ':nth-last-child(2)';

            if ( $dp_secondary_menu_search_opening_divider == true && $dp_secondary_menu_search_closing_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' -1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor . ' -2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

            } elseif ( $dp_secondary_menu_search_opening_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

            } elseif ( $dp_secondary_menu_search_closing_divider == true ) {
                $dp_secondary_menu_search_divider_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' -1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' -2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

            } else {
                $dp_secondary_menu_search_divider_boxshadow = 'none';
            }

        } else {
            $dp_secondary_menu_item_dividers_boxshadow_lastchild_position = ':last-child';
            $dp_secondary_menu_search_divider_boxshadow = 'none';
        }

        $dp_secondary_menu_item_dividers_boxshadow = $dp_secondary_menu_item_dividers_newcolor . ' 1px 0px 0px 0px inset, ' . $dp_secondary_menu_item_dividers_newcolor2 . ' 2px 0px 0px 0px inset' . $dp_secondary_menu_item_dividers_bordertop_boxshadow;

    }


    if ( dp_theme_mod( 'dp_secondary_menu_boxed' ) == true ) {
        $dp_secondary_menu_wrap_padding = '0px';
        $dp_secondary_menu_item_padding_right_search_box = '0px';
    } elseif ( dp_theme_mod( 'dp_secondary_menu_item_alignment_padding' ) == true ) {
        $dp_secondary_menu_wrap_padding = $dp_site_container_wrap_padding_left_right . 'px';
        //$dp_secondary_menu_item_padding_child = $dp_secondary_menu_item_padding_left_right . 'px';
        $dp_secondary_menu_item_padding_right_search_box = '0px';
        //$dp_secondary_menu_item_padding_left_logo = '0px';
    } else {
        $dp_secondary_menu_wrap_padding = '0px';
        //$dp_secondary_menu_item_padding_child = $dp_secondary_menu_item_padding_left_right . 'px';
        $dp_secondary_menu_item_padding_right_search_box = $dp_site_container_wrap_padding_left_right . 'px';
        //$dp_secondary_menu_item_padding_left_logo = $dp_site_container_wrap_padding_left_right . 'px';
    }

    if ( dp_theme_mod( 'dp_secondary_menu_font_family_toggle' ) == true ) {
        $dp_secondary_menu_font_family = dp_decode_fonts( dp_theme_mod( 'dp_typography_font_family' ) );
    } else {
        $dp_secondary_menu_font_family = dp_decode_fonts( dp_theme_mod( 'dp_secondary_menu_font_family' ) );
    }

// 	if ( dp_theme_mod( 'dp_secondary_menu_sticky_menu_width' ) == true ) {
// 		$dp_secondary_menu_sticky_menu_width = '100%';
// 	} else {
// 		$dp_secondary_menu_sticky_menu_width =  dp_theme_mod( 'dp_site_container_width' ) . 'px';
// 	}

// 	if ( dp_theme_mod( 'dp_secondary_menu_sticky' ) == '1' ) {
// 		$dp_secondary_menu_sticky_transition = 'transition: width 0.6s, max-width 0.6s, height 0.6s;';
// 		$dp_secondary_menu_sticky_transition_logo = 'transition: all 0.4s;';
// 	} else {
// 		$dp_secondary_menu_sticky_transition =  '';
// 		$dp_secondary_menu_sticky_transition_logo =  '';
// 	}

// 	if ( dp_theme_mod( 'dp_secondary_menu_sticky_border' ) == true ) {
// 		$dp_secondary_menu_sticky_border = 'border: 0;';
// 	} else {
// 		$dp_secondary_menu_sticky_border =  '';
// 	}

// 	if ( dp_theme_mod( 'dp_secondary_menu_sticky_item_padding_top_bottom_toggle' ) == true ) {
// 		$dp_secondary_menu_sticky_item_padding_top_bottom = dp_theme_mod( 'dp_secondary_menu_sticky_item_padding_top_bottom' );
// 	} else {
// 		$dp_secondary_menu_sticky_item_padding_top_bottom = dp_theme_mod( 'dp_secondary_menu_item_padding_top_bottom' );
// 	}

    /*
     * secondary Menu Shadow
     */
    if ( dp_theme_mod( 'dp_secondary_menu_shadow_bottom_style' ) == 'presets' ) {
        $dp_secondary_menu_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_secondary_menu_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_secondary_menu_shadow_bottom_style' ) == 'custom' ) {
        $vertical = dp_theme_mod( 'dp_secondary_menu_shadow_bottom_vertical' );
        $blur = dp_theme_mod( 'dp_secondary_menu_shadow_bottom_blur_radius' );
        $spread = dp_theme_mod( 'dp_secondary_menu_shadow_bottom_spread_radius' );
        $opacity = dp_theme_mod( 'dp_secondary_menu_shadow_bottom_opacity' );

        $dp_secondary_menu_shadow = 'box-shadow: 0px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_secondary_menu_shadow = 'box-shadow: none;';
    }

// 	if ( dp_theme_mod( 'dp_secondary_menu_sticky_shadow_bottom' ) == true ) {
// 		$dp_secondary_menu_stick_shadow = 'box-shadow: none;';
// 	} else {
// 		$dp_secondary_menu_stick_shadow = $dp_secondary_menu_shadow;
// 	}

    if ( dp_theme_mod( 'dp_secondary_menu_search_field_height_toggle' ) == true ) {
        $dp_secondary_menu_search_field_height = dp_theme_mod( 'dp_secondary_menu_search_field_height' );
    } else {
        $dp_secondary_menu_search_field_height = ( dp_theme_mod( 'dp_secondary_menu_font_size' ) * 2 );
    }

    if ( dp_theme_mod( 'dp_secondary_menu_search_font_size_toggle' ) == true ) {
        $dp_secondary_menu_search_font_size = dp_theme_mod( 'dp_secondary_menu_search_font_size' );
        $dp_secondary_menu_search_font_size_icon = dp_theme_mod( 'dp_secondary_menu_search_font_size' ) + 4;
    } else {
        $dp_secondary_menu_search_font_size = dp_theme_mod( 'dp_secondary_menu_font_size' );
        $dp_secondary_menu_search_font_size_icon = dp_theme_mod( 'dp_secondary_menu_font_size' ) + 4;
    }

    $dp_secondary_menu_search_field_width = dp_theme_mod( 'dp_secondary_menu_search_field_width' );
    $dp_secondary_menu_search_border_radius = dp_theme_mod( 'dp_secondary_menu_search_border_radius' );

    if ( dp_theme_mod( 'dp_secondary_menu_search_border_toggle' ) == true ) {
        $dp_secondary_menu_search_border = '1px solid ' . dp_theme_mod( 'dp_secondary_menu_search_border_color' );
    } else {
        $dp_secondary_menu_search_border = 'none';
    }
    $dp_secondary_menu_search_border_color = dp_theme_mod( 'dp_secondary_menu_search_border_color' );
    $dp_secondary_menu_search_submit_font_color = dp_theme_mod( 'dp_secondary_menu_search_submit_font_color' );

    $dp_secondary_menu_height = dp_theme_mod( 'dp_secondary_menu_height' );
	
	
		//WooCommerce Category
    $dp_woocommerce_category_padding = dp_theme_mod( 'dp_woocommerce_category_padding' );
	
    $dp_woocommerce_category_margin_top = dp_theme_mod( 'dp_woocommerce_category_margin_top' );
    $dp_woocommerce_category_margin_right = dp_theme_mod( 'dp_woocommerce_category_margin_right' );
    $dp_woocommerce_category_margin_bottom = dp_theme_mod( 'dp_woocommerce_category_margin_bottom' );
    $dp_woocommerce_category_margin_left = dp_theme_mod( 'dp_woocommerce_category_margin_left' );
	
    $dp_woocommerce_category_border_radius = dp_theme_mod( 'dp_woocommerce_category_border_radius' );

		$dp_woocommerce_category_border_style = dp_theme_mod( 'dp_woocommerce_category_border_style' );
    $dp_woocommerce_category_border_top = dp_theme_mod( 'dp_woocommerce_category_border_top' );
    $dp_woocommerce_category_border_right = dp_theme_mod( 'dp_woocommerce_category_border_right' );
    $dp_woocommerce_category_border_bottom = dp_theme_mod( 'dp_woocommerce_category_border_bottom' );
    $dp_woocommerce_category_border_left = dp_theme_mod( 'dp_woocommerce_category_border_left' );
    $dp_woocommerce_category_border_color = dp_theme_mod( 'dp_woocommerce_category_border_color' );

    if ( $dp_woocommerce_category_border_style != 'none' ) {
        $dp_woocommerce_category_border = '
			border-top: '.$dp_woocommerce_category_border_top.'px '.$dp_woocommerce_category_border_style.' '.$dp_woocommerce_category_border_color.';
			border-bottom: '.$dp_woocommerce_category_border_bottom.'px '.$dp_woocommerce_category_border_style.' '.$dp_woocommerce_category_border_color.';
			border-left: '.$dp_woocommerce_category_border_left.'px '.$dp_woocommerce_category_border_style.' '.$dp_woocommerce_category_border_color.';
			border-right: '.$dp_woocommerce_category_border_right.'px '.$dp_woocommerce_category_border_style.' '.$dp_woocommerce_category_border_color.';
	';
    } else {
        $dp_woocommerce_category_border = 'border: none;';
    }

    if ( dp_theme_mod( 'dp_woocommerce_category_shadow_style' ) == 'presets' ) {
        $dp_woocommerce_category_shadow = 'box-shadow: ' . dp_shadows()[dp_theme_mod( 'dp_woocommerce_category_shadow_presets' ) - 1] . ';';

    } elseif ( dp_theme_mod( 'dp_woocommerce_category_shadow_style' ) == 'custom' ) {
        $horizontal = dp_theme_mod( 'dp_woocommerce_category_shadow_horizontal' );
        $vertical = dp_theme_mod( 'dp_woocommerce_category_shadow_vertical' );
        $blur = dp_theme_mod( 'dp_woocommerce_category_shadow_blur_radius' );
        $spread = dp_theme_mod( 'dp_woocommerce_category_shadow_spread_radius' );
        $opacity = dp_theme_mod( 'dp_woocommerce_category_shadow_opacity' );

        $dp_woocommerce_category_shadow = 'box-shadow: ' . $horizontal . 'px ' . $vertical . 'px ' . $blur . 'px ' . $spread . 'px rgba(0, 0, 0, ' . $opacity . ');';

    } else {
        $dp_woocommerce_category_shadow = 'box-shadow: none;';
    }

	$dp_woocommerce_category_color = dp_theme_mod( 'dp_woocommerce_category_color' );
	
	$dp_woocommerce_category_sale_bg_color = dp_theme_mod( 'dp_woocommerce_category_sale_bg_color' );
	$dp_woocommerce_category_sale_font_color = dp_theme_mod( 'dp_woocommerce_category_sale_font_color' );
	$dp_woocommerce_category_cart_bg_color = dp_theme_mod( 'dp_woocommerce_category_cart_bg_color' );
	$dp_woocommerce_category_cart_font_color = dp_theme_mod( 'dp_woocommerce_category_cart_font_color' );
	$dp_woocommerce_category_product_font_size = dp_theme_mod( 'dp_woocommerce_category_product_font_size' );

    return '/*Theme Name: DisruptPress
Theme URI: http://www.disruptpress.com
Author: Aedan OBrien
Author URI: http://www.aedanobrien.com
Description: Theme Description
Version: '.DP_VERSION.'
Last Update: '.$time.'
License: proprietary
Text Domain: disruptpress
*/


/*--------------------------------------------------------------
# normalize.css v5.0.0 | MIT License | github.com/necolas/normalize.css
--------------------------------------------------------------*/
html{font-family:sans-serif;line-height:1.15;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,footer,header,nav,section{display:block}h1{font-size:2em;margin:0.67em 0}figcaption,figure,main{display:block}figure{margin:1em 40px}hr{box-sizing:content-box;height:0;overflow:visible}pre{font-family:monospace, monospace;font-size:1em}a{background-color:transparent;-webkit-text-decoration-skip:objects}a:active,a:hover{outline-width:0}abbr[title]{border-bottom:none;text-decoration:underline;text-decoration:underline dotted}b,strong{font-weight:inherit}b,strong{font-weight:bolder}code,kbd,samp{font-family:monospace, monospace;font-size:1em}dfn{font-style:italic}mark{background-color:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sub{bottom:-0.25em}sup{top:-0.5em}audio,video{display:inline-block}audio:not([controls]){display:none;height:0}img{border-style:none}svg:not(:root){overflow:hidden}button,input,optgroup,select,textarea{font-family:sans-serif;font-size:100%;line-height:1.15;margin:0}button,input{overflow:visible}button,select{text-transform:none}button,html [type="button"],[type="reset"],[type="submit"]{-webkit-appearance:button}button::-moz-focus-inner,[type="button"]::-moz-focus-inner,[type="reset"]::-moz-focus-inner,[type="submit"]::-moz-focus-inner{border-style:none;padding:0}button:-moz-focusring,[type="button"]:-moz-focusring,[type="reset"]:-moz-focusring,[type="submit"]:-moz-focusring{outline:1px dotted ButtonText}fieldset{border:1px solid #c0c0c0;margin:0 2px;padding:0.35em 0.625em 0.75em}legend{box-sizing:border-box;color:inherit;display:table;max-width:100%;padding:0;white-space:normal}progress{display:inline-block;vertical-align:baseline}textarea{overflow:auto}[type="checkbox"],[type="radio"]{box-sizing:border-box;padding:0}[type="number"]::-webkit-inner-spin-button,[type="number"]::-webkit-outer-spin-button{height:auto}[type="search"]{-webkit-appearance:textfield;outline-offset:-2px}[type="search"]::-webkit-search-cancel-button,[type="search"]::-webkit-search-decoration{-webkit-appearance:none}::-webkit-file-upload-button{-webkit-appearance:button;font:inherit}details,menu{display:block}summary{display:list-item}canvas{display:inline-block}template{display:none}[hidden]{display:none}

/* ## Box Sizing
--------------------------------------------- */

html,
input[type="search"]{
	-webkit-box-sizing: border-box;
	-moz-box-sizing:    border-box;
	box-sizing:         border-box;
}

*,
*:before,
*:after {
	box-sizing: inherit;
}


/* ## Float Clearing
--------------------------------------------- */

.author-box:before,
.clearfix:before,
.entry:before,
.entry-content:before,
.nav-primary:before,
.nav-secondary:before,
.pagination:before,
.site-container:before,
.site-footer:before,
.site-header:before,
.site-inner:before,
.widget:before,
.wrap:before {
	content: " ";
	display: table;
}

.author-box:after,
.clearfix:after,
.entry:after,
.entry-content:after,
.nav-primary:after,
.nav-secondary:after,
.pagination:after,
.site-container:after,
.site-footer:after,
.site-header:after,
.site-inner:after,
.widget:after,
.wrap:after {
	clear: both;
	content: " ";
	display: table;
}


/* # Defaults
---------------------------------------------------------------------------------------------------- */

/* ## Typographical Elements
--------------------------------------------- */

html {
    font-size: 62.5%; /* 10px browser default */
}

/* Chrome fix */
body > div {
   /* font-size: 1.8rem;*/
}

body {
	position: relative;
	color: ' . $dp_typography_font_color . ';
	font-family: ' . $dp_typography_font_family . ';
	font-size: ' . $dp_typography_font_size . 'px;
	font-size: ' . $dp_typography_font_size / 10 . 'rem;
	font-weight: ' . $dp_typography_font_weight . ';
	line-height: ' . $dp_typography_font_line_height . ';
	margin: 0;
	' . $dp_bg . '
}

a,
button,
input:focus,
input[type="button"],
input[type="reset"],
input[type="submit"],
textarea:focus,
.button,
.gallery img {
	-webkit-transition: all 0.1s ease-in-out;
	-moz-transition:    all 0.1s ease-in-out;
	-ms-transition:     all 0.1s ease-in-out;
	-o-transition:      all 0.1s ease-in-out;
	transition:         all 0.1s ease-in-out;
}

a {
	color: ' . $dp_typography_link_color . ';
	text-decoration: ' . $dp_typography_link_underline . ';
}

a:hover,
a:focus {
	color: ' . $dp_typography_link_color_hover . ';
	text-decoration: ' . $dp_typography_link_hover_underline . ';
}

p {
	margin: 0 0 28px;
	padding: 0;
}

ol,
ul {
	margin: 0;
	padding: 0;
}

li {
	list-style-type: none;
}

hr {
	border: 0;
	border-collapse: collapse;
	border-top: 1px solid #ddd;
	clear: both;
	margin: 1em 0;
}

b,
strong {
	font-weight: 700;
}

blockquote,
cite,
em,
i {
	font-style: italic;
}

blockquote {
	margin: 40px;
}

blockquote::before {
	content: "\201C";
	display: block;
	font-size: 30px;
	height: 0;
	left: -20px;
	position: relative;
	top: -10px;
}


/* ## Headings
--------------------------------------------- */

h1,
h2,
h3,
h4,
h5,
h6 {
	font-family: ' . $dp_typography_h_font_family .';
	font-weight: ' . $dp_typography_h_font_weight . ';
	line-height: ' . $dp_typography_h_font_line_height . ';
	margin: 0;
}

h1 {
	font-size: '. $dp_typography_h1_font_size .'px;
	font-size: '. $dp_typography_h1_font_size / 10 .'rem;
}

h2 {
	font-size: '. $dp_typography_h2_font_size .'px;
	font-size: '. $dp_typography_h2_font_size / 10 .'rem;
}

h3 {
	font-size: '. $dp_typography_h3_font_size .'px;
	font-size: '. $dp_typography_h3_font_size / 10 .'rem;
}

h4 {
	font-size: '. $dp_typography_h4_font_size .'px;
	font-size: '. $dp_typography_h4_font_size / 10 .'rem;
}

h5 {
	font-size: '. $dp_typography_h5_font_size .'px;
	font-size: '. $dp_typography_h5_font_size / 10 .'rem;
}

h6 {
	font-size: '. $dp_typography_h6_font_size .'px;
	font-size: '. $dp_typography_h6_font_size / 10 .'rem;
}

/* ## Objects
--------------------------------------------- */

embed,
iframe,
img,
object,
video,
.wp-caption {
	max-width: 100%;
}

img {
	height: auto;
}

.youtube-embed-container { 
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    max-width: 100%;
    margin-bottom: 25px;
} 

.youtube-embed-container iframe, 
.youtube-embed-container object, 
.youtube-embed-container embed { 
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

/* ## Gallery
--------------------------------------------- */

.gallery {
	overflow: hidden;
}

.gallery-item {
	float: left;
	margin: 0 0 28px;
	text-align: center;
}

.gallery-columns-2 .gallery-item {
	width: 50%;
}

.gallery-columns-3 .gallery-item {
	width: 33%;
}

.gallery-columns-4 .gallery-item {
	width: 25%;
}

.gallery-columns-5 .gallery-item {
	width: 20%;
}

.gallery-columns-6 .gallery-item {
	width: 16.6666%;
}

.gallery-columns-7 .gallery-item {
	width: 14.2857%;
}

.gallery-columns-8 .gallery-item {
	width: 12.5%;
}

.gallery-columns-9 .gallery-item {
	width: 11.1111%;
}

.gallery img {
	border: 1px solid #ddd;
	height: auto;
	padding: 4px;
}

.gallery img:hover,
.gallery img:focus {
	border: 1px solid #999;
}

/* ## Forms
--------------------------------------------- */

input,
select,
textarea {
	background-color: #fff;
	border: 1px solid #ddd;
	color: #333;
	font-size: 18px;
	font-size: 1.8rem;
	font-weight: 400;
	padding: 16px;
	width: 100%;
}

input:focus,
textarea:focus {
	border: 1px solid #999;
	outline: none;
}

input[type="checkbox"],
input[type="image"],
input[type="radio"] {
	width: auto;
}

::-moz-placeholder {
	color: #333;
	opacity: 1;
}

::-webkit-input-placeholder {
	color: #333;
}

button,
input[type="button"],
input[type="reset"],
input[type="submit"],
.button {
	background-color: #333;
	border: 0;
	color: #fff;
	cursor: pointer;
	font-size: 16px;
	font-size: 1.6rem;
	font-weight: 700;
	padding: 16px 24px;
	width: auto;
}

button:hover,
input:hover[type="button"],
input:hover[type="reset"],
input:hover[type="submit"],
.button:hover,
button:focus,
input:focus[type="button"],
input:focus[type="reset"],
input:focus[type="submit"],
.button:focus  {
	background-color: #c3251d;
	color: #fff;
}

.entry-content .button:hover,
.entry-content .button:focus {
	color: #fff;
}

.button {
	display: inline-block;
}

input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button {
	display: none;
}

/* ## Tables
--------------------------------------------- */

table {
	border-collapse: collapse;
	border-spacing: 0;
	line-height: 2;
	margin-bottom: 40px;
	width: 100%;
}

tbody {
	border-bottom: 1px solid #ddd;
}

td,
th {
	text-align: left;
}

td {
	border-top: 1px solid #ddd;
	padding: 6px 0;
}

th {
	font-weight: 400;
}

/* ## Screen Reader Text
--------------------------------------------- */

.screen-reader-text,
.screen-reader-text span,
.screen-reader-shortcut {
	position: absolute !important;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	width: 1px;
	border: 0;
	overflow: hidden;
}

.screen-reader-text:focus,
.screen-reader-shortcut:focus,
.genesis-nav-menu .search input[type="submit"]:focus,
.widget_search input[type="submit"]:focus  {
	clip: auto !important;
	height: auto;
	width: auto;
	display: block;
	font-size: 1em;
	font-weight: bold;
	padding: 15px 23px 14px;
	color: #333;
	background: #fff;
	z-index: 100000; /* Above WP toolbar. */
	text-decoration: none;
	box-shadow: 0 0 2px 2px rgba(0,0,0,.6);
}

.more-link {
    position: relative;
}


/* # Structure and Layout
---------------------------------------------------------------------------------------------------- */

/* ## Site Containers
--------------------------------------------- */

.body-container {
	padding-top: '.$dp_site_container_margin_top_bottom.'px;
	padding-bottom: '.$dp_site_container_margin_top_bottom.'px;
	padding-left: '.$dp_site_container_margin_left_right.'px;
	padding-right: '.$dp_site_container_margin_left_right.'px;
}

.body-background-2 {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	width: 100%;
	z-index: -1;
	' . $body_background_2_height . '
	' . $dp_bg2 . '
	' . $dp_bg2_border_bottom . '
	' . $dp_bg2_shadow_bottom . '
}

.site-container {
	margin: auto auto;
	overflow: hidden;
	' . $dp_site_container_bg . '
	max-width: ' . $site_container_max_width . ';
	' . $site_container_border_style . '
	' . $site_container_box_shadow . '
	' . $dp_site_container_border_radius . '
}

.site-inner {
	/*max-width: '.$site_inner_max_width.';*/
	position: relative;
	width: 100%;
	margin: 0 auto;
	clear: both;
	padding-top: ' . $dp_site_container_site_inner_padding_top . 'px;
	float:left;
}

.wrap {
	max-width: '.$site_inner_max_width.';
	margin: 0 auto;
	padding-left: '.$dp_site_container_wrap_padding_left_right.'px;
	padding-right: '.$dp_site_container_wrap_padding_left_right.'px;
}




.dp-blog-roll-loop-wrap {
    overflow:auto;
    display: block;
  
    padding-top: ' . $dp_blog_roll_wrap_padding_top . 'px;
    padding-right: ' . $dp_blog_roll_wrap_padding_right . 'px;
    padding-bottom: ' . $dp_blog_roll_wrap_padding_bottom . 'px;
    padding-left: ' . $dp_blog_roll_wrap_padding_left . 'px;
    
    margin-top: ' . $dp_blog_roll_wrap_margin_top . 'px;
    margin-right: ' . $dp_blog_roll_wrap_margin_right . 'px;
    margin-bottom: ' . $dp_blog_roll_wrap_margin_bottom . 'px;
    margin-left: ' . $dp_blog_roll_wrap_margin_left . 'px;
    
    ' . $dp_blog_roll_wrap_shadow . ';
    ' . $blog_roll_wrap_border_style . ';
    ' . $dp_blog_roll_wrap_bg . '
    ' . $dp_blog_roll_wrap_border_radius . '
  
}

.blog .entry, .archive .entry, .search .entry {
    display: inline-block;
    width: ' . $dp_blog_roll_wrap_width . ';
    vertical-align: top;
    float: left;
}

.dp-blog-roll-loop-container {
  display: block;
  overflow: auto;
}



.dp-blog-roll-loop-title {
    overflow: hidden;
    position: relative;
    color: ' . $dp_blog_roll_title_font_color . ';
    height: ' . $dp_blog_roll_title_height . ';
    display: ' . $dp_blog_roll_title_width . ';
    
    padding-top: ' . $dp_blog_roll_title_padding_top . 'px;
    padding-right: ' . $dp_blog_roll_title_padding_right . 'px;
    padding-bottom: ' . $dp_blog_roll_title_padding_bottom . 'px;
    padding-left: ' . $dp_blog_roll_title_padding_left . 'px;
    
    margin-top: ' . $dp_blog_roll_title_margin_top . 'px;
    margin-right: ' . $dp_blog_roll_title_margin_right . 'px;
    margin-bottom: ' . $dp_blog_roll_title_margin_bottom . 'px;
    margin-left: ' . $dp_blog_roll_title_margin_left . 'px;
    
    ' . $blog_roll_title_border_style . ';
    ' . $dp_blog_roll_title_bg . '
    ' . $dp_blog_roll_title_border_radius . '
}

.dp-blog-roll-loop-title h2 {
    font-size: ' . $dp_blog_roll_title_font_size . 'px;
    font-size: ' . $dp_blog_roll_title_font_size / 10 . 'rem;
    font-weight: ' . $dp_blog_roll_title_font_weight . ';
    text-align: ' . $dp_blog_roll_title_text_align . ';
}

.dp-blog-roll-loop-title a,
.dp-blog-roll-loop-title a:hover {
    color: ' . $dp_blog_roll_title_font_color . ';
    text-decoration: none;
}
.dp-blog-roll-loop-featured-image {
    width:' . $dp_blog_roll_featured_image_width . ';
    /*max-height: ' . $dp_blog_roll_featured_image_max_height . 'px;*/
    float: ' . $dp_blog_roll_featured_image_float . ';
   
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    
    margin-top: ' . $dp_blog_roll_featured_image_margin_top . 'px;
    margin-right: ' . $dp_blog_roll_featured_image_margin_right . 'px;
    margin-bottom: ' . $dp_blog_roll_featured_image_margin_bottom . 'px;
    margin-left: ' . $dp_blog_roll_featured_image_margin_left . 'px;
    
    ' . $dp_blog_roll_featured_image_shadow . ';
    ' . $blog_roll_featured_image_border_style . ';
    
    ' . $dp_blog_roll_featured_image_border_radius . '
    overflow: hidden;
    line-height: 0;
    position: relative;
    padding-bottom: calc(' . $dp_blog_roll_featured_image_width_calc . ' * ' . $dp_blog_roll_featured_image_aspect_ratio . ');
}

.dp-blog-roll-loop-featured-image-link {
    /*background: rgba(45,45,45, 0.15);*/
    width: 100%;
    height: 100%;
    display: block;
    margin: 0;
    padding: 0;
    top: 0;
    left: 0;
    text-decoration: none;
    /*opacity: 0;*/
    position: absolute;
}

.dp-blog-roll-loop-featured-image img {
    width: 100%;
    height: 100%;
    /*height: ' . $dp_blog_roll_featured_image_height . ';*/
    position: absolute;
}

.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-title-wrap {
    position: absolute;
    width: 100%;
    text-align: ' . $dp_blog_roll_title_location_inside_image_horizontal . ';
    ' . $dp_blog_roll_title_location_inside_image_vertical . '
    /*line-height: 1;*/
    z-index: 10;
}


.dp-blog-roll-loop-excerpt-wrap {
    ' . $dp_blog_roll_excerpt_display . '
    
    text-align: ' . $dp_blog_roll_excerpt_text_align . ';
    font-size: ' . $dp_blog_roll_excerpt_font_size . 'px;
    font-size: ' . $dp_blog_roll_excerpt_font_size / 10 . 'rem;
    font-weight: ' . $dp_blog_roll_excerpt_font_weight . ';
    color: ' . $dp_blog_roll_excerpt_font_color . '; 
    
    padding-top: ' . $dp_blog_roll_excerpt_padding_top . 'px;
    padding-right: ' . $dp_blog_roll_excerpt_padding_right . 'px;
    padding-bottom: ' . $dp_blog_roll_excerpt_padding_bottom . 'px;
    padding-left: ' . $dp_blog_roll_excerpt_padding_left . 'px;
    
    margin-top: ' . $dp_blog_roll_excerpt_margin_top . 'px;
    margin-right: ' . $dp_blog_roll_excerpt_margin_right . 'px;
    margin-bottom: ' . $dp_blog_roll_excerpt_margin_bottom . 'px;
    margin-left: ' . $dp_blog_roll_excerpt_margin_left . 'px;
    
    overflow: hidden;
    position: relative;
}

.dp-blog-roll-loop-excerpt {
    height: ' . $dp_blog_roll_excerpt_height . ';
    overflow: hidden;
    
}

.dp-blog-roll-loop-excerpt-wrap a {
    color: ' . $dp_blog_roll_excerpt_link_color . ';
    text-decoration: none;
}

.dp-blog-roll-loop-excerpt-wrap a:hover {
    color: ' . $dp_blog_roll_excerpt_font_color . ';
    text-decoration: none;
}


.dp-blog-roll-loop-meta {
    text-align: ' . $dp_blog_roll_meta_text_align . ';
    float: ' . $dp_blog_roll_meta_float . ';
	background: ' . $dp_blog_roll_meta_color . ';
    display: ' . $dp_blog_roll_meta_display . ';
    width: ' . $dp_blog_roll_meta_width . ';
    
    font-size: ' . $dp_blog_roll_meta_font_size . 'px;
    font-size: ' . $dp_blog_roll_meta_font_size / 10 . 'rem;
    font-weight: ' . $dp_blog_roll_meta_font_weight . ';
    color: ' . $dp_blog_roll_meta_font_color . ';
    padding-top: ' . $dp_blog_roll_meta_padding_top . 'px;
    padding-right: ' . $dp_blog_roll_meta_padding_right . 'px;
    padding-bottom: ' . $dp_blog_roll_meta_padding_bottom . 'px;
    padding-left: ' . $dp_blog_roll_meta_padding_left . 'px;
    
    margin-top: ' . $dp_blog_roll_meta_margin_top . 'px;
    margin-right: ' . $dp_blog_roll_meta_margin_right . 'px;
    margin-bottom: ' . $dp_blog_roll_meta_margin_bottom . 'px;
    margin-left: ' . $dp_blog_roll_meta_margin_left . 'px;
    
    z-index: 11;
}

.dp-blog-roll-loop-meta a {
    color: ' . $dp_blog_roll_meta_link_color . ';
}

.dp-blog-roll-loop-meta a:hover {
    color: ' . $dp_blog_roll_meta_font_color . ';
}

.dp-blog-roll-loop-meta .entry-time {
    ' . $dp_blog_roll_meta_show_date . '
}

.dp-blog-roll-loop-meta .byline {
    ' . $dp_blog_roll_meta_show_author . '
}

.dp-blog-roll-loop-meta .entry-comments-link {
    ' . $dp_blog_roll_meta_show_comment_count . '
}


.dp-blog-roll-loop-categories {
    font-size: ' . $dp_blog_roll_category_font_size . 'px;
	font-size: ' . $dp_blog_roll_category_font_size / 10 . 'rem;
	font-weight: ' . $dp_blog_roll_category_font_weight . ';
	color: ' . $dp_blog_roll_category_font_color . ';
	text-align: ' . $dp_blog_roll_category_text_align . ';
	float: ' . $dp_blog_roll_category_float . ';
    display: ' . $dp_blog_roll_category_display . ';
    width: ' . $dp_blog_roll_category_width . ';
	margin-top: ' . $dp_blog_roll_category_margin_top . 'px;
	margin-bottom: ' . $dp_blog_roll_category_margin_bottom . 'px;
	
	
}
.dp-blog-roll-loop-categories a {
    background: ' . $dp_blog_roll_category_color . ';
    
    padding-top: ' . $dp_blog_roll_category_padding_top . 'px;
	padding-right: ' . $dp_blog_roll_category_padding_right . 'px;
	padding-bottom: ' . $dp_blog_roll_category_padding_bottom . 'px;
	padding-left: ' . $dp_blog_roll_category_padding_left . 'px;
	
	
	margin-right: ' . $dp_blog_roll_category_margin_right . 'px;
	
	margin-left: ' . $dp_blog_roll_category_margin_left . 'px;
	
	' . $dp_blog_roll_category_border_radius . '
	
}

.dp-blog-roll-loop-categories a,
.dp-blog-roll-loop-categories a:hover {
    color: ' . $dp_blog_roll_category_font_color . ';
    text-decoration: none;
}

.dp-blog-roll-loop-featured-image .dp-blog-roll-loop-categories {
    position: absolute;
    ' . $dp_blog_roll_category_location_inside_image_horizontal . '
    ' . $dp_blog_roll_category_location_inside_image_vertical . '
    line-height: 1;
    z-index: 10;
}


/* ## Column Widths and Positions
--------------------------------------------- */

/* ### Container for fullheight sidebar */

.content-sidebar1fullheight .sidebarfullheight-container {
	float: left;
	width: calc(100% - 360px);
}

.sidebar1fullheight-content .sidebarfullheight-container {
	float: right;
	width: calc(100% - 360px);
}

.content-sidebar2-sidebar1fullheight .sidebarfullheight-container {
	float: left;
	width: calc(100% - 360px);
}

.sidebar1fullheight-content-sidebar2 .sidebarfullheight-container {
	float: right;
	width: calc(100% - 360px);
}

.sidebar2-content-sidebar1fullheight .sidebarfullheight-container {
	float: left;
	width: calc(100% - 360px);
}

.sidebar1fullheight-sidebar2-content .sidebarfullheight-container {
	float: right;
	width: calc(100% - 360px);
}



/* ### Wrapping div for .content and .sidebar-primary */

.content-sidebar1-sidebar2 .content-sidebar1-wrap {
	float: left;
	max-width: 100%;
	margin-right: 200px;
	width: calc(100% - 200px);
}

.content-sidebar2-sidebar1 .content-sidebar2-wrap {
	float: left;
	max-width: 100%;
	margin-right: 380px;
	width: calc(100% - 380px);
}

.sidebar1-content-sidebar2 .sidebar1-content-wrap {
	float: left;
	max-width: 100%;
	margin-right: 200px;
	width: calc(100% - 200px);
}

.sidebar2-content-sidebar1 .content-sidebar1-wrap {
	float: right;
	max-width: 100%;
	margin-left: 200px;
	width: calc(100% - 200px);
}

.sidebar1-sidebar2-content .sidebar2-content-wrap {
	float: right;
	max-width: 100%;
	margin-left: 380px;
	width: calc(100% - 380px);
}

.sidebar2-sidebar1-content .sidebar1-content-wrap {
	float: right;
	max-width: 100%;
	margin-left: 200px;
	width: calc(100% - 200px);
}

/* ### Content */

.content {
	float: left;
/* 	width: calc(100% - 380px); */
	max-width: 100%;
}

.page .content,
.single .content {
	padding-top: ' . $dp_page_padding_top . 'px;
	padding-right: ' . $dp_page_padding_right . 'px;
	padding-bottom: ' . $dp_page_padding_bottom . 'px;
	padding-left: ' . $dp_page_padding_left . 'px;
	
	margin-top: ' . $dp_page_margin_top . 'px;
	margin-right: ' . $dp_page_margin_right . 'px;
	margin-bottom: ' . $dp_page_margin_bottom . 'px;
	margin-left: ' . $dp_page_margin_left . 'px;
	
	' . $dp_page_shadow . ';
	' . $page_border_style . ';
	' . $dp_page_bg . '
	' . $dp_page_border_radius . '
}

.archive .content,
.blog .content {

}

.archive .content a,
.blog .content a {
    
}

.archive .content a:hover,
.blog .content a:hover {
    
}

.post-featured-image {
    position: relative;
    width: auto;
    overflow: hidden;
    max-height: ' . $dp_page_featured_image_max_height . 'px;
    line-height: 0;
    
    padding-top: ' . $dp_page_featured_image_padding_top . 'px;
	padding-right: ' . $dp_page_featured_image_padding_right . 'px;
	padding-bottom: ' . $dp_page_featured_image_padding_bottom . 'px;
	padding-left: ' . $dp_page_featured_image_padding_left . 'px;
	
	margin-top: ' . $dp_page_featured_image_margin_top . 'px;
	margin-right: ' . $dp_page_featured_image_margin_right . 'px;
	margin-bottom: ' . $dp_page_featured_image_margin_bottom . 'px;
	margin-left: ' . $dp_page_featured_image_margin_left . 'px;
	
	' . $dp_page_featured_image_shadow . ';
	' . $page_featured_image_border_style . ';
	' . $dp_page_featured_image_bg . '
	' . $dp_page_featured_image_border_radius . '
    
}
.post-featured-image div {
    line-height: initial;
}

.post-featured-image img {
    width: 100%;
    background-size: contain !important;
    background-position: top !important;
}

.post-featured-image .entry-header-wrap {
    position: absolute;
    ' . $dp_page_header_location_inside_image_vertical . '
    width: 100%;
    text-align: ' . $dp_page_header_location_inside_image_horizontal . ';

}

.entry-content-featured-image {
	float: left;
	width: 300px;
	margin-right: 15px;
    margin-top: 10px;
}

.full-width-content .content {
	width: 100%;
}

.content-sidebar1 .content {
	float: left;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-right: ' . $dp_content_width . 'px;
}

.sidebar1-content .content {
	float: right;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-left: ' . $dp_content_width . 'px;
}

.content-sidebar1-sidebar2 .content {
	float: left;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-right: ' . $dp_content_width . 'px;
}

.content-sidebar2-sidebar1 .content {
	float: left;
	width: calc(100% - 200px); 
	max-width: 100%;
	margin-right: 200px;
}

.sidebar1-content-sidebar2 .content {
	float: right;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-left: ' . $dp_content_width . 'px;
}

.sidebar2-content-sidebar1 .content {
	float: left;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-right: ' . $dp_content_width . 'px;
}

.sidebar1-sidebar2-content .content {
	float: right;
	width: calc(100% - 200px);
	max-width: 100%;
	margin-left: 200px;
}

.sidebar2-sidebar1-content .content {
	float: right;
	width: calc(100% - ' . $dp_content_width . 'px);
	max-width: 100%;
	margin-left: ' . $dp_content_width . 'px;
}

.content-sidebar2-sidebar1fullheight .content {
	float: left;
	width: calc(100% - 200px); 
	max-width: 100%;
	margin-right: 200px;
}

.sidebar1fullheight-content-sidebar2 .content {
	float: left;
	width: calc(100% - 200px); 
	max-width: 100%;
	margin-right: 200px;
}

.sidebar2-content-sidebar1fullheight .content {
	float: right;
	width: calc(100% - 200px); 
	max-width: 100%;
	margin-left: 200px;
}

.sidebar1fullheight-sidebar2-content .content {
	float: right;
	width: calc(100% - 200px); 
	max-width: 100%;
	margin-left: 200px;
}


/* ### Primary Sidebar */

.sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
	padding: ' . $dp_primary_sidebar_padding . 'px;
	margin-top: ' . $dp_primary_sidebar_margin_top . 'px;
	' . $dp_primary_sidebar_bg . '
	' . $dp_primary_sidebar_border . '
	' . $dp_primary_sidebar_border_radius . '
	' . $dp_primary_sidebar_shadow . '
}

.sidebar-primary .widget {
	overflow: hidden;
	font-size: ' . $dp_primary_sidebar_widgets_font_size . 'px;
	font-weight: ' . $dp_primary_sidebar_widgets_font_weight . ';
	font-family: ' . $dp_primary_sidebar_widgets_font_family . ';
	color: ' . $dp_primary_sidebar_widgets_font_color . ';
	padding: ' . $dp_primary_sidebar_widgets_padding_top . 'px ' . $dp_primary_sidebar_widgets_padding_leftright . 'px ' . $dp_primary_sidebar_widgets_padding_bottom . 'px ' . $dp_primary_sidebar_widgets_padding_leftright . 'px;
	margin-top: ' . $dp_primary_sidebar_widgets_margin_top . 'px;
	margin-bottom: ' . $dp_primary_sidebar_widgets_margin_bottom . 'px;
	' . $dp_primary_sidebar_widgets_bg . '
	' . $dp_primary_sidebar_widgets_border . '
	' . $dp_primary_sidebar_widgets_border_radius . '
	' . $dp_primary_sidebar_widgets_shadow . '
}

.sidebar-primary .dp-ad-widget,
.sidebar-primary .dp-custom-widget {
    text-align: center;
    line-height: 1;
    margin-top: ' . $dp_primary_sidebar_widgets_margin_top . 'px;
	margin-bottom: ' . $dp_primary_sidebar_widgets_margin_bottom . 'px;
}

.sidebar-primary .widget a {
	color: ' . $dp_primary_sidebar_widgets_link_color . ';
	text-decoration: ' . $dp_primary_sidebar_widgets_link_underline . ';
}

.sidebar-primary .widget a:hover {
	color: ' . $dp_primary_sidebar_widgets_link_color_hover . ';
	text-decoration: ' . $dp_primary_sidebar_widgets_link_hover_underline . ';
}

.sidebar-primary .widget-title {
	font-size: ' . $dp_primary_sidebar_widgets_title_font_size . 'px;
	font-weight: ' . $dp_primary_sidebar_widgets_title_font_weight . ';
	/*font-family: ' . $dp_primary_sidebar_widgets_title_font_family . ';*/
	color: ' . $dp_primary_sidebar_widgets_title_font_color . ';
	
	margin-top: ' . $dp_primary_sidebar_widgets_title_margin_top . 'px;
	margin-bottom: ' . $dp_primary_sidebar_widgets_title_margin_bottom . 'px;
	margin-left: ' . $dp_primary_sidebar_widgets_title_width . 'px;
	margin-right: ' . $dp_primary_sidebar_widgets_title_width . 'px;
	background: ' . $dp_primary_sidebar_widgets_title_container_background . ';
	' . $dp_primary_sidebar_widgets_title_border . '
	
	' . $dp_primary_sidebar_widgets_title_shadow . '
}
.sidebar-primary .widget-title span {
	display: ' . $dp_primary_sidebar_widgets_title_content_width . ';
	padding: ' . $dp_primary_sidebar_widgets_title_padding . 'px;
	' . $dp_primary_sidebar_widgets_title_bg . '
	' . $dp_primary_sidebar_widgets_title_border_radius . '
}

.content-sidebar1 .sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-left: -' . $dp_primary_sidebar_width . 'px;
}

.sidebar1-content .sidebar-primary {
	float: left;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-right: -' . $dp_primary_sidebar_width . 'px;
}

.content-sidebar1-sidebar2 .sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-left: -' . $dp_primary_sidebar_width . 'px;
}

.content-sidebar2-sidebar1 .sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-left: -' . $dp_primary_sidebar_width . 'px;
}

.sidebar1-content-sidebar2 .sidebar-primary {
	float: left;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-right: -' . $dp_primary_sidebar_width . 'px;
}

.sidebar2-content-sidebar1 .sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-left: -' . $dp_primary_sidebar_width . 'px;
}

.sidebar1-sidebar2-content .sidebar-primary {
	float: left;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-right: -' . $dp_primary_sidebar_width . 'px;
}

.sidebar2-sidebar1-content .sidebar-primary {
	float: left;
	width: ' . $dp_primary_sidebar_width . 'px;
	margin-right: -' . $dp_primary_sidebar_width . 'px;
}

.content-sidebar1fullheight .sidebar-primary {
	float: right;
	width: ' . $dp_primary_sidebar_width . 'px;
}

.sidebar1fullheight-content .sidebar-primary {
	float: left;
	width: ' . $dp_primary_sidebar_width . 'px;
}

/* ### Secondary Sidebar */

.sidebar-secondary {
	float: left;
	width: 180px;
}

.content-sidebar1-sidebar2 .sidebar-secondary {
	float: right;
	margin-left: -200px;
}

.content-sidebar2-sidebar1 .sidebar-secondary {
	float: right;
	margin-left: -200px;
}

.sidebar1-content-sidebar2 .sidebar-secondary {
	float: right;
	margin-left: -200px;
}

.sidebar2-content-sidebar1 .sidebar-secondary {
	float: left;
	margin-right: -200px;
}

.sidebar1-sidebar2-content .sidebar-secondary {
	float: left;
	margin-right: -200px;
}

.sidebar2-sidebar1-content .sidebar-secondary {
	float: left;
	margin-right: -200px;
}

.content-sidebar2-sidebar1fullheight .sidebar-secondary {
	float: right;
	margin-left: -200px;
}

.sidebar1fullheight-content-sidebar2 .sidebar-secondary {
	float: right;
	margin-left: -200px;
}

.sidebar2-content-sidebar1fullheight .sidebar-secondary {
	float: left;
	margin-right: -200px;
}

.sidebar1fullheight-sidebar2-content .sidebar-secondary {
	float: left;
	margin-right: -200px;
}

/* # Common Classes
---------------------------------------------------------------------------------------------------- */

/* ## Avatar
--------------------------------------------- */

.avatar {
	float: left;
}

.alignleft .avatar,
.author-box .avatar {
	margin-right: 24px;
}

.alignright .avatar {
	margin-left: 24px;
}

.comment .avatar {
	margin: 0 16px 24px 0;
}

/* ## Genesis
--------------------------------------------- */

.breadcrumb {
	margin-bottom: 40px;
}

.archive-description,
.author-box {
	margin-bottom: 60px;
}

.archive-description p:last-child,
.author-box p:last-child {
	margin-bottom: 0;
}

/* ## Search Form
--------------------------------------------- */

.search-form {
	overflow: hidden;
}

.site-header .search-form {
	float: right;
	margin-top: 12px;
}

.entry-content .search-form,
.site-header .search-form {
	width: 50%;
}

.genesis-nav-menu .search input[type="submit"],
.widget_search input[type="submit"] {
	border: 0;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	margin: -1px;
	padding: 0;
	position: absolute;
	width: 1px;
}

/* ## Titles
--------------------------------------------- */


.archive-title {
    font-size: ' . $dp_archive_title_font_size . 'px;
	font-size: ' . $dp_archive_title_font_size / 10 . 'rem;
	font-weight: ' . $dp_archive_title_font_weight . ';
	color: ' . $dp_archive_title_font_color . ';
	padding-top: ' . $dp_archive_title_padding_top . 'px;
	padding-right: ' . $dp_archive_title_padding_right . 'px;
	padding-bottom: ' . $dp_archive_title_padding_bottom . 'px;
	padding-left: ' . $dp_archive_title_padding_left . 'px;
	
	margin-top: ' . $dp_archive_title_margin_top . 'px;
	margin-right: ' . $dp_archive_title_margin_right . 'px;
	margin-bottom: ' . $dp_archive_title_margin_bottom . 'px;
	margin-left: ' . $dp_archive_title_margin_left . 'px;
	
	' . $dp_archive_title_shadow . ';
	' . $archive_title_border_style . ';
	' . $dp_archive_title_bg . '
	' . $dp_archive_title_border_radius . '
}

.entry-title {
	font-size: ' . $dp_typography_h1_font_size . 'px;
	font-size: ' . $dp_typography_h1_font_size / 10 . 'rem;
}

.single .entry-title,
.page .entry-title {
    font-size: ' . $dp_page_header_font_size . 'px;
	font-size: ' . $dp_page_header_font_size / 10 . 'rem;
	font-weight: ' . $dp_page_header_font_weight . ';
	color: ' . $dp_page_header_font_color . ';
	text-align: ' . $dp_page_header_text_align . ';
}

.single .entry-header,
.page .entry-header {
    display: inline-block;
    width: ' . $dp_page_header_width . ';
	padding-top: ' . $dp_page_header_padding_top . 'px;
	padding-right: ' . $dp_page_header_padding_right . 'px;
	padding-bottom: ' . $dp_page_header_padding_bottom . 'px;
	padding-left: ' . $dp_page_header_padding_left . 'px;
	
	margin-top: ' . $dp_page_header_margin_top . 'px;
	margin-right: ' . $dp_page_header_margin_right . 'px;
	margin-bottom: ' . $dp_page_header_margin_bottom . 'px;
	margin-left: ' . $dp_page_header_margin_left . 'px;
	
	' . $dp_page_header_shadow . ';
	' . $page_header_border_style . ';
	' . $dp_page_header_bg . '
	' . $dp_page_header_border_radius . '
}

.entry-title a,
.sidebar .widget-title a {
	color: #333;
}

.entry-title a:hover,
.entry-title a:focus {
	color: #c3251d;
}

.post-featured-image .entry-categories-wrap {
    position: ' . $dp_page_category_wrap_position . ';
    ' . $dp_page_category_location_inside_image_vertical . '
    width: 100%;
    text-align: ' . $dp_page_category_location_inside_image_horizontal . ';
}

.entry-categories-wrap .entry-categories {
    font-size: ' . $dp_page_category_font_size . 'px;
	font-size: ' . $dp_page_category_font_size / 10 . 'rem;
	font-weight: ' . $dp_page_category_font_weight . ';
	color: ' . $dp_page_category_font_color . ';
	text-align: ' . $dp_page_category_text_align . ';
	
    display: inline-block;
    width: ' . $dp_page_category_width . ';
	padding-top: ' . $dp_page_category_padding_top . 'px;
	padding-right: ' . $dp_page_category_padding_right . 'px;
	padding-bottom: ' . $dp_page_category_padding_bottom . 'px;
	padding-left: ' . $dp_page_category_padding_left . 'px;
	
	margin-top: ' . $dp_page_category_margin_top . 'px;
	margin-right: ' . $dp_page_category_margin_right . 'px;
	margin-bottom: ' . $dp_page_category_margin_bottom . 'px;
	margin-left: ' . $dp_page_category_margin_left . 'px;
	
	' . $dp_page_category_shadow . ';
	' . $page_category_border_style . ';
	' . $dp_page_category_bg . '
	' . $dp_page_category_border_radius . '
}

.entry-categories-wrap a {
    color: ' . $dp_page_category_font_color . ';
    text-decoration: none;
}
.widget-title {
	margin-bottom: 20px;
}

/* ## WordPress
--------------------------------------------- */

a.aligncenter img {
	display: block;
	margin: 0 auto;
}

a.alignnone {
	display: inline-block;
}

.alignleft {
	float: left;
	text-align: left;
}

.alignright {
	float: right;
	text-align: right;
}

a.alignleft,
a.alignnone,
a.alignright {
	max-width: 100%;
}

img.centered,
.aligncenter {
	display: block;
	margin: 0 auto 24px;
}

img.alignnone,
.alignnone {
	margin-bottom: 12px;
}

a.alignleft,
img.alignleft,
.wp-caption.alignleft {
	margin: 10px 25px 10px 0;
}

a.alignright,
img.alignright,
.wp-caption.alignright {
	margin: 10px 0 10px 25px;
}

.wp-caption-text {
	font-size: 14px;
	font-size: 1.4rem;
	font-weight: 700;
	text-align: center;
}

.entry-content p.wp-caption-text {
	margin-bottom: 0;
}

.entry-content .wp-audio-shortcode,
.entry-content .wp-playlist,
.entry-content .wp-video {
	margin: 0 0 28px;
}


/* # Widgets
---------------------------------------------------------------------------------------------------- */

.widget {
	word-wrap: break-word;
}

.widget ol > li {
	list-style-position: inside;
	list-style-type: decimal;
	padding-left: 20px;
	text-indent: -20px;
}

.widget li li {
	border: 0;
	margin: 0 0 0 30px;
	padding: 0;
}

.widget_calendar table {
	width: 100%;
}

.widget_calendar td,
.widget_calendar th {
	text-align: center;
}

/* ## Featured Content
--------------------------------------------- */

.featured-content .entry {
	margin-bottom: 40px;
}

.featured-content .entry:last-child {
	margin-bottom: 0;
}

.featured-content .entry-title {
	font-size: 20px;
	font-size: 2rem;
}


/* # Plugins
---------------------------------------------------------------------------------------------------- */

/* ## Genesis eNews Extended
--------------------------------------------- */

.enews-widget input {
	font-size: 16px;
	font-size: 1.6rem;
	margin-bottom: 16px;
}

.enews-widget input[type="submit"] {
	margin: 0;
	width: 100%;
}

.enews form + p {
	margin-top: 24px;
}

/* ## Jetpack
--------------------------------------------- */

#wpstats {
	display: none;
}


/* # Skip Links
---------------------------------------------------------------------------------------------------- */

.genesis-skip-link {
	margin: 0;
}

.genesis-skip-link li {
	height: 0;
	width: 0;
	list-style: none;
}

/* Display outline on focus */
:focus {
	color: #333;
	outline: #ccc solid 1px;
}


/* # Site Header
---------------------------------------------------------------------------------------------------- */

.site-header {
	min-height: ' . $dp_header_height . 'px;
	' . $dp_header_bg . '
	padding: ' . $dp_header_padding_top . 'px ' . $dp_header_padding_right . 'px ' . $dp_header_padding_bottom . 'px ' . $dp_header_padding_left . 'px;
	margin-top: ' . $dp_header_margin_top . 'px;
	margin-bottom: ' . $dp_header_margin_bottom . 'px;
	margin-left: auto;
	margin-right: auto;
	' . $header_border_style . '
	' . $dp_header_border_radius . '
	max-width: ' . $dp_header_max_width . ';
}

.site-header .wrap {
	
}

/* ## Title Area
--------------------------------------------- */

.header-full-width .title-area {
	width: 100%;
}

.site-header .title-area {
	float: left;
	padding: 0;
	width: ' . $dp_header_logo_title_area_width . 'px;
	display: ' . $dp_header_logo_toggle . ';
	white-space: nowrap;
	height: ' . $dp_header_height . 'px;
}

.site-header .site-title {
	font-family: ' . $dp_header_logo_title_font_family . ';
	font-size: ' . $dp_header_logo_title_font_size . 'px;
	font-size: ' . $dp_header_logo_title_font_size / 10 . 'rem;
	font-weight: ' . $dp_header_logo_title_font_weight . ';
	color: ' . $dp_header_logo_title_color . ';
	display: block;
	vertical-align: middle;
	line-height:1;
	margin-bottom: ' . $dp_header_logo_title_margin_bottom . 'px;
	text-transform: ' . $dp_header_logo_title_uppercase . ';
}

.site-header .site-title a,
.site-header .site-title a:hover,
.site-header .site-title a:focus {
	color: ' . $dp_header_logo_title_color . ';
	text-decoration:none;
	padding: 0;
}

.site-header .title-logo {
	display: ' . $dp_header_logo_display . ';
	margin-right: ' . $dp_header_logo_margin_right . 'px;
  height:100%;
	white-space: nowrap;
	vertical-align: middle;
	width: ' . $dp_header_logo_width . 'px;
}

.site-header .title-logo-img {
	' . $dp_header_logo_upload . '
	background-repeat:no-repeat;
	background-size:contain;
	background-position:left;
	height:100%;
	width:100%;
}

.site-header .site-title-wrap {
    display: table-cell;
    text-align: left;
    vertical-align: middle;
}

.site-header .site-description {
	font-family: ' . $dp_header_logo_tagline_font_family . ';
	font-size: ' . $dp_header_logo_tagline_font_size . 'px;
	font-size: ' . $dp_header_logo_tagline_font_size / 10 . 'rem;
	font-weight: ' . $dp_header_logo_tagline_font_weight . ';
	color: ' . $dp_header_logo_tagline_color . ';
	line-height: 1;
  display: block;
  vertical-align: bottom;
	text-transform: ' . $dp_header_logo_tagline_uppercase . ';
}

.site-header .header-image .site-description,
.site-header .header-image .site-title a {
	overflow: hidden;
	text-indent: 100%;
	white-space: nowrap;
}


.dp-font-style-1 {
  text-shadow: 3px 3px 0px rgba(0,0,0,0.2);
}

.dp-font-style-2 {
  text-shadow: 4px 3px 0px #fff, 5px 4px 0px rgba(0,0,0,0.15);
}

.dp-font-style-3 {
   text-shadow: 0 1px 0 #fff,
               0 2px 0 #fff,
               0 3px 0 #fff,
               0 4px 0 #aaa,
               0 5px 0 #bbb,
               0 6px 1px rgba(0,0,0,.1),
               0 0 5px rgba(0,0,0,.1),
               0 1px 3px rgba(0,0,0,.3),
               0 3px 5px rgba(0,0,0,.2),
               0 5px 10px rgba(0,0,0,.0),
               0 10px 10px rgba(0,0,0,.0),
               0 20px 20px rgba(0,0,0,.0);
}

.dp-font-style-4 {
     text-shadow: 0px 4px 3px rgba(0,0,0,0.4),
             0px 8px 13px rgba(0,0,0,0.1),
             0px 18px 23px rgba(0,0,0,0.1);
}

.dp-font-style-5 {
    text-shadow: 3px 3px 0px #2c2e38, 5px 5px 0px #5c5f72;
}

.dp-font-style-6 {
   background-color: #5a5a5a;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;
}

.dp-font-style-7 {
   /*color: rgba(0,0,0,0.6);*/
text-shadow: 2px 8px 6px rgba(0,0,0,0.2),
                 0px 1px 15px rgba(255,255,255,0.3);
}

.dp-font-style-8 {
    text-shadow: -1px -1px 0px rgba(255,255,255,0.1), 2px 2px 0px rgba(0,0,0,0.8);
}

.dp-font-style-9 {
    	text-shadow: 0px 1px 0px #FFF, 0px 2px 0px #FFF, 0px 3px 0px #EEE, 0px 4px 0px #DDD, 0px 5px 0px #DDD, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 7px #001135;
}



/* ## Widget Area
--------------------------------------------- */

.site-header .widget-area {
	float: right;
	text-align: right;
	display: table;
	height: ' . $dp_header_height . 'px;
}
.site-header .widget-area > div {
    vertical-align: middle;
    display: table-cell;
}

/* # Pagination Navigation
--------------------------------------------- */
.dp-pagination {
    text-align: ' . $dp_pagination_text_align . ';
    font-size: ' . $dp_pagination_font_size . 'px;
    font-size: ' . $dp_pagination_font_size / 10 . 'rem;
    font-weight: ' . $dp_pagination_font_weight . ';
    line-height: 3;
    clear: both;
    margin-top: ' . $dp_pagination_margin_top . 'px;
	margin-bottom: ' . $dp_pagination_margin_bottom . 'px;
}

.dp-pagination li {
	display: inline;
	
	margin-left: ' . $dp_pagination_margin_left . 'px;
	margin-right: ' . $dp_pagination_margin_right . 'px;
	
}

.dp-pagination li a {
    color: ' . $dp_pagination_font_color . ';
	text-decoration:none;
	background: ' . $dp_pagination_color . ';
	
	padding-top: ' . $dp_pagination_padding_top . 'px;
	padding-right: ' . $dp_pagination_padding_right . 'px;
	padding-bottom: ' . $dp_pagination_padding_bottom . 'px;
	padding-left: ' . $dp_pagination_padding_left . 'px;
	
	' . $dp_pagination_border . '
	' . $dp_pagination_border_radius . '
}

.dp-pagination li a:hover,
.dp-pagination li.active a {
    color: ' . $dp_pagination_font_color_active . ';
    background: ' . $dp_pagination_color_active . ';
}



.dp-pagination li a,
.dp-pagination li a:hover,
.dp-pagination li.active a,
.dp-pagination li.disabled {
	cursor: pointer;
}



/*---------------------------------------------------------------------------------------------------- */
/* # Site Navigation
/* # Primary Menu
---------------------------------------------------------------------------------------------------- */

.nav-primary {
	overflow: hidden;
	line-height: 0;
	'. $dp_primary_menu_bg .'
	margin-top: ' . $dp_primary_menu_margin_top . 'px;
	margin-bottom: ' . $dp_primary_menu_margin_bottom . 'px;
	margin-left: auto;
	margin-right: auto;
	width: 100%;
	max-width: ' . $dp_primary_menu_max_width . ';
	' . $primary_menu_border_style . '
	' . $dp_primary_menu_border_radius . '
	font-family: ' . $dp_primary_menu_font_family . ';
	' . $dp_primary_menu_shadow . '
	height:' . $dp_primary_menu_height . 'px;
	transition: width 0.6s, max-width 0.6s, height 0.6s;
	display: table; /* fixed jittering on sticky transition */
	box-sizing: content-box;
}

.nav-primary .wrap {
	padding-left: ' . $dp_primary_menu_wrap_padding . ';
	padding-right: ' . $dp_primary_menu_wrap_padding . ';
}

.nav-primary .disruptpress-nav-menu {
	text-align: ' . $dp_primary_menu_item_alignment_textalign . ';
	clear: both;
	width: 100%;
	font-size: 0;
	display: ' . $dp_primary_menu_item_alignment_display . ';
	justify-content: ' . $dp_primary_menu_item_alignment_justifycontent . ';
	height:' . $dp_primary_menu_height . 'px;
}

.nav-primary .disruptpress-nav-menu > li {
	font-size: ' . $dp_primary_menu_font_size . 'px;
	font-size: ' . $dp_primary_menu_font_size / 10 . 'rem;
	font-weight: ' . $dp_primary_menu_font_weight . ';
	display: inline-block;
	list-style-type: none;
	line-height: ' . $dp_primary_menu_font_size . 'px;
  vertical-align:middle;
	box-shadow: '. $dp_primary_menu_item_dividers_boxshadow . ';
	border-top: ' . $dp_primary_menu_item_dividers_bordertop . ';
	border-bottom: ' . $dp_primary_menu_item_dividers_borderbottom . ';
	/*width: ' . $dp_primary_menu_item_alignment_width . ';*/
	/*width: 100%;
	display: table-cell;*/
  white-space: nowrap;
	text-transform: ' . $dp_primary_menu_home_font_uppercase . ';
}

.nav-primary .disruptpress-nav-menu > li:first-child {
	box-shadow: ' . $dp_primary_menu_item_dividers_boxshadow_firstchild . ';
}

.nav-primary .disruptpress-nav-menu > li' . $dp_primary_menu_item_dividers_boxshadow_lastchild_position . ' {
	box-shadow: ' . $dp_primary_menu_item_dividers_boxshadow_lastchild . ';
}

.dp-nav-primary-home-icon .dashicons {
	font-size: ' . ( $dp_primary_menu_font_size + 8 ) . 'px;
	width: ' . ( $dp_primary_menu_font_size + 8 ) . 'px;
	height: ' . ( $dp_primary_menu_font_size + 8 ) . 'px;
	text-decoration: none;
}

.nav-primary .disruptpress-nav-menu > li > a {
	height:' . $dp_primary_menu_height . 'px;
	color: ' . $dp_primary_menu_link_color . ';
	text-decoration: ' . $dp_primary_menu_link_text_decoration . ';
/*	display: inline-block;*/
	padding-left: ' . $dp_primary_menu_item_padding_left_right . 'px;
	padding-right: ' . $dp_primary_menu_item_padding_left_right . 'px;
	width: ' . $dp_primary_menu_item_alignment_width . ';
	display: table-cell;
	vertical-align: middle;
}

.nav-primary .disruptpress-nav-menu > li.dp-nav-primary-home-icon > a {
	padding-left: ' . $dp_primary_menu_home_icon_padding . 'px;
	padding-right: ' . $dp_primary_menu_home_icon_padding . 'px;
}


.dp-search-nav-primary {
	/*padding-left: ' . $dp_primary_menu_item_padding_left_right . 'px;
	padding-right: ' . $dp_primary_menu_item_padding_right_search_box . ';*/
}

.nav-primary .disruptpress-nav-menu > .menu-item > a:hover,
.nav-primary .disruptpress-nav-menu > .menu-item > a:focus,
.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) > a {
	color: ' . $dp_primary_menu_link_color_active . ';
	text-decoration: ' . $dp_primary_menu_link_text_decoration . ';
}

.nav-primary .disruptpress-nav-menu > .menu-item:hover,
.nav-primary .disruptpress-nav-menu > .menu-item:focus,
.nav-primary .disruptpress-nav-menu > .current-menu-item:not(.menu-item-home) {
	'. $dp_primary_menu_bg_active_boxshadow .'
	' . $dp_primary_menu_bg_active . '
}


.nav-primary .menu-item-home > a {	
	/*font-size: ' . $dp_primary_menu_item_home_font_size . ';*/
}

.nav-primary .disruptpress-nav-menu > .menu-item-has-children > a:after {
	font-family: "dashicons";
	content: " \f140";
	font-size: ' . $dp_primary_menu_item_submenu_icon_font_size . 'px;
	line-height: inherit;
	vertical-align: top;
	display: ' . $dp_primary_menu_submenu_indicator_display . ';
	text-decoration: none;
}

.nav-primary .disruptpress-nav-menu > .menu-item-home > a:after {
	/*font-family: "dashicons";
	content: " \f102";
	font-size: ' . $dp_primary_menu_item_home_icon_font_size . 'px;
	line-height: inherit;
	vertical-align: middle;
	display: ' . $dp_primary_menu_item_home_after_display . ';
	text-decoration: none;*/
}

.nav-primary .disruptpress-nav-menu > .menu-item-home.menu-item-has-children > a:after {
	/*font-family: "dashicons";
	content: "' . $dp_primary_menu_item_home_and_submenu_after_content . '";
	font-size: ' . $dp_primary_menu_item_home_and_submenu_after_fontsize . ';
	line-height: inherit;
	vertical-align: ' . $dp_primary_menu_item_home_and_submenu_after_verticalalign . ';
	display: ' . $dp_primary_menu_item_home_and_submenu_after_display . ';
	text-decoration: none;*/
}

.dp-nav-primary-home-button-icon {
	float: none;
}

.dp-nav-primary-home-button-logo {
	float: left;
}

.nav-primary .sub-menu a {
	color: #000;
	background: #FFF;
}

.nav-primary .sub-menu a:hover,
.nav-primary .sub-menu a:focus,
.nav-primary .sub-menu .current-menu-item > a,
.nav-primary .sub-menu .current-menu-item > a:hover,
.nav-primary .sub-menu .current-menu-item > a:focus {
	color: #000;
	background: #FFF;
}

.nav-primary .sub-menu {
	border-top: 1px solid #eee;
	left: -9999px;
	opacity: 0;
	position: absolute;
	-webkit-transition: opacity .4s ease-in-out;
	-moz-transition:    opacity .4s ease-in-out;
	-ms-transition:     opacity .4s ease-in-out;
	-o-transition:      opacity .4s ease-in-out;
	transition:         opacity .4s ease-in-out;
	/*width: 210px;*/
	z-index: 99999;
	text-align: left;
}

.disruptpress-nav-menu .sub-menu a {
	background-color: #fff;
	border: 1px solid #eee;
	border-top: 0;
	font-size: 14px;
	font-size: 1.4rem;
	padding: 20px;
	position: relative;
	width: 210px;
	word-wrap: break-word;
	display: block;
	line-height: normal;
	text-decoration: ' . $dp_primary_menu_link_text_decoration . ';
}

.nav-primary .sub-menu > .menu-item-has-children > a:after {
	font-family: "dashicons";
	content: " \f139";
	font-size: 20px;
	height: 3px;
	width: 20px;
	line-height: 0;
	vertical-align: middle;
	display: ' . $dp_primary_menu_submenu_indicator_display . ';
}

.disruptpress-nav-menu .sub-menu .sub-menu {
	margin: -58px 0 0 209px;
}

.disruptpress-nav-menu .menu-item:hover {
	position: static;
}

.disruptpress-nav-menu .menu-item:hover > .sub-menu {
	left: auto;
	opacity: 1;
}

.disruptpress-nav-menu > .first > a {
	padding-left: 0;
}

.disruptpress-nav-menu > .last > a {
	padding-right: 0;
}

.nav-primary-scroll-wrap {

	/*display: none;*/
	/ *width: $dp_primary_menu_sticky_menu_width; */
	/ *max-width: $dp_primary_menu_sticky_menu_width; */
	z-index: 99999;
	top: 0;
	right: 0;
	left: 0;
	margin: 0 auto;
}




.dp-search-nav-primary {
	display: inline-block;
	float: right;
	vertical-align: middle;
	border-left: none;
	box-shadow: none;
	overflow: hidden;
	line-height: 0 !important;
	padding-left: ' . $dp_primary_menu_search_padding_left . 'px;
	padding-right: ' . $dp_primary_menu_search_padding_right . 'px;
}

.nav-primary .disruptpress-nav-menu > li.dp-search-nav-primary {
	box-shadow: ' . $dp_primary_menu_search_divider_boxshadow . ';
}

.dp-search-nav-primary-wrap {
	
}

.dp-search-nav-primary .search-form {
	display: table-cell;
	vertical-align: middle;
	height:' . $dp_primary_menu_height . 'px;
	padding-right: 5px; /* Fix for border radius overlap */
}

.dp-search-nav-primary .search-field {
	display: inline-block;
	vertical-align: middle;
	font-size: ' . $dp_primary_menu_search_font_size . 'px;
	width: ' . $dp_primary_menu_search_field_width . 'px;
	/*max-width: ' . $dp_primary_menu_search_field_width . 'px;*/
	height: ' . $dp_primary_menu_search_field_height . 'px;
	line-height: 0px;
	border: ' . $dp_primary_menu_search_border . ';
	background: #fff;
	border-radius: ' . $dp_primary_menu_search_border_radius . 'px;
	padding: 0px 10px;
	margin-right: 2px; /* Fix for border radius overlap */
}

.dp-search-nav-primary .search-submit {
	display: inline-block;
	vertical-align: middle;
	font-family: "dashicons";
	font-size: ' . $dp_primary_menu_search_font_size_icon . 'px;
	font-weight: 400;
	overflow: visible;
	position: relative;
	border: 0;
	padding: 0;
	cursor: pointer;
	color: ' . $dp_primary_menu_search_submit_font_color . ';
	text-transform: uppercase;
	/*text-shadow: 0 -1px 0 rgba(0, 0 ,0, .3);*/
	height: ' . $dp_primary_menu_search_field_height . 'px;
	width: ' . $dp_primary_menu_search_field_height . 'px;
	margin-left: -' . $dp_primary_menu_search_field_height . 'px;
	background-color: ' . $dp_primary_menu_search_border_color . ';
	border-radius: 0 ' . $dp_primary_menu_search_border_radius . 'px ' . $dp_primary_menu_search_border_radius . 'px 0 ;
}

.dp-search-nav-primary .search-submit:focus,
.dp-search-nav-primary .search-submit:hover {
	background-color: ' . $dp_primary_menu_search_border_color . ';
	color: ' . $dp_primary_menu_search_submit_font_color . ';
}


/* ## Nav Primary Menu Logo
--------------------------------------------- */
.dp-nav-primary-logo {
	float: left;
}

.nav-primary .dp-nav-primary-logo {
	padding-left: ' . $dp_primary_menu_logo_padding_left . 'px;
	padding-right: ' . $dp_primary_menu_logo_padding_right . 'px;
}

.nav-primary .title-area {
	float: left;
	padding: 0;
	/*width: ' . $dp_primary_menu_logo_title_area_width . 'px;*/
	display: table;
	white-space: nowrap;
	height: ' . $dp_primary_menu_height . 'px;
	text-align: left;
	transition: all 0.4s;
}

.nav-primary .site-title {
	font-family: ' . $dp_primary_menu_logo_title_font_family . ';
	font-size: ' . $dp_primary_menu_logo_title_font_size . 'px;
	font-size: ' . $dp_primary_menu_logo_title_font_size / 10 . 'rem;
	font-weight: ' . $dp_primary_menu_logo_title_font_weight . ';
	color: ' . $dp_primary_menu_logo_title_color . ';
	display: block;
	vertical-align: middle;
	line-height:1;
	margin-bottom: ' . $dp_primary_menu_logo_title_margin_bottom . 'px;
	text-transform: ' . $dp_primary_menu_logo_title_uppercase . ';
}

.nav-primary .site-title a,
.nav-primary .site-title a:hover,
.nav-primary .site-title a:focus {
	color: ' . $dp_primary_menu_logo_title_color . ';
	text-decoration:none;
	padding: 0;
}

.nav-primary .title-logo {
	display: ' . $dp_primary_menu_logo_display . ';
	margin-right: ' . $dp_primary_menu_logo_margin_right . 'px;
	white-space: nowrap;
	height:100%;
	width: ' . $dp_primary_menu_logo_width . 'px;
  vertical-align: middle;
}

.nav-primary .title-logo-img {
	' . $dp_primary_menu_logo_upload . '
	background-repeat:no-repeat;
	background-size:contain;
	background-position:left;
	height:100%;
	width:100%;
}

.nav-primary .site-title a {
	 padding-left: 0px !important;
   padding-right: 0px !important;
}

.nav-primary .title-logo a {
   padding-right: 0px !important;
}

.nav-primary .site-title-wrap {
 	display: table-cell;
	text-align: left;
  vertical-align: middle;
}

.nav-primary .site-description {
	font-family: ' . $dp_primary_menu_logo_tagline_font_family . ';
	font-size: ' . $dp_primary_menu_logo_tagline_font_size . 'px;
	font-size: ' . $dp_primary_menu_logo_tagline_font_size / 10 . 'rem;
	font-weight: ' . $dp_primary_menu_logo_tagline_font_weight . ';
	color: ' . $dp_primary_menu_logo_tagline_color . ';
	line-height: 1;
  display: block;
  vertical-align: bottom;
	text-transform: ' . $dp_primary_menu_logo_tagline_uppercase . ';
}

.nav-primary .header-image .site-description,
.nav-primary .header-image .site-title a {
	overflow: hidden;
	text-indent: 100%;
	white-space: nowrap;
}

/* ## Accessible Menu
--------------------------------------------- */


/* ## Accessible Menu
--------------------------------------------- */

.menu .menu-item:focus {
	position: static;
}

.menu .menu-item > a:focus + ul.sub-menu,
.menu .menu-item.sfHover > ul.sub-menu {
	left: auto;
	opacity: 1;
}

.site-header .genesis-nav-menu li li {
	margin-left: 0;
}

/* # Site Navigation
/* # Primary Menu Sticky
---------------------------------------------------------------------------------------------------- */

.nav-primary-scroll-wrap-sticky {
	z-index:99999;
	position: ' . $dp_primary_menu_sticky_enabled . '; /* Setting position fixed to this container instead of .nav-primary, fixes IE flicker issue */
}

.nav-primary.nav-primary-sticky {
	' . $dp_primary_menu_sticky_boxed . ';
	border-radius: 0;
	box-shadow: none;
}

.nav-primary-sticky-slidein {	
	top: -90px;
	display: block;
}

.nav-primary-sticky-slidein-transition {
	top: 0;
	transition: 0.6s top;
	display: block;
}
.nav-primary-sticky .sub-menu {
	position: fixed;
}

/* # Content Area
---------------------------------------------------------------------------------------------------- */

/* ## Entries
--------------------------------------------- */

.entry {
	/*margin-bottom: 60px;*/
}

.entry-content ol,
.entry-content ul {
	margin-bottom: 28px;
	margin-left: 40px;
}

.entry-content ol > li {
	list-style-type: decimal;
}

.entry-content ul > li {
	list-style-type: disc;
}

.entry-content ol ol,
.entry-content ul ul {
	margin-bottom: 0;
}

.entry-content code {
	background-color: #333;
	color: #ddd;
}

/* ## Entry Meta
--------------------------------------------- */

p.entry-meta {
	font-size: 16px;
	font-size: 1.6rem;
	margin-bottom: 0;
}

.entry-header .entry-meta {
	text-align: left;
	font-size: ' . $dp_page_header_meta_font_size . 'px;
	font-size: ' . $dp_page_header_meta_font_size / 10 . 'rem;
	font-weight: ' . $dp_page_header_meta_font_weight . ';
	color: ' . $dp_page_header_meta_font_color . ';
	padding-top: ' . $dp_page_header_meta_padding_top . 'px;
	padding-right: ' . $dp_page_header_meta_padding_right . 'px;
	padding-bottom: ' . $dp_page_header_meta_padding_bottom . 'px;
	padding-left: ' . $dp_page_header_meta_padding_left . 'px;
	
	margin-top: ' . $dp_page_header_meta_margin_top . 'px;
	margin-right: ' . $dp_page_header_meta_margin_right . 'px;
	margin-bottom: ' . $dp_page_header_meta_margin_bottom . 'px;
	margin-left: ' . $dp_page_header_meta_margin_left . 'px;
	
	' . $dp_page_header_meta_shadow . ';
	' . $page_header_meta_border_style . ';
	' . $dp_page_header_meta_bg . '
	' . $dp_page_header_meta_border_radius . '
}
.entry-header .entry-meta a {
    color: ' . $dp_page_header_meta_link_color . ';
}

.entry-header .entry-meta a:hover {
    color: ' . $dp_page_header_meta_link_hover_color . ';
}

.entry-header .entry-meta .entry-time {
    ' . $dp_page_header_meta_show_date . ';
}

.entry-header .entry-meta .byline {
    ' . $dp_page_header_meta_show_author . ';
}

.entry-header .entry-meta .entry-comments-link {
    ' . $dp_page_header_meta_show_comment_count . ';
}

.entry-header .entry-meta .edit-link {
    display: none;
}

.entry-categories,
.entry-tags {
	display: block;
}

.entry-comments-link::before {
	content: "\2014";
	margin: 0 6px 0 2px;
}

.updated:not(.published) {
    display: none;
}
/* ## Pagination
--------------------------------------------- */

.pagination {
	clear: both;
	margin: 40px 0;
}

.pagination li {
	display: inline;
}

.pagination li a {
	cursor: pointer;
	display: inline-block;
	font-size: 16px;
	font-size: 1.6rem;
	padding-right: 10px;
	text-decoration: none;
}

.pagination .active a {
	color: #333;
}

/* ## Comments
--------------------------------------------- */

.comment-respond,
.entry-comments,
.entry-pings {
	margin-bottom: 60px;
}

.comment-header {
	font-size: 16px;
	font-size: 1.6rem;
}

.comment-content {
	clear: both;
	word-wrap: break-word;
}

.comment-list li {
	padding: 32px 0 0 32px;
}

.comment-list li.depth-1 {
	padding-left: 0;
}

.comment-respond input[type="email"],
.comment-respond input[type="text"],
.comment-respond input[type="url"] {
	width: 50%;
}

.comment-respond label {
	display: block;
	margin-right: 12px;
}

.entry-comments .comment-author {
	margin-bottom: 0;
}

.entry-pings .reply {
	display: none;
}


/* # Sidebars
---------------------------------------------------------------------------------------------------- */

.sidebar {
	font-size: 16px;
	font-size: 1.6rem;
}

.sidebar li {
	margin-bottom: 10px;
	/*padding-bottom: 10px;*/
}

.sidebar p:last-child,
.sidebar ul > li:last-child {
	margin-bottom: 0;
}

.sidebar .widget {
	/*margin-bottom: 60px;*/
}


/* # Site Footer
---------------------------------------------------------------------------------------------------- */

.site-footer {
	' . $dp_footer_bg . '
	padding: ' . $dp_footer_padding_top . 'px ' . $dp_footer_padding_right . 'px ' . $dp_footer_padding_bottom . 'px ' . $dp_footer_padding_left . 'px;
	margin-top: ' . $dp_footer_margin_top . 'px;
	margin-bottom: ' . $dp_footer_margin_bottom . 'px;
	margin-left: auto;
	margin-right: auto;
	' . $footer_border_style . '
	' . $dp_footer_border_radius . '
	font-size: ' . $dp_footer_font_size . 'px;
	font-weight: ' . $dp_footer_font_weight . ';
	font-family: ' . $dp_footer_font_family . ';
	color: ' . $dp_footer_font_color . ';
	clear:both;
}

.site-footer a {
	color: ' . $dp_footer_link_color . ';
	text-decoration: ' . $dp_footer_link_underline . ';
}

.site-footer a:hover {
	color: ' . $dp_footer_link_color_hover . ';
	text-decoration: ' . $dp_footer_link_hover_underline . ';
}

.site-footer .widget-title {
	font-size: ' . $dp_footer_widget_title_font_size . 'px;
	font-weight: ' . $dp_footer_widget_title_font_weight . ';
	font-family: ' . $dp_footer_widget_title_font_family . ';
	color: ' . $dp_footer_widget_title_font_color . ';
}
.site-footer p {
	margin-bottom: 0;
}

.footer-widget-area {
	width: 32%;
	display: inline-block;
	vertical-align: top;
}
.footer-widget-area li {
	margin-bottom: 10px;
}

.site-footer-copyright {
	margin-top: 40px;
}

.site-footer-copyright a {
    text-decoration: underline;
}

.site-footer-copyright-disclaimer {
    font-size: 12px;
}
.site-footer-copyright-theme {
    margin-top: 20px;
    font-size: 12px;
}
	

.sidr .dp-search-nav-primary {
    display: none;
}

/* # Social Media Share
---------------------------------------------------------------------------------------------------- */

.dp-social-media-share-wrap {
    width: ' . $dp_social_share_alignment_width . ';
    display: table;
    margin-top: 25px;
    margin-bottom: 25px;
    margin-left: ' . $dp_social_share_alignment_margin_left . ';
    margin-right: ' . $dp_social_share_alignment_margin_right . ';
    white-space: nowrap;
}

.dp-social-media-share-float {
    position: fixed;
    top: 300px;
    left: 0;
    width: auto;
}

.dp-social-media-share-float > .dp-social-media-share-button {
    width: 50px;
    display: block;
    padding-left: 0 !important;
    padding-right: 0 !important;
}
.dp-social-media-share-float:hover .dp-social-media-share-text:hover  {
    display: block;
}
.dp-social-media-share-float .dp-social-media-share-text {
    display: none !important;
}

.dp-social-media-share-button {
    display: table-cell;
    width: 20%;
    text-align: center;
    padding-left: ' . $dp_social_share_space_between_buttons . ';
    padding-right: ' . $dp_social_share_space_between_buttons . ';
}

.dp-social-media-share-button a {
    padding: 5px 5px;
    color: #FFF;
    text-decoration: none;
    display: inline-block;
    height:100%;
    width:100%;
    text-align: center;
}

.dp-social-media-share-facebook {
    padding-left: 0 !important;
}

.dp-social-media-share-linkedin {
    padding-right: 0 !important;
}

.dp-social-media-share-facebook a {
    background-color: #3a579a;
}

.dp-social-media-share-twitter a {
    background-color: #00abf0;
}

.dp-social-media-share-google a {
    background-color: #EA4335;
}

.dp-social-media-share-pinterest a {
    background-color: #cd1c1f;
}

.dp-social-media-share-linkedin a {
    background-color: #127bb6;
}
.dp-social-media-share-text {
    display:' . $dp_social_share_display_name . ';
    padding-left: 5px;
    font-size: 12px;
}

.dp-social-media-share-button a:hover {
    background: black;
}

/* # Social Media Following
---------------------------------------------------------------------------------------------------- */

.dp-social-media-follow-wrap {
    width: 100%;
    display: block;
    margin-top: ' . $dp_primary_sidebar_widgets_margin_top . 'px;
	margin-bottom: ' . $dp_primary_sidebar_widgets_margin_bottom . 'px;
}

.dp-social-media-follow-button {
    width: 100%;
}

.dp-social-media-follow-button a {
    padding: 5px 15px;
    padding-left: 55px;
    color: #FFF;
    text-decoration: none;
    display: inline-block;
    height:100%;
    width:100%;
}

.dp-social-media-follow-facebook a {
    background-color: #3a579a;
}

.dp-social-media-follow-twitter a {
    background-color: #00abf0;
}

.dp-social-media-follow-google a {
    background-color: #EA4335;
}

.dp-social-media-follow-pinterest a {
    background-color: #cd1c1f;
}

.dp-social-media-follow-linkedin a {
    background-color: #127bb6;
}

.dp-social-media-follow-instagram a {
    background-color: #9C27B0;
}

.dp-social-media-follow-text {
    padding-left: 10px;
}

.dp-social-media-follow-button a:hover {
    background: black;
}

/* # Related Posts
---------------------------------------------------------------------------------------------------- */

.dp-related-post-loop-container {
    margin-top: 50px;
    margin-bottom: 30px;
}
.dp-related-post-loop-container h3 {
    margin-bottom: 10px;
}

.dp-related-post-loop-wrap {
    position: relative;
    width: 20%;
    float: left;
    padding: 5px;
}

.dp-related-post-featured-image {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    width: auto;
    float: none;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    margin-left: 0px;
    box-shadow: none;
    border: none;
    border-radius: 0;
    overflow: hidden;
    line-height: 0;
    position: relative;
    padding-bottom: calc(100% * 9 / 16);
}

.dp-related-post-featured-image img {
    width: 100%;
    height: 100%;
    position: absolute;
}

.dp-related-post-title-wrap {
    margin-top: 10px;
}

.dp-related-post-title {
    height: 120px;
    font-size: 15px;
    overflow: hidden;
}

.dp-related-post-title a {
    text-decoration: none;
    color: #000;
}

/* # WooCommerce
---------------------------------------------------------------------------------------------------- */

.woocommerce .woocommerce-breadcrumb {
    border-bottom: 1px solid #8c8c8c;
    padding-bottom: 10px;
    margin-bottom: 40px;
}

.aawp .aawp-product--horizontal {
	font-size: inherit;
}

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce a.button {
    background: ' . $dp_woocommerce_category_cart_bg_color . ';
		color: ' . $dp_woocommerce_category_cart_font_color . ';
		font-weight:400;
}


.woocommerce div.product p.price, .woocommerce div.product span.price,
.woocommerce ul.products li.product .price {
    color: #de2727 !important;
}

.woocommerce span.onsale {
    min-height: auto !important;
    min-width: auto !important;
    border-radius: 0;
    line-height: normal !important;
    padding: 10px !important;
		background: ' . $dp_woocommerce_category_sale_bg_color . ';
		color: ' . $dp_woocommerce_category_sale_font_color . ';
}

.woocommerce ul.products li.product .onsale {
    right: auto !important;
    left: -' . $dp_woocommerce_category_border_left . 'px;
    top: -' . $dp_woocommerce_category_border_top . 'px;
    margin: 0 !important;
		border-top-left-radius: ' . $dp_woocommerce_category_border_radius . 'px;
}

.woocommerce ul.products li.product a img {
    width: auto !important;
    height: 200px !important;
}

.woocommerce ul.products li.product, .woocommerce-page ul.products li.product {
	padding: ' . $dp_woocommerce_category_padding . 'px;
	text-align: center;
	overflow: visible;
	display: block;
	margin-top: ' . $dp_woocommerce_category_margin_top . 'px;
	margin-right: ' . $dp_woocommerce_category_margin_right . 'px;
	margin-bottom: ' . $dp_woocommerce_category_margin_bottom . 'px;
	margin-left: ' . $dp_woocommerce_category_margin_left . 'px;
	' . $dp_woocommerce_category_shadow . '
	' . $dp_woocommerce_category_border . '
	background: ' . $dp_woocommerce_category_color . ';
	border-radius: ' . $dp_woocommerce_category_border_radius . 'px;
	width: 23.5%;
}

.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
    margin-right: -20px !important;
}

.woocommerce ul.products li.product a img {
    width: auto !important;
    height: 200px !important;
	  margin: 0 auto;
}

.woocommerce ul.products li.product .price {
    font-weight: 700;
}

.woocommerce ul.products li.product .woocommerce-loop-product__title {
	height: 115px;
	overflow: hidden;
}

.woocommerce ul.products li.product .price del {
    display: inline-block;
}

.woocommerce span.onsale {
	font-size: 16px;
	font-weight: 400;
}

.woocommerce div.product .product_title {
    margin-bottom:20px;
		font-size: '. $dp_woocommerce_category_product_font_size .'px;
}

@media only screen and (max-width: 600px) {

	.woocommerce .woocommerce-breadcrumb {
		padding-top: 10px;
	}

}
/* # Media Queries
---------------------------------------------------------------------------------------------------- */


@media only screen and (max-width: 1024px) {

    .site-header .title-area {
        float: none;
        margin: 0 auto;
    }
    .site-header .widget-area {
        width: 100%;
        
    }
    .site-header .widget-area div {
       margin:0 auto;
    }

	.site-inner,
	.wrap {
		padding-left: 10px;
		padding-right: 10px;
	}
	
	.body-container {
        padding-top: 0px;
        padding-bottom: 0px;
    }
	.content-sidebar1fullheight .sidebarfullheight-container,
	.sidebar1fullheight-content .sidebarfullheight-container,
	.content-sidebar2-sidebar1fullheight .sidebarfullheight-container,
	.sidebar1fullheight-content-sidebar2 .sidebarfullheight-container,
	.sidebar2-content-sidebar1fullheight .sidebarfullheight-container,
	.sidebar1fullheight-sidebar2-content .sidebarfullheight-container {
  	float: none;
		width: 100%;
	}
	
	.content-sidebar1-sidebar2 .content-sidebar1-wrap,
	.content-sidebar2-sidebar1 .content-sidebar2-wrap,
	.sidebar1-content-sidebar2 .sidebar1-content-wrap,
	.sidebar2-content-sidebar1 .content-sidebar1-wrap,
	.sidebar1-sidebar2-content .sidebar2-content-wrap,
	.sidebar2-sidebar1-content .sidebar1-content-wrap {
		float: none;
		max-width: 100%;
		margin-right: 0;
		margin-left: 0;
		width: 100%;
	}

	.content-sidebar1 .content,
	.sidebar1-content .content,
	.content-sidebar1-sidebar2 .content,
	.content-sidebar2-sidebar1 .content,
	.sidebar1-content-sidebar2 .content,
	.sidebar2-content-sidebar1 .content,
	.sidebar1-sidebar2-content .content,
	.sidebar2-sidebar1-content .content,
	.content-sidebar1fullheight .content,
	.sidebar1fullheight-content .content,
	.content-sidebar2-sidebar1fullheight .content,
	.sidebar1fullheight-content-sidebar2 .content,
	.sidebar2-content-sidebar1fullheight .content,
	.sidebar1fullheight-sidebar2-content .content {
		float: none;
		width: 100%;
		max-width: 100%;
		margin-left: 0;
		margin-right: 0;
	}
	
	.sidebar-primary,
	.content-sidebar1 .sidebar-primary,
	.sidebar1-content .sidebar-primary,
	.content-sidebar1-sidebar2 .sidebar-primary,
	.content-sidebar2-sidebar1 .sidebar-primary,
	.sidebar1-content-sidebar2 .sidebar-primary,
	.sidebar2-content-sidebar1 .sidebar-primary,
	.sidebar1-sidebar2-content .sidebar-primary,
	.sidebar2-sidebar1-content .sidebar-primary,
	.content-sidebar1fullheight .sidebar-primary,
	.sidebar1fullheight-content .sidebar-primary,
	.content-sidebar2-sidebar1fullheight .sidebar-primary,
	.sidebar1fullheight-content-sidebar2 .sidebar-primary,
	.sidebar2-content-sidebar1fullheight .sidebar-primary,
	.sidebar1fullheight-sidebar2-content .sidebar-primary {
		float: none;
		width: 100%;
		margin-right: 0;
		margin-left: 0;
	}
	
	.sidebar-secondary,
	.content-sidebar1-sidebar2 .sidebar-secondary,
	.content-sidebar2-sidebar1 .sidebar-secondary,
	.sidebar1-content-sidebar2 .sidebar-secondary,
	.sidebar2-content-sidebar1 .sidebar-secondary,
	.sidebar1-sidebar2-content .sidebar-secondary,
	.sidebar2-sidebar1-content .sidebar-secondary,
	.content-sidebar2-sidebar1fullheight .sidebar-secondary,
	.sidebar1fullheight-content-sidebar2 .sidebar-secondary,
	.sidebar2-content-sidebar1fullheight .sidebar-secondary,
	.sidebar1fullheight-sidebar2-content .sidebar-secondary {
		float: none;
		width: 100%;
		margin-right: 0;
		margin-left: 0;
	}

	.title-area {
		width: 100%;
	}

	.content,
	.site-header .widget-area,
	.title-area {
		width: 100%;
	}

	.site-header .wrap {
		padding: 20px 5%;
	}

	.header-image .site-title > a {
		background-position: center top;
	}

	.genesis-nav-menu li,
	.site-header ul.genesis-nav-menu,
	.site-header .search-form {
		float: none;
	}

	.genesis-nav-menu,
	.site-header .title-area,
	.site-header .search-form {
		text-align: center;
	}

	.genesis-nav-menu a,
	.genesis-nav-menu > .first > a,
	.genesis-nav-menu > .last > a {
		padding: 20px 16px;
	}

	.site-header .search-form {
		margin: 16px auto;
	}
	
	.site-footer {
	    padding-left: 15px;
	    padding-right: 15px;
	}
	
	.footer-widget-area {
		width:100%;
		display: block;
		margin-bottom:20px;
	}
	
	.dp-social-media-share-float > .dp-social-media-share-button {
	    display: none;
	}

}

/* # Print Styles
---------------------------------------------------------------------------------------------------- */

@media print {

	*,
	*:before,
	*:after {
		background: transparent !important;
		box-shadow: none !important;
		color: #000 !important;
		text-shadow: none !important;
	}

	a,
	a:visited {
		text-decoration: underline;
	}

	a[href]:after {
		content: " (" attr(href) ")";
	}

	abbr[title]:after {
		content: " (" attr(title) ")";
	}

	a[href^="javascript:"]:after,
	a[href^="#"]:after,
	.site-title > a:after {
		content: "";
	}

	thead {
		display: table-header-group;
	}

	img,
	tr {
		page-break-inside: avoid;
	}

	img {
		max-width: 100% !important;
	}

	@page {
		margin: 2cm 0.5cm;
	}

	p,
	h2,
	h3 {
		orphans: 3;
		widows: 3;
	}

	blockquote,
	pre {
		border: 1px solid #999;
		page-break-inside: avoid;
	}

	.content,
	.content-sidebar {
		width: 100%;
	}

	button,
	input,
	select,
	textarea,
	.breadcrumb,
	.comment-edit-link,
	.comment-form,
	.comment-list .reply a,
	.comment-reply-title,
	.edit-link,
	.entry-comments-link,
	.entry-footer,
	.genesis-box,
	.header-widget-area,
	.hidden-print,
	.home-top,
	.nav-primary,
	.nav-secondary,
	.post-edit-link,
	.sidebar {
		display: none !important;
	}

	.title-area {
		text-align: center;
		width: 100%;
	}

	.site-title > a {
		margin: 0;
		text-decoration: none;
		text-indent: 0;
	}

	.site-inner {
		padding-top: 0;
		position: relative;
		top: -100px;
	}

	.author-box {
		margin-bottom: 0;
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		orphans: 3;
		page-break-after: avoid;
		page-break-inside: avoid;
		widows: 3;
	}


	img {
		page-break-after: avoid;
		page-break-inside: avoid;
	}

	blockquote,
	pre,
	table {
		page-break-inside: avoid;
	}

	dl,
	ol,
	ul {
		page-break-before: avoid;
	}

}

/* Responsive Menu */
.disruptpress-responsive-menu-wrap,
#disruptpress-responsive-menu {
	display:none;
}

.responsive-search-field {
	font-size:1.5rem !important;
	border-radius:15px !important;
	border:1px solid #E1E1E1 !important;
	-webkit-background-clip: padding-box !important;
	padding-left:35px !important;
}

.responsive-search-icon {
	margin-top:-35px;
	margin-left:10px;
}

.disruptpress-responsive-menu {
    margin-bottom: 100px !important;
    padding-bottom: 100px !important;
}

.disruptpress-responsive-menu .dp-nav-primary-logo {
    display: none;
}

.disruptpress-responsive-menu-wrap {
    overflow: auto;
    text-align: center;
    ' . $primary_menu_border_style . '
}

.disruptpress-responsive-menu-wrap-menu-toggle {
    float: left;
    display: inline-block;
}
.disruptpress-responsive-menu-wrap-title {
    text-align: center;
    display: inline-block;
    font-size: 20px;
    line-height: 65px;
}
.disruptpress-responsive-menu-wrap-title a {
    color: ' . $dp_primary_menu_link_color . ';
    text-decoration: none;
}
.disruptpress-responsive-menu-wrap-menu-toggle a {
    color: ' . $dp_primary_menu_link_color . ';
}

.nav-primary-height-fix {
    height:' . $dp_primary_menu_height . 'px;
}


@media only screen and (max-width: 768px) {
	#disruptpress-nav-primary,
	#disruptpress-nav-secondary {
		display:none;
	}
	
	.disruptpress-responsive-menu-wrap,
	#disruptpress-responsive-menu {
		display:block;
	}
	
    .disruptpress-responsive-menu-wrap {
    '. $dp_primary_menu_bg .'
    }
    
	#disruptpress-responsive-menu-toggle:after {
		font-family: "dashicons";
		content: " \f333";
		font-size: 40px;
		display:inline-block;
		text-decoration:none;
	}
	
	#disruptpress-responsive-menu-toggle-inside:after {
		font-family: "dashicons";
		content: " \f158";
		font-size: 30px;
		display:inline-block;
		text-decoration:none;
		padding-left:10px;
	}
	#disruptpress-responsive-menu-toggle-inside:after {
		color: #ff4d43;
	}
	
	
    .nav-primary-height-fix {
        height:auto;
    }
    
    .post-featured-image img {
        background-size: cover!important;
    }
    
    .dp-blog-roll-loop-featured-image {
	    width: 100%;
	    padding-bottom: calc(100% * ' . $dp_blog_roll_featured_image_aspect_ratio . ');
	 }
	 
	 .dp-social-media-share-text {
	    display: none;
	 }
}


@media only screen and (max-width: 600px) {

    body {
        font-size: 16px;
        font-size: 1.6rem;
        font-weight: 400; 
    }
	.site-inner,
	.wrap {
		padding-left: 0px;
		padding-right: 0px;
		
	}
	.site-inner {
	    padding-top: 0px;
	}
	h1.entry-title {
	    font-size: 22px !important;
        font-size: 2.2rem !important;
        
	}
	.entry-header {
	    width: 100% !important;
	    margin-top: 0px !important;
	}
	
	.blog .entry, .archive .entry, .search .entry {
	    width: 100%;
	}
	.page .content, .single .content {
	    padding-left: 15px;
	    padding-right: 15px;
	}
	
	.dp-custom-post-loop-title {
	    font-size: 15px !important;
	    font-weight: 400 !important;
	}
	.dp-custom-post-loop-meta {
	    font-size: 12px !important;
	}
	
	.dp-blog-roll-loop-wrap {
	    margin-left: 0px;
	    margin-right: 0px;
	    
	}
	.single .content. post-featured-image,
	.page .content .post-featured-image {
	    /*width: calc(100% + ' . $dp_page_padding_right . 'px + ' . $dp_page_padding_left . 'px);
	    margin-left: -' . $dp_page_padding_left . 'px;*/
	    width: calc(100% + 30px);
	    margin-left: -15px;
	}
	
	.post-featured-image {
	    margin-bottom: 0px;
	}
	
	.post-featured-image img {
	    margin-bottom: -10px;
	}
	    
	.post-featured-image .entry-header-wrap {
	    position: initial;
	}
	
	.post-featured-image .entry-categories-wrap {
        bottom: 0;
        top: initial;
	}
	
	.site-header {
	    padding-bottom: 0px;
	    
	}
	
	.site-header .title-area {
	    width: 100%;
			white-space: normal;
	}
	
	.site-header .title-logo {
	    height: 70px;
	    display: block;
	    margin: 0 auto;
	}
	
	.site-header .title-logo-img {
		background-position:center;
	}
	
	.site-header .site-title-wrap {
	    display: block;
	    text-align: center;
	}
	
	.site-header .site-title {
	    font-size: 26px;
        font-size: 2.6rem;
	}
	
	.dp-custom-post-loop-wrap-parent {
	    width: 100% !important;
	}
	
	.page .content, .single .content {
	    /*padding: 0;*/
	     padding-top: 0;
	}
	
	.content {
	    padding: 15px;
	}
	
	.single .entry-header {
	    padding-left: 10px;
	    padding-right: 10px;
	}
	
	.page .entry-header {
	    padding-left: 0px;
	    padding-right: 0px;
	}
	
	.dp-blog-roll-loop-container {
	    overflow: hidden;
	}
	
	.dp-blog-roll-loop-featured-image {
	    margin-left: 0px;
	    margin-top: 0px;
	    width: 100%;
	    padding-bottom: calc(100% * ' . $dp_blog_roll_featured_image_aspect_ratio . ');
	}
	
	.dp-blog-roll-loop-title,
	.dp-blog-roll-loop-excerpt {
	    height: auto;
	}
	
	.dp-blog-roll-loop-title h2 {
		font-size: 20px;
		font-weight: 700;
	}
	
	.dp-related-post-loop-wrap {
        position: relative;
        width: 100%;
        float: none;
        padding: 0px;
    }
    
    .dp-related-post-title-wrap {
        margin-bottom: 30px;
    }
    .dp-related-post-title {
        height: auto;
        font-size: 18px;
    }
    
    body .dp-slider {
        width: 100% !important;
        margin-right:0 !important;
        float: none  !important;
    }

	.bxslider > li {
		margin-right:0 !important;
	}

	
}


.rpwwt-widget {
    font-size: 14px;
}

/* # Redux Options
---------------------------------------------------------------------------------------------------- */
.option-dp-fb-name {
    border: 0 !important;
}
.option-dp-fb-name .redux_field_th,
.option-dp-fb-name .redux-container-text {
    padding-bottom: 0 !important;
}

.bx-wrapper {
    border: 0 !important;
    box-shadow: none !important;
}
.bx-wrapper .bx-caption {
    background: rgba(10,0,0,0.42) !important;
}


';

}
?>