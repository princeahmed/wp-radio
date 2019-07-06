<?php


namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Class Ajax
 *
 * Handle all Ajax requests
 *
 * @since 1.0.0
 *
 * @package Prince\WP_Radio
 */
class Ajax {

	function __construct() {
		add_action( 'wp_ajax_update_stream_title', array( $this, 'update_stream_title' ) );
		add_action( 'wp_ajax_nopriv_update_stream_title', array( $this, 'update_stream_title' ) );
		add_action( 'wp_ajax_wp_radio_next_prev', array( $this, 'next_prev' ) );
		add_action( 'wp_ajax_nopriv_wp_radio_next_prev', array( $this, 'next_prev' ) );
		add_action( 'wp_ajax_wp_radio_station_count', array( $this, 'station_count' ) );
		add_action( 'wp_ajax_nopriv_wp_radio_station_count', array( $this, 'station_count' ) );
	}

	/**
	 * Get stream title for requested station ids
	 *
	 * @return string|boolean
	 * @since 1.0.0
	 *
	 */
	function update_stream_title() {

		if ( empty( $_REQUEST['data'] ) ) {
			wp_send_json_error( __( 'No data', 'wp_radio' ) );
			exit();
		}

		$streams = $_REQUEST['data'];

		$data = [];
		foreach ( $streams as $stream ) {
			$data[ $stream['id'] ] = wp_radio_get_stream_title( $stream['url'] );
		}

		wp_send_json_success( $data );
		exit();
	}

	/**
	 * Get stream data for previous/ next player button
	 *
	 * @return string
	 * @since 1.0.0
	 *
	 */
	function next_prev() {
		$current_id = ! empty( $_REQUEST['current_id'] ) ? intval( $_REQUEST['current_id'] ) : 0;
		$prev_next  = ! empty( $_REQUEST['prev_next'] ) ? sanitize_key( $_REQUEST['prev_next'] ) : 'next';

		$stream_data = wp_radio_get_next_prev_stream_data( $current_id, $prev_next );

		if ( $stream_data ) {
			wp_send_json_success( $stream_data );
		} else {
			wp_send_json_error( __( 'No Post', 'wp_radio' ) );
		}

		exit();
	}

}

new Ajax();