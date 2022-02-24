<?php
/**
 * Originally created by The Beaver Builder Team
 * http://www.wpbeaverbuilder.com/?utm_source=external&utm_medium=customizer-export&utm_campaign=plugins-page
 */
define( 'CEI_VERSION', '0.6' );
define( 'CEI_PLUGIN_DIR', get_template_directory() . '/customizer-export-import/' );
define( 'CEI_PLUGIN_URL', get_template_directory_uri() . '/customizer-export-import/' );

/* Classes */
require_once CEI_PLUGIN_DIR . 'classes/class-cei-core.php';

/* Actions */
add_action( 'plugins_loaded', 'CEI_Core::load_plugin_textdomain' );
add_action( 'customize_controls_print_scripts', 'CEI_Core::controls_print_scripts' );
add_action( 'customize_controls_enqueue_scripts', 'CEI_Core::controls_enqueue_scripts' );
add_action( 'customize_register', 'CEI_Core::init', 999999 );
add_action( 'customize_register', 'CEI_Core::register' );