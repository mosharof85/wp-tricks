add_action('init', function() {
	unload_textdomain('woocommerce');
	load_textdomain('woocommerce', WP_LANG_DIR . '/plugins/woocommerce-de_DE.mo');
}, 20);
