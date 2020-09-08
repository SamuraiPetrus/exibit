
//Script que modifica o padrão da tela

$("#exibit-display").change(function(){
  var preview_box_dimensions = new Map();
  $(".dimension").css("display", "none");
  switch ( this.value ) {
    case "exibit-display-for-desktop":
      preview_box_dimensions.set("width", 504);
      preview_box_dimensions.set("height", 472.58);
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
  exibit_resize_preview_box_action(
    preview_box_dimensions.get("width"),
    preview_box_dimensions.get("height"),
    preview_box_dimensions.get("displayName")
  );
});
