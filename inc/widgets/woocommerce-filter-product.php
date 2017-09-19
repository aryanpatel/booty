<?php
/**
 * Recent post widget
 * @package booty
 */

class WP_Booty_Widget_Filter_Product extends WP_Widget {

    public function __construct() {
        $widget_ops = array( 'classname' => 'booty_filter_product', 'description' => esc_html__( "A search product for your site.", BOOTY_TXT_DOMAIN) );
        parent::__construct( 'booty-filter-product', esc_html__( '[Booty] Filter Product', BOOTY_TXT_DOMAIN ), $widget_ops );
        $this->alt_option_name = 'booty_filter_product';
    }

    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( $instance['title'] ) {
             echo $args['before_title'] . wp_kses($instance['title'],array('span'=>array('class'=>array()))) . $args['after_title'];
        }
        ?>
        <form method="get" class="rang-form" name="price">
                <?php
                $booty_currency = get_woocommerce_currency_symbol(get_woocommerce_currency()); ?>
            <div class="filter-price">
                <div id="slider-range-min" data-value=<?php echo (isset($_GET['price']) ? (int)$_GET['price'] : $instance['maxprice'])?>></div>
            </div>
            <p class="num">
                <label for="amount"><?php esc_html_e( 'Price: ', BOOTY_TXT_DOMAIN).$booty_currency.'2 - '.$booty_currency; ?></label>
                <input type="text" name="price" id="amount" readonly>
            </p>
            <button class="btn btn-form" type="submit"><?php esc_html_e('Filter',BOOTY_TXT_DOMAIN); ?></button>
        </form>

        <?php
        echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['minprice'] = strip_tags($new_instance['minprice']);
        $instance['maxprice'] = strip_tags($new_instance['maxprice']);
        return $instance;
    }

    public function form( $instance ) {
        $title              = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $maxprice           = isset( $instance['maxprice'] ) ? esc_attr( $instance['maxprice'] ) : '';
?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:',BOOTY_TXT_DOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'maxprice' ); ?>"><?php esc_html_e( 'Max price:',BOOTY_TXT_DOMAIN ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'maxprice' ); ?>" name="<?php echo $this->get_field_name( 'maxprice' ); ?>" type="text" value="<?php echo $maxprice; ?>" /></p>
<?php
    }
}