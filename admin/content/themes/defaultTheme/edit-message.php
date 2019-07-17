<?php
  if(!$_POST || !$_POST["mEditBtn"]){
    die("post");
  }
  $bcMessage = new BcMessage();
  $bcMessage -> currentMessage = $_POST["id"];
?>

<div class = "contMenu">
  <p>Mesaj Başlığı</p> <textarea id = "mHead" class = "textr1"><?php echo($bcMessage -> returnMessage("m_title")); ?></textarea>
  <p>Mesaj İçeriği</p> <textarea id = "mContent" class = "textr1"><?php echo($bcMessage -> returnMessage("m_content")); ?></textarea>
  <p>Alıcı Id'leri</p> <textarea id = "rIds" class = "textr1"><?php echo($bcMessage -> returnMessage("r_ids")); ?></textarea>
  <p>Gönderici Id'si</p> <textarea id = "sId" class = "textr1"><?php echo($bcMessage -> returnMessage("s_id")); ?></textarea><br>
  <p>Göderilme Tarihi</p> <textarea id = "sDate" class = "textr1"><?php echo($bcMessage -> returnMessage("s_date")); ?></textarea><br>
  <p>Aktiflik Durumu</p> <textarea id = "aState" class = "textr1"><?php echo($bcMessage -> returnMessage("a_state")); ?></textarea><br>
  <input type = "hidden" id = "id" value = '<?php echo($bcMessage -> returnMessage("id")); ?>'>
  <button id = "changeMessage">Kaydet</button>
</div>
