<?php
/*

  Exibit Model

  Camada de interação com o banco.

  Cadastra as fontes e os vetores.

*/

//Cadastro dos vetores
function exibit_vetores_model ( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['exibit_nonce'] ) || !wp_verify_nonce( $_POST['exibit_nonce'], 'exibit_metabox_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );

    //Vetores
    if( isset( $_POST['exibit_preview'] ) ) {
        update_post_meta( $post_id, 'texto_meta_box', wp_kses( $_POST['exibit_preview'], $allowed ) );
    }
}
add_action( 'save_post', 'exibit_vetores_model' );

//Cadastro das fontes
function exibit_fontes_model ( $post_id ) {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['exibit_nonce'] ) || !wp_verify_nonce( $_POST['exibit_nonce'], 'exibit_fontes_metabox_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );

    if( isset( $_FILES['exibit_fonte_upload_meta'] ) ) {

        $fonte = $_FILES['exibit_fonte_upload_meta'];

        $target_dir = wp_upload_dir()['url'] . "/fontes";
        $target_file = $target_dir . '/'. basename( $_fonte['name'] );
        $allowFile = 0;
        $supported_types = [
            'font/ttf',
            'font/otf'
        ];

        //A extensão do arquivo é suportada?
        foreach ( $supported_types as $type ) {
            if ( $fonte['type'] === $type ) {
                $allowFile++;
            }
        }

        if ( $allowFile ) {
            wp_die( $fonte['type'] . ' não é uma extensão suportada!' );
        }
        if ( file_exists( $target_file ) ) {
            wp_die( 'Esse arquivo já existe no site!' );
        }

        if ( move_uploaded_file($fonte['tmp_name'], $target_file) ) {
            update_post_meta( $post_id, 'exibit_fonte_upload_meta', wp_kses( $target_file, $allowed ) );
        } else {
            wp_die( 'Algo de errado aconteceu' );
        }
    }
}
add_action( 'save_post', 'exibit_fontes_model' );
