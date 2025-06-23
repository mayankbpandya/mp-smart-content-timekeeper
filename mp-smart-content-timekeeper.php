<?php
/**
 * Plugin Name: MP Smart Content Timekeeper
 * Description: Displays reading time with progress bar and reading goals
 * Version: 1.0.0
 * Author: Mayank Pandya
 * Requires at least: 5.8
 * License: GPL-2.0+
 * Requires PHP: 7.4
 * Text Domain: mp-smart-content-timekeeper
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

// Define plugin constants
defined( 'MP_SCT_VERSION' ) || define( 'MP_SCT_VERSION', '1.0.0' );
defined( 'MP_SCT_PATH' ) || define( 'MP_SCT_PATH', plugin_dir_path( __FILE__ ) );
defined( 'MP_SCT_URL' ) || define( 'MP_SCT_URL', plugin_dir_url( __FILE__ ) );

// Load main class
if ( ! class_exists( 'MP_SCT_Timekeeper' ) ) {
    require_once MP_SCT_PATH . 'includes/mp-sct-timekeeper.php';
}

// Initialize plugin
function mp_sct_initialize() {
    return MP_SCT_Timekeeper::mp_sct_get_instance();
}
add_action( 'plugins_loaded', 'mp_sct_initialize' );