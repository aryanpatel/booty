<?php

/**
 * Recent post widget
 * @package Booty
 */
class WP_Booty_Widget_Recent_Posts extends WP_Widget {

    public function __construct() {
        $widget_ops = array('classname' => 'booty_widget_recent_posts', 'description' => esc_html__("Your site&#8217;s most recent Posts.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-recent-posts', esc_html__('[Booty] Recent Posts', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_recent_posts';
    }

    public function widget($args, $instance) {
        $number = (!empty($instance['number']) ) ? absint($instance['number']) : 5;
        if (!$number)
            $number = 5;
        $layout = isset($instance['layout']) ? $instance['layout'] : '1';
        $show_title = isset($instance['show_title']) ? $instance['show_title'] : false;
        $show_excert = isset($instance['show_excert']) ? $instance['show_excert'] : false;
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $r = new WP_Query(apply_filters('booty_widget_posts_args', array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true
                )));

        if ($r->have_posts()) : $index = 1;
            ?>
            <?php echo $args['before_widget']; ?>
            <div class="shop-features">
                <?php
                if ($instance['title']) {
                    echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
                }
                ?>
                    <?php if ($layout == '1') { ?>
                    <div class="booty-recent-posts">
                                <?php while ($r->have_posts()) : $r->the_post(); ?>
                            <div class="footer-news-box">
                                <div class="img-box">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('booty_imag_latest_widget'); ?></a>
                    <?php endif; ?>
                                </div>
                                <div class="txt">
                                    <a href="<?php the_permalink(); ?>">
                                    <?php if ($show_title) {
                                        the_title();
                                    } ?>
                            <?php if ($show_excert) {
                                echo '<p>' . booty_excert(absint($instance['number_excert'])) . '</p>';
                            } ?>
                                    </a>
                        <?php if ($show_date) {
                            echo '<time datetime="' . get_the_time('Y-m-d', get_the_ID()) . '">' . get_the_date('d M Y') . '</time>';
                        } ?>
                                </div>
                            </div>
                                    <?php $index = $index + 1; ?>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                    </div>
                            <?php } elseif ($layout == '2') { ?>
                    <div class="features-box">
                                <?php while ($r->have_posts()) : $r->the_post(); ?>
                            <article class="product-article blog">
                                <div class="alignleft">
                            <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('booty_imag_latest_widget'); ?></a>
                        <?php endif; ?>
                                </div>
                                <div class="txt-box">
                    <?php if ($show_title) {
                        echo '<h3><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
                    } ?>
                    <?php if ($show_date) {
                        echo '<time datetime="' . get_the_time('Y-m-d', get_the_ID()) . '">' . get_the_date('d M, Y') . '</time>';
                    } ?>
                    <?php if ($show_excert) {
                        echo '<p>' . booty_excert(absint($instance['number_excert'])) . '</p>';
                    } ?>
                                </div>
                            </article>
                <?php endwhile;
                wp_reset_postdata(); ?>
                    </div>
            <?php } else {
                return;
            } ?>
            </div>
            <?php echo $args['after_widget']; ?>
            <?php
        endif;
    }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['number'] = (int) $new_instance['number'];
        $instance['number_excert'] = (int) $new_instance['number_excert'];
        $instance['layout'] = strip_tags($new_instance['layout']);
        $instance['show_title'] = isset($new_instance['show_title']) ? (bool) $new_instance['show_title'] : false;
        $instance['show_excert'] = isset($new_instance['show_excert']) ? (bool) $new_instance['show_excert'] : false;
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;

        return $instance;
    }

    public function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : 'LATEST NEWS';
        $number = isset($instance['number']) ? absint($instance['number']) : 2;
        $number_excert = isset($instance['number_excert']) ? absint($instance['number_excert']) : 50;
        $show_title = isset($instance['show_title']) ? (bool) $instance['show_title'] : false;
        $layout = isset($instance['layout']) ? esc_html($instance['layout']) : '1';
        $show_excert = isset($instance['show_excert']) ? (bool) $instance['show_excert'] : true;
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : true;
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>

        <p><label for="<?php echo esc_html($this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show:', BOOTY_TXT_DOMAIN); ?></label>
            <input id="<?php echo esc_html($this->get_field_id('number')); ?>" name="<?php echo esc_html($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_html($number); ?>" size="3" /></p>

        <p><label for="<?php echo esc_html($this->get_field_id('number_excert')); ?>"><?php esc_html_e('Length excert of post to show:', BOOTY_TXT_DOMAIN); ?></label>
            <input id="<?php echo esc_html($this->get_field_id('number_excert')); ?>" name="<?php echo esc_html($this->get_field_name('number_excert')); ?>" type="text" value="<?php echo esc_html($number_excert); ?>" size="3" /></p>

        <p><select name="<?php echo esc_html($this->get_field_name('layout')); ?>">
                <option value="1" <?php selected($layout, '1'); ?>><?php esc_html_e('Type 1', BOOTY_TXT_DOMAIN) ?></option>
                <option value="2" <?php selected($layout, '2'); ?>><?php esc_html_e('Type 2', BOOTY_TXT_DOMAIN) ?></option>
            </select>
            <label for="<?php echo esc_html($this->get_field_id('layout')); ?>"><?php esc_html_e('Select type of show', BOOTY_TXT_DOMAIN); ?></label></p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_title); ?> id="<?php echo esc_html($this->get_field_id('show_title')); ?>" name="<?php echo esc_html($this->get_field_name('show_title')); ?>" />
            <label for="<?php echo esc_html($this->get_field_id('show_title')); ?>"><?php esc_html_e('Display post title?', BOOTY_TXT_DOMAIN); ?></label></p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_excert); ?> id="<?php echo esc_html($this->get_field_id('show_excert')); ?>" name="<?php echo esc_html($this->get_field_name('show_excert')); ?>" />
            <label for="<?php echo esc_html($this->get_field_id('show_excert')); ?>"><?php esc_html_e('Display post excert?', BOOTY_TXT_DOMAIN); ?></label></p>

        <p><input class="checkbox" type="checkbox" <?php checked($show_date); ?> id="<?php echo esc_html($this->get_field_id('show_date')); ?>" name="<?php echo esc_html($this->get_field_name('show_date')); ?>" />
            <label for="<?php echo esc_html($this->get_field_id('show_date')); ?>"><?php esc_html_e('Display post date?', BOOTY_TXT_DOMAIN); ?></label></p>
        <?php
    }

}
