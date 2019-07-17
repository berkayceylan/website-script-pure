
	
	
	
	
	<!-- ŞABLON -->
	<!--
	<div class="section">
		
	
		<?php for($i = 0; $i < 2; $i++){ ?>
		<div class="general-blog">
			<div class="gb-title">
				Konu Başlığı
			</div>
			<div class="gb-image">
				<img src="http://localhost/myScript/Script1/content/images/robotik_el_-_arduino_-_telefon_egimiyle_kontrol_610790.jpg" alt="">
			</div>
			<div class="gb-text gb-item">
				Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği
				Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği Konu içeriği
			</div><br>
			<a href = '#' class = "btn1">Read More...</a>
		</div>
		<?php } ?>
	
	</div>
	-->
	
	
	<div class = "section">
		
			
		<?php 
			$bcPost = new BcPost;
			$i = 0;
			while($bcPost -> havePosts(true, 5)){ // $limit düzeltilecek
				if($_GET["show"] == "skills"){
					
					while($bcPost -> returnPost("is_publish") == 1 || $bcPost -> returnPost("is_preview") == 0){
					
						$bcPost -> nextPost(true);
						continue;
					}
				}else{
					while($bcPost -> returnPost("is_publish") == 0 || $bcPost -> returnPost("is_preview") == 1){
					
						$bcPost -> nextPost(true);
						continue;
					}
				}
				
		?>
				<div class = "general-blog">
				<a class = "gb-a" href = '<?php echo($bcPost -> fetchSetting("url") . "/konu/" . $bcPost -> returnPost("p_title")) ?>'>
					<div class = "gb-title"><?php echo(substr($bcPost -> returnPost("p_title"), 0, 50) . ""); ?></div>
				</a>
				<div class = "gb-image">
					<img src = '<?php echo($bcPost -> returnPost("image_url")); ?>'>
				</div>
				
				<!--<div class = "mpb-item mpb-date"><?php echo($bcPost -> returnPost("p_date")); ?></div>-->
				<div class = "gb-text gb-item">
					<?php echo(mb_substr($bcPost -> returnPost("p_content", true),0,127, "utf-8") . "..."); ?>
				</div><br>
				<a href = '<?php echo($bcPost -> returnUrl()); ?>' class = "btn1 mpb-item"><?php echo($lang["readMore"]); ?>...</a>
				</div>
			
		<?php 
				$i++;
				} 
		?>
		
	</div>
	