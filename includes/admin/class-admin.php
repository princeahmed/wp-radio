<?php

namespace Prince\WP_Radio\Admin;
defined( 'ABSPATH' ) || exit();

class Admin {

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menu' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
	}

	function admin_menu() {
		add_submenu_page( 'edit.php?post_type=wp_radio', __( 'Import Stations', 'wp-radio' ), __( 'Import Stations', 'wp-radio' ), 'manage_options', 'import-stations', [
			$this,
			'import_menu_page'
		] );
	}

	function import_menu_page() {
		include WP_RADIO_INCLUDES . '/admin/views/html-import-stations.php';
	}

	function admin_scripts( $hook ) {

		if ( 'wp_radio_page_import-stations' != $hook ) {
			return;
		}

		wp_enqueue_style( 'wp-radio-admin', WP_RADIO_ASSETS_URL . '/css/admin.min.css', false, WP_RADIO_VERSION );
		wp_enqueue_script( 'hideseek', WP_RADIO_ASSETS_URL . '/js/jquery.hideseek.min.js', [ 'jquery' ], WP_RADIO_VERSION );
		wp_enqueue_script( 'wp-radio-admin', WP_RADIO_ASSETS_URL . '/js/admin.min.js', [
			'jquery',
			'wp-util'
		], WP_RADIO_VERSION, true );

		wp_localize_script( 'wp-radio-admin', 'wpradio', array(
			'isPremium'          => wr_fs()->can_use_premium_code__premium_only(),
			'pricingPage'        => WP_RADIO_PRICING,
			'imported_countries' => get_option( 'wp_radio_imported_countries' ),
			'i18n'               => array(
				'alert_no_country'   => __( 'You need to select countries, before run the import', 'wp-radio' ),
				'running'            => __( 'Running...', 'wp-radio' ),
				'no_country_found'   => __( 'No country found.', 'wp-radio' ),
				'update'             => __( 'Update', 'wp-radio' ),
				'updating'           => __( 'Updating', 'wp-radio' ),
				'imported'           => __( 'Imported:', 'wp-radio' ),
				'count_title'        => __( 'Total station of the country', 'wp-radio' ),
				'premium'            => __( 'Premium', 'wp-radio' ),
				'select_add_country' => __( 'Search country to add', 'wp-radio' ),
				'get_premium'        => __( 'Upgrade to Premium', 'wp-radio' ),
				'premium_promo'      => __( 'to access total 45000+ stations of 230+ countries.', 'wp-radio' ),
				'selected_countries' => __( 'Selected Countries', 'wp-radio' ),
				'selected'           => __( 'Selected:', 'wp-radio' ),
				'remaining'          => __( 'Remaining:', 'wp-radio' ),
				'total_station'      => __( 'Total Station:', 'wp-radio' ),
				'done_msg'           => __( 'Done, See all stations', 'wp-radio' ),
			),
		) );


	}

}

new Admin();