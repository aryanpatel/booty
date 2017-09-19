<?php

function booty_show_page_meta_option() { 
    $meta_box = booty_default_meta_data(); 
    booty_show_meta_box($meta_box);
}
function booty_show_page_header_footer_option() {
	global $post; 
	$booty_header_layouts = array('header 1' => 'header_layout_1','header 2' => 'header_layout_2','header 3' => 'header_layout_3','header 4' => 'header_layout_6','header 5' => 'header_layout_7','header 6' => 'header_layout_12','header 7' => 'header_layout_13','header 8' => 'header_layout_16','header 9' => 'header_layout_17','header 10' => 'header_layout_19','header 11' => 'header_layout_blog','header 12' => 'header_layout_creative','header 13' => 'header_layout_st3','header 14' => 'header_layout_st7','header 15' => 'header_layout_st8','header 16' => 'header_layout_st13','header 17' => 'header_layout_st18','header 18' => 'header_layout_st26','header 19' => 'header_layout_finance','header 20' => 'header_layout_decoration','header 21' => 'header_layout_architecture');
	$booty_footer_styles =  array('style1','style2','style3','style4','style5','style6','style7','style8','style9','style10','style11','style12','style13','style14','style15','style16','style17','style18','style19','style20','style21','style22','style23','style24','style25','style-freelancer');
	$booty_footer_bgs =  array('bg-none','bg-white','bg-grey','bg-shark','bg-dark-jungle');
	?>
	<div class="booty_header_layout">
		<label><strong><?php esc_html_e( 'Header layout', BOOTY_TXT_DOMAIN);?></strong></label>
		<div>
			<select name="header_layout"> 
				<?php if(get_post_meta($post->ID, 'header_layout', true))
					$booty_selected = get_post_meta($post->ID, 'header_layout', true);
					else $booty_selected='';
				?>
				<option value="default" <?php selected( $booty_selected, 'default');?>>
					<?php esc_html_e( 'Header Layout Default', BOOTY_TXT_DOMAIN );?>
				</option>
				<?php foreach ($booty_header_layouts as $booty_header_layout => $value){ ?>
				<option value="<?php echo esc_attr($value); ?>" <?php selected( $booty_selected, $value);?>><?php echo esc_attr($booty_header_layout); ?></option>
				<?php } ?>
			</select>
			<p class="description"><label></label><?php esc_html_e( 'Choose header layout', BOOTY_TXT_DOMAIN);?></p>
		</div>
	</div>
	
	<div class="wrapselect-heading">
			<!--Header 11 option-->
		<div class="wrapselect-heading-type hide" data-show="header_layout_blog">
			<input type="checkbox" class="header_option" name="header_option" value="yes" <?php checked(get_post_meta($post->ID, 'header_option', true),'yes'); ?>/><?php esc_html_e('Custom option',BOOTY_TXT_DOMAIN)?>
			<div class="wrapselect-option wrapselect-header11-option hide">
				<div class="d-inline-block col-lg-3 m-bottom-10">
					<div class="color-picker"><input type="text" diabled name="header_bg_color" value="<?php if(get_post_meta($post->ID, 'header_bg_color', true)) echo esc_html(get_post_meta($post->ID, 'header_bg_color', true));?>"/></div>
					<p class="description"><?php esc_html_e('Header Background Color',BOOTY_TXT_DOMAIN)?></p>
				</div>
				<div class="d-inline-block col-lg-3 m-bottom-10">
					<div class="color-picker"><input type="text" diabled name="header_text_color" value="<?php if(get_post_meta($post->ID, 'header_text_color', true)) echo esc_html(get_post_meta($post->ID, 'header_text_color', true));?>"/></div>
					<p class="description"><?php esc_html_e('Header Background Color',BOOTY_TXT_DOMAIN)?></p>
				</div>
				<div class="d-inline-block col-lg-3 aht_image_upload m-bottom-10">
					<div>
						<a href="#" class="button add-images" title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>" data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>" data-uploader-button-text="<?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN ); ?></a>
						<?php if(get_post_meta($post->ID, 'header11_logo_light', true))
								$aht_selected = get_post_meta($post->ID, 'header11_logo_light', true);
								else $aht_selected='';
						?>
						<input type="hidden" class="aht_img_upload" name="header11_logo_light" value="<?php echo esc_html($aht_selected ); ?>"/>
						<p class="description"><?php esc_html_e( 'Upload Logo for light theme', BOOTY_TXT_DOMAIN);?></p>
					</div>
					<div class="aht_image">
					<?php
						$aht_selected='';
						if(get_post_meta($post->ID, 'header11_logo_light', true)){
							$aht_selected = get_post_meta($post->ID, 'header11_logo_light', true);
							$image = wp_get_attachment_image_src( (int)$aht_selected );
							echo '<img class="image-preview" src="'. esc_url( $image[0] ) .'"/>';
							echo '<a href="#" class="remove-image" title="'. esc_html__( 'Remove Image', BOOTY_TXT_DOMAIN ) .'"><i class="dashicons dashicons-no"></i></a>';
						}
					?>
					</div>
				</div>
				<div class="d-inline-block col-lg-3 aht_image_upload m-bottom-10">
					<div>
						<a href="#" class="button add-images" title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>" data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>" data-uploader-button-text="<?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN ); ?></a>
						<?php if(get_post_meta($post->ID, 'header11_logo_dark', true))
								$aht_selected = get_post_meta($post->ID, 'header11_logo_dark', true);
								else $aht_selected='';
						?>
						<input type="hidden" class="aht_img_upload" name="header11_logo_dark" value="<?php echo esc_html($aht_selected ); ?>"/>
						<p class="description"><?php esc_html_e( 'Upload Logo for dark theme', BOOTY_TXT_DOMAIN);?></p>
					</div>
					<div class="aht_image">
					<?php
						$aht_selected='';
						if(get_post_meta($post->ID, 'header11_logo_dark', true)){
							$aht_selected = get_post_meta($post->ID, 'header11_logo_dark', true);
							$image = wp_get_attachment_image_src( (int)$aht_selected );
							echo '<img class="image-preview" src="'. esc_url( $image[0] ) .'"/>';
							echo '<a href="#" class="remove-image" title="'. esc_html__( 'Remove Image', BOOTY_TXT_DOMAIN ) .'"><i class="dashicons dashicons-no"></i></a>';
						}
					?>
					</div>
				</div>
			</div>
		</div>
			<!--Header 20 option-->
		<div class="wrapselect-heading-type hide" data-show="header_layout_decoration">
			<input type="checkbox" class="header_option" name="header_option20" value="yes" <?php checked(get_post_meta($post->ID, 'header_option20', true),'yes'); ?>/><?php esc_html_e('Custom option',BOOTY_TXT_DOMAIN)?>
			<div class="wrapselect-option wrapselect-header20-option hide">
				<div class="d-inline-block col-lg-4 aht_image_upload m-bottom-10">
					<div>
						<a href="#" class="button add-images" title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>" data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>" data-uploader-button-text="<?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN ); ?></a>
						<?php if(get_post_meta($post->ID, 'header20_logo_light', true))
								$aht_selected = get_post_meta($post->ID, 'header20_logo_light', true);
								else $aht_selected='';
						?>
						<input type="hidden" class="aht_img_upload" name="header20_logo_light" value="<?php echo esc_html($aht_selected ); ?>"/>
						<p class="description"><?php esc_html_e( 'Upload Logo for light theme', BOOTY_TXT_DOMAIN);?></p>
					</div>
					<div class="aht_image">
					<?php
						$aht_selected='';
						if(get_post_meta($post->ID, 'header20_logo_light', true)){
							$aht_selected = get_post_meta($post->ID, 'header20_logo_light', true);
							$image = wp_get_attachment_image_src( (int)$aht_selected );
							echo '<img class="image-preview" src="'. esc_url( $image[0] ) .'"/>';
							echo '<a href="#" class="remove-image" title="'. esc_html__( 'Remove Image', BOOTY_TXT_DOMAIN ) .'"><i class="dashicons dashicons-no"></i></a>';
						}
					?>
					</div>
				</div>
				<div class="d-inline-block col-lg-4 aht_image_upload m-bottom-10">
					<div>
						<a href="#" class="button add-images" title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>" data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>" data-uploader-button-text="<?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN ); ?></a>
						<?php if(get_post_meta($post->ID, 'header20_logo_dark', true))
								$aht_selected = get_post_meta($post->ID, 'header20_logo_dark', true);
								else $aht_selected='';
						?>
						<input type="hidden" class="aht_img_upload" name="header20_logo_dark" value="<?php echo esc_html($aht_selected ); ?>"/>
						<p class="description"><?php esc_html_e( 'Upload Logo for dark theme', BOOTY_TXT_DOMAIN);?></p>
					</div>
					<div class="aht_image">
					<?php
						$aht_selected='';
						if(get_post_meta($post->ID, 'header20_logo_dark', true)){
							$aht_selected = get_post_meta($post->ID, 'header20_logo_dark', true);
							$image = wp_get_attachment_image_src( (int)$aht_selected );
							echo '<img class="image-preview" src="'. esc_url( $image[0] ) .'"/>';
							echo '<a href="#" class="remove-image" title="'. esc_html__( 'Remove Image', BOOTY_TXT_DOMAIN ) .'"><i class="dashicons dashicons-no"></i></a>';
						}
					?>
					</div>
				</div>
				
				<div class="d-inline-block col-lg-4 m-bottom-10">
					<select type="text" name="header20_menu_bar">
						<?php echo get_post_meta($post->ID, 'header20_menu_bar', true)?>
						<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
							 <option <?php selected( get_post_meta($post->ID, 'header20_menu_bar', true), ucwords($sidebar['id']) ); ?> value="<?php echo ucwords( $sidebar['id'] ); ?>">
									<?php echo ucwords( $sidebar['name'] ); ?>
							 </option>
						<?php } ?>
					</select>
					<p class="description"><?php esc_html_e('Header Menu bar',BOOTY_TXT_DOMAIN)?></p>
				</div>
			</div>
		</div>
	</div> <!-- end .wrapselect-heading -->
	<?php // Layout footer ?>
	<div class="booty_footer_layout">
		<label><strong><?php esc_html_e( 'Footer layout', BOOTY_TXT_DOMAIN);?></strong></label>
		<div>
			<select name="footer_layout">
				<?php if(get_post_meta($post->ID, 'footer_layout', true))
					$booty_selected = get_post_meta($post->ID, 'footer_layout', true);
					else $booty_selected='';
				?>
				<option value="default" <?php selected( $booty_selected, 'default');?>>
					<?php esc_html_e( 'Footer Layout Default', BOOTY_TXT_DOMAIN );?>
				</option>
				<option value="custom" <?php selected( $booty_selected, 'custom');?>>
					<?php esc_html_e( 'Footer Layout Custom', BOOTY_TXT_DOMAIN );?>
				</option>
			</select>
			<p class="description"><?php esc_html_e( 'Choose footer layout', BOOTY_TXT_DOMAIN);?></p>
		</div>
	</div>
	<div class="booty_footer_setting_wrapper">
		<div class="booty_footer_style">
			<label><strong><?php esc_html_e( 'Footer Style', BOOTY_TXT_DOMAIN);?></strong></label>
			<div>
				<select name="booty_footer_style">
					<?php if(get_post_meta($post->ID, 'booty_footer_style', true))
							$booty_selected = get_post_meta($post->ID, 'booty_footer_style', true);
							else $booty_selected='';
						?>
						<option value="default" <?php selected( $booty_selected, 'default');?>>
							<?php esc_html_e( 'Footer Style Default', BOOTY_TXT_DOMAIN );?>
						</option>
						<?php foreach ($booty_footer_styles as $booty_footer_style){ ?>
						<option value="<?php echo esc_attr($booty_footer_style); ?>" <?php selected( $booty_selected, $booty_footer_style);?>><?php echo esc_attr($booty_footer_style); ?></option>
						<?php } ?>
				</select>
				<p class="description"><?php esc_html_e( 'Choose footer style', BOOTY_TXT_DOMAIN);?></p>
			</div>
		</div>
		<div class="booty_footer_reverse">
			<label><strong><?php esc_html_e( 'Footer Reverse', BOOTY_TXT_DOMAIN);?></strong></label>
			<div>
				<select name="booty_footer_reverse">
					<?php if(get_post_meta($post->ID, 'booty_footer_reverse', true))
							$booty_selected = get_post_meta($post->ID, 'booty_footer_reverse', true);
							else $booty_selected='';
						?>
						<option value="not_reverse" <?php selected( $booty_selected, 'not_reverse');?>>
							<?php esc_html_e( 'Not Reverse', BOOTY_TXT_DOMAIN );?>
						</option>
						<option value="reverse" <?php selected( $booty_selected, 'reverse');?>>
							<?php esc_html_e( 'Reverse', BOOTY_TXT_DOMAIN );?>
						</option>  
				</select>
				<p class="description"><?php esc_html_e( 'Choose footer style', BOOTY_TXT_DOMAIN);?></p>
			</div>
		</div>
		<div class="booty_footer_parallax aht_image_upload">
			<label><strong><?php esc_html_e( 'Footer Parallax', BOOTY_TXT_DOMAIN);?></strong></label>
			<div class="aht_image">
			<?php 
				$booty_selected='';
				if(get_post_meta($post->ID, 'booty_footer_parallax', true)){
					$booty_selected = get_post_meta($post->ID, 'booty_footer_parallax', true);
					$image = wp_get_attachment_image_src( (int)$booty_selected );
					echo '<img class="image-preview" src="'. esc_url( $image[0] ) .'"/>';
					echo '<a href="#" class="remove-image" title="'. esc_html__( 'Remove Image', BOOTY_TXT_DOMAIN ) .'"><i class="dashicons dashicons-no"></i></a>';
				}
			?>
			</div>
			<div>
				<a href="#" class="button add-images" title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN ) ?>" data-uploader-title="<?php esc_html_e( 'Add image(s)', BOOTY_TXT_DOMAIN); ?>" data-uploader-button-text="<?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN); ?>"><?php esc_html_e( 'Add image', BOOTY_TXT_DOMAIN ); ?></a>
				<?php if(get_post_meta($post->ID, 'booty_footer_parallax', true))
						$booty_selected = get_post_meta($post->ID, 'booty_footer_parallax', true);
						else $booty_selected='';
				?>
				<input type="hidden" class="aht_img_upload" name="booty_footer_parallax" value="<?php echo esc_html($booty_selected ); ?>"/>
				<p class="description"><?php esc_html_e( 'Choose image for Parallax', BOOTY_TXT_DOMAIN);?></p>
			</div>
		</div>

		<ul class="booty_footer_tab">
			<li class="active"><input type="button" class="booty_footer_top" value="<?php esc_html_e( 'Footer Top', BOOTY_TXT_DOMAIN );?>" /></li>
			<li><input type="button" class="booty_footer_center" value="<?php esc_html_e( 'Footer Center', BOOTY_TXT_DOMAIN );?>" /></li>
			<li><input type="button" class="booty_footer_bottom" value="<?php esc_html_e( 'Footer Bottom', BOOTY_TXT_DOMAIN );?>" /></li>
		</ul>
		<div class="booty_footer_wrapper booty_footer_top_wrapper">
			<?php if(get_post_meta($post->ID, 'booty_footer_top_show', true))
				$booty_selected = get_post_meta($post->ID, 'booty_footer_top_show', true);
				else $booty_selected='';
			?> 
			<select name="booty_footer_top_show" class="booty_select_show">
				<option value="show" <?php selected( $booty_selected, 'show');?>><?php esc_html_e( 'Show', BOOTY_TXT_DOMAIN );?></option>
				<option value="hide" <?php selected( $booty_selected, 'hide');?>><?php esc_html_e( 'Hide', BOOTY_TXT_DOMAIN );?></option>
			</select>
			<div class="booty_footer_top_column booty_select_show_ct">
				<?php if(get_post_meta($post->ID, 'booty_footer_top_column', true))
					$booty_selected = get_post_meta($post->ID, 'booty_footer_top_column', true);
					else $booty_selected='';
				?> 
				<select name="booty_footer_top_column">
					<option value="1column" <?php selected( $booty_selected, '1column');?>><?php esc_html_e( '1 Layout', BOOTY_TXT_DOMAIN );?></option>
					<option value="2column" <?php selected( $booty_selected, '2column');?>><?php esc_html_e( '2 Layout', BOOTY_TXT_DOMAIN );?></option> 
				</select>
				<select name="booty_footer_top_bg">
					<?php if(get_post_meta($post->ID, 'booty_footer_top_bg', true))
							$booty_selected = get_post_meta($post->ID, 'booty_footer_top_bg', true);
							else $booty_selected='';
						?>
						<option value="default" <?php selected( $booty_selected, 'default');?>>
							<?php esc_html_e( 'Background Default', BOOTY_TXT_DOMAIN );?>
						</option>
						<?php foreach ($booty_footer_bgs as $booty_footer_bg){ ?>
						<option value="<?php echo esc_attr($booty_footer_bg); ?>" <?php selected( $booty_selected, $booty_footer_bg);?>><?php echo esc_attr($booty_footer_bg); ?></option>
						<?php } ?>
				</select>
				
				<?php for ($c=1; $c<=2; $c++){ ?>
					<div class="booty_footer_top_<?php echo esc_attr($c)?>column booty_footer_top_ct">
						<?php for ($i=1;$i<=$c;$i++){ ?>
						<div class="booty_footer_top_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>">
							<?php if(get_post_meta($post->ID, 'booty_footer_top_'.$c.'column_'.$i.'w', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_top_'.$c.'column_'.$i.'w', true);
								else $booty_selected='';
							?> 
							<select name="booty_footer_top_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>w">
								<?php for ($j=1;$j<13;$j++){ ?>
								<option value="<?php echo esc_attr($j) ?>" <?php selected( $booty_selected, $j);?>><?php echo esc_attr($j); echo '&#47;12';?></option>
								<?php } ?>
							</select>
							<?php if(get_post_meta($post->ID, 'booty_footer_top_'.$c.'column_'.$i.'ct', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_top_'.$c.'column_'.$i.'ct', true);
								else $booty_selected=''; 
							?> 
							<select name="booty_footer_top_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>ct">
								<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
								 <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php selected( $booty_selected, ucwords( $sidebar['id'] ));?>>
										  <?php echo ucwords( $sidebar['name'] ); ?>
								 </option>
							<?php } ?>
							</select>
						</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="booty_footer_wrapper booty_footer_center_wrapper">
			<?php if(get_post_meta($post->ID, 'booty_footer_center_show', true))
				$booty_selected = get_post_meta($post->ID, 'booty_footer_center_show', true);
				else $booty_selected='';
			?> 
			<select name="booty_footer_center_show"  class="booty_select_show">
				<option value="show" <?php selected( $booty_selected, 'show');?>><?php esc_html_e( 'Show', BOOTY_TXT_DOMAIN );?></option>
				<option value="hide" <?php selected( $booty_selected, 'hide');?>><?php esc_html_e( 'Hide', BOOTY_TXT_DOMAIN );?></option>
			</select>
			<div class="booty_footer_center_column booty_select_show_ct">
				<?php if(get_post_meta($post->ID, 'booty_footer_center_column', true))
					$booty_selected = get_post_meta($post->ID, 'booty_footer_center_column', true);
					else $booty_selected='';
				?> 
				<select name="booty_footer_center_column">
					<option value="3column" <?php selected( $booty_selected, '3column');?>><?php esc_html_e( '3 Layout', BOOTY_TXT_DOMAIN );?></option>
					<option value="4column" <?php selected( $booty_selected, '4column');?>><?php esc_html_e( '4 Layout', BOOTY_TXT_DOMAIN );?></option>
				</select>
				<select name="booty_footer_center_bg">
					<?php if(get_post_meta($post->ID, 'booty_footer_center_bg', true))
							$booty_selected = get_post_meta($post->ID, 'booty_footer_center_bg', true);
							else $booty_selected='';
						?>
						<option value="default" <?php selected( $booty_selected, 'default');?>>
							<?php esc_html_e( 'Background Default', BOOTY_TXT_DOMAIN );?>
						</option>
						<?php foreach ($booty_footer_bgs as $booty_footer_bg){ ?>
						<option value="<?php echo esc_attr($booty_footer_bg); ?>" <?php selected( $booty_selected, $booty_footer_bg);?>><?php echo esc_attr($booty_footer_bg); ?></option>
						<?php } ?>
				</select>
				<?php for ($c=3; $c<=4; $c++){ ?>
					<div class="booty_footer_center_<?php echo esc_attr($c) ?>column booty_footer_center_ct">
						<?php for ($i=1;$i<=$c;$i++){ ?>
						<div class="booty_footer_center_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>">
							<?php if(get_post_meta($post->ID, 'booty_footer_center_'.$c.'column_'.$i.'w', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_center_'.$c.'column_'.$i.'w', true);
								else $booty_selected='';
							?>
							 
							<select name="booty_footer_center_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>w">
								<?php for ($j=1;$j<13;$j++){ ?>
								<option value="<?php echo esc_attr($j) ?>" <?php selected( $booty_selected, $j);?>><?php echo esc_attr($j); echo ('&#47;12');?></option>
								<?php } ?>
							</select>
							<?php if(get_post_meta($post->ID, 'booty_footer_center_'.$c.'column_'.$i.'ct', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_center_'.$c.'column_'.$i.'ct', true);
								else $booty_selected='';
							?> 
							<select name="booty_footer_center_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>ct">
								<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
								 <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php selected( $booty_selected, ucwords( $sidebar['id'] ));?>>
										  <?php echo ucwords( $sidebar['name'] ); ?>
								 </option>
							<?php } ?>
							</select>
						</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="booty_footer_wrapper booty_footer_bottom_wrapper">
			<?php if(get_post_meta($post->ID, 'booty_footer_bottom_show', true))
				$booty_selected = get_post_meta($post->ID, 'booty_footer_bottom_show', true);
				else $booty_selected='';
			?> 
			<select name="booty_footer_bottom_show" class="booty_select_show">
				<option value="show" <?php selected( $booty_selected, 'show');?>><?php esc_html_e( 'Show', BOOTY_TXT_DOMAIN );?></option>
				<option value="hide" <?php selected( $booty_selected, 'hide');?>><?php esc_html_e( 'hide', BOOTY_TXT_DOMAIN );?></option>
			</select>
			<div class="booty_footer_bottom_column booty_select_show_ct">
				<?php if(get_post_meta($post->ID, 'booty_footer_bottom_column', true))
					$booty_selected = get_post_meta($post->ID, 'booty_footer_bottom_column', true);
					else $booty_selected='';
				?> 
				<select name="booty_footer_bottom_column">
					<option value="1column" <?php selected( $booty_selected, '1column');?>><?php esc_html_e( '1 Layout', BOOTY_TXT_DOMAIN );?></option>
					<option value="2column" <?php selected( $booty_selected, '2column');?>><?php esc_html_e( '2 Layout', BOOTY_TXT_DOMAIN );?></option> 
				</select>
				<select name="booty_footer_bottom_bg">
					<?php if(get_post_meta($post->ID, 'booty_footer_bottom_bg', true))
							$booty_selected = get_post_meta($post->ID, 'booty_footer_bottom_bg', true);
							else $booty_selected='';
						?>
						<option value="default" <?php selected( $booty_selected, 'default');?>>
							<?php esc_html_e( 'Background Default', BOOTY_TXT_DOMAIN );?>
						</option>
						<?php foreach ($booty_footer_bgs as $booty_footer_bg){ ?>
						<option value="<?php echo esc_attr($booty_footer_bg); ?>" <?php selected( $booty_selected, $booty_footer_bg);?>><?php echo esc_attr($booty_footer_bg); ?></option>
						<?php } ?>
				</select>
				<?php for ($c=1; $c<=2; $c++){ ?>
					<div class="booty_footer_bottom_<?php echo esc_attr($c)?>column booty_footer_bottom_ct">
						<?php for ($i=1;$i<=$c;$i++){ ?>
						<div class="booty_footer_bottom_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>">
							<?php if(get_post_meta($post->ID, 'booty_footer_bottom_'.$c.'column_'.$i.'w', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_bottom_'.$c.'column_'.$i.'w', true);
								else $booty_selected='';
							?>
							
							<select name="booty_footer_bottom_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>w">
								<?php for ($j=1;$j<13;$j++){ ?>
								<option value="<?php echo esc_attr($j) ?>" <?php selected( $booty_selected, $j);?>><?php echo esc_attr($j); echo '&#47;12';?></option>
								<?php } ?>
							</select>
							<?php if(get_post_meta($post->ID, 'booty_footer_bottom_'.$c.'column_'.$i.'ct', true))
								$booty_selected = get_post_meta($post->ID, 'booty_footer_bottom_'.$c.'column_'.$i.'ct', true);
								else $booty_selected='';
							?> 
							<select name="booty_footer_bottom_<?php echo esc_attr($c) ?>column_<?php echo esc_attr($i) ?>ct">
								<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
								 <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php selected( $booty_selected, ucwords( $sidebar['id'] ));?>>
										  <?php echo ucwords( $sidebar['name'] ); ?>
								 </option>
							<?php } ?>
							</select>
						</div>
						<?php } ?>
					</div>
				<?php } ?> 
			</div>
		</div>
	</div>
	<?php
}

function booty_save_page_meta_option($post_id) {
    $meta_box_default = booty_default_meta_data();
    $meta_box_header_footer = booty_header_footer_meta_data();
    $meta_box = array_merge($meta_box_default,$meta_box_header_footer); 
    return booty_save_meta_data($post_id, $meta_box);
}

function booty_add_page_metaboxes() {
    if (function_exists('add_meta_box')) {
        add_meta_box('view-meta-boxes', esc_html__('Layout Options', BOOTY_TXT_DOMAIN), 'booty_show_page_meta_option', 'page', 'side', 'low');
        add_meta_box('view-header-boxes', esc_html__('Header Options', BOOTY_TXT_DOMAIN), 'booty_show_page_header_footer_option', 'page', 'normal', 'low');
    }
}
function booty_meta_page_assets(){
	wp_enqueue_script( 'booty-metabox', get_template_directory_uri() . '/inc/functions/metaboxes/js/metabox.js', array( 'jquery' ), '1.0'); 
	wp_enqueue_script( 'booty-page-metabox', get_template_directory_uri() . '/inc/functions/metaboxes/js/page.metabox.js', array( 'jquery' ), '1.0'); 
	wp_enqueue_style("booty-page-metabox-style",get_template_directory_uri().'/inc/functions/metaboxes/css/metabox.css', array(), '1.0');
	
	if ( isset( $_GET['post_type'] ) || isset( $_GET['post'] )  ) {
		
		
		if ( !class_exists( 'Vc_Manager' ) ){
			wp_enqueue_script( 'booty-page-js2', get_template_directory_uri() . '/inc/functions/metaboxes/js/jquery-ui.min.js', array( 'jquery' ), '', true );
			wp_enqueue_script( 'booty-page-js3', get_template_directory_uri() . '/inc/functions/metaboxes/js/iris.min.js', array( 'jquery' ), '', true );
		}
	}
}
add_action('add_meta_boxes', 'booty_add_page_metaboxes');
add_action('save_post', 'booty_save_page_meta_option');
add_action('admin_enqueue_scripts', 'booty_meta_page_assets' );

