<?php
$config = booty_settings();
?> 
<div class="w1">
    <!-- header of the page style26 -->
    <header id="header" class="style21">
        <div class="container">
            <div class="row">
                <!-- header top -->
                <div class="col-xs-12 header-top">
                    <ul class="list-inline info-list">
                        <?php if ($config['layout_finance_option_top_show_email'] == 'show') { ?>
                            <li><a href="<?php echo $config['layout_finance_option_top_info_email'] ?>"><i class="fa fa-envelope"></i> <?php echo $config['layout_finance_option_top_info_email_text'] ?></a></li>
                        <?php } ?>
                        <?php if ($config['layout_finance_option_top_show_clock'] == 'show') { ?>
                            <li><i class="fa fa-clock-o"></i>  <?php echo $config['layout_finance_option_top_info_opening'] ?>  </li>
                        <?php } ?>
                        <?php if ($config['layout_finance_option_top_show_phone'] == 'show') { ?>
                            <li><a class="tel" href="tel:<?php echo $config['layout_finance_option_top_info_phone'] ?>"><i class="fa fa-phone"></i> <?php echo $config['layout_finance_option_top_info_phone_text'] ?></a></li>
                        <?php } ?>
                    </ul>
                    <form class="search-form-top" action="<?php echo esc_url(home_url('/')); ?>">
                        <fieldset>
                            <input type="search" name="s" class="text" placeholder="<?php echo $config['layout_finance_option_top_search_text'] ?>">
                            <button class="fa fa-search" type="submit"></button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $config['layout_finance_logo_image_dark']['url'])) ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>" class="img-responsive w-logo">
                            <img src="<?php echo esc_url(str_replace(array('http:', 'https:'), '', $config['layout_finance_logo_image_light']['url'])) ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')) ?>" class="img-responsive b-logo">
                        </a>
                    </div>
                    <div class="holder">
                        <!-- icon list -->
                        <ul class="list-unstyled icon-list social">
                            <?php echo booty_header_social('layout_finance', '1') ?>
                        </ul>
                        <!-- main navigation of the page -->
                        <nav id="nav">
                            <a href="#" class="nav-opener"><i class="fa fa-bars"></i></a>
                            <div class="nav-holder">
                                <ul class="list-inline nav-top">
                                    <?php
                                    if (get_terms('nav_menu', array('hide_empty' => true))):
                                        if (booty_get_meta_value('header_menu', false) && booty_get_meta_value('header_menu', false) != 'default'):
                                            wp_nav_menu(array(
                                                'menu' => booty_get_meta_value('header_menu', false),
                                                'title_li' => '',
                                                'container' => false,
                                                'echo' => true,
                                                'items_wrap' => '%3$s',
                                                'walker' => new Booty_Sublevel_Walker,
                                            ));
                                        elseif (has_nav_menu('primary')):
                                            wp_nav_menu(array(
                                                'theme_location' => 'primary',
                                                'title_li' => '',
                                                'container' => false,
                                                'echo' => true,
                                                'items_wrap' => '%3$s',
                                                'walker' => new Booty_Sublevel_Walker,
                                            ));
                                        else:
                                            wp_nav_menu(array(
                                                'menu' => '',
                                                'title_li' => '',
                                                'menu_class' => '',
                                                'container' => false,
                                                'echo' => true,
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
                    </div>
                </div>
            </div>

        </div>
    </header>
    <?php echo booty_search_popup(); ?>
    <!-- contain main informative part of the site -->
    <main id="main">