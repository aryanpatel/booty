<?php
$config = booty_settings();
?>
<div class="w9">
    <!-- sidemenu photo v9 -->
    <div class="sidemenu-photo v9">
        <div class="win-height jcf-scrollable">
            <!-- sidemenu holder -->
            <div class="sidemenu-holder">
                <!-- header7 -->
                <header id="header7">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo $config['header_layout_17_logo']['url'] ?>" alt="photographer"></a> 
                    </div>
                    <nav id="nav7">
                        <a class="nav-opener" href="#">
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="nav-holder"> 
                            <ul class="list-unstyled">
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
                                        'menu' => $config['layout_17_option_nav'],
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
                </header>
            </div>
        </div>
        <div class="logo-v9">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                echo '<img class="b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_17_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                echo '<img class="w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_17_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                ?>
            </a>
        </div>
    </div>
    <!-- contain main informative part of the site -->
    <main id="main">   