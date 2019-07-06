<?php


namespace Prince\WP_Radio\Admin;

defined( 'ABSPATH' ) || exit();

include WP_RADIO_INCLUDES . '/admin/class-import-stations.php';

class Ajax {

	function __construct() {
		add_action( 'wp_ajax_wp_radio_import_stations', array( $this, 'handle_import' ) );
	}

	function handle_import() {

		$countries = ! empty( $_REQUEST['countries'] ) ? $_REQUEST['countries'] : '';

		$importer = new Importer( $countries );

		$response = $importer->handle_import();

		wp_send_json_success( $response );
	}

}

new Ajax();