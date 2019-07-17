<?php


include("includes.php");


$_SESSION["_token"] = md5(rand(0,999999));

include("includes/Bc.php");
$bcUser = new BcUser();
echo('<iframe style = "display:none;" src = "'. $bcUser -> fetchSetting("url") .'includes/posts.php"></iframe>');
?>



<?php

$bcFollow = new BcFollow();
$email = $_GET["followEmail"];
$code = $_GET["code"];


$aState = $bcFollow -> fetchColumn("bc_emails", "a_state" , "email", $email)["a_state"];
$emailCode = $bcFollow -> fetchColumn("bc_emails", "a_code", "email", $email)["a_code"];

if($bcFollow -> controlColumn("bc_emails","email", $email, "") && $aState == 0){
    if($emailCode == $code){

      $bcFollow -> activateEmail($email);
      echo("Aktivasyon işlemi başarılı");
      return;
    }else{
      echo("Aktivasyon kodu yanlış");
      return;
    }
  return;
}
if($bcFollow -> controlColumn("bc_emails", "email", $email, "") && $aState == 1){
  echo("Bu email bizi takip etmektedir.");
  return;
}

echo("Email adresi hatalı...");


?>
