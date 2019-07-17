<?php
  $bcMessage = new BcMessage();

?>

<div class="contMenu">
  <table class="table1" id = "showPost">
    <tr>
      <?php
      $arr = $bcMessage -> returnColumn("bc_messages");
      foreach ($arr as $row ) {
        echo("<th>" . $row["Field"] . "</th>");
      }
      ?>
    </tr>
    <?php while($bcMessage -> haveMessages()){ ?>

      <tr>

      <?php foreach($arr as $row){ ?>
        <td><?php echo($bcMessage -> returnMessage($row["Field"])); ?></td>
      <?php } ?>
      <td>
        <form method = "POST" action = "mesajDuzenle">
          <input name = "id" type = "hidden" value = "<?php echo($bcMessage -> returnMessage('id')); ?>">
          <input type = "submit" value="Değiştir" name = "mEditBtn">
        </form>
      </td>
    </tr>
  <?php }//inset ile editler aynı dosyada yapılabilirdi. ?>
  </table>
</div>
