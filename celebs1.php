<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>TP Celebs</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style type="text/css"><!--
.style1 {color: #FF0000 background: #000000; opacity:0.8;}
.style2 {color: #FFFFFF}
--></style>
</head>
<body>
<div align="center">
<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
<td class="gradient"><div align="center">TP Celebrities</div></td>
</tr>
<tr>
<td class="tableborder">
<table width="550" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most Experience</div></td>
</tr>
<?php
$xp_query = mysqli_query( $connection, "SELECT * FROM accounts WHERE (`userlevel`='0') OR (`userlevel`='2') OR (`userlevel`='3') ORDER BY rankpoints DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($xp_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->rankpoints)." xp $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most Kills</div></td>
</tr>
<?php
$kill_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY kill_skill DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($kill_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->kill_skill)." kills $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
</tr>
</table>
<br/>
<table width="550" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most Successful Jail Breaks</div></td>
</tr>
<?php
$jail_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY busts DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($jail_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->busts)." $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most Crimes</div></td>
</tr>
<?php
$crime_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY crimes DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($crime_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->crimes)." $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
</tr>
</table>
<br/>
<table width="550" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most GTAs</div></td>
</tr>
<?php
$gta_query = mysqli_query( $connection, "SELECT * FROM account_info WHERE (`food_crimes`='0') ORDER BY gtas DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($gta_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->gtas)." $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
<td valign="top"><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Most Fugitive Kills</div></td>
</tr>
<?php
$oacn_query = mysqli_query( $connection, "SELECT * FROM accounts WHERE (`userlevel`='0') ORDER BY oacn DESC LIMIT 10");

$i = 1;

while($man = mysqli_fetch_object($oacn_query)){

 if($i == '1'){
  $colour1 = "<font color=red>";
  $colour2 = "</font>";
 }else{
  $colour1 = "";
  $colour2 = "";
 }

 echo "<td class='tableborder style2'><div align='left'>$colour1 $i. <a href='profile.php?viewing=$man->username'>$man->username</a> with ".makecomma($man->oacn)." kills $colour2</div></td>
</tr>";
 $i++;
}
?>
</table></td>
</tr>
</table>
<br/>
<table width="550" border="0" align="center" cellpadding="5" cellspacing="0">
<tr>
<td><table width="250" border="2" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient"><div align="center">Other Stats</div></td>
</tr>
<?php $no1 = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE rank='Official TP Legend'"));
$no2 = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE money>'1000000000'"));
$no3 = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM account_info WHERE busts>='10000'"));
$no4 = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM account_info WHERE kill_skill>='40'"));
$no5 = mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts WHERE oacn>='20'"));

?>
<tr>
<td class="tableborder"><div align="left">Alive Official TP Legends: <?php echo $no1; ?></div></td>
</tr>
<tr>
<td class="tableborder"><div align="left">Money &gt; $1,000,000,000: <?php echo $no2; ?></div></td>
</tr>
<tr>
<td class="tableborder"><div align="left">Criminal Masterminds: <?php echo $no3; ?></div></td>
</tr>
<tr>
<td class="tableborder"><div align="left">World Class Assassins: <?php echo $no4; ?></div></td>
</tr>
<tr>
<td class="tableborder"><div align="left">Mercenaries: <?php echo $no5; ?></div></td>
</tr>
</table>
<div align="center">
<br/>
</div>
<div align="center" style="font-size:9px;"><a href="modcelebs.php">Mod Celebs!</a></div></td>
</tr>
</table>
</td></tr>
</table>
<strong><em><br/>
Stats automatically updated daily</em></strong></div>
</body>
</html>
