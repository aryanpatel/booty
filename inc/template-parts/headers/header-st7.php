<?php
$config = booty_settings();
?>
<div class="w1">
    <!-- header of the page style7 -->
    <header id="header" class="style7">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="img-responsive w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="img-responsive b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <div class="holder">
                        <!-- icon list -->
                        <?php if (isset($config['layout_st7_option_e_near_nav']) && $config['layout_st7_option_e_near_nav'] == 'show'): ?>
                            <ul class="list-unstyled icon-list booty-icon-mini"> 
                                <?php if (isset($config['layout_st7_option_e_near_nav_language']) && $config['layout_st7_option_e_near_nav_language'] == 'show'): ?>
                                    <li>
                                        <?php echo booty_language_dropdown('type_1'); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($config['layout_st7_option_e_near_nav_cart']) && $config['layout_st7_option_e_near_nav_cart'] == 'show'): ?>
                                    <li class="cart-box">
                                        <?php if (class_exists('Woocommerce')) echo booty_minicart('type_1'); ?>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($config['layout_st7_option_e_near_nav_search']) && $config['layout_st7_option_e_near_nav_search'] == 'show'): ?>
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
    <?php if (isset($config['layout_st7_option_e_near_nav_search']) && $config['layout_st7_option_e_near_nav_search'] == 'show'): ?>
        <?php echo booty_search_popup(); ?>
    <?php endif; ?>
    <!-- contain main informative part of the site -->
    <main id="main">