//Gradient Functions

function dp_rgb2hex(rgb){
	if (rgb.includes("#")) {
  	return rgb;
  }

	rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
	return (rgb && rgb.length === 4) ? "#" +
	("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
	("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
	("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}

function dp_hexToRgb(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

function shading(color, percent) {   
	var f=parseInt(color.slice(1),16),t=percent<0?0:255,p=percent<0?percent*-1:percent,R=f>>16,G=f>>8&0x00FF,B=f&0x0000FF;
	return "#"+(0x1000000+(Math.round((t-R)*p)+R)*0x10000+(Math.round((t-G)*p)+G)*0x100+(Math.round((t-B)*p)+B)).toString(16).slice(1);
}

function bg_gradient (selector, shape, color1_rgba, color2_rgba, style_status, img_status, pattern_url, img_url, img_pos, img_size, img_repeat, img_attach, grad_pos1, grad_pos2, shade_percentage, rev_colors, advanced, inIframe) {
	
	var color1 = color1_rgba;
	var color2 = color2_rgba;
	var color1_hex = dp_rgb2hex(color1);
	
	if(style_status == "2") {
		var color2 = shading(dp_rgb2hex(color1), shade_percentage);
	}
	
	if (rev_colors == "1" && advanced == "1" && style_status != "1") {
		var color1 = color2_rgba;
		var color2 = color1_rgba;
		
		if(style_status == "2") {
			var color1 = shading(dp_rgb2hex(color2), shade_percentage);
		}
	}

	if(advanced == "0") {
		
		if(shape == "5" || shape == "6" || shape == "7" || shape == "8") {
			var grad_per1 = 50;
			var grad_per2 = 50;
		} else {
			var grad_per1 = 0;
			var grad_per2 = 100;
		}
		
	} else {
		var grad_per1 = grad_pos1;
		var grad_per2 = grad_pos2;
	}
	
	if (img_status == "1") {
        var bg_img = '';
    } else if (img_status == "2"){
		var path = window.location.host; 
		var bg_img = 'url(//' + path + '/wp-content/themes/disruptpress/customizer/img/pattern/' + pattern_url + ') repeat, ';
	} else if (img_status == "3"){
		var path = window.location.host; 
		var bg_img = 'url(' + img_url + ') '+ img_pos +'/'+ img_size +' ' + img_repeat +' ' + img_attach +', ';
	}
	
	if(inIframe == "1") {
		var prefix = jQuery("iframe").contents().find(selector);
	} else {
		var prefix = jQuery.stylesheet(selector);
	}
	//No Gradient
	if (shape == "0") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' '+ color1 );
		/*jQuery(selector).css('background', bg_img +' -o-linear-gradient('+color1+' 0%, '+color1+' 100%)',
		jQuery(selector).css('background', bg_img +' -moz-linear-gradient('+color1+' 0%, '+color1+' 100%)',
		jQuery(selector).css('background', bg_img +' -webkit-linear-gradient('+color1+' 0%, '+color1+' 100%)',
		jQuery(selector).css('background', bg_img +' linear-gradient('+color1+' 0%, '+color1+' 100%)',*/
		
	}
	
	//Gradient Top to Bottom
	if (shape == "1") {
		/*
		'background: '+ bg_img +' -o-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)',
		'background: '+ bg_img +' -moz-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)',
		'background: '+ bg_img +' -webkit-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)',
		'background: '+ bg_img +' linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)',
		*/
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
	}
	
	//Gradient Left to Right
	if (shape == "2") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(left, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(left, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(left, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' linear-gradient(to right, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		
	}
	
	//Gradient Diagonal Top Left to Bottom Right
	if (shape == "3") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(-45deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(-45deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(-45deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' linear-gradient(135deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		
	}
	
	//Gradient Diagonal Bottom Left to Top Right
	if (shape == "4") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(225deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(225deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(225deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		prefix.css('background', bg_img +' linear-gradient(225deg, '+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
		
	}
	
	//Gradient Top to Bottom Split-Mirrored
	if (shape == "5") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		
	}
	
	//Gradient Left to Right Split-Mirrored
	if (shape == "6") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(left, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(left, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(left, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' linear-gradient(to right, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		
	}
	
	//Gradient Diagonal Top Left to Botton Right Split-Mirrored
	if (shape == "7") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(-45deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(-45deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(-45deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' linear-gradient(135deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		
	}
	
	//Gradient Diagonal Bottom Left to Top Right Split-Mirrored
	if (shape == "8") {
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient(225deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient(225deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient(225deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		prefix.css('background', bg_img +' linear-gradient(225deg, '+color1+' 0%, '+color2+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%, '+color1+' 100%)' );
		
	}
	
	
	
	//Gradient Ellipse Cover Center
	if (shape == "9") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center center, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center center, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center center, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center center, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center center, ellipse cover, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Ellipse Contained Center
	if (shape == "10") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center center, ellipse contain, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center center, ellipse contain, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center center, ellipse contain, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center center, ellipse contain, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center center, ellipse contain, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Circle Cover Center
	if (shape == "11") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center center, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center center, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center center, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center center, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center center, circle cover, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Ellipse Cover Bottom
	if (shape == "12") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center bottom, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center bottom, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center bottom, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center bottom, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center bottom, ellipse cover, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Circle Cover Bottom
	if (shape == "13") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center bottom, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center bottom, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center bottom, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center bottom, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center bottom, circle cover, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Ellipse Cover Top
	if (shape == "14") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center top, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center top, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center top, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center top, ellipse cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center top, ellipse cover, '+color1+', '+color2+')' );
		
	}
	
	//Gradient Circle Cover Top
	if (shape == "15") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-radial-gradient(center top, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -ms-radial-gradient(center top, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -moz-radial-gradient(center top, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' -webkit-radial-gradient(center top, circle cover, '+color1+', '+color2+')' );
		prefix.css('background', bg_img +' radial-gradient(center top, circle cover, '+color1+', '+color2+')' );
		
	}
	//Gradient Middle Split Style 1
	if (shape == "16") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+ shading(color1_hex, 0) +' 0%, '+ shading(color1_hex, 0) +' 50%, '+ shading(color1_hex, -0.2) +' 51%, '+ shading(color1_hex, 0.1) +' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+ shading(color1_hex, 0) +' 0%, '+ shading(color1, 0) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0.1) +' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0.1) +' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0.1) +' 100%)' );
		
	}
	
	//Gradient Middle Split Style 2
	if (shape == "17") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+ shading(color1, -0.1) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+ shading(color1, 0.1) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+ shading(color1, 0.1) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+ shading(color1, 0.1) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		
	}
	
	//Gradient Middle Split Style 3
	if (shape == "18") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+ shading(color1, 0.2) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+ shading(color1, 0.2) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+ shading(color1, 0.2) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+ shading(color1, 0.2) +' 0%, '+ shading(color1,0.20) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		
	}
	
	//Gradient Middle Split Style 4
	if (shape == "19") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+ shading(color1, 0.3) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+ shading(color1, 0.3) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+ shading(color1, 0.3) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+ shading(color1, 0.3) +' 0%, '+ shading(color1, 0.1) +' 50%, '+ shading(color1, -0.2) +' 51%, '+ shading(color1, 0) +' 100%)' );
		
	}
	
	//Gradient Middle Split Style 5
	if (shape == "20") {	
		prefix.css('background','' );
		prefix.css('background', bg_img +' -o-linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -moz-linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' -webkit-linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		prefix.css('background', bg_img +' linear-gradient('+ shading(color1, 0) +' 0%, '+ shading(color1, 0.2) +' 50%, '+ shading(color1, 0) +' 51%, '+ shading(color1, 0) +' 100%)' );
		
	}
}