
//Algoritmo de criação do vetor

var vetor = new Object();
vetor.nome = '<input type="text" class="exibit-input" placeholder="Nome" name="exibit-vetor-nome" value="" />';
vetor.fonte = function () {
  return '<input type="text" class="exibit-input" placeholder="Fonte" name="exibit-vetor-fonte" value="" />';
};
vetor.cor = '<input type="color" class="exibit-input half" placeholder="Cor" name="exibit-vetor-cor" value="" />';
vetor.tamanho = '<input type="number" class="exibit-input half" placeholder="Tamanho" name="exibit-vetor-tamanho" value="" />';
vetor.x = '<input type="number" class="exibit-input half" placeholder="X" name="exibit-vetor-dimensions_x" value="" />';
vetor.y = '<input type="number" class="exibit-input half" placeholder="Y" name="exibit-vetor-dimensions_y" value="" />';

$("#exibit-vetor").click( function () {

  //Criando esturutura que abrigará os campos do vetor
  estrutura = document.createElement("li");
  estrutura.classList.add("vetor");

  //Abrigando os campos
  Object.keys(vetor).forEach(function(v){
    $(estrutura).append(vetor[v]);
    console.log( vetor[v] );
  });

  $(".vetores").append(estrutura);

} );
