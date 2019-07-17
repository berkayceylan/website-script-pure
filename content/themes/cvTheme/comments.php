<?php
  $bcComment = new BcComment();
  $bcPost = new BcPost();
  $bcUser = new BcUser();

  $pId = $bcComment -> fetchColumn("bc_posts", "id", "p_title", $_GET["konu"])["id"];
  while($bcComment -> haveComment()){
   if($bcComment -> returnComment("p_id") == $pId && $bcComment -> returnComment("is_active") == 1){
     $bcUser -> currentUser = $bcUser -> fetchColumn("bc_users", "id", "u_nick", $bcComment -> returnComment("c_author"));
  ?>
<article class="artc1">
  <div class="textPview">
    <div class = "commentBox" id = "commentBox">

      <div class="cusrNick"><?php $bcUser -> printUser($bcComment -> returnComment("c_author")); ?></div>
      <div id = "commentContent" class="commentContent"><?php echo($bcComment -> returnComment("c_content")); ?></div>
      <div class="cusrImg"><img src = '<?php echo($bcUser -> returnUser("u_p_i_url"))?>' ></div>
      <input type = "hidden" id = "id" value = '<?php echo($bcComment -> returnComment("id")); ?>'>
      <?php

        if(isset($_COOKIE["usr"]) &&
          $_COOKIE["usr"] == $bcComment -> fetchColumn("bc_users", "s_id", "u_nick", $bcComment -> returnComment("c_author"))["s_id"]){
          echo("<button class = 'button2 editComment'>düzenle</button><button id = 'deleteComment' class = 'button2 deleteComment'>Sil</button>");
        }
      ?>

    </div>
    <br><div class = "dateForComment"><?php echo($bcComment -> returnComment("c_date")); ?></div>
</article>
<?php }} ?>
