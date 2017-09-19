<?php

/**
 * booty theme setup functions
 */
//-- Restrict direct access
if (!defined('ABSPATH')) {
    die('Cheatin\' huh?');
}

require( BOOTY_FUNCTIONS . '/class_theme_base.php' );
require( BOOTY_FUNCTIONS . '/class_theme_ajax.php' );
require( BOOTY_FUNCTIONS . '/class-post-like.php' );
require( BOOTY_LIB . '/widgets/widgets.php' );
require_once(BOOTY_ADMIN . '/functions.php');
require_once (BOOTY_FUNCTIONS . '/functions.php');
require_once (BOOTY_METABOXES.'/functions.php');

/**
 * Resize Image
 */
add_image_size('booty_image_shop_carousel', 370, 507, true);
add_image_size('booty_image_shop_sell', 270, 270, true);
add_image_size('booty_imag_latest_widget', 100, 100, true);
add_image_size('booty_imag_product_slide_thumn', 125, 145, true);
add_image_size('booty_clients', 250, 130, true);
