<?php
/**
 * DisruptPress functions.
 *
 * @package DisruptPress
 */
//define( 'WP_DEBUG', true );
define( 'DP_VERSION', '1.2.4');
/**
 * Load theme updater functions.
 * Action is used so that child themes can easily disable.
 */

function disruptpress_theme_updater() {
    require( get_template_directory() . '/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'disruptpress_theme_updater' );


//Load ReduxFramework
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux-framework/ReduxCore/framework.php' );
}
if ( !isset( $epurus_theme ) && file_exists( dirname( __FILE__ ) . '/redux-config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/redux-config.php' );
    require_once( dirname( __FILE__ ) . '/theme-options.php' );
}



function disruptpress_reduxFontAwesome() {
    // Uncomment this to remove elusive icon from the panel completely
    //wp_deregister_style( 'redux-elusive-icon' );
    //wp_deregister_style( 'redux-elusive-icon-ie7' );

    wp_register_style(
        'redux-font-awesome',
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css',
        array(),
        time(),
        'all'
    );
    wp_enqueue_style( 'redux-font-awesome' );
}
// This example assumes the opt_name is set to redux_demo.  Please replace it with your opt_name value.
add_action( 'redux/page/disruptpress_theme_options/enqueue', 'disruptpress_reduxFontAwesome' );



/**
 * Load Kirki Framework.
 */
include_once( dirname( __FILE__ ) . '/kirki/kirki.php' );

/**
 * Avoid Kirki url path issues by adjusting Kirki url path.
 */
if ( ! function_exists( 'disruptpress_kirki_update_url' ) ) {
	function disruptpress_kirki_update_url( $config ) {
		$config['url_path'] = get_stylesheet_directory_uri() . '/kirki/';
		return $config;
	}
}
add_filter( 'kirki/config', 'disruptpress_kirki_update_url' );

/**
 * Enqueue scripts and styles.
 */
function disruptpress_enqueue_scripts() {

    $last_update = get_theme_mod('dp_last_modified', '0');

	if ( file_exists( wp_upload_dir()['basedir'] . '/disruptpress/style.css' ) ) {
		wp_enqueue_style( 'disruptpress-style', wp_upload_dir()['baseurl'] . '/disruptpress/style.css', '', $last_update );
	} else {
		wp_enqueue_style( 'disruptpress-style', get_stylesheet_uri() );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_style( 'responsive-menu-css',  get_stylesheet_directory_uri() . '/css/responsive-menu.css', '', $last_update );
	wp_enqueue_style( 'font-awesome-css',  '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'disruptpress-jquery',  get_stylesheet_directory_uri() . '/js/disruptpress.js', array(), $last_update, true );
	wp_enqueue_script( 'responsive-menu',  get_stylesheet_directory_uri() . '/js/responsive-menu.js', array(), $last_update, true );
	wp_enqueue_script( 'responsive-menu-config',  get_stylesheet_directory_uri() . '/js/responsive-menu-config.js', array(), $last_update, true );

}
add_action( 'wp_enqueue_scripts', 'disruptpress_enqueue_scripts'  );

/**
 * Load Theme Customizer.
 */
require_once( get_template_directory() . '/customizer/customizer.php' );
require_once( get_template_directory() . '/external-featured-image.php' );
require_once( get_template_directory() . '/customizer-export-import/customizer-export-import.php' );

/**
 * Create style.css file (in upload folder) on customizer save.
 */
function disruptpress_compiler_action() {

	global $wp_filesystem;
	$upload_dir = wp_upload_dir();
	
	$filename = wp_upload_dir()['basedir'] . '/disruptpress/style.css';
	
	if (wp_mkdir_p($upload_dir['basedir'] . '/disruptpress/')) {
		
		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}
	 
		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename,
				disruptpress_create_css_file(),
				FS_CHMOD_FILE // predefined mode settings for WP files
			);
		}
	}
}
add_action( 'customize_save_after', 'disruptpress_compiler_action', 99 );

function dp_run_css_compiler_after_update() {
    add_action( 'wp_loaded', 'disruptpress_compiler_action' );
}
//add_action( 'upgrader_process_complete', 'dp_run_css_compiler_after_update', 99 );


function my_upgrate_function( $options ) {

   // if ($options['action'] == 'update' && $options['type'] == 'theme' ){
        //disruptpress_compiler_action();
        add_action( 'wp_loaded', 'disruptpress_compiler_action', 10 );
  //  }
}
//add_action( 'upgrader_process_complete', 'my_upgrate_function', 1 );
add_filter('upgrader_post_install', 'my_upgrate_function', 100 );

//add_action('after_switch_theme', 'dp_run_css_compiler_after_update');

//do_action( 'upgrader_process_complete', $this, array( 'action' => 'update', 'type' => 'theme' ), $theme )

/**
 * Set theme defaults, various html5 support and menu registrations.
 */
if ( ! function_exists( 'disruptpress_setup' ) ) :

	function disruptpress_setup() {
		// Add document title tag to HTML <head>.
		add_theme_support( 'title-tag' );

		// Loads the theme's translated strings.
		load_theme_textdomain( 'disruptpress', get_template_directory() . '/languages' );

		// Add featured image support
		add_theme_support( 'post-thumbnails' );

		// Adds RSS feed links to HTML <head>.
		add_theme_support( 'automatic-feed-links' );
		
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add HTML5 support
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Register navigation menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation Menu', 'disruptpress' ),
			'secondary' => esc_html__( 'Secondary Navigation Menu', 'disruptpress' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'disruptpress_setup' );


/**
 * Register widget areas.
 */
function disruptpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'disruptpress' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Secondary Sidebar', 'disruptpress' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Header Widget', 'disruptpress' ),
		'id'            => 'header-1',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget #1', 'disruptpress' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget #2', 'disruptpress' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget #3', 'disruptpress' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'disruptpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'disruptpress_widgets_init' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/template-parts/header.php';
require get_template_directory() . '/template-parts/nav-primary.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Default site layout css class name and amount of sidebars
 */
function disruptpress_default_site_layout ( $input ) {
	$layout_class = get_theme_mod( 'dp_site_layout_default', '2' );
	
	$layouts = array(
		'1' => array(
			'class_body'        => 'full-width-content',
			'class_wrap'        => 'full-width-content',
			'primary_sidebar'   => false,
			'secondary_sidebar' => false,
			'fullheight'        => false
		),
		
		'2' => array(
			'class_body'        => 'content-sidebar1',
			'class_wrap'        => 'content-sidebar1',
			'primary_sidebar'   => true,
			'secondary_sidebar' => false,
			'fullheight'        => false
		),
		
		'3' => array(
			'class_body'        => 'sidebar1-content',
			'class_wrap'        => 'sidebar1-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => false,
			'fullheight'        => false,
		),
		
		'4' => array(
			'class_body'        => 'content-sidebar1-sidebar2',
			'class_wrap'        => 'content-sidebar1',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		),
		
		'5' => array(
			'class_body'        => 'content-sidebar2-sidebar1',
			'class_wrap'        => 'content-sidebar2',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		) ,
		
		'6' => array(
			'class_body'        => 'sidebar1-content-sidebar2',
			'class_wrap'        => 'sidebar1-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		),
		
		'7' => array(
			'class_body'        => 'sidebar2-content-sidebar1',
			'class_wrap'        => 'content-sidebar1',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		),
		
		'8' => array(
			'class_body'        => 'sidebar1-sidebar2-content',
			'class_wrap'        => 'sidebar2-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		),
		
		'9' => array(
			'class_body'        => 'sidebar2-sidebar1-content',
			'class_wrap'        => 'sidebar1-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => false,
		),
		
		'10' => array(
			'class_body'        => 'content-sidebar1fullheight',
			'class_wrap'        => 'full-width-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => false,
			'fullheight'        => true,
		),
		
		'11' => array(
			'class_body'        => 'sidebar1fullheight-content',
			'class_wrap'        => 'full-width-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => false,
			'fullheight'        => true,
		),
		
		'12' => array(
			'class_body'        => 'content-sidebar2-sidebar1fullheight',
			'class_wrap'        => 'content-sidebar2',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => true,
		),
		
		'13' => array(
			'class_body'        => 'sidebar1fullheight-content-sidebar2',
			'class_wrap'        => 'content-sidebar2',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => true,
		),
		
		'14' => array(
			'class_body'        => 'sidebar2-content-sidebar1fullheight',
			'class_wrap'        => 'sidebar2-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => true,
		),
		
		'15' => array(
			'class_body'        => 'sidebar1fullheight-sidebar2-content',
			'class_wrap'        => 'sidebar2-content',
			'primary_sidebar'   => true,
			'secondary_sidebar' => true,
			'fullheight'        => true,
		),
	);
	
// 	if ( $input == 'sidebars' ) {
// 		return $layouts[$layout_class]['sidebars'];
// 	} elseif ( $input == 'class_body') {
// 		return $layouts[$layout_class]['class_body'];
// 	} elseif ( $input == 'fullheight') {
// 		return $layouts[$layout_class]['fullheight'];
// 	} else {
// 		return $layouts[$layout_class]['class_wrap'];
// 	}
	return $layouts[$layout_class][$input];
}


// Reuters Image fix
function dp_reuters_img_fix( $img, $size='medium' ) {
	
	if ( strpos( $img, '/resources/r/' ) !== false AND strpos( $img, 'reutersmedia.net' ) === false) {
		
		if ( $size == 'full') {
			$img = str_replace("w=400", "w=800", $img);
		}
		
		$img = str_replace("/resources/", "https://www.reuters.com/resources/", $img);
		
	}

	return $img;
}
/**
 * Logo
 */
/*function disruptpress_logo_url () {
	$url = get_theme_mod( 'dp_logo_settings_logo_upload', '' );
	
	if ( $url ) {
		return '<div class="title-logo"><img src="' . $url . '"></div>';
	} else {
		return '';
	}
}*/

/*function disruptpress_logo_style () {
	return get_theme_mod( 'dp_logo_settings_title_style', '0' ); 
}*/	

////Test shortcode to see PHP saved Kirki values in comparison with JavaScript values
//function foobar_func( $atts ){
//	 $a = shortcode_atts( array(
//		'val' => 'something',
//	), $atts );
//
//	return var_dump( get_theme_mod( $a['val'], 'No value found.' ) );
//}
//add_shortcode( 'GET_THEME_MOD_VALUE', 'foobar_func' );

// Enable shortcodes in text widgets
//add_filter('widget_text','do_shortcode');

// Global Shortcodes
function disruptpress_shortcode_year() {
    $year = date('Y');
    return $year;
}
add_shortcode('dp_year', 'disruptpress_shortcode_year');

function disruptpress_shortcode_blog_name() {
    return get_bloginfo( 'name' );
}
add_shortcode('dp_website_name', 'disruptpress_shortcode_blog_name');

function disruptpress_shortcode_blog_url() {
    return get_bloginfo( 'url' );
}
add_shortcode('dp_url', 'disruptpress_shortcode_blog_url');

function disruptpress_shortcode_blog_description() {
    return get_bloginfo( 'description' );
}
add_shortcode('dp_website_description', 'disruptpress_shortcode_blog_description');

function disruptpress_shortcode_demo_ad_300x600() {
    return '<div style="
display: block;
height: 600px;
background: #CCC;
background: url(\'' . get_bloginfo( 'url' ) . '/wp-content/themes/disruptpress/img/example_300600.jpg\') center center;
"></div>';
}
add_shortcode('dp_demo_ad_300x600', 'disruptpress_shortcode_demo_ad_300x600');


function disruptpress_shortcode_demo_ad_300x600_2() {
    return '<div style="
display: block;
height: 600px;
background: #CCC;
background: url(\'' . get_bloginfo( 'url' ) . '/wp-content/themes/disruptpress/img/example_300600_2.jpg\') center center;
"></div>';
}
add_shortcode('dp_demo_ad_300x600_2', 'disruptpress_shortcode_demo_ad_300x600_2');

function disruptpress_shortcode_demo_ad_fullx90() {
    return '<div style="
display: block;
max-width:1050px;
height: 90px;
background: #CCC;
background: url(\'http://dp.aobrien.org/wp-content/themes/disruptpress/img/example_105090.jpg\') left center;
"></div>
';
}
add_shortcode('dp_demo_ad_fullx90', 'disruptpress_shortcode_demo_ad_fullx90');

function disruptpress_shortcode_demo_ad_fullx90_2() {
    return '<div style="
display: block;
max-width:1050px;
height: 90px;
background: #CCC;
background: url(\'http://dp.aobrien.org/wp-content/themes/disruptpress/img/example_105090_2.jpg\') left center;
"></div>
';
}
add_shortcode('dp_demo_ad_fullx90_2', 'disruptpress_shortcode_demo_ad_fullx90_2');


function disruptpress_shortcode_demo_ad_468x60() {
    return '<div style="
display: block;
width:468px;
height: 60px;
background: #CCC;
background: url(\'http://dp.aobrien.org/wp-content/themes/disruptpress/img/example_46860.jpg\') center center;
"></div>
';
}
add_shortcode('dp_demo_ad_468x60', 'disruptpress_shortcode_demo_ad_468x60');


function disruptpress_theme_copyright() {
    global $disruptpress_theme_options;
    return $disruptpress_theme_options['dp-footer-theme-copyright'];
}
//add_shortcode('dp_full_theme_copyright', 'disruptpress_shortcode_full_theme_copyright');

function disruptpress_copyright_disclaimer() {
    global $disruptpress_theme_options;
    return $disruptpress_theme_options['dp-footer-copyright-disclaimer'];
}

function disruptpress_header_code_injection() {
    global $disruptpress_theme_options;
    echo $disruptpress_theme_options['dp-code-header'];
}
add_action('wp_head', 'disruptpress_header_code_injection');

function disruptpress_footer_code_injection() {
    global $disruptpress_theme_options;
    echo $disruptpress_theme_options['dp-code-footer'];
}
add_action( 'wp_footer', 'disruptpress_footer_code_injection' );
//add_shortcode('dp_full_copyright_disclaimer', 'disruptpress_shortcode_full_copyright_disclaimer');

function disruptpress_amazon_top_ad() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['dp-amazon-ad-top-enabled'] == true AND dp_check_ad_disabled() ) {
	// 		echo '<script type="text/javascript">
    // amzn_assoc_placement = "adunit0";
    // amzn_assoc_search_bar = "false";
    // amzn_assoc_tracking_id = "' . $disruptpress_theme_options['dp-amazon-id'] . '";
    // amzn_assoc_ad_mode = "search";
    // amzn_assoc_ad_type = "smart";
    // amzn_assoc_marketplace = "amazon";
    // amzn_assoc_region = "US";
    // amzn_assoc_title = "";
    // amzn_assoc_default_search_phrase = "' . $disruptpress_theme_options['dp-amazon-ad-top-search-term'] . '";
    // amzn_assoc_default_category = "All";
    // amzn_assoc_rows = "' . $disruptpress_theme_options['dp-amazon-ad-top-rows'] . '";
    // amzn_assoc_search_bar_position = "top";
    // </script>
    // <script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script>';
    echo '<div><h3>Products You May Like</h3><div id="dp_amazon_ads1" class="dp_amazon_ads"></div>
<div id="dp_amazon_ads_disclaimer1" class="dp_amazon_ads_disclaimer"><a href="https://affiliate-program.amazon.com/" target="_blank">Ads by Amazon</a></div></div>';

		}
	//}

}
add_action('disruptpress_before_the_content', 'disruptpress_amazon_top_ad');

function disruptpress_amazon_bottom_ad() {
    global $disruptpress_theme_options;
    global $post;

	//if ( is_array( $disruptpress_theme_options['ads-disabled-pages'] ) ) {
		if ( $disruptpress_theme_options['dp-amazon-ad-bottom-enabled'] == true AND dp_check_ad_disabled() ) {
	// 		echo '<div><h3>Products You May Like</h3><script type="text/javascript">
    // amzn_assoc_placement = "adunit0";
    // amzn_assoc_search_bar = "false";
    // amzn_assoc_tracking_id = "' . $disruptpress_theme_options['dp-amazon-id'] . '";
    // amzn_assoc_ad_mode = "search";
    // amzn_assoc_ad_type = "smart";
    // amzn_assoc_marketplace = "amazon";
    // amzn_assoc_region = "US";
    // amzn_assoc_title = "";
    // amzn_assoc_default_search_phrase = "' . $disruptpress_theme_options['dp-amazon-ad-bottom-search-term'] . '";
    // amzn_assoc_default_category = "All";
    // amzn_assoc_rows = "' . $disruptpress_theme_options['dp-amazon-ad-bottom-rows'] . '";
    // amzn_assoc_search_bar_position = "top";
    // </script>
    // <script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US"></script></div>';
    echo '<div><h3>Products You May Like</h3><div id="dp_amazon_ads2" class="dp_amazon_ads"></div>
<div id="dp_amazon_ads_disclaimer2" class="dp_amazon_ads_disclaimer"><a href="https://affiliate-program.amazon.com/" target="_blank">Ads by Amazon</a></div></div>';

		}
	//}

}
add_action('disruptpress_after_entry_content', 'disruptpress_amazon_bottom_ad');



// Header Arragement
function dp_header_arrangement( $input ) {
	$position = array_search( $input, get_theme_mod( 'dp_sort_header_arrangement' ) );
	
	return $position;
	
}

// function dp_fullyloaded() {
// 	add_action( 'disruptpress_header', 'disruptpress_do_header', get_theme_mod( 'dp_sort_header_arrangement_test1' ) );
// 	add_action( 'disruptpress_header', 'disruptpress_do_nav_primary', get_theme_mod( 'dp_sort_header_arrangement_test2' ) );
// }
// add_action( 'wp_loaded', 'dp_fullyloaded' );



function disruptpress_title_area( $selector = 'dp_header_logo', $is_menu = false ) {
	
	$title_area_toggle = get_theme_mod( $selector . '_toggle', '1' );
	
	if ($is_menu == false OR $title_area_toggle == true AND $is_menu == true ) {
		$logo_url = get_theme_mod( $selector . '_upload', '' );
		$title_toggle = get_theme_mod( $selector . '_title_toggle', '2' );
		$title_style = get_theme_mod( $selector . '_title_style', '0' );
		$tagline_toggle = get_theme_mod( $selector . '_tagline_toggle', '2' );

		if ( $title_toggle == '2' ) {
			$title = get_bloginfo( 'name', 'display' );
		} elseif ( $title_toggle == '3') {
			$title = get_theme_mod( $selector . '_title_custom', '' );
		} else {
			$title = '';
		}

		if ( $tagline_toggle == '2' ) {
			$tagline = get_bloginfo( 'description', 'display' );
		} elseif ( $tagline_toggle == '3') {
			$tagline = get_theme_mod( $selector . '_tagline_custom', '' );
		} else {
			$tagline = '';
		}

		$output = '<div class="title-area">';

		//if ( $logo_url ) {
			//$output .= '<div class="title-logo"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><img src="' . $logo_url . '"></a></div>';
		$output .= '<div class="title-logo"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home"><div class="title-logo-img"></div></a></div>';
		//}

		$output .= '<div class="site-title-wrap">';

		if ( is_front_page() && is_home() ) {
			$output .= '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="dp-font-style-' . $title_style . '">' . $title . '</a></h1>';
		}	else {
			$output .= '<div class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home" class="dp-font-style-' . $title_style . '">' . $title . '</a></div>';
		}

		$output .= '<div class="site-description">' . $tagline . '</div>
			</div>
		</div>';
	} else {
		$output = '';
	}
	return $output;
}

/**
 * Add Logo to Primary Menu
 */
function disruptpress_primary_menu_add_logo ( $items, $args ) {
	
  if ( $args->theme_location == 'primary' &&  dp_theme_mod( 'dp_primary_menu_logo_toggle' ) == '1' ) {
		$home_button = '<li class="dp-nav-primary-logo">' . disruptpress_title_area( 'dp_primary_menu_logo', true ) . '</li>';

	} else {
		$home_button = '';
	}

	return $home_button.$items;
}
add_filter( 'wp_nav_menu_items', 'disruptpress_primary_menu_add_logo', 10, 2 );






/**
 * Custom Blog Posts
 */
function dp_grid_posts() {

    global $disruptpress_theme_options;
	global $wp_query;
	global $cat;
	global $paged;

    $grid_enabled = $disruptpress_theme_options['dp-grid-status'];

    if( empty( $disruptpress_theme_options['dp-grid-category-select'] ) ) {
        $select_categories = 0;
    } else {
        $select_categories = $disruptpress_theme_options['dp-grid-category-select'];
    }


    if ( is_front_page() AND $grid_enabled AND !is_paged() ) {


    $rows = $disruptpress_theme_options['dp-grid-row-count'];
    $row1 = $disruptpress_theme_options['dp-grid-layout-row-1'];
    $row2 = $disruptpress_theme_options['dp-grid-layout-row-2'];
    $row3 = $disruptpress_theme_options['dp-grid-layout-row-3'];
    $duplicates = $disruptpress_theme_options['dp-grid-duplicates'];

    if( $duplicates ) {
        $skip = disruptpress_slider_post_ids();
    } else {
        $skip = '';
    }

    if( $rows == 1 ) {
        $item_limit = $row1;
    } elseif( $rows == 2 ) {
        $item_limit = $row1 + $row2;
    } elseif( $rows == 3 ) {
        $item_limit = $row1 + $row2 + $row3;
    }

    $output = '';
    //$item_limit = get_theme_mod( 'dp_front_page_grid_item_limit', '6' );
    //$category_input = get_theme_mod( 'dp_front_page_grid_container_category', '0' );
	//Set arguments for WP_Query
	$args = array(
		'post_type'				=> 'post',
		'posts_per_page'	=> $item_limit,
		'orderby'			=> 'date',
		'order'			=> "DESC",
		'cat'			=> $select_categories,
		//'offset'			=> "3",
		'paged'				=> $paged,
        'post__not_in'		=> $skip,
		//'ignore_sticky_posts' 	=> $input['ignore_sticky_posts']
	);

	$wp_query = new WP_Query( $args );


	//Opening Wrap
	$output .= '<div class="dp-grid-loop-fix">';
	$output .= '<div class="dp-grid-loop-wrap">';

	
	if( $wp_query->have_posts() && $item_limit != '0' ) {
		
		
		//$i = 0;
		
		//$i++;
		
		while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;
		
	//	if ($i++ == $item_limit) break;
			//$thumbnail = get_the_post_thumbnail( $post->ID, 'full' );
			//$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

			$image_featured = get_the_post_thumbnail_url( $post->ID, 'medium' );
			$image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

			if ( $image_featured ) {
				$thumbnail = ' style="background-image: url(\'' . $image_featured .'\')"';
			} else {
				$thumbnail = ' style="background-image: url(\'' . $image_featured_external .'\')"';
			}
		
		$cat ='';
		$i = 0;
		$separator = ', ';
		foreach( ( get_the_category() ) as $category ) {
			if ( $category->cat_name != 'Uncategorized' ) {
                if ( 0 < $i ) {
                    $cat .= $separator;
                }
                $cat .= $category->cat_name;
				$i ++;

				break; //only display first category
			}
		}
		
		$title = esc_attr( get_the_title());
		
		$output .= '
                    <div class="dp-grid-loop-wrap-parent"><a href="'.get_permalink().'">
					    <div class="dp-grid-loop-wrap-child"'.$thumbnail.'>
						    
								<div class="dp-grid-loop-image">
								    <div class="dp-grid-loop-content-wrap">
                                        <div class="dp-grid-loop-title">'.$title.'</div>
                                        <div class="dp-grid-loop-meta">
                                            <div class="dp-grid-loop-date">'.get_the_date().'</div>
                                            <div class="dp-grid-loop-cat">'.$cat.'</div>
                                        </div>
									</div>
								</div>
							
						</div></a>
					</div>';

		endwhile;

	

	} 
	//IF NO POSTS ARE FOUND
	else {
		if( $item_limit != '0' ) {
			$output .= 'No items found in this category.';
		}
	}

	$output .= '</div>';

	wp_reset_query();
	echo $output;
	echo '<div class="dp-grid-loop-wrap-bottom" style="clear:both"></div>';
    echo do_action( 'dp_below_grid_posts' );
    echo '</div>';

	}// End is paged
}

function dp_grid_posts_location() {

    //$location = get_theme_mod( 'dp_front_page_grid_container_location', false );

//    if( $location == true ) {
//        add_action('dp_main_content_top', 'dp_grid_posts');
//    } else {
//        add_action('dp_content_sidebar_wrap_top', 'dp_grid_posts');
//    }
    add_action('dp_content_sidebar_wrap_top', 'dp_grid_posts');
}
add_action( 'wp_loaded', 'dp_grid_posts_location' );


function dp_post_entry_header() {

    global $post;

    do_action( 'disruptpress_before_entry_header' );

    echo '<div class="entry-header-wrap"><header class="entry-header">';
    do_action( 'disruptpress_entry_header' );

    if ( is_single() OR is_page() ) {
        echo '<h1 class="entry-title">' . get_the_title($post->ID) . '</h1>';
    } else {
        echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>';
    }

    if ( 'post' === get_post_type() ) {
        echo '<p class="entry-meta">';
            disruptpress_posted_on();
        echo '</p>';

    }
    do_action( 'disruptpress_entry_header_end' );
    echo '</header></div>';

}

function dp_post_featured_image() {
	if ( is_single() OR is_page() ) {

        global $post;
        $image = get_the_post_thumbnail( $post->ID, 'full' );

        if ( $image ) {
            echo '<div class="post-featured-image">';
            echo do_action('disruptpress_post_featured_image');
            echo $image;
            echo '</div>';
        }
	}
}

function dp_post_featured_image_location() {
	$location = get_theme_mod( 'dp_page_featured_image_location', 'disruptpress_before_entry_content' );
    $priority = get_theme_mod( 'dp_page_featured_image_location_priority', '1' );
	add_action( $location, 'dp_post_featured_image', $priority );
}
add_action( 'wp_loaded', 'dp_post_featured_image_location' );


//function dp_post_title() {
//	global $post;
//
//	if ( is_single() ) {
//        echo '<div class="test"><h1 class="entry-title">' . get_the_title($post->ID) . '</h1></div>';
//	} else {
//        echo '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title($post->ID) . '</a></h2>';
//	}
//}

function dp_post_header_location() {
	$location = get_theme_mod( 'dp_page_header_location', 'disruptpress_before_entry_content' );
	$priority = get_theme_mod( 'dp_page_header_location_priority', '1' );
	add_action( $location, 'dp_post_entry_header', $priority );
}
add_action( 'wp_loaded', 'dp_post_header_location' );


function disruptpress_post_categories() {
    // Hide category and tag text for pages.
    global $post;


    if ( 'post' === get_post_type() ) {
        /* translators: used between list items, there is a space after the comma */
        //$categories_list = get_the_category_list( esc_html__( ', ', 'disruptpress' ) );
        //if ( $categories_list && disruptpress_categorized_blog() ) {
        //printf( '<div class="entry-categories-wrap"><span class="entry-categories">' . esc_html__( '%1$s', 'disruptpress' ) . '</span></div>', $categories_list ); // WPCS: XSS OK.
        //	}

        //$hide_default = get_theme_mod( 'dp_page_category_hide_default', '1' );
        $limit = get_theme_mod( 'dp_page_category_limit', '1' );
        $output = '';
        //$output .= '<div class="entry-categories-wrap"><span class="entry-categories">';
        $i = 0;
        $separator = ', ';


            foreach( get_the_category() as $category ) {
                if ( $category->cat_name != 'Uncategorized' ) {
                    if (0 < $i) {
                        $output .= $separator;
                    }
                    $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . $category->cat_name . '">' . $category->cat_name . '</a>';
                    $i++;
                    if (0 < $i && $limit == true ) {
                        break;
                    }
                }
            }
        //$output .= '</span></div>';

        //echo $output;

    }

    if ( $output ) {
        printf( '<div class="entry-categories-wrap"><span class="entry-categories">' . esc_html__( '%1$s', 'disruptpress' ) . '</span></div>', $output );
    }


}

function disruptpress_post_categories_location() {
    $location = get_theme_mod( 'dp_page_category_location', 'disruptpress_entry_header' );
    $priority = get_theme_mod( 'dp_page_category_location_priority', '1' );
    add_action( $location, 'disruptpress_post_categories', $priority );
}
add_action( 'wp_loaded', 'disruptpress_post_categories_location' );


function disruptpress_blog_roll_the_title () {
    echo '<div class="dp-blog-roll-loop-title-wrap"><div class="dp-blog-roll-loop-title"><a href="'.get_permalink().'"><h2>' . esc_attr( get_the_title() ) . '</h2></a>';
    echo do_action( 'disruptpress_blog_roll_below_title' );
    echo '</div></div>';
}
//add_action( 'disruptpress_blog_roll_container_1', 'disruptpress_blog_roll_the_title' );


function disruptpress_blog_roll_the_excerpt () {
    global $post;
    echo '<div class="dp-blog-roll-loop-excerpt-wrap">
            <div class="dp-blog-roll-loop-excerpt">' . get_the_excerpt() . '</div>
            <div class="dp-blog-roll-loop-read-more"><a class="dp-moretag" href="'. get_permalink($post->ID) . '"> <b>... read more</b></a></div>
          </div>';
}
//add_action( 'disruptpress_blog_roll_container_2', 'disruptpress_blog_roll_the_excerpt' );


function disruptpress_blog_roll_featured_image () {
    global $post;
    $image_featured = get_the_post_thumbnail_url( $post->ID, 'medium' );
    $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

    if ( $image_featured ) {
        $thumbnail = ' style="background-image: url(\'' . $image_featured .'\')"';
    } else {
        $thumbnail = ' style="background-image: url(\'' . $image_featured_external .'\')"';
    }

    //$thumbnail = get_the_post_thumbnail( $post->ID, 'full' );

//    if ( $thumbnail ) {
//        $image = $thumbnail;
//    } else {
//        $image = '<img src="' . get_stylesheet_directory_uri() . '/default_thumbnail.jpg' . '" class="attachment-full size-full wp-post-image" />';
//    }

    echo '<div class="dp-blog-roll-loop-featured-image"' . $thumbnail . '><a href="'.get_permalink().'" class="dp-blog-roll-loop-featured-image-link"></a>';
    echo do_action('disruptpress_blog_roll_featured_image');
    //echo '<a href="'.get_permalink().'">' . $image . '</a></div>';
    echo '</div>';
}
//add_action( 'disruptpress_blog_roll_container_2', 'disruptpress_blog_roll_featured_image', 1 );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more( $more ) {
    global $post;
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function disruptpress_blog_roll_location() {
    $location_title = get_theme_mod( 'dp_blog_roll_title_location', 'disruptpress_blog_roll_container_1' );
    $priority_title = get_theme_mod( 'dp_blog_roll_title_location_priority', '1' );
    add_action( $location_title, 'disruptpress_blog_roll_the_title', $priority_title );

    $location_image = get_theme_mod( 'dp_blog_roll_featured_image_location', 'disruptpress_blog_roll_container_2' );
    $priority_image = get_theme_mod( 'dp_blog_roll_featured_image_location_priority', '1' );
    add_action( $location_image, 'disruptpress_blog_roll_featured_image', $priority_image );

    $location_excerpt = get_theme_mod( 'dp_blog_roll_excerpt_location', 'disruptpress_blog_roll_container_2' );
    $priority_excerpt = get_theme_mod( 'dp_blog_roll_excerpt_location_priority', '2' );
    add_action( $location_excerpt, 'disruptpress_blog_roll_the_excerpt', $priority_excerpt );

    $location_meta = get_theme_mod( 'dp_blog_roll_meta_location', 'disruptpress_blog_roll_container_1' );
    $priority_meta = get_theme_mod( 'dp_blog_roll_meta_location_priority', '2' );
    add_action( $location_meta, 'disruptpress_blog_roll_meta', $priority_meta );

    $location_categories = get_theme_mod( 'dp_blog_roll_category_location', 'disruptpress_blog_roll_container_1' );
    $priority_categories = get_theme_mod( 'dp_blog_roll_category_location_priority', '2' );
    add_action( $location_categories, 'disruptpress_blog_roll_categories', $priority_categories );



}
add_action( 'wp_loaded', 'disruptpress_blog_roll_location' );


function disruptpress_blog_roll_meta() {
    global $post;
    $author_id=$post->post_author;

    echo '<div class="dp-blog-roll-loop-meta">';

    $time_string = '<time class="entry-time published updated" datetime="%1$s">%2$s</time>';
    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-time published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_attr( get_the_modified_date( 'c' ) ),
        esc_html( get_the_modified_date() )
    );

    $posted_on = sprintf( esc_html_x( '%s', 'post date', 'disruptpress' ), $time_string );

    $byline = sprintf(
        esc_html_x( 'by %s', 'post author', 'disruptpress' ),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name', $author_id ) ) . '</a></span>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . ' </span>'; // WPCS: XSS OK.



    echo '<span class="entry-comments-link"><a href="' . get_comments_link() . '">';

    printf( // WPCS: XSS OK.
        esc_html( _nx( '1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'disruptpress' ) ),
        number_format_i18n( get_comments_number() ),
        '<span>' . get_the_title() . '</span>'
    );

    echo '</a></span> ';

    echo '</div>';
//    edit_post_link(
//        esc_html__( '(Edit)', 'disruptpress' ),
//        '<span class="edit-link">',
//        '</span>'
//    );

}


function disruptpress_blog_roll_categories() {
    global $post;

    if ( 'post' === get_post_type() ) {
        $limit = get_theme_mod( 'dp_blog_roll_category_limit', '1' );
        $output = '';
        $i = 0;
        $separator = ' ';

        foreach( get_the_category() as $category ) {
            if ( $category->cat_name != 'Uncategorized' ) {
                if (0 < $i) {
                    $output .= $separator;
                }
                $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . $category->cat_name . '">' . $category->cat_name . '</a>';
                $i++;
                if (0 < $i && $limit == true ) {
                    break;
                }
            }
        }
    }

    if ( $output ) {
        printf( '<div class="dp-blog-roll-loop-categories"><span class="entry-categories">' . esc_html__( '%1$s', 'disruptpress' ) . '</span></div>', $output );
    }
}

function disruptpress_blog_roll() {
    global $post;

    $title = '
        <div class="dp-blog-roll-loop-title-wrap">
            <div class="dp-blog-roll-loop-title">
                <a href="'.get_permalink().'"><h2>' . esc_attr( get_the_title() ) . '</h2></a>
             </div>
        </div>
    ';


    echo '
        <div class="dp-blog-roll-loop-wrap">
            <div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-1">
            </div>
            
            <div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-2">
            </div>
            
            <div class="dp-blog-roll-loop-container dp-blog-roll-loop-container-3">
            </div>
        </div>
    ';


}

function disruptpress_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="dp-pagination"><ul>' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link() );

    echo '</ul></div>' . "\n";

}


function disruptpress_social_media_share( $float = false ) {

    if ( is_single() ) {
        $link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if ( $float ) {
            $float = ' dp-social-media-share-float';
        } else {
            $float = '';
        }

        echo '
            <div class="dp-social-media-share-wrap' . $float . '">
                <div class="dp-social-media-share-button dp-social-media-share-facebook"><a href="#" onclick="window.open(\'https://www.facebook.com/sharer/sharer.php?u=\'+encodeURIComponent(location.href),\'facebook-share-dialog\',\'width=626,height=436\');return false;"><i class="fa fa-facebook" aria-hidden="true""></i><span class="dp-social-media-share-text">Share on Facebook</span></a></div>
                <div class="dp-social-media-share-button dp-social-media-share-twitter"><a href="#" onclick="window.open(\'https://twitter.com/share?url=\'+escape(window.location.href)+\'&text=\'+document.title, \'\', \'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600\');return false;"><i class="fa fa-twitter" aria-hidden="true"></i><span class="dp-social-media-share-text">Share on Twitter</span></a></div>
                <div class="dp-social-media-share-button dp-social-media-share-pinterest"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i><span class="dp-social-media-share-text">Share on Pinterest</span></a></div>
                <div class="dp-social-media-share-button dp-social-media-share-linkedin"><a href="#" onclick="window.open(\'https://www.linkedin.com/shareArticle?mini=true&url=\'+escape(window.location.href)+\'&title=\'+document.title, \'\', \'width=626,height=436\');return false;"><i class="fa fa-linkedin" aria-hidden="true"></i><span class="dp-social-media-share-text">Share on LinkedIn</span></a></div>
            </div>
        ';
    }
}



function disruptpress_social_media_share_location() {

    if ( get_theme_mod( 'dp_social_share_location_top', false ) == true ) {
        add_action( 'disruptpress_before_the_content', 'disruptpress_social_media_share' );
    }

    if ( get_theme_mod( 'dp_social_share_location_bottom', false ) == true ) {
        add_action( 'disruptpress_after_entry_content', 'disruptpress_social_media_share', 5 );
    }

    if ( get_theme_mod( 'dp_social_share_location_float', false ) == true ) {
        add_action('disruptpress_before_the_content', function() {disruptpress_social_media_share(true); });
    }

}
add_action( 'wp_loaded', 'disruptpress_social_media_share_location');



/**
 * Related Blog Posts
 */
function dp_related_posts() {

    global $wp_query;
    global $cat;
    global $paged;
    global $post;

    if ( is_single() ) {
        $output = '';
        //Set arguments for WP_Query
        $args = array(
            'post_type'			=> 'post',
            'posts_per_page'	=> '5',
            'orderby'			=> 'rand',
            'post__not_in' => array($post->ID),
            'date_query' => array(
                'after' => date('Y-m-d', strtotime('-7 days'))
            ),
        );

        $wp_query = new WP_Query( $args );

        //Opening Wrap


        if( $wp_query->have_posts() ) {
            $output .= '<div class="dp-related-post-loop-container"><h3>Articles You May Like</h3>';

            while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;

                $image_featured = get_the_post_thumbnail_url( $post->ID, 'medium' );
                $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

                if ( $image_featured ) {
                    $thumbnail = ' style="background-image: url(\'' . $image_featured .'\')"';
                } else {
                    $thumbnail = ' style="background-image: url(\'' . $image_featured_external .'\')"';
                }

                $title = esc_attr( get_the_title());

                $output .= '
                        <div class="dp-related-post-loop-wrap">
                            <div class="dp-related-post-featured-image"'.$thumbnail.'><a href="'.get_permalink().'" class="dp-blog-roll-loop-featured-image-link"></a></div>
                            <div class="dp-related-post-title-wrap">
                                <div class="dp-related-post-title"><a href="'.get_permalink().'">'.$title.'</div></a>
                            </div>
                        </div>';

            endwhile;
            $output .= '</div>
                        <div class="dp-related-post-loop-wrap-bottom" style="clear:both"></div>';
        }
        //IF NO POSTS ARE FOUND
        else {
            $output .= '';
        }



        wp_reset_query();
        echo $output;
    }

}
add_action( 'disruptpress_after_entry_content', 'dp_related_posts', 12);

function disruptpress_enqueue_scripts_slider() {

    wp_enqueue_script( 'bxslider',  get_stylesheet_directory_uri() . '/bxslider/jquery.bxslider.min.js', array(), '1.0.0'  );
    wp_enqueue_style( 'bxslider-css',  get_stylesheet_directory_uri() . '/bxslider/jquery.bxslider.min.css', true );

}
add_action( 'wp_enqueue_scripts', 'disruptpress_enqueue_scripts_slider'  );

function dpNumberToBoolean($number) {
    if($number === '1') {
        return 'true';
    }

    if($number === '0') {
        return 'false';
    }
}

function slider_script() {

    global $disruptpress_theme_options;
    $speed = 1000 * $disruptpress_theme_options['dp-slider-transition-speed'];

    echo '<script type="text/javascript">
jQuery(document).ready(function(){
		jQuery(\'.bxslider\').bxSlider({
			mode: \'horizontal\',
			moveSlides: 1,
			slideMargin: 40,
            infiniteLoop: true,
            touchEnabled : (navigator.maxTouchPoints > 0),
			captions: true,
			autoStart: true,
			auto: true,
			speed: ' . $speed . ',
		});
	});

    jQuery(document).ready(function(){

        const dpAmazonSearchKeyword1 = "'. $disruptpress_theme_options['dp-amazon-ad-top-search-term'].'";
        const dpAmazonSearchKeyword2 = "'. $disruptpress_theme_options['dp-amazon-ad-bottom-search-term'].'";
        const dpAmazonSearchKeyword3 = "'. $disruptpress_theme_options['dp-amazon-ad-widget-1-search-term'].'";
        const dpAmazonSearchKeyword4 = "'. $disruptpress_theme_options['dp-amazon-ad-widget-2-search-term'].'";

        const dpRowAmazonAd1 = '. $disruptpress_theme_options['dp-amazon-ad-top-rows'].';
        const dpRowAmazonAd2 = '. $disruptpress_theme_options['dp-amazon-ad-bottom-rows'].';
        const dpRowAmazonAd3 = '. $disruptpress_theme_options['dp-amazon-ad-widget-1-rows'].';
        const dpRowAmazonAd4 = '. $disruptpress_theme_options['dp-amazon-ad-widget-2-rows'].';

        const dpEnableAmazonAd1 = '.dpNumberToBoolean($disruptpress_theme_options['dp-amazon-ad-top-enabled']).';
        const dpEnableAmazonAd2 = '.dpNumberToBoolean($disruptpress_theme_options['dp-amazon-ad-bottom-enabled']).';
        const dpEnableAmazonAd3 = true;
        const dpEnableAmazonAd4 = true;

        const dpAmazonAdsCacheDuration = 86400; //86400 = 24hours
        const dpCurrentUnixTimeStamp = Math.floor(Date.now() / 1000);

        const dpAmazonAdsCountryTags = {
            "ES": "'.$disruptpress_theme_options['dp-amazon-id-es'].'",
            "CA": "'.$disruptpress_theme_options['dp-amazon-id-uk'].'",
            "DE": "'.$disruptpress_theme_options['dp-amazon-id-de'].'",
            "FR": "'.$disruptpress_theme_options['dp-amazon-id-fr'].'",
            "GB": "'.$disruptpress_theme_options['dp-amazon-id-uk'].'",
            "IT": "'.$disruptpress_theme_options['dp-amazon-id-it'].'",
            "JP": "'.$disruptpress_theme_options['dp-amazon-id-jp'].'",
            "US": "'.$disruptpress_theme_options['dp-amazon-id'].'",
        };

        const dpAmazonGeoLocations = {
            "ES": "ES",
            "CA": "CA",
            "DE": "DE",
            "FR": "FR",
            "GB": "GB",
            "IT": "IT",
            "JP": "JP",
            "US": "US",
            
            "IE": "GB",
            "CH": "DE",
            "AT": "DE",
        };

        const dpAmazonGeoLocationsMarkets = {
            "ES": "//ws-eu.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=ES&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "CA": "//ws-na.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=CA&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "DE": "//ws-eu.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=DE&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "FR": "//ws-eu.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=FR&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "GB": "//ws-eu.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=GB&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "IT": "//ws-eu.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=IT&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "JP": "//ws-fe.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=JP&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
            "US": "//ws-na.amazon-adsystem.com/widgets/q?callback=search_callback&MarketPlace=US&Operation=GetResults&InstanceId=0&dataType=jsonp&TemplateId=MobileSearchResults&ServiceVersion=20070822",
        };

        function dpGetAmazonMarketURL(countryCode) {

            if(dpAmazonGeoLocations.hasOwnProperty(countryCode)) {
                return dpAmazonGeoLocationsMarkets[dpAmazonGeoLocations[countryCode]];
            } else {
                return dpAmazonGeoLocationsMarkets["US"];
            }
        }

        function dpGetAmazonCountryTag(countryCode) {

            if(dpAmazonGeoLocations.hasOwnProperty(countryCode)) {
                return dpAmazonAdsCountryTags[dpAmazonGeoLocations[countryCode]];
            } else {
                return dpAmazonAdsCountryTags["US"];
            }
        }

        async function dpDisplayAmazonAds() {

            async function dpGetPublicIP() {
                try {
                    let response = await fetch("//api.ipify.org/?format=json");

                    if (!response.ok) {
                        throw new Error(`HTTP error! Can"t get public IP from api.ipify.org. Status: ${response.status}`);
                        return false;
                    }

                    let getIP = await response.json();

                    return getIP.ip;

                } catch(e) {
                    return false;
                }
            }

            async function dpGetGeoLocation() {
                let localStorageIP = localStorage.getItem("dp_ip");
                let localStorageGeoLocation = localStorage.getItem("dp_geoLocation");

                //Get new Geo Location if IP changed, OR cache doesn"t exist
                if(localStorageGeoLocation === null || localStorageIP != dpPublicIP) {

                    return jQuery.ajax({
                        url: "//json.geoiplookup.io/"+dpPublicIP+"?callback=dp_geoip_callback",
                        dataType: "jsonp",
                        jsonpCallback: "dp_geoip_callback",
                        success: function(data){
                            localStorage.setItem("dp_geoLocation", data["country_code"]);
                    
                        }, error: function() {
                            localStorage.setItem("dp_geoLocation", "US");
                        }
                    });
                    
                }
            }

            //Saves Amazon Search Keywords to localStorage and returns true if one of the keywords has changed.
            function dpAmazonAdsSearchKeywords() {
                let output = false;
                let localStorageAmazonKeyword1 = localStorage.getItem("dp_amazon_keyword1");
                let localStorageAmazonKeyword2 = localStorage.getItem("dp_amazon_keyword2");
                let localStorageAmazonKeyword3 = localStorage.getItem("dp_amazon_keyword3");
                let localStorageAmazonKeyword4 = localStorage.getItem("dp_amazon_keyword4");

                if(localStorageAmazonKeyword1 === null || localStorageAmazonKeyword1 != dpAmazonSearchKeyword1) {
                    localStorage.setItem("dp_amazon_keyword1", dpAmazonSearchKeyword1);
                    output = true;
                }

                if(localStorageAmazonKeyword2 === null || localStorageAmazonKeyword2 != dpAmazonSearchKeyword2) {
                    localStorage.setItem("dp_amazon_keyword2", dpAmazonSearchKeyword2);
                    output = true;
                }

                if(localStorageAmazonKeyword3 === null || localStorageAmazonKeyword3 != dpAmazonSearchKeyword3) {
                    localStorage.setItem("dp_amazon_keyword3", dpAmazonSearchKeyword3);
                    output = true;
                }

                if(localStorageAmazonKeyword4 === null || localStorageAmazonKeyword4 != dpAmazonSearchKeyword4) {
                    localStorage.setItem("dp_amazon_keyword4", dpAmazonSearchKeyword4);
                    output = true;
                }

                return output;
            }

            //Returns true if cache has expired.
            function dpAmazonAdsIsCacheExpired() {
                let output = false;
                let localStorageAmazonCacheExpiration = localStorage.getItem("dp_amazon_cache_expiration");

                if(localStorageAmazonCacheExpiration === null || dpCurrentUnixTimeStamp >= parseInt(localStorageAmazonCacheExpiration)) {
                    output = true;
                }

                return output;
            }

            //Fetch Amazon ads
            async function dpAmazonAdsFetchJSONP() {
                let localStorageGeoLocation = localStorage.getItem("dp_geoLocation");
                let i = 1;
            
                async function dpAmazonAjaxLoop() {

                    if(i === 5) {
                        dpRenderAmazonAds();
                        return;
                    }

                    let dpAmazonSearchKeyword = localStorage.getItem("dp_amazon_keyword" + i);

                    if(dpAmazonSearchKeyword === null || dpAmazonSearchKeyword == "") {
                        dpAmazonSearchKeyword = "Echo";
                    }

                    jQuery.ajax({
                        url: dpGetAmazonMarketURL(localStorageGeoLocation) + `&Keywords=${dpAmazonSearchKeyword}`,
                        dataType: "jsonp",
                        async: false,
                        jsonpCallback: "search_callback",
                        success: function(data){
                            localStorage.setItem("dp_amazon_cached_json" + i, JSON.stringify(data));
                            i++;

                            dpAmazonAjaxLoop();
                        }
                    });
                }

                localStorage.setItem("dp_amazon_cache_expiration", (dpCurrentUnixTimeStamp + dpAmazonAdsCacheDuration));

                let output = await dpAmazonAjaxLoop();

                return output;
            }

            function dpAmazonAdsHTML(dataJSON, adNumber, maxItems) {
                let localStorageGeoLocation = localStorage.getItem("dp_geoLocation");

                for(let [i, result] of dataJSON.results.entries()){

                    if(i == maxItems) break;

                    let listPrice = result["ListPrice"];
                    let prime = "";
                    let reviews = "";
                    let pageURL = result["DetailPageURL"] + "/?tag=" + dpGetAmazonCountryTag(localStorageGeoLocation);


                    if(listPrice != "") {
                        listPrice = `<div class="dp_amazon_ad_listprice">${listPrice}</div>`;
                    }

                    if(result["IsPrimeEligible"] == "1") {
                        prime = `<div class="dp_amazon_ad_prime"><img src="'.get_stylesheet_directory_uri().'/img/prime.png"></div>`;
                    }

                    if(result["TotalReviews"] != "" && result["Rating"] != "") {
                        let rating = Math.round(result["Rating"]*2)/2;

                        reviews = `<div class="dp_amazon_ad_rating Stars" style="--rating: ${rating};">
                                    <div class="dp_amazon_ad_reviews">(${parseInt(result["TotalReviews"]).toLocaleString()})</div>
                                </div>`;
                    }

                    let amazonAd = `
                        <div class="dp_amazon_ad">
                            <a href="${pageURL}" target="_blank">
                                <div class="dp_amazon_ad_img"><img src="${result["ImageUrl"]}"></div>
                                <div class="dp_amazon_ad_title">${result["Title"]}</div>
                                <div class="dp_amazon_ad_price">${result["Price"]}
                                    ${listPrice}
                                    ${prime}
                                </div>
                                ${reviews}
                            </a>
                        </div>`;

                    let getAmazonAdsElement = document.getElementById("dp_amazon_ads" + adNumber);
                    if (typeof(getAmazonAdsElement) != "undefined" && getAmazonAdsElement != null) {
                        let dp_amazon_ads = document.getElementById("dp_amazon_ads" + adNumber).innerHTML;
                        document.getElementById("dp_amazon_ads" + adNumber).innerHTML = dp_amazon_ads + amazonAd;
                    }
                    
                }
            }

            function dpRenderAmazonAds() {
                if(dpEnableAmazonAd1 === true) {
                    let AmazonJSONCached1 = localStorage.getItem("dp_amazon_cached_json1");

                    if(AmazonJSONCached1 !== null) {
                        dpAmazonAdsHTML(JSON.parse(AmazonJSONCached1), "1", dpRowAmazonAd1 * 4);
                    }
                }

                if(dpEnableAmazonAd2 === true) {
                    let AmazonJSONCached2 = localStorage.getItem("dp_amazon_cached_json2");
                    
                    if(AmazonJSONCached2 !== null) {
                        dpAmazonAdsHTML(JSON.parse(AmazonJSONCached2), "2", dpRowAmazonAd2 * 4);
                    }
                }

                if(dpEnableAmazonAd3 === true) {
                    let AmazonJSONCached3 = localStorage.getItem("dp_amazon_cached_json3");
                    
                    if(AmazonJSONCached3 !== null) {
                        dpAmazonAdsHTML(JSON.parse(AmazonJSONCached3), "3", dpRowAmazonAd3 * 2);
                    }
                }

                if(dpEnableAmazonAd4 === true) {
                    let AmazonJSONCached4 = localStorage.getItem("dp_amazon_cached_json4");
                    
                    if(AmazonJSONCached4 !== null) {
                        dpAmazonAdsHTML(JSON.parse(AmazonJSONCached4), "4", dpRowAmazonAd4 * 2);
                    }
                }
                    
            }

            function dpAmazonAdsCheckJSONCache() {
                let AmazonJSONCached1 = localStorage.getItem("dp_amazon_cached_json1");
                let AmazonJSONCached2 = localStorage.getItem("dp_amazon_cached_json2");
                let AmazonJSONCached3 = localStorage.getItem("dp_amazon_cached_json3");
                let AmazonJSONCached4 = localStorage.getItem("dp_amazon_cached_json4");
                    
                if(AmazonJSONCached1 === null || AmazonJSONCached2 === null || AmazonJSONCached3 === null || AmazonJSONCached4 === null) {
                    return true;
                }

                return false;
            }

            const dpPublicIP = await dpGetPublicIP();

            if(dpPublicIP === false) {
                console.log("Failed to get IP. Aborting Amazon Ads.")
                return
            };

            const dpGeoLocation = await dpGetGeoLocation();
            let dpEmptyCache = false;

            if(dpPublicIP != localStorage.getItem("dp_ip")) {
                dpEmptyCache = true;
            }
            localStorage.setItem("dp_ip", dpPublicIP);

            const dpIsCacheExpired = dpAmazonAdsIsCacheExpired();
            const dpSearchKeywords = dpAmazonAdsSearchKeywords();

            if(dpAmazonAdsCheckJSONCache() === true) {
                dpEmptyCache = true;
            }

            if(dpIsCacheExpired === true || dpSearchKeywords === true || dpEmptyCache === true) {
                dpAmazonAdsFetchJSONP();
            } else {
                dpRenderAmazonAds();
            }
        }

        let getAmazonAdsElement1 = document.getElementById("dp_amazon_ads1");
        let getAmazonAdsElement2 = document.getElementById("dp_amazon_ads2");
        let getAmazonAdsElement3 = document.getElementById("dp_amazon_ads3");
        let getAmazonAdsElement4 = document.getElementById("dp_amazon_ads4");

        if (getAmazonAdsElement1 != null || getAmazonAdsElement2 != null || getAmazonAdsElement3 != null || getAmazonAdsElement4 != null) {
            dpDisplayAmazonAds();
        }
    });
</script>';
}
add_action('wp_head', 'slider_script');

function dp_get_first_post_id_of_each_cat( $cat = 0 ) {

    if ( $cat == 0 ) {
        $cat_ids = array();

        foreach ( get_terms('category','parent=0&hide_empty=0') as $category_object ) {
            $cat_ids[] = $category_object->term_id;
        }
    } else {
        $cat_ids = $cat;
    }

    //Get IDs of all first posts of categories
   // $first_categories = get_categories();
    $first_post_ids = array();

    foreach ( $cat_ids as $category ) {

        $args = array(
            'cat' => $category,
           // 'cat' => '4',
            'post_type' => 'post',
            'posts_per_page' => '1',
            'orderby'			=> 'date',
            'order'			=> 'DESC',
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {

            while ( $query->have_posts() ) {
                $query->the_post();
                $first_post_ids[] = get_the_ID();
                //echo 'ID: '. get_the_ID();
            }
        }
    }
    wp_reset_postdata();
    return $first_post_ids;
    //var_dump($first_post_ids);
}

/**
 * Slider Layouts
 */
function disruptpress_slider_layout( $input = 1 ) {

    $layouts = array(
        '1' => array(
            'slider_width'          => '70%',
            'slider_aspect_ratio'   => '169',
            'slider_sidebar_items'  => '3'
        ),

        '2' => array(
            'slider_width'          => '70%',
            'slider_aspect_ratio'   => '169',
            'slider_sidebar_items'  => '2'
        ),

        '3' => array(
            'slider_width'          => '100%',
            'slider_aspect_ratio'   => '169',
            'slider_sidebar_items'  => '0'
        ),

        '4' => array(
            'slider_width'          => '70%',
            'slider_aspect_ratio'   => '219',
            'slider_sidebar_items'  => '2'
        ),

        '5' => array(
            'slider_width'          => '100%',
            'slider_aspect_ratio'   => '219',
            'slider_sidebar_items'  => '0'
        ),

    );

    return $layouts[$input];
}

/**
 * Slider
 */
function disruptpress_slider() {

    global $disruptpress_theme_options;
    global $wp_query;
    global $cat;
    global $paged;
    global $post;
   // $slider_enabled = dp_theme_mod( 'dp_slider_enabled' );
    $slider_enabled = $disruptpress_theme_options['dp-slider-status'];
    //$select_categories = $disruptpress_theme_options['dp-slider-category-select'];

    if( empty( $disruptpress_theme_options['dp-slider-category-select'] ) ) {
        $select_categories = 0;
    } else {
        $select_categories = $disruptpress_theme_options['dp-slider-category-select'];
    }


    if ( $disruptpress_theme_options['dp-slider-one-category'] == true ) {
        $post_ids = dp_get_first_post_id_of_each_cat( $select_categories );
        $offset = count( $post_ids );
    } else {
        $post_ids = 0;
        $offset = $disruptpress_theme_options['dp-slider-count'];
    }


    // Slider query
    if ( is_front_page() AND $slider_enabled AND !is_paged() ) {
        $output = '<div style="position:relative;height:100%;">';

        //Set arguments for WP_Query
        $args = array(
            'post_type'			=> 'post',
            'posts_per_page'	=> $disruptpress_theme_options['dp-slider-count'],
            'post__in'	        => $post_ids,
            'orderby'			=> 'date',
            'order'			=> 'DESC',
            'cat'               => $select_categories,
            //'post__not_in' => array($post->ID),
            'date_query' => array(
                //'after' => date('Y-m-d', strtotime('-7 days'))
            ),
        );

        $wp_query = new WP_Query( $args );

        if( $wp_query->have_posts() ) {
           // $slider_width = dp_theme_mod( 'dp_slider_width' );
            $slider_width = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_width'];

            //$slider_aspect_ration = dp_theme_mod( 'dp_slider_aspect_radio' );
            $slider_aspect_ration = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_aspect_ratio'];
            $slider_sidebar_items = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_sidebar_items'];

            if ( $slider_width == "100%") {

                $slider_style = 'width:100%;';
            } else {
                $slider_style = 'width:calc(70% - 15px);margin-right:15px;';
            }
            $output .= '<div class="dp-slider" style="' . $slider_style . 'float:left;"><ul class="bxslider" style="position: relative; ">';

            while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;

                $image_featured = get_the_post_thumbnail_url( $post->ID, 'large' );
                $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

                if ( $image_featured ) {
                    $thumbnail = $image_featured;
                } else {
                    $thumbnail = $image_featured_external;
                }

                $title = esc_attr( get_the_title());

                if ( $thumbnail ){
                $output .= '
                       <li class="" style="background-image: url(\'' . $thumbnail .'\');background-size: cover;background-repeat: no-repeat;background-position: center center;"><a href="'.get_permalink().'" ><img src="' . get_stylesheet_directory_uri() . '/bxslider/images/blank_'.$slider_aspect_ration.'.png" title="' . $title . '"  /></a>
                </li>';
                }

            endwhile;

            $output .= '</ul></div>';

        }
        //IF NO POSTS ARE FOUND
        else {
            $output .= '';
        }

        //Sidebar
        if ( $slider_width != "100%") {




            if ( $slider_aspect_ration == "219" ) {
                $padding_bottom = 'calc(50% - 10px);';
                //$slider_sidebar_items = '2';
            } else {
                //$slider_sidebar_items = dp_theme_mod( 'dp_slider_sidebar_items' );
                if ( $slider_sidebar_items == "2") {
                    $padding_bottom = 'calc(60% + 12px);';
                } else {
                    $padding_bottom = 'calc(40% + 3px);';
                }
            }
            //Set arguments for WP_Query
            $args = array(
                'post_type'			=> 'post',
                'offset' => $offset,
                'post__in'	        => $post_ids,
                'posts_per_page'	=> $slider_sidebar_items,
                'orderby'			=> 'date',
                'cat'               => $select_categories,
								'ignore_sticky_posts' => true,
               // 'post__not_in' => array($post->ID),
                'date_query' => array(
                    //'after' => date('Y-m-d', strtotime('-7 days'))
                ),
            );

            $wp_query = new WP_Query( $args );

            if( $wp_query->have_posts() ) {

                while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;

                    $image_featured = get_the_post_thumbnail_url( $post->ID, 'medium' );
                    $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

                    if ( $image_featured ) {
                        $thumbnail = $image_featured;
                    } else {
                        $thumbnail = $image_featured_external;
                    }

                    $title = esc_attr( get_the_title());

                    if ( $thumbnail ){
                        $output .= '<div class="dp-grid-loop-wrap-parent" style="width: 30%;padding:0px"> <a href="'.get_permalink().'">
                            <div class="dp-grid-loop-wrap-child" style="margin-bottom:15px;padding-bottom:'.$padding_bottom.';background-image: url(\''.$thumbnail.'\')">
                               
                                    <div class="dp-grid-loop-image">
                                        <div class="dp-grid-loop-content-wrap">
                                            <div class="dp-grid-loop-title" style="font-size: 16px;">' . $title . '</div>
                                            
                                        </div>
                                    </div>
                               
                            </div> </a>
                        </div>';
                    }

                endwhile;


            }
            //IF NO POSTS ARE FOUND
            else {
                $output .= '';
            }

        }//if has sidebar end

        //Closing
        $output .= '</div><div style="clear: both"></div>';

        wp_reset_query();
        //var_dump(disruptpress_slider_post_ids()) ;
        echo $output;

    }//Closing is_front_page()

}
add_action( 'disruptpress_wrap_entry', 'disruptpress_slider' );

/**
 * Slider Post IDs
 */
function disruptpress_slider_post_ids() {

    global $disruptpress_theme_options;
    global $wp_query;
    global $cat;
    global $paged;
    global $post;

    $slider_post_ids = array();

   // $slider_enabled = dp_theme_mod( 'dp_slider_enabled' );
    $slider_enabled = $disruptpress_theme_options['dp-slider-status'];
    //$select_categories = $disruptpress_theme_options['dp-slider-category-select'];

    if( empty( $disruptpress_theme_options['dp-slider-category-select'] ) ) {
        $select_categories = 0;
    } else {
        $select_categories = $disruptpress_theme_options['dp-slider-category-select'];
    }


    if ( $disruptpress_theme_options['dp-slider-one-category'] == true ) {
        $post_ids = dp_get_first_post_id_of_each_cat( $select_categories );
        $offset = count( $post_ids );
    } else {
        $post_ids = 0;
        $offset = $disruptpress_theme_options['dp-slider-count'];
    }


    // Slider query
    if ( is_front_page() AND $slider_enabled AND !is_paged() ) {

        //Set arguments for WP_Query
        $args = array(
            'post_type'			=> 'post',
            'posts_per_page'	=> $disruptpress_theme_options['dp-slider-count'],
            'post__in'	        => $post_ids,
            'orderby'			=> 'date',
            'order'			=> 'DESC',
            'cat'               => $select_categories,
            //'post__not_in' => array($post->ID),
            'date_query' => array(
                //'after' => date('Y-m-d', strtotime('-7 days'))
            ),
        );

        $wp_query = new WP_Query( $args );

        if( $wp_query->have_posts() ) {
           // $slider_width = dp_theme_mod( 'dp_slider_width' );
            $slider_width = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_width'];

            //$slider_aspect_ration = dp_theme_mod( 'dp_slider_aspect_radio' );
            $slider_aspect_ration = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_aspect_ratio'];
            $slider_sidebar_items = disruptpress_slider_layout( $disruptpress_theme_options['dp-slider-layout'] )['slider_sidebar_items'];

            if ( $slider_width == "100%") {

                $slider_style = 'width:100%;';
            } else {
                $slider_style = 'width:calc(70% - 15px);margin-right:15px;';
            }

            while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;

                $image_featured = get_the_post_thumbnail_url( $post->ID, 'large' );
                $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

                if ( $image_featured ) {
                    $thumbnail = $image_featured;
                } else {
                    $thumbnail = $image_featured_external;
                }

                $title = esc_attr( get_the_title());

                if ( $thumbnail ){
                    $slider_post_ids[] = get_the_ID();
                }

            endwhile;



        }
        //IF NO POSTS ARE FOUND
        else {

        }

        //Sidebar
        if ( $slider_width != "100%") {




            if ( $slider_aspect_ration == "219" ) {
                $padding_bottom = 'calc(50% - 10px);';
                //$slider_sidebar_items = '2';
            } else {
                //$slider_sidebar_items = dp_theme_mod( 'dp_slider_sidebar_items' );
                if ( $slider_sidebar_items == "2") {
                    $padding_bottom = 'calc(60% + 12px);';
                } else {
                    $padding_bottom = 'calc(40% + 3px);';
                }
            }
            //Set arguments for WP_Query
            $args = array(
                'post_type'			=> 'post',
                'offset' => $offset,
                'post__in'	        => $post_ids,
                'posts_per_page'	=> $slider_sidebar_items,
                'orderby'			=> 'date',
                'cat'               => $select_categories,
								'ignore_sticky_posts' => true,
               // 'post__not_in' => array($post->ID),
                'date_query' => array(
                    //'after' => date('Y-m-d', strtotime('-7 days'))
                ),
            );

            $wp_query = new WP_Query( $args );

            if( $wp_query->have_posts() ) {

                while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;

                    $image_featured = get_the_post_thumbnail_url( $post->ID, 'medium' );
                    $image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

                    if ( $image_featured ) {
                        $thumbnail = $image_featured;
                    } else {
                        $thumbnail = $image_featured_external;
                    }

                    $title = esc_attr( get_the_title());

                    if ( $thumbnail ){
                        $slider_post_ids[] = get_the_ID();
                    }

                endwhile;


            }
            //IF NO POSTS ARE FOUND
            else {

            }

        }//if has sidebar end

        //Closing


        wp_reset_query();


    }//Closing is_front_page()
    return $slider_post_ids;
}


// DisruptPress Front Page Widgets



// CSS updates
function dp_css_updates() {

    global $disruptpress_theme_options;

    if( $disruptpress_theme_options['dp-disable-source-link'] ) {
        $source_link = 'none';
    } else {
        $source_link = 'block';
    }

    $dp_blog_roll_title_font_size = dp_theme_mod( 'dp_blog_roll_title_font_size' );
    $dp_blog_roll_title_font_weight = dp_theme_mod( 'dp_blog_roll_title_font_weight' );
    $dp_blog_roll_title_text_align = dp_theme_mod( 'dp_blog_roll_title_text_align' );

    $row_array = array(
        '2' => array(
            'width'             => '50%',
            'font_size_title'   => '22',
            'font_size_meta'    => '14'
        ),

        '3' => array(
            'width'             => '33%',
            'font_size_title'   => '16',
            'font_size_meta'    => '12'
        ),

        '4' => array(
            'width'             => '25%',
            'font_size_title'   => '14',
            'font_size_meta'    => '12'
        ),

        '5' => array(
            'width'             => '20%',
            'font_size_title'   => '12',
            'font_size_meta'    => '11'
        ),
    );

    $rows = $disruptpress_theme_options['dp-grid-row-count'];
    $row1 = $disruptpress_theme_options['dp-grid-layout-row-1'];
    $row2 = $disruptpress_theme_options['dp-grid-layout-row-2'];
    $row3 = $disruptpress_theme_options['dp-grid-layout-row-3'];

    $row_css = '';


        $row_css .= '
        
.dp-grid-loop-wrap-parent:nth-child(n+1):nth-child(-n+'.$row1.') {
    width: '.$row_array[$row1]['width'].';
}
.dp-grid-loop-wrap-parent:nth-child(n+1):nth-child(-n+'.$row1.') .dp-grid-loop-title {
    font-size: '.$row_array[$row1]['font_size_title'].'px;
}
.dp-grid-loop-wrap-parent:nth-child(n+1):nth-child(-n+'.$row1.') .dp-grid-loop-meta {
    font-size: '.$row_array[$row1]['font_size_meta'].'px;
}


.dp-grid-loop-wrap-parent:nth-child(n+' . ($row1 + 1) .'):nth-child(-n+'.($row1 + $row2).') {
    width: '.$row_array[$row2]['width'].';
}
.dp-grid-loop-wrap-parent:nth-child(n+' . ($row1 + 1) .'):nth-child(-n+'.($row1 + $row2).') .dp-grid-loop-title {
    font-size: '.$row_array[$row2]['font_size_title'].'px;
}
.dp-grid-loop-wrap-parent::nth-child(n+' . ($row1 + 1) .'):nth-child(-n+'.($row1 + $row2).') .dp-grid-loop-meta {
    font-size: '.$row_array[$row2]['font_size_meta'].'px;
}


.dp-grid-loop-wrap-parent:nth-child(n+' . ($row1 + $row2 + 1) .'):nth-child(-n+'.($row1 + $row2 + $row3).') {
    width: '.$row_array[$row3]['width'].';
}
.dp-grid-loop-wrap-parent:nth-child(n+' . ($row1 + $row2 + 1) .'):nth-child(-n+'.($row1 + $row2 + $row3).') .dp-grid-loop-title {
    font-size: '.$row_array[$row3]['font_size_title'].'px;
}
.dp-grid-loop-wrap-parent::nth-child(n+' . ($row1 + $row2 + 1) .'):nth-child(-n+'.($row1 + $row2 + $row3).') .dp-grid-loop-meta {
    font-size: '.$row_array[$row3]['font_size_meta'].'px;
}



        ';
   

	$css = '
	
#dp_source_link {
	display:' . $source_link . ' !important;
}	
	
.dp-social-media-follow-instagram a {
	background-color: #9C27B0;
}

.dp-social-media-follow-youtube a {
    background-color: #FF0000;
}

.site-header .title-logo {
	height: inherit;
}

@media only screen and (max-width: 768px) {

	.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
			margin-right: 0px !important;
	}
}

@media only screen and (max-width: 600px) {

	.woocommerce ul.products li.last, .woocommerce-page ul.products li.last {
			margin-right: 0px !important;
	}
	.woocommerce ul.products[class*=columns-] li.product, .woocommerce-page ul.products[class*=columns-] li.product {
		width: 100%;
	}
}

@media only screen and (max-width: 767px) {
	
	.dp-slider {
		width: calc(100% - 15px) !important;
	}
	.dp-grid-loop-wrap-parent {
		width: 100% !important;
	}
	.dp-grid-loop-title {
		font-size:16px !important;
	}
}

@media only screen and (max-width: 1023px) {
	
	.dp-grid-loop-title {
		font-size:15px !important;
	}
}	


/* ## Front Page Grid
--------------------------------------------- */

.dp-grid-loop-wrap {
	margin-top: 0px;	
}

.dp-grid-loop-wrap-bottom {
	margin-bottom: 50px;
}

.dp-grid-loop-wrap-parent {
	position: relative;
	width: 50%;
	float:left;
	padding: 5px;
}

.dp-grid-loop-wrap-child {
	overflow:hidden;
	border-radius: 0px;
	position: relative;
	padding-bottom: calc(100% * 9 / 16);
	background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}

.dp-grid-loop-image img {
	position: absolute;
	height: 100%;
    width: 100%;
	background-position: top center;
}

.dp-grid-loop-content-wrap {
	position: absolute;
	bottom: 0;
	background: rgba(10,0,0,0.5);
	width: 100%;
	height: auto;
	padding: 10px;
	color: #fff;
	line-height: 1.4;
}

.dp-grid-loop-title {
	overflow:hidden;
	font-size: 16px;
	font-weight: 400;
	color: #FFFFFF;
}

.dp-grid-loop-content {
	position: absolute;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
}

.dp-grid-loop-meta {
	font-size: 12px;
	color: #FFFFFF;
}

.dp-grid-loop-date {
	display: inline-block;
}

.dp-grid-loop-cat {
	display: inline-block;
	float: right;
}





/*** H2 fix ***/
.dp-blog-roll-loop-title h2 {
    font-size: ' . $dp_blog_roll_title_font_size . 'px;
    font-size: ' . $dp_blog_roll_title_font_size / 10 . 'rem;
    font-weight: ' . $dp_blog_roll_title_font_weight . ';
    text-align: ' . $dp_blog_roll_title_text_align . ';
}

@media only screen and (max-width: 600px) {

    .dp-blog-roll-loop-title h2 {
		font-size: 20px;
		font-weight: 700;
	}
}


/*** Amazon Ads ***/

.dp_amazon_ad_rating {
    --percent: calc(var(--rating) / 5 * 100%);
    display: inline-block;
    font-size: 14px;
    line-height: 1;
    height: 16px;
    margin-top: 5px;
}

.dp_amazon_ad_rating::before {
    content: "★★★★★";
    letter-spacing: 0;
    background: linear-gradient(90deg, #fc0 var(--percent), #fff var(--percent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 16px;
}

.dp_amazon_ads {
    width: 100%;
    display: grid;
    gap: 15px;
    grid-template-columns: repeat(4, 1fr);
    font-family: Arial,Helvetica,sans-serif;
}

.dp_amazon_ads a {
    text-decoration: none;
}

.dp_amazon_ad {
    display: inline-block;
    border: 1px solid #ccc;
    padding: 10px 10px 5px 10px;
    background: #FFFFFF;
}

.dp_amazon_ad_img {
    position: relative;
    padding-top: 56.25%;
    margin: 0;
    width: 100%;
}

.dp_amazon_ad_img img {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.dp_amazon_ad_title {
    font-size: 15px;
    line-height: 1.2;
    height: 2.4em;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-top: 10px;
    margin-bottom: 15px;
    color: blue;
}

.dp_amazon_ad:hover .dp_amazon_ad_title {
    color: #f90;
}

.dp_amazon_ad_price {
    font-weight: bold;
    color: #000000;
    font-size: 14px;
    line-height: 1;
}

.dp_amazon_ad_listprice {
    display: inline-block;
    font-size: 12px;
    color: #4a4a4a;
    text-decoration: line-through;
}

.dp_amazon_ad_prime {
    display: inline-block;
    height: 15px;
}

.dp_amazon_ad_prime img {
    height: 100%;
}

.dp_amazon_ad_reviews {
    display: inline-block;
    color: #000000;
}

.dp_amazon_ads_disclaimer {
    display: block;
    margin-top: 3px;
    margin-bottom: 3px;
    text-align: right;
    font-size: 11px;
    font-weight: bold;
    padding: 10px 3px;
    font-family: Arial,Helvetica,sans-serif;
}

.dp_amazon_ads_disclaimer a {
    text-decoration: none;
    color: #777;
}

.dp_amazon_ads_widget {
    grid-template-columns: repeat(2, 1fr);
}


'.$row_css.'
';
     
	wp_add_inline_style( 'disruptpress-style', $css );
}
add_action( 'wp_enqueue_scripts', 'dp_css_updates' );


function dp_og_image_fix() {
	 
	if ( is_singular()) {
		global $post;
		$image_featured = get_the_post_thumbnail_url( $post->ID, 'full' );
		$image_featured_external = get_post_meta( $post->ID, _disruptpress_efi_url(), true );

		if ( $image_featured ) {
			echo '<meta property="og:image" content="' . esc_attr( $image_featured ) . '" />';
		} elseif( $image_featured_external ) {
			echo '<meta property="og:image" content="' . esc_attr( $image_featured_external ) . '" />';
		} else {
			
		}
		 
		echo '
	<meta property="og:image:width" content="1024" />
	<meta property="og:image:height" content="1024" />
	
	';
	}
}

add_action('wp_head', 'dp_og_image_fix', 1);

// WooCommerce layout support
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'dp_woocommerce_content_wrapper_start', 10);
function dp_woocommerce_content_wrapper_start() {

  echo '<div class="' . disruptpress_default_site_layout( 'class_wrap' ) . '-wrap">
	<div id="disruptpress-content" class="content" role="main">';
}
add_action('woocommerce_after_main_content', 'dp_woocommerce_content_wrapper_end', 10);
function dp_woocommerce_content_wrapper_end() {
  echo '</div></div>';
}


// WooCommerce - Add and remove product thumbnails in loop to avoid SSL issues with external images
add_action( 'woocommerce_before_shop_loop_item_title', 'dp_woocommerce_template_loop_product_thumbnail', 10);

add_action( 'wp_head', 'dp_woocommerce_loop_remove_original_thumbnail' );
function dp_woocommerce_loop_remove_original_thumbnail(){
   remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
}

if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function dp_woocommerce_template_loop_product_thumbnail() {
		echo dp_woocommerce_get_product_thumbnail();
	} 
}
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
	function dp_woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post, $woocommerce;
		
		return get_the_post_thumbnail( $post->ID, $size );
	}
}

// WooCommerce flash sales percentage
add_filter('woocommerce_sale_flash', 'dp_woocommerce_sale_flash_percentage');
function dp_woocommerce_sale_flash_percentage($text) {
    global $product;
    $percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
    return '<span class="onsale">'.$percentage.'% off</span>';  
}   

// WooCommerce add percentage after price on product page
add_filter( 'woocommerce_get_price_html', 'dp_woocommerce_product_page_price_adjustment', 100, 2 );
function dp_woocommerce_product_page_price_adjustment( $price, $product ){
	if(is_product()){
		$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
    //return 'Regular Price: ' . str_replace( '<ins>', '<br>Now: <ins>', $price );
    return $price.' ('.$percentage.'% off)';
	} else {
		return $price;
	}
}

// WooCommerce disable review tab
add_filter( 'woocommerce_product_tabs', 'dp_woocommerce_remove_reviews_tab', 98 );
function dp_woocommerce_remove_reviews_tab($tabs) {
	 unset($tabs['reviews']);
	 return $tabs;
}

// WooCommerce rename cart button
add_filter( 'woocommerce_product_single_add_to_cart_text', 'dp_woocommerce_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'dp_woocommerce_custom_cart_button_text' );
function dp_woocommerce_custom_cart_button_text() {
	return __( 'Add To Cart', 'woocommerce' );
}

// WooCommerce add link to amazon description on product page
function dp_woocommerce_amazon_description_link(  ) {
	global $disruptpress_theme_options;
	
	$asin = get_post_meta( get_the_ID(), 'product_asin', true );
	echo '<p>
	<a href="https://www.amazon.com/dp/'.$asin.'/?tag=' . $disruptpress_theme_options['dp-amazon-id'] . '" rel="nofollow" class="aawp-button aawp-button--buy aawp-button aawp-button--amazon aawp-button--icon aawp-button--icon-amazon-black" target="_blank">See Full Product Details On Amazon</a>
</p>';
	
}; 
add_action( 'woocommerce_after_add_to_cart_button', 'dp_woocommerce_amazon_description_link'); 


// Declare WooComme Theme Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
// // WooCommerce higher image quality (not working)
// function action_woocommerce_product_thumbnails(  ) {
// 	$product_imgs = get_post_meta( get_the_ID(), 'product_imgs', true );
	
// 	if(product_imgs) {
// 		$imgs = explode(',', $product_imgs);
		
// 		foreach($imgs as $img) {
// 			$img = trim($img);
// 			$img_l = str_replace('.jpg', '._SL1000_.jpg', $img);
			
// 			echo '<div data-thumb="' . $img . '" class="woocommerce-product-gallery__image"><a href="' . $img_l . '"><img width="461" height="500" src="' . $img . '" class="attachment-shop_single size-shop_single" alt="" title="' . $img . '" data-caption="" data-src="' . $img . '"></a></div>';
// 		}
		
// 	}
// }
// add_action( 'woocommerce_product_thumbnails', 'action_woocommerce_product_thumbnails' ); 



// //WooCommerce limit item title on shop page
// if ( class_exists( 'WooCommerce' ) ) {
// 	add_filter( 'the_title', 'shorten_my_title', 10, 2 );
// 	function shorten_my_title( $title, $id ) {
// 		if ( is_shop() && get_post_type( $id ) === 'product' && strlen( $title ) > 50 ) {
// 			return substr( $title, 0, 50 ) . '...'; // change 50 to the number of characters you want to show
// 		} else {
// 			return $title;
// 	}
// }
// }

function dp_reuters_no_img_removal () {
	$args = array(
		'numberposts' => 5,
		'offset' => 0,
		'category' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' =>'',
		'post_type' => 'post',
		'post_status' => 'draft, publish, future, pending, private',
		'suppress_filters' => true
	);

	$recent_posts = wp_get_recent_posts( $args );

	foreach( $recent_posts as $recent ){

		$image_featured_external = get_post_meta( $recent["ID"], '_nelioefi_url', true );

		if ( $image_featured_external == '/resources_v2/images/rcom-default.png' ) {
				wp_delete_post( $recent["ID"] );
			}
	}

	wp_reset_query();

}
//add_action('init', 'dp_reuters_no_img_removal');



function disruptpress_admin_css() {
    echo '<style>

#section-table-dp-grid-section-start tr {
    border-bottom: 0px solid #e7e7e7;
}

  </style>';
}
add_action('admin_head', 'disruptpress_admin_css');

function dp_clear_cache() {
    if ( is_plugin_active( 'wp-fastest-cache/wpFastestCache.php' ) ) {
        $foobar = new WpFastestCache;  // correct
        $foobar->deleteCssAndJsCacheToolbar();
    } 
}

add_action('redux/options/disruptpress_theme_options/saved', 'dp_clear_cache');

function dp_check_ad_disabled() {
    global $disruptpress_theme_options;
    global $post;

    if( is_array($disruptpress_theme_options['ads-disabled-pages'])){
        if( in_array( $post->ID, $disruptpress_theme_options['ads-disabled-pages'] )) {
            return false;
        } else {
            return true;
        }
    } else {
        return true;
    }
}