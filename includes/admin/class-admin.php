<?php

namespace Prince\WP_Radio\Admin;
defined('ABSPATH') || exit();

class Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_import_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	function add_import_menu( $a ) {
		add_submenu_page( 'edit.php?post_type=wp_radio', __( 'Import Stations', 'wp-radio' ), __( 'Import Stations', 'wp-radio' ), 'manage_options', 'import-stations', [
			$this,
			'import_menu_page'
		] );
	}

	function import_menu_page() {
		include WP_RADIO_INCLUDES . '/admin/views/html-import-stations.php';
	}

	function admin_scripts( $hook ) {

		if ( 'wp_radio_page_import-stations' == $hook ) {
			wp_enqueue_style( 'wp-radio-admin', WP_RADIO_ASSETS_URL . '/admin.min.css', false, WP_RADIO_VERSION );
			wp_enqueue_script( 'hideseek', WP_RADIO_ASSETS_URL . '/jquery.hideseek.min.js', [ 'jquery' ], WP_RADIO_VERSION );
			wp_enqueue_script( 'wp-radio-admin', WP_RADIO_ASSETS_URL . '/admin.min.js', [
				'jquery',
				'wp-util'
			], WP_RADIO_VERSION, true );

			wp_localize_script( 'wp-radio-admin', 'wpradio', array(
				'imported_countries' => get_option( 'wp_radio_imported_countries' ),
			) );

		}
	}

}

new Admin();