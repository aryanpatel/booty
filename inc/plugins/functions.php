<?php

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once BOOTY_PLUGINS . '/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'booty_theme_register_required_plugins');

function booty_theme_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'Redux Framework',
            'slug' => 'redux-framework',
            'required' => true
        ),
        // This is an example of how to include a plugin bundled with a theme.
//        array(
//            'name' => 'Revolution Slider', // The plugin name.
//            'slug' => 'revslider', // The plugin slug (typically the folder name).
//            'source' => $remote_url . '/revslider.zip', // The plugin source.
//            'required' => true // If false, the plugin is only 'recommended' instead of required.
//        ),
//        array(
//            'name' => 'WPBakery Visual Composer',
//            'slug' => 'js_composer',
//            'source' => $remote_url . '/js_composer.zip',
//            'required' => true
//        ),
//        array(
//            'name' => 'Ultimate Addons for Visual Composer',
//            'slug' => 'Ultimate_VC_Addons',
//            'source' => $remote_url . '/Ultimate_VC_Addons.zip',
//            'required' => true
//        ),
//        array(
//            'name' => 'Fekra Post Types',
//            'slug' => 'fekra-post-types',
//            'source' => $remote_url . '/fekra/fekra-post-types.zip',
//            'required' => true
//        ),
//        array(
//            'name' => 'Fekra Shortcodes',
//            'slug' => 'fekra-shortcodes',
//            'source' => $remote_url . '/fekra/fekra-shortcodes.zip',
//            'required' => true
//        ),
//        array(
//            'name' => 'Fekra Latest Tweets',
//            'slug' => 'fekra-latest-tweets',
//            'source' => $remote_url . '/fekra/fekra-latest-tweets.zip',
//            'required' => true
//        ),
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => true
        ),
        array(
            'name' => 'MailChimp for WordPress',
            'slug' => 'mailchimp-for-wp',
            'required' => true,
        ),
        array(
            'name' => 'WP User Avatar',
            'slug' => 'wp-user-avatar',
            'required' => true,
        ),
        array(
            'name' => 'Black Studio TinyMCE Widget',
            'slug' => 'black-studio-tinymce-widget',
            'required' => true,
        ),
        array(
            'name' => 'Woocommerce',
            'slug' => 'woocommerce',
            'required' => true
        ),
        array(
            'name' => 'YITH WooCommerce Quick View',
            'slug' => 'yith-woocommerce-quick-view',
            'required' => true
        ),
        array(
            'name' => 'YITH WooCommerce Compare',
            'slug' => 'yith-woocommerce-compare',
            'required' => true
        ),
        array(
            'name' => 'YITH WooCommerce Wishlist',
            'slug' => 'yith-woocommerce-wishlist',
            'required' => true
        ),
        array(
            'name' => 'YITH WooCommerce Ajax Product Filter',
            'slug' => 'yith-woocommerce-ajax-navigation',
            'required' => true
        ),
        array(
            'name' => 'Regenerate Thumbnails',
            'slug' => 'regenerate-thumbnails',
            'required' => false
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'booty', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'install-required-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => esc_html__('Install Required Plugins', BOOTY_TXT_DOMAIN),
            'menu_title' => esc_html__('Install Plugins', BOOTY_TXT_DOMAIN),
            'installing' => esc_html__('Installing Plugin: %s', BOOTY_TXT_DOMAIN), // %s = plugin name.
            'oops' => esc_html__('Something went wrong with the plugin API.', BOOTY_TXT_DOMAIN),
            'notice_can_install_required' => _n_noop(
                    'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', BOOTY_TXT_DOMAIN
            ), // %1$s = plugin name(s).
            'install_link' => _n_noop(
                    'Begin installing plugin', 'Begin installing plugins', BOOTY_TXT_DOMAIN
            ),
            'update_link' => _n_noop(
                    'Begin updating plugin', 'Begin updating plugins', BOOTY_TXT_DOMAIN
            ),
            'activate_link' => _n_noop(
                    'Begin activating plugin', 'Begin activating plugins', BOOTY_TXT_DOMAIN
            ),
            'return' => esc_html__('Return to Required Plugins Installer', BOOTY_TXT_DOMAIN),
            'plugin_activated' => esc_html__('Plugin activated successfully.', BOOTY_TXT_DOMAIN),
            'activated_successfully' => esc_html__('The following plugin was activated successfully:', BOOTY_TXT_DOMAIN),
            'plugin_already_active' => esc_html__('No action taken. Plugin %1$s was already active.', BOOTY_TXT_DOMAIN), // %1$s = plugin name(s).
            'plugin_needs_higher_version' => esc_html__('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', BOOTY_TXT_DOMAIN), // %1$s = plugin name(s).
            'complete' => esc_html__('All plugins installed and activated successfully. %1$s', BOOTY_TXT_DOMAIN), // %s = dashboard link.
            'contact_admin' => esc_html__('Please contact the administrator of this site for help.', BOOTY_TXT_DOMAIN),
            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        ),
    );

    tgmpa($plugins, $config);
}
