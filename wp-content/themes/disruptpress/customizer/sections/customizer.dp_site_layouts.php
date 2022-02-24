<?php

Kirki::add_section( 'dp_site_layouts', array(
	'title'          => __( 'Site Layout' ),
	'panel' => 'dp_theme_settings'
) );

/**
 * Default Site Layout Options
 */
$disruptpress_theme_defaults['dp_site_layout_default'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_site_layout_default',
	'label'       => esc_html__( 'Default Site Layout', 'my_textdomain' ),
	'tooltip'     => __( 'The default layout will be used across the entire website, on all sites, unless otherwise specified below.', 'textdomain' ),
	'section'     => 'dp_site_layouts',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_default'],
	'priority'    => 10,
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/full-width-content.png',
		'2' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1.png',
		'3' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content.png',
		'4' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1-sidebar2.png',
		'5' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1.png',
		'6' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content-sidebar2.png',
		'7' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1.png',
		'8' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-sidebar2-content.png',
		'9' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-sidebar1-content.png',
		'10' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1full.png',
		'11' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content.png',
		'12' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1full.png',
		'13' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content-sidebar2.png',
		'14' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1full.png',
		'15' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-sidebar2-content.png',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_divider_site_layout_1',
	'section'     => 'dp_site_layouts',
	'default'     => '<div class="dp_customizer-divider"></div>',
	'priority'    => 15,
) );

/**
 * Post Site Layout Options
 */
$disruptpress_theme_defaults['dp_site_layout_post_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_site_layout_post_toggle',
	'label'       => __( 'Different Layout for Posts', 'my_textdomain' ),
	'section'     => 'dp_site_layouts',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_post_toggle'],
	'priority'    => 20,
) );

$disruptpress_theme_defaults['dp_site_layout_post'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_site_layout_post',
	'label'       => esc_html__( 'Posts Site Layout', 'my_textdomain' ),
	'section'     => 'dp_site_layouts',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_post'],
	'priority'    => 30,
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/full-width-content.png',
		'2' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1.png',
		'3' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content.png',
		'4' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1-sidebar2.png',
		'5' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1.png',
		'6' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content-sidebar2.png',
		'7' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1.png',
		'8' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-sidebar2-content.png',
		'9' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-sidebar1-content.png',
		'10' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1full.png',
		'11' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content.png',
		'12' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1full.png',
		'13' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content-sidebar2.png',
		'14' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1full.png',
		'15' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-sidebar2-content.png',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_divider_site_layout_2',
	'section'     => 'dp_site_layouts',
	'default'     => '<div class="dp_customizer-divider"></div>',
	'priority'    => 35,
) );

/**
 * Pages Site Layout Options
 */
$disruptpress_theme_defaults['dp_site_layout_page_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_site_layout_page_toggle',
	'label'       => __( 'Different Layout for Pages', 'my_textdomain' ),
	'section'     => 'dp_site_layouts',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_page_toggle'],
	'priority'    => 40,
) );

$disruptpress_theme_defaults['dp_site_layout_page'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_site_layout_page',
	'label'       => esc_html__( 'Pages Site Layout', 'my_textdomain' ),
	'section'     => 'dp_site_layouts',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_page'],
	'priority'    => 50,
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/full-width-content.png',
		'2' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1.png',
		'3' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content.png',
		'4' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1-sidebar2.png',
		'5' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1.png',
		'6' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content-sidebar2.png',
		'7' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1.png',
		'8' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-sidebar2-content.png',
		'9' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-sidebar1-content.png',
		'10' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1full.png',
		'11' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content.png',
		'12' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1full.png',
		'13' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content-sidebar2.png',
		'14' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1full.png',
		'15' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-sidebar2-content.png',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_divider_site_layout_3',
	'section'     => 'dp_site_layouts',
	'default'     => '<div class="dp_customizer-divider"></div>',
	'priority'    => 55,
) );
/**
 * Category Site Layout Options
 */
$disruptpress_theme_defaults['dp_site_layout_category_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_site_layout_category_toggle',
	'label'       => __( 'Different Layout for Categories', 'my_textdomain' ),
	'section'     => 'dp_site_layouts',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_category_toggle'],
	'priority'    => 60,
) );

$disruptpress_theme_defaults['dp_site_layout_category'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_site_layout_category',
	'label'       => esc_html__( 'Categories Site Layout', 'my_textdomain' ),
	'description' => __( 'Select the site layout for posts and pages.', 'textdomain' ),
	'section'     => 'dp_site_layouts',
	'default'     => $disruptpress_theme_defaults['dp_site_layout_category'],
	'priority'    => 70,
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/full-width-content.png',
		'2' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1.png',
		'3' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content.png',
		'4' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1-sidebar2.png',
		'5' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1.png',
		'6' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-content-sidebar2.png',
		'7' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1.png',
		'8' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1-sidebar2-content.png',
		'9' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-sidebar1-content.png',
		'10' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar1full.png',
		'11' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content.png',
		'12' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/content-sidebar2-sidebar1full.png',
		'13' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-content-sidebar2.png',
		'14' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar2-content-sidebar1full.png',
		'15' => get_stylesheet_directory_uri() . '/customizer/img/layout_icons/sidebar1full-sidebar2-content.png',
	),
) );
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_divider_site_layout_4',
	'section'     => 'dp_site_layouts',
	'default'     => '<div class="dp_customizer-divider"></div>',
	'priority'    => 75,
) );