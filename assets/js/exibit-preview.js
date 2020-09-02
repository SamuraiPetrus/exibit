
//Script que lida com a prévia de imagem na edição.

$('#exibit_preview').change(function (event) {

  //Adicionando imagem de prévia
  var image = this.files[0];
  $("#imagePreviewContainer").innerHTML = '';
  var imgElement = document.createElement("img");
  imgElement.classList.add("preview_box_image");
  imgElement.src = window.URL.createObjectURL(image);
  imgElement.alt = image.name;
  imgElement.onload = function () {
      window.URL.revokeObjectURL(this.src);
  };
  document.getElementById("preview_box").innerHTML = ''; // clear existing content
  $("#preview_box").append(imgElement);

  //Habilitando reset de edição
  $("#exibit-reset").prop("disabled", false);

  //Habilitando adição de vetores
  $("#exibit-vetor").prop("disabled", false);
});
