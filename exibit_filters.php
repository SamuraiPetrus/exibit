<?php

//Funções que filtram o conteúdo de acordo com regras específicas

function show_when_is_array_and_key_exists ( $key, $array, $callback ) {
    if ( is_array( $array ) ) {
        if ( array_key_exists( $key, $array ) ) {
            $callback();
        }
    }
}
