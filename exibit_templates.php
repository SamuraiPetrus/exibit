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
}

//Templates para interface do usuário

function Style_User_Interface () { ?>
  <style media="screen">

      .exibit-view,
      .flex-viewport,
      .woocommerce-product-gallery {
          position: relative;
      }

      .exibit-view img {
          width: 100%;
          height: 100%;
          object-fit: contain;
      }

      .exibit-vetores{
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
      }

      .exibit-vetor-input-field{
        margin-bottom: 30px;
        width: 100%;
      }

      @media screen and ( min-width: 768px ) {
          .exibit-vetor-input-field{
            width: 45%;
          }
      }

      .exibit-vetor-label {
          text-transform: uppercase;
          letter-spacing: 1px;
          margin-bottom: 18px;
          display: block;
      }
      .exibit-vetor-input {
          border: none;
          background: #f5f5f5;
          text-indent: 8px;
          font-weight: lighter;
          width: 100%;
      }
      .exibit-preview-img{
          width: 100%;
          height: 100%;
          object-fit: contain;
      }

      #exibir-previa {
          color: #C2A672;
          fill: #C2A672;
          display: none;
          letter-spacing: 2px;
          margin-bottom: 30px;
          font-weight: bolder;
          font-size: 15px;
          cursor: pointer;
          text-decoration: underline;
          text-transform: uppercase;
          width: -moz-fit-content;
          width: fit-content;
      }

      .personalize {
          font-size: 15px;
          letter-spacing: 3px;
          text-transform: uppercase;
          color: #D4D4D4;
          position: relative;
      }

      .personalize::after{
          height: 1px;
          width: 57%;
          background: #D4D4D4;
          content: "";
          display: block;
          position: absolute;
          right: 0;
          top: 50%;
          transform: translateY(-50%);
      }

      .preview{
          height: 100%;
          width: 100%;
          background: rgba(1,1,1,0.5);
          position: absolute;
          z-index: 1;
          display: none;
      }

      /* Size preservation em caso de imagens sem galeria ao lado. */
      .size-preservation{
          max-width:600px;
          max-height: 406px;
          width: 100%;
          height: 100%;
          top: 50%;
          left: 50%;
          position: relative;
          transform: translate(-50%, -50%);
      }
      @media screen and ( min-width: 768px ) {
          .size-preservation{
              max-width: 621px;
              max-height: 600px;
          }
      }
      @media screen and ( min-width: 960px ) {
          .size-preservation{
              max-width: 649.217px;
              height: 599.8px;
          }
      }
  </style>
<?php }

function Preview_User_Interface ( $exibit_preview, $exibit_fields ) { ?>
      <?php if ( (bool) $exibit_preview ) : ?>
          <img class="exibit-preview-img" src="<?=$exibit_preview?>">\
      <?php endif;

          if ( is_array( $exibit_fields ) ) {
              if ( array_key_exists( 'vetor_ids', $exibit_fields ) ) {
                  for ( $i = 0; $i < count( $exibit_fields ); $i++ ) {
                      $fonte = get_post($exibit_fields['fontes'][$i]);
                      $url = get_post_meta( $fonte->ID, 'exibit_fonte_upload_meta', true );
                      ?>
                          <style type="text/css" media="screen, print">\
                               @font-face {\
                                   font-family: "<?= $fonte->post_title ?>";\
                                   src: url("<?= $url ?>");\
                                   font-weight: normal;\
                               }\
                               <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {\
                                   position: absolute;\
                                   font-family: "<?= get_the_title( $exibit_fields['fontes'][$i] ) ?>";\
                                   top: 40%;\
                                   left: 40%;\
                                   color: <?= $exibit_fields['cores'][$i] ?>;\
                                   transform: translate( <?= $exibit_fields['x_mobile'][$i] ?>px, <?= $exibit_fields['y_mobile'][$i] ?>px );\
                                   font-size: <?= $exibit_fields['tamanhos_mobile'][$i] ?>px;\
                               }\
                               @media screen and ( min-width: 768px ) {\
                                   <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {\
                                       transform: translate( <?= $exibit_fields['x_tablet'][$i] ?>px, <?= $exibit_fields['y_tablet'][$i] ?>px );\
                                       font-size: <?= $exibit_fields['tamanhos_tablet'][$i] ?>px;\
                                   }\
                               }\
                               @media screen and ( min-width: 960px ) {\
                                   <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {\
                                       transform: translate( <?= $exibit_fields['x_desktop'][$i] ?>px, <?= $exibit_fields['y_desktop'][$i] ?>px );\
                                       font-size: <?= $exibit_fields['tamanhos_desktop'][$i] ?>px;\
                                   }\
                               }\
                          </style>\
                          <div id="vetor-<?= $exibit_fields['vetor_ids'][$i] ?>" class="vetor-previa"\
                              data-x="<?= $exibit_fields['x_desktop'][$i] ?>"\
                              data-y="<?= $exibit_fields['y_desktop'][$i] ?>"\
                              vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>">\
                              <?= $exibit_fields['nomes'][$i] ?>\
                          </div>\
                      <?php
                  }
              }
          }
      ?>
<?php }

function Inputs_User_Interface ( $exibit_fields, $i ) { ?>
    <div class="exibit-vetor-input-field">
        <label class="exibit-vetor-label"><?=$exibit_fields['nomes'][$i]?></label>
        <input type="text" class="exibit-vetor-input" id="<?= 'vetor-input-' . $exibit_fields['vetor_ids'][$i] ?>" value="">
    </div>

    <script type="text/javascript">
        document.getElementById('<?= 'vetor-input-' . $exibit_fields['vetor_ids'][$i] ?>').oninput = function () {
            document.getElementById('<?= "vetor-" . $exibit_fields['vetor_ids'][$i] ?>').innerHTML = this.value;
        }
    </script>
<?php }

function Preview_Switch_User_Interface ( $exibit_preview, $exibit_fields ) { ?>

    <p class="personalize u-marginBottom--inter">Personalize</p>
    <a href="javascript:void(0)" id="exibir-previa" class="off">Visualizar prévia <i class="fas fa-eye"></i></a>
    <script type="text/javascript">

        function exibir_previa ( thisObj ) {
            document.querySelector(".preview").style.display = "flex";
            document.getElementById('exibir-previa').innerHTML = 'Esconder prévia <i class="fas fa-eye-slash"></i>';
            thisObj.classList.remove( 'off' );
            thisObj.classList.add( 'on' );
        }

        function esconder_previa ( thisObj ) {
            document.querySelector(".preview").style.display = "none";
            document.getElementById('exibir-previa').innerHTML = 'Visualizar prévia <i class="fas fa-eye"></i>';
            thisObj.classList.remove( 'on' );
            thisObj.classList.add( 'off' );
        }

        //Configuração da estrutura da prévia.
        setTimeout(function(){

            //Removendo status de loading do botão de prévia
            console.log('Ativado');
            document.getElementById('exibir-previa').style.display = "block";

            //Definindo a prévia
            var gallery = document.querySelector('.woocommerce-product-gallery'),
            atributos = {
              lupa: false,
              galeria: false
            };

            Array.from( gallery.children ).forEach(function( child ){

                console.log( child );
                if ( child.classList.contains('flex-viewport') ) {
                    //Trata-se de uma imagem com lupa.
                    atributos.lupa = true;
                }

                if ( child.classList.contains('flex-control-nav') ) {
                    atributos.galeria = true;
                }

            });

            //Criando a estrutura da prévia
            var preview = document.createElement('figure');
            preview.classList.add('preview');

            preview.innerHTML = '<div class="size-preservation"><?php Preview_User_Interface( $exibit_preview, $exibit_fields ) ?></div>';

            if ( atributos.lupa ) {
                var append_preview = gallery.querySelectorAll('.flex-viewport')[0];
            } else {
                var append_preview = gallery;
            }
            append_preview.append( preview );

            document.getElementById('exibir-previa').onclick = function () {
                if ( this.classList.contains('off') ) {
                    exibir_previa( this );
                } else {
                    esconder_previa( this );
                }
            }

            // document.querySelector('.flex-control-nav').onclick = function () {
            //     esconder_previa( this )
            // };
        }, 5000)

    </script>
<?php }
