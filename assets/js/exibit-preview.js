
//Script que lida com a prévia de imagem na edição.

var exibit_preview = (function (event) {
    //Adicionando imagem de prévia
    var image = this.files[0];
    $("#imagePreviewContainer").innerHTML = '';

    var imgElement = document.createElement("img");
    imgElement.classList.add("preview_box_image");
    imgElement.setAttribute('draggable', false);
    imgElement.src = window.URL.createObjectURL(image);
    imgElement.onload = function () {
        window.URL.revokeObjectURL(this.src);
    };

    Array.from(document.getElementById("preview_box").children).forEach(function ( child ) {
        if ( child.tagName == 'IMG' ) {
            child.parentNode.removeChild( child );
        }
    }); // clear previous image

    $("#preview_box").append(imgElement);

    //Habilitando reset de edição
    $("#exibit-reset").prop("disabled", false);

    //Habilitando adição de vetores
    $("#exibit-vetor").prop("disabled", false);
});

export default exibit_preview;
