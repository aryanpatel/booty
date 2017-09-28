<?php
$config = booty_settings();
//personal banner
echo booty_header_banner();
?>	<div class="w1">
    <main id="main">
        <!-- header of the page -->
        <header id="header" class="style9 booty_layout6">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- page logo -->
                        <div class="logo">
                            <a href="<?php echo esc_url(home_url('/')); ?>">
                                <?php
                                echo '<img class="img-responsive" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_6_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                                ?>
                            </a>
                        </div>
                        <div class="holder">
                            <?php if (isset($config['layout_6_option_e_near_nav']) && $config['layout_6_option_e_near_nav'] == 'show'): ?>
                                <ul class="list-unstyled icon-list booty-icon-mini"> 
                                    <?php if (isset($config['layout_6_option_e_near_nav_language']) && $config['layout_6_option_e_near_nav_language'] == 'show'): ?>
                                        <li>
                                            <?php echo booty_language_dropdown('type_2'); ?>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (isset($config['layout_6_option_e_near_nav_cart']) && $config['layout_6_option_e_near_nav_cart'] == 'show'): ?>
                                        <li class="cart-box">
                                            <?php if (class_exists('Woocommerce')) echo booty_minicart('type_1'); ?>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (isset($config['layout_6_option_e_near_nav_search']) && $config['layout_6_option_e_near_nav_search'] == 'show'): ?>
                                        <li>
                                            <a href="#" class="search-opener opener-icons"><i class="fa fa-search"></i></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            <?php endif; ?>
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
        <!-- search popup -->
        <?php if (isset($config['layout_6_option_e_near_nav_search']) && $config['layout_6_option_e_near_nav_search'] == 'show'): ?>
            <?php echo booty_search_popup(); ?>
        <?php endif; ?>