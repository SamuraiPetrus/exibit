import VetorBind from './vetor/exibit-vetor-bind.js';

//Script que modifica o padrão da tela

function exibit_resize_preview_box_action ( width, height, displayName ) {
    //Atualizando dimensões da preview preview_box
    $("#preview_box").css("width", width + "px").css("height", height + "px");
    $("#preview_box").attr("class", "");
    $("#preview_box").attr("class", "previa " + displayName);
    $("#preview_box").attr("display", displayName);
    //Atualizando inputs disponíveis
    $(".dimension." + displayName).css("display", "block");
}

var exibit_display = (function(){
    var preview_box_dimensions = new Map();
    $(".dimension").css("display", "none");

    switch ( this.value ) {
        case "exibit-display-for-desktop":
            preview_box_dimensions.set("width", 600);
            preview_box_dimensions.set("height", 568);
            preview_box_dimensions.set("displayName", "desktop");
            break;
        case "exibit-display-for-tablet":
            preview_box_dimensions.set("width", 474);
            preview_box_dimensions.set("height", 459.47);
            preview_box_dimensions.set("displayName", "tablet");
            break;
        case "exibit-display-for-mobile":
            preview_box_dimensions.set("width", 322.5);
            preview_box_dimensions.set("height", 406);
            preview_box_dimensions.set("displayName", "mobile");
            break;
    }
    //Atualização dos dados mediante display.
    VetorBind(function ( scope ) {
        scope['painel'].children().each(function(){
          //Loop de componentes do painel
          if ( $(this).hasClass( preview_box_dimensions.get("displayName") ) ) {
              if ( $(this).hasClass('exibit-vetor-tamanho') ) {
                  //Alterando tamanho mediante display
                  scope['previa'].css('font-size', $(this).val() + "px");
              } else if ( $(this).attr("name") === undefined ) {
                  //Alterando coordenadas
                  var coordinate = $(this).children()[1];
                  if ( $(coordinate).hasClass( 'exibit-input-x' ) ) {
                      scope['previa'].attr( 'data-x', $(coordinate).val() );
                      var translate = 'translate(' + $(coordinate).val() + 'px,' + scope['previa'].attr('data-y') + 'px)';
                  } else if ( $(coordinate).hasClass( 'exibit-input-y' ) ) {
                      scope['previa'].attr( 'data-y', $(coordinate).val() );
                      var translate = 'translate(' + scope['previa'].attr('data-x') + 'px,' + $(coordinate).val() + 'px)';
                  }
                  scope['previa'].css('transform', translate);
              }
          }
        });
    });
    exibit_resize_preview_box_action(
        preview_box_dimensions.get("width"),
        preview_box_dimensions.get("height"),
        preview_box_dimensions.get("displayName")
    );
});

export default exibit_display;
