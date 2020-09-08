
//Funções JavaScript internas do plugin

//Ação de Reset do editor
function exibit_reset_action () {
  //Removendo imagem de prévia
  document.getElementById("preview_box").innerHTML = '<figcaption>624 x 585</figcaption>';
  document.getElementById("exibit_vetores").innerHTML = '';

  //Removendo imagem de upload
  document.getElementById("exibit_preview").value = '';

  //Desabilitando funcionalidades de edição
  $("#exibit-reset").prop("disabled", true);
  $("#exibit-vetor").prop("disabled", true);
  $("#exibit-display").prop("disabled", true);
}

//Ação de redimensionamento da prévia da imagem.
function exibit_resize_preview_box_action (width, height, displayName) {
  //Atualizando dimensões da preview preview_box
  $("#preview_box").css("width", width + "px").css("height", height + "px");
  //Atualizando inputs disponíveis
  $(".dimension." + displayName).css("display", "block");
}

//Habilitando a funcionalidade de mudança das prévias (Desktop, Tablet e Mobile)
function exibit_enable_display () {
  $("#exibit-display").prop("disabled", false);
  $("#exibit-display").val("exibit-display-for-desktop");
}
