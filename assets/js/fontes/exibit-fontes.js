/*

  Script que faz requisição assíncrona pelas fontes do projeto.

*/

import FontFamilyChanger from "./exibit-fontfamily-changer.js";

var fontes_do_projeto = (function ( vetor_id ) {
    var httpRequest,
    url = "../wp-json/wp/v2/exibit_fontes";

    if ( window.XMLHttpRequest ) {
        httpRequest = new XMLHttpRequest();
    } else if ( window.ActiveXObject ) {
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }

    httpRequest.onreadystatechange = function () {
        if ( httpRequest.readyState === 4 ) {
            if ( httpRequest.status === 200 ) {
                var painel = document.getElementById(vetor_id),
                fontes_object = JSON.parse( httpRequest.responseText );

                painel.childNodes.forEach(function( child ){
                    if ( child.classList.contains( "exibit-vetor-fontes" ) ) {
                        child.innerHTML = "";
                        //Laço de repetição mediante as fontes cadastradas no site
                        if ( fontes_object.length ) {
                            fontes_object.forEach(function( fonte ){
                                var id = fonte.id,
                                url = fonte.exibit_fonte_upload_meta[0],
                                title = fonte.title.rendered;

                                if ( id && title ) {
                                    var option = document.createElement("option");
                                    option.value = id;
                                    option.setAttribute( 'url', url );
                                    option.setAttribute( 'registered', "false" );
                                    option.innerHTML = title;

                                    child.append( option );
                                }
                            });
                        } else {
                            var notFoundOption = document.createElement('option');
                            notFoundOption.innerHTML = "Nenhuma fonte encontrada. Adicione novas fontes indo em 'Fontes' > 'Nova Fonte'.";
                            notFoundOption.setAttribute('selected', 'selected');
                            notFoundOption.setAttribute('value', '');
                            child.append(notFoundOption);
                        }

                        FontFamilyChanger( child, vetor_id );

                        //Troca dinâmica de font-family.
                        child.onchange = function () {
                            FontFamilyChanger( child, vetor_id );
                        }
                    }
                });
            }
        }
    };

    httpRequest.open('GET', url);
    httpRequest.send();
});

export default fontes_do_projeto;
