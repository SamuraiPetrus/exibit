
//Algoritmo de criação do vetor

var vetor = new Object();
vetor.nome = '<input type="text" class="exibit-input" placeholder="Nome" name="exibit-vetor-nome" value="Novo vetor" />';
vetor.fonte = function () {
  return '<input type="text" class="exibit-input" placeholder="Fonte" name="exibit-vetor-fonte" value="" />';
};
vetor.cor = '<input type="color" class="exibit-input half" placeholder="Cor" name="exibit-vetor-cor" value="#000000" />';
vetor.tamanho = '<input type="number" class="exibit-input half" placeholder="Tamanho" name="exibit-vetor-tamanho" value="20" />';
vetor.xMobile = '<div class="dimension"><span>X</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_xMobile" value="0" /></div>';
vetor.yMobile = '<div class="dimension"><span>Y</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_yMobile" value="0" /></div>';
vetor.xTablet = '<div class="dimension"><span>X</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_xTablet" value="0" /></div>';
vetor.yTablet = '<div class="dimension"><span>Y</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_yTablet" value="0" /></div>';
vetor.xDesktop = '<div class="dimension"><span>X</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_xDesktop" value="0" /></div>';
vetor.yDesktop = '<div class="dimension"><span>Y</span><input type="number" class="exibit-input half" name="exibit-vetor-dimensions_yDesktop" value="0" /></div>';

$("#exibit-vetor").click( function () {

  //Criando esturutura que abrigará os campos do vetor
  estrutura = document.createElement("li");
  estrutura.classList.add("vetor");

  //Abrigando os campos
  Object.keys(vetor).forEach(function(v){
    $(estrutura).append(vetor[v]);
  });

  $(".vetores").append(estrutura);

} );
