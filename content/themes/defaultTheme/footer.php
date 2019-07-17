<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
  $bcDb = new BcDb();
?>

<script type = "text/javascript" src = "<?php echo($bcDb -> fetchSetting("url")); ?>includes/prcss.js"></script>
<script type = "text/javascript" src = "<?php echo($bcDb -> fetchSetting("themeUrl") . "js/oper.js"); ?>"></script>
</body>
</html>
<br>
