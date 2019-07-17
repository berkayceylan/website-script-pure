<?php


include("includes.php");


$_SESSION["_token"] = md5(rand(0,999999));

include("includes/Bc.php");
$bcUser = new BcUser();
echo('<iframe style = "display:none;" src = "'. $bcUser -> fetchSetting("url") .'includes/posts.php"></iframe>');
?>

<?php

  $email = $_GET["email"];
  $code = $_GET["code"];

  //veritabanından değişkenleri çekme
  $sendedCode = $bcUser -> fetchColumn("bc_users", "f_email_code", "u_email", $email)["f_email_code"];
  $fSendedEmail = $bcUser -> fetchColumn("bc_users", "f_sended_email" , "u_email", $email)["f_sended_email"];

  if($fSendedEmail == 0){ //Yanlış email
    echo("Bu email adresine şifre yenileme maili gönderilmemiştir...");
    return;
  }
  if(trim($sendedCode) == trim($code)){ // şifre yenileme işlemi olacaksa

    //değişkenleri belirleme
    $newPassword = rand(100000, 999999);

    //send Email
    $bcUser -> sendMail($email, "Yeni Şifreniz", "Tebrikler şifrenizi değiştirdiniz...\n\n\n Yeni Şifre: " . $newPassword . "\n\n\n Şifrenizi ayarlar bölümünden değiştirebilirsiniz...");

    //şifre değiştirme - şifre yenileme kodu sıfırlama
    $query = $GLOBALS["db"] -> prepare("UPDATE bc_users SET u_password = ?, f_sended_email = ?, f_email_code = ? WHERE u_email = ?");
    $query -> execute(array(md5($newPassword), 0, " ", $email));


    //bilgi mesajı
    echo("Yeni şifreniz email adresine gönderildi...");
  }else{ // yanlış kod
    echo("Şifre yenileme kodu yanlıştır.");
  }
?>
