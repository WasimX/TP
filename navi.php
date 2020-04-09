<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

$inbox_msg=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM `inbox` WHERE `read`='0' AND `to`='$username'")); ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="style.css" type="text/css">
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=700,width=850');
	if (window.focus) {newwindow.focus()}
	return false;
}

// -->
</script>
</head>
<body>
<br><br>
<table align="center" width="136" border="0" class="table1px" cellspacing="0" cellpadding="0">
<tr><td background="../images/grad.png" height="25" align="center"><b>Information</b></td></tr>
<tr><td class="tableborder">
	<div>><a href="news.php" target="middle"> News</a></div>
    <div>><a href="tut.php" target="middle"> F.A.Q</a></div>
	<div>><a href="search.php" target="middle"> Find Gangs / Users</a></div>
	<div>><a href="online.php" target="middle"> Users Online</a></div>
	<div>><a href="properties.php" target="middle"> Properties</a></div>
	<div>><a href="records.php" target="middle"> TP Celebs</a></div> 
	<div>><a href="garage.php" target="middle"> Garage Hideout</a></div>
	<div>><a href="safe.php" target="middle"> Safehouse</a></div>
	<div>><a href="hospital.php" target="middle"> Hospital</a></div>
	<div>><a href="statistics.php" target="middle"> World Stats</a></div>
	<div>><a href="workxp.php" target="middle"> Work Experience</a></div>
	<div>><a href="blacklist.php" target="middle"> Hitlist</a></div>
	<div>><a href="achievements.php" target="middle"> Achievements</a></div>
	<div>><a href="credit.php" target="middle"> Credits</a></div>
    <div>><a href="editprofile.php" target="middle"> Edit Profile</a></div>
</td></tr>
</table><br>
 
<table align="center" border="0" cellspacing="0" width="136" class="table1px" cellpadding="0">
<tr><td background="../images/grad.png" height="25" align="center"><b>Communication</b></td></tr>
<tr><td class="tableborder">
	<div>><a href="inbox.php" target="middle"> Inbox</a></div>
	<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1"){ ?>
	<div>><a href="control/menu.php" target="middle"> Control Panel</a></div><?php } ?> 
	<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "5"){ ?>
	<div>><a href="control/gfx.php" target="middle"> GFX Panel</a></div><?php } ?> 
	<div>><a href="sendmessage.php" target="middle"> Send Message</a></div>
	<div>><a href="forum.php?forum=main" target="middle"> The Forum</a></div> 
	<div>><a href="forum.php?forum=crew" target="middle"> Gangs Forum</a></div>
	<div>><a href="forum.php?forum=cc" target="middle"> OC Forum</a></div> 
<?php if ($fetch->userlevel == "4" || $fetch->userlevel == "1" || $fetch->userlevel == "5" || $fetch->hdop == "1" || $fetch->fmod == "1"){ ?>
	<div>><a href="forum.php?forum=staff" target="middle"> Staff Forum</a></div><?php } ?> 
	<div>><a href="forum.php?forum=sale" target="middle"> Sales Forum</a></div> 
	<div>><a href="support.php" target="middle"> Support Desk</a></div>
	<div>><a href="helpassist.php" target="middle"> Help Assistance</a></div>
	<div>><a href="navi.php" onClick="return popitup('notepad.php')"> Notes</a></div>
</td></tr>
</table><br>

<table align="center" border="0" cellspacing="0" width="136" class="table1px" cellpadding="0">
<tr><td background="../images/grad.png" height="25" align="center"><b>Actions</b></td></tr>
<tr><td class="tableborder">
	<div>><a href="crime2.php" target="middle"> Crimes</a></div>
	<div>><a href="gta.php" target="middle"> Car Crimes</a></div>
	<div>><a href="smuggling.php" target="middle"> Drug Smuggling</a></div>
	<div>><a href="crime.php" target="middle"> Crazy Crimes</a></div>
	<div>><a href="test.php" target="middle"> Organized Crime</a></div>
	<div>><a href="drugs.php" target="middle"> Drug Dealers</a></div>
	<div>><a href="range.php" target="middle"> Inventory Range</a></div>
	<div>><a href="jail.php" target="middle"> Jail</a></div>
	<div>><a href="missions.php" target="middle"> Missions</a></div>
	<div>><a href="buycar.php" target="middle"> Test Page</a></div>
	<div>><a href="grave.php" target="middle"> Graveyard</a> <font color=red>*New</font></div>
    <div>><a href="deal.php" target="middle"> Deal</a></div>
	<div>><a href="kill.php" target="middle"> Search & Kill</a></div>
	<div>><a href="carfactory.php" target="middle"> Car Factories</a></div>
        <div>><a href="gang_apply.php" target="middle"> Join</a></div>
	<div>><a href="gangs.php" target="middle"> Gangs</a></div> 
	<div>><a href="goshopping.php" target="middle"> Go Shopping</a></div>
	<div>><a href="travel.php" target="middle"> Travel Agents</a></div>
	<div>><a href="bank.php" target="middle"> Bank</a></div>
<?php if($fetch->oacn) >= 20){ echo"<a href=bank.php target=middle> Swiss Bank</a></div>";}?> >
	<div>><a href="inventory.php" target="middle"> Your Stats</a></div>
</td></tr>
</table><br> 

<table align="center" border="0" cellspacing="0" width="136" class="table1px" cellpadding="0">
<tr><td background="../images/grad.png" height="25" align="center"><b>Casinos</b></td></tr>
<tr><td class="tableborder">
<div>><a href="casinos.php" target="middle"> Enter Casino</a></div>
</td></tr>
</table>

<p>&nbsp;</p>
  </div>
  
  </body></html>