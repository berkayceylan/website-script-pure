<?php

class BcUser extends BcDb{

public $user;

public $currentUser = 0;

private $countUser;

public $userName;

//echo <a href="#nick">nick</a> şeklinde yazdıran bir fonksiyon eklenecek

function __construct(){

  $this -> countUser = count($this -> fetchId("bc_users"));

}

function printUser($nick = ""){

  if($nick == ""){

    echo('<a href = "' . $this -> fetchSetting("url") . "profil/" . $this -> returnUser("u_nick") . '">'. $this -> returnUser("u_nick") . "</a>");

    return true;

  }

  $this -> currentUser = $this -> fetchColumn("bc_users", "id", "u_nick", $nick)["id"];



  echo('<a href = "' . $this -> fetchSetting("url") . "profil/" . $this -> returnUser("u_nick") . '">'. $this -> returnUser("u_nick") . "</a>");

  return true;

}

function haveUsers(){



  if($this -> currentUser < $this -> countUser){



    $fetch = $this -> fetchColumn("bc_users","s_id", "id", $this -> currentUser);

    $this -> user = $fetch["s_id"];





    $this -> currentUser++;

    return true;

  }

}

function editPassword($pw,$id){





  if($this -> controlPassword($pw) == false)

    return false;



  $query = $GLOBALS["db"] -> prepare("UPDATE bc_users SET u_password = ? WHERE id = ?");

  $query -> execute(array(md5($pw),$id));

  return true;

}

function setUser($usrName){

  $fetch = $this -> fetchColumn("bc_users","id","u_nick", $usrName);

  $this -> currentUser = $fetch["id"];

}

function returnUser($column){

  $fetch = $this -> fetchColumn("bc_users",$column,"id", $this -> currentUser);

  /* ispublish burada uygulanabilir */

  return $fetch[$column];

}

function insertUser($userNick, $userPw, $userEmail, $sId, $imageUrl, $registryDate, $userActive){

  if($this -> controlColumn("bc_users", "u_nick", $userNick,"")){

    echo("Bu Nick Kullanılmaktadır.");

    return false;

  }else if($this -> controlColumn("bc_users", "u_email", $userEmail,"")){

    echo("Bu E-Mail Kullanılmaktadır");

    return false;

  }

  if(trim($userNick) == "" || trim($userEmail) == "" || trim($userPw) == ""){

    echo("Boş alan bırakılmamalıdır.");

    return false;

  }

  if($this -> controlEmail($userEmail) == false){
    echo("E-mail ERROR !");
    return false;
  }

    

  if($this -> controlPassword($userPw) == false){
    echo("PW ERROR !");
    return false;
  }



  
  $query = $GLOBALS["db"] -> prepare("INSERT INTO bc_users(u_nick, u_password, u_email, s_id, u_p_i_url, u_r_date,u_active, u_rank, f_sended_email, f_email_code) VALUES (?,?,?,?,?,?,?,?,?,?)");

  $result = $query -> execute(array(htmlspecialchars($userNick), md5($userPw), htmlspecialchars($userEmail), $sId, $imageUrl, $registryDate, $userActive, 0, 0, "-1"));

  if($result == true){

    echo("Kayıt işlemi başarılı.");

  }

  return true;

}

function editUser($id, $userNick, $userPw, $userEmail, $sId, $imageUrl, $registryDate, $userActive){

  if($this -> controlColumn("bc_users", "u_nick", $userNick,$this -> fetchColumn("bc_users", "u_nick", "id", $id)["u_nick"])){

    echo("Bu Nick Kullanılmaktadır");

    return;

  }else if($this -> controlColumn("bc_users", "u_email", $userEmail,$this -> fetchColumn("bc_users", "u_email", "id", $id)["u_email"])){

    echo("Bu E-Mail Kullanılmaktadır");

    return;

  }

  if(trim($imageUrl) == ""){

    $imageUrl = $this -> fetchColumn("bc_users", "u_p_i_url", "id", $id)["u_p_i_url"];

  }

  $query = $GLOBALS["db"] -> prepare("UPDATE bc_users SET u_nick = ?, u_email = ?, s_id = ?, u_p_i_url = ?, u_r_date = ?, u_active = ? WHERE id = ?");

  $query -> execute(array($userNick, $userEmail, $sId, $imageUrl, $registryDate, $userActive,$id));



}

function login($uNick, $uPw){

  $fetchPw = $this -> fetchColumn("bc_users", "u_password", "u_nick", $uNick);

  $login = false;

  $sId = "";

  if(md5($uPw) == $fetchPw["u_password"]){

    $login = true;

    $fetchSId = $this -> fetchColumn("bc_users", "s_id", "u_nick", $uNick);

    $sId = $fetchSId["s_id"];



  }



  if($login == true){

    $time = time() + 60 * 60 * 3;

    if($_POST["remember"]){

      $time = time() + 60 * 999999;

    }

    setcookie("usr", $sId, $time,"/");

    if(isset($_COOKIE["usr"])){

      echo("Başarı");

    }

  }else{

    echo("Giriş başarılı değil -- " . $fetchPw["u_password"] . " -- " . $uPw);

  }

  return $login;

}

function controlLogin($uName, $uPw){

  $fetch = $this -> fetchColumn("bc_users", "u_password","u_nick", $uName);

  $pw = $fetch["u_password"];

  if($pw == md5($uPw)){

    return true;

  }

  return false;



}

function followWebsite($email){

  $query = $GLOBALS["db"] -> prepare("INSERT INTO bc_emails (email, date, a_state, n_categ, a_code) VALUES(?,?,?,?, ?)");

  $query -> execute(array($email, "-1", "0", "-1", ""));

}

}
?>