<?php
/**
 * Display single product reviews (comments)
 *
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews">
	<div id="comment-box">
		<h2 class="margin-bottom-10"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )
				printf( _n( 'Review (%s)', 'Review (%s)', $count, BOOTY_TXT_DOMAIN ), $count, get_the_title() );
			else
				esc_html_e( 'Reviews', BOOTY_TXT_DOMAIN );
		?></h2>
		<?php if ( have_comments() ) : ?>

			<ul class="list-unstyled list">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', BOOTY_TXT_DOMAIN ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? esc_html__( 'Add Review', BOOTY_TXT_DOMAIN ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', BOOTY_TXT_DOMAIN ), get_the_title() ),
						'title_reply_to'       => esc_html__( 'Leave a Reply to %s', BOOTY_TXT_DOMAIN ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<div class="row"><div class="col-xs-12 col-sm-6 col-md-4"><input class="input" placeholder="Your Name *" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></div>',
							'email'  => '<div class="col-xs-12 col-sm-6 col-md-4"><input id="email" class="input" placeholder="Email *" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></div>',
						),
						'label_submit'  => esc_html__( 'Submit', BOOTY_TXT_DOMAIN ),
						'logged_in_as'  => '',
						'comment_field' => ''
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( wp_kses_post( 'You must be <a href="%s">logged in</a> to post a review.', BOOTY_TXT_DOMAIN ), esc_url( $account_page_url ) ) . '</p>';
					}

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
						$comment_form['comment_field'] = '<div class="col-xs-12 col-sm-6 col-md-4"><label for="rating">' . esc_html__( 'Your Rating', BOOTY_TXT_DOMAIN ) .'</label><select name="rating" id="rating">
							<option value="">' . esc_html__( 'Rate&hellip;', BOOTY_TXT_DOMAIN ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', BOOTY_TXT_DOMAIN ) . '</option>
							<option value="4">' . esc_html__( 'Good', BOOTY_TXT_DOMAIN ) . '</option>
							<option value="3">' . esc_html__( 'Average', BOOTY_TXT_DOMAIN ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', BOOTY_TXT_DOMAIN ) . '</option>
							<option value="1">' . esc_html__( 'Very Poor', BOOTY_TXT_DOMAIN ) . '</option>
						</select></div>';
					}
					if ( is_user_logged_in () ) {
						$comment_form['comment_field'] .= '<div class="row"><div class="col-xs-12 col-sm-12 col-md-12"><textarea placeholder="Review *" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div></div>';
					} else{
						$comment_form['comment_field'] .= '<div class="col-xs-12 col-sm-12 col-md-12"><textarea placeholder="Review *" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';
					}


					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', BOOTY_TXT_DOMAIN ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
