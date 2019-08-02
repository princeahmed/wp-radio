<?php

/**
 * Default WP Theme Support
 *
 * @since 1.0.0
 *
 * @package WP_Radio
 */

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit();

class Theme_Support {
	function __construct() {
		add_action( 'wp_radio_scripts_after', array( $this, 'enqueue_styles' ) );

		if ( in_array( get_template(), array( 'twentyseventeen' ) ) ) {
			add_action( 'wp_radio_before_main_content', array( $this, 'before_main_content' ) );
			add_action( 'wp_radio_after_main_content', array( $this, 'after_main_content' ) );
		}
	}

	function enqueue_styles() {
		switch ( get_template() ) {
			case 'twentynineteen':
				wp_enqueue_style( 'wp-radio-twentynineteen', WP_RADIO_ASSETS_URL . '/css/twentynineteen.min.css', false, WP_RADIO_VERSION );
				break;
			case 'twentyseventeen':
				wp_enqueue_style( 'wp-radio-twentyseventeen', WP_RADIO_ASSETS_URL . '/css/twentyseventeen.min.css', false, WP_RADIO_VERSION );
				break;
		}
	}

	function before_main_content( $content ) {
		switch ( get_template() ) {
			case 'twentyseventeen':
				$html = '<div class="wrap">';
				$html .= '<div id="primary" class="content-area twentyseventeen">';
				$html .= '<main id="main" class="site-main" role="main">';

				return $html;
			default:
				return $content;
		}
	}

	function after_main_content( $content ) {
		switch ( get_template() ) {
			case 'twentyseventeen':
				ob_start();
				echo '</main>';
				echo '</div>';
				get_sidebar();
				echo '</div>';
				$html = ob_get_clean();

				return $html;
			default:
				return $content;
		}
	}
}

new Theme_Support();