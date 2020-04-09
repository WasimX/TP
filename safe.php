<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php"; 
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$date = gmdate('Y-m-d H:i:s');
$currank = $fetch->rank;
$rankcheck=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));
$newk= (3600*24)+time();

if ($fetch->lastsafehouse > time()){ die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=\"errorMsg\" class=\"repeatable\">You have to wait ".maketime($fetch->lastsafehouse)." before you can enter the safehouse!</div><br/><br/>"); }

if ($fetch->protecting1 != '0'){ die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=\"errorMsg\" class=\"repeatable\">You can't be a bodyguard and use the safehouse.</div><br/><br/>"); }

if ($fetch->protection1 != '0'){ die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=\"errorMsg\" class=\"repeatable\">You can't have a bodyguard and be in the safehouse.</div><br/><br/>"); }


$time=time();

$add = $rankcheck->health * 8;
$cost = $rankcheck->cost * 10;
?>

<?php 
if (strip_tags($_POST['Submit']) && strip_tags($_POST['units'])){
$units=intval(strip_tags($_POST['units']));

if($units == 0 || !$units || ereg('[^0-9]',$units)){
	echo"Invalid amount."; 
}
elseif ($units != 0 && $units && !ereg('[^0-9]',$units)){
	$price = $units * $cost;
	if($price > $fetch->money){
		echo "It costs &pound;".makecomma($cost)." for $units hours in safehouse, so you can't afford it.";
	}
	elseif($price <= $fetch->money){
		$addto = $units * 3600;
		$newe = $addto + $timenow;
		mysqli_query( $connection, "UPDATE `accounts` SET safehours='$newe' WHERE username='$username'") or die(mysqli_error());
		mysqli_query( $connection, "UPDATE `accounts` SET money=money-$price WHERE username='$username'") or die(mysqli_error());
		mysqli_query( $connection, "UPDATE `accounts` SET safetime='$units' WHERE username='$username'") or die(mysqli_error());
		mysqli_query( $connection, "UPDATE `accounts` SET safehouse='1' WHERE username='$username'") or die(mysqli_error());
		echo "Thanks for the &pound;".makecomma($price).", here's the key to your room, keep the noise down for $units hours!";
}
}}
?>

<html>
<head>
<title>Thug Paradise :: Safehouse</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body><form action="" method="post">
<table width="600" border="1" cellpadding="0" cellspacing="0" align="center" bordercolor="#FFFFFF">
  <tr><td width="558" height="30" colspan="3" align="center" class="gradient">Safehouse</td>
  </tr>
<?php
  if ($rankcheck->id < "8"){
echo "<tr><td colspan=\"2\" align=\"center\" class=\"tablebackground\"><b>Safehouse boss</b> says:<br><br>Who do you think you are? Your too low to come in here.<br>$fetch->rank's aren't welcome here.";

}elseif ($rankcheck->id >= "8"){
if ($fetch->safehours > time()){
echo "<tr><td colspan=\"2\" align=\"center\" class=\"tablebackground\"><br><b>Safehouse boss</b> says:<br><br>You have still got ".maketime($fetch->safehours)." left before you get kicked out of this house!<br><br>
<font color=\"red\"><b>Warning: If you leave the safehouse early, it is possible that you could get killed. The safehouse will no longer protect you against attacks. Also, you will not receive any of the health which is granted at the end of your departure and will also not receive any of your money back at all.<br>If you wish to leave, you can click \"Leave\" below.</b></font><br><br>
<input type=\"submit\" class=\"custombutton\" name=\"leave\" id=\"leave\" value=\"Leave\"><br><br>";

if($_POST['leave']){
mysqli_query( $connection, "UPDATE accounts SET safehours='0', safehouse='0', safetime='0', lastsafehouse='$newk' WHERE username='$username'");
echo"You left the safehouse successfully!"; }

echo"</td></tr>";
}elseif ($fetch->safehours <= time()){
?>
<tr>
<td class="tablebackground"><div align="center">
<p align="left"><strong><b>G running the safehouse</strong> says: <br/>
<br/>
&quot;There are 10 rooms in the safehouse here in
<?php echo"$fetch->location";?>,
0 rooms are taken!<br/>
<br/>
On the streets you're known as
the &quot;<?php echo"$fetch->rank";?>&quot;, so it'll cost ya
<?php echo"&pound;".makecomma($cost)."";?>
($10m if you've got a property) per hour to enter the safehouse but whilst inside you are completely safe from death!<br/>
<br/>
There will be an additional charge of <?php echo"&pound;".makecomma($cost)."";?> per hour per casino you own, if you've got any that is.<br/>
<br/>
I want cash up front for my own reasons, but you can be certain of your safety here! <br/>
<br/>
Oh, and I'll throw in a few hoes while you're here, you'll gain health when you leave, 10% for every hour you enter!&quot;</p>
<p><strong><u><br/>
A few rules for you<br/>
</u></strong><br/>
You cannot move countries, search or shoot another player, shop, hitlist, bank, bet...You get the idea, you pretty much can't leave the safehouse.</p>
<p>Number of hours to enter:
<input name="units" type="text" id="units" class="textbox" size="2" maxlength="2">
<br/>
(Maximum of 24 hours with a
casino, 48 hours with a store, 72 hours with neither)</b></p>
<p>
<input type="submit" class="custombutton" name="Submit" id="Submit" value="Take a room!">
</p>
</div></td>
</tr>
</table>
  <?php }} ?>
</table>
</form>
<br><table align="center" width="500" border="0" cellpadding="0" cellspacing="0"><tr><td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46"></div></td><td width="450" valign="middle" class="table1px"><div align="center" class="style1"><p>This is one of the new and up to date feature on TP as you can have the ultimate advantage of not being killed. The safehouse works better then any Armour at protecting people but there is a limit of 99hours. Also you need to be ranked Hitman+ to enter!</p></div></td></tr></table></td></tr></table></td></tr></table>
<?php require_once "incfiles/foot.php"; ?> 
</body>
</html>