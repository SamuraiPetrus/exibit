<?php
/*

  Exibit Model

  Camada de interação com o banco.

*/

function exibit_model ( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['exibit_nonce'] ) || !wp_verify_nonce( $_POST['exibit_nonce'], 'exibit_metabox_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );

    if( isset( $_POST['exibit_preview'] ) ) {
        update_post_meta( $post_id, 'texto_meta_box', wp_kses( $_POST['exibit_preview'], $allowed ) );
    }
}

add_action( 'save_post', 'exibit_model' );
