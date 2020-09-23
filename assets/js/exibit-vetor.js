
//Algoritmo de criação do vetor
import Vetor from './exibit-vetor-object.js';

var exibit_vetor = (function () {

    //Criando esturutura que abrigará os campos do vetor
    var estrutura = document.createElement("li");
    estrutura.classList.add("vetor");

    //Abrigando os campos
    Object.keys(Vetor).forEach(function(v){
        $(estrutura).append(Vetor[v]);
    });

    $(".vetores").append(estrutura);

    //Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
    $("#exibit-display").prop("disabled", false);
    $("#exibit-display").val("exibit-display-for-desktop");

});

export default exibit_vetor;
