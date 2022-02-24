<?php

/**
 * Registers custom post type wpa_rss
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_register_post_type() {
	register_post_type( 'wpa_rss', array(
		'labels' => array(
			'menu_name'         => 'WPA RSS',
			'name'               => 'Campaigns',
			'singular_name'      => 'Campaign',
			'all_items'          => 'Campaigns',
			'add_new'            => 'Add New Campaign' ,
			'add_new_item'       => 'Add New Campaign',
			'edit_item'          => 'Edit Campaign',
			'new_item'           => 'New Campaign',
			'view_item'          => 'View Campaign',
			'search_items'       => 'Search Campaigns',
			'not_found'          => 'No Campaigns Found',
			'not_found_in_trash' => 'No Campaigns Found In Trash',
			'parent_item_colon'  => 'Parent Campaign',
		),
		'public'             => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'          => 'dashicons-update',
		'supports'           => array( 'title' ),
		'menu_position'      => 150,
		'taxonomies'         => array( 'category' ),
	) );
}
add_action( 'init', 'wp_autonomous_rss_register_post_type' );


/**
 * Remove category link from wp_autonomous_rss post type menu
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_remove_category_from_menu() {
	global $submenu;
	$post_type = 'wpa_rss';
	$tax_slug = 'category';

	if ( isset( $submenu['edit.php?post_type='.$post_type] ) ) {

		foreach ($submenu['edit.php?post_type='.$post_type] as $k => $sub) {

			if ( false !== strpos($sub[2],$tax_slug) ) {
				unset( $submenu['edit.php?post_type='.$post_type][$k] );
			}
		}
	}
}
add_action( 'admin_menu','wp_autonomous_rss_remove_category_from_menu' );

/**
 * Flush rewrite for custom post types on plugin activation
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_register_post_type_flush() {
	wp_autonomous_rss_register_post_type();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'wp_autonomous_rss_register_post_type_flush' );


/**
 * Add columns to wpa_rss
 *
 * @since 1.0.0
 */
add_filter( 'manage_wpa_rss_posts_columns', 'wp_autonomous_rss_edit_column_remove' );
function wp_autonomous_rss_edit_column_remove($columns) {
	unset( $columns['date'] );
	unset( $columns['wpfc_column_clear_cache'] );
	unset( $columns['gadwp_stats'] );
	$columns['rss_feeds'] = __( 'RSS Feeds', 'your_text_domain' );
	$columns['interval'] = __( 'Interval', 'your_text_domain' );
	$columns['post_created'] = __( 'Posts Created', 'your_text_domain' );
	$columns['last_run'] = __( 'Last Automatic Run', 'your_text_domain' );
	$columns['next_run'] = __( 'Next Run', 'your_text_domain' );
	//$columns['publisher'] = __( 'Publisher', 'your_text_domain' );

	return $columns;
}

/**
 * Functions for custom columns
 *
 * @since 1.0.0
 */
add_action( 'manage_wpa_rss_posts_custom_column' , 'wp_autonomous_rss_column_add', 10, 2 );
function wp_autonomous_rss_column_add( $column, $post_id ) {
	switch ( $column ) {

		case 'rss_feeds' :
			$meta = get_post_meta( $post_id );
			$feed_array = preg_split('/\n|\r/', $meta['wp_autonomous_rss_feed'][0], -1, PREG_SPLIT_NO_EMPTY);

			$rss_count = 0;
			foreach( $feed_array as $rss ) {
				echo $rss.'<br>';
				$rss_count++;

				if( $rss_count > 4 ) {
					break;
				}
			}
			break;

		case 'interval' :
			$meta = get_post_meta( $post_id );
			$number = $meta['wp_autonomous_rss_interval_number'][0];
			$unit = $meta['wp_autonomous_rss_interval_unit'][0];



			if( $meta['wp_autonomous_rss_interval_unit'][0] == '3600') {
				$unit = 'hours';
			} else {
				$unit = 'days';
			}

			if( $number == '1' ) {
				$unit = str_replace('s', '', $unit);
			}

			echo 'Every ' . $number . ' ' . $unit;
			break;

		case 'post_created' :
			$meta = get_post_meta( $post_id );

			$query = get_posts(array(
				'numberposts' => -1,
				'meta_key'   => 'wpa_rss_campaign_id',
				'meta_value' => $post_id
			));

			echo count( $query );
			break;

		case 'last_run' :
			$meta = get_post_meta( $post_id );

			if ( isset ( $meta['wp_autonomous_rss_stats_last_run'] ) ) {
				$last_run = wp_autonomous_rss_time_elapsed( '@' . $meta['wp_autonomous_rss_stats_last_run'][0] );
			} else {
				$last_run = 'Never';
			}

			echo $last_run;
			break;

		case 'next_run' :
			$meta = get_post_meta( $post_id );

			$status = get_post_status( $post_id );

			if( $status != 'publish' ) {
				echo '-';
			} else {

				$interval_number = $meta['wp_autonomous_rss_interval_number'][0];
				$interval_hours_days = $meta['wp_autonomous_rss_interval_unit'][0];

//				if( $interval_hours_days == 'days' ) {
//					$interval_time = $interval_number * 3600 * 24;
//				} else {
//					$interval_time = $interval_number * 3600;
//				}

				$interval_time = $interval_number * $interval_hours_days;

				$next_cron = wp_next_scheduled( 'wp_autonomous_rss_cron_10min_event' ) - time();

				if ( isset ( $meta['wp_autonomous_rss_stats_last_run'] ) ) {
					$last_run = $meta['wp_autonomous_rss_stats_last_run'][0];
					$time_difference = time() - $last_run;

					$time_left = $interval_time - $time_difference;

					$next_run = $next_cron + ( $interval_time - $time_difference );

					if( $time_left > 0 ) {
						echo wp_autonomous_rss_secondsToWords( $next_run );
					} else {
						echo wp_autonomous_rss_secondsToWords( $next_cron );
					}

				} else {
					echo wp_autonomous_rss_secondsToWords( $next_cron );
				}
			}

			break;

	}
}