function AcaoLimpar(){
    document.getElementById("preview_box").innerHTML = '';
    document.getElementById("preview_box").appendChild("<figcaption>624 x 585</figcaption>");
}

var dialog = $('#window');
$('#show').click(function() {
  dialog.show();
});
$('#exit').click(function() {
  dialog.hide();
});
$('#reset').click(function() {
  AcaoLimpar();
  dialog.hide();
});
