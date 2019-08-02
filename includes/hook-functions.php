<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit();

/**
 * Change the Enter title placeholder
 *
 * @param $placeholder
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_enter_title_here( $placeholder ) {

	if ( 'wp_radio' == get_post_type() ) {
		return __( 'Enter Radio Station Name', 'wp-radio' );
	}

	return $placeholder;
}

add_filter( 'enter_title_here', 'wp_radio_enter_title_here' );

/* Footer full-width player */
function wp_radio_fullwidth_player() {
	wp_radio_get_template( 'player/full-width' );
}

add_action( 'wp_footer', 'wp_radio_fullwidth_player', 999 );

/**
 * Add settings menu to Main menu
 */
add_filter( 'prince_settings_parent_slug', function () {
	return 'edit.php?post_type=wp_radio';
} );

/**
 * Change the default template
 *
 * Change template for radio_country & radio_genre archive
 * and wp_radio single post
 *
 * @param $template
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_listing_page_template( $template ) {

	if ( is_page( prince_get_option( 'radios_page' ) ) ) {
		$template = wp_radio_get_template( 'listing/listing-page' );
	} elseif ( is_tax( 'radio_country' ) || is_tax( 'radio_genre' ) ) {
		$template = wp_radio_get_template( 'listing/listing-page-template' );
	} elseif ( is_singular( 'wp_radio' ) ) {
		$template = wp_radio_get_template( 'single' );
	}

	return $template;
}

add_filter( 'template_include', 'wp_radio_listing_page_template' );

/**
 * Change WP_Radio Posts Permalink
 *
 * @return string
 * @since 1.0.0
 *
 */

function wp_radio_permalinks( $permalink, $post ) {

	if ( 'wp_radio' != get_post_type( $post ) ) {
		return $permalink;
	}

	$category = get_the_terms( $post, 'radio_country' );

	if ( ! empty( $category ) ) {
		return trailingslashit( site_url( $category[0]->slug . '/' . $post->post_name ) );
	}
}

add_filter( 'post_type_link', 'wp_radio_permalinks', 10, 2 );

/**
 * Change radio_country taxonomy term link
 *
 * @param $url
 * @param $term
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_country_link( $url, $term ) {

	if ( 'radio_country' != $term->taxonomy ) {
		return $url;
	}

	return trailingslashit( site_url( $term->slug ) );
}

add_filter( 'term_link', 'wp_radio_country_link', 10, 2 );

/**
 * Add new rewrite rules for single and archive view
 *
 * @param $rules
 *
 * @return array
 * @since 1.0.0
 *
 */
function wp_radio_rewrite_rules( $rules ) {

	if ( empty( $_SERVER['REDIRECT_URL'] ) ) {
		return $rules;
	}

	$url = $_SERVER['REDIRECT_URL'];
	$new = array();

	if ( preg_match( '/^\/(?<country>[a-z]{2})\/(?<name>.+?)\/?$/i', $url, $matches ) ) {
		$countries = array_change_key_case( wp_radio_get_country_list() );

		if ( array_key_exists( $matches['country'], $countries ) ) {
			$new[ $matches['country'] . '/([^/]+)/?$' ] = 'index.php?post_type=wp_radio&wp_radio=$matches[1]';
		}
	}

	$country_pattern       = '/^\/(?<country>[a-z]{2})\/?$/i';
	$country_paged_pattern = '/^\/(?<country>[a-z]{2})\/page\/(?<page>[0-9]{1,})\/?$/i';

	$countries = array_change_key_case( wp_radio_get_country_list() );

	if ( preg_match( $country_pattern, $url, $matches ) ) {
		if ( array_key_exists( $matches['country'], $countries ) ) {
			$new[ '(' . $matches['country'] . ')/?$' ] = 'index.php?radio_country=$matches[1]';
		}
	}

	if ( preg_match( $country_paged_pattern, $url, $matches ) ) {
		if ( array_key_exists( $matches['country'], $countries ) ) {
			$new[ '(' . $matches['country'] . ')/page/?([0-9]{1,})/?$' ] = 'index.php?radio_country=$matches[1]&paged=$matches[2]';
		}
	}

	return array_merge( $new, $rules ); // Ensure our rules come first
}

add_filter( 'rewrite_rules_array', 'wp_radio_rewrite_rules' );

/**
 * Flush rewrite rules if matched with pattern
 *
 * @return void
 * @since 1.0.0
 *
 */
function wp_radio_flush_rewrite_rules() {

	if ( ! isset( $_SERVER['REDIRECT_URL'] ) ) {
		return;
	}

	$url                   = $_SERVER['REDIRECT_URL'];
	$single_pattern        = '/^\/([a-z]{2})\/(.+?)\/?$/i';
	$country_pattern       = '/^\/(?<country>[a-z]{2})\/?$/i';
	$country_paged_pattern = '/^\/(?<country>[a-z]{2})\/page\/(?<page>[0-9]{1,})\/?$/i';

	if ( preg_match( $single_pattern, $url ) || preg_match( $country_pattern, $url ) || preg_match( $country_paged_pattern, $url ) ) {
		flush_rewrite_rules( true );
	}
}

add_action( 'init', 'wp_radio_flush_rewrite_rules' );

/**
 * Add radio_country tax_query to the genre archive query
 *
 * @param $query
 *
 * @since 1.0.0
 *
 */
function wp_radio_country_genres_posts( $query ) {

	if ( ! is_tax( 'radio_genre' ) ) {
		return;
	}

	$country = ! empty( $_REQUEST['country'] ) ? sanitize_key( $_REQUEST['country'] ) : '';

	$query->set( 'tax_query', array(
		'relation' => 'AND',
		array(
			'taxonomy' => 'radio_country',
			'field'    => 'slug',
			'terms'    => $country,
		)
	) );

	$query->set( 'orderby', 'title' );
	$query->set( 'order', 'ASC' );

}

add_action( 'pre_get_posts', 'wp_radio_country_genres_posts' );
/**
 * Add radio_country tax_query to the genre archive query
 *
 * @param $query
 *
 * @since 1.0.0
 *
 */
function wp_radio_country_posts( $query ) {

	if ( ! is_tax( 'radio_country' ) ) {
		return;
	}

	$query->set( 'orderby', 'title' );
	$query->set( 'order', 'ASC' );

}

add_action( 'pre_get_posts', 'wp_radio_country_posts' );

/**
 * Settings page logo
 *
 * @param $html
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_settings_page_logo( $html ) {
	return '<a href="http://wordpress.org/plugins/wp-radio" target="_blank"> <img style="position: relative; height: auto;margin-top: 3px;" src="' . WP_RADIO_ASSETS_URL . '/images/wp-radio-icon-w20.png"> </a>';
}

add_filter( 'prince_header_logo_link', 'wp_radio_settings_page_logo' );

/**
 * Settings page version text
 *
 * @param $text
 *
 * @return string
 * @since 1.0.0
 *
 */
function wp_radio_settings_version_text( $text ) {
	return __( 'WP Radio - ' . WP_RADIO_VERSION, 'wp-radio' );
}

add_filter( 'prince_header_version_text', 'wp_radio_settings_version_text' );
/**
 * Settings page version text
 *
 * @param $text
 *
 * @return array|string
 * @since 1.0.0
 *
 */
function wp_radio_template_layout_images( $choices, $field_id ) {

	if ( 'template_layout' != $field_id ) {
		return false;
	}

	$choices = array(
		array(
			'value' => 'left-sidebar',
			'label' => __( 'Left Country Sidebar', 'wp-radio' ),
			'src'   => PRINCE_ASSETS_URL . 'left-sidebar.png'
		),
		array(
			'value' => 'full-width',
			'label' => __( 'Full Width (no sidebar)', 'wp-radio' ),
			'src'   => PRINCE_ASSETS_URL . 'full-width.png'
		),
	);

	return $choices;
}

add_filter( 'prince_radio_images', 'wp_radio_template_layout_images', 10, 2 );

//============Filter Previous/ Next Station Link

function wp_radio_filter_prev_next_post_join( $join ) {
	global $post, $wpdb;
	if ( get_post_type( $post ) == 'wp_radio' ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
	}

	return $join;
}

function wp_radio_filter_next_post_sort( $sort ) {
	global $post;
	if ( get_post_type( $post ) == 'wp_radio' ) {
		$sort = "ORDER BY p.post_title ASC LIMIT 1";
	}

	return $sort;
}

function wp_radio_filter_next_post_where( $where ) {
	global $post, $wpdb;

	if ( get_post_type( $post ) == 'wp_radio' ) {
		$where = $wpdb->prepare( "WHERE p.post_title > '%s' AND p.post_type = '" . get_post_type( $post ) . "' AND p.post_status = 'publish'", $post->post_title );

		$term_array = wp_get_object_terms( $post->ID, 'radio_country', array( 'fields' => 'ids' ) );
		$term_array = array_map( 'intval', $term_array );

		if ( ! $term_array || is_wp_error( $term_array ) ) {
			return '';
		}

		$where .= ' AND tt.term_id IN (' . implode( ',', $term_array ) . ')';
	}

	return $where;
}

function wp_radio_filter_previous_post_sort( $sort ) {
	global $post;

	if ( get_post_type( $post ) == 'wp_radio' ) {
		$sort = "ORDER BY p.post_title DESC LIMIT 1";
	}

	return $sort;
}

function wp_radio_filter_previous_post_where( $where ) {
	global $post, $wpdb;

	if ( get_post_type( $post ) == 'wp_radio' ) {
		$where = $wpdb->prepare( "WHERE p.post_title < '%s' AND p.post_type = '" . get_post_type( $post ) . "' AND p.post_status = 'publish'", $post->post_title );

		$term_array = wp_get_object_terms( $post->ID, 'radio_country', array( 'fields' => 'ids' ) );
		$term_array = array_map( 'intval', $term_array );

		if ( ! $term_array || is_wp_error( $term_array ) ) {
			return '';
		}

		$where .= ' AND tt.term_id IN (' . implode( ',', $term_array ) . ')';
	}

	return $where;
}

add_filter( 'get_previous_post_join', 'wp_radio_filter_prev_next_post_join' );
add_filter( 'get_next_post_join', 'wp_radio_filter_prev_next_post_join' );

add_filter( 'get_next_post_sort', 'wp_radio_filter_next_post_sort' );
add_filter( 'get_previous_post_sort', 'wp_radio_filter_previous_post_sort' );

add_filter( 'get_next_post_where', 'wp_radio_filter_next_post_where' );
add_filter( 'get_previous_post_where', 'wp_radio_filter_previous_post_where' );

//filter body class
function wp_radio_filter_body_class( $classes ) {
	global $post;

	if ( ( is_page() && has_shortcode( $post->post_content, 'wp_radio_listing' ) )
	     || 'wp_radio' == get_post_type( $post )
	     || is_tax( 'radio_country' )
	     || is_tax( 'radio_genre' )
	     || is_page( prince_get_option('radios_page') )
	) {
		$classes[] = 'wp-radio';
	}

	return $classes;
}

add_filter( 'body_class', 'wp_radio_filter_body_class' );

