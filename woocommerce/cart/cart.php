<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $product;
?>
<div class="row m_bottom_10 margin-top-100">
    <?php
    wc_print_notices();
    do_action('woocommerce_before_cart');
    ?>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <?php $countitem = sprintf(_n('Your shopping cart contains %d product', 'Your shopping cart contains %d products', WC()->cart->cart_contents_count, BOOTY_TXT_DOMAIN), WC()->cart->cart_contents_count); ?>
        <p class="fw_light"><?php echo $countitem; ?></p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 tl-right">
        <a href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>" class="continue-shop"><i class="icon-basket d_inline_b m_right_5"></i> <?php esc_html_e('Continue Shopping', BOOTY_TXT_DOMAIN); ?></a>
    </div>
</div>
<form action="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" method="post">

    <?php do_action('woocommerce_before_cart_table'); ?>
    <div class="table-block">
        <table class="shop_table shop_table_responsive cart" cellspacing="0">
            <thead>
                <tr class="gray">
                    <th class="product-thumbnail ico-1"><?php esc_html_e('Product', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-color ico-2"><?php esc_html_e('Color', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-size ico-2"><?php esc_html_e('Size', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-price ico-4"><?php esc_html_e('Price', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-quantity ico-5"><?php esc_html_e('Quantity', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-subtotal ico-6"><?php esc_html_e('Total', BOOTY_TXT_DOMAIN); ?></th>
                    <th class="product-remove ico-7">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php do_action('woocommerce_before_cart_contents'); ?>

                <?php
                $i = 0;
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        ?>
                        <tr class="tr_delay <?php if ($i % 2 != 0) echo 'gray ';
                echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <td class="product-thumbnail ico-1" data-title="Product Image">
                                <div class="alignleft">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$_product->is_visible()) {
                                        echo $thumbnail;
                                    } else {
                                        printf('<a href="%s">%s</a>', esc_url($_product->get_permalink($cart_item)), $thumbnail);
                                    }
                                    ?>
                                </div>
                                <span class="product-name">
                                    <?php
                                    if (!$_product->is_visible()) {
                                        echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key) . '&nbsp;';
                                    } else {
                                        echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="color_dark tr_all">%s </a>', esc_url($_product->get_permalink($cart_item)), $_product->get_title()), $cart_item, $cart_item_key);
                                    }
                                    ?>
                                </span>
                            </td>
                            <?php
                            if ($cart_item['variation']) :
                                foreach ($cart_item['variation'] as $name => $value) {
                                    $taxonomy = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', urldecode($name)));
                                    $term = get_term_by('slug', $value, $taxonomy);

                                    if (!is_wp_error($term) && $term && $term->name) {
                                        $value = $term->name;
                                    }
                                    echo '<td class="product-name ico-2" data-title="Description">' . $value . '</td>';
                                }
                            else :
                                ?>
                                <td class="product-name ico-2" data-title="Description"></td>
                                <td class="product-name ico-2" data-title="Description"></td>
                            <?php
                            endif;
                            ?>
                            <td class="product-price ico-4" data-title="Price">
                                <?php
                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                ?>
                            </td>

                            <td class="product-quantity ico-5" data-title="Quantity">
                                <?php
                                if ($_product->is_sold_individually()) {
                                    $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                } else {
                                    $product_quantity = woocommerce_quantity_input(array(
                                        'input_name' => "cart[{$cart_item_key}][qty]",
                                        'input_value' => $cart_item['quantity'],
                                        'max_value' => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
                                        'min_value' => '0'
                                            ), $_product, false);
                                }

                                echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                ?>
                            </td>
                            <td class="product-subtotal ico-6" data-title="Total">
                                <?php
                                echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                ?>
                            </td>
                            <td class="product-remove">
                                <?php
                                echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
                                                '<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><i class="fa fa-times"></i></a>', esc_url(WC()->cart->get_remove_url($cart_item_key)), __('Remove this item', BOOTY_TXT_DOMAIN), esc_attr($product_id), esc_attr($_product->get_sku())
                                        ), $cart_item_key);
                                ?>
                            </td>
                        </tr>
        <?php
    }
    $i++;
}

do_action('woocommerce_cart_contents');
?>

                <?php do_action('woocommerce_after_cart_contents'); ?>
            </tbody>
        </table>
    </div>
<?php do_action('woocommerce_after_cart_table'); ?>
    <div class="cart-collaterals m_top_10 padding-bottom-100">
    <?php do_action('woocommerce_cart_collaterals'); ?>
    </div>
</form>

<?php do_action('woocommerce_after_cart'); ?>
