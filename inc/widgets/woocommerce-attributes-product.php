<?php

/**
 * Attributes product
 */
class WP_Booty_Widget_Attributes_Product extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_attributes_product', 'description' => esc_html__("Woocommerce attributes product.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-attributes-product', esc_html__('[Booty] Woocommerce attributes Product', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_attributes_product';
    }

    public function widget($args, $instance) {

        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

        echo $args['before_widget'];
        global $product;
        ?>
        <?php
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
        <?php
        $attribute_taxonomies = wc_get_attribute_taxonomies();
        foreach ($attribute_taxonomies as $key => $value) {
            $taxonomy = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', urldecode($value->attribute_name)));
            $term = get_terms($taxonomy);
            $booty_filter_key = 'filter_' . $value->attribute_name;
            $booty_link = esc_url($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
            $booty_link = $val = substr($booty_link, 0, strrpos($booty_link, "?"));
            echo '<div class="shop-widget">';
            echo '<h3>' . $value->attribute_label . '</h3>';
            echo '<ul class="list-unstyled">';
            foreach ($term as $key => $value) {
                echo '<li><a href="' . esc_url($booty_link) . '?' . $booty_filter_key . '=' . $value->term_id . '">' . $value->name . ' (' . $value->count . ')</a></li>';
            }
            echo '</ul>';
            echo '</div>';
        }
        ?>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        ?>

        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>

            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <?php
    }

}

/**
 *
 */
require_once( WC()->plugin_path() . '/includes/admin/reports/class-wc-admin-report.php' );

class WC_attributes extends WC_Admin_Report {

    public function list_product_attributes() {
        $args_attributes = array(
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
            'limit' => 3,
            'query_type' => 'get_results',
        );

        $best_sellers = WC_Admin_Report::get_order_report_data($args_attributes);
        // print_r($best_sellers);
        return $best_sellers;
    }

}
