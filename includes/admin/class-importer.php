<?php

namespace Prince\WP_Radio\Admin;

defined( 'ABSPATH' ) || exit();
include WP_RADIO_INCLUDES . '/admin/class-dispatcher.php';

class Importer {


	protected $countries;
	protected $update;

	/**
	 * Importer constructor.
	 *
	 * @param $countries
	 */
	function __construct( $countries, $update = false ) {
		$this->countries = $countries;
		$this->update    = $update;
	}

	function handle_import() {

		$this->insert_country_terms();

		$response = [];

		if ( ! $this->update ) {
			$countries = array_diff( $this->countries, (array) get_option( 'wp_radio_imported_countries' ) );
		} else {
			$countries = $this->countries;
		}

		$dispatcher = new Dispatcher();

		//parsed csv text file path
		$file      = wr_fs()->can_use_premium_code__premium_only() ? 'wp-radio-stations-all.csv__premium_only.txt' : 'wp-radio-stations-free.csv.txt';
		$file_path = WP_RADIO_INCLUDES . "/admin/data/$file";

		//dispatched data from the parsed text file
		$data = $dispatcher->dispatch( $file_path );

		//columns header
		$header = array(
			'id',
			'station_name',
			'stream_url',
			'description',
			'logo',
			'genres',
			'language',
			'website',
			'facebook',
			'twitter',
			'wikipedia',
			'contact_address',
			'contact_phone',
			'contact_email',
			'contact_additional',
			'country_code',
		);

		$stations = [];

		//columns positions
		$field_pos = $this->get_field_pos_map( $header );

		//loop through the data
		foreach ( $data as $row ) {

			if ( empty( $row[15] ) || ! in_array( $row[15], $countries ) ) {
				continue;
			}

			$station = [];

			//loop through the row fields
			foreach ( $field_pos as $field => $pos ) {
				if ( isset( $row[ $pos ] ) ) {
					$station[ $field ] = $row[ $pos ];
				}
			}

			$stations[] = $station;
		}


		//offset
		$last_countries = get_option( 'wp_radio_last_selected_countries' );
		$offset         = $countries == $last_countries ? get_option( 'wp_radio_import_offset' ) : 0;
		update_option( 'wp_radio_last_selected_countries', $countries );

		$length   = 10;
		$stations = array_slice( $stations, $offset, $length );

		if ( ! empty( $stations ) ) {

			$this->import_stations( $stations );

			$count = count( $stations );

			if ( $count < $length ) {
				$length = $count;
			}

			$offset = $offset + $length;

			update_option( 'wp_radio_import_offset', $offset );

		} else {
			$response['done'] = true;

			if ( $this->update ) {
				$response['update'] = true;
			}

			update_option( 'wp_radio_imported_countries', array_merge( $countries, (array) get_option( 'wp_radio_imported_countries' ) ) );
			update_option( 'wp_radio_import_offset', 0 );
		}

		$response['imported'] = $offset;

		return $response;

	}

	function import_stations( $stations ) {
		$defaults = array(
			'station_name'       => '',
			'stream_url'         => '',
			'description'        => '',
			'logo'               => '',
			'genres'             => '',
			'language'           => '',
			'website'            => '',
			'facebook'           => '',
			'twitter'            => '',
			'wikipedia'          => '',
			'contact_address'    => '',
			'contact_phone'      => '',
			'contact_email'      => '',
			'contact_additional' => '',
			'country_code'       => '',
		);

		foreach ( $stations as $station ) {

			$station = array_merge( $defaults, $station );

			$title   = sanitize_text_field( $station['station_name'] );
			$content = sanitize_textarea_field( $station['description'] );

			//country
			$country    = trim( $station['country_code'] );
			$country_id = '';
			if ( ! empty( $country ) ) {

				$term = get_term_by( 'slug', $country, 'radio_country' );

				$country_id = $term->term_id;
			}

			$tax_input = [
				'radio_country' => [ $country_id ],
				'radio_genre'   => $station['genres'],
			];

			//social links
			$social_links = [];
			if ( ! empty( $station['website'] ) ) {
				$social_links[] = [
					'name' => __( 'Website', 'wp-radio' ),
					'href' => esc_url( $station['website'] ),
				];
			}

			if ( ! empty( $station['facebook'] ) ) {
				$social_links[] = [
					'name' => __( 'Facebook', 'wp-radio' ),
					'href' => esc_url( $station['facebook'] ),
				];
			}

			if ( ! empty( $station['twitter'] ) ) {
				$social_links[] = [
					'name' => __( 'Twitter', 'wp-radio' ),
					'href' => esc_url( $station['twitter'] ),
				];
			}

			if ( ! empty( $station['wikipedia'] ) ) {
				$social_links[] = [
					'name' => __( 'Wikipedia', 'wp-radio' ),
					'href' => esc_url( $station['wikipedia'] ),
				];
			}

			$meta_input = array(
				'stream_url'         => esc_url( $station['stream_url'] ),
				'logo'               => esc_url( $station['logo'] ),
				'language'           => sanitize_text_field( $station['language'] ),
				'social-links'       => $social_links,
				'contact_address'    => sanitize_textarea_field( $station['contact_address'] ),
				'contact_phone'      => sanitize_text_field( $station['contact_phone'] ),
				'contact_email'      => sanitize_text_field( $station['contact_email'] ),
				'contact_additional' => sanitize_textarea_field( $station['contact_additional'] ),
			);

			if ( $this->station_exist( $station['station_name'], $station['country_code'] ) ) {
				continue;
			}

			$post_id = wp_insert_post( array(
				'post_type'    => 'wp_radio',
				'post_title'   => $title,
				'post_content' => $content,
				'post_status'  => 'publish',
				'tax_input'    => $tax_input,
				'meta_input'   => $meta_input,
			) );

		}
	}

	function station_exist( $station_name, $country_code ) {
		$station = get_page_by_title( $station_name, OBJECT, 'wp_radio' );

		if ( $station ) {
			$country = wp_get_post_terms( $station->ID, 'radio_country' );

			if ( $country and is_array( $country ) ) {
				if ( $country_code == $country[0]->slug ) {
					return true;
				}
			}
		}

		return false;
	}

	function get_field_pos_map( $header ) {
		// Start all fields with invalid index.
		$fields = array(
			'station_name'       => - 1,
			'stream_url'         => - 1,
			'description'        => - 1,
			'logo'               => - 1,
			'genres'             => - 1,
			'language'           => - 1,
			'website'            => - 1,
			'facebook'           => - 1,
			'twitter'            => - 1,
			'wikipedia'          => - 1,
			'contact_address'    => - 1,
			'contact_phone'      => - 1,
			'contact_email'      => - 1,
			'contact_additional' => - 1,
			'country_code'       => - 1,
		);

		// Get the index of each field.
		foreach ( $header as $index => $field ) {
			if ( isset( $fields[ $field ] ) ) {
				$fields[ $field ] = $index;
			}
		}

		return $fields;
	}

	function insert_country_terms() {

		if ( get_option( 'wp_radio_country_terms_inserted', false ) ) {
			return;
		}

		$countries = array_change_key_case( wp_radio_get_country_list() );

		foreach ( $countries as $slug => $term ) {

			if ( get_term_by( 'slug', $slug, 'radio_country' ) ) {
				continue;
			}

			wp_insert_term( $term['country'], 'radio_country', [
				'slug' => $slug
			] );

		}

		update_option( 'wp_radio_country_terms_inserted', true );

	}


}