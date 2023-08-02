<?php
/**
 * Template for order history license keys table.
 *
 * Version: 1.0
 * @package fs-license-manager
 */

defined( 'ABSPATH' ) or die();

$download = '';
if ( get_option( 'fslm_download_links', 'on' ) == 'on' ) {
    $download = '<div class="fslm-download-keys" style="margin-bottom: 10px">
                            <a class="button" href="?fslm-order-id=' . $order_id . '">' . __( 'Download as a CSV file',
            'fslm' ) . '</a>
                            <a class="button" href="?fslm-order-id-txt=' . $order_id . '">' . __( 'Download as a TXT file',
            'fslm' ) . '</a>
                        </div>';
}

$val = "<h4>" . ( count( $values ) == 1 ? get_option( 'fslm_meta_key_name',
        'License Key' ) : get_option( 'fslm_meta_key_name_plural', 'License Key' ) ) . '</h4>
                        ' . $download . "
                        <table class=\"shop_table order_details fslm-license-keys-table\" style=\"width: 100%;\">
                            <thead>
                                <tr>
                                    <th style=\"text-align:left;width: 20%;\"><strong>" . __( 'Product', 'fslm' ) . "</strong></th>
                                    <th style=\"text-align:left;width: 80%;\"><strong>" . ( count( $values ) == 1 ? get_option( 'fslm_meta_key_name',
        'License Key' ) : get_option( 'fslm_meta_key_name_plural', 'License Key' ) ) . '</strong></th>
                                </tr>
                            </thead>
                        <tbody>';

foreach ( $values as $value ) {
    if ( $value['visible'] == 'Yes' ) {
        $visible_key_found = true;

        $display = get_post_meta( (int) $value['product_id'], 'fslm_display', true );
        if ( $display == "" ) {
            $display = get_option( 'fslm_display', '2' );
        }

        $license_key = $value['license_key'];
        $license_key = $this->encrypt_decrypt( 'decrypt', $license_key, ENCRYPTION_KEY, ENCRYPTION_VI );

        $license_key = br2newLine( $license_key );
        $license_key = preg_replace( "/\\\\\"|\\\\'/", '"', $license_key );
        $license_key = $this->newLine2br( $license_key );

        $meta = "";

        if ( $display != '1' ) {
            $meta = $license_key . '<br>';
        }

        $image_license_key = '';

        if ( $display != '0' ) {
            $image_license_key = $this->get_image_name( $value['license_id'] );

            if ( $image_license_key != '' ) {
                $upload_directory  = wp_upload_dir();
                $image_license_key = '<img  style="width: auto" class="fslm_ilksrc" src="' . $upload_directory['baseurl'] . '/fslm_keys/' . $image_license_key . '">';
            }
        }

        if ( $value['max_instance_number'] > 0 ) {
            $meta .= ' <strong>' . __( 'Can be used',
                    'fslm' ) . '</strong> ' . $value['max_instance_number'] . ' ' . __( 'time(s)',
                    'fslm' ) . '<br>';
        }

        if ( ( $value['max_instance_number'] == 0 ) && isset( $value['uses'] ) && $value['uses'] > 1 ) {
            $meta .= ' <strong>' . __( 'Can be used',
                    'fslm' ) . '</strong> ' . $value['uses'] . ' ' . __( 'times', 'fslm' ) . '<br>';
        }

        if ( ( $value['expiration_date'] != '0000-00-00' ) && ( $value['expiration_date'] != '' ) ) {
            $meta .= ' ' . '<strong>' . __( 'Expires ',
                    'fslm' ) . '</strong>' . $this->fslm_format_date( $value['expiration_date'] );
        }

        $product_name = get_the_title( $value['product_id'] );

        if ( $value['variation_id'] != 0 ) {
            $variation = wc_get_product( $value['variation_id'] );
            if ( $variation ) {
                $product_name .= ' - ' . implode( ' ', $variation->get_variation_attributes() );
            }
        }


        $redeem = "";

        if ( ( get_option( 'fslm_redeem_btn',
                    '' ) == 'on' ) && ( $this->get_encrypted_license_key_status( $value['license_key'] ) != "redeemed" ) ) {
            $redeem_prams = $value['license_id'] != "0" ? $value['license_id'] : $value['item_id'];
            $redeem_type  = $value['license_id'] != "0" ? "id" : "key";

            $redeem = '<br><form method="post">
                                            <input type="hidden" name="fslm_redeem_type" value="' . $redeem_type . '">
                                            <input type="hidden" name="fslm_redeem_key" value="' . $redeem_prams . '">
                                            <input type="hidden" name="fslm_order_id" value="' . $order_id . '">
                                            <button type="submit">' . __( "Set as redeemed", "fslm" ) . '</button>
                                       </form>';
        }


    }
}

$val .= "</tbody></table>";