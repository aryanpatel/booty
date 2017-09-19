<?php
/**
 * Social network links widgets
 * @package  Fekra
 */
if (!defined('ABSPATH')) {
    die("Cheatin' huh?");
}

class WP_Booty_Widget_Social_Links extends WP_Widget {

    function __construct() {
        $widget_ops = array(
            'classname' => 'booty_widget_social_links',
            'description' => esc_html__("Social links from theme options.", BOOTY_TXT_DOMAIN)
        );

        parent::__construct('booty-social-links', esc_html__('[Fekra] Social', BOOTY_TXT_DOMAIN), $widget_ops);
    }

    function widget($args, $instance) {
        ob_start();
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . wp_kses($instance['title'], array('span' => array('class' => array()))) . $args['after_title'];
        }
        echo '<ul class="list-inline footer-social">';
        if (isset($instance['social_facebook_link']) && ( '' != $instance['social_facebook_link'] )) :
            echo '<li class="">';
            echo '<a target="_blank" href="' . esc_url($instance['social_facebook_link']) . '"><i class="fa fa-facebook"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_twitter_link']) && ( '' != $instance['social_twitter_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_twitter_link']) . '"><i class="fa fa-twitter"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_googleplus_link']) && ( '' != $instance['social_googleplus_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_googleplus_link']) . '"><i class="fa fa-google-plus"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_pinterest_link']) && ( '' != $instance['social_pinterest_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_pinterest_link']) . '"><i class="fa fa-pinterest"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_instagram_link']) && ( '' != $instance['social_instagram_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_instagram_link']) . '"><i class="fa fa-instagram"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_dribbble_link']) && ( '' != $instance['social_dribbble_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_dribbble_link']) . '"><i class="fa fa-dribbble"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_flickr_link']) && ( '' != $instance['social_flickr_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_flickr_link']) . '"><i class="fa fa-flickr"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_youtube_link']) && ( '' != $instance['social_youtube_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_youtube_link']) . '"><i class="fa fa-youtube"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_vimeo_link']) && ( '' != $instance['social_vimeo_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_vimeo_link']) . '"><i class="fa fa-vimeo"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_linkedin_link']) && ( '' != $instance['social_linkedin_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_linkedin_link']) . '"><i class="fa fa-linkedin"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_behance_link']) && ( '' != $instance['social_behance_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_behance_link']) . '"><i class="fa fa-behance"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_skype_link']) && ( '' != $instance['social_skype_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_skype_link']) . '"><i class="fa fa-skype"></i></a>';
            echo '</li>';
        endif;
        if (isset($instance['social_apple_link']) && ( '' != $instance['social_apple_link'] )) :
            echo '<li>';
            echo '<a target="_blank" href="' . esc_url($instance['social_apple_link']) . '"><i class="fa fa-apple"></i></a>';
            echo '</li>';
        endif;
        echo '</ul>';

        echo ob_get_clean();
        echo $args['after_widget'];
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $booty_socials = array('facebook' => $social_facebook_link, 'twitter' => $social_twitter_link, 'googleplus' => $social_googleplus_link, 'pinterest' => $social_pinterest_link, 'instagram' => $social_instagram_link, 'dribbble' => $social_dribbble_link, 'flickr' => $social_flickr_link, 'youtube' => $social_youtube_link, 'vimeo' => $social_vimeo_link, 'linkedin' => $social_linkedin_link, 'behance' => $social_behance_link, 'skype' => $social_skype_link, 'apple' => $social_apple_link);
        foreach ($booty_socials as $booty_social => $value) {
            $instance['social_' . $booty_social . '_link'] = strip_tags($new_instance['social_' . $booty_social . '_link']);
        }
        return $instance;
    }

    function form($instance) {
        $instance = wp_parse_args((array) $instance, array('title' => ''));
        $title = isset($instance['title']) ? wp_kses($instance['title'], array('span' => array('class' => array()))) : '';
        $social_facebook_link = isset($instance['social_facebook_link']) ? esc_url($instance['social_facebook_link']) : '';
        $social_twitter_link = isset($instance['social_twitter_link']) ? esc_url($instance['social_twitter_link']) : '';
        $social_googleplus_link = isset($instance['social_googleplus_link']) ? esc_url($instance['social_googleplus_link']) : '';
        $social_pinterest_link = isset($instance['social_pinterest_link']) ? esc_url($instance['social_pinterest_link']) : '';
        $social_instagram_link = isset($instance['social_instagram_link']) ? esc_url($instance['social_instagram_link']) : '';
        $social_dribbble_link = isset($instance['social_dribbble_link']) ? esc_url($instance['social_dribbble_link']) : '';
        $social_flickr_link = isset($instance['social_flickr_link']) ? esc_url($instance['social_flickr_link']) : '';
        $social_youtube_link = isset($instance['social_youtube_link']) ? esc_url($instance['social_youtube_link']) : '';
        $social_vimeo_link = isset($instance['social_vimeo_link']) ? esc_url($instance['social_vimeo_link']) : '';
        $social_linkedin_link = isset($instance['social_vimeo_link']) ? esc_url($instance['social_linkedin_link']) : '';
        $social_behance_link = isset($instance['social_vimeo_link']) ? esc_url($instance['social_behance_link']) : '';
        $social_skype_link = isset($instance['social_vimeo_link']) ? esc_url($instance['social_skype_link']) : '';
        $social_apple_link = isset($instance['social_vimeo_link']) ? esc_url($instance['social_apple_link']) : '';
        $booty_socials = array('facebook' => $social_facebook_link, 'twitter' => $social_twitter_link, 'googleplus' => $social_googleplus_link, 'pinterest' => $social_pinterest_link, 'instagram' => $social_instagram_link, 'dribbble' => $social_dribbble_link, 'flickr' => $social_flickr_link, 'youtube' => $social_youtube_link, 'vimeo' => $social_vimeo_link, 'linkedin' => $social_linkedin_link, 'behance' => $social_behance_link, 'skype' => $social_skype_link, 'apple' => $social_apple_link);
        ?>
        <p>
            <label for="<?php echo esc_html($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', BOOTY_TXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo esc_html($this->get_field_id('title')); ?>" name="<?php echo esc_html($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_html($title); ?>" />
        </p>
        <?php foreach ($booty_socials as $booty_social => $value) { ?>
            <p>
                <label for="<?php echo ($this->get_field_id('social_' . $booty_social . '_link')); ?>"><?php echo esc_html($booty_social); ?></label>
                <input class="widefat" id="<?php echo ($this->get_field_id('social_' . $booty_social . '_link')); ?>" name="<?php echo ($this->get_field_name('social_' . $booty_social . '_link')); ?>" type="text" value="<?php echo esc_url($value); ?>" />
            </p>
            <?php
        }
    }

}
