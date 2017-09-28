<?php
/**
 * The template for displaying page
 *
 * @package WordPress
 * @subpackage Booty
 * @since Booty 1.0
 */
get_header();
?>
<?php
$config = booty_page_layout();
if ($config['booty_layout'] == 'default' || $config['booty_layout'] == 'fullwidth')
    $container_class = 'container';
if ($config['booty_layout'] == 'wide')
    $container_class = 'container-fluid';
if ($config['no_padding'] != 'no_padding')
    $container_class .= ' padding-bottom-100 padding-top-100';
?>
<div class="content-main">
    <div id="primary" class="site-content">
        <div id="content" role="main">	
<?php if ($config['hide_banner'] != 'hide_banner') { ?>
                <div class="booty-breadcrumb page-banner  grey small ">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="holder">
                                    <h1 class="heading"><?php the_title(); ?></h1>
                                </div>
                <?php booty_breadcrumbs(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                    <?php } ?>
            <div class="<?php echo esc_html($container_class); ?>">
                <div class="row">
                    <?php
                    if ($config['booty_sidebar_position'] == 'no-sidebar') {
                        echo '<div class="col-xs-12">';
                    } elseif ($config['booty_sidebar_position'] == 'both-sidebar') {
                        echo '<div class="col-xs-12 col-md-6 col-md-push-3">';
                    } elseif ($config['booty_sidebar_position'] == 'left-sidebar') {
                        echo '<div class="col-xs-12 col-sm-8 col-md-9 col-sm-push-4 col-md-push-3">';
                    } elseif ($config['booty_sidebar_position'] == 'right-sidebar') {
                        echo '<div class="col-xs-12 col-sm-8 col-md-9">';
                    }
                    ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                        <?php
                        if (comments_open() || get_comments_number()) {
                            echo '<div class="comment-box">';
                            comments_template();
                            echo '</div>';
                        }
                        ?>
                    <?php endwhile; // end of the loop. ?>
                    <?php
                    echo '</div>';
                    if ($config['booty_sidebar_position'] == 'left-sidebar') {
                        echo '<aside class="col-xs-12 col-sm-4 col-md-3 col-sm-pull-8 col-md-pull-9">';
                        dynamic_sidebar($config['booty_sidebar_left']);
                        echo '</aside>';
                    } elseif ($config['booty_sidebar_position'] == 'right-sidebar') {
                        echo '<aside class="col-xs-12 col-sm-4 col-md-3">';
                        dynamic_sidebar($config['booty_sidebar_right']);
                        echo '</aside>';
                    } elseif ($config['booty_sidebar_position'] == 'both-sidebar') {
                        echo '<aside class="col-xs-12 col-sm-6 col-md-3 col-md-pull-6">';
                        dynamic_sidebar($config['booty_sidebar_left']);
                        echo '</aside>';
                        echo '<aside class="col-xs-12 col-sm-6 col-md-3 ">';
                        dynamic_sidebar($config['booty_sidebar_right']);
                        echo '</aside>';
                    }
                    ?>
                </div>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
</div>
<?php get_footer(); ?>
