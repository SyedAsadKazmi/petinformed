<?php

Kirki::add_section( 'dp_social_share', array(
    'title'          => __( 'Social Network Buttons' ),
    'panel' => 'dp_design_options'
) );


$disruptpress_theme_defaults['dp_social_share_display_name'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_social_share_display_name',
    'label'       => __( 'Display Network Names', 'my_textdomain' ),
    'section'     => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_display_name'],
    'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_social_share_space_between_buttons'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_social_share_space_between_buttons',
    'label'       => __( 'Space Between Buttons', 'my_textdomain' ),
    'section'     => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_space_between_buttons'],
    'transport'   => 'postMessage',
) );


$disruptpress_theme_defaults['dp_social_share_alignment'] = 'full';
Kirki::add_field( 'disruptpress_theme', array(
    'type'      => 'radio-buttonset',
    'settings'  => 'dp_social_share_alignment',
    //'label'     => __( 'Header Position Inside Featured Image', 'my_textdomain' ),
    'section'   => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_alignment'],
    'transport' => 'postMessage',
    'choices'   => array(
        'full'  => __( 'Full Width', 'my_textdomain' ),
        'left' => __( 'Left', 'my_textdomain' ),
        'center'    => __( 'Center', 'my_textdomain' ),
        'right'    => __( 'Right', 'my_textdomain' ),
    )
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_social_share_divider_location',
    'section'     => 'dp_social_share',
    'default'     => '<div class="dp_customizer-divider"></div>',
) );

$disruptpress_theme_defaults['dp_social_share_location_top'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_social_share_location_top',
    'label'       => __( 'Display Buttons at Top of Content', 'my_textdomain' ),
    'section'     => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_location_top'],
    //'transport'   => 'postMessage',
) );

$disruptpress_theme_defaults['dp_social_share_location_bottom'] = '1';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_social_share_location_bottom',
    'label'       => __( 'Display Buttons at End of Content', 'my_textdomain' ),
    'section'     => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_location_bottom'],
    //'transport'   => 'postMessage',
) );


$disruptpress_theme_defaults['dp_social_share_location_float'] = '0';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'dp_social_share_location_float',
    'label'       => __( 'Display Floating Buttons', 'my_textdomain' ),
    'section'     => 'dp_social_share',
    'default'   => $disruptpress_theme_defaults['dp_social_share_location_float'],
    //'transport'   => 'postMessage',
) );


