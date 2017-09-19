<?php
/**
 * Metabox for post
 * @package Booty
 */

/**
 * Restricted Access
 */
if ( ! defined( 'ABSPATH') || ! defined( 'BOOTY_DIR' ) || ! defined( 'BOOTY_DIR_URI') ) :
    die( 'Cheatin\' huh?' );
endif;

/**
 * Class definition
 */
class Booty_Post_Metabox {

    private $post_types;
    private $meta_key_option;
    function __construct() {
        $this->post_types = array( 'post','portfolio' );
        $this->meta_key_option = '_additional_data_option';
		$this->booty_meta_keys = array('post_gallery_id' => 'array','post_image_id' => 'array','post_image_layout'=>'layout','post_gallery_layout'=>'slide', 'post_link_url' => 'url','post_link_title' => 'attr','post_quote_content' => 'attr','post_quote_by' => 'attr','post_video_url' => 'iframe','post_audio_url' => 'iframe');
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_metabox') );
        add_action( 'save_post', array( $this, 'save' ) );
    }

    /**
     * Enqueue scripts and styles for the metabox
     */
    function enqueues( $screen ) {
        if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], $this->post_types )
            && ( $screen == 'post.php' || $screen == 'post-new.php' ) ) {
            wp_enqueue_script( 'post-metabox', BOOTY_DIR_URI . '/inc/functions/metaboxes/js/post.metabox.js', array( 'jquery' ), '', true );
        }
    }

    /**
     * Attach metabox
     */
    function add_metabox( $post_type ) {
        if ( in_array( $post_type, $this->post_types ) ) {
            add_meta_box(
                'post-metabox',
                esc_html__( 'Post format data', BOOTY_TXT_DOMAIN ),
                array( $this, 'render_content' ),
                $post_type,
                'normal',
                'high'
            );
        }
       /*  add_meta_box(
            'wp_custom_attachment_post',
            esc_html__( 'Layout', BOOTY_TXT_DOMAIN ),
            array( $this, 'render_content_layout' ),
            'post',
            'side'
        ); */
    }

    function render_content_layout(){
        global $post;
        $meta_data = get_post_meta($post->ID, $this->meta_key_option, true);

        if ( ! isset( $meta_data['heading_layout'] ) ) : $meta_data['heading_layout'] = 'default'; endif;
        if ( ! isset( $meta_data['bgtype_heading'] ) ) : $meta_data['bgtype_heading'] = 'background_gradient'; endif;
        if ( ! isset( $meta_data['bgcolor_heading'] ) ) : $meta_data['bgcolor_heading'] = '#f7f9f9'; endif;
        if ( ! isset( $meta_data['bggradientfrom_heading'] ) ) : $meta_data['bggradientfrom_heading'] = '#70269f'; endif;
        if ( ! isset( $meta_data['bggradientto_heading'] ) ) : $meta_data['bggradientto_heading'] = '#35eef6'; endif;
        if ( ! isset( $meta_data['bgimage_heading'] ) ) : $meta_data['bgimage_heading'] = ''; endif;
		if ( ! isset( $meta_data['color_headingtext'] ) ) : $meta_data['color_headingtext']='#ecf0f1'; endif;
        if ( ! isset( $meta_data['breadcrumb_position'] ) ) : $meta_data['breadcrumb_position'] = 'default'; endif;
		if ( ! isset( $meta_data['color_breadcrumbtext'] ) ) : $meta_data['color_breadcrumbtext']='#ecf0f1'; endif;
        if ( ! isset( $meta_data['sidebar_position'] ) ) : $meta_data['sidebar_position'] = 'default'; endif;
        if ( ! isset( $meta_data['sidebar_setting'] ) ) : $meta_data['sidebar_setting'] = 'default'; endif;

        ?>


        <p><strong><?php esc_html_e( 'Heading', BOOTY_TXT_DOMAIN); ?></strong></p>
        <select name="heading-layout" id="heading-layout">
			<option value="default" <?php if(isset( $meta_data['heading_layout'])) selected( $meta_data['heading_layout'], 'default');?>><?php esc_html_e( 'Default', BOOTY_TXT_DOMAIN);?></option>
            <option value="show" <?php selected( $meta_data['heading_layout'], 'show');?>><?php esc_html_e( 'Show heading', BOOTY_TXT_DOMAIN); ?></option>
            <option value="hidden" <?php selected( $meta_data['heading_layout'], 'hidden');?>><?php esc_html_e( 'Hidden heading', BOOTY_TXT_DOMAIN); ?></option>
        </select>
        <p class="description"><?php esc_html_e( 'Choose heading show or hidden', BOOTY_TXT_DOMAIN); ?></p>
        <div class="wrapselect-heading" style="display:none">
            <p><?php esc_html_e( 'Background for heading:', BOOTY_TXT_DOMAIN); ?></p>
            <select id="background-heading" name="background-heading">
                <option value="background_color"  <?php selected( $meta_data['bgtype_heading'], 'background_color');?>><?php esc_html_e( 'Color', BOOTY_TXT_DOMAIN); ?></option>
				<option value="background_gradient"  <?php if(isset( $meta_data['bgtype_heading'])) selected( $meta_data['bgtype_heading'], 'background_gradient');?>><?php esc_html_e( 'Gradient', BOOTY_TXT_DOMAIN);?></option>
                <option value="background_image" <?php selected( $meta_data['bgtype_heading'], 'background_image');?>><?php esc_html_e( 'Image', BOOTY_TXT_DOMAIN); ?></option>
            </select>
            <div class="choose_color" style="display:block">
                <p id="color-picker-1" class="color-picker" ><input type="text" name="bgcolor-heading" value="<?php echo esc_attr($meta_data['bgcolor_heading']);?>" style="background-color:<?php echo esc_attr($meta_data['bgcolor_heading']);?>"/><label><?php esc_html_e( 'Select color', BOOTY_TXT_DOMAIN); ?></label></p>
                <p class="description"><?php esc_html_e( 'Choose background color', BOOTY_TXT_DOMAIN); ?></p>
            </div>
			<div class="choose_gradient" style="display:block">
                <p id="color-picker-from" class="color-picker" ><input type="text" diabled name="bggradientfrom-heading" value="<?php if(isset( $meta_data['bggradientfrom_heading'])) echo esc_attr($meta_data['bggradientfrom_heading']);?>" style="background-color:<?php if(isset( $meta_data['bggradientfrom_heading'])) echo esc_attr($meta_data['bggradientfrom_heading']);?>"/><label><?php esc_html_e( 'From', BOOTY_TXT_DOMAIN);?></label></p>
				<p id="color-picker-to" class="color-picker" ><input type="text" diabled name="bggradientto-heading" value="<?php if(isset( $meta_data['bggradientto_heading'])) echo esc_attr($meta_data['bggradientto_heading']);?>" style="background-color:<?php if(isset( $meta_data['bggradientto_heading'])) echo esc_attr($meta_data['bggradientto_heading']);?>"/><label><?php esc_html_e( 'To', BOOTY_TXT_DOMAIN);?></label></p>
                <p class="description"><?php esc_html_e( 'Set Background Color Gradient Heading', BOOTY_TXT_DOMAIN);?></p>
            </div>
            <div class="choose_image" style="display:none">
                <p>
                    <input class="upload_image" id="upload_image_bghead" type="text" name="upload-image-bghead" value="<?php echo esc_attr($meta_data['bgimage_heading']); ?>" />
                    <input class="upload_image_button_text" id="upload_image_button_bghead" type="button" value="Upload Image" />
                </p>
                <p class="description"><?php esc_html_e( 'Choose background image', BOOTY_TXT_DOMAIN); ?></p>
            </div>
			<?php // Color Heading text ?>
			<p><strong><?php esc_html_e('Heading text color',BOOTY_TXT_DOMAIN)?></strong></p>
			<p class="color-picker" ><input type="text" name="color_headingtext" value="<?php if(isset($meta_data['color_headingtext'])) echo esc_attr($meta_data['color_headingtext']);?>" style="background-color:<?php if(isset($meta_data['color_headingtext'])) echo esc_attr($meta_data['color_headingtext']); ?>"/><label><?php esc_html_e('Select color',BOOTY_TXT_DOMAIN)?></label></p>
			<?php // Breadcrumb setting ?>
			<p><strong><?php esc_html_e( 'Display the breadcrumbs on Heading', BOOTY_TXT_DOMAIN); ?></strong></p>
            <select name="breadcrumb-position">
                <option value="show" <?php selected( $meta_data['breadcrumb_position'], 'show'); ?>><?php esc_html_e( 'Display', BOOTY_TXT_DOMAIN); ?></option>
                <option value="hidden" <?php selected( $meta_data['breadcrumb_position'], 'hidden'); ?>><?php esc_html_e( 'Hidden', BOOTY_TXT_DOMAIN); ?></option>
            </select>
			<div class="breadcrumb_color">
				<p class="color-picker" ><input type="text" name="color_breadcrumbtext" value="<?php if(isset($meta_data['color_breadcrumbtext'])) echo esc_attr($meta_data['color_breadcrumbtext']);?>" style="background-color:<?php if(isset($meta_data['color_breadcrumbtext'])) echo esc_attr($meta_data['color_breadcrumbtext']); ?>"/><label><?php esc_html_e('Select color',BOOTY_TXT_DOMAIN)?></label></p>
				<p class="description"><?php esc_html_e('Choose color for breadcrumbs text',BOOTY_TXT_DOMAIN)?></p>
			</div>
        </div>
        <p><strong><?php esc_html_e( 'Sidebar position', BOOTY_TXT_DOMAIN); ?></strong></p>
        <select name="sidebar-position">
            <option value="default" <?php selected( $meta_data['sidebar_position'], 'default'); ?>><?php esc_html_e( 'Default', BOOTY_TXT_DOMAIN); ?></option>
            <option value="no_sidebar" <?php selected( $meta_data['sidebar_position'], 'no_sidebar'); ?>><?php esc_html_e( 'No sidebar', BOOTY_TXT_DOMAIN); ?></option>
            <option value="left_sidebar" <?php selected( $meta_data['sidebar_position'], 'left_sidebar'); ?>><?php esc_html_e( 'Left sidebar', BOOTY_TXT_DOMAIN); ?></option>
            <option value="right_sidebar" <?php selected( $meta_data['sidebar_position'], 'right_sidebar'); ?>><?php esc_html_e( 'Right sidebar', BOOTY_TXT_DOMAIN); ?></option>
        </select>
        <p class="description"><?php esc_html_e( 'Choose page sidebar position', BOOTY_TXT_DOMAIN); ?></p>
        <p><strong><?php esc_html_e( 'Sidebar setting', BOOTY_TXT_DOMAIN); ?></strong></p>
        <select name="sidebar-setting">
			<option value="default"><?php esc_html_e('Default',BOOTY_TXT_DOMAIN)?></option>
            <?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
             <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php selected( $meta_data['sidebar_setting'], ucwords( $sidebar['id'] )); ?>>
                      <?php echo ucwords( $sidebar['name'] ); ?>
             </option>
        <?php } ?>
        </select>
        <p class="description"><?php esc_html_e( 'Choose a custom sidebar', BOOTY_TXT_DOMAIN); ?></p>

    <?php
    }

    /**
     * Render HTML content for metabox
     */
    function render_content( $post ) {
        wp_nonce_field( 'post-metabox', 'post-metabox-nonce' );
        $meta_data = get_post_meta( $post->ID, $this->meta_key_option, true );
        if ( ! isset( $meta_data['post_image_id'] ) ) : $meta_data['post_image_id'] = array(); endif;
        if ( ! isset( $meta_data['post_image_layout'] ) ) : $meta_data['post_image_layout'] = '' ; endif;
        if ( ! isset( $meta_data['post_gallery_layout'] ) ) : $meta_data['post_gallery_layout'] = '' ; endif;
        if ( ! isset( $meta_data['post_gallery_id'] ) ) : $meta_data['post_gallery_id'] = array(); endif;
        if ( ! isset( $meta_data['post_link_title'] ) ) : $meta_data['post_link_title'] = ''; endif;
        if ( ! isset( $meta_data['post_link_url'] ) ) : $meta_data['post_link_url'] = ''; endif;
        if ( ! isset( $meta_data['post_quote_content'] ) ) : $meta_data['post_quote_content'] = ''; endif;
        if ( ! isset( $meta_data['post_quote_by'] ) ) : $meta_data['post_quote_by'] = ''; endif;
        if ( ! isset( $meta_data['post_video_url'] ) ) : $meta_data['post_video_url'] = ''; endif;
        if ( ! isset( $meta_data['post_audio_url'] ) ) : $meta_data['post_audio_url'] = ''; endif;
        ?>

        <div class="post-metabox-container">
            <div class="post-metabox-child post-metabox-gallery" data-post-format="gallery">
                <a href="#" class="button add-images"
                    title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>"
                    data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>"
                    data-uploader-button-text="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ); ?></a>
                <select name="post_gallery_layout" >
                    <option value=""><?php esc_html_e( 'Select layout',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="full-site" <?php if(isset( $meta_data['post_gallery_layout'])) selected( $meta_data['post_gallery_layout'], 'full-site');?>><?php esc_html_e( 'Image full site',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="full-width" <?php if(isset( $meta_data['post_gallery_layout'])) selected( $meta_data['post_gallery_layout'], 'full-width');?>><?php esc_html_e( 'Image full width',BOOTY_TXT_DOMAIN ); ?></option>
                </select>
                <ul class="images-list"><?php
                if ( is_array( $meta_data['post_gallery_id'] ) && count( $meta_data['post_gallery_id'] ) > 0 ) :
                    foreach ( $meta_data['post_gallery_id'] as $key => $value ) : $image = wp_get_attachment_image_src( $value ); ?>
                    <li>
                        <input type="hidden" name="post_gallery_id[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr( $value ); ?>"/>
                        <img class="image-preview" src="<?php echo esc_url( $image[0] ); ?>"/>
                        <a href="#" class="change-image"
                            title="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"
                            data-uploader-title="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"
                            data-uploader-button-text="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"><i class="dashicons dashicons-edit"></i></a>
                        <a href="#" class="remove-image" title="<?php esc_html_e( 'Remove Image', BOOTY_TXT_DOMAIN ); ?>"><i class="dashicons dashicons-no"></i></a>
                    </li><?php
                    endforeach;
                endif; ?>
                </ul>
            </div>
			<div class="post-metabox-child post-metabox-image" data-post-format="image">
                <a href="#" class="button add-images"
                    title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>"
                    data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>"
                    data-uploader-button-text="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ); ?></a>
                <select name="post_image_layout" >
                    <option value=""><?php esc_html_e( 'Select layout',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="full-site" <?php if(isset( $meta_data['post_image_layout'])) selected( $meta_data['post_image_layout'], 'full-site');?>><?php esc_html_e( 'Image full site',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="full-width" <?php if(isset( $meta_data['post_image_layout'])) selected( $meta_data['post_image_layout'], 'full-width');?>><?php esc_html_e( 'Image full width',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="parallax-full-site" <?php if(isset( $meta_data['post_image_layout'])) selected( $meta_data['post_image_layout'], 'parallax-full-site');?>><?php esc_html_e( 'Parallax full site',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="parallax-full-width" <?php if(isset( $meta_data['post_image_layout'])) selected( $meta_data['post_image_layout'], 'parallax-full-width');?>><?php esc_html_e( 'Parallax full width',BOOTY_TXT_DOMAIN ); ?></option>
                    <option value="image-3column" <?php if(isset( $meta_data['post_image_layout'])) selected( $meta_data['post_image_layout'], 'image-3column');?>><?php esc_html_e( '3column',BOOTY_TXT_DOMAIN ); ?></option>
                </select>
                <ul class="images-list"><?php
                if ( is_array( $meta_data['post_image_id'] ) && count( $meta_data['post_image_id'] ) > 0 ) :
                    foreach ( $meta_data['post_image_id'] as $key => $value ) : $image = wp_get_attachment_image_src( $value ); ?>
                    <li>
                        <input type="hidden" name="post_image_id[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr( $value ); ?>"/>
                        <img class="image-preview" src="<?php echo esc_url( $image[0] ); ?>"/>
                        <a href="#" class="change-image"
                            title="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"
                            data-uploader-title="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"
                            data-uploader-button-text="<?php esc_html_e( 'Change image', BOOTY_TXT_DOMAIN ); ?>"><i class="dashicons dashicons-edit"></i></a>
                        <a href="#" class="remove-image" title="<?php esc_html_e( 'Remove Image', BOOTY_TXT_DOMAIN ); ?>"><i class="dashicons dashicons-no"></i></a>
                    </li><?php
                    endforeach;
                endif; ?>
                </ul>
            </div>

            <div class="post-metabox-child post-metabox-link" data-post-format="link">
				<p><label for="post_link_title"><strong><?php esc_html_e( 'Add title', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><input type="text" name="post_link_title" class="widefat" value="<?php echo esc_html( $meta_data['post_link_title'] ); ?>"/></p>
                <p><label for="post_link_url"><strong><?php esc_html_e( 'Add url', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><input type="text" name="post_link_url" class="widefat" value="<?php echo esc_url( $meta_data['post_link_url'] ); ?>"/></p>
                <p class="howto"><?php esc_html_e( 'Add a link to this post, it will show up at the top of the post', BOOTY_TXT_DOMAIN ); ?></p>
            </div>

            <div class="post-metabox-child post-metabox-quote" data-post-format="quote">
                <p><label for="post_quote_content"><strong><?php esc_html_e( 'Quote content', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><textarea class="widefat" name="post_quote_content" id="post_quote_content" cols="30" rows="10"><?php echo esc_attr($meta_data['post_quote_content']); ?></textarea></p>
                <p><label for="post_quote_by"><strong><?php esc_html_e( 'Quote by', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><input type="text" name="post_quote_by" class="widefat" value="<?php echo esc_attr( $meta_data['post_quote_by'] ); ?>"/></p>
            </div>

            <div class="post-metabox-child post-metabox-video" data-post-format="video">
                <p><label for="post_video_url"><strong><?php esc_html_e( 'Add video iframe or upload', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><input type="text" name="post_video_url" class="widefat" value="<?php echo esc_attr( $meta_data['post_video_url'] ); ?>"/></p>
                <p><a href="#" class="button add-video"
                    title="<?php esc_html_e( 'Upload video', BOOTY_TXT_DOMAIN ) ?>"
                    data-uploader-title="<?php esc_html_e( 'Add video', BOOTY_TXT_DOMAIN); ?>"
                    data-uploader-button-text="<?php esc_html_e( 'Add video', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Upload', BOOTY_TXT_DOMAIN ); ?></a></p>
                <p class="howto"><?php esc_html_e( 'Supports: youtube, vimeo and self hosted videos', BOOTY_TXT_DOMAIN ); ?></p>

            </div>

            <div class="post-metabox-child post-metabox-audio" data-post-format="audio">
                <p><label for="post_audio_url"><strong><?php esc_html_e( 'Add audio link or upload', BOOTY_TXT_DOMAIN ); ?></strong></label></p>
                <p><input type="text" name="post_audio_url" class="widefat" value="<?php echo esc_attr( $meta_data['post_audio_url'] ); ?>"/></p>
                <p><a href="#" class="button add-audio"
                    title="<?php esc_html_e( 'Upload audio', BOOTY_TXT_DOMAIN ) ?>"
                    data-uploader-title="<?php esc_html_e( 'Add audio', BOOTY_TXT_DOMAIN); ?>"
                    data-uploader-button-text="<?php esc_html_e( 'Add audio', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Upload', BOOTY_TXT_DOMAIN ); ?></a></p>
                <p class="howto"><?php esc_html_e( 'Supports: soundcloud and self hosted audios', BOOTY_TXT_DOMAIN ); ?></p>
            </div>
        </div>
        <?php
    }

    /**
     * Save metabox data
     */
    function save( $post_id ) {
        if ( isset( $GLOBALS['post_type'] ) && in_array( $GLOBALS['post_type'], $this->post_types ) ) {

            if ( ! isset( $_POST['post-metabox-nonce'] )
                ||  ! wp_verify_nonce( $_POST['post-metabox-nonce'], 'post-metabox' ) ) return;

            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

            $new_meta_data = array();
            $old_meta_data_option = get_post_meta( $post_id, $this->meta_key_option, true );
			$booty_meta_keys = $this->booty_meta_keys ;
			foreach( $booty_meta_keys as $booty_meta_key => $type ){
				if ( isset( $_POST[$booty_meta_key] ) ) {
					if ($type == 'array'){
						if(is_array( $_POST[$booty_meta_key] ) && count( $_POST[$booty_meta_key] ) > 0 )
						{$new_meta_data[$booty_meta_key] = array_unique( $_POST[$booty_meta_key] );}
						else{$new_meta_data[$booty_meta_key] = array();}
					}elseif($type == 'url'){
						$new_meta_data[$booty_meta_key] = esc_url( $_POST[$booty_meta_key] );
					}elseif($type == 'attr'){
						$new_meta_data[$booty_meta_key] = esc_attr( $_POST[$booty_meta_key] );
					}elseif($type == 'iframe'){
						if(strpos($_POST[$booty_meta_key],'iframe') != false){
							$new_meta_data[$booty_meta_key] = $_POST[$booty_meta_key];
						}else{
							$new_meta_data[$booty_meta_key] = esc_url($_POST[$booty_meta_key]);
						}
					}else{
						$new_meta_data[$booty_meta_key] = $_POST[$booty_meta_key];
					}
				}
			}
            if ( ! empty( $new_meta_data ) ) {
                if ( empty( $old_meta_data_option ) ) {
                    add_post_meta( $post_id, $this->meta_key_option, $new_meta_data, true );
                } else {
                    update_post_meta( $post_id, $this->meta_key_option, $new_meta_data );
                }
            }

        }
    }
}

if ( is_admin() ) {
    new Booty_Post_Metabox();
}