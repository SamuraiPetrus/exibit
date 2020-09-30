
//Algoritmo que relaciona o painel e a prévia do vetor.

var vetor_bind = (function( action ){
    $("#preview_box .vetor-previa").each(function(){ //2x
        //Loop das prévias de vetores
        var previa = $(this),
        previa_vetor_id = previa.attr('vetor-id');

        //Efetue uma busca pelos painéis de vetores, e retorne aquele cujo vetor-id seja idêntico.
        $("#exibit_vetores .vetor").each(function(){
            //Loop dos painéis de vetores
            var estrutura_vetor_id = $(this).attr("vetor-id");
            if ( previa_vetor_id === estrutura_vetor_id ) {
                var scope = {
                    "previa": previa,
                    "painel": $(this)
                };
                action( scope );
            }
        });
    });
});

export default vetor_bind;
