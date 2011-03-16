<?php
require_once('inc/header.php');
require_once('inc/functions.php');

if (!isset($_SESSION['website'])){
	?><meta http-equiv="refresh" content="0;url=index.php"><?php
	die();
}


$websiteName = GetWebSiteName($aWebsites, $_SESSION['website']);
?>
<body>

<div id="topbar">
	<div id="title">
		 <?php echo $websiteName; ?> </div>
	<div id="leftbutton">
		<a href="<?php 	echo $_SERVER['HTTP_REFERER'] ?>" class="noeffect">Back</a> </div>
</div>

<div id="tributton">
	<div class="links">
		<a href="websites.php">Websites</a><a id="pressed" href="datepicker.php">Change Date</a><a href="about.php">About</a>
	</div>
</div>

<div id="content">
	<!-- <span class="graytitle">Select Date</span> -->
	<ul class="pageitem">
		<li class="textbox"><span class="header">Select Date</span>
		<p>
			Pre-defined date ranges.		
		</p>
		</li>
		<li class="menu">
			<a href="stats.php?id=<?php echo $_SESSION['website'] ?>&dr=today"><img alt="list" src="thumbs/calendar2.png" /><span class="name">Today</span><span class="arrow"></span></a>
		</li>
		<li class="menu">
			<a href="stats.php?id=<?php echo $_SESSION['website'] ?>&dr=yesterday"><img alt="list" src="thumbs/calendar2.png" /><span class="name">Yesterday</span><span class="arrow"></span></a>
		</li>
		<li class="menu">
			<a href="stats.php?id=<?php echo $_SESSION['website'] ?>&dr=thismonth"><img alt="list" src="thumbs/calendar2.png" /><span class="name">Current Month</span><span class="arrow"></span></a>
		</li>
		
	</ul>
	<?$aMonths = array('01'=>'January',
			 '02'=>'Febuary',
			 '03'=>'March',
			 '04'=>'April',
			 '05'=>'May',
			 '06'=>'June',
			 '07'=>'July',
			 '08'=>'August',
			 '09'=>'September',
			 '10'=>'October',
			 '11'=>'November',
			 '12'=>'December')?>

	<ul class="pageitem">
		<form method="get" action="stats.php" name="custom">
		<input type="hidden" name="dr" value="custom">
		<input type="hidden" name="id" value="<?php echo $_SESSION['website'] ?>">
		<li class="textbox"><span class="header">Custom Dates</span>
		<p>
			Select a custom date range.
		</p></li>
		<li class="select">
			<select name="m">
				<?php
				foreach ($aMonths as $n=>$F){ 
					if ($n == date('n')){ ?>
						<option value="<?php echo $n ?>" SELECTED><?php echo $F; ?></option>
					<?php } else { ?>
						<option value="<?php echo $n ?>"><?php echo $F; ?></option>	
					<?php } ?>				
				<?php } ?>
			</select>
			<span class="arrow"></span> 
		</li>
		<li class="select">
			<select name="d">
				<?php for ($x=0; $x<=31; $x++) {
					if ($x < 10) { 
						$x = '0' . $x;
					} 
					if ($x == '00'){ ?>
						<option value="<?php echo $x ?>" SELECTED>Entire Month</option>						
					<?php			
					}elseif($x == date('d')) { ?>					
						<option value="<?php echo $x ?>" SELECTED><?php echo $x ?> </option>
					<?php }else{ ?>
						<option value="<?php echo $x ?>"><?php echo $x ?> </option>			
					<?php } ?>
				<?php } ?>				
			</select>
			<span class="arrow"></span>
		</li>
		<li class="select">
			<select name="y">
				<?php for ($x=0; $x<=99; $x++) {
					if ($x < 10) { 
						$x = '0' . $x;
					} 
					if($x == date('y')) { ?>					
						<option value="<?php echo $x ?>" SELECTED><?php echo '20' . $x ?> </option>
					<?php }else{ ?>
						<option value="<?php echo $x ?>"><?php echo '20' . $x ?> </option>			
					<?php } ?>
				<?php } ?>				
			</select>
			<span class="arrow"></span>
		</li>
			<li class="button">
			<input name="Submit" type="submit" value="Submit" /></li>
		</form>
	</ul>
</div>

<?php
require_once('inc/footer.php');
?>

</body>

</html>
