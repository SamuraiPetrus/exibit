<?php
/**
* Plugin Name: Exibit
* Description: Um simples plugin para envio de campos personalizados.
* Version: 1.0.0
* Author: Petrus Nogueira
*/

//Configurações iniciais

include_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( is_plugin_active('woocommerce/woocommerce.php') ) {

    add_action('post_edit_form_tag', 'add_post_enctype');

    function add_post_enctype() {
        echo ' enctype="multipart/form-data"';
    }

    //Arquitetura
    include_once "exibit_fontes.php";
    include_once "exibit_admin.php";
    include_once "exibit_model.php";
    include_once "exibit_view.php";

} else {
    wp_die('O plugin depende do <a href="https://br.wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> para funcionar! <br> <a href="javascript:history.back()"> << Voltar</a>');
}
