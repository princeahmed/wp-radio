<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit;
/**
 * Class Ajax
 *
 * Handle all Ajax requests
 *
 * @since 1.0.0
 *
 * @package Prince\WP_Radio
 */
class Ajax
{
    function __construct()
    {
        add_action( 'wp_ajax_wp_radio_next_prev', array( $this, 'next_prev' ) );
        add_action( 'wp_ajax_nopriv_wp_radio_next_prev', array( $this, 'next_prev' ) );
    }
    
    /**
     * Get stream data for previous/ next player button
     *
     * @return string
     * @since 1.0.0
     *
     */
    function next_prev()
    {
        $current_id = ( !empty($_REQUEST['current_id']) ? intval( $_REQUEST['current_id'] ) : 0 );
        $prev_next = ( !empty($_REQUEST['prev_next']) ? sanitize_key( $_REQUEST['prev_next'] ) : 'next' );
        $stream_data = wp_radio_get_next_prev_stream_data( $current_id, $prev_next );
        
        if ( $stream_data ) {
            wp_send_json_success( $stream_data );
        } else {
            wp_send_json_error( __( 'No Post', 'wp_radio' ) );
        }
        
        exit;
    }

}
new Ajax();