<?php

/**
 * @link              https://aedanobrien.com
 * @since             1.0.0
 * @package           WP_Autonomous_RSS
 *
 * @wordpress-plugin
 * Plugin Name:       WP Autonomous RSS
 * Plugin URI:        https://wpautonomous.com/
 * Description:       Automatically creates posts from RSS feeds.
 * Version:           1.2.3
 * Author:            Aedan O'Brien
 * Author URI:        https://aedanobrien.com
 * Text Domain:       wp-autonomous-rss
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

define( 'WP_AUTONOMOUS_RSS_VERSION', '1.2.3' );
define( 'WP_AUTONOMOUS_RSS_NAME', 'wp_autonomous_rss' );
define( 'WP_AUTONOMOUS_RSS_NAME_FANCY', 'WP Autonomous RSS' );
define( 'WP_AUTONOMOUS_RSS_SLUG', 'wp-autonomous-rss' );
define( 'WP_AUTONOMOUS_RSS_PLUGIN_FILE', __FILE__ );
define( 'WP_AUTONOMOUS_RSS_UPDATE_URL', 'http://www.disruptpress.com' );
define( 'WP_AUTONOMOUS_RSS_ITEM_ID', '178' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-autonomous-rss.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_autonomous_rss() {

	$plugin = new WP_Autonomous_RSS();
	$plugin->run();

}
run_wp_autonomous_rss();

function wp_autonomous_rss_updater() {

	require plugin_dir_path( __FILE__ ) . 'updater/plugin-updater.php';

	$parent_menu = 'edit.php?post_type=wpa_rss';

	$updater = new WP_Autonomous_RSS_Updater(
		WP_AUTONOMOUS_RSS_VERSION,
		WP_AUTONOMOUS_RSS_NAME,
		WP_AUTONOMOUS_RSS_PLUGIN_FILE,
		WP_AUTONOMOUS_RSS_UPDATE_URL,
		WP_AUTONOMOUS_RSS_ITEM_ID,
		$parent_menu
	);
}
wp_autonomous_rss_updater();