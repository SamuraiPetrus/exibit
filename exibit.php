<?php
/**
 * Plugin Name: Exibit
 * Description: Crie um modelo de exibição Real Time para os seus produtos.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 *
 */

//Classes do plugin

add_action("init", "_exibit_main");

function _exibit_main ( $exibit_methods ) {
    
    //=========
    //Métodos
    //=========
    function construct_vectors( $exibit_panel ) {
        //Árvore de conteúdos que servirá de base para o laço abaixo
        $panel = $exibit_panel;
    
        $the_panel = [];
    
        //Gera o array principal vazio
        foreach ($panel as $p){
            array_push($the_panel, []);
        }
    
        //Laço que alimenta o array principal
        foreach ($panel as $vector) {
            $count = 0;

            if ( ! $vector == null ) {
                foreach ($vector as $v) {
                    array_push($the_panel[$count], $c);
                    $count++;
                }
            } else {
                return $panel;
            }
        }
    
        //Retorna o array principal com as informações
        return $the_panel;
    }

    function panel_state ( $panel ) {
        foreach ( $panel as $value ) {
            if ( gettype( $value ) == "array" ) {
                foreach ( $value as $v ) {
                    if ( $v == null ) return 0;
                }
            } else {
                return 0;
            }
        }
        
        return 1;
    }

    //Checar se WooCommerce está instalado no site
    $is_woocommerce_ready = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

    if ( $is_woocommerce_ready ) {
        //Criação do Metabox de exibição Real-Time em produtos.
        function exibit_metabox()
        {
            $screens = ["product"];
            foreach ($screens as $screen) {
                add_meta_box(
                    'exibit_id',           // Unique ID
                    'Exibição em Real Time',  // Box title
                    'exibit_html',  // Content callback, must be of type callable
                    $screen,                   // Post type
                    "advanced",
                    "high"
                );
            }
        }
    
        add_action('add_meta_boxes', 'exibit_metabox');
    
        function exibit_html ( $post ) {
            
            // Criando os elementos do painel
            $exibit_panel = [
                "nome" => get_post_meta($post->ID, '_nome_meta_key', true),
                "fonte" => array(
                    "family" => get_post_meta($post->ID, '_fonte_family_meta_key', true),
                    "size" => get_post_meta($post->ID, '_fonte_meta_key', true),
                ),
                "desktop" => array(
                    "x" => get_post_meta($post->ID, '_desktop_x_meta_key', true),
                    "y" => get_post_meta($post->ID, '_desktop_y_meta_key', true)
                ),
                "tablet" => array(
                    "x" => get_post_meta($post->ID, '_tablet_x_meta_key', true),
                    "y" => get_post_meta($post->ID, '_tablet_y_meta_key', true)
                ),
                "mobile" => array(
                    "x" => get_post_meta($post->ID, '_mobile_x_meta_key', true),
                    "y" => get_post_meta($post->ID, '_mobile_y_meta_key', true)
                ),
                "image_id" => get_post_meta( $post->ID, '_image_id', true ),
                "token" => get_post_meta($post->ID, '_token_meta_key', true),
            ];

            if ( panel_state ( $exibit_panel ) ) { // Painel já cadastrado
                echo "<pre>";
                print_r ( construct_vectors($exibit_panel) );
                echo "</pre>";
    
                $the_panel = construct_vectors($exibit_panel);
    
                //Convertendo os dados para JSON possibilitando uso Javascript
                $json_containers = json_encode($the_panel);
                
                //Os tokens servem para individualizar os vetores e facilitar a referẽncia deles pelo Javascript
                $tokens = [];
    
                //Cadastrando tokens gerados via Javascript para o array PHP
                foreach ($the_panel as $p) {
                    array_push( $tokens, $p[sizeof( $the_panel ) + 1] );
                }
            } else { //Painel em branco

                $the_panel = [];

                //Convertendo os dados para JSON possibilitando uso Javascript
                $json_containers = json_encode($the_panel);
            }

            /* A thumbnail será enviada pelo usuário em um campo de upload */
            $product = wc_get_product($post->ID);
            $image_src = wp_get_attachment_url( $image_id );

        ?>
            <style>
                .main{
                    min-height: 650px;
                }
            </style>
            <div class="main">
                <div class="options">
                    <button class="button">Adicionar vetor</button>
                </div>
                <div class="preview"></div>
            </div>
        <?php
        }
    }
}