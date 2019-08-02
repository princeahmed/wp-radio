<?php

namespace Prince\WP_Radio;

/* Block direct access */
defined( 'ABSPATH' ) || exit;
/**
 * Class ShortCode
 *
 * add short codes
 *
 * @package Prince\WP_Radio
 *
 * @since 1.0.0
 */
class ShortCode
{
    /* constructor */
    public function __construct()
    {
        add_shortcode( 'wp_radio_listing', array( $this, 'listing' ) );
        add_shortcode( 'wp_radio_featured', array( $this, 'featured' ) );
        add_shortcode( 'wp_radio_trending', array( $this, 'trending' ) );
        add_shortcode( 'wp_radio_country_list', array( $this, 'country_list' ) );
    }
    
    /**
     * Station listing
     *
     * @param $attrs
     */
    function listing( $atts )
    {
        $atts = shortcode_atts( array(
            'country' => '',
        ), $atts );
        ob_start();
        wp_radio_get_template( 'listing/listing-page-shortcode', $atts );
        $html = ob_get_clean();
        return $html;
    }
    
    /**
     * Featured stations
     *
     * @param $atts
     */
    function featured( $atts )
    {
        $atts = shortcode_atts( array(
            'count'   => 10,
            'country' => '',
            'title'   => __( 'Featured Stations', 'wp-radio-premium' ),
        ), $atts );
        ob_start();
        printf( '<h4><a href="%s">%s</a></h4>', WP_RADIO_PRICING, __( 'Upgrade to Premium to use this shortcode', 'wp-radio' ) );
        $html = ob_get_clean();
        return $html;
    }
    
    /**
     * Featured stations
     *
     * @param $atts
     */
    function trending( $atts )
    {
        $atts = shortcode_atts( array(
            'count'   => 10,
            'country' => 'bd',
            'title'   => __( 'Trending Stations', 'wp-radio-premium' ),
        ), $atts );
        ob_start();
        printf( '<h4><a href="%s">%s</a></h4>', WP_RADIO_PRICING, __( 'Upgrade to Premium to use this shortcode', 'wp-radio' ) );
        $html = ob_get_clean();
        return $html;
    }
    
    /**
     * Get sidebar country list
     *
     * @param $atts
     */
    function country_list( $atts )
    {
        ob_start();
        printf( '<h4><a href="%s">%s</a></h4>', WP_RADIO_PRICING, __( 'Upgrade to Premium to use this shortcode', 'wp-radio' ) );
        $html = ob_get_clean();
        return $html;
    }

}
new ShortCode();