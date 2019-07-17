
	
	<div class = "section">
		<div class = "general-mp-blog">
			<div class = "gmpb-title">Blog</div>
		<?php 
			$bcPost = new BcPost;
			$i = 0;
			while($bcPost -> havePosts(true, 4)){ // $limit düzeltilecek
				while($bcPost -> returnPost("is_publish") == 0 || $bcPost -> returnPost("is_preview") == 1){
					
					$bcPost -> nextPost(true);
					continue;
				}
		?>

			<div class = "mp-blog">
				<div class = "mpb-image">
					<img src = '<?php echo($bcPost -> returnPost("image_url")); ?>'>
				</div>
				<a href = '<?php echo($bcPost -> fetchSetting("url") . "/konu/" . $bcPost -> returnPost("p_title")) ?>'>
					<div class = "mpb-item mpb-title"><?php echo(substr($bcPost -> returnPost("p_title"), 0, 8) . "..."); ?></div>
				</a>
				<div class = "mpb-item mpb-date"><?php echo($bcPost -> returnPost("p_date")); ?></div>
				<div class = "mpb-item mpb-desc">
					<?php echo(strip_tags(substr($bcPost -> returnPost("p_content", true),0,87) . "...", "")); ?>
				</div>
				<a href = '<?php echo($bcPost -> returnUrl()); ?>' class = "btn1 mpb-item"><?php echo($lang["readMore"]); ?>...</a>
			</div>
			<?php if($i == 1){ echo("<br>"); } ?>
		<?php 
				$i++;
				} 
		?><br><br>
		<div class = "mpb-item mpb-title">...</div><br><br>
		<a href = '<?php echo($bcPost -> fetchSetting("url") . "/show/blog"); ?>' class = "btn1 mpb-item"><?php echo($lang["seeAll"]); ?></a>
		</div>
	</div>
	