<?php

Kirki::add_section( 'dp_test', array(
    'title'          => __( 'Test' ),
    'panel' => 'dp_design_options'
) );

$disruptpress_theme_defaults['dp_test'] = '250';
Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'slider',
    'settings'    => 'dp_primary_sidebar_width_custom',
//	'label'       => esc_attr__( 'Sidebar Width', 'my_textdomain' ),
    'section'     => 'dp_primary_sidebar',
    'default'     => $disruptpress_theme_defaults['dp_primary_sidebar_width_custom'],
    'transport'   => 'postMessage',
    'choices'     => array(
        'min'  => '100',
        'max'  => '500',
        'step' => '5',
    ),
) );





Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'custom',
	'settings'    => 'dp_test_divider1',
	'section'     => 'dp_test',
	'default'     => '<div class="dp_customizer-divider"></div>',
) );