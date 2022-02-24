<?php

Kirki::add_section( 'dp_primary_menu', array(
    'title'          => __( 'Primary Menu' ),
    'panel' => 'dp_design_options'
) );

$disruptpress_theme_defaults['dp_primary_menu_boxed'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_boxed',
	'label'       => __( 'Boxed Width', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_boxed'],
	'transport'   => 'postMessage',
) );

// $disruptpress_theme_defaults['dp_primary_menu_width'] = '1';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_primary_menu_width',
// 	'label'     => __( 'Menu Width', 'my_textdomain' ),
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_width'],
// 	'transport' => 'postMessage',
// 	'choices'   => array(
// 		'1' => __( 'Boxed', 'my_textdomain' ),
// 		'2' => __( 'Wide', 'my_textdomain' ),
// 		'3' => __( 'Full Width', 'my_textdomain' )
// 	)
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_home_icon'] = true;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_home_icon',
// 	'label'       => __( 'Show Home Icon', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_home_icon'],
// 	'transport'   => 'postMessage',
// ) );

$disruptpress_theme_defaults['dp_primary_menu_submenu_indicator'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_submenu_indicator',
	'label'       => __( 'Show Submenu Indicator', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_submenu_indicator'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_home_icon'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_home_icon',
	'label'       => esc_attr__( 'Display Home Icon', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_home_icon'],
) );

$disruptpress_theme_defaults['dp_primary_menu_link_text_decoration'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_link_text_decoration',
	'label'       => esc_attr__( 'Underline Text', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_link_text_decoration'],
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider100',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_height'] = '50';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_height',
	'label' => esc_attr__( 'Menu Height', 'my_textdomain' ),
	//'description' => esc_attr__( 'Menu Height', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_height'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '15',
		'max'  => '200',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_item_padding_left_right'] = '15';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_item_padding_left_right',
	'label' => esc_attr__( 'Menu Item Padding Left & Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_padding_left_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider1',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_alignment'] = 'left';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_item_alignment',
	'label'     => __( 'Menu Item Alignment', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_item_alignment'],
	'transport' => 'postMessage',
	'choices'   => array(
		'left' => __( 'Left', 'my_textdomain' ),
		'center' => __( 'Center', 'my_textdomain' ),
		'right' => __( 'Right', 'my_textdomain' ),
		/*'fullwidth' => __( 'Full Width', 'my_textdomain' ),*/
	)
) );

// $disruptpress_theme_defaults['dp_primary_menu_item_alignment_padding'] = '1';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'radio',
// 	'settings'    => 'dp_primary_menu_item_alignment_padding',
// 	//'label'       => __( 'Radio Control', 'my_textdomain' ),
// 	'transport' => 'postMessage',
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_alignment_padding'],
// 	'choices'     => array(
// 		'1' => esc_attr__( 'Align First Item with Site Content', 'my_textdomain' ),
// 		'2' => esc_attr__( 'Align First Item with Site Container', 'my_textdomain' ),
// 		//'3' => esc_attr__( 'Align First Item Content with Container', 'my_textdomain' ),
// 	),
// ) );

$disruptpress_theme_defaults['dp_primary_menu_item_alignment_padding'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_alignment_padding',
	'label'       => __( 'Align First/Last Item with Site Content', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_alignment_padding'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_home_icon_smart_padding'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_home_icon_smart_padding',
	'label'       => __( 'Home Icon Smart Padding', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_home_icon_smart_padding'],
	'transport'   => 'postMessage',
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_bg_active_divider41',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

// $disruptpress_theme_defaults['dp_primary_menu_home_button_logo_toggle'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_home_button_logo_toggle',
// 	'label'       => esc_attr__( 'Choose different logo', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_home_button_logo_toggle'],
// ) );



// $disruptpress_theme_defaults['dp_primary_menu_title_custom'] = '';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'text',
// 	'settings'  => 'dp_primary_menu_title_custom',
// 	'label'     => __( 'Custom Title', 'my_textdomain' ),
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_title_custom'],
// 	'transport'   => 'postMessage',
// ) );


// $disruptpress_theme_defaults['dp_primary_menu_title_style'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_title_style',
// 	'description' => __( 'Title Style', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_style'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '9',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_title_font_family_toggle'] = true;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_title_font_family_toggle',
// 	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_font_family_toggle'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_title_font_family'] = 'Open+Sans';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'select',
// 	'settings'    => 'dp_primary_menu_title_font_family',
// 	'description' => __( 'Title Font Family', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_font_family'],
// 	'transport'   => 'postMessage',
// 	'multiple'    => 0,
// 	'choices'     => dp_global_fonts(),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_title_font_size'] = '32';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_title_font_size',
// 	'description' => esc_attr__( 'Title Font Size', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_font_size'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '10',
// 		'max'  => '72',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_title_font_weight'] = '400';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_title_font_weight',
// 	'description' => esc_attr__( 'Title Font Weight', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_font_weight'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '100',
// 		'max'  => '900',
// 		'step' => '100',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_title_color'] = '#000000';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'color',
// 	'settings'    => 'dp_primary_menu_title_color',
// 	'description' => esc_attr__( 'Title Color', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_color'],
// 	'choices'     => array(
// 		'alpha'     => false,
// 		'palettes'  => array(),
// 	),
// ) );


// $disruptpress_theme_defaults['dp_primary_menu_title_margin_bottom'] = '10';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_title_margin_bottom',
// 	'description' => esc_attr__( 'Title Margin Bottom', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_title_margin_bottom'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '40',
// 		'step' => '1',
// 	),
// ) );

// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'custom',
// 	'settings'    => 'dp_primary_menu_divider100',
// 	'section'     => 'dp_primary_menu',
// 	'default'     => '<div class="dp_customizer-divider"></div>',
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_toggle'] = '2';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_primary_menu_tagline_toggle',
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_tagline_toggle'],
// 	'transport'   => 'postMessage',
// 	'choices'   => array(
// 		'1' => __( 'Tagline Off', 'my_textdomain' ),
// 		'2' => __( 'Tagline On', 'my_textdomain' ),
// 		'3' => __( 'Custom', 'my_textdomain' )
// 	)
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_custom'] = '';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'text',
// 	'settings'  => 'dp_primary_menu_tagline_custom',
// 	'label'     => __( 'Custom Tagline', 'my_textdomain' ),
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_tagline_custom'],
// 	'transport'   => 'postMessage',
// ) );


// $disruptpress_theme_defaults['dp_primary_menu_tagline_font_family_toggle'] = true;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_tagline_font_family_toggle',
// 	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_tagline_font_family_toggle'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_font_family'] = 'Open+Sans';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'select',
// 	'settings'    => 'dp_primary_menu_tagline_font_family',
// 	'description' => __( 'Tagline Font Family', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_tagline_font_family'],
// 	'transport'   => 'postMessage',
// 	'multiple'    => 0,
// 	'choices'     => dp_global_fonts(),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_font_size'] = '14';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_tagline_font_size',
// 	'description' => esc_attr__( 'Tagline Font Size', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_tagline_font_size'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '10',
// 		'max'  => '72',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_font_weight'] = '400';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_tagline_font_weight',
// 	'description' => esc_attr__( 'Tagline Font Weight', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_tagline_font_weight'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '100',
// 		'max'  => '900',
// 		'step' => '100',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_tagline_color'] = '#000000';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'color',
// 	'settings'    => 'dp_primary_menu_tagline_color',
// 	'description' => esc_attr__( 'Tagline Color', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_tagline_color'],
// 	'choices'     => array(
// 		'alpha'     => false,
// 		'palettes'  => array(),
// 	),
// ) );


// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'custom',
// 	'settings'    => 'dp_primary_menu_divider132',
// 	'section'     => 'dp_primary_menu',
// 	'default'     => '<div class="dp_customizer-divider"></div>',
// ) );

$disruptpress_theme_defaults['dp_primary_menu_font_size'] = '14';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_font_size',
	'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Font Size (pixel)', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '48',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_font_weight'] = '400';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_font_weight',
	//'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Font Weight', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_font_weight'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '100',
		'max'  => '900',
		'step' => '100',
	),
) );


$disruptpress_theme_defaults['dp_primary_menu_link_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_link_color',
	'description' => esc_attr__( 'Regular Link Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_link_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_link_color_active'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_link_color_active',
	'description' => esc_attr__( 'Active/Hover Link Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_link_color_active'],
	'choices'    => array(
		'alpha'    => false,
		'palettes'  => array(),
	),
) );

// $disruptpress_theme_defaults['dp_primary_menu_link_color'] = '#000000';
// $disruptpress_theme_defaults['dp_primary_menu_link_color_active'] = '#000000';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'multicolor',
// 	'settings'    => 'dp_primary_menu_link_color',
// 	'label'       => esc_attr__( 'Link Colors', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 	// 'link'    => esc_attr__( 'Color', 'my_textdomain' ),
// 		'hover'   => esc_attr__( 'Regular', 'my_textdomain' ),
// 		'active'  => esc_attr__( 'Active & Hover', 'my_textdomain' ),
// 	'irisArgs' => array(
// 			'palettes' => array( '#000', '#222', '#555', '#777', '#999', '#bbb', '#fff' ),
// 		),
// 	),
// 	'default'     => array(
// 	//  'link'    => '#0088cc',
// 		'hover'   => $disruptpress_theme_defaults['dp_primary_menu_link_color'],
// 		'active'  => $disruptpress_theme_defaults['dp_primary_menu_link_color_active'],
// 	),
// ) );

$disruptpress_theme_defaults['dp_primary_menu_font_family_toggle'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_font_family_toggle',
	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_font_family_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_primary_menu_font_family',
	'description' => __( 'Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_font_family'],
	'transport'   => 'postMessage',
	'multiple'    => 0,
	'choices'     => dp_global_fonts(),
) );

$disruptpress_theme_defaults['dp_primary_menu_home_font_uppercase'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_home_font_uppercase',
	'label'       => esc_attr__( 'Uppercase', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_home_font_uppercase'],
) );


Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider2',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_color_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_bg_color_style',
	'label'     => __( 'Background Color Style', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_bg_color_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'1' => __( 'Single', 'my_textdomain' ),
		'2' => __( 'Monochrome', 'my_textdomain' ),
		'3' => __( 'Multi Color', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_bg_color',
	'description' => esc_attr__( 'Primary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_color'],
	'choices'    => array(
		'alpha'    => true,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_color2'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_bg_color2',
	'description' => esc_attr__( 'Secondary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_color2'],
	'choices'    => array(
		'alpha'    => true,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_shade_strenght'] = '-0.5';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_shade_strenght',
	'description' => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_shade_strenght'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-1',
		'max'  => '1',
		'step' => '0.01',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_gradient_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_primary_menu_bg_gradient_style',
	'description' => esc_html__( 'Gradient Style', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_gradient_style'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-top-bottom.png',
		'2' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-left-right.png',
		'16' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style1.png',
		'17' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style2.png',
		'18' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style3.png',
		'19' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style4.png',
		'20' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style5.png',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_gradient_advanced_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_bg_gradient_advanced_toggle',
	'label'       => __( 'Advanced Options', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_gradient_advanced_toggle'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_gradient_position_parameter1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_gradient_position_parameter1',
	'description' => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_gradient_position_parameter1'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_gradient_position_parameter2'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_gradient_position_parameter2',
	'description' => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_gradient_position_parameter2'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_gradient_reverse_color'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'switch',
	'settings'    => 'dp_primary_menu_bg_gradient_reverse_color',
	'description' => __( 'Reverse Colors', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_gradient_reverse_color'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'0'  => esc_attr__( 'Enable', 'my_textdomain' ),
		'1' => esc_attr__( 'Disable', 'my_textdomain' ),
	),
) );

// $disruptpress_theme_defaults['dp_primary_menu_bg_items_only'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_bg_items_only',
// 	'label'       => esc_attr__( 'Apply Background To Menu Items Only', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_items_only'],
// ) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_bg_divider3',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_primary_menu_bg_active_color_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_bg_active_color_style',
	'label'     => __( 'Background Color Style Active Item', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_bg_active_color_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'1' => __( 'Single', 'my_textdomain' ),
		'2' => __( 'Monochrome', 'my_textdomain' ),
		'3' => __( 'Multi Color', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_bg_active_color',
	'description' => esc_attr__( 'Primary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_color'],
	'choices'    => array(
		'alpha'    => true,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_color2'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_bg_active_color2',
	'description' => esc_attr__( 'Secondary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_color2'],
	'choices'    => array(
		'alpha'    => true,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_shade_strenght'] = '-0.5';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_active_shade_strenght',
	'description' => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_shade_strenght'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-1',
		'max'  => '1',
		'step' => '0.01',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_primary_menu_bg_active_gradient_style',
	'description' => esc_html__( 'Gradient Style', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_style'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'1' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-top-bottom.png',
		'2' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-left-right.png',
		'3' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-topleft-bottomright.png',
		'4' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-topright-bottomleft.png',
		'5' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-top-bottom-mirrored.png',
		'6' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-left-right-mirrored.png',
		'7' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-topleft-bottomright-mirrored.png',
		'8' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-topright-bottomleft-mirrored.png',
		'9' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-center-ellipse-cover.png',
		'10' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-center-ellipse-contain.png',
		'11' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-center-circle-cover.png',
		'12' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-bottom-elipse-cover.png',
		'13' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-bottom-circle-cover.png',
		'14' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-top-ellipse-cover.png',
		'15' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-top-circle-cover.png',
		'16' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style1.png',
		'17' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style2.png',
		'18' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style3.png',
		'19' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style4.png',
		'20' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style5.png',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_advanced_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_bg_active_gradient_advanced_toggle',
	'label'       => __( 'Advanced Options', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_advanced_toggle'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_position_parameter1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_active_gradient_position_parameter1',
	'description' => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_position_parameter1'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_position_parameter2'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_bg_active_gradient_position_parameter2',
	'description' => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_position_parameter2'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_reverse_color'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'switch',
	'settings'    => 'dp_primary_menu_bg_active_gradient_reverse_color',
	'description' => __( 'Reverse Colors', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_gradient_reverse_color'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'0'  => esc_attr__( 'Enable', 'my_textdomain' ),
		'1' => esc_attr__( 'Disable', 'my_textdomain' ),
	),
) );

// $disruptpress_theme_defaults['dp_primary_menu_bg_active_boxshadow'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_bg_active_boxshadow',
// 	'label'       => __( 'Box Shadow', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_bg_active_boxshadow'],
// 	'transport'   => 'postMessage',
// ) );

$disruptpress_theme_defaults['dp_primary_menu_bg_active_boxshadow'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_bg_active_boxshadow',
	'label'     => __( 'Box Shadow', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_bg_active_boxshadow'],
	'transport' => 'postMessage',
	'choices'   => array(
		'0' => __( 'None', 'my_textdomain' ),
		'1' => __( 'Style 1', 'my_textdomain' ),
		'2' => __( 'Style 2', 'my_textdomain' ),
		'3' => __( 'Style 3', 'my_textdomain' )
	)
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_bg_active_divider4',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_item_dividers',
	'label'     => __( 'Item Dividers', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_item_dividers'],
	'transport' => 'postMessage',
	'choices'   => array(
		'0' => __( 'None', 'my_textdomain' ),
		'1' => __( 'Single Line', 'my_textdomain' ),
		'2' => __( 'Dual Line', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_firstchild'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_dividers_firstchild',
	'label'       => __( 'Opening Divider on First Item', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_firstchild'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_lastchild'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_dividers_lastchild',
	'label'       => __( 'Closing Divider on Last Item', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_lastchild'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_top'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_dividers_top',
	'label'       => __( 'Border Top', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_top'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_bottom'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_dividers_bottom',
	'label'       => __( 'Border Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_bottom'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_color_toggle'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_item_dividers_color_toggle',
	'label'       => __( 'Adjust Divider Color Manually', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_color_toggle'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_menu_item_dividers_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_item_dividers_color',
	'description' => esc_attr__( 'Divider Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_dividers_color'],
	'choices'    => array(
		'alpha'    => false
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_bg_active_divider40',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_primary_menu_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_margin_top',
	'label'       => esc_attr__( 'Margin', 'my_textdomain' ),
	'description' => esc_attr__( 'Top', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_margin_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_margin_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_margin_bottom',
	'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_margin_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'custom',
// 	'settings'    => 'dp_primary_menu_bg_active_divider5',
// 	'section'     => 'dp_primary_menu',
// 	'default'     => '<div class="dp_customizer-divider"></div>',
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_item_padding_top_bottom'] = '16';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_item_padding_top_bottom',
// 	'label'       => esc_attr__( 'Menu Item Padding', 'my_textdomain' ),
// 	'description' => esc_attr__( 'Top & Bottom', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_padding_top_bottom'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '50',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_item_padding_left_right'] = '20';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_item_padding_left_right',
// 	'description' => esc_attr__( 'Left & Right', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_item_padding_left_right'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '50',
// 		'step' => '1',
// 	),
// ) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_bg_active_divider6',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_border_radius_topleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_radius_topleft',
	'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
	'label'       => __( 'Border Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_radius_topleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_radius_topright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_radius_topright',
	'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_radius_topright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_radius_bottomright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_radius_bottomright',
	'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_radius_bottomright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_radius_bottomleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_radius_bottomleft',
	'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_radius_bottomleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider7',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_menu_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_border_style',
	'label'     => __( 'Menu Border Style', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_border_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'none'   => __( 'None', 'my_textdomain' ),
		'solid'  => __( 'Solid', 'my_textdomain' ),
		'dotted' => __( 'Dotted', 'my_textdomain' ),
		'dashed' => __( 'Dashed', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_border_width_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_width_top',
	'description' => esc_attr__( 'Border Width Top', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_width_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_width_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_width_right',
	'description' => esc_attr__( 'Border Width Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_width_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_width_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_width_bottom',
	'description' => esc_attr__( 'Border Width Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_width_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_width_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_border_width_left',
	'description' => esc_attr__( 'Border Width Left', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_width_left'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_border_color',
	'description' => esc_attr__( 'Border Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_border_color'],
	'sanitize_callback'     => '',
	'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider8',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'typography',
// 	'settings'    => 'dp_primary_menu_typography',
// 	'label'       => esc_attr__( 'Typography', 'kirki' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'auto',
// 	'output'      => array(
// 		array(
// 			'element' => '.nav-primary',
// 		),
// 	),
// 	'default'     => array(
// 		'font-family'    => 'Roboto',
// 		//'variant'        => 'regular',
// 		//'font-size'      => '14px',
// 		//'line-height'    => '1.5',
// 		//'letter-spacing' => '0',
// 		//'subsets'        => array( 'latin-ext' ),
// 		//'color'          => '#333333',
// 		//'text-transform' => 'none',
// 		//'text-align'     => 'left'
// 	),
// 	//'js_vars'   => array(),
// ) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_shadow_bottom_style',
	'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'none'    => __( 'None', 'my_textdomain' ),
		'presets' => __( 'Presets', 'my_textdomain' ),
		'custom'  => __( 'Custom', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_presets'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_shadow_presets',
	//'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_shadow_presets'],
	'transport' => 'postMessage',
	'choices'   => array(
		'1'    => __( '1', 'my_textdomain' ),
		'2' => __( '2', 'my_textdomain' ),
		'3'  => __( '3', 'my_textdomain' ),
		'4'  => __( '4', 'my_textdomain' ),
		'5'  => __( '5', 'my_textdomain' ),
		'6'  => __( '6', 'my_textdomain' ),
		'7'  => __( '7', 'my_textdomain' ),
		'8'  => __( '8', 'my_textdomain' ),
		'9'  => __( '9', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_vertical'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_shadow_bottom_vertical',
	//'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
	'description' => esc_attr__( 'Vertical', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_vertical'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-30',
		'max'  => '40',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_blur_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_shadow_bottom_blur_radius',
	'description'  => esc_attr__( 'Blur Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_blur_radius'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_spread_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_shadow_bottom_spread_radius',
	'description' => esc_attr__( 'Spread Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_spread_radius'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-30',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_opacity'] = '0.75';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_shadow_bottom_opacity',
	'description'       => esc_attr__( 'Opacity', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_shadow_bottom_opacity'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0.00',
		'max'  => '1.00',
		'step' => '0.01',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider9',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky',
// 	'label'       => esc_attr__( 'Sticky Menu', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	//'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky'],
// ) );
// $disruptpress_theme_defaults['dp_primary_menu_sticky'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_primary_menu_sticky',
// 	'label'     => __( 'Sticky Menu', 'my_textdomain' ),
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky'],
// 	'transport' => 'refresh',
// 	'choices'   => array(
// 		'0' => __( 'Off', 'my_textdomain' ),
// 		'1' => __( 'Transitioning', 'my_textdomain' ),
// 		'2' => __( 'No Transition', 'my_textdomain' ),
// 	)
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_menu_width'] = true;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_menu_width',
// 	'label'       => esc_attr__( 'Force Full Width Menu', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_menu_width'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_shadow_bottom'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_shadow_bottom',
// 	'label'       => esc_attr__( 'Hide Shadow', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_shadow_bottom'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_border'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_border',
// 	'label'       => esc_attr__( 'Hide Border', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_border'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_height_toggle'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_height_toggle',
// 	'label'       => esc_attr__( 'Use Different Menu Height', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_height_toggle'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_height'] = '50';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_height',
// 	'description' => esc_attr__( 'Height', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_height'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '15',
// 		'max'  => '200',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color_toggle'] = false;
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_bg_color_toggle',
// 	'label'       => esc_attr__( 'Use Different Background Color', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color_toggle'],
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color_style'] = '1';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_primary_menu_sticky_bg_color_style',
// 	'label'     => __( 'Sticky Menu Background Color Style', 'my_textdomain' ),
// 	'section'   => 'dp_primary_menu',
// 	'default'   => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color_style'],
// 	'transport' => 'postMessage',
// 	'choices'   => array(
// 		'1' => __( 'Single', 'my_textdomain' ),
// 		'2' => __( 'Monochrome', 'my_textdomain' ),
// 		'3' => __( 'Multi Color', 'my_textdomain' )
// 	)
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color'] = '#CCCCCC';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'color',
// 	'settings'    => 'dp_primary_menu_sticky_bg_color',
// 	'description' => esc_attr__( 'Primary Color', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color'],
// 	'choices'    => array(
// 		'alpha'    => true,
// 		'palettes'  => array(),
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color2'] = '#FFFFFF';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'color',
// 	'settings'    => 'dp_primary_menu_sticky_bg_color2',
// 	'description' => esc_attr__( 'Secondary Color', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'transport'   => 'postMessage',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_color2'],
// 	'choices'    => array(
// 		'alpha'    => true,
// 		'palettes'  => array(),
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_shade_strenght'] = '-0.5';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_bg_shade_strenght',
// 	'description' => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_shade_strenght'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '-1',
// 		'max'  => '1',
// 		'step' => '0.01',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_style'] = '1';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'radio-image',
// 	'settings'    => 'dp_primary_menu_sticky_bg_gradient_style',
// 	'description' => esc_html__( 'Gradient Style', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_style'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'1' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-top-bottom.png',
// 		'2' => get_stylesheet_directory_uri() .  '/customizer/img/gradient/gradient-left-right.png',
// 		'16' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style1.png',
// 		'17' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style2.png',
// 		'18' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style3.png',
// 		'19' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style4.png',
// 		'20' => get_stylesheet_directory_uri() . '/customizer/img/gradient/gradient-style5.png',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_advanced_toggle'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'checkbox',
// 	'settings'    => 'dp_primary_menu_sticky_bg_gradient_advanced_toggle',
// 	'label'       => __( 'Advanced Options', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_advanced_toggle'],
// 	'transport'   => 'postMessage',
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_position_parameter1'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_bg_gradient_position_parameter1',
// 	'description' => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_position_parameter1'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '100',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_position_parameter2'] = '100';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'slider',
// 	'settings'    => 'dp_primary_menu_sticky_bg_gradient_position_parameter2',
// 	'description' => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_position_parameter2'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'min'  => '0',
// 		'max'  => '100',
// 		'step' => '1',
// 	),
// ) );

// $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_reverse_color'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'switch',
// 	'settings'    => 'dp_primary_menu_sticky_bg_gradient_reverse_color',
// 	'description' => __( 'Reverse Colors', 'my_textdomain' ),
// 	'section'     => 'dp_primary_menu',
// 	'default'     => $disruptpress_theme_defaults['dp_primary_menu_sticky_bg_gradient_reverse_color'],
// 	'transport'   => 'postMessage',
// 	'choices'     => array(
// 		'0'  => esc_attr__( 'Enable', 'my_textdomain' ),
// 		'1' => esc_attr__( 'Disable', 'my_textdomain' ),
// 	),
// ) );


$disruptpress_theme_defaults['dp_primary_menu_search_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_menu_search_toggle',
	'label'     => __( 'Search Box', 'my_textdomain' ),
	'section'   => 'dp_primary_menu',
	'default'   => $disruptpress_theme_defaults['dp_primary_menu_search_toggle'],
	'transport' => 'postMessage',
	'choices'   => array(
		'0'    => __( 'Off', 'my_textdomain' ),
		'1' => __( 'On', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_menu_search_opening_divider'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_opening_divider',
	'label'       => esc_attr__( 'Opening Divider', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_opening_divider'],
) );

$disruptpress_theme_defaults['dp_primary_menu_search_closing_divider'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_closing_divider',
	'label'       => esc_attr__( 'Closing Divider', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_closing_divider'],
) );

$disruptpress_theme_defaults['dp_primary_menu_search_padding_left'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_padding_left',
	'label'       => esc_attr__( 'Padding Left', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_padding_left'],
) );


$disruptpress_theme_defaults['dp_primary_menu_search_padding_right'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_padding_right',
	'label'       => esc_attr__( 'Padding Right', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_padding_right'],
) );


$disruptpress_theme_defaults['dp_primary_menu_search_font_size_toggle'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_font_size_toggle',
	'label'       => esc_attr__( 'Adjust Font Size Manually', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_font_size_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_search_font_size'] = '16';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_search_font_size',
	//'label'       => esc_attr__( 'Sticky Menu: Menu Item Padding', 'my_textdomain' ),
	'description' => esc_attr__( 'Form Field Font Size', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '48',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_search_field_height_toggle'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_field_height_toggle',
	'label'       => esc_attr__( 'Adjust Height Manually', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_field_height_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_search_field_height'] = '24';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_search_field_height',
	'description' => esc_attr__( 'Height', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_field_height'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '16',
		'max'  => '50',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_search_field_width'] = '180';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_search_field_width',
	'description' => esc_attr__( 'Width', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_field_width'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '50',
		'max'  => '250',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_search_border_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_menu_search_border_radius',
	//'label'       => esc_attr__( 'Sticky Menu: Menu Item Padding', 'my_textdomain' ),
	'description' => esc_attr__( 'Border Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_border_radius'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '20',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_search_border_toggle'] = false;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_menu_search_border_toggle',
	'label'       => esc_attr__( 'Display Border', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_border_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_menu_search_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_search_border_color',
	'description' => esc_attr__( 'Border Color & Icon Background Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_border_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_menu_search_submit_font_color'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_menu_search_submit_font_color',
	'description' => esc_attr__( 'Icon Color', 'my_textdomain' ),
	'section'     => 'dp_primary_menu',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_menu_search_submit_font_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_menu_divider_sticky1',
	'section'     => 'dp_primary_menu',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );



