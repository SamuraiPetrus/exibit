<?php

/*

  Adicionando Custom Post Types

*/

add_action('init', 'exibit_font_post_type');

function exibit_font_post_type () {

    $labels = array(
        'name'                  => _x( 'Fontes', 'Post type general name', 'exibit_fontes' ),
        'singular_name'         => _x( 'Fonte', 'Post type singular name', 'exibit_fontes' ),
        'menu_name'             => _x( 'Fontes', 'Admin Menu text', 'exibit_fontes' ),
        'name_admin_bar'        => _x( 'Fonte', 'Add New on Toolbar', 'exibit_fontes' ),
        'add_new'               => __( 'Nova fonte', 'exibit_fontes' ),
        'add_new_item'          => __( 'Nova fonte', 'exibit_fontes' ),
        'new_item'              => __( 'Nova fonte', 'exibit_fontes' ),
        'edit_item'             => __( 'Editar fonte', 'exibit_fontes' ),
        'view_item'             => __( 'Ver fonte', 'exibit_fontes' ),
        'all_items'             => __( 'Todas as fontes', 'exibit_fontes' ),
        'search_items'          => __( 'Procurar fontes', 'exibit_fontes' ),
        'parent_item_colon'     => __( 'Fontes pai:', 'exibit_fontes' ),
        'not_found'             => __( 'Nenhuma fonte encontrada.', 'exibit_fontes' ),
        'not_found_in_trash'    => __( 'Nenhuma fonte encontrada na lixeira.', 'exibit_fontes' )
    );

    $args = [
        'labels' => $labels,
        'description' => 'Fontes utilizadas pelos vetores do plugin Exibit',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'exibit_fontes' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-editor-paste-text',
        'supports'           => array( 'title' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
        'show_in_rest'       => true
    ];

    register_post_type('exibit_fontes', $args);
}

add_action( 'add_meta_boxes', 'exibit_fontes_metabox' );

function exibit_fontes_metabox () {
    add_meta_box(
        'exibit_fontes_upload',
        'Upload da fonte',
        'exibit_fontes_upload_callback',
        'exibit_fontes'
    );
}

function exibit_fontes_upload_callback ( $the_post ) {
    wp_nonce_field( 'exibit_fontes_metabox_nonce', 'exibit_nonce' );

    $fonte = get_post_meta( $the_post->ID, 'exibit_fonte_upload_meta', true );

    // Exibir informações da fonte carregada.
    if ( $fonte ) {
        $fonte_info = pathinfo( $_SERVER['DOCUMENT_ROOT'] . parse_url( $fonte )['path'] );
        echo "<h2><strong>Fonte atual:</strong> " . $fonte_info['filename'] . '.' . $fonte_info['extension'] . "</h2><a target='_blank' class='button' href='" . $fonte . "'>Baixar fonte atual</a>";
    }
?>
    <p>Formatos suportados: <strong>.ttf</strong> <strong>.otf</strong></p>
    <p>Tamanho máximo do arquivo: <strong>500KB</strong></p>
    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
    <input type="file" accept=".ttf, .otf" class="upload_preview" name="exibit_fonte_upload_meta" required />
<?php
}

add_action( 'rest_api_init', function () {
    register_rest_field(
        'exibit_fontes',
        'exibit_fonte_upload_meta', array(
            'get_callback' => 'get_post_meta_cb',
            'update_callback' => 'update_post_meta_cb',
            'schema' => null
        )
    );
});

function get_post_meta_cb( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name );
}

function update_post_meta_cb( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}

// //Incluindo fontes nas heads do site.
// $heads = [
//   'wp_head', //Head do cliente
//   'admin_head' // Head do admin
// ];
//
// foreach ( $heads as $head ) {
//     if ( $head == 'admin_head' ) {
//         //Fontes no painel de admnistração
//         add_action( $head, function() {
//           if ( isset($_GET['post']) && isset($_GET['action']) ) {
//               //Página de edição de post
//               print_font_faces();
//           }
//         });
//     } else if ( $head == 'wp_head' ) {
//         //Fontes no cliente
//     }
// }
//
// function print_font_faces () {
//     $args = [
//       "post_type" => "exibit_fontes",
//       "posts_per_page" => -1
//     ];
//
//     $fontes = get_posts($args);
//
//     foreach ( $fontes as $fonte ) {
//         $url = get_post_meta( $fonte->ID, 'exibit_fonte_upload_meta', true );
//         echo '
//             <style type="text/css" media="screen, print">
//
//                 @font-face {
//                     font-family: '.$fonte->post_title.';
//                     src: url("'.$url.'");
//                     font-weight: normal;
//                 }
//
//             </style>
//         ';
//     }
// }
