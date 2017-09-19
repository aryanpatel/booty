<?php
$config = booty_settings();
?> 
<div class="w1">
    <header id="header">
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
                        <ul class="list-unstyled icon-list">
                            <li>
                                <?php if (isset($config['layout_1_option_e_near_nav_bars']) && $config['layout_1_option_e_near_nav_bars'] == 'show') {
                                    echo '<a href="#" class="menu-opener opener-icons"><i class="fa fa-bars"></i></a>';
                                }
                                ?>

                            </li>
                            <li>
<?php if (isset($config['layout_1_option_e_near_nav_search']) && $config['layout_1_option_e_near_nav_search'] == 'show') {
    echo '<a href="#" class="search-opener opener-icons"><i class="fa fa-search"></i></a>';
}
?>

                            </li>
                            <li class="cart-box">
<?php if (isset($config['layout_1_option_e_near_nav_cart']) && $config['layout_1_option_e_near_nav_cart'] == 'show') {
    echo booty_minicart('type_2');
}
?>

                            </li>
                        </ul>
                        <!-- main navigation of the page -->
                        <nav id="nav">
                            <a href="#" class="nav-opener"><i class="fa fa-bars"></i></a>
                            <div class="nav-holder">
                                <ul class="list-inline nav-top">
                                    <?php
                                    if(get_terms('nva_menu', array('hide_empty' => TRUE))):
                                        if(booty_get_meta_value('header_menu', FALSE) && booty_get_meta_value('header_menu',FALSE) != 'default'):
                                            wp_nav_menu(array(
                                                'menu' => booty_get_meta_value('header_menu', FALSE),
                                                'title_li' => '',
                                                'container' => FALSE,
                                                'echo' => TRUE,
                                                'items_wrap' => '%3$s',
                                                'walker' => new Booty_Sublevel_Walker,
                                            ));
                                        elseif(has_nav_menu('primary')):
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
<?php if (isset($config['layout_1_option_e_near_nav_search']) && $config['layout_1_option_e_near_nav_search'] == 'show') {
    echo booty_search_product_popup();
} ?>
<?php if (isset($config['layout_1_option_e_near_nav_bars']) && $config['layout_1_option_e_near_nav_bars'] == 'show') {
    echo booty_nav_bars();
}
?>
    <!-- contain main informative part of the site -->
    <main id="main">