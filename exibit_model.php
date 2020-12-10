<?php
/*

  Exibit Model

  Camada de interação com o banco.

  Cadastra as fontes e os vetores.

*/

//Cadastro dos vetores
function exibit_vetores_model ( $post_id ) {

    //Verificações de segurança
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if( !isset( $_POST['exibit_nonce'] ) || !wp_verify_nonce( $_POST['exibit_nonce'], 'exibit_metabox_nonce' ) ) return;
    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
        'a' => array(
            'href' => array()
        )
    );

    $exibit_vetor_fields = [
        'vetor_ids'         => 'exibit_vetor_id',
        'nomes'             => 'exibit_vetor_nome',
        'max_chars'         => 'exibit_vetor_max_char',
        'fontes'            => 'exibit_vetor_fontes',
        'cores'             => 'exibit_vetor_cor',
        'tamanhos_mobile'   => 'exibit_vetor_tamanho_mobile',
        'tamanhos_tablet'   => 'exibit_vetor_tamanho_tablet',
        'tamanhos_desktop'  => 'exibit_vetor_tamanho_desktop',
        'x_mobile'          => 'exibit_vetor_x_mobile',
        'x_tablet'          => 'exibit_vetor_x_tablet',
        'x_desktop'         => 'exibit_vetor_x_desktop',
        'y_mobile'          => 'exibit_vetor_y_mobile',
        'y_tablet'          => 'exibit_vetor_y_tablet',
        'y_desktop'         => 'exibit_vetor_y_desktop',
    ];

    $exibit_fields = [];
    foreach ( $exibit_vetor_fields as $key => $value ) {
        if ( isset($_POST[$value]) ) {
            $exibit_fields[$key] = $_POST[$value];
        }
    }

    if ( count($exibit_fields) > 0 ) {
        update_post_meta( $post_id, 'exibit_fields', $exibit_fields );
    }

    //Upload da imagem de fundo.
    if ( isset( $_FILES['exibit_vetor_preview'] ) ) {

        $preview = $_FILES['exibit_vetor_preview'];

        if ( $preview['error'] === 0 ) {

            $previews_path     = "wp-content/uploads/previews";
            $target_dir      = get_home_path() . $previews_path;
            $target_file     = $target_dir     . '/' . basename( $preview['name'] );
            $target_url      = get_home_url()  . '/' . $previews_path . '/' . basename( $preview['name'] );
            $allowFile       = 0;
            $supported_types = [
                'image/png',
                'image/jpeg'
            ];

            foreach ( $supported_types as $type ) {
                if ( $preview['type'] === $type ) { //O formato do arquivo é suportado?
                    $allowFile++;
                }
            }

            if ( !$allowFile ) { wp_die( $preview['type'] . ' não é uma extensão suportada! <br> <a href="javascript:history.back()"><-Voltar</a>' ); }

            if ( ! is_dir( $target_dir ) ) {
                mkdir( $target_dir );
            }

            if ( move_uploaded_file($preview['tmp_name'], $target_file) ) {

                update_post_meta( $post_id, 'exibit_preview', wp_kses( $target_url, $allowed) );

            } else {
                wp_die( 'Algo de errado aconteceu. <br> <a target="_blank" href="https://github.com/SamuraiPetrus/exibit/issues/new">Reportar</a> <a href="javascript:history.back()"><-Voltar</a>' );
            }

        } else {
            //Lidando com erros no arquivo.
            switch ( $preview['error'] ) {
                case 1 :
                case 2 :
                    $message = "O arquivo enviado excede o limite definido de <strong>500KB</strong>.";
                    break;
                case 3 :
                    $message = "O upload do arquivo foi feito parcialmente.";
                    break;
                case 6 :
                    $message = "Pasta temporária ausente.";
                    break;
                case 7 :
                    $message = "Falha em escrever o arquivo em disco.";
                    break;
                case 8 :
                    $message = "Uma extensão do PHP interrompeu o upload do arquivo.";
                    break;
                default :
                    return;
            }
            wp_die( $message . '<br> <a href="javascript:history.back()"><-Voltar</a>' );
        }
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
