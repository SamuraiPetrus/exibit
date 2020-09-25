
//Objetos JavaScript do plugin

var vetor = new Object();

//Objeto que representa o painel de edição do vetor.
vetor.painel = {
  'nome'    : '<input type="text" class="exibit-input" placeholder="Nome" name="exibit-vetor-nome" value="Vetor" />',
  'fonte'   : get_font_families,
  'cor'     : '<input type="color" class="exibit-input half" placeholder="Cor" name="exibit-vetor-cor" value="#000000" />',
  'tamanho' : {
      'mobile'  : '<input type="number" class="exibit-input half dimension mobile" placeholder="Tamanho" name="exibit-vetor-tamanho_mobile" value="20" />',
      'tablet'  : '<input type="number" class="exibit-input half dimension tablet" placeholder="Tamanho" name="exibit-vetor-tamanho_tablet" value="20" />',
      'desktop'  : '<input type="number" class="exibit-input half dimension desktop" placeholder="Tamanho" name="exibit-vetor-tamanho_desktop" value="20" />',
  },
  'x'       : {
      'mobile'  : '<div class="dimension mobile"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xMobile" value="0" /></div>',
      'tablet'  : '<div class="dimension tablet"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xTablet" value="0" /></div>',
      'desktop' : '<div class="dimension desktop"><span>X</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_xDesktop" value="0" /></div>',
  },
  'y'       : {
      'mobile'  : '<div class="dimension mobile"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yMobile" value="0" /></div>',
      'tablet'  : '<div class="dimension tablet"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yTablet" value="0" /></div>',
      'desktop' : '<div class="dimension desktop"><span>Y</span><input class="exibit-input" type="number" name="exibit-vetor-dimensions_yDesktop" value="0" /></div>',
  }
};

//Ação de adicionar a prévia de exibição do vetor.
vetor.adicionar_previa = (function() {
  interact('.vetor-previa').draggable({
      // enable inertial throwing
      inertia: true,
      // keep the element within the area of it's parent
      modifiers: [
        interact.modifiers.restrictRect({
          restriction: 'parent',
          endOnly: true
        })
      ],
      // enable autoScroll
      autoScroll: true,

      listeners: {
        // call this function on every dragmove event
        move: dragMove,
      }
    });

    //Adicionando prévia de vetor
    var vetor_previa = $("<div>");
    vetor_previa.text('Vetor');
    vetor_previa.addClass('vetor-previa');
    $("#preview_box").append(vetor_previa);
});

//Funções

//Algoritmo de movimento.
function dragMove (event) {
  var target = event.target
  // keep the dragged position in the data-x/data-y attributes
  var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
  var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

  // translate the element
  target.style.webkitTransform =
    target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)'

  // update the posiion attributes
  target.setAttribute('data-x', x)
  target.setAttribute('data-y', y)
}

//Algoritmo de busca de fontes
function get_font_families () {
  return  '<input type="text" class="exibit-input" placeholder="Fonte" name="exibit-vetor-fonte" />';
}


export default vetor;
