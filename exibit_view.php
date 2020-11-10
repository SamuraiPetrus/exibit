<?php

/*

  Exibit View

  Camada de apresentação.

*/

//Prévia
add_action('woocommerce_before_single_product_summary', function () {
    $the_post = get_queried_object();
    $exibit_fields = get_post_meta($the_post->ID, 'exibit_fields', true );
    $exibit_preview = get_post_meta($the_post->ID, 'exibit_preview', true);

    if ( is_array($exibit_fields['vetor_ids']) ) { ?>

    <style media="screen">

        .woocommerce-product-gallery {
            display: none !important;
        }

        .exibit-view {
            height: 406px;
            width: 322.5px;
            position: relative;
        }

        .exibit-view img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @media screen and ( min-width: 768px ) {
            .exibit-view {
                height: 459.47px;
                width: 474px;
                position: relative;
            }
        }

        @media screen and ( min-width: 960px ) {
            .exibit-view {
                height: 568px;
                width: 600px;
                position: relative;
            }
        }
    </style>

    <figure class="exibit-view">

        <img src="<?=$exibit_preview?>">

        <?php
            if ( is_array( $exibit_fields ) ) {
                if ( count( $exibit_fields['vetor_ids'] ) > 0 ) {
                    for ( $i = 0; $i < count( $exibit_fields ); $i++ ) {
                        $fonte = get_post($exibit_fields['fontes'][$i]);
                        $url = get_post_meta( $fonte->ID, 'exibit_fonte_upload_meta', true ); ?>

                        <style type="text/css" media="screen, print">

                             @font-face {
                                 font-family: '<?= $fonte->post_title ?>';
                                 src: url('<?= $url ?>');
                                 font-weight: normal;
                             }

                             <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {
                                 position: absolute;
                                 font-family: <?= get_the_title( $exibit_fields['fontes'][$i] ) ?>;
                                 top: 40%;
                                 left: 40%;
                                 color: <?= $exibit_fields['cores'][$i] ?>;
                                 transform: translate( <?= $exibit_fields['x_mobile'][$i] ?>px, <?= $exibit_fields['y_mobile'][$i] ?>px );
                                 font-size: <?= $exibit_fields['tamanhos_mobile'][$i] ?>px;
                             }

                             @media screen and ( min-width: 768px ) {
                                 <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {
                                     transform: translate( <?= $exibit_fields['x_tablet'][$i] ?>px, <?= $exibit_fields['y_tablet'][$i] ?>px );
                                     font-size: <?= $exibit_fields['tamanhos_tablet'][$i] ?>px;
                                 }
                             }

                             @media screen and ( min-width: 960px ) {
                                 <?= "#vetor-" . $exibit_fields['vetor_ids'][$i] ?> {
                                     transform: translate( <?= $exibit_fields['x_desktop'][$i] ?>px, <?= $exibit_fields['y_desktop'][$i] ?>px );
                                     font-size: <?= $exibit_fields['tamanhos_desktop'][$i] ?>px;
                                 }
                             }

                        </style>

                        <div id="vetor-<?= $exibit_fields['vetor_ids'][$i] ?>" class="vetor-previa"
                            data-x="<?= $exibit_fields['x_desktop'][$i] ?>"
                            data-y="<?= $exibit_fields['y_desktop'][$i] ?>"
                            vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>">

                            <?= $exibit_fields['nomes'][$i] ?>

                        </div>
        <?php       }
                }
            }
        ?>


    </figure>


<?php } });

//Inputs do JavaScript
add_action('exibit_vetores_hook', function () {
  $the_post = get_queried_object();
  $exibit_fields = get_post_meta($the_post->ID, 'exibit_fields', true );
  ?>
  <style media="screen">
      .exibit-vetor-label {
          text-transform: uppercase;
          letter-spacing: 1px;
          margin-bottom: 18px;
      }
      .exibit-vetor-input {
          border: none;
          background: #f5f5f5;
          text-indent: 8px;
          font-weight: lighter;
          margin-bottom: 30px;
      }
  </style>
  <?php
  for ( $i =0; count( $exibit_fields['vetor_ids'] ) > $i; $i++ ) { ?>

      <label class="exibit-vetor-label"><?=$exibit_fields['nomes'][$i]?></label>
      <input type="text" class="exibit-vetor-input" id="<?= 'vetor-input-' . $exibit_fields['vetor_ids'][$i] ?>" value="">

      <script type="text/javascript">
          document.getElementById('<?= 'vetor-input-' . $exibit_fields['vetor_ids'][$i] ?>').oninput = function () {
              document.getElementById('<?= "vetor-" . $exibit_fields['vetor_ids'][$i] ?>').innerHTML = this.value;
          }
      </script>

<?php } });
