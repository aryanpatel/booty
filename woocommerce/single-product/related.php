<?php
/**
 * Related Products
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) === 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products related-shop">

		<h2><?php esc_html_e( 'Related Products', BOOTY_TXT_DOMAIN ); ?></h2>

			<div class="row">
				<?php woocommerce_product_loop_start(); ?>
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<li class="col-sm-3 col-xs-12 fadeInUp animated" data-animate="fadeInUp" data-delay="300">
						<?php wc_get_template_part( 'content', 'product' ); ?>
					</li>
				<?php endwhile; // end of the loop. ?>
				<?php woocommerce_product_loop_end(); ?>
			</div>

	</div>

<?php endif;

wp_reset_postdata();
