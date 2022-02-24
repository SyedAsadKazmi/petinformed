<?php

class WP_Autonomous_RSS_Updater {

    public $version;
    public $plugin_name;
    public $plugin_file;
    public $update_url;
    public $item_id;
    public $parent_menu;

	public function __construct( $version, $plugin_name, $plugin_file, $update_url, $item_id, $parent_menu ) {

	    $this->version = $version;
	    $this->plugin_name = $plugin_name;
	    $this->plugin_file = $plugin_file;
	    $this->update_url = $update_url;
	    $this->item_id = $item_id;
	    $this->parent_menu = $parent_menu;

		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'license_page_init' ) );
			add_action( 'admin_menu', array( $this, 'license_menu_init' ) );
		}

		add_action( 'admin_init', array( $this, 'plugin_updater' ), 0 );
		add_action( 'admin_init', array( $this, 'deactivate_license' ) );
		add_action( 'admin_init', array( $this, 'activate_license' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice_license' ) );
		add_action( 'admin_notices', array( $this, 'license_error_message' ) );
	}

    function plugin_updater() {

	    if ( ! class_exists('EDD_SL_Plugin_Updater') )
	    {
		    include(dirname( __FILE__) . '/EDD_SL_Plugin_Updater.php' );
	    }

        // Retrieve license key from database
        $license_key = trim(get_option( $this->plugin_name . '_license_key') );

        // Setup the updater
        $edd_updater = new EDD_SL_Plugin_Updater( $this->update_url, $this->plugin_file, array(
                'version' => WP_AUTONOMOUS_RSS_VERSION,
                'license' => $license_key,
                'item_id' => $this->item_id,
                'author' => 'Aedan OBrien',
                'url' => home_url()
            )
        );

    }

    /**
     * Register licence settings page
     *
     * @since 1.0.0
     */
    function license_page_init() {

        register_setting($this->plugin_name . '_settings_page_license', $this->plugin_name . '_license_key', $this->plugin_name . '_license_status_update');
        register_setting($this->plugin_name . '_settings_page_license', $this->plugin_name . '_license_status');

    }

    function license_menu_init() {

        add_submenu_page($this->parent_menu . '', 'License', 'License', 'administrator', $this->plugin_name . '_license', array( $this, 'license_page' ) );

    }

    function license_page() {

        include( dirname(__FILE__) . '/settings-licence.php' );

    }

    /**
     * Admin notice if license key is missing
     *
     * @since 1.0.0
     */
    function admin_notice_license() {

        if (get_option($this->plugin_name . '_license_key') == '' OR get_option($this->plugin_name . '_license_status') != 'valid') {
            echo '<div class="notice notice-error">
                <p><b>'. WP_AUTONOMOUS_RSS_NAME_FANCY . ' Plugin:</b> License not active. Please <a href="' . $this->parent_menu . '&page=' . $this->plugin_name . '_license" target="_self">enter a valid license key</a> in order to use the plugin and receive updates.</p>
            </div>';
        }

    }



    /**
     * Update license status on license key change
     *
     * @since 1.0.0
     */
    function license_status_update( $new ) {

        $old = get_option($this->plugin_name . '_license_key');
        if ($old && $old != $new) {
            delete_option($this->plugin_name . '_license_status');
        }
        return $new;

    }

    /**
     * Activate license
     *
     * @since 1.0.0
     */
    function activate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST[$this->plugin_name . '_license_activate'])) {
            // run a quick security check
            if (!check_admin_referer($this->plugin_name . '_license_nonce', $this->plugin_name . '_license_nonce'))
                return; // get out if we didn't click the Activate button
            // retrieve the license from the database
            $license = sanitize_text_field($_POST[$this->plugin_name . '_license_key']);
            update_option($this->plugin_name . '_license_key', $license);
            //$license = trim( get_option( $this->plugin_name . '_license_key' ) );
            // data to send in our API request
            $api_params = array(
                'edd_action' => 'activate_license',
                'license' => $license,
                'item_id' => $this->item_id, // The ID of the item in EDD
                'url' => home_url()
            );
            // Call the custom API.
            $response = wp_remote_post($this->update_url, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));
            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
                $message = (is_wp_error($response) && !empty($response->get_error_message())) ? $response->get_error_message() : __('An error occurred, please try again.');
            } else {
                $license_data = json_decode(wp_remote_retrieve_body($response));
                if (false === $license_data->success) {
                    switch ($license_data->error) {
                        case 'expired' :
                            $message = sprintf(
                                __('Your license key expired on %s.'),
                                date_i18n(get_option('date_format'), strtotime($license_data->expires, current_time('timestamp')))
                            );
                            break;
                        case 'revoked' :
                            $message = __('Your license key has been disabled.');
                            break;
                        case 'missing' :
                            $message = __('Invalid license.');
                            break;
                        case 'invalid' :
                        case 'site_inactive' :
                            $message = __('Your license is not active for this URL.');
                            break;
                        case 'item_name_mismatch' :
                            $message = __('This appears to be an invalid license key for this plugin.');
                            break;
                        case 'no_activations_left':
                            $message = __('Your license key has reached its activation limit.');
                            break;
                        default :
                            $message = __('An error occurred, please try again.');
                            break;
                    }
                }
            }
            // Check if anything passed on a message constituting a failure
            if (!empty($message)) {
                $base_url = admin_url($this->parent_menu . '&page=' . $this->plugin_name . '_license');
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);
                wp_redirect($redirect);
                exit();
            }
            // $license_data->license will be either "valid" or "invalid"
            update_option($this->plugin_name . '_license_status', $license_data->license);
            wp_redirect(admin_url($this->parent_menu . '&page=' . $this->plugin_name . '_license'));
            exit();
        }

    }


    /**
     * Display license key error messages
     *
     * @since 1.0.0
     */
    function license_error_message() {

        if (isset($_GET['sl_activation']) && !empty($_GET['message'])) {
            switch ($_GET['sl_activation']) {
                case 'false':
                    $message = urldecode($_GET['message']);
                    ?>
                    <div class="error">
                        <p><?php echo $message; ?></p>
                    </div>
                    <?php
                    break;
                case 'true':
                default:
                    // Developers can put a custom success message here for when activation is successful if they way.
                    break;
            }
        }

    }

    /**
     * Deactivate license key
     * This will decrease the site count
     *
     * @since 1.0.0
     */
    function deactivate_license() {

        // listen for our activate button to be clicked
        if (isset($_POST[$this->plugin_name . '_license_deactivate'])) {

            // run a quick security check
            if (!check_admin_referer($this->plugin_name . '_license_nonce', $this->plugin_name . '_license_nonce'))
                return; // get out if we didn't click the Activate button

            // retrieve the license from the database
            $license = trim(get_option($this->plugin_name . '_license_key'));


            // data to send in our API request
            $api_params = array(
                'edd_action' => 'deactivate_license',
                'license' => $license,
                'item_id' => $this->item_id, // the name of our product in EDD
                'url' => home_url()
            );

            // Call the custom API.
            $response = wp_remote_post($this->update_url, array('timeout' => 15, 'sslverify' => false, 'body' => $api_params));

            // make sure the response came back okay
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {

                if (is_wp_error($response)) {
                    $message = $response->get_error_message();
                } else {
                    $message = __('An error occurred, please try again.');
                }

                $base_url = admin_url($this->parent_menu . '&page=' . $this->plugin_name . '_license');
                $redirect = add_query_arg(array('sl_activation' => 'false', 'message' => urlencode($message)), $base_url);

                wp_redirect($redirect);
                exit();
            }

            // decode the license data
            $license_data = json_decode(wp_remote_retrieve_body($response));

            // $license_data->license will be either "deactivated" or "failed"
            if ( $license_data->license == 'deactivated' ) {
                delete_option( $this->plugin_name . '_license_status' );
            }

            wp_redirect( admin_url( $this->parent_menu . '&page=' . $this->plugin_name . '_license') );
            exit();

        }

    }

}