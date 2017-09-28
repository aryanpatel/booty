<?php
/**
 * Cart errors page
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<p><?php esc_html_e( 'There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', BOOTY_TXT_DOMAIN ) ?></p>

<?php do_action( 'woocommerce_cart_has_errors' ); ?>

<p><a class="button wc-backward" href="<?php echo esc_url( wc_get_page_permalink( 'cart' ) ); ?>"><?php esc_html_e( 'Return To Cart', BOOTY_TXT_DOMAIN ) ?></a></p>
