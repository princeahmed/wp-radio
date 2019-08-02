<?php
/**
 * Plugin Name: WP Radio
 * Plugin URI:  https://wpradio.princeboss.com
 * Description: Worldwide Radio station directory to listen live radio streaming.
 * Version:     2.0.1
 * Author:      Prince Ahmed
 * Author URI:  http://princeboss.com
 * Text Domain: wp-radio
 * Domain Path: /languages/
 *
 */

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( __( 'You can\'t access this page', 'wp-radio' ) );
}


/**
 * Main initiation class
 *
 * @since 1.0.0
 */
final class WP_Radio {
	/**
	 * WP_Radio version.
	 *
	 * @var string
	 */
	public $version = '2.0.1';

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

	public function __construct() {
		self::setup();
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

		define( 'WP_RADIO_PRICING', admin_url( 'edit.php?post_type=wp_radio&page=wp-radio-pricing' ) );
		define( 'WP_RADIO_CONTACT', admin_url( 'edit.php?post_type=wp_radio&page=wp-radio-contact' ) );
		define( 'WP_RADIO_SUPPORT', admin_url( 'edit.php?post_type=wp_radio&page=wp-radio-wp-support-forum' ) );
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
		//freemius
		include_once WP_RADIO_INCLUDES . '/freemius.php';

		//core includes
		include_once WP_RADIO_INCLUDES . '/core-functions.php';
		include_once WP_RADIO_INCLUDES . '/hook-functions.php';
		include_once WP_RADIO_INCLUDES . '/class-post-types.php';
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
			include_once WP_RADIO_INCLUDES . '/class-shortcode.php';
			include_once WP_RADIO_INCLUDES . '/class-ajax.php';

			if ( in_array( get_template(), array( 'twentynineteen', 'twentyseventeen' ) ) ) {
				include_once WP_RADIO_INCLUDES . '/class-theme-support.php';
			}
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

		register_activation_hook( __FILE__, array( $this, 'create_radios_page' ) );
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
	 * Create Base Radios page
	 *
	 * @since 2.1.0
	 */
	function create_radios_page() {
		if ( get_page_by_title( 'Radios' ) ) {
			return;
		}

		wp_insert_post( array(
			'post_type'   => 'page',
			'post_title'  => __( 'Radios', 'wp-radio' ),
			'post_status' => 'publish',
		) );

	}

	/**
	 * Plugin action links
	 *
	 * @param array $links
	 *
	 * @return array
	 */
	function plugin_action_links( $links ) {
		$links[] = '<a href="' . admin_url( 'edit.php?post_type=wp_radio&page=import-stations' ) . '">' . __( 'Import', 'wp-radio' ) . '</a>';

		return $links;
	}

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
		}

		return self::$instance;
	}


}

function wp_radio() {
	return WP_Radio::instance();
}

//fire off the plugin
wp_radio();