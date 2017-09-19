<?php

/**
 * Video
 */
class Booty_Popular_Video extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'booty_widget_video', 'description' => esc_html__("Video vimeo or youtube.", BOOTY_TXT_DOMAIN));
        parent::__construct('booty-popularvideo', esc_html__('[Booty] Popular video', BOOTY_TXT_DOMAIN), $widget_ops);
        $this->alt_option_name = 'booty_widget_video';
    }

    function widget($args, $instance) {
        echo $args['before_widget'];
        if ($instance['title']) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        ?>
        <div class="iframe_video_wrap">
            <?php
            $booty_video = $instance['iframe'];
            if (strpos($booty_video, 'youtube.com/') != false) {
                $step1 = explode('v=', $booty_video);
                $step2 = explode('&', $step1[1]);
                $booty_video_id = $step2[0];
                echo '<div class="iframe_video_wrap">';
                echo '<iframe src="http://www.youtube.com/embed/' . $booty_video_id . '" frameborder="0"></iframe>';
                echo '</div>';
            } elseif (strpos($booty_video, 'vimeo.com/') != false) {
                $step1 = explode('vimeo.com/', $booty_video);
                $step2 = explode('&', $step1[1]);
                $booty_video_id = $step2[0];
                echo '<div class="iframe_video_wrap">';
                echo '<iframe src="http://player.vimeo.com/video/' . $booty_video_id . '"></iframe>';
                echo '</div>';
            } elseif (strpos($booty_video, 'dailymotion.com/video/') != false) {
                $step1 = explode('dailymotion.com/video/', $booty_video);
                $step2 = explode('dailymotion.com/video/', $step1[1]);
                $video_id = $step2[0];
                echo '<div class="iframe_video_wrap">';
                echo '<iframe frameborder="0" width="100%" height="315" src="http://www.dailymotion.com/embed/video/' . $video_id . '" allowfullscreen></iframe>';
                echo '</div>';
            }
            ?>

        </div>
        <?php
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['iframe'] = strip_tags($new_instance['iframe']);

        return $instance;
    }

    function form($instance) {
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : '';
        $iframe = isset($instance['iframe']) ? esc_attr($instance['iframe']) : '';
        ?>
        <p><label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" /></p>
        <p><label for="<?php echo esc_html($this->get_field_id('iframe')); ?>"><?php esc_html_e('Iframe:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('iframe')); ?>" name="<?php echo esc_html($this->get_field_name('iframe')); ?>" type="text" value="<?php echo esc_html($iframe); ?>" /></p>
        <p class="description"><?php esc_html_e('Suport video youtube,vimeo,dailymotion', BOOTY_TXT_DOMAIN); ?></p>
        <?php
    }

}
