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
<title>Thug Paradise 2 :: Menu</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name','height=700,width=850');
	if (window.focus) {newwindow.focus()}
	return false;
}
function hide(id){ 
var hide = document.all? document.all[id + "_block"] : document.getElementById? document.getElementById(id + "_block") : "";
  	if(hide.style.display == 'none'){ hide.style.display = ''; }
  	else{  hide.style.display = 'none'; }
   }
// -->
</script>
</head>
<body>
<link rel=stylesheet href=style2.css type=text/css>
<style type="text/css">
<!--
body {
	background-color: #000000;
}
body,td,th {
	font-family: verdana;
	font-size: xx-small;
	color: #FFFFFF;
}
a:link {
	text-decoration: none;
	color: #FFFFFF;
}
a:visited {
	text-decoration: none;
	color: #FFFFFF;
}
a:active {
	text-decoration: none;
	color: #FFFFFF;
}
a:hover {
	text-decoration: underline;
	color: #990000;
}
.gradient {
	font-family: Arial;
	font-weight: Bold;
	font-size: 12px;
	font-style: normal;
	line-height: 23px;
	color: #FFFFFF;
	background-image: url(../images/gpgradientblack.gif);
	background-repeat: repeat-x;
}
.style1 {color: #FF0000}
-->
</style>

</head>
<table class="table1px" width="106" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td onclick='hide("main"); return false;' class="gradient"><div align="left">Information</div></td>
  </tr>
<tbody id="main_block">
  <tr>
    <td>
    <?php if ($fetch->username == "Kartel" || $fetch->userlevel == "1"){ ?>
	<div align="left"><img src="../images/arrow.gif"><a href="../786/index2.php" target="middle"> <font color=gold><b>Control Panel</b></font></a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="../786/search.php" target="middle"> <font color=gold><b>Search</b></font></a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="../xonline.php" target="middle"> <font color=gold><b>Online IPs</b></font></a></div>
  <?php } ?>
	<div align="left"><img src="../images/arrow.gif"><a href="news.php" target="middle"> News</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="helpc.php" target="middle"> Help Centre</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="search.php" target="middle"> Find Player</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="online.php" target="middle"> Players Online</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="properties.php" target="middle"> Domination</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="statistics.php" target="middle"> World Stats</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="celebs1.php" target="middle"> TP Celebs</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="hitlist.php" target="middle"> Hitlist</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="witness.php" target="middle"> Witnesses</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="missions.php" target="middle"> Missions</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="fugi.php" target="middle"> Fugitives</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="editprofile.php" target="middle"> Edit Profile</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="mystats.php" target="middle"> My Stats</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="graft.php" target="middle"> Grafting</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="rewards.php" target="middle"> Daily Rewards</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="creditsNew.php" target="middle"> Use Credits</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="buycredits.php" target="middle"> Buy Credits</a></div>
	</td>
  </tr>
</tbody>
  <tr>
    <td class="gradient" onclick='hide("comun"); return false;'><div align="left">Communication</div></td>
  </tr>
<tbody id="comun_block">
  <tr>
    <td>
	<div align="left"><img src="../images/arrow.gif"><a href="inbox.php" target="middle"> Inbox</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="sendmessage.php" target="middle"> Send Message</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="soon.php" target="middle"> TP Chat</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="forum.php?forum=main" target="middle"> Forum</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="forum.php?forum=oc" target="middle"> OC Forum</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="forumbm.php?forum=sale" target="middle"> Black Market</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="forum.php?forum=crew" target="middle"> Gang Forum</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="support.php" target="middle"> TP Support</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="menu.php" onclick="return popitup('notepad.php')"> TP Notepad</a></div>
	</td>
  </tr>
</tbody>
  <tr>
    <td class="gradient" onclick='hide("act"); return false;'><div align="left">Actions</div></td>
  </tr>
<tbody id="act_block">
  <tr>
    <td>
	<div align="left"><img src="../images/arrow.gif"><a href="crime2.php" target="middle"> Commit Crime</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="gta2.php" target="middle"> GTA</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="boatcrime.php" target="middle"> Boat Hi-Jacking</a></div>
	    <div align="left"><img src="../images/arrow.gif"><a href="drugs.php" target="middle"> Drug Cartel</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="garage.php" target="middle"> Garage</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="jail.php" target="middle"> Jail</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="hospital.php" target="middle"> Hospital</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="test.php" target="middle"> OCs</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="safe.php" target="middle"> Safehouse</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="graveyard.php" target="middle"> Graveyard</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="Muscle.php" target="middle"> Muscle</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="kill2.php" target="middle"> Search &amp; Kill</a></div>
    <div align="left"><img src="../images/arrow.gif"><a href="riots.php" target="middle"> Riots</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="gangs.php" target="middle"> Gangs</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="shop.php" target="middle"> Go Shopping</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="inventory.php" target="middle"> Inventory</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="travel.php" target="middle"> Travel</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="bank.php" target="middle"> Bank</a></div>
        <?php if(($fetch->oacn) >= 20){ ?>	<div align="left"><img src="../images/arrow.gif"><a href="SwissBank.php" target="middle"> Swiss Bank</a></div><?php } ?>
    	<div align="left"><img src="../images/arrow.gif"><a href="newDeal.php" target="middle"> Deal</a></div>
	</td>
  </tr>
</tbody>
  <tr>
    <td class="gradient" onclick='hide("gamble"); return false;'><div align="left">Gambling</div></td>
  </tr>
<tbody id="gamble_block">
  <tr>
    <td>
	<div align="left"><img src="../images/arrow.gif"><a href="bshop.php" target="middle"> Betshop</a></div>
	<div align="left"><img src="../images/arrow.gif"><a href="casinos.php" target="middle"> Enter Casino</a></div>
	</td>
  </tr>
</tbody>
</table>
</body>
</html>