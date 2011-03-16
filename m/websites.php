<?php
require_once('inc/header.php');
require_once('inc/functions.php');
$defaultDRView = "today"; //default date range to show when selecting a website
?>
<body>

<div id="topbar">
	<div id="title">
		TWiPP</div>
	<div id="leftbutton">
		<a href="http://motersho.com" class="noeffect">PC Site</a> </div>
</div>

<div id="content">
	<!--<span class="graytitle">Features</span> -->
	<ul class="pageitem">
		<li class="textbox"><span class="header">Select Website</span>
		<p>
			Trace Watch monitored websites.	
		</p>
		</li>
		<?php
		foreach ($aWebsites as $id=>$site){
		?>
			<li class="menu"><a href="stats.php?id=<?php echo $id; ?>&dr=<?php echo $defaultDRView; ?>">
			<img alt="list" src="thumbs/safari.png" /><span class="name"><?php echo $site; ?></span><span class="arrow"></span></a></li>
		<?php }?>
	</ul>

</div>

<?php
require_once('inc/footer.php');
?>

</body>

</html>
