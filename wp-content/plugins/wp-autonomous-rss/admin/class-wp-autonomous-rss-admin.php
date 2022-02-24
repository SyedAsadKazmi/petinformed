<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://aedanobrien.com
 * @since      1.0.0
 *
 * @package    WP_Autonomous_RSS
 * @subpackage WP_Autonomous_RSS/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_Autonomous_RSS
 * @subpackage WP_Autonomous_RSS/admin
 * @author     Aedan O'Brien <aedan.obrien84@gmail.com>
 */
class WP_Autonomous_RSS_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		//$this->license();
		//$this->enqueue_styles();
		//$this->enqueue_scripts();
		$this->register_post_type();
		$this->add_meta_boxes();
		$this->scraper();
		$this->cron_job();
		$this->settings_page();


	}

	/**
	 * License setup
	 *
	 * @since    1.0.0
	 */
//	public function license() {
//
//		require plugin_dir_path( __FILE__ ) . 'updater/plugin-updater.php';
//
//	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Autonomous_RSS_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Autonomous_RSS_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'css/wp-autonomous-rss-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-jquery-ui', plugin_dir_url( __FILE__ ) . 'css/jquery-ui.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_Autonomous_RSS_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_Autonomous_RSS_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-autonomous-rss-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers custom post type wpa_rss
	 *
	 * @since    1.0.0
	 */
	public function register_post_type() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-autonomous-rss-post-type.php';

	}

	/**
	 * Add meta boxes
	 *
	 * @since    1.0.0
	 */
	public function add_meta_boxes() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-autonomous-rss-meta-boxes.php';

	}

	/**
	 * Registers cron jobs
	 *
	 * @since    1.0.0
	 */
	public function cron_job() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-autonomous-rss-cron-job.php';

	}

	/**
	 * RSS Scraper
	 *
	 * @since    1.0.0
	 */
	public function scraper() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-autonomous-rss-scraper.php';
		//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/simple_html_dom.php';

	}
	/**
	 * Settings page
	 *
	 * @since    1.0.0
	 */
	public function settings_page() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-autonomous-rss-settings-page.php';

	}

}
