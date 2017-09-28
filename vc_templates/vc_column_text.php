<?php

if (!defined('ABSPATH')) {
    die('-1');
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $css = $css_animation = '';
$heading_style = 'default';
$atts = vc_map_get_attributes($this->getShortcode(), $atts);
extract($atts);

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation($css_animation);
$class_to_filter .= vc_shortcode_custom_css_class($css, ' ') . $this->getExtraClass($el_class);
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts);

$pattern1 = '/\<h1>(.+)\<\/h1>/';
$pattern2 = '/\<h2>(.+)\<\/h2>/';
$pattern3 = '/\<h3>(.+)\<\/h3>/';
$pattern4 = '/\<h4>(.+)\<\/h4>/';
$pattern5 = '/\<h5>(.+)\<\/h5>/';
$pattern6 = '/\<h6>(.+)\<\/h6>/';
$class_style = '';
$class_heading = '';
if ($heading_style == 'headingstyle2') {
    $class_style = 'small';
    $class_heading = 'heading';
} else if ($heading_style == 'headingstyle3') {
    $class_style = 'style2';
    $class_heading = 'heading';
} else if ($heading_style == 'headingstyle4') {
    $class_heading = 'heading2';
} else if ($heading_style == 'headingstyle5') {
    $class_heading = 'heading3';
} else if ($heading_style == 'headingstyle6') {
    $class_heading = 'heading4';
} else if ($heading_style == 'headingstyle7') {
    $class_heading = 'heading5';
} else if ($heading_style == 'headingstyle8') {
    $class_heading = 'heading6';
    $class_style = 'dark-style';
} else if ($heading_style == 'headingstyle9') {
    $class_heading = 'heading7';
} else if ($heading_style == 'headingstyle10') {
    $class_heading = 'heading8';
} else {
    $class_style = '';
    $class_heading = 'heading';
}
$content = wpb_js_remove_wpautop($content, true);

if ($heading_style != 'default') :
    # code...
    if (preg_match($pattern1, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h1 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h1>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
    if (preg_match($pattern2, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h2 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h2>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
    if (preg_match($pattern3, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h3 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h3>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
    if (preg_match($pattern4, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h4 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h4>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
    if (preg_match($pattern5, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h5 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h5>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
    if (preg_match($pattern6, $content, $matches)) :
        $output = '
            <div class="' . esc_attr($css_class) . '">
                <div class="wpb_wrapper">
                    ' . str_replace($matches[0], '<header class="page-heading ' . $class_style . '">
                <h6 class="' . $class_heading . ' lime text-capitalize font-medium">' . $matches[1] . '</h6>
            </header>', $content) . '
                </div>
            </div>
        ';
    endif;
else :
# code...
    $output = '
        <div class="' . esc_attr($css_class) . '">
            <div class="wpb_wrapper">
                ' . $content . '
            </div>
        </div>
    ';
endif;

echo $output;
