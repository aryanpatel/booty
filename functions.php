<?php

$theme = wp_get_theme();
define('BOOTY_VERSION', $theme->Version);
define('BOOTY_TXT_DOMAIN', $theme->TextDomain);
define('BOOTY_URI', get_template_directory_uri());
define('BOOTY_DIR', get_template_directory());
define('BOOTY_LIB', get_template_directory() . '/inc');
define('BOOTY_ADMIN', BOOTY_LIB . '/admin');
define('BOOTY_FUNCTIONS', BOOTY_LIB . '/functions');
define('BOOTY_ASSEST_DIR', BOOTY_URI . '/assets');
define('BOOTY_PLUGINS', BOOTY_LIB . '/plugins');
define('BOOTY_METABOXES', BOOTY_FUNCTIONS . '/metaboxes');
if (!class_exists('Booty_Nav_Walker')) {
    include BOOTY_DIR . '/inc/booty_nav_walker.php';
}
if ( ! defined( 'BOOTY_DIR_URI') ) :
    define( 'BOOTY_DIR_URI', get_template_directory_uri() );
endif;
require_once(BOOTY_PLUGINS . '/functions.php');
require( BOOTY_LIB . '/theme-setup.php' );
add_action('after_setup_theme', 'booty_setup');

if (!function_exists('booty_setup')) {

    function booty_setup() {
        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'top' => __('Top Menu', BOOTY_TXT_DOMAIN),
            'social' => __('Social Links Menu', BOOTY_TXT_DOMAIN),
        ));
        add_theme_support('post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
        ));
        add_theme_support('automatic-feed-links');
        add_theme_support('custom-header');
        add_theme_support('custom-background');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('woocommerce');
        add_theme_support( 'customize-selective-refresh-widgets' );
    }

}

function prefix_modify_nav_menu_args($args) {
    return array_merge($args, array(
        'walker' => new Booty_Nav_Walker(),
    ));
}

add_filter('wp_nav_menu_args', 'prefix_modify_nav_menu_args');
add_action('wp_enqueue_scripts', 'booty_enqueue_scripts');

function booty_enqueue_scripts() {
    $booty_styles_array = array(
        'font-en' => get_template_directory_uri() . '/assets/vc-entypo/vc_entypo.css',
        'asets' => get_template_directory_uri() . '/assets/css/style.css',
        'button' => get_template_directory_uri() . '/assets/css/button-component.css',
        'media' => get_template_directory_uri() . '/assets/css/mediaelementplayer.css',
        'bootstrap-base' => get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        'awe' => get_template_directory_uri() . '/assets/css/font-awesome.min.css',
        'page-asset' => get_template_directory_uri() . '/assets/css/page-assets.css',
        'helper-elements' => get_template_directory_uri() . '/assets/css/helper-elements.css',
        'theme' => get_template_directory_uri() . '/assets/css/theme.css',
        'theme2' => get_template_directory_uri() . '/assets/css/theme2.css',
        'animate' => get_template_directory_uri() . '/assets/css/animate.css'
    );
    $booty_script_array = array(
        'popper' => get_template_directory_uri() . '/js/popper.min.js',
        'bootstrap-base' => get_template_directory_uri() . '/js/bootstrap.min.js'
    );
    wp_register_style('vc-entypo', $booty_styles_array['font-en']);
    wp_enqueue_style('vc-entypo');
    wp_register_style('booty-style-assets', $booty_styles_array['asets']);
    wp_enqueue_style('booty-style-assets');
    wp_register_style('booty-button-style', $booty_styles_array['button']);
    wp_enqueue_style('booty-button-style');
    wp_register_style('booty-media', $booty_styles_array['media']);
    wp_enqueue_style('booty-media');
    wp_register_style('bootstrap-base', $booty_styles_array['bootstrap-base']);
    wp_enqueue_style('bootstrap-base');
    wp_register_style('booty-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('booty-style');
    wp_register_style('booty-font-awsome', $booty_styles_array['awe']);
    wp_enqueue_style('booty-font-awsome');
    wp_register_style('booty-page-asset', $booty_styles_array['page-asset']);
    wp_enqueue_style('booty-page-asset');
    wp_register_style('booty-helper-elements', $booty_styles_array['helper-elements']);
    wp_enqueue_style('booty-helper-elements');
    wp_register_style('booty-theme', $booty_styles_array['theme']);
    wp_enqueue_style('booty-theme');
    wp_register_style('booty-theme2', $booty_styles_array['theme2']);
    wp_enqueue_style('booty-theme2');
    wp_register_style('booty-animate', $booty_styles_array['animate']);
    wp_enqueue_style('booty-animate');


    wp_register_script('popper', $booty_script_array['popper']);
    wp_enqueue_script('popper');
    wp_register_script('bootstrap-base', $booty_script_array['bootstrap-base']);
    wp_enqueue_script('bootstrap-base');
}
