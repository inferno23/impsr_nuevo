<?php
  $count = count($menu['items']);
  $isEven = $count%2 === 0;
  $rowsLength = (int)($count / 2) + ($isEven ? 0 : 1);
  foreach ($menu['items'] as $index => $item) {

    $targetStr = ($item['target'] && $item['target'] === '_blank') ? 'target="_blank"' : '';

    if ($index%$rowsLength === 0) { ?>
    <div class="col-md-4">
    <?php } ?>
    <a class="dropdown-item" href="<?php echo $item['link']?>" <?php echo $targetStr ?>><?php echo $item['text']?></a>
    <?php // Termina col-md-4
    if (($index+1)%$rowsLength === 0 || $index === count($menu['items'])-1) { ?>
    </div>
    <?php }
  }
?>