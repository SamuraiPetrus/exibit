<?php

/*

  Exibit View

  Camada de apresentação.

*/

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
            height: 568px;
            width: 600px;
        }

        .exibit-view img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

    </style>

    <figure class="exibit-view u-sizeFull u-positionRelative">

        <img src="<?=$exibit_preview?>">

        <?php
            if ( is_array( $exibit_fields ) ) {
                if ( count( $exibit_fields['vetor_ids'] ) > 0 ) {
                    for ( $i = 0; $i < count( $exibit_fields ); $i++ ) {
                        $fonte = get_post($exibit_fields['fontes'][$i]);
                        $url = get_post_meta( $fonte->ID, 'exibit_fonte_upload_meta', true );
                        echo '
                        <style type="text/css" media="screen, print">

                         @font-face {
                             font-family: '.$fonte->post_title.';
                             src: url("'.$url.'");
                             font-weight: normal;
                         }

                        </style>';?>
                      <div id="vetor-<?= $exibit_fields['vetor_ids'][$i] ?>" class="vetor-previa"
                          data-x="<?= $exibit_fields['x_desktop'][$i] ?>"
                          data-y="<?= $exibit_fields['y_desktop'][$i] ?>"
                          vetor-id="<?= $exibit_fields['vetor_ids'][$i] ?>"
                          style="
                            position: absolute;
                            font-family: <?= get_the_title( $exibit_fields['fontes'][$i] ) ?>;
                            top: 40%;
                            left: 40%;
                            transform: translate( <?= $exibit_fields['x_desktop'][$i] ?>px, <?= $exibit_fields['y_desktop'][$i] ?>px );
                            color: <?= $exibit_fields['cores'][$i] ?>;
                            font-size: <?= $exibit_fields['tamanhos_desktop'][$i] ?>px;
                          ">
                          <!-- Nome -->
                          <?= $exibit_fields['nomes'][$i] ?>
                      </div>
        <?php       }
                }
            }
        ?>


    </figure>


<?php } });
