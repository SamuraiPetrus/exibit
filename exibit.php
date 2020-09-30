<?php
/**
* Plugin Name: Exibit
* Description: Um simples plugin para envio de campos personalizados.
* Version: 1.0.0
* Author: Petrus Nogueira
*/

//Configurações iniciais
add_action('post_edit_form_tag', 'add_post_enctype');

function add_post_enctype() {
    echo ' enctype="multipart/form-data"';
}

//Arquitetura
include_once "includes/vetor.php";
include_once "exibit_fontes.php";
include_once "exibit_view.php";
include_once "exibit_model.php";
