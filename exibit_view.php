<?php

/*

  Exibit View

  Camada de apresentação.

*/

include_once "exibit_templates.php";

//Prévia

function exibit_preview_callback () {
    $the_post = get_queried_object();
    $exibit_fields = get_post_meta($the_post->ID, 'exibit_fields', true );

    if ( is_array( $exibit_fields ) ) {
        if ( array_key_exists( 'vetor_ids', $exibit_fields ) ) {
            Style_Interface();
        }
    }
}

add_action('woocommerce_before_single_product', 'exibit_preview_callback');

add_action('woocommerce_before_add_to_cart_button', function () {
    //Inputs do JavaScript
    $the_post = get_queried_object();
    $exibit_fields = get_post_meta($the_post->ID, 'exibit_fields', true );
    $exibit_preview = get_post_meta($the_post->ID, 'exibit_preview', true);

    if ( is_array( $exibit_fields ) ) {
        if ( array_key_exists( 'vetor_ids', $exibit_fields ) ) {
            Personalize_Interface( $exibit_preview, $exibit_fields );
        }
    }
});
