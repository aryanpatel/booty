<?php
$config = booty_settings();
?>
<div class="w1">
    <!-- header of the page -->
    <header id="header" class="style15">
        <div class="container">
            <div class="row">
                <!-- header top -->
                <div class="col-xs-12 header-top">
                    <ul class="list-inline info-list">
                        <?php if (isset($config['layout_19_option_top_show_phone']) && $config['layout_19_option_top_show_phone'] == 'show'): ?>
                            <li><a class="tel" href="tel:<?php if ($config['layout_19_option_top_info_phone'] != '') echo $config['layout_19_option_top_info_phone']; ?>"><i class="fa fa-phone"></i> <?php if ($config['layout_19_option_top_info_phone_text'] != '') echo $config['layout_19_option_top_info_phone_text']; ?></a></li>
                        <?php endif; ?>
                        <?php if (isset($config['layout_19_option_top_show_email']) && $config['layout_19_option_top_show_email'] == 'show'): ?>
                            <li><a href="mailto: <?php if ($config['layout_19_option_top_info_email'] != '') echo $config['layout_19_option_top_info_email']; ?>"><i class="fa fa-envelope"></i> <?php if ($config['layout_19_option_top_info_email_text'] != '') echo $config['layout_19_option_top_info_email_text']; ?></a></li>
                        <?php endif; ?>
                    </ul> 
                    <ul class="head-socialnetworks list-inline">
                        <?php echo booty_header_social('layout_19', '1') ?>
                    </ul> 
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['layout_19_logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['layout_19_logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <div class="holder">
                        <!-- main navigation of the page -->
                        <nav id="nav">
                            <a href="#" class="nav-opener">
                                <span class="txt"><?php esc_html_e('Menu', BOOTY_TXT_DOMAIN) ?></span>
                                <i class="fa fa-bars"></i>
                            </a>
                            <div class="nav-holder"> 
                                <ul class="list-inline nav-top">
                                    <?php
                                    if (booty_get_meta_value('header_menu', FALSE) && booty_get_meta_value('header_menu', FALSE) != 'default'):
                                        wp_nav_menu(array(
                                            'menu' => booty_get_meta_value('header_menu', FALSE),
                                            'title_li' => '',
                                            'container' => FALSE,
                                            'echo' => TRUE,
                                            'items_wrap' => '%3$s',
                                            'walker' => new Booty_Sublevel_Walker,
                                        ));
                                    else:
                                        wp_nav_menu(array(
                                            'menu' => $config['layout_19_option_nav'],
                                            'title_li' => '',
                                            'container' => FALSE,
                                            'echo' => TRUE,
                                            'items_wrap' => '%3$s',
                                        ));
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
    <main id="main">