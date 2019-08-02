<?php

if ( !function_exists( 'wr_fs' ) ) {
    // Create a helper function for easy SDK access.
    function wr_fs()
    {
        global  $wr_fs ;
        
        if ( !isset( $wr_fs ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wr_fs = fs_dynamic_init( array(
                'id'             => '4227',
                'slug'           => 'wp-radio',
                'type'           => 'plugin',
                'public_key'     => 'pk_6acab182f004d200ec631d063d6c4',
                'is_premium'     => false,
                'premium_suffix' => 'Premium',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'menu'           => array(
                'slug' => 'edit.php?post_type=wp_radio',
            ),
                'is_live'        => true,
            ) );
        }
        
        return $wr_fs;
    }
    
    // Init Freemius.
    wr_fs();
    // Signal that SDK was initiated.
    do_action( 'wr_fs_loaded' );
}
