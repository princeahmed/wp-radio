<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Get template files
 *
 * since 1.0.0
 *
 * @param        $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 *
 * @return void
 */
function wp_radio_get_template( $template_name, $args = array(), $template_path = 'wp-radio', $default_path = '' ) {

	/* Add php file extension to the template name */
	$template_name = $template_name . '.php';

	/* Extract the args to variables */
	if ( $args && is_array( $args ) ) {
		extract( $args );
	}

	/* Look within passed path within the theme - this is high priority. */
	$template = locate_template( array( trailingslashit( $template_path ) . $template_name ) );

	/* Get default template. */
	if ( ! $template && false !== $default_path ) {
		$default_path = $default_path ? $default_path : WP_RADIO_TEMPLATES_DIR;
		if ( file_exists( trailingslashit( $default_path ) . $template_name ) ) {
			$template = trailingslashit( $default_path ) . $template_name;
		}
	};

	// Return what we found.
	include( apply_filters( 'wp_radio_locate_template', $template, $template_name, $template_path ) );

}