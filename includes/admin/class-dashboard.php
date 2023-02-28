<?php
/**
 * Wrh_Order_Dashboard Handler class
 */
class Wrh_Order_Sheet_Dashboard {

    /**
     * Plugin page handler
     *
     * @return void
     */
    public function plugin_page() {
        $template = __DIR__ . '/views/settings.php';
        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Handle the form
     *
     * @return void
     */
    public function create_sheet_form_handler() {
        if ( ! isset( $_POST['wrh_save_existing_sheet_id'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'wrh-save-existing-sheet-id' ) ) {
            wp_die( 'Are you cheating?' );
        }

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'Are you cheating?' );
        }
        $api_id = sanitize_text_field( $_POST['wrh_order_sheet_id'] );
       update_option('wrh_order_sheet_api_id',$api_id );
    }
     
}