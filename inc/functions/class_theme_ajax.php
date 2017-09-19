<?php
/**
 * Ajax handler for the theme
 * @package Fekra
 */
if (!defined('ABSPATH')) {
    exit('Cheatin\' huh?');
}

class Booty_Theme_Ajax {

    public function __construct() {
        //-- Blog posts masonry load more process 
        add_action('wp_ajax_booty_ajax_load_more', array($this, 'booty_ajax_load_more'));
        add_action('wp_ajax_nopriv_booty_ajax_load_more', array($this, 'booty_ajax_load_more'));
        add_action('wp_ajax_nopriv_load_woo_cart', array($this, 'load_woo_cart'));
        add_action('wp_ajax_load_woo_cart', array($this, 'load_woo_cart'));
        add_action('wp_ajax_nopriv_booty_style_changer', array($this, 'booty_style_changer'));
        add_action('wp_ajax_booty_style_changer', array($this, 'booty_style_changer'));
    }

    function enqueue() {
        wp_enqueue_script('booty-js-ajax', BOOTY_URI . '/assets/js/jquery.ajax.js', array('jquery'), '1.0', true);
    }

    function booty_style_changer() {
        $booty_skin = $_POST['booty_style'];
        echo $booty_style = BOOTY_ASSEST_DIR . '/css/color/' . $booty_skin . '.css';
        die();
    }

    function load_woo_cart() {
        woocommerce_mini_cart();
        die();
    }

    function booty_ajax_load_more() {
        $booty_post_type = $_POST['booty_posttype'];
        $booty_tax = $_POST['booty_tax'];
        $booty_layout = $_POST['booty_layout'];
        $booty_perpage = $_POST['booty_perpage'];
        $booty_currentpage = $_POST['booty_currentpage'];
        if ($booty_post_type == 'post') {
            $hidden_author_blog = $_POST['booty_hideauthor'];
            $hidden_cat_blog = $_POST['booty_hidecat'];
            $hidden_like_blog = $_POST['booty_hidelike'];
            $hidden_comment_blog = $_POST['booty_hidecomment'];
            $hidden_comment_blog = $_POST['booty_hidecomment'];
            $column = $_POST['booty_column'];
            $space = $_POST['booty_space'];
            if ($booty_tax != '') {
                $args = array(
                    'post_type' => $booty_post_type,
                    'post_status' => 'publish',
                    'posts_per_page' => (int) $booty_perpage,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_layout',
                            'field' => 'slug',
                            'terms' => $booty_tax,
                        ),
                    ),
                    'paged' => (int) $booty_currentpage + 1,
                );
            } else {
                $args = array(
                    'post_type' => $booty_post_type,
                    'post_status' => 'publish',
                    'posts_per_page' => (int) $booty_perpage,
                    'paged' => (int) $booty_currentpage + 1,
                );
            }
            $rquery = new Wp_Query($args);
            if ($booty_layout == 'list-accordion') {
                while ($rquery->have_posts()) : $rquery->the_post();
                    ?>
                    <li class="blog-m-post accordion">
                    <?php echo booty_before_content_post(get_the_ID(), get_post_format(), 'list-accordion'); ?>
                        <div class="blog-txt">
                            <h3><a href="<?php the_permalink(); ?>" class="opener"><?php the_title(); ?></a></h3>
                            <!-- meta -->
                                <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                            <!-- box slide -->
                            <div class="blog-slide">
                    <?php
                    echo get_post_format() . '<br />';
                    echo wp_trim_words(get_the_content(), 25, '...');
                    ?>
                                <br />
                                <a href="<?php the_permalink(); ?>" class="btn btn-dark"> <?php echo esc_html_e('DETAILS', BOOTY_TXT_DOMAIN); ?></a>
                            </div> 
                            <div class="box-holder">
                    <?php echo get_date_post(get_the_ID()); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                }elseif ($booty_layout == 'default') {
                    while ($rquery->have_posts()) : $rquery->the_post();
                        ?>
                    <article class="blog-post-v1 style2">
                        <!-- img-box -->
                                <?php echo booty_before_content_post(get_the_ID(), get_post_format(), 'default'); ?>

                        <!-- blog-txt -->
                        <div class="blog-txt">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <!-- meta -->
                                <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                            <div>
                    <?php
                    echo wp_trim_words(get_the_content(), 100, '...');
                    ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('[ CONTINUE READING ]', BOOTY_TXT_DOMAIN); ?></a>
                            <!-- box-holder -->
                            <div class="box-holder">
                    <?php echo get_date_post(get_the_ID()); ?>
                            </div>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
            }elseif ($booty_layout == 'default2') {
                $booty_flag = $booty_perpage;
                while ($rquery->have_posts()) : $rquery->the_post();
                    ob_start();
                    echo booty_before_content_post(get_the_ID(), get_post_format(), $booty_layout);
                    $img_box = ob_get_clean();
                    ob_start();
                    ?>
                    <div class="blog-txt">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <!-- meta -->
                    <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                        <div>
                    <?php
                    echo wp_trim_words(get_the_content(), 100, '...');
                    ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="more"><?php esc_html_e('[ CONTINUE READING ]', BOOTY_TXT_DOMAIN); ?></a>
                        <!-- box-holder -->
                        <div class="box-holder">
                        <?php echo get_date_post(get_the_ID()); ?>
                        </div>
                    </div>
                        <?php
                        $blog_txt = ob_get_clean();
                        ?>
                    <article class="blog-post-v1 style2">
                    <?php
                    if ($booty_flag % 2 == 0) {
                        echo ($img_box . $blog_txt);
                    } else {
                        echo ($blog_txt . $img_box);
                    }
                    $booty_flag ++;
                    ?>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
            } elseif ($booty_layout == 'fullwidth-list') {
                $booty_flag = 0;
                $booty_count = $rquery->post_count;
                while ($rquery->have_posts()) : $rquery->the_post();
                    if ($booty_flag == 0) {
                        echo '<div class="col-xs-12">
								<div class="row">';
                    } elseif ($booty_flag != 0 && $booty_flag % 3 == 0 && $booty_flag < $booty_count) {
                        echo '</div></div>';
                        echo '<div class="col-xs-12">
								<div class="row">';
                    }
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
                    <?php $booty_flag = $booty_flag + 1;
                    if ($booty_flag == $booty_count) {
                        echo '</div></div>';
                    } ?>
                <?php
                endwhile;
                wp_reset_postdata();
            } elseif ($booty_layout == 'gird' || $booty_layout == 'masonry') {
                $item_class = 'blog-post-v1 item';
                if ($space == 'without_space')
                    $item_class .= ' nospace';
                if ($column == '2columns') {
                    $item_class .= ' style5';
                } elseif ($column == '3columns') {
                    $item_class .= ' style3';
                } elseif ($column == '4columns') {
                    $item_class .= ' style6';
                } elseif ($column == 'fullwidth') {
                    if ($booty_layout == 'masonry') {
                        $item_class .= ' style3';
                    } else {
                        $item_class .= ' style6';
                    }
                }
                while ($rquery->have_posts()) : $rquery->the_post();
                    if ($booty_layout == 'masonry') {
                        $categories = get_the_category(get_the_ID());
                        if (!empty($categories)) {
                            foreach ($categories as $category) {
                                $item_class .= ' ' . $category->slug;
                            }
                        }
                    }
                    ?>
                    <archive class="<?php echo $item_class; ?>">
                    <?php echo booty_before_content_post(get_the_ID(), get_post_format(), $booty_layout); ?>
                        <div class="blog-txt">
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php echo get_meta_blog(get_the_ID(), $hidden_author_blog, $hidden_cat_blog, $hidden_like_blog, $hidden_comment_blog); ?>
                            <p><?php echo wp_trim_words(get_the_content(), 100, ''); ?></p>
                            <a href="<?php the_permalink(); ?>" class="more"><?php echo '[ ' . __('CONTINUE READING', BOOTY_TXT_DOMAIN) . ' ]' ?></a>
                            <div class="box-holder">
                    <?php echo get_date_post(get_the_ID()); ?>
                            </div>
                        </div>
                    </archive>
                    <?php
                endwhile;
                wp_reset_postdata();
            }
        } elseif ($booty_post_type = "portfolio" && $_POST['booty_taxtype'] == "portfolio_layout") {
            if ($booty_tax != '') :
                $args = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish',
                    'posts_per_page' => $booty_perpage,
                    'paged' => (int) $booty_currentpage + 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'portfolio_layout',
                            'field' => 'slug',
                            'terms' => $booty_tax,
                        ),
                    ),
                );
            else :
                $args = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish',
                    'posts_per_page' => $booty_perpage,
                    'paged' => (int) $booty_currentpage + 1,
                );
            endif;
            $rquery = new Wp_Query($args);
            $effect = $_POST['booty_effect'];
            $effect_css = '';
            switch ($effect) {
                case 'zoom-in':
                    $effect_css = 'style3';
                    break;
                case 'bottom-to-top':
                    $effect_css = 'style5';
                    break;
                default:
                    # code...
                    break;
            }
            $column_show = $_POST['booty_column'];
            if ($column_show == 1) {
                $column_class = 'coll-2';
            } else if ($column_show == 2) {
                $column_class = 'coll-2';
            } else if ($column_show == 3) {
                $column_class = 'coll-3';
            } else if ($column_show == 4) {
                $column_class = 'coll-4';
            } else if ($column_show == 5) {
                $column_class = 'coll-5';
            } else if ($column_show == 6) {
                $column_class = 'coll-6';
            } else {
                $column_class = 'coll-2';
            }

            /* Layout default */
            if ($booty_layout == 'normal') {
                if ($rquery->have_posts()) :
                    while ($rquery->have_posts()) : $rquery->the_post();
                        ?>
                        <!-- portfolio block coll-4 style3 nospace -->
                        <div class="portfolio-block <?php echo esc_html($column_class) . ' ';
                            echo ( $effect_css != '' ) ? ' ' . esc_html($effect_css) : ''; ?> nospace">
                            <!-- box -->
                            <div class="box">
                                <a href="<?php the_permalink(); ?>" class="over capitalize">
                                    <div class="holder">
                                        <div class="frame">
                                            <div class="over-frame">
                                <?php if ($effect != 'bottom-to-top'): ?>
                                                    <span class="plus small">&#43;</span>
                                                    <strong class="title upper"><?php the_title() ?></strong>
                            <?php
                            $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                            if ($booty_portfolio_cat != ''):
                                foreach ($booty_portfolio_cat as $term) {
                                    echo '<p>' . esc_html($term->name) . '</p>';
                                }
                            endif;
                        else :
                            ?>
                                                    <h2 class="title no-bg text-left padding-zero"><?php the_title() ?></h2>
                                                    <ul class="porto-nav list-inline text-left">
                            <?php
                            $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                            if ($booty_portfolio_cat != ''):
                                foreach ($booty_portfolio_cat as $term) {
                                    echo '<li>' . esc_html($term->name) . '</li>';
                                }
                            endif;
                            ?>
                                                    </ul>
                        <?php
                        endif;
                        ?>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                        <?php the_post_thumbnail('full'); ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
            } elseif ($booty_layout == 'portfolio-filter' || $booty_layout == 'portfolio-filter-nospace') {
                $nav_type = $_POST['booty_navtype'];
                $space_class = '';
                if ($booty_layout == 'portfolio-filter-nospace') {
                    $space_class = 'nospace';
                } else {
                    $space_class = '';
                }
                if ($column_show == 1) {
                    $column_class = 'coll-12';
                } else if ($column_show == 2) {
                    $column_class = 'coll-2';
                } else if ($column_show == 3) {
                    $column_class = 'coll-3';
                } else if ($column_show == 4) {
                    $column_class = 'coll-4';
                } else if ($column_show == 5) {
                    $column_class = 'coll-5';
                } else if ($column_show == 6) {
                    $column_class = 'coll-6';
                } else {
                    $column_class = 'coll-3';
                }
                if ($rquery->have_posts()) :
                    while ($rquery->have_posts()) : $rquery->the_post();
                        $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                        $filter_name = $filter_slug = '';

                        if ($booty_portfolio_cat != ''):
                            foreach ($booty_portfolio_cat as $term) {
                                $filter_slug = $term->slug;
                                $filter_name = $term->name;
                                ?>
                                <div class="portfolio-block<?php echo ( $space_class ) ? ' ' . $space_class : ''; ?> <?php echo $column_class; ?> <?php echo esc_attr($filter_slug); ?>">
                                    <!-- box -->
                                    <div class="box">
                                                            <?php
                                                            if ($nav_type == 'type2') {
                                                                if ($effect_type == 'default') :
                                                                    ?>
                                                <div class="over">
                                                    <div class="holder">
                                                        <div class="frame">
                                                            <div class="over-frame">
                                                                <a href="<?php the_permalink(); ?>" class="btn btn-f-default"><?php esc_html_e('VIEW WORK', BOOTY_TXT_DOMAIN); ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endif;
                                            if ($effect_type == 'type1') :
                                                ?>
                                                <div class="over">
                                                    <div class="holder">
                                                        <div class="frame">
                                                            <div class="over-frame">
                                                                <strong class="title"><?php the_title(); ?></strong>
                                                                <ul class="porto-nav list-inline text-center">
                                        <?php
                                        $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                                        if ($booty_portfolio_cat != ''):
                                            foreach ($booty_portfolio_cat as $term) {
                                                echo '<li>' . $term->name . '</li>';
                                            }
                                        endif;
                                        ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                        <?php
                                        if (has_post_thumbnail(get_the_ID())) {
                                            $image_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full');
                                        }
                                        ?>
                                                    <a href="<?php echo $image_url; ?>" class="search lightbox"><i class="fa fa-search"></i></a>
                                                    <a href="<?php the_permalink(); ?>" class="link"><i class="fa fa-link"></i></a>
                                                </div>
                                        <?php
                                    endif;
                                } else {
                                    ?>
                                            <a href="<?php the_permalink(); ?>" class="over">
                                                <div class="holder">
                                                    <div class="frame">
                                                        <div class="over-frame">
                                                            <span class="plus"><?php echo '+'; ?></span>
                                                            <strong class="title upper"><?php the_title(); ?></strong>
                                                            <p><?php echo esc_attr($filter_name); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                <?php } ?>
                                <?php the_post_thumbnail('full'); ?>
                                    </div>
                                </div>
                                <?php
                            }
                        endif;
                    endwhile;
                    wp_reset_postdata();
                endif;
            } elseif ($booty_layout == 'portfolio-masonry' || $booty_layout == 'portfolio-masonry-nospace' || $booty_layout == 'portfolio-masonry-filter' || $booty_layout == 'portfolio-masonry-filter-nospace') {

                $space_class = '';
                if ($booty_layout == 'portfolio-masonry-filter-nospace') {
                    $space_class = 'nospace';
                } else {
                    $space_class = '';
                }
                if ($column_show == 1) {
                    $column_class = 'coll-2';
                } else if ($column_show == 2) {
                    $column_class = 'coll-2';
                } else if ($column_show == 3) {
                    $column_class = 'coll-3';
                } else if ($column_show == 4) {
                    $column_class = 'coll-4';
                } else if ($column_show == 5) {
                    $column_class = 'coll-5';
                } else if ($column_show == 6) {
                    $column_class = 'coll-6';
                } else {
                    $column_class = 'coll-2';
                }
                if ($rquery->have_posts()) :
                    while ($rquery->have_posts()) : $rquery->the_post();
                        $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                        if ($booty_portfolio_cat != ''):
                            foreach ($booty_portfolio_cat as $term) {
                                $portfolio_slug = $term->slug;
                                $portfolio_name = $term->name;
                                $portfolio_link = get_term_link($term);
                                $url_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full');
                                ?>
                                <!-- portfolio block coll-5 style6 -->
                                <div class="portfolio-block <?php echo esc_html($space_class); ?> <?php echo esc_html($column_class); ?> style6<?php if ($portfolio_slug) echo ' ' . esc_html($portfolio_slug); ?>">
                                    <!-- box -->
                                    <div class="box">
                                        <div class="img-box">
                                <?php the_post_thumbnail('full'); ?>
                                            <div class="over">
                                                <a class="search lightbox" href="<?php echo esc_url($url_image); ?>"><i class="fa fa-search"></i></a>
                                                <a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-box">
                                            <h2 class="title text-left no-bg padding-zero margin-zero"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                            <p class="text-left text-uppercase"><a href="<?php echo esc_url($portfolio_link); ?>"><?php echo $portfolio_name; ?></a></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        endif;
                    endwhile;
                    wp_reset_postdata();
                endif;
            }
        }elseif ($booty_post_type = "portfolio" && $_POST['booty_taxtype'] == "portfolio_cat") {
            if ($booty_tax != '') :
                $args = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish',
                    'posts_per_page' => $booty_perpage,
                    'paged' => (int) $booty_currentpage + 1,
                    'tax_query' => array(
                        'relation' => 'AND',
                        array(
                            'taxonomy' => 'portfolio_cat',
                            'field' => 'slug',
                            'terms' => $booty_tax,
                        ),
                    ),
                );
            else :
                $args = array(
                    'post_type' => 'portfolio',
                    'post_status' => 'publish',
                    'posts_per_page' => $booty_perpage,
                    'paged' => (int) $booty_currentpage + 1,
                );
            endif;
            $rquery = new Wp_Query($args);
            $column_show = $_POST['booty_column'];
            if ($column_show == 1) {
                $column_class = 'coll-12';
            } else if ($column_show == 2) {
                $column_class = 'coll-2';
            } else if ($column_show == 3) {
                $column_class = 'coll-3';
            } else if ($column_show == 4) {
                $column_class = 'coll-4';
            } else if ($column_show == 5) {
                $column_class = 'coll-5';
            } else if ($column_show == 6) {
                $column_class = 'coll-6';
            } else {
                $column_class = 'coll-3';
            }
            $effect_type = $_POST['booty_effect'];
            if ($rquery->have_posts()) :
                while ($rquery->have_posts()) : $rquery->the_post();
                    $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                    $portfolio_name = '';

                    if ($booty_portfolio_cat != ''):
                        $i = 0;
                        foreach ($booty_portfolio_cat as $term) {
                            if (count($booty_portfolio_cat) > 1) {
                                if ($i == 1) {
                                    $portfolio_name .= '/' . $term->name;
                                } else {
                                    $portfolio_name .= $term->name;
                                }
                            } else {
                                $portfolio_name .= $term->name;
                            }
                            $i++;
                        }
                        $url_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full');
                        if ($booty_layout == 'normal') :
                            ?>
                            <div class="portfolio-block <?php echo $column_class; ?>">
                                <!-- box -->
                                <div class="box">
                                                            <?php
                                                            if ($effect_type == 'type2') :
                                                                ?>
                                        <div class="box-holder">
                                            <div class="over">
                                                <div class="holder">
                                                    <div class="frame">
                                                        <div class="over-frame">
                                                            <a href="<?php the_permalink(); ?>" class="btn btn-f-default"><?php esc_html_e('VIEW WORK', BOOTY_TXT_DOMAIN); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                            endif;
                            if ($effect_type == 'type1') :
                                ?>
                                        <div class="box-holder">
                                            <div class="over">
                                                <div class="holder">
                                                    <div class="frame">
                                                        <div class="over-frame">
                                                            <strong class="title"><?php the_title(); ?></strong>
                                                            <ul class="porto-nav list-inline text-center">
                                <?php
                                $booty_portfolio_cat = get_the_terms(get_the_ID(), 'portfolio_cat');
                                if ($booty_portfolio_cat != ''):
                                    foreach ($booty_portfolio_cat as $term) {
                                        echo '<li>' . $term->name . '</li>';
                                    }
                                endif;
                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            if (has_post_thumbnail(get_the_ID())) {
                                                $image_url = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full');
                                            }
                                            ?>
                                                <a href="<?php echo $image_url; ?>" class="search lightbox"><i class="fa fa-search"></i></a>
                                                <a href="<?php the_permalink(); ?>" class="link"><i class="fa fa-link"></i></a>
                                            </div>
                                        </div>
                                <?php
                            endif;
                            if ($effect_type == 'default') {
                                ?>
                                        <div class="box-holder">
                                            <a href="<?php the_permalink(); ?>" class="over">
                                                <div class="holder">
                                                    <div class="frame">
                                                        <div class="over-frame">
                                                            <span class="plus"><?php echo '+'; ?></span>
                                                            <strong class="title"><?php the_title(); ?></strong>
                                                            <p><?php echo esc_attr($portfolio_name); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                <?php
                            }
                            ?>
                                    <div class="stretch">
                            <?php the_post_thumbnail('full'); ?>
                                    </div>

                                </div>
                            </div>
                            <?php
                        endif;
                        if ($booty_layout == 'masonry') :
                            ?>
                            <div class="portfolio-block <?php echo $column_class; ?> style6">
                                <div class="box">
                                    <div class="img-box">
                            <?php the_post_thumbnail('full'); ?>
                                        <div class="over">
                                            <a class="search lightbox" href="<?php echo esc_url($url_image); ?>"><i class="fa fa-search"></i></a>
                                            <a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-box">
                                        <h2 class="title text-left no-bg padding-zero margin-zero"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <p class="text-left text-uppercase"><?php echo $portfolio_name; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                    endif;
                endwhile;
                wp_reset_postdata();
            endif;
        }
        exit();
    }

}

if (!isset($booty_theme_ajax)) {
    $booty_theme_ajax = new Booty_Theme_Ajax();
}
