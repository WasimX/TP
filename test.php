<?php 
session_start(); 
include_once "incfiles/connectdb.php"; 
include_once "incfiles/func.php";
include_once "incfiles/jailcheck.php";  
logincheck();
$username=$_SESSION['username'];
$query=mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$fetch=mysqli_fetch_object($query);

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

if($fetch->health <= "-2000"){
exit('You cant do this as your health is below minus 2,000.'); }

if ($fetch->cc == "1"){ $fetchcc=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM cc WHERE $fetch->ccpost='$username'")); }
$fetchleader=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetchcc->leader'"));
$fetchwmaster=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetchcc->wmaster'"));
$fetchemaster=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetchcc->emaster'"));
$fetchdriver=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$fetchcc->gdriver'"));

if (strip_tags($_GET['accept'])){
$leader=strip_tags($_GET['accept']);
$pos=strip_tags($_GET['pos']);
$fetchccq=mysqli_query( $connection, "SELECT * FROM cc WHERE leader='$leader'");
$fetchccnum=mysqli_num_rows($fetchccq);
$fetchccs=mysqli_fetch_object($fetchccq); 
if ($fetchccnum == "0"){ echo"That Organized crime no longer exists."; }elseif ($fetchccnum > "0"){

if ($pos == "wmaster"){  
if($fetchccs->wmaster != "" && $fetchccs->wmaster != "0"){ echo "The weapons master position is not available."; }
elseif($fetchccs->wmaster == "" || $fetchccs->wmaster == "0"){
if($fetch->cc != "0"){ echo "You are currently involved in a Organized crime already."; }
elseif ($fetch->cc == "0" || $fetch->cc == ""){
mysqli_query( $connection, "UPDATE accounts SET cc='1', ccpost='wmaster' WHERE username='$username'");
mysqli_query( $connection, "UPDATE cc SET wmaster='$username' WHERE leader='$leader'");
echo " ";
echo"<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }}}

elseif ($pos == "emaster"){
if($fetchccs->emaster != "" && $fetchccs->emaster != "0"){ echo "The explosives master position is not available."; }
elseif($fetchccs->emaster == "" || $fetchccs->emaster == "0"){
if($fetch->cc != "0"){ echo "You are currently involved in a Organized crime already."; }
elseif ($fetch->cc == "0" || $fetch->cc == ""){
mysqli_query( $connection, "UPDATE accounts SET cc='1', ccpost='emaster' WHERE username='$username'");
mysqli_query( $connection, "UPDATE cc SET emaster='$username' WHERE leader='$leader'");
echo " ";
echo"<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }}}

elseif ($pos == "gdriver"){
if($fetchccs->gdriver != "" && $fetchccs->gdriver != "0"){ echo "The getaway driver position is not available."; }
elseif($fetchccs->gdriver == "" || $fetchccs->gdriver == "0"){
if($fetch->cc != "0"){ echo "You are currently involved in a Organized crime already."; }
elseif ($fetch->cc == "0" || $fetch->cc == ""){
mysqli_query( $connection, "UPDATE accounts SET cc='1', ccpost='gdriver' WHERE username='$username'");
mysqli_query( $connection, "UPDATE cc SET gdriver='$username' WHERE leader='$leader'");
echo " ";
echo"<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }}}}}

if($fetch->last_cc > time()){ 
echo "You must wait ".maketime($fetch->last_cc)." untill you can permit another Organised crime."; exit(); }

if (strip_tags($_POST['NewCC'])){ 
$class=strip_tags($_POST['class']); 

$leader=addslashes(strip_tags($_POST['leader']));
$weaponsmaster=addslashes(strip_tags($_POST['weaponsmaster']));
$explosivesmaster=addslashes(strip_tags($_POST['explosivesmaster']));
$getawaydriver=addslashes(strip_tags($_POST['getawaydriver']));

if ($class == ""){ echo "Please choose a Organized Crime class."; }
elseif ($class != ""){

if (!$leader || ereg('[^0-9]',$leader)){ echo "Invalid percentage for the leader.";
}elseif ($leader || !ereg('[^0-9]',$leader)){

if (!$weaponsmaster || ereg('[^0-9]',$weaponsmaster)){ echo "Invalid percentage for the Weapon Master.";
}elseif ($weaponsmaster || !ereg('[^0-9]',$weaponsmaster)){

if (!$explosivesmaster || ereg('[^0-9]',$explosivesmaster)){ echo "Invalid percentage for the Explosion Master.";
}elseif ($explosivesmaster || !ereg('[^0-9]',$explosivesmaster)){

if (!$getawaydriver || ereg('[^0-9]',$getawaydriver)){ echo "Invalid percentage for the Getaway driver.";
}elseif ($getawaydriver || !ereg('[^0-9]',$getawaydriver)){

if ($class == "Rob Bank"){
$money = "500000";
$type = "1";
$moneyloss = $fetch->money - $money;
}elseif($class == "Hijack Plane"){
$money = "750000";
$type = "2";
$moneyloss = $fetch->money - $money;
}elseif($class == "Take Hostages"){
$money = "1250000";
$type = "3";
$moneyloss = $fetch->money - $money; }

if($fetch->money <= $money){
echo "You cant afford &pound;".makecomma($money)." for the Organized crime.";
}elseif($fetch->money > $money){

$percentrr = array($leader, $expolsionmaster, $weaponsmaster, $getawaydriver);
$percent = implode("-", $percentrr);

$added = $leader + $explosivesmaster + $weaponsmaster + $getawaydriver;

if($added != "100"){ echo "All the percentages do not add up to 100."; }
elseif($added == "100"){

mysqli_query( $connection, "INSERT INTO `cc` (`id`, `leader`, `wmaster`, `emaster`, `gdriver`, `weapons`, `explosives`, `car`, `percentages`, `cardam`, `type`, `carid`, `cctype`, `leaderperc`, `wmasterperc`, `emasterperc`, `driverperc`)
VALUES ('', '$username', '', '', '', ' ', ' ', ' ', '$percent', '', '$type', '', '$class', '$leader', '$explosivesmaster', '$weaponsmaster', '$getawaydriver');") or die (mysqli_error());
echo "The organised crime was successfully set up.";
echo "<meta http-equiv=\"refresh\" content=\"0;url=test.php\">";
mysqli_query( $connection, "UPDATE accounts SET cc='1', ccpost='leader', money='$moneyloss' WHERE username='$username'"); }}}}}}}} ?>

<?php
if (strip_tags($_POST['useweapons'])){
$weapon=strip_tags($_POST['weapon']);

if ($weapon == ""){ echo "Please select a weapon to use..."; }
elseif ($weapon != ""){

mysqli_query( $connection, "UPDATE cc SET weapons='$weapon', wmasterready='Ready' WHERE wmaster='$username'");
mysqli_query( $connection, "UPDATE inventory SET $weapon=$weapon-1 WHERE username='$username'");
echo " ";
echo "<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }} ?>

<?php
if (strip_tags($_POST['use_explosives'])){
$explosives=strip_tags(addslashes($_POST['explosives']));

if ($explosives == "Homemade Bomb"){ $cost = "100000"; }
if ($explosives == "Dynamite"){ $cost = "225000"; }
if ($explosives == "C4"){ $cost = "500000"; }

if ($fetch->money < $cost){ echo "You cannot afford those explosives."; }
elseif ($fetch->money >= $cost){

if ($explosives == ""){ echo "Please select an explosive to use..."; }
elseif ($explosives != ""){

mysqli_query( $connection, "UPDATE cc SET explosives='$explosives', emasterready='Ready' WHERE emaster='$username'");
mysqli_query( $connection, "UPDATE accounts SET money=money-$cost WHERE username='$username'");
echo " "; 
echo "<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }}} ?>

<?php
if (strip_tags($_POST['usecar'])){
$car=strip_tags($_POST['car']);
$fetchcar=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM garage WHERE id='$car'"));

if ($fetchcar->owner != "$username"){ echo "You do not own this car."; }
elseif ($fetchcar->owner == "$username"){

if ($fetchcar->damage == "100"){ echo "Your car contains 100% damage, therefore cannot be used."; }
elseif ($fetchcar->damage != "100"){

if ($car == ""){ echo "Please select a getaway car to use..."; } 
elseif ($car != ""){
 
mysqli_query( $connection, "UPDATE cc SET car='$fetchcar->car', cardam='$fetchcar->damage', driverready='Ready', carid='$fetchcar->id' WHERE gdriver='$username'");
mysqli_query( $connection, "DELETE FROM garage WHERE id='$fetchcar->id'");
echo " "; 
echo "<meta http-equiv=\"refresh\" content=\"0;url=test.php\">"; }}}}  ?>

<?php
if (strip_tags($_POST['inviteaccounts'])){
$weaponsmaster=strip_tags($_POST['weaponsmaster']);
$explosivesmaster=strip_tags($_POST['explosivesmaster']);
$getawaydriver=strip_tags($_POST['getawaydriver']);
$datenow = gmdate('Y-m-d H:i:s');

if ($weaponsmaster == "$username"){ echo "You cannot invite yourself as weapons master."; }
elseif ($weaponsmaster != "$username"){
if ($explosivesmaster == "$username"){ echo "You cannot invite yourself as explosives master."; }
elseif ($explosivesmaster != "$username"){
if ($getawaydriver == "$username"){ echo "You cannot invite yourself as the getaway driver."; }
elseif ($getawaydriver != "$username"){

if($weaponsmaster == ""){ }elseif($weaponsmaster != ""){
$wmast=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$weaponsmaster'"));
if($wmast->ocm == "on"){ $enter = "no"; }elseif($wmast->ocm == "off"){ $enter = "yes"; }
 
if($enter == "no"){
echo"<a href='profile.php?viewing=$weaponsmaster'>$weaponsmaster</a> is currently not accepting CC invites.<br>";
}elseif($enter == "yes"){

$text = "$username has invited you to join their OC as a we! <a href=\"test.php?accept=$username&pos=wmaster\">Accept</a> <a href=\"test.php?decline=$username\">Decline</a>";

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$weaponsmaster', '$username', '$text', '<b>OC Invite</b>', '$datenow', '0');") or die (mysqli_error());
echo"<center>You sent an invite to <b>$weaponsmaster</b> to be your <b>we</b><br></center>";
 }}


if($explosivesmaster == ""){ }elseif($explosivesmaster != ""){
$emast=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$explosivesmaster'"));
if($emast->ocm == "on"){ $enter = "no"; }elseif($emast->ocm == "off"){ $enter = "yes"; }

if($enter == "no"){
echo"<a href='profile.php?viewing=$explosivesmaster'>$explosivesmaster</a> is currently not accepting OC invites.<br>";
}elseif($enter == "yes"){

$text = "$username has invited you to join their OC as a ee! <a href=\"test.php?accept=$username&pos=emaster\">Accept</a> <a href=\"test.php?decline=$username\">Decline</a>";

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$explosivesmaster', '$username', '$text', '<b>OC Invite</b>', '$datenow', '0');") or die (mysqli_error());
echo"<center>You sent an invite to <b>$explosivesmaster</b> to be your <b>ee</b><br></center>";
 }}



if($getawaydriver == ""){ }elseif($getawaydriver != ""){
$gmast=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$getawaydriver'"));
if($gmast->ocm == "on"){ $enter = "no"; }elseif($gmast->ocm == "off"){ $enter = "yes"; }

if($enter == "no"){
echo"<a href='profile.php?viewing=$getawaydriver'>$getawaydriver</a> is currently not accepting OC invites.<br>";
}elseif($enter == "yes"){

$text = "$username has invited you to join their OC as a driver! <a href=\"test.php?accept=$username&pos=gdriver\">Accept</a> <a href=\"test.php?decline=$username\">Decline</a>";

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$getawaydriver', '$username', '$text', '<b>OC Invite</b>', '$datenow', '0');") or die (mysqli_error());
echo"<center>You sent an invite to <b>$getawaydriver</b> to be your <b>driver</b><br></center>";
 }}}}}}

$datenow2 = gmdate('Y-m-d h:i:s');

if (strip_tags($_POST['kick'])){ 

if (strip_tags($_POST['kickwm'])){
mysqli_query( $connection, "UPDATE accounts SET cc='0', ccpost='' WHERE username='$fetchcc->wmaster'");
mysqli_query( $connection, "UPDATE cc SET wmaster='', weapons='', wmasterready='Not Ready' WHERE leader='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->wmaster', '$username', '<b>You have been kicked from the Organized Crime you was currently in, all weapons entered were lost.</b>', 'Organized Crime', '$date', '0')");
echo"You have successfully kicked <a href=profile.php?viewing=$fetchcc->wmaster>$fetchcc->wmaster</a> from your OC team."; }

if (strip_tags($_POST['kickem'])){ 
mysqli_query( $connection, "UPDATE accounts SET cc='0', ccpost='' WHERE username='$fetchcc->emaster'");
mysqli_query( $connection, "UPDATE cc SET emaster='', explosives='', emasterready='Not Ready' WHERE leader='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->emaster', '$username', '<b>You have been kicked from the Organized Crime you was currently in, all explosives entered were lost.</b>', 'Organized Crime', '$date', '0')");
echo"You have successfully kicked <a href=profile.php?viewing=$fetchcc->emaster>$fetchcc->emaster</a> from your OC team."; }

if (strip_tags($_POST['kickdriver'])){
mysqli_query( $connection, "UPDATE accounts SET cc='0', ccpost='' WHERE username='$fetchcc->gdriver'");
mysqli_query( $connection, "UPDATE cc SET gdriver='', car='', carid='', cardam='', driverready='Not Ready' WHERE leader='$username'");
mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->gdriver', '$username', '<b>You have been kicked from the Organized Crime you was currently in, any cars entered were lost.</b>', 'Organized Crime', '$date', '0')");
echo"You have successfully kicked <a href=profile.php?viewing=$fetchcc->gdriver>$fetchcc->gdriver</a> from your OC team."; }} 



if (strip_tags($_POST['finish'])){

	if($fetchcc->leader != "$username"){
		echo"you can't";
		exit();
	}

if ($fetchcc->wmasterready != "Ready" ||  $fetchcc->emasterready != "Ready" || $fetchcc->driverready != "Ready"){
echo "Some participants are not ready yet.";
}elseif ($fetchcc->wmasterready == "Ready" &&  $fetchcc->emasterready == "Ready" && $fetchcc->driverready == "Ready"){

$rank=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetchwmaster->rank'"));
$rank2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetchwmaster->rank'"));
$rank3=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetchemaster->rank'"));
$rank4=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetchdriver->rank'"));
$max_l = $rank->id;
$max_w = $rank2->id;
$max_e = $rank3->id;
$max_d = $rank4->id;

if ($fetchcc->weapons == "M16A4"){ $max_wep = "0";
}elseif ($fetchcc->weapons == "MP5"){ $max_wep = "1";
}elseif ($fetchcc->weapons == "P90"){ $max_wep = "2";
}elseif ($fetchcc->weapons == "PSG1"){ $max_wep = "3";
}elseif ($fetchcc->weapons == "SA80"){ $max_wep = "4";
}elseif ($fetchcc->weapons == "G36C"){ $max_wep = "5"; 
}elseif ($fetchcc->weapons == "FAMAS"){ $max_wep = "6"; 
}elseif ($fetchcc->weapons == "M82A1"){ $max_wep = "7"; }

if ($explosives == "Nail Bombs"){ $max_exp = "1";  
}elseif ($explosives == "Mines"){ $max_exp = "2"; 
}elseif ($explosives == "Satchel Charges"){ $max_exp = "3"; 
}elseif ($explosives == "Claymores"){ $max_exp = "4"; 
}elseif ($explosives == "RGD33"){ $max_exp = "5"; }

if ($fetchcc->car == "BMW M3"){ $max_car="1";
}elseif ($fetchcc->car == "Cadilac Escelade"){ $max_car="2";
}elseif ($fetchcc->car == "Nissan Skyline"){ $max_car="3";
}elseif ($fetchcc->car == "Porsche 911"){ $max_car="4";
}elseif ($fetchcc->car == "GT 40"){ $max_car="5";
}elseif ($fetchcc->car == "Lamborghini Murcielago"){ $max_car="6";
}elseif ($fetchcc->car == "Ferrari Enzo"){ $max_car="7";
}elseif ($fetchcc->car == "TVR Speed 12"){ $max_car="8";
}elseif ($fetchcc->car == "Mclaren F1"){ $max_car="9";
}elseif ($fetchcc->car == "Bugatti Veyron"){ $max_car="10";
}elseif ($fetchcc->car == "Mercedes SLK Mclaren"){ $max_car="11";
}elseif ($fetchcc->car == "Hummer H2"){ $max_car="12"; }


if ($fetchcc->cctype == "Rob Bank"){
$ifocd = "4"; $maxmoney = "2000000";

}elseif ($fetchcc->cctype == "Hijack Plane"){
$ifocd = "3"; $maxmoney = "6000000";

}elseif ($fetchcc->cctype == "Take Hostages"){
$ifocd = "2"; $maxmoney = "10000000"; }

$added = $max_l + $max_w + $max_e + $max_d + $max_wep + $max_exp + $max_car;
$added1 = $added * "100000";
$finalsum = $added1 / $ifocd;
$maxmoney2 = $finalsum + "500000";

$finalmoney = rand($finalsum, $maxmoney);

$money100 = $finalmoney / "100";
$leadermoney1 = $money100 * $fetchcc->leaderperc;
$wemoney1 = $money100 * $fetchcc->wmasterperc;
$eemoney1 = $money100 * $fetchcc->emasterperc;
$drivermoney1 = $money100 * $fetchcc->driverperc;

$leadermoney = round($leadermoney1, 0);
$wemoney = round($wemoney1, 0);
$eemoney = round($eemoney1, 0);
$drivermoney = round($drivermoney1, 0);

$ran = rand(15,50);
$ran2 = rand(15,35);
$ran3 = rand(15,35);
$ran4 = rand(15,30);

echo "OC SUMMARY<br>
You were successful and got the loot!<br><br>

Total loot: &pound;".makecomma($finalmoney)."<br><br>

Leader Cash: &pound;".makecomma($leadermoney)."<br>
WE Cash: &pound;".makecomma($wemoney)."<br>
EE Cash: &pound;".makecomma($eemoney)."<br>
Driver Cash: &pound;".makecomma($drivermoney)."<br><br>

$fetchcc->leader took $ran% damage<br>
$fetchcc->wmaster took $ran2% damage<br>
$fetchcc->emaster took $ran3% damage<br>
$fetchcc->gdriver took $ran4% damage<br><br>

<pre>
          ^
         | |
       @#####@
     (###   ###)-.
   .(###     ###) \
  /  (###   ###)   )
 (=-  .@#####@|_--\"
 /\    \_|l|_/ (\
(=-\     |l|    /
 \  \.___|l|___/
 /\      |_|   /
(=-\._________/\
 \             /
   \._________/
     #  ----  #
     #   __   #
     \########/
</pre>
";

$textfrom = "OC SUMMARY
You were successful and got the loot!

Total loot: &pound;".makecomma($finalmoney)."

Leader Cash: &pound;".makecomma($leadermoney)."
WE Cash: &pound;".makecomma($wemoney)."
EE Cash: &pound;".makecomma($eemoney)."
Driver Cash: &pound;".makecomma($drivermoney)."

$fetchcc->leader took $ran% damage
$fetchcc->wmaster took $ran2% damage
$fetchcc->emaster took $ran3% damage
$fetchcc->gdriver took $ran4% damage";



mysqli_query( $connection, "UPDATE accounts SET cc='0', money=money+$leadermoney WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET cc='0', money=money+$drivermoney WHERE username='$fetchcc->gdriver'");
mysqli_query( $connection, "UPDATE accounts SET cc='0', money=money+$eemoney WHERE username='$fetchcc->emaster'");
mysqli_query( $connection, "UPDATE accounts SET cc='0', money=money+$wemoney WHERE username='$fetchcc->wmaster'");

$rank = 750 / $ifocd;
mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+$rank, octotloot=octotloot+$finalmoney WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+$rank, octotloot=octotloot+$finalmoney WHERE username='$fetchcc->emaster'");
mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+$rank, octotloot=octotloot+$finalmoney WHERE username='$fetchcc->wmaster'");
mysqli_query( $connection, "UPDATE accounts SET rankpoints=rankpoints+$rank, octotloot=octotloot+$finalmoney WHERE username='$fetchcc->gdriver'");

mysqli_query( $connection, "UPDATE accounts SET health=health-$ran, ccpost='' WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$ran2, ccpost='' WHERE username='$fetchcc->emaster'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$ran3, ccpost='' WHERE username='$fetchcc->wmaster'");
mysqli_query( $connection, "UPDATE accounts SET health=health-$ran4, ccpost='' WHERE username='$fetchcc->gdriver'");

$daten = gmdate('Y-m-d H:i:s');

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$username', '$username', '$textfrom', 'OC Results', '$daten', '0');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->wmaster', '$fetchcc->wmaster', '$textfrom', 'OC Results', '$daten', '0');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->emaster', '$fetchcc->emaster', '$textfrom', 'OC Results', '$daten', '0');") or die (mysqli_error());

mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`) VALUES ('', '$fetchcc->gdriver', '$fetchcc->gdriver', '$textfrom', 'OC Results', '$daten', '0');") or die (mysqli_error());

mysqli_query( $connection, "DELETE FROM cc WHERE id='$fetchcc->id'"); }}  ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="style.css" type="text/css" />
<style type="text/css">
a:link {
	text-decoration: underline;
	color: #33CCFF;
}
a:visited {
	text-decoration: underline;
	color: #33CCFF;
}
a:active {
	text-decoration: underline;
	color: #33CCFF;
}
a:hover {
	color: #FFFFFF;
	font-weight: bold;
	text-decoration: none;
}
.tablebg {	
font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	line-height: normal;
	color: #000000;
	background-image: url(../images/others/ClassifiedC.png);
	background-repeat: no-repeat;
	background-position: center top;
	border: 1px solid;
	background-repeat: repeat-x;	 }
.tablebg2 {	
font-family: Arial, Helvetica, sans-serif;
	font-size: 12px; 
	font-style: normal; 
	line-height: normal;
	color: #000000;
	background-color: #FFFFFF;
	border: 1px solid;	 }
.whitebg {	
    font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-style: normal;
	padding: 4px;
	color: #000000;
	background-color: #FFFFFF;
	border: none;	 }
.textbox {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #996600;
	background-color: #FFFFFF; 
	border: 1px solid #000000;
}
</style>
<title>Organized Crimes :: Thug Paradise 2</title>

</head>

<body>

<form action="" method="post" name="form">
<?php if ($fetch->cc == "0"){ ?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<style>
a:link {
	text-decoration: underline;
	color: #33CCFF;
}
a:visited {
	text-decoration: underline;
	color: #33CCFF;
}
a:active {
	text-decoration: underline;
	color: #33CCFF;
}
a:hover {
	color: #FFFFFF;
	font-weight: bold;
	text-decoration: none;
}
</style>
</head>
<body>
  <table width="30%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
    <tr>
      <th colspan="2" class="gradient" scope="col">OC (Organised Crime)</th>
    </tr>
    <tr>
      <th width="50%" class="gradient" scope="col"><div align="center">Start Own OC</div></th>
      <th width="50%" class="gradient" scope="col">Setup Cost </th>
    </tr>
    <tr>
      <td class="tableborder"><div align="center">Rob Bank </div></td>
      <td class="tableborder">
        <div align="center">
          <input name="class" type="radio" value="Rob Bank">
          <br>
          $500,000</div></td></tr>
    <tr>
      <td class="tableborder"><div align="center">Hijack Plane </div></td>
      <td class="tableborder">
        <div align="center">
          <input name="class" type="radio" value="Hijack Plane">
          <br>
          $750,000</div></td></tr>
    <tr>
      <td class="tableborder"><div align="center">Take Hostages</div></td>
      <td class="tableborder">
        <div align="center">
          <input name="class" type="radio" value="Take Hostages">
          <br>
          $1,250,000</div></td></tr>
  </table>
 <br />
  <br />
  <table width="200" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" class="gradient"><div align="center">Percentages</div></td>
    </tr>
    <tr>
      <td width="50%" class="tableborder" scope="col"><div align="right">Leader % </div></td>
      <td width="50%" class="tableborder" scope="col"><input name="leader" type="text" value="50" class="textbox" size="3" maxlength="3" /></td>
    </tr>
    <tr>
      <td class="tableborder"><div align="right">WE % </div></td>
      <td class="tableborder"><input name="weaponsmaster" type="text" class="textbox" value="20" size="3" maxlength="3" /></td>
    </tr>
    <tr>
      <td class="tableborder"><div align="right">EE % </div></td>
      <td class="tableborder"><input name="explosivesmaster" class="textbox" type="text" value="20" size="3" maxlength="3" /></td>
    </tr>
    <tr>
      <td class="tableborder"><div align="right">Driver % </div></td>
      <td class="tableborder"><input name="getawaydriver" class="textbox" type="text" value="10" size="3" maxlength="3" /></td>
    </tr>
  </table>
  <br />
  <center>
    <p>
      <input type="submit" class="custombutton" name="NewCC" id="NewCC" value="Start OC!" />
</p>
    <table width="60%" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="49" class="table1px"><p><img src="../images/questionmark.jpg" width="49" height="46" align="left"></p></td>
        <td width="558" class="tableborder"><p align="center">This is the organized crime page, here you can do crimes for BIG money. As the leader you should invite people to be in different positions and you can split the money as you're getting away or you can take it all yourself (set to 100%) and split it afterwards.</p>
            <p align="center">The more skillful you are and the better equipment you use, the more smoothly the OC will run. This means a bigger load of loot!</p>
        <p align="center">Beware though, you may lose health while commiting the Organised Crime!</p></td>
      </tr>
    </table>
  </center>

<?php }elseif($fetch->cc == "1"){ ?>

<table width="750" align="center" border="2" cellpadding="0" cellspacing="0" class="tablegp">
<tr>
<td colspan="6" height="30" align="center" class="gradient" style="font-size: 14px; color: #FFFFFF;"><?php echo "$fetchcc->cctype"; ?></td>
</tr>

  <tr> 
 <td width="15%" align="center" style="padding: 4px;" class="tablegp"><b>Position</b></td>
 <td width="35%" align="center" style="padding: 4px;" class="tablegp"><b>Username</b></td>
 <td width="15%" align="center" style="padding: 4px;" class="tablegp"><b>Item</b></td>
 <td width="18%" align="center" style="padding: 4px;" class="tablegp"><b>Rank</b></td>
 <td width="10%" align="center" style="padding: 4px;" class="tablegp"><b>Split</b></td>
 <?php if($fetch->ccpost == "leader"){ echo"<td width='7%' align='center' style='padding: 4px;' class='tablegp'><b>Kick?</b></td>"; }?>
  </tr>
  <tr>
 <td align="center" class="tablegp">Leader</td>
 <td align="center" class="tablegp"><?php echo "<a href='profile.php?viewing=$fetchcc->leader'>$fetchcc->leader</a>"; ?></td>
 <td align="center" class="tablegp">Blueprints</td>
 <td align="center" class="tablegp"><?php echo"$fetchleader->rank"; ?></td>
 <td align="center" class="tablegp"><?php if($fetchcc->leader == ""){  echo"None"; }elseif($fetchcc->leader != ""){ echo"$fetchcc->leaderperc%"; }?></td>
 <?php if ($fetch->ccpost == "leader"){ ?><td align="center">&nbsp;</td><?php } ?>
  </tr>
  <tr>
 
<td align="center" class="tablegp">Weapons Expert</td>
<td align="center" class="tablegp"><?php if($fetchcc->wmaster == "" && ($fetch->ccpost == "leader")){ echo"<input type='text' name='weaponsmaster' class='textbox' size='20' /> <input type='submit' class='custombutton' name='inviteaccounts' value='Invite!' />"; }elseif($fetchcc->wmaster != ""){
echo "<a href='profile.php?viewing=$fetchwmaster->username'>$fetchwmaster->username</a>"; }?></td>
<td align="center" class="tablegp"><?php if($fetchcc->weapons == ""){ echo""; }elseif($fetchcc->weapons != ""){ echo"$fetchcc->weapons"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->wmaster == ""){ echo" "; }elseif($fetchcc->wmaster != ""){ echo"$fetchwmaster->rank"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->wmaster == ""){ echo"$fetchcc->wmasterperc%"; }elseif($fetchcc->wmaster != ""){ echo"$fetchcc->wmasterperc%"; } ?></td>
 <?php if ($fetch->ccpost == "leader"){ ?>
 <td align="center" class="tablegp"><input type='checkbox' name='kickwm' id='kickwm'></td><?php } ?>
</tr>
  <tr>
<td align="center" class="tablegp">Explosion Expert</td>
<td align="center" class="tablegp"><?php if($fetchcc->emaster == "" && ($fetch->ccpost == "leader")){ echo"<input type='text' name='explosivesmaster' class='textbox' size='20' /> <input type='submit' class='custombutton' name='inviteaccounts' value='Invite!' />"; }elseif($fetchcc->emaster != ""){
echo "<a href='profile.php?viewing=$fetchemaster->username'>$fetchemaster->username</a>"; }?></td>
<td align="center" class="tablegp"><?php if($fetchcc->explosives == ""){ echo " "; }elseif($fetchcc->explosives != ""){ echo"$fetchcc->explosives"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->emaster == ""){ echo" "; }elseif($fetchcc->emaster != ""){ echo"$fetchemaster->rank"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->emaster == ""){ echo"$fetchcc->emasterperc%"; }elseif($fetchcc->emaster != ""){ echo"$fetchcc->emasterperc%"; } ?></td>
 <?php if ($fetch->ccpost == "leader"){ ?>
 <td align="center" class="tablegp"><input type='checkbox' name='kickem' id='kickem'></td><?php } ?>
</tr>
<tr>
<td align="center" class="tablegp">Driver</td>
<td align="center" class="tablegp"><?php if($fetchcc->gdriver == "" && ($fetch->ccpost == "leader")){ echo"<input type='text' name='getawaydriver' class='textbox' size='20' /> <input type='submit' class='custombutton' name='inviteaccounts' value='Invite!' />"; }elseif($fetchcc->gdriver != ""){
echo"<a href='profile.php?viewing=$fetchdriver->username'>$fetchdriver->username</a>"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->car == ""){ echo" "; }elseif($fetchcc->car != ""){ echo"$fetchcc->car"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->gdriver == ""){ echo" "; }elseif($fetchcc->gdriver != ""){ echo"$fetchdriver->rank"; } ?></td>
<td align="center" class="tablegp"><?php if($fetchcc->gdriver == ""){ echo"$fetchcc->driverperc%"; }elseif($fetchcc->gdriver != ""){ echo"$fetchcc->driverperc%"; } ?></td>
 <?php if ($fetch->ccpost == "leader"){ ?>
 <td align="center" class="tablegp"><input type='checkbox' name='kickdriver' id='kickdriver'></td><?php } ?>
</tr>
<tr>
<td colspan="6" align="center" class="tablegp">
<?php if ($fetch->ccpost == "leader"){ ?><input type='submit' class='custombutton' name='finish' id='finish' value="Lock'n'Load!" />&nbsp;&nbsp;<?php } ?><input type="submit" class="custombutton" name="leave" id="leave" value="Leave OC!" /><?php if ($fetch->ccpost == "leader"){ ?>&nbsp;&nbsp;<input type="submit" class="custombutton" name="kick" id="kick" value="Kick Selected!" /><?php } ?>

<?php 
if (strip_tags($_POST['leave'])){

if ($fetch->ccpost == "leader"){ 
mysqli_query( $connection, "UPDATE accounts SET cc='0' WHERE username='$fetchcc->gdriver'");
mysqli_query( $connection, "UPDATE accounts SET cc='0' WHERE username='$fetchcc->emaster'");
mysqli_query( $connection, "UPDATE accounts SET cc='0' WHERE username='$fetchoc->wmaster'");
mysqli_query( $connection, "UPDATE accounts SET cc='0' WHERE username='$username'");
mysqli_query( $connection, "DELETE FROM cc WHERE leader='$username'");
echo "<br>The Organised crime was cancelled as you are the leader."; }

elseif ($fetch->ccpost != "leader"){ 

if ($fetch->ccpost == "wmaster"){ 
mysqli_query( $connection, "UPDATE cc SET wmaster='', weapons='', wmasterready='Not Ready' WHERE wmaster='$username'"); }
if ($fetch->ccpost == "emaster"){ 
mysqli_query( $connection, "UPDATE cc SET emaster='', explosives='', emasterready='Not Ready' WHERE emaster='$username'"); }
if ($fetch->ccpost == "gdriver"){ 
mysqli_query( $connection, "UPDATE cc SET gdriver='', car='', driverready='Not Ready' WHERE gdriver='$username'"); }
mysqli_query( $connection, "UPDATE accounts SET cc='0', ccpost='' WHERE username='$username'");
echo "You have left the Organized crime."; }} ?>

</td></tr>
</table>
<br />


<?php if ($fetch->ccpost == "leader"){ ?>

<?php include_once "onlineoc.php"; ?>

<?php } ?>

 

<?php if ($fetch->ccpost == "wmaster" && $fetchcc->wmasterready == "Not Ready"){ ?>

<table width="350" align="center" class="tablegp" border="1" cellpadding="0" cellspacing="0">
<tr><td height="30" align="center" class="gradient" style="font-size: 13px; color: #FFFFFF;">Select Weapon</td>
</tr> 
<tr><td colspan="2" align="center" style="padding: 4px;">

<select name="weapon" id="weapon" class="textbox">
<?php $gather = mysqli_query( $connection, "SELECT * FROM inventory WHERE username='$username'");
     while($object=mysqli_fetch_object($gather)){
	 if ($object->M16A4 > "0"){ echo "<option value='M16A4'>M16A4 - (Power 1)</option><br>"; }
	 if ($object->MP5 > "0"){ echo "<option value='MP5'>MP5 - (Power 2)</option><br>"; }
	 if ($object->P90 > "0"){ echo "<option value='P90'>P90 - (Power 3)</option><br>"; }
	 if ($object->PSG1 > "0"){ echo "<option value='PSG1'>PSG1 - (Power 4)</option><br>"; }
	 if ($object->SA80 > "0"){ echo "<option value='SA80'>SA80 - (Power 5)</option><br>"; }
	 if ($object->G36C > "0"){ echo "<option value='G36C'>G36C - (Power 7)</option><br>"; }
	 if ($object->FAMAS > "0"){ echo "<option value='FAMAS'>FAMAS - (Power 10)</option><br>"; }
	 if ($object->M82A1 > "0"){ echo "<option value='M82A1'>M82A1 - (Power 15)</option><br>"; }} ?>
</select><br /><br />
Your gun will be destroyed after the OC to get rid of all evidence! </td></tr>
<tr><td colspan="2" align="center" style="padding: 4px;">
<input type="submit" class="custombutton" name="useweapons" id="useweapons" value="USE IT!" />
</td></tr>
</table>

<?php } ?>



<?php if ($fetch->ccpost == "gdriver" && $fetchcc->driverready == "Not Ready"){ ?>

<table width="350" align="center" class="tablegp" border="1" cellpadding="0" cellspacing="0">
<tr><td height="30" align="center" class="gradient" style="font-size: 14px; color: #FFFFFF;">Select Car</td>
</tr> 
<tr><td colspan="2" align="center" style="padding: 4px;">
Please select your getaway car...
<br /><br />
<select name="car" id="car" class="textbox">
<?php $gather = mysqli_query( $connection, "SELECT * FROM garage WHERE owner='$username'");
     while($object=mysqli_fetch_object($gather)){
	 echo "<option value='$object->id'>$object->id - $object->car, $object->damage% damage</option>"; } ?>
</select></td></tr>
<tr><td colspan="2" align="center" style="padding: 4px;">
<input type="submit" class="custombutton" name="usecar" id="usecar" value="USE IT!" />
</td></tr>
</table>

<?php } ?>



<?php if ($fetch->ccpost == "emaster" && $fetchcc->emasterready == "Not Ready"){ ?>

<table width="350" align="center" class="tablegp" border="1" cellpadding="0" cellspacing="0">
<tr><td height="30" align="center" class="gradient" style="font-size: 13px; color: #FFFFFF;">Select Explosive</td>
</tr> 
<tr><td colspan="2" align="center" style="padding: 4px;">
<select name="explosives" id="explosives" class="textbox">
<option value="Homemade Bomb">Homemade Bomb  -  &pound;100,000</option>
<option value="Dynamite">Dynamite -  &pound;225,000</option>
<option value="C4">C4 -  &pound;500,000</option>
</select></td></tr>
<tr><td colspan="2" align="center" style="padding: 4px;">
<input type="submit" class="custombutton" name="use_explosives" id="use_explosives" value="USE IT!" />
</td></tr>
</table>

<?php }} ?>

 
</form>  

<?php include_once "incfiles/foot.php"; ?>
</body> 
</html> 
