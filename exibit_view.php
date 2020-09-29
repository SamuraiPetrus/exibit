<?php
/*

  Exibit View

  Camada de apresentação.

*/

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
  ?>
    <link rel="stylesheet" href="<?=plugins_url("assets/css/index.css", __FILE__)?>">
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
            <button id="exibit-vetor" type="button" class="button tagadd" name="button">Adicionar vetor</button>
            <button type="button" name="button" class="button tagadd"><input type="hidden" name="MAX_FILE_SIZE" value="30000" /><input id="exibit_preview" type="file" accept="image/*" class="upload_preview" name="exibit_preview" required />Upload da imagem</button>
            <button id="exibit-reset" type="button" class="button tagadd exclude" name="button" disabled>Resetar</button>
        </div>
        <ul id="exibit_vetores" class="vetores"></ul>
        <div id="preview_box" class="previa desktop">
            <figcaption>624 x 585</figcaption>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
        <script type="module" src="<?=plugins_url("assets/js/index.js", __FILE__)?>"></script>
    </div>
  <?php
}
