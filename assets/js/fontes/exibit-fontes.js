/*

  Script que faz requisição assíncrona pelas fontes do projeto.

*/

var fontes_do_projeto = (function ( vetor_id ) {
    var httpRequest,
    url = "../wp-json";

    if ( window.XMLHttpRequest ) {
        httpRequest = new XMLHttpRequest();
    } else if ( window.ActiveXObject ) {
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }

    httpRequest.onreadystatechange = function () {
        if ( httpRequest.readyState === 4 ) {
            if ( httpRequest.status === 200 ) {
                var painel = document.getElementById(vetor_id),
                fontes_object = JSON.parse( httpRequest.responseText ),
                fonte = document.createElement("option");
                fonte.innerHTML = fontes_object.description;
                fonte.value = "weart";

                painel.childNodes.forEach(function( child ){
                    // console.log( child );
                    if ( child.classList.contains( "exibit-vetor-fontes" ) ) {
                        child.innerHTML = "";
                        child.append( fonte );
                    }
                });
            }
        }
    };

    httpRequest.open('GET', url);
    httpRequest.send();
});

export default fontes_do_projeto;
