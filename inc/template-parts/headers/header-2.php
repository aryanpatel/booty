<?php
$config = booty_settings();
?>
<div class="w1">
    <header id="header" class="style2">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 header-top"> 
                    <!-- language nav -->
                    <?php
                    if (isset($config['layout_2_option_top_show_language']) && $config['layout_2_option_top_show_language'] == 'show')
                        echo booty_language_list();
                    ?>
                    <!-- top nav -->
                    <nav class="top-nav">  
                        <ul class="list-inline">
                            <?php
                            if (class_exists('Woocommerce'))
                                echo booty_account('layout_2');
                            ?>  
                        </ul>
                    </nav>
                    <!-- language nav -->

                </div>
            </div>
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
                    <div class="holder">
                        <!-- icon list -->
                        <?php if (isset($config['layout_2_option_e_near_nav']) && $config['layout_2_option_e_near_nav'] == 'show'): ?>
                            <ul class="list-unstyled icon-list">
                                <?php if (isset($config['layout_2_option_e_near_nav_search']) && $config['layout_2_option_e_near_nav_search'] == 'show'): ?>
                                    <li>
                                        <a href="#" class="search-opener opener-icons"><i class="fa fa-search"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (isset($config['layout_2_option_e_near_nav_cart']) && $config['layout_2_option_e_near_nav_cart'] == 'show'): ?>
                                    <li class="cart-box">
                                        <?php if (class_exists('Woocommerce')) echo booty_minicart('type_2'); ?>
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
                    </div>	
                </div>	
            </div> 
        </div>
    </header> 
    <?php
    if (isset($config['layout_2_option_e_near_nav_search']) && $config['layout_2_option_e_near_nav_search'] == 'show'):
        echo booty_search_popup();
    endif;
    ?>
    <main id="main">