<?php

/**
 * Bestseller product
 */
class WP_Booty_Widget_Bestseller_Product extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_bestseller_product', 'description' => esc_html__("Woocommerce bestseller product.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-bestseller-product', esc_html__('[Booty] Woocommerce bestseller Product', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_bestseller_product';
    }

    public function widget($args, $instance) {

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        ?>
        <div class="shop-widget sellers-widget">
        <?php
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
            <?php
            global $product;
            $WC_Bestseller = new WC_Bestseller();
            $args_id = $WC_Bestseller->list_product_bestseller($instance['number']);
            foreach ($args_id as $value) {
                $id_post = $value->product_id;
                ?>
                <article class="top-seller">
                    <div class="alignleft">
                        <a href="<?php echo get_permalink($id_post); ?>" alt="">
                            <?php echo get_the_post_thumbnail($id_post, 'booty_imag_latest_widget'); ?>
                        </a>
                    </div>
                    <div class="txt-box">
                        <strong class="title"><?php echo get_the_title($id_post); ?></strong>
                        <?php
                        $_pf = new WC_Product_Factory();
                        $_product = $_pf->get_product($id_post);

                        if ($_product->get_rating_html() == '') {
                            echo '<ul class="rattings-nav list-inline">
                                    <li class="add"><i class="fa fa-star"></i></li>
                                    <li class="add"><i class="fa fa-star"></i></li>
                                    <li class="add"><i class="fa fa-star"></i></li>
                                    <li class="add"><i class="fa fa-star"></i></li>
                                    <li class="add"><i class="fa fa-star"></i></li>
                                </ul>';
                        } else {
                            echo '<div class="rattings-nav">' . $_product->get_rating_html() . '</div>';
                        }
                        ?>
                        <div class="inline">
                            <?php
                            echo $_product->get_price_html();
                            ?>
                        </div>
                    </div>
                </article>
                <?php
            };
            ?>
        </div>
        <?php
        wp_reset_postdata();
        ?>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number = isset($instance['number']) ? esc_attr($instance['number']) : '';
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php esc_html_e('Nuber show item(s):', BOOTY_TXT_DOMAIN); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" /></p>
        <?php
    }

}

/**
 *
 */
require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-admin-report.php' );

class WC_Bestseller extends WC_Admin_Report {

    public function list_product_bestseller($number) {
        $args_bestseller = array(
            'data' => array(
                '_product_id' => array(
                    'type' => 'order_item_meta',
                    'order_item_type' => 'line_item',
                    'function' => '',
                    'name' => 'product_id'
                ),
                '_qty' => array(
                    'type' => 'order_item_meta',
                    'order_item_type' => 'line_item',
                    'function' => 'SUM',
                    'name' => 'order_item_qty'
                )
            ),
            'where_meta' => array(
                array(
                    'type' => 'order_item_meta',
                    'meta_key' => '_line_subtotal',
                    'meta_value' => '0',
                    'operator' => '>'
                )
            ),
            'order_by' => 'order_item_qty DESC',
            'group_by' => 'product_id',
            'limit' => $number,
            'query_type' => 'get_results',
        );

        $best_sellers = WC_Admin_Report::get_order_report_data($args_bestseller);
        return $best_sellers;
    }

}
