<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php
  $bcDb = new BcDb();
?>	<div class = "footer">		<div class = "sub-footer">			<div class = "footer-text">				BRKY				<div class = "footer-mini-text"><?php echo($bcDb -> fetchSetting("footerText")); ?></div>			</div>			<div class = "footer-icons">				<div class = "icon-border">t</div>				<div class = "icon-border">f</div>				<div class = "icon-border" style = "padding-left: 8px; padding-right: 8px">in</div>			</div>		</div>	</div>

<script type = "text/javascript" src = "<?php echo($bcDb -> fetchSetting("url")); ?>includes/prcss.js"></script>
<script type = "text/javascript" src = "<?php echo($bcDb -> fetchSetting("themeUrl") . "js/oper.js"); ?>"></script><script type = "text/javascript" src = "<?php echo($bcDb -> fetchSetting("themeUrl") . "js/themeJs.js"); ?> "></script>
</body>
</html>
<br>
