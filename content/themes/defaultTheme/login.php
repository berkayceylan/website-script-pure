<?php
  if(isset($_COOKIE["usr"])){
    $bcUser = new BcUser();
    header("Location: " . $bcUser -> fetchSetting("url"));
  }

?>

<article class="artc1">
  <div class="textPview">
    <textarea placeholder="Kullanıcı Adı" id = "uNick" class = "textr1 ps"></textarea>
    <input placeholder="Parola" id = "uPw" type="password" class = "textr1 ps"><br>

    <input id = "remember" checked = "checked" type = "checkbox">Beni Hatırla<br><br>
    <button id = "login" class = "button1">Giriş Yap</button><br><br>
    <a href = '<?php echo($bcUser -> fetchSetting("url") . "islem/yeni-sifre"); ?>'>Şifremi Unuttum</a>
  </div>

</article>
