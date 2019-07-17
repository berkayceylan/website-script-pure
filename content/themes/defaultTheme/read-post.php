<?php
  $bcPost = new BcPost();
  $fetch = $bcPost -> fetchColumn("bc_posts", "id", "p_title", $_GET["konu"]);
  $id = $fetch["id"];
  $bcPost -> currentPost = $id;
?>
<article class="artc1">

  <div class="textPview">

    <div class="head1"><?php echo($bcPost -> returnPost("p_title")); ?></div><br>
    <br>
    <div class="img1">
      <img src = '<?php echo($bcPost -> returnPost("image_url")); ?>'>
    </div><br>
    <div class="explain1" style = "font-weight: normal"><?php echo($bcPost -> returnPost("p_content")); ?></div><br>
    <input type = "hidden" id = "pId" value = '<?php echo($bcPost -> returnPost("id")); ?>'>
    <br><div class = "dateOnPost"><?php echo($bcPost -> returnPost("p_date")); ?></div>
  </div>

</article>
