<?php
require_once('inc/header.php');
require_once('inc/functions.php');


if (isset($_GET['id']) && isset($_GET['dr'])) {
	$_SESSION['website'] = $_GET['id'];
	$_SESSION['dateRange'] = $_GET['dr'];
}elseif (!isset($_SESSION['website']) || !isset($_SESSION['dateRange'])){
	?><meta http-equiv="refresh" content="0;url=index.php"><?php
	die();
}
//echo "site: " . $_SESSION['website'];
//echo "<br>dr: " . $_SESSION['dateRange'];
$websiteID = $_SESSION['website'];
$value = "";
$group = "";
$websiteName = GetWebSiteName($aWebsites, $websiteID);
$aDateInfo = getDateInformation(); //0=date, 1=periodType, 2=Date Formated

$periodType = getPeriodType($aDateInfo[1]);
$aTwatch = twatch ( $periodType, $aDateInfo[0], $value, $group, $websiteID );


?>	
<body>

<div id="topbar">
	<div id="title">
		<?php echo $websiteName ?></div>
	<!--<div id="leftbutton">
		<a href="websites.php" class="noeffect">Websites</a> </div>-->
	<div id="rightbutton">
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="noeffect">Refresh</a> </div>
</div>

<div id="tributton">
	<div class="links">
		<a href="websites.php">Websites</a><a href="datepicker.php">Change Date</a><a href="about.php">About</a>
	</div>
</div>

<div id="content">
	<span class="graytitle"><center>Total vistors currently online: <?php echo twatchOnlineVisitorsCount( $websiteID ) ?>	 
	</center></span>
	
	
	<ul class="pageitem">
		<li class="textbox"><span class="header"><center>Statistics for <?echo $aDateInfo[2] ?></center></span></li>
		<li class="menu"><span class="name">Unique Visitors</span><span class="comment"><?php echo $aTwatch[2] ?></span></li>
		<li class="menu"><span class="name">New Visitors</span><span class="comment"><?php echo $aTwatch[3] ?></span></li>
		<li class="menu"><span class="name">Sessions</span><span class="comment"><?php echo $aTwatch[1] ?></span></li>
		<li class="menu"><span class="name">Page Views</span><span class="comment"><?php echo $aTwatch[0] ?></span></li>
		<li class="menu"><span class="name">Avg Page Views/Visitor</span><span class="comment"><?php echo $aTwatch[5] ?></span></li>
		<li class="menu"><span class="name">Avg UVisitors/Hour</span><span class="comment"><?php echo $aTwatch[6] ?></span></li>
		<li class="menu"><span class="name">Avg PViews/Hour</span><span class="comment"><?php echo $aTwatch[7] ?></span></li>
		<li class="menu"><span class="name">Robot Page Views</span><span class="comment"><?php echo $aTwatch[4] ?></span></li>
	</ul>

</div>
<div id="tributton">
	<div class="links">
		<a href="statsByHour.php">Hour</a><a href="statsByBrowser.php">Broswer</a><a href="statsByReferrer.php">Referrer</a>
	</div>
</div>
<?php
require_once('inc/footer.php');
?>

</body>

</html>
