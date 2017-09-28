<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $values
 * @var $units
 * @var $bgcolor
 * @var $custombgcolor
 * @var $customtxtcolor
 * @var $options
 * @var $el_class
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$title = $values = $units = $bgcolor = $css = $custombgcolor = $customtxtcolor = $options = $el_class = '';
$animation_move = 'yes';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts = $this->convertAttributesToNewProgressBar( $atts );

extract( $atts );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );

$bar_options = array();
$options = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}

if ( 'custom' === $bgcolor && '' !== $custombgcolor ) {
	$custombgcolor = ' style="' . vc_get_css_color( 'background-color', $custombgcolor ) . '"';
	if ( '' !== $customtxtcolor ) {
		$customtxtcolor = ' style="' . vc_get_css_color( 'color', $customtxtcolor ) . '"';
	}
	$bgcolor = '';
} else {
	$custombgcolor = '';
	$customtxtcolor = '';
	$bgcolor = 'vc_progress-bar-color-' . esc_attr( $bgcolor );
	$el_class .= ' ' . $bgcolor;
}

$class_to_filter = 'vc_progress_bar wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

if ( $animation_move == 'yes' ) :
	if ( in_array( 'striped', $bar_options ) ){
		$output = '<div class="progress-holder style2 list-unstyled padding-zero ' . esc_attr( $css_class ) . '">';
	} else {
		$output = '<div class="progress-holder list-unstyled ' . esc_attr( $css_class ) . '">';
	}
else :
	$output = '<div class="p-skills"><div class="progress-right ' . esc_attr( $css_class ) . '">';
	$output .= '<div class="progress-holder list-unstyled ' . esc_attr( $css_class ) . '">';
endif;

$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_progress_bar_heading' ) );

$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $custombgcolor;
	$new_line['txtcolor'] = isset( $data['color'] ) && 'custom' !== $data['color'] ? '' : $customtxtcolor;
	if ( isset( $data['customcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['customcolor'] ) . ';"';
	}
	if ( isset( $data['customtxtcolor'] ) && ( ! isset( $data['color'] ) || 'custom' === $data['color'] ) ) {
		$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['customtxtcolor'] ) . ';"';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {
	if ( $units !='' ){
		$unit = $units;
	}else{
		$unit ='%';
	}
	if ( in_array( 'striped', $bar_options ) ){
		$output .= '<div class="vc_single_process_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '">';
		$output .= '<span class="title" ' . $line['txtcolor'] . '>' . $line['label'].'</span>';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output.='<div class="progress-bar">
					<span class="progress-bar-outer" data-width="'.esc_attr( $line['value'] ).'">
						<span class="counter">
							<span data-from="0" data-to="'.esc_attr( $line['value'] ).'" data-refresh-interval="'.esc_attr( $line['value'] ).'" data-speed="1000" data-comma="true">0</span>'.$unit.'
						</span>
					</span>
				</div>';
		$output .= '</div>';
	} else {
		$output .= '<div class="vc_single_process_bar' . ( ( isset( $line['color'] ) && 'custom' !== $line['color'] ) ?
				' vc_progress-bar-color-' . $line['color'] : '' )
			. '">';
		if ( $max_value > 100.00 ) {
			$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
		} else {
			$percentage_value = $line['value'];
		}
		$output.='<div class="progress-bar">
                    <span class="progress-bar-outer" data-width="'.esc_attr( $line['value'] ).'">
                    </span>
                </div>
                <div class="counter">
                    <span data-from="0" data-to="'.esc_attr( $line['value'] ).'" data-refresh-interval="'.esc_attr( $line['value'] ).'" data-speed="1000" data-comma="true">0</span>'.$unit.'
                </div>
                <span class="text" '.$line['txtcolor'].'>'.$line['label'].'</span>';
		$output .= '</div>';
	}
}

$output .= '</div>';
if ( $animation_move == 'no' ) {
	$output .= '</div></div>';
}
echo $output;
