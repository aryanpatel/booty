<?php
/**
 * Result Count 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;

if ( ! woocommerce_products_will_display() )
	return;
?>
<p class="woocommerce-result-count">
	<?php
	$paged    = max( 1, $wp_query->get( 'paged' ) );
	$per_page = $wp_query->get( 'posts_per_page' );
	$total    = $wp_query->found_posts;
	$first    = ( $per_page * $paged ) - $per_page + 1;
	$last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

	if ( 1 === $total ) {
		esc_html_e( 'Showing the single result', BOOTY_TXT_DOMAIN );
	} elseif ( $total <= $per_page || -1 === $per_page ) {
		printf( __( 'Showing all <span>%d</span> results', BOOTY_TXT_DOMAIN ), $total );
	} else {
		printf( _x( 'Showing <span>%1$d&ndash;%2$d</span> of <span>%3$d</span> results', '%1$d = first, %2$d = last, %3$d = total', BOOTY_TXT_DOMAIN ), $first, $last, $total );
	}
	?>
</p>
