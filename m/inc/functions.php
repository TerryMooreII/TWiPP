<?php 

$version = "0.3.0";

//include the Trace Watch API
//location of the API
$twAPI = "../api/GetStats.php";
if ( file_exists($twAPI) ) {
	include_once($twAPI);
} else {
	die ("ERROR: Trace Watch API cannot be loaded.");
}


//The $wss line was the TraceWatch authors code.
$wss = $twatch->config->getList( TwatchConfig::WEBSITES );  	//returns all website data into an array within array
$aWebsites = array();			
foreach($wss as $a) {             				//This for loop breaks those arrays and create new array called $aWebsites 	
	foreach ($a as $k=>$v){	  				//with just the data that I need, the name and id.
		if ($k == "name") {
			$name = $v;
		}
		if ($k == "handle") {
			$id = $v;
		}	
	}
	$aWebsites[$id] = $name;
}


/*************************************************************************************************
*	Get the Website name from the ID
*
*	@param array $aWebsites	An array of the Websites Name
*
*	@param	string $id		ID of the current website.
*
	*return string 			Name of the Website.
**************************************************************************************************/
function GetWebSiteName($aWebsites, $id){
	foreach ($aWebsites as $k=>$v){
		if ($k == $id){
			return $v;
		}
	}
	return $aWebsites[0][1];
}

/**************************************************************************************************
*	Gets the website statics for a certian period of time
*
*	@param string $period  	Determines whether to get the Statistics for a given month, day, or all
* 						all = 0
*						day = 1
*						month = 2
*
*	@param int $date		Date to get statics from.  YYMM or YYMMDD
*
*	@param int $value	Value.  Defaults to "" 
*
*	@param int $group	Group.  Defaults to "" 
*
*	@param int $websiteID	Website ID.  
*
*
*	return array $aTwatch Array containing all website statistics
****************************************************************************************************/
function twatch( $period, $date, $value = "",$group = "",$websiteID) {
	$aTwatch = "";


	$pageViews 		= twatchCounterResult( TwatchCounter::PAGE_VIEWS, $period, $date, $value, $group, $websiteID ) ;
	$sessions		= twatchCounterResult( TwatchCounter::SESSIONS, $period, $date, $value, $group, $websiteID ) ;
	$visitors		= twatchCounterResult( TwatchCounter::VISITORS, $period, $date , $value, $group, $websiteID) ;
	$newVisitors		= twatchCounterResult( TwatchCounter::NEW_VISITORS, $period, $date, $value, $group, $websiteID ) ;
	$robotPViews		= twatchCounterResult( TwatchCounter::ROBOT_PVIEWS, $period, $date, $value, $group, $websiteID ) ;
	//$pages			= twatchCounterResult( TwatchCounter::PAGES, TwatchPeriod::DAY, twatchToday(), $value, $group, $websiteID );
	//$robots			= twatchCounterResult( TwatchCounter::ROBOT, TwatchPeriod::DAY, twatchToday(), $value, $group, $websiteID );
	
	if ( $visitors != 0 ) {
		$avgPViewsVisitor = $pageViews / $visitors;
	} else { 
		$avgPViewsVisitor = 0;
	}
	
	$hour = date("G");
	if ( $hour != 0 ) {
		$avgUVisitorsHour = $visitors / $hour;
	} else {
		$avgUVisitorHour = $visitors;
	}
	
	if ( $hour != 0 ) {
		$avgPageViewsHour = $pageViews / $hour;
	} else {
		$avgPageViewsHour = $pageViews;
	}

	$aTwatch = array($pageViews, $sessions, $visitors, $newVisitors, $robotPViews, round($avgPViewsVisitor, 2), round($avgUVisitorsHour,2), round($avgPageViewsHour, 2));
	return $aTwatch;
}

/**************************************************************************************************
*	Gets the period type and matches it to the TraceWatch value for period type
*
*	@param string $period  	Determines whether to get the Statistics for a given month, day, or all
* 						all = 0
*						day = 1
*						month = 2
*
*
*	return string	$period	Value is the tracewatch value for peroidType
****************************************************************************************************/
function getPeriodType($period){

	if ( strtolower($period) == 'day' ) {
		$period = 1;
	} elseif ( strtolower($period) == 'month' ) {
		$period = 2;
	} elseif ( strtolower($period) == 'all' ) {
		$period = 0;
	} else {
		echo "Error: Invalid Period Type";
		?><meta http-equiv="refresh" content="10;url=index.php"><?php
		
	}
	return $period;
}

/**************************************************************************************************
*	Gets the date information for the session variable
*
*	No input parameters
*
*
*	return array	$aDateInfo
*				Array Index
*				0=raw date value (Tracewatch $date varible)
*				1=periodType (Tracewatch $period varible)
*				2=DateFormated The date varible in human readable format for headers
****************************************************************************************************/
function getDateInformation(){
	if (isset($_SESSION['dateRange'])) {
		$date = $_SESSION['dateRange'];
		if (strtolower($date) == 'today'){
			$date = Date("ymd");
			$periodType = 'day';
			$dateFormated = date("F d Y");
		}elseif (strtolower($date) == 'yesterday'){
			$date = date("ymd", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));
			$periodType = 'day';
			$dateFormated = date("F d Y", mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")));
		}elseif (strtolower($date) == 'thismonth'){
			$date = date("ym");
			$periodType = 'month';
			$dateFormated = date("F");
		}elseif (strtolower($date) == 'lastmonth'){
			$date = date("ym", mktime(0, 0, 0, date("m")-1  , date("d"), date("Y")));
			$periodType = 'month';
			$dateFormated = date("F", mktime(0, 0, 0, date("m")-1  , date("d"), date("Y")));
		}elseif (strtolower($date) == 'all'){
			$date = "";
			$periodType = 'all';
			$dateFormated = 'All Dates';
		}elseif (strtolower($date) == 'custom'){
			if (isset($_GET['m']) && isset($_GET['m']) && isset($_GET['m'])){
				$_SESSION['m'] = $_GET['m'];
				$_SESSION['d'] = $_GET['d'];
				$_SESSION['y'] = $_GET['y'];
			}	
			$month = $_SESSION['m'];  
			$day = $_SESSION['d'];
			$year = $_SESSION['y'];
			if ($month == '02' && $day > 28){
				$day = 28;
			}
			if (($month == '04' || $month == '06' ||$month == '09' ||$month == '11') && $day > 28){
				$day = 30;
			}
			if ($day == '00') {
				$date = $year . $month;
				$periodType = 'month';
				$dateFormated = date("F Y", mktime(0, 0, 0, $month, 1, '20'. $year ));	
			}else{
				$date = $year . $month . $day;
				$periodType = 'day';
				$dateFormated = date("F j, Y", mktime(0, 0, 0, $month, $day, '20'. $year ));	
			}

		}

	}else{
		die('Date Range Not Specified');
	}
	$aDateInfo = array($date, $periodType,$dateFormated);
	return $aDateInfo;
}


