<?php

/* Block direct access */
defined( 'ABSPATH' ) || exit();


get_header();

//before min content
echo apply_filters( 'wp_radio_before_main_content', ' <section id="primary" class="content-area">
        <main id="main" class="site-main">' );

while ( have_posts() ) {
	the_post();

	$id         = get_the_ID();
	$stream_url = prince_get_meta( $id, 'stream_url' );
	$country    = wp_get_post_terms( $id, 'radio_country' );

	if ( is_array( $country ) ) {
		$country = $country[0];
	}

	?>

    <div class="wp-radio-single" id="<?php echo $id; ?>" data-stream-url="<?php echo $stream_url; ?>">
        <div class="wp-radio-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
						<?php
						printf( '<a href="%s"> <img src="%s"> %s </a>', get_term_link( $country->term_id ), wp_radio_get_country_image_url( $country->slug ), $country->name );
						?>

                    </li>
                    <li class="breadcrumb-item active" aria-current="page"> / <?php echo get_the_title(); ?> </li>
                </ol>
            </nav>

            <!--station poster-->
            <div class="wp-radio-thumbnail">
                <img src="<?php prince_echo_meta( $id, 'logo', WP_RADIO_ASSETS_URL . '/images/wp-radio-logo.png' ); ?>" alt="<?php echo get_the_title( $id ); ?>">
            </div>

            <div class="wp-radio-details">
				<?php the_title( '<h3 class="station-name">', '</h3>' ) ?>

				<?php


				/* genres */
				$genres = wp_get_post_terms( $id, 'radio_genre' );

				$country = get_the_terms( $id, 'radio_country' );

				$country = ! empty( $country ) ? $country[0]->slug : '';

				if ( ! empty( $genres ) ) {
					$genres = wp_list_pluck( $genres, 'name', 'term_id' );

					$genres_html = '<div class="genres"><span>Genres: </span>';
					foreach ( $genres as $term_id => $genre ) {
						$genres_html .= sprintf( '<a href="%s"><span>%s</span></a>', add_query_arg( 'country', $country, get_term_link( $term_id ) ), $genre );
					}
					$genres_html .= '</div>';
					echo $genres_html;
				}

				?>

                <div class="now-playing">
                    <i class="dashicons dashicons-format-audio"></i>
                    <span><strong><?php _e( 'Playing', 'wp-radio' ); ?>:</strong> </span>
                    <span class="stream-title"></span>
                </div>

                <div class="single-actions">
                    <span id="play-<?php echo $id ?>" class="wp-radio-player-play-pause dashicons dashicons-controls-play" title="Play" data-stream='<?php echo json_encode( wp_radio_get_stream_data( $id ) ); ?>'></span>
                </div>

            </div>

        </div>

        <div class="wp-radio-body">
            <p class="description"><?php echo get_the_content(); ?></p>
        </div>

        <div class="wp-radio-footer">
            <div class="wp-radio-info">
				<?php

				$links = prince_get_meta( $id, 'social-links' );

				if ( ! empty( $links ) ) {
					foreach ( $links as $link ) {
						$icon = 'external';
						if ( 'facebook' == strtolower( $link['name'] ) ) {
							$icon = 'facebook';
						} elseif ( 'twitter' == strtolower( $link['name'] ) ) {
							$icon = 'twitter';
						} elseif ( 'twitter' == strtolower( $link['name'] ) ) {
							$icon = 'twitter';
						}

						printf( '<a href="%s" target="_blank"><i class="dashicons dashicons-%s"></i> %s </a>', $link['href'], $icon, $link['name'] );
					}
				}

				$language = prince_get_meta( $id, 'language' );
				if ( ! empty( $language ) ) {
					echo '<a href="#" target="_blank"><i class="dashicons dashicons-translation"></i> ' . wp_radio_get_language( $language ) . '</a>';
				}

				?>

            </div>


        </div>

		<?php

		$contacts = [];

		$contacts['address']    = prince_get_meta( $id, 'contact_address' );
		$contacts['email']      = prince_get_meta( $id, 'contact_email' );
		$contacts['phone']      = prince_get_meta( $id, 'contact_phone' );
		$contacts['additional'] = prince_get_meta( $id, 'contact_additional' );

		$contacts = array_filter( $contacts );

		if ( ! empty( $contacts ) ) {

			?>

            <div class="station-contacts">
                <h3 class="contacts-title"><?php _e( 'Contacts', 'wp-radio' ); ?></h3>
				<?php

				foreach ( $contacts as $contact ) {
					echo "<p>$contact</p>";
				}

				?>

            </div>
		<?php } ?>
    </div>

	<?php

	// Previous/next post navigation.
	the_post_navigation(
		array(
			'in_same_term' => true,
			'taxonomy'     => 'radio_country',
			'prev_text'    => '<span class="post-title"><i class="dashicons dashicons-arrow-left-alt"></i> %title </span>',
			'next_text'    => '<span class="post-title">%title <i class="dashicons dashicons-arrow-right-alt"></i></span>',
		)
	);


	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}

} // End of the loop.

echo apply_filters( 'wp_radio_after_main_content', ' </main></section>' );

get_footer();