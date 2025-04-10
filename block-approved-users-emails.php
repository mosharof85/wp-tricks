<?php

add_filter('new_user_approve_approve_user_subject', function ($subject){
    return 'Registrierung genehmigt';
});

add_filter('new_user_approve_deny_user_subject', function ($subject){
    return 'Blocked Emails';
});

add_filter('wp_mail', function ($args) {
    $blocked_subject = 'Blocked Emails';
    if (isset($args['subject']) && $args['subject'] === $blocked_subject) {
        $args['to'] = [];
    }
    $args['message'] = preg_replace('/\bUsername:\s/', '', $args['message']);

    return $args;
});
