<?php
$bcDb = new BcPost();

?>
<div class="contMenu">
  <table class="table1" id = "showPost">
    <tr>
      <?php
      $arr = $bcDb -> returnColumn("bc_posts");
      foreach ($arr as $row ) {
        echo("<th>" . $row["Field"] . "</th>");
      }
      ?>
    </tr>
    <?php while($bcDb -> havePosts()){ ?>
    <tr>
      <?php foreach($arr as $row){ ?>
        <td><?php echo($bcDb -> returnPost($row["Field"])); ?></td>
      <?php } ?>
      <td>
        <form method = "POST" action = "yaziDuzenle">
          <input name = "id" type = "hidden" value = "<?php echo($bcDb -> returnPost('id')); ?>">
          <input type = "submit" value="Değiştir" name = "pEditBtn">
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
