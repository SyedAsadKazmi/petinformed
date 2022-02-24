<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "disruptpress_theme_options";

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'DisruptPress Theme Options' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( '1.0' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
    'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '_theme_options',
    // Page slug used to denote the panel
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => false,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    //'allow_sub_menu' => false,
    //'hide_expand' => true,
    //'open_expanded' => true,
    //'compiler'             => true,

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'light',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    )
);

// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
//     $args['admin_bar_links'][] = array(
//         'id'    => 'redux-docs',
//         'href'  => 'http://docs.reduxframework.com/',
//         'title' => __( 'Documentation', 'redux-framework-demo' ),
//     );

//     $args['admin_bar_links'][] = array(
//         //'id'    => 'redux-support',
//         'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
//         'title' => __( 'Support', 'redux-framework-demo' ),
//     );

//     $args['admin_bar_links'][] = array(
//         'id'    => 'redux-extensions',
//         'href'  => 'reduxframework.com/extensions',
//         'title' => __( 'Extensions', 'redux-framework-demo' ),
//     );

//     // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
//     $args['share_icons'][] = array(
//         'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
//         'title' => 'Visit us on GitHub',
//         'icon'  => 'el el-github'
//         //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
//     );
//     $args['share_icons'][] = array(
//         'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
//         'title' => 'Like us on Facebook',
//         'icon'  => 'el el-facebook'
//     );
//     $args['share_icons'][] = array(
//         'url'   => 'http://twitter.com/reduxframework',
//         'title' => 'Follow us on Twitter',
//         'icon'  => 'el el-twitter'
//     );
//     $args['share_icons'][] = array(
//         'url'   => 'http://www.linkedin.com/company/redux-framework',
//         'title' => 'Find us on LinkedIn',
//         'icon'  => 'el el-linkedin'
//     );

// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
    if ( ! empty( $args['global_variable'] ) ) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace( '-', '_', $args['opt_name'] );
    }
    $args['intro_text'] = sprintf( __( '', 'redux-framework-demo' ), $v );
} else {
    $args['intro_text'] = __( '', 'redux-framework-demo' );
}

// Add content after the form.
$args['footer_text'] = __( '<p>DisruptPress Theme created by <a href="http://www.aedanobrien.com" target="_blank">Aedan O\'Brien</a></p>', 'redux-framework-demo' );

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

//     $tabs = array(
//         array(
//             'id'      => 'redux-help-tab-1',
//             'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
//             'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
//         ),
//         array(
//             'id'      => 'redux-help-tab-2',
//             'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
//             'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
//         )
//     );
//     Redux::setHelpTab( $opt_name, $tabs );

// Set the help sidebar
$content = __( '', 'redux-framework-demo' );
Redux::setHelpSidebar( $opt_name, $content );


/*
 * <--- END HELP TABS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

/*

    As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


 */

// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'  => __( 'Social Media Pages', 'redux-framework-demo' ),
    'id'     => 'dp-social-media',
    'desc'   => __( 'Enter your social media links below. These links will be displayed in the sidebar using the Widget "Social Media Pages". You can rearrange, add or remove the widget by going to the Widget area here in the WordPress Admin Panel - Appearance - Widgets. <br />Note: To disable a specific social media page, leave the URL field empty.', 'redux-framework-demo' ),
    'icon'   => 'fa fa-share-alt',
    'fields'     => array(



//        array(
//            'id'       => 'dp-fb-link',
//            'type'     => 'text',
//            'title'    => __( 'Facebook Page', 'redux-framework-demo' ),
//            'description' => __( 'Example: https://www.facebook.com/WordPress/', 'redux-framework-demo' ),
//            'subtitle'     => __( 'Create a Facebook page <a href="https://www.facebook.com/pages/create/" target="_blank">here</a>', 'redux-framework-demo' ),
//            'default'  => '',
//        ),

//        array(
//            'id'       => 'dp-fb-name',
//            'type'     => 'text',
//            'title'    => __( 'Facebook Page Name', 'redux-framework-demo' ),
//            'description' => __( 'Use shortcode: <b>[dp_website_name]</b> to automatically use your websites name, or manually enter a name above.', 'redux-framework-demo' ),
//            'subtitle'     => __( 'Necessary the "Facebook Like Box" widget', 'redux-framework-demo' ),
//            'default'  => '[dp_website_name]',
//            'class'  => 'option-dp-fb-name',
//        ),

        array(
            'id'       => 'dp-fb-link',
            'type'     => 'text',
            'title'    => __( 'Facebook Page URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://www.facebook.com/WordPress/', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Facebook page <a href="https://www.facebook.com/pages/create/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://www.facebook.com/WordPress/',
        ),



        array(
            'id'       => 'dp-twitter-link',
            'type'     => 'text',
            'title'    => __( 'Twitter Page URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://twitter.com/WordPress', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Twitter account <a href="https://twitter.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://twitter.com/WordPress',
        ),

        // array(
        //     'id'       => 'dp-google-link',
        //     'type'     => 'text',
        //     'title'    => __( 'Google+ Page URL', 'redux-framework-demo' ),
        //     'description' => __( 'Example: https://plus.google.com/+WordPress', 'redux-framework-demo' ),
        //     'subtitle'     => __( 'Create a Google+ account <a href="https://plus.google.com/" target="_blank">here</a> and then go to "Join Google+"', 'redux-framework-demo' ),
        //     'default'  => 'https://plus.google.com/+WordPress',
        // ),

        array(
            'id'       => 'dp-pinterest-link',
            'type'     => 'text',
            'title'    => __( 'Pinterest Page URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://www.pinterest.com/wikipedia/', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Pinterest account <a href="https://www.pinterest.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://www.pinterest.com/wikipedia/',
        ),

        array(
            'id'       => 'dp-linkedin-link',
            'type'     => 'text',
            'title'    => __( 'LinkedIn Page URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://www.linkedin.com/company-beta/1089783/', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a LinkedIn account <a href="https://www.linkedin.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://www.linkedin.com/company-beta/1089783/',
        ),
      
        array(
            'id'       => 'dp-instagram-link',
            'type'     => 'text',
            'title'    => __( 'Instagram Page URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://www.instagram.com/wildlifeplanet/', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create an Instagram account <a href="https://www.instagram.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://www.instagram.com/wildlifeplanet/',
        ),

        array(
            'id'       => 'dp-youtube-link',
            'type'     => 'text',
            'title'    => __( 'YouTube URL', 'redux-framework-demo' ),
            'description' => __( 'Example: https://www.youtube.com/user/TEDtalksDirector', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a YouTube (Google) account <a href="https://accounts.google.com/SignUp" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'https://www.youtube.com/user/TEDtalksDirector',
        ),


    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Amazon Affiliate', 'redux-framework-demo' ),
    'id'     => 'dp-amazon-affiliate',
    'desc'   => __( 'The Amazon ads will automatically show ads from the relevant countries of the visitors. If a country is not supported, the ad will show products from the US Amazon store.<br><br>
    Note: When creating Amazon affiliate accounts for European countries, you only have to create 1 account manually, Amazon then offers you to automatically create accounts for the other European countries and will supply you with individual tracking IDs for each country. Creating the accounts automatically can either be done during the registration process of the first European account, or afterwards inside of your European Amazon affiliate account. ', 'redux-framework-demo' ),
    'icon'   => 'fa fa-amazon',
    'fields'     => array(


        array(
            'id'       => 'dp-amazon-id',
            'type'     => 'text',
            'title'    => __( 'Amazon Tracking ID USA (Default)', 'redux-framework-demo' ),
            'description' => __( 'Example: disruptpress-us-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create an Amazon Affiliate account <a href="https://affiliate-program.amazon.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-us-20',
        ),

        array(
            'id'       => 'dp-amazon-id-uk',
            'type'     => 'text',
            'title'    => __( 'UK Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a UK Amazon Affiliate account <a href="https://affiliate-program.amazon.co.uk/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-uk-21',
        ),

        array(
            'id'       => 'dp-amazon-id-ca',
            'type'     => 'text',
            'title'    => __( 'Canadian Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Canadian Amazon Affiliate account <a href="https://associates.amazon.ca/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-ca-20',
        ),

        array(
            'id'       => 'dp-amazon-id-de',
            'type'     => 'text',
            'title'    => __( 'German Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a German Amazon Affiliate account <a href="https://partnernet.amazon.de/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-de-21',
        ),

        array(
            'id'       => 'dp-amazon-id-fr',
            'type'     => 'text',
            'title'    => __( 'French Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a French Amazon Affiliate account <a href="https://partenaires.amazon.fr/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-fr-21',
        ),

        array(
            'id'       => 'dp-amazon-id-it',
            'type'     => 'text',
            'title'    => __( 'Italian Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create an Italian Amazon Affiliate account <a href="https://programma-affiliazione.amazon.it/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-it-21',
        ),

        array(
            'id'       => 'dp-amazon-id-es',
            'type'     => 'text',
            'title'    => __( 'Spanish Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Spanish Amazon Affiliate account <a href="https://afiliados.amazon.es/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-es-21',
        ),

        array(
            'id'       => 'dp-amazon-id-jp',
            'type'     => 'text',
            'title'    => __( 'Japanese Amazon Tracking ID', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Create a Japanese Amazon Affiliate account <a href="https://affiliate.amazon.co.jp/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => 'disruptpress-jp-22',
        ),

       


        array(
            'id' => 'dp-amazon-ad-top-section-start',
            'type' => 'section',
            'title'    => __( 'Amazon Top Ad', 'redux-framework-demo' ),
            'subtitle'     => __( 'This ad will be displayed at the top of the content.', 'redux-framework-demo' ),
            'indent' => true
        ),

        array(
            'id'       => 'dp-amazon-ad-top-enabled',
            'type'     => 'switch',
            'title'    => __( 'Enable Top Ad', 'redux-framework-demo' ),
            'default' => '1'
        ),

        array(
            'id'       => 'dp-amazon-ad-top-search-term',
            'type'     => 'text',
            'title'    => __( 'Search Term', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Enter a keyword or key phrase which will be used to search for relevant products.', 'redux-framework-demo' ),
            'default' => 'laptops',
            'required' => array('dp-amazon-ad-top-enabled','equals','1')
        ),

        array(
            'id'       => 'dp-amazon-ad-top-rows',
            'type'     => 'button_set',
            'title'    => __( 'Product Rows', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'The amount of product rows that will be displayed.', 'redux-framework-demo' ),
            'options' => array(
                '1' => '1',
                '2' => '2',
            ),
            'default' => '1',
            'required' => array('dp-amazon-ad-top-enabled','equals','1')
        ),

    array(
        'id'     => 'dp-amazon-ad-top-section-end',
        'type'   => 'section',
        'indent' => false,
    ),




        array(
            'id' => 'dp-amazon-ad-bottom-section-start',
            'type' => 'section',
            'title'    => __( 'Amazon Bottom Ad', 'redux-framework-demo' ),
            'subtitle'     => __( 'This ad will be displayed at the bottom of the content.', 'redux-framework-demo' ),
            'indent' => true
        ),

        array(
            'id'       => 'dp-amazon-ad-bottom-enabled',
            'type'     => 'switch',
            'title'    => __( 'Enable Bottom Ad', 'redux-framework-demo' ),
            'default' => '1'
        ),

        array(
            'id'       => 'dp-amazon-ad-bottom-search-term',
            'type'     => 'text',
            'title'    => __( 'Search Term', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Enter a keyword or key phrase which will be used to search for relevant products.', 'redux-framework-demo' ),
            'default' => 'echo',
            'required' => array('dp-amazon-ad-bottom-enabled','equals','1')
        ),

        array(
            'id'       => 'dp-amazon-ad-bottom-rows',
            'type'     => 'button_set',
            'title'    => __( 'Product Rows', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'The amount of product rows that will be displayed.', 'redux-framework-demo' ),
            'options' => array(
                '1' => '1',
                '2' => '2',
            ),
            'default' => '2',
            'required' => array('dp-amazon-ad-bottom-enabled','equals','1')
        ),

        array(
            'id'     => 'dp-amazon-ad-bottom-section-end',
            'type'   => 'section',
            'indent' => false,
        ),




        array(
            'id' => 'dp-amazon-ad-widget-1-section-start',
            'type' => 'section',
            'title'    => __( 'Amazon Ad Widget #1', 'redux-framework-demo' ),
            'subtitle'     => __( 'This ad will be displayed inside of the "Amazon Ad #1" widget. Assign this widget to a widget area inside of "Appearance > Widgets".', 'redux-framework-demo' ),
            'indent' => true
        ),


        array(
            'id'       => 'dp-amazon-ad-widget-1-search-term',
            'type'     => 'text',
            'title'    => __( 'Search Term', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Enter a keyword or key phrase which will be used to search for relevant products.', 'redux-framework-demo' ),
            'default' => 'echo',
        ),

        array(
            'id'       => 'dp-amazon-ad-widget-1-rows',
            'type'     => 'button_set',
            'title'    => __( 'Product Rows', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'The amount of product rows that will be displayed.', 'redux-framework-demo' ),
            'options' => array(
                '1' => '1',
                '2' => '2',
            ),
            'default' => '2',
        ),

        array(
            'id'     => 'dp-amazon-ad-widget-1-section-end',
            'type'   => 'section',
            'indent' => false,
        ),


        array(
            'id' => 'dp-amazon-ad-widget-2-section-start',
            'type' => 'section',
            'title'    => __( 'Amazon Ad Widget #2', 'redux-framework-demo' ),
            'subtitle'     => __( 'This ad will be displayed inside of the "Amazon Ad #2" widget. Assign this widget to a widget area inside of "Appearance > Widgets".', 'redux-framework-demo' ),
            'indent' => true
        ),


        array(
            'id'       => 'dp-amazon-ad-widget-2-search-term',
            'type'     => 'text',
            'title'    => __( 'Search Term', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Enter a keyword or key phrase which will be used to search for relevant products.', 'redux-framework-demo' ),
            'default' => 'laptops',
        ),

        array(
            'id'       => 'dp-amazon-ad-widget-2-rows',
            'type'     => 'button_set',
            'title'    => __( 'Product Rows', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'The amount of product rows that will be displayed.', 'redux-framework-demo' ),
            'options' => array(
                '1' => '1',
                '2' => '2',
            ),
            'default' => '2',
        ),

        array(
            'id'     => 'dp-amazon-ad-widget-2-section-end',
            'type'   => 'section',
            'indent' => false,
        ),


    ),
) );



// -> START Basic Fields
Redux::setSection( $opt_name, array(
    'title'  => __( 'Ad Manager', 'redux-framework-demo' ),
    'id'     => 'basic',
    'desc'   => __( 'Enter your ad codes into the fields below. Each field corresponds to a specific location on the website. Make sure you enter the exact code as provided by your ad program.', 'redux-framework-demo' ),
    'icon'   => 'el el-usd',
    'fields'     => array(

        array(
            'id'       => 'ad-page-level',
            'type'     => 'textarea',
            'title'    => __( '&lt;head&gt; code', 'redux-framework-demo' ),
            //'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
            'subtitle'     => __( 'Code entered into this field will be executed in the &lt;head&gt;&lt;/head&gt;. This is not to be confused with the header section where the logo is. This is strictly for JavaScript only, like Google AdSense verification, PropellerAds verification, Propeller Ads, Google Analytics etc.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-inside-header',
            'type'     => 'textarea',
            'title'    => __( 'Ad Inside Header', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: fixed size 468x60<br>Demo ad: <b>[dp_demo_ad_468x60]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_inside_header.png" /><br /><br />
          This ad space will be displayed in the header on all pages.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-below-primary-menu',
            'type'     => 'textarea',
            'title'    => __( 'Ad Below Primary Menu', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 768x90 or higher<br>Demo ad: <b>[dp_demo_ad_fullx90] or [dp_demo_ad_fullx90_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_navi.png" /><br /><br />
          This ad space will be displayed directly below the primary menu on all pages.', 'redux-framework-demo' ),
            'default'  => '',
        ),

//        array(
//            'id'       => 'ad-below-front-page-grid',
//            'type'     => 'textarea',
//            'title'    => __( 'Front Page Ad Below Top Grid', 'redux-framework-demo' ),
//            //'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
//            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_front_page_grid.png" /><br /><br />
//          This ad space is only displayed on the front page, directly below the top grid of posts.', 'redux-framework-demo' ),
//            'default'  => '',
//        ),



        array(
            'id'       => 'ad-above-page-title',
            'type'     => 'textarea',
            'title'    => __( 'Ad Above Page Title', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 768x90 or higher<br>Demo ad: <b>[dp_demo_ad_fullx90] or [dp_demo_ad_fullx90_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_above_page_title.png" /><br /><br />
          This ad space will be displayed on posts and pages directly above the title.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-above-page-content',
            'type'     => 'textarea',
            'title'    => __( 'Ad Above Page Content', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 768x90 or higher<br>Demo ad: <b>[dp_demo_ad_fullx90] or [dp_demo_ad_fullx90_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_page_title.png" /><br /><br />
          This ad space will be displayed on posts and pages directly above the page content.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-below-page-content',
            'type'     => 'textarea',
            'title'    => __( 'Ad Below Page Content', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 768x90 or higher<br>Demo ad: <b>[dp_demo_ad_fullx90] or [dp_demo_ad_fullx90_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_content.png" /><br /><br />
          This ad space will be displayed on posts and pages directly below the content.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-below-site-content',
            'type'     => 'textarea',
            'title'    => __( 'Ad Below Site Content', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 768x90 or higher<br>Demo ad: <b>[dp_demo_ad_fullx90] or [dp_demo_ad_fullx90_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_content_sidebar.png" /><br /><br />
          This ad space will be displayed on all pages directly below the site content.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-widget-1',
            'type'     => 'textarea',
            'title'    => __( 'Ad Widget #1', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 300x600 or 300x250<br>Demo ad: <b>[dp_demo_ad_300x600] or [dp_demo_ad_300x600_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_widget.png" /><br /><br />
          This ad will be displayed using the widget "Ad Manager Widget #1". <br />
          Make sure to assign the widget to a widget area inside of Appearance -> Widgets.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-widget-2',
            'type'     => 'textarea',
            'title'    => __( 'Ad Widget #2', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 300x600 or 300x250<br>Demo ad: <b>[dp_demo_ad_300x600] or [dp_demo_ad_300x600_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_widget.png" /><br /><br />
          This ad will be displayed using the widget "Ad Manager Widget #2". <br />
          Make sure to assign the widget to a widget area inside of Appearance -> Widgets.', 'redux-framework-demo' ),
            'default'  => '',
        ),

        array(
            'id'       => 'ad-widget-3',
            'type'     => 'textarea',
            'title'    => __( 'Ad Widget #3', 'redux-framework-demo' ),
            'description' => __( 'Recommended size: responsive ad or fixed size 300x600 or 300x250<br>Demo ad: <b>[dp_demo_ad_300x600] or [dp_demo_ad_300x600_2]</b>', 'redux-framework-demo' ),
            'subtitle'     => __( '<img src="'. get_stylesheet_directory_uri() . '/img/area_below_widget.png" /><br /><br />
          This ad will be displayed using the widget "Ad Manager Widget #3". <br />
          Make sure to assign the widget to a widget area inside of Appearance -> Widgets.', 'redux-framework-demo' ),
            'default'  => '',
        ),


        array(
            'id'       => 'ads-disabled-pages',
            'type'     => 'select',
            'multi'    => true,
            'data'     => 'pages',
            //'args'     => array( 'post_type' =>  array( 'nyheter_grenene', 'nyheter_forbundet', 'stup' ), 'numberposts' => -1 ),
            'title'    => __( 'Disable Ads On Specific Pages', 'redux-framework-demo' ),
            'subtitle' => __( 'Most advertising programs prohibit ads to be displayed on <b>utility pages</b>, such as contact form page, privacy policy page, terms & condition page, disclaimer page etc.<br /><br />
Select the pages where you don’t want the ads to be shown.', 'redux-framework-demo' ),
            //'desc'     => __( 'Page will be marked as front for this post type', TD ),
        ),


    ),
) );




Redux::setSection( $opt_name, array(
    'title'  => __( 'Footer Copyright', 'redux-framework-demo' ),
    'id'     => 'dp-footer-copyright',
    'desc'   => __( 'To reset the copyright back to the default, click the "Reset Section" button in the top right corner. <br><br>The follow shortcodes are available:<br />
<b>[dp_year]</b> <i>Displays the current year</i><br />
<b>[dp_website_name]</b> <i>Displays the name of the website as set in Settings > General.</i><br />
<b>[dp_website_description]</b> <i>Displays the description of the website as set in Settings > General.</i><br />
<b>[dp_url]</b> <i>Displays the url of the website.</i><br />

', 'redux-framework-demo' ),
    'icon'   => 'fa fa-copyright',
    'fields'     => array(

        array(
            'id'       => 'dp-footer-copyright-disclaimer',
            'type'     => 'editor',
            'title'    => __( 'Footer Disclaimer', 'redux-framework-demo' ),
            //'description' => __( '<b>Note from the developer:</b> I have added this section so you can edit the copyright. I would however appreciate if you could leave a link to my theme "DisruptPress", as this it will help to grow my business. Thank you for considering. - Aedan O\'Brien', 'redux-framework-demo' ),
            //'subtitle'     => __( 'Create an Amazon Affiiate account <a href="https://affiliate-program.amazon.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => '<p style="text-align: center;">Copyright &copy; [dp_year] by <a href="[dp_url]" target="_self">[dp_website_name]</a>. All rights reserved.<br />All articles, images, product names, logos, and brands are property of their respective owners. All company, product and service names used in this website are for identification purposes only.<br />Use of these names, logos, and brands does not imply endorsement unless specified.<br />By using this site, you agree to the <a href="[dp_url]/terms-and-conditions/" target="_self">Terms of Use</a> and <a href="[dp_url]/privacy-policy/" target="_self">Privacy Policy</a>.</p>',
            'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 8
            )
        ),

        array(
            'id'       => 'dp-footer-theme-copyright',
            'type'     => 'editor',
            'title'    => __( 'Footer Theme Copyright', 'redux-framework-demo' ),
            'description' => __( '<b>Note from the theme developer:</b> I have added this section so you can edit the copyright and add your own name to it. I would however appreciate if you could leave a link to my theme "DisruptPress", as this will help to grow my business. Thank you for considering. - Aedan O\'Brien', 'redux-framework-demo' ),
            //'subtitle'     => __( 'Create an Amazon Affiiate account <a href="https://affiliate-program.amazon.com/" target="_blank">here</a>', 'redux-framework-demo' ),
            'default'  => '<p style="text-align: center;">Powered by <a href="https://wordpress.org/" target="_blank" rel="noopener noreferrer">WordPress</a> using <a href="http://disruptpress.com/" target="_blank" rel="designer">DisruptPress Theme</a>.</p>',
            'args'   => array(
                'teeny'            => false,
                'textarea_rows'    => 3
            )
        ),



    ),
) );


Redux::setSection( $opt_name, array(
    'title'  => __( 'Header & Footer Code', 'redux-framework-demo' ),
    'id'     => 'dp-code',
    'desc'   => __( '', 'redux-framework-demo' ),
    'icon'   => 'fa fa-code',
    'fields'     => array(


        array(
            'id'       => 'dp-code-header',
            'type'     => 'textarea',
            'title'    => __( 'Header Code', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Code entered into this field will be executed inside of the &lt;head&gt;&lt;/head&gt; tags of the website.<br />This is often used for scripts like Google Analytics, Javascript or CSS.', 'redux-framework-demo' ),
            'default'  => '',
            'rows'  => 10,

        ),

        array(
            'id'       => 'dp-code-footer',
            'type'     => 'textarea',
            'title'    => __( 'Footer Code', 'redux-framework-demo' ),
            //'description' => __( 'Example: aedanobrien02-20', 'redux-framework-demo' ),
            'subtitle'     => __( 'Code entered into this field will be executed at the bottom of the website, just before the closing &lt;/body&gt; tag.', 'redux-framework-demo' ),
            'default'  => '',
            'rows'  => 10,

        ),

    ),
) );

$dp_category_choices = array();
foreach ( get_terms('category','parent=0&hide_empty=0') as $category_object ) {
    $dp_category_choices[$category_object->term_id] = $category_object->name;
}

Redux::setSection( $opt_name, array(
    'title'  => __( 'Slider', 'redux-framework-demo' ),
    'id'     => 'dp-slider',
    'desc'   => __( '', 'redux-framework-demo' ),
    'icon'   => 'fa fa-image',
    'fields'     => array(

        array(
            'id'       => 'dp-slider-status',
            'type'     => 'switch',
            'title'    => __('Turn Slider On / Off', 'redux-framework-demo'),
            //'subtitle' => __('', 'redux-framework-demo'),
            'default'  => true,
        ),

        array(
            'id'       => 'dp-slider-category-select',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Slider Categories', 'redux-framework-demo'),
            'subtitle' => __('Select specific categories for the slider.', 'redux-framework-demo'),
            'desc'     => __('You can select multiple categories. Leave empty to display posts from all categories.', 'redux-framework-demo'),
            //Must provide key => value pairs for radio options
            'options'  => $dp_category_choices,
            'required' => array('dp-slider-status','equals','1')
            //'default'  => array('2','3')
        ),

        array(
            'id'        => 'dp-slider-count',
            'type'      => 'slider',
            'title'    => __('Amount of Slides in Slider', 'redux-framework-demo'),
            'subtitle' => __('The amount of slides to be displayed in the slider.', 'redux-framework-demo'),
            'desc'     => __('Default: 5', 'redux-framework-demo'),
            "default"   => 5,
            "min"       => 1,
            "step"      => 1,
            "max"       => 10,
            'resolution' => 1,
            'display_value' => 'label',
            'required' => array('dp-slider-status','equals','1')
        ),

        array(
            'id'       => 'dp-slider-one-category',
            'type'     => 'checkbox',
            'title'    => __('1 Post Per Category', 'redux-framework-demo'),
            'subtitle' => __('Display only the latest post of each category.', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '0',
            'required' => array('dp-slider-status','equals','1')
        ),

        array(
            'id'       => 'dp-slider-layout',
            'type'     => 'image_select',
            'title'    => __('Slider Layout', 'redux-framework-demo'),
            //'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'redux-framework-demo'),
            'options'  => array(
                '1'      => array(
                    'alt'   => 'slider_icon_169_3.jpg',
                    'img'   => get_template_directory_uri().'/img/slider/slider_icon_169_3.jpg'
                ),
                '2'      => array(
                    'alt'   => 'slider_icon_169_2.jpg',
                    'img'   => get_template_directory_uri().'/img/slider/slider_icon_169_2.jpg'
                ),
                '3'      => array(
                    'alt'   => 'slider_icon_169_0.jpg',
                    'img'   => get_template_directory_uri().'/img/slider/slider_icon_169_0.jpg'
                ),
                '4'      => array(
                    'alt'   => 'slider_icon_219_2.jpg',
                    'img'   => get_template_directory_uri().'/img/slider/slider_icon_219_2.jpg'
                ),
                '5'      => array(
                    'alt'   => 'slider_icon_219_0.jpg',
                    'img'   => get_template_directory_uri().'/img/slider/slider_icon_219_0.jpg'
                ),

            ),
            'default' => '1',
            'required' => array('dp-slider-status','equals','1')
        ),

        array(
            'id'        => 'dp-slider-transition-speed',
            'type'      => 'slider',
            'title'    => __('Slider Transition Speed (in seconds)', 'redux-framework-demo'),
            'subtitle' => __('Change the transition speed between the slides.', 'redux-framework-demo'),
            'desc'     => __('Default: 0.8 seconds', 'redux-framework-demo'),
            "default"   => 0.8,
            "min"       => 0.1,
            "step"      => 0.1,
            "max"       => 2.0,
            'resolution' => 0.1,
            'display_value' => 'label',
            'required' => array('dp-slider-status','equals','1')
        ),

    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Front Page Grid', 'redux-framework-demo' ),
    'id'     => 'dp-grid',
    'desc'   => __( 'The front page grid, is the area on the front page of the website, directly below the slider.', 'redux-framework-demo' ),
    'icon'   => 'fa fa-image',
    'fields'     => array(

        array(
            'id'       => 'dp-grid-status',
            'type'     => 'switch',
            'title'    => __('Turn Grid On / Off', 'redux-framework-demo'),
            //'subtitle' => __('', 'redux-framework-demo'),
            'default'  => true,
        ),

        array(
            'id'       => 'dp-grid-category-select',
            'type'     => 'select',
            'multi'    => true,
            'title'    => __('Grid Categories', 'redux-framework-demo'),
            'subtitle' => __('Select specific categories for the Grid.', 'redux-framework-demo'),
            'desc'     => __('You can select multiple categories. Leave empty to display posts from all categories.', 'redux-framework-demo'),
            //Must provide key => value pairs for radio options
            'options'  => $dp_category_choices,
            'required' => array('dp-grid-status','equals','1')
            //'default'  => array('2','3')
        ),

        array(
            'id'       => 'dp-grid-duplicates',
            'type'     => 'checkbox',
            'title'    => __('Remove Duplicate Posts', 'redux-framework-demo'),
            'subtitle' => __('Removes duplicate posts from the grid if they are already displayed in the slider.', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1',
            'required' => array('dp-grid-status','equals','1')
        ),

//        array(
//            'id'        => 'dp-grid-row-count',
//            'type'      => 'slider',
//            'title'    => __('Amount of Rows', 'redux-framework-demo'),
//            //'subtitle' => __('Change the transition speed between the slides.', 'redux-framework-demo'),
//            //'desc'     => __('Default: 0.8 seconds', 'redux-framework-demo'),
//            "default"   => 2,
//            "min"       => 1,
//            "step"      => 1,
//            "max"       => 3,
//            'resolution' => 1,
//            'display_value' => 'label',
//
//        ),

        array(
            'id'       => 'dp-grid-row-count',
            'type'     => 'radio',
            'title'    => __('Amount of Rows', 'redux-framework-demo'),
           // 'subtitle' => __('No validation can be done on this field type', 'redux-framework-demo'),
           // 'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            //Must provide key => value pairs for radio options
            'options'  => array(
                '1' => '1 Row',
                '2' => '2 Rows',
                '3' => '3 Rows'
            ),
            'default' => '2',
            'required' => array('dp-grid-status','equals','1')
        ),

        array(
            'id' => 'dp-grid-section-start',
            'type' => 'section',
            //'title' => __('Indented Options', 'redux-framework-demo'),
            //'subtitle' => __('With the "section" field you can create indent option sections.', 'redux-framework-demo'),
            'indent' => true
        ),

        array(
            'id'       => 'dp-grid-layout-row-1',
            'type'     => 'image_select',
            'title'    => __('Grid Layout Row 1', 'redux-framework-demo'),
            //'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'redux-framework-demo'),
            'options'  => array(

                '2'      => array(
                    'alt'   => '2.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/2.jpg'
                ),

                '3'      => array(
                    'alt'   => '3.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/3.jpg'
                ),

                '4'      => array(
                    'alt'   => '4.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/4.jpg'
                ),

                '5'      => array(
                    'alt'   => '5.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/5.jpg'
                ),
            ),
            'default' => '2',
            'required' => array(
                array('dp-grid-status','equals','1'),
                array('dp-grid-row-count','>=','1')
            )
        ),

        array(
            'id'       => 'dp-grid-layout-row-2',
            'type'     => 'image_select',
            'title'    => __('Grid Layout Row 2', 'redux-framework-demo'),
            //'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'redux-framework-demo'),
            'options'  => array(

                '2'      => array(
                    'alt'   => '2.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/2.jpg'
                ),

                '3'      => array(
                    'alt'   => '3.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/3.jpg'
                ),

                '4'      => array(
                    'alt'   => '4.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/4.jpg'
                ),

                '5'      => array(
                    'alt'   => '5.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/5.jpg'
                ),
            ),
            'default' => '3',
            'required' => array(
                array('dp-grid-status','equals','1'),
                array('dp-grid-row-count','>=','2')
            )
        ),
        array(
            'id'       => 'dp-grid-layout-row-3',
            'type'     => 'image_select',
            'title'    => __('Grid Layout Row 3', 'redux-framework-demo'),
            //'subtitle' => __('Select main content and sidebar alignment. Choose between 1, 2 or 3 column layout.', 'redux-framework-demo'),
            'options'  => array(

                '2'      => array(
                    'alt'   => '2.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/2.jpg'
                ),

                '3'      => array(
                    'alt'   => '3.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/3.jpg'
                ),

                '4'      => array(
                    'alt'   => '4.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/4.jpg'
                ),

                '5'      => array(
                    'alt'   => '5.jpg',
                    'img'   => get_template_directory_uri().'/img/grid/5.jpg'
                ),
            ),
            'default' => '4',
            'required' => array(
                array('dp-grid-status','equals','1'),
                array('dp-grid-row-count','>=','3')
            )
        ),

        array(
            'id'     => 'dp-grid-section-end',
            'type'   => 'section',
            'indent' => false,
        ),

    ),
) );

Redux::setSection( $opt_name, array(
    'title'  => __( 'Settings', 'redux-framework-demo' ),
    'id'     => 'dp-settings',
    'desc'   => __( '', 'redux-framework-demo' ),
    'icon'   => 'fa fa-cog',
    'fields'     => array(


        array(
            'id'       => 'dp-disable-source-link',
            'type'     => 'checkbox',
            'title'    => __('Disable Source Link', 'redux-framework-demo'),
            'subtitle' => __('Disables a link the original source article when using automated articles.', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'dp-disable-toolbar',
            'type'     => 'checkbox',
            'title'    => __('Disable Toolbar', 'redux-framework-demo'),
            'subtitle' => __('Disable front end toolbar for all users', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'dp-auto-update-themes',
            'type'     => 'checkbox',
            'title'    => __('Automatically update themes', 'redux-framework-demo'),
            //'subtitle' => __('Disable front end toolbar for all users', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'dp-auto-update-plugins',
            'type'     => 'checkbox',
            'title'    => __('Automatically update plugins', 'redux-framework-demo'),
            //'subtitle' => __('Disable front end toolbar for all users', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1'// 1 = on | 0 = off
        ),

        array(
            'id'       => 'dp-auto-update-wordpress',
            'type'     => 'checkbox',
            'title'    => __('Automatically update WordPress', 'redux-framework-demo'),
            //'subtitle' => __('Disable front end toolbar for all users', 'redux-framework-demo'),
            //'desc'     => __('This is the description field, again good for additional info.', 'redux-framework-demo'),
            'default'  => '1'// 1 = on | 0 = off
        ),

    ),
) );

//     Redux::setSection( $opt_name, array(
//         'title' => __( 'Basic Fields', 'redux-framework-demo' ),
//         'id'    => 'basic',
//         'desc'  => __( 'Basic fields as subsections.', 'redux-framework-demo' ),
//         'icon'  => 'el el-home'
//     ) );

//     Redux::setSection( $opt_name, array(
//         'title'      => __( 'Text', 'redux-framework-demo' ),
//         'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/text/" target="_blank">//docs.reduxframework.com/core/fields/text/</a>',
//         'id'         => 'opt-text-subsection',
//         'subsection' => true,
//         'fields'     => array(
//             array(
//                 'id'       => 'text-example',
//                 'type'     => 'text',
//                 'title'    => __( 'Text Field', 'redux-framework-demo' ),
//                 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
//                 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
//                 'default'  => 'Default Text',
//             ),
//         )
//     ) );

//     Redux::setSection( $opt_name, array(
//         'title'      => __( 'Text Area', 'redux-framework-demo' ),
//         'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="//docs.reduxframework.com/core/fields/textarea/" target="_blank">//docs.reduxframework.com/core/fields/textarea/</a>',
//         'id'         => 'opt-textarea-subsection',
//         'subsection' => true,
//         'fields'     => array(
//             array(
//                 'id'       => 'textarea-example',
//                 'type'     => 'textarea',
//                 'title'    => __( 'Text Area Field', 'redux-framework-demo' ),
//                 'subtitle' => __( 'Subtitle', 'redux-framework-demo' ),
//                 'desc'     => __( 'Field Description', 'redux-framework-demo' ),
//                 'default'  => 'Default Text',
//             ),
//         )
//     ) );

/*
 * <--- END SECTIONS
 */
