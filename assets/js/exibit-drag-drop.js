
import VetorBind from './vetor/exibit-vetor-bind.js';

//Algoritmo de movimento.

var drag_drop = (function () {
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
});

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

    //Atualizando coordenadas no painel
    VetorBind(function( scope ){
        scope['painel'].children().each(function(){
          //Loop de componentes do painel
          if ( $(this).attr("name") === undefined ) {
              if ( $(this).hasClass( $("#preview_box").attr('display') ) ) {
                  var coordinate = $(this).children()[1];

                  if ( scope['painel'].attr('vetor-id') === target.getAttribute('vetor-id') ) {
                      if ( $( coordinate ).hasClass( 'exibit-input-x' ) ) {
                        $( coordinate ).val( x );
                      } else if ( $( coordinate ).hasClass( 'exibit-input-y' ) ) {
                        $( coordinate ).val( y );
                      }
                  }
              }
          }
        });
    });
}

export default drag_drop;
