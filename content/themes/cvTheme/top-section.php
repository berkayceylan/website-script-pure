<div class = "top">
		
		<div class = "top-section background1">

			<div class = "sub-top-section center">
				<!--
					<div class = "st-left">
						<input placeholder = "Enter your name" type = "text" class = "stl-text">
						<input placeholder = "Enter your e-mail" type = "text" class = "stl-text">
						<textarea placeholder = "Enter your message" class="str-textarea" rows = "5"></textarea>
						<input style = "margin-top: 20px;" type = "button" class = "btn1" value = "SEND">
					</div>
				-->
					<div class="big-art1">
						BU SİTE DEMODUR ! TAMAMLANMAMIŞTIR !
						<br><br><br><br>
					</div>
					<div class = "st-center">
							<div class = "stc-image">
								<img src='<?php echo($bcUser -> fetchSetting("url") . "content/images/pp.jpg"); ?>'>
							</div><br>
							<div class = "big-art1">BERKAY CEYLAN</div><br>
					
							<div class = "art1 st-center-art">
								<?php if (trim($bcUser -> fetchSetting("aboutme-en")) == "" || $_COOKIE["lang"] == "tr"){?>

								<?php echo($bcUser -> fetchSetting("aboutme-tr")); }else{ ?>
								<?php echo($bcUser -> fetchSetting("aboutme-en")); } ?>
							</div><br>
							<!--<input placeholder = "Ipsum Lorem" type = "text" class = "stc-text"> -->
							<input style = "margin-left: 10px;" type = "button" class = "btn1" value = "<?php echo($lang["moreThan"]); ?>">
							<div class = "stc-icons">
								<div class = "icon-border">t</div>
								<div class = "icon-border">f</div>
								<div class = "icon-border" style = "padding-left: 15px; padding-right: 15px">in</div>
							</div>
					</div>
					
					<!--<div class = "st-right">
						<input type = "text" class = "str-text">
						<input type = "text" class = "str-text">
						
					</div>-->
				
			</div>
		</div>
	</div>