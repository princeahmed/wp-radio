<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit();

get_header();

$layout = prince_get_option( 'template_layout', 'left-sidebar' );
?>

    <section id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="wp-radio-listing <?php echo $layout ?>">

				<?php

				if ( is_tax() ) {
					$term    = get_queried_object();
					$heading = '';

					if ( is_tax( 'radio_country' ) ) {
						$active  = $term->slug;
						$heading .= '<sapn class="country">' . ucfirst( $term->name ) . '</sapn>';
					} elseif ( is_tax( 'radio_genre' ) ) {

						if ( ! empty( $_REQUEST['country'] ) ) {
							$country_term = wp_radio_get_country( sanitize_key( $_REQUEST['country'] ) );
							$active       = $country_term->slug;
							$heading      .= ! empty( $country_term ) ? '<a href="' . get_term_link( $country_term->term_id ) . '" class="country">' . $country_term->name . '</a>' : '';
						}

						$heading .= ! empty( $term ) ? '<span class="genre"><i class="dashicons dashicons-arrow-right-alt"></i> ' . ucfirst( $term->name ) . '</span>' : '';
					}
				}

				printf( '<h2 class="wp-radio-page-title"> <img src="%s">  %s <span class="station-txt"> <i class="dashicons dashicons-arrow-right-alt"></i> %s</span></h2>',
                    wp_radio_get_country_image_url($active, 48), $heading, __( 'Radio Stations', 'wp_radio' ) );

				if ( 'full-width' != $layout ) {
					wp_radio_get_template( 'sidebar', [ 'active' => $active ] );
				}
				?>

                <div class="wp-radio-listing-main">
					<?php

					while ( have_posts() ) {
						the_post();
						wp_radio_get_template( 'listing/listing-loop', [ 'post' => get_post( get_the_id() ) ] );

					}//End of the while loop

					?>

                    <div class="wp-radio-pagination">
						<?php
						the_posts_pagination(
							array(
								'mid_size'  => 3,
								'prev_text' => sprintf( '<i class="dashicons dashicons-arrow-left-alt"></i> %s', __( 'Previous', 'wp-radio' ) ),
								'next_text' => sprintf( '%s <i class="dashicons dashicons-arrow-right-alt"></i>', __( 'Next', 'wp-radio' ) ),
							)
						);
						?>
                    </div>

                </div><!-- .wp-radio-listing -->
            </div>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php

get_footer();
