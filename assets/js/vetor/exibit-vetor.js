
//Algoritmo de criação do vetor
import FontesDoProjeto from '../fontes/exibit-fontes.js';
import CaracteresMaximos from './exibit-maxchar.js';
import EscreverVetor from './exibit-write-vector.js';
import Vetor from './exibit-vetor-library.js';
import VetorBind from './exibit-vetor-bind.js';
import GerarID from './exibit-gerar-id.js';

/*

  exibit-vetor.js - Responsável por adicionar um novo vetor na interface.

  O script consulta a biblioteca de componentes do vetor (exibit-vetor-library)
  adiciona-os da forma adequada, e relaciona-os de forma que o cadastro possa
  ser efetuado.

*/


// Cadastro de um novo vetor no DOM.
var exibit_vetor = (function () {

    //Gerando identificação do única do Vetor
    var vetor_id = GerarID();

    //Criando esturutura do painel de edição do vetor.
    var estrutura_do_painel = document.createElement("li");
    estrutura_do_painel.classList.add("vetor");
    estrutura_do_painel.setAttribute('vetor-id', vetor_id);
    estrutura_do_painel.setAttribute('id', vetor_id);

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

    //Cadastrando vetor_ids
    var vetor_id_input = document.createElement('input');
    vetor_id_input.setAttribute('type', 'hidden');
    vetor_id_input.name = "exibit_vetor_id[]";
    vetor_id_input.value = vetor_id;
    $( estrutura_do_painel ).append( vetor_id_input );

    //Carregando as fontes do projeto
    FontesDoProjeto( vetor_id );

    //Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
    $("#exibit-display").prop("disabled", false);

    //Adicionando prévia de vetor
    var vetor_previa = $("<div>");
    vetor_previa.id = "vetor-" + vetor_id;
    vetor_previa.text('Vetor');
    vetor_previa.addClass('vetor-previa');
    vetor_previa.attr('data-x', 0);
    vetor_previa.attr('data-y', 0);
    vetor_previa.attr('vetor-id', vetor_id);

    //Criando botão de exclusão do vetor
    var excluir_painel = document.createElement('a');
    excluir_painel.classList.add('vetor-excluir');
    excluir_painel.name = 'vetor-excluir';
    excluir_painel.innerHTML = "Excluir";
    excluir_painel.onclick = function () {
        vetor_previa.empty();
        estrutura_do_painel.remove();
    }

    //Salvando botão de excluir no painel
    estrutura_do_painel.append(excluir_painel);

    //Atualizando prévia dos vetores em real time
    Array.from(estrutura_do_painel.children).forEach(function( componente_do_painel ){
        componente_do_painel.oninput = function () {
            switch ( this.name ) {
                case "exibit_vetor_nome[]" :
                    EscreverVetor( Array.from(estrutura_do_painel.children), vetor_previa, this.value );
                    break;
                case "exibit_vetor_max_char[]" :
                    CaracteresMaximos( Array.from(estrutura_do_painel.children), vetor_previa , this.value );
                    break;
                case "exibit_vetor_cor[]" :
                    vetor_previa.css("color", this.value);
                    break;
                case "exibit_vetor_tamanho_mobile[]" :
                case "exibit_vetor_tamanho_tablet[]" :
                case "exibit_vetor_tamanho_desktop[]" :
                    vetor_previa.css("font-size", this.value + "px");
                    break;
                case ( undefined ) :
                    //Coordenadas
                    var coordinate = this.children[1],
                    data_x = vetor_previa.attr('data-x');
                    var data_y = vetor_previa.attr('data-y');

                    if ( coordinate.classList.contains( "exibit-input-x" ) ) {
                        //Mover vetor x
                        vetor_previa.attr('data-x', coordinate.value);
                        var translate = 'translate(' + coordinate.value + 'px, ' + data_y + 'px)';

                    } else if ( coordinate.classList.contains( "exibit-input-y" ) ) {
                        //Mover vetor y
                        vetor_previa.attr('data-y', coordinate.value);
                        var translate = 'translate(' + data_x + 'px, ' + coordinate.value + 'px)';
                    }

                    vetor_previa.css( 'transform', translate );
                    break;
            }
        }
    });

    $("#preview_box").append(vetor_previa);
    $(".vetores").append( estrutura_do_painel );

});

export default exibit_vetor;
