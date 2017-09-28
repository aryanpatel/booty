<?php
/**
 * Displayed when no products are found matching the current query 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<p class="woocommerce-info"><?php esc_html_e( 'No products were found matching your selection.', BOOTY_TXT_DOMAIN ); ?></p>
