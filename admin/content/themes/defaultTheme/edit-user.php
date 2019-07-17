<?php
  if(!$_POST || !$_POST["uEditBtn"]){
    die("post");
  }
  $bcUser = new BcUser();
  $bcUser -> currentUser = $_POST["id"];
?>

<div class = "contMenu">
  <p>Nick</p> <textarea id = "uNick" class = "textr1"><?php echo($bcUser -> returnUser("u_nick")); ?></textarea>
  <p>Parola</p> <textarea placeholder="(Değişmedi)" id = "uPw" class = "textr1"></textarea>
  <p>E-Mail</p> <textarea id = "uEmail" class = "textr1"><?php echo($bcUser -> returnUser("u_email")); ?></textarea>
  <p>Kayıt Tarihi</p> <textarea id = "uRDate" class = "textr1"><?php echo($bcUser -> returnUser("u_r_date")); ?></textarea>
  <p>Profil Resmi</p> <input type = "file" class = "textr1" id = "uPIUrl"><br>
  <p>Aktiflik Durumu</p> <textarea id = "uIsActive" class = "textr1"><?php echo($bcUser -> returnUser("u_active")); ?></textarea><br>
  <input type = "hidden" id = "id" value = '<?php echo($bcUser -> returnUser("id")); ?>'>
  <button id = "changeUser">Kaydet</button>
</div>
