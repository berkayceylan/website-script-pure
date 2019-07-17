	<div class = "section">
		

		<div class = "slider">
			
			<?php 
				$bcPost = new BcPost();
				while($bcPost -> havePosts(true, $bcPost -> fetchSetting("preview-count"))){
					if($bcPost -> returnPost("is_preview") == 0){
						$bcPost -> nextPost(true);
					}
			
			?>
			<div class = "slider-item si-side">
				<div class = "si-image">
					<img src='<?php echo($bcPost -> returnPost("image_url")); ?>'>
				</div>
				<div class = "si-title"><?php echo(substr($bcPost -> returnPost("p_title"),0,16) . "..."); ?></div>
				<div class = "si-desc"><?php echo(substr($bcPost -> returnPost("p_content"),0,252)); ?></div>
				<a class="si-btn btn1" href = "<?php echo($bcPost -> returnUrl()); ?>">Read More</a>
				
			</div>
				<?php } ?>
			<div class = "left-button"><span><</span></div>
			<div class = "right-button"><span>></span></div>
			<div class="slider-top">
				<div class = "mpb-item mpb-title">...</div><br><br>
				<a href = '<?php echo($bcPost -> fetchSetting("url") . "/show/skills"); ?>' class = "btn1 mpb-item"><?php echo($lang["seeAll"]); ?></a>
			</div>
		</div>
		
	</div>