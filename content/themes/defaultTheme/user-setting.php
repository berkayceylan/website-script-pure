<?php
  if(!isset($_COOKIE["usr"]))
    return;
  $bcUser = new BcUser();
  $fetch = $bcUser -> fetchColumn("bc_users", "id", "s_id", $_COOKIE["usr"]);
  $bcUser -> currentUser = $fetch["id"];
?>
<article class="artc1">
  <div class="textPview">

      <?php echo(trim($bcUser -> returnUser("u_nick"))); ?><br><br>


      <img src = "<?php echo($bcUser -> returnUser("u_p_i_url")); ?>">
    <br><br>
    <input id = "id" type="hidden" value = '<?php echo($bcUser -> returnUser("id")); ?>'>
    <input type = "file" id = "uImage"><br><br>
    <textarea id = "email" placeholder = "E-Mail" class = "textr1 ps"><?php echo($bcUser -> returnUser("u_email")); ?></textarea><br>

    <input id = "pw" placeholder = "Parola" type="password" class = "textr1 ps"><br>
    <input id = "rPw" placeholder = "Parola (Tekrar)" type="password" class = "textr1 ps"><br>

    <input id = "oPw" placeholder = "Eski Parola" type="password" class = "textr1 ps"><br>

    <button id = "changeProfile" class = "button1">Kaydet</button>
  </div>

</article>
