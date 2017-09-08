<?php
if (!class_exists('ReduxFramwork') && file_exists(BOOTY_ADMIN . '/ReduxCore/fromwork.php')) {
    require_once BOOTY_ADMIN . '/ReduxCore/framwork.php';
}

require_once( BOOTY_ADMIN . '/settings/settings.php' );
require_once( BOOTY_ADMIN . '/settings/save_settings.php' );
//disable redux message
if ( class_exists('ReduxFramework') && ! function_exists( 'fekra_redux_disable_dev_mode_plugin' ) ) {
	function fekra_redux_disable_dev_mode_plugin( $redux ) {
		if ( $redux->args['opt_name'] != 'redux_demo' ) {
			$redux->args['dev_mode'] = false;
			$redux->args['forced_dev_mode_off'] = false;
		}
	}

	add_action( 'redux/construct', 'fekra_redux_disable_dev_mode_plugin' );
}
//get theme demo options
function booty_theme_types() {
    return array(
        'agency' => esc_html__("Demo Home agency", BOOTY_TXT_DOMAIN),
        'architecture' => esc_html__("Demo Home architecture", BOOTY_TXT_DOMAIN),
        'app-landing' => esc_html__("Demo Home app-landing", BOOTY_TXT_DOMAIN),
        'blog' => esc_html__("Demo Home blog", BOOTY_TXT_DOMAIN),
        'business' => esc_html__("Demo Home business", BOOTY_TXT_DOMAIN),
        'construction' => esc_html__("Demo Home construction", BOOTY_TXT_DOMAIN),
        'corporate' => esc_html__("Demo Home corporate", BOOTY_TXT_DOMAIN),
        'creative' => esc_html__("Demo Home creative", BOOTY_TXT_DOMAIN),
        'decoration' => esc_html__("Demo Home decoration", BOOTY_TXT_DOMAIN),
        'education' => esc_html__("Demo Home education", BOOTY_TXT_DOMAIN),
        'finace' => esc_html__("Demo Home finace", BOOTY_TXT_DOMAIN),
        'logistics' => esc_html__("Demo Home logistics", BOOTY_TXT_DOMAIN),
        'minimal' => esc_html__("Demo Home minimal", BOOTY_TXT_DOMAIN),
        'personal' => esc_html__("Demo Home personal", BOOTY_TXT_DOMAIN),
        'onepage-business' => esc_html__("Demo Home onepage-business", BOOTY_TXT_DOMAIN),
        'onepage-construction' => esc_html__("Demo Home onepage-construction", BOOTY_TXT_DOMAIN),
        'onepage-creatiave' => esc_html__("Demo Home onepage-creatiave", BOOTY_TXT_DOMAIN),
        'onepage-default' => esc_html__("Demo Home onepage-onepage-creatiave", BOOTY_TXT_DOMAIN),
        'onepage-freelancer' => esc_html__("Demo Home onepage-freelancer", BOOTY_TXT_DOMAIN),
        'onepage-persion' => esc_html__("Demo Home onepage-persion", BOOTY_TXT_DOMAIN),
        'onepage-plumber' => esc_html__("Demo Home onepage-plumber", BOOTY_TXT_DOMAIN),
    );
}

//get theme layout options
function booty_layouts() {
    return array(
        'default' => esc_html__('Default Layout', BOOTY_TXT_DOMAIN),
        'boxed' => esc_html__('Boxed', BOOTY_TXT_DOMAIN),
        'fullwidth' => esc_html__('Full width', BOOTY_TXT_DOMAIN)
    );
}

//get theme sidebar position options
function booty_sidebar_position() {
    return array(
        'default' => esc_html__('Default Position', BOOTY_TXT_DOMAIN),
        'left-sidebar' => esc_html__('Left', BOOTY_TXT_DOMAIN),
        'right-sidebar' => esc_html__('Right', BOOTY_TXT_DOMAIN),
        'none' => esc_html__('None', BOOTY_TXT_DOMAIN)
    );
}

function booty_pre_loader() {
    $config = booty_settings();
    if ($config['preload'] && $config['preload'] == 'enable') {
        ob_start();
        ?>
        <div id="pre-loader">
            <div class="loader-holder">
                <div class="frame">
                    <img src="<?php echo $config['logo_image']['url'] ?>" alt="Booty"/>
                    <div class="spinner7">
                        <div class="circ1"></div>
                        <div class="circ2"></div>
                        <div class="circ3"></div>
                        <div class="circ4"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    } else {
        return;
    }
}

function booty_header_banner() {
    $config = booty_settings();
    ob_start();
    ?>
    <section class="personal-banner">
        <div class="stretch">
            <img src="<?php echo $config['layout_6_option_banner']['url'] ?>" alt="image description">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="win-height text-box">
                        <div class="box">
    <?php echo $config['layout_6_option_banner_box'] ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function booty_header_social($layout, $type) {
    $config = booty_settings();
    ob_start();
    if ($type == '2') {
        $type = 'opener-icons';
    } else {
        $type = '';
    }
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_facebook']) && $config['' . $layout . '_option_top_show_facebook'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_facebook_link'] . '" class="' . $type . '"><i class="fa fa-facebook"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_twitter']) && $config['' . $layout . '_option_top_show_twitter'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_twitter_link'] . '" class="' . $type . '"><i class="fa fa-twitter"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_google_plus']) && $config['' . $layout . '_option_top_show_google_plus'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_googleplus_link'] . '" class="' . $type . '"><i class="fa fa-google-plus"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_pinterest']) && $config['' . $layout . '_option_top_show_pinterest'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_pinterest_link'] . '" class="' . $type . '"><i class="fa fa-pinterest"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_instagram']) && $config['' . $layout . '_option_top_show_instagram'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_instagram_link'] . '" class="' . $type . '"><i class="fa fa-instagram"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_dribbble']) && $config['' . $layout . '_option_top_show_dribbble'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_dribbble_link'] . '" class="' . $type . '"><i class="fa fa-dribbble"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_skype']) && $config['' . $layout . '_option_top_show_skype'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_skype_link'] . '" class="' . $type . '"><i class="fa fa-skype"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_flickr']) && $config['' . $layout . '_option_top_show_flickr'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_flickr_link'] . '" class="' . $type . '"><i class="fa fa-flickr"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_youtube']) && $config['' . $layout . '_option_top_show_youtube'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_youtube_link'] . '" class="' . $type . '"><i class="fa fa-youtube"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_linkedin']) && $config['' . $layout . '_option_top_show_linkedin'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_linkedin_link'] . '" class="' . $type . '"><i class="fa fa-linkedin"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_behance']) && $config['' . $layout . '_option_top_show_behance'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_behance_link'] . '" class="' . $type . '"><i class="fa fa-behance"></i></a></li>';
    endif;
    ?>
    <?php if (isset($config['' . $layout . '_option_top_show_apple']) && $config['' . $layout . '_option_top_show_apple'] == 'show'): echo '<li><a target="_blank" href="' . $config['social_apple_link'] . '" class="' . $type . '"><i class="fa fa-apple"></i></a></li>';
    endif;
    ?>
    <?php
    return ob_get_clean();
}

function booty_header_types() {
    $post = booty_post();
    $config = booty_settings();
    ob_start();
    $booty_header_show = 'show_header';
    $header_layouts = array('header_layout_1', 'header_layout_2', 'header_layout_3', 'header_layout_6', 'header_layout_7', 'header_layout_12', 'header_layout_13', 'header_layout_16', 'header_layout_17', 'header_layout_19', 'header_layout_blog', 'header_layout_creative', 'header_layout_st3', 'header_layout_st7', 'header_layout_st8', 'header_layout_st13', 'header_layout_st18', 'header_layout_st26', 'header_layout_finance', 'header_layout_decoration', 'header_layout_architecture');
    $booty_header_layout = '';
    if (isset($header_layouts[$config['header_layout_selected']]))
        $booty_header_layout = $header_layouts[$config['header_layout_selected']];
    if (is_page()) {
        $booty_id = $post->ID;
    } elseif (function_exists('is_shop') && is_shop()) {
        $booty_id = get_option('woocommerce_shop_page_id');
    } else {
        $booty_id = -1;
    }
    if (get_post_meta($booty_id, 'hide_header', true)) {
        $booty_header_show = get_post_meta($booty_id, 'hide_header', true);
    }
    if (get_post_meta($booty_id, 'header_layout', true) && get_post_meta($booty_id, 'header_layout', true) != 'default') {
        $booty_header_layout = get_post_meta($booty_id, 'header_layout', true);
    }
    if ((function_exists('is_product') || function_exists('is_product_tag') || function_exists('is_product_category')) && (is_product() || is_product_tag() || is_product_category())) {
        $booty_header_layout = 'header_layout_1';
    }
    if ($booty_header_show == 'show_header') {
        switch ($booty_header_layout) {
            case 'header_layout_1':
                get_template_part('inc/template-parts/headers/header-1');
                break;
            case 'header_layout_2':
                get_template_part('inc/template-parts/headers/header-2');
                break;
            case 'header_layout_3':
                get_template_part('inc/template-parts/headers/header-3');
                break;
            case 'header_layout_4':
                get_template_part('inc/template-parts/headers/header-4');
                break;
            case 'header_layout_5':
                get_template_part('inc/template-parts/headers/header-5');
                break;
            case 'header_layout_6':
                get_template_part('inc/template-parts/headers/header-6');
                break;
            case 'header_layout_7':
                get_template_part('inc/template-parts/headers/header-7');
                break;
            case 'header_layout_8':
                get_template_part('inc/template-parts/headers/header-8');
                break;
            case 'header_layout_9':
                get_template_part('inc/template-parts/headers/header-9');
                break;
            case 'header_layout_10':
                get_template_part('inc/template-parts/headers/header-10');
                break;
            case 'header_layout_11':
                get_template_part('inc/template-parts/headers/header-11');
                break;
            case 'header_layout_12':
                get_template_part('inc/template-parts/headers/header-12');
                break;
            case 'header_layout_13':
                get_template_part('inc/template-parts/headers/header-13');
                break;
            case 'header_layout_14':
                get_template_part('inc/template-parts/headers/header-14');
                break;
            case 'header_layout_15':
                get_template_part('inc/template-parts/headers/header-15');
                break;
            case 'header_layout_16':
                get_template_part('inc/template-parts/headers/header-16');
                break;
            case 'header_layout_17':
                get_template_part('inc/template-parts/headers/header-17');
                break;
            case 'header_layout_18':
                get_template_part('inc/template-parts/headers/header-18');
                break;
            case 'header_layout_19':
                get_template_part('inc/template-parts/headers/header-19');
                break;
            case 'header_layout_st3':
                get_template_part('inc/template-parts/headers/header-st3');
                break;
            case 'header_layout_st26':
                get_template_part('inc/template-parts/headers/header-st26');
                break;
            case 'header_layout_st7':
                get_template_part('inc/template-parts/headers/header-st7');
                break;
            case 'header_layout_st8':
                get_template_part('inc/template-parts/headers/header-st8');
                break;
            case 'header_layout_st13':
                get_template_part('inc/template-parts/headers/header-st13');
                break;
            case 'header_layout_st18':
                get_template_part('inc/template-parts/headers/header-st18');
                break;
            case 'header_layout_blog':
                get_template_part('inc/template-parts/headers/header-blog');
                break;
            case 'header_layout_creative':
                get_template_part('inc/template-parts/headers/header-creative');
                break;
            case 'header_layout_woo':
                get_template_part('inc/template-parts/headers/header-woo');
                break;
            case 'header_layout_finance':
                get_template_part('inc/template-parts/headers/header-finance');
                break;
            case 'header_layout_decoration':
                get_template_part('inc/template-parts/headers/header-decoration');
                break;
            case 'header_layout_architecture':
                get_template_part('inc/template-parts/headers/header-architecture');
                break;
            default :
                get_template_part('inc/template-parts/headers/header-1');
                break;
        }
    }
    return ob_get_clean();
}

function booty_footer() {
    $post = booty_post();
    $config = booty_settings();
    $booty_footer_show = 'show_footer';
    if (is_page() || (function_exists('is_shop') && is_shop())) {
        if (is_page()) {
            $post_id = $post->ID;
        } elseif ((function_exists('is_shop') && is_shop())) {
            $post_id = get_option('woocommerce_shop_page_id');
        }
        if (get_post_meta($post_id, 'hide_footer', true)) {
            $booty_footer_show = get_post_meta($post_id, 'hide_footer', true);
        }
        if (get_post_meta($post_id, 'footer_layout', true) != 'default' && get_post_meta($post_id, 'booty_footer_top_show', true)) {
            $booty_footer_top_show = get_post_meta($post_id, 'booty_footer_top_show', true);
        } else {
            $booty_footer_top_show = $config['footer_top_enabled'];
        }
        if (get_post_meta($post_id, 'footer_layout', true) != 'default' && get_post_meta($post_id, 'booty_footer_center_show', true)) {
            $booty_footer_center_show = get_post_meta($post_id, 'booty_footer_center_show', true);
        } else {
            $booty_footer_center_show = $config['footer_center_enabled'];
        }
        if (get_post_meta($post_id, 'footer_layout', true) != 'default' && get_post_meta($post_id, 'booty_footer_bottom_show', true)) {
            $booty_footer_bottom_show = get_post_meta($post_id, 'booty_footer_bottom_show', true);
        } else {
            $booty_footer_bottom_show = $config['footer_bottom_enabled'];
        }
        if (get_post_meta($post_id, 'booty_footer_parallax', true)) {
            $booty_footer_parallax_show = get_post_meta($post_id, 'booty_footer_parallax', true);
        } else {
            $booty_footer_parallax_show = '';
        }
        if (get_post_meta($post_id, 'booty_footer_style', true))
            $booty_footer_style = get_post_meta($post_id, 'booty_footer_style', true);
        else
            $booty_footer_style = '';
    }else {
        $booty_footer_top_show = $config['footer_top_enabled'];
        $booty_footer_bottom_show = $config['footer_bottom_enabled'];
        $booty_footer_center_show = $config['footer_center_enabled'];
        $booty_footer_parallax_show = '';
    }
    if ($booty_footer_show == 'show_footer') {
        if ($booty_footer_top_show == 'show') {
            get_template_part('inc/template-parts/footer/footer-top');
        }
        if ($booty_footer_center_show == 'show') {
            get_template_part('inc/template-parts/footer/footer-center');
        }
        if ($booty_footer_bottom_show == 'show') {
            get_template_part('inc/template-parts/footer/footer-bottom');
        }
        if ($booty_footer_parallax_show != '') {
            $image = wp_get_attachment_image_src((int) $booty_footer_parallax_show, 'full');
            echo '<div class="parallax-holder"><div class="parallax-frame"><img src="' . esc_url($image[0]) . '" alt="image description" style="visibility: hidden;"></div></div>';
        }
    }
}

function booty_footer_class() {
    $booty_style = '';
    if (is_page() || (function_exists('is_shop') && is_shop())) {
        if (is_page()) {
            global $post;
            $post_id = $post->ID;
        } else {
            $post_id = get_option('woocommerce_shop_page_id');
        }
        if (get_post_meta($post_id, 'booty_footer_style', true)) {
            $booty_style = get_post_meta($post_id, 'booty_footer_style', true);
        } else {
            $booty_style = '';
        }
        if (get_post_meta($post_id, 'booty_footer_parallax', true))
            $booty_style .= ' footer_parallax';
    }
    return $booty_style;
}

function booty_footer_top_class() {
    $booty_footer_top_class = 'footer-top bg-shark';
    if (is_page() || (function_exists('is_shop') && is_shop())) {
        if (is_page()) {
            global $post;
            $post_id = $post->ID;
        } elseif (function_exists('is_shop') && is_shop()) {
            $post_id = get_option('woocommerce_shop_page_id');
        }
        if (get_post_meta($post_id, 'booty_footer_reverse', true) && get_post_meta($post_id, 'booty_footer_reverse', true) == 'reverse')
            $booty_footer_top_class = 'footer-bottom';
        else
            $booty_footer_top_class = 'footer-top';
        if (get_post_meta($post_id, 'booty_footer_top_bg', true) && get_post_meta($post_id, 'booty_footer_top_bg', true) != 'default')
            $booty_footer_top_class .= ' ' . get_post_meta($post_id, 'booty_footer_top_bg', true);
        else
            $booty_footer_top_class .= ' bg-shark';
    }
    return $booty_footer_top_class;
}

function booty_footer_center_class() {
    $booty_footer_center_class = 'footer-cent bg-dark-jungle';
    if (is_page() || (function_exists('is_shop') && is_shop())) {
        if (is_page()) {
            global $post;
            $post_id = $post->ID;
        } elseif (function_exists('is_shop') && is_shop()) {
            $post_id = get_option('woocommerce_shop_page_id');
        }
        $booty_footer_center_class = 'footer-cent';
        if (get_post_meta($post_id, 'booty_footer_center_bg', true) && get_post_meta($post_id, 'booty_footer_center_bg', true) != 'default')
            $booty_footer_center_class .= ' ' . get_post_meta($post_id, 'booty_footer_center_bg', true);
        else
            $booty_footer_center_class .= ' bg-dark-jungle';
    }
    return $booty_footer_center_class;
}

function booty_footer_bottom_class() {
    $booty_footer_bottom_class = 'footer-bottom bg-shark';
    if (is_page() || (function_exists('is_shop') && is_shop())) {
        if (is_page()) {
            global $post;
            $post_id = $post->ID;
        } elseif (function_exists('is_shop') && is_shop()) {
            $post_id = get_option('woocommerce_shop_page_id');
        }
        if (get_post_meta($post_id, 'booty_footer_reverse', true) && get_post_meta($post_id, 'booty_footer_reverse', true) == 'reverse')
            $booty_footer_bottom_class = 'footer-top';
        else
            $booty_footer_bottom_class = 'footer-bottom';
        if (get_post_meta($post_id, 'booty_footer_bottom_bg', true) && get_post_meta($post_id, 'booty_footer_bottom_bg', true) != 'default')
            $booty_footer_bottom_class .= ' ' . get_post_meta($post_id, 'booty_footer_bottom_bg', true);
        else
            $booty_footer_bottom_class .= ' bg-shark';
    }
    return $booty_footer_bottom_class;
}

function booty_footer_types() {
    $post = booty_post();
    $config = booty_settings();
    $booty_footer_arg = array();
    if (is_page()) {
        $post_id = $post->ID;
    } elseif (function_exists('is_shop') && is_shop()) {
        $post_id = get_option('woocommerce_shop_page_id');
    }
    if ((is_page() || (function_exists('is_shop') && is_shop())) && get_post_meta($post_id, 'footer_layout', true) != 'default') {
        // footer top
        if (get_post_meta($post_id, 'booty_footer_top_column', true))
            $booty_footer_top_column = get_post_meta($post_id, 'booty_footer_top_column', true);
        else
            $booty_footer_top_column = $config['footer_top_layout'];
        for ($c = 1; $c <= 2; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                if (get_post_meta($post_id, 'booty_footer_top_' . $c . 'column_' . $i . 'w', true) && get_post_meta($post_id, 'footer_layout', true) != 'default')
                    $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'w'] = get_post_meta($post_id, 'booty_footer_top_' . $c . 'column_' . $i . 'w', true);
                else
                    $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'w'] = $config['footer_top_' . $c . 'c_' . $i];
                if (get_post_meta($post_id, 'booty_footer_top_' . $c . 'column_' . $i . 'ct', true))
                    $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'ct'] = get_post_meta($post_id, 'booty_footer_top_' . $c . 'column_' . $i . 'ct', true);
                else
                    $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'ct'] = $config['footer_top_ct_' . $c . 'c_' . $i];
            }
        }
        // footer center
        if (get_post_meta($post_id, 'booty_footer_center_column', true))
            $booty_footer_center_column = get_post_meta($post_id, 'booty_footer_center_column', true);
        else
            $booty_footer_center_column = $config['footer_center_layout'];
        for ($c = 3; $c <= 4; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                if (get_post_meta($post_id, 'booty_footer_center_' . $c . 'column_' . $i . 'w', true))
                    $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'w'] = get_post_meta($post_id, 'booty_footer_center_' . $c . 'column_' . $i . 'w', true);
                else
                    $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'w'] = $config['footer_center_' . $c . 'c_' . $i];
                if (get_post_meta($post_id, 'booty_footer_center_' . $c . 'column_' . $i . 'ct', true))
                    $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'ct'] = get_post_meta($post_id, 'booty_footer_center_' . $c . 'column_' . $i . 'ct', true);
                else
                    $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'ct'] = $config['footer_center_ct_' . $c . 'c_' . $i];
            }
        }
        // footer bottom
        if (get_post_meta($post_id, 'booty_footer_bottom_column', true))
            $booty_footer_bottom_column = get_post_meta($post_id, 'booty_footer_bottom_column', true);
        else
            $booty_footer_bottom_column = $config['footer_bottom_layout'];
        for ($c = 1; $c <= 2; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                if (get_post_meta($post_id, 'booty_footer_bottom_' . $c . 'column_' . $i . 'w', true))
                    $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'w'] = get_post_meta($post_id, 'booty_footer_bottom_' . $c . 'column_' . $i . 'w', true);
                else
                    $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'w'] = $config['footer_bottom_' . $c . 'c_' . $i];
                if (get_post_meta($post_id, 'booty_footer_bottom_' . $c . 'column_' . $i . 'ct', true))
                    $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'ct'] = get_post_meta($post_id, 'booty_footer_bottom_' . $c . 'column_' . $i . 'ct', true);
                else
                    $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'ct'] = $config['footer_bottom_ct_' . $c . 'c_' . $i];
            }
        }
    }else {
        $booty_footer_top_column = $config['footer_top_layout'];
        for ($c = 1; $c <= 2; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'w'] = $config['footer_top_' . $c . 'c_' . $i];
                $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'ct'] = $config['footer_top_ct_' . $c . 'c_' . $i];
            }
        }
        // footer center
        $booty_footer_center_column = $config['footer_center_layout'];
        for ($c = 3; $c <= 4; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'w'] = $config['footer_center_' . $c . 'c_' . $i];
                $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'ct'] = $config['footer_center_ct_' . $c . 'c_' . $i];
            }
        }
        // footer bottom
        $booty_footer_bottom_column = $config['footer_bottom_layout'];
        for ($c = 1; $c <= 2; $c++) {
            for ($i = 1; $i <= $c; $i++) {
                $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'w'] = $config['footer_bottom_' . $c . 'c_' . $i];
                $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'ct'] = $config['footer_bottom_ct_' . $c . 'c_' . $i];
            }
        }
    }

    if ($booty_footer_top_column == '1column') {
        $booty_footer_arg['top']['col'] = '1column';
    } else {
        $booty_footer_arg['top']['col'] = '2column';
    }
    for ($c = 1; $c <= 2; $c++) {
        for ($i = 1; $i <= $c; $i++) {
            $booty_footer_arg['top_' . $c . 'colum']['w' . $i] = $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'w'];
            $booty_footer_arg['top_' . $c . 'colum']['ct' . $i] = $booty_footer_top['booty_footer_top_' . $c . 'column_' . $i . 'ct'];
        }
    }
    if ($booty_footer_center_column == '3column') {
        $booty_footer_arg['center']['col'] = '3column';
    } else {
        $booty_footer_arg['center']['col'] = '4column';
    }
    for ($c = 3; $c <= 4; $c++) {
        for ($i = 1; $i <= $c; $i++) {
            $booty_footer_arg['center_' . $c . 'colum']['w' . $i] = $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'w'];
            $booty_footer_arg['center_' . $c . 'colum']['ct' . $i] = $booty_footer_center['booty_footer_center_' . $c . 'column_' . $i . 'ct'];
        }
    }
    if ($booty_footer_bottom_column == '1column') {
        $booty_footer_arg['bottom']['col'] = '1column';
    } else {
        $booty_footer_arg['bottom']['col'] = '2column';
    }
    for ($c = 1; $c <= 2; $c++) {
        for ($i = 1; $i <= $c; $i++) {
            $booty_footer_arg['bottom_' . $c . 'colum']['w' . $i] = $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'w'];
            $booty_footer_arg['bottom_' . $c . 'colum']['ct' . $i] = $booty_footer_bottom['booty_footer_bottom_' . $c . 'column_' . $i . 'ct'];
        }
    }
    return $booty_footer_arg;
}

function booty_excert($length, $post_id = 0) {
    if (is_numeric($post_id) && $post_id > 0) {
        $post_obj = get_post($post_id);
        $excerpt = $post_obj->post_excerpt;
        $content = strip_tags(apply_filters('the_content', $post_obj->post_content));
    } else {
        $excerpt = get_the_excerpt();
        $content = strip_tags(apply_filters('the_content', do_shortcode(get_the_content(''))));
    }
    if (mb_strlen($excerpt) > $length) {
        $subex = mb_substr($excerpt, 0, $length - 5);
        $indicator = apply_filters('excerpt_more', '');
    } else {
        if (mb_strlen($content) > $length) {
            $indicator = apply_filters('excerpt_more', '');
            $subex = mb_substr($content, 0, $length - 5);
        } else {
            return $content;
        }
    }

    if (!strpos($subex, ' '))
        return '';

    $exwords = explode(' ', $subex);
    $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
    if ($excut < 0) {
        return trim(mb_substr($subex, 0, $excut)) . $indicator;
    } else {
        return trim($subex) . $indicator;
    }
}

function booty_heading_banner($type) {
    $config = booty_settings();
    if ($config[$type . '_banner'] == 'hide')
        return;
    $breadcrumbs = booty_get_meta_value('breadcrumbs', true);
    $page_title = booty_get_meta_value('page_title', true);
    if ($breadcrumbs || $page_title) :
        ob_start();
        ?>
        <div class="page-banner small">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
        <?php if ($page_title) { ?>
                            <div class="holder">
                <?php if ($config[$type . '_banner_text_default'] == 'default') { ?>
                                    <h1 class="heading text-uppercase"><?php booty_page_title(); ?></h1>
            <?php } elseif ($config[$type . '_banner_text_default'] == 'custom') { ?>
                    <?php echo (wp_kses($config[$type . '_banner_text'], wp_kses_allowed_html('post'))); ?>
                <?php } ?>
                            </div>
            <?php } ?>
            <?php if ($breadcrumbs) { ?>
                <?php booty_breadcrumbs(); ?>
            <?php } ?>
                    </div>
                </div>
            </div>
        <?php if ($config[$type . '_banner_bg']['background-image'] != '') { ?>
                <div class="stretch">
                    <img src="<?php echo esc_url($config[$type . '_banner_bg']['background-image']) ?>" alt="image description" />
                </div>
            <?php
        } else {
            if ($config[$type . '_banner_bg']['background-color'] != '')
                $booty_style = 'background:' . $config[$type . '_banner_bg']['background-color'];
            else
                $booty_style = 'background:#000';
            echo '<div class="stretch" style="' . $booty_style . '"></div>';
        }
        ?>
        </div>
        <?php
        echo ob_get_clean();
    endif;
}

function booty_portfolio_heading_banner() {
    $config = booty_settings();
    $breadcrumbs = booty_get_meta_value('breadcrumbs', true);
    $page_title = booty_get_meta_value('page_title', true);
    if ($breadcrumbs || $page_title) :
        ob_start();
        ?>
        <div class="page-banner small">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
        <?php if ($page_title) { ?>
                            <div class="holder">
                <?php if ($config['single_portfolio_banner_text_default'] == 'default') { ?>
                                    <h1 class="heading text-uppercase"><?php booty_page_title(); ?></h1>
            <?php } elseif ($config['single_portfolio_banner_text_default'] == 'custom') { ?>
                    <?php echo (wp_kses($config['single_portfolio_banner_text'], wp_kses_allowed_html('post'))); ?>
                <?php } ?>
                            </div>
            <?php } ?>
            <?php if ($breadcrumbs) { ?>
                <?php booty_breadcrumbs(); ?>
            <?php } ?>
                    </div>
                </div>
            </div>
        <?php if ($config['single_portfolio_banner_bg']['background-image'] != '') { ?>
                <div class="stretch">
                    <img src="<?php echo esc_url($config['single_portfolio_banner_bg']['background-image']) ?>" alt="image description" />
                </div>
            <?php
        } else {
            if ($config['single_portfolio_banner_bg']['background-color'] != '')
                $booty_style = 'background:' . $config['single_portfolio_banner_bg']['background-color'];
            else
                $booty_style = 'background:#000';
            echo '<div class="stretch" style="' . $booty_style . '"></div>';
        }
        ?>
        </div>
        <?php
        echo ob_get_clean();
    endif;
}

function booty_product_columns() {
    return array(
        "2" => esc_html__("2", BOOTY_TXT_DOMAIN),
        "3" => esc_html__("3", BOOTY_TXT_DOMAIN),
        "4" => esc_html__("4", BOOTY_TXT_DOMAIN),
    );
}

function booty_blog_columns() {
    return array(
        "2" => esc_html__("2", BOOTY_TXT_DOMAIN),
        "3" => esc_html__("3", BOOTY_TXT_DOMAIN),
        "4" => esc_html__("4", BOOTY_TXT_DOMAIN),
    );
}

function booty_style_inline() {
    
}

function booty_page_layout() {
    $config = booty_settings();
    $booty_setting = array();
    $booty_setting['booty_layout'] = (isset($config['page_layout']) && $config['page_layout'] != '') ? $config['page_layout'] : 'default';
    $booty_setting['booty_sidebar_position'] = (isset($config['page_sidebar']) && $config['page_sidebar'] != '') ? $config['page_sidebar'] : 'no-sidebar';
    $booty_setting['booty_sidebar_left'] = (isset($config['page_sidebar_left']) && $config['page_sidebar_left'] != '') ? $config['page_sidebar_left'] : 'left-sidebar';
    $booty_setting['booty_sidebar_right'] = (isset($config['page_sidebar_right']) && $config['page_sidebar_right'] != '') ? $config['page_sidebar_right'] : 'right-sidebar';
    if (booty_get_meta_value('layout', false) != '' && booty_get_meta_value('layout', false) != 'default')
        $booty_setting['booty_layout'] = booty_get_meta_value('layout', false);
    if (booty_get_meta_value('sidebar_position', false) != '' && booty_get_meta_value('sidebar_position', false) != 'default')
        $booty_setting['booty_sidebar_position'] = booty_get_meta_value('sidebar_position', false);
    if (booty_get_meta_value('sidebarleft', false) != '' && booty_get_meta_value('sidebarleft', false) != 'default')
        $booty_setting['booty_sidebar_left'] = booty_get_meta_value('sidebarleft', false);
    if (booty_get_meta_value('sidebarright', false) != '' && booty_get_meta_value('sidebarright', false) != 'default')
        $booty_setting['booty_sidebar_right'] = booty_get_meta_value('sidebarright', false);
    $booty_setting['no_padding'] = booty_get_meta_value('no_padding', false);
    $booty_setting['hide_banner'] = booty_get_meta_value('hide_banner', false);
    return $booty_setting;
}

function booty_archive_portforlio_setting() {
    $config = booty_settings();
    $booty_setting = array();
    $booty_setting['design_type'] = $config['archive_portfolio_layout'];
    $booty_setting['layout_site'] = $config['archive_portfolio_layout_width'];
    $booty_setting['space_class'] = $config['archive_portfolio_space'];
    $booty_setting['column_show'] = $config['archive_portfolio_column'];
    $booty_setting['num_items'] = $config['archive_portfolio_num_item'];
    $booty_setting['effect_type'] = $config['archive_portfolio_effect'];
    $booty_setting['sidebar'] = $config['archive_portfolio_sitebar'];
    $booty_setting['sidebar_left'] = $config['archive_portfolio_sitebar_left'];
    $booty_setting['sidebar_right'] = $config['archive_portfolio_sitebar_right'];
    return $booty_setting;
}

function booty_body_class($classes) {
    $config = booty_settings();
    if (is_page() && get_post_meta(get_the_ID(), 'dark_theme', true)) {
        $classes[] = 'dark';
    } elseif ($config['theme_style'] && $config['theme_style'] == 'dark') {
        $classes[] = 'dark';
    }
    return $classes;
}

add_filter('body_class', 'booty_body_class');
