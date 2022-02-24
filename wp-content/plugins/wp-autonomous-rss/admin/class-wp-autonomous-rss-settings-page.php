<?php

/**
 * Register settings page
 *
 * @since 1.0.0
 */
function wp_autonomous_rss_settings_page_admin_init() {
	//register_setting( 'wp_autonomous_rss_settings_page_general', 'wp_autonomous_rss_youtube_api_key' );
}

function wp_autonomous_rss_settings_page_menu_init(){
	//add_submenu_page( 'edit.php?post_type=wpa_rss', 'Converter', 'Converter', 'administrator', 'wp_autonomous_rss_settings_general', 'wp_autonomous_rss_settings_page' );
}

if ( is_admin() ) {
	//add_action( 'admin_init', 'wp_autonomous_rss_settings_page_admin_init' );
	//add_action( 'admin_menu', 'wp_autonomous_rss_settings_page_menu_init' );
}

function wp_autonomous_rss_settings_page() {
	require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/class-wp-autonomous-rss-settings-page.php';
}

/**
 * Admin notice
 *
 * @since 1.0.0
 */
//function wp_autonomous_rss_admin_notice() {
//
//	echo '<div class="notice notice-error">
//		<p><b>WP Autonomous RSS Plugin:</b> Please <a href="edit.php?post_type=wpa_rss&page=wp_autonomous_rss_settings_general" target="_self">enter a valid YouTube API key</a> in order to use the plugin.</a></p>
//	</div>';
//}
//add_action( 'admin_notices', 'wp_autonomous_rss_admin_notice' );















