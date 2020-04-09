<?php
// CLOSE AGAIN
session_start();
include_once "incfiles/connectdb.php";
include_once "incfiles/func.php";
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
$page=$_GET['page'];
$sql = "SELECT username FROM accounts ORDER BY RAND()";

if($fetch->rank=='Chav' || $fetch->rank=='Vandal' || $fetch->rank=='Criminal' || $fetch->rank=='Pickpocket' || $fetch->rank=='Thief'){
die ("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=\"errorMsg\" class=\"repeatable\">You must be ranked at least Gangster to join the rioting!</div><br/><br/>");
}

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

// Function to assign target.

function riotTarget($r){
	$userList = array();
	// Query to find eligible users.
	$query = mysqli_query( $connection, "SELECT * FROM `accounts` WHERE rank='$r' AND status='Alive'");
	// Loop to add the potential users into the array.
	while($u = mysqli_fetch_object($query)){
		array_push($userList, $u->username);
	}
	// Count total entries into the array.
	$entries = count($userList);
	$entries = $entries - 1;
	// Generate a random user.
	$selected = rand(0,$entries);
	// Print out the selected user.
	$t = $userList[$selected];
	if(empty($userList)){
		die('There are no users of the desired rank to give you...');
	}else{
		mysqli_query( $connection, "UPDATE `accounts` SET riots_used=riots_used+1 WHERE username='$_SESSION[username]'");
		mysqli_query( $connection, "INSERT INTO `riot_targets` (`id`, `username`, `target`, `attacked`, `rank`) VALUES ('', '$_SESSION[username]', '$t', 'No', '$r')");
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Thug Paradise :: Riots</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style type="text/css">form{padding:0;margin:0;}#errorMsg{font-size:12px;font-weight:bold;border:red solid 2px;text-align:center;background:#000;padding:5px;width:596px;margin:0 auto;}table{margin:0 auto;text-align:center;}#riotBar{font-weight:bold;padding:5px;font-size:12px;color:#E3261E;}#outerBox{text-align:left;}#leftBox{line-height:20px;}#leftBox font{color:white;}#leftBox a font{color:#33CCFF}#rightBox{vertical-align:top;}#target{font-size:13px;position:relative;padding:0 50px;}#target #change{position:absolute;top:3px;right:0;font-size:9px;color:#999!important;}.bulletBox{cursor:pointer;font-size:16px;font-weight:bold;width:27%;margin:5px;padding:5px;background:#333333;background:-moz-linear-gradient(top,#333333 0%,#222222 100%);background:-webkit-gradient(linear,left top,left bottom,color-stop(0%,#333333),color-stop(100%,#222222));background:-webkit-linear-gradient(top,#333333 0%,#222222 100%);background:-o-linear-gradient(top,#333333 0%,#222222 100%);background:-ms-linear-gradient(top,#333333 0%,#222222 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#333333',endColorstr='#222222',GradientType=0);background:linear-gradient(top,#333333 0%,#222222 100%);display:inline-block;*display:inline;*zoom:1;}.bulletSmall{display:block;font-size:9px;}.this{color:yellow;}#attackBar .bulletBox{margin-top:70px;}.bulletBox.chosen{border:1px solid #E3261E;padding:4px;}</style>
</head>
 
<body>
<form method="post" id="form">
<table border="0" cellpadding="0" cellspacing="0" width="600">
<tr><td class="gradient"><?php echo"$fetch->location"; ?> Riots</td></tr>
<tr>
<td class="tableborder">
<div id="riotBar">Riot Points: <?php echo"$fetch->riotpoints"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Robbed: <?php echo"$fetch->rrobed"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attacked: <?php echo"$fetch->rattack"; ?></div>
<img src="../images/1.jpg" alt"" />
        </td>
    </tr>
</table>
<br />
<table border="0" cellpadding="0" cellspacing="0" width="610">
    <tr>
    	<td class="gradient" width="150">Ranks to Attack</td>
    	<td class="gradient">Information</td>
    </tr>
    <tr>
    	<td id="leftBox" class="tableborder">
        	<a href="?page=1">Chav</a><br />
        	<a href="?page=2">Pickpocket</a><br />
        	<a href="?page=3">Vandal</a><br />
        	<a href="?page=4">Thief</a><br />
        	<a href="?page=5">Criminal</a><br />
        	<a href="?page=6">Gangster</a><br />
        	<a href="?page=7">Hitman</a><br />
    <a href="?page=8">Knuckle Breaker</a><br />
        	<a href="?page=9">Boss</a><br />
        	<a href="?page=10">Assassin</a><br />
        	<a href="?page=11">Don</a><br />
        	<a href="?page=12">Godfather</a><br />
        	<a href="?page=13">Global Terror</a><br />
        	<a href="?page=14">Global Dominator</a><br />
        	<a href="?page=15">Untouchable Godfather</a><br />
        	<a href="?page=16">Legend</a><br />
        	<a href="?page=17"><font color=#FF0000>Official TP Legend</font></a><br />
        </td>
    	<td id="rightBox" class="tableborder">
		<?php 
		/// START --- Start page
		if ($page == "") { 
		?>
	                <img src="../images/questionmark.jpg" alt="" style="float:left">
        <p>Due to the high number of deaths recently, everyone is rioting for easy cash and XP! You can join in and attack someone's turf. You may even be able to loot back the bullets you use in the process and get a health boost. To start, choose a rank to attack. BEWARE! They will be sent a message warning them that you may be searching for them and you'll not be able to attempt to kill them for 24hrs after, if you need to.</p>
        <p style="margin-top:20px;color:#666;">You are hit at random by other players. Armour helps.<br>Full Metal Jacket armour is not used as protection nor does it take damage in riots.<br>Be careful, if you use the wrong type of bullets, or too few, you'll lose some!</p>
		<?php } ?>

		<?php 
		/// START --- CHAV
		if ($page == "1") { 
		?>
		<?php
		if($fetch->riots_rank != '1'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Chav');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Chav' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>
			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			<p><b>Location:</b></br><?php if($searchR != '0') echo "Found in $searchF->location"; }elseif($searchR == '0'){ echo'Not yet known'; } ?></p>
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
	
		<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />
		<?php } ?>
		<?php } ?>

<?php //copy from here ?>
		<?php
		/// START --- Pickpocket
		if ($page == "2") { 
		?>

		<?php
		if($fetch->riots_rank != '2'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Pickpocket');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Pickpocket' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>

						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>

<?php ///// copy to here and paste below... ?>



<?php //copy from here ?>
		<?php
		/// START --- Vandal
		if ($page == "3") { 
		?>

		<?php
		if($fetch->riots_rank != '3'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Vandal');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Vandal' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>




<?php //copy from here ?>
		<?php
		/// START --- Thief
		if ($page == "4") { 
		?>

		<?php
		if($fetch->riots_rank != '4'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Thief');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Thief' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>



<?php //copy from here ?>
		<?php
		/// START --- Criminal
		if ($page == "5") { 
		?>

		<?php
		if($fetch->riots_rank != '5'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Criminal');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Thief' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+1, riotpoints=riotpoints+1 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>



<?php //copy from here ?>
		<?php
		/// START --- Gangster
		if ($page == "6") { 
		?>

		<?php
		if($fetch->riots_rank != '6'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Gangster');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Thief' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>


<?php //copy from here ?>
		<?php
		/// START --- Hitman
		if ($page == "7") { 
		?>

		<?php
		if($fetch->riots_rank != '7'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Hitman');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Hitman' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>



<?php //copy from here ?>
		<?php
		/// START --- Knuckle Breaker
		if ($page == "8") { 
		?>

		<?php
		if($fetch->riots_rank != '8'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Knuckle Breaker');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Knuckle Breaker' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>




<?php //copy from here ?>
		<?php
		/// START --- Boss
		if ($page == "9") { 
		?>

		<?php
		if($fetch->riots_rank != '9'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Boss');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Boss' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+2, riotpoints=riotpoints+2 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>



<?php //copy from here ?>
		<?php
		/// START --- Assassin
		if ($page == "10") { 
		?>

		<?php
		if($fetch->riots_rank != '10'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Assassin');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Assassin' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>
		
<?php //copy from here ?>
		<?php
		/// START --- Don
		if ($page == "11") { 
		?>

		<?php
		if($fetch->riots_rank != '11'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Don');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Don' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>

<?php //copy from here ?>
		<?php
		/// START --- Godfather
		if ($page == "12") { 
		?>

		<?php
		if($fetch->riots_rank != '12'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Godfather');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Godfather' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>


<?php //copy from here ?>
		<?php
		/// START --- Global Terror
		if ($page == "13") { 
		?>

		<?php
		if($fetch->riots_rank != '13'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Global Terror');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Global Terror' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>


<?php //copy from here ?>
		<?php
		/// START --- Global Dominator
		if ($page == "14") { 
		?>

		<?php
		if($fetch->riots_rank != '14'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Global Dominator');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Global Dominator' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>

<?php //copy from here ?>
		<?php
		/// START --- Untouchable Godfather
		if ($page == "15") { 
		?>

		<?php
		if($fetch->riots_rank != '15'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Untouchable Godfather');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Untouchable Godfather' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>

<?php //copy from here ?>
		<?php
		/// START --- Legend
		if ($page == "16") { 
		?>

		<?php
		if($fetch->riots_rank != '16'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Legend');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Legend' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>You must search for the player then decide wether you want to Attack or Rob them!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>

<?php //copy from here ?>
		<?php
		/// START --- Official TP Legend
		if ($page == "17") { 
		?>

		<?php
		if($fetch->riots_rank != '17'){
			echo'You have either completed this rank, or you have not reached this rank yet.';
		}else{
			if($_POST['RandomUser']){
				if($fetch->riots_used >= 5){
					echo"<p>You can't get a new target yet. You have used all 5 chances.</br>You need to wait until midnight for them to reset.</p>";
				}else{
					riotTarget('Official TP Legend');
				}
			}

		$chavQ = mysqli_query( $connection, "SELECT * FROM `riot_targets` WHERE username='$username' AND rank='Official TP Legend' ORDER BY id DESC"); 
		$chavR = mysqli_num_rows($chavQ);
		$chavF = mysqli_fetch_object($chavQ);

		$search = mysqli_query( $connection, "SELECT * FROM `searches` WHERE username='$username' AND target='$chavF->target' AND status='Success'");
		$searchR = mysqli_num_rows($search);
		$searchF = mysqli_fetch_object($search);

		$targetInfo = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM `accounts` WHERE username='$chavF->target'"));

		if($chavR != '0'){
		?>

			<p></p>
			<p><b>Your Target:</b></br><?php echo"<a href='profile.php?viewing=$chavF->target'>$chavF->target</a>"; ?></p>
			</br></br><b>Location:</b></br><?php if($searchR != '0'){ echo "Found in $searchF->location"; } if($searchR == '0'){ echo'Not yet known'; } ?>
			
				<?php
				if($_POST['Steal']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$stealAmount = ($targetInfo->money / 100) * 5;

						if($stealAmount < 0){
							$loot = rand(0,100000);
						}else{

						$loot = rand(0,$stealAmount);

						}

						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape unharmed, but you were taken for &pound;".makecomma($loot).". The rioter responsible escaped.";
						mysqli_query( $connection, "UPDATE `accounts` SET money=money+$loot, riots_rank=riots_rank+1, rrobed=rrobed+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET money=money-$loot WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You stole &pound;".makecomma($loot)." from $targetInfo->username.</p>";
					}
				}

				if($_POST['Attack']){
					if($searchR == '0'){
						echo'You havent found the user.';
					}else{

						$h = rand(1,10);
						$msgSend = "Dear $targetInfo->username, you were caught in the middle of a riot. You managed to escape, but you lost $h% health. The rioter responsible escaped.";

						mysqli_query( $connection, "UPDATE `accounts` SET riots_rank=riots_rank+1, rattack=rattack+3, riotpoints=riotpoints+3 WHERE username='$username'");
						mysqli_query( $connection, "UPDATE `accounts` SET health=health-$h WHERE username='$targetInfo->username'");
						mysqli_query( $connection, "INSERT INTO `inbox` (`id`, `to`, `from`, `subject`, `message`, `date`, `read`, `saved`, `event_id`, `wit`, `wuser`, `crewu`, `crewin`, `wdied`) VALUES (NULL, '$to', 'Notification Msg', 'Riots', '$msg', '$date', '0', '0', '0', '0', '', '', '', '')");
						mysqli_query( $connection, "DELETE FROM `searches` WHERE username='$username' AND target='$targetInfo->username'");
						mysqli_query( $connection, "DELETE FROM `riot_targets` WHERE username='$username'");
						echo"<p>You attacked $targetInfo->username and took $h% health.</p>";
					}
				}
				?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Steal' value='Steal' class='custombutton'></p><?php } ?>
						<?php if($searchR != '0'){ ?><p><input type='submit' name='Attack' value='Attack' class='custombutton'></p><?php } ?>
								<?php } ?>
						<p><input type='submit' name='RandomUser' class='custombutton' value='New Target'><br>(You can only do this 5 times a day)</p>
		
		
		<br></br><i>After completing the last rank you will be able to do them all over again!</i><img src="../images/gangster.png" alt="" style="float:right" />

		<?php }} ?>
</td>
</tr>
</table>
</body> <?php include_once"incfiles/foot.php"; ?>