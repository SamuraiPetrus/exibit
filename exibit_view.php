<?php
/*

  Exibit View

  Camada de apresentação.

*/

include_once 'exibit_templates.php';

add_action( "add_meta_boxes", "exibit_metabox_add" );

function exibit_metabox_add () {
    add_meta_box(
        "exibit",
        "Plus Order Fields - Editar os campos personalizados do produto",
        "exibit_html",
        "product",
        "normal",
        "high"
    );
}

function exibit_html ( $the_post ) {
    wp_nonce_field( 'exibit_metabox_nonce', 'exibit_nonce' );
    $exibit_fields = get_post_meta($the_post->ID, 'exibit_fields', true );
    $exibit_preview = get_post_meta($the_post->ID, 'exibit_preview', true);
    Exibit_Fontes( $exibit_fields['fontes'] );
  ?>
    <link rel="stylesheet" href="<?=plugins_url("assets/css/index.css", __FILE__)?>">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <div id="dialog-window">
        <h3>Você realmente deseja resetar a edição dos vetores?</h3>
        <button type="button" id="exibit-exit-option">Não</button>
        <button type="button" id="exibit-reset-option">Sim</button>
    </div>
    <div class="exibit-mask"></div>
    <div class="exibit">
        <div class="settings">
            <select id="exibit-display" name="exibit-display" disabled>
                <option value="exibit-display-for-desktop">Desktop</option>
                <option value="exibit-display-for-tablet">Tablet</option>
                <option value="exibit-display-for-mobile">Mobile</option>
            </select>
            <button id="exibit-vetor" type="button" class="button tagadd" name="button" disabled>Adicionar vetor</button>
            <button type="button" name="button" class="button tagadd"><input type="hidden" name="MAX_FILE_SIZE" value="30000" /><input id="exibit_preview" type="file" accept="image/*" class="upload_preview" name="exibit_vetor_preview" required />Upload da imagem</button>
            <button id="exibit-reset" type="button" class="button tagadd exclude" name="button" disabled>Resetar</button>
        </div>
        <ul id="exibit_vetores" class="vetores">
          <?php
              if ( is_array( $exibit_fields ) ) {
                  if ( count( $exibit_fields['vetor_ids'] ) > 0 ) {

                      echo '<script type="text/javascript">$("#exibit-display").prop("disabled", false);</script>';

                      for ( $i = 0; $i < count( $exibit_fields['vetor_ids'] ); $i++ ) {
                          Vetor_Template( $exibit_fields, $i );
                          Vetor_Script( $exibit_fields, $i );
                      }
                  }
              }
          ?>
        </ul>
        <div id="preview_box" class="previa desktop" display="desktop">
            <?php
                if ( is_array( $exibit_fields ) ) {
                    if ( count( $exibit_fields['vetor_ids'] ) > 0 ) {
                        for ( $i = 0; $i < count( $exibit_fields ); $i++ ) { ?>

                            <div id="vetor-<?= $exibit_fields['vetor_ids'][$i] ?>" class="vetor-previa"
                                data-x="<?= $exibit_fields['x_desktop'][$i] ?>"
                                data-y="<?= $exibit_fields['y_desktop'][$i] ?>"
                                vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>"
                                style="
                                  font-family: <?= get_the_title( $exibit_fields['fontes'][$i] ) ?>;
                                  transform: translate( <?= $exibit_fields['x_desktop'][$i] ?>px, <?= $exibit_fields['y_desktop'][$i] ?>px );
                                  color: <?= $exibit_fields['cores'][$i] ?>;
                                  font-size: <?= $exibit_fields['vetor_ids'][$i] ?>;
                                ">
                                <!-- Nome -->
                                <?= $exibit_fields['nomes'][$i] ?>
                            </div>

                        <?php }
                    }
                }
                if ( $exibit_preview ) {
                    echo '<img class="preview_box_image" draggable="false" src="'. $exibit_preview .'">';
                }
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script type="module" src="<?=plugins_url("assets/js/index.js", __FILE__)?>"></script>
    </div>
  <?php
}
