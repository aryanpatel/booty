<?php

/**
 * Flick stream photo
 */
class Booty_Flick_Photo extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_flickphoto', 'description' => esc_html__("Flick Photo Stream.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-flickphoto', esc_html__('[Booty] Flick Photo', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_flickphoto';
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
        <div class="insta-box flickr-feed" data-id="<?php echo $instance['flick'] ?>" data-count="<?php echo $instance['items'] ?>" data-lightbox="gallery"></div>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['flick'] = strip_tags($new_instance['flick']);
        $instance['items'] = strip_tags($new_instance['items']);

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'FLICKR STREAM';
        $flick_id = isset($instance['flick']) ? esc_html($instance['flick']) : '44802888@N04';
        $items = isset($instance['items']) ? esc_html($instance['items']) : '8';
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>" ><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo esc_html($this->get_field_id('flick')); ?>" value="<?php echo esc_html($title); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>">

        <p><label for="<?php echo esc_html($this->get_field_id('flick')); ?>" ><?php esc_html_e('ID Flick:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo $this->get_field_id('flick'); ?>" value="<?php echo esc_html($flick_id); ?>" name="<?php echo esc_html($this->get_field_name('flick')); ?>">

        <p><label for="<?php echo esc_html($this->get_field_id('items')); ?>" ><?php esc_html_e('Number items:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo esc_html($this->get_field_id('items')); ?>" value="<?php echo esc_html($items); ?>" name="<?php echo esc_html($this->get_field_name('items')); ?>">

        <?php
    }

}
