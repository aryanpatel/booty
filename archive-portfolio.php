<?php
$booty_setting = booty_archive_portforlio_setting();
$design_type = $booty_setting['design_type']; /* normal,masonry,parallax */
$layout_site = $booty_setting['layout_site']; /* full-site,full-width */
$space_class = $booty_setting['space_class']; /* default,nospace */
$items_show = (int) $booty_setting['num_items'];
$column_show = (int) $booty_setting['column_show'];
$effect_type = $booty_setting['effect_type']; /* default(grip),type1(vertical),type2 for type normal */
$sidebar = $booty_setting['sidebar']; /* no-sidebar,left-sidebar,right-sidebar,both-sidebar */
$sidebar_left = $booty_setting['sidebar_left'];
$sidebar_right = $booty_setting['sidebar_right'];
get_header();
?>
<?php booty_heading_banner('archive_portfolio'); ?>
<div class="content-main">
    <div id="primary" class="site-content">
        <?php
        if ($design_type == 'parallax') {
            $class_padding = '';
        } else {
            $class_padding = 'padding-top-90 padding-bottom-90';
        }
        ?>
        <div id="content" role="main" class="<?php echo $class_padding;
        echo ( $space_class ) ? ' ' . $space_class : ''; ?>">
            <?php
            $args = array(
                'post_type' => 'portfolio',
                'post_status' => 'publish',
                'posts_per_page' => $items_show,
            );

            $rquery = new Wp_Query($args);
            if ($design_type != 'parallax') :
                if ($layout_site == 'full-site')
                    echo '<div class="container"><div class="row">';
                if ($layout_site == 'full-width')
                    echo '<div class="content-full-width">';
                if ($sidebar == 'no-sidebar') {
                    
                } else if ($sidebar == 'left-sidebar') {
                    echo '<div class="col-sm-3 col-xs-12 col-md-3">';
                    dynamic_sidebar($sidebar_left);
                    echo '</div>';
                    echo '<div class="col-md-9 col-sm-9 col-xs-12"><div class="row">';
                } else if ($sidebar == 'right-sidebar') {
                    echo '<div class="col-md-9 col-sm-9 col-xs-12"><div class="row">';
                } else if ($sidebar == 'both-sidebar') {
                    echo '<div class="col-sm-3 col-xs-12 col-md-3">';
                    dynamic_sidebar($sidebar_left);
                    echo '</div>';
                    echo '<div class="col-md-6 col-sm-6 col-xs-12"><div class="row">';
                }
                ?>
                <div>
                    <nav class="list-inline isotop-controls margin-bottom-60">
                        <ul id="work-filter" class="list-inline">
                            <li class="active"><a href="#"><?php esc_html_e('All', BOOTY_TXT_DOMAIN); ?></a></li>
                            <?php
                            $booty_portfolio_cat = get_terms('portfolio_cat');
                            if ($booty_portfolio_cat != ''):
                                foreach ($booty_portfolio_cat as $term) {
                                    ?>
                                    <li><a data-filter=".<?php echo $term->slug; ?>" href="#"><?php echo $term->name; ?></a></li>
        <?php } endif; ?>
                        </ul>
                    </nav>
                </div>
                <div class="icotop-holder booty_wrapper_ajax" id="work">
                    <?php
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
                            $portfolio_name = $portfolio_slug = '';

                            if ($booty_portfolio_cat != '') {
                                $i = 0;
                                foreach ($booty_portfolio_cat as $term) {
                                    $portfolio_slug .= $term->slug . ' ';
                                    if ($i != 1) {
                                        $portfolio_name .= '/' . $term->name;
                                    } else {
                                        $portfolio_name .= $term->name;
                                    }
                                    $i++;
                                }
                            }
                            $url_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'full');
                            if ($design_type == 'normal') :
                                ?>
                                <div class="portfolio-block <?php echo $column_class . ' ' . $portfolio_slug; ?>">
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
                            if ($design_type == 'masonry') :
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
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <div class="row text-center <?php if ($space_class == 'nospace') {
                    echo 'padding-top-60';
                } else {
                    echo 'padding-top-30';
                } ?>">
                <?php if ($rquery->max_num_pages > 1) : ?>
                        <a href="#" class="btn btn-dark portfolio_ajax_load_more" data-posttype="portfolio" data-taxtype="portfolio_cat" data-layout="<?php echo esc_html($design_type) ?>" data-tax="" data-column="<?php echo esc_html($column_show) ?>" data-effect="<?php echo esc_html($effect_type) ?>" data-navtype="type2" data-perpage="<?php echo esc_html($items_show) ?>" data-currentpage="1" data-maxpage="<?php echo esc_html($rquery->max_num_pages); ?>"><?php esc_html_e('Load more', BOOTY_TXT_DOMAIN); ?></a>
                <?php endif; ?>
                </div>
                <?php
                if ($sidebar == 'no-sidebar') {
                    
                } else if ($sidebar == 'left-sidebar') {
                    echo '</div></div>';
                } else if ($sidebar == 'right-sidebar') {
                    echo '</div></div>';
                    echo '<div class="col-sm-3 col-xs-12 col-md-3">';
                    dynamic_sidebar($sidebar_right);
                    echo '</div>';
                } else if ($sidebar == 'both-sidebar') {
                    echo '</div></div>';
                    echo '<div class="col-sm-3 col-xs-12 col-md-3">';
                    dynamic_sidebar($sidebar_right);
                    echo '</div>';
                }
                if ($layout_site == 'full-site')
                    echo '</div></div>';
                if ($layout_site == 'full-width')
                    echo '</div>';
                ?>
                <?php
            endif;
            if ($design_type == 'parallax') {
                if ($layout_site == 'full-site')
                    echo '<div class="container">';
                if ($layout_site == 'full-width')
                    echo '<div class="parallax-full-width">';

                if ($rquery->have_posts()) :
                    while ($rquery->have_posts()) : $rquery->the_post();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                        ?>
                        <section class="port-parallex small">
                            <div class="parallax-holder">
                                <div class="parallax-frame" style="padding-bottom: 50px; background-image: url(<?php echo $image[0]; ?>); background-attachment: fixed; background-size: 1349px 940.253px; background-position: 50% -282.366px; background-repeat: no-repeat;">
                        <?php the_post_thumbnail('full'); ?>
                                </div>
                            </div>
                        </section>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    if ($layout_site == 'full-site')
        echo '</div>';
    if ($layout_site == 'full-width')
        echo '</div>';
}
?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
