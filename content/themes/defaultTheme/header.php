<?php $bcUser = new BcUser(); ?>
<html>
<head>
<title></title>
<?php echo(
  '<link rel = "stylesheet" type = "text/css" href="' . $bcUser -> fetchSetting("themeUrl") . 'css/blog.css">'); ?>
</head>
<?php echo('<input id = "_token" type = "hidden" value = "' . $_SESSION["_token"] . '" >');?>
<nav class = "navbar">
  <div class ="topBar">
    <ul class = "topMenu">
      <a href = "<?php echo($bcUser -> fetchSetting("url"));  ?>"><li>Anasayfa</li></a>

    </ul>
    <?php

      if(isset($_COOKIE["usr"])){

        $fetch = $bcUser -> fetchColumn("bc_users", "id", "s_id", $_COOKIE["usr"]);
        $bcUser -> currentUser = $fetch["id"];
        if($fetch["id"] != ""){
    ?>
    <div class = "myProfile"><?php echo($bcUser -> returnUser("u_nick")) ?></div>
    <ul class = "myProfileMenu">
      <li><img src = '<?php echo($bcUser -> returnUser("u_p_i_url")) ?>'></li>
      <a href= '<?php  echo($bcUser -> fetchSetting("url") . "profil/" . $bcUser -> returnUser("u_nick")); ?>'><li>Profilim</li></a>
      <a href= '<?php  echo($bcUser -> fetchSetting("url") . "islem/ayarlar"); ?>'><li>Ayarlar</li></a>
      <a href= '<?php  echo($bcUser -> fetchSetting("url") . "islem/mesajlar"); ?>'><li>Mesajlar</li></a>
      <li id = "userQuit">Çıkış Yap</li>
    </ul>
  <?php } }else{?>
    <a href = "<?php echo($bcUser -> fetchSetting("url") . 'islem/giris-yap');  ?>"><div class = "myProfile">Giriş Yap</div></a>
    <a href = "<?php echo($bcUser -> fetchSetting("url") . 'islem/kayit-ol');  ?>"><div class = "myProfile">Kayıt Ol</div></a>
      <div class = "followNewArea">
      <div style = "margin-right: 30px" class = "myProfile" id = "followNewButton">
        Takipte Kal

      </div>
      <div class = "followNewRegistry">
        <input type = "text" id = "followEmail" />
        <input type = "hidden" id = "followEmailCode" value = '<?php echo(md5(rand(0,9999999))); ?>' />
        <input type = "button" value = "Takip Et" id = "followWebsite">
      </div>
      </div>

    </div>

  <?php } ?>

  </div>

</nav>
<body>
