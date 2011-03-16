<?php
require_once('inc/header.php');
require_once('inc/functions.php');

?>
<body>

<div id="topbar">
	<div id="title">
		About</div>
	<div id="leftbutton">
		<a href="<?php 	echo $_SERVER['HTTP_REFERER'] ?>" class="noeffect">Back</a> </div>
</div>
<div id="tributton">
	<div class="links">
		<a href="websites.php">Websites</a><a  href="datepicker.php">Change Date</a><a id="pressed" href="about.php">About</a>
	</div>
</div>
<div id="content">
	<ul class="pageitem">
		<li class="textbox"><span class="header"></span>
		<p>
			<h3><center>Written By: Terry Moore </center></h3>
		<h4><center>Email: <a href="mailto:motersho@gmail.com">motersho@gmail.com</a><br />
		Website: <a href="http://www.motersho.com" target="_blank">www.motersho.com</a><br />
		<a href="http://motersho.com/blog/index.php/2010/03/22/trace-watch-iphone-plugin-twipp/" target="_blank">Check for Updates</a></center></h4>
		<h4><center>Version <?php echo $version; ?></center></h4>
		<center><a href="http://www.tracewatch.com" target="_blank"><img src="img/twatch_100_65.gif" alt="Trace Watch Logo" /></a></center>		
		</p>
		</li>
		
	</ul>

</div>

<?php
require_once('inc/footer.php');
?>

</body>

</html>
