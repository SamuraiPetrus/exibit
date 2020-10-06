/*

  Algoritmo que modifica a família da fonte, tendo como base o select de fontes do painel.

*/

var font_family_changer = (function ( fontes, vetor_id ) {
    fontes.childNodes.forEach(function( option ){
        if ( option.selected ) {
            //Adicionando opções de fonte ao menu
            document.querySelector("#preview_box").childNodes.forEach(function( vetor ){
                if ( vetor.className === 'vetor-previa' ) {
                    if ( vetor.getAttribute('vetor-id') == vetor_id ) {
                        vetor.style.fontFamily = option.innerHTML;
                    }
                }
            });

            //Carregando font-face
            if ( option.getAttribute("registered") === "false" ) {
                var font_face = document.createElement('style');
                font_face.setAttribute( 'type', 'text/css' );
                font_face.setAttribute( 'media', 'screen, print' );
                font_face.appendChild(document.createTextNode('\
                    @font-face {\
                        font-family: '+ option.innerHTML +';\
                        src: url("'+ option.getAttribute('url') +'");\
                        font-weight: normal;\
                    }\
                '));

                document.head.append( font_face );
                option.setAttribute('registered', 'true');
            }
        }
    });
});

export default font_family_changer;
