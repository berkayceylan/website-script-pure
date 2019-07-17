<?php

include("../settings.php");

include("../includes/Bc.php");

$bcDb = new BcDb();

if(!isset($_COOKIE["usr"])){

  header("Location: " . $bcDb -> fetchSetting("url"));

  return false;

}

if($bcDb -> fetchColumn("bc_users", "u_rank", "s_id", $_COOKIE["usr"])["u_rank"] != 1 ){

  header("Location: " . $bcDb -> fetchSetting("url"));

  return false;

}





$_SESSION["_token"] = md5(rand(0,999999));





?>

<input id = "_token" type = "hidden" value = '<?php echo($_SESSION["_token"]); ?>'>



<?php  ?>



<?php include($bcDb -> fetchSetting("adThemePath") . "main.php");



$bcDb = new BcDb();

echo "<br>";











?>

