
//Script que controla o Warning de Reset do editor.

var dialog = $('#dialog-window'),
mask = $(".exibit-mask");

var exibit_reset = (function () {
    sure_popup( 'open' );

    $('#exibit-exit-option').click(function() {
        sure_popup( 'close' );
    });

    $('#exibit-reset-option').click(function() {
        reset_action();
        sure_popup( 'close' );
    });
});

function sure_popup ( action ) {
    if ( action === 'open' ) {
        dialog.fadeIn();
        mask.fadeIn();
    } else if ( 'close' ) {
        dialog.fadeOut();
        mask.fadeOut();
    } else {
        return;
    }
}

function reset_action () {
    //Removendo imagem de prévia
    document.getElementById("preview_box").innerHTML = '';
    document.getElementById("exibit_vetores").innerHTML = '';

    //Removendo imagem de upload
    document.getElementById("exibit_preview").value = '';

    //Desabilitando funcionalidades de edição
    $("#exibit-reset").prop("disabled", true);
    $("#exibit-vetor").prop("disabled", true);
    $("#exibit-display").prop("disabled", true);
    $("#exibit-display").val("exibit-display-for-desktop");
}

export default exibit_reset;
