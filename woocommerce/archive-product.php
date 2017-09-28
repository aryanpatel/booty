<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 
?>
<div class="content-main">
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php
				if(get_option( 'woocommerce_shop_page_id' )){
                    $booty_post=get_post(get_option( 'woocommerce_shop_page_id' ));
                    $booty_content = apply_filters('the_content', $booty_post -> post_content);
					if($booty_content !='')
						$booty_shop = true;
					else
						$booty_shop = false;
				}else{
					$booty_shop = false;
				}
            ?>
			<?php if (is_shop() && $booty_shop): ?>
			<div class="container">
                <?php echo $booty_content; ?>
            </div>
			<?php 
			else: 
				$booty_settings = booty_settings();
				$type = $booty_settings['archive_product_layout'];/*grid,list*/
				$layout = $booty_settings['archive_product_width'];/*full-site,full-width*/
				$column = (int)$booty_settings['archive_product_column'];/*3,4*/
				$sidebar = $booty_settings['archive_product_sidebar'];/*no-sidebar,left-sidebar,right-sidebar*/
				if( is_product_category() ):
					if ( isset( $_GET['price'] )){
						$paged	 = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
						$args = array(
							'post_type' => 'product',
							'orderby' => 'title',
							'order' => 'ASC',
							'paged'          => $paged,
							'tax_query' => array(
								'relation' => 'AND',
								array(
									'taxonomy' => 'product_cat',
									'field' => 'slug',
									'terms' => get_queried_object()->slug
								)
							),
							'meta_query' => array(
								'relation' => 'AND',
									array(
										'key' => '_price',
										'value' => $_GET['price'],
										'compare' => '<',
										'type' => 'NUMERIC'
									),
									array(
										'key' => '_price',
										'value' => 2,
										'compare' => '>=',
										'type' => 'NUMERIC'
									)
							)
						);
						query_posts( $args );
					}
					if(isset( $_GET['pro_s'] )){
						$paged	 = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
						$args = array(
							'post_type' => 'product',
							'orderby' => 'title',
							'order' => 'ASC',
							'paged'          => $paged,
							'meta_query' => array(
								'relation' => 'AND',
									array(
										'key' => '_price',
										'value' => $_GET['price'],
										'compare' => '<',
										'type' => 'NUMERIC'
									),
									array(
										'key' => '_price',
										'value' => 2,
										'compare' => '>=',
										'type' => 'NUMERIC'
									)
							)
						);
						query_posts( $args );
					}
			?>
				<div class="page-banner">
					<div class="container">
		                <div class="row">
		                    <div class="col-xs-12">
		                    	<div class="holder">
									<h1 class="heading text-uppercase">
										<?php
										if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
											woocommerce_page_title();
										endif;
										?>
									</h1>
									<p><?php wp_kses( woocommerce_taxonomy_archive_description(),wp_kses_allowed_html( 'post' ) ); ?></p>
								</div>
		                        <?php
		                            $args = array(
		                                'delimiter'   => '',
		                                'wrap_before' => '<ul class="breadcrumbs list-inline">',
		                                'wrap_after'  => '</ul>',
		                                'before'      => '',
		                                'after'       => '',
		                                'home'        => _x( 'Home', 'breadcrumb', BOOTY_TXT_DOMAIN )
		                            );
		                            echo woocommerce_breadcrumb($args);
		                        ?>
		                    </div>
		                </div>
		            </div>
		            <div class="stretch">
		            	<?php woocommerce_category_image(); ?>
					</div>
		        </div>
				<?php endif;?>
				<div class="padding-top-95 padding-bottom-100">
					<?php
					if( $layout == 'full-site' ) echo '<div class="container">';
                	if( $layout == 'full-width' ) echo '<div class="shop-full-width">';

                	if ( $sidebar == 'no-sidebar' ) {
	                    echo '';
	                } else if ( $sidebar == 'left-sidebar' ) {
	                    echo '<div class="row"><div class="col-md-3 col-sm-3 col-xs-12">';
	                    dynamic_sidebar( 'shop-sidebar' );
	                    echo '</div>';
	                    echo '<div class="col-md-9 col-sm-9 col-xs-12">';
	                } else if ( $sidebar == 'right-sidebar' ) {
	                    echo '<div class="row"><div class="col-md-9 col-sm-9 col-xs-12">';
	                }
					if ( have_posts() ) :
					?>
					<header class="shop-header">
	                    <div class="holder">
	                    	<h2>
	                    		<?php
								if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
									woocommerce_page_title();
								endif;
								?>
							</h2>
	                    	<?php echo woocommerce_result_count(); ?>
	                    </div>
	                    <?php booty_woo_ordering(); ?>
	                </header>

					<?php
					if ( $column == 3 ){
                        $column_class = 'coll-3';
                    }else if ( $column == 4 ){
                        $column_class = 'coll-4';
                    }else{
                        $column_class = 'coll-43';
                    } ?>
                    <div class="products-shop">
                    	<div class="products-holder<?php if ( $column == 3 ) echo ' side';?>">
							<?php
							if ( $type == 'gird' ) :
								$count_item = 0;
								while ( have_posts() ) : the_post();
									$count_item++;
		                            if ( $count_item == 1 ) echo '<div class="row">';
		                            if ( ($count_item-1) % $column == 0 && $count_item > $column ) echo '<div class="row">';
		                                if ( $column == 3 ){
		                                    echo '<div class="col-xs-12 col-sm-6 col-md-4">';
		                                }else{
		                                    echo '<div class="col-xs-12 col-sm-6 col-md-3">';
		                                }
		                                wc_get_template_part( 'content', 'product' );
		                                echo '</div>';
		                            if ( $count_item == $column ) echo '</div>';
		                            if ( $count_item % $column == 0 && $count_item > $column ) echo '</div>';
								endwhile; // end of the loop.
								wp_reset_postdata();
								if ( $count_item % $column != 0 ) echo '</div>';
							endif;
							if ( $type == 'list' ) :
								while ( have_posts() ) : the_post();
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
								endwhile;
								wp_reset_postdata();
							endif;
							?>
						</div>
					</div>
					<footer class="shop-footer side">
						<?php booty_paging_navigation('type3',$GLOBALS['wp_query']); ?>
                        <?php booty_woo_resual_count_footer($GLOBALS['wp_query']) ;?>
                    </footer>	
					<?php else: ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>
					
                    <?php
                    if ( $sidebar == 'no-sidebar' ) {
	                    echo '';
	                } else if ( $sidebar == 'left-sidebar' ) {
	                	echo '</div></div>';
	                } else if ( $sidebar == 'right-sidebar' ) {
	                    echo '</div>';
	                    echo '<div class="col-md-3 col-sm-3 col-xs-12">';
	                    dynamic_sidebar( 'shop-sidebar' );
	                    echo '</div></div>';
	                }

					if( $layout == 'full-site' ) echo '</div>';
					if( $layout == 'full-width' ) echo '</div>';
					?>
				</div>
				<?php
				endif;
			?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
