<?php
  if(!$_POST)
    die("post");


    $bcPost = new BcPost();
    $bcPost -> currentPost = $_POST["id"];



 ?>
 <div class = "contMenu">
   <p>Id</p> <textarea id = "pId" class = "textr1"><?php echo($bcPost -> returnPost("id")); ?></textarea>
   <p>Başlık</p> <textarea id = "pName" class = "textr1"><?php echo($bcPost -> returnPost("p_title")); ?></textarea>
   <p>Tarih</p> <textarea id = "pDate" class = "textr1"><?php echo($bcPost -> returnPost("p_date")); ?></textarea>
   <p>Yazar</p> <textarea id = "pAuthor" class = "textr1"><?php echo($bcPost -> returnPost("p_author")); ?></textarea>

   <p>İçerik</p> <textarea id = "pContent" class = "textr8"><?php echo($bcPost -> returnPost("p_content")); ?></textarea><br>
   <input type = "file" id = "pImage">
   <input type = "hidden" id = "id" value = '<?php echo($bcPost -> returnPost("id")); ?>'>
   <button id = "changePost">Kaydet</button>
 </div>
