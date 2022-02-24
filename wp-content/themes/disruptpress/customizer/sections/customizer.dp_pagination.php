<?php

Kirki::add_section( 'dp_pagination', array(
    'title'          => __( 'Pagination' ),
    'panel' => 'dp_design_options'
) );


$disruptpress_theme_defaults['dp_pagination_text_align'] = 'left';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_pagination_text_align',
    'label'     => __( 'Alignment', 'my_textdomain' ),
    'section'   => 'dp_pagination',
    'default'   => $disruptpress_theme_defaults['dp_pagination_text_align'],
    'transport' => 'postMessage',
    'choices'   => array(
        'left'    => __( 'Left', 'my_textdomain' ),
        'center' => __( 'Center', 'my_textdomain' ),
        'right'  => __( 'Right', 'my_textdomain' ),
    )
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_location',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_typography_title',
    'section'     => 'dp_pagination',
    'default'     => '<span class="customize-control-title">Typography</span>',
) );

$disruptpress_theme_defaults['dp_pagination_font_size'] = '18';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_font_size',
    'description' => esc_attr__( 'Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '48',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_font_weight'] = '400';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_font_weight',
    //'label' => esc_attr__( 'Typography', 'my_textdomain' ),
    'description' => esc_attr__( 'Font Weight', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_font_weight'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '100',
        'max'  => '900',
        'step' => '100',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_font_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_pagination_font_color',
    'description' => esc_attr__( 'Font Color', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_pagination_font_color'],
    'choices'     => array(
        'alpha'     => false,
        'palettes'  => array(),
    ),
) );

$disruptpress_theme_defaults['dp_pagination_font_color_active'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_pagination_font_color_active',
    'description' => esc_attr__( 'Font Color Active & Hover', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_pagination_font_color_active'],
    'choices'     => array(
        'alpha'     => false,
        'palettes'  => array(),
    ),
) );



Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_typography',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );








$disruptpress_theme_defaults['dp_pagination_padding_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_padding_top',
    'label' => esc_attr__( 'Padding', 'my_textdomain' ),
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_padding_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_padding_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_padding_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_padding_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_padding_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_padding_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_padding_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_padding_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_padding_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_padding_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_padding',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_pagination_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_margin_top',
    'label' => esc_attr__( 'Margin', 'my_textdomain' ),
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_margin_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-50',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_margin_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_margin_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_margin_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-50',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_margin_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_margin_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_margin_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-50',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_margin_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_margin_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_margin_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-50',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_margin',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_pagination_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_pagination_border_style',
    'label'     => __( 'Border Style', 'my_textdomain' ),
    'section'   => 'dp_pagination',
    'default'   => 'none',
    'default'   => $disruptpress_theme_defaults['dp_pagination_border_style'],
    'transport' => 'postMessage',
    'choices'   => array(
        'none'   => __( 'None', 'my_textdomain' ),
        'solid'  => __( 'Solid', 'my_textdomain' ),
        'dotted' => __( 'Dotted', 'my_textdomain' ),
        'dashed' => __( 'Dashed', 'my_textdomain' ),
    )
) );

$disruptpress_theme_defaults['dp_pagination_border_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_top',
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_pagination_border_color',
    'label'       => esc_attr__( 'Border Color', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_color'],
    'sanitize_callback'     => '',
    'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_border',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_pagination_border_radius_top_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_radius_top_left',
    'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
    'label'       => __( 'Border Radius', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_radius_top_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_radius_top_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_radius_top_right',
    'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_radius_top_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_radius_bottom_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_radius_bottom_right',
    'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_radius_bottom_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_pagination_border_radius_bottom_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_pagination_border_radius_bottom_left',
    'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'default'     => $disruptpress_theme_defaults['dp_pagination_border_radius_bottom_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider_border_radius',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_pagination_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_pagination_color',
    'label'       => esc_attr__( 'Background Color', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_pagination_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


$disruptpress_theme_defaults['dp_pagination_color_active'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_pagination_color_active',
    'label'       => esc_attr__( 'Background Color Active & Hover', 'my_textdomain' ),
    'section'     => 'dp_pagination',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_pagination_color_active'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_pagination_divider2',
    'section'     => 'dp_pagination',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );
