
//Algoritmo de criação do vetor
import Vetor from './exibit-vetor-library.js';
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

    //Adicionando o vetor a prévia de imagem
    interact('.vetor-previa').draggable({
        inertia: true,
        modifiers: [
            interact.modifiers.restrictRect({
                restriction: 'parent',
                endOnly: true
            })
        ],
        autoScroll: true,
        listeners: {
            move: dragMove,
        }
    });

    //Adicionando prévia de vetor
    var vetor_previa = $("<div>");
    vetor_previa.text('Vetor');
    vetor_previa.addClass('vetor-previa');
    vetor_previa.attr('data-x', 0);
    vetor_previa.attr('data-y', 0);
    vetor_previa.attr('vetor-id', vetor_id);

    //Algoritmo de movimento.
    function dragMove (event) {
        var target = event.target,
        x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx,
        y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

        // translate the element
        target.style.webkitTransform =
          target.style.transform =
            'translate(' + x + 'px, ' + y + 'px)';

        // update the posiion attributes
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    }

    //Criando botão de exclusão do vetor
    var excluir_painel = document.createElement('a');
    excluir_painel.classList.add('vetor-excluir');
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
                case ( "exibit-vetor-nome" ) :
                  vetor_previa.text(this.value);
                  break;
                case ( "exibit-vetor-cor" ) :
                  vetor_previa.css("color", this.value);
                  break;
                case ( "exibit-vetor-tamanho" ) :
                  vetor_previa.css("font-size", this.value + "px");
                  break;
                case ( undefined ) :
                  //Campo está sob uma div "dimension"
                  console.log( this.children );
                  break;
            }
        }
    });

    $("#preview_box").append(vetor_previa);
    $(".vetores").append( estrutura_do_painel );

});

export default exibit_vetor;
