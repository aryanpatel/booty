<?php

if (!class_exists('WP_Booty_Widget_Contact')) {
    require get_template_directory() . '/inc/widgets/booty-contact.php';
}
if (!class_exists('WP_Booty_Widget_Recent_Posts')) {
    require get_template_directory() . '/inc/widgets/booty-recent_posts.php';
}
if (!class_exists('Booty_Flick_Photo')) {
    require get_template_directory() . '/inc/widgets/booty-flick.php';
}
/* Instagram */
if (!class_exists('Booty_Instagram_Photo')) {
    require get_template_directory() . '/inc/widgets/booty-instagram.php';
}
//contact form 7
if (!class_exists('WP_Booty_Widget_Contact_Form7') && class_exists('WPCF7_ContactForm')) {
    require get_template_directory() . '/inc/widgets/booty-contact-form7.php';
}
if (!class_exists('WP_Booty_Widget_Social_Links')) {
    require get_template_directory() . '/inc/widgets/booty-social-links.php';
}

/* Sale product */
if (!class_exists('WP_Booty_Widget_Testimonial')) {
    require get_template_directory() . '/inc/widgets/booty-testimonial.php';
}
/* Sale product */
if (!class_exists('WP_Booty_Widget_Sale_Product') && class_exists('Woocommerce')) {
    require get_template_directory() . '/inc/widgets/woocommerce-sale-product.php';
}
/* Featured product */
if (!class_exists('WP_Booty_Widget_Featured_Product') && class_exists('Woocommerce')) {
    require get_template_directory() . '/inc/widgets/woocommerce-featured-product.php';
}
/* Bestsellers product */
if (!class_exists('WP_Booty_Widget_Bestseller_Product') && class_exists('Woocommerce')) {
    require get_template_directory() . '/inc/widgets/woocommerce-bestseller-product.php';
}
/* Attributes product */
if (!class_exists('WP_Booty_Widget_Attributes_Product') && class_exists('Woocommerce')) {
    require get_template_directory() . '/inc/widgets/woocommerce-attributes-product.php';
}
/* Bestsellers product */
if (!class_exists('WP_Booty_Widget_Filter_Product') && class_exists('Woocommerce')) {
    require get_template_directory() . '/inc/widgets/woocommerce-filter-product.php';
}
/* Tab blog widget */
if (!class_exists('WP_Booty_Widget_tabs')) {
    require get_template_directory() . '/inc/widgets/tabs-widget.php';
}

/* Multiple menu */
if (!class_exists('WP_Booty_Widget_multiple')) {
    require get_template_directory() . '/inc/widgets/booty-multiple-menu.php';
}
/* Viddeo */
if (!class_exists('Booty_Popular_Video')) {
    require get_template_directory() . '/inc/widgets/booty-video.php';
}
/* Counter */
if (!class_exists('WP_Booty_Widget_Counter')) {
    require get_template_directory() . '/inc/widgets/booty-counter.php';
}

add_action('admin_enqueue_scripts', 'booty_wdscript');

function booty_wdscript() {
    wp_enqueue_media();
    wp_enqueue_script('booty_wdscript', get_template_directory_uri() . '/inc/widgets/js/widget.js', false, '1.0', true);
}

function booty_extra_widgets_init() {
    register_widget('WP_Booty_Widget_Contact');
    register_widget('WP_Booty_Widget_Recent_Posts');
    register_widget('Booty_Flick_Photo');
    if (class_exists('WPCF7_ContactForm')) {
        register_widget('WP_Booty_Widget_Contact_Form7');
    }
    register_widget('WP_Booty_Widget_Social_Links');
    if (class_exists('Woocommerce')) {
        register_widget('WP_Booty_Widget_Sale_Product');
        register_widget('WP_Booty_Widget_Featured_Product');
        register_widget('WP_Booty_Widget_Bestseller_Product');
        register_widget('WP_Booty_Widget_Attributes_Product');
        register_widget('WP_Booty_Widget_Filter_Product');
    }

    register_widget('WP_Booty_Widget_multiple');
    register_widget('Booty_Instagram_Photo');
    register_widget('WP_Booty_Widget_tabs');
    register_widget('Booty_Popular_Video');
    register_widget('WP_Booty_Widget_Counter');
    register_widget('WP_Booty_Widget_Testimonial');
}

add_action('widgets_init', 'booty_extra_widgets_init');
