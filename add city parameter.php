<?php

add_filter( 'the_content', 'replace_city_parameter', 99);
add_action( 'elementor/frontend/the_content',  'replace_city_parameter', 99);

function replace_city_parameter($content){
    if( class_exists('ACF') ) {
        $city = get_field( "city_name" );
        if(!empty($city)){
            $content = str_replace('{{city}}', $city, $content);
        }
        return $content;
    }
}
