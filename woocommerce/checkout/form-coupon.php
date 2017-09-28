<?php
/**
 * Checkout coupon form 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! wc_coupons_enabled() ) {
	return;
}

if ( ! WC()->cart->applied_coupons ) {
    $info_message = apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', BOOTY_TXT_DOMAIN ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', BOOTY_TXT_DOMAIN ) . '</a>' );
    wc_print_notice( $info_message, 'notice' );
}
?>

<form class="checkout_coupon shop-apply" method="post" style="display:none">

	<p class="form-row form-row-first">
		<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_html_e( 'Coupon code', BOOTY_TXT_DOMAIN ); ?>" id="coupon_code" value="" />
	</p>

	<p class="form-row form-row-last">
		<input type="submit" class="btn btn-slider" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', BOOTY_TXT_DOMAIN ); ?>" />
	</p>

	<div class="clear"></div>
</form>
