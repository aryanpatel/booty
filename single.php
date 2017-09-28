<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Booty
 *
 */
get_header();
$hidden_author_blog = 'show';
$hidden_cat_blog = 'show';
$hidden_like_blog = 'show';
$hidden_comment_blog = 'show';
?>
<?php booty_heading_banner('single'); ?>
<div id="primary" class="content-area">
    <?php
    if (have_posts()) :
        // Start the loop.
        while (have_posts()) : the_post();
            ?>
            <div class="port-single padding-top-100">
                <article <?php post_class('blog-post-v1 style-full padding-b-zero border-zero'); ?>>
                    <?php
                    $forma_type = get_post_format(get_the_ID());
                    $meta_data = get_post_meta(get_the_ID(), '_additional_data_option', true);
                    $layout_img = $layout_glry = '';
                    $layout_img = (isset($meta_data['post_image_layout'])) ? $meta_data['post_image_layout'] : '';
                    $layout_glry = (isset($meta_data['post_gallery_layout'])) ? $meta_data['post_gallery_layout'] : '';

                    if (isset($meta_data['post_image_id']) || isset($meta_data['post_gallery_id']) || isset($meta_data['post_video_url']) || isset($meta_data['post_audio_url']) || isset($meta_data['post_quote_content'])):
                        switch ($forma_type) {
                            case 'image':
                                if ($layout_img == 'full-width' || $layout_img == 'parallax-full-width') {
                                    echo '<div class="layout-full-width">';
                                } else {
                                    echo '<div class="container">';
                                }
                                break;
                            case 'gallery':
                                if ($layout_glry == 'full-width') {
                                    echo '<div class="layout-full-width">';
                                } else {
                                    echo '<div class="container">';
                                }
                                break;
                            default:
                                echo '<div class="container">';
                                break;
                        }
                        ?>
                        <div class="img-box">
                            <?php
                            switch ($forma_type) {
                                case 'image':
                                    # code...
                                    if (isset($meta_data['post_image_id'])) {
                                        $img_ID = $meta_data['post_image_id'];
                                    } else {
                                        $img_ID = '';
                                    }
                                    if ($layout_img == 'image-3column') {
                                        echo '<div class="row">';
                                        if (has_post_thumbnail()) {
                                            ?>
                                            <div class="col-xs-12 col-sm-4">
                                                <?php the_post_thumbnail('full', array('class' => 'margin-bottom-30')); ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    if ($layout_img == 'parallax-full-site' || $layout_img == 'parallax-full-width') {
                                        ?>
                                        <section class="port-parallex small">
                                            <div class="parallax-holder">
                                                <div class="parallax-frame">
                                                    <?php the_post_thumbnail('full', array('class' => 'margin-bottom-30')); ?>
                                                </div>
                                            </div>
                                        </section>
                                        <?php
                                    } elseif ($layout_img != 'image-3column') {
                                        if (has_post_thumbnail()) {
                                            the_post_thumbnail('full', array('class' => 'margin-bottom-30'));
                                        }
                                    }
                                    if ($img_ID != '') :

                                        foreach ($img_ID as $key => $value) {
                                            if ($layout_img == 'parallax-full-site' || $layout_img == 'parallax-full-width') :
                                                ?>
                                                <section class="port-parallex small">
                                                    <div class="parallax-holder">
                                                        <div class="parallax-frame">
                                                            <img src="<?php echo wp_get_attachment_url($value); ?>" height="1394" width="2000" alt="image description">
                                                        </div>
                                                    </div>
                                                </section>
                                                <?php
                                            elseif ($layout_img == 'image-3column') :
                                                ?>
                                                <div class="col-xs-12 col-sm-4">
                                                    <img src="<?php echo wp_get_attachment_url($value); ?>" alt="image description" class="img-responsive">
                                                </div>
                                                <?php
                                            else :
                                                ?>
                                                <img class="margin-bottom-30" src="<?php echo wp_get_attachment_url($value); ?>" />
                                            <?php
                                            endif;
                                        }
                                    endif;
                                    if ($layout_img == 'image-3column')
                                        echo '</div>';
                                    break;
                                case 'gallery':
                                    if (isset($meta_data['post_gallery_id'])) {
                                        $img_ID = $meta_data['post_gallery_id'];
                                    } else {
                                        $img_ID = '';
                                    }
                                    ?>
                                    <div class="beans-slider" data-rotate="true">
                                        <div class="beans-mask">
                                            <div class="beans-slideset">
                                                <?php
                                                if ($img_ID != '') :
                                                    foreach ($img_ID as $key => $value) {
                                                        ?>
                                                        <!-- beans-slide -->
                                                        <div class="beans-slide">
                                                            <div class="stretch">
                                                                <img src="<?php echo wp_get_attachment_url($value); ?>" />
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                        <?php if ($layout_glry == 'full-width') : ?>
                                            <div class="row arrow-holder">
                                                <div class="container">
                                                    <a href="#" class="btn-prev"><i class="fa fa-angle-left"></i></a>
                                                    <a href="#" class="btn-next"><i class="fa fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        <?php else : ?>
                                            <div class="arrow-holder">
                                                <div class="col-xs-12">
                                                    <a href="#" class="btn-prev"><i class="fa fa-angle-left"></i></a>
                                                    <a href="#" class="btn-next"><i class="fa fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php
                                    break;
                                case 'video':
                                    $linkesc_html_embeds = $meta_data['post_video_url'];
                                    if (strpos($linkesc_html_embeds, 'youtube.com/') != false) {
                                        $step1 = explode('v=', $linkesc_html_embeds);
                                        $step2 = explode('&', $step1[1]);
                                        $booty_video_id = $step2[0];
                                        ?>
                                        <div class="video-area">
                                            <iframe  src="https://www.youtube.com/embed/<?php echo $booty_video_id; ?>" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                        <?php
                                    } elseif (strpos($linkesc_html_embeds, 'vimeo.com/') != false) {
                                        $step1 = explode('vimeo.com/', $linkesc_html_embeds);
                                        $step2 = explode('&', $step1[1]);
                                        $booty_video_id = $step2[0];
                                        ?>
                                        <div class="video-area">
                                            <iframe src="https://player.vimeo.com/video/<?php echo $booty_video_id; ?>?title=0&byline=0&portrait=0"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                        </div>
                                        <?php
                                    } elseif (strpos($linkesc_html_embeds, 'dailymotion.com/video/') != false) {
                                        $step1 = explode('dailymotion.com/video/', $linkesc_html_embeds);
                                        $step2 = explode('dailymotion.com/video/', $step1[1]);
                                        $video_id = $step2[0];
                                        ?>
                                        <div class="video-area">
                                            <iframe frameborder="0" width="100%" height="500" src="//www.dailymotion.com/embed/video/<?php echo $video_id; ?>" allowfullscreen></iframe>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="video-area">
                                            <video width="100%" height="100%">
                                                <source src="<?php echo $linkesc_html_embeds; ?>" type="video/mp4">
                                            </video>
                                        </div>
                                        <?php
                                    }
                                    break;
                                case 'audio':
                                    $linkesc_html_embeds = $meta_data['post_audio_url'];
                                    if (strpos($linkesc_html_embeds, 'soundcloud.com/') != false) {
                                        ?>
                                        <div class="audio-area">
                                            <iframe width="100%" height="450" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $linkesc_html_embeds; ?>&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&visual=true"></iframe>
                                        </div>
                                        <?php
                                    } elseif (strpos($linkesc_html_embeds, 'mixcloud.com/') != false) {
                                        ?>
                                        <div class="audio-area">
                                            <iframe width="100%" height="60" src="https://www.mixcloud.com/widget/iframe/?feed=<?php echo $linkesc_html_embeds; ?>&hide_cover=1&mini=1&light=1" frameborder="0"></iframe>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="audio-area">
                                            <audio controls>
                                                <source src="<?php echo $linkesc_html_embeds; ?>" type="audio/mpeg">
                                            </audio>
                                        </div>
                                        <?php
                                    }

                                    break;
                                case 'quote':
                                    $block_content = $meta_data['post_quote_content'];
                                    ?>
                                    <blockquote class="main-blockquote"><?php echo esc_html($block_content); ?></blockquote>
                                    <?php
                                    break;
                                case 'link' :
                                    if (isset($meta_data['post_link_url']) && isset($meta_data['post_link_title'])):
                                        $booty_link_url = $meta_data['post_link_url'];
                                        $booty_link_title = $meta_data['post_link_title'];
                                        echo '<h2><a href="' . esc_url($booty_link_url) . '" target="_blank"><i class="fa fa-fw fa-link"></i>' . esc_attr($booty_link_title) . '</a></h2>';
                                    endif;
                                    break;
                                case 'aside' :
                                    if (has_post_thumbnail(get_the_ID())) {
                                        $url_thumb_arr = booty_thumb(get_post_thumbnail_id(get_the_ID()), 'full');
                                        $url_thumb = $url_thumb_arr[0];
                                        ?>
                                        <div class="img-box">
                                            <a href="<?php echo get_the_permalink() ?>">
                                                <img src="<?php echo esc_url($url_thumb) ?>" alt="<?php echo get_the_title(); ?>"/>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    break;
                                default :
                                    if (has_post_thumbnail()) {
                                        $url_thumb_arr = booty_thumb(get_post_thumbnail_id(get_the_ID()), 'full');
                                        $url_thumb = $url_thumb_arr[0];
                                        ?>
                                        <div class="img-box">
                                            <a href="<?php echo get_the_permalink() ?>">
                                                <img src="<?php echo esc_url($url_thumb) ?>" alt="<?php echo get_the_title(); ?>"/>
                                            </a>
                                        </div>
                                        <?php
                                    }
                                    break;
                            }
                            ?>
                        </div>
                        <?php
                        echo '</div>';
                    endif;
                    ?>
                    <div class="container">
                        <div class="blog-post-v1 margin-b-zero style-full">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="box-holder">
                                        <?php echo get_date_post(get_the_ID()); ?>
                                    </div>
                                    <div>
                                        <h2><?php the_title(); ?></h2>
                                        <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                                    </div>
                                    <div class="single-content">
                                        <?php
                                        the_content();
                                        wp_link_pages(array(
                                            'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'booty') . '</span>',
                                            'after' => '</div>',
                                            'link_before' => '<span>',
                                            'link_after' => '</span>',
                                            'pagelink' => '<span class="screen-reader-text">' . esc_html__('Page', 'booty') . ' </span>%',
                                            'separator' => '<span class="screen-reader-text">, </span>',
                                        ));
                                        ?>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>
                <div class="container">
                    <footer class="post-footer">
                        <div class="post-tags">
                            <strong class="title"><?php echo esc_html('Tagged by', 'booty') ?></strong>
                            <ul class="list-unstyled">
                                <?php
                                $booty_cats = get_the_category();
                                foreach ($booty_cats as $booty_cat):
                                    ?>
                                    <li><?php echo '<a href="' . esc_url(get_category_link($booty_cat->term_id)) . '" alt="' . esc_attr(sprintf(esc_html__('View all posts in %s', 'booty'), $booty_cat->name)) . '">' . esc_html($booty_cat->name) . '</a>' ?></li>
                                    <?php
                                endforeach;
                                ?>
                            </ul>
                        </div>
                        <ul class="post-social list-unstyled">
                            <li><span class='st_facebook_large' displayText='Facebook'><i class="fa fa-facebook"></i> </span><?php esc_html_e('SHARE', 'booty') ?></li>
                            <li><span class='st_twitter_large' displayText='Tweet'><i class="fa fa-twitter"></i> </span><?php esc_html_e('TWEET', 'booty') ?></li>
                            <li><span class='st_pinterest_large' displayText='Pinterest'><i class="fa fa-pinterest"></i> </span><?php esc_html_e('PIN', 'booty') ?></li>
                        </ul>
                    </footer>
                    <div class="post-author-box">
                        <div class="img-box">
        <?php $author_id = get_the_author_meta('ID');
        echo get_avatar($author_id, 120) ?>
                        </div>
                        <div class="holder">
                            <strong class="title"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')) ?>">- <?php the_author(); ?></a></strong>
                            <span class="aut-text"><?php echo count_user_posts($author_id, 'post') . ' ' . esc_html('POST', 'booty') ?>  -  <?php echo get_comments(array('user_id' => $author_id, 'count' => true)) . ' ' . esc_html('COMMENTS', 'booty'); ?></span>
                            <p><?php the_author_meta('description', $author_id); ?></p>
                        </div>
                    </div>
                    <?php if (comments_open() || get_comments_number()) : echo '<div class="comment-box">';
                        comments_template();
                        echo '</div>';
                    endif; ?>
                    <?php
                    if (is_singular('post')) {
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Next', 'booty') . '</span> ',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__('Previous', 'booty') . '</span> ',
                        ));
                    }
                    ?>
                </div>
            </div>
            <?php endwhile;
        wp_reset_postdata();
        ?>
        <?php
        $args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
        );
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'post_layout',
                'field' => 'slug',
                'terms' => 'single-latest',
            ),
        );
        $rquery = new Wp_Query($args);
        if ($rquery->have_posts()) :
            ?>
            <div class="container-fluid related-post-widget bg-grey dark-bottom-border">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <h5><?php esc_html_e('Related News', 'booty') ?></h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="row">
                                    <?php
                                    while ($rquery->have_posts()) : $rquery->the_post();
                                        ?>
                                <article class="blog-post-v2">
                                            <?php echo booty_before_content_post(get_the_ID(), get_post_format(), 'full'); ?>
                                    <div class="blog-txt">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                                        <p><?php echo wp_trim_words(get_the_content(), 20, ''); ?></p>
                                        <div class="box">
                                <?php echo get_date_post(get_the_ID()); ?>
                                        </div>
                                    </div>
                                </article>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    endif;
endif;
?>
</div><!-- .content-area -->

<?php get_footer(); ?>
