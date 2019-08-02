<?php

defined( 'ABSPATH' ) || exit();

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
				'id'    => 'page',
				'icon'  => 'dashicons dashicons-format-aside',
				'title' => __( 'Page Settings', 'wp-radio' )
			),
			array(
				'id'    => 'layout',
				'icon'  => 'dashicons dashicons-layout',
				'title' => __( 'Layout', 'wp-radio' )
			),

		),
		'settings' => array(
			//pages
			array(
				'id'      => 'radios_page',
				'label'   => __( 'Radios Page', 'wp_radio' ),
				'desc'    => __( 'Choose the radios base page', 'wp_radio' ),
				'std'     => get_page_by_title( 'Radios' ) ? get_page_by_title( 'Radios' )->ID : '',
				'type'    => 'page-select',
				'section' => 'page'
			),
			array(
				'id'      => 'page_sidebar',
				'label'   => __( 'Page Sidebar', 'wp_radio' ),
				'desc'    => __( 'Choose the sidebar for the radios base page. Select none if you don\'t want to show the sidebar', 'wp_radio' ),
				'std'     => 'sidebar-1',
				'type'    => 'sidebar-select',
				'section' => 'page'
			),

			//layout
			array(
				'id'      => 'template_layout',
				'label'   => __( 'Template Layout', 'wp_radio' ),
				'desc'    => __( 'Choose the layout, you want to show', 'wp_radio' ),
				'std'     => '',
				'type'    => 'radio-image',
				'section' => 'layout'
			),
			array(
				'id'      => 'country_list_hidden',
				'label'   => __( 'Hide Country List', 'wp_radio' ),
				'desc'    => __( 'Hide the country sidebar list in the country and genres archive page and show only the radio stations in the country & genres archive page.', 'wp_radio' ),
				'std'     => 'on',
				'type'    => 'on_off',
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