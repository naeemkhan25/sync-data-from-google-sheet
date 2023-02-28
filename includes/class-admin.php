<?php
/**
 * The admin class
 */
class Wrh_Order_Sheet_Admin {

    /**
     * Initialize the class
     */
    function __construct() {
        $this->dispatch_actions();
        new WRH_Order_Sheet_Menu();
    }
    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions() {
        $dashboard = new Wrh_Order_Sheet_Dashboard();
        add_action( 'admin_init', [ $dashboard, 'create_sheet_form_handler' ] );
    }
} 
new Wrh_Order_Sheet_Admin();