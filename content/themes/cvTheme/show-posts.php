<?php
$bcPost = new BcPost();
while($bcPost -> havePosts(1,-1)){
  if($bcPost -> returnPost("p_categ") == false)
    continue;
  if((isset($_GET["categ"]) && strpos(strtolower($bcPost -> returnPost("p_categ")), strtolower($_GET["categ"])) !== false) || ! isset($_GET["categ"])){



?>
<article class="artc1">
  <div class="textPview">
    <div class="head1"><?php echo($bcPost -> returnPost("p_title")); ?></div><br>
    <div class="img1">
      <img src = '<?php echo($bcPost -> returnPost("image_url")); ?>'>
    </div><br>
    <div class="explain1"><?php echo(substr($bcPost -> returnPost("p_content"), 0, 130) . "..."); ?></div><br>

    <a href= '<?php  echo($bcPost -> fetchSetting("url") . "konu/" . $bcPost -> returnPost("p_title")); ?>'><div class="btn1">Devamını Oku</div></a>
    <br><div class = "dateOnPost" style = "right: 10;"><?php echo($bcPost -> returnPost("p_date")); ?></div>
  </div>

</article>

<?php }} ?>
