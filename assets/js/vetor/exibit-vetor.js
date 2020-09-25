
//Algoritmo de criação do vetor
import Vetor from './exibit-vetor-object.js';

var exibit_vetor = (function () {

    //Criando esturutura que abrigará os campos do painel de edição do vetor.
    var estrutura = document.createElement("li");
    estrutura.classList.add("vetor");

    //Abrigando os campos do painel de edição do vetor, tomando como base o objeto definido em "exibit-vector-object.js"
    Object.keys(Vetor.painel).forEach(function(field){
        var panel_field = Vetor.painel[field];
        if ( typeof panel_field == "object" ) {
            Object.keys(panel_field).forEach(function(display){
                $(estrutura).append(panel_field[display]);
            });
        } else {
            $(estrutura).append(panel_field);
        }
    });

    $(".vetores").append(estrutura);

    //Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
    $("#exibit-display").prop("disabled", false);
    $("#exibit-display").val("exibit-display-for-desktop");

    //Adicionando o vetor a prévia de imagem
    Vetor.adicionar_previa();

});

export default exibit_vetor;
