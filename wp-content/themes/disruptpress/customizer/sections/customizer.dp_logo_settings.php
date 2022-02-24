<?php

Kirki::add_section( 'dp_logo_settings', array(
    'title'          => __( 'Logo Settings' ),
    'panel' => 'dp_theme_settings'
) );


$disruptpress_theme_defaults['dp_logo_settings_logo_upload'] = '';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'image',
	'settings'    => 'dp_logo_settings_logo_upload',
	'label'       => __( 'Logo Upload', 'my_textdomain' ),
	'section'     => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_logo_upload'],
) );

$disruptpress_theme_defaults['dp_logo_settings_logo_height'] = '50';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_logo_settings_logo_height',
	//'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Logo Height', 'my_textdomain' ),
	'section'     => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_logo_height'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '250',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_logo_settings_title_style'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_logo_settings_title_style',
	'label'       => __( 'Title Style', 'my_textdomain' ),
	'section'     => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_title_style'],
	'multiple'    => 1,
	'choices'     => array(
		'0' => esc_attr__( 'None', 'my_textdomain' ),
		'1' => esc_attr__( 'Style 1', 'my_textdomain' ),
		'2' => esc_attr__( 'Style 2', 'my_textdomain' ),
		'3' => esc_attr__( 'Style 3', 'my_textdomain' ),
		'4' => esc_attr__( 'Style 4', 'my_textdomain' ),
		'5' => esc_attr__( 'Style 5', 'my_textdomain' ),
		'6' => esc_attr__( 'Style 6', 'my_textdomain' ),
		'7' => esc_attr__( 'Style 7', 'my_textdomain' ),
		'8' => esc_attr__( 'Style 8', 'my_textdomain' ),
		'9' => esc_attr__( 'Style 9', 'my_textdomain' ),
	),
) );

$disruptpress_theme_defaults['dp_logo_settings_title_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_logo_settings_title_font_family',
	'description' => __( 'Font Family', 'my_textdomain' ),
	'section'     => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_title_font_family'],
	'transport'   => 'postMessage',
	'multiple'    => 0,
	'choices'     => dp_global_fonts(),
) );

$disruptpress_theme_defaults['dp_logo_settings_title_font_size'] = '24';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_logo_settings_title_font_size',
	//'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Site Title Font Size (pixel)', 'my_textdomain' ),
	'section'     => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_title_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '48',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_logo_settings_title_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_logo_settings_title_color',
	'description' => esc_attr__( 'Site Title Primary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'dp_logo_settings',
	'default'     => $disruptpress_theme_defaults['dp_logo_settings_title_color'],
	'choices'    => array(
		'alpha'    => true,
		'palettes'  => array(),
	),
) );