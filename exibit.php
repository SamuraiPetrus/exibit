<?php
/**
 * Plugin Name: Exibit
 * Description: Crie um modelo de exibição Real Time para os seus produtos.
 * Version: 1.0.0
 * Author: Petrus Nogueira
 *
 */

//Classes do plugin
require "includes/vetor.php";

add_action("init", "_exibit_main");

function _exibit_main ( $exibit_methods ) {

  add_action( "add_meta_boxes", "exibit_metabox_add" );
  function exibit_metabox_add () {
    add_meta_box(
      "exibit",
      "Editar vetores do produto",
      "exibit_html",
      "product",
      "normal",
      "high"
    );
  }

  function exibit_html ( $the_post ) {
    ?>
    <style media="screen">

      /* Geral */
      .exibit{
        display: flex;
        flex-wrap: wrap;
        margin: 20px 0 !important;
      }
      .exibit ul, .exibit figure {
        margin: 0;
      }

      /* Painel de controle */
      .settings{
        width: 100%;
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
      }
      .settings button{
        margin-right: 10px !important;
      }
      .settings button:last-child{
        margin-right: 0px !important;
      }

      /* Vetores */
      .vetores{
        padding-right: 25px !important;
        margin-right: 25px !important;
        width: 32%;
        max-height: 530px;
        overflow-y: scroll;
      }
      .vetor{
        background: #f1f1f1;
        border: 1px solid lightgray;
        padding: 20px;
        margin-bottom: 10px;
      }
      .vetor input{
        width: 100%;
        margin-bottom: 10px;
      }
      .dimensions{
        display: flex;
        justify-content: space-between;
      }
      .dimensions input{
        width: 48%;
      }

      /* Prévia de exibição */
      .previa{
        width: 500px;
        height: 468.58px;
        border: 2px solid lightgray;
        color: lightgray;
        font-size: 50px;
        position: relative;
      }
      .previa figcaption{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

    </style>
    <div class="exibit">
      <div class="settings">
        <button type="button" class="button tagadd" name="button">Adicionar vetor</button>
        <button type="button" class="button tagadd" name="button">Upload da imagem</button>
      </div>
      <ul class="vetores">
        <li class="vetor">
            <input type="text" placeholder="Nome" name="nome" value="" />
            <input type="text" placeholder="Fonte" name="fonte" value="" />
            <input type="text" placeholder="Tamanho" name="tamanho" value="" />
            <div class="dimensions">
              <input type="text" placeholder="X" name="dimensions_x" value="" />
              <input type="text" placeholder="Y" name="dimensions_y" value="" />
            </div>
        </li>
        <li class="vetor">
            <input type="text" placeholder="Nome" name="nome" value="" />
            <input type="text" placeholder="Fonte" name="fonte" value="" />
            <input type="text" placeholder="Tamanho" name="tamanho" value="" />
            <div class="dimensions">
              <input type="text" placeholder="X" name="dimensions_x" value="" />
              <input type="text" placeholder="Y" name="dimensions_y" value="" />
            </div>
        </li>
        <li class="vetor">
            <input type="text" placeholder="Nome" name="nome" value="" />
            <input type="text" placeholder="Fonte" name="fonte" value="" />
            <input type="text" placeholder="Tamanho" name="tamanho" value="" />
            <div class="dimensions">
              <input type="text" placeholder="X" name="dimensions_x" value="" />
              <input type="text" placeholder="Y" name="dimensions_y" value="" />
            </div>
        </li>
      </ul>
      <figure class="previa">
        <figcaption>624 x 585</figcaption>
      </figure>
    </div>
    <?php
  }

}
