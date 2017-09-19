<?php

/**
 * Multiple menu
 */
class WP_Booty_Widget_multiple extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_multiple_menu', 'description' => esc_html__("Multiple menu.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-multiple-menu', esc_html__('[Booty] Multiple Menu', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_multiple_menu';
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $multiple_menu = empty($instance['multiple_menu']) ? array() : $instance['multiple_menu'];
        echo $args['before_widget'];
        ?>
        <!--title & nav-->
        <div class="shop-features">
            <?php
            if ($instance['title']) {
                echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
            }
            ?>
            <div class="features-box links">
                <?php
                foreach ($multiple_menu as $value) {
                    $nav_menu = wp_get_nav_menu_object($value);
                    $nav_menu_item = wp_get_nav_menu_items($value);
                    echo '<h3>' . $nav_menu->name . '</h3>';
                    echo '<ul class="list-unstyled links-nav">';
                    foreach ($nav_menu_item as $key => $value) {
                        echo '<li><a href="' . $value->url . '"><i class="fa fa-angle-right"></i>' . $value->post_title . '</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['multiple_menu'] = esc_sql($new_instance['multiple_menu']);
        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : '';
        $booty_selected = isset($instance['multiple_menu']) ? $instance['multiple_menu'] : array();
        ?>

        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>

            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
                <?php
                $menus = get_terms('nav_menu');
                ?>
        <p><label for="<?php echo $this->get_field_id('multiple_menu[]'); ?>"><?php esc_html_e('Menu:', BOOTY_TXT_DOMAIN); ?></label>
            <select class="multiple-menu" name="<?php echo $this->get_field_name('multiple_menu'); ?>[]" multiple id="<?php echo $this->get_field_id('multiple_menu'); ?>">
                <?php
                foreach ($menus as $menu) {
                    ?>
                    <option value="<?php echo esc_html($menu->slug); ?>" <?php if (in_array($menu->slug, $booty_selected)) echo 'selected'; ?>><?php echo esc_html($menu->name); ?></option>
            <?php
        }
        ?>
            </select>
        </p>
        <?php
    }

}
