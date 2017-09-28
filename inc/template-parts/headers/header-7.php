<?php
$config = booty_settings();
?>
<div class="w7">
    <div class="sidemenu-photo">
        <div class="win-height jcf-scrollable">
            <!-- sidemenu holder -->
            <div class="sidemenu-holder">
                <header id="header7">
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_7_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_7_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <nav id="nav7">
                        <a class="nav-opener" href="#">
                            <span class="txt"><?php esc_html_e('Menu', BOOTY_TXT_DOMAIN) ?></span>
                            <i class="fa fa-bars"></i>
                        </a>
                        <div class="nav-holder"> 
                            <ul class="list-unstyled">
                                <?php
                                if (booty_get_meta_value('header_menu', false) && booty_get_meta_value('header_menu', false) != 'default'):
                                    wp_nav_menu(array(
                                        'menu' => booty_get_meta_value('header_menu', false),
                                        'title_li' => '',
                                        'container' => false,
                                        'echo' => true,
                                        'items_wrap' => '%3$s',
                                        'walker' => new Booty_Sublevel_Walker,
                                    ));
                                else:
                                    wp_nav_menu(array(
                                        'menu' => $config['layout_7_option_nav'],
                                        'title_li' => '',
                                        'container' => false,
                                        'echo' => true,
                                        'items_wrap' => '%3$s',
                                    ));
                                endif;
                                ?>
                            </ul>
                        </div>
                    </nav>
                </header>
                <!-- footer of the page -->
                <footer id="footer" class="style12">
                    <!-- footer bottom -->
                    <div class="footer-bottom">
                        <ul class="f-social-networks list-inline">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                        <span class="copyrights">&copy; 2015 <a href="#">Booty</a></span>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <main id="main">