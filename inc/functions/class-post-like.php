<?php

/*
  Name:  WordPress Simple Post Like Button
  Description:  A simple and efficient post like system for WordPress.
  Version:      1.0
  Author:
  Author URI:
 */

class Booty_Simple_Post_Like {

    function __construct() {
        add_action('wp_ajax_nopriv_sn_like_post', array($this, 'post_like_process'));
        add_action('wp_ajax_sn_like_post', array($this, 'post_like_process'));
    }

    function enqueues() {
        wp_enqueue_script('jquery');
        wp_localize_script('script-theme', 'sn_like_post', array(
            'url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('ajax-nonce')
                )
        );
    }

    function post_like_process() {
        //-- Verify stuffs
        $nonce = $_POST['nonce'];
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'ajax-nonce')) {
            die('Cheatin\' huh? ');
        }
        if (!isset($_POST['sn_post_like']) || !isset($_POST['post_id']))
            exit;
        //-- Store stuffs for use
        $post_id = $_POST['post_id'];
        $liked = false;
        $likes_count = get_post_meta($post_id, '_likes_count', true);
        if ($likes_count && is_numeric($likes_count)) {
            $likes_count = (int) $likes_count;
        } else {
            $likes_count = 0;
            delete_post_meta($post_id, '_likes_count');
            add_post_meta($post_id, '_likes_count', $likes_count);
        }
        //-- Invalidate WP Super Cache if exists
        if (function_exists('wp_cache_post_change')) {
            $GLOBALS["super_cache_enabled"] = 1;
            wp_cache_post_change($post_id);
        }
        //-- User logged in
        if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $user_likes = get_user_meta('_liked_posts', $user_id, true);
            $post_likes = get_post_meta($post_id, '_users_liked', true);

            //-- Setup default things.
            if (!$user_likes || !is_array($user_likes) || count($user_likes) == 0) {
                $user_likes = array();
                delete_user_meta($user_id, '_liked_posts');
                add_user_meta($user_id, '_liked_posts', $user_likes, true);
            }
            if (!$post_likes || !is_array($post_likes) || count($post_likes) == 0) {
                $post_likes = array();
                delete_post_meta($post_id, '_users_liked');
                add_post_meta($post_id, '_users_liked', $post_likes, true);
            }

            //-- User is already liked current post, decrease post likes count and unset stuffs
            if ($this->already_liked($post_id)) {

                $user_id_key = array_search($user_id, $post_likes);
                if ($user_id_key >= 0) {
                    unset($post_likes[$user_id_key]);
                    update_post_meta($post_id, '_users_liked', $post_likes);
                }

                $post_id_key = array_search($post_id, $user_likes);
                if ($post_id_key >= 0) {
                    unset($user_likes[$post_id_key]);
                    update_user_meta($user_id, '_liked_posts', $user_likes);
                }

                if ($likes_count > 0 && $user_id_key >= 0 && $post_id_key >= 0) {
                    $likes_count--;
                    update_post_meta($post_id, '_likes_count', $likes_count);
                }
            }
            //-- User is unliked or never liked this post before, increase post like count and set stuffs
            else {
                $likes_count++;
                $post_likes[] = $user_id;
                $user_likes[] = $post_id;
                update_post_meta($post_id, '_users_liked', $post_likes);
                update_post_meta($post_id, '_likes_count', $likes_count);
                update_user_meta($user_id, '_liked_posts', $user_likes);
                $liked = true;
            }
        }

        //-- Guest likes / unlike
        else {

            $ip = $_SERVER['REMOTE_ADDR'];

            $post_like_ips = get_post_meta($post_id, "_ips_liked", true);

            if (!$post_like_ips || !is_array($post_like_ips) || count($post_like_ips) == 0) {
                $post_like_ips = array();
                delete_post_meta($post_id, '_ips_liked');
                add_post_meta($post_id, '_ips_liked', $post_like_ips, true);
            }

            //-- User from current ip is already liked this post
            if ($this->already_liked($post_id)) {
                $user_ip_key = array_search($ip, $post_like_ips);
                if ($user_ip_key >= 0) {
                    unset($post_like_ips[$user_ip_key]);
                    update_post_meta($post_id, '_ips_liked', $post_like_ips);
                    if ($likes_count > 0) {
                        $likes_count--;
                        update_post_meta($post_id, '_likes_count', $likes_count);
                    }
                }
            }
            //-- User from current ip is already unliked this post or never liked this post before
            else {
                $likes_count++;
                $post_like_ips[] = $ip;
                update_post_meta($post_id, '_ips_liked', $post_like_ips);
                update_post_meta($post_id, '_likes_count', $likes_count);
                $liked = true;
            }
        }
        $this->print_markup($post_id, $likes_count, $liked);

        exit;
    }

    /**
     * Check if already liked. Also use outside of class
     * @return boolean
     */
    function already_liked($post_id) {

        if (is_user_logged_in()) {
            $user_id = get_current_user_id();

            $user_likes = get_user_meta('_liked_posts', $user_id, true);
            $post_likes = get_post_meta($post_id, '_users_liked', true);

            if (!$user_likes || !is_array($user_likes) || count($user_likes) == 0) {
                $user_likes = array();
            }
            if (!$post_likes || !is_array($post_likes) || count($post_likes) == 0) {
                $post_likes = array();
            }

            if (in_array($user_id, $post_likes)) {
                return true;
            }
        } else {

            $ip = $_SERVER['REMOTE_ADDR'];

            $post_like_ips = get_post_meta($post_id, "_ips_liked", true);

            if (!$post_like_ips || !is_array($post_like_ips) || count($post_like_ips) == 0) {
                $post_like_ips = array();
            }
            if (in_array($ip, $post_like_ips)) {
                return true;
            }
        }
        return false;
    }

    function print_markup($post_id, $likes_count, $already_liked = false) {
        if ($already_liked) {
            echo '<span class="liked">' . esc_attr($likes_count) . '</span>';
        } else {
            echo '<span>' . esc_attr($likes_count) . '</span>';
        }
    }

}

$booty_post_like = new Booty_Simple_Post_Like();
