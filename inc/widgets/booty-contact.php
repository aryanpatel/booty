<?php

/**
 * Recent post widget
 * @package Booty
 */
class WP_Booty_Widget_Contact extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'booty_widget_contact', 'description' => esc_html__("Display a contact", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-contact', esc_html__('[Booty] Contact', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_contact';
    }

    public function widget($args, $instance) {
        $booty_allow_html = array('a' => array('href' => array(), 'class' => array()), 'span' => array('class' => array()), 'div' => array('class' => array()), 'p' => array('class' => array()), 'i' => array('class' => array()), 'br' => array());
        $layout = isset($instance['layout']) ? $instance['layout'] : '1';
        echo $args['before_widget'];
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
        <div class="info-box b-contact-info<?php echo ($layout == '2') ? ' type2' : '' ?>">
            <?php echo wp_kses($instance['description'], $booty_allow_html) ?>
            <?php
            if ($instance['address'] != '') {
                echo '<address><i class="fa fa-map-marker"></i>' . esc_html($instance['address']) . '</address>';
            }
            if ($instance['opening'] != '') {
                echo '<div class="mail-box2"><span class="mail-box"><i class="fa fa-clock-o"></i>' . wp_kses($instance['opening'], $booty_allow_html) . '</span></div>';
            }
            if ($instance['email'] != '') {
                echo '<div class="mail-box2"><span class="mail-box"><i class="fa fa-envelope-o"></i>' . wp_kses($instance['email'], $booty_allow_html) . '</span></div>';
            }
            if ($instance['tel'] != '') {
                echo '<div class="tel-holder"><span class="tel-box"><i class="fa fa-phone"></i>' . wp_kses($instance['tel'], $booty_allow_html) . '</span></div>';
            }
            ?>
        </div>
        <?php echo $args['after_widget']; ?>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['layout'] = strip_tags($new_instance['layout']);
        $instance['description'] = $new_instance['description'];
        $instance['address'] = $new_instance['address'];
        $instance['opening'] = $new_instance['opening'];
        $instance['email'] = $new_instance['email'];
        $instance['tel'] = $new_instance['tel'];
        return $instance;
    }

    public function form($instance) {
        $booty_allow_html = array('a' => array('href' => array(), 'class' => array()), 'span' => array('class' => array()), 'div' => array('class' => array()), 'p' => array('class' => array()), 'i' => array('class' => array()), 'br' => array());
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'GET IN TOUCH';
        $layout = isset($instance['layout']) ? esc_html($instance['layout']) : '1';
        $description = isset($instance['description']) ? wp_kses($instance['description'], $booty_allow_html) : '';
        $address = isset($instance['address']) ? esc_html($instance['address']) : '1422 1st St. Santa Rosa,t CA 94559. USA';
        $opening = isset($instance['opening']) ? esc_html($instance['opening']) : 'Opening from 10.00 am L 5.00p.m Sunday is off';
        $email = isset($instance['email']) ? wp_kses($instance['email'], $booty_allow_html) : '';
        $tel = isset($instance['tel']) ? wp_kses($instance['tel'], $booty_allow_html) : '';
        ?>
        <p><label for="<?php echo ($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo ($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
        <p><select name="<?php echo esc_attr($this->get_field_name('layout')); ?>">
                <option value="1" <?php selected($layout, '1'); ?>><?php esc_html_e('Type 1', BOOTY_TXT_DOMAIN) ?></option>
                <option value="2" <?php selected($layout, '2'); ?>><?php esc_html_e('Type 2', BOOTY_TXT_DOMAIN) ?></option>
            </select>
            <label for="<?php echo esc_attr($this->get_field_id('layout')); ?>"><?php esc_html_e('Select type of show', BOOTY_TXT_DOMAIN); ?></label></p>
        <label for="<?php echo $this->get_field_id('description'); ?>">
        <?php esc_html_e('Description:', BOOTY_TXT_DOMAIN) ?>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo ($this->get_field_id('description')); ?>" name="<?php echo ($this->get_field_name('description')); ?>"><?php echo esc_html($description); ?></textarea>
        </label>

        <label for="<?php echo $this->get_field_id('address'); ?>">
        <?php esc_html_e('Address:', BOOTY_TXT_DOMAIN) ?>
            <input class="widefat" id="<?php echo ($this->get_field_id('address')); ?>" name="<?php echo ($this->get_field_name('address')); ?>" type="text" value="<?php echo esc_html($address); ?>" />
        </label>
        <label for="<?php echo $this->get_field_id('opening'); ?>">
        <?php esc_html_e('Opening:', BOOTY_TXT_DOMAIN) ?>
            <input class="widefat" id="<?php echo ($this->get_field_id('opening')); ?>" name="<?php echo ($this->get_field_name('opening')); ?>" type="text" value="<?php echo esc_html($opening); ?>" />
        </label>
        <label for="<?php echo $this->get_field_id('email'); ?>">
        <?php esc_html_e('Email:', BOOTY_TXT_DOMAIN) ?>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo ($this->get_field_id('email')); ?>" name="<?php echo ($this->get_field_name('email')); ?>"><?php echo wp_kses($email, $booty_allow_html); ?></textarea>
        </label>
        <label for="<?php echo $this->get_field_id('tel'); ?>">
        <?php esc_html_e('Tel:', BOOTY_TXT_DOMAIN) ?>
            <textarea class="widefat" rows="10" cols="20" id="<?php echo ($this->get_field_id('tel')); ?>" name="<?php echo ($this->get_field_name('tel')); ?>"><?php echo wp_kses($tel, $booty_allow_html); ?></textarea>
        </label>
        <?php
    }

}
