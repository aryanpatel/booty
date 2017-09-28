<?php
$config = booty_settings();
?> 
<div class="w1">
    <!-- header of the page style26 -->
    <header id="header" class="style26">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            echo '<img class="img-responsive w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['layout_st26_logo_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="img-responsive b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $config['layout_st26_logo2_image']['url'])) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <div class="holder">
                        <nav id="nav">
                            <a href="#" class="nav-opener"><i class="fa fa-bars"></i></a>
                            <div class="nav-holder"> 
                                <ul class="list-inline nav-top">
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
                                            'menu' => $config['layout_st26_option_nav'],
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
                    </div>
                </div>
            </div>
        </div>
    </header>
    <?php if (isset($config['layout_creative_option_e_near_nav_search']) && $config['layout_creative_option_e_near_nav_search'] == 'show'): ?>
        <?php echo booty_search_popup(); ?>
    <?php endif; ?>
    <!-- contain main informative part of the site -->
    <main id="main">