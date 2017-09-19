<?php
require_once(BOOTY_FUNCTIONS . '/vc_functions.php');
require_once(BOOTY_FUNCTIONS . '/sidebars.php');
require_once(BOOTY_FUNCTIONS . '/layout.php');
if (class_exists('Woocommerce')) {
    require_once(BOOTY_FUNCTIONS . '/woocommerce.php');
}
if ( !is_admin() ) {
    function booty_searchfilter($query) {
        if ($query->is_search && !is_admin() && $query->get( 'post_type' ) != 'product') {
            $query->set('post_type',array('post'));
        }
        return $query;
    }
    add_filter('pre_get_posts','booty_searchfilter');
}
/*
* Search popup
*/
function booty_search_popup(){
    $template = get_search_form(false);
    $output = '';
    ob_start();
    ?>
        <div class="search-popup win-height">
            <div class="holder">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="close-btn"><?php esc_html_e('close',BOOTY_TXT_DOMAIN)?></a>
                            <?php echo $template ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    $output .= ob_get_clean();
    return $output;
}
/*
* Search popup
*/
function booty_search_product_popup(){
    if(class_exists( 'WooCommerce' )) {
         $template = get_product_search_form(false);
    }
    $output = '';
    ob_start();
    ?>
        <div class="search-popup win-height">
            <div class="holder">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="close-btn"><?php esc_html_e('close',BOOTY_TXT_DOMAIN)?></a>
							<?php //echo $template ;?>
                           <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<fieldset>
								<input type="search" class="search" placeholder="search..." value="" name="s" title="Search for:">
								<input type="hidden" name="s_post_type" value="product">
								<button type="submit" class="submit">
									<i class="fa fa-search"></i>
								</button>
							</fieldset>
						</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    $output .= ob_get_clean();
    return $output;

}
/*
* Language
*/
	function booty_language_dropdown($type){
		if( !defined( 'ICL_LANGUAGE_CODE' )) {
			return false;
		}
		if($type=="type_1") $booty_language_type=''; elseif($type=="type_2") $booty_language_type=' opener-icons';
		ob_start();
			$languages = icl_get_languages('skip_missing=0');
				if(!empty($languages)){
					foreach($languages as $l){
						if($l['active']){
							echo '<a href="#" class="leng-opener'. $booty_language_type .'">'. $l['language_code'] .'<i class="fa fa-angle-down"></i></a>';
						}
					}
				}
?>
			<div class="lang-drop">
				<ul class="list-unstyled">
					<?php
						if(!empty($languages)){
							foreach($languages as $l){
								echo '<li>';
								//if($l['active']){
								echo '<a href="'. esc_url($l['url']) .'">';
								echo $l['language_code'];
								echo '</a>';
								echo '</li>';
							}
						}
					?>
				</ul>
			</div>
<?php
		return ob_get_clean();
	}
	function booty_language_list(){
		if( !defined( 'ICL_LANGUAGE_CODE' )) {
			return false;
		}
		$booty_settings = booty_settings();
		ob_start();
				$languages = icl_get_languages('skip_missing=0');
			?>
				<nav class="nav language-nav">
					<ul class="list-inline">
						<?php
							if(!empty($languages)){
								foreach($languages as $l){
									echo '<li>';
									echo '<a href="'. esc_url($l['url']) .'">';
									echo $l['language_code'];
									echo '</a>';
									echo '</li>';

								}
							}
						?>
					</ul>
				</nav>

<?php
		return ob_get_clean();
	}
function booty_nav_bars($sidebar=false) {?>
	<div class="menu-nav">
		<div class="win-height jcf-scrollable">
			<?php
				if(!$sidebar){
					if(is_active_sidebar('bars-sidebar'))  dynamic_sidebar('bars-sidebar');
				}else{
					if(is_active_sidebar($sidebar))  dynamic_sidebar($sidebar);
				}
			?>
		</div>
	</div>
<?php
}
function booty_theme_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' : ?>
            <li <?php comment_class(); ?> id="comment<?php comment_ID(); ?>">
            <div class="back-link"><?php comment_author_link(); ?></div>
            </li>
        <?php break;
        default : ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <div <?php comment_class('box'); ?>>
					<div class="img-box">
						<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
						<?php
                            comment_reply_link( array_merge( $args, array(
                                'reply_text' => '<i class="fa fa-reply"></i> <span class="txt-over">'.esc_html('Reply',BOOTY_TXT_DOMAIN).'</span>',
                                'before' => '',
                                'depth' => $depth,
                            ) ) ); ?>
					</div>
					<div class="hoder">
						<strong class="title"><?php comment_author(); ?></strong>
						<time datetime="<?php comment_time( 'c' ); ?>"><?php comment_date(); echo ' '.esc_html('at',BOOTY_TXT_DOMAIN).' '; comment_time(); ?></time>
						<?php comment_text(); ?>
					</div>

                </div>
            </li>
        <?php // End the default styling of comment
        break;
    endswitch;
}



/**
* Render info testimonial
*/
add_action( 'add_meta_boxes', 'add_metabox_testimonial' );
function add_metabox_testimonial(){
    if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], array('testimonial') ) ) {
        add_meta_box(
            'field_testimonial',
            'Info',
            'render_content_testimonial',
            'testimonial',
            'normal',
            'high'
        );
    }
    if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], array('team') ) ) {
        add_meta_box(
            'field_team',
            'Info',
            'render_content_team',
            'team',
            'normal',
            'high'
        );
    }
    if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], array('education') ) ) {
        add_meta_box(
            'field_education',
            'Info',
            'render_content_education',
            'education',
            'normal',
            'high'
        );
    }
    if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], array('yoga') ) ) {
        add_meta_box(
            'field_yoga',
            'More information',
            'field_yoga',
            'yoga',
            'normal',
            'high'
        );
        wp_enqueue_style('booty-style-timepicker1', get_template_directory_uri() . '/assets/timepicker/jquery-ui-1.10.0.custom.min.css',array(), '1.0');
        wp_enqueue_style('booty-style-timepicker2', get_template_directory_uri() . '/assets/timepicker/jquery.ui.timepicker.css?v=0.3.3.css',array(), '1.0');
        wp_enqueue_script('booty-js-timepicker1', get_template_directory_uri() . '/assets/timepicker/jquery.ui.core.min.js',array(), '1.0');
        wp_enqueue_script('booty-js-timepicker2', get_template_directory_uri() . '/assets/timepicker/jquery.ui.timepicker.js?v=0.3.3',array(), '1.0');
        wp_enqueue_script('booty-js-timepicker', get_template_directory_uri() . '/assets/timepicker/timepicker.js',array(), '1.0');
    }

    /**
     * Add field postype portfolio
     */

}
function render_content_testimonial(){
global $post;
$business = get_post_meta( $post->ID, 'business', true );
$company = get_post_meta( $post->ID, 'company', true );
?>
<div class="col-6">
    <label><?php esc_html_e( 'Company', BOOTY_TXT_DOMAIN );?></label>
    <textarea name="company" rows="3" cols="40"><?php echo $company; ?></textarea>
</div>
<div class="col-6">
    <label><?php esc_html_e( 'Business', BOOTY_TXT_DOMAIN );?></label>
    <textarea name="business" rows="3" cols="40"><?php echo $business; ?></textarea>
</div>
<?php
}

/**
* Render team
*/

function render_content_team(){
    global $post;
    $business = get_post_meta( $post->ID, 'business', true );
    $facebook = get_post_meta( $post->ID, 'facebook', true );
    $twitter = get_post_meta( $post->ID, 'twitter', true );
    $linkedin = get_post_meta( $post->ID, 'linkedin', true );
    $googleplus = get_post_meta( $post->ID, 'googleplus', true );
    ?>
    <div class="col-6">
        <label><?php esc_html_e( 'Business', BOOTY_TXT_DOMAIN );?></label>
        <textarea name="business" rows="3" cols="40"><?php echo $business; ?></textarea>
        <label><?php esc_html_e( 'Facebook', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="txtfacebook" value="<?php echo $facebook; ?>">
        <label><?php esc_html_e( 'Twitter', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="txttwitter" value="<?php echo $twitter; ?>">
        <label><?php esc_html_e( 'Linkedin', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="txtlinkin" value="<?php echo $linkedin; ?>">
        <label><?php esc_html_e( 'Google plus', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="txtgplus" value="<?php echo $googleplus; ?>">
        <p class="description"><?php esc_html_e('Add link social',BOOTY_TXT_DOMAIN)?></p>
    </div>
<?php
}

/**
 * Field Education
 */
function render_content_education(){
    global $post;
    $degree = ( get_post_meta( get_the_ID(), 'degree', true ) ) ? get_post_meta( get_the_ID(), 'degree', true ) : '' ;
    $duration = ( get_post_meta( get_the_ID(), 'duration', true ) ) ? get_post_meta( get_the_ID(), 'duration', true ) : '' ;
    ?>
    <div class="col-6">
        <label><?php esc_html_e( 'Degree', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="degree" value="<?php echo $degree; ?>">
        <p class="description"><?php esc_html_e( 'Enter degree education.', BOOTY_TXT_DOMAIN );?></p>
        <label><?php esc_html_e( 'Duration', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="duration" value="<?php echo $duration; ?>">
        <p class="description"><?php esc_html_e( 'Select duration class.', BOOTY_TXT_DOMAIN );?></p>
    </div>
    <?php
}

/**
 * Field Yoga
 */
function field_yoga(){
    global $post;
    $trainneer = ( get_post_meta( get_the_ID(), 'starttime-class', true ) ) ? get_post_meta( get_the_ID(), 'trainneer-class', true ) : '' ;
    $starttime = ( get_post_meta( get_the_ID(), 'starttime-class', true ) ) ? get_post_meta( get_the_ID(), 'starttime-class', true ) : '' ;
    $endtime   = ( get_post_meta( get_the_ID(), 'endtime-class', true ) ) ? get_post_meta( get_the_ID(), 'endtime-class', true ) : '' ;
    $date = ( get_post_meta( get_the_ID(), 'chkday-class', true ) ) ? get_post_meta( get_the_ID(), 'chkday-class', true ) : '' ;

    ?>
    <div class="col-6">
        <label><?php esc_html_e( 'Traineer', BOOTY_TXT_DOMAIN );?></label>
        <input type="text" name="traineer" value="<?php echo $trainneer; ?>">
        <p class="description"><?php esc_html_e( 'Select trainneer class.', BOOTY_TXT_DOMAIN );?></p>
        <label><?php esc_html_e( 'Time hours', BOOTY_TXT_DOMAIN );?></label>
        <span><?php esc_html_e( 'Start Time: ', BOOTY_TXT_DOMAIN );?></span><input type="text" name="starttime" style="width: 100px;" id="timepicker_start" value="<?php echo $starttime; ?>" />
        <span><?php esc_html_e( 'End Time: ', BOOTY_TXT_DOMAIN );?></span><input type="text" name="endtime" style="width: 100px;" id="timepicker_end" value="<?php echo $endtime; ?>" />
        <p class="description"><?php esc_html_e( 'Select time take place class.', BOOTY_TXT_DOMAIN );?></p>
        <label><?php esc_html_e( 'Time date', BOOTY_TXT_DOMAIN );?></label>
        <p><?php esc_html_e('Monday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="mon" <?php if ( ! empty($date) ) echo ( in_array('mon',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Tuesday',BOOTY_TXT_DOMAIN)?>  <input type="checkbox" name="chkday[]" value="tue" <?php if ( ! empty($date) ) echo ( in_array('tue',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Thurday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="thu" <?php if ( ! empty($date) ) echo ( in_array('thu',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Wednesday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="wed" <?php if ( ! empty($date) ) echo ( in_array('wed',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Friday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="fri" <?php if ( ! empty($date) ) echo ( in_array('fri',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Saturday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="sat" <?php if ( ! empty($date) ) echo ( in_array('sat',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Sunday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="sunday" <?php if ( ! empty($date) ) echo ( in_array('sunday',$date) ) ? 'checked="checked"' : ''; ?>>
        <?php esc_html_e('Everyday',BOOTY_TXT_DOMAIN)?> <input type="checkbox" name="chkday[]" value="everyday" <?php if ( ! empty($date) ) echo ( in_array('everyday',$date) ) ? 'checked="checked"' : ''; ?>>
        </p>
        <p class="description"><?php esc_html_e( 'Select date take place class.', BOOTY_TXT_DOMAIN );?></p>
    </div>
    <?php
}

/*Save metabox*/
add_action( 'save_post','save_metabox_testimonial' );
function save_metabox_testimonial($post_id){
    $business = isset($_POST['business']) ? $_POST['business'] : '';
    $company = isset($_POST['company']) ? $_POST['company'] : '';
    $facebook = isset($_POST['txtfacebook']) ? $_POST['txtfacebook'] : '';
    $twitter = isset($_POST['txttwitter']) ? $_POST['txttwitter'] : '';
    $linkedin = isset($_POST['txtlinkin']) ? $_POST['txtlinkin'] : '';
    $googleplus = isset($_POST['txtgplus']) ? $_POST['txtgplus'] : '';

    $trainneer = isset($_POST['traineer']) ? $_POST['traineer'] : '';
    $starttime = isset($_POST['starttime']) ? $_POST['starttime'] : '';
    $endtime   = isset($_POST['endtime']) ? $_POST['endtime'] : '';
    $date = isset($_POST['chkday']) ? $_POST['chkday'] : '';

    $degree   = isset($_POST['degree']) ? $_POST['degree'] : '';
    $duration = isset($_POST['duration']) ? $_POST['duration'] : '';
    /**
     * Update info testimonial
     */
    update_post_meta($post_id,'business',$business);
    update_post_meta($post_id,'company',$company);
    update_post_meta($post_id,'facebook',$facebook);
    update_post_meta($post_id,'twitter',$twitter);
    update_post_meta($post_id,'linkedin',$linkedin);
    update_post_meta($post_id,'googleplus',$googleplus);

    /**
     * Update info yoga
     */
    update_post_meta($post_id,'trainneer-class',$trainneer);
    update_post_meta($post_id,'starttime-class',$starttime);
    update_post_meta($post_id,'endtime-class',$endtime);
    update_post_meta($post_id,'chkday-class',$date);

    /**
     * Update info education
     */
    update_post_meta($post_id,'degree',$degree);
    update_post_meta($post_id,'duration',$duration);
}
?>