<?php
$config = booty_settings();
?>
<div class="w1">
    <!-- header of the page -->
    <header id="header" class="style27">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="img-responsive w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="img-responsive b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <!-- main navigation of the page -->
                    <nav id="nav">
                        <a href="#" class="nav-opener"><i class="fa fa-bars"></i></a>
                        <div class="nav-holder">
                            <ul class="list-inline nav-top">
                                <?php
                                if (get_terms('nav_menu', array('hide_empty' => TRUE))):
                                    if (booty_get_meta_value('header_menu', FALSE) && booty_get_meta_value('header_menu', FALSE) != 'default'):
                                        wp_nav_menu(array(
                                            'menu' => booty_get_meta_value('header_menu', FALSE),
                                            'title_li' => '',
                                            'container' => FALSE,
                                            'echo' => TRUE,
                                            'items_wrap' => '%3$s',
                                            'walker' => new Booty_Sublevel_Walker,
                                        ));
                                    elseif (has_nav_menu('primary')):
                                        wp_nav_menu(array(
                                            'theme_location' => 'primary',
                                            'title_li' => '',
                                            'container' => FALSE,
                                            'echo' => TRUE,
                                            'items_wrap' => '%3$s',
                                            'walker' => new Booty_Sublevel_Walker,
                                        ));
                                    else:
                                        wp_nav_menu(array(
                                            'menu' => '',
                                            'title_li' => '',
                                            'menu_class' => '',
                                            'container' => FALSE,
                                            'echo' => TRUE,
                                            'fallback_cb' => 'wp_list_pages',
                                            'items_wrap' => '%3$s',
                                            'walker' => new Booty_Sublevel_Walker,
                                        ));
                                    endif;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </nav> 
                    <!-- icon list -->
                    <ul class="list-unstyled icon-list add">
                        <?php echo booty_header_social('layout_12', '2') ?>
                    </ul>
                </div>
            </div>
        </div>
    </header> 
    <main id="main">