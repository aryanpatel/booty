<?php

function booty_header_footer_meta_data() { 
	return array( 
		'header' => array(
			'name' => 'header_layout', 
		),
		'header_option' => array(
			'name' => 'header_option', 
		),
		'header_bg_color' => array(
			'name' => 'header_bg_color', 
		),
		'header_text_color' => array(
			'name' => 'header_text_color', 
		),
		'header11_logo_light' => array(
			'name' => 'header11_logo_light', 
		),
		'header11_logo_dark' => array(
			'name' => 'header11_logo_dark', 
		),
		'header_option20' => array(
			'name' => 'header_option20', 
		),
		'header20_logo_light' => array(
			'name' => 'header20_logo_light', 
		),
		'header20_logo_dark' => array(
			'name' => 'header20_logo_dark', 
		),
		'header20_menu_bar' => array(
			'name' => 'header20_menu_bar', 
		),
		'footer' => array(
			'name' => 'footer_layout', 
		), 
		'booty_footer_style' => array(
			'name' => 'booty_footer_style', 
		), 
		'booty_footer_reverse' => array(
			'name' => 'booty_footer_reverse', 
		),
		'booty_footer_parallax' => array(
			'name' => 'booty_footer_parallax', 
		),
		//footer top
		'booty_footer_top_show' => array(
			'name' => 'booty_footer_top_show', 
		), 
		'booty_footer_top_bg' => array(
			'name' => 'booty_footer_top_bg', 
		),
		'booty_footer_top_column' => array(
			'name' => 'booty_footer_top_column', 
		),
		'booty_footer_top_1column_1w' => array(
			'name' => 'booty_footer_top_1column_1w', 
		),
		'booty_footer_top_1column_1ct' => array(
			'name' => 'booty_footer_top_1column_1ct', 
		),
		'booty_footer_top_2column_1w' => array(
			'name' => 'booty_footer_top_2column_1w', 
		),
		'booty_footer_top_2column_1ct' => array(
			'name' => 'booty_footer_top_2column_1ct', 
		),
		'booty_footer_top_2column_2w' => array(
			'name' => 'booty_footer_top_2column_2w', 
		),
		'booty_footer_top_2column_2ct' => array(
			'name' => 'booty_footer_top_2column_2ct', 
		),
		//footer center
		'booty_footer_center_show' => array(
			'name' => 'booty_footer_center_show', 
		),
		'booty_footer_center_bg' => array(
			'name' => 'booty_footer_center_bg', 
		),
		'booty_footer_center_column' => array(
			'name' => 'booty_footer_center_column', 
		),
		'booty_footer_center_3column_1w' => array(
			'name' => 'booty_footer_center_3column_1w', 
		),
		'booty_footer_center_3column_1ct' => array(
			'name' => 'booty_footer_center_3column_1ct', 
		),
		'booty_footer_center_3column_2w' => array(
			'name' => 'booty_footer_center_3column_2w', 
		),
		'booty_footer_center_3column_2ct' => array(
			'name' => 'booty_footer_center_3column_2ct', 
		),
		'booty_footer_center_3column_3w' => array(
			'name' => 'booty_footer_center_3column_3w', 
		),
		'booty_footer_center_3column_3ct' => array(
			'name' => 'booty_footer_center_3column_3ct', 
		),
		'booty_footer_center_4column_1w' => array(
			'name' => 'booty_footer_center_4column_1w', 
		),
		'booty_footer_center_4column_1ct' => array(
			'name' => 'booty_footer_center_4column_1ct', 
		),
		'booty_footer_center_4column_2w' => array(
			'name' => 'booty_footer_center_4column_2w', 
		),
		'booty_footer_center_4column_2ct' => array(
			'name' => 'booty_footer_center_4column_2ct', 
		),
		'booty_footer_center_4column_3w' => array(
			'name' => 'booty_footer_center_4column_3w', 
		),
		'booty_footer_center_4column_3ct' => array(
			'name' => 'booty_footer_center_4column_3ct', 
		),
		'booty_footer_center_4column_4w' => array(
			'name' => 'booty_footer_center_4column_4w', 
		),
		'booty_footer_center_4column_4ct' => array(
			'name' => 'booty_footer_center_4column_4ct', 
		),
		//footer bottom
		
		'booty_footer_bottom_show' => array(
			'name' => 'booty_footer_bottom_show', 
		),
		'booty_footer_bottom_bg' => array(
			'name' => 'booty_footer_bottom_bg', 
		),
		'booty_footer_bottom_column' => array(
			'name' => 'booty_footer_bottom_column', 
		),
		'booty_footer_bottom_1column_1w' => array(
			'name' => 'booty_footer_bottom_1column_1w', 
		),
		'booty_footer_bottom_1column_1ct' => array(
			'name' => 'booty_footer_bottom_1column_1ct', 
		),
		'booty_footer_bottom_2column_1w' => array(
			'name' => 'booty_footer_bottom_2column_1w', 
		),
		'booty_footer_bottom_2column_1ct' => array(
			'name' => 'booty_footer_bottom_2column_1ct', 
		),
		'booty_footer_bottom_2column_2w' => array(
			'name' => 'booty_footer_bottom_2column_2w', 
		),
		'booty_footer_bottom_2column_2ct' => array(
			'name' => 'booty_footer_bottom_2column_2ct', 
		),
	);
}
function booty_default_meta_data() {
    $booty_layout = booty_layouts();
    $booty_sidebar_position = booty_sidebar_position();
    $booty_sidebars = booty_sidebars(); 
    $booty_skin = array('awesome', 'bleu-de-france', 'bleu-de-france2', 'chateau-green', 'dark-pastel-red', 'di-serria', 'light-green', 'light-taupe', 'my-sin', 'niagara', 'orange', 'pastel-orange', 'pastel-red', 'pastel-red2', 'rich-electric-blue', 'rodeo-dust', 'sun', 'sunglo', 'twine', 'ucla-gold', 'yellow', 'zest'); 
	$booty_menu = array();
	$booty_menu['default']= 'Default';
	if(get_terms( 'nav_menu', array( 'hide_empty' => true ) )):
		$menus =  get_terms('nav_menu');
		foreach ( $menus as $menu ) {
			$booty_menu[$menu -> slug]= $menu -> name;
		}
	endif;
    return array(
		'special_skin' => array(
            'name' => 'special_skin',
            'title' => esc_html__('Special Skin', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Select Skin for this page', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ), 
       'skin' => array(
            'name' => 'skin',
            'title' => esc_html__('Skin', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Select Skin', BOOTY_TXT_DOMAIN),
            'type' => 'skin',
			'default'=> 'awesome',
			'options'=> $booty_skin
        ),
       'dark_theme' => array(
            'name' => 'dark_theme',
            'title' => esc_html__('Dark Theme', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Dark Theme', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ), 
       'show_header' => array(
            'name' => 'hide_header',
            'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Hide header', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ), 
        'show_footer' => array(
            'name' => 'hide_footer',
            'title' => esc_html__('Footer', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Hide footer', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ),
        'show_banner' => array(
            'name' => 'hide_banner',
            'title' => esc_html__('Banner', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Hide Banner Default, not hide banner you create in content', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ),
        'header_fixed' => array(
            'name' => 'header_fixed',
            'title' => esc_html__('Header fixed', BOOTY_TXT_DOMAIN),
			'desc' => esc_html__('Header fixed when scroll', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ),
        'header_over' => array(
            'name' => 'header_over',
            'title' => esc_html__('Header over content', BOOTY_TXT_DOMAIN),
			'desc' => esc_html__('Header over content', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ),
		
       'header_menu' => array(
            'name' => 'header_menu',
            'title' => esc_html__('Header Menu', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('Select Menu show in header', BOOTY_TXT_DOMAIN),
            'type' => 'select',
			'options' => $booty_menu,
            'default' => 'default',
        ), 
        'no_padding' => array(
            'name' => 'no_padding',
            'title' => esc_html__('No Padding', BOOTY_TXT_DOMAIN),
            'desc' => esc_html__('No Padding default', BOOTY_TXT_DOMAIN),
            'type' => 'checkbox'
        ),
        //sidebar position
        'layout' => array(
            'name' => 'layout',
            'type' => 'select',
            'title' => esc_html__('Layout', BOOTY_TXT_DOMAIN),
            'options' => array('default'=> 'Default','wide'=> 'Wide','fullwidth'=> 'Full width'),
            'default' => 'default'
        ),
        //sidebar position
        'sidebar_position' => array(
            'name' => 'sidebar_position',
            'type' => 'select',
            'title' => esc_html__('Sidebar Position', BOOTY_TXT_DOMAIN),
            'options' => $booty_sidebar_position,
            'default' => 'default'
        ),
        //sidebar
        'sidebarleft' => array(
            'name' => 'sidebarleft',
            'type' => 'select',
            'title' => esc_html__('Sidebar Left', BOOTY_TXT_DOMAIN),
            'options' => $booty_sidebars,
            'default' => 'default'
        ),
        'sidebarright' => array(
            'name' => 'sidebarright',
            'type' => 'select',
            'title' => esc_html__('Sidebar Right', BOOTY_TXT_DOMAIN),
            'options' => $booty_sidebars,
            'default' => 'default'
        ),
    );
}

