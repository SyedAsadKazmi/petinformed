<?php

Kirki::add_section( 'dp_slider', array(
    'title'          => __( 'Slider' ),
    'panel' => 'dp_design_options'
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_slider_moved_message',
    'section'     => 'dp_slider',
    'default'     => 'Slider options have been moved to <a href="' . admin_url('admin.php?page=_theme_options&tab=6').'" target="_blank">WordPress Admin Panel -> Theme Options -> Slider</a>',
) );
//
//$disruptpress_theme_defaults['dp_slider_enabled'] = '1';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'checkbox',
//    'settings'    => 'dp_slider_enabled',
//    'label'       => __( 'Enable Slider', 'my_textdomain' ),
//    'section'     => 'dp_slider',
//    'default'   => $disruptpress_theme_defaults['dp_slider_enabled'],
//    //'transport'   => 'postMessage',
//) );
//
//$disruptpress_theme_defaults['dp_slider_width'] = '70%';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'      => 'radio-buttonset',
//    'settings'  => 'dp_slider_width',
//    'label'     => __( 'Slider Width', 'my_textdomain' ),
//    'section'   => 'dp_slider',
//    'default'   => $disruptpress_theme_defaults['dp_slider_width'],
//    //'transport' => 'postMessage',
//    'choices'   => array(
//        '100%'  => __( '100%', 'my_textdomain' ),
//        '70%' => __( '70%', 'my_textdomain' ),
//    )
//) );
//
//$disruptpress_theme_defaults['dp_slider_aspect_radio'] = '219';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'      => 'radio-buttonset',
//    'settings'  => 'dp_slider_aspect_radio',
//    'label'     => __( 'Slider Aspect Ratio', 'my_textdomain' ),
//    'section'   => 'dp_slider',
//    'default'   => $disruptpress_theme_defaults['dp_slider_aspect_radio'],
//    //'transport' => 'postMessage',
//    'choices'   => array(
//        '169' => __( '16 : 9', 'my_textdomain' ),
//        '219'  => __( '21 : 9', 'my_textdomain' ),
//    )
//) );
//
//$disruptpress_theme_defaults['dp_slider_sidebar_items'] = '2';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'      => 'radio-buttonset',
//    'settings'  => 'dp_slider_sidebar_items',
//    'label'     => __( 'Slider Sidebar Items', 'my_textdomain' ),
//    'section'   => 'dp_slider',
//    'default'   => $disruptpress_theme_defaults['dp_slider_sidebar_items'],
//    //'transport' => 'postMessage',
//    'choices'   => array(
//        '2'  => __( '2', 'my_textdomain' ),
//        '3' => __( '3', 'my_textdomain' ),
//    )
//) );