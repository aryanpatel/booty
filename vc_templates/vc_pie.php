<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $el_class
 * @var $value
 * @var $units
 * @var $color
 * @var $custom_color
 * @var $label_value
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$title = $el_class = $value = $units = $color = $custom_color = $label_value = $css = $line_width = $size_box = $layouts = '';
$atts = $this->convertOldColorsToNew( $atts );
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'vc_pie' );

$colors = array(
	'blue' => '#5472d2',
	'turquoise' => '#00c1cf',
	'pink' => '#fe6c61',
	'violet' => '#8d6dc4',
	'peacoc' => '#4cadc9',
	'chino' => '#cec2ab',
	'mulled-wine' => '#50485b',
	'vista-blue' => '#75d69c',
	'orange' => '#f7be68',
	'sky' => '#5aa1e3',
	'green' => '#6dab3c',
	'juicy-pink' => '#f4524d',
	'sandy-brown' => '#f79468',
	'purple' => '#b97ebb',
	'black' => '#2a2a2a',
	'grey' => '#ebebeb',
	'white' => '#ffffff',
);

if ( 'custom' === $color ) {
	$color = $custom_color;
} else {
	$color = isset( $colors[ $color ] ) ? $colors[ $color ] : '';
}

if ( ! $color ) {
	$color = $colors['grey'];
}

$class_to_filter = '';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
switch ( $layouts ) {
	case 'yes':
		# code...
		$output ='<div class="pie_chart lancer-about '.esc_attr( $css_class ).'">';
		break;
	case 'no':
		# code...
		$output ='<div class="pie_chart pie-block '.esc_attr( $css_class ).'">';
		break;
	default:
		# code...
		break;
}
$output .= '<div class= "box" data-pie-value="' . esc_attr( $value ) . '" data-pie-label-value="' . esc_attr( $label_value ) . '" data-pie-units="' . esc_attr( $units ) . '" data-pie-color="' . esc_attr( $color ) . '" data-animate="fadeInUp" data-delay="100">';
$output .='
	<div class="pie-block">
		<div class="pie-chart" data-percent="' . esc_attr( $value ) . '" data-barColor="'.esc_attr( $color ).'" data-trackColor="#eee" data-lineWidth="' . esc_attr( $line_width ) . '" data-barSize="' . esc_attr( $size_box ) . '">
			<div class="pie-chart-percent">
				<span></span>'.esc_attr( $units ).'
			</div>
		</div>';
		if ( '' !== $title ) {
			$output .= '<span class="pie-description">' . $title . '</span>';
		}

$output .='</div>
</div>
	</div>';

echo $output;
