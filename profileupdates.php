<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

///////MONEY IN GAME AND PER USER

$result11111 = mysqli_query( $connection, "SELECT money FROM accounts WHERE userlevel='0' OR userlevel='2' OR userlevel='3' OR userlevel='5' OR userlevel='6'");
	$moneytot = 0;
	while($row=mysqli_fetch_array($result11111)){
		$moneytot+=$row[0]+$row[1];
	}
		$nums=mysqli_num_rows($result11111); 
	$per_user = round($moneytot / $nums);
$moneytot = round($moneytot);
$ud=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM accounts")); 

$site=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM stats WHERE id='1'"));
$dead= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status = 'Dead'"));
$alive= mysqli_num_rows(mysqli_query( $connection, "SELECT username FROM accounts WHERE status != 'Dead'"));
/////TOTAL ATTEMPTS
$attempts= mysqli_num_rows(mysqli_query( $connection, "SELECT id FROM attempts WHERE outcome = 'Survived'"));
///?END

$gangEngland=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='England'")); 
$gangPakistan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Pakistan'")); 
$gangJamaica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Jamaica'")); 
$gangAmerica=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='America'")); 
$gangJapan=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Japan'")); 
$gangGermany=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='Germany'"));
$gangChina=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM gangCountry WHERE location='China'"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Updated Profiles</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<style>table:first-child{min-width:700px;}td{text-align:center;}.tableborder{padding:7px;}.headings .tableborder{font-weight:bold;font-size:11px;}#back{position:absolute;top:5px;left:5px;}</style>
</head>
<body>
<div id="back"><a href="online.php">Players online</a></div><table border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="gradient" colspan="4">Edited Profiles in the past 12 hours</td>
</tr>
<tr class="headings">
<td class="tableborder">Username</td>
<td class="tableborder">Rank</td>
<td class="tableborder">Gang</td>
<td class="tableborder">Time</td>
</tr>
<tr>
<?php $c=mysqli_query( $connection, "SELECT * FROM accounts ORDER BY proedited DESC LIMIT 10");
while($d=mysqli_fetch_object($c)){
echo "<tr><td class=\"tableborder\" valign=\"top\"><a href='profile.php?viewing=$d->username'><b><center>$d->username</center></b></a></td> 
	  <td class=\"tableborder\"><center>$d->rank</center></td>
	  <td class=\"tableborder\"><center>$d->crew</center></td>
	  	  <td class=\"tableborder\"><center>$d->proedited</center></td>
"; } ?>


</tr>
</table>
<style>.foot{border:1px solid #666;font-size:9px;}.foot a{color:#CCC;text-decoration:none;font-weight:bold;font-style:italic;border-bottom:1px solid #333;}</style>
<?php include_once"incfiles/foot.php"; ?>
<br/></body>
</html>