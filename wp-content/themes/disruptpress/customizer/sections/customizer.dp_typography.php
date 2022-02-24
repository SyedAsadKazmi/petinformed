<?php

Kirki::add_section( 'dp_typography', array(
    'title'          => __( 'Typography' ),
    'panel' => 'dp_design_options'
) );


Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_typography_divider_typography_title',
    'section'     => 'dp_typography',
    'default'     => '<span class="customize-control-title">Typography General Content</span>',
) );

$disruptpress_theme_defaults['dp_typography_font_size'] = '18';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_font_size',
    'description' => esc_attr__( 'Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '48',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_font_weight'] = '400';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_font_weight',
    //'label' => esc_attr__( 'Typography', 'my_textdomain' ),
    'description' => esc_attr__( 'Font Weight', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_font_weight'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '100',
        'max'  => '900',
        'step' => '100',
    ),
) );

$disruptpress_theme_defaults['dp_typography_font_line_height'] = '1.6';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_font_line_height',
    //'label' => esc_attr__( 'Typography', 'my_textdomain' ),
    'description' => esc_attr__( 'Font Line Height', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_font_line_height'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '1',
        'max'  => '2',
        'step' => '0.05',
    ),
) );


$disruptpress_theme_defaults['dp_typography_font_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_typography_font_color',
    'description' => esc_attr__( 'Font Color', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_typography_font_color'],
    'choices'     => array(
        'alpha'     => false,
        'palettes'  => array(),
    ),
) );

$disruptpress_theme_defaults['dp_typography_link_color'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_typography_link_color',
    'description' => esc_attr__( 'Link Color', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_typography_link_color'],
    'choices'     => array(
        'alpha'     => false,
        'palettes'  => array(),
    ),
) );

$disruptpress_theme_defaults['dp_typography_link_color_hover'] = '#000000';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'color',
    'settings'    => 'dp_typography_link_color_hover',
    'description' => esc_attr__( 'Link Color Hover', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_typography_link_color_hover'],
    'choices'     => array(
        'alpha'     => false,
        'palettes'  => array(),
    ),
) );

$disruptpress_theme_defaults['dp_typography_link_underline'] = false;
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_typography_link_underline',
    'label'       => esc_attr__( 'Underline Links', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_typography_link_underline'],
) );

$disruptpress_theme_defaults['dp_typography_link_hover_underline'] = false;
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_typography_link_hover_underline',
    'label'       => esc_attr__( 'Underline Links Hover', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'transport'   => 'postMessage',
    'default'     => $disruptpress_theme_defaults['dp_typography_link_hover_underline'],
) );

$disruptpress_theme_defaults['dp_typography_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'select',
    'settings'    => 'dp_typography_font_family',
    'description' => __( 'Font Family', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_font_family'],
    'transport'   => 'postMessage',
    'multiple'    => 0,
    'choices'     => dp_global_fonts(),
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_typography_divider_typography',
    'section'     => 'dp_typography',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_typography_divider_h1_title',
    'section'     => 'dp_typography',
    'default'     => '<span class="customize-control-title">Typography Headers</span>',
) );

$disruptpress_theme_defaults['dp_typography_h1_font_size'] = '36';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h1_font_size',
    'description' => esc_attr__( 'H1 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h1_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h2_font_size'] = '30';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h2_font_size',
    'description' => esc_attr__( 'H2 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h2_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h3_font_size'] = '24';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h3_font_size',
    'description' => esc_attr__( 'H3 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h3_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h4_font_size'] = '20';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h4_font_size',
    'description' => esc_attr__( 'H4 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h4_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h5_font_size'] = '18';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h5_font_size',
    'description' => esc_attr__( 'H5 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h5_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h6_font_size'] = '16';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h6_font_size',
    'description' => esc_attr__( 'H6 Font Size (pixel)', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h6_font_size'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '10',
        'max'  => '72',
        'step' => '1',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h_font_weight'] = '700';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h_font_weight',
    //'label' => esc_attr__( 'Typography', 'my_textdomain' ),
    'description' => esc_attr__( 'H1-H6 Font Weight', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h_font_weight'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '100',
        'max'  => '900',
        'step' => '100',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h_font_line_height'] = '1.2';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_typography_h_font_line_height',
    //'label' => esc_attr__( 'Typography', 'my_textdomain' ),
    'description' => esc_attr__( 'H1-H6 Font Line Height', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h_font_line_height'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '1',
        'max'  => '2',
        'step' => '0.05',
    ),
) );

$disruptpress_theme_defaults['dp_typography_h_font_family'] = 'Open+Sans';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'select',
    'settings'    => 'dp_typography_h_font_family',
    'description' => __( 'H1 - H6 Font Family', 'my_textdomain' ),
    'section'     => 'dp_typography',
    'default'     => $disruptpress_theme_defaults['dp_typography_h_font_family'],
    'transport'   => 'postMessage',
    'multiple'    => 0,
    'choices'     => dp_global_fonts(),
) );