//Algoritmo que define o número máximo de caracteres de um vetor.

var define_max_char = (function( painel, previa, max_char ){
    painel.forEach(function( componente ){
        if ( parseInt(max_char) ) {
            if ( componente.name === "exibit_vetor_nome[]" )  {
                var new_component_value = "";
                componente.value.split('').forEach(function(letter){
                    if ( parseInt(max_char) > new_component_value.length ) {
                        new_component_value += letter;
                    }
                });
                componente.value = new_component_value;
                previa[0].innerHTML = new_component_value;
            }
        }
    });
});

export default define_max_char;
