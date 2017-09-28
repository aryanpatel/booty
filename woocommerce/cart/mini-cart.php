<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="widget_shopping_cart_content">
<div class="cart-drop">
	<input type="hidden" value="<?php echo WC()->cart->cart_contents_count; ?>" id="cart_number" />
	<div class="cart-holder">
		<strong class="main-title"><?php esc_html_e('shopping cart',BOOTY_TXT_DOMAIN)?></strong>
		<ul class="cart-list list-unstyled product_list_widget">
			<?php if ( ! WC()->cart->is_empty() ) : 
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(array(56,56)), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
						<li class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
							<?php if ( ! $_product->is_visible() ) : ?>
								<div class="image">
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) ?>
								</div>
							<?php else : ?>
								<div class="image">
									<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>"><?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail )?></a>
								</div>
							<?php endif; ?>
							<div class="description">
								<span class="product-name"><a href="#"><?php echo esc_html($product_name); ?></a></span> 
								<?php
									if ( $_product->get_rating_html() == '' ){
										echo '<ul class="rating list-inline">
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
												<li><i class="fa fa-star-o"></i></li>
											</ul>';
									}else{
										echo booty_get_rating_html( $_product,null );
									}
								?>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>
								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<div class="price-area"><span class="price">'. sprintf( '%s', $product_price ) .'</span><span class="quantity">&times; ' . esc_html($cart_item['quantity']) . '</span></div>', $cart_item, $cart_item_key ); ?>
							</div>
							<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								'<a href="%s" class="remove delete fa fa-times" title="%s" data-product_id="%s" data-product_sku="%s"></a>',
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								esc_html__( 'Remove this item', BOOTY_TXT_DOMAIN ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );
							?>
						</li>
						<?php
					}
				}
			?>
			<?php else : ?>
				<li class="empty"><?php esc_html_e( 'No products in the cart.', BOOTY_TXT_DOMAIN ); ?></li>
			<?php endif; ?>
		</ul>
		<?php if ( ! WC()->cart->is_empty() ) : ?>
			<div class="total-price-area">
				<span class="title-text text-uppercase"><?php esc_html_e( 'total', BOOTY_TXT_DOMAIN ); ?>:</span>
				<span class="price"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
			</div>
			<ul class="btn-list list-unstyled">
				<li><a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-default"><span><?php esc_html_e( 'Checkout', BOOTY_TXT_DOMAIN ); ?></span></a></li>
				<li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-default add"><span><?php esc_html_e( 'View Cart', BOOTY_TXT_DOMAIN ); ?></span></a></li>
			</ul>
		<?php endif; ?>
	</div>
</div>
</div>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
