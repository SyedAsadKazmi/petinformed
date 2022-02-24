<?php

Kirki::add_section( 'dp_header', array(
    'title'          => __( 'Header' ),
    'panel' => 'dp_design_options'
) );





$disruptpress_theme_defaults['dp_header_boxed'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'checkbox',
	'settings'  => 'dp_header_boxed',
	'label'     => __( 'Boxed Width', 'my_textdomain' ),
	'section'   => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_boxed'],
	'transport' => 'postMessage',
) );

$disruptpress_theme_defaults['dp_header_height'] = '160';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_height',
	'label'       => esc_attr__( 'Header Minimum Height (px)', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_height'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '400',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_header_padding_top'] = '30';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_padding_top',
	'label'       => esc_attr__( 'Header Padding', 'my_textdomain' ),
	'description' => esc_attr__( 'Top', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_padding_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_padding_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_padding_right',
	'description' => esc_attr__( 'Right', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_padding_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_padding_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_padding_bottom',
	'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_padding_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_padding_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_padding_left',
	'description' => esc_attr__( 'Left', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_padding_left'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '50',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider1',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_header_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_margin_top',
	'label'       => esc_attr__( 'Header Margin', 'my_textdomain' ),
	'description' => esc_attr__( 'Top', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_margin_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_margin_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_margin_bottom',
	'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_margin_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider2',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_header_color_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_header_color_style',
	'label'     => __( 'Background Color Style', 'my_textdomain' ),
	'section'   => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_color_style'],
	'transport'   => 'postMessage',
	'choices'   => array(
		'1' => __( 'Single', 'my_textdomain' ),
		'2' => __( 'Monochrome', 'my_textdomain' ),
		'3' => __( 'Multi Color', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_header_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_header_color',
	'label'       => esc_attr__( 'Primary Color', 'my_textdomain' ),
	'section'     => 'dp_header',
	'transport'   => 'postMessage',
	'default'   => $disruptpress_theme_defaults['dp_header_color'],
	'sanitize_callback'     => '',
	'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_header_color2'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_header_color2',
	'label'       => esc_attr__( 'Secondary Color', 'my_textdomain' ),
	'section'     => 'dp_header',
	'transport'   => 'postMessage',
	'default'   => $disruptpress_theme_defaults['dp_header_color2'],
	'sanitize_callback'     => '',
	'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_header_shade_strenght'] = '-0.5';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_shade_strenght',
	'label'       => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_shade_strenght'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '-1',
		'max'  => '1',
		'step' => '0.01',
	),
) );

$disruptpress_theme_defaults['dp_header_gradient_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_header_gradient_style',
	'label'       => esc_html__( 'Gradient Style', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_gradient_style'],
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
	),
) );

$disruptpress_theme_defaults['dp_header_gradient_advanced_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'checkbox',
	'settings'    => 'dp_header_gradient_advanced_toggle',
	'label'       => __( 'Advanced Options', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_gradient_advanced_toggle'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_header_gradient_position_parameter1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_gradient_position_parameter1',
	'label'       => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_gradient_position_parameter1'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_gradient_position_parameter2'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_gradient_position_parameter2',
	'label'       => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_gradient_position_parameter2'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_gradient_reverse_color'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'switch',
	'settings'    => 'dp_header_gradient_reverse_color',
	'label'       => __( 'Reverse Colors', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_gradient_reverse_color'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'0'  => esc_attr__( 'Enable', 'my_textdomain' ),
		'1' => esc_attr__( 'Disable', 'my_textdomain' ),
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider3',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );


//Background Image
$disruptpress_theme_defaults['dp_header_img_panel'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_header_img_panel',
	'label'     => __( 'Background Image', 'my_textdomain' ),
	'section'   => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_img_panel'],
	'transport'   => 'postMessage',
	'choices'   => array(
		'1' => __( 'None', 'my_textdomain' ),
		'2' => __( 'Pattern', 'my_textdomain' ),
		'3' => __( 'Upload', 'my_textdomain' )
	)
) );

$disruptpress_theme_defaults['dp_header_pattern'] = 'bg_noise_1.png';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'radio-image',
	'settings'    => 'dp_header_pattern',
	'label'       => esc_html__( 'Pattern', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'   => $disruptpress_theme_defaults['dp_header_pattern'],
	'transport'   => 'postMessage',
	'choices'     => array(
			'bg_noise_1.png'               => get_stylesheet_directory_uri() . '/customizer/img/pattern/bg_noise_1.png',
			'bg_noise_2.png'               => get_stylesheet_directory_uri() . '/customizer/img/pattern/bg_noise_2.png',
			'3px-tile.png'                 => get_stylesheet_directory_uri() . '/customizer/img/pattern/3px-tile.png',
			'45-degree-fabric-dark.png'    => get_stylesheet_directory_uri() . '/customizer/img/pattern/45-degree-fabric-dark.png',
			'60-lines.png'                 => get_stylesheet_directory_uri() . '/customizer/img/pattern/60-lines.png',
			'absurdity.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/absurdity.png',
			'always-grey.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/always-grey.png',
			'arabesque.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/arabesque.png',
			'arches.png'                   => get_stylesheet_directory_uri() . '/customizer/img/pattern/arches.png',
			'asfalt-dark.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/asfalt-dark.png',
			'assault.png'                  => get_stylesheet_directory_uri() . '/customizer/img/pattern/assault.png',
			'axiom-pattern.png'            => get_stylesheet_directory_uri() . '/customizer/img/pattern/axiom-pattern.png',
			'az-subtle.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/az-subtle.png',
			'billie-holiday.png'           => get_stylesheet_directory_uri() . '/customizer/img/pattern/billie-holiday.png',
			'black-linen-2.png'            => get_stylesheet_directory_uri() . '/customizer/img/pattern/black-linen-2.png',
			'black-linen.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/black-linen.png',
			'black-paper.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/black-paper.png',
			'black-scales.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/black-scales.png',
			'black-twill.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/black-twill.png',
			'brick-wall-dark.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/brick-wall-dark.png',
			'bright-squares.png'           => get_stylesheet_directory_uri() . '/customizer/img/pattern/bright-squares.png',
			'broken-noise.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/broken-noise.png',
			'brushed-alum.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/brushed-alum.png',
			'buried.png'                   => get_stylesheet_directory_uri() . '/customizer/img/pattern/buried.png',
			'cardboard-flat.png'           => get_stylesheet_directory_uri() . '/customizer/img/pattern/cardboard-flat.png',
			'cardboard.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/cardboard.png',
			'checkered-light-emboss.png'   => get_stylesheet_directory_uri() . '/customizer/img/pattern/checkered-light-emboss.png',
			'concrete-wall-3.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/concrete-wall-3.png',
			'cream-paper.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/cream-paper.png',
			'crisp-paper-ruffles.png'      => get_stylesheet_directory_uri() . '/customizer/img/pattern/crisp-paper-ruffles.png',
			'cross-scratches.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/cross-scratches.png',
			'crossword.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/crossword.png',
			'cubes.png'                    => get_stylesheet_directory_uri() . '/customizer/img/pattern/cubes.png',
			'cutcube.png'                  => get_stylesheet_directory_uri() . '/customizer/img/pattern/cutcube.png',
			'dark-brick-wall.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/dark-brick-wall.png',
			'dark-wall.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/dark-wall.png',
			'darth-stripe.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/darth-stripe.png',
			'diagmonds-light.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/diagmonds-light.png',
			'diagmonds.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/diagmonds.png',
			'diagonal-striped-brick.png'   => get_stylesheet_directory_uri() . '/customizer/img/pattern/diagonal-striped-brick.png',
			'diagonal-waves.png'           => get_stylesheet_directory_uri() . '/customizer/img/pattern/diagonal-waves.png',
			'diamond-upholstery.png'       => get_stylesheet_directory_uri() . '/customizer/img/pattern/diamond-upholstery.png',
			'dimension.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/dimension.png',
			'dirty-old-black-shirt.png'    => get_stylesheet_directory_uri() . '/customizer/img/pattern/dirty-old-black-shirt.png',
			'egg-shell.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/egg-shell.png',
			'escheresque-dark.png'         => get_stylesheet_directory_uri() . '/customizer/img/pattern/escheresque-dark.png',
			'fabric-of-squares.png'        => get_stylesheet_directory_uri() . '/customizer/img/pattern/fabric-of-squares.png',
			'fabric-plaid.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/fabric-plaid.png',
			'foggy-birds.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/foggy-birds.png',
			'gradient-squares.png'         => get_stylesheet_directory_uri() . '/customizer/img/pattern/gradient-squares.png',
			'gray-floral.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/gray-floral.png',
			'gray-lines.png'               => get_stylesheet_directory_uri() . '/customizer/img/pattern/gray-lines.png',
			'grey-jean.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/grey-jean.png',
			'greyzz.png'                   => get_stylesheet_directory_uri() . '/customizer/img/pattern/greyzz.png',
			'grid-me.png'                  => get_stylesheet_directory_uri() . '/customizer/img/pattern/grid-me.png',
			'hexellence.png'               => get_stylesheet_directory_uri() . '/customizer/img/pattern/hexellence.png',
			'light-honeycomb-dark.png'     => get_stylesheet_directory_uri() . '/customizer/img/pattern/light-honeycomb-dark.png',
			'light-honeycomb.png'          => get_stylesheet_directory_uri() . '/customizer/img/pattern/light-honeycomb.png',
			'light-sketch.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/light-sketch.png',
			'nice-snow.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/nice-snow.png',
			'noisy-net.png'                => get_stylesheet_directory_uri() . '/customizer/img/pattern/noisy-net.png',
			'office.png'                   => get_stylesheet_directory_uri() . '/customizer/img/pattern/office.png',
			'paper-1.png'                  => get_stylesheet_directory_uri() . '/customizer/img/pattern/paper-1.png',
			'paper-fibers.png'             => get_stylesheet_directory_uri() . '/customizer/img/pattern/paper-fibers.png',
			'pixel-weave.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/pixel-weave.png',
			'ps-neutral.png'               => get_stylesheet_directory_uri() . '/customizer/img/pattern/ps-neutral.png',
			'random-grey-variations.png'   => get_stylesheet_directory_uri() . '/customizer/img/pattern/random-grey-variations.png',
			'redox-01.png'                 => get_stylesheet_directory_uri() . '/customizer/img/pattern/redox-01.png',
			'redox-02.png'                 => get_stylesheet_directory_uri() . '/customizer/img/pattern/redox-02.png',
			'stressed-linen.png'           => get_stylesheet_directory_uri() . '/customizer/img/pattern/stressed-linen.png',
			'subtle-grey.png'              => get_stylesheet_directory_uri() . '/customizer/img/pattern/subtle-grey.png',
			'transparent-square-tiles.png' => get_stylesheet_directory_uri() . '/customizer/img/pattern/transparent-square-tiles.png',
			'washi.png'                    => get_stylesheet_directory_uri() . '/customizer/img/pattern/washi.png',
			'white-brushed.png'            => get_stylesheet_directory_uri() . '/customizer/img/pattern/white-brushed.png',
			'white-texture.png'            => get_stylesheet_directory_uri() . '/customizer/img/pattern/white-texture.png',
			'whitey.png'                   => get_stylesheet_directory_uri() . '/customizer/img/pattern/whitey.png',
	),
) );

$disruptpress_theme_defaults['dp_header_img_upload'] = '';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'image',
	'settings'    => 'dp_header_img_upload',
	'label'       => __( 'Upload Background Image', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_img_upload'],
	'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_header_img_repeat'] = 'no-repeat';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_header_img_repeat',
	'label'       => __( 'Background Repeat', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_img_repeat'],
	'transport'   => 'postMessage',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__( 'No Repeat', 'my_textdomain' ),
		'repeat'    => esc_attr__( 'Repeat All', 'my_textdomain' ),
		'repeat-x'  => esc_attr__( 'Repeat Horizontally', 'my_textdomain' ),
		'repeat-y'  => esc_attr__( 'Repeat Vertically', 'my_textdomain' ),
		'inherit'   => esc_attr__( 'Inherit', 'my_textdomain' ),
	),
) );

$disruptpress_theme_defaults['dp_header_img_size'] = 'auto';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_header_img_size',
	'label'       => __( 'Background Size', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_img_size'],
	'transport'   => 'postMessage',
	'multiple'    => 1,
	'choices'     => array(
		'auto'    => esc_attr__( 'Auto', 'my_textdomain' ),
		'cover'   => esc_attr__( 'Cover', 'my_textdomain' ),
		'contain' => esc_attr__( 'Contain', 'my_textdomain' ),
	),
) );

$disruptpress_theme_defaults['dp_header_img_attachment'] = 'scroll';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_header_img_attachment',
	'label'       => __( 'Background Attachment', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_img_attachment'],
	'transport'   => 'postMessage',
	'multiple'    => 1,
	'choices'     => array(
		'scroll'  => esc_attr__( 'Scroll', 'my_textdomain' ),
		'fixed'   => esc_attr__( 'Fixed', 'my_textdomain' ),
		'inherit' => esc_attr__( 'Inherit', 'my_textdomain' ),
	),
) );

$disruptpress_theme_defaults['dp_header_img_position'] = 'left top';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'select',
	'settings'    => 'dp_header_img_position',
	'label'       => __( 'Background Position', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_img_position'],
	'transport'   => 'postMessage',
	'multiple'    => 1,
	'choices'     => array(
		'left top'      => esc_attr__( 'Left Top', 'my_textdomain' ),
		'left center'   => esc_attr__( 'Left Center', 'my_textdomain' ),
		'left bottom'   => esc_attr__( 'Left Bottom', 'my_textdomain' ),
		'center top'    => esc_attr__( 'Center Top', 'my_textdomain' ),
		'center center' => esc_attr__( 'Center Center', 'my_textdomain' ),
		'center bottom' => esc_attr__( 'Center Bottom', 'my_textdomain' ),
		'right top'     => esc_attr__( 'Right Top', 'my_textdomain' ),
		'right center'  => esc_attr__( 'Right Center', 'my_textdomain' ),
		'right bottom'  => esc_attr__( 'Right Bottom', 'my_textdomain' ),
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider4',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_header_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
	'type'      => 'radio-buttonset',
	'settings'  => 'dp_header_border_style',
	'label'     => __( 'Border Style', 'my_textdomain' ),
	'section'   => 'dp_header',
	'default'   => 'none',
 	'default'   => $disruptpress_theme_defaults['dp_header_border_style'],
	'transport' => 'postMessage',
	'choices'   => array(
		'none'   => __( 'None', 'my_textdomain' ),
		'solid'  => __( 'Solid', 'my_textdomain' ),
		'dotted' => __( 'Dotted', 'my_textdomain' ),
		'dashed' => __( 'Dashed', 'my_textdomain' ),
	)
) );

$disruptpress_theme_defaults['dp_header_border_width_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_width_top',
	'description' => esc_attr__( 'Top', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_width_top'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_width_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_width_right',
	'description' => esc_attr__( 'Right', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_width_right'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_width_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_width_bottom',
	'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_width_bottom'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_width_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_width_left',
	'description' => esc_attr__( 'Left', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_width_left'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'color',
	'settings'    => 'dp_header_border_color',
	'label'       => esc_attr__( 'Border Color', 'my_textdomain' ),
	'section'     => 'dp_header',
	'transport'   => 'postMessage',
	'default'     => $disruptpress_theme_defaults['dp_header_border_color'],
	'sanitize_callback'     => '',
	'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider5',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_header_border_radius_topleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_radius_topleft',
	'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
	'label'       => __( 'Border Radius', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_radius_topleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_radius_topright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_radius_topright',
	'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_radius_topright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_radius_bottomright'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_radius_bottomright',
	'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_radius_bottomright'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

$disruptpress_theme_defaults['dp_header_border_radius_bottomleft'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'slider',
	'settings'    => 'dp_header_border_radius_bottomleft',
	'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
	'section'     => 'dp_header',
	'default'     => $disruptpress_theme_defaults['dp_header_border_radius_bottomleft'],
	'transport'   => 'postMessage',
	'choices'     => array(
		'min'  => '0',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_header_divider6',
	'section'     => 'dp_header',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );




