<?php 
global $booty_settings;
$config = $booty_settings;
?>

//SKIN
$main_color: #e74c3c;
$header_3_bg_image:url('');
$header_3_bg_color: #fff;
$header_3_bg_position:left top;
$header_3_bg_repeat: repeat;
$header_3_bg_size: inherit;
$header_3_bg_attachment: inherit;
$header_3_text_color: #2a2a2a;
$header_blog_bg_image:url('');
$header_blog_bg_color: #fff;
$header_blog_bg_position:left top;
$header_blog_bg_repeat: repeat;
$header_blog_bg_size: inherit;
$header_blog_bg_attachment: inherit;
$header_blog_text_color: #666; 
$header_creative_text_color: #222;
$header_creative_bg_nav_color: #fff;
$header_6_bg_color: #2a2a2a;
$header_6_text_color: #fff;
$header_7_bg_image: <?php echo 'url(' . get_template_directory_uri() . '/inc/admin/settings/images/pattren01.png'. ')'?>;
$header_7_bg_color: #222;
$header_7_bg_position: left top;
$header_7_bg_repeat: repeat;
$header_7_bg_size: inherit;
$header_7_bg_attachment:inherit;
$header_7_text_color: #ffffff;
$header_12_bg_image:url('');
$header_12_bg_color: #fff;
$header_12_bg_position:left top;
$header_12_bg_repeat: repeat;
$header_12_bg_size: inherit;
$header_12_bg_attachment: inherit;
$header_12_text_color: #666;
$header_13_option_top_bg_color : #F4F4F4; 
$header_13_option_top_color: #222222;
$header_13_option_center_bg_color: #fff;
$header_16_bg_image: <?php echo 'url(' . get_template_directory_uri() . '/inc/admin/settings/images/pattren01.png'. ')'?>;
$header_16_bg_color: #222;
$header_16_bg_position: left top;
$header_16_bg_repeat: repeat;
$header_16_bg_size: inherit;
$header_16_bg_attachment:inherit;
$header_16_text_color: #ffffff;
$header_17_bg_image:url('');
$header_17_bg_color: #fff;
$header_17_bg_position:left top;
$header_17_bg_repeat: repeat;
$header_17_bg_size: inherit;
$header_17_bg_attachment: inherit;
$header_17_text_color: #8f8f8f;
$header_19_text_color: #fff;
$header_19_bg_nav_color: #fff;
$header_19_bg_nav_opacity: 0.2;
$header_16_text_color: #ffffff;
$header_st7_bg_image:url('');
$header_st7_bg_color: #fff;
$header_st7_bg_position:left top;
$header_st7_bg_repeat: repeat;
$header_st7_bg_size: inherit;
$header_st7_bg_attachment: inherit;
$header_st7_text_color: #2a2a2a;
$header_st8_option_top_bg_image:url('');
$header_st8_option_top_bg_color: #2a2a2a;
$header_st8_option_top_bg_position:left top;
$header_st8_option_top_bg_repeat: repeat;
$header_st8_option_top_bg_size: inherit;
$header_st8_option_top_bg_attachment: inherit;
$header_st8_option_top_text_color: #fff;
$header_st8_bg_image:url('');
$header_st8_bg_color: #fff;
$header_st8_bg_position:left top;
$header_st8_bg_repeat: repeat;
$header_st8_bg_size: inherit;
$header_st8_bg_attachment: inherit;
$header_st8_text_color: #222;
$header_st13_text_color: #fff;
$header_st18_option_top_bg_image:url('');
$header_st18_option_top_bg_color: #f4f4f4;
$header_st18_option_top_bg_position:left top;
$header_st18_option_top_bg_repeat: repeat;
$header_st18_option_top_bg_size: inherit;
$header_st18_option_top_bg_attachment: inherit;
$header_st18_option_top_info_color: #222;
$header_st18_option_top_social_color: #ddd;
$header_st18_bg_image:url('');
$header_st18_bg_color: #fff;
$header_st18_bg_position:left top;
$header_st18_bg_repeat: repeat;
$header_st18_bg_size: inherit;
$header_st18_bg_attachment: inherit;
$header_st18_text_color: #222;
$header_st26_text_color: #fff;
<?php 
if(isset($config['main_color'])){
?>
$main_color: <?php echo $config['main_color'] ?>;
<?php 
}
?>
$font__primary: <?php
    if ( empty( $config['primary_font']['font-family'] ) ) {
        echo 'Georgia, Times New Roman, Times, serif';
    } else {
        echo esc_attr($config['primary_font']['font-family']);  
    }
?>;
$font__primary_color: <?php
    if ( empty( $config['primary_font']['color'] ) ) {
        echo '#8f8f8f';
    } else {
        echo esc_attr($config['primary_font']['color']);  
    }
?>;
$font__primary_weight: <?php
    if ( empty( $config['primary_font']['font-weight'] ) ) {
        echo '400';
    } else {
        echo esc_attr($config['primary_font']['font-weight']);
    }
?>;
$font__primary_size: <?php
    if ( empty( $config['primary_font']['font-size'] ) ) {
        echo '14px';
    } else {
        echo esc_attr($config['primary_font']['font-size']);
    }
?>;
$font__primary_line_height: <?php
    if ( empty( $config['primary_font']['line-height'] ) ) {
        echo '20px';
    } else {
        echo esc_attr($config['primary_font']['line-height']);
    }
?>;
$font__primary_backup: <?php
    if ( empty( $config['primary_font']['font-backup'] ) ) {
        echo '20px';
    } else {
        echo esc_attr($config['primary_font']['font-backup']);
    }
?>;
// Option header 3
	<?php if (isset($config['layout_3_option_bg']['background-image']) && $config['layout_3_option_bg']['background-image'] !=''): ?>
		$header_3_bg_image: <?php echo 'url(' . $config['layout_3_option_bg']['background-image'] . ')'?>;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_bg']['background-color']) && $config['layout_3_option_bg']['background-color'] !=''): ?>
		$header_3_bg_color: <?php echo $config['layout_3_option_bg']['background-color'] ?>;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_bg']['background-position']) && $config['layout_3_option_bg']['background-position'] !=''): ?> 
		$header_3_bg_position: <?php echo $config['layout_3_option_bg']['background-position']?>;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_bg']['background-repeat']) && $config['layout_3_option_bg']['background-repeat'] !=''): ?> 
		$header_3_bg_repeat: <?php echo $config['layout_3_option_bg']['background-repeat']?>;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_bg']['background-size']) && $config['layout_3_option_bg']['background-size'] !=''): ?> 
		$header_3_bg_size: <?php echo $config['layout_3_option_bg']['background-size']?>;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_bg']['background-attachment']) && $config['layout_3_option_bg']['background-attachment'] !=''): ?> 
		$header_3_bg_attachment: <?php echo $config['layout_3_option_bg']['background-attachment']?> ;
	<?php endif;?>
	<?php if (isset($config['layout_3_option_color']) && $config['layout_3_option_color'] !=''): ?> 
		$header_3_text_color: <?php echo $config['layout_3_option_color']?> ;
	<?php endif;?>
// Option header blog
	<?php if (isset($config['layout_blog_option_bg']['background-image']) && $config['layout_blog_option_bg']['background-image'] !=''): ?>
		$header_blog_bg_image: <?php echo 'url(' . $config['layout_blog_option_bg']['background-image'] . ')'?>;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_bg']['background-color']) && $config['layout_blog_option_bg']['background-color'] !=''): ?>
		$header_blog_bg_color: <?php echo $config['layout_blog_option_bg']['background-color'] ?>;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_bg']['background-position']) && $config['layout_blog_option_bg']['background-position'] !=''): ?> 
		$header_blog_bg_position: <?php echo $config['layout_blog_option_bg']['background-position']?>;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_bg']['background-repeat']) && $config['layout_blog_option_bg']['background-repeat'] !=''): ?> 
		$header_blog_bg_repeat: <?php echo $config['layout_blog_option_bg']['background-repeat']?>;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_bg']['background-size']) && $config['layout_blog_option_bg']['background-size'] !=''): ?> 
		$header_blog_bg_size: <?php echo $config['layout_blog_option_bg']['background-size']?>;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_bg']['background-attachment']) && $config['layout_blog_option_bg']['background-attachment'] !=''): ?> 
		$header_blog_bg_attachment: <?php echo $config['layout_blog_option_bg']['background-attachment']?> ;
	<?php endif;?>
	<?php if (isset($config['layout_blog_option_color']) && $config['layout_blog_option_color'] !=''): ?> 
		$header_blog_text_color: <?php echo $config['layout_blog_option_color']?> ;
	<?php endif;?>
// Option header creative
	<?php if (isset($config['layout_creative_option_bg']['rgba']) && $config['layout_creative_option_bg']['rgba'] !=''): ?>
		$header_creative_bg_nav_color: <?php echo $config['layout_creative_option_bg']['rgba'] ?>;
	<?php endif;?> 
	<?php if (isset($config['layout_creative_option_color']) && $config['layout_creative_option_color'] !=''): ?> 
		$header_creative_text_color: <?php echo $config['layout_creative_option_color'] ?>;
	<?php endif;?>
// Option header 6
<?php if($config['header_layout'] =='header_layout_6'):?>
	<?php if (isset($config['layout_6_option_bg']['rgba']) && $config['layout_6_option_bg']['rgba'] !='') ?>
		$header_6_bg_color: <?php echo $config['layout_6_option_bg']['rgba'] ?>;
	<?php if (isset($config['layout_6_option_color']) && $config['layout_6_option_color'] !='') ?> 
		$header_6_text_color: <?php echo $config['layout_6_option_color'] ?>;
<?php endif;?>
// Option header 7
	<?php if (isset($config['layout_7_option_bg']['background-image']) && $config['layout_7_option_bg']['background-image'] !=''): ?>
		$header_7_bg_image: <?php echo 'url(' . $config['layout_7_option_bg']['background-image'] . ')'?>;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_bg']['background-color']) && $config['layout_7_option_bg']['background-color'] !=''): ?>
		$header_7_bg_color: <?php echo $config['layout_7_option_bg']['background-color'] ?>;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_bg']['background-position']) && $config['layout_7_option_bg']['background-position'] !=''): ?> 
		$header_7_bg_position: <?php echo $config['layout_7_option_bg']['background-position']?>;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_bg']['background-repeat']) && $config['layout_7_option_bg']['background-repeat'] !=''): ?> 
		$header_7_bg_repeat: <?php echo $config['layout_7_option_bg']['background-repeat']?>;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_bg']['background-size']) && $config['layout_7_option_bg']['background-size'] !=''): ?> 
		$header_7_bg_size: <?php echo $config['layout_7_option_bg']['background-size']?>;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_bg']['background-attachment']) && $config['layout_7_option_bg']['background-attachment'] !=''): ?> 
		$header_7_bg_attachment: <?php echo $config['layout_7_option_bg']['background-attachment']?> ;
	<?php endif;?>
	<?php if (isset($config['layout_7_option_color']) && $config['layout_7_option_color'] !=''): ?> 
		$header_7_text_color: <?php echo $config['layout_7_option_color']?> ;
	<?php endif;?>
// Option header 12
	<?php if (isset($config['layout_12_option_bg']['background-image']) && $config['layout_12_option_bg']['background-image'] !=''): ?>
		$header_12_bg_image: <?php echo 'url(' . $config['layout_12_option_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_12_option_bg']['background-color']) && $config['layout_12_option_bg']['background-color'] !=''): ?>
		$header_12_bg_color: <?php echo $config['layout_12_option_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_12_option_bg']['background-position']) && $config['layout_12_option_bg']['background-position'] !=''): ?>
		$header_12_bg_position: <?php echo  $config['layout_12_option_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_12_option_bg']['background-repeat']) && $config['layout_12_option_bg']['background-repeat'] !=''): ?>
		$header_12_bg_repeat: <?php echo $config['layout_12_option_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_12_option_bg']['background-size']) && $config['layout_12_option_bg']['background-size'] !=''): ?>
		$header_12_bg_size: <?php echo  $config['layout_12_option_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_12_option_bg']['background-attachment']) && $config['layout_12_option_bg']['background-attachment'] !=''): ?>
		$header_12_bg_attachment: <?php echo $config['layout_12_option_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_12_option_color']) && $config['layout_12_option_color'] !=''): ?>
		$header_12_text_color: <?php echo $config['layout_12_option_color'] ?>; 
	<?php endif;?>
// Option header 13
	<?php if (isset($config['layout_13_option_top_bg']['background-color']) && $config['layout_13_option_top_bg']['background-color'] !=''): ?> 
		$header_13_option_top_bg_color : <?php echo $config['layout_13_option_top_bg']['background-color']?>; 
	<?php endif;?>
	<?php if (isset($config['layout_13_option_top_color']) && $config['layout_13_option_top_color'] !=''): ?> 
		$header_13_option_top_color : <?php echo $config['layout_13_option_top_color']?>;
	<?php endif;?>
	<?php if (isset($config['layout_13_option_center_bg']['background-color']) && $config['layout_13_option_center_bg']['background-color'] !=''): ?> 
		$header_13_option_center_bg_color : <?php echo $config['layout_13_option_center_bg']['background-color'] ?>;
	<?php endif;?>
// Option header 16
	$header_16_bg_image: <?php echo 'url(' . $config['layout_16_option_bg']['background-image'] . ')'?>;
	<?php if (isset($config['layout_16_option_bg']['background-color']) && $config['layout_16_option_bg']['background-color'] !=''):?>
		$header_16_bg_color: <?php echo $config['layout_16_option_bg']['background-color'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_16_option_bg']['background-position']) && $config['layout_16_option_bg']['background-position'] !='')?>
		$header_16_bg_position: <?php echo $config['layout_16_option_bg']['background-position']?>;
	<?php if (isset($config['layout_16_option_bg']['background-repeat']) && $config['layout_16_option_bg']['background-repeat'] !='')?>
		$header_16_bg_repeat: <?php echo $config['layout_16_option_bg']['background-repeat']?>;
	<?php if (isset($config['layout_16_option_bg']['background-size']) && $config['layout_16_option_bg']['background-size'] !='')?>
		$header_16_bg_size: <?php echo $config['layout_16_option_bg']['background-size']?>;
	<?php if (isset($config['layout_16_option_bg']['background-attachment']) && $config['layout_16_option_bg']['background-attachment'] !='')?>
		$header_16_bg_attachment: <?php echo $config['layout_16_option_bg']['background-attachment']?> ;
	<?php if (isset($config['layout_16_option_color']) && $config['layout_16_option_color'] !='')?>
		$header_16_text_color: <?php echo $config['layout_16_option_color']?> ; 
// Option header 17 
	<?php if (isset($config['layout_17_option_bg']['background-image']) && $config['layout_17_option_bg']['background-image'] !=''): ?>
		$header_17_bg_image: <?php echo 'url(' . $config['layout_17_option_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_17_option_bg']['background-color']) && $config['layout_17_option_bg']['background-color'] !=''): ?>
		$header_17_bg_color: <?php echo $config['layout_17_option_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_17_option_bg']['background-position']) && $config['layout_17_option_bg']['background-position'] !=''): ?>
		$header_17_bg_position: <?php echo  $config['layout_17_option_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_17_option_bg']['background-repeat']) && $config['layout_17_option_bg']['background-repeat'] !=''): ?>
		$header_17_bg_repeat: <?php echo $config['layout_17_option_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_17_option_bg']['background-size']) && $config['layout_17_option_bg']['background-size'] !=''): ?>
		$header_17_bg_size: <?php echo  $config['layout_17_option_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_17_option_bg']['background-attachment']) && $config['layout_17_option_bg']['background-attachment'] !=''): ?>
		$header_17_bg_attachment: <?php echo $config['layout_17_option_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_17_option_color']) && $config['layout_17_option_color'] !='') ?>
		$header_17_text_color: <?php echo $config['layout_17_option_color'] ?>;  
// Option header 19 
	<?php if (isset($config['layout_19_option_nav_bg']['color']) && $config['layout_19_option_nav_bg']['color'] !=''): ?>
		$header_19_bg_nav_color: <?php echo $config['layout_19_option_nav_bg']['color'] ?>;
	<?php endif;?>
	<?php if (isset($config['layout_19_option_nav_bg']['alpha']) && $config['layout_19_option_nav_bg']['alpha'] !=''): ?>
		$header_19_bg_nav_opacity: <?php echo $config['layout_19_option_nav_bg']['alpha'] ?>;
	<?php endif;?>
	<?php if (isset($config['layout_19_option_color']) && $config['layout_19_option_color'] !=''): ?> 
		$header_19_text_color: <?php echo $config['layout_19_option_color'] ?>;
	<?php endif;?> 
// Option header st7 
	<?php if (isset($config['layout_st7_option_bg']['background-image']) && $config['layout_st7_option_bg']['background-image'] !=''): ?>
		$header_st7_bg_image: <?php echo 'url(' . $config['layout_st7_option_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st7_option_bg']['background-color']) && $config['layout_st7_option_bg']['background-color'] !=''): ?>
		$header_st7_bg_color: <?php echo $config['layout_st7_option_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_st7_option_bg']['background-position']) && $config['layout_st7_option_bg']['background-position'] !=''): ?>
		$header_st7_bg_position: <?php echo  $config['layout_st7_option_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st7_option_bg']['background-repeat']) && $config['layout_st7_option_bg']['background-repeat'] !=''): ?>
		$header_st7_bg_repeat: <?php echo $config['layout_st7_option_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st7_option_bg']['background-size']) && $config['layout_st7_option_bg']['background-size'] !=''): ?>
		$header_st7_bg_size: <?php echo  $config['layout_st7_option_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st7_option_bg']['background-attachment']) && $config['layout_st7_option_bg']['background-attachment'] !=''): ?>
		$header_st7_bg_attachment: <?php echo $config['layout_st7_option_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st7_option_color']) && $config['layout_st7_option_color'] !='') ?>
		$header_st7_text_color: <?php echo $config['layout_st7_option_color'] ?>;  
// Option header st8 
	<?php if (isset($config['layout_st8_option_top_bg']['background-image']) && $config['layout_st8_option_top_bg']['background-image'] !=''): ?>
		$header_st8_option_top_bg_image: <?php echo 'url(' . $config['layout_st8_option_top_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_top_bg']['background-color']) && $config['layout_st8_option_top_bg']['background-color'] !=''): ?>
		$header_st8_option_top_bg_color: <?php echo $config['layout_st8_option_top_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_st8_option_top_bg']['background-position']) && $config['layout_st8_option_top_bg']['background-position'] !=''): ?>
		$header_st8_option_top_bg_position: <?php echo  $config['layout_st8_option_top_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_top_bg']['background-repeat']) && $config['layout_st8_option_top_bg']['background-repeat'] !=''): ?>
		$header_st8_option_top_bg_repeat: <?php echo $config['layout_st8_option_top_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_top_bg']['background-size']) && $config['layout_st8_option_top_bg']['background-size'] !=''): ?>
		$header_st8_option_top_bg_size: <?php echo  $config['layout_st8_option_top_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_top_bg']['background-attachment']) && $config['layout_st8_option_top_bg']['background-attachment'] !=''): ?>
		$header_st8_option_top_bg_attachment: <?php echo $config['layout_st8_option_top_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_top_color']) && $config['layout_st8_option_top_color'] !=''): ?>
		$header_st8_option_top_text_color: <?php echo $config['layout_st8_option_top_color'] ?>;
	<?php endif;?>
		
	<?php if (isset($config['layout_st8_option_bg']['background-image']) && $config['layout_st8_option_bg']['background-image'] !=''): ?>
		$header_st8_bg_image: <?php echo 'url(' . $config['layout_st8_option_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_bg']['background-color']) && $config['layout_st8_option_bg']['background-color'] !=''): ?>
		$header_st8_bg_color: <?php echo $config['layout_st8_option_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_st8_option_bg']['background-position']) && $config['layout_st8_option_bg']['background-position'] !=''): ?>
		$header_st8_bg_position: <?php echo  $config['layout_st8_option_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_bg']['background-repeat']) && $config['layout_st8_option_bg']['background-repeat'] !=''): ?>
		$header_st8_bg_repeat: <?php echo $config['layout_st8_option_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_bg']['background-size']) && $config['layout_st8_option_bg']['background-size'] !=''): ?>
		$header_st8_bg_size: <?php echo  $config['layout_st8_option_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_bg']['background-attachment']) && $config['layout_st8_option_bg']['background-attachment'] !=''): ?>
		$header_st8_bg_attachment: <?php echo $config['layout_st8_option_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st8_option_color']) && $config['layout_st8_option_color'] !='') ?>
		$header_st8_text_color: <?php echo $config['layout_st8_option_color'] ?>; 
// Option header st13 
	<?php if (isset($config['layout_st13_option_color']) && $config['layout_st13_option_color'] !=''): ?> 
		$header_st13_text_color: <?php echo $config['layout_st13_option_color'] ?>;
	<?php endif;?> 
// Option header st18 
	<?php if (isset($config['layout_st18_option_top_bg']['background-image']) && $config['layout_st18_option_top_bg']['background-image'] !=''): ?>
		$header_st18_option_top_bg_image: <?php echo 'url(' . $config['layout_st18_option_top_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_bg']['background-color']) && $config['layout_st18_option_top_bg']['background-color'] !=''): ?>
		$header_st18_option_top_bg_color: <?php echo $config['layout_st18_option_top_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_st18_option_top_bg']['background-position']) && $config['layout_st18_option_top_bg']['background-position'] !=''): ?>
		$header_st18_option_top_bg_position: <?php echo  $config['layout_st18_option_top_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_bg']['background-repeat']) && $config['layout_st18_option_top_bg']['background-repeat'] !=''): ?>
		$header_st18_option_top_bg_repeat: <?php echo $config['layout_st18_option_top_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_bg']['background-size']) && $config['layout_st18_option_top_bg']['background-size'] !=''): ?>
		$header_st18_option_top_bg_size: <?php echo  $config['layout_st18_option_top_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_bg']['background-attachment']) && $config['layout_st18_option_top_bg']['background-attachment'] !=''): ?>
		$header_st18_option_top_bg_attachment: <?php echo $config['layout_st18_option_top_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_info_color']) && $config['layout_st18_option_top_info_color'] !=''): ?>
		$header_st18_option_top_info_color: <?php echo $config['layout_st18_option_top_info_color'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_top_social_color']) && $config['layout_st18_option_top_social_color'] !=''): ?>
		$header_st18_option_top_social_color: <?php echo $config['layout_st18_option_top_social_color'] ?>; 
	<?php endif;?>
		
	<?php if (isset($config['layout_st18_option_bg']['background-image']) && $config['layout_st18_option_bg']['background-image'] !=''): ?>
		$header_st18_bg_image: <?php echo 'url(' . $config['layout_st18_option_bg']['background-image'] . ')'?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_bg']['background-color']) && $config['layout_st18_option_bg']['background-color'] !=''): ?>
		$header_st18_bg_color: <?php echo $config['layout_st18_option_bg']['background-color'] ?>; 
	<?php endif;?>	
	<?php if (isset($config['layout_st18_option_bg']['background-position']) && $config['layout_st18_option_bg']['background-position'] !=''): ?>
		$header_st18_bg_position: <?php echo  $config['layout_st18_option_bg']['background-position'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_bg']['background-repeat']) && $config['layout_st18_option_bg']['background-repeat'] !=''): ?>
		$header_st18_bg_repeat: <?php echo $config['layout_st18_option_bg']['background-repeat'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_bg']['background-size']) && $config['layout_st18_option_bg']['background-size'] !=''): ?>
		$header_st18_bg_size: <?php echo  $config['layout_st18_option_bg']['background-size'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_bg']['background-attachment']) && $config['layout_st18_option_bg']['background-attachment'] !=''): ?>
		$header_st18_bg_attachment: <?php echo $config['layout_st18_option_bg']['background-attachment'] ?>; 
	<?php endif;?>
	<?php if (isset($config['layout_st18_option_color']) && $config['layout_st18_option_color'] !='') ?>
		$header_st18_text_color: <?php echo $config['layout_st18_option_color'] ?>; 
// Option header st26 
	<?php if (isset($config['layout_st26_option_color']) && $config['layout_st26_option_color'] !=''): ?> 
		$header_st26_text_color: <?php echo $config['layout_st26_option_color'] ?>;
	<?php endif;?> 