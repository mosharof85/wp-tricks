<?php
/**
 * This filter will help you change content on the frontend
 */

add_filter('the_content', function($content){
    $replace = array(
        'ß' => 'ss'
    );
    return str_replace(array_keys($replace), $replace, $content);
},99);

/**
 * This filter will help you change content on the frontend
 * if the site is built with elementor
 */

add_filter('elementor/frontend/the_content', function($content){
    $replace = array(
        'ß' => 'ss'
    );
    return str_replace(array_keys($replace), $replace, $content);
},99);

add_filter('the_content', function($content){
    $replace = array(
        'Share With Friends' => 'Dieses Event teilen',
        'Date And Time' => 'Datum und Uhrzeit'
    );

    $pattern = '/<div class="wpem-event-date-time">\s*(.*?)\s*<\/div>/s';

    $result = preg_replace_callback($pattern, function($matches) {
        $newContent = str_replace('to', 'bis', $matches[1]);
        return $newContent . $matches[2];
    }, $content);
    
    return str_replace(array_keys($replace), $replace, $result);
},99);


/***
 * This script is very powerful. But it creates problem with wp-rocket
 */

add_action( 'init', function (){
    ob_start();
} );


add_action('shutdown', function() {
    $final = '';

    $levels = ob_get_level();

    for ($i = 0; $i < $levels; $i++) {
        $final .= ob_get_clean();
    }

    if(is_admin()){
        echo $final;
    }
    else{
        echo apply_filters('final_output', $final);
    }
}, 0);

add_filter('final_output', function($output) {
    $replace = array(
        'Find out more' => 'Zur Veranstaltung',
        'List' => 'Liste',
        'Month' => 'Monat',
        'Finde' => 'Suchen',
    );
    return str_replace(array_keys($replace), $replace, $output);;
});
