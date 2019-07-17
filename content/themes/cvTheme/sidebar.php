<div class = "contentASide">
<aside class = "aside1">


  <div class = "head1">En Son Konular</div><br>
  <?php $bcPost = new BcPost(); ?>
  <ul class = "list1">
    <?php while($bcPost -> havePosts(1)){ ?>
      <?php
      if($bcPost -> returnPost("p_title") == false)
            continue;
      ?>
    <a href = '<?php echo($bcPost -> fetchSetting ("url") . "konu/" . $bcPost -> returnPost("p_title")) ?>'><li><?php echo($bcPost -> returnPost("p_title")) ?></li></a>
  <?php } ?>

  </ul>

</aside>
<aside class = "aside1">


  <div class = "head1">Kategoriler</div><br>
  <?php
  $bcCateg = new BcCateg();
  $categName = $bcCateg -> usrCategsName;
  $categUrl = $bcCateg -> usrCategsLink;
  $categArr = explode(";",$bcCateg -> fetchSetting("userCateg"));
  ?>
  <ul class = "list1">

    <a href = ''><li><?php echo($bcCateg -> usrCategsName["general"]); ?></li></a>
    <a href = ''><li><?php echo($bcCateg -> usrCategsName["technology"]); ?></li></a>
    <a href = ''><li><?php echo($bcCateg -> usrCategsName["software"]); ?></li></a>
    <a href = ''><li><?php echo($bcCateg -> usrCategsName["videos"]); ?></li></a>

  </ul>

</aside>
</div>
