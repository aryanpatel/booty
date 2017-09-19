<?php

/**
 * Instagram stream photo
 */
class Booty_Instagram_Photo extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_instagramphoto', 'description' => esc_html__("Instagram Photo Stream.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-instagramphoto', esc_html__('[Booty] Instagram Photo', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_instagramphoto';
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
        <div class="insta-box instagram-photos" data-count="<?php echo $instance['items'] ?>" data-user="<?php echo $instance['instagram'] ?>"></div>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['instagram'] = strip_tags($new_instance['instagram']);
        $instance['items'] = strip_tags($new_instance['items']);

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'instagramR STREAM';
        $instagram_id = isset($instance['instagram']) ? esc_html($instance['instagram']) : '44802888@N04';
        $items = isset($instance['items']) ? esc_html($instance['items']) : '8';
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>" ><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo esc_html($this->get_field_id('instagram')); ?>" value="<?php echo esc_html($title); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>">

        <p><label for="<?php echo esc_html($this->get_field_id('instagram')); ?>" ><?php esc_html_e('ID instagram:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo $this->get_field_id('instagram'); ?>" value="<?php echo esc_html($instagram_id); ?>" name="<?php echo esc_html($this->get_field_name('instagram')); ?>">

        <p><label for="<?php echo esc_html($this->get_field_id('items')); ?>" ><?php esc_html_e('Number items:', BOOTY_TXT_DOMAIN); ?></label></p>
        <input type="text" class="widefat" id ="<?php echo esc_html($this->get_field_id('items')); ?>" value="<?php echo esc_html($items); ?>" name="<?php echo esc_html($this->get_field_name('items')); ?>">

        <?php
    }

}
