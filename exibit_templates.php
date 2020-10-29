<?php

// HTML de vetores já cadastrados.
function Vetor_Template ( $exibit_fields, $i ) { ?>

    <li class="vetor" vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>" id="<?= $exibit_fields['vetor_ids'][$i] ?>">
        <input type="text" class="exibit-input" placeholder="Nome" name="exibit_vetor_nome[]" value="<?= $exibit_fields['nomes'][$i] ?>">
        <select class="exibit-input exibit-vetor-fontes" name="exibit_vetor_fontes[]">
            <option value="149" url="http://localhost/we_art/wp-content/uploads/fontes/BreeSerif-Regular.ttf" registered="true">Bree Serif</option>
        </select>
        <input type="color" class="exibit-input exibit-vetor-cor half" placeholder="Cor" name="exibit_vetor_cor[]" value="<?= $exibit_fields['cores'][$i] ?>">
        <input type="number" class="exibit-input exibit-vetor-tamanho half dimension mobile" placeholder="Tamanho" name="exibit_vetor_tamanho_mobile[]" value="<?= $exibit_fields['tamanhos_mobile'][$i] ?>" min="0">
        <input type="number" class="exibit-input exibit-vetor-tamanho half dimension tablet" placeholder="Tamanho" name="exibit_vetor_tamanho_tablet[]" value="<?= $exibit_fields['tamanhos_tablet'][$i] ?>" min="0">
        <input type="number" class="exibit-input exibit-vetor-tamanho half dimension desktop" placeholder="Tamanho" name="exibit_vetor_tamanho_desktop[]" value="<?= $exibit_fields['tamanhos_desktop'][$i] ?>" min="0">
        <div class="dimension mobile">
            <span>X</span>
            <input class="exibit-input exibit-input-x" type="number" name="exibit_vetor_x_mobile[]" value="<?= $exibit_fields['x_mobile'][$i] ?>">
        </div>
        <div class="dimension tablet">
            <span>X</span>
            <input class="exibit-input exibit-input-x" type="number" name="exibit_vetor_x_tablet[]" value="<?= $exibit_fields['x_tablet'][$i] ?>">
        </div>
        <div class="dimension desktop">
            <span>X</span>
            <input class="exibit-input exibit-input-x" type="number" name="exibit_vetor_x_desktop[]" value="<?= $exibit_fields['x_desktop'][$i] ?>">
        </div>
        <div class="dimension mobile">
            <span>Y</span>
            <input class="exibit-input exibit-input-y" type="number" name="exibit_vetor_y_mobile[]" value="<?= $exibit_fields['y_mobile'][$i] ?>">
        </div>
        <div class="dimension tablet">
            <span>Y</span>
            <input class="exibit-input exibit-input-y" type="number" name="exibit_vetor_y_tablet[]" value="<?= $exibit_fields['y_tablet'][$i] ?>">
        </div>
        <div class="dimension desktop">
            <span>Y</span>
            <input class="exibit-input exibit-input-y" type="number" name="exibit_vetor_y_desktop[]" value="<?= $exibit_fields['y_desktop'][$i] ?>">
        </div>
        <input type="hidden" name="exibit_vetor_id[]" value="<?=$exibit_fields['vetor_ids'][$i]?>">
        <a class="vetor-excluir" name="vetor-excluir">Excluir</a>
    </li>

<?php }

// Ações de vetores já cadastrados.
function Vetor_Script ( $exibit_fields, $i ) { ?>

    <script type="text/javascript">

        //Excluir vetor
        $('#<?= $exibit_fields['vetor_ids'][$i] ?> .vetor-excluir').click(function() {
            $('#<?= $exibit_fields['vetor_ids'][$i] ?>').remove();
            $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').remove();
        });

        //Manipular tabela do vetor em Real Time.
        $('#<?= $exibit_fields['vetor_ids'][$i] ?>').children().each(function() {
            $(this).on('input', function () {
                switch ( $(this).attr('name') ) {
                    case "exibit_vetor_nome[]" :
                        $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').text( $(this).val() );
                        break;
                    case "exibit_vetor_cor[]" :
                        $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').css( 'color', $(this).val() );
                        break;
                    case "exibit_vetor_tamanho_mobile[]" :
                    case "exibit_vetor_tamanho_tablet[]" :
                    case "exibit_vetor_tamanho_desktop[]" :
                        $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').css("font-size", $(this).val() + "px");
                        break;
                    case ( undefined ) :
                        //Coordenadas
                        var coordinate = $(this).children()[1];
                        // console.log( coordinate );
                        data_x = $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').attr('data-x');
                        var data_y = $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').attr('data-y');

                        if ( $(coordinate).hasClass( "exibit-input-x" ) ) {
                            //Mover vetor x
                            $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').attr( 'data-x', $(coordinate).val() );
                            var translate = 'translate(' + $(coordinate).val() + 'px, ' + data_y + 'px)';

                        } else if ( $(coordinate).hasClass( "exibit-input-y" ) ) {
                            //Mover vetor y
                            $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').attr( 'data-y', $(coordinate).val() );
                            var translate = 'translate(' + data_x + 'px, ' + $(coordinate).val() + 'px)';
                        }

                        $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').css( 'transform', translate );
                        break;
                }
            })
        });

        //Manipular vetor (Drag and Drop)

    </script>

<?php }
