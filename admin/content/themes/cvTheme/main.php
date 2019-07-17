<?php include("header.php"); ?>
<?php include("sidebar.php"); ?>


<?php

  if($_GET){
    if($_GET["prcss"] == "yaziGir"){
      include("insert-post.php");
    }else if($_GET["prcss"] == "ayarGir")
      include("insert-setting.php");
    else if($_GET["prcss"] == "yaziGoster")
      include("show-posts.php");
    else if($_GET["prcss"] == "yorumGir")
      include("insert-comment.php");
    else if($_GET["prcss"] == "yorumGoster")
      include("show-comments.php");
    else if($_GET["prcss"] == "yorumDuzenle")
      include("edit-comment.php");
    else if($_GET["prcss"] == "yaziDuzenle")
      include("edit-post.php");
    else if($_GET["prcss"] == "kullaniciGoruntule")
      include("show-users.php");
    else if($_GET["prcss"] == "kullaniciGir")
      include("insert-user.php");
    else if($_GET["prcss"] == "kullaniciDuzenle")
      include("edit-user.php");
    else if($_GET["prcss"] == "mesajGir")
      include("insert-message.php");
    else if($_GET["prcss"] == "mesajGoruntule")
      include("show-messages.php");
    else if($_GET["prcss"] == "mesajDuzenle")
      include("edit-message.php");
  }

?>


<?php include("footer.php"); ?>
