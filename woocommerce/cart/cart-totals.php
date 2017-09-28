<?php
/**
 * Cart totals
 *
 */
if (!defined('ABSPATH')) {
    exit;
}
do_action('woocommerce_before_cart_totals');
?>

<table class="shop_table shop-apply" cellspacing="0">
    <tr class="order-total">
        <td colspan="7" class="t_align_r fw_light">
<?php if (WC()->cart->coupons_enabled()) { ?>
                <div class="apply-form">
                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" value="" placeholder="<?php esc_html_e('Coupon code', BOOTY_TXT_DOMAIN); ?>" />
                    <input type="submit" class="btn btn-slider" name="apply_coupon" value="<?php esc_html_e('Submit', BOOTY_TXT_DOMAIN); ?>" />

                <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
<?php } ?>

        </td>
        <td colspan="2" class="fw_ex_bold color_pink total_bold">
            <input type="submit" class="btn btn-slider" name="update_cart" value="<?php esc_html_e('Update', BOOTY_TXT_DOMAIN); ?>" />

            <?php do_action('woocommerce_cart_actions'); ?>

<?php wp_nonce_field('woocommerce-cart'); ?>
        </td>
    </tr>
    <tr class="cart-subtotal">
        <td colspan="7" class="t_align_r fw_light"><?php esc_html_e('Total products', BOOTY_TXT_DOMAIN); ?></td>
        <td colspan="2"><?php wc_cart_totals_subtotal_html(); ?></td>
    </tr>

<?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
        <tr class="cart-discount coupon-<?php echo esc_attr(sanitize_title($code)); ?>">
            <td colspan="7" class="t_align_r fw_light"><?php wc_cart_totals_coupon_label($coupon); ?></td>
            <td colspan="2"><?php wc_cart_totals_coupon_html($coupon); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>

        <?php do_action('woocommerce_cart_totals_before_shipping'); ?>

        <?php wc_cart_totals_shipping_html(); ?>

        <?php do_action('woocommerce_cart_totals_after_shipping'); ?>

<?php elseif (WC()->cart->needs_shipping()) : ?>

        <tr class="shipping">
            <td colspan="7" class="t_align_r fw_light"><?php esc_html_e('Total shipping', BOOTY_TXT_DOMAIN); ?></td>
            c
            <td colspan="2"><?php woocommerce_shipping_calculator(); ?></td>
        </tr>

    <?php endif; ?>

<?php foreach (WC()->cart->get_fees() as $fee) : ?>
        <tr class="fee">
            <td colspan="7" class="t_align_r fw_light"><?php echo esc_html($fee->name); ?></td>
            <td colspan="2"><?php wc_cart_totals_fee_html($fee); ?></td>
        </tr>
    <?php endforeach; ?>

    <?php if (wc_tax_enabled() && WC()->cart->tax_display_cart == 'excl') : ?>
        <?php if (get_option('woocommerce_tax_total_display') == 'itemized') : ?>
        <?php foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
                <tr class="tax-rate tax-rate-<?php echo sanitize_title($code); ?>">
                    <td colspan="7" class="t_align_r fw_light"><?php esc_html_e('Total (tax excl.):', BOOTY_TXT_DOMAIN); ?></td>
                    <td colspan="2"><?php echo wp_kses_post($tax->formatted_amount); ?></td>
                </tr>
            <?php endforeach; ?>
    <?php else : ?>
            <tr class="tax-total">
                <td colspan="7" class="t_align_r fw_light"><?php esc_html_e('Total tax:', BOOTY_TXT_DOMAIN); ?>></th>
                <td colspan="2"><?php wc_cart_totals_taxes_total_html(); ?></td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>

<?php do_action('woocommerce_cart_totals_before_order_total'); ?>
    <tr>
        <td colspan="7" rowspan="" headers="">
            <span class="line_40 fw_ex_bold color_pink f_right"><?php esc_html_e('Total', BOOTY_TXT_DOMAIN); ?></span>
        </td>
        <td colspan="2" rowspan="" headers="">
<?php wc_cart_totals_order_total_html(); ?>
        </td>
    </tr>
<?php do_action('woocommerce_cart_totals_after_order_total'); ?>

</table>

        <?php if (WC()->cart->get_cart_tax()) : ?>
    <p class="wc-cart-shipping-notice"><small><?php
            $estimated_text = WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping() ? sprintf(' ' . esc_html__(' (taxes estimated for %s)', BOOTY_TXT_DOMAIN), WC()->countries->estimated_for_prefix() . WC()->countries->countries[WC()->countries->get_base_country()] . '') : '';

            printf(esc_html__('Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', BOOTY_TXT_DOMAIN), $estimated_text);
            ?></small></p>
<?php endif; ?>

<div class="wc-proceed-to-checkout shop-apply">

<?php do_action('woocommerce_proceed_to_checkout'); ?>

</div>

<?php do_action('woocommerce_after_cart_totals'); ?>
