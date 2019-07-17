

<?php



error_reporting(E_NOTICE);

include("settings.php");





$_SESSION["_token"] = md5(rand(0,999999));




include("includes/Bc.php");
$bcUser = new BcUser();

echo('<iframe style = "display:none;" src = "'. $bcUser -> fetchSetting("url") .'includes/posts.php"></iframe>');

?>









<?php

//echo("$url");





include($bcUser -> fetchSetting("themePath")."main.php");











?>

