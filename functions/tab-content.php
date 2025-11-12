<div class="tab-content">
  <!-- Requisitos -->
  <div role="tabpanel" class="tab-pane <?php echo ($active === 0) ? 'active' : 'fade'; ?>" id="requisitos">
    <?php foreach ($tabs_contents['requisitos'] as $index => $requisito) { ?>
    <div class="grey tab-content__item">
      <div class="numero"><span><?php echo $index + 1 ?></span></div>
      <p><?php echo $requisito ?></p>
    </div>
    <?php } ?>
  </div>
  <!-- Documentacion -->
  <div role="tabpanel" class="tab-pane <?php echo ($active === 1) ? 'active' : 'fade'; ?>" id="documentacion">
    <div class="items">
      <?php foreach ($tabs_contents['documentacion'] as $index => $doc) { ?>
        <div class="grey tab-content__item">
          <div class="numero"><span><?php echo $index + 1 ?></span></div>
          <div><?php echo segunTipo($doc) ?></div>
        </div>
      <?php } ?>
    </div>
  </div>
  <!-- Formularios -->
  <div role="tabpanel" class="tab-pane <?php echo ($active === 3) ? 'active' : 'fade'; ?>" id="formularios">
    <ul class="lista-form">
      <?php foreach ($tabs_contents['formularios'] as $index => $archivo) { ?>
      <li>
        <i class="fa fa-file-pdf-o" style="color: grey"></i>
        <a target="_blank" href="./formularios/<?php echo $archivo['file']?>"><?php echo $archivo['title']?></a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
<?php
  function segunTipo($texto) {
    $tipo = gettype($texto);
    $textoFinal = '';

    if ($tipo === 'string') {
      $textoFinal .= '<p>'.$texto.'</p>';
    } else if ($tipo === 'array') {
      $keys = array_keys($texto);

      foreach ($keys as $key => $value) {
        $textoFinal .= '<p>'.$value.'</p>';
        $textoFinal .= '<ul>';
        foreach ($texto[$value] as $k => $_value) {
          $textoFinal .= '<li>';

          if (gettype($_value) === 'array') {
            $textoFinal .= segunTipo($_value);
          } else {
            $textoFinal .= $_value;
          }

          $textoFinal .= '</li>';
        }
        $textoFinal .= '</ul>';
      }
    }

    return $textoFinal;
  }
?>