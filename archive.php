<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 * @package WordPress
 * @subpackage Booty
 * @since Booty 1.0
 */
get_header();
$hidden_author_blog = 'show';
$hidden_cat_blog = 'show';
$hidden_like_blog = 'show';
$hidden_comment_blog = 'show';
$booty_settings = booty_settings();
$items_type = $booty_settings['archive_post_type'];
$space = $booty_settings['archive_post_space'];
$column = $booty_settings['archive_post_column'];
$nav = $booty_settings['archive_post_nav'];
?>
<?php booty_heading_banner('archive'); ?>
<div class="content-main">
    <div id="primary" class="site-content">
        <div id="content" role="main">
            <div class="container">
                <div class="booty-blog padding-top-100">
                    <?php if (have_posts()) : ?>
                        <?php
                        if ($items_type == 'gird' || $items_type == 'masonry') {
                            if ($items_type == 'masonry')
                                booty_blog_filter();
                            $item_class = 'blog-post-v1 item';
                            $wrapper_class = 'blog-masonry-holder booty_wrapper_ajax';
                            $wrapper_id = 'masonry-container';
                            if ($items_type == 'masonry')
                                $wrapper_id = 'work';
                            if ($space == 'without_space')
                                $item_class .= ' nospace';
                            if ($column == '2columns') {
                                $item_class .= ' style5';
                                $wrapper_class .= ' full-width';
                            } elseif ($column == '3columns') {
                                $item_class .= ' style3';
                            } elseif ($column == '4columns') {
                                $item_class .= ' style6';
                            } elseif ($column == 'fullwidth') {
                                if ($items_type == 'masonry') {
                                    $item_class .= ' style3';
                                } else {
                                    $item_class .= ' style6';
                                } $wrapper_class .= ' full-width';
                            }
                            echo '<div class="' . $wrapper_class . '" id="' . $wrapper_id . '">';
                            while (have_posts()) : the_post();
                                if ($items_type == 'masonry') {
                                    $categories = get_the_category(get_the_ID());
                                    if (!empty($categories)) {
                                        foreach ($categories as $category) {
                                            $item_class .= ' ' . $category->slug;
                                        }
                                    }
                                }
                                ?>
                                <archive class="<?php echo $item_class; ?>">
                                <?php echo booty_before_content_post(get_the_ID(), get_post_format(), $items_type); ?>
                                    <div class="blog-txt">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                                        <p><?php echo wp_trim_words(get_the_content(), 20, ''); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="more"><?php echo '[ ' . __('CONTINUE READING', BOOTY_TXT_DOMAIN) . ' ]' ?></a>
                                        <div class="box-holder">
                                <?php echo get_date_post(get_the_ID()); ?>
                                        </div>
                                    </div>
                                </archive>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            echo '</div>';
                            if ($nav == 'loadmore') {
                                echo '<nav class="blog-footer style2 text-center">';
                                $items_show = get_option('posts_per_page');
                                echo booty_tp_blog_loadmore($GLOBALS['wp_query'], $nav, $items_type, '', $items_show, $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog, 'no', $space, $column);
                                echo '</nav>';
                            } elseif ($nav == 'pagination') {
                                booty_paging_navigation('type1', $GLOBALS['wp_query']);
                            }
                        }
                        ?>
    <?php
else :
    get_template_part('content', 'none');
endif;
?>
                </div>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
</div>
<?php get_footer(); ?>

