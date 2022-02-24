<?php

/**
 * WP Cron add 10 minute schedule interval
 *
 * @since 1.0.0
 *
 * @param array $schedules WordPress cron schedules
 * @return array
 */
function wp_autonomous_rss_cron_schedule_every_10_minutes( $schedules ) {

	$schedules ['every_10_minutes'] = array (
		'interval' => 600,
		'display' => __ ( 'Every 10 Minutes' )
	);
	return $schedules;
}
add_filter ( 'cron_schedules', 'wp_autonomous_rss_cron_schedule_every_10_minutes' );

/**
 * Register wp cron job on plugin activation
 */
register_activation_hook( WP_AUTONOMOUS_RSS_PLUGIN_FILE, 'wp_autonomous_rss_cron_activation' );

function wp_autonomous_rss_cron_activation() {
	if ( ! wp_next_scheduled ( 'wp_autonomous_rss_cron_10min_event' ) ) {
		wp_schedule_event( time(), 'every_10_minutes', 'wp_autonomous_rss_cron_10min_event' );
	}
}
add_action( 'wp_autonomous_rss_cron_10min_event', 'wp_autonomous_rss_cron_action' );


/**
 * Action function for RSS cron
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_cron_action() {

	$args = array(
		'numberposts' => -1,
		'posts_per_page'=> -1,
		'post_type'   => 'wpa_rss',
		'post_status' => 'publish'
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {

		while ( $query->have_posts() ) {
			$query->the_post();
			$campaign_id = get_the_ID();



			$meta = get_post_meta( $campaign_id );

			$interval_number = $meta['wp_autonomous_rss_interval_number'][0];
			$interval_hours_days = $meta['wp_autonomous_rss_interval_unit'][0];

//			if( $interval_hours_days == 'days' ) {
//				$interval_time = $interval_number * 3600 * 24;
//			} else {
//				$interval_time = $interval_number * 3600;
//			}

			$interval_time = $interval_number * $interval_hours_days;

			if ( isset ( $meta['wp_autonomous_rss_stats_last_run'] ) ) {
				$last_run = $meta['wp_autonomous_rss_stats_last_run'][0];
				$time_difference = time() - $last_run;
				$missed = intval( $time_difference / $interval_time );
			} else {
				$missed = 1;
			}

			//wpa_send_mail('function: wp_autonomous_rss_cron_action(); Campaign ID: '.$campaign_id.' Missed: '.$missed.'');

			if( $missed > 0 ) {
			//if( true ) {
				wp_autonomous_rss_add_article_trigger( $campaign_id, $missed, true );
			}

		}
	}
}
add_shortcode( 'wp_autonomous_rss_cron_action', 'wp_autonomous_rss_cron_action' );

function wp_autonomous_rss_add_article_trigger( $campaign_id, $missed = 1, $is_cron = false ) {

	if( isset( $_POST['campaign_id'] ) ) {
		$campaign_id = intval( $_POST['campaign_id'] );

		$status = get_post_status( $campaign_id );

		if( $status != 'publish' ) {
			echo 'Error: Campaign has not yet been published. Please publish the campaign and then try again.';
			wp_die(); // this is required to terminate immediately and return a proper response
		}
	}



	// Get all feed URLs (not actual article links). If one or rotate, just get 1.
	$meta = get_post_meta( $campaign_id );
	$posts_per_interval = $meta['wp_autonomous_rss_posts_per_interval'][0];
	$feed_rotate_queue = $meta['wp_autonomous_rss_feed_rotate_queue'][0];
	$feed_rotate = $meta['wp_autonomous_rss_rotate'][0];
	$feed_array = preg_split('/\n|\r/', $meta['wp_autonomous_rss_feed'][0], -1, PREG_SPLIT_NO_EMPTY);

	if( $feed_rotate == 'on' ) {

		if( ! isset ( $meta['wp_autonomous_rss_feed_rotate_queue'] ) ) {
			update_post_meta( $campaign_id, 'wp_autonomous_rss_feed_rotate_queue', '0' );
			$feed_rotate_queue = '0';
		}

		if( $feed_rotate_queue > (count( $feed_array ) - 1) ) {
			update_post_meta( $campaign_id, 'wp_autonomous_rss_feed_rotate_queue', '0' );
			$feed_rotate_queue = '0';
		}

		$feeds[] = $feed_array[$feed_rotate_queue];

		$new_queue = $feed_rotate_queue + 1;
		update_post_meta( $campaign_id, 'wp_autonomous_rss_feed_rotate_queue', $new_queue );

	} else {

		$feeds = $feed_array;

	}

	//wpa_send_mail('function: wp_autonomous_rss_add_article_trigger(); Campaign ID: '.$campaign_id.' feeds: '.print_r($feeds, true).'');

	// Set max 10 loops per feed.
	$loop = $posts_per_interval * $missed;
	if( $loop >= 10 ){
		$loop = 10;
	}

	$output = '';

	foreach( $feeds as $feed ) {

		// RSS array includes
		$feedContent = wp_autonomous_rss_getFeed( $feed );

		if( $feedContent == false ) {

			$output .= 'RSS feed error: Please check if the RSS feed link is correct. Link: '. $feed;
			//continue;

		} else {

			for ( $i = 0; $i < $loop; $i++ ) {
				$output .= wp_autonomous_rss_add_article( $campaign_id, $feedContent, $is_cron );

				if( !isset( $_POST['campaign_id'] ) ) {
					update_post_meta( $campaign_id, 'wp_autonomous_rss_stats_last_run', time() );
				}
			}

		}


		$rss_array = null;

	}

	$feeds = null;

	if( isset( $_POST['campaign_id'] ) ) {
		//echo $output;
		echo $output;
		wp_die(); // this is required to terminate immediately and return a proper response
	} else {
		//echo $output;
	}

}
add_action( 'wp_ajax_wp_autonomous_rss_add_article_trigger', 'wp_autonomous_rss_add_article_trigger' );

/**
 * Unregister wp cron job on plugin deactivation
 */
register_deactivation_hook( WP_AUTONOMOUS_RSS_PLUGIN_FILE, 'wp_autonomous_rss_cron_deactivation' );

function wp_autonomous_rss_cron_deactivation() {
	wp_clear_scheduled_hook( 'wp_autonomous_rss_cron_10min_event' );
}
