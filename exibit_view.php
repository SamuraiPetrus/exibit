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
            Style_User_Interface();
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
            Preview_Switch_User_Interface( $exibit_preview, $exibit_fields );
            ?> <div class="exibit-vetores"> <?php
                for ( $i =0; count( $exibit_fields['vetor_ids'] ) > $i; $i++ ) {
                    Inputs_User_Interface( $exibit_fields, $i );
                }
            ?> </div> <?php
        }
    }
});
