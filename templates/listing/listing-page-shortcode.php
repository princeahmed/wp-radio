<?php
/* Block direct access */
defined( 'ABSPATH' ) || exit();

$layout = prince_get_option( 'template_layout', 'left-sidebar' );

?>

<div class="wp-radio-listings <?php echo $layout ?>">
	<?php

	if ( 'full-width' != $layout ) {
		wp_radio_get_template( 'sidebar' );
	}

	?>
    <div class="wp-radio-listings-main">
		<?php

		$country = ! empty( $country ) ? $country : '';

		$posts = wp_radio_get_stations_by_country( $country );

		if ( ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			wp_radio_get_template( 'listing/listing-loop', [ 'post' => $post ] );
		}

		?>

        <div class="wp-radio-pagination">
            <nav id="post-navigation" class="navigation pagination" role="navigation" aria-label="Post Navigation">
                <div class="nav-links">
					<?php
					global $wp_radio_args;

					$wp_radio_query = wp_radio_get_stations( $wp_radio_args, true );
					$paged          = ! empty( $_REQUEST['paginate'] ) ? intval( $_REQUEST['paginate'] ) : '';
					$translated     = __( 'Page', 'wp-radio' ); // Supply translatable string

					echo paginate_links( array(
						'format'             => '?paginate=%#%',
						'current'            => max( 1, $paged ),
						'total'              => $wp_radio_query->max_num_pages,
						'before_page_number' => '<span class="screen-reader-text">' . $translated . ' </span>',
						'mid_size'           => 1,
						'prev_text'          => sprintf( '<i class="dashicons dashicons-arrow-left-alt"></i> %s', __( 'Previous', 'wp-radio' ) ),
						'next_text'          => sprintf( '%s <i class="dashicons dashicons-arrow-right-alt"></i>', __( 'Next', 'wp-radio' ) ),
					) );

					}
					?>
                </div>
            </nav>
        </div>
    </div>
</div>
