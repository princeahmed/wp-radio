<?php
/* Block direct access */
defined( 'ABSPATH' ) || exit();
?>

<div id="wp-radio-player" class="wp-radio-player full-width">
    <div id="wp-radio-player-media" class="wp-radio-player-media"></div>

    <!--Details-->
    <div id="wp-radio-player-details" class="wp-radio-player-details">

        <a href="javascript:void(0)" class="wp-radio-player-url">
            <img src="" class="wp-radio-player-thumbnail">
        </a>

        <a href="javascript:void(0)" class="wp-radio-player-url wp-radio-player-title"></a>

        <div class="wp-radio-player-now-playing">
            <span><i class="dashicons dashicons-format-audio"></i></span>
            <marquee id="wp-radio-player-stream-title"></marquee>
        </div>
    </div>

    <!--Controls-->
    <div id="wp-radio-player-controls" class="wp-radio-player-controls">

        <!--Play Pause Control-->
        <div class="wp-radio-player-controls-tools">
            <span id="wp-radio-player-prev" class="wp-radio-player-prev dashicons dashicons-controls-back"
                  title="<?php _e( 'Previous', 'wp-radio' ); ?>"></span>
            <span id="wp-radio-player-play-pause"
                  class="wp-radio-player-play-pause dashicons dashicons-controls-play"
                  title="<?php _e( 'Play', 'wp-radio' ); ?>"></span>
            <span id="wp-radio-player-next" class="wp-radio-player-next dashicons dashicons-controls-forward"
                  title="<?php _e( 'Next', 'wp-radio' ); ?>"></span>
        </div>

        <!--Volume Control-->
        <div class="wp-radio-player-volume">

            <div class="wp-radio-player-volume-hover">
                <span id="wp-radio-player-volume-value" class="wp-radio-player-volume-value"></span>
                <div id="wp-radio-player-volume-bar" class="wp-radio-player-volume-bar"></div>
                <span class="ui-slider-range ui-slider-handle" style="display: none !important;"></span>
            </div>

            <span id="wp-radio-player-volume-icon"
                  class="wp-radio-player-volume-icon dashicons dashicons-controls-volumeon"></span>
        </div>
    </div>

    <div class="wp-radio-player-toggle dashicons dashicons-arrow-down-alt2"></div>
</div>