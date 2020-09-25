
//Algoritmo de criação do vetor
import Vetor from './exibit-vetor-library.js';

/*

  exibit-vetor.js - Responsável por adicionar um novo vetor na interface.

  O script consulta a biblioteca de componentes do vetor (exibit-vetor-library)
  e adiciona-os da forma adequada, para que sejam submetidos ao banco de dados.

*/


// Cadastro de um novo vetor no DOM.
var exibit_vetor = (function () {

    //Criando esturutura do painel de edição do vetor.
    var estrutura = document.createElement("li");
    estrutura.classList.add("vetor");

    //Cadastrando os componentes do painel. (Inputs de nome, cor, tamanho...)
    Object.keys( Vetor.painel ).forEach( function ( componente ) {
        var componente_do_painel = Vetor.painel[componente];
        if ( typeof componente_do_painel == "object" ) {
            //Campos que variam mediante o tamanho da tela. ( media_screen )
            Object.keys( componente_do_painel ).forEach( function( media_screen ) {
                $( estrutura ).append( componente_do_painel[media_screen] );
            });
        } else {
            $( estrutura ).append( componente_do_painel );
        }
    });

    $(".vetores").append(estrutura);

    //Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
    $("#exibit-display").prop("disabled", false);
    $("#exibit-display").val("exibit-display-for-desktop");

    //Adicionando o vetor a prévia de imagem
    Vetor.adicionar_previa();

    //Estabelecendo relação entre painel e prévia

});

export default exibit_vetor;
