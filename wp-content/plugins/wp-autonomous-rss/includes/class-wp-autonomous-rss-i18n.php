<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://aedanobrien.com
 * @since      1.0.0
 *
 * @package    WP_Autonomous_RSS
 * @subpackage WP_Autonomous_RSS/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    WP_Autonomous_RSS
 * @subpackage WP_Autonomous_RSS/includes
 * @author     Aedan O'Brien <aedan.obrien84@gmail.com>
 */
class WP_Autonomous_RSS_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wp-autonomous-rss',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
