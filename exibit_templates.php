<?php

// HTML de vetores já cadastrados.
function Vetor_Template ( $exibit_fields, $i ) {

  $fontes = new WP_Query([
      "post_type" => "exibit_fontes",
      "posts_per_page" => -1
  ]);


?>

    <li class="vetor" vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>" id="<?= $exibit_fields['vetor_ids'][$i] ?>">
        <style class="font-face">

        </style>
        <input type="text" class="exibit-input" placeholder="Nome" name="exibit_vetor_nome[]" value="<?= $exibit_fields['nomes'][$i] ?>">
        <select class="exibit-input exibit-vetor-fontes" name="exibit_vetor_fontes[]">
            <?php
            if ( $fontes->have_posts() ) :
                while ( $fontes->have_posts() ) : $fontes->the_post(); ?>

                    <option value="<?= get_the_id() ?>" url="<?= get_post_meta( get_the_ID(), 'exibit_fonte_upload_meta', true ); ?>" <?= get_the_ID() == $exibit_fields['fontes'][$i] ? "selected='true' registered='true'" : "registered='false'"; ?> ><?= get_the_title(); ?></option>

              <?php
                endwhile;
            endif; ?>
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

        // JavaScript duplicado para vetores já cadastrados. Em longo prazo, devemos globalizar as funcionalidades, tendo um melhor reaproveitamento de código.

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

        //Manipular fontes
        $('#<?= $exibit_fields['vetor_ids'][$i] ?> .exibit-vetor-fontes').on('change', function() {
            $(this).children().each(function () {
              if ( this.selected ) {
                  if ( $(this).attr('registered') === 'false' ) {
                      var font_face = document.createElement('style');
                      font_face.setAttribute( 'type', 'text/css' );
                      font_face.setAttribute( 'media', 'screen, print' );
                      font_face.appendChild(document.createTextNode('\
                          @font-face {\
                              font-family: '+ $(this).text() +';\
                              src: url("'+ $(this).attr('url') +'");\
                              font-weight: normal;\
                          }\
                      '));

                      document.head.append( font_face );

                      $(this).attr('registered', 'true');
                  }
                  $('#vetor-<?= $exibit_fields['vetor_ids'][$i] ?>').css( 'font-family', $(this).text() );
              }
            });
        });

    </script>

<?php }

function Exibit_Fontes ( $fontes ) {
    $fontes_log = [];
    foreach ( $fontes as $fonte ) {
        if ( !in_array( $fonte, $fontes_log ) ) {
            $url = get_post_meta( $fonte, 'exibit_fonte_upload_meta', true );
            echo '
                <style type="text/css" media="screen, print">

                    @font-face {
                        font-family: '.get_the_title( $fonte ).';
                        src: url("'.$url.'");
                        font-weight: normal;
                    }

                </style>
            ';
            array_push($fontes_log, $fonte);
        }
    }
} ?>
