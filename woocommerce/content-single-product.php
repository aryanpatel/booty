<?php
/**
 * The template for displaying product content in the single-product.php template
 * 
 */
global $product;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row shop-description">
		<div class="col-sm-6 col-xs-12">
		<?php
            $attachment_ids = $product->get_gallery_attachment_ids();
            if( count($attachment_ids) > 0 ){
        ?>
			<!-- beans-stepslider2 -->
			<div class="beans-stepslider2 description gallery-js-ready">
				<div class="beans-mask" >
					<div class="beans-slideset">
						<?php
						$id_thumb = get_post_thumbnail_id( get_the_ID() );
						if ( $id_thumb != '' ){
							?>
							<div class="beans-slide"><img class="img-responsive" alt="image description" src="<?php echo wp_get_attachment_image_src( $id_thumb , 'booty_imag_product_slide_full')[0]; ?>" ></div>
							<?php
						}
						foreach( $attachment_ids as $attachment_id ) {
							$image_link_full = wp_get_attachment_image_src( $attachment_id , 'booty_imag_product_slide_full');
                        ?>
						<!-- beans-slide -->
						<div class="beans-slide"><img class="img-responsive" alt="image description" src="<?php echo $image_link_full[0]; ?>" ></div>
						<?php } ?>

					</div>
				</div>
				<div class="beans-pagination">
					<ul class="list-inline">
						<?php
						if ( $id_thumb != '' ){
							?>
							<li><a href="#"><img class="img-responsive" alt="image description" src="<?php echo wp_get_attachment_image_src( $id_thumb , 'full')[0]; ?>" ></a></li>
							<?php
						}
						foreach( $attachment_ids as $attachment_id ) {
							$image_link = wp_get_attachment_image_src( $attachment_id , 'full');
                        ?>
						<li><a href="#"><img class="img-responsive" alt="image description" src="<?php echo $image_link[0]; ?>" ></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php } else {
				the_post_thumbnail('full');
			}
				?>
		</div>
		<div class="col-sm-6 col-xs-12 description-block">
			<header class="description-header">
				<div class="holder">
					<h2><?php the_title(); ?></h2>
					<div class="block">
						<?php echo woocommerce_template_single_rating($product->id); ?>
					</div>
					<span class="in-stock">
						<?php if ( ! $product->is_in_stock() ) {
						    echo esc_html__('Out Stock', BOOTY_TXT_DOMAIN);
						}else{
							echo esc_html__('In Stock', BOOTY_TXT_DOMAIN);
						}
						?>
					</span>
				</div>
				<?php echo woocommerce_template_single_price($product->id); ?>
			</header>
			<div class="excerpt">
				<?php echo woocommerce_template_single_excerpt($product->id);?>
			</div>
			<?php
				echo woocommerce_template_single_add_to_cart($product->id);
			?>
			<div class="buttons-block">
		        <?php    
		        if (class_exists('YITH_WCWL')) {
		            echo do_shortcode('[yith_wcwl_add_to_wishlist]');
		        }
		        ?>
		        <a class="btn-add" href="mailto:blank?subject=<?php the_title(); ?>&amp;body= <?php the_permalink() ?>"><i class="fa fa-envelope-o"></i> <?php echo esc_html__('SEND TO FRIEND',BOOTY_TXT_DOMAIN);?></a>
			</div>
			<ul class="list-inline footer-social">
				<li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_the_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li class="twitter"><a href="https://twitter.com/share?url=<?php echo urlencode(get_the_permalink()); ?>&amp;text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li class="google-plus"><a href="https://plus.google.com/share?url=<?php the_permalink();?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<li class="linkedin"><a href="http://www.linkedin.com/shareArticle?url=<?php echo urlencode(get_the_permalink()); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			</ul>
		</div>
	</div>
	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
