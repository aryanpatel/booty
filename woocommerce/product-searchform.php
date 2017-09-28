<?php
/**
 * The template for displaying product search form 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<label class="screen-reader-text" for="woocommerce-product-search-field"><?php esc_html_e( 'Search for:', BOOTY_TXT_DOMAIN ); ?></label>
	<input type="search" id="woocommerce-product-search-field" class="search-field" placeholder="<?php echo esc_html_x( 'Search Products&hellip;', 'placeholder', BOOTY_TXT_DOMAIN ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', BOOTY_TXT_DOMAIN ); ?>" />
	<input type="submit" value="<?php echo esc_html_x( 'Search', 'submit button', BOOTY_TXT_DOMAIN ); ?>" />
	<input type="hidden" name="post_type" value="product" />
</form>
