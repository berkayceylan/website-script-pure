<?php
  $bcMessage = new BcMessage();

  if(isset($_COOKIE["usr"])){
?>


<article class="artc1">
  <div class="textPview">
    <a href = '<?php echo($bcMessage -> fetchSetting("url") . "islem/mesaj-gonder"); ?> ' class = "button2">Mesaj Gönder</a><br><br>
        <ul class = "table1 messageMenu">


         <a href = "mesajlar&m_type=gelenler"><li> Gelenler</li></a>
      <a href = "mesajlar&m_type=gonderilenler"><li>  Gönderilenler</li></a>
      <a href = "mesajlar&m_type=cop-kutusu"><li>Çöp Kutusu</li></a>

    </ul>

    <?php if(isset($_GET["m_type"])) {
        $uType = "";
        if($_GET["m_type"] == "gonderilenler"){
          $uType = "s_id";
        }else if($_GET["m_type"] == "cop-kutusu"){
          $uType = "trash";
        }else{
          $uType = "r_ids";
        }
      ?>
    <table id = "mTable" class = "table1 messageTable">

      <tr>
        <th>Mesaj Başlığı</th>
        <th>Gönderen</th>
        <th>İçerik</th>
      </tr>

      <?php while($bcMessage -> haveMessages(1)){
          $sNick = $bcMessage -> fetchColumn("bc_users", "u_nick", "s_id", $_COOKIE["usr"])["u_nick"];
            if($bcMessage -> isMessage($uType, $sNick) ){
        ?>
        <!-- table kullanma zorunluluğu -->
        <tr>

          <td><a href = '<?php  echo($bcMessage -> fetchSetting("url") . "islem/mesaj-oku&msg=" . $bcMessage -> returnMessage("m_id"));  ?>'><?php echo($bcMessage -> returnMessage("m_title")); ?></a></td>
          <td><?php echo($bcMessage -> returnMessage("s_id")); ?></td>
          <td><?php echo($bcMessage -> returnMessage("m_content")); ?></td>
          <input type = "hidden" id = "m_id" value="<?php echo($bcMessage -> returnMessage("m_id")); ?>">
          <td><input type = "radio" class = "mSelect"></td>
        </tr>

      <?php }}


   ?>
 </table>
    <?php if($_GET["m_type"] == "cop-kutusu"){ ?>
      <button style = "float: right;" id = "removeFromTrash" class = "button2">Çöpten Çıkar</button>
      <button style = "float: left;" id = "remove" class = "button2">Kalıcı Olarak Sil</button>
    <?php }else{ ?>
      <button style = "float: right;" id = "sendToTrash" class = "button2">Çöpe At</button>
    <?php } ?>
  </div>

</article>
<?php }}
