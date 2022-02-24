/**
 * jQuery plugin for adding, removing and making changes to CSS rules
 * 
 * @author Vimal Aravindashan
 * @version 0.3.7
 * @licensed MIT license
 */
(function (factory) {
	if (typeof module === "object" && typeof module.exports === "object") {
		// Node/CommonJS
		module.exports = factory;
	} else {
		// Browser globals
		factory(jQuery);
	}
}(function ($) {
	var	_ahref = $(document.createElement('a')), /**< <a> tag used for evaluating hrefs */
		_styles = _ahref.prop('style'), /**< Collection of styles available on the host */
		_sheet = function(s) {
			return s.sheet || s.styleSheet;
		}($('<style type="text/css">*{}</style>').appendTo('head')[0]), /**< StyleSheet for adding new rules*/
		_rules = ('cssRules' in _sheet) ? 'cssRules' : 'rules', /**< Attribute name for rules collection in a stylesheet */
		vendorPrefixes = ["Webkit", "O", "Moz", "ms"]; /**< Case sensitive list of vendor specific prefixes */
	
	/**
	 * @function filterStyleSheet
	 * Filter a stylesheet based on accessibility and, ID or location
	 * @param {String} filter Filter to be applied. id or href of the style element can be used as filters.
	 * @param {CSSStyleSheet} styleSheet StyleSheet to be filtered
	 * @returns {Boolean} true if styleSheet matches the filter, false otherwise
	 */
	function filterStyleSheet(filter, styleSheet) {
		try {
			if(styleSheet[_rules]) {
				filter = filter || '';
				var node = $(styleSheet.ownerNode || styleSheet.owningElement);
				return (filter === '') || (filter === '*') ||
					('#'+(node.prop('id') || '') == filter) ||
					((node.prop('href') || '') == _ahref.prop('href', filter).prop('href'));
			} else {
				return false;
			}
		} catch(e) {
			return false;
		}
	}
	
	/**
	 * @function parseSelector
	 * Splits a jQuery.stylesheet compatible selector into stylesheet filter and selector text
	 * @param {String} selector Selector text to be parsed
	 * @returns {Object} object with two properties 'styleSheet' and 'selectorText'
	 */
	function parseSelector(selector) {
		var styleSheet = (/.*?{/.exec(selector) || ['{'])[0],
			selectorText = /{.*}/g.exec(selector); //TODO: replace selector with dict object
		if(selectorText === null) {
			var parts = selector.split('{');
			selectorText = '{'+parts[parts.length==1 ? 0 : 1].split('}')[0]+'}';
		} else {
			selectorText = selectorText[0];
		}
		return {
			styleSheet: $.trim(styleSheet.substr(0, styleSheet.length-1)),
			selectorText: normalizeSelector(selectorText.substr(1, selectorText.length-2))
		};
	}
	
	/**
	 * @function normalizeSelector
	 * Normalizes selectorText to work cross-browser
	 * @param {String} selectorText selector string to normalize
	 * @returns {String} normalized selector string
	 */
	function normalizeSelector(selectorText) {
		var selector = [], last, len;
		last = _sheet[_rules].length;
		insertRule.call(_sheet, selectorText, ';'); //NOTE: IE doesn't seem to mind ';' as non-empty
		len = _sheet[_rules].length;
		for(var i=len-1; i>=last; i--) {
			selector.push(_sheet[_rules][i].selectorText);
			deleteRule.call(_sheet, i);
		}
		return selector.reverse().join(', ');
	}
	
	/**
	 * @function matchSelector
	 * Matches given selector to selectorText of cssRule
	 * @param {CSSStyleRule} cssRule to match with
	 * @param {String} selectorText selector string to compare
	 * @param {Boolean} matchGroups when true, selector is matched in grouped style rules
	 * @returns true if selectorText of cssRule matches given selector, false otherwise
	 */
	function matchSelector(cssRule, selectorText, matchGroups) {
		if($.type(cssRule.selectorText) !== 'string') {
			return false;
		}
		
		if(cssRule.selectorText === selectorText) {
			return true;
		} else if (matchGroups === true) {
			return $($.map(cssRule.selectorText.split(','), $.trim)).filter(function(i) {
				return this.toString() === selectorText;
			}).length > 0;
		} else {
			return false;
		}
	}
	
	/**
	 * @function vendorPropName
	 * Vendor prefixed style property name.
	 * Based on similar function in jQuery library.
	 * @param {String} name camelCased CSS property name
	 * @returns {String} Vendor specific tag prefixed style name
	 * if found in styles, else passed name as-is
	 * @see vendorPrefixes
	 * @see _styles
	 */
	function vendorPropName(name) {
		var titleName = name[0].toUpperCase() + name.slice(1),
			styleName, i = vendorPrefixes.length;
		while( --i ) {
			styleName = vendorPrefixes[i] + titleName;
			if(styleName in _styles) {
				return styleName;
			}
		}
		return name;
	}
	
	/**
	 * @function normalizeRule
	 * Normalizes the CSSStyleRule object to work better across browsers
	 * @param {CSSStyleRule} rule CSSStyleRule object to be normalized
	 * @param {StyleSheet} styleSheet parent stylesheet of the rule
	 * @returns {CSSStyleRule} normalized CSSStyleRule
	 */
	function normalizeRule(rule, styleSheet) {
		//NOTE: this is experimental, however, it does have it's benefits
		//      for use with $.animate(), be sure to include jquery.stylesheet-animate.js as well
		//TODO: move some of the defaults used here to user options
		rule.ownerDocument = rule.ownerDocument || document; //XXX: Hack for jQuery.isHidden()
		rule.nodeType = rule.nodeType || 1; //XXX: Hack for jQuery's defaultPrefilter()
		rule.nodeName = rule.nodeName || 'DIV'; //XXX: Hack for jQuery's acceptData()
		rule.parentNode = rule.parentNode || styleSheet.ownerNode || styleSheet.owningElement; //XXX: Hack for jQuery.contains()
		rule.parentStyleSheet = rule.parentStyleSheet || styleSheet; //XXX: Fix for IE7
		return rule;
	}
	/*
	 * Checking for 'instanceof CSSStyleRule' fails in IE7 but not in IE8, however, the call to normalizeRule() fails in both.
	 * So, we will define our custom CSSStyleRule class on all browsers where normalizeRule() fails.
	 */
	try {
		normalizeRule(_sheet[_rules][0], _sheet);
		$.support.nativeCSSStyleRule = true;
	} catch(e) {
		$.support.nativeCSSStyleRule = false;
		CSSStyleRule = function(rule) {
			$.extend(this, rule);
			this.rule = rule; //XXX: deleteRule() requires the original object
			this.currentStyle = rule.style; //XXX: Hack for jQuery's curCSS()/getStyles() for IE7
		};
	}
	
	/**
	 * @function insertRule
	 * Cross-browser function for inserting rules
	 * @param {String} selector selectorText for the rule
	 * @param {String} css CSS property-value pair string
	 * @param {Number} index Index position to insert the string;
	 * defaults to end of rules collection
	 */
	function insertRule(selector, css, index) {
		if(!selector || !css) {
			return -1; //NOTE: IE does not like addRule(selector,'',index)
		}
		var self = this,
			_insfn = self.insertRule ? function (selector, css, index) { this.insertRule(selector+'{'+css+'}', index); } : self.addRule;
		index = index || this[_rules].length;
		try {
			return _insfn.call(self, selector, css, index);
		} catch(e) {
			$.each(selector.split(','), function(i, sel) {
				_insfn.call(self, $.trim(sel), css);
			});
			return -1;
		}
	}
	
	/**
	 * @function deleteRule
	 * Cross-browser function for deleting rules
	 * @param {Number|CSSStyleRule} Index of rule to be deleted, or
	 * reference to rule to be deleted from rules collection
	 */
	function deleteRule(rule) {
		//NOTE: If we are using our custom CSSStyleRule, then CSSStyleRule.rule is the real style rule object
		rule = (rule && rule.rule) ? rule.rule : rule;
		if(!rule) {
			return;
		}
		var self = this,
			_delfn = self.deleteRule || self.removeRule;
		if(!_delfn) { //NOTE: IE7 has issues with rule.parentStyleSheet, so we need to search for the parent stylesheet
			$(document.styleSheets).each(function (i, styleSheet) {
				if($(styleSheet[_rules]).filter(function() {return this === rule;}).length == 1) {
					self = styleSheet;
					_delfn = self.deleteRule || self.removeRule;
					return false;
				}
			});
		}
		if($.type(rule) == 'number') {
			_delfn.call(self, rule);
		} else {
			$.each(self[_rules], function (i, _rule) {
				if(rule === _rule) {
					_delfn.call(self, i);
					return false;
				}
			});
		}
	}
	
	/**
	 * jQuery.stylesheet
	 * 
	 * Constructor/Factory method for initializing a jQuery.stylesheet object.
	 * Includes a short-cut to apply style changes immediately.
	 * @param {String} selector CSS rule selector text with optional stylesheet filter  
	 * @param {String|Array|Object} name Name of style property to get/set.
	 * Also accepts array of property names and object of name/value pairs.
	 * @param {String} value If defined, then value of the style property
	 * is updated with it. Unused when name is an object map.
	 * @returns {jQuery.stylesheet|String|Object} A new jQuery.stylesheet object
	 * if name/value is not passed, or value of property or object of name/value pairs
	 */
	$.stylesheet = function (selector, name, value) {
		if(!(this instanceof $.stylesheet)) {
			return new $.stylesheet(selector, name, value);
		}
		
		this.init(selector);
		return this.css(name, value);
	};
	
	$.extend($.stylesheet, {
		/**
		 * @function jQuery.stylesheet.cssRules
		 * @param {String} selector CSS rule selector text with optional stylesheet filter
		 * @returns {Array} Array of CSSStyleRule objects that match the selector text
		 * and pass the stylesheet filter
		 */
		cssRules: function (selector) {
			var rules = [],
				filters = parseSelector(selector);
			//NOTE: The stylesheet filter will be treated as case-sensitive
			//      The selectorText filter's case depends on the browser
			$(document.styleSheets).each(function (i, styleSheet) {
				if(filterStyleSheet(filters.styleSheet, styleSheet)) {
					$.merge(rules, $(styleSheet[_rules]).filter(function() {
						return matchSelector(this, filters.selectorText, filters.styleSheet === '*');
					}).map(function() {
						return normalizeRule($.support.nativeCSSStyleRule ? this : new CSSStyleRule(this), styleSheet);
					}));
				}
			});
			return rules.reverse();
		},
		
		/**
		 * @function jQuery.stylesheet.camelCase
		 * jQuery.camelCase is undocumented and could be removed at any point
		 * @param {String} str Hypenated string to be camelCased
		 * @returns {String} camelCased string
		 */
		camelCase: $.camelCase || function( str ) {
			return str.replace(/-([\da-z])/g, function(a){return a.toUpperCase().replace('-','');});
		},
		
		/**
		 * Normalized CSS property names
		 * jQuery.cssProps is undocumented and could be removed at any point
		 */
		cssProps: $.cssProps || {},
		
		/**
		 * @function jQuery.styesheet.cssStyleName
		 * @param {String} name Hypenated CSS property name
		 * @returns {String} camelCased or vendor specific name if found in host styles
		 */
		cssStyleName: function (name) {
			if(name) {
				var camelcasedName = $.camelCase(name);
				if(camelcasedName in _styles) {
					return camelcasedName;
				} else if (($.cssProps[name] || ($.cssProps[name] = vendorPropName(camelcasedName))) in _styles) {
					return $.cssProps[name];
				}
			}
		}
	});
	
	$.stylesheet.fn = $.stylesheet.prototype = {
		/**
		 * @function jQuery.stylesheet.fn.init
		 * Initializes a jQuery.stylesheet object.
		 * Selects a list of applicable CSS rules for given selector.
		 * @see jQuery.stylesheet.cssRules
		 * @param {String|Array|Object} selector CSS rule selector text(s)
		 * with optional stylesheet filter(s)
		 */
		init: function (selector) {
			var rules = []; /**< Array of CSSStyleRule objects matching the selector initialized with */
			
			switch($.type(selector)) {
			case 'string':
				rules = $.stylesheet.cssRules(selector);
				break;
			case 'array':
				$.each(selector, function (idx, val) {
					if($.type(val) === 'string') {
						$.merge(rules, $.stylesheet.cssRules(val));
					} else if(val instanceof CSSStyleRule) {
						rules.push(val);
					}
				});
				break;
			case 'object':
				if(selector instanceof CSSStyleRule) {
					rules.push(val);
				}
				break;
			}
			
			$.extend(this, {
				/**
				 * @function jQuery.stylesheet.rules
				 * @returns {Array} Copy of array of CSSStyleRule objects used
				 * by this instance of jQuery.stylesheet 
				 */
				rules: function() {
					return rules.slice();
				},
				
				/**
				 * @function jQuery.stylesheet.css()
				 * @param {String|Array|Object} name Name of style property to get/set.
				 * Also accepts array of property names and object of name/value pairs.
				 * @param {String} value If defined, then value of the style property
				 * is updated with it. Unused when name is an object map.
				 * @returns {jQuery.stylesheet|String|Object} A new jQuery.stylesheet object
				 * if name/value is not passed, or value of property or object of name/value pairs
				 */
				css: function (name, value) {
					var self = this, styles = undefined;
					
					switch($.type(name)) {
					case 'null':
						$.each(rules, function (idx, rule) {
							deleteRule.call(rule.parentStyleSheet, rule);
						});
						//NOTE: Safari seems to replace the rules collection object on insert/delete
						//      Refresh our private collection to reflect the changes
						rules = $.stylesheet.cssRules(selector);
						return self;
					case 'string':
						var stylename = $.stylesheet.cssStyleName(name);
						if(stylename) {
							if(rules.length === 0 && value !== undefined) {
								var filters = parseSelector(selector),
									sheet = $(document.styleSheets).filter(function () {
										return filterStyleSheet(filters.styleSheet, this);
									});
								sheet = (sheet && sheet.length == 1) ? sheet[0] : _sheet;
								insertRule.call(sheet, filters.selectorText, name+':'+value+';');
								//NOTE: See above note on Safari
								//      Also, IE has different behaviour for grouped selectors 
								rules = $.stylesheet.cssRules(selector);
								styles = self;
							} else {
								$.each(rules, function (i, rule) {
									if(rule.style[stylename] !== '') {
										if(value !== undefined) {
											rule.style[stylename] = value;
											styles = self;
										} else {
											styles = rule.style[stylename];
										}
										return false;
									}
								});
								if(styles === undefined && value !== undefined) {
									rules[0].style[stylename] = value;
									styles = self;
								}
							}
						}
						break;
					case 'array':
						styles = {};
						$.each(name, function (idx, key) {
							styles[key] = self.css(key, value);
						});
						if(value !== undefined) {
							styles = self;
						}
						break;
					case 'object':
						$.each(name, function (key, val) {
							self.css(key, val);
						});
						return self;
					default: /*undefined*/
						return self;
					}
					
					return styles;
				}
			});
		}
	};
}));
// vi:sw=2:ts=2
 
jQuery(document).ready(function( $ ) {
	
	/**
	 * Customizer dependency function, to show/hide fields.
	 */
	function showControlIfhasValues( setting, ExpectedValues  ) {

		return function( control ) {

		//	Check the current value in the array of ExpectedValues
		var isDisplayed = function() {
			return $.inArray( setting.get(), ExpectedValues ) !== -1;
		};
		//console.log('status: '+ $.inArray( setting.get(), ExpectedValues ) !== -1);
			
		var setActiveState = function() {
			control.active.set( isDisplayed() );
		};

		control.active.validate = isDisplayed;
		setActiveState();
		setting.bind( setActiveState );
		};
	}

	//Nested dependancy
	function showControlIfhasValues2( setting, ExpectedValues, setting2, ExpectedValues2  ) {

		return function( control ) {

		//	Check the current value in the array of ExpectedValues
		var isDisplayed = function() {
			return $.inArray( setting.get(), ExpectedValues ) !== -1 && $.inArray( wp.customize.value( setting2 )(), ExpectedValues2 ) !== -1;
		};
	//	console.log('status: '+ $.inArray( setting.get(), ExpectedValues ) !== -1);
		var setActiveState = function() {
			control.active.set( isDisplayed() );
		};

		control.active.validate = isDisplayed;
		setActiveState();
		setting.bind( setActiveState );
		};
	}
	
	//Nested dependancy manual 3
	function showControlIfhasValues3( setting, ExpectedValues, setting2, ExpectedValues2, setting3, ExpectedValues3 ) {

		return function( control ) {

		//	Check the current value in the array of ExpectedValues
		var isDisplayed = function() {
			return $.inArray( setting.get(), ExpectedValues ) !== -1 && $.inArray( wp.customize.value( setting2 )(), ExpectedValues2 ) !== -1 && $.inArray( wp.customize.value( setting3 )(), ExpectedValues3 ) !== -1;
		};
	//	console.log('status: '+ $.inArray( setting.get(), ExpectedValues ) !== -1);
		var setActiveState = function() {
			control.active.set( isDisplayed() );
		};

		control.active.validate = isDisplayed;
		setActiveState();
		setting.bind( setActiveState );
		};
	}

/**
 * 
 * Customizer Dependencies:
 * 
 */
	
/**
 * Site Container
 */	
	wp.customize( 'dp_site_layout', function( setting ) {
		wp.customize.control( 'dp_site_container_width', showControlIfhasValues( setting, ['1', '2']) );
	} );
	
	wp.customize( 'dp_site_container_border_style', function( setting ) {
		wp.customize.control( 'dp_site_container_border_width_left_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_site_container_border_width_top_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_site_container_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	wp.customize( 'dp_site_container_color_style', function( setting ) {
		wp.customize.control( 'dp_site_container_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_site_container_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_site_container_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_site_container_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_site_container_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_site_container_color_style', ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_site_container_color_style', ['2', '3']) );
		wp.customize.control( 'dp_site_container_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_site_container_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_site_container_img_panel', function( setting ) {
		wp.customize.control( 'dp_site_container_pattern', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_site_container_img_upload', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_site_container_img_repeat', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_site_container_img_size', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_site_container_img_attachment', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_site_container_img_position', showControlIfhasValues( setting, ['3']) );
	} );
	
	
/**
 * Site Layout
 */	

	wp.customize( 'dp_site_layout_post_toggle', function( setting ) {
		wp.customize.control( 'dp_site_layout_post', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_divider_site_layout_2', showControlIfhasValues( setting, [true, '1']) );
	} );
	
	wp.customize( 'dp_site_layout_page_toggle', function( setting ) {
		wp.customize.control( 'dp_site_layout_page', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_divider_site_layout_3', showControlIfhasValues( setting, [true, '1']) );
	} );
	
	wp.customize( 'dp_site_layout_category_toggle', function( setting ) {
		wp.customize.control( 'dp_site_layout_category', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_divider_site_layout_4', showControlIfhasValues( setting, [true, '1']) );
	} );
	
/**
 *  Background
 */	
	wp.customize( 'dp_bg_color_style', function( setting ) {
		wp.customize.control( 'dp_bg_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_bg_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_bg_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_bg_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_bg_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_bg_color_style', ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_bg_color_style', ['2', '3']) );
		wp.customize.control( 'dp_bg_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_bg_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_bg_img_panel', function( setting ) {
		wp.customize.control( 'dp_bg_pattern', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_bg_img_upload', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_bg_img_repeat', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_bg_img_size', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_bg_img_attachment', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_bg_img_position', showControlIfhasValues( setting, ['3']) );
	} );
	
	
	/**
 *  Background 2
 */	
	wp.customize( 'dp_bg2_height_panel', function( setting ) {
		wp.customize.control( 'dp_bg2_height', showControlIfhasValues( setting, ['4']) );
		wp.customize.control( 'dp_background2_divider', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_background2_divider1', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_color_style', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_color', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_color2', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_shade_strenght', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_gradient_style', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3', '4']) );
		
		wp.customize.control( 'dp_background2_divider2', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_panel', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_pattern', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_upload', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_repeat', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_size', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_attachment', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_img_position', showControlIfhasValues( setting, ['2', '3', '4']) );
		
		wp.customize.control( 'dp_background2_divider3', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_background2_divider4', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_background2_divider5', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_background2_divider6', showControlIfhasValues( setting,['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_border_bottom_size', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_border_bottom_color', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_shadow_bottom_vertical', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_shadow_bottom_blur_radius', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_shadow_bottom_spread_radius', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_shadow_bottom_opacity', showControlIfhasValues( setting, ['2', '3', '4']) );
		wp.customize.control( 'dp_bg2_blur', showControlIfhasValues( setting, ['2', '3', '4']) );
	} );
	
	wp.customize( 'dp_bg2_color_style', function( setting ) {
		wp.customize.control( 'dp_bg2_color2', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_shade_strenght', showControlIfhasValues2( setting, ['2'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_style', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_advanced_toggle', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
	} );
	
	wp.customize( 'dp_bg2_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
	} );

	wp.customize( 'dp_bg2_img_panel', function( setting ) {
		wp.customize.control( 'dp_bg2_pattern', showControlIfhasValues2( setting, ['2'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_img_upload', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_img_repeat', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_img_size', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_img_attachment', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_img_position', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
	} );
	
	
	/**
 *  Header Logo
 */	
	
// 	wp.customize( 'dp_header_logo_toggle', function( setting ) {
		
// 		wp.customize.control( 'dp_header_logo_upload', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_width', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_area_width', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_margin_right', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_divider2', showControlIfhasValues( setting, [true, '1']) );
		
// 		wp.customize.control( 'dp_header_logo_title_toggle', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_custom', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_font_family_toggle', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_font_family', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_font_size', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_font_weight', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_color', showControlIfhasValues( setting,[true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_style', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_title_margin_bottom', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_divider3', showControlIfhasValues( setting, [true, '1']) );
		
// 		wp.customize.control( 'dp_header_logo_tagline_toggle', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_custom', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_font_family_toggle', showControlIfhasValues( setting,[true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_font_family', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_font_size', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_font_weight', showControlIfhasValues( setting,[true, '1']) );
// 		wp.customize.control( 'dp_header_logo_tagline_color', showControlIfhasValues( setting, [true, '1']) );
// 		wp.customize.control( 'dp_header_logo_divider4', showControlIfhasValues( setting, [true, '1']) );
// 	} );
	
	wp.customize( 'dp_header_logo_title_toggle', function( setting ) {
		wp.customize.control( 'dp_header_logo_title_custom', showControlIfhasValues( setting, ['3'] ) );
		wp.customize.control( 'dp_header_logo_title_font_family_toggle', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_font_family', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_font_size', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_font_weight', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_color', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_style', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_title_margin_bottom', showControlIfhasValues( setting, ['2', '3'] ) );
	} );
	
	wp.customize( 'dp_header_logo_title_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_header_logo_title_font_family', showControlIfhasValues2( setting, [false, '0'], 'dp_header_logo_title_toggle', ['2', '3'] ) );
	} );
	
	wp.customize( 'dp_header_logo_tagline_toggle', function( setting ) {
		wp.customize.control( 'dp_header_logo_tagline_custom', showControlIfhasValues( setting, ['3'] ) );
		wp.customize.control( 'dp_header_logo_tagline_font_family_toggle', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_tagline_font_family', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_tagline_font_size', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_tagline_font_weight', showControlIfhasValues( setting, ['2', '3'] ) );
		wp.customize.control( 'dp_header_logo_tagline_color', showControlIfhasValues( setting, ['2', '3'] ) );
	} );
	
	wp.customize( 'dp_header_logo_tagline_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_header_logo_tagline_font_family', showControlIfhasValues2( setting, [false, '0'], 'dp_header_logo_tagline_toggle', ['2', '3'] ) );
	} );

	
	/**
 *  Header
 */	
	wp.customize( 'dp_header_color_style', function( setting ) {
		wp.customize.control( 'dp_header_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_header_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_header_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_header_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_header_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_header_color_style', ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_header_color_style', ['2', '3']) );
		wp.customize.control( 'dp_header_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_header_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_header_img_panel', function( setting ) {
		wp.customize.control( 'dp_header_pattern', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_header_img_upload', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_header_img_repeat', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_header_img_size', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_header_img_attachment', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_header_img_position', showControlIfhasValues( setting, ['3']) );
	} );
	
	wp.customize( 'dp_header_border_style', function( setting ) {
		wp.customize.control( 'dp_header_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_header_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_header_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_header_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_header_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	/**
 *  Primary Menu
 */
	
	// Align First/Last Item with Site Content
	wp.customize( 'dp_primary_menu_boxed', function( setting ) {
		wp.customize.control( 'dp_primary_menu_item_alignment_padding', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	//Background Color
	wp.customize( 'dp_primary_menu_bg_color_style', function( setting ) {
		wp.customize.control( 'dp_primary_menu_bg_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_primary_menu_bg_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );

	wp.customize( 'dp_primary_menu_bg_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_bg_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_color_style', ['2', '3']) );
	} );
	
	//Background Color active
	wp.customize( 'dp_primary_menu_bg_active_color_style', function( setting ) {
		wp.customize.control( 'dp_primary_menu_bg_active_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_menu_bg_active_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_active_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_active_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_menu_bg_active_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_bg_active_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_menu_border_style', function( setting ) {
		wp.customize.control( 'dp_primary_menu_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_menu_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_menu_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_menu_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_menu_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	// Primary Menu Dividers
	wp.customize( 'dp_primary_menu_item_dividers', function( setting ) {
		wp.customize.control( 'dp_primary_menu_item_dividers_firstchild', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_item_dividers_lastchild', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_item_dividers_top', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_item_dividers_bottom', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_item_dividers_color_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_item_dividers_color', showControlIfhasValues( setting, ['1', '2'] ) );
	} );
	
	wp.customize( 'dp_primary_menu_item_dividers_color_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_item_dividers_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_item_dividers', ['1', '2']) );
	} );
	
	wp.customize( 'dp_primary_menu_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_font_family', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	
// 	wp.customize( 'dp_primary_menu_sticky', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_menu_width', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_shadow_bottom', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_border', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_font_size_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_font_size', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_height_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_height', showControlIfhasValues( setting, ['1', '2'] ) );
// 		//wp.customize.control( 'dp_primary_menu_sticky_item_padding_left_right_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
// 		//wp.customize.control( 'dp_primary_menu_sticky_item_padding_left_right', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color_style', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color2', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_shade_strenght', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_style', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_advanced_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter1', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter2', showControlIfhasValues( setting, ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_reverse_color', showControlIfhasValues( setting, ['1', '2'] ) );
// 	} );
	
// 	wp.customize( 'dp_primary_menu_sticky_font_size_toggle', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_font_size', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 	} );
	
// 	wp.customize( 'dp_primary_menu_sticky_height_toggle', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_height', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 	} );
	
// 	wp.customize( 'dp_primary_menu_sticky_bg_color_toggle', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color_style', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 	} );
	
// 	//Background Color Sticky Primary Menu
// 	wp.customize( 'dp_primary_menu_sticky_bg_color_toggle', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color_style', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color2', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_shade_strenght', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_style', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_advanced_toggle', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky',  ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter1', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter2', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_reverse_color', showControlIfhasValues2( setting,  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 	} );
	
// 	wp.customize( 'dp_primary_menu_sticky_bg_color_style', function( setting ) {
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_color2', showControlIfhasValues3( setting, ['3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_shade_strenght', showControlIfhasValues3( setting, ['2'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_style', showControlIfhasValues3( setting, ['2', '3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_advanced_toggle', showControlIfhasValues3( setting, ['2', '3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky',  ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter1', showControlIfhasValues3( setting, ['2', '3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_position_parameter2', showControlIfhasValues3( setting, ['2', '3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 		wp.customize.control( 'dp_primary_menu_sticky_bg_gradient_reverse_color', showControlIfhasValues3( setting, ['2', '3'], 'dp_primary_menu_sticky_bg_color_toggle',  [true, '1'], 'dp_primary_menu_sticky', ['1', '2'] ) );
// 	} );
	
// 	wp.customize( 'dp_bg2_gradient_advanced_toggle', function( setting ) {
// 		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
// 		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
// 		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
// 	} );
	
	/*
		wp.customize( 'dp_bg2_color_style', function( setting ) {
		wp.customize.control( 'dp_bg2_color2', showControlIfhasValues2( setting, ['3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_shade_strenght', showControlIfhasValues2( setting, ['2'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_style', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_advanced_toggle', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues2( setting, ['2', '3'], 'dp_bg2_height_panel', ['2', '3', '4'] ) );
	} );
	
	wp.customize( 'dp_bg2_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_bg2_gradient_position_parameter1', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
		wp.customize.control( 'dp_bg2_gradient_position_parameter2', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
		wp.customize.control( 'dp_bg2_gradient_reverse_color', showControlIfhasValues3( setting, [true, '1'], 'dp_bg2_height_panel', ['2', '3', '4'], 'dp_bg2_color_style', ['2', '3'] ) );
	} );
	*/
//	wp.customize( 'dp_primary_menu_sticky_item_padding_left_right_toggle', function( setting ) {
//		wp.customize.control( 'dp_primary_menu_sticky_item_padding_left_right', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_sticky', ['1', '2']) );
//	} );
	
	
	wp.customize( 'dp_primary_menu_shadow_bottom_style', function( setting ) {
		wp.customize.control( 'dp_primary_menu_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
		wp.customize.control( 'dp_primary_menu_shadow_bottom_vertical', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_menu_shadow_bottom_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_menu_shadow_bottom_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_menu_shadow_bottom_opacity', showControlIfhasValues( setting, ['custom'] ) );
	} );
	
	
	wp.customize( 'dp_primary_menu_search_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_search_opening_divider', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_closing_divider', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_padding_left', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_padding_right', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_font_size_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_font_size', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_field_height_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_field_height', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_field_width', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_border_radius', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_border_toggle', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_border_color', showControlIfhasValues( setting, ['1', '2'] ) );
		wp.customize.control( 'dp_primary_menu_search_submit_font_color', showControlIfhasValues( setting, ['1', '2'] ) );
	} );
	
	wp.customize( 'dp_primary_menu_search_font_size_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_search_font_size', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_search_toggle', ['1', '2']) );
	} );
	
	wp.customize( 'dp_primary_menu_search_field_height_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_search_field_height', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_menu_search_toggle', ['1', '2']) );
	} );
	
	
	// Primary Menu Logo
	wp.customize( 'dp_primary_menu_logo_toggle', function( setting ) {
		
		wp.customize.control( 'dp_primary_menu_logo_upload', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_width', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_margin_right', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_padding_left', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_padding_right', showControlIfhasValues( setting, [true, '1']) );
		//wp.customize.control( 'dp_primary_menu_logo_title_area_width', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_divider2', showControlIfhasValues( setting, [true, '1']) );
		
		wp.customize.control( 'dp_primary_menu_logo_title_toggle', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_custom', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_family_toggle', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_family', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_size', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_weight', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_color', showControlIfhasValues( setting,[true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_style', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_margin_bottom', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_divider3', showControlIfhasValues( setting, [true, '1']) );
		
		wp.customize.control( 'dp_primary_menu_logo_tagline_toggle', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_custom', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_family_toggle', showControlIfhasValues( setting,[true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_family', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_size', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_weight', showControlIfhasValues( setting,[true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_color', showControlIfhasValues( setting, [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_divider4', showControlIfhasValues( setting, [true, '1']) );
	} );
	
	wp.customize( 'dp_primary_menu_logo_title_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_logo_title_custom', showControlIfhasValues2( setting, ['3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_family_toggle', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_family', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_size', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_font_weight', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_color', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_style', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_title_margin_bottom', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
	} );
	
	wp.customize( 'dp_primary_menu_logo_title_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_logo_title_font_family', showControlIfhasValues3( setting, [false, '0'], 'dp_primary_menu_logo_title_toggle', ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1'] ) );
	} );
	
	wp.customize( 'dp_primary_menu_logo_tagline_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_logo_tagline_custom', showControlIfhasValues2( setting, ['3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_family_toggle', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_family', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_size', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_weight', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
		wp.customize.control( 'dp_primary_menu_logo_tagline_color', showControlIfhasValues2( setting, ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1']) );
	} );
	
	wp.customize( 'dp_primary_menu_logo_tagline_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_menu_logo_tagline_font_family', showControlIfhasValues3( setting, [false, '0'], 'dp_primary_menu_logo_tagline_toggle', ['2', '3'], 'dp_primary_menu_logo_toggle', [true, '1'] ) );
	} );
	
	
	/**
	 * Primary Sidebar
	 */
	wp.customize( 'dp_primary_sidebar_width', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_width_custom', showControlIfhasValues( setting, ['custom']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_color_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_primary_sidebar_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_border_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_shadow_bottom_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
		wp.customize.control( 'dp_primary_sidebar_shadow_bottom_horizontal', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_shadow_bottom_vertical', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_shadow_bottom_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_shadow_bottom_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_shadow_bottom_opacity', showControlIfhasValues( setting, ['custom'] ) );
	} );
	
	/**
	 * Primary Sidebar Widgets
	 */
	wp.customize( 'dp_primary_sidebar_widgets_color_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_border_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_shadow_bottom_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_bottom_horizontal', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_bottom_vertical', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_bottom_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_bottom_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_shadow_bottom_opacity', showControlIfhasValues( setting, ['custom'] ) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_font_family', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	/**
	 * Primary Sidebar Widgets Title
	 */
	wp.customize( 'dp_primary_sidebar_widgets_title_color_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_title_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_title_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_title_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_title_color_style', ['2', '3']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_primary_sidebar_widgets_title_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_title_border_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_title_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_title_shadow_bottom_style', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_bottom_vertical', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
		wp.customize.control( 'dp_primary_sidebar_widgets_title_shadow_bottom_opacity', showControlIfhasValues( setting, ['custom'] ) );
	} );
	
	wp.customize( 'dp_primary_sidebar_widgets_title_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_primary_sidebar_widgets_title_font_family', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	
	/**
 *  Footer
 */	
	wp.customize( 'dp_footer_color_style', function( setting ) {
		wp.customize.control( 'dp_footer_color2', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_footer_shade_strenght', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_footer_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
	} );
	
	wp.customize( 'dp_footer_gradient_advanced_toggle', function( setting ) {
		wp.customize.control( 'dp_footer_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_footer_color_style', ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_footer_color_style', ['2', '3']) );
		wp.customize.control( 'dp_footer_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_footer_color_style', ['2', '3']) );
	} );
	
	wp.customize( 'dp_footer_img_panel', function( setting ) {
		wp.customize.control( 'dp_footer_pattern', showControlIfhasValues( setting, ['2']) );
		wp.customize.control( 'dp_footer_img_upload', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_footer_img_repeat', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_footer_img_size', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_footer_img_attachment', showControlIfhasValues( setting, ['3']) );
		wp.customize.control( 'dp_footer_img_position', showControlIfhasValues( setting, ['3']) );
	} );
	
	wp.customize( 'dp_footer_border_style', function( setting ) {
		wp.customize.control( 'dp_footer_border_width_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_footer_border_width_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_footer_border_width_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_footer_border_width_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
		wp.customize.control( 'dp_footer_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
	} );
	
	wp.customize( 'dp_footer_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_footer_font_family', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	wp.customize( 'dp_footer_widget_title_font_family_toggle', function( setting ) {
		wp.customize.control( 'dp_footer_widget_title_font_family', showControlIfhasValues( setting, [false, '0'] ) );
	} );
	
	/**
 *  Front Page Grid
 */
	wp.customize( 'dp_front_page_grid_item_nth_toggle', function( setting ) {
		wp.customize.control( 'dp_front_page_grid_item_nth_limit', showControlIfhasValues( setting, [true, '1'] ) );
		//wp.customize.control( 'dp_front_page_grid_item_nth_selector', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_items_nth_per_line', showControlIfhasValues( setting, [true, '1'] ) );
		//wp.customize.control( 'dp_front_page_grid_item_nth_border_radius', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_title_background_height', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_title_background_color', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_title_font_color', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_meta_font_color', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_title_font_size', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_title_font_weight', showControlIfhasValues( setting, [true, '1'] ) );
		wp.customize.control( 'dp_front_page_grid_item_nth_meta_font_size', showControlIfhasValues( setting, [true, '1'] ) );
	} );



    /**
     * Page
     */
    wp.customize( 'dp_page_color_style', function( setting ) {
        wp.customize.control( 'dp_page_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_page_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_page_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_page_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_page_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_page_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_page_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_page_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_page_border_style', function( setting ) {
        wp.customize.control( 'dp_page_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_page_shadow_style', function( setting ) {
        wp.customize.control( 'dp_page_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_page_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

// wp.customize( 'dp_page_typography_toggle', function( setting ) {
    //     wp.customize.control( 'dp_page_font_size', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_font_weight', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_font_line_height', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_font_color', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_link_color', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_link_color_hover', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_link_underline', showControlIfhasValues( setting, [false, '0']) );
    //     wp.customize.control( 'dp_page_link_hover_underline', showControlIfhasValues( setting, [false, '0']) );
    // } );
    //
    // wp.customize( 'dp_page_font_family_toggle', function( setting ) {
    //     wp.customize.control( 'dp_page_font_family', showControlIfhasValues( setting, [false, '0']) );
    // } );

	/**
	 * Page Featured Image
	 */
    wp.customize( 'dp_page_featured_image_color_style', function( setting ) {
        wp.customize.control( 'dp_page_featured_image_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_page_featured_image_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_page_featured_image_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_page_featured_image_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_page_featured_image_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_page_featured_image_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_page_featured_image_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_featured_image_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_page_featured_image_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_page_featured_image_border_style', function( setting ) {
        wp.customize.control( 'dp_page_featured_image_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_featured_image_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_featured_image_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_featured_image_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_featured_image_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_page_featured_image_shadow_style', function( setting ) {
        wp.customize.control( 'dp_page_featured_image_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_page_featured_image_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_featured_image_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_featured_image_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_featured_image_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_featured_image_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

    /**
     * Page Header
     */
    wp.customize( 'dp_page_header_color_style', function( setting ) {
        wp.customize.control( 'dp_page_header_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_page_header_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_page_header_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_page_header_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_page_header_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_header_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_page_header_border_style', function( setting ) {
        wp.customize.control( 'dp_page_header_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_page_header_shadow_style', function( setting ) {
        wp.customize.control( 'dp_page_header_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_page_header_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

    /**
     * Page Header Meta
     */
    wp.customize( 'dp_page_header_meta_color_style', function( setting ) {
        wp.customize.control( 'dp_page_header_meta_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_page_header_meta_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_page_header_meta_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_page_header_meta_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_page_header_meta_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_meta_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_meta_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_header_meta_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_page_header_meta_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_page_header_meta_border_style', function( setting ) {
        wp.customize.control( 'dp_page_header_meta_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_meta_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_meta_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_meta_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_header_meta_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_page_header_meta_shadow_style', function( setting ) {
        wp.customize.control( 'dp_page_header_meta_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_page_header_meta_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_meta_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_meta_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_meta_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_header_meta_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

    /**
     * Page Category
     */
    wp.customize( 'dp_page_category_color_style', function( setting ) {
        wp.customize.control( 'dp_page_category_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_page_category_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_page_category_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_page_category_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_page_category_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_page_category_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_page_category_color_style', ['2', '3']) );
        wp.customize.control( 'dp_page_category_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_page_category_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_page_category_border_style', function( setting ) {
        wp.customize.control( 'dp_page_category_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_category_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_category_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_category_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_page_category_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_page_category_shadow_style', function( setting ) {
        wp.customize.control( 'dp_page_category_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_page_category_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_category_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_category_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_category_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_page_category_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
     * Blog Roll
     */
    wp.customize( 'dp_blog_roll_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );



    /**
     * Archive Title
     */
    wp.customize( 'dp_archive_title_color_style', function( setting ) {
        wp.customize.control( 'dp_archive_title_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_archive_title_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_archive_title_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_archive_title_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_archive_title_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_archive_title_color_style', ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_archive_title_color_style', ['2', '3']) );
        wp.customize.control( 'dp_archive_title_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_archive_title_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_archive_title_border_style', function( setting ) {
        wp.customize.control( 'dp_archive_title_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_archive_title_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_archive_title_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_archive_title_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_archive_title_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_archive_title_shadow_style', function( setting ) {
        wp.customize.control( 'dp_archive_title_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_archive_title_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_archive_title_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_archive_title_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_archive_title_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_archive_title_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
     * Blog Roll Wrap
     */
    wp.customize( 'dp_blog_roll_wrap_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_wrap_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_wrap_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_wrap_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_wrap_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_wrap_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_wrap_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_wrap_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_wrap_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_wrap_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_wrap_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_wrap_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_wrap_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_wrap_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_wrap_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_wrap_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_wrap_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_wrap_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_wrap_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_wrap_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_wrap_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_wrap_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

    /**
     * Blog Roll Container 1
     */
    wp.customize( 'dp_blog_roll_container_1_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_1_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_container_1_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_1_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_1_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_1_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_1_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_1_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_1_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_1_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_1_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_1_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_1_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_1_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_1_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_container_1_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_1_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_container_1_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_1_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_1_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_1_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_1_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
     * Blog Roll Container 2
     */
    wp.customize( 'dp_blog_roll_container_2_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_2_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_container_2_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_2_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_2_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_2_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_2_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_2_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_2_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_2_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_2_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_2_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_2_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_2_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_2_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_container_2_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_2_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_container_2_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_2_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_2_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_2_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_2_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
     * Blog Roll Container 3
     */
    wp.customize( 'dp_blog_roll_container_3_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_3_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_container_3_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_3_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_3_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_3_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_3_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_container_3_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_container_3_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_container_3_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_3_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_3_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_3_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_3_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_container_3_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_container_3_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_container_3_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_container_3_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_3_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_3_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_3_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_container_3_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
     * Blog Roll Title
     */
    wp.customize( 'dp_blog_roll_title_height_auto', function( setting ) {
        wp.customize.control( 'dp_blog_roll_title_height', showControlIfhasValues( setting, ['0', false]) );
    } );
    wp.customize( 'dp_blog_roll_title_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_title_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_title_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_title_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_title_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_title_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_title_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_title_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_title_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_title_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_title_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_title_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_title_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_title_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_title_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_title_location', function( setting ) {
        wp.customize.control( 'dp_blog_roll_title_location_inside_image_vertical', showControlIfhasValues( setting, ['disruptpress_blog_roll_featured_image'] ) );
        wp.customize.control( 'dp_blog_roll_title_location_inside_image_horizontal', showControlIfhasValues( setting, ['disruptpress_blog_roll_featured_image'] ) );
    } );

    // wp.customize( 'dp_blog_roll_title_shadow_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_title_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
    //     wp.customize.control( 'dp_blog_roll_title_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_title_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_title_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_title_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_title_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    // } );


    /**
     * Blog Roll Featured Image
     */

    wp.customize( 'dp_blog_roll_featured_image_width_100', function( setting ) {
        wp.customize.control( 'dp_blog_roll_featured_image_width', showControlIfhasValues( setting, ['0', false]) );
    } );

    // wp.customize( 'dp_blog_roll_featured_image_color_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_featured_image_color2', showControlIfhasValues( setting, ['3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_shade_strenght', showControlIfhasValues( setting, ['2']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    // } );
    //
    // wp.customize( 'dp_blog_roll_featured_image_gradient_advanced_toggle', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_featured_image_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_featured_image_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_featured_image_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_featured_image_color_style', ['2', '3']) );
    // } );

    wp.customize( 'dp_blog_roll_featured_image_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_featured_image_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_featured_image_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_featured_image_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_featured_image_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_featured_image_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_featured_image_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_featured_image_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );



    /**
     * Blog Roll Excerpt
     */

    wp.customize( 'dp_blog_roll_excerpt_height_auto', function( setting ) {
        wp.customize.control( 'dp_blog_roll_excerpt_height', showControlIfhasValues( setting, ['0', false]) );
    } );
    wp.customize( 'dp_blog_roll_excerpt_color_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_excerpt_color2', showControlIfhasValues( setting, ['3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_shade_strenght', showControlIfhasValues( setting, ['2']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_excerpt_gradient_advanced_toggle', function( setting ) {
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_excerpt_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_excerpt_color_style', ['2', '3']) );
        wp.customize.control( 'dp_blog_roll_excerpt_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_excerpt_color_style', ['2', '3']) );
    } );

    wp.customize( 'dp_blog_roll_excerpt_border_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_excerpt_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_excerpt_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_excerpt_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_excerpt_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_blog_roll_excerpt_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_blog_roll_excerpt_shadow_style', function( setting ) {
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_blog_roll_excerpt_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );

    /**
     * Slider
     */

    wp.customize( 'dp_slider_enabled', function( setting ) {
        wp.customize.control( 'dp_slider_width', showControlIfhasValues( setting, ['1', true]) );
        wp.customize.control( 'dp_slider_aspect_radio', showControlIfhasValues( setting, ['1', true]) );
        wp.customize.control( 'dp_slider_sidebar_items', showControlIfhasValues( setting, ['1', true]) );
    } );

    wp.customize( 'dp_slider_aspect_radio', function( setting ) {
        wp.customize.control( 'dp_slider_sidebar_items', showControlIfhasValues2( setting, ['169'], 'dp_slider_enabled', ['1', true]) );
    } );


    /**
     * Blog Roll Meta
     */
    // wp.customize( 'dp_blog_roll_meta_color_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_meta_color2', showControlIfhasValues( setting, ['3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_shade_strenght', showControlIfhasValues( setting, ['2']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_gradient_advanced_toggle', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_meta_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_meta_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_meta_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_meta_color_style', ['2', '3']) );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_border_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_meta_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_meta_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_meta_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_meta_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_meta_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    // } );
    //
    // wp.customize( 'dp_blog_roll_meta_shadow_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_meta_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    // } );


    /**
     * Blog Roll Category
     */
    // wp.customize( 'dp_blog_roll_category_color_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_category_color2', showControlIfhasValues( setting, ['3']) );
    //     wp.customize.control( 'dp_blog_roll_category_shade_strenght', showControlIfhasValues( setting, ['2']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_style', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_advanced_toggle', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_position_parameter1', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_position_parameter2', showControlIfhasValues( setting, ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_reverse_color', showControlIfhasValues( setting, ['2', '3']) );
    // } );
    //
    // wp.customize( 'dp_blog_roll_category_gradient_advanced_toggle', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_category_gradient_position_parameter1', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_category_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_position_parameter2', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_category_color_style', ['2', '3']) );
    //     wp.customize.control( 'dp_blog_roll_category_gradient_reverse_color', showControlIfhasValues2( setting, [true, '1'], 'dp_blog_roll_category_color_style', ['2', '3']) );
    // } );

    // wp.customize( 'dp_blog_roll_category_border_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_category_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_category_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_category_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_category_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    //     wp.customize.control( 'dp_blog_roll_category_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    // } );

    // wp.customize( 'dp_blog_roll_category_shadow_style', function( setting ) {
    //     wp.customize.control( 'dp_blog_roll_category_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
    //     wp.customize.control( 'dp_blog_roll_category_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_category_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_category_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_category_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
    //     wp.customize.control( 'dp_blog_roll_category_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    // } );



    /**
     * Pagination
     */

    wp.customize( 'dp_pagination_border_style', function( setting ) {
        wp.customize.control( 'dp_pagination_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_pagination_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_pagination_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_pagination_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_pagination_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

		/**
     * WooCommerce Category
     */

		wp.customize( 'dp_woocommerce_category_border_style', function( setting ) {
        wp.customize.control( 'dp_woocommerce_category_border_top', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_woocommerce_category_border_right', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_woocommerce_category_border_bottom', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_woocommerce_category_border_left', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
        wp.customize.control( 'dp_woocommerce_category_border_color', showControlIfhasValues( setting, ['solid', 'dotted', 'dashed']) );
    } );

    wp.customize( 'dp_woocommerce_category_shadow_style', function( setting ) {
        wp.customize.control( 'dp_woocommerce_category_shadow_presets', showControlIfhasValues( setting, ['presets'] ) );
        wp.customize.control( 'dp_woocommerce_category_shadow_horizontal', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_woocommerce_category_shadow_vertical', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_woocommerce_category_shadow_blur_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_woocommerce_category_shadow_spread_radius', showControlIfhasValues( setting, ['custom'] ) );
        wp.customize.control( 'dp_woocommerce_category_shadow_opacity', showControlIfhasValues( setting, ['custom'] ) );
    } );


    /**
	 * Customizer generator test
	 */
	$("#dp_generator").click(function(){
		
		function dp_getRandom(min, max) {
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}
		
		function round5(x, round) {
			return Math.ceil(x/round)*round;
		}
		
		var items = Array('1','2','3');
		var item = items[Math.floor(Math.random()*items.length)];
		
		kirkiSetSettingValue( 'dp_website_layout', item );
		
		if(item == "1" || item == "2") {
			kirkiSetSettingValue( 'dp_site_container_width', round5(dp_getRandom(1025,1400), 5) );
		}
		if(item == "1") {
			kirkiSetSettingValue( 'dp_site_container_padding_top_bottom', round5(dp_getRandom(0,60), 5) );
		}
	} );
	
	$("#test_generator").click(function(){
		kirkiSetSettingValue( 'dp_primary_menu_bg_color', '#FFF' );
	} );
	

// 	wp.customize( 'dp_site_layout', function( value ) {
// 		value.bind( function( newval ) {
// 			var container_width = wp.customize.value( 'dp_site_container_width' )();
// 			var padding_top_bottom = wp.customize.value( 'dp_site_container_margin_top_bottom' )();

// 			if ( newval == '1' ) {
// 				$.stylesheet('.site-container').css('max-width', container_width + 'px' );
// 				$.stylesheet('.wrap').css('max-width', container_width + 'px' );
// 			}
			
// 			if ( newval == '2' ) {
// 				$.stylesheet('.site-container').css('max-width', '100%' );
// 				$.stylesheet('.wrap').css('max-width', container_width + 'px' );	
// 			}
			
// 			if ( newval == '3' ) {
// 				$.stylesheet('.site-container').css('max-width', '100%' );	
// 				$.stylesheet('.wrap').css('max-width', '100%' );
// 			}
			
// 			//console.log('triggered');
			
// 		} );
// 	} );
		// Container Width 
// 	wp.customize( 'dp_site_container_width', function( value ) {
// 		value.bind( function( newval ) {
			
// 		//	$.stylesheet('.wrap').css('max-width', newval + 'px' );
// 			console.log('triger me');
			
// 			var dp_site_layout = wp.customize.value( 'dp_site_layout' )();
// 			kirkiSetSettingValue( 'dp_site_layout', dp_site_layout );
			
// 			//if( dp_site_layout == '1' ) {
// 		//		$.stylesheet('.site-container').css('max-width', newval + 'px' );
// 			//}

// 		} );
// 	} );
// 	$('.kirki-color-control').iris({
        
//          palettes: ['#125', '#459', '#78b'],
//     });
// 	$('.iris-palette-container a').each(function(i,e){
// 		if (((i+1) % 6) == 0)
// 		$(this).after('<p>Hello, world.</p>');
// 	});
	
	dpColorPalette = [
		"#ffffff", "#f2f2f2", "#d7d7d7", "#bebebe", "#a3a3a3", "#7e7e7e",
		"#7f7f7f", "#595959", "#414141", "#2a2a2a", "#141414", "#000000", 
		"#f8d1d3", "#f2a3a7", "#eb757b", "#c00000", "#a3171e", "#6d0f14",
		"#fdeada", "#fbd5b5", "#fac08f", "#f79646", "#e36c09", "#974806",
		"#fafdd7", "#fbfaae", "#eef98e", "#f5f445", "#dede07", "#c0c00d",
		"#e5f5d7", "#cbecb0", "#b2e389", "#7fd13b", "#5ea226", "#3f6c19",
		"#dbeef3", "#b7dde8", "#92cddc", "#4bacc6", "#31859b", "#205867",
		"#c6d9f0", "#8db3e2", "#548dd4", "#1f497d", "#17365d", "#0f243e",
		"#e5e0ec", "#ccc1d9", "#b2a2c7", "#8064a2", "#5f497a", "#3f3151"
	];
	
	dpColorSchemes = [
		["#e6af4b", "#e05038", "#f2cbbc", "#334431", "#FFF", "#f79646"],
		["#e5f5d7", "#cbecb0", "#b2e389", "#7fd13b", "#5ea226", "#3f6c19"],
		["#e5f5d7", "#cbecb0", "#b2e389", "#7fd13b", "#5ea226", "#3f6c19"],
		["#FFFFFF", "#cbecb0", "#b2e389", "#7fd13b", "#5ea226", "#3f6c19"],
		["#e5f5d7", "#cbecb0", "#b2e389", "#7fd13b", "#5ea226", "#3f6c19"],
	];
// 	function dp_color_schemes( input ) {
		
// 		input = typeof input !== 'undefined' ? input : 0;

// 		var output = [
// 			["#FFF", "#000", "#000", "#CCC", "#FFF", "#EEE"],
// 		];
		
// 		return output[0][input];
// 	}
// 	console.log( dp_color_schemes(0))
  // Let's say we want to add three grey scale colors on top of your pre-existing palette
	var dp_color_scheme_onload = wp.customize.value( 'dp_color_scheme_1' )();
  $('.kirki-color-control').iris('option', 'palettes', dpColorSchemes[dp_color_scheme_onload].concat(dpColorPalette));

	var arrayLength = dpColorSchemes.length;
	for (var i = 0; i < arrayLength; i++) {
		$('label[for=dp_color_scheme_1' + i + ']').css('background', 'linear-gradient(to right, ' + dpColorSchemes[i][0] + ' 0%, ' + dpColorSchemes[i][0] + ' 17%, ' + dpColorSchemes[i][1] + ' 17%, ' + dpColorSchemes[i][1] + ' 34%, ' + dpColorSchemes[i][2] + ' 34%, ' + dpColorSchemes[i][2] + ' 51%, ' + dpColorSchemes[i][3] + ' 51%, ' + dpColorSchemes[i][3] + ' 68%, ' + dpColorSchemes[i][4] + ' 68%, ' + dpColorSchemes[i][4] + ' 84%, ' + dpColorSchemes[i][5] + ' 84%, ' + dpColorSchemes[i][5] + ' 100%)');
	}
		//Color Schemes
	wp.customize( 'dp_color_scheme_1', function( value ) {
		value.bind( function( newval ) {
			$('.kirki-color-control').iris('option', 'palettes', dpColorSchemes[newval].concat(dpColorPalette));
			$('.iris-palette-container a:nth-child(1)').before('<div class="dp-color-palette-before">Global Color Scheme:</div>');
			$('.iris-palette-container a:nth-child(7)').after('<div class="dp-color-palette-after">Color Palette:</div>');
		} );
	} );
	
	$('.iris-palette-container a:nth-child(1)').before('<div class="dp-color-palette-before">Global Color Scheme:</div>');
	$('.iris-palette-container a:nth-child(7)').after('<div class="dp-color-palette-after">Color Palette:</div>');

//$('#customize-control-dp_primary_menu_link_color .iris-palette').css({'height':'35px','width':'35px', 'margin-left':'','margin-right':'3px','margin-top':'3px'});
//$('#customize-control-dp_primary_menu_link_color .iris-strip').css('height','182px');
//	paletteCount = $('#customize-control-dp_primary_menu_link_color .iris-palette').length
//	paletteRowCount = Math.ceil(paletteCount / 6);
//	$('#customize-control-dp_primary_menu_link_color .iris-picker').css({'height': 200 + (paletteRowCount * 38)+'px', 'padding-bottom':'15px'});
	
// 	function gradienttest ( selector, input ) {
// 		var css_id = selector.split("::");
// 		//property:linear;angle:90deg;colors:c1_s0_cs0-c2_s0_cs50;
// 		$('label[for="' + selector + input + '"] img').css('background','blue' );
// // 		prefix.css('background', bg_img +' -o-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
// // 		prefix.css('background', bg_img +' -moz-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
// // 		prefix.css('background', bg_img +' -webkit-linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
// // 		$('label[for="' + selector + input + '"] img').css('background', 'linear-gradient('+color1+' '+ grad_per1 +'%, '+color2+' '+ grad_per2 +'%)' );
// 	}
	
// 	//testing
// 	wp.customize( 'dp_primary_menu_gradient_style', function( value ) {
// 		var val = wp.customize.value( 'dp_primary_menu_gradient_style' )();
// 		//gradienttest('dp_primary_menu_gradient_style', val);

// 		value.bind( function( newval ) {
// 		//	gradienttest('dp_primary_menu_gradient_style', newval);
// 		} );
// 	} );
	
// 	$('#input_dp_primary_menu_gradient_style label img').css('background','green' );
	
	//$( '.color-picker-typography-text .wp-color-result-text' ).parent().prev().html('Icon Color' );
	 // $( '.color-picker-typography-text .wp-color-result-text' ).parent().prev().html('Icon Color' );
  // $( '.wp-color-result-text' ).html('Icon Color' );

	$('.customize-control-kirki-color').each(function(index) {
  // alert($(this).text());
		var description = $(this).find('.customize-control-description').html();
		var title = $(this).find('.customize-control-title').html()
		
		if( title == false ) {
			var new_text = description;
		} else {
			var new_text = title;
		}
		
		$(this).find('.wp-color-result-text').html( new_text );
		//$(this).children('.customize-control-description').text('hi');
  //console.log( $('.customize-control-description').text() );
});
	
});

