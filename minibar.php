<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection,  "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);


if (empty($_SESSION['username'])){
echo "<script>setTimeout('top.location.href=\"error.php\"','0')
</script>";
}

if ($fetch->userlevel == "1" || $fetch->userlevel == "4") { mysqli_query( $connection,  "UPDATE accounts SET health='100' WHERE username='$username'"); }

	$username = $_SESSION[ 'username' ];
	$query = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username' LIMIT 1" );
	$fetch = mysqli_fetch_object( $query );

	$date = gmdate( 'Y-m-d H:i:s' );

	if ( ( $fetch->rank == "Chav" ) && ( $fetch->rankpoints >= "50" ) ) {
		$newrank = "Pickpocket";
		$done = "1";
		$credits = "1";
	} elseif ( ( $fetch->rank == "Pickpocket" ) && ( $fetch->rankpoints >= "100" ) ) {
		$newrank = "Vandal";
		$done = "1";
		$credits = "2";
	}
	elseif ( ( $fetch->rank == "Vandal" ) && ( $fetch->rankpoints >= "250" ) ) {
		$newrank = "Thief";
		$done = "1";
		$credits = "3";
	}
	elseif ( ( $fetch->rank == "Thief" ) && ( $fetch->rankpoints >= "500" ) ) {
		$newrank = "Criminal";
		$done = "1";
		$credits = "4";
	}
	elseif ( ( $fetch->rank == "Criminal" ) && ( $fetch->rankpoints >= "1000" ) ) {
		$newrank = "Gangster";
		$done = "1";
		$credits = "5";
	}
	elseif ( ( $fetch->rank == "Gangster" ) && ( $fetch->rankpoints >= "2000" ) ) {
		$newrank = "Hitman";
		$done = "1";
		$credits = "6";
	}
	elseif ( ( $fetch->rank == "Hitman" ) && ( $fetch->rankpoints >= "5000" ) ) {
		$newrank = "Knuckle Breaker";
		$done = "1";
		$credits = "7";
	}
	elseif ( ( $fetch->rank == "Knuckle Breaker" ) && ( $fetch->rankpoints >= "10000" ) ) {
		$newrank = "Boss";
		$done = "1";
		$credits = "8";
	}
	elseif ( ( $fetch->rank == "Boss" ) && ( $fetch->rankpoints >= "20000" ) ) {
		$newrank = "Assassin";
		$done = "1";
		$credits = "9";
	}
	elseif ( ( $fetch->rank == "Assassin" ) && ( $fetch->rankpoints >= "35000" ) ) {
		$newrank = "Don";
		$done = "1";
		$credits = "10";
	}
	elseif ( ( $fetch->rank == "Don" ) && ( $fetch->rankpoints >= "50000" ) ) {
		$newrank = "Godfather";
		$done = "1";
		$credits = "11";
	}
	elseif ( ( $fetch->rank == "Godfather" ) && ( $fetch->rankpoints >= "70000" ) ) {
		$newrank = "Global Terror";
		$done = "1";
		$credits = "12";
	}
	elseif ( ( $fetch->rank == "Global Terror" ) && ( $fetch->rankpoints >= "90000" ) ) {
		$newrank = "Global Dominator";
		$done = "1";
		$credits = "13";
	}
	elseif ( ( $fetch->rank == "Global Dominator" ) && ( $fetch->rankpoints >= "145000" ) ) {
		$newrank = "Untouchable Godfather";
		$done = "1";
		$credits = "14";
	}
	elseif ( ( $fetch->rank == "Untouchable Godfather" ) && ( $fetch->rankpoints >= "175000" ) ) {
		$newrank = "Legend";
		$done = "1";
		$credits = "15";
	}
	elseif ( ( $fetch->rank == "Legend" ) && ( $fetch->rankpoints >= "225000" ) ) {
		$newrank = "Official TP Legend";
		$done = "1";
		$credits = "16";
	}


	//if (!$done){ $done="0"; }
	$done = "0";
	if ( $done == "1" ) {
		mysqli_query( "UPDATE accounts SET rank='$newrank' WHERE username='$username'" );
		mysqli_query( "UPDATE accounts SET credits=credits+$credits WHERE username='$username'" );
		mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `date` , `read` , `saved` , `event_id` ) 
VALUES ('', '$username', '$username', '<b><center>Congratulations! You have been promoted to $newrank!
Keep it up!</b><br></br><i>You have received $credits Credits for this achievement.</i></center>', '$date', '0', '0', '0')" );
	}


?>
<head>
<html>
<title>Thug Paradise 2 :: Stats</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="style.css" type="text/css">
<script language="javascript">
function Logout (){
var del = confirm("Please Confirm That You Wish To Logout , And Thanks For Playing ");
if (del == true){
var loc = "index.php?logout=yes";
parent.top.location.href=loc; }}
</script>
</head>
 
<?php $check = mysqli_query( $connection,  "SELECT * FROM `inbox` WHERE `read`='0' AND `to`='$username'");
$inbox=mysqli_num_rows($check);

$fetch=mysqli_fetch_object(mysqli_query( $connection,  "SELECT * FROM accounts WHERE username='$username'"));

$query1=mysqli_query( $connection,  "SELECT * FROM account_info WHERE username='$username'");
$info=mysqli_fetch_object($query1);

if($inbox > "0"){
$isnbox = "images/newmsg.gif";
}elseif($inbox == "0"){
$isnbox = "images/tile_cat2.gif";
}


$currank=$fetch->rank;
$rankp = $fetch->rankpoints;


if ($currank == "Chav"){
$max = "50";
$old="0";
}elseif ($currank == "Pickpocket"){
$max = '100';
$old="50";
}elseif ($currank == "Vandal"){
$max = '250';
$old="100";
}elseif ($currank == "Thief"){
$max = '500';
$old="250";
}elseif ($currank == "Criminal"){
$max = '1000';
$old="500";
}elseif ($currank == "Gangster"){
$max = '2000';
$old="1000";
}elseif ($currank == "Hitman"){
$max = '5000';
$old="2000";
}elseif ($currank == "Knuckle Breaker"){
$max = '10000';
$old="5000";
}elseif ($currank == "Boss"){
$max = '20000';
$old="10000";
}elseif ($currank == "Assassin"){
$max = '35000';
$old="20000";

}elseif ($currank == "Don"){
$max = '50000';
$old="35000";

}elseif ($currank == "Godfather"){
$max = '70000';
$old="50000";

}elseif ($currank == "Global Terror"){
$max = '90000';
$old="70000";

}elseif ($currank == "Global Dominator"){
$max = '145000';
$old="90000";

}elseif ($currank == "Untouchable Godfather"){
$max = '175000';
$old="145000";

}elseif ($currank == "Legend"){
$max = '225000';
$old="175000";

}elseif ($currank == "Official TP Legend"){
$max = '99999999999999';
$old="225000";

}
$percent = round((($rankp-$old)/($max-$old))*100);
?>



<html>
<head>
<meta http-equiv="refresh" content="20">
<style type="text/css">

body {
    font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: normal;
	color: #FFFFFF;
	background-image: url(images/tile_cat2.gif); 
}
.tableborder {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px; 
	font-style: normal;
	line-height: normal;
	font-weight: bold; 
	color: #FFFFFF;
	background-color: #666666;
	padding: 5px;	
} 
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #FFFFFF;
	}

</style>
<title>Stats</title> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
 
<div align="center"> 
<table height="24" align="center" cellspacing="4" cellpadding="2">
<tr valign="middle">
<td height="22" align="center" valign="middle"></td>
<td height="22" align="center" valign="middle"></td>
<td height="22" valign="middle" scope="col"><?php if ($inbox > 0){ 
echo "<a href=\"inbox.php\" target=\"middle\" border=\"0\"><img src=\"images/newmsg.gif\" border=\"0\"></a>"; } ?></td>
<td height="22" valign="middle" scope="col"><b>Name: <font color='#FF9900'><?php echo "$fetch->username"; ?></font></b></td>
<td height="22" valign="middle" scope="col"><b>Rank: <font color='#99CCFF'> <?php echo "$fetch->rank"; ?></font></b></td>

<td height="22" valign="middle" scope="col"><b>HP: <?php if ($fetch->health > "50") { $s='green'; }elseif ($fetch->health <= "50") { $s='red'; } ?> <font color="<?php echo "$s"; ?>"><?php echo "$fetch->health%"; ?></font></b>
</td>

<td height="22" valign="middle" scope="col"><b>Gang: <font color='99CCFF'><?php
if($fetch->crew == "0") { echo "<b><font color='#99CCFF'>None</font>"; }
elseif($fetch->crew != "0") { echo "<b><font color='99CCFF'>$fetch->crew</font>"; } ?> 
</font></b></td>
<td height="22" valign="middle" scope="col"><b>Cash: <font color='#FFCC33'><?php echo "&#163;".makecomma($fetch->money).""; ?></font></b></td>
<td height="22" valign="middle" scope="col"><b>Credits: <font color='#999999'><?php echo "".makecomma($fetch->credits).""; ?></font></b></td>
<td height="22" valign="middle" scope="col"><b>Loc: <font color='#0099FF'><?php echo "$fetch->location"; ?></font></b></td>
<td valign="middle" scope="col" width="0"> <b>    
<?php
if($fetch->rank == "Official TP Legend") { ?> <font color='#ffffff'><?php echo "".makecomma($fetch->rankpoints).""; ?> xp</font> 
<?php }elseif($fetch->rank != "Official TP Legend") { ?>
<table width="80%" height="0" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td height="0" colspan="3" align="center" valign="middle" scope='col'>
<table width="100" height="0" border="1" cellpadding="0" cellspacing="0" bordercolor="#999999">
<tr>
<td width="<?php echo "$percent"; ?>%" bgcolor="#009900"><div align='center'><b><font size="1px"><?php echo "".makecomma($percent)."%"; ?></font></b></div></td>
<td width="100%" bgcolor="#990000"><div align='center'></div></td>
</tr>
</table>
</td></tr>
</table>
<?php } ?>
</b></td>
<td height="22" valign="middle" scope="col" width="25"><b><a href=javascript:Logout()><img width="20" height="20" src="images/logout.png" border="0" title="Logout" /></a></b></td> 
<td height="22" valign="middle" scope="col" width="25"><b><a href="minibar.php"><img width="20" height="20" src="images/refresh.png" border="0" title="Refresh" /></a></b></td> 
  
</table>
 </td>

		 

  </table> 
</div>
</body>
</html>