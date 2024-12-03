add_action('init', function() {
	unload_textdomain('woocommerce');
	load_textdomain('woocommerce', WP_LANG_DIR . '/plugins/woocommerce-de_DE.mo');
}, 20);


add_filter( 'doing_it_wrong_trigger_error', '__return_false' );
