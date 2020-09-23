
//Script que modifica o padrão da tela

function exibit_resize_preview_box_action ( width, height, displayName ) {
    //Atualizando dimensões da preview preview_box
    $("#preview_box").css("width", width + "px").css("height", height + "px");
    //Atualizando inputs disponíveis
    $(".dimension." + displayName).css("display", "block");
}

var exibit_display = (function(){
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

export default exibit_display;
