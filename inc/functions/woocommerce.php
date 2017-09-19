<?php
if (class_exists('YITH_WCQV_Frontend')) {
    $quick_view = YITH_WCQV_Frontend();
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_product_loop_tags', 5);
    remove_action('woocommerce_after_shop_loop_item', array($quick_view, 'yith_add_quick_view_button'), 15);
}
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 20);

function booty_minicart($type) {
    if ($type == "type_1")
        $booty_cart_type = 'cart-opener cartopener-main';
    elseif ($type == "type_2")
        $booty_cart_type = 'cart-opener opener-icons';elseif ($type == "type_3")
        $booty_cart_type = '';
    ob_start()
    ?>
    <?php
    if (!WC()->cart->is_empty()) :
        $booty_cart_num = count(WC()->cart->get_cart());
    else: $booty_cart_num = 0;
    endif;
    ?>
    <?php if ($type == 'type_4') { ?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-opener">
            <i class="fa fa-shopping-cart"></i>
            <span class="txt"><?php echo sprintf(esc_html__('Cart', BOOTY_TXT_DOMAIN) . '<span class="booty_cart_number">(' . '%s' . ')</span>', $booty_cart_num); ?></span>
            <span class="arrow"><i class="fa fa-angle-down"></i></span>
        </a>
    <?php } else { ?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="<?php echo $booty_cart_type; ?>">
            <i class="fa fa-shopping-cart"></i>
            <span class="cart-num"><?php if ($type == "type_3") echo sprintf(esc_html__('Cart', BOOTY_TXT_DOMAIN) . '<span class="booty_cart_number">(' . '%s' . ').</span>', $booty_cart_num);
        else echo '<span class="booty_cart_number">' . $booty_cart_num . '</span>' ?></span>
        </a>
    <?php
    }
    get_template_part('woocommerce/cart/mini-cart');
    return ob_get_clean();
}

function booty_account($layout) {
    global $booty_settings, $woocommerce;
    $config = $booty_settings;
    $wishlist = false;
    if (class_exists('YITH_WCWL')) {
        $wishlist = true;
    }
    if (class_exists('Woocommerce')) {
        $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        $logout_url = wp_logout_url(get_permalink($myaccount_page_id));
        $login_url = get_permalink($myaccount_page_id);
        if (get_option('woocommerce_force_ssl_checkout') == 'yes') {
            $logout_url = str_replace('http:', 'https:', $logout_url);
        }
    } else {
        $myaccount_page_id = get_edit_user_link();
        $login_url = wp_login_url(home_url());
        $logout_url = wp_logout_url(home_url());
    }
    ob_start()
    ?>
    <?php
    if (isset($config['' . $layout . '_option_top_show_myaccount']) && $config['' . $layout . '_option_top_show_myaccount'] == 'show') {

        echo '<li><a href="' . esc_url(get_permalink($myaccount_page_id)) . '">' . esc_html__('MY ACCOUNT', BOOTY_TXT_DOMAIN) . '</a></li>';
    }
    ?>
    <?php
    if (isset($config['' . $layout . '_option_top_show_wishlist']) && $config['' . $layout . '_option_top_show_wishlist'] == 'show' && $wishlist == true) {
        echo '<li><a href="' . esc_url(YITH_WCWL()->get_wishlist_url()) . '">' . esc_html__('WISHLIST', BOOTY_TXT_DOMAIN) . '</a></li>';
    }
    ?>
    <?php
    if (isset($config['' . $layout . '_option_top_show_login']) && $config['' . $layout . '_option_top_show_login'] == 'show') {
        if (!is_user_logged_in()) {
            echo '<li><a href="' . esc_url($login_url) . '">' . esc_html__('LOGIN', BOOTY_TXT_DOMAIN) . '</a></li>';
        } else {
            echo '<li><a href="' . esc_url($logout_url) . '">' . esc_html__('LOGOUT', BOOTY_TXT_DOMAIN) . '</a></li>';
        }
    }
    ?>
    <?php
    if (isset($config['' . $layout . '_option_top_show_checkout']) && $config['' . $layout . '_option_top_show_checkout'] == 'show') {
        if (class_exists('Woocommerce') && sizeof($woocommerce->cart->cart_contents) > 0) {
            echo '<li><a href="' . esc_url($woocommerce->cart->get_checkout_url()) . '">' . esc_html__('Checkout', BOOTY_TXT_DOMAIN) . '</a></li>';
        }
    }
    ?> 
    <?php
    return ob_get_clean();
}

add_filter('add_to_cart_text', 'woo_custom_cart_button_text');    // < 2.1

function woo_custom_cart_button_text() {
    return esc_html__('[ ADD TO CART ]', BOOTY_TXT_DOMAIN);
}

function booty_addShortcodesCustomCss($id = null) {
    if (is_shop()) {
        $id = get_option('woocommerce_shop_page_id');
    }
    if ($id) {
        $shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
        if (!empty($shortcodes_custom_css)) {
            $shortcodes_custom_css = strip_tags($shortcodes_custom_css);
            echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
            echo $shortcodes_custom_css;
            echo '</style>';
        }
    }
}

function booty_addPageCustomCss($id = null) {
    if (is_shop()) {
        $id = get_option('woocommerce_shop_page_id');
    }
    if ($id) {
        $post_custom_css = get_post_meta($id, '_wpb_post_custom_css', true);
        if (!empty($post_custom_css)) {
            $post_custom_css = strip_tags($post_custom_css);
            echo '<style type="text/css" data-type="vc_custom-css">';
            echo $post_custom_css;
            echo '</style>';
        }
    }
}

function booty_addFrontCss() {
    booty_addPageCustomCss();
    booty_addShortcodesCustomCss();
}

add_action('wp_footer', 'booty_addFrontCss', 1000);

function booty_get_rating_html($_product, $rating = null) {
    $rating_html = '';

    if (!is_numeric($rating)) {
        $rating = $_product->get_average_rating();
    }

    if ($rating > 0) {
        $rating_html = '<ul class="rating list-inline">';
        for ($i = 1; $i <= $rating; $i++) {
            $rating_html .= ' <li><i class="fa fa-star"></i></li>';
        }
        if ($rating < 5) {
            for ($i = $rating; $i < 5; $i++) {
                $rating_html .= ' <li><i class="fa fa-star-o"></i></li>';
            }
        }
        $rating_html .= '</ul>';
    }

    return apply_filters('woocommerce_product_get_rating_html', $rating_html, $rating);
}

add_filter('woocommerce_product_tabs', 'booty_woo_remove_product_tabs', 98);

function booty_woo_remove_product_tabs($tabs) {
    unset($tabs['additional_information']);   // Remove the additional information tab
    return $tabs;
}

function booty_woo_resual_count_header($query) {
    $paged = max(1, $query->get('paged'));
    $per_page = $query->get('posts_per_page');
    $total = $query->found_posts;
    $first = ( $per_page * $paged ) - $per_page + 1;
    $last = min($total, $query->get('posts_per_page') * $paged);

    if (1 === $total) {
        echo ('<p>' . esc_html__('Showing the single result', BOOTY_TXT_DOMAIN) . '</p>');
        esc_html_e('Showing the single result', BOOTY_TXT_DOMAIN);
    } elseif ($total <= $per_page || -1 === $per_page) {
        echo ('<p>' . esc_html__('Showing all', BOOTY_TXT_DOMAIN) . ' <a href="#">' . esc_html($total) . '</a> ' . esc_html__('Results', BOOTY_TXT_DOMAIN) . '</p>');
    } else {
        echo ('<p>' . esc_html__('Showing', BOOTY_TXT_DOMAIN) . ' <a href="#">' . esc_html($first) . '</a> - <a href="#">' . esc_html($last) . '</a> ' . esc_html__('of ', BOOTY_TXT_DOMAIN) . ' <a href="#">' . esc_html($total) . '</a> ' . esc_html__('Results', BOOTY_TXT_DOMAIN) . '</p>');
    }
}

function booty_woo_resual_count_footer($query) {
    $paged = max(1, $query->get('paged'));
    $per_page = $query->get('posts_per_page');
    $total = $query->found_posts;
    $first = ( $per_page * $paged ) - $per_page + 1;
    $last = min($total, $query->get('posts_per_page') * $paged);

    if (1 === $total) {
        echo ('<div class="txt-box"><p>' . esc_html__('Showing the single result', BOOTY_TXT_DOMAIN) . '</p></div>');
        esc_html_e('Showing the single result', BOOTY_TXT_DOMAIN);
    } elseif ($total <= $per_page || -1 === $per_page) {
        echo ('<div class="txt-box"><p>' . esc_html__('Showing all', BOOTY_TXT_DOMAIN) . ' <a href="#">' . esc_html($total) . '</a> ' . esc_html__('Results', BOOTY_TXT_DOMAIN) . '</p></div>');
    } else {
        echo ('<div class="txt-box"><p>' . esc_html($first) . ' - ' . esc_html($last) . ' ' . esc_html__('of about', BOOTY_TXT_DOMAIN) . ' ' . esc_html($total) . ' ' . esc_html__('results found', BOOTY_TXT_DOMAIN) . '</p></div>');
    }
}

function booty_woo_ordering() {
    ?>
    <form class="woocommerce-ordering shop-form" method="get">
        <select name="orderby" class="orderby">
            <option value="menu_order" selected="selected"><?php esc_html_e('Default sorting', BOOTY_TXT_DOMAIN); ?></option>
            <option value="popularity" <?php if (isset($_GET['orderby'])) selected($_GET['orderby'], 'popularity'); ?>><?php esc_html_e('Sort by popularity', BOOTY_TXT_DOMAIN); ?></option>
            <option value="rating" <?php if (isset($_GET['orderby'])) selected($_GET['orderby'], 'rating'); ?>><?php esc_html_e('Sort by average rating', BOOTY_TXT_DOMAIN); ?></option>
            <option value="date" <?php if (isset($_GET['orderby'])) selected($_GET['orderby'], 'date'); ?>><?php esc_html_e('Sort by newness', BOOTY_TXT_DOMAIN); ?></option>
            <option value="price" <?php if (isset($_GET['orderby'])) selected($_GET['orderby'], 'price'); ?>><?php esc_html_e('Sort by price: low to high', BOOTY_TXT_DOMAIN); ?></option>
            <option value="price-desc" <?php if (isset($_GET['orderby'])) selected($_GET['orderby'], 'price-desc'); ?>><?php esc_html_e('Sort by price: high to low', BOOTY_TXT_DOMAIN); ?></option>
        </select>
    </form>
    <?php
}

function booty_woo_nav() {
    ?>
    <div class="buttons-box">
        <a href="#" class="btn shop-prev">PREVIOUS</a>
        <a href="#" class="btn shop-next">next</a>
    </div>
    <ul class="shop-pagination list-inline">
        <li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
    </ul>
    <?php
}

add_action('woocommerce_archive_description', 'woocommerce_category_image', 2);

function woocommerce_category_image() {
    if (is_product_category()) {
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta($cat->term_id, 'thumbnail_id', true);
        if ($thumbnail_id) {
            $image = wp_get_attachment_url($thumbnail_id);
            if ($image) {
                echo '<img src="' . $image . '" alt="" />';
            }
        } else {
            if (function_exists('booty_settings')) {
                $config = booty_settings();
                $img_banner = $config['woo_banner_image']['url'];
                echo '<img src="' . esc_url($img_banner) . '" alt="" />';
            }
        }
    }
}

function booty_product() {
    global $product;
    return $product;
}

add_filter('woocommerce_billing_fields', 'booty_override_billing_fields');
add_filter('woocommerce_shipping_fields', 'booty_override_shipping_fields');
add_filter('woocommerce_checkout_fields', 'booty_custom_override_checkout_fields');

function booty_override_billing_fields($fields) {
    $fields['billing_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_company'] = array(
        'label' => 'Company name',
        'placeholder' => _x('Company Name', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['billing_email'] = array(
        'label' => 'Email',
        'placeholder' => _x('E-mail *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_address_1'] = array(
        'label' => 'Address',
        'placeholder' => _x('Address', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['billing_address_2'] = array(
        'label' => 'Apartment, suite, unit etc. (optional)',
        'placeholder' => _x('Apartment, suite, unit etc. (optional)', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['billing_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postcode / Zip *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_city'] = array(
        'label' => 'Town / City',
        'placeholder' => _x('Town / City *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    return $fields;
}

function booty_override_shipping_fields($fields) {
    $fields['shipping_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_company'] = array(
        'label' => 'Company name',
        'placeholder' => _x('Company Name', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['shipping_email'] = array(
        'label' => 'Email',
        'placeholder' => _x('E-mail *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_address_1'] = array(
        'label' => 'Address',
        'placeholder' => _x('Address *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_address_2'] = array(
        'label' => 'Apartment, suite, unit etc. (optional)',
        'placeholder' => _x('Apartment, suite, unit etc. (optional)', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['shipping_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postcode / Zip *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_city'] = array(
        'label' => 'Town / City',
        'placeholder' => _x('Town / City *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    return $fields;
}

function booty_custom_override_checkout_fields($fields) {

    $fields['billing']['billing_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing']['billing_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing']['billing_company'] = array(
        'label' => '',
        'placeholder' => _x('Company Name', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
        'class' => array('form-row-wide'),
    );
    $fields['billing']['billing_address_1'] = array(
        'label' => '',
        'placeholder' => _x('Address', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
        'class' => array('form-row-wide'),
    );
    $fields['billing']['billing_address_2'] = array(
        'label' => '',
        'placeholder' => _x('Enter Your Apartment', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['billing']['billing_city'] = array(
        'label' => 'City',
        'placeholder' => _x('City *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing']['billing_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postcode / Zip *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
        'value' => '',
    );
    $fields['billing']['billing_email'] = array(
        'label' => 'Email Address',
        'placeholder' => _x('E-mail *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing']['billing_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['billing']['billing_state'] = array(
        'label' => 'State / County',
        'placeholder' => _x('State / County', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['shipping']['shipping_phone'] = array(
        'label' => 'Phone',
        'placeholder' => _x('Phone Number *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_first_name'] = array(
        'label' => 'First Name',
        'placeholder' => _x('First Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_last_name'] = array(
        'label' => 'Last Name',
        'placeholder' => _x('Last Name *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_company'] = array(
        'label' => 'Company Name',
        'placeholder' => _x('Company Name', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
        'class' => array('form-row-wide'),
    );
    $fields['shipping']['shipping_city'] = array(
        'label' => 'City',
        'placeholder' => _x('City *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_state'] = array(
        'label' => 'Enter State/Country',
        'placeholder' => _x('Enter State/Country *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
    );
    $fields['shipping']['shipping_email'] = array(
        'label' => 'Email Address',
        'placeholder' => _x('E-mail *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_postcode'] = array(
        'label' => 'Postcode / Zip',
        'placeholder' => _x('Postal Code *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
    );
    $fields['shipping']['shipping_address_1'] = array(
        'label' => 'Adress',
        'placeholder' => _x('Address *', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => true,
        'class' => array('form-row-wide'),
    );
    $fields['order']['order_comments'] = array(
        'label' => 'Order notes',
        'placeholder' => _x('Order Notes', 'placeholder', BOOTY_TXT_DOMAIN),
        'required' => false,
        'type' => 'textarea',
        'class' => array('form-row-wide'),
    );


    return $fields;
}

function booty_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        if ($query->is_search) {
            if (isset($_GET['s_post_type']) && $_GET['s_post_type'] == 'product')
                $query->set('post_type', 'product');
        }
    }
}

add_action('pre_get_posts', 'booty_search_filter');
