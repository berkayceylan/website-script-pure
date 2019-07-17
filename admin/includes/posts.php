

<?php include("../../settings.php"); ?>

<?php include("../../includes/Bc.php"); ?>

<?php



  if(!$_POST["_token"] || $_POST["_token"] != $_SESSION["_token"]){

    echo($_POST["_token"] . "\n" . $_SESSION["_token"]);

    die("CSRF'lendin");



  }



  if($_POST["type"] == "insert-post"){

      $bcPost = new BcPost();

      $uNick = $bcPost -> fetchColumn("bc_users", "u_nick", "s_id", $_COOKIE["usr"])["u_nick"];





      $imageUrl = $bcPost -> uploadImage($_FILES["ipImage"], $bcPost -> replaceFromTr(strtolower(

        str_replace(" ", "_", $_POST["ipTitle"])

      )));
      $isPublish = ($_POST["ipPublish"] == "true") ? 1 : 0;
      $isPreview = ($_POST["ipPreview"] == "true") ? 1 : 0;
      
      $bcPost -> insertPost(array(

        "pTitle" => $_POST["ipTitle"],

        "pDate" => "",

        "pAuthor" => $uNick,

        "sId" => md5(rand(0,9999999)),

        "pContent" => $_POST["ipContent"],

        "pComments" => "",

        "pCateg" => "Genel",

        "imageUrl" => $imageUrl,

        "isPublish" => $isPublish,

        "isPreview" => $isPreview

      ));

      //$pQuery = $db -> prepare("INSERT INTO bc_posts (p_title,p_date,p_author,s_id,p_content,p_comments,p_categ,image_url) VALUES (?,?,?,?,?,?,?,?)");

      //$pQuery -> execute(array($_POST["ipTitle"],"","sparrowx","1234",$_POST["ipContent"],"adssad,asdasd","Genel",$imageUrl));



  }else if($_POST["type"] == "insert-setting"){

    $query = $db -> prepare("INSERT INTO bc_settings(setting,value) VALUES(?,?)");

    $query -> execute(array($_POST["setting"], $_POST["value"]));

  }else if($_POST["type"] == "insert-comment"){

    $sId = md5(rand(0,999999));

    $query = $db -> prepare("INSERT INTO bc_comments(p_id,c_date,c_author,c_content,is_active,s_id) VALUES(?,?,?,?,?,?)");

    $query ->

    execute(array($_POST["pId"],$_POST["cDate"],$_POST["cAuthor"],$_POST["cContent"],1,$sId));



  }else if($_POST["type"] == "edit-comment"){



  $query = $db -> prepare("UPDATE bc_comments SET p_id = ?,c_date = ?,c_author = ?,c_content = ?,is_active = ? WHERE id = ?");

  $query ->

  execute(array($_POST["pId"],$_POST["cDate"],$_POST["cAuthor"],$_POST["cContent"],1, $_POST["id"]));



  }

  else if($_POST["type"] == "edit-post"){

    //column adı değişkene atanabilir bu sayede veritabanından bir şey değiştirdiğimizde sadece bir yerden değiştirmiş oluruz



    $bcPost = new BcPost();

    $imgUrl = "";

    if(isset($_FILES["pImage"])){

      $imgUrl = $bcPost -> uploadImage($_FILES["pImage"], $bcPost -> replaceFromTr(strtolower(str_replace(" ", "_", $_POST["pName"]))));

    }

    //post array gibi düşünülüp ppost index leriyle kolaylık sağlanabilir.

    $bcPost -> editPost(array(

      "pTitle" => $_POST["pName"],

      "pDate" => $_POST["pDate"],

      "pAuthor" => $_POST["pAuthor"],

      "pContent" => $_POST["pContent"],

      "id" => $_POST["id"],

      "img" => $imgUrl

    ));

    //$query = $db -> prepare("UPDATE bc_posts SET p_title = ?,p_date = ?,p_author = ?,p_content = ?,is_publish = ? WHERE id = ?");

    //$query -> execute(array($_POST["pName"],$_POST["pDate"],$_POST["pAuthor"],$_POST["pContent"],1, $_POST["id"]));



  }else if($_POST["type"] == "insert-user"){



    $sId = md5(rand(0,999999));

    $pw = md5($_POST["iuPassword"]);





    //Control E Mail and Nickname

    $bcUser = new BcUser();

    $imgUrl = "";



    if(isset($_FILES["iuPIUrl"])){

      $imgUrl = $bcUser -> uploadImage($_FILES["iuPIUrl"], str_replace(" ", ",", $_POST["iuNick"]));

    }



    $bcUser -> insertUser($_POST["iuNick"], $pw, $_POST["iuEMail"], $sId, $imgUrl, $_POST["iuRDate"], $_POST["iuIsActive"]);

  }else if($_POST["type"] == "edit-user"){



    $bcUser = new BcUser();





    //--



    $pw = md5($_POST["uPw"]);

    $imgUrl = "";

    if(isset($_FILES["uPImage"])){

      $imgUrl = $bcUser -> uploadImage($_FILES["uPImage"], str_replace(" ", ",",$_POST["uNick"]));

    }



    $sId = $bcUser -> returnUser("s_id");

    $bcUser -> editUser($_POST["id"], $_POST["uNick"], $pw, $_POST["uEmail"], $sId, $imgUrl,

      $_POST["uRDate"], $_POST["uIsActive"]);





  }else if ($_POST["type"] == "insert-message"){

    $bcMessage = new BcMessage();

    $bcMessage -> insertMessage($_POST["mHead"],$_POST["mContent"],$_POST["sId"],$_POST["rIds"],$_POST["sDate"],$_POST["aState"]);



  }else if ($_POST["type"] == "edit-message"){



    $bcMessage = new BcMessage();

    $bcMessage -> editMessage($_POST["id"],$_POST["mHead"],$_POST["mContent"],$_POST["sId"],$_POST["rIds"],$_POST["sDate"],$_POST["aState"]);



  }



?>

