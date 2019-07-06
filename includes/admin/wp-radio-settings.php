<?php

defined('ABSPATH') || exit();

/**
 * Initialize the custom Settings.
 */
add_action( 'init', 'wp_radio_settings' );

/**
 * Build the custom settings & update Prince.
 *
 * @return    void
 * @since     1.0.0
 */
function wp_radio_settings() {

	/* Prince is not loaded yet, or this is not an admin request */
	if ( ! function_exists( 'prince_settings_id' ) || ! is_admin() ) {
		return;
	}

	/**
	 * Get a copy of the saved settings array.
	 */
	$saved_settings = get_option( prince_settings_id(), array() );

	/**
	 * Custom settings array that will eventually be
	 * passes to the Prince Settings API Class.
	 */

	$custom_settings = array(

		'sections' => array(
			array(
				'id'    => 'layout',
				'icon'  => 'dashicons dashicons-layout',
				'title' => __( 'Layout', 'wp-radio' )
			),

		),
		'settings' => array(
			//layout
			array(
				'id'      => 'template_layout',
				'label'   => __( 'Template Layout', 'wp_radio' ),
				'desc'    => __( 'Choose the layout, you want to show', 'wp_radio' ),
				'std'     => '',
				'type'    => 'radio-image',
				'section' => 'layout'
			),


		)
	);

	/* allow settings to be filtered before saving */
	$custom_settings = apply_filters( prince_settings_id() . '_args', $custom_settings );

	/* settings are not the same update the DB */
	if ( $saved_settings !== $custom_settings ) {
		update_option( prince_settings_id(), $custom_settings );
	}

	/* Lets Prince know the UI Builder is being overridden */
	global $prince_has_custom_settings;
	$prince_has_custom_settings = true;

}