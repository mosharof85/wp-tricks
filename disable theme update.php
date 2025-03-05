function AS_disable_plugin_updates( $value ) {
   $pluginsNotUpdatable = [
    'astra-addon/astra-addon.php'
  ];

  if ( isset($value) && is_object($value) ) {
    foreach ($pluginsNotUpdatable as $plugin) {
        if ( isset( $value->response[$plugin] ) ) {
            unset( $value->response[$plugin] );
        }
      }
  }
  return $value;
}
add_filter( 'site_transient_update_plugins', 'AS_disable_plugin_updates' );

function AS_disable_theme_updates( $value ) {
    $themesNotUpdatable = [
        'astra'
    ];

    if ( isset($value) && is_object($value) ) {
        foreach ($themesNotUpdatable as $theme) {
            if ( isset( $value->response[$theme] ) ) {
                unset( $value->response[$theme] );
            }
        }
    }
    return $value;
}
add_filter( 'site_transient_update_themes', 'AS_disable_theme_updates' );
