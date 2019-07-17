<?php
  if(!$_GET["usr"])
    die("Hata !");
  $bcUser = new BcUser();
  $bcUser -> setUser($_GET["usr"]);
?>
  <!-- show profile -->
  <article class="artc1">
    <div class="textPview listInf">
       <div><img src = '<?php echo($bcUser -> returnUser("u_p_i_url")); ?>'></div>
       <p>İsim</p>
       <div> <?php echo($bcUser -> returnUser("u_nick")); ?></div>
       <p>Email</p>
       <div><?php echo($bcUser -> returnUser("u_email")); ?></div>
       <p>Kayıt Tarihi</p>
       <div><?php echo($bcUser -> returnUser("u_r_date")); ?></div>

    </div>
  </article>
