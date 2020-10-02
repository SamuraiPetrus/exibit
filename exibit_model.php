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

        $fonte           = $_FILES['exibit_fonte_upload_meta'];

        $fontes_path     = "wp-content/uploads/fontes";
        $target_dir      = get_home_path() . $fontes_path;
        $target_file     = $target_dir     . '/' . basename( $fonte['name'] );
        $target_url      = get_home_url()  . '/' . $fontes_path . '/' . basename( $fonte['name'] );
        $allowFile       = 0;
        $supported_types = [
            'font/ttf',
            'font/otf'
        ];

        //Checando se o arquivo atende os requisitos.
        if ( $fonte['size'] <= 500000 ) { // Tamanho do arquivo está dentro dos limites de tamanho?
            foreach ( $supported_types as $type ) {
                if ( $fonte['type'] === $type ) { //O formato do arquivo é suportado?
                    $allowFile++;
                }
            }
        } else {
            wp_die( 'Tamanho do arquivo excede o máximo de <strong>100KB</strong>. <br> <a href="javascript:history.back()"><-Voltar</a>' );
        }

        if ( !$allowFile ) { wp_die( $fonte['type'] . ' não é uma extensão suportada! <br> <a href="javascript:history.back()"><-Voltar</a>' ); }

        if ( ! is_dir( $target_dir ) ) {
            mkdir( $target_dir );
        } else {
            if ( file_exists( $target_file ) ) {
                wp_die( 'Esse arquivo já existe no site! <br> <a href="javascript:history.back()"><-Voltar</a>' );
            }
        }

        if ( move_uploaded_file($fonte['tmp_name'], $target_file) ) {

            update_post_meta( $post_id, 'exibit_fonte_upload_meta', wp_kses( $target_url, $allowed) );

        } else {
            wp_die( 'Algo de errado aconteceu. <br> <a target="_blank" href="https://github.com/SamuraiPetrus/exibit/issues/new">Reportar</a> <a href="javascript:history.back()"><-Voltar</a>' );
        }
    }
}
add_action( 'save_post', 'exibit_fontes_model' );
