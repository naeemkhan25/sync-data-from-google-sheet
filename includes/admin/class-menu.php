<?php
/**
 * Register WRH Order Sheet Menu
 * @return object
 * @version 1.0.0
 */
if ( ! defined('ABSPATH') ) {
    exit;
}

 if ( ! class_exists( 'WRH_Order_Sheet_Menu' ) ) {
    /**
     * wrh-order-sync-with-sheet register Menu class
     * 
     * @version 1.0.0
     */
    class WRH_Order_Sheet_Menu {
        /**
         * Calling Method 
         * 
         * @return void
         * @version 1.0.0
         */
        public function __construct() {
            add_action('admin_menu', [ $this,'register_menu' ], 11 );
        }
        /**
         * Register wrh-order-sync-with-sheet menu items
         * 
         * @return void
         * @version 1.0.0
         */
        public function register_menu() {
            add_menu_page( __( 'Google Sheet', 'wrh-order-sync-with-sheet' ),__( 'Google Sheet',' wrh-order-sync-with-sheet' ), 'manage_options','extra-product-sheet',[ $this,'dashboard_pages' ],WRHORDERSHEET_ASSETS.'/img/logo.svg', 40 );
            add_submenu_page( 'extra-product-sheet',  __( 'Settings', 'wrh-order-sync-with-sheet' ),__('Settings', 'wrh-order-sync-with-sheet'), 'manage_options','extra-product-sheet',[ $this, 'dashboard_pages'] );
        }
        public function dashboard_pages() {
            $Dashboard = new Wrh_Order_Sheet_Dashboard();
            $Dashboard->plugin_page();
        }
    }

 }