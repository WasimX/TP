<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

$pagin=$_GET['page']; 

$fetch= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

if (strip_tags($_POST['go'])){
$bet=intval(strip_tags($_POST['bet']));

if ($bet == "0" || !$bet || ereg('[^0-9]',$bet)){ echo "TP servers dont allow shit like that.<br /><br />";
}elseif ($bet != 0 || $bet || !ereg('[^0-9]',$bet)){

if ($bet > 500000000){
echo "You cant bet more than &pound;500,000,000<br /><br />"; 
}elseif ($bet <= 500000000){

if ($bet > $fetch->money){
echo "You dont have that much cash!<br /><br />";
}elseif ($bet <= $fetch->money){

$playernum=rand(1,100);
$newmoney = $bet * 2;
$lostmoney = $fetch->money - $bet;

if ($playernum > "50"){

echo "<center><font color=green size=\"15px\">$playernum</font><br /><b>You bet &pound;".makecomma($bet)." and won &pound;".makecomma($newmoney)."!</b><br /><br /></center>";
mysqli_query( $connection, "UPDATE accounts SET money=money+$bet WHERE username='$username'"); 

}elseif ($playernum <= "50"){

echo "<center><font color=red size=\"15px\">$playernum</font><br /><b>You bet &pound;".makecomma($bet)." and won &pound;0!</b><br /><br /></center>";
mysqli_query( $connection, "UPDATE accounts SET money='$lostmoney' WHERE username='$username'"); 

}}}}}

?>

<html>
<head>
<title>Thug Paradise :: 50/50</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.hasansmumstits { 
	color: #000000;
	border-collapse: collapse;
	background-image: url(../images/bbc.jpg);
	background-position: center bottom;
	background-repeat: no-repeat;
	padding: 5px;	
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 10px; 
	font-style: normal;
	line-height: normal;
	color: #FFFFFF;
	padding: 4px;	
} 
-->
</style>
</head>
<body>
<form action="" method="post" name="form">

<table width="460" height="295" class="table1px" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td height="29" class="gradient">Fifty/Fifty</td></tr>
<tr><td height="260">

<table width="460" height="260" class="hasansmumstits" border="0" align="center">
<tr><td height="133" align="center"><b>Your Bet: <br>&pound;</b>
<input name="bet" type="text" id="bet" class="textbox" size="20">
<br></br>
<input name="go" class="custombutton" type="submit" id="go" value="Place Bet!">
<br></br>
<br></br>
<center><b>The Maximum Bet On This Casino Is &pound;500,000,000!<br>
Fifty Fifty Is Owned By <a href="profile.php?viewing=Kartel">Kartel</a>.</b>
</td>
</tr>
</table>

</td></tr>
</table>
</form>
<br><table align="center" width="460" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>Bored of low maxbets? Well here is your solution, 50/50 allows you to bet upto &pound;500,000,000 with a fair 50% chance of winning, this could either go one way or the other and a great way to gamble on TP!</p></div></td></tr></table></td></tr></table></td></tr></table>
</body> 
</html>
<?php require_once "incfiles/foot.php"; ?>