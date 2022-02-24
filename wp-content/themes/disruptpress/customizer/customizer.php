<?php
/**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */

/**
 * Create array for default theme options.
 */
global $disruptpress_theme_defaults; global $disruptpress_theme_defaults; $disruptpress_theme_defaults = array();

/**
 * Web Safe Fonts
 */
function dp_web_safe_fonts() {
	return array(
		'Arial, Helvetica, sans-serif',
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
	);
}

/**
 * Global Fonts
 */
function dp_global_fonts() {
	return array(
		/* Web Safe Fonts */
		'Arial, Helvetica, sans-serif' => esc_attr__( 'Arial', 'my_textdomain' ),
		'"Arial Black", Gadget, sans-serif' => esc_attr__( 'Arial Black', 'my_textdomain' ),
		'"Comic Sans MS", cursive, sans-serif' => esc_attr__( 'Comic Sans MS', 'my_textdomain' ),
		'Impact, Charcoal, sans-serif' => esc_attr__( 'Impact', 'my_textdomain' ),
		'"Lucida Sans Unicode", "Lucida Grande", sans-serif' => esc_attr__( 'Lucida Sans Unicode', 'my_textdomain' ),
		'Tahoma, Geneva, sans-serif' => esc_attr__( 'Tahoma', 'my_textdomain' ),
		'"Trebuchet MS", Helvetica, sans-serif' => esc_attr__( 'Trebuchet MS', 'my_textdomain' ),
		'Verdana, Geneva, sans-serif' => esc_attr__( 'Verdana', 'my_textdomain' ),
		'Georgia, serif' => esc_attr__( 'Georgia', 'my_textdomain' ),
		'"Palatino Linotype", "Book Antiqua", Palatino, serif' => esc_attr__( 'Palatino Linotype', 'my_textdomain' ),
		'"Times New Roman", Times, serif' => esc_attr__( 'Times New Roman', 'my_textdomain' ),
		'"Courier New", Courier, monospace' => esc_attr__( 'Courier New', 'my_textdomain' ),
		'"Lucida Console", Monaco, monospace' => esc_attr__( 'Lucida Console"', 'my_textdomain' ),
	
		/* Google Fonts */
		'Roboto Slab' => esc_attr__( 'Roboto Slab', 'my_textdomain' ),
		'Aclonica' => esc_attr__( 'Aclonica', 'my_textdomain' ),
		'Allan' => esc_attr__( 'Allan', 'my_textdomain' ), 
		'Annie+Use+Your+Telescope' => esc_attr__( 'Annie Use Your Telescope', 'my_textdomain' ), 
		'Anonymous+Pro' => esc_attr__( 'Anonymous Pro', 'my_textdomain' ), 
		'Allerta+Stencil' => esc_attr__( 'Allerta Stencil', 'my_textdomain' ), 
		'Allerta' => esc_attr__( 'Allerta', 'my_textdomain' ), 
		'Amaranth' => esc_attr__( 'Amaranth', 'my_textdomain' ), 
		'Anton' => esc_attr__( 'Anton', 'my_textdomain' ), 
		'Architects+Daughter' => esc_attr__( 'Architects Daughter', 'my_textdomain' ), 
		'Arimo' => esc_attr__( 'Arimo', 'my_textdomain' ), 
		'Artifika' => esc_attr__( 'Artifika', 'my_textdomain' ), 
		'Arvo' => esc_attr__( 'Arvo', 'my_textdomain' ), 
		'Asset' => esc_attr__( 'Asset', 'my_textdomain' ), 
		'Astloch' => esc_attr__( 'Astloch', 'my_textdomain' ), 
		'Bangers' => esc_attr__( 'Bangers', 'my_textdomain' ), 
		'Bentham' => esc_attr__( 'Bentham', 'my_textdomain' ), 
		'Bevan' => esc_attr__( 'Bevan', 'my_textdomain' ), 
		'Bigshot+One' => esc_attr__( 'Bigshot One', 'my_textdomain' ), 
		'Bowlby+One' => esc_attr__( 'Bowlby One', 'my_textdomain' ), 
		'Bowlby+One+SC' => esc_attr__( 'Bowlby One SC', 'my_textdomain' ), 
		'Brawler' => esc_attr__( 'Brawler', 'my_textdomain' ), 
		'Buda' => esc_attr__( 'Buda', 'my_textdomain' ), 
		'Cabin' => esc_attr__( 'Cabin', 'my_textdomain' ), 
		'Calligraffitti' => esc_attr__( 'Calligraffitti', 'my_textdomain' ), 
		'Candal' => esc_attr__( 'Candal', 'my_textdomain' ), 
		'Cantarell' => esc_attr__( 'Cantarell', 'my_textdomain' ), 
		'Cardo' => esc_attr__( 'Cardo', 'my_textdomain' ), 
		'Carter+One' => esc_attr__( 'Carter One', 'my_textdomain' ), 
		'Caudex' => esc_attr__( 'Caudex', 'my_textdomain' ), 
		'Cedarville+Cursive' => esc_attr__( 'Cedarville Cursive', 'my_textdomain' ), 
		'Cherry+Cream+Soda' => esc_attr__( 'Cherry Cream Soda', 'my_textdomain' ), 
		'Chewy' => esc_attr__( 'Chewy', 'my_textdomain' ), 
		'Coda' => esc_attr__( 'Coda', 'my_textdomain' ), 
		'Coming+Soon' => esc_attr__( 'Coming Soon', 'my_textdomain' ), 
		'Copse' => esc_attr__( 'Copse', 'my_textdomain' ), 
		'Corben' => esc_attr__( 'Corben', 'my_textdomain' ), 
		'Cousine' => esc_attr__( 'Cousine', 'my_textdomain' ), 
		'Covered+By+Your+Grace' => esc_attr__( 'Covered By Your Grace', 'my_textdomain' ), 
		'Crafty+Girls' => esc_attr__( 'Crafty Girls', 'my_textdomain' ), 
		'Crimson+Text' => esc_attr__( 'Crimson Text', 'my_textdomain' ), 
		'Crushed' => esc_attr__( 'Crushed', 'my_textdomain' ), 
		'Cuprum' => esc_attr__( 'Cuprum', 'my_textdomain' ), 
		'Damion' => esc_attr__( 'Damion', 'my_textdomain' ), 
		'Dancing+Script' => esc_attr__( 'Dancing Script', 'my_textdomain' ), 
		'Dawning+of+a+New+Day' => esc_attr__( 'Dawning of a New Day', 'my_textdomain' ), 
		'Didact+Gothic' => esc_attr__( 'Didact Gothic', 'my_textdomain' ), 
		'Droid+Sans' => esc_attr__( 'Droid Sans', 'my_textdomain' ), 
		'Droid+Sans+Mono' => esc_attr__( 'Droid Sans Mono', 'my_textdomain' ), 
		'Droid+Serif' => esc_attr__( 'Droid Serif', 'my_textdomain' ), 
		'EB+Garamond' => esc_attr__( 'EB Garamond', 'my_textdomain' ), 
		'Expletus+Sans' => esc_attr__( 'Expletus Sans', 'my_textdomain' ), 
		'Fontdiner+Swanky' => esc_attr__( 'Fontdiner Swanky', 'my_textdomain' ), 
		'Forum' => esc_attr__( 'Forum', 'my_textdomain' ), 
		'Francois+One' => esc_attr__( 'Francois One', 'my_textdomain' ), 
		'Geo' => esc_attr__( 'Geo', 'my_textdomain' ), 
		'Give+You+Glory' => esc_attr__( 'Give You Glory', 'my_textdomain' ), 
		'Goblin+One' => esc_attr__( 'Goblin One', 'my_textdomain' ), 
		'Gravitas+One' => esc_attr__( 'Gravitas One', 'my_textdomain' ), 
		'Gruppo' => esc_attr__( 'Gruppo', 'my_textdomain' ), 
		'Hammersmith+One' => esc_attr__( 'Hammersmith One', 'my_textdomain' ), 
		'Holtwood+One+SC' => esc_attr__( 'Holtwood One SC', 'my_textdomain' ), 
		'Homemade+Apple' => esc_attr__( 'Homemade Apple', 'my_textdomain' ), 
		'Inconsolata' => esc_attr__( 'Inconsolata', 'my_textdomain' ), 
		'Indie+Flower' => esc_attr__( 'Indie Flower', 'my_textdomain' ), 
		'IM+Fell+DW+Pica' => esc_attr__( 'IM Fell DW Pica', 'my_textdomain' ), 
		'IM+Fell+DW+Pica+SC' => esc_attr__( 'IM Fell DW Pica SC', 'my_textdomain' ), 
		'IM+Fell+Double+Pica' => esc_attr__( 'IM Fell Double Pica', 'my_textdomain' ), 
		'IM+Fell+Double+Pica+SC' => esc_attr__( 'IM Fell Double Pica SC', 'my_textdomain' ), 
		'IM+Fell+English' => esc_attr__( 'IM Fell English', 'my_textdomain' ), 
		'IM+Fell+English+SC' => esc_attr__( 'IM Fell English SC', 'my_textdomain' ), 
		'IM+Fell+French+Canon' => esc_attr__( 'IM Fell French Canon', 'my_textdomain' ), 
		'IM+Fell+French+Canon+SC' => esc_attr__( 'IM Fell French Canon SC', 'my_textdomain' ), 
		'IM+Fell+Great+Primer' => esc_attr__( 'IM Fell Great Primer', 'my_textdomain' ), 
		'IM+Fell+Great+Primer+SC' => esc_attr__( 'IM Fell Great Primer SC', 'my_textdomain' ), 
		'Irish+Grover' => esc_attr__( 'Irish Grover', 'my_textdomain' ), 
		'Irish+Growler' => esc_attr__( 'Irish Growler', 'my_textdomain' ), 
		'Istok+Web' => esc_attr__( 'Istok Web', 'my_textdomain' ), 
		'Josefin+Sans' => esc_attr__( 'Josefin Sans', 'my_textdomain' ), 
		'Josefin+Slab' => esc_attr__( 'Josefin Slab', 'my_textdomain' ), 
		'Judson' => esc_attr__( 'Judson', 'my_textdomain' ), 
		'Jura' => esc_attr__( 'Jura', 'my_textdomain' ), 
		'Just+Another+Hand' => esc_attr__( 'Just Another Hand', 'my_textdomain' ), 
		'Just+Me+Again+Down+Here' => esc_attr__( 'Just Me Again Down Here', 'my_textdomain' ), 
		'Kameron' => esc_attr__( 'Kameron', 'my_textdomain' ), 
		'Kenia' => esc_attr__( 'Kenia', 'my_textdomain' ), 
		'Kranky' => esc_attr__( 'Kranky', 'my_textdomain' ), 
		'Kreon' => esc_attr__( 'Kreon', 'my_textdomain' ), 
		'Kristi' => esc_attr__( 'Kristi', 'my_textdomain' ), 
		'La+Belle+Aurore' => esc_attr__( 'La Belle Aurore', 'my_textdomain' ), 
		'Lato' => esc_attr__( 'Lato', 'my_textdomain' ), 
		'League+Script' => esc_attr__( 'League Script', 'my_textdomain' ), 
		'Lekton' => esc_attr__( 'Lekton', 'my_textdomain' ), 
		'Limelight' => esc_attr__( 'Limelight', 'my_textdomain' ), 
		'Lobster' => esc_attr__( 'Lobster', 'my_textdomain' ), 
		'Lobster+Two' => esc_attr__( 'Lobster Two', 'my_textdomain' ), 
		'Lora' => esc_attr__( 'Lora', 'my_textdomain' ), 
		'Love+Ya+Like+A+Sister' => esc_attr__( 'Love Ya Like A Sister', 'my_textdomain' ), 
		'Loved+by+the+King' => esc_attr__( 'Loved by the King', 'my_textdomain' ), 
		'Luckiest+Guy' => esc_attr__( 'Luckiest Guy', 'my_textdomain' ), 
		'Maiden+Orange' => esc_attr__( 'Maiden Orange', 'my_textdomain' ), 
		'Mako' => esc_attr__( 'Mako', 'my_textdomain' ), 
		'Maven+Pro' => esc_attr__( 'Maven Pro', 'my_textdomain' ), 
		'Meddon' => esc_attr__( 'Meddon', 'my_textdomain' ), 
		'MedievalSharp' => esc_attr__( 'MedievalSharp', 'my_textdomain' ), 
		'Megrim' => esc_attr__( 'Megrim', 'my_textdomain' ), 
		'Merriweather' => esc_attr__( 'Merriweather', 'my_textdomain' ), 
		'Metrophobic' => esc_attr__( 'Metrophobic', 'my_textdomain' ), 
		'Michroma' => esc_attr__( 'Michroma', 'my_textdomain' ), 
		'Miltonian+Tattoo' => esc_attr__( 'Miltonian Tattoo', 'my_textdomain' ), 
		'Miltonian' => esc_attr__( 'Miltonian', 'my_textdomain' ), 
		'Modern+Antiqua' => esc_attr__( 'Modern Antiqua', 'my_textdomain' ), 
		'Monofett' => esc_attr__( 'Monofett', 'my_textdomain' ), 
		'Molengo' => esc_attr__( 'Molengo', 'my_textdomain' ), 
		'Mountains+of+Christmas' => esc_attr__( 'Mountains of Christmas', 'my_textdomain' ), 
		'Muli' => esc_attr__( 'Muli', 'my_textdomain' ), 
		'Neucha' => esc_attr__( 'Neucha', 'my_textdomain' ), 
		'Neuton' => esc_attr__( 'Neuton', 'my_textdomain' ), 
		'News+Cycle' => esc_attr__( 'News Cycle', 'my_textdomain' ), 
		'Nixie+One' => esc_attr__( 'Nixie One', 'my_textdomain' ), 
		'Nobile' => esc_attr__( 'Nobile', 'my_textdomain' ), 
		'Nova+Cut' => esc_attr__( 'Nova Cut', 'my_textdomain' ), 
		'Nova+Flat' => esc_attr__( 'Nova Flat', 'my_textdomain' ), 
		'Nova+Mono' => esc_attr__( 'Nova Mono', 'my_textdomain' ), 
		'Nova+Oval' => esc_attr__( 'Nova Oval', 'my_textdomain' ), 
		'Nova+Round' => esc_attr__( 'Nova Round', 'my_textdomain' ), 
		'Nova+Script' => esc_attr__( 'Nova Script', 'my_textdomain' ), 
		'Nova+Slim' => esc_attr__( 'Nova Slim', 'my_textdomain' ), 
		'Nova+Square' => esc_attr__( 'Nova Square', 'my_textdomain' ), 
		'Nunito' => esc_attr__( 'Nunito', 'my_textdomain' ), 
		'Nunito' => esc_attr__( 'Nunito', 'my_textdomain' ), 
		'OFL+Sorts+Mill+Goudy+TT' => esc_attr__( 'OFL Sorts Mill Goudy TT', 'my_textdomain' ), 
		'Old+Standard+TT' => esc_attr__( 'Old Standard TT', 'my_textdomain' ), 
		'Open+Sans' => esc_attr__( 'Open Sans', 'my_textdomain' ), 
		'Open+Sans+Condensed' => esc_attr__( 'Open Sans Condensed', 'my_textdomain' ), 
		'Orbitron' => esc_attr__( 'Orbitron', 'my_textdomain' ), 
		'Oswald' => esc_attr__( 'Oswald', 'my_textdomain' ), 
		'Over+the+Rainbow' => esc_attr__( 'Over the Rainbow', 'my_textdomain' ), 
		'Reenie+Beanie' => esc_attr__( 'Reenie Beanie', 'my_textdomain' ), 
		'Pacifico' => esc_attr__( 'Pacifico', 'my_textdomain' ), 
		'Patrick+Hand' => esc_attr__( 'Patrick Hand', 'my_textdomain' ), 
		'Paytone+One' => esc_attr__( 'Paytone One', 'my_textdomain' ), 
		'Permanent+Marker' => esc_attr__( 'Permanent Marker', 'my_textdomain' ), 
		'Philosopher' => esc_attr__( 'Philosopher', 'my_textdomain' ), 
		'Play' => esc_attr__( 'Play', 'my_textdomain' ), 
		'Playfair+Display' => esc_attr__( 'Playfair Display', 'my_textdomain' ), 
		'Podkova' => esc_attr__( 'Podkova', 'my_textdomain' ), 
		'PT+Sans' => esc_attr__( 'PT Sans', 'my_textdomain' ), 
		'PT+Sans+Narrow' => esc_attr__( 'PT Sans Narrow', 'my_textdomain' ), 
		'PT+Serif' => esc_attr__( 'PT Serif', 'my_textdomain' ), 
		'PT+Serif+Caption' => esc_attr__( 'PT Serif Caption', 'my_textdomain' ), 
		'Puritan' => esc_attr__( 'Puritan', 'my_textdomain' ), 
		'Quattrocento' => esc_attr__( 'Quattrocento', 'my_textdomain' ), 
		'Quattrocento+Sans' => esc_attr__( 'Quattrocento Sans', 'my_textdomain' ), 
		'Radley' => esc_attr__( 'Radley', 'my_textdomain' ), 
		'Raleway' => esc_attr__( 'Raleway', 'my_textdomain' ), 
		'Redressed' => esc_attr__( 'Redressed', 'my_textdomain' ), 
		'Rock+Salt' => esc_attr__( 'Rock Salt', 'my_textdomain' ), 
		'Rokkitt' => esc_attr__( 'Rokkitt', 'my_textdomain' ), 
		'Roboto' => esc_attr__( 'Roboto', 'my_textdomain' ), 
		'Ruslan+Display' => esc_attr__( 'Ruslan Display', 'my_textdomain' ), 
		'Schoolbell' => esc_attr__( 'Schoolbell', 'my_textdomain' ), 
		'Shadows+Into+Light' => esc_attr__( 'Shadows Into Light', 'my_textdomain' ), 
		'Shanti' => esc_attr__( 'Shanti', 'my_textdomain' ), 
		'Sigmar+One' => esc_attr__( 'Sigmar One', 'my_textdomain' ), 
		'Six+Caps' => esc_attr__( 'Six Caps', 'my_textdomain' ), 
		'Slackey' => esc_attr__( 'Slackey', 'my_textdomain' ), 
		'Smythe' => esc_attr__( 'Smythe', 'my_textdomain' ), 
		'Sniglet' => esc_attr__( 'Sniglet', 'my_textdomain' ), 
		'Special+Elite' => esc_attr__( 'Special Elite', 'my_textdomain' ), 
		'Stardos+Stencil' => esc_attr__( 'Stardos Stencil', 'my_textdomain' ), 
		'Sue+Ellen+Francisco' => esc_attr__( 'Sue Ellen Francisco', 'my_textdomain' ), 
		'Sunshiney' => esc_attr__( 'Sunshiney', 'my_textdomain' ), 
		'Swanky+and+Moo+Moo' => esc_attr__( 'Swanky and Moo Moo', 'my_textdomain' ), 
		'Syncopate' => esc_attr__( 'Syncopate', 'my_textdomain' ), 
		'Tangerine' => esc_attr__( 'Tangerine', 'my_textdomain' ), 
		'Tenor+Sans' => esc_attr__( 'Tenor Sans', 'my_textdomain' ), 
		'Terminal+Dosis+Light' => esc_attr__( 'Terminal Dosis Light', 'my_textdomain' ), 
		'The+Girl+Next+Door' => esc_attr__( 'The Girl Next Door', 'my_textdomain' ), 
		'Tinos' => esc_attr__( 'Tinos', 'my_textdomain' ), 
		'Ubuntu' => esc_attr__( 'Ubuntu', 'my_textdomain' ), 
		'Ultra' => esc_attr__( 'Ultra', 'my_textdomain' ), 
		'Unkempt' => esc_attr__( 'Unkempt', 'my_textdomain' ), 
		'UnifrakturCook' => esc_attr__( 'UnifrakturCook', 'my_textdomain' ), 
		'UnifrakturMaguntia' => esc_attr__( 'UnifrakturMaguntia', 'my_textdomain' ), 
		'Varela' => esc_attr__( 'Varela', 'my_textdomain' ), 
		'Varela+Round' => esc_attr__( 'Varela Round', 'my_textdomain' ), 
		'Vibur' => esc_attr__( 'Vibur', 'my_textdomain' ), 
		'Vollkorn' => esc_attr__( 'Vollkorn', 'my_textdomain' ), 
		'VT323' => esc_attr__( 'VT323', 'my_textdomain' ), 
		'Waiting+for+the+Sunrise' => esc_attr__( 'Waiting for the Sunrise', 'my_textdomain' ), 
		'Wallpoet' => esc_attr__( 'Wallpoet', 'my_textdomain' ), 
		'Walter+Turncoat' => esc_attr__( 'Walter Turncoat', 'my_textdomain' ), 
		'Wire+One' => esc_attr__( 'Wire One', 'my_textdomain' ), 
		'Yanone+Kaffeesatz' => esc_attr__( 'Yanone Kaffeesatz', 'my_textdomain' ), 
		'Yeseva+One' => esc_attr__( 'Yeseva One', 'my_textdomain' ), 
		'Zeyada' => esc_attr__( 'Zeyada', 'my_textdomain' ), 
	);
}

/**
 * Shadow Presets
 */
function dp_shadows() {
	return array( '0px 3px 15px 0px #777777',
	 '0px 6px 15px 0px #777777',
	 '0px 7px 12px 0px #777777',
	 '0 10px 6px -6px #777777',
	 '0px 17px 14px -10px #777777',
	 '0px 20px 11px -10px #777777',
	 '0px 10px 20px -6px #000000',
	 '0px 12px 20px -6px #000000',
	 '0px 15px 20px -6px #000000'
	);
}

/**
 * Customizer Theme Config
 */
Kirki::add_config( 'disruptpress_theme', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
	'option_name' => 'disruptpress_theme',
) );

/**
 * Theme Settings Section
 */
Kirki::add_panel( 'dp_theme_settings', array(
    'title' => __( 'Theme Settings', 'textdomain' ),
) );

//include get_template_directory() . '/customizer/sections/customizer.dp_logo_settings.php';
include get_template_directory() . '/customizer/sections/customizer.dp_site_layouts.php';
include get_template_directory() . '/customizer/sections/customizer.dp_sort_header.php';

/**
 * Design Options Section
 */
Kirki::add_panel( 'dp_design_options', array(
    'title'       => __( 'Design Options', 'textdomain' ),
) );
include get_template_directory() . '/customizer/sections/customizer.dp_color_schemes.php';
include get_template_directory() . '/customizer/sections/customizer.dp_typography.php';
include get_template_directory() . '/customizer/sections/customizer.dp_social_share.php';
include get_template_directory() . '/customizer/sections/customizer.dp_site_container.php';
include get_template_directory() . '/customizer/sections/customizer.dp_slider.php';
include get_template_directory() . '/customizer/sections/customizer.dp_front_page_grid.php';
include get_template_directory() . '/customizer/sections/customizer.dp_page.php';
include get_template_directory() . '/customizer/sections/customizer.dp_page_featured_image.php';
include get_template_directory() . '/customizer/sections/customizer.dp_page_header.php';
include get_template_directory() . '/customizer/sections/customizer.dp_page_categories.php';
include get_template_directory() . '/customizer/sections/customizer.dp_page_header_meta.php';
//include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_wrap.php';
//include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_container_1.php';
//include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_container_2.php';
//include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_container_3.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_title.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_featured_image.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_categories.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_excerpt.php';
include get_template_directory() . '/customizer/sections/customizer.dp_blog_roll_meta.php';
include get_template_directory() . '/customizer/sections/customizer.dp_archive_title_description.php';
include get_template_directory() . '/customizer/sections/customizer.dp_background.php';
include get_template_directory() . '/customizer/sections/customizer.dp_background2.php';
include get_template_directory() . '/customizer/sections/customizer.dp_header.php';
include get_template_directory() . '/customizer/sections/customizer.dp_header_logo.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_menu.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_menu_logo.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_menu_sticky.php';
//include get_template_directory() . '/customizer/sections/customizer.dp_primary_menu_sticky_logo.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_sidebar.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_sidebar_widgets.php';
include get_template_directory() . '/customizer/sections/customizer.dp_primary_sidebar_widgets_title.php';
include get_template_directory() . '/customizer/sections/customizer.dp_pagination.php';
include get_template_directory() . '/customizer/sections/customizer.dp_footer.php';
include get_template_directory() . '/customizer/sections/customizer.dp_woocommerce_category.php';


//* Load Stylesheet Compiler
require_once( dirname(__FILE__) . '/css-compiler.php' );

//* Load Customizer scripts for control panel
function dp_customize_controls_enqueue_scripts() {

	$last_update = get_theme_mod('dp_last_modified', '0');

	wp_enqueue_script( 'theme-customizer-addon',  get_stylesheet_directory_uri() . '/customizer/theme-customizer-field-dependencies.js', array(), $last_update, true );
	wp_enqueue_style( 'redux-custom-css',  get_stylesheet_directory_uri() . '/customizer/customizer-panel.css' );
	//wp_enqueue_script( 'theme-customizer-functions',  get_stylesheet_directory_uri() . '/theme-customizer-functions.js', array(), '1.0.0', true );
//	wp_enqueue_script( 'theme-customizer',  get_stylesheet_directory_uri() . '/customizer/theme-customizer.js', array(), '1.0.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'dp_customize_controls_enqueue_scripts' );

//* Load Customizer scripts for preview
function dp_customize_preview_init() {

	$last_update = get_theme_mod('dp_last_modified', '0');

	wp_add_inline_style( 'disruptpress-style', disruptpress_create_css_file() );
	wp_enqueue_style( 'customizer-preview-css',  get_stylesheet_directory_uri() . '/customizer/customizer-preview.css', '', $last_update );
	wp_enqueue_script( 'jquery-stylesheet',  get_stylesheet_directory_uri() . '/js/jquery.stylesheet.js', array(), $last_update, true );
	wp_enqueue_script( 'theme-customizer',  get_stylesheet_directory_uri() . '/customizer/theme-customizer.js', array(), $last_update, true );
	wp_enqueue_script( 'theme-customizer-functions',  get_stylesheet_directory_uri() . '/customizer/theme-customizer-functions.js', array(), $last_update, true );
}
add_action( 'customize_preview_init', 'dp_customize_preview_init' );

// Enque Scripts
function dp_wp_enqueue_scripts_customize_preview() {
	if ( is_customize_preview() ) {
		wp_add_inline_style( 'disruptpress-style', disruptpress_create_css_file() );
		wp_enqueue_style( 'customizer-preview-css',  get_stylesheet_directory_uri() . '/customizer/customizer-preview.css' );
	}
}
add_action( 'wp_enqueue_scripts', 'dp_wp_enqueue_scripts_customize_preview'  );

/**
 *   Determine the device view size and icons in Customizer
 */
function disruptpress_customizer_responsive_sizes() {

	$mobile_margin_left = '-240px'; //Half of -$mobile_width
	$mobile_width = '320px';
	$mobile_height = '568px';

	$mobile_landscape_width = '568px';
	$mobile_landscape_height = '320px';

	$tablet_width = '768px';
	$tablet_height = '1024px';

	$tablet_landscape_width = '1024px';
	$tablet_landscape_height = '768px';

	?>
	<style>
		.wp-customizer .preview-mobile .wp-full-overlay-main {
				margin-left: <?php echo $mobile_margin_left; ?>;
				width: <?php echo $mobile_width; ?>;
				height: <?php echo $mobile_height; ?>;
		}

		.wp-customizer .preview-mobile-landscape .wp-full-overlay-main {

				width: <?php echo $mobile_landscape_width; ?>;
				height: <?php echo $mobile_landscape_height; ?>;
				top: 50%;
				left: 50%;
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
		}

		.wp-customizer .preview-tablet .wp-full-overlay-main {

				width: <?php echo $tablet_width; ?>;
				height: <?php echo $tablet_height; ?>;
		}

		.wp-customizer .preview-tablet-landscape .wp-full-overlay-main {

				width: <?php echo $tablet_landscape_width; ?>;
				height: <?php echo $tablet_landscape_height; ?>;
				top: 50%;
				left: 50%;
				-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
		}

		.wp-full-overlay-footer .devices .preview-tablet-landscape:before {
				content: "\f167";
		}

		.wp-full-overlay-footer .devices .preview-mobile-landscape:before {
				content: "\f167";
		}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'disruptpress_customizer_responsive_sizes' );

function dp_customize_previewable_devices( $devices ) {
	$custom_devices[ 'desktop' ] = $devices[ 'desktop' ];
	$custom_devices[ 'tablet' ] = $devices[ 'tablet' ];
	$custom_devices[ 'tablet-landscape' ] = array (
		'label' => __( 'Enter tablet landscape preview mode' ), 'default' => false,
	);
	$custom_devices[ 'mobile' ] = $devices[ 'mobile' ];
	$custom_devices[ 'mobile-landscape' ] = array (
		'label' => __( 'Enter mobile landscape preview mode' ), 'default' => false,
	);

	foreach ( $devices as $device => $settings ) {
		if ( ! isset( $custom_devices[ $device ] ) ) {
			$custom_devices[ $device ] = $settings;
		}
	}

	return $custom_devices;
}
add_filter( 'customize_previewable_devices', 'dp_customize_previewable_devices' );

class MyTheme_Customize {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since MyTheme 1.0
    */
   public static function register ( $wp_customize ) {
      //1. Define a new section (if desired) to the Theme Customizer
//       $wp_customize->add_section( 'mytheme2_options', 
//          array(
//             'title' => __( 'MyTheme Options', 'mytheme2' ), //Visible title of section
//             'priority' => 35, //Determines what order this appears in
//             'capability' => 'edit_theme_options', //Capability needed to tweak
//             'description' => __('Allows you to customize some example settings for MyTheme.', 'mytheme'), //Descriptive tooltip
//          ) 
//       );
      
      //2. Register new settings to the WP database...
//       $wp_customize->add_setting( 'link_textcolor', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
//          array(
//             'default' => '#2BA6CB', //Default setting/value to save
//             'type' => 'theme_mod', //Is this an 'option' or a 'theme_mod'?
//             'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
//             'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
//          ) 
//       );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
//       $wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
//          $wp_customize, //Pass the $wp_customize object (required)
//          'mytheme_link_textcolor', //Set a unique ID for the control
//          array(
//             'label' => __( 'Link Color', 'mytheme2' ), //Admin-visible name of the control
//             'section' => 'colors', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
//             'settings' => 'link_textcolor', //Which setting to load and manipulate (serialized is okay)
//             'priority' => 10, //Determines the order this control appears in for the specified section
//          ) 
//       ) );
	  
	  // Hide core sections/controls when they aren't used on the current page.
//	$wp_customize->get_section( 'header_image' )->active_callback = 'is_front_page';
//	$wp_customize->get_control( "site_icon" )->active_callback = 'is_front_page';
		  
      //$wp_customize->get_control( 'disruptpress_theme[dp_general_container_width]' )->active_callback = 'is_front_page';
      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
     /* $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
      $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
      $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
      $wp_customize->get_setting( 'genesis_breadcrumb_home' )->transport = 'postMessage';
	  */
	//  $wp_customize->get_section( 'blogdescription' )->active_callback = 'is_front_page';
// $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
 //$wp_customize->get_section( 'header_image' )->active_callback = 'is_front_page';

	//$wp_customize->remove_section('title_tagline');
	//$wp_customize->remove_section('colors');
	//$wp_customize->remove_section('background_image');
	/*$wp_customize->remove_section('nav');
	$wp_customize->remove_section('genesis_breadcrumbs');
	$wp_customize->get_section( 'header_image' )->active_callback = 'is_front_page';

	$wp_customize->remove_section('static_front_page');

	$wp_customize->remove_panel('widgets');
	$wp_customize->remove_section('genesis_layout');
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';*/

$wp_customize->remove_section('themes');
 $wp_customize->remove_section("colors");
 $wp_customize->remove_section("blogdescription");
 $wp_customize->remove_section("blogname");
$wp_customize->remove_section('title_tagline');
   }

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {
	
	
     
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      /*wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_stylesheet_directory_uri() . '/theme-customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );*/
	  
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'MyTheme_Customize' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'MyTheme_Customize' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'MyTheme_Customize' , 'live_preview' ) );


/**
 * Enqueue Nav Primary Sticky Menu
 */
function disruptpress_sticky_menu_enqueue_scripts() {
	$last_update = get_theme_mod('dp_last_modified', '0');
	//if ( dp_theme_mod( 'dp_primary_menu_sticky' ) != '0' ) {
		wp_enqueue_script( 'sticky-menu',  get_stylesheet_directory_uri() . '/js/sticky-menu-primary.js', array(), $last_update, true );
	//}
}
add_action( 'wp_enqueue_scripts', 'disruptpress_sticky_menu_enqueue_scripts'  );

/**
 * Enqueue Google Fonts
 * Only enqueue if font is not a web safe font
 */
function disruptpress_enqueue_google_fonts() {

	// Global Font
	if ( !in_array( html_entity_decode( dp_theme_mod( 'dp_typography_font_family' ) ), dp_web_safe_fonts() ) ) {
		wp_enqueue_style( 'dp-google-font-body', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_typography_font_family' ) );
	}

    // Global Font H1 - H6
    if ( !in_array( html_entity_decode( dp_theme_mod( 'dp_typography_h_font_family' ) ), dp_web_safe_fonts() ) ) {
        wp_enqueue_style( 'dp-google-font-h1-h6', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_typography_h_font_family' ) );
    }
	
	// Header Title Font
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_header_logo_title_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_header_logo_title_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-header-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_header_logo_title_font_family' ) );
	}
	
	// Header Tagline Font
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_header_logo_tagline_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_header_logo_tagline_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-tagline-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_header_logo_tagline_font_family' ) );
	}
	
	// Nav Primary Font
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_primary_menu_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_primary_menu_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-nav-primary', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_primary_menu_font_family' ) );
	}
	
	// Nav Primary Title Font
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_primary_menu_logo_title_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_primary_menu_logo_title_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-nav-primary-logo-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_primary_menu_logo_title_font_family' ) );
	}
	
	// Nav Primary Tagline Font
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_primary_menu_logo_tagline_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_primary_menu_logo_tagline_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-nav-primary-logo-tagline', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_primary_menu_logo_tagline_font_family' ) );
	}
	
	// Sidebar Widgets Title
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-primary-sidebar-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_primary_sidebar_widgets_title_font_family' ) );
	}
	
	// Sidebar Widgets
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_primary_sidebar_widgets_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_primary_sidebar_widgets_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-primary-sidebar-widgets', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_primary_sidebar_widgets_font_family' ) );
	}
	
	// Footer
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_footer_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_footer_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-footer', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_footer_font_family' ) );
	}
	
	// Footer Widget Title
	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_footer_widget_title_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_footer_widget_title_font_family_toggle' ) == false ) { 
		wp_enqueue_style( 'dp-google-font-footer-widget-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_footer_widget_title_font_family' ) );
	}
    //Page and Posts
//	if ( !in_array(  html_entity_decode( dp_theme_mod( 'dp_page_font_family' ) ), dp_web_safe_fonts() ) AND dp_theme_mod( 'dp_page_font_family_toggle' ) == false ) {
//        wp_enqueue_style( 'dp-google-font-footer-widget-title', 'https://fonts.googleapis.com/css?family=' . dp_theme_mod( 'dp_page_font_family' ) );
//    }
}
add_action( 'wp_enqueue_scripts', 'disruptpress_enqueue_google_fonts'  );


/**
 * Add Home Button to Primary Menu
 */
function disruptpress_primary_menu_add_home_button ( $items, $args ) {
	
  if ( $args->theme_location == 'primary' &&  dp_theme_mod( 'dp_primary_menu_home_icon' ) == '1' ) {
		$home_button = '<li class="dp-nav-primary-home-icon menu-item"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><span class="dashicons dashicons-admin-home"></span></a></li>';

	} else {
		$home_button = '';
	}

	return $home_button.$items;
}
add_filter( 'wp_nav_menu_items', 'disruptpress_primary_menu_add_home_button', 10, 2 );

/**
 * Add Search Box to Primary Menu
 */
function disruptpress_primary_menu_add_search ( $items, $args ) {
    if ($args->theme_location == 'primary' &&  dp_theme_mod( 'dp_primary_menu_search_toggle' ) == true ) {
        $items .= '<li class="dp-search-nav-primary"><div class="dp-search-nav-primary-wrap"><form role="search" method="get" class="search-form" action="' . get_bloginfo( 'url' ) . '"><input type="search" class="search-field" placeholder="Search …" value="" name="s"><input type="submit" class="search-submit" value="&#xf179;"></form></div></li>';
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'disruptpress_primary_menu_add_search', 10, 2 );


// function nav_replace_wpse_189788($item_output, $item) {
//   //   var_dump($item_output, $item);
// //if('primary' == $args->theme_location && in_array("menu-item-home", $item->classes) ){
// 	if ( $item->title == "Home") {
//        // $item_output .='<span class="arrow"></span>';
// 	return '<img src="http://dp2.aedanobrien.com/wp-content/uploads/2016/12/bestseller.png" style="height:80px">';
//     }
      

//   return $item_output;
// }
// add_filter('walker_nav_menu_start_el','nav_replace_wpse_189788',10,2);