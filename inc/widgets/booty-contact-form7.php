<?php

/**
 * Contact_us
 * @package Booty
 */
class WP_Booty_Widget_Contact_Form7 extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'Booty_widget_contact_form7', 'description' => esc_html__("Your site&#8217;s Contact Us.", BOOTY_TXT_DOMAIN));
        parent::__construct('Booty-contact-form7', esc_html__('[Booty] Contact Form7', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'Booty_widget_contact_form7';
    }

    public function widget($args, $instance) {
        global $Booty_opt;

        $contact_id = isset($instance['contact_id']) ? $instance['contact_id'] : '';
        echo $args['before_widget'];
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        echo do_shortcode('[contact-form-7 id="' . (int) $contact_id . '" title="Contact form"]');
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['contact_id'] = strip_tags($new_instance['contact_id']);
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : '';
        $contact_id = isset($instance['contact_id']) ? esc_html($instance['contact_id']) : '';
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
        <p><label for="<?php echo esc_html($this->get_field_id('contact_id')); ?>"><?php esc_html_e('Select Contact Form:', BOOTY_TXT_DOMAIN); ?></label>
            <select id="<?php echo esc_html($this->get_field_id('contact_id')); ?>" name="<?php echo esc_html($this->get_field_name('contact_id')); ?>">
                <?php
                $args = array('post_type' => 'wpcf7_contact_form', 'posts_per_page' => -1);
                if ($cf7Forms = get_posts($args)) {
                    foreach ($cf7Forms as $cf7Form) {
                        echo '<option value="' . $cf7Form->ID . '">' . $cf7Form->post_title . '</option>';
                    }
                }
                ?>
            </select>

            <?php
        }

    }
    