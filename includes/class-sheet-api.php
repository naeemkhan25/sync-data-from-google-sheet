<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Ensure WP_React_Settings_Rest_Route class exists or not
 *
 * @version 1.0.0
 */
if ( ! class_exists( 'WRH_Order_Google_Sheet_API' ) ) {
	/**
	 * Register end points for get hoodsly hub data.
	 *
	 * @version 1.0.0
	 */
	class WRH_Order_Google_Sheet_API {
		/**
		 * Calling method
		 */
		public function __construct() {
			add_action( 'wp', array( $this, 'ptho_setup_schedule' ) );
		    add_action( 'ptho_daily_event', array( $this, 'fatch_api_data' ) );
            // add_action('init', array($this, 'fatch_api_data'));
		}
        public function ptho_setup_schedule() {
            if ( ! wp_next_scheduled( 'ptho_daily_event' ) ) {
                wp_schedule_event( time(), 'daily', 'ptho_daily_event' );
            }
        }
    
        public function fatch_api_data() {
            $get_optiondata = get_option( 'wrh_order_sheet_api_id' );
            if(isset($get_optiondata) && !empty($get_optiondata)){
                $url           = "https://script.google.com/macros/s/$get_optiondata/exec";
                $args       = array(
                    'headers' => array(
                        'Accept'       => 'application/json',
                        'Content-Type' => 'application/json',
                    ),
                    'timeout' => 120,
                );
                $remotedata = wp_remote_get( $url, $args );
                if ( ! is_wp_error( $remotedata ) ) {
                    delete_transient( 'extra_product_google_sheets' );
                    set_transient( 'extra_product_google_sheets', $remotedata['body'] );
                    $this->insert_value_in_product_option();
                    return true;
                } else {
                    return;
                }
            }
        }

        public function insert_value_in_product_option() {
            $data = get_transient('extra_product_google_sheets');
            $data2 = json_decode($data, true);
            if (is_array( $data2 )&& !empty( $data2 ) ) {
                $i = 0;
                if (array_key_exists('row',$data2 )) {
                    foreach ($data2['row'] as $key => $value) {
                        if ($i != 0 ) {
                            if ($value[6] == 1) {
                                $this->insert_tirs_value($value);
                            } else {
                                $this->insert_rims_value($value);
                            }
                        }
                        $i++;
                    }
                }
            }
        }

        public function insert_rims_value($value) {
            $product_id = $this->get_productID_by_sku($value[0]);
            update_post_meta($product_id, '_custom_product_tuuma', esc_attr($value[4]));
            update_post_meta($product_id, '_custom_product_brändi', esc_attr($value[5]));
            update_post_meta($product_id, '_custom_product_pulttijako', esc_attr($value[2]));
            update_post_meta($product_id, '_custom_product_keskireikä', esc_attr($value[3]));
            update_post_meta($product_id, '_custom_product_et', esc_attr($value[1]));
        }
        public function insert_tirs_value($value) {
            $product_id = $this->get_productID_by_sku($value[0]);
            update_post_meta($product_id, '_custom_product_tuuma', esc_attr($value[4]));
            update_post_meta($product_id, '_custom_product_brändi', esc_attr($value[5]));
            update_post_meta($product_id, '_custom_product_leveys', esc_attr($value[2]));
            update_post_meta($product_id, '_custom_product_korkeus', esc_attr($value[3]));
            update_post_meta($product_id, '_custom_product_malli', esc_attr($value[1]));
        }

        public function get_productID_by_sku( $sku ) {
            global $wpdb;
            $table_name = $wpdb->prefix. 'postmeta';
            $product_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $table_name WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $sku ) );
            if ($product_id) {
                return $product_id;
            }
            return null;
        }
    }
    new WRH_Order_Google_Sheet_API();
}