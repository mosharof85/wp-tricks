foreach ($attributes as $attribute) {
        if ( isset( $_POST[$attribute['meta_field']] ) ) {
            $type = apply_filters( 'wpml_element_type', get_post_type( $post_id ) );
            $trid = apply_filters( 'wpml_element_trid', false, $post_id, $type );
            $translations = apply_filters( 'wpml_get_element_translations', array(), $trid, $type );
            foreach ( $translations as $lang => $translation ) {
                update_post_meta( $translation->element_id, $attribute['meta_field'], sanitize_text_field( $_POST[$attribute['meta_field']] ));
            }
//            update_post_meta( $post_id, $attribute['meta_field'], sanitize_text_field( $_POST[$attribute['meta_field']] ) );
        }
    }
