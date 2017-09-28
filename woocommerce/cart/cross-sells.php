<?php
/**
 * Cross-sells
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( 0 === sizeof( $crosssells ) ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<div class="booty-cross-sells related-shop">

		<h2><?php esc_html_e( 'You may be interested in&hellip;', BOOTY_TXT_DOMAIN ) ?></h2>

		<?php woocommerce_product_loop_start(); ?>
			<div class="row">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<li class="col-sm-3 col-xs-12 fadeInUp animated" data-animate="fadeInUp" data-delay="300">
				<?php wc_get_template_part( 'content', 'product' ); ?>
				</li>
			<?php endwhile; // end of the loop. ?>
			</div>
		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_query();
