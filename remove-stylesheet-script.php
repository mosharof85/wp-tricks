<?php
add_action( 'wp_print_styles', function (){
    global $wp_scripts;
    foreach ( $wp_scripts->queue as $handle )
    {
        if($handle == 'aos'){
            $wp_scripts->remove( $handle );
        }
    }
}, 0 );

add_action( 'wp_enqueue_scripts', function (){
    wp_dequeue_style( 'aos' );
},99999 );
