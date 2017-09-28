<?php
/**
 * Proceed to checkout button 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<a href="<?php echo esc_url( wc_get_checkout_url() ) ;?>" class="btn btn-slider proceed">
	<?php echo esc_html__( 'Proceed to Checkout', BOOTY_TXT_DOMAIN ); ?>
</a>
