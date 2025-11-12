<?php
  $count = count($menu['items']);
  $isEven = $count%2 === 0;
  $rowsLength = ($count > 7 ? ($count / 2) : 7) + ($isEven ? 0 : 1);

  foreach ($menu['items'] as $index => $item) {

    $targetStr = ($item['target'] && $item['target'] === '_blank') ? 'target="_blank"' : '';

    if ($index%$rowsLength === 0) {
    ?>
    <div class="col-md-3">
      <p>
        <?php if ($index === 0) { ?>
          <b><?php echo $menu['title'] ?></b>
        <?php } else { ?>&nbsp;<?php } ?>
      </p>
    <?php
    }
    ?>
    <p><a href="<?php echo $item['link']?>" <?php echo $targetStr?>><i class="fa fa-angle-right"></i> <?php echo $item['text']?></a></p>
    <?php
     // Termina col-md-3
    if (($index+1)%$rowsLength === 0 || $index === count($menu['items'])-1) {
      ?>
      </div>
      <?php 
    }
  }
?>