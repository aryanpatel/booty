<?php
/**
 * The template for displaying comments.
 *
 * @package Booty
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h4><?php echo esc_html('Comments',BOOTY_TXT_DOMAIN) .' ('. wp_count_comments(get_the_ID())->total_comments .')'?></h4>
		<ul class="list-unstyled list">
			<?php
				wp_list_comments( array(
                    'avatar_size'   => 80,
                    'callback'      => 'booty_theme_comments'
				) );
			?>
		</ul><!-- .comment-list -->
	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', BOOTY_TXT_DOMAIN ); ?></p>
	<?php endif; ?>

	<?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name__mail' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
			'title_reply_before'=> '<h4>',
			'title_reply_after'=> '</h4>',
            'title_reply'       => esc_html__( 'Leave Comment', BOOTY_TXT_DOMAIN ),
            'title_reply_to'    => esc_html__( 'Leave A Reply To %s', BOOTY_TXT_DOMAIN ),
            'cancel_reply_link' => esc_html__( 'Cancel Reply', BOOTY_TXT_DOMAIN ),
            'label_submit'      => esc_html__( 'Submit', BOOTY_TXT_DOMAIN ),
            'comment_notes_before' => '',
			'comment_notes_after' => '',
            'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' =>
                    '<div class="form-row">' .
                            '<input id="author" class="input" name="author" type="text" aria-required="true" required="required" placeholder="' . esc_html__( 'Your Name *', BOOTY_TXT_DOMAIN ) . '"/>' ,

                'email' =>
                        
                            '<input id="email" class="input" name="email" type="email" aria-describedby="email-notes" aria-required="true"' .
                                ' required="required" placeholder="' . esc_html__( 'Email*', BOOTY_TXT_DOMAIN ) . '"/>'  ,

                'website' =>
                        
                            '<input id="url" class="input" name="url" type="url"
                             placeholder="' . esc_html__( 'Website', BOOTY_TXT_DOMAIN ) . '"/>' .
                        
                    '</div>'
                )
            ),
            'comment_field' =>  
                '<textarea id="comment" name="comment" cols="30" rows="10"'.
                ' class="color_grey d_block r_corners w_full height_4"' .
                ' placeholder="'. esc_html__('Review *', BOOTY_TXT_DOMAIN ).'" aria-required="true">' .
            '</textarea>',
    );
    comment_form($args);?>

</div><!-- #comments -->
