<?php

Kirki::add_section( 'dp_blog_roll_container_2', array(
    'title'          => __( 'Blog Roll Container 2' ),
    'panel' => 'dp_design_options'
) );


$disruptpress_theme_defaults['dp_blog_roll_container_2_padding_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_padding_top',
    'label' => esc_attr__( 'Padding', 'my_textdomain' ),
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_padding_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_padding_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_padding_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_padding_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_padding_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_padding_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_padding_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_padding_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_padding_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_padding_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider_padding',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_margin_top',
    'label' => esc_attr__( 'Margin', 'my_textdomain' ),
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_margin_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_margin_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_margin_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_margin_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_margin_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_margin_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_margin_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_margin_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_margin_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_margin_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider_margin',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_blog_roll_container_2_border_style',
    'label'     => __( 'Border Style', 'my_textdomain' ),
    'section'   => 'dp_blog_roll_container_2',
    'default'   => 'none',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_style'],
    'transport' => 'postMessage',
    'choices'   => array(
        'none'   => __( 'None', 'my_textdomain' ),
        'solid'  => __( 'Solid', 'my_textdomain' ),
        'dotted' => __( 'Dotted', 'my_textdomain' ),
        'dashed' => __( 'Dashed', 'my_textdomain' ),
    )
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_top',
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_blog_roll_container_2_border_color',
    'label'       => esc_attr__( 'Border Color', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_color'],
    'sanitize_callback'     => '',
    'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider_border',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_top_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_radius_top_left',
    'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
    'label'       => __( 'Border Radius', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_top_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_top_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_radius_top_right',
    'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_top_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_bottom_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_radius_bottom_right',
    'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_bottom_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_bottom_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_border_radius_bottom_left',
    'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_border_radius_bottom_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider_border_radius',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_blog_roll_container_2_shadow_style',
    'label'     => __( 'Shadow Style', 'my_textdomain' ),
    'section'   => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_style'],
    'transport' => 'postMessage',
    'choices'   => array(
        'none'    => __( 'None', 'my_textdomain' ),
        'presets' => __( 'Presets', 'my_textdomain' ),
        'custom'  => __( 'Custom', 'my_textdomain' ),
    )
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_presets'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_blog_roll_container_2_shadow_presets',
    //'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
    'section'   => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_presets'],
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

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_horizontal'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shadow_horizontal',
    //'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
    'description' => esc_attr__( 'Horizontal', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_horizontal'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '40',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_vertical'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shadow_vertical',
    //'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
    'description' => esc_attr__( 'Vertical', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_vertical'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '40',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_blur_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shadow_blur_radius',
    'description'  => esc_attr__( 'Blur Radius', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_blur_radius'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_spread_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shadow_spread_radius',
    'description' => esc_attr__( 'Spread Radius', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_spread_radius'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_opacity'] = '0.75';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shadow_opacity',
    'description'       => esc_attr__( 'Opacity', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'     => $disruptpress_theme_defaults['dp_blog_roll_container_2_shadow_opacity'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0.00',
        'max'  => '1.00',
        'step' => '0.01',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider_shadow',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );
















$disruptpress_theme_defaults['dp_blog_roll_container_2_color_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_blog_roll_container_2_color_style',
    'label'     => __( 'Background Color Style', 'my_textdomain' ),
    'section'   => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_color_style'],
    'transport'   => 'postMessage',
    'choices'   => array(
        '1' => __( 'Single', 'my_textdomain' ),
        '2' => __( 'Monochrome', 'my_textdomain' ),
        '3' => __( 'Multi Color', 'my_textdomain' )
    )
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_blog_roll_container_2_color',
    'label'       => esc_attr__( 'Primary Color', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_color2'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_blog_roll_container_2_color2',
    'label'       => esc_attr__( 'Secondary Color', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_color2'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_shade_strenght'] = '-0.5';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_shade_strenght',
    'label'       => esc_attr__( 'Shade Strenght', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_shade_strenght'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-1',
        'max'  => '1',
        'step' => '0.01',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_style'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'radio-image',
    'settings'    => 'dp_blog_roll_container_2_gradient_style',
    'label'       => esc_html__( 'Gradient Style', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_style'],
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

$disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_advanced_toggle'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_blog_roll_container_2_gradient_advanced_toggle',
    'label'       => __( 'Advanced Options', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_advanced_toggle'],
    'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_position_parameter1'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_gradient_position_parameter1',
    'label'       => esc_attr__( 'Gradient Position Parameter 1', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_position_parameter1'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_position_parameter2'] = '100';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_blog_roll_container_2_gradient_position_parameter2',
    'label'       => esc_attr__( 'Gradient Position Parameter 2', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_position_parameter2'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_reverse_color'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'switch',
    'settings'    => 'dp_blog_roll_container_2_gradient_reverse_color',
    'label'       => __( 'Reverse Colors', 'my_textdomain' ),
    'section'     => 'dp_blog_roll_container_2',
    'default'   => $disruptpress_theme_defaults['dp_blog_roll_container_2_gradient_reverse_color'],
    'transport'   => 'postMessage',
    'choices'     => array(
        '0'  => esc_attr__( 'Enable', 'my_textdomain' ),
        '1' => esc_attr__( 'Disable', 'my_textdomain' ),
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_blog_roll_container_2_divider2',
    'section'     => 'dp_blog_roll_container_2',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );
