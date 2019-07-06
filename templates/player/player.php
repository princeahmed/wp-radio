<?php return; ?>
<div id="wp-radio-player" class="wp-radio-player">
    <div id="wp-radio-player-media" class="wp-radio-player-media"></div>

    <!--Details-->
    <div id="wp-radio-player-details" class="wp-radio-player-details">
        <a href="javascript:void(0)" class="wp-radio-player-url" title="">
            <img src="" class="wp-radio-player-thumbnail" alt="">
        </a>
        <a href="javascript:void(0)" class="wp-radio-player-url wp-radio-player-title" title=""></a>
    </div>

    <!--Controls-->
    <div id="wp-radio-player-controls" class="wp-radio-player-controls">

        <!-- Favorite Control -->
        <span id="wp-radio-player-favorite" class="wp-radio-player-favorite dashicons dashicons-star-empty"></span>

        <!--Play Pause Control-->
        <div class="wp-radio-player-controls-tools">
            <span id="wp-radio-player-prev" class="wp-radio-player-prev dashicons dashicons-controls-back"
                  data-station='{"title":"Previous", "mp3":"http://live.radiogoongoon.com:8888/stream/1/", "thumbnail":"https://cdn.onlineradiobox.com/img/logo/8/29208.v10.png"}'></span>
            <span id="wp-radio-player-play-pause"
                  class="wp-radio-player-play-pause dashicons dashicons-controls-play"></span>
            <span id="wp-radio-player-next" class="wp-radio-player-next dashicons dashicons-controls-forward"
                  data-station='{"url":"Next","title":"Next", "mp3":"http://149.56.195.94:8545/;stream.mp3", "thumbnail":"https://cdn.onlineradiobox.com/img/logo/7/29437.v3.png"}'></span>
        </div>

        <!--Volume Control-->
        <div class="wp-radio-player-volume">

            <div class="wp-radio-player-volume-hover">
                <span id="wp-radio-player-volume-value" class="wp-radio-player-volume-value"></span>
                <div id="wp-radio-player-volume-bar" class="wp-radio-player-volume-bar"></div>
            </div>

            <span id="wp-radio-player-volume-icon"
                  class="wp-radio-player-volume-icon dashicons dashicons-controls-volumeon"></span>
        </div>
    </div>
</div>