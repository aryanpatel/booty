<?php $config = booty_settings(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="">
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <?php if ((!function_exists('has_site_icon') || !has_site_icon()) && !empty($config['favicon_main'])): ?>
            <link rel="shortcut icon" href="<?php echo esc_url(is_ssl() ? (str_replace("http://", "https://", $config['favicon_main']['url'])) : $config['favicon_main']['url']) ?> "/>
            <?php
        endif;
        wp_head();
        ?>
    </head>
    <body <?php body_class(); ?>>
        <?php
        $booty_wrapper_class = '';
        if (isset($config['header_layout']) && $config['header_layout'] == 'header_layout_17')
            $booty_wrapper_class .= 'no-boxed';
        if (booty_header_fixed())
            $booty_wrapper_class .= ' header_fixed';
        if (booty_header_over())
            $booty_wrapper_class .= ' header_over';
        if ((function_exists('is_product') || function_exists('is_product_tag') || function_exists('is_product_category')) && (is_product() || is_product_tag() || is_product_category())) {
            $booty_wrapper_class .= ' header_fixed header_over';
        }
        //        if (has_nav_menu('top')) :
//            get_template_part('template-parts/navigation/navigation', 'top');
//        endif;
        ?>
        <!-- Page pre loader -->
        <?php echo booty_pre_loader(); ?>
        <div id="wrapper" class="<?php echo $booty_wrapper_class; ?>">
            <?php echo booty_header_types(); ?>