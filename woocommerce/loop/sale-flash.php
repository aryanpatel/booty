<?php
/**
 * Product loop sale flash 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', BOOTY_TXT_DOMAIN ) . '</span>', $post, $product ); ?>

<?php endif; ?>
