function AcaoLimpar(){
    document.getElementById("exibit_preview").value = '';
    document.getElementById("preview_box").innerHTML = '<figcaption>624 x 585</figcaption>';
    document.getElementById("exibit_vetores").innerHTML = '';
}

var dialog = $('#dialog-window'),
mask = $(".exibit-mask");
$('#exibit-reset').click(function() {
  dialog.fadeIn();
  mask.fadeIn();
});
$('#exibit-exit-option').click(function() {
  dialog.fadeOut();
  mask.fadeOut();
});
$('#exibit-reset-option').click(function() {
  AcaoLimpar();
  dialog.fadeOut();
  mask.fadeOut();
});
console.log("HEY");
