
//Objetos JavaScript do plugin

var vetor = new Object();
vetor.nome = '<input type="text" class="exibit-input" placeholder="Nome" name="exibit-vetor-nome" value="Novo vetor" />';
vetor.fonte = function () {
  return '<input type="text" class="exibit-input" placeholder="Fonte" name="exibit-vetor-fonte" value="" />';
};
vetor.cor = '<input type="color" class="exibit-input half" placeholder="Cor" name="exibit-vetor-cor" value="#000000" />';
vetor.tamanho = '<input type="number" class="exibit-input half" placeholder="Tamanho" name="exibit-vetor-tamanho" value="20" />';
vetor.xMobile = '<div class="dimension mobile"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xMobile" value="0" /></div>';
vetor.yMobile = '<div class="dimension mobile"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yMobile" value="0" /></div>';
vetor.xTablet = '<div class="dimension tablet"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xTablet" value="0" /></div>';
vetor.yTablet = '<div class="dimension tablet"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yTablet" value="0" /></div>';
vetor.xDesktop = '<div class="dimension desktop"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xDesktop" value="0" /></div>';
vetor.yDesktop = '<div class="dimension desktop"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yDesktop" value="0" /></div>';

export default vetor;
