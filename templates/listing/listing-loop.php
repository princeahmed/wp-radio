<?php
/* Block direct access */
defined( 'ABSPATH' ) || exit();

$stream = wp_radio_get_stream_data( $post->ID );

?>

<div class="wp-radio-listing" id="<?php echo $post->ID; ?>" data-url="<?php echo $stream['mp3']; ?>">
    <div class="listing-thumbnail">
		<?php printf( '<a href="%s"><img src="%s" alt="%s"> </a>', $stream['url'], $stream['poster'], $stream['title'] ) ?>
    </div>
    <div class="listing-details">

        <div class="listing-heading">
            <a href="<?php echo $stream['url'] ?>" class="station-name"><?php echo $stream['title']; ?></a>
            <span id="play-<?php echo $post->ID ?>" class="wp-radio-player-play-pause dashicons dashicons-controls-play"
                  title="<?php _e( 'Play', 'wp-radio' ); ?>"
                  data-stream='<?php echo json_encode( $stream ); ?>'></span>
        </div>

        <div class="now-playing">
            <i class="dashicons dashicons-format-audio"></i> <span><?php _e( 'Playing', 'wp-radio' ); ?>: </span>
            <span class="stream-title"></span>
        </div>

    </div>
</div>