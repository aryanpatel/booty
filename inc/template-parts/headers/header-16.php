<?php
$config = booty_settings();
?>
<div class="w1">
    <div class="logo port-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            echo '<img src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['header_layout_16_logo']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
            ?>
        </a>
    </div>
    <a href="#" class="portfolio-nav-opener"><i class="fa fa-bars"></i></a>
    <!-- sidenav port -->
    <nav class="sidenav-port booty-header-16">
        <div class="win-height jcf-scrollable"> 
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
                        'menu' => $config['layout_16_option_nav'],
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
    <main id="main">