<?php

  if(!$_POST || !$_POST["id"]){
    die("gg");
  }


$bcc = new BcComment();
$bcc -> currentComment = $_POST["id"];
?>
<div class = "contMenu">
  <p>p_id</p> <textarea id = "pId" class = "textr1"><?php echo($bcc -> returnComment("p_id")); ?></textarea>
  <p>c_date</p> <textarea id = "cDate" class = "textr1"><?php echo($bcc -> returnComment("c_date")); ?></textarea>
  <p>c_author</p> <textarea id = "cAuthor" class = "textr1"><?php echo($bcc -> returnComment("c_author")); ?></textarea>
  <p>content</p> <textarea id = "cContent" class = "textr8"><?php echo($bcc -> returnComment("c_content")); ?></textarea><br>
  <input id="id" type = "hidden" value = '<?php echo($bcc -> returnComment("id")); ?>'>
  <button id = "changeComment">Kaydet</button>
</div>
