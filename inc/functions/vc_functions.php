<?php

function booty_vc_btn() {
    $attributes = array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Style', BOOTY_TXT_DOMAIN ),
            'description' => esc_html__( 'Select button display style.', BOOTY_TXT_DOMAIN ),
            'param_name' => 'style',
            // partly compatible with btn2, need to be converted shape+style from btn2 and btn1
            'value' => array(
                esc_html__( 'Modern', BOOTY_TXT_DOMAIN ) => 'modern',
                esc_html__( 'Classic', BOOTY_TXT_DOMAIN ) => 'classic',
                esc_html__( 'Flat', BOOTY_TXT_DOMAIN ) => 'flat',
                esc_html__( 'Outline', BOOTY_TXT_DOMAIN ) => 'outline',
                esc_html__( '3d', BOOTY_TXT_DOMAIN ) => '3d',
                esc_html__( 'Custom', BOOTY_TXT_DOMAIN ) => 'custom',
                esc_html__( 'Outline custom', BOOTY_TXT_DOMAIN ) => 'outline-custom',
                esc_html__( 'Fekra history button', BOOTY_TXT_DOMAIN ) => 'btn-history',
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Color', BOOTY_TXT_DOMAIN ),
            'param_name' => 'color',
            'description' => esc_html__( 'Select button color.', BOOTY_TXT_DOMAIN ),
            'dependency' => array(
                'element' => 'style',
                'value_not_equal_to' => array(
                    'custom',
                    'outline-custom',
                ),
        ),
    ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Alignment', BOOTY_TXT_DOMAIN ),
            'description' => esc_html__( 'Select icon alignment.', BOOTY_TXT_DOMAIN ),
            'param_name' => 'i_align',
            'value' => array(
                esc_html__( 'Left', BOOTY_TXT_DOMAIN ) => 'left',
                // default as well
                esc_html__( 'Right', BOOTY_TXT_DOMAIN ) => 'right',
                esc_html__( 'Top', BOOTY_TXT_DOMAIN ) => 'top',
            ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => 'true',
            ),
        ),
    );
    vc_add_params('vc_btn', $attributes); // Note: 'vc_message' was used as a base for "Message box" element
}

add_action('vc_before_init', 'booty_vc_btn');

function booty_vc_ulti_btn() {
    $attributes = array(
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => esc_html__("Button Alignment",BOOTY_TXT_DOMAIN),
            "param_name" => "btn_align",
            "value" => array(
                    "Left Align" => "ubtn-left",
                    "Center Align" => "ubtn-center",
                    "Right Align" => "ubtn-right",
                    "Inline" => "fekra-inline"
                ),
            "description" => "",
            "group" => "General"
        ),
    );
    vc_add_params('ult_buttons', $attributes); // Note: 'vc_message' was used as a base for "Message box" element
}

add_action('vc_before_init', 'booty_vc_ulti_btn');





