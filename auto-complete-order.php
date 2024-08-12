<?php

add_action( 'woocommerce_thankyou', function ($order_id){
    if ( ! $order_id ) {
        return;
    }
    
    $order = wc_get_order( $order_id );
    
    if(!empty($order->get_date_paid())){
        if($order->has_status( array( 'processing', 'on-hold' ) )){
            $order->update_status( 'completed', 'Order auto-completed after payment.' );
        }
    }
} );
