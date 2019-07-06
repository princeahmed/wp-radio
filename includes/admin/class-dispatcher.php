<?php

namespace Prince\WP_Radio\Admin;

/**
 * CSV Parser.
 */
class Dispatcher {

	/**
	 * Parser options.
	 *
	 * @var array
	 */
	protected $options = array(
		'delimeter' => ',',
		'enclosure' => '"',
		'escape'    => "\\",
	);

	/**
	 * Class constructor.
	 *
	 * @param array $options Parser options
	 */
	public function __construct( $options = array() ) {
		$this->options = array_merge( $this->options, $options );
		$this->options = apply_filters( 'wp_radio_parser_options', $this->options );
	}

	/**
	 * Parses a CSV file.
	 *
	 * @param string $filepath The CSV filepath
	 *
	 * @return array|\WP_Error Returns parsed CSV in array on success, WP_Error
	 *                        on error
	 */
	public function dispatch( $filepath ) {
		$data = '';

		if ( file_exists( $filepath ) ) {
			$data = $this->read_file( $filepath );
		} else {
			return new \WP_Error(
				'wp_radio_parser_invalid_file',
				sprintf( __( 'File <code>%s</code> does not exist', 'wp-radio' ), $filepath )
			);
		}

		if ( ! $data ) {
			return new \WP_Error(
				'wp_radio_parser_no_data',
				sprintf( __( 'No data to parse from <code>%s</code>', 'wp-radio' ), $filepath )
			);
		}

		return $data;
	}

	/**
	 * Reads CSV file.
	 *
	 * @param string $filepath The CSV filepath
	 *
	 * @return array|\WP_Error Return data from file on success, WP_Error on error.
	 */
	protected function read_file( $filepath ) {

		if ( is_readable( $filepath ) ) {

			if ( ! ( $fh = fopen( $filepath, 'r' ) ) ) {
				return new \WP_Error(
					'wp_radio_parser_fopen_file_failed',
					sprintf( __( 'Unable to open file <code>%s</code>', 'wp-radio' ), $filepath )
				);
			}

			$data = [];
			$data[] = fgetcsv( $fh, 0, $this->options['delimeter'], $this->options['enclosure'], $this->options['escape'] );

			while ( 1 ) {
				$row = fgetcsv( $fh, 0, $this->options['delimeter'], $this->options['enclosure'], $this->options['escape'] );

				if ( false !== $row ) {
					$data[] = $row;
				} else {
					break;
				}

			}

			fclose( $fh );


			return $data;
		}

		return new \WP_Error(
			'wp_radio_parser_unreadable_file',
			sprintf( __( 'File <code>%s</code> is not readable', 'wp-radio' ), $filepath )
		);
	}
}
