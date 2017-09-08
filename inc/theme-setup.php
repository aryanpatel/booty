<?php

/**
 * booty theme setup functions
 */
//-- Restrict direct access
if (!defined('ABSPATH')) {
    die('Cheatin\' huh?');
}
require( BOOTY_DIR . '/inc/functions/class_theme_base.php' );
require_once(BOOTY_ADMIN . '/functions.php');

/**
 * Resize Image
 */
add_image_size('fekra_image_shop_carousel', 370, 507, true);
add_image_size('fekra_image_shop_sell', 270, 270, true);
add_image_size('fekra_imag_latest_widget', 100, 100, true);
add_image_size('fekra_imag_product_slide_thumn', 125, 145, true);
add_image_size('fekra_clients', 250, 130, true);
