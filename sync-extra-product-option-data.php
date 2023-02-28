<?php
/**
 * Plugin Name: Sync Extra product option data
 * Description: Sync Extra product option data
 * Plugin URI:  
 * Version:     1.0.0
 * Author:      Pilar
 * Author URI:  
 * Text Domain: wrh-order-sync-with-sheet
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// define constants.
if ( ! defined( 'WRHORDERSHEET_VERSION' ) ) {
	define( 'WRHORDERSHEET_VERSION', '1.0.0' );
	define( 'WRHORDERSHEET_PATH', plugin_dir_path( __FILE__ ) );
	define( 'WRHORDERSHEET_INCLUDES', WRHORDERSHEET_PATH . 'includes' );
	define( 'WRHORDERSHEET_URL', plugin_dir_url( __FILE__ ) );
	define( 'WRHORDERSHEET_ASSETS', WRHORDERSHEET_URL . '/assets');
	define( 'WRHORDERSHEET_FILE', __FILE__ );
}
register_activation_hook( WRHORDERSHEET_FILE, 'wrh_order_sheet_activate' );

/**
 * Insert plugin default inforamtion in database
 * 
 * @return void
 * @version 1.0.0
 */
function wrh_order_sheet_activate() {
	wrh_order_sheet_default_insert_info();
}
/**
 * Update plugin default data
 * 
 * @return void
 * @version 1.0.0
 */
 function wrh_order_sheet_default_insert_info() {
	$version         = get_option( 'wrh_order_sheet_version', '0' );
	$install_time    = get_option( 'wrh_order_sheet_install_time', '' );
	if ( empty( $version ) ) {
		update_option( 'wrh_order_sheet_version', WRHORDERSHEET_VERSION );
	}
	if ( ! empty( $install_time ) ) {
		$date_format = get_option( 'date_format' );
		$time_format = get_option( 'time_format' );
		update_option( 'wrh_order_sheet_install_time', date( $date_format . ' ' . $time_format ) );
	}
	update_option( 'wrh_order_sheet_active', 1 );
	flush_rewrite_rules();
}

function wrh_order_sync_with_google_sheet() {

	// Load plugin file
	require_once( __DIR__ . '/includes/plugin.php' );

	// Run the plugin
	\WRH_ORDER_SHEET\Plugin::instance();

}
add_action( 'plugins_loaded', 'wrh_order_sync_with_google_sheet' );