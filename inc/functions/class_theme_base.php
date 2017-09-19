<?php

/**
 *
 */
function vc_get_css_colors($prefix, $color) {
    $rgb_color = preg_match('/rgba/', $color) ? preg_replace(array(
                '/\s+/',
                '/^rgba\((\d+)\,(\d+)\,(\d+)\,([\d\.]+)\)$/',
                    ), array(
                '',
                'rgb($1,$2,$3)',
                    ), $color) : $color;
    $string = $prefix . ':' . $rgb_color . ';';
    if ($rgb_color !== $color) {
        $string .= $prefix . ':' . $color . ';';
    }

    return $string;
}

/* Get css editor */

function vc_shortcode_custom_css_classs($param_value, $prefix = '') {
    $css_class = preg_match('/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value) ? $prefix . preg_replace('/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value) : '';

    return $css_class;
}

function get_term_posttype($post_id, $posttype) {
    $results = '';
    $terms = get_the_terms($post_id, $posttype);
    $d = 0;
    if ($terms != ''):
        foreach ($terms as $key => $value) {
            # code...
            if ($d != 0) {
                $results .= '<a href="' . get_term_link($value->term_id, $posttype) . '" >';
                $results .= ', ' . $value->name;
                $results .= '</a>';
            } else {
                $results .= '<a href="' . get_term_link($value->term_id, $posttype) . '" >';
                $results .= $value->name;
                $results .= '</a>';
            }
            $d++;
        }
    endif;
    return $results;
}

function get_meta_blog($post_id, $hidden_user, $hidden_tag, $hidden_like, $hidden_comment) {
    $comments = get_comments_number();
    ?>
    <ul class="meta list-inline">
        <?php if ($hidden_user != 'yes'): ?>
            <li class="user">
                <i class="fa fa-user"></i>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                    <?php esc_html_e('By', BOOTY_TXT_DOMAIN); ?> <?php the_author(); ?>
                </a>
            </li>
            <?php
        endif;
        if ($hidden_tag != 'yes') :
            $args_tag = get_the_tags($post_id, 'category');
            if ($args_tag != ''):
                ?>
                <li class="tags">
                    <i class="fa fa-tags"></i>
                    <?php
                    $i = 1;
                    foreach ($args_tag as $key => $value) {
                        if ($i > 1) {
                            echo ',  <a href="' . get_tag_link($value->term_id) . '">' . $value->name . '</a>';
                        } else {
                            echo '<a href="' . get_tag_link($value->term_id) . '">' . $value->name . '</a>';
                        }
                        $i++;
                    }
                    ?>
                </li>
                <?php
            endif;
        endif;
        if ($hidden_like != 'yes') :
            echo like_button();
        endif;
        if ($hidden_comment != 'yes') :
            ?>
            <li class="comment">
                <i class="fa fa-comments"></i>
                <a href="<?php echo esc_url(get_permalink()) . '#comments'; ?>"
                   class="color_scheme_hover fw_normal"
                   title=""><?php echo ( $comments . ' '); ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php
}

function get_post_format_icon($format) {
    $format_icon = '';
    switch ($format) {
        case 'image' :
            $format_icon = 'fa-picture-o';
            break;

        case 'gallery' :
            $format_icon = 'fa-picture-o';
            break;

        case 'video' :
            $format_icon = 'fa-video-camera';
            break;

        case 'audio' :
            $format_icon = 'fa-volume-down';
            break;

        case 'quote' :
            $format_icon = 'fa-quote-left';
            break;

        case 'link' :
            $format_icon = 'fa-link';
            break;

        default :
            $format_icon = 'fa-pencil';
            break;
    }
    return $format_icon;
}

function booty_get_day_link($post_id = null) {
    if ($post_id) {
        $archive_year = get_the_time('Y', $post_id);
        $archive_month = get_the_time('m', $post_id);
        $archive_day = get_the_time('d', $post_id);
    } else {
        $archive_year = get_the_time('Y');
        $archive_month = get_the_time('m');
        $archive_day = get_the_time('d');
    }
    return get_day_link($archive_year, $archive_month, $archive_day);
}

function get_date_post($post_id) {
    global $post;

    $icon = get_post_format_icon(get_post_format());

    ob_start();
    ?>
    <span class="icon"><i class="fa <?php echo $icon; ?>"></i></span>
    <time datetime="<?php echo get_the_time('Y-m-d', $post_id); ?>">
        <span class="add"><?php echo get_the_date('d'); ?></span><?php echo get_the_date('M'); ?>
    </time>
    <?php
    return ob_get_clean();
}

//Like function
/**
 * Like button
 */
function like_button() {
    global $post, $booty_post_like;
    $base_class = '';
    $post_id = $post->ID;
    $likes_count = get_post_meta($post_id, '_likes_count', true);
    $likes_count = $likes_count ? $likes_count : 0;
    if (!is_numeric($post_id))
        return 0;
    if ($booty_post_like->already_liked($post_id)) {
        $base_class .= 'liked';
    }
    ?>
    <li class="like">
        <i class="fa fa-heart"></i>
        <a href="#" data-post_id="<?php echo esc_attr($post_id); ?>" data-post-like="true">
            <?php echo '<span class="' . $base_class . '">' . $likes_count . '</span>'; ?>
        </a>
    </li>
    <?php
}

function booty_tp_blog_loadmore($rquery, $nav_type, $items_type, $item_category, $items_show, $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog, $view_all, $space, $column) {
    if ($nav_type == 'loadmore') {
        if ($rquery->max_num_pages > 1) {
            ?>
            <a href="#" class="btn btn-dark btn-load booty_ajax_load_more" data-posttype="post" data-tax="<?php echo esc_attr($item_category) ?>" data-layout="<?php echo esc_attr($items_type) ?>" data-column="<?php echo esc_attr($column) ?>" data-space="<?php echo esc_attr($space) ?>" data-perpage="<?php echo esc_attr($items_show) ?>" data-currentpage="1" data-maxpage="<?php echo $rquery->max_num_pages; ?>" data-hideauthor="<?php $hidden_author_blog ?>" data-hidecat="<?php $hidden_cat_blog ?>" data-hidelike="<?php $hidden_like_blog ?>" data-hidecomment="<?php $hidden_comment_blog ?>" ><?php esc_html_e('Load more', BOOTY_TXT_DOMAIN); ?></a>
            <?php
        }
    }
    ?>
    <?php if ($view_all == 'yes') : ?>
        <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-dark btn-load"><?php esc_html_e('VIEW  ALL', BOOTY_TXT_DOMAIN); ?></a>
        <?php
    endif;
}

function booty_blog_filter() {
    $categories = get_categories();
    echo '<ul id="work-filter" class="list-inline isotop-controls"><li class="active"><a href="#">' . esc_html__('All', BOOTY_TXT_DOMAIN) . '</a></li>';
    foreach ($categories as $category) {
        echo '<li class=""><a data-filter=".' . esc_html($category->slug) . '" href="#">' . esc_html($category->name) . '</a></li>';
    }
    echo '</ul>';
}

function booty_thumb($att_id, $items_type) {
    if ($items_type == 'default')
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    elseif ($items_type == 'list-accordion')
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    elseif ($items_type == 'list-2column')
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    elseif ($items_type == 'single')
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    elseif ($items_type == 'full')
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    else
        $url_thumb_arr = wp_get_attachment_image_src($att_id, 'full');
    return $url_thumb_arr;
}

// before content post
function booty_before_content_post($post_id, $format, $items_type) {
    $booty_protocol = is_ssl() ? "https://" : "http://";
    if ($items_type == 'list-accordion')
        $class_opener = 'opener';
    else
        $class_opener = '';
    switch ($format) {
        case 'image' :
            $booty_images = array();
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);

            if ((isset($booty_data['post_image_id']) && is_array($booty_data['post_image_id'])) || has_post_thumbnail($post_id)) {

                if (isset($booty_data['post_image_id'])) {
                    $booty_images = $booty_data['post_image_id'];
                }
                if (has_post_thumbnail($post_id)) {
                    $url_thumb_arr = booty_thumb(get_post_thumbnail_id($post_id), $items_type);
                } elseif (!is_array($booty_data['post_image_id'])) {
                    $url_thumb_arr = '';
                }
            } else {
                return;
            }
            ob_start();
            ?>
            <div class="img-box">
                <?php
                if (has_post_thumbnail($post_id)) {
                    echo '<a class="' . esc_attr($class_opener) . '" href="' . get_the_permalink($post_id) . '"><img src="' . esc_url($url_thumb_arr[0]) . '" alt="' . esc_attr(get_the_title($post_id)) . '"/></a>';
                } else {
                    $booty_url_thumb = booty_thumb($booty_images[0], $items_type);
                    echo '<a class="' . esc_attr($class_opener) . '" href="' . get_the_permalink($post_id) . '"><img src="' . esc_url($booty_url_thumb[0]) . '" alt="' . esc_attr(get_the_title($post_id)) . '"/></a>';
                }
                ?>
            </div>
            <?php
            $booty_return = ob_get_clean();
            break;
        case 'gallery' :
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);
            if ((isset($booty_data['post_gallery_id']) && is_array($booty_data['post_gallery_id'])) || has_post_thumbnail($post_id)) {
                if (isset($booty_data['post_gallery_id'])) {
                    $booty_gallerys = $booty_data['post_gallery_id'];
                }
                if (has_post_thumbnail($post_id)) {
                    $url_thumb_arr = booty_thumb(get_post_thumbnail_id($post_id), $items_type);
                }
            } else {
                return;
            }
            ob_start();
            ?>
            <div class="img-box">
                <div class="beans-slider" data-rotate="true">
                    <div class="beans-mask">
                        <div class="beans-slideset">
                            <?php
                            if (!empty($booty_gallerys)) {
                                foreach ($booty_gallerys as $booty_gallery) {
                                    echo '<div class="beans-slide"><a href="' . get_the_permalink($post_id) . '">';
                                    $booty_url_thumb = booty_thumb($booty_gallery, $items_type);
                                    echo '<img src="' . esc_url($booty_url_thumb[0]) . '" alt="' . esc_attr(get_the_title($post_id)) . '"/>';
                                    echo '</a></div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="beans-pagination">
                    </div>
                </div>
            </div>
            <?php
            $booty_return = ob_get_clean();
            break;
        case 'video' :
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);
            if (isset($booty_data['post_video_url']) && $booty_data['post_video_url'] != ''):
                $booty_video = $booty_data['post_video_url'];
            else :
                return;
            endif;
            ob_start();
            if (strpos($booty_video, 'youtube.com/') != false) {
                $step1 = explode('v=', $booty_video);
                $step2 = explode('&', $step1[1]);
                $booty_video_id = $step2[0];
                echo '<div class="img-box video-area">';
                echo '<iframe src="' . $booty_protocol . 'www.youtube.com/embed/' . esc_attr($booty_video_id) . '" frameborder="0"></iframe>';
                echo '</div>';
            } elseif (strpos($booty_video, 'vimeo.com/') != false) {
                $step1 = explode('vimeo.com/', $booty_video);
                $step2 = explode('&', $step1[1]);
                $booty_video_id = $step2[0];
                echo '<div class="img-box video-area">';
                echo '<iframe src="' . $booty_protocol . 'player.vimeo.com/video/' . esc_attr($booty_video_id) . '"></iframe>';
                echo '</div>';
            } elseif (strpos($booty_video, 'dailymotion.com/video/') != false) {
                $step1 = explode('dailymotion.com/video/', $booty_video);
                $step2 = explode('dailymotion.com/video/', $step1[1]);
                $video_id = $step2[0];
                ?>
                <div class="video-area">
                    <iframe frameborder="0" width="100%" src="//www.dailymotion.com/embed/video/<?php echo $video_id; ?>" allowfullscreen></iframe>
                </div>
                <?php
            } else {
                $attr = array(
                    'src' => $booty_video,
                    'loop' => '',
                    'autoplay' => '',
                    'preload' => 'none',
                );
                global $wpdb;
                $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$booty_video'";
                $id_attachment = $wpdb->get_var($query);
                if (wp_attachment_is('video', $id_attachment)) {
                    echo wp_video_shortcode($attr);
                }
            }
            ?>
            <?php
            $booty_return = ob_get_clean();
            break;
        case 'audio' :
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);
            if (isset($booty_data['post_audio_url']) && $booty_data['post_audio_url'] != ''):
                $booty_audio = $booty_data['post_audio_url'];
            else :
                return;
            endif;
            ob_start();
            if (strpos($booty_audio, 'soundcloud.com/') != false) {
                echo '<div class="img-box video-area">';
                echo '<iframe class="w_full" width="100%" height="120" scrolling="no" frameborder="no" src="' . $booty_protocol . 'w.soundcloud.com/player/?url=' . esc_attr($booty_audio) . '&amp;color=ff5500&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe> ';
                echo '</div>';
            } elseif (strpos($booty_audio, 'mixcloud.com/') != false) {
                echo '<div class="img-box video-area">';
                echo '<iframe class="w_full" width="100%" height="120" scrolling="no" frameborder="no" src="https://www.mixcloud.com/widget/iframe/?feed=' . esc_attr($booty_audio) . '&hide_cover=1&mini=1&light=1"></iframe> ';
                echo '</div>';
            } else {
                ?>
                <div class="img-box audio-area">
                    <audio controls>
                        <source src="<?php echo $booty_audio; ?>" type="audio/mpeg">
                    </audio>
                </div>
                <?php
            }
            ?>
            <?php
            $booty_return = ob_get_clean();
            break;
        case 'quote' :
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);
            if (isset($booty_data['post_quote_content']) && $booty_data['post_quote_content'] != ''):
                $booty_quote = $booty_data['post_quote_content'];
            else :
                return;
            endif;
            ob_start();
            echo '<blockquote class="main-blockquote">' . esc_attr($booty_quote) . '</blockquote>';
            $booty_return = ob_get_clean();
            break;
        case 'link' :
            $booty_data = get_post_meta($post_id, '_additional_data_option', true);
            if (isset($booty_data['post_link_url']) && isset($booty_data['post_link_title'])):
                $booty_link_url = $booty_data['post_link_url'];
                $booty_link_title = $booty_data['post_link_title'];
            else :
                return;
            endif;
            ob_start();
            echo '<h2><a href="' . esc_url($booty_link_url) . '" target="_blank"><i class="fa fa-fw fa-link"></i>' . esc_attr($booty_link_title) . '</a></h2>';
            $booty_return = ob_get_clean();
            break;
        case 'aside' :
            if (has_post_thumbnail($post_id)) {
                if (has_post_thumbnail($post_id)) {
                    $url_thumb_arr = booty_thumb(get_post_thumbnail_id($post_id), $items_type);
                }
                $url_thumb = $url_thumb_arr[0];
            } else {
                return;
            }
            ob_start();
            ?>
            <div class="img-box">
                <a class="<?php echo esc_attr($class_opener) ?>" href="<?php echo get_the_permalink($post_id) ?>">
                    <img src="<?php echo esc_url($url_thumb) ?>" alt="<?php echo get_the_title($post_id); ?>"/>
                </a>
            </div>
            <?php
            $booty_return = ob_get_clean();
            break;
        default :
            if (has_post_thumbnail($post_id)) {
                if (has_post_thumbnail($post_id)) {
                    $url_thumb_arr = booty_thumb(get_post_thumbnail_id($post_id), $items_type);
                }
                $url_thumb = $url_thumb_arr[0];
            } else {
                $url_thumb = '';
            }
            ob_start();
            if ($url_thumb != '') :
                ?>
                <div class="img-box">
                    <a class="<?php echo esc_attr($class_opener) ?>" href="<?php echo get_the_permalink($post_id) ?>">
                        <img src="<?php echo esc_url($url_thumb) ?>" alt="<?php echo get_the_title($post_id); ?>"/>
                    </a>
                </div>
                <?php
            endif;
            $booty_return = ob_get_clean();
            break;
    }
    return $booty_return;
}

// paging navigation
function booty_paging_navigation($type, $query = null) {
    if ($query == null) {
        $query = $GLOBALS['wp_query'];
    } else {
        $query = $query;
    }
    $max_page = $query->max_num_pages;
    if ($max_page < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';
    // Set up paginated links.
    $links = @paginate_links(array(
                'base' => $pagenum_link,
                'format' => $format,
                'total' => $query->max_num_pages,
                'current' => $paged,
                'mid_size' => 2,
                'add_args' => array_map('urlencode', $query_args),
                'prev_next' => false,
                'type' => 'array'
    ));

    if (count($links)) :
        $index = 0;
        $length = count($links);
        if ($type == 'type1') {
            ?>
            <nav class="blog-footer">
                <div class="btn-box">
                    <a href="<?php echo esc_url(previous_posts(false)); ?>" class="btn"><?php esc_html_e('PREVIOUS', BOOTY_TXT_DOMAIN) ?></a>
                    <a href="<?php echo esc_url(next_posts($max_page, false)); ?>" class="btn"><?php esc_html_e('NEXT', BOOTY_TXT_DOMAIN) ?></a>
                </div>
                <ul class="b-pagination list-unstyled">
                    <?php
                    foreach ($links as $key => $link) :
                        if (strpos($link, 'current"') > 0 || strpos($link, 'current\'') > 0) :
                            ?>
                            <li class="active"><a href="#"><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></a></li><?php elseif (strpos($link, 'dots"') > 0 || strpos($link, 'dots\'') > 0) :
                    ?>
                            <li class="dots"><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></li><?php else :
                    ?>
                            <li><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></li><?php
                        endif;
                        $index++;
                    endforeach;
                    ?>
                </ul>
            </nav>
        <?php }elseif ($type == 'type2' || $type == 'type3') {
            ?>
            <?php if ($type == 'type2'): ?>
                <div class="buttons-box">
                    <a href="<?php echo esc_url(previous_posts(false)); ?>" class="btn shop-prev"><?php esc_html_e('PREVIOUS', BOOTY_TXT_DOMAIN) ?></a>
                    <a href="<?php echo esc_url(next_posts($max_page, false)); ?>" class="btn shop-next"><?php esc_html_e('next', BOOTY_TXT_DOMAIN) ?></a>
                </div>
            <?php endif; ?>
            <ul class="shop-pagination list-inline">
                <li class="prev"><a href="<?php echo esc_url(previous_posts(false)); ?>"><i class="fa fa-angle-double-left"></i></a></li>
                <?php
                foreach ($links as $key => $link) :
                    if (strpos($link, 'current"') > 0 || strpos($link, 'current\'') > 0) :
                        ?>
                        <li class="active"><a href="#"><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></a></li><?php elseif (strpos($link, 'dots"') > 0 || strpos($link, 'dots\'') > 0) :
                        ?>
                        <li class="dots"><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></li><?php else :
                        ?>
                        <li><?php echo wp_kses($link, wp_kses_allowed_html('post')); ?></li><?php
                    endif;
                    $index++;
                endforeach;
                ?>
                <li class="next"><a href="<?php echo esc_url(next_posts($max_page, false)); ?>"><i class="fa fa-angle-double-right"></i></a></li>
            </ul>
            <?php
        }
    endif;
}

/**
 * For populating most viewed posts
 */
function booty_set_post_view_count() {
    global $post;
    $count = get_post_meta($post->ID, 'post_views_count', true);

    if ($count == '') {
        $count = 0;
        delete_post_meta($post->ID, 'post_views_count');
        add_post_meta($post->ID, 'post_views_count', '0');
    } else {
        $count++;
        update_post_meta($post->ID, 'post_views_count', $count);
    }
}

function wpcodex_add_format_for_portfolio() {
    add_post_type_support('portfolio', 'post-formats');
}

add_action('init', 'wpcodex_add_format_for_portfolio');

function post_nagivation($args) {
    global $post;

    $default = array(
        'post_type_link' => '',
        'container_class' => '',
        'prev_link_class' => '',
        'next_link_class' => '',
        'prev_link_before' => '',
        'next_link_after' => ''
    );

    $args = array_merge($default, $args);
    if ('' != $args['prev_link_class']) {
        $args['prev_link_class'] = ' class="' . $args['prev_link_class'] . '"';
    }
    if ('' != $args['next_link_class']) {
        $args['next_link_class'] = ' class="' . $args['next_link_class'] . '"';
    }

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
    $next = get_adjacent_post(false, '', false);

    if (!$next && !$previous)
        return;
    ?>
    <nav class="navigation post-navigation">
        <div class="nav-links clearfix <?php echo $args['container_class']; ?>">
            <?php
            $prev_post = get_previous_post();
            if (!empty($prev_post)):
                ?>
                <a <?php echo $args['prev_link_class']; ?>
                    href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo $args['prev_link_before']; ?></a>
                <?php endif; ?>
            <a href="<?php echo $args['post_type_link'] ?>" class="dashboard"><i class="fa fa-th"></i></a>
                <?php
                $next_post = get_next_post();
                if (is_a($next_post, 'WP_Post')) {
                    ?>
                <a <?php echo $args['next_link_class']; ?>
                    href="<?php echo get_permalink($next_post->ID); ?>"><?php echo $args['next_link_after']; ?></a>
    <?php } ?>

        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}

function booty_post() {
    global $post;
    return $post;
}

function booty_settings() {
    global $booty_settings;
    return $booty_settings;
}

function booty_page_id() {
    if (is_page() || is_home() || (class_exists('WooCommerce') && is_shop())) {
        if (is_page()) {
            $post_id = get_the_ID();
        } elseif (is_home()) {
            if (get_option('page_for_posts')) {
                $post_id = get_option('page_for_posts');
            } else {
                return false;
            }
        } else {
            if (get_option('woocommerce_shop_page_id'))
                $post_id = get_option('woocommerce_shop_page_id');
            else
                return false;
        }
    }else {
        return false;
    }
    return $post_id;
}

function booty_header_fixed() {
    if (booty_page_id()) {
        $post_id = booty_page_id();
        if (get_post_meta($post_id, 'header_fixed', true)) {
            return true;
        }
    } else {
        return false;
    }
}

function booty_header_over() {
    if (booty_page_id()) {
        $post_id = booty_page_id();
        if (get_post_meta($post_id, 'header_over', true)) {
            return true;
        }
    } else {
        return false;
    }
}
