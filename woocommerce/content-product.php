<?php
/**
 * The template for displaying product content within loops
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 === ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 === $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 === $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>
<article class="new-product" data-delay="200" data-animate="fadeInUp">
    <div class="product-img">
        <?php the_post_thumbnail('booty_image_shop_carousel'); ?>
        <div class="product-over">
            <div class="frame">
                <?php 
                    printf('<div class="box" title="Quick view"><a onclick="" href="#" class="yith-wcqv-button btn btn-f-default" data-product_id="%d" title="%s">'.esc_html__( 'QUICK VIEW', BOOTY_TXT_DOMAIN).'</a></div>', $product->id, esc_html__('Quick View', BOOTY_TXT_DOMAIN), esc_html__('Quick View', BOOTY_TXT_DOMAIN));
                ?>
            </div>
        </div>
    </div>
    <span class="title">
    <?php
    $terms = get_the_terms( get_the_ID(), 'product_cat' );
	if(is_array($terms)){
		foreach ($terms as $term) {
			echo $term->name;
		}
    }
    ?></span>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
    if ( $product->get_rating_html() == '' ){
        echo '<ul class="rattings-nav list-inline">
                <li class="add"><i class="fa fa-star"></i></li>
                <li class="add"><i class="fa fa-star"></i></li>
                <li class="add"><i class="fa fa-star"></i></li>
                <li class="add"><i class="fa fa-star"></i></li>
                <li class="add"><i class="fa fa-star"></i></li>
            </ul>';
    }else{
        echo '<div class="rattings-nav">'.$product->get_rating_html().'</div>';
    }
    ?>
    <div class="btn-cart"><?php do_action( 'woocommerce_after_shop_loop_item' );?></div>
    <p class="price"><?php echo $product->get_price_html(); ?></p>
</article>
