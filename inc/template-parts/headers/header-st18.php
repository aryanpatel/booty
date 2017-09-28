<?php
$config = booty_settings();
?>
<div class="w1">
    <!-- header of the page -->
    <header id="header" class="style18">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- header top -->
                    <div class="col-xs-12">
                        <ul class="list-inline info-list">
                            <?php if (isset($config['layout_st18_option_top_show_email']) && $config['layout_st18_option_top_show_email'] == 'show'): ?>
                                <li><a href="mailto: <?php if ($config['layout_st18_option_top_info_email'] != '') echo $config['layout_st18_option_top_info_email']; ?>"><i class="fa fa-envelope"></i> <?php if ($config['layout_st18_option_top_info_email_text'] != '') echo $config['layout_st18_option_top_info_email_text']; ?></a></li>
                            <?php endif; ?>
                            <?php if (isset($config['layout_st18_option_top_show_phone']) && $config['layout_st18_option_top_show_phone'] == 'show'): ?>
                                <li><a class="tel" href="tel:<?php if ($config['layout_st18_option_top_info_phone'] != '') echo $config['layout_st18_option_top_info_phone']; ?>"><i class="fa fa-phone"></i> <?php if ($config['layout_st18_option_top_info_phone_text'] != '') echo $config['layout_st18_option_top_info_phone_text']; ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <ul class="head-socialnetworks list-inline">
                            <?php echo booty_header_social('layout_st18', '1') ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container"> 
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div> 
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
                            <a href="<?php if (isset($config['layout_st18_option_quote']) && $config['layout_st18_option_quote'] != '') echo $config['layout_st18_option_quote']; ?>" class="quote-btn"><?php if (isset($config['layout_st18_option_quote_text']) && $config['layout_st18_option_quote_text'] != '') echo $config['layout_st18_option_quote_text']; ?></a>
                        </div>
                    </nav> 
                </div>
            </div>
        </div>
    </header> 
    <main id="main">