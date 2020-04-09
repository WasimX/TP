<?php
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username = $_SESSION[ 'username' ];
$query = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'" );
$fetch = mysqli_fetch_object( $query );

$check = mysqli_query( $connection, "SELECT * FROM `email` WHERE `read`='0' AND `to`='$username'" );
$inbox = mysqli_num_rows( $check );

$date = gmdate( 'Y-m-d H:i:s' );
if ( $fetch->schooltime < time() && $fetch->schooltime != "0" && $fetch->schooltime != "" ) {
	mysqli_query( $connection, "UPDATE accounts SET schooltime='0' WHERE username='$username'" );
	mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username', 'Warry', 'Hello student, it has passed your school training time. You have gained worthy work experience. Please check back to the Work Experience page to see how your progress is going! For each hour you trained, you have gained 10 work xp.', '<b>Training Passed!</b>', '$date', '0');" )or die( mysqli_error() );
}

if ( $fetch->factorytime < time() && $fetch->factorytime != "0" && $fetch->factorytime != "" ) {
	mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$username', 'Warry', 'Just to inform you, your manufacturing manager has completed the job. He was very pleased with the car and did a superb job. $fetch->factorycarsback car(s) have been added to your garage, identical to the one you sent to him.', '<b>Training Passed!</b>', '$date', '0');" )or die( mysqli_error() );
	include_once "garageupdate.php";
	mysqli_query( $connection, "UPDATE accounts SET factorytime='0', factorycarsback='0' WHERE username='$username'" );
}



?>
<html>

<head>
	<link rel=stylesheet href=style2.css type=text/css>
	<script type="text/javascript">
		<!--
		function updateClock() {
			var currentTime = new Date();
			var currentHours = currentTime.getHours();
			var currentMinutes = currentTime.getMinutes();
			var currentSeconds = currentTime.getSeconds();
			currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
			currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
			var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
			currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
			currentHours = ( currentHours == 0 ) ? 12 : currentHours;
			var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
			document.getElementById( "clock" ).firstChild.nodeValue = currentTimeString;
		}
		// -->
	</script>

	<style type="text/css">
		#clocks {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #CCCCCC;
			position: absolute;
			font-weight: bold;
			top: 0;
			right: 2;
		}
		
		#user {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #CCCCCC;
			position: absolute;
			top: 12;
			right: 2;
		}
		
		#cc {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #CCCCCC;
			position: absolute;
			top: 24;
			right: 2;
		}
		
		#loans {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			color: #CCCCCC;
			position: absolute;
			top: 25;
			right: 2;
		}
		
		#admins {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 12px;
			color: #CCCCCC;
			position: absolute;
			top: 12;
			left: 10;
			text-decoration: blink;
		}
		
		.custombutton {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			color: #FFFFFF;
			font-weight: bold;
			border: none;
			border: 1px solid #000000;
			font-size: 10px;
			background: url(images/others/formbutton.png) repeat;
			height: 23px;
		}
		
		a:link {
			text-decoration: none;
			color: #CCCCCC;
			font-weight: bold;
		}
		
		a:visited {
			text-decoration: none;
			color: #CCCCCC;
			font-weight: bold;
		}
		
		a:active {
			text-decoration: none;
			color: #CCCCCC;
			font-weight: bold;
		}
		
		a:hover {
			color: #999999;
			font-weight: bold;
		}
		
		.textbox {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-weight: bold;
			color: #660000;
			background-color: #CCCCCC;
			border: none;
		}
		
		.table1px {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-style: normal;
			border: 1px solid #000000;
			color: #FFFFFF;
			border-collapse: collapse;
			background-color: #666666;
		}
		
		.tablebackground {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-style: normal;
			line-height: normal;
			color: #FFFFFF;
			background-color: #666666;
			background-image: url(images/others/tablebackground.png);
			background-repeat: no-repeat;
			background-position: center top;
			padding: 5px;
		}
		
		.gradient {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-style: normal;
			text-align: center;
			font-weight: bold;
			color: #FFFFFF;
			background-image: url(images/grad.gif);
		}
		
		.tableborder {
			font-family: Verdana, Arial, Helvetica, sans-serif;
			font-size: 10px;
			font-style: normal;
			line-height: normal;
			border-color: #000000;
			color: #FFFFFF;
			background-color: #666666;
			padding: 4px;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<center>

	<body onLoad="updateClock(); setInterval('updateClock()', 1000 )">
		<div id="user" align="center">
			<?php echo "<a href=\"profile.php?viewing=$username\" target=\"middle\">$username</a>"; ?>
		</div>
		<div id="cc" align="center">
			<?php echo "<a href=\"test.php\" target=\"middle\">Double XP On!</a>"; ?>
		</div>
		<div id="clocks"><span id="clock">&nbsp;</span>
		</div>
		<?php if ($fetch->loan == "1"){ ?>
		<div id="loans" align="center">
			Loan:
			<?php echo "&pound;".makecomma($fetch->loanmoney).""; ?><br/> Loan Left:
			<?php $loanleft = $fetch->loanmoney - $fetch->loanpayed; echo "&pound;".makecomma($loanleft).""; ?><br/>
			<?php echo "".maketime($fetch->loantime).""; ?>
		</div>
		<?php } ?>
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
				<td width="98">
					<div align="left"><img src="images/left.png" alt="Left Part" width="18" height="97">
					</div>
				</td>
				<td width="100%">
					<div align="center"><img src="images/banner/banner12345.png" alt="Middle Part">
					</div>
				</td>
				<td width="18">
					<div align="right"><img src="images/right.png" alt="Right Part" width="18" height="97">
					</div>
				</td>
			</tr>
		</table>
	</body>

</html>