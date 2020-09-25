
//Algoritmo de criação do vetor
import Vetor from './exibit-vetor-library.js';

/*

  exibit-vetor.js - Responsável por adicionar um novo vetor na interface.

  O script consulta a biblioteca de componentes do vetor (exibit-vetor-library)
  adiciona-os da forma adequada, e relaciona-os de forma que o cadastro possa
  ser efetuado.

*/


// Cadastro de um novo vetor no DOM.
var exibit_vetor = (function () {

    //Criando esturutura do painel de edição do vetor.
    var estrutura_do_painel = document.createElement("li");
    estrutura_do_painel.classList.add("vetor");

    //Cadastrando os componentes do painel. (Inputs de nome, cor, tamanho...)
    Object.keys( Vetor.painel ).forEach( function ( componente ) {
        var componente_do_painel = Vetor.painel[componente];
        if ( typeof componente_do_painel == "object" ) {
            //Campos que variam mediante o tamanho da tela. ( media_screen )
            Object.keys( componente_do_painel ).forEach( function( media_screen ) {
                $( estrutura_do_painel ).append( componente_do_painel[media_screen] );
            });
        } else {
            $( estrutura_do_painel ).append( componente_do_painel );
        }
    });

    //Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
    $("#exibit-display").prop("disabled", false);
    $("#exibit-display").val("exibit-display-for-desktop");

    //Adicionando o vetor a prévia de imagem
    Vetor.adicionar_previa();

    //Estabelecendo relação entre painel e prévia
    var vetores_cadastrados = document.querySelector("#preview_box .vetor-previa");
    if ( vetores_cadastrados.length ) {
        vetores_cadastrados.forEach(function(vetor){
          console.log(vetor);
        });
    } else {
        console.log( "Nenhum vetor cadastrado!" );
    }
    // $id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
    // estrutura_do_painel.prop("id", $id);

    $(".vetores").append( estrutura_do_painel );

});

export default exibit_vetor;
