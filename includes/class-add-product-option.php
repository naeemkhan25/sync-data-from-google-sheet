<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Ensure WP_React_Settings_Rest_Route class exists or not
 *
 * @version 1.0.0
 */
if ( ! class_exists( 'Add_Extra_Product_Option_Google_Sheet' ) ) {
	/**
	 * Register end points for get hoodsly hub data.
	 *
	 * @version 1.0.0
	 */
	class Add_Extra_Product_Option_Google_Sheet {
		/**
		 * Calling method
		 */
		public function __construct() {
            add_action('woocommerce_product_options_general_product_data', [ $this, 'woocommerce_product_custom_fields' ] );	
		}
        public function woocommerce_product_custom_fields() {
            echo '<div class="product_custom_field">';
            // Custom Product Text Field
                woocommerce_wp_text_input(
                    array(
                        'id' => '_custom_product_tuuma',
                        'placeholder' => 'Tuuma',
                        'label' => __('Tuuma', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
                //Custom Product Number Field
                woocommerce_wp_text_input(
                    array(
                        'id' => '_custom_product_brändi',
                        'placeholder' => 'Brändi',
                        'label' => __('Brändi', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_pulttijako',
                        'placeholder' => 'Pulttijako',
                        'label' => __('Pulttijako', 'woocommerce'),
                        'desc_tip' => 'true',
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_keskireikä',
                        'placeholder' => 'Keskireikä',
                        'label' => __('Keskireikä', 'woocommerce'),
                        'desc_tip' => 'true',
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_et',
                        'placeholder' => 'ET',
                        'label' => __('ET', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_leveys',
                        'placeholder' => 'Leveys',
                        'label' => __('Leveys', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_korkeus',
                        'placeholder' => 'Korkeus',
                        'label' => __('Korkeus', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
                woocommerce_wp_textarea_input(
                    array(
                        'id' => '_custom_product_malli',
                        'placeholder' => 'Malli',
                        'label' => __('Malli', 'woocommerce'),
                        'desc_tip' => 'true'
                    )
                );
              
            echo '</div>';
        }
    }
    new Add_Extra_Product_Option_Google_Sheet();
}