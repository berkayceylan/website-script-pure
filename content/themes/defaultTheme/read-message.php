
<?php
  if(!isset($_GET["msg"]) || !isset($_COOKIE["usr"]))
    return;
  $bcMessage = new BcMessage();
  $bcUser = new BcUser();
  $fetch = $bcMessage -> fetchColumn("bc_messages", "id", "m_id", $_GET["msg"]);
  $id = $fetch["id"];
  $bcMessage -> currentMessage = $id;
?>
<article class="artc1">
  <div class="textPview">

    <div class="rmBox"><div class = "rmProperty">Başlık: </div><?php echo( " ".$bcMessage -> returnMessage("m_title")); ?></div><br>
    <div class="rmBox"><div class = "rmProperty">Gönderen:</div> <?php $bcUser -> printUser($bcMessage -> returnMessage("s_id")); ?></div><br>
    <div class="rmBox" style = "font-weight: normal"><?php echo($bcMessage -> returnMessage("m_content")); ?></div><br>
    <a href = '<?php echo($bcMessage -> fetchSetting("url") . "islem/mesaj-gonder&rcv=" . $bcMessage -> returnMessage("s_id")); ?> ' class = "button2">Yanıt Yaz</a>
    <input type = "hidden" id = "pId" value = '<?php echo($bcMessage -> returnMessage("id")); ?>'>

  </div>

</article>
