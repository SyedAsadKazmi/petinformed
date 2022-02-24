<?php

Kirki::add_section( 'dp_primary_menu_sticky_logo', array(
    'title'          => __( 'Primary Menu Sticky Logo' ),
    'panel' => 'dp_design_options'
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_toggle'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_sticky_logo_toggle',
	'label'       => esc_attr__( 'Enable Primary Menu Logo', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_toggle'],
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_sticky_logo_divider1',
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_upload'] = '';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'image',
	'settings'    => 'dp_primary_menu_sticky_logo_upload',
	'label'       => __( 'Logo Upload', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_upload'],
	'transport'   => 'postMessage',
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_width'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_width',
	'description' => esc_attr__( 'Logo Width', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_width'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '320',
		'step' => '1',
	),
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_margin_right'] = '10';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_margin_right',
	'description' => esc_attr__( 'Logo Margin Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_margin_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_padding_left'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_sticky_logo_padding_left',
	'label'       => esc_attr__( 'Padding Left', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_padding_left'],
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_padding_right'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_sticky_logo_padding_right',
	'label'       => esc_attr__( 'Padding Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_padding_right'],
) );
// $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_height'] = '80';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_logo_height',
// 	'description' => esc_attr__( 'Logo Height', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu_sticky_logo',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_height'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '10',
// 		'max'  => '250',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_area_width'] = '400';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_logo_title_area_width',
// 	'description' => esc_attr__( 'Title Area Width', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu_sticky_logo',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_area_width'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '10',
// 		'max'  => '1000',
// 		'step' => '1',
// 	),
// ) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_sticky_logo_divider2',
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

	
$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_toggle'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_sticky_logo_title_toggle',
	'section'   => 'dp_primary_menu_sticky_logo',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_toggle'],
	'transport'   => 'postMessage',
	'choices'   => array(
		'1' => __( 'Title Off', 'my_textdomain' ),
		'2' => __( 'Title On', 'my_textdomain' ),
		'3' => __( 'Custom Title', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_custom'] = '';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'text',
	'settings'  => 'dp_primary_menu_sticky_logo_title_custom',
	'label'     => __( 'Custom Title', 'my_textdomain' ),
	'section'   => 'dp_primary_menu_sticky_logo',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_custom'],
	'transport'   => 'postMessage',
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_style'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_title_style',
	'description' => __( 'Title Style', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_style'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '9',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_family_toggle'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_sticky_logo_title_font_family_toggle',
	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_family_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_primary_menu_sticky_logo_title_font_family',
	'description' => __( 'Title Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_family'],
	'transport'   => 'postMessage',
	'multiple'    => 0,
	'choices'     => dp_global_fonts(),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_size'] = '32';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_title_font_size',
	'description' => esc_attr__( 'Title Font Size', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '72',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_weight'] = '400';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_title_font_weight',
	'description' => esc_attr__( 'Title Font Weight', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_font_weight'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '100',
		'max'  => '900',
		'step' => '100',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_sticky_logo_title_color',
	'description' => esc_attr__( 'Title Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_margin_bottom'] = '10';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_title_margin_bottom',
	'description' => esc_attr__( 'Title Margin Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_title_margin_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '40',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_sticky_logo_divider3',
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_toggle'] = '2';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_sticky_logo_tagline_toggle',
	'section'   => 'dp_primary_menu_sticky_logo',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_toggle'],
	'transport'   => 'postMessage',
	'choices'   => array(
		'1' => __( 'Tagline Off', 'my_textdomain' ),
		'2' => __( 'Tagline On', 'my_textdomain' ),
		'3' => __( 'Custom', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_custom'] = '';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'text',
	'settings'  => 'dp_primary_menu_sticky_logo_tagline_custom',
	'label'     => __( 'Custom Tagline', 'my_textdomain' ),
	'section'   => 'dp_primary_menu_sticky_logo',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_custom'],
	'transport'   => 'postMessage',
) );


$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_family_toggle'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_sticky_logo_tagline_font_family_toggle',
	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_family_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_primary_menu_sticky_logo_tagline_font_family',
	'description' => __( 'Tagline Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_family'],
	'transport'   => 'postMessage',
	'multiple'    => 0,
	'choices'     => dp_global_fonts(),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_size'] = '14';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_tagline_font_size',
	'description' => esc_attr__( 'Tagline Font Size', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '72',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_weight'] = '400';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_sticky_logo_tagline_font_weight',
	'description' => esc_attr__( 'Tagline Font Weight', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_font_weight'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '100',
		'max'  => '900',
		'step' => '100',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_sticky_logo_tagline_color',
	'description' => esc_attr__( 'Tagline Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu_sticky_logo',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_logo_tagline_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_sticky_logo_divider4',
	'section'     => 'dp_primary_menu_sticky_logo',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );