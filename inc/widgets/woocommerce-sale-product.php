<?php
/**
 * sale product
 */

class WP_Booty_Widget_Sale_Product extends WP_Widget
{

    function __construct()
    {
        $widget_ops = array( 'classname' => 'booty_widget_sale_product', 'description' => esc_html__( "Woocommerce sale product.", BOOTY_TXT_DOMAIN) );
        parent::__construct( 'booty-sale-product', esc_html__( '[Booty] Woocommerce Sale Product', BOOTY_TXT_DOMAIN ), $widget_ops );
        $this->alt_option_name = 'booty_widget_sale_product';
    }
    public function widget( $args, $instance ){
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $number_item = isset ( $instance['number_item'] ) ? $instance['number_item'] : 3;
        echo $args['before_widget'];
        $args_product = array(
            'post_type'      => 'product',
            'posts_per_page' => $number_item,
            'meta_query'     => array(
                'relation' => 'OR',
                array( // Simple products type
                    'key'           => '_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
                array( // Variable products type
                    'key'           => '_min_variation_sale_price',
                    'value'         => 0,
                    'compare'       => '>',
                    'type'          => 'numeric'
                )
            )
        );
        $rquery = new WP_Query( $args_product );
        ?>
        <!--title & nav-->
        <div class="shop-features hot">
            <?php if ( $instance['title'] ) {
                 echo $args['before_title'] . wp_kses($instance['title'],array('span'=>array('class'=>array()))) . $args['after_title'];
            } ?>
            <div class="deal-gallery beans-slider gallery-js-ready" data-rotate="true">
                <div class="beans-mask">
                    <div class="beans-slideset">
                        <?php
                        if ( $rquery -> have_posts() ) :
                            while ( $rquery -> have_posts() ) : $rquery-> the_post();
                                global $product;
                                ?>
                                <div class="beans-slide">
                                    <div class="deal-img">
                                        <?php the_post_thumbnail( 'booty_image_shop_sell' ); ?>
                                        <a href="#" class="btn-sale">Sale</a>
                                    </div>
                                    <div class="deal-box">
                                        <div class="deal-row">
                                            <a href="<?php the_permalink(); ?>" class="name"><?php the_title(); ?></a>
                                            <?php
                                            if ( $product->get_rating_html() == '' ){
                                                echo '<ul class="rattings-nav list-inline">
                                                        <li class="add"><i class="fa fa-star"></i></li>
                                                        <li class="add"><i class="fa fa-star"></i></li>
                                                        <li class="add"><i class="fa fa-star"></i></li>
                                                        <li class="add"><i class="fa fa-star"></i></li>
                                                        <li class="add"><i class="fa fa-star"></i></li>
                                                    </ul>';
                                            }else{
                                                echo '<div class="rattings-nav">'.$product->get_rating_html().'</div>';
                                            }
                                            ?>
                                        </div>
                                        <div class="deal-row">
                                            <span class="price cancel"><?php echo get_woocommerce_currency_symbol().number_format((float)get_post_meta( get_the_ID(), '_regular_price', true), 2, '.', ''); ?></span>
                                            <span class="price"><?php echo get_woocommerce_currency_symbol().number_format((float)get_post_meta( get_the_ID(), '_sale_price', true), 2, '.', ''); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="deal-buttons">
                    <a class="btn-prev" href="#"><i class="fa fa-angle-left"></i></a>
                    <a class="btn-next" href="#"><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number_item'] = strip_tags($new_instance['number_item']);
        return $instance;
    }
     public function form( $instance){
        $title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number_item  = isset( $instance['number_item'] ) ? esc_attr( $instance['number_item'] ) : '';
        ?>

        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:',BOOTY_TXT_DOMAIN ); ?></label>

        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
        <p><label for="<?php echo $this->get_field_id( 'number_item' ); ?>"><?php esc_html_e( 'Number item(s):',BOOTY_TXT_DOMAIN ); ?></label>

        <input class="widefat" id="<?php echo $this->get_field_id( 'number_item' ); ?>" name="<?php echo $this->get_field_name( 'number_item' ); ?>" type="text" value="<?php echo $number_item; ?>" /></p>
        <?php
    }
}