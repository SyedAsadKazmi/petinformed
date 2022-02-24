<?php

Kirki::add_section( 'dp_front_page_grid', array(
    'title'          => __( 'Front Page Grid' ),
    'panel' => 'dp_design_options'
) );

Kirki::add_field( 'disruptpress_theme', array(
    'type'        => 'custom',
    'settings'    => 'dp_grid_moved_message',
    'section'     => 'dp_front_page_grid',
    'default'     => 'Front Page Grid options have been moved to <a href="' . admin_url('admin.php?page=_theme_options&tab=7').'" target="_blank">WordPress Admin Panel -> Theme Options -> Front Page Grid</a>',
) );

//
//$category_choices = array();
//$category_choices['0'] = 'All Categories';
//
//foreach ( get_terms('category','parent=0&hide_empty=0') as $category_object ) {
//    $category_choices[$category_object->term_id] = $category_object->name;
//}
//
//$disruptpress_theme_defaults['dp_front_page_grid_container_category'] = '0';
//Kirki::add_field( 'disruptpress_theme', array(
//    'type'        => 'select',
//    'settings'    => 'dp_front_page_grid_container_category',
//    'label'     => __( 'Select Category', 'my_textdomain' ),
//    'section'     => 'dp_front_page_grid',
//    'default'     => $disruptpress_theme_defaults['dp_front_page_grid_container_category'],
//    //'transport'   => 'postMessage',
//    'multiple'    => 0,
//    'choices'   => $category_choices,
//
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_container_location'] = false;
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'checkbox',
//	'settings'  => 'dp_front_page_grid_container_location',
//	'label'     => __( 'Container Iniside Sidebar Wrap', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_container_location'],
//	//'transport' => 'postMessage',
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_container_margin_top'] = '0';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_container_margin_top',
//	'description' => esc_attr__( 'Container Margin Top', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_container_margin_top'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '80',
//		'step' => '1',
//	),
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_container_margin_bottom'] = '25';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_container_margin_bottom',
//	'description' => esc_attr__( 'Container Margin Bottom', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_container_margin_bottom'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '50',
//		'step' => '1',
//	),
//) );
//
//
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'custom',
//	'settings'    => 'dp_front_page_grid_divider0',
//	'section'     => 'dp_front_page_grid',
//	'default'     => '<div class="dp_customizer-divider"></div>',
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_limit'] = '9';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'number',
//	'settings'    => 'dp_front_page_grid_item_limit',
//	'label'       => esc_attr__( 'Amount Of Items To Display', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_limit'],
//  //'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => 0,
//		'max'  => 40,
//		'step' => 1,
//	),
//) );
//
//// $disruptpress_theme_defaults['dp_front_page_grid_items_per_line'] = '3';
//// Kirki::add_field( 'disruptpress_theme', array(
//// 	'type'        => 'slider',
//// 	'settings'    => 'dp_front_page_grid_items_per_line',
//// 	'description' => esc_attr__( 'Items Per Line', 'my_textdomain' ),
//// 	'section'     => 'dp_front_page_grid',
//// 	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_items_per_line'],
//// 	'transport'   => 'postMessage',
//// 	'choices'     => array(
//// 		'min'  => '1',
//// 		'max'  => '6',
//// 		'step' => '1',
//// 	),
//// ) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_items_per_line'] = '33.333%';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'radio-buttonset',
//	'settings'  => 'dp_front_page_grid_items_per_line',
//	'label'     => __( 'Item Width', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_items_per_line'],
//	'transport' => 'postMessage',
//	'choices'   => array(
//		'100%'   => __( '100%', 'my_textdomain' ),
//		'83.333%'   => __( '83.3%', 'my_textdomain' ),
//		'80%'   => __( '80%', 'my_textdomain' ),
//		'75%'   => __( '75%', 'my_textdomain' ),
//		'66.666%'   => __( '66.6%', 'my_textdomain' ),
//		'50%'   => __( '50%', 'my_textdomain' ),
//		'33.333%'   => __( '33.3%', 'my_textdomain' ),
//		'25%'   => __( '25%', 'my_textdomain' ),
//		'20%'   => __( '20%', 'my_textdomain' ),
//		'16.666%'   => __( '16.6%', 'my_textdomain' ),
//		'14.285%'   => __( '14.2%', 'my_textdomain' ),
//		'12.5%'   => __( '12.5%', 'my_textdomain' ),
//	)
//) );
//
//
//
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_padding'] = '5';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_padding',
//	'description' => esc_attr__( 'Item Padding', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_padding'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '15',
//		'step' => '1',
//	),
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_border_radius'] = '0';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_border_radius',
//	'description' => esc_attr__( 'Item Border Radius', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_border_radius'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '25',
//		'step' => '1',
//	),
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_dimensions'] = '1.777';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'radio-buttonset',
//	'settings'  => 'dp_front_page_grid_item_dimensions',
//	'label'     => __( 'Item Dimensions', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_dimensions'],
//	'transport' => 'postMessage',
//	'choices'   => array(
//		'9 / 16'   => __( '16:9', 'my_textdomain' ),
//		'3 / 4'  => __( '4:3', 'my_textdomain' ),
//		//'9 / 21' => __( '21:9', 'my_textdomain' ),
//	)
//) );
//
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'custom',
//	'settings'    => 'dp_front_page_grid_divider1',
//	'section'     => 'dp_front_page_grid',
//	'default'     => '<div class="dp_customizer-divider"></div>',
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_title_background_color'] = 'rgba(10,0,0,0.5)';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_title_background_color',
//	'label'       => esc_attr__( 'Title Background Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_title_background_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_title_font_color'] = '#FFF';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_title_font_color',
//	'label'       => esc_attr__( 'Title Font Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_title_font_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_meta_font_color'] = '#FFF';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_meta_font_color',
//	'label'       => esc_attr__( 'Meta Data Font Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_meta_font_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//
////$disruptpress_theme_defaults['dp_front_page_grid_item_title_background_height'] = '50';
////Kirki::add_field( 'disruptpress_theme', array(
////	'type'        => 'slider',
////	'settings'    => 'dp_front_page_grid_item_title_background_height',
////	'description' => esc_attr__( 'Item Background Height', 'my_textdomain' ),
////	'section'     => 'dp_front_page_grid',
////	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_title_background_height'],
////	'transport'   => 'postMessage',
////	'choices'     => array(
////		'min'  => '10',
////		'max'  => '150',
////		'step' => '5',
////	),
////) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_title_font_size'] = '22';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_title_font_size',
//	'description' => esc_attr__( 'Title Font Size', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_title_font_size'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '8',
//		'max'  => '72',
//		'step' => '1',
//	),
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_title_font_weight'] = '700';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_title_font_weight',
//	'description' => esc_attr__( 'Title Font Weight', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_title_font_weight'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '100',
//		'max'  => '900',
//		'step' => '100',
//	),
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_meta_font_size'] = '12';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_meta_font_size',
//	'description' => esc_attr__( 'Meta Data Font Size', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_meta_font_size'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '32',
//		'step' => '1',
//	),
//) );
//
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'custom',
//	'settings'    => 'dp_front_page_grid_divider2',
//	'section'     => 'dp_front_page_grid',
//	'default'     => '<div class="dp_customizer-divider"></div>',
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_toggle'] = false;
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'checkbox',
//	'settings'  => 'dp_front_page_grid_item_nth_toggle',
//	'label'     => __( 'Use Custom Options for first items', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_toggle'],
//	//'transport' => 'postMessage',
//) );
//
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_limit'] = '1';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'number',
//	'settings'    => 'dp_front_page_grid_item_nth_limit',
//	'label'       => esc_attr__( 'Apply Option To X Items', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_limit'],
//  //'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => 1,
//		'max'  => 40,
//		'step' => 1,
//	),
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_selector'] = '1';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'radio-buttonset',
//	'settings'  => 'dp_front_page_grid_item_nth_selector',
//	//'label'     => __( 'Item Dimensions', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_selector'],
//	//'transport' => 'postMessage',
//	'choices'   => array(
//		'1'   => __( 'Start at First', 'my_textdomain' ),
//		'2'  => __( 'Every X Amount', 'my_textdomain' ),
//	)
//) );
//
//// $disruptpress_theme_defaults['dp_front_page_grid_items_nth_per_line'] = '3';
//// Kirki::add_field( 'disruptpress_theme', array(
//// 	'type'        => 'slider',
//// 	'settings'    => 'dp_front_page_grid_items_nth_per_line',
//// 	'description' => esc_attr__( 'Items Per Line', 'my_textdomain' ),
//// 	'section'     => 'dp_front_page_grid',
//// 	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_items_nth_per_line'],
//// 	'transport'   => 'postMessage',
//// 	'choices'     => array(
//// 		'min'  => '1',
//// 		'max'  => '6',
//// 		'step' => '1',
//// 	),
//// ) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_items_nth_per_line'] = '50%';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'      => 'radio-buttonset',
//	'settings'  => 'dp_front_page_grid_items_nth_per_line',
//	'label'     => __( 'Item Width', 'my_textdomain' ),
//	'section'   => 'dp_front_page_grid',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_items_nth_per_line'],
//	'transport' => 'postMessage',
//	'choices'   => array(
//		'100%'   => __( '100%', 'my_textdomain' ),
//		'83.333%'   => __( '83.3%', 'my_textdomain' ),
//		'80%'   => __( '80%', 'my_textdomain' ),
//		'75%'   => __( '75%', 'my_textdomain' ),
//		'66.666%'   => __( '66.6%', 'my_textdomain' ),
//		'50%'   => __( '50%', 'my_textdomain' ),
//		'33.333%'   => __( '33.3%', 'my_textdomain' ),
//		'25%'   => __( '25%', 'my_textdomain' ),
//		'20%'   => __( '20%', 'my_textdomain' ),
//		'16.666%'   => __( '16.6%', 'my_textdomain' ),
//		'14.285%'   => __( '14.2%', 'my_textdomain' ),
//		'12.5%'   => __( '12.5%', 'my_textdomain' ),
//	)
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_background_color'] = 'rgba(10,0,0,0.5)';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_nth_title_background_color',
//	'label'       => esc_attr__( 'Title Background Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_background_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_color'] = '#FFF';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_nth_title_font_color',
//	'label'       => esc_attr__( 'Title Font Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_meta_font_color'] = '#FFF';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'color',
//	'settings'    => 'dp_front_page_grid_item_nth_meta_font_color',
//	'label'       => esc_attr__( 'Meta Data Font Color', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'transport'   => 'postMessage',
//	'default'   => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_meta_font_color'],
//	'sanitize_callback'     => '',
//	'alpha'       => true,
//) );
//
//
////$disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_background_height'] = '50';
////Kirki::add_field( 'disruptpress_theme', array(
////	'type'        => 'slider',
////	'settings'    => 'dp_front_page_grid_item_nth_title_background_height',
////	'description' => esc_attr__( 'Item Background Height', 'my_textdomain' ),
////	'section'     => 'dp_front_page_grid',
////	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_background_height'],
////	'transport'   => 'postMessage',
////	'choices'     => array(
////		'min'  => '10',
////		'max'  => '150',
////		'step' => '5',
////	),
////) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_size'] = '22';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_nth_title_font_size',
//	'description' => esc_attr__( 'Title Font Size', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_size'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '8',
//		'max'  => '72',
//		'step' => '1',
//	),
//) );
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_weight'] = '700';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_nth_title_font_weight',
//	'description' => esc_attr__( 'Title Font Weight', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_title_font_weight'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '100',
//		'max'  => '900',
//		'step' => '100',
//	),
//) );
//
//
//$disruptpress_theme_defaults['dp_front_page_grid_item_nth_meta_font_size'] = '12';
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'slider',
//	'settings'    => 'dp_front_page_grid_item_nth_meta_font_size',
//	'description' => esc_attr__( 'Meta Data Font Size', 'my_textdomain' ),
//	'section'     => 'dp_front_page_grid',
//	'default'     => $disruptpress_theme_defaults['dp_front_page_grid_item_nth_meta_font_size'],
//	'transport'   => 'postMessage',
//	'choices'     => array(
//		'min'  => '0',
//		'max'  => '32',
//		'step' => '1',
//	),
//) );
//
//Kirki::add_field( 'disruptpress_theme', array(
//	'type'        => 'custom',
//	'settings'    => 'dp_front_page_grid_divider3',
//	'section'     => 'dp_front_page_grid',
//	'default'     => '<div class="dp_customizer-divider"></div>',
//) );