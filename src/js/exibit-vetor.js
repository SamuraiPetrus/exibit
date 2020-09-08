
//Algoritmo de criação do vetor

$("#exibit-vetor").click( function () {

  //Criando esturutura que abrigará os campos do vetor
  estrutura = document.createElement("li");
  estrutura.classList.add("vetor");

  //Abrigando os campos
  Object.keys(vetor).forEach(function(v){
    $(estrutura).append(vetor[v]);
  });

  $(".vetores").append(estrutura);

  exibit_enable_display();
  
} );
