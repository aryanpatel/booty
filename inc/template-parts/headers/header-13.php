<?php
$config = booty_settings();
?>
<div class="w1">
    <header id="header" class="style12">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 header-top"> 
                    <ul class="list-inline info-list">
                        <?php if (isset($config['layout_13_option_top_show_phone']) && $config['layout_13_option_top_show_phone'] == 'show'): ?>
                            <li><a class="tel" href="tel:<?php if ($config['layout_13_option_top_info_phone'] != '') echo $config['layout_13_option_top_info_phone']; ?>"><i class="fa fa-phone"></i> <?php if ($config['layout_13_option_top_info_phone_text'] != '') echo $config['layout_13_option_top_info_phone_text']; ?></a></li>
                        <?php endif; ?>
                        <?php if (isset($config['layout_13_option_top_show_email']) && $config['layout_13_option_top_show_email'] == 'show'): ?>
                            <li><a href="mailto: <?php if ($config['layout_13_option_top_info_email'] != '') echo $config['layout_13_option_top_info_email']; ?>"><i class="fa fa-envelope"></i> <?php if ($config['layout_13_option_top_info_email_text'] != '') echo $config['layout_13_option_top_info_email_text']; ?></a></li>
                        <?php endif; ?>
                    </ul> 
                    <!-- language nav -->
                    <?php
                    if (isset($config['layout_13_option_top_show_language']) && $config['layout_13_option_top_show_language'] == 'show')
                        echo booty_language_list();
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 header-cent">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="img-responsive w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="img-responsive b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <ul class="list-inline head-social">
<?php echo booty_header_social('layout_13', '1') ?>
                    </ul>
                </div>	
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <nav id="nav">
                        <a class="nav-opener" href="#">
                            <span class="txt"><?php esc_html_e('Menu', BOOTY_TXT_DOMAIN) ?></span>
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="nav-holder">
                            <div class="logo">
                                <a href="<?php echo esc_url(home_url('/')); ?>">
                                    <img src="<?php echo $config['logo2_image']['url'] ?>" alt="Booty" class="img-responsive">
                                </a>
                            </div>
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
                            <a href="<?php if (isset($config['layout_13_option_bottom_quote']) && $config['layout_13_option_bottom_quote'] != '') echo $config['layout_13_option_bottom_quote']; ?>" class="quote-btn"><?php if (isset($config['layout_13_option_bottom_quote_text']) && $config['layout_13_option_bottom_quote_text'] != '') echo $config['layout_13_option_bottom_quote_text']; ?></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header> 
    <main id="main">