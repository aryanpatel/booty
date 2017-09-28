<?php $booty_settings = booty_settings(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php if (!empty($booty_settings['favicon_main'])): ?>
            <link rel="shortcut icon" href="<?php echo esc_url(is_ssl() ? (str_replace("http://", "https://", $booty_settings['favicon_main']['url'])) : $booty_settings['favicon_main']['url']) ?> "/>
        <?php endif; ?>
        <?php wp_head(); ?>
    </head>
    <body class="home">
        <?php echo booty_pre_loader(); ?>
        <div id="wrapper">
            <?php
            $booty_404_layout = $booty_settings['404_layout'];
            if (isset($_GET['booty_404_layout'])) {
                if ($_GET['booty_404_layout'] == 'layout1') {
                    $booty_404_layout = 'layout1';
                } elseif ($_GET['booty_404_layout'] == 'layout2') {
                    $booty_404_layout = 'layout2';
                } elseif ($_GET['booty_404_layout'] == 'layout3') {
                    $booty_404_layout = 'layout3';
                }
            }
            ?>
            <?php if ($booty_404_layout == 'layout1') { ?>
                <div class="w1">
                    <main id="main" role="main">
                        <section class="error-section text-center win-height">
                            <div class="container win-height">
                                <div class="holder">
                                    <!-- page logo -->
                                    <div class="logo">
                                        <a href="<?php echo esc_url(home_url('/')); ?>">
                                            <?php
                                            if ($booty_settings['404_logo'] && $booty_settings['404_logo']['url']):
                                                echo '<img class="" src="' . esc_url(str_replace(array('http:', 'https:'), '', $booty_settings['404_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                                            else:
                                                echo '<h1>' . bloginfo('name') . '</h1>';
                                            endif;
                                            ?>
                                        </a>
                                    </div>
                                    <h1 class="text-uppercase"><?php echo esc_html__('PAGE NOT FOUND', BOOTY_TXT_DOMAIN); ?></h1>
                                    <?php if ($booty_settings['404_txt'] && $booty_settings['404_txt'] != '') : ?>
                                        <div class="text">
                                            <p><?php echo esc_html($booty_settings['404_txt']); ?></p>
                                        </div>
                                    <?php endif; ?>
                                    <div class="error-info text-uppercase">
                                        <span class="error-code"><?php echo esc_html('404', BOOTY_TXT_DOMAIN); ?></span><?php echo esc_html('error', BOOTY_TXT_DOMAIN); ?>
                                    </div>
                                    <ul class="btn-list list-inline">
                                        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-f-default"><?php echo esc_html__('back to home', BOOTY_TXT_DOMAIN); ?></a></li>
                                        <?php if ($booty_settings['404_link'] && $booty_settings['404_link'] != ''): ?>
                                            <li><a href="<?php echo esc_url($booty_settings['404_link']); ?>" class="btn btn-f-info"><?php echo esc_html('get help', BOOTY_TXT_DOMAIN); ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php if ($booty_settings['404_bg'] && $booty_settings['404_bg']['url']): ?>
                                <div class="stretch">
                                    <img src="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $booty_settings['404_bg']['url'])); ?>" alt="image background">
                                </div>
                            <?php endif; ?>
                        </section>
                    </main>
                </div>

            <?php }elseif ($booty_404_layout == 'layout2') { ?>
                <?php
                get_template_part('inc/template-parts/headers/header-1');
                ?>
                <header class="page-banner">
                    <div class="stretch">
                        <img alt="image background" src="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $booty_settings['404_type2_banner_bg']['url'])); ?>">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="holder">
                                    <h1 class="heading"><?php echo esc_html('404', BOOTY_TXT_DOMAIN); ?></h1>
                                    <p><?php echo esc_html('Page not found', BOOTY_TXT_DOMAIN); ?></p>
                                </div>
                                <?php booty_breadcrumbs(); ?>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="container lost-block">
                    <div class="row">
                        <div class="col-xs-12">

                            <?php if ($booty_settings['404_type2_txt'] && $booty_settings['404_type2_txt'] != '') : ?>
                                <h2>
                                    <?php echo $booty_settings['404_type2_txt']; ?>
                                </h2>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-back"><i class="fa fa-home"></i> <?php echo esc_html('BACK TO HOME', BOOTY_TXT_DOMAIN); ?></a>
                        </div>
                    </div>
                </div>
            </main>
            <footer id="footer" class="<?php echo esc_html(booty_footer_class()); ?>" >
                <?php echo booty_footer(); ?>
            </footer>
        </div><!-- end .w* -->

    <?php }elseif ($booty_404_layout == 'layout3') { ?>
        <div class="w1">
            <main id="main" role="main">
                <section class="error-section text-center style2 win-height">
                    <div class="container win-height">
                        <div class="holder">
                            <!-- page logo -->
                            <div class="logo">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <?php
                                    if ($booty_settings['404_type3_logo'] && $booty_settings['404_type3_logo']['url']):
                                        echo '<img class="" src="' . esc_url(str_replace(array('http:', 'https:'), '', $booty_settings['404_type3_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                                    else:
                                        echo '<h1>' . bloginfo('name') . '</h1>';
                                    endif;
                                    ?>
                                </a>
                            </div>
                            <div class="error-info text-uppercase">
                                <?php echo esc_html__('error', BOOTY_TXT_DOMAIN); ?><span class="error-code"><?php echo esc_html__('404', BOOTY_TXT_DOMAIN); ?></span>
                            </div>
                            <h1 class="text-uppercase"><?php echo esc_html__('PAGE NOT FOUND', BOOTY_TXT_DOMAIN); ?></h1>
                            <?php if ($booty_settings['404_type3_txt'] && $booty_settings['404_type3_txt'] != '') : ?>
                                <div class="text">
                                    <p><?php echo esc_html($booty_settings['404_type3_txt']); ?></p>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo esc_url(home_url('/')); ?>" class="error-form">
                                <fieldset>
                                    <input type="search" name ="s" class="form-control" placeholder="SEARCH AGAIN">
                                    <input class="btn btn-slider" type="submit" value="GO">
                                </fieldset>
                            </form>
                            <ul class="list-inline footer-social">
                                <?php echo booty_header_social('404_type3', '1') ?>
                            </ul>
                        </div>
                    </div>
                    <?php if ($booty_settings['404_type3_bg'] && $booty_settings['404_type3_bg']['url']): ?>
                        <div class="stretch">
                            <img src="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $booty_settings['404_type3_bg']['url'])); ?>" alt="image background">
                        </div>
                    <?php endif; ?>
                </section>
            </main>
        </div>
    <?php } ?>
    <div class="fa fa-chevron-up" id="gotoTop"></div>
</div>
</body>
<?php wp_footer(); ?>
</html>
