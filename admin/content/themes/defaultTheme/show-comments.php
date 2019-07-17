<?php

  $bcComment = new BcComment();
?>
<div class="contMenu">
  <table class="table1" id = "showCom">
    <tr>
    <?php
    $arr = $bcComment -> returnColumn("bc_comments");
    foreach($arr as $row){
      echo("<th>" . $row["Field"] . "</th>");
    }
    ?>
  </tr>

  <?php while($bcComment -> haveComment()){ ?>
    <tr>
      <input id = "cSid" type = "hidden" value = '<?php echo($bcComment -> returnComment("s_id")); ?>'>

      <?php foreach($arr as $row){ ?>
        <td> <?php echo($bcComment -> returnComment($row["Field"])); ?></td>

      <?php } ?>
      <td>
        <form method= "POST" action="yorumDuzenle">
          <input type = "hidden" value = "<?php echo($bcComment -> returnComment("id")); ?>" name = "id" >
          <input type = "submit" value = "Değiştir" class = "cEditBtn" name = "cEditBtn">
        </form>
      </td>
  <?php }?>
  </table>
</div>




  <a href = 'yorumDuzenle?id=<?php echo($bcComment -> returnComment("s_id")); ?>'></a>
