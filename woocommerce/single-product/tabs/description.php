<?php
/**
 * Description tab
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', esc_html__( 'Product Description', BOOTY_TXT_DOMAIN ) ) );

?>
<?php the_content(); ?>
