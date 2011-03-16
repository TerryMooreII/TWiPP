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

$websiteID = $_SESSION['website'];
$value = "";
$group = "";
$websiteName = GetWebSiteName($aWebsites, $websiteID);

$aDateInfo = getDateInformation(); //0=date, 1=periodType, 2=Date Formated

$periodType = getPeriodType($aDateInfo[1]);
$browsers = $twatch->config->getList( TwatchConfig::USER_AGENTS );

$aBrowsers = array();			
foreach($browsers as $a) {
	foreach ($a as $k=>$v){	  
		if ($k == "id"){
			$id = $v;
		}
		if ($k == "name") {
			$name = $v;
		}
	
	}

$aBrowsers[$id] = $name;
}

?>	
<body>

<div id="topbar">
	<div id="title">
		<?php echo $websiteName ?></div>
	<div id="leftbutton">
		<a href="stats.php" class="noeffect">Stats</a> 
	</div>
	<div id="rightbutton">
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="noeffect">Refresh</a> 
	</div>
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
		<li class="textbox"><span class="header"><center>Browser Stats for <?echo $aDateInfo[2] ?></center></span></li>
		<?php 
		foreach ($aBrowsers as $id =>$ua){
			if ($id < 1000){
				$count = twatchCounterResult( TwatchCounter::BROWSERS, $periodType, $aDateInfo[0], $ua, $group, $websiteID );		
				$iconName = str_replace(" ","",$ua);
				$iconPath = "thumbs/browsers/" . strtolower($iconName) . "-32.png";
				?>
				<li class="menu"><span alt="list"  class="name"> <img height="24" width="24" src="<?php echo $iconPath; ?>"><?php echo " " .$ua; ?></span><span class="comment"><?php echo $count; ?></span></li>
				<?php
		
			}
}
?>

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
