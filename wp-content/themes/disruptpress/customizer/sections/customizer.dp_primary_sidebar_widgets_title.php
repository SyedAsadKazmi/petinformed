<?php

Kirki::add_section( 'dp_primary_sidebar_widgets_title', array(
    'title'          => __( 'Primary Sidebar Widgets Title' ),
    'panel' => 'dp_design_options'
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_width'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_sidebar_widgets_title_width',
	'label'       => esc_attr__( 'Container Full Width', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_width'],
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_content_width'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_sidebar_widgets_title_content_width',
	'label'       => esc_attr__( 'Content Full Width', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_content_width'],
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_container_background'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_sidebar_widgets_title_container_background',
	'label'       => esc_attr__( 'Container Background Transparent', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_container_background'],
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_padding'] = '20';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_padding',
	'label'       => esc_attr__( 'Widget Title Padding', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_padding'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '5',
	),
) );


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_margin_top',
	'label'       => esc_attr__( 'Margin Top', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_margin_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '5',
	),
) );


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_margin_bottom'] = '20';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_margin_bottom',
	'label'       => esc_attr__( 'Margin Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_margin_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '5',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_divider1',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_size'] = '24';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_font_size',
	'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Font Size (pixel)', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_size'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '10',
		'max'  => '48',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_weight'] = '700';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_font_weight',
	//'label' => esc_attr__( 'Typography', 'my_textdomain' ),
	'description' => esc_attr__( 'Font Weight', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_weight'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '100',
		'max'  => '900',
		'step' => '100',
	),
) );


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_sidebar_widgets_title_font_color',
	'description' => esc_attr__( 'Font Color', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_color'],
	'choices'     => array(
		'alpha'     => false,
		'palettes'  => array(),
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_family_toggle'] = true;
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_sidebar_widgets_title_font_family_toggle',
	'label'       => esc_attr__( 'Use Global Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_family_toggle'],
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_primary_sidebar_widgets_title_font_family',
	'description' => __( 'Font Family', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_font_family'],
	'transport'   => 'postMessage',
	'multiple'    => 0,
	'choices'     => dp_global_fonts(),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_divider2',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );



$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_sidebar_widgets_title_border_style',
	'label'     => __( 'Menu Border Style', 'my_textdomain' ),
	'section'   => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'none'   => __( 'None', 'my_textdomain' ),
		'solid'  => __( 'Solid', 'my_textdomain' ),
		'dotted' => __( 'Dotted', 'my_textdomain' ),
		'dashed' => __( 'Dashed', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_width_top',
	'description' => esc_attr__( 'Border Width Top', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_width_right',
	'description' => esc_attr__( 'Border Width Right', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_width_bottom',
	'description' => esc_attr__( 'Border Width Bottom', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_width_left',
	'description' => esc_attr__( 'Border Width Left', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_width_left'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_color',
	'description' => esc_attr__( 'Border Color', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_color'],
	'sanitize_callback'     => '',
	'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_bg_active_divider6',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_sidebar_widgets_title_shadow_bottom_style',
	'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
	'section'   => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'none'    => __( 'None', 'my_textdomain' ),
		'presets' => __( 'Presets', 'my_textdomain' ),
		'custom'  => __( 'Custom', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_presets'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_sidebar_widgets_title_shadow_presets',
	//'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
	'section'   => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_presets'],
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


$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_horizontal'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shadow_bottom_horizontal',
	//'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
	'description' => esc_attr__( 'Horizonal', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_horizontal'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-30',
		'max'  => '40',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_vertical'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shadow_bottom_vertical',
	//'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
	'description' => esc_attr__( 'Vertical', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_vertical'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-30',
		'max'  => '40',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius',
	'description'  => esc_attr__( 'Blur Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_blur_radius'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius',
	'description' => esc_attr__( 'Spread Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_spread_radius'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-30',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_opacity'] = '0.75';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shadow_bottom_opacity',
	'description'       => esc_attr__( 'Opacity', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shadow_bottom_opacity'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0.00',
		'max'  => '1.00',
		'step' => '0.01',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_divider9',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_topleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_radius_topleft',
	'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
	'label'       => __( 'Border Radius', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_topleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_topright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_radius_topright',
	'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_topright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_bottomright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_radius_bottomright',
	'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_bottomright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_bottomleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_border_radius_bottomleft',
	'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_border_radius_bottomleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_divider1x',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_primary_sidebar_widgets_title_color_style',
	'label'     => __( 'Background Color Style', 'my_textdomain' ),
	'section'   => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color_style'],
	'transport'   => 'postMessage',
	'choices'   => array(
		'1' => __( 'Single', 'my_textdomain' ),
		'2' => __( 'Monochrome', 'my_textdomain' ),
		'3' => __( 'Multi Color', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_sidebar_widgets_title_color',
	'label'       => esc_attr__( 'Primary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color'],
	'sanitize_callback'     => '',
	'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color2'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_primary_sidebar_widgets_title_color2',
	'label'       => esc_attr__( 'Secondary Color', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'transport'   => 'postMessage',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_color2'],
	'sanitize_callback'     => '',
	'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shade_strenght'] = '-0.5';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_shade_strenght',
	'label'       => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_shade_strenght'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-1',
		'max'  => '1',
		'step' => '0.01',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_primary_sidebar_widgets_title_gradient_style',
	'label'       => esc_html__( 'Gradient Style', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_style'],
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

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_advanced_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_primary_sidebar_widgets_title_gradient_advanced_toggle',
	'label'       => __( 'Advanced Options', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_advanced_toggle'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_position_parameter1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_gradient_position_parameter1',
	'label'       => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_position_parameter1'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_position_parameter2'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_primary_sidebar_widgets_title_gradient_position_parameter2',
	'label'       => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_position_parameter2'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_reverse_color'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'switch',
	'settings'    => 'dp_primary_sidebar_widgets_title_gradient_reverse_color',
	'label'       => __( 'Reverse Colors', 'my_textdomain' ),
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'   => $disruptpress_theme_defaults['dp_primary_sidebar_widgets_title_gradient_reverse_color'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'0'  => esc_attr__( 'Enable', 'my_textdomain' ),
		'1' => esc_attr__( 'Disable', 'my_textdomain' ),
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_primary_sidebar_widgets_title_divider3',
	'section'     => 'dp_primary_sidebar_widgets_title',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );
