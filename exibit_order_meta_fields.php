<?php

// Exibit Order Meta Fields
// Salva valor dos vetores e do canvas (gerado) no pedido.

//Script que valida os vetores.
function vetores_validation( $passed, $product_id, $quantity, $variation_id=null ) {
    $exibit_fields = get_post_meta($product_id, 'exibit_fields', true );

    if ( is_array( $exibit_fields ) ) {
        if ( array_key_exists( 'vetor_ids', $exibit_fields ) ) {
            for ( $i =0; count( $exibit_fields['vetor_ids'] ) > $i; $i++ ) {
                $vetor_name = 'vetor-input-' . $exibit_fields['vetor_ids'][$i];
                if( empty( $_POST[$vetor_name] ) ) {
                    $passed = false;
                    wc_add_notice( __( '"' . $exibit_fields['nomes'][$i] . '" é um campo obrigatório.', 'exibit' ), 'error' );
                }
            }
        }
    }

    return $passed;
}
add_filter( 'woocommerce_add_to_cart_validation', 'vetores_validation', 10, 4 );

//Depois de validados, salve os campos como metadados do carrinho.
function exibit_add_cart_item_data( $cart_item_data, $product_id, $variation_id ) {
   $exibit_fields = get_post_meta($product_id, 'exibit_fields', true );
   $produto_personalizado = [];

   if ( is_array( $exibit_fields ) ) {
       if ( array_key_exists( 'vetor_ids', $exibit_fields ) ) {
           for ( $i =0; count( $exibit_fields['vetor_ids'] ) > $i; $i++ ) {

               $vetor_name = 'vetor-input-' . $exibit_fields['vetor_ids'][$i];
               if( isset( $_POST[$vetor_name] ) ) {
                  $produto_personalizado[$exibit_fields['nomes'][$i]] = sanitize_text_field( $_POST[$vetor_name] );
               }
           }
       }
   }

   $cart_item_data['produto_personalizado'] = $produto_personalizado;

   if ( isset($_POST['canvas']) ) {
      $cart_item_data['canvas'] = SaveOrder( $_POST['canvas'] );
   }

   return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'exibit_add_cart_item_data', 10, 3 );

//Depois do checkout, adicione os metadados do carrinho ao pedido.
function exibit_checkout_create_order_line_item( $item, $cart_item_key, $values, $order ) {
    if( isset( $values['produto_personalizado'] ) ) {
        foreach ( $values['produto_personalizado'] as $key => $value ) {
            $item->add_meta_data(
                $key,
                $value,
                true
            );
        }
    }

    if ( isset( $values['canvas'] ) ) {
        $item->add_meta_data(
            "Prévia",
            "<a href='".$values['canvas']."' target='_blank' class='button'>Visualizar prévia</a>",
            true
        );
    }
}

add_action( 'woocommerce_checkout_create_order_line_item', 'exibit_checkout_create_order_line_item', 10, 4 );

function fs_get_wp_config_path()
{
    $base = dirname(__FILE__);
    $path = false;

    if ( @file_exists( dirname( dirname( $base ) ) ) ) {

        $path = dirname( dirname( $base ) );

    }
    else if ( @file_exists( dirname( dirname( dirname( $base ) ) ) ) ) {

        $path = dirname( dirname( dirname( $base ) ) );

    }
    else {

        $path = false;

    }

    if ($path != false) {

        $path = str_replace("\\", "/", $path);

    }

    return $path;
}

//FUNÇÃO QUE SALVA A IMAGEM PRESONALIZADA DO PRODUTO E RETORNA A URL DELA
function SaveOrder ($post_data) {

    //ID DA IMAGEM SALVA
    $unique = uniqid();

    //CAMINHOS
    $folderPath = fs_get_wp_config_path() . "/uploads/orders/";
    $folderUrl = get_site_url() . "/wp-content/uploads/orders/";

    if (!is_dir($folderPath)) {

    	mkdir(fs_get_wp_config_path() . "/uploads/orders/", 0777, true);

    }

    $image_parts = explode(";base64,", $post_data);

    $image_type_aux = explode("image/", $image_parts[0]);

    $image_type = $image_type_aux[1];

    $image_base64 = base64_decode($image_parts[1]);

    $file = $folderPath . $unique . '.png';

    file_put_contents($file, $image_base64);

    $file = $folderUrl . $unique . '.png';

    return $file;
}
