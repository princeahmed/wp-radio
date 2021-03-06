<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Class MetaBox
 *
 * Handle metaboxes
 *
 * @package Prince\WP_Radio
 *
 * @since 1.0.0
 */
class MetaBox {

	/**
	 * MetaBox constructor.
	 * Initialize the custom Meta Boxes for prince-settings api.
	 *
	 * @since 1.0.0
	 */
	function __construct() {
		add_action( 'admin_init', array( $this, 'meta_boxes' ) );
		add_filter( 'prince_media_buttons', array( $this, 'wp_editor_media_buttons' ), 10, 2 );
		add_filter( 'prince_tinymce', array( $this, 'wp_editor_tinymce' ), 10, 2 );
		add_action( 'do_meta_boxes', array( $this, 'remove_metaboxes' ) );
	}

	function remove_metaboxes() {
		remove_meta_box( 'postimagediv', 'wp_radio', 'side' );
	}

	/**
	 * Create a custom meta boxes array that we pass to
	 * the Prince Meta Box API Class.
	 *
	 * @since 1.0.0
	 */
	function meta_boxes() {

		$metaboxes = [];

		$metaboxes['wp_radio_metabox'] = array(
			'id'       => 'wp_radio_metabox',
			'title'    => __( 'Station Information', 'wp-radio' ),
			//'desc'     => __( 'Add Additional Information for the radio station', 'wp-radio' ),
			'pages'    => array( 'wp_radio' ),
			'context'  => 'normal',
			'priority' => 'high',
			'fields'   => apply_filters( 'wp_radio_metabox_fields', array(
					'general-tab' => array(
						'id'    => 'general-tab',
						'label' => __( 'General', 'wp-radio' ),
						'type'  => 'tab',
					),

					'stream_url' => array(
						'label' => __( 'Station Stream URL', 'wp-radio' ),
						'id'    => 'stream_url',
						'type'  => 'text',
						'desc'  => sprintf( __( 'Enter the %s of the radio station', 'wp-radio' ), '<code>Live Stream URL</code>' ),
						'attrs' => array(
							'placeholder' => 'Stream URL'
						),
					),


					'featured' => array(
						'label' => __( 'Featured Station', 'wp-radio' ),
						'id'    => 'featured',
						'type'  => 'on_off',
						'desc'  => sprintf( '%s %s',
							__( 'Turn ON, to featured this station. Get the featured stations by using <code>[wp_radio_featured]</code> shortcode.', 'wp-radio' ),
							!wr_fs()->can_use_premium_code__premium_only() ? __( 'This feature is only available in <strong>Premium</strong> version.', 'wp-radio' ) : ''
						),
						'std'   => 'off',
						'class' => 'disabled',
					),

					'references-tab' => array(
						'id'    => 'references-tab',
						'label' => __( 'Station References', 'wp-radio' ),
						'desc'  => __( 'The references of the Radio Station', 'wp-radio' ),
						'type'  => 'tab',
					),

					'language' => array(
						'id'      => 'language',
						'label'   => __( 'Station Language', 'wp-radio' ),
						'desc'    => __( 'Select the language of the radio station', 'wp-radio' ),
						'type'    => 'select',
						'choices' => wp_radio_get_language(),
					),

					'social-links' => array(
						'id'    => 'social-links',
						'label' => __( 'Station Social Links', 'wp-radio' ),
						'desc'  => __( 'Add station website, social links', 'wp-radio' ),
						'type'  => 'social-links',
						'std'   => array(
							array(
								'name'  => __( 'Website', 'wp-radio' ),
								'title' => '',
								'href'  => ''
							),
							array(
								'name'  => __( 'Facebook', 'wp-radio' ),
								'title' => '',
								'href'  => ''
							),
							array(
								'name'  => __( 'Twitter', 'wp-radio' ),
								'title' => '',
								'href'  => ''
							),
							array(
								'name'  => __( 'Wikipedia', 'wp-radio' ),
								'title' => '',
								'href'  => ''
							),
						),
					),

					'station-contacts-tab' => array(
						'id'    => 'station-contacts-tab',
						'label' => __( 'Station Contacts', 'wp-radio' ),
						'type'  => 'tab',
						'std'   => '',
					),

					'contact_address' => array(
						'id'    => 'contact_address',
						'label' => __( 'Station Address', 'wp-radio' ),
						'desc'  => __( 'Contact address of the Radio station', 'wp-radio' ),
						'type'  => 'textarea_simple',
						'rows'  => 2,
					),

					'contact_email' => array(
						'id'    => 'contact_email',
						'label' => __( 'Email', 'wp-radio' ),
						'desc'  => __( 'Contact email of the Radio Station', 'wp-radio' ),
						'type'  => 'text',
					),

					'contact_phone' => array(
						'id'    => 'contact_phone',
						'label' => __( 'Phone', 'wp-radio' ),
						'desc'  => __( 'Contact phone number of the Radio Station', 'wp-radio' ),
						'type'  => 'text',
					),

					'contact_additional' => array(
						'id'    => 'contact_additional',
						'label' => __( 'Additional Contacts Info', 'wp-radio' ),
						'desc'  => sprintf( __( 'You can enter additional contact information here with basic %s.', 'wp-radio' ), '<code>HTML</code>' ),
						'type'  => 'textarea',
					),

				)
			)

		);

		$metaboxes['wp_radio_image_metabox'] = array(
			'id'       => 'wp_radio_image_metabox',
			'title'    => __( 'Station Image', 'wp-radio' ),
			'desc'     => __( 'Enter URL or Upload the station Image', 'wp-radio' ),
			'pages'    => array( 'wp_radio' ),
			'context'  => 'side',
			'priority' => 'low',
			'fields'   => array(
				array(
					'id'   => 'logo',
					'type' => 'upload',
				),
			)
		);

		if ( function_exists( 'prince_register_meta_box' ) ) {
			foreach ( $metaboxes as $metabox ) {
				prince_register_meta_box( $metabox );
			}
		}

	}

	/**
	 * Hide wp_editor media buttons for metabox specific ids
	 *
	 * @param $true
	 * @param $field_id
	 *
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	function wp_editor_media_buttons( $true, $field_id ) {


		if ( 'additional' == $field_id ) {
			return false;
		}

		return $true;
	}

	/**
	 * Disallow wp_editor tinymce editor for metabox specific field ids
	 *
	 * @param $true
	 * @param $field_id
	 *
	 * @return bool
	 * @since 1.0.0
	 *
	 */
	function wp_editor_tinymce( $true, $field_id ) {
		if ( 'additional' == $field_id ) {
			return false;
		}

		return $true;
	}

}

new MetaBox();
