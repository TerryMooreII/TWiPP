<?php
require_once('inc/header.php');
require_once('inc/functions.php');
?>
<body>

<div id="topbar">
	<div id="title">
		TWiPP</div>
	<div id="leftbutton">
		<a href="http://iwebkit.net" class="noeffect">PC Site</a> </div>
</div>

<div id="content">
	<!--<span class="graytitle">Features</span> -->
	<ul class="pageitem">
		<li class="textbox"><span class="header">Select Website</span>
		<p>
			Blah Blah		
		</p>
		</li>
		<?php
		foreach ($aWebsites as $id=>$site){
		?>
			<li class="menu"><a href="stats.php?id=<?php echo $id; ?>">
			<img alt="list" src="thumbs/plugin.png" /><span class="name"><?php echo $id; ?></span><span class="arrow"></span></a></li>
		<?php }?>
	</ul>

</div>

<?php
require_once('inc/footer.php');
?>

</body>

</html>
