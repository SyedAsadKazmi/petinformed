<?php

Kirki::add_section( 'dp_sort_header', array(
	'title'          => __( 'Header Arrangement' ),
	'panel' => 'dp_theme_settings'
) );

/**
 * Header Arrangement
 */
$disruptpress_theme_defaults['dp_sort_header_arrangement'] = array(
	'header',
	'nav_primary',
	'nav_secondary'
);
Kirki::add_field( 'disruptpress_theme', array(
	'type'        => 'sortable',
	'settings'    => 'dp_sort_header_arrangement',
	'label'       => __( 'Header Arrangement', 'my_textdomain' ),
	'section'     => 'dp_sort_header',
	'default'     => $disruptpress_theme_defaults['dp_sort_header_arrangement'],
	'choices'     => array(
		'nav_primary' => esc_attr__( 'Nav Primary', 'my_textdomain' ),
		'nav_secondary' => esc_attr__( 'Nav Secondary', 'my_textdomain' ),
		'header' => esc_attr__( 'Header', 'my_textdomain' ),
	),
) );

// $disruptpress_theme_defaults['dp_sort_header_arrangement_test1'] = '1';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_sort_header_arrangement_test1',
// 	'label'     => __( 'Header Position', 'my_textdomain' ),
// 	'section'   => 'dp_sort_header',
// 	'default'   => $disruptpress_theme_defaults['dp_sort_header_arrangement_test1'],
// 	//'transport' => 'postMessage',
// 	'choices'   => array(
// 		'1' => __( '1', 'my_textdomain' ),
// 		'2' => __( '2', 'my_textdomain' ),
// 		'3' => __( '3', 'my_textdomain' )
// 	)
// ) );

// $disruptpress_theme_defaults['dp_sort_header_arrangement_test2'] = '2';
// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'      => 'radio-buttonset',
// 	'settings'  => 'dp_sort_header_arrangement_test2',
// 	'label'     => __( 'Nav 1 Position', 'my_textdomain' ),
// 	'section'   => 'dp_sort_header',
// 	'default'   => $disruptpress_theme_defaults['dp_sort_header_arrangement_test2'],
// 	//'transport' => 'postMessage',
// 	'choices'   => array(
// 		'1' => __( '1', 'my_textdomain' ),
// 		'2' => __( '2', 'my_textdomain' ),
// 		'3' => __( '3', 'my_textdomain' )
// 	)
// ) );


// Kirki::add_field( 'disruptpress_theme', array(
// 	'type'        => 'custom',
// 	'settings'    => 'dp_sort_header_divider',
// 	'section'     => 'dp_sort_header',
// 	'default'     => '<div class="dp_customizer-divider"></div>',
// ) );