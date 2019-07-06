<?php
/**
 * Plugin Name: WP Radio
 * Plugin URI:  wpradio.com
 * Description: Worldwide Radio station directory to listen live radio streaming.
 * Version:     2.0.0
 * Author:      Prince Ahmed
 * Author URI:  http://princeahmed.me
 * Donate link: http://princeahmed.me
 * License:     GPLv2+
 * Text Domain: wp-radio
 * Domain Path: /languages/
 */

/**
 * Copyright (c) 2018 wpradio (email : support@wpradio.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General frontend License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General frontend License for more details.
 *
 * You should have received a copy of the GNU General frontend License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( __( 'Hey, Silly man, You can\'t acces this page', 'wp-radio' ) );
};


/**
 * Main initiation class
 *
 * @since 1.0.0
 */

/**
 * Main WP_Radio Class.
 *
 * @class WP_Radio
 */
final class WP_Radio {
	/**
	 * WP_Radio version.
	 *
	 * @var string
	 */
	public $version = '2.0.0';

	/**
	 * Minimum PHP version required
	 *
	 * @var string
	 */
	private $min_php = '5.6.0';

	/**
	 * The single instance of the class.
	 *
	 * @var WP_Radio
	 * @since 1.0.0
	 */
	protected static $instance = null;


	/**
	 * Holds various class instances
	 *
	 * @var array
	 */
	private $container = array();

	/**
	 * Main WP_Radio Instance.
	 *
	 * Ensures only one instance of WP_Radio is loaded or can be loaded.
	 *
	 * @return WP_Radio - Main instance.
	 * @since 1.0.0
	 * @static
	 */
	static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->setup();
		}

		return self::$instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0
	 */
	function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.', 'wp-radio' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0
	 */
	function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.', 'wp-radio' ), '1.0.0' );
	}

	/**
	 * Magic getter to bypass referencing plugin.
	 *
	 * @param $prop
	 *
	 * @return mixed
	 */
	function __get( $prop ) {
		if ( array_key_exists( $prop, $this->container ) ) {
			return $this->container[ $prop ];
		}

		return $this->{$prop};
	}

	/**
	 * Magic isset to bypass referencing plugin.
	 *
	 * @param $prop
	 *
	 * @return mixed
	 */
	function __isset( $prop ) {
		return isset( $this->{$prop} ) || isset( $this->container[ $prop ] );
	}

	/**
	 *  Constructor.
	 */
	function setup() {
		$this->check_environment();
		$this->define_constants();
		$this->includes();
		$this->init_hooks();
		do_action( 'wp_radio_loaded' );
	}

	/**
	 * Ensure theme and server variable compatibility
	 */
	function check_environment() {
		if ( version_compare( PHP_VERSION, $this->min_php, '<=' ) ) {
			deactivate_plugins( plugin_basename( __FILE__ ) );

			wp_die( "Unsupported PHP version Min required PHP Version:{$this->min_php}" );
		}
	}

	/**
	 * Define Projects Constants.
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	private function define_constants() {
		define( 'WP_RADIO_VERSION', $this->version );
		define( 'WP_RADIO_FILE', __FILE__ );
		define( 'WP_RADIO_PATH', dirname( WP_RADIO_FILE ) );
		define( 'WP_RADIO_INCLUDES', WP_RADIO_PATH . '/includes' );
		define( 'WP_RADIO_URL', plugins_url( '', WP_RADIO_FILE ) );
		define( 'WP_RADIO_ASSETS_URL', WP_RADIO_URL . '/assets' );
		define( 'WP_RADIO_TEMPLATES_DIR', WP_RADIO_PATH . '/templates' );
	}


	/**
	 * Check What type of request is this?
	 *
	 * @param string $type admin, ajax, cron or frontend.
	 *
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined( 'DOING_AJAX' );
			case 'cron':
				return defined( 'DOING_CRON' );
			case 'frontend':
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' ) && ! defined( 'REST_REQUEST' );
		}
	}


	/**
	 * Include required core files used in admin and on the frontend.
	 */
	function includes() {
		//core includes
		include_once WP_RADIO_INCLUDES . '/class-install.php';
		include_once WP_RADIO_INCLUDES . '/core-functions.php';
		include_once WP_RADIO_INCLUDES . '/hook-functions.php';
		include_once WP_RADIO_INCLUDES . '/class-post-types.php';
		include_once WP_RADIO_INCLUDES . '/class-widget.php';
		include_once WP_RADIO_INCLUDES . '/prince-settings/prince-loader.php';
		include_once WP_RADIO_INCLUDES . '/script-functions.php';

		//admin includes
		if ( $this->is_request( 'admin' ) ) {
			include_once WP_RADIO_INCLUDES . '/admin/class-metabox.php';
			include_once WP_RADIO_INCLUDES . '/admin/class-ajax.php';
			include_once WP_RADIO_INCLUDES . '/admin/wp-radio-settings.php';
			include_once WP_RADIO_INCLUDES . '/admin/class-admin.php';
		}

		//frontend includes
		if ( $this->is_request( 'frontend' ) ) {
			include_once WP_RADIO_INCLUDES . '/template-functions.php';
			include_once WP_RADIO_INCLUDES . '/class-shortcode.php';
			include_once WP_RADIO_INCLUDES . '/class-ajax.php';
		}

	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 2.3
	 */
	private function init_hooks() {
		// Localize our plugin
		add_action( 'init', array( $this, 'localization_setup' ) );

		//action_links
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @return void
	 * @since 1.0.0
	 *
	 */
	function localization_setup() {
		load_plugin_textdomain( 'wp-radio', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Plugin action links
	 *
	 * @param array $links
	 *
	 * @return array
	 */
	function plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'edit.php?post_type=wp_radio&page=import-stations' ) . '">' . __( 'Import Stations', 'wp-radio' ) . '</a>';
		$links[] = '<a href="https://wordpress.org/support/plugin/wp-radio/" target="_blank">' . __( 'Support', 'wp-radio' ) . '</a>';

		return $links;
	}

}

function wp_radio() {
	return WP_Radio::instance();
}

//fire off the plugin
wp_radio();


