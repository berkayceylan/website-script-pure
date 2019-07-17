<?php if(isset($_COOKIE["usr"])){ ?>

<article class="artc1">
  <div class="textPview">
    <textarea id = "receiver" placeholder = "Alıcı" class = "textr1">
      <?php
        if(isset($_GET["rcv"])){
          echo($_GET["rcv"]);
        }
      ?>
    </textarea><br>
    <textarea id = "mTitle" placeholder="Mesaj Başlığı" class = "textr1"></textarea><br>
    <textarea id = "mContent" placeholder="Mesaj" class = "textr35"></textarea><br>
    <button id = "sendMessage" class = "button1">Gönder</button>
  </div>
</article>
<?php } ?>
