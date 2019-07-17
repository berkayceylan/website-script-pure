<?php

  session_start();
  $db = "bcwebsite";
  $host = "localhost";
  $user = "root";
  $pw = "";
  $db = new PDO("mysql:host=" . $host  .";dbname=". $db .";charset=utf8",$user,$pw);
?>
