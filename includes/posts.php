<?php



   include("../settings.php");

  include("Bc.php");

  if(isset($_POST["_token"]) == false || isset($_POST["type"]) == false)

    die("POST !");

  if($_POST["_token"] != $_SESSION["_token"]){

    echo($_POST["_token"] . "\n" . $_SESSION["_token"] . "\n");

    die("TOKEN !");

  }





  if($_POST["type"] == "sign-up"){

    if($_POST["pw"] != $_POST["rPw"]){

      echo("Parolalar aynı değil");

      return;

    }



    $bcUser = new BcUser();

    $bcUser -> insertUser($_POST["uNick"], $_POST["pw"], $_POST["email"], md5(rand(0,999999)), "", "", 1);



  }

  if($_POST["type"] == "login"){





    $bcUser = new BcUser();

    if($bcUser -> login(htmlspecialchars($_POST["uNick"]), ($_POST["uPw"]), $_POST["remember"])){

      echo("Giriş Başarılı");

    }

    return;

  }

  if($_POST["type"] == "change-profile"){

    $bcUser = new BcUser();

    $bcUser -> currentUser = $_POST["id"];

    $imgUrl = $bcUser -> returnUser("u_p_i_url");

    if(isset($_FILES["img"])){

      $imgUrl = $bcUser -> resizeAndUploadImage($_FILES["img"], $_POST["id"], 480, $bcUser -> fetchSetting("path") . "content/images/");

    }

    $bcUser -> editUser($_POST["id"], $bcUser -> returnUser("u_nick"), "", $_POST["email"],

      $bcUser -> returnUser("s_id"), $imgUrl, $bcUser -> returnUser("u_r_date"), $bcUser -> returnUser("u_active"));

    if(strlen($_POST["pw"]) > 4 && $_POST["pw"] == $_POST["rPw"]){

      if(md5($_POST["oPw"]) != $bcUser -> returnUser("u_password")){

        echo("Parola Yanlış !");

        return false;

      }

      if($bcUser -> editPassword($_POST["pw"], $_POST["id"])){

        echo("Parola Değişti.");

      }



    }

    return true;

  }

  if($_POST["type"] == "insert-comment"){

    $bcComment = new BcComment();



    $sId = md5(rand(0,999999));

    $author = $bcComment -> fetchColumn("bc_users", "u_nick" , "s_id", $_COOKIE["usr"])["u_nick"];

    $comment = htmlspecialchars($_POST["comment"]);



    $bcComment -> insertComment(array(

      "p_id" => $_POST["pId"],

      "c_date" => "",

      "c_author" => $author,

      "c_content" => $comment,

      "is_active" => 1,

      "s_id" => $sId

    ));



    return true;

  }

  if($_POST["type"] == "send-message"){

    $bcMessage = new BcMessage();

    $receiver = explode(",", $_POST["receiver"]);

    print_r($receiver);

    foreach ($receiver as $row) {

    echo($row);



    $mId = md5(rand(0,999999));

    $sNick = $bcMessage -> fetchColumn("bc_users", "u_nick", "s_id", $_COOKIE["usr"])["u_nick"];

    if($bcMessage -> controlColumn("bc_users","u_nick",$row,"") == false){

      echo($row . " Kullanıcısı Bulunamadı");



    }else{

      $bcMessage ->

        insertMessage($_POST["mTitle"],$_POST["mContent"],$row,$sNick,"",1,$mId);

    }

    }

    return true;

  }

  if($_POST["type"] == "change-comment"){

    $bcComment = new BcComment();

    $bcComment -> editComment(array(htmlspecialchars($_POST["cContent"]),$_POST["id"]));

    return true;

  }

  if($_POST["type"] == "delete-comment"){

    $bcComment = new BcComment();

    $bcComment -> deleteComment($_POST["id"]);

    return true;

  }

  if($_POST["type"] == "quit-user"){

    if(isset($_COOKIE["usr"])){

      setcookie("usr", "", time() -1, "/");

    }

    return true;

  }

  if($_POST["type"] == "send-trash"){

    $bcMessage = new BcMessage();

    $bcMessage -> state("m_id", 2, $_POST["m_id"]);



  }

  if($_POST["type"] == "remove-from-trash"){

    $bcMessage = new BcMessage();

    $bcMessage -> state("m_id", 1, $_POST["m_id"]);



  }

  if($_POST["type"] == "remove"){

    $bcMessage = new BcMessage();

    $bcMessage -> state("m_id", 0, $_POST["m_id"]);



  }

  if($_POST["type"] == "followWebsite"){

      //controlEmail fonksiyonu yazılacak

      $bcFollow = new BcFollow();

      $email = $_POST["followEmail"];

      $code = $_POST["followEmailCode"];



      $url = $bcFollow -> fetchSetting("url") . "verify-follow-email.php?followEmail=" . $email . "&code=" . $code;//geçici

      $aState = $bcFollow -> fetchColumn("bc_emails", "a_state" , "email", $email)["a_state"];



      if($bcFollow -> controlColumn("bc_emails","email", $email, "") && $aState == 0){

        echo("Lütfen aktivasyon linkine tıklayınız.");

        return;

      }

      if($bcFollow -> controlColumn("bc_emails", "email", $email, "") && $aState == 1){

        echo("Bu email bizi takip etmektedir.");

        return;

      }



      $bcFollow -> followWebsite($_POST["followEmail"], $code);

      $bcFollow -> sendMail($email, "Website Takip Onayı", "Websitemizi takip etmek için aşağıdaki bağlantıdan E-mail'inizi onaylayabilirsiniz\n\n\n" . $url);



      echo($url);

      return;

  }

  if($_POST["type"] == "change-password"){

    $bcUser = new BcUser();

    $email = $_POST["email"];

    $code = $_POST["fEmailCode"];



    $url = $bcUser -> fetchSetting("url") . "reset-password.php?email=" . $email . "&code=" . $code;//geçici

    $sendedEmail = $bcUser -> fetchColumn("bc_users", "f_sended_email" , "u_email", $email)["f_sended_email"];



    $usedEmail = $bcUser -> controlColumn("bc_users","u_email", $email, "");

    if($usedEmail == false){

      echo("Bu email ile kayıtlı bir kullanıcı yoktur...");

      return;

    }

    if($sendedEmail == 0){

      //email gönderme //test edilecek

      $bcUser -> sendMail($email, "Şifre Yenileme Talebi", "Aşağıdaki bağlantıdan yeni şifrenizi alabilirsiniz...\n\n\n" . $url);



      //code ekleme ve email değiştirme

      $query = $GLOBALS["db"] -> prepare("UPDATE bc_users SET f_email_code = ?, f_sended_email = ? WHERE u_email = ?");

      $query -> execute(array($code, 1, $email));



      //bilgilendirme

      echo($url . "\n"); // Kaldırılacak

      echo("E-posta gönderildi...");

      return;

    }

    if($sendedEmail == 1){

      echo("Şifre yenileme e-maili zaten gönderilmiş.");

      return;

    }

  }
  if($_POST["type"] == "setTurkish"){
    setcookie("lang", "tr", time() + 9999999999, "/");
    echo("lang setted");
  }
  if($_POST["type"] == "setEnglish"){
    setcookie("lang", "en", time() + 9999999999, "/");
    echo("lang Setted");
  }

