<?php
/* Block direct access */
defined( 'ABSPATH' ) || exit();
?>

<div class="sidebar-toggle">
    <span class="dashicons dashicons-menu-alt"></span> <?php _e( 'Countries', 'wp-radio' ); ?>
</div>

<div class="wp-radio-sidebar">

    <div class="sidebar-header <?php echo ! empty( $_REQUEST['keyword'] ) ? 'search' : ''; ?>">
        <div class="title"><?php _e( 'Country', 'wp-radio' ); ?></div>
        <div class="filter">
            <form action="" method="get">
                <input type="search" name="keyword" placeholder="Enter station name" required value="<?php echo ! empty( $_REQUEST['keyword'] ) ? esc_attr( $_REQUEST['keyword'] ) : ''; ?>">
            </form>
            <span class="dashicons dashicons-search"></span>
        </div>
    </div>

    <ul class="sidebar-listing">
		<?php

		$countries = get_terms( [ 'taxonomy' => 'radio_country' ] );

		if ( ! empty( $countries ) ) {
			$i = 0;
			foreach ( $countries as $country ) {

				if ( $i < 10 ) {
					$image = '<img src="' . wp_radio_get_country_image_url( $country->slug ) . '">';
				} else {
					$image = '<img class="wp-radio-lazy-load" data-src="' . wp_radio_get_country_image_url( $country->slug ) . '">';
				}

				printf( '<li %s ><a href="%s">%s %s</a></li>', ! empty( $active ) && $country->slug == $active ? 'class="active"' : '', get_term_link($country->term_id), $image, $country->name );

				$i ++;

			}//End of the loop
		}else{
		    _e('No Country added yet!', 'wp-radio');
        }
		?>
    </ul>

    <div class="listing-filter"></div>
</div>