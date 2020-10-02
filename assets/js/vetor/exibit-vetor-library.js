/*

  exibit-vetor-library.js - Biblioteca de componentes do vetor.

  Cadastro de recursos do vetor: Componentes, Ações, etc..

*/

var vetor = new Object();

//Componentes do painel de edição do vetor.
vetor.painel = {
  'nome'    : '<input type="text" class="exibit-input" placeholder="Nome" name="exibit-vetor-nome" value="Vetor" />',
  'fonte'   : '<select class="exibit-input exibit-vetor-fontes"><option value="" disabled selected>Carregando fontes...</option></select>',
  'cor'     : '<input type="color" class="exibit-input exibit-vetor-cor half" placeholder="Cor" name="exibit-vetor-cor" value="#000000" />',
  'tamanho' : {
      'mobile'  : '<input type="number" class="exibit-input exibit-vetor-tamanho half dimension mobile" placeholder="Tamanho" name="exibit-vetor-tamanho" value="35" min="0" />',
      'tablet'  : '<input type="number" class="exibit-input exibit-vetor-tamanho half dimension tablet" placeholder="Tamanho" name="exibit-vetor-tamanho" value="35" min="0" />',
      'desktop' : '<input type="number" class="exibit-input exibit-vetor-tamanho half dimension desktop" placeholder="Tamanho" name="exibit-vetor-tamanho" value="35" min="0" />',
  },
  'x'       : {
      'mobile'  : '<div class="dimension mobile"><span>X</span><input class="exibit-input exibit-input-x" type="number" name="exibit-vetor-xMobile" value="0" /></div>',
      'tablet'  : '<div class="dimension tablet"><span>X</span><input class="exibit-input exibit-input-x" type="number" name="exibit-vetor-xTablet" value="0" /></div>',
      'desktop' : '<div class="dimension desktop"><span>X</span><input class="exibit-input exibit-input-x" type="number" name="exibit-vetor-xDesktop" value="0" /></div>',
  },
  'y'       : {
      'mobile'  : '<div class="dimension mobile"><span>Y</span><input class="exibit-input exibit-input-y" type="number" name="exibit-vetor-yMobile" value="0" /></div>',
      'tablet'  : '<div class="dimension tablet"><span>Y</span><input class="exibit-input exibit-input-y" type="number" name="exibit-vetor-yTablet" value="0" /></div>',
      'desktop' : '<div class="dimension desktop"><span>Y</span><input class="exibit-input exibit-input-y" type="number" name="exibit-vetor-yDesktop" value="0" /></div>',
  }
};

export default vetor;
