<?php

// Add the custom meta box
add_action('add_meta_boxes', function () {
    add_meta_box(
        'city_parameter',
        'City Parameter Field',
        'city_parameter_field_callback',
        ['post', 'page'],
        'normal',
        'high'
    );
});


function city_parameter_field_callback($post) {
    $value = get_post_meta($post->ID, '_city_parameter', true);
    wp_nonce_field('city_parameter_field_nonce', 'city_parameter_nonce');
    ?>
    <label style="margin-bottom: 8px; display: inline-block" for="city_parameter_field">City Parameter Value:
        <span style="cursor: help; border-bottom: 1px dotted #999;" title="Enter the city name that applies to {{city}} variable on post or page.">[?]</span>
    </label>
    <input type="text" name="city_parameter_field" value="<?php echo esc_attr($value); ?>" style="width:100%;" />
    <?php
}

add_action('save_post', function ($post_id) {
    if (!isset($_POST['city_parameter_nonce']) || !wp_verify_nonce($_POST['city_parameter_nonce'], 'city_parameter_field_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (isset($_POST['city_parameter_field'])) {
        update_post_meta($post_id, '_city_parameter', sanitize_text_field($_POST['city_parameter_field']));
    }
});


add_filter( 'the_content', 'replace_city_parameter', 99);
add_action( 'elementor/frontend/the_content',  'replace_city_parameter', 99);

function replace_city_parameter($content){
    $city_parameter = get_post_meta(get_the_ID(), '_city_parameter', true);
    if (!empty($city_parameter)) {
        $content = str_replace('{{city}}', $city, $content);
    }
    return $content;
}
