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
  exibit_reset_action();
  dialog.fadeOut();
  mask.fadeOut();
});
