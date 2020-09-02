<?php
/**
 * Plugin Name: Exibit
 * Description: Um simples plugin para envio de campos personalizados.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 *
 */

//Classes do plugin
require "includes/vetor.php";

add_action("init", "_exibit_main");

function _exibit_main ( $exibit_methods ) {

  //Adicionando ENCTYPE
  add_action( 'post_edit_form_tag' , 'post_edit_form_tag' );

  function post_edit_form_tag( ) {
      echo ' enctype="multipart/form-data"';
  }

  add_action( "add_meta_boxes", "exibit_metabox_add" );
  function exibit_metabox_add () {
    add_meta_box(
      "exibit",
      "Editar vetores do produto",
      "exibit_html",
      "product",
      "normal",
      "high"
    );
  }

  function exibit_html ( $the_post ) {
    wp_nonce_field( 'exibit_metabox_nonce', 'exibit_nonce' );
    ?>
    <link rel="stylesheet" href="<?=plugins_url("assets/css/exibit.min.css", __FILE__)?>">
    <div class="exibit">
      <dialog id="window">
        <h3>Você realmente deseja resetar a edição dos vetores?</h3>
        <p>Caso Sim, todos os dados não salvos serão apagados permanentemente!</p>
        <button id="exit">Não</button>
        <button id="reset">Sim</button>
      </dialog>
      <div class="settings">
        <button id="exibit-vetor" type="button" class="button tagadd" name="button" disabled>Adicionar vetor</button>
        <button type="button" name="button" class="button tagadd"><input type="hidden" name="MAX_FILE_SIZE" value="30000" /><input id="exibit_preview" type="file" accept="image/*" class="upload_preview" name="exibit_preview" />Upload da imagem</button>
        <button id="exibit-reset" type="button" class="button tagadd exclude" name="button" disabled>Resetar</button>
      </div>
      <ul class="vetores"></ul>
      <div id="preview_box" class="previa">
        <figcaption>624 x 585</figcaption>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script type="text/javascript" src="<?=plugins_url("assets/js/exibit.min.js", __FILE__)?>"></script>
    </div>
    <?php
  }

  add_action( 'save_post', 'exibit_meta_box_save' );

  function exibit_meta_box_save( $post_id )
  {
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['exibit_nonce'] ) || !wp_verify_nonce( $_POST['exibit_nonce'], 'exibit_metabox_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    $allowed = array(
    'a' => array(
    'href' => array()
    )
    );

    if( isset( $_POST['exibit_preview'] ) )
    update_post_meta( $post_id, 'texto_meta_box', wp_kses( $_POST['exibit_preview'], $allowed ) );
  }

}
