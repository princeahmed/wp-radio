<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Class Install
 *
 * Update essential options during installation
 *
 * @package Prince\WP_Radio
 *
 * @since 1.0.0
 *
 */
class Install {

	/**
	 * Install constructor.
	 */
	public function __construct() {
		register_activation_hook( WP_RADIO_FILE, array( __CLASS__, 'install' ) );

	}

	public static function install() {

		if ( get_option( 'wp_radio_install_date' ) ) {
			return;
		}

		if ( ! is_blog_installed() ) {
			return;
		}

		// Check if we are not already running this routine.
		if ( 'yes' === get_transient( 'wp_radio_installing' ) ) {
			return;
		}

		self::create_options();


		delete_transient( 'wp_radio_installing' );
	}


	/**
	 * Save option data
	 */
	public static function create_options() {
		//save version
		update_option( 'wp_radio_version', WP_RADIO_VERSION );

		//save install date
		update_option( 'wp_radio_install_date', current_time( 'timestamp' ) );
	}


}

new Install();
