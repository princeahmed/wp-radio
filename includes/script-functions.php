<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Register and enqueue frontend scripts
 *
 * @param $hook
 *
 * @since 1.0.0
 *
 */
function wp_radio_frontend_scripts( $hook ) {

	/* register frontend styles */
	wp_register_style( 'wp-radio', WP_RADIO_ASSETS_URL . '/css/frontend.min.css', false, WP_RADIO_VERSION );

	/* register frontend scripts */


	/* enqueue frontend styles */
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'wp-radio' );

	/* enqueue frontend script */
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_script( 'jquery.jplayer', WP_RADIO_ASSETS_URL . '/js/jquery.jplayer.min.js', [ 'jquery' ], '2.9.2', true );
	wp_enqueue_script( 'wp-radio', WP_RADIO_ASSETS_URL . '/js/frontend.min.js', array(
		'jquery',
		'jquery-ui-slider',
		'jquery.jplayer',
		'wp-util',
	), WP_RADIO_VERSION, true );

	/* create localized JS array */
	$localized_array = array(
		'ajax'  => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'wp-radio' ),
		'isPremium' => wr_fs()->can_use_premium_code__premium_only() ? true : false,
	);

	/* localized script attached to 'wp-radio' */
	wp_localize_script( 'wp-radio', 'wpradio', $localized_array );

	/* execute scripts after actions */
	do_action( 'wp_radio_scripts_after' );
}

add_action( 'wp_enqueue_scripts', 'wp_radio_frontend_scripts' );



