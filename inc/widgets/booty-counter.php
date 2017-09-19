<?php

/**
 * Recent post widget
 * @package fekra
 */
class WP_Booty_Widget_Counter extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'booty_widget_counter', 'description' => esc_html__("Display a counter", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-counter', esc_html__('[Booty] Counter', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_counter';
    }

    public function widget($args, $instance) {
        $booty_allow_html = array('a' => array('href' => array(), 'class' => array()), 'span' => array('class' => array()), 'div' => array('class' => array()), 'p' => array('class' => array()), 'i' => array('class' => array()), 'br' => array());
        $layout = isset($instance['layout']) ? $instance['layout'] : '1';
        echo $args['before_widget'];
        if ($instance['counter']) {
            $counter = $instance['counter'];
            ?>
            <div class="counter-box">
                <div class="counter">
                    <span class="num-counter num" data-from="10" data-to="<?php echo esc_html($instance['counter']) ?>" data-refresh-interval="80" data-speed="3000" data-comma="true"><?php echo esc_html($instance['counter']) ?></span>
                </div>
                <?php
                if ($instance['title']) {
                    echo '<p>' . wp_kses($instance['title'], array('span' => array('class' => array()))) . '</p>';
                }
                ?>
            </div>
            <?php
        }
        echo $args['after_widget'];
        ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['counter'] = $new_instance['counter'];
        return $instance;
    }

    public function form($instance) {
        $booty_allow_html = array('a' => array('href' => array(), 'class' => array()), 'span' => array('class' => array()), 'div' => array('class' => array()), 'p' => array('class' => array()), 'i' => array('class' => array()), 'br' => array());
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'GET IN TOUCH';
        $counter = isset($instance['counter']) ? (int) $instance['counter'] : 'GET IN TOUCH';
        ?>
        <p><label for="<?php echo ($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo ($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
        <p><label for="<?php echo ($this->get_field_id('counter')); ?>"><?php esc_html_e('Counter:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo ($this->get_field_id('counter')); ?>" name="<?php echo esc_html($this->get_field_name('counter')); ?>" type="number" value="<?php echo (int) $counter; ?>" /></p>

        <?php
    }

}
