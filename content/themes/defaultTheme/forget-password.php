<?php
  if(isset($_COOKIE["usr"])){
    $bcUser = new BcUser();
    header("Location: " . $bcUser -> fetchSetting("url"));
  }

?>
<article class="artc1">
  <div class="textPview">
    <input id = "fEmailCode" type = "hidden" value = '<?php echo(md5(rand(0,999999999))); ?>' />
    <textarea placeholder="E-Mail Adresi" id = "email" class = "textr1 ps"></textarea><br>
    <button id = "forgetPassword" class = "button1">Yeni Şifre İste</button>
  </div>

</article>
