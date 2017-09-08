<?php

add_action('redux/options/booty_settings/saved', 'booty_save_theme_settings', 10, 2);
add_action('redux/options/booty_settings/import', 'booty_save_theme_settings', 10, 2);
add_action('redux/options/booty_settings/reset', 'booty_save_theme_settings');
add_action('redux/options/booty_settings/section/reset', 'booty_save_theme_settings');
add_action('redux/options/booty_settings/compiler/advanced', 'booty_save_theme_advanced');

function booty_config_value($value) {
    return isset($value) ? $value : 0;
}

//complie scss
function booty_save_theme_advanced() {
    return;
}

function booty_save_theme_settings() {
    $booty_settings = booty_settings();
    global $bootyReduxSettings;

    $reduxFramework = $bootyReduxSettings->ReduxFramework;
    $template_dir = get_template_directory() . '/assets';
    // Compile SCSS Files
    if (!class_exists('scssc')) {
        include( BOOTY_ADMIN . '/sassphp/scss.inc.php' );
    }
    // config skin file
    ob_start();
    include (BOOTY_ADMIN . '/sassphp/config_skin_scss.php');
    $_config_css = ob_get_clean();

    $filename = $template_dir . '/scss/config/_config_skin.scss';

    if (is_writable(dirname($filename)) == false) {
        @chmod(dirname($filename), 0755);
    }

    if (file_exists($filename)) {
        if (is_writable($filename) == false) {
            @chmod($filename, 0755);
        }
        @unlink($filename);
    }
    $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));

    $fileMaps = array('skin', 'bootstrap', 'helper-elements', 'theme', 'theme2');

    foreach ($fileMaps as $value) {
        ob_start();

        $scss = new scssc();
        $scss->setImportPaths($template_dir . '/scss');
        $scss->setFormatter('scss_formatter');
        echo $scss->compile('@import "' . $value . '.scss"');
        
        if ($value == 'skin') {
            if (isset($fekra_settings['custom-css-code']))
                echo $fekra_settings['custom-css-code'];
        }

        $_config_css = ob_get_clean();

        $filename = $template_dir . '/css/' . $value . '.css';

        if (is_writable(dirname($filename)) == false) {
            @chmod(dirname($filename), 0755);
        }

        if (file_exists($filename)) {
            if (is_writable($filename) == false) {
                @chmod($filename, 0755);
            }
            @unlink($filename);
        }

        $reduxFramework->filesystem->execute('put_contents', $filename, array('content' => $_config_css));
    }
}
