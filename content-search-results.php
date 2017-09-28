<?php 
$hidden_author_blog ='show'; 
$hidden_cat_blog ='show';
$hidden_like_blog ='show'; 
$hidden_comment_blog ='show';
$booty_settings = booty_settings();
$items_type = $booty_settings['archive_post_type'];
$space = $booty_settings['archive_post_space'];
$column = $booty_settings['archive_post_column'];
$nav = $booty_settings['archive_post_nav'];
?>                        

<?php 

if(!isset($_GET['s_post_type'])){
    $items_type = 'default';  
    $hidden_author_blog = 'yes';
    $hidden_cat_blog = 'yes';
    $hidden_like_blog = 'yes'; 
    $hidden_comment_blog = 'yes';
?>
<article class="blog-post-v1 item style5">
    <?php echo booty_before_content_post(get_the_ID(),get_post_format(),$items_type); ?>
    <div class="blog-txt">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php echo get_meta_blog( get_the_ID(),$hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog ); ?>
        <p><?php  echo wp_trim_words( get_the_content(), 100, '' ); ?></p>
        <a href="<?php the_permalink(); ?>" class="more"><?php echo '[ '.__('CONTINUE READING',BOOTY_TXT_DOMAIN).' ]' ?></a>
        <div class="box-holder">
            <?php echo get_date_post( get_the_ID() ); ?>
        </div>
    </div>
</article>
<?php 
}elseif($_GET['s_post_type'] == 'product'){
	$product = booty_product();
	$post = booty_post();
	?>
	<article class="shop-product-info fadeInUp animated" data-animate="fadeInUp" data-delay="300">
		<div class="product-img">
			<?php the_post_thumbnail( 'booty_image_shop_carousel' ); ?>
			<div class="product-over">
				<div class="frame">
						 <?php
							printf('<div class="box" title="Quick view"><a onclick="" href="#" class="yith-wcqv-button btn btn-f-default" data-product_id="%d" title="%s">'.esc_html__( 'QUICK VIEW', BOOTY_TXT_DOMAIN).'</a></div>', $product->id, esc_html__('Quick View', BOOTY_TXT_DOMAIN), esc_html__('Quick View', BOOTY_TXT_DOMAIN));
						?>
				</div>
			</div>
		</div>
		<div class="produt-txt">
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
			<?php echo $product->get_price_html(); ?>
			<div class="excerpt">
				<?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ); ?>
			</div>
			<div class="buttons-box">
				<a href="<?php the_permalink(); ?>" class="btn-cart"><?php esc_html_e( '[ READ MORE ]',BOOTY_TXT_DOMAIN); ?></a>
				<div class="btn-cart"><?php do_action( 'woocommerce_after_shop_loop_item' );?></div>
			</div>
		</div>
	</article>
<?php
}?>

