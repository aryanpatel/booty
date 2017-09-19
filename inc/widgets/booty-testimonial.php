<?php

/**
 * Recent post widget
 * @package Booty
 */
class WP_Booty_Widget_Testimonial extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'booty_widget_testimonial', 'description' => esc_html__("Your site&#8217;s most testimonial.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-testimonial', esc_html__('[Booty] Testimonial', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_testimonial';
    }

    public function widget($args, $instance) {
        $number = (!empty($instance['number']) ) ? absint($instance['number']) : 5;
        if (!$number)
            $number = 5;
        $r = new WP_Query(apply_filters('booty_widget_testimonial_args', array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true
                )));

        if ($r->have_posts()) : $index = 1;
            ?>
            <?php echo $args['before_widget']; ?>
            <div class="testimonial-features">
                <?php
                if ($instance['title']) {
                    echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
                }
                ?>
                <div class="booty-testimonial">
                    <div class="beans-slider">
                        <div class="beans-mask">
                            <div class="beans-slideset">
            <?php while ($r->have_posts()) : $r->the_post(); ?>
                                    <div class="beans-slide">
                                        <blockquote class="gallery-quotes">
                                            <i class="fa fa-quote-left"></i>
                                            <div class="content-ts">
                <?php the_content(); ?>
                                            </div>
                                            <footer><cite title="Source Title"><a href="#"><?php the_title(); ?></a></cite></footer>
                                        </blockquote>
                                    </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
                            </div>
                        </div>
                        <div class="beans-pagination"></div>
                    </div>
                </div>
            </div>
            <?php echo $args['after_widget']; ?>
            <?php
        endif;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = (int) $new_instance['number'];
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'LATEST NEWS';
        $number = isset($instance['number']) ? absint($instance['number']) : 2;
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

        <p><label for="<?php echo esc_html($this->get_field_id('number')); ?>"><?php esc_html_e('Number of item to show:', BOOTY_TXT_DOMAIN); ?></label>
            <input id="<?php echo esc_html($this->get_field_id('number')); ?>" name="<?php echo esc_html($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_html($number); ?>" size="3" /></p>
        <?php
    }

}
