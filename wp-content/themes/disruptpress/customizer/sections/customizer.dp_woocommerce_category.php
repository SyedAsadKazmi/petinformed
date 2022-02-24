<?php

Kirki::add_section( 'dp_woocommerce_category', array(
    'title'          => __( 'WooCommerce' ),
    'panel' => 'dp_design_options'
) );

//
//
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'custom',
//    'settings'    => 'dp_woocommerce_category_divider_typography_title',
//    'section'     => 'dp_woocommerce_category',
//    'default'     => '<span class="customize-control-title">Typography</span>',
//) );
//
//
//$disruptpress_theme_defaults['dp_woocommerce_category_font_size'] = '18';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'slider',
//    'settings'    => 'dp_woocommerce_category_font_size',
//    'description' => esc_attr__( 'Font Size (pixel)', 'my_textdomain' ),
//    'section'     => 'dp_woocommerce_category',
//    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_font_size'],
//    'transport'   => 'postMessage',
//    'choices'     => array(
//        'min'  => '10',
//        'max'  => '48',
//        'step' => '1',
//    ),
//) );
//
//
//$disruptpress_theme_defaults['dp_woocommerce_category_font_color'] = '#000000';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'color',
//    'settings'    => 'dp_woocommerce_category_font_color',
//    'description' => esc_attr__( 'Font Color', 'my_textdomain' ),
//    'section'     => 'dp_woocommerce_category',
//    'transport'   => 'postMessage',
//    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_font_color'],
//    'choices'     => array(
//        'alpha'     => false,
//        'palettes'  => array(),
//    ),
//) );
//
//$disruptpress_theme_defaults['dp_woocommerce_category_link_color'] = '#000000';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'color',
//    'settings'    => 'dp_woocommerce_category_link_color',
//    'description' => esc_attr__( 'Link Color', 'my_textdomain' ),
//    'section'     => 'dp_woocommerce_category',
//    'transport'   => 'postMessage',
//    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_link_color'],
//    'choices'     => array(
//        'alpha'     => false,
//        'palettes'  => array(),
//    ),
//) );
//
//$disruptpress_theme_defaults['dp_woocommerce_category_link_color_hover'] = '#000000';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'color',
//    'settings'    => 'dp_woocommerce_category_link_color_hover',
//    'description' => esc_attr__( 'Link Color Hover', 'my_textdomain' ),
//    'section'     => 'dp_woocommerce_category',
//    'transport'   => 'postMessage',
//    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_link_color_hover'],
//    'choices'     => array(
//        'alpha'     => false,
//        'palettes'  => array(),
//    ),
//) );
//
//
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'custom',
//    'settings'    => 'dp_woocommerce_category_divider_typography',
//    'section'     => 'dp_woocommerce_category',
//    'default'     => '<div class="dp_customizer-divider"></div>',
//) );


// $disruptpress_theme_defaults['dp_woocommerce_category_width'] = '33.333%';
// Kirki::add_field( 'disruptpress_theme', array(
//     'type'      => 'radio-buttonset',
//     'settings'  => 'dp_woocommerce_category_width',
//     'label'     => __( 'Wrap Width', 'my_textdomain' ),
//     'section'   => 'dp_woocommerce_category',
//     'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_width'],
//     'transport' => 'postMessage',
//     'choices'   => array(
//         '100%'   => __( '100%', 'my_textdomain' ),
// //        '83.333%'   => __( '83.3%', 'my_textdomain' ),
// //        '80%'   => __( '80%', 'my_textdomain' ),
// //        '75%'   => __( '75%', 'my_textdomain' ),
// //        '66.666%'   => __( '66.6%', 'my_textdomain' ),
//         '50%'   => __( '50%', 'my_textdomain' ),
//         '33.333%'   => __( '33.3%', 'my_textdomain' ),
//         '25%'   => __( '25%', 'my_textdomain' ),
//         '20%'   => __( '20%', 'my_textdomain' ),
//         '16.666%'   => __( '16.6%', 'my_textdomain' ),
//         '14.285%'   => __( '14.2%', 'my_textdomain' ),
//         '12.5%'   => __( '12.5%', 'my_textdomain' ),
//     )
// ) );

// Kirki::add_field( 'disruptpress_theme', array(
//     'type'        => 'custom',
//     'settings'    => 'dp_woocommerce_category_divider_width',
//     'section'     => 'dp_woocommerce_category',
//     'default'     => '<div class="dp_customizer-divider"></div>',
// ) );

$disruptpress_theme_defaults['dp_woocommerce_category_padding'] = '20';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_padding',
    'label' => esc_attr__( 'Padding', 'my_textdomain' ),
    //'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_padding'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider_padding',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_woocommerce_category_margin_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_margin_top',
    'label' => esc_attr__( 'Margin', 'my_textdomain' ),
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_margin_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_margin_right'] = '20';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_margin_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_margin_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_margin_bottom'] = '30';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_margin_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_margin_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_margin_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_margin_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_margin_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '50',
        'step' => '5',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider_margin',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_woocommerce_category_border_style',
    'label'     => __( 'Border Style', 'my_textdomain' ),
    'section'   => 'dp_woocommerce_category',
    'default'   => 'none',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_border_style'],
    'transport' => 'postMessage',
    'choices'   => array(
        'none'   => __( 'None', 'my_textdomain' ),
        'solid'  => __( 'Solid', 'my_textdomain' ),
        'dotted' => __( 'Dotted', 'my_textdomain' ),
        'dashed' => __( 'Dashed', 'my_textdomain' ),
    )
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_top'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_border_top',
    'description' => esc_attr__( 'Top', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_top'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_right'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_border_right',
    'description' => esc_attr__( 'Right', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_right'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_bottom'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_border_bottom',
    'description' => esc_attr__( 'Bottom', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_bottom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_left'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_border_left',
    'description' => esc_attr__( 'Left', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_left'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '20',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_border_color',
    'label'       => esc_attr__( 'Border Color', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_color'],
    'sanitize_callback'     => '',
    'alpha'       => false,
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider_border',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_woocommerce_category_border_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_border_radius',
    //'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
    'label'       => __( 'Border Radius', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_radius'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '40',
        'step' => '1',
    ),
) );

// $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_top_left'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
//     'type'        => 'slider',
//     'settings'    => 'dp_woocommerce_category_border_radius_top_left',
//     'description' => esc_attr__( 'Top Left', 'my_textdomain' ),
//     'label'       => __( 'Border Radius', 'my_textdomain' ),
//     'section'     => 'dp_woocommerce_category',
//     'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_top_left'],
//     'transport'   => 'postMessage',
//     'choices'     => array(
//         'min'  => '0',
//         'max'  => '100',
//         'step' => '1',
//     ),
// ) );

// $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_top_right'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
//     'type'        => 'slider',
//     'settings'    => 'dp_woocommerce_category_border_radius_top_right',
//     'description' => esc_attr__( 'Top Right', 'my_textdomain' ),
//     'section'     => 'dp_woocommerce_category',
//     'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_top_right'],
//     'transport'   => 'postMessage',
//     'choices'     => array(
//         'min'  => '0',
//         'max'  => '100',
//         'step' => '1',
//     ),
// ) );

// $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_bottom_right'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
//     'type'        => 'slider',
//     'settings'    => 'dp_woocommerce_category_border_radius_bottom_right',
//     'description' => esc_attr__( 'Bottom Right', 'my_textdomain' ),
//     'section'     => 'dp_woocommerce_category',
//     'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_bottom_right'],
//     'transport'   => 'postMessage',
//     'choices'     => array(
//         'min'  => '0',
//         'max'  => '100',
//         'step' => '1',
//     ),
// ) );

// $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_bottom_left'] = '0';
// Kirki::add_field( 'disruptpress_theme', array(
//     'type'        => 'slider',
//     'settings'    => 'dp_woocommerce_category_border_radius_bottom_left',
//     'description' => esc_attr__( 'Bottom Left', 'my_textdomain' ),
//     'section'     => 'dp_woocommerce_category',
//     'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_border_radius_bottom_left'],
//     'transport'   => 'postMessage',
//     'choices'     => array(
//         'min'  => '0',
//         'max'  => '100',
//         'step' => '1',
//     ),
// ) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider_border_radius',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_style'] = 'none';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_woocommerce_category_shadow_style',
    'label'     => __( 'Shadow Style', 'my_textdomain' ),
    'section'   => 'dp_woocommerce_category',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_style'],
    'transport' => 'postMessage',
    'choices'   => array(
        'none'    => __( 'None', 'my_textdomain' ),
        'presets' => __( 'Presets', 'my_textdomain' ),
        'custom'  => __( 'Custom', 'my_textdomain' ),
    )
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_presets'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_woocommerce_category_shadow_presets',
    //'label'     => __( 'Menu Shadow Style', 'my_textdomain' ),
    'section'   => 'dp_woocommerce_category',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_presets'],
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

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_horizontal'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_shadow_horizontal',
    //'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
    'description' => esc_attr__( 'Horizontal', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_horizontal'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '40',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_vertical'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_shadow_vertical',
    //'label'       => esc_attr__( 'Shadow Bottom', 'my_textdomain' ),
    'description' => esc_attr__( 'Vertical', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_vertical'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '40',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_blur_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_shadow_blur_radius',
    'description'  => esc_attr__( 'Blur Radius', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_blur_radius'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_spread_radius'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_shadow_spread_radius',
    'description' => esc_attr__( 'Spread Radius', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_spread_radius'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '-30',
        'max'  => '100',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_woocommerce_category_shadow_opacity'] = '0.75';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_shadow_opacity',
    'description'       => esc_attr__( 'Opacity', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_shadow_opacity'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '0.00',
        'max'  => '1.00',
        'step' => '0.01',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider_shadow',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );



$disruptpress_theme_defaults['dp_woocommerce_category_color'] = '#CCCCCC';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_color',
    'label'       => 'Background Color', 'my_textdomain',
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider2',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_woocommerce_category_sale_bg_color'] = '#F44336';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_sale_bg_color',
    'label'       => 'Sales Splash Background Color', 'my_textdomain',
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_sale_bg_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );

$disruptpress_theme_defaults['dp_woocommerce_category_sale_font_color'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_sale_font_color',
    'label'       => 'Sales Splash Font Color', 'my_textdomain',
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_sale_font_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider20',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_woocommerce_category_cart_bg_color'] = '#3a3a3a';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_cart_bg_color',
    'label'       => 'Add To Cart Background Color', 'my_textdomain',
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_cart_bg_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


$disruptpress_theme_defaults['dp_woocommerce_category_cart_font_color'] = '#FFFFFF';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_woocommerce_category_cart_font_color',
    'label'       => 'Add To Cart Font Color', 'my_textdomain',
    'section'     => 'dp_woocommerce_category',
    'transport'   => 'postMessage',
    'default'   => $disruptpress_theme_defaults['dp_woocommerce_category_cart_font_color'],
    'sanitize_callback'     => '',
    'alpha'       => true,
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider21',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );


$disruptpress_theme_defaults['dp_woocommerce_category_product_font_size'] = '38';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_woocommerce_category_product_font_size',
    'description'  => esc_attr__( 'Title Font Size on Product Page', 'my_textdomain' ),
    'section'     => 'dp_woocommerce_category',
    'default'     => $disruptpress_theme_defaults['dp_woocommerce_category_product_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '24',
        'max'  => '72',
        'step' => '2',
    ),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_woocommerce_category_divider22',
    'section'     => 'dp_woocommerce_category',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );
