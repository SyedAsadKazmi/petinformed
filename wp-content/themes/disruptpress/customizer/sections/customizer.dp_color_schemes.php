<?php

Kirki::add_section( 'dp_color_schemes', array(
    'title'          => __( 'Color Schemes' ),
    'panel' => 'dp_design_options'
) );


$disruptpress_theme_defaults['dp_color_scheme_1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_color_scheme_1',
	'label' => esc_html__( 'Color Scheme', 'my_textdomain' ),
	'section'     => 'dp_color_schemes',
	'default'     => $disruptpress_theme_defaults['dp_color_scheme_1'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'0' => get_stylesheet_directory_uri() . '/customizer/img/gradient/transparent.png',
		'1' => get_stylesheet_directory_uri() . '/customizer/img/gradient/transparent.png',
		'2' => get_stylesheet_directory_uri() . '/customizer/img/gradient/transparent.png',
		'3' => get_stylesheet_directory_uri() . '/customizer/img/gradient/transparent.png',
		'4' => get_stylesheet_directory_uri() . '/customizer/img/gradient/transparent.png',
	),
) );

