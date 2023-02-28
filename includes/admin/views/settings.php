<div class="wrap wrh_order_sheet_table">
    <h1 class="wp-heading-inline"><img class="wrh_plugin_icons"src="<?php echo esc_url(WRHORDERSHEET_ASSETS.'/img/logo.svg'); ?>" /><?php _e( 'Google Sheet Settings', 'wrh-order-sync-with-sheet' ); ?></h1>
    <?php
    $wrh_sheet_id = get_option('wrh_order_sheet_api_id',"" );
?>
        <form action="" method="post">
            <table class="form-table generate_token_tab" >
            <tbody>
                <tbody> 
                    <tr>
                        <th scope="row">
                            <label for="wrh_order_sheet_id"><?php _e( 'Google Sheet Deployment ID', 'wrh-order-sync-with-sheet' ); ?></label>
                        </th>
                        <td>
                            <input type="text" name="wrh_order_sheet_id" id="wrh_order_sheet_id" class="regular-text" value="<?php echo esc_attr( $wrh_sheet_id )?>" placeholder="Please Enter Google Sheet Deployment ID">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php wp_nonce_field( 'wrh-save-existing-sheet-id' ); ?>
            <?php submit_button( __( 'Save Settings', 'wrh-order-sync-with-sheet' ), 'primary', 'wrh_save_existing_sheet_id' ); ?>
        </form>
</div>