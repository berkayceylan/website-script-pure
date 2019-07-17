<?php
  $bcUser = new BcUser();

?>
<div class="contMenu">
  <div class = "tableDiv">
  <table class="table1" id = "showPost">
    <tr>
      <?php
      $arr = $bcUser -> returnColumn("bc_users");
      foreach ($arr as $row ) {
        echo("<th>" . $row["Field"] . "</th>");
      }
      ?>
    </tr>
    <?php while($bcUser -> haveUsers()){ ?>

      <tr>

      <?php foreach($arr as $row){ ?>
        <td><?php echo($bcUser -> returnUser($row["Field"])); ?></td>
      <?php } ?>
      <td>
        <form method = "POST" action = "kullaniciDuzenle">
          <input name = "id" type = "hidden" value = "<?php echo($bcUser -> returnUser('id')); ?>">
          <input type = "submit" value="Değiştir" name = "uEditBtn">
        </form>
      </td>
    </tr>
  <?php }//inset ile editler aynı dosyada yapılabilirdi. ?>
  </table>
</div>
</div>
