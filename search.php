<?php
/**
 * The template for displaying search results
 *
 * @package WordPress
 * @subpackage Booty
 * @since Booty 1.0
 */
get_header();
?>
<div class="content-main">
    <div id="primary" class="site-content">
        <div id="content" role="main">
                <?php booty_heading_banner('search'); ?>
            <div class="container">            
<?php if (have_posts()) : ?>
                    <div class="booty-blog ">
                        <div class="search-have-results blog-masonry-holder booty_wrapper_ajax full-width" id="masonry-container">
                            <?php
                            while (have_posts()) : the_post();
                                get_template_part('content', 'search-results');
                            endwhile; // end of the loop.
                            ?>
                        </div>
                    <?php booty_paging_navigation('type1', $GLOBALS['wp_query']); ?>
                    </div>
<?php else: ?>
                    <div class="page-no-result">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <p><?php echo esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', BOOTY_TXT_DOMAIN); ?></p>
                                <div class="search-form-no">
    <?php get_search_form(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif;
                ?>
            </div>
        </div><!-- #content -->
    </div><!-- #primary -->
</div>
<?php get_footer(); ?>
