<?php
  if(isset($_COOKIE["usr"])){
    $bcUser = new BcUser();
    header("Location: " . $bcUser -> fetchSetting("url"));
  }

?>

<article class="artc1">
  <div class="textPview">
    <textarea id="uNick" placeholder = "Kullanıcı Adı" class = "textr1 ps"></textarea>
    <input id = "pw" placeholder = "Parola" type="password" class = "textr1 ps"><br>
    <input id = "rPw" placeholder = "Parola (Tekrar)" type="password" class = "textr1 ps"><br>
    <textarea id = "email" placeholder = "E-Mail" class = "textr1 ps"></textarea><br>

    <button id = "signUp" class = "button1">Üye Ol</button>
  </div>

</article>
