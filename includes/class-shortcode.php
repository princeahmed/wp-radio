<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Class ShortCode
 *
 * add short codes
 *
 * @package Prince\WP_Radio
 *
 * @since 1.0.0
 */
class ShortCode {

	/* constructor */
	public function __construct() {
		add_shortcode( 'wp_radio_listing', array( $this, 'listing' ) );
	}

	/**
	 * Station listing
	 *
	 * @param $attrs
	 */
	function listing( $attrs ) {
		ob_start();
		wp_radio_get_template( 'listing/listing-page' );
		$html = ob_get_clean();

		return $html;
	}

}

new ShortCode();