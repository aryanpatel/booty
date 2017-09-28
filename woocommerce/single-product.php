<?php
/**
 * The Template for displaying all single products
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>
<div class="content-main">
	<header class="page-banner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="holder">
						<?php if (function_exists('booty_settings')){
							$config = booty_settings();
							$slogan = $config['banner_slogan'];
						}else{
							$slogan = esc_html__('Your Solgan Here',BOOTY_TXT_DOMAIN);
						}		
						?>
						<h1 class="heading text-uppercase"><?php esc_html_e('Shop',BOOTY_TXT_DOMAIN)?></h1>
						<p><?php echo ($slogan)?></p>
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
			<?php if (function_exists('booty_settings')){
				$config = booty_settings();
				$img_banner = $config['woo_banner_image']['url'];
			}else{
				$img_banner = get_template_directory_uri(). "/assets/images/img01.jpg";
			}		
			?>
			<img alt="image description" src="<?php echo esc_url($img_banner)?>">
		</div>
	</header>
	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div class="container contact-block shop">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'single-product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php
					do_action( 'woocommerce_after_main_content' );
				?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
