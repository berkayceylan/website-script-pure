<?php include("header.php"); ?>









<?php //include("sidebar.php"); ?>



<?php

  if(isset($_GET["prcss"])){

    if($_GET["prcss"] == "yazilari-goster"){

      include("show-posts.php");

    }else if($_GET["prcss"] == "giris-yap"){

      include("login.php");



    }else if($_GET["prcss"] == "kayit-ol"){

      include("sign-up.php");

    }else if($_GET["prcss"] == "mesajlar"){

      include("messages.php");

    }else if($_GET["prcss"] == "yorumlar"){

      include("comments.php");

    }else if($_GET["prcss"] == "ayarlar"){

      include("user-setting.php");

    }else if($_GET["prcss"] == "mesaj-gonder")

      include("write-message.php");

    else if($_GET["prcss"] == "mesaj-oku")

      include("read-message.php");

    else if($_GET["prcss"] == "yeni-sifre")

        include("forget-password.php");

  }else if(isset($_GET["usr"])){

    include("show-users.php");

  }else if(isset($_GET["konu"])){

    include("read-post.php");

    include("comments.php");

    include('write-comment.php');

  }else if (isset($_GET["show"])){
    
      include("show-all.php");
    
  }else{
	  include("top-section.php");
    include("blog-preview.php");
    include("education-preview.php");
	  include("contact.php");
	  include("slider.php");
	  
    //top section
    //blog preview - include("show-posts.php");
    //videos pictures
    //slider
  }





?>







<?php include("footer.php"); ?>

