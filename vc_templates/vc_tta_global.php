<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$this->resetVariables( $atts, $content );
extract( $atts );

$this->setGlobalTtaInfo();
$this->enqueueTtaStyles();
$this->enqueueTtaScript();

// It is required to be before tabs-list-top/left/bottom/right for tabs/tours
$prepareContent = $this->getTemplateVariable( 'content' );

$class_to_filter = $this->getTtaGeneralClasses();
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="booty_tabs">';
$output .= '<div '. $this->getWrapperAttributes() .'>';
$output .= '<div class="t_align_c m_bottom_15 heading_1 appear-animation bounceInLeft appear-animation-visible" data-appear-animation="bounceInLeft">'.$this->getTemplateVariable( 'title' ).'</div>';
$justify = '';
if ( isset($justify_effect) ) :
    if ( $justify_effect == 'enable_justify_effect' ) {
        $justify = 'nav-justified';
    }else{
        $justify = '';
    }
endif;


$output .= '<div class="' . esc_attr( $css_class ) .' '.$justify. '">';
$output .= $this->getTemplateVariable( 'tabs-list-top' );
$output .= $this->getTemplateVariable( 'tabs-list-left' );
$output .= '<div class="tabs_panels_container vc_tta-panels-container">';
$output .= $this->getTemplateVariable( 'pagination-top' );
$output .= '<div class="vc_tta-panels">';
$output .= $prepareContent;
$output .= '</div>';
$output .= $this->getTemplateVariable( 'pagination-bottom' );
$output .= '</div>';
$output .= $this->getTemplateVariable( 'tabs-list-bottom' );
$output .= $this->getTemplateVariable( 'tabs-list-right' );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;