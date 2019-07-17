<?php

//s_id yerine normal id kullanılabilir.



class Bc{

  function replaceFromTr($str){
    
    return str_replace(["ş","ı","ğ","ü","ö","ç"],["s","i","g","u","o","c"],$str);

  }

  public function uploadImage($arrFile, $newFilePreName){

    $fileName = $arrFile["name"];

    $ext = explode(".", $fileName)[count(explode(".", $fileName)) - 1];

    $numb = rand(0,999999);

    //$filePath =

    $this -> fetchSetting("path") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;

    $fileUrl = $this -> fetchSetting("url") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;

    move_uploaded_file($arrFile["tmp_name"], $filePath);

    return $fileUrl;

  }

  public function resizeAndUploadImage($files, $newFilePreName, $rWidth, $tfolder){

    $fn = $files["tmp_name"];

    $numb = rand(0, 999999);

    list($width, $height, $type) = getimagesize($fn);

    $ext = explode(".", $files["name"])[count(explode(".", $files["name"])) - 1];



    $filePath = $this -> fetchSetting("path") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;

    $fileUrl = $this -> fetchSetting("url") . "content/images/" . $newFilePreName ."_" . $numb . "." .$ext;





    if($width < $rWidth){

      move_uploaded_file($files["tmp_name"], $filePath);

      return $fileUrl;

    }

    $ratio = $width / $rWidth;

    $nHeight = $height / $ratio;

    $nWidth = $rWidth;





    $dst = imagecreatetruecolor($nWidth, $nHeight);

    $src = imagecreatefromstring(file_get_contents($files["tmp_name"]));



    imagecopyresampled($dst, $src, 0, 0, 0, 0, $nWidth, $nHeight, $width, $height);

    if($type == 2){

      imagejpeg($dst, $fn, 100);

    }else if($type == 3){

      imagepng($dst, $fn, 9);

    }else{

      echo($rWidth . "'den genişliğinden yüksek resimler sadece jpg ve png formatında desteklenmektedir.");

    }

    imagedestroy($dst);

    move_uploaded_file($files["tmp_name"], $filePath);

    return $fileUrl;

   

  }

  function sendMail($who, $head, $text){

    mail($who, $head, $text);

  }

  function controlPassword($password){

    if(strlen($password) < 5){

      echo("Parola 5 karakterden daha az olamaz");

      return false;

    }

    if(strpos($password, "123") !== false || strpos($password, "abc") !== false ){

      echo("Parola basit ifadeler içermemelidir !");

      return false;

    }

    return true;

  }

  function isInside($str, $cStr){

    if(strpos($str, $cStr) === false || strpos($str, $cStr) == 0 || strpos($str, $cStr) == strlen($str)-1 ){

      return false;

    }

    return true;

  }

  function controlEmail($email){

    if(strlen($email) < 5 || strpos($email, "@") === false || $this -> isInside($email, "@") == false || $this -> isInside($email, ".") == false){

      echo("Lütfen email adresini düzgün yazınız...");

      return false;

    }

    return true;

  }


}


class BcArticle{

  function artcToShort($txt){
	


  }

}

class BcDb extends Bc{

  //--categ--

  //categ isminde BcDb yi extend eden bir class yazılabilir


  //--categ--

  public function fetchSetting($setting){

    $fetchUrl = $this -> fetchColumn("bc_settings", "value", "setting", "url");

    $fetchPath = $this -> fetchColumn("bc_settings", "value", "setting", "path");
	  
    $themeFolder = $this -> fetchColumn("bc_settings", "value", "setting", "themeFolder")["value"] . "/";


    $url = $fetchUrl["value"];

    $path = $fetchPath["value"];



    if($setting == "url"){

      return $url;

    }

    if($setting == "path")

      return $path;

    if($setting == "themeUrl")

      return $url . "content/themes/" . $themeFolder;

    if($setting == "themePath")

      return $path . "content/themes/" . $themeFolder;

    if($setting == "adminUrl")

      return $url . "admin";

    if($setting == "adminPath")

      return $path . "admin";

    if($setting == "adThemeUrl")

      return $url . "admin/" .  "content/themes/" . $themeFolder;

    if($setting == "adThemePath")

      return $path . "/admin/" .  "content/themes/" . $themeFolder;
	else
		return $this -> fetchColumn("bc_settings", "value", "setting", $setting)["value"];
  }

  public function fetchId($table){

    $query = $GLOBALS['db'] -> prepare("SELECT id FROM $table");

    $query -> execute();

    return $query -> fetchAll(PDO::FETCH_ASSOC);

  }



  public function fetchColumn($table, $column, $idType, $id){

    $query = $GLOBALS['db'] -> prepare("SELECT $column FROM $table WHERE $idType = ?");

    $query -> execute(array($id));

    $fetch = $query -> fetch(PDO::FETCH_ASSOC);

    return $fetch;

  }

  public function fetchPost($column, $idType, $id){

    $fetch = $this -> fetchColumn("bc_posts", $column, $idType, $id);

    return $fetch;

  }



  function returnColumn($table){

    $query = $GLOBALS["db"] -> prepare("SHOW COLUMNS FROM $table");

    $query -> execute();

    $fetch = $query -> fetchAll(PDO::FETCH_ASSOC);

    return $fetch;

  }

  function controlColumn($table, $column, $value, $existValue){

    $query = $GLOBALS["db"] -> prepare("SELECT $column FROM $table");

    $query -> execute();

    $isValue = 0;

    $fetch = $query -> fetchAll(PDO::FETCH_ASSOC);





    foreach($fetch as $row){

      if(strtolower($row[$column]) == $existValue)

        continue;

      if(strtolower($row[$column]) == strtolower($value)){

        $isValue = 1;

      }

    }

    if($isValue == 1)

      return true;



    return false;

  }

  function startLang(){
    
    if(!isset($_COOKIE["lang"]))
      setcookie("lang", "en", time() + 9999999999,"/");
      
    
    
    
   

  }
  function setLang($lang = "en"){
    if(!isset($_COOKIE["lang"]))
      return;
    setcookie("lang", $lang, time() + 99999999, "/");
    
  }



}




include("BcUser.php");
include("BcMessage.php");
include("BcCateg.php");
include("BcPost.php");
include("BcComment.php");
include("BcFollow.php");

?>

