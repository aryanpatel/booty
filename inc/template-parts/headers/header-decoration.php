<?php
$config = booty_settings();
?> 
<div class="w1">
    <header id="header" class="dec-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <!-- page logo -->
                    <div class="logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php
                            $logo_themelight = $config['logo_image']['url'];
                            $logo_themedark = $config['logo2_image']['url'];
                            if (booty_page_id()) {
                                $post_id = booty_page_id();
                                if (get_post_meta($post_id, 'header_option20', true) == 'yes' && get_post_meta($post_id, 'header20_logo_light', true)) {
                                    $image = wp_get_attachment_image_src((int) get_post_meta($post_id, 'header20_logo_light', true), 'full');
                                    $logo_themelight = $image[0];
                                }
                                if (get_post_meta($post_id, 'header_option20', true) == 'yes' && get_post_meta($post_id, 'header20_logo_dark', true)) {
                                    $image = wp_get_attachment_image_src((int) get_post_meta($post_id, 'header20_logo_dark', true), 'full');
                                    $logo_themedark = $image[0];
                                }
                            }
                            echo '<img class="img-responsive w-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_themedark)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            echo '<img class="img-responsive b-logo" src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_themelight)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                            ?>
                        </a>
                    </div>
                    <div class="holder">
                        <!-- icon list -->
                        <ul class="list-unstyled icon-list">
                            <li>
                                <a href="#" class="menu-opener burger-menu"><span><?php esc_html_e('MENU', BOOTY_TXT_DOMAIN) ?></span><i class="fa fa-bars"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php
    if (get_post_meta($post->ID, 'header20_menu_bar', true)) {
        echo booty_nav_bars(get_post_meta($post->ID, 'header20_menu_bar', true));
    } else {
        echo booty_nav_bars();
    }
    ?>
    <!-- contain main informative part of the site -->
    <main id="main">