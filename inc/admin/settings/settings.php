<?php

/**
 * Booty Settings Options
 */
if (!class_exists('Framework_Booty_Settings')) {

    class Framework_Booty_Settings {

        public $ReduxFramework;

        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {
            $this->ReduxFramework = new ReduxFramework($this->booty_get_setting_sections(), $this->booty_get_setting_arguments());
        }

        public function booty_get_setting_sections() {
            $arg_social = array(
                'facebook' => 'Facebook',
                'twitter' => 'Twitter',
                'googleplus' => 'Google Plus',
                'pinterest' => 'Pinterest',
                'instagram' => 'Instagram',
                'dribbble' => 'Dribbble',
                'skype' => 'Skype',
                'flickr' => 'Flickr',
                'youtube' => 'Youtube',
                'likedin' => 'Linkedin',
                'behance' => 'Behance',
                'skype' => 'Skype',
                'apple' => 'Apple',
                'soundcloud' => 'Soundcloud'
            );
            $arg_ctinfo = array(
                'email' => 'Email',
                'phone' => 'Phone',
            );
            $arg_woopage = array(
                'myaccout' => 'Myaccout',
                'checkout' => 'Checkout',
                'cart' => 'Cart',
            );
            $arg_icon = array(
                'search' => esc_html__('Search', BOOTY_TXT_DOMAIN),
            );
            if (class_exists('YITH_WCWL')) {
                $arg_woopage['wishlist'] = esc_html__('Wishlist', BOOTY_TXT_DOMAIN);
            }
            if (class_exists('YITH_Woocompare')) {
                $arg_woopage['compare'] = esc_html__('Compare', BOOTY_TXT_DOMAIN);
            }
            $arg_header_tl = array(
                'social' => esc_html__('Social', BOOTY_TXT_DOMAIN),
                'ct_info' => esc_html__('Contact info', BOOTY_TXT_DOMAIN),
            );
            if (class_exists('WooCommerce')):
                $arg_header_tl['woo_page'] = esc_html__('Woo page', BOOTY_TXT_DOMAIN);
                $arg_icon['cart'] = esc_html__('Mini cart', BOOTY_TXT_DOMAIN);
            endif;
            if (defined('ICL_LANGUAGE_CODE')):
                $arg_header_tl['lang'] = esc_html__('Language', BOOTY_TXT_DOMAIN);
                $arg_icon['lang'] = esc_html__('Language', BOOTY_TXT_DOMAIN);
            endif;
            $header_layout = array('Header Layout 1', 'Header Layout 2', 'Header Layout 3', 'Header Layout 4', 'Header Layout 5', 'Header Layout 6', 'Header Layout 7', 'Header Layout 8', 'Header Layout 9', 'Header Layout 10', 'Header Layout 11', 'Header Layout 12', 'Header Layout 13', 'Header Layout 14', 'Header Layout 15', 'Header Layout 16', 'Header Layout 17', 'Header Layout 18', 'Header Layout 19', 'Header Layout 20', 'Header Layout 21');
            $header_layout_option = array('header_layout_1' => 'Header Layout 1', 'header_layout_2' => 'Header Layout 2', 'header_layout_3' => 'Header Layout 3', 'header_layout_6' => 'Header Layout 4', 'header_layout_7' => 'Header Layout 5', 'header_layout_12' => 'Header Layout 6', 'header_layout_13' => 'Header Layout 7', 'header_layout_16' => 'Header Layout 8', 'header_layout_17' => 'Header Layout 9', 'header_layout_19' => 'Header Layout 10', 'header_layout_blog' => 'Header Layout 11', 'header_layout_creative' => 'Header Layout 12', 'header_layout_st3' => 'Header Layout 13', 'header_layout_st7' => 'Header Layout 14', 'header_layout_st8' => 'Header Layout 15', 'header_layout_st13' => 'Header Layout 16', 'header_layout_st18' => 'Header Layout 17', 'header_layout_st26' => 'Header Layout 18', 'header_layout_finance' => 'Header Layout 19', 'header_layout_decoration' => 'Header Layout 20', 'header_layout_architecture' => 'Header Layout 21');
            $sections[] = array(
                'icon' => 'el-icon-cog',
                'icon_class' => 'icon',
                'title' => esc_html__('Demo', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'import-default',
                        'type' => 'button_set',
                        'title' => esc_html__('Import media, post-type, slider, widget, ...', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('You need select "Import Default" on first Import to get data default, do not need on next Import.', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'import' => esc_html__('Import Default', BOOTY_TXT_DOMAIN),
                            'not' => esc_html__('Not Import Default', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'import',
                    ),
                    array(
                        'id' => 'theme-type',
                        'type' => 'select',
                        'title' => esc_html__('Select Demo', BOOTY_TXT_DOMAIN),
                        'desc' => esc_html__('Import Home demo', BOOTY_TXT_DOMAIN),
                        'options' => booty_theme_types(),
                        'default' => 'business'
                    ),
                    array(
                        'id' => 'import-demo',
                        'type' => 'info',
                        'title' => esc_html__('Import Demo', BOOTY_TXT_DOMAIN),
                        'desc' => '<br/><strong>' . esc_html__('Please click button "Save Changes" before click button "Import"', BOOTY_TXT_DOMAIN) . '</strong> <br/><strong>' . esc_html__('If import failed, please check your site and click "Import" again.', BOOTY_TXT_DOMAIN) . '</strong>',
                        'notice' => false
                    ),
                    array(
                        'id' => 'import-demo-success',
                        'type' => 'raw',
                        'content' => (isset($_GET['import_options_success']) ? '<strong>' . esc_html__('Successfully Imported!', BOOTY_TXT_DOMAIN) . '</strong><br/><br/>' : '') . '<a href="' . admin_url('admin.php?page=Booty') . '&import_sample_content=true" class="button button-primary">' . esc_html__('Import', BOOTY_TXT_DOMAIN) . '</a>'
                    ),
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-dashboard',
                'icon_class' => 'icon',
                'title' => esc_html__('General', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    //-- Basic theme switcher
                    array(
                        'id' => 'theme_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Set theme style', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Set dark/white theme', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'white' => esc_html__('White', BOOTY_TXT_DOMAIN),
                            'dark' => esc_html__('Dark', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'white',
                    ),
                    array(
                        'id' => 'logo_image',
                        'type' => 'media',
                        'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for your logo.', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo.png'
                        )
                    ),
                    array(
                        'id' => 'logo2_image',
                        'type' => 'media',
                        'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for your logo when nav fixed.', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo2.png'
                        )
                    ),
                    //-- Favicon upload
                    array(
                        'id' => 'favicon_main',
                        'type' => 'media',
                        'title' => esc_html__('Favicon', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Specify a', BOOTY_TXT_DOMAIN) . '<a href="' . esc_url('en.wikipedia.org/wiki/Favicon') . '" target="_blank">' . esc_html__(' favicon', BOOTY_TXT_DOMAIN) . '</a>' . esc_html__(' for your site. Accepted formats: .ico, .png, .gif.', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/favicon.ico'
                        )
                    ), //-- Sidebar Mobile
                    array(
                        'id' => 'preload',
                        'type' => 'button_set',
                        'title' => esc_html__('Preload ', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enable Preload site', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'enable' => esc_html__('Enable', BOOTY_TXT_DOMAIN),
                            'disable' => esc_html__('Disable', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'enable',
                    ),
                    array(
                        'id' => 'mapapi',
                        'type' => 'text',
                        'title' => esc_html__('Map API ', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enter Map API', BOOTY_TXT_DOMAIN) . ' <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">' . esc_html__("Get API", BOOTY_TXT_DOMAIN) . '</a> '
                    ),
                    array(
                        'id' => 'js-code',
                        'type' => 'ace_editor',
                        'title' => esc_html__('JS Code', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your JS code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'default' => "jQuery(document).ready(function(){});"
                    )
                )
            );
            /**
             * 404 Page
             */
            $sections[] = array(
                'title' => esc_html__('404 page', BOOTY_TXT_DOMAIN),
                'icon' => 'el-icon-website',
                'fields' => array(
                    array(
                        'id' => '404_layout',
                        'type' => 'select',
                        'title' => esc_html__('Layout 404', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select layout for 404 page', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'layout1' => esc_html__('Layout 1', BOOTY_TXT_DOMAIN),
                            'layout2' => esc_html__('Layout 2', BOOTY_TXT_DOMAIN),
                            'layout3' => esc_html__('Layout 3', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'layout1',
                    ),
                    // Layout 1
                    array(
                        'id' => '404_logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for your logo in 404 page', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-5.png'
                        ),
                        'required' => array(
                            array('404_layout', '=', 'layout1')
                        ),
                    ),
                    array(
                        'id' => '404_bg',
                        'type' => 'media',
                        'title' => esc_html__('Background for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for 404 page background image', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/img76.jpg'
                        ),
                        'required' => array(
                            array('404_layout', '=', 'layout1')
                        ),
                    ),
                    array(
                        'id' => '404_txt',
                        'type' => 'textarea',
                        'title' => esc_html__('Content for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enter 404 content here', BOOTY_TXT_DOMAIN),
                        'default' => esc_html__('Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aenean commodo ligula eget dolor aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', BOOTY_TXT_DOMAIN),
                        'required' => array(
                            array('404_layout', '=', 'layout1')
                        ),
                    ),
                    array(
                        'id' => '404_link',
                        'type' => 'text',
                        'title' => esc_html__('Links for "Get Help" button', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enter your link here', BOOTY_TXT_DOMAIN),
                        'placeholder' => esc_html__('http://', BOOTY_TXT_DOMAIN),
                        'default' => '#',
                        'required' => array(
                            array('404_layout', '=', 'layout1')
                        ),
                    ),
                    // Layout 2
                    array(
                        'id' => '404_type2_banner_bg',
                        'type' => 'media',
                        'title' => esc_html__('Background for banner 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for banner 404 page background image', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/img_404_01.jpg'
                        ),
                        'required' => array(
                            array('404_layout', '=', 'layout2')
                        ),
                    ),
                    array(
                        'id' => '404_type2_txt',
                        'type' => 'textarea',
                        'title' => esc_html__('Content for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enter 404 content here', BOOTY_TXT_DOMAIN),
                        'default' => esc_html__('ARE YOU LOST SOMEWHERE?', BOOTY_TXT_DOMAIN),
                        'required' => array(
                            array('404_layout', '=', 'layout2')
                        ),
                    ),
                    // Layout 3
                    array(
                        'id' => '404_type3_logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for your logo in 404 page', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-5.png'
                        ),
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_bg',
                        'type' => 'media',
                        'title' => esc_html__('Background for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select an image file for 404 page background image', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/inc/admin/settings/images/img_404_02.jpg'
                        ),
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_txt',
                        'type' => 'textarea',
                        'title' => esc_html__('Content for 404 page', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enter 404 content here', BOOTY_TXT_DOMAIN),
                        'default' => esc_html__('Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', BOOTY_TXT_DOMAIN),
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_facebook',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_twitter',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_google_plus',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_pinterest',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_instagram',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_dribbble',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_flickr',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_youtube',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_vimeo',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_linkedin',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'hide',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_behance',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_skype',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                    array(
                        'id' => '404_type3_option_top_show_apple',
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                        'required' => array(
                            array('404_layout', '=', 'layout3')
                        ),
                    ),
                )
            );
            /**
             * SOCIAL NETWORK
             */
            $sections[] = array(
                'title' => esc_html__('Social Networks', BOOTY_TXT_DOMAIN),
                'icon' => 'el-icon-share',
                'fields' => array(
                    array(
                        'id' => 'social_facebook_link',
                        'type' => 'text',
                        'title' => 'Facebook',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_twitter_link',
                        'type' => 'text',
                        'title' => 'Twitter',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_googleplus_link',
                        'type' => 'text',
                        'title' => 'Google Plus',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_pinterest_link',
                        'type' => 'text',
                        'title' => 'Pinterest',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_instagram_link',
                        'type' => 'text',
                        'title' => 'Instagram',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_dribbble_link',
                        'type' => 'text',
                        'title' => 'Dribbble',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_skype_link',
                        'type' => 'text',
                        'title' => 'Skype',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_flickr_link',
                        'type' => 'text',
                        'title' => 'Flickr',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_youtube_link',
                        'type' => 'text',
                        'title' => 'Youtube',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_linkedin_link',
                        'type' => 'text',
                        'title' => 'Linkedin',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_behance_link',
                        'type' => 'text',
                        'title' => 'Behance',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_apple_link',
                        'type' => 'text',
                        'title' => 'Apple',
                        'default' => '#',
                    ),
                    array(
                        'id' => 'social_soundcloud_link',
                        'type' => 'text',
                        'title' => 'Soundcloud',
                        'default' => '#',
                    ),
                )
            );
            /**
             * STYLE OPTION
             */
            $sections[] = array(
                'icon' => 'el-icon-css',
                'icon_class' => 'icon',
                'title' => esc_html__('Skin', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'main_color',
                        'type' => 'color',
                        'title' => esc_html__('Main Color', BOOTY_TXT_DOMAIN),
                        'transparent' => false,
                        'description' => esc_html__('Set color for main theme', BOOTY_TXT_DOMAIN),
                        'default' => '#e74c3c',
                    ),
                    array(
                        'id' => 'primary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Primary font', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Specify the body font properties.', BOOTY_TXT_DOMAIN),
                        'font-backup' => true,
                        'all_styles' => true,
                        'text-align' => false,
                        'default' => array(
                            'subsets' => 'latin',
                            'font-family' => 'Lato',
                            'font-backup' => 'Georgia, serif',
                            'font-weight' => '400',
                            'color' => '#8f8f8f',
                            'font-size' => '14px',
                            'line-height' => '20px'
                        ),
                    ),
                    array(
                        'id' => 'second1_font',
                        'type' => 'typography',
                        'title' => esc_html__('Second font', BOOTY_TXT_DOMAIN),
                        'all_styles' => true,
                        'font-family' => true,
                        'color' => false,
                        'subsets' => false,
                        'font-backup' => false,
                        'text-align' => false,
                        'line-height' => false,
                        'font-size' => false,
                        'default' => array(
                            'font-family' => 'Poppins',
                        ),
                    ),
                    array(
                        'id' => 'second2_font',
                        'type' => 'typography',
                        'description' => esc_html__('Specify the title font properties.', BOOTY_TXT_DOMAIN),
                        'all_styles' => true,
                        'font-family' => true,
                        'color' => false,
                        'subsets' => false,
                        'font-backup' => false,
                        'text-align' => false,
                        'line-height' => false,
                        'font-size' => false,
                        'default' => array(
                            'font-family' => 'Raleway',
                        ),
                    ),
                )
            );
            $sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'custom-css-code',
                        'type' => 'ace_editor',
                        'title' => esc_html__('CSS', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Enter CSS code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'default' => ""
                    ),
                )
            );
            $booty_arg_header = array(
                array(
                    'id' => 'header_layout_selected',
                    'type' => 'select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Select header to default', BOOTY_TXT_DOMAIN),
                    'options' => $header_layout,
                    'default' => '10',
                ),
                array(
                    'id' => 'header_layout',
                    'type' => 'select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Select header to option', BOOTY_TXT_DOMAIN),
                    'options' => $header_layout_option,
                    'default' => 'header_layout_1',
                ),
            );
            /*
             * 	header layout 1
             */
            $booty_arg_header1 = array(
                array(
                    'id' => 'header_layout_1_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_1' => get_template_directory_uri() . '/inc/admin/settings/images/header_1.png'
                    ),
                    'default' => 'header_layout_1',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_1')
                    ),
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_header1[] = array(
                    'id' => 'layout_1_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_1')
                    )
                );
            endif;
            $booty_arg_header1[] = array(
                'id' => 'layout_1_option_e_near_nav_search',
                'type' => 'button_set',
                'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                'options' => array(
                    'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                    'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                ),
                'default' => 'show',
                'required' => array(
                    array('header_layout', '=', 'header_layout_1')
                )
            );
            $booty_arg_header1[] = array(
                'id' => 'layout_1_option_e_near_nav_bars',
                'type' => 'button_set',
                'description' => esc_html__('Select show bars near nav', BOOTY_TXT_DOMAIN),
                'options' => array(
                    'show' => esc_html__('Show bars', BOOTY_TXT_DOMAIN),
                    'hide' => esc_html__('Hide bars', BOOTY_TXT_DOMAIN)
                ),
                'default' => 'show',
                'required' => array(
                    array('header_layout', '=', 'header_layout_1')
                )
            );
            $booty_arg_header1[] = array(
                'id' => 'layout_1_option_e_near_nav_bars_ct',
                'type' => 'select',
                'data' => 'sidebar',
                'default' => 'bars-sidebar',
                'required' => array(
                    array('header_layout', '=', 'header_layout_1')
                )
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header1);
            /* <-- end header layout 1 */
            /*
             * 	header layout 2
             */
            $booty_arg_header2 = array(
                array(
                    'id' => 'header_layout_2_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_2' => get_template_directory_uri() . '/inc/admin/settings/images/header_2.png'
                    ),
                    'default' => 'header_layout_2',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2')
                    ),
                ),
                array(
                    'id' => 'layout_2_option_top_color',
                    'type' => 'color',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top', BOOTY_TXT_DOMAIN),
                    'default' => '#fff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
            );
            if (defined('ICL_LANGUAGE_CODE')):
                $booty_arg_header2[] = array(
                    'id' => 'layout_2_option_top_show_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show language', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2')
                    ),
                );
            endif;
            if (class_exists('WooCommerce')):
                $booty_arg_header2[] = array(
                    'id' => 'layout_2_option_top_show_myaccount',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show My account', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show My account', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide My account', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2')
                    ),
                );
                $booty_arg_header2[] = array(
                    'id' => 'layout_2_option_top_show_wishlist',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show Wishlist', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Wishlist', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Wishlist', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2')
                    ),
                );
                $booty_arg_header2[] = array(
                    'id' => 'layout_2_option_top_show_login',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show Login', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Login', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Login', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2')
                    ),
                );
            endif;
            $booty_arg_header2[] = array(
                'id' => 'layout_2_option_e_near_nav',
                'type' => 'button_set',
                'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                'options' => array(
                    'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                    'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                ),
                'default' => 'show',
                'required' => array(
                    array('header_layout', '=', 'header_layout_2'),
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_header2[] = array(
                    'id' => 'layout_2_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_2'),
                        array('layout_2_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            $booty_arg_header2[] = array(
                'id' => 'layout_2_option_e_near_nav_search',
                'type' => 'button_set',
                'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                'options' => array(
                    'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                    'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                ),
                'default' => 'show',
                'required' => array(
                    array('header_layout', '=', 'header_layout_2'),
                    array('layout_2_option_e_near_nav', '=', 'show')
                )
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header2);
            /* <-- end header layout 2 */
            /*
             * 	header layout 3
             */
            $booty_arg_header3 = array(
                array(
                    'id' => 'header_layout_3_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_3' => get_template_directory_uri() . '/inc/admin/settings/images/header_3.png'
                    ),
                    'default' => 'header_layout_3',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3')
                    ),
                ),
                array(
                    'id' => 'layout_3_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3')
                    ),
                ),
                array(
                    'id' => 'layout_3_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#2a2a2a',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3')
                    ),
                ),
                array(
                    'id' => 'layout_3_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3'),
                    ),
                ),
                array(
                    'id' => 'layout_3_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3'),
                        array('layout_3_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_header3[] = array(
                    'id' => 'layout_3_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3'),
                        array('layout_3_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            if (defined('ICL_LANGUAGE_CODE')):
                $booty_arg_header3[] = array(
                    'id' => 'layout_3_option_e_near_nav_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show language', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_3')
                    ),
                );
            endif;
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header3);
            /* <-- end header layout 3 */
            /*
             * 	header layout blog
             */
            $booty_arg_headerblog = array(
                array(
                    'id' => 'header_layout_blog_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_blog' => get_template_directory_uri() . '/inc/admin/settings/images/header_blog.png'
                    ),
                    'default' => 'header_layout_blog',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog')
                    ),
                ),
                array(
                    'id' => 'layout_blog_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog')
                    ),
                ),
                array(
                    'id' => 'layout_blog_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#666',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog')
                    ),
                ),
                array(
                    'id' => 'layout_blog_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog'),
                    ),
                ),
                array(
                    'id' => 'layout_blog_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog'),
                        array('layout_blog_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_headerblog[] = array(
                    'id' => 'layout_blog_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_blog'),
                        array('layout_blog_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerblog);
            /* <-- end header layout blog */
            /*
             * 	header layout creative
             */
            $booty_arg_headercreative = array(
                array(
                    'id' => 'header_layout_creative_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_creative' => get_template_directory_uri() . '/inc/admin/settings/images/header_creative.png'
                    ),
                    'default' => 'header_layout_creative',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative')
                    ),
                ),
                array(
                    'id' => 'layout_creative_option_bg',
                    'type' => 'color_rgba',
                    'transparent' => false,
                    'description' => esc_html__('Set background color and opacity for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'color' => '#fff',
                        'alpha' => 0.95
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative')
                    ),
                ),
                array(
                    'id' => 'layout_creative_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#222',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative')
                    ),
                ),
                array(
                    'id' => 'layout_creative_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative'),
                    ),
                ),
                array(
                    'id' => 'layout_creative_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative'),
                        array('layout_creative_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_headercreative[] = array(
                    'id' => 'layout_creative_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative'),
                        array('layout_creative_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            if (defined('ICL_LANGUAGE_CODE')):
                $booty_arg_headercreative[] = array(
                    'id' => 'layout_creative_option_e_near_nav_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show language', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_creative'),
                        array('layout_creative_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headercreative);
            /* <-- end header layout creative */
            /*
             * 	header layout 6
             */
            $booty_arg_header6 = array(
                array(
                    'id' => 'header_layout_6_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_6' => get_template_directory_uri() . '/inc/admin/settings/images/header_6.png'
                    ),
                    'default' => 'header_layout_6',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'layout_6_option_banner',
                    'type' => 'media',
                    'title' => esc_html__('Section Banner', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your banner.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/img01.jpg'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'layout_6_option_banner_box',
                    'type' => 'ace_editor',
                    'subtitle' => esc_html__('Enter html code here. This show in box banner', BOOTY_TXT_DOMAIN),
                    'mode' => 'html',
                    'default' => "<h1>Hi ! I'm Sara</h1><p>CREATIVE WEB Designer</p>",
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'header_layout_6_logo',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Set logo for this header type', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-6.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'layout_6_option_bg',
                    'type' => 'color_rgba',
                    'transparent' => false,
                    'description' => esc_html__('Set background color and opacity for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'color' => '#2a2a2a',
                        'alpha' => 1
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'layout_6_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#ffffff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6')
                    ),
                ),
                array(
                    'id' => 'layout_6_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6'),
                    ),
                ),
                array(
                    'id' => 'layout_6_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6'),
                        array('layout_6_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')) {
                $booty_arg_header6 [] = array(
                    'id' => 'layout_6_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6'),
                        array('layout_6_option_e_near_nav', '=', 'show')
                    )
                );
            };
            if (defined('ICL_LANGUAGE_CODE')) {
                $booty_arg_header6 [] = array(
                    'id' => 'layout_6_option_e_near_nav_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show language near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide language', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_6'),
                        array('layout_6_option_e_near_nav', '=', 'show')
                    )
                );
            };
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header6);
            /* <-- end header layout 6 */
            /*
             * 	header layout 7
             */
            $booty_arg_header7 = array(
                array(
                    'id' => 'header_layout_7_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_7' => get_template_directory_uri() . '/inc/admin/settings/images/header_7.png'
                    ),
                    'default' => 'header_layout_7',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_7')
                    ),
                ),
                array(
                    'id' => 'header_layout_7_logo',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Set logo for this header type', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-7.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_7')
                    ),
                ),
                array(
                    'id' => 'layout_7_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/pattren01.png',
                        'background-repeat' => 'repeat',
                        'background-size' => 'inherit',
                        'background-attachment' => 'inherit',
                        'background-position' => 'left top',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_7')
                    ),
                ),
                array(
                    'id' => 'layout_7_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#ffffff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_7')
                    ),
                ),
                array(
                    'id' => 'layout_7_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '25',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_7')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header7);
            /* <-- end header layout 7 */
            /*
             * 	header layout 12
             */
            $booty_arg_header12 = array(
                array(
                    'id' => 'header_layout_12_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_12' => get_template_directory_uri() . '/inc/admin/settings/images/header_12.png'
                    ),
                    'default' => 'header_layout_12',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#666',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
                array(
                    'id' => 'layout_12_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_12')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header12);
            /* <-- end header layout 12 */
            /*
             * 	header layout 13
             */
            $booty_arg_header13 = array(
                array(
                    'id' => 'header_layout_13_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_13' => get_template_directory_uri() . '/inc/admin/settings/images/header_13.png'
                    ),
                    'default' => 'header_layout_13',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_bg',
                    'type' => 'background',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'background-repeat' => false,
                    'background-attachment' => false,
                    'background-position' => false,
                    'background-image' => false,
                    'background-size' => false,
                    'description' => esc_html__('Set background for header top', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-color' => '#F4F4F4'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#222222',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_phone',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show phone', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Phone', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Phone', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_info_phone',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid phone number format without space or minus sign. This info will be used as click-to-call link.', BOOTY_TXT_DOMAIN),
                    'default' => '+01008431112',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13'),
                        array('layout_13_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_13_option_top_info_phone_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the phone number link here.', BOOTY_TXT_DOMAIN),
                    'default' => esc_html__('CALL US NOW 0100 843 1112', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13'),
                        array('layout_13_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_13_option_top_show_email',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Phone', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Phone', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_info_email',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid email format without space or minus sign. This info will be used as click-to-send-mail link.', BOOTY_TXT_DOMAIN),
                    'default' => 'darna@company.com',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13'),
                        array('layout_13_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_13_option_top_info_email_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the email link here.', BOOTY_TXT_DOMAIN),
                    'default' => 'DARNA@COMPANY.COM',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13'),
                        array('layout_13_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_13_option_top_show_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_center_bg',
                    'type' => 'background',
                    'title' => esc_html__('Header Center', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'background-repeat' => false,
                    'background-attachment' => false,
                    'background-position' => false,
                    'background-image' => false,
                    'background-size' => false,
                    'description' => esc_html__('Set background for header center', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-color' => '#fff'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_bottom_quote',
                    'type' => 'text',
                    'title' => esc_html__('Header Bottom', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Enter a valid quote link', BOOTY_TXT_DOMAIN),
                    'default' => '#',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
                array(
                    'id' => 'layout_13_option_bottom_quote_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the quote link.', BOOTY_TXT_DOMAIN),
                    'default' => 'GET A QUOTE NOW',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_13')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header13);
            /* <-- end header layout 13 */
            /*
             * 	header layout 16
             */
            $booty_arg_header16 = array(
                array(
                    'id' => 'header_layout_16_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_16' => get_template_directory_uri() . '/inc/admin/settings/images/header_16.png'
                    ),
                    'default' => 'header_layout_16',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_16')
                    ),
                ),
                array(
                    'id' => 'header_layout_16_logo',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Set logo for this header type', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-16.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_16')
                    ),
                ),
                array(
                    'id' => 'layout_16_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/pattren01.png',
                        'background-repeat' => 'repeat',
                        'background-size' => 'inherit',
                        'background-attachment' => 'inherit',
                        'background-position' => 'left top',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_16')
                    ),
                ),
                array(
                    'id' => 'layout_16_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#ffffff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_16')
                    ),
                ),
                array(
                    'id' => 'layout_16_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '25',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_16')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header16);
            /* <-- end header layout 16 */
            /*
             * 	header layout 17
             */
            $booty_arg_header17 = array(
                array(
                    'id' => 'header_layout_17_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_17' => get_template_directory_uri() . '/inc/admin/settings/images/header_17.png'
                    ),
                    'default' => 'header_layout_17',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_17')
                    ),
                ),
                array(
                    'id' => 'header_layout_17_logo',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'subtitle' => esc_html__('Set logo for this header type', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-17.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_17')
                    ),
                ),
                array(
                    'id' => 'layout_17_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_17')
                    ),
                ),
                array(
                    'id' => 'layout_17_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#8f8f8f',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_17')
                    ),
                ),
                array(
                    'id' => 'layout_17_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '25',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_17')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header17);
            /* <-- end header layout 17 */
            /*
             * 	header layout 19
             */
            $booty_arg_header19 = array(
                array(
                    'id' => 'header_layout_19_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_19' => get_template_directory_uri() . '/inc/admin/settings/images/header_19.png'
                    ),
                    'default' => 'header_layout_19',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_color',
                    'type' => 'color',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top', BOOTY_TXT_DOMAIN),
                    'default' => '#fff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_phone',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show phone', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Phone', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Phone', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_info_phone',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid phone number format without space or minus sign. This info will be used as click-to-call link.', BOOTY_TXT_DOMAIN),
                    'default' => '+01008431112',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19'),
                        array('layout_19_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_19_option_top_info_phone_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the phone number link here.', BOOTY_TXT_DOMAIN),
                    'default' => esc_html__('123456789', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19'),
                        array('layout_19_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_19_option_top_show_email',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Email', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Email', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_info_email',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid email format without space or minus sign. This info will be used as click-to-send-mail link.', BOOTY_TXT_DOMAIN),
                    'default' => 'admin@company.com',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19'),
                        array('layout_19_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_19_option_top_info_email_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the email link here.', BOOTY_TXT_DOMAIN),
                    'default' => 'admin@company-name.com',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19'),
                        array('layout_19_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_19_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_nav_bg',
                    'type' => 'color_rgba',
                    'transparent' => false,
                    'description' => esc_html__('Set background color and opacity for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'color' => '#fff',
                        'alpha' => 0.2
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_logo_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo2.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_logo2_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo Scroll', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo when nav fixed.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
                array(
                    'id' => 'layout_19_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '26',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_19')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_header19);
            /* <-- end header layout 19 */
            /*
             * 	header layout st3
             */
            $booty_arg_headerst3 = array(
                array(
                    'id' => 'header_layout_st3_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st3' => get_template_directory_uri() . '/inc/admin/settings/images/header_st3.png'
                    ),
                    'default' => 'header_layout_st3',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_show_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3'),
                    )
                ),
                array(
                    'id' => 'layout_st3_option_show_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show cart', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3'),
                    )
                ),
                array(
                    'id' => 'layout_st3_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_tumblr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Tumblr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Tumblr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
                array(
                    'id' => 'layout_st3_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st3')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst3);
            /* <-- end header layout st3 */
            /*
             * 	header layout st7
             */
            $booty_arg_headerst7 = array(
                array(
                    'id' => 'header_layout_st7_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st7' => get_template_directory_uri() . '/inc/admin/settings/images/header_st7.png'
                    ),
                    'default' => 'header_layout_st7',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7')
                    ),
                ),
                array(
                    'id' => 'layout_st7_option_bg',
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7')
                    ),
                ),
                array(
                    'id' => 'layout_st7_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#2a2a2a',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7')
                    ),
                ),
                array(
                    'id' => 'layout_st7_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7'),
                    ),
                ),
                array(
                    'id' => 'layout_st7_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7'),
                        array('layout_st7_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')):
                $booty_arg_headerst7[] = array(
                    'id' => 'layout_st7_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7'),
                        array('layout_st7_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            if (defined('ICL_LANGUAGE_CODE')):
                $booty_arg_headerst7[] = array(
                    'id' => 'layout_st7_option_e_near_nav_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show language', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st7')
                    ),
                );
            endif;
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst7);
            /* <-- end header layout st */
            /*
             * 	header layout st8
             */
            $booty_arg_headerst8 = array(
                array(
                    'id' => 'header_layout_st8_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st8' => get_template_directory_uri() . '/inc/admin/settings/images/header_st8.png'
                    ),
                    'default' => 'header_layout_st8',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                ),
                array(
                    'id' => 'layout_st8_option_top_bg',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'type' => 'background',
                    'transparent' => false,
                    'description' => esc_html__('Set background for header top', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#2a2a2a',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                ),
                array(
                    'id' => 'layout_st8_option_top_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top', BOOTY_TXT_DOMAIN),
                    'default' => '#fff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                ),
            );
            if (defined('ICL_LANGUAGE_CODE')):
                $booty_arg_headerst8[] = array(
                    'id' => 'layout_st8_option_top_show_language',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show language', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Language', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Language', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                );
            endif;
            if (class_exists('WooCommerce')):
                $booty_arg_headerst8[] = array(
                    'id' => 'layout_st8_option_top_show_myaccount',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show My account', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show My account', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide My account', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                );
                $booty_arg_headerst8[] = array(
                    'id' => 'layout_st8_option_top_show_wishlist',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show Wishlist', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Wishlist', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Wishlist', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                );
                $booty_arg_headerst8[] = array(
                    'id' => 'layout_st8_option_top_show_checkout',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show Checkout', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Checkout', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Checkout', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8')
                    ),
                );
                $booty_arg_headerst8[] = array(
                    'id' => 'layout_st8_option_top_show_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st8'),
                        array('layout_st8_option_e_near_nav', '=', 'show')
                    )
                );
            endif;
            $booty_arg_headerst8[] = array(
                'id' => 'layout_st8_option_bg',
                'type' => 'background',
                'title' => 'Header nav',
                'transparent' => false,
                'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                'default' => array(
                    'background-image' => '',
                    'background-repeat' => '',
                    'background-size' => '',
                    'background-attachment' => '',
                    'background-position' => '',
                    'background-color' => '#ffffff',
                ),
                'required' => array(
                    array('header_layout', '=', 'header_layout_st8')
                ),
            );
            $booty_arg_headerst8[] = array(
                'id' => 'layout_st8_option_color',
                'type' => 'color',
                'transparent' => false,
                'description' => esc_html__('Set color for text in header nav', BOOTY_TXT_DOMAIN),
                'default' => '#222',
                'required' => array(
                    array('header_layout', '=', 'header_layout_st8')
                ),
            );
            $booty_arg_headerst8[] = array(
                'id' => 'layout_st8_option_e_near_nav_search',
                'type' => 'button_set',
                'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                'options' => array(
                    'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                    'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                ),
                'default' => 'show',
                'required' => array(
                    array('header_layout', '=', 'header_layout_st8')
                )
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst8);
            /* <-- end header layout st8 */
            /*
             * 	header layout st26
             */
            $booty_arg_headerst26 = array(
                array(
                    'id' => 'header_layout_st26_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st26' => get_template_directory_uri() . '/inc/admin/settings/images/header_st26.png'
                    ),
                    'default' => 'header_layout_st26',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st26')
                    ),
                ),
                array(
                    'id' => 'layout_st26_logo_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo2.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st26')
                    ),
                ),
                array(
                    'id' => 'layout_st26_logo2_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo Scroll', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo when nav fixed.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st26')
                    ),
                ),
                array(
                    'id' => 'layout_st26_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '112',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st26')
                    ),
                ),
                array(
                    'id' => 'layout_st26_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header', BOOTY_TXT_DOMAIN),
                    'default' => '#ffffff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st26')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst26);
            /* <-- end header layout st26 */
            /*
             * 	header layout st13
             */
            $booty_arg_headerst13 = array(
                array(
                    'id' => 'header_layout_st13_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st13' => get_template_directory_uri() . '/inc/admin/settings/images/header_st13.png'
                    ),
                    'default' => 'header_layout_st13',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13')
                    ),
                ),
                array(
                    'id' => 'layout_st13_logo_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo2.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13')
                    ),
                ),
                array(
                    'id' => 'layout_st13_logo2_image',
                    'type' => 'media',
                    'title' => esc_html__('Logo Scroll', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image file for your logo when nav fixed.', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13')
                    ),
                ),
                array(
                    'id' => 'layout_st13_option_nav',
                    'type' => 'select',
                    'data' => 'menus',
                    'description' => esc_html__('Set menu show in this header type', BOOTY_TXT_DOMAIN),
                    'args' => array(
                        'post_type' => 'menu',
                        'posts_per_page' => -1
                    ),
                    'default' => '82',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13')
                    ),
                ),
                array(
                    'id' => 'layout_st13_option_color',
                    'type' => 'color',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top', BOOTY_TXT_DOMAIN),
                    'default' => '#fff',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13')
                    ),
                ),
                array(
                    'id' => 'layout_st13_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13'),
                    ),
                ),
                array(
                    'id' => 'layout_st13_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13'),
                        array('layout_st13_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            if (class_exists('WooCommerce')) {
                $booty_arg_headerst13 [] = array(
                    'id' => 'layout_st13_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st13'),
                        array('layout_st13_option_e_near_nav', '=', 'show')
                    )
                );
            };
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst13);
            /* <-- end header layout st13 */
            /*
             * 	header layout st18
             */
            $booty_arg_headerst18 = array(
                array(
                    'id' => 'header_layout_st18_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_st18' => get_template_directory_uri() . '/inc/admin/settings/images/header_st18.png'
                    ),
                    'default' => 'header_layout_st18',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_bg',
                    'type' => 'background',
                    'title' => esc_html__('Header Top', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#f4f4f4',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_info_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top info', BOOTY_TXT_DOMAIN),
                    'default' => '#222222',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_social_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header top social', BOOTY_TXT_DOMAIN),
                    'default' => '#dddddd',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_phone',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show phone', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Phone', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Phone', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_info_phone',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid phone number format without space or minus sign. This info will be used as click-to-call link.', BOOTY_TXT_DOMAIN),
                    'default' => '+01008431112',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_st18_option_top_info_phone_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the phone number link here.', BOOTY_TXT_DOMAIN),
                    'default' => esc_html__('CALL US NOW 0100 843 1112', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_st18_option_top_show_email',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Email', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Email', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_info_email',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid email format without space or minus sign. This info will be used as click-to-send-mail link.', BOOTY_TXT_DOMAIN),
                    'default' => 'DARNA@COMPANY.COM',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_st18_option_top_info_email_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the email link here.', BOOTY_TXT_DOMAIN),
                    'default' => 'DARNA@COMPANY.COM',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_st18_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_bg',
                    'type' => 'background',
                    'title' => esc_html__('Header Nav', BOOTY_TXT_DOMAIN),
                    'transparent' => false,
                    'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'background-image' => '',
                        'background-repeat' => '',
                        'background-size' => '',
                        'background-attachment' => '',
                        'background-position' => '',
                        'background-color' => '#ffffff',
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_color',
                    'type' => 'color',
                    'transparent' => false,
                    'description' => esc_html__('Set color for text in header nav', BOOTY_TXT_DOMAIN),
                    'default' => '#222',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18')
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select quote show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_quote',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid quote link', BOOTY_TXT_DOMAIN),
                    'default' => '#',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_e_near_nav', '=', 'show'),
                    ),
                ),
                array(
                    'id' => 'layout_st18_option_quote_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the quote link.', BOOTY_TXT_DOMAIN),
                    'default' => 'GET A  PLUMBER',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_st18'),
                        array('layout_st18_option_e_near_nav', '=', 'show'),
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerst18);
            /* <-- end header layout st18 */
            /*
             * 	header layout finance
             */
            $booty_arg_headerfinance = array(
                array(
                    'id' => 'header_layout_finance_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_finance' => get_template_directory_uri() . '/inc/admin/settings/images/header-finance.png'
                    ),
                    'default' => 'header_layout_finance',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_logo_image_light',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image logo for theme style light', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-finance.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_logo_image_dark',
                    'type' => 'media',
                    'title' => esc_html__('Logo', BOOTY_TXT_DOMAIN),
                    'description' => esc_html__('Select an image logo for theme style dark', BOOTY_TXT_DOMAIN),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/inc/admin/settings/images/logo-finance2.png'
                    ),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_email',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Email', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Email', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_info_email',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid email format without space or minus sign. This info will be used as click-to-send-mail link.', BOOTY_TXT_DOMAIN),
                    'default' => 'booty@company.com',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                        array('layout_finance_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_info_email_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the email link here.', BOOTY_TXT_DOMAIN),
                    'default' => 'BOOTY@COMPANY.COM',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                        array('layout_finance_option_top_show_email', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_show_clock',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show email', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Email', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Email', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_info_opening',
                    'type' => 'text',
                    'default' => esc_html__('OPENING FROM 6:00 AM TO 2:00 AM', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                        array('layout_finance_option_top_show_clock', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_show_phone',
                    'type' => 'button_set',
                    'description' => esc_html__('Set show phone', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show Phone', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Phone', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_info_phone',
                    'type' => 'text',
                    'description' => esc_html__('Enter a valid phone number format without space or minus sign. This info will be used as click-to-call link.', BOOTY_TXT_DOMAIN),
                    'default' => '+01008431112',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                        array('layout_finance_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_info_phone_text',
                    'type' => 'text',
                    'description' => esc_html__('You can customize the look of the phone number link here.', BOOTY_TXT_DOMAIN),
                    'default' => esc_html__('CALL US NOW 0100 843 1112', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                        array('layout_finance_option_top_show_phone', '=', 'show'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_search_text',
                    'type' => 'text',
                    'description' => esc_html__('place holder of search', BOOTY_TXT_DOMAIN),
                    'default' => esc_html__('ENTER YOUR KEYWORDS', BOOTY_TXT_DOMAIN),
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance'),
                    )
                ),
                array(
                    'id' => 'layout_finance_option_top_show_facebook',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Facebook', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Facebook', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_twitter',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Twitter', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Twitter', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_google_plus',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Google Plus', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Google Plus', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_pinterest',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Pinterest', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Pinterest', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_instagram',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Instagram', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Instagram', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_dribbble',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Dribbble', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Dribbble', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_skype',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Skype', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Skype', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_flickr',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Flickr', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Flickr', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_youtube',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Youtube', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Youtube', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_vimeo',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Vimeo', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Vimeo', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_linkedin',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Linkedin', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Linkedin', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_behance',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Behance', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Behance', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
                array(
                    'id' => 'layout_finance_option_top_show_apple',
                    'type' => 'button_set',
                    'options' => array(
                        'show' => esc_html__('Show Apple', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide Apple', BOOTY_TXT_DOMAIN),
                    ),
                    'default' => 'hide',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_finance')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_headerfinance);
            /*
             * 	header layout decoration
             */
            $booty_arg_decoration = array(
                array(
                    'id' => 'header_layout_decoration_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'booty_arg_decoration' => get_template_directory_uri() . '/inc/admin/settings/images/header-decoration.png'
                    ),
                    'default' => 'booty_arg_decoration',
                    'required' => array(
                        array('header_layout', '=', 'booty_arg_decoration')
                    ),
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_decoration);
            /* <-- end header layout decoration */
            /*
             * 	header layout architecture
             */
            $booty_arg_architecture = array(
                array(
                    'id' => 'header_layout_architecture_img',
                    'type' => 'image_select',
                    'title' => esc_html__('Header', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'header_layout_architecture' => get_template_directory_uri() . '/inc/admin/settings/images/header_architecture.png'
                    ),
                    'default' => 'header_layout_architecture',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_architecture')
                    ),
                ),
                array(
                    'id' => 'layout_architecture_option_e_near_nav',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_architecture'),
                    ),
                ),
                array(
                    'id' => 'layout_architecture_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select element show near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_architecture'),
                    ),
                ),
                array(
                    'id' => 'layout_architecture_option_e_near_nav_search',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show search near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show search', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide search', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_architecture'),
                        array('layout_architecture_option_e_near_nav', '=', 'show')
                    )
                ),
                array(
                    'id' => 'layout_architecture_option_e_near_nav_cart',
                    'type' => 'button_set',
                    'description' => esc_html__('Select show mini cart near nav', BOOTY_TXT_DOMAIN),
                    'options' => array(
                        'show' => esc_html__('Show mini cart', BOOTY_TXT_DOMAIN),
                        'hide' => esc_html__('Hide mini cart', BOOTY_TXT_DOMAIN)
                    ),
                    'default' => 'show',
                    'required' => array(
                        array('header_layout', '=', 'header_layout_architecture'),
                        array('layout_architecture_option_e_near_nav', '=', 'show')
                    )
                ),
            );
            $booty_arg_header = array_merge($booty_arg_header, $booty_arg_architecture);
            /* <-- end header layout headerfinance */
            $sections[] = array(
                'title' => esc_html__('Header Option', BOOTY_TXT_DOMAIN),
                'fields' => $booty_arg_header,
            );
            /**
             * FOOTER SETTINGS
             */
            $sections[] = array(
                'title' => esc_html__('Footer', BOOTY_TXT_DOMAIN),
                'icon' => 'el-icon-website',
            );
            /* FOOTER TOP */
            $sections[] = array(
                'title' => esc_html__('Footer Top', BOOTY_TXT_DOMAIN),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'footer_top_enabled',
                        'title' => esc_html__('Enable Footer Top Area', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enable footer top.', BOOTY_TXT_DOMAIN),
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                            'hidden' => esc_html__('Hidden', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show'
                    ),
                    array(
                        'id' => 'footer_top_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Footer top layout', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1column' => esc_html__('1 layout', BOOTY_TXT_DOMAIN),
                            '2column' => esc_html__('2 layout', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '1column',
                        'required' => array('footer_top_enabled', '=', 'show')
                    ),
                    array(
                        'id' => 'footer_top_1c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '12',
                        'required' => array('footer_top_layout', '=', '1column')
                    ),
                    array(
                        'id' => 'footer_top_ct_1c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-1',
                        'required' => array('footer_top_layout', '=', '1column')
                    ),
                    /* Footer top 2 col */
                    array(
                        'id' => 'footer_top_2c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '6',
                        'required' => array('footer_top_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_top_ct_2c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_top_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_top_2c_2',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '6',
                        'required' => array('footer_top_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_top_ct_2c_2',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_top_layout', '=', '2column')
                    ),
                )
            );
            /* FOOTER CENTER */
            $sections[] = array(
                'title' => esc_html__('Footer Center', BOOTY_TXT_DOMAIN),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'footer_center_enabled',
                        'title' => esc_html__('Enable Footer center Area', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enable footer center.', BOOTY_TXT_DOMAIN),
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                            'hidden' => esc_html__('Hidden', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show'
                    ),
                    array(
                        'id' => 'footer_center_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Footer center layout', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '3column' => esc_html__('3 layout', BOOTY_TXT_DOMAIN),
                            '4column' => esc_html__('4 layout', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '4column',
                        'required' => array('footer_center_enabled', '=', 'show')
                    ),
                    /* Footer center 3 col */
                    array(
                        'id' => 'footer_center_3c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '4',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    array(
                        'id' => 'footer_center_ct_3c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    array(
                        'id' => 'footer_center_3c_2',
                        'type' => 'select',
                        'title' => esc_html__('Column 2 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '4',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    array(
                        'id' => 'footer_center_ct_3c_2',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 2 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 2', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    array(
                        'id' => 'footer_center_3c_3',
                        'type' => 'select',
                        'title' => esc_html__('Column 3 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '4',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    array(
                        'id' => 'footer_center_ct_3c_3',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 3 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 3', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_center_layout', '=', '3column')
                    ),
                    /* Footer center 4 col */
                    array(
                        'id' => 'footer_center_4c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '3',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_ct_4c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-2',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_4c_2',
                        'type' => 'select',
                        'title' => esc_html__('Column 2 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '3',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_ct_4c_2',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 2 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 2', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-3',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_4c_3',
                        'type' => 'select',
                        'title' => esc_html__('Column 3 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '3',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_ct_4c_3',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 3 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 3', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-4',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_4c_4',
                        'type' => 'select',
                        'title' => esc_html__('Column 4 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '3',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                    array(
                        'id' => 'footer_center_ct_4c_4',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 4 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 4', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-5',
                        'required' => array('footer_center_layout', '=', '4column')
                    ),
                )
            );
            /* FOOTER Bottom */
            $sections[] = array(
                'title' => esc_html__('Footer Bottom', BOOTY_TXT_DOMAIN),
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'footer_bottom_enabled',
                        'title' => esc_html__('Enable Footer bottom Area', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Enable footer bottom.', BOOTY_TXT_DOMAIN),
                        'type' => 'button_set',
                        'options' => array(
                            'show' => esc_html__('Show', BOOTY_TXT_DOMAIN),
                            'hidden' => esc_html__('Hidden', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show'
                    ),
                    array(
                        'id' => 'footer_bottom_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Footer bottom layout', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1column' => esc_html__('1 layout', BOOTY_TXT_DOMAIN),
                            '2column' => esc_html__('2 layout', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '2column',
                        'required' => array('footer_bottom_enabled', '=', 'show')
                    ),
                    /* Footer bottom 2 col */
                    array(
                        'id' => 'footer_bottom_1c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '12',
                        'required' => array('footer_bottom_layout', '=', '1column')
                    ),
                    array(
                        'id' => 'footer_bottom_ct_1c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => '',
                        'required' => array('footer_bottom_layout', '=', '3column')
                    ),
                    /* Footer bottom 2 col */
                    array(
                        'id' => 'footer_bottom_2c_1',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '6',
                        'required' => array('footer_bottom_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_bottom_ct_2c_1',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 1 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 1', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-6',
                        'required' => array('footer_bottom_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_bottom_2c_2',
                        'type' => 'select',
                        'title' => esc_html__('Column 1 width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => '1 / 12',
                            '2' => '2 / 12',
                            '3' => '3 / 12',
                            '4' => '4 / 12',
                            '5' => '5 / 12',
                            '6' => '6 / 12',
                            '7' => '7 / 12',
                            '8' => '8 / 12',
                            '9' => '9 / 12',
                            '10' => '10 / 12',
                            '11' => '11 / 12',
                            '12' => '12 / 12',
                        ),
                        'default' => '6',
                        'required' => array('footer_bottom_layout', '=', '2column')
                    ),
                    array(
                        'id' => 'footer_bottom_ct_2c_2',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'title' => esc_html__('Column 2 content', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Choose widget for Column 2', BOOTY_TXT_DOMAIN),
                        'default' => 'footer-df-7',
                        'required' => array('footer_bottom_layout', '=', '2column')
                    )
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-brush',
                'icon_class' => 'icon',
                'title' => esc_html__('Page', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'page_layout',
                        'type' => 'select',
                        'description' => esc_html__('Select layout type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html('Default', BOOTY_TXT_DOMAIN),
                            'wide' => esc_html('Wide', BOOTY_TXT_DOMAIN),
                            'fullwidth' => esc_html('Full width', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'default',
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'select',
                        'description' => esc_html__('Select layout type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'no-sidebar' => esc_html('No sidebar', BOOTY_TXT_DOMAIN),
                            'left-sidebar' => esc_html('Left sidebar', BOOTY_TXT_DOMAIN),
                            'right-sidebar' => esc_html('Right sidebar', BOOTY_TXT_DOMAIN),
                            'both-sidebar' => esc_html('Both sidebar', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'no-sidebar',
                    ),
                    array(
                        'id' => 'page_sidebar_left',
                        'type' => 'select',
                        'description' => esc_html__('Select layout type', BOOTY_TXT_DOMAIN),
                        'data' => 'sidebar',
                        'default' => 'left-sidebar',
                        'required' => array(
                            array('page_sidebar', '!=', 'no-sidebar'),
                            array('page_sidebar', '!=', 'right-sidebar'),
                        ),
                    ),
                    array(
                        'id' => 'page_sidebar_right',
                        'type' => 'select',
                        'description' => esc_html__('Select layout type', BOOTY_TXT_DOMAIN),
                        'data' => 'sidebar',
                        'default' => 'right-sidebar',
                        'required' => array(
                            array('page_sidebar', '!=', 'no-sidebar'),
                            array('page_sidebar', '!=', 'left-sidebar'),
                        ),
                    ),
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-brush',
                'icon_class' => 'icon',
                'title' => esc_html__('Blog & Single Post', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'blog-title',
                        'type' => 'text',
                        'title' => esc_html__('Page Title', BOOTY_TXT_DOMAIN),
                        'default' => 'Blog'
                    ),
                    //archive
                    array(
                        'id' => 'archive_post_type',
                        'type' => 'select',
                        'title' => esc_html__('Archive Option', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Set type of layout Archive post', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'gird' => esc_html('Gird', BOOTY_TXT_DOMAIN),
                            'masonry' => esc_html('Masonry', BOOTY_TXT_DOMAIN),
                            'accordion' => esc_html('Accordion', BOOTY_TXT_DOMAIN),
                            'layout' => esc_html('layout', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'gird',
                    ),
                    array(
                        'id' => 'archive_post_space',
                        'type' => 'select',
                        'description' => esc_html__('Set space of layout Gird or Mansory', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'space' => esc_html('Space', BOOTY_TXT_DOMAIN),
                            'without_space' => esc_html('Without Space', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'space',
                        'required' => array(
                            array('archive_post_type', '!=', 'accordion'),
                            array('archive_post_type', '!=', 'layout')
                        ),
                    ),
                    array(
                        'id' => 'archive_post_column',
                        'type' => 'select',
                        'description' => esc_html__('Set column of layout Gird or Mansory', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '2columns' => esc_html('2 Columns', BOOTY_TXT_DOMAIN),
                            '3columns' => esc_html('3 Columns', BOOTY_TXT_DOMAIN),
                            '4columns' => esc_html('4 Columns', BOOTY_TXT_DOMAIN),
                            'fullwidth' => esc_html('Full Width', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '2columns',
                        'required' => array(
                            array('archive_post_type', '!=', 'accordion'),
                            array('archive_post_type', '!=', 'layout')
                        ),
                    ),
                    array(
                        'id' => 'archive_post_layout',
                        'type' => 'select',
                        'description' => esc_html__('Select layout type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'fullwidth' => esc_html('Full Width', BOOTY_TXT_DOMAIN),
                            'alt' => esc_html('ALT', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'fullwidth',
                        'required' => array(
                            array('archive_post_type', '=', 'layout',),
                        ),
                    ),
                    array(
                        'id' => 'archive_post_layout_fullwidth_type',
                        'type' => 'select',
                        'description' => esc_html__('Select fullwidth type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html('Default', BOOTY_TXT_DOMAIN),
                            'list' => esc_html('List', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'default',
                        'required' => array(
                            array('archive_post_layout', '=', 'fullwidth',),
                        ),
                    ),
                    array(
                        'id' => 'archive_post_layout_alt_type',
                        'type' => 'select',
                        'description' => esc_html__('Select alt type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html('Default', BOOTY_TXT_DOMAIN),
                            'alt2' => esc_html('ALT2', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'default',
                        'required' => array(
                            array('archive_post_layout', '=', 'alt',),
                        ),
                    ),
                    array(
                        'id' => 'archive_post_sidebar',
                        'type' => 'select',
                        'description' => esc_html__('Select sidebar', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'no-sidebar' => esc_html('No sidebar', BOOTY_TXT_DOMAIN),
                            'left-sidebar' => esc_html('Left sidebar', BOOTY_TXT_DOMAIN),
                            'right-sidebar' => esc_html('Right sidebar', BOOTY_TXT_DOMAIN),
                            'both-sidebar' => esc_html('Both sidebar', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'no-sidebar',
                        'required' => array(
                            array('archive_post_type', '!=', 'gird',),
                            array('archive_post_type', '!=', 'masonry'),
                            array('archive_post_layout_fullwidth_type', '!=', 'list'),
                        ),
                    ),
                    array(
                        'id' => 'archive_post_alt_sidebar',
                        'type' => 'select',
                        'description' => esc_html__('Select sidebar', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'no-sidebar' => esc_html('No sidebar', BOOTY_TXT_DOMAIN),
                            'left-sidebar' => esc_html('Left sidebar', BOOTY_TXT_DOMAIN),
                            'right-sidebar' => esc_html('Right sidebar', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'No sidebar',
                        'required' => array(
                            array('archive_post_layout', '=', 'alt'),
                        ),
                    ),
                    array(
                        'id' => 'archive_post_nav',
                        'type' => 'select',
                        'description' => esc_html__('Select loadmore or pagination', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'loadmore' => esc_html('Load More', BOOTY_TXT_DOMAIN),
                            'pagination' => esc_html('Pagination', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'loadmore',
                    ),
                    array(
                        'id' => 'archive_banner',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'show' => esc_html__('Show banner', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide banner', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'id' => 'archive_banner_bg',
                        'type' => 'background',
                        'transparent' => false,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/blog-banner.jpg',
                            'background-color' => '',
                        ),
                        'required' => array(
                            array('archive_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'archive_banner_text_default',
                        'type' => 'button_set',
                        'description' => esc_html__('Set Title Archive at Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html__('Title Archive', BOOTY_TXT_DOMAIN),
                            'custom' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'custom',
                        'required' => array(
                            array('archive_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'archive_banner_text',
                        'type' => 'ace_editor',
                        'description' => esc_html__('Single banner text custom', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your html code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => "<h1 class='heading text-uppercase'>Blog</h1>",
                        'required' => array(
                            array('archive_banner_text_default', '=', 'custom')
                        ),
                    ),
                    //single
                    array(
                        'id' => 'single_banner',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'show' => esc_html__('Show banner', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide banner', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'id' => 'single_banner_bg',
                        'type' => 'background',
                        'transparent' => false,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/single-banner.jpg',
                            'background-color' => '',
                        ),
                        'required' => array(
                            array('single_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'single_banner_text_default',
                        'type' => 'button_set',
                        'description' => esc_html__('Set Title Single at Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html__('Title Single', BOOTY_TXT_DOMAIN),
                            'custom' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'custom',
                        'required' => array(
                            array('single_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'single_banner_text',
                        'type' => 'ace_editor',
                        'description' => esc_html__('Single banner text custom', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your html code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => "<h1 class='heading text-uppercase'>Single Blog</h1>",
                        'required' => array(
                            array('single_banner_text_default', '=', 'custom')
                        ),
                    ),
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-file',
                'icon_class' => 'icon',
                'title' => esc_html__('Search', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    array(
                        'id' => 'search_banner',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'show' => esc_html__('Show banner', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide banner', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'id' => 'search_banner_bg',
                        'type' => 'background',
                        'transparent' => false,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/single-banner.jpg',
                            'background-color' => '',
                        ),
                        'required' => array(
                            array('search_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'search_banner_text_default',
                        'type' => 'button_set',
                        'description' => esc_html__('Set search title at Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html__('Search title', BOOTY_TXT_DOMAIN),
                            'custom' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'custom',
                        'required' => array(
                            array('search_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'search_banner_text',
                        'type' => 'ace_editor',
                        'description' => esc_html__('Search banner text custom', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your html code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => "<h1 class='heading text-uppercase'>" . esc_html__('Search', BOOTY_TXT_DOMAIN) . "</h1>",
                    ),
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-file',
                'icon_class' => 'icon',
                'title' => esc_html__('Portfolio', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    //archive
                    array(
                        'id' => 'archive_portfolio_layout',
                        'type' => 'select',
                        'title' => esc_html__('Layout type', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'normal' => esc_html('gird', BOOTY_TXT_DOMAIN),
                            'masonry' => esc_html('masonry', BOOTY_TXT_DOMAIN),
                            'parallax' => esc_html('parallax', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'normal',
                    ),
                    array(
                        'id' => 'archive_portfolio_layout_width',
                        'type' => 'select',
                        'title' => esc_html__('Layout width', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'full-width' => esc_html('Full width', BOOTY_TXT_DOMAIN),
                            'full-site' => esc_html('Full site', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'full-site',
                    ),
                    array(
                        'id' => 'archive_portfolio_space',
                        'type' => 'select',
                        'title' => esc_html__('Space item', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'space' => esc_html('Space', BOOTY_TXT_DOMAIN),
                            'no-space' => esc_html('No space', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'space',
                        'required' => array(
                            array('archive_portfolio_layout', '!=', 'parallax')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_column',
                        'type' => 'select',
                        'title' => esc_html__('Columns number', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '1' => esc_html('1 Column', BOOTY_TXT_DOMAIN),
                            '2' => esc_html('2 Column', BOOTY_TXT_DOMAIN),
                            '3' => esc_html('3 Column', BOOTY_TXT_DOMAIN),
                            '4' => esc_html('4 Column', BOOTY_TXT_DOMAIN),
                            '5' => esc_html('5 Column', BOOTY_TXT_DOMAIN),
                            '6' => esc_html('6 Column', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '2',
                        'required' => array(
                            array('archive_portfolio_layout', '!=', 'parallax')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_num_item',
                        'type' => 'spinner',
                        'title' => esc_html__('Number items', BOOTY_TXT_DOMAIN),
                        'default' => '10',
                        'min' => '4',
                        'step' => '1',
                        'max' => '15'
                    ),
                    array(
                        'id' => 'archive_portfolio_sitebar',
                        'type' => 'select',
                        'title' => esc_html__('Side bar', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'no-sidebar' => esc_html('No sidebar', BOOTY_TXT_DOMAIN),
                            'left-sidebar' => esc_html('Left sidebar', BOOTY_TXT_DOMAIN),
                            'right-sidebar' => esc_html('Right sidebar', BOOTY_TXT_DOMAIN),
                            'both-sidebar' => esc_html('Both sidebar', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'no-sidebar',
                        'default' => 'space', 'required' => array(
                            array('archive_portfolio_layout', '!=', 'parallax')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_sitebar_left',
                        'type' => 'select',
                        'title' => esc_html__('Sidebar left', BOOTY_TXT_DOMAIN),
                        'data' => 'sidebar',
                        'default' => 'left-sidebar',
                        'required' => array(
                            array('archive_portfolio_sitebar', '!=', 'right-sidebar'),
                            array('archive_portfolio_sitebar', '!=', 'no-sidebar')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_sitebar_right',
                        'type' => 'select',
                        'title' => esc_html__('Sidebar right', BOOTY_TXT_DOMAIN),
                        'data' => 'sidebar',
                        'default' => 'right-sidebar',
                        'required' => array(
                            array('archive_portfolio_sitebar', '!=', 'left-sidebar'),
                            array('archive_portfolio_sitebar', '!=', 'no-sidebar')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_effect',
                        'type' => 'select',
                        'title' => esc_html__('Effect', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html('default', BOOTY_TXT_DOMAIN),
                            'type1' => esc_html('Type1', BOOTY_TXT_DOMAIN),
                            'type2' => esc_html('Type2', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'default',
                        'required' => array(
                            array('archive_portfolio_layout', '!=', 'parallax')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_banner',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'show' => esc_html__('Show banner', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide banner', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'id' => 'archive_portfolio_banner_bg',
                        'type' => 'background',
                        'transparent' => false,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'background-image' => '',
                            'background-color' => '#f1f1f1',
                        ),
                        'required' => array(
                            array('archive_portfolio_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_banner_text_default',
                        'type' => 'button_set',
                        'description' => esc_html__('Set Title Archive at Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html__('Title Archive', BOOTY_TXT_DOMAIN),
                            'custom' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'custom',
                        'required' => array(
                            array('archive_portfolio_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'archive_portfolio_banner_text',
                        'type' => 'ace_editor',
                        'description' => esc_html__('Archive banner text custom', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your html code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => "<h1 class='heading text-uppercase'>portfolio</h1>",
                        'required' => array(
                            array('archive_portfolio_banner_text_default', '=', 'custom')
                        ),
                    ),
                    //single
                    array(
                        'id' => 'single_portfolio_banner',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'show' => esc_html__('Show banner', BOOTY_TXT_DOMAIN),
                            'hide' => esc_html__('Hide banner', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'show',
                    ),
                    array(
                        'id' => 'single_portfolio_banner_bg',
                        'type' => 'background',
                        'transparent' => false,
                        'background-repeat' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-position' => false,
                        'description' => esc_html__('Set background for header', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'background-image' => get_template_directory_uri() . '/inc/admin/settings/images/portfolio-banner.jpg',
                            'background-color' => '',
                        ),
                        'required' => array(
                            array('single_portfolio_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'single_portfolio_banner_text_default',
                        'type' => 'button_set',
                        'description' => esc_html__('Set Title Single at Banner', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'default' => esc_html__('Title Single', BOOTY_TXT_DOMAIN),
                            'custom' => esc_html__('Custom', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'custom',
                        'required' => array(
                            array('single_portfolio_banner', '=', 'show')
                        ),
                    ),
                    array(
                        'id' => 'single_portfolio_banner_text',
                        'type' => 'ace_editor',
                        'description' => esc_html__('Single banner text custom', BOOTY_TXT_DOMAIN),
                        'subtitle' => esc_html__('Paste your html code here.', BOOTY_TXT_DOMAIN),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => "<h1 class='heading text-uppercase'>portfolio</h1>",
                        'required' => array(
                            array('single_portfolio_banner_text_default', '=', 'custom')
                        ),
                    ),
                )
            );
            $sections[] = array(
                'icon' => 'el-icon-file',
                'icon_class' => 'icon',
                'title' => esc_html__('Product', BOOTY_TXT_DOMAIN),
                'fields' => array(
                    //Banner
                    array(
                        'id' => 'banner_slogan',
                        'type' => 'text',
                        'title' => esc_html__('Woo banner', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Slogan in banner', BOOTY_TXT_DOMAIN),
                        'default' => esc_html('YOUR SOLGAN HERE', BOOTY_TXT_DOMAIN),
                    ),
                    array(
                        'id' => 'woo_banner_image',
                        'type' => 'media',
                        'description' => esc_html__('Select an image file for your Banner.', BOOTY_TXT_DOMAIN),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/assets/images/img01.jpg'
                        )
                    ),
                    //archive
                    array(
                        'id' => 'archive_product_layout',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Setting', BOOTY_TXT_DOMAIN),
                        'description' => esc_html__('Select layout gird or list', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'gird' => esc_html('gird', BOOTY_TXT_DOMAIN),
                            'list' => esc_html('list', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'gird',
                    ),
                    array(
                        'id' => 'archive_product_column',
                        'type' => 'select',
                        'description' => esc_html__('Select columns for gird', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            '3' => esc_html('3columns', BOOTY_TXT_DOMAIN),
                            '4' => esc_html('4columns', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => '3',
                        'required' => array(
                            array('archive_product_layout', '=', 'gird')
                        ),
                    ),
                    array(
                        'id' => 'archive_product_width',
                        'type' => 'select',
                        'description' => esc_html__('Select width for gird', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'full-site' => esc_html('Normal', BOOTY_TXT_DOMAIN),
                            'full-width' => esc_html('Full Width', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'full-site',
                        'required' => array(
                            array('archive_product_layout', '=', 'gird')
                        ),
                    ),
                    array(
                        'id' => 'archive_product_sidebar',
                        'type' => 'select',
                        'description' => esc_html__('Select sidebar', BOOTY_TXT_DOMAIN),
                        'options' => array(
                            'no-sidebar' => esc_html('No Sidebar', BOOTY_TXT_DOMAIN),
                            'left-sidebar' => esc_html('Left Sidebar', BOOTY_TXT_DOMAIN),
                            'right-sidebar' => esc_html('Right Sidebar', BOOTY_TXT_DOMAIN),
                        ),
                        'default' => 'no-sidebar',
                    ),
                )
            );
            return $sections;
        }

        public function booty_get_setting_arguments() {
            $theme = wp_get_theme();
            $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'booty_settings',
                'display_name' => $theme->get('Name'),
                'display_version' => $theme->get('Version'),
                'menu_type' => 'menu',
                'allow_sub_menu' => true,
                'menu_title' => 'Booty',
                'page_title' => 'Booty',
                'google_api_key' => '',
                'google_update_weekly' => false,
                'async_typography' => true,
                'admin_bar' => true,
                'admin_bar_icon' => 'dashicons-admin-generic',
                'admin_bar_priority' => 50,
                'global_variable' => '',
                'dev_mode' => false,
                'update_notice' => true,
                'customizer' => true,
                'page_priority' => null,
                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'menu_icon' => '',
                'last_tab' => '',
                'page_icon' => 'icon-themes',
                'page_slug' => '',
                'save_defaults' => true,
                'default_show' => false,
                'default_mark' => '',
                'show_import_export' => true,
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                'output_tag' => true,
                'database' => '',
                'use_cdn' => true,
                // HINTS
                'hints' => array(
                    'icon' => 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'red',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );
            return $args;
        }

        protected function booty_header_types() {
            return array();
        }

        protected function booty_footer_types() {
            return array();
        }

    }

    global $bootyReduxSettings;
    $bootyReduxSettings = new Framework_Booty_Settings();
}