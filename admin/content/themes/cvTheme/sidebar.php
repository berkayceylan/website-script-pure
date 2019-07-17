
<ul class = "aside">

  <?php
  $bcCateg = new BcCateg();
  $categName = $bcCateg -> admCategsName;
  $categUrl = $bcCateg -> admCategsLink;

?>
<div class = "subSideMenu">
<li><?php echo($categName["posts"]); ?></li>
  <div class = "subSide">

      <a href = '<?php echo($categUrl["showPosts"]); ?>'><li><?php echo($categName["showPosts"]); ?></li></a>
      <a href = '<?php echo($categUrl["insertPost"]); ?>'><li><?php echo($categName["insertPost"]); ?></li></a>


  </div>
</div>
<div class = "subSideMenu">
<li><?php echo($categName["users"]); ?></li>
  <div class = "subSide">

      <a href = '<?php echo($categUrl["showUsers"]); ?>'><li><?php echo($categName["showUsers"]); ?></li></a>
      <a href = '<?php echo($categUrl["insertUser"]); ?>'><li><?php echo($categName["insertUser"]); ?></li></a>


  </div>
</div>
<div class = "subSideMenu">
<li><?php echo($categName["comments"]); ?></li>
  <div class = "subSide">

      <a href = '<?php echo($categUrl["showComments"]); ?>'><li><?php echo($categName["showComments"]); ?></li></a>
      <a href = '<?php echo($categUrl["insertComment"]); ?>'><li><?php echo($categName["insertComment"]); ?></li></a>


  </div>
</div>
<div class = "subSideMenu">
<li><?php echo($categName["messages"]); ?></li>
  <div class = "subSide">

      <a href = '<?php echo($categUrl["showMessages"]); ?>'><li><?php echo($categName["showMessages"]); ?></li></a>
      <a href = '<?php echo($categUrl["insertMessage"]); ?>'><li><?php echo($categName["insertMessage"]); ?></li></a>


  </div>
</div>
</ul>
