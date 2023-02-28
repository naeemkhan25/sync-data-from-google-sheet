<?php
/**
 * Don't call the file directly.
 *
 * @package WRHORDERSHEET
 */

defined( 'ABSPATH' ) || exit;
/**
 * Enqueue all admin or frontend scripts
 *
 * @version 1.0.0
 */

if ( ! class_exists( 'Wrh_Order_Sheet_Scripts' ) ) {
	/**
	 * Enqueue all admin or frontend scripts
	 *
	 * @version 1.0.0
	 */
	class Wrh_Order_Sheet_Scripts {
		/**
		 * Wrh_Order_Sheet_Scripts constructor.
		 *
		 * @version 1.0.0
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue' ] );
			
		}
		/**
		 * Wrh_Order_Sheet_Scripts css and js
		 *
		 * @param Object $hook return screen ids.
		 *
		 * @return void
		 * @since 1.0.0
		 */
		public function admin_enqueue( $hook ) {
		    wp_enqueue_style( 'wrh_order_sheet_menu', WRHORDERSHEET_ASSETS . '/css/menu.css' );
		}
	}
	/**
	 * Kick out Wrh_Order_Sheet_Scripts constructor
	 *
	 * @version 1.0.0
	 */
	new Wrh_Order_Sheet_Scripts();
}