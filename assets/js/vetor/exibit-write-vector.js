//Algoritmo que gerencia a escrita do vetor.

var define_write_vector = (function( painel, vetor_previa, content ){

    painel.forEach(function( componente ){
        if ( componente.name === "exibit_vetor_max_char[]" ) {
            if ( componente.value ) {
                var new_component_value = "";
                content.split('').forEach(function(letter){
                    if ( parseInt(componente.value) > new_component_value.length ) {
                        new_component_value += letter;
                    }
                });

                content = new_component_value;
            }
        }
    });

    vetor_previa.text(content);
});

export default define_write_vector;
