<?php

include "incfiles/connectdb.php";
include "incfiles/func.php";

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />";

$above = mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'");
$info = mysqli_fetch_object($above);

if ($info->lastfugi > time()){
$left = $info->lastfugi - time();
echo "<center>You must wait ".maketime($fetch->lastfugi)." before your fugitive can be reset!<br>
<br><b> Please be patient as fugitives are not easy to find..</b><br></br>
<a href=fugi.php>Go Back!</a></center>";
exit();
}

$time_month=time() - (3600 * 24) * 30;

mysqli_query( $connection, "DELETE FROM OAC_AC WHERE username='$username'");

$mysqli1 = mysqli_query( $connection, "SELECT * FROM `accounts` WHERE `username`='$username' AND online >= '$time_month'");

 while($get = mysqli_fetch_object($mysqli1)){

$rand = rand(1111,9999);




$randran = rand(1,9);

$randhealth = rand(-5,100);

if($randran == "1"){ $rank = "Boss"; $randm = rand(30000000,60000000); $randf = rand(1,11000); $randj = rand(1,11000); }elseif($randran == "2"){ $rank = "Assassin"; $randm = rand(40000000,70000000); $randf = rand(1,17000); $randj = rand(1,17000);}elseif($randran == "3"){ $rank = "Don";  $randm = rand(50000000,80000000); $randf = rand(1,22000); $randj = rand(1,22000);}elseif($randran == "4"){ $rank = "Godfather"; $randm = rand(70000000,100000000); $randf = rand(1,31000); $randj = rand(1,31000);}elseif($randran == "5"){ $rank = "Global Terror"; $randm = rand(80000000,150000000); $randf = rand(1,46000); $randj = rand(1,46000);}elseif($randran == "6"){ $rank = "Global Dominator"; $randm = rand(90000000,175000000); $randf = rand(1,70000); $randj = rand(1,70000);}elseif($randran == "7"){ $rank = "Untouchable Godfather"; $randm = rand(125000000,200000000); $randf = rand(1,80000); $randj = rand(1,80000);}elseif($randran == "8"){ $rank = "Legend"; $randm = rand(150000000,250000000); $randf = rand(1,95000); $randj = rand(1,95000);}elseif($randran == "9"){ $rank = "Official TP Legend"; $randm = rand(175000000,300000000); $randf = rand(1,150000); $randj = rand(1,150000); }

$made = gmdate('Y-m-d H:i:s');




mysqli_query( $connection, "INSERT INTO `OAC_AC` (`id` ,`claimed` ,`username` ,`name` ,`status` ,`location` ,`money` ,`rank` ,`fmj` ,`jhp` ,`health` ,`cars` ,`death` ,`safehouse` ,`crew`, `made`)

VALUES (NULL , '0', '$get->username', 'Fugi $rand', 'Alive', 'England', '$randm', '$rank', '$randf', '$randj', '$randhealth', '', '0000-00-00 00:00:00', '0', '0', '$made')");

$timmy = '43200';
$time= time() + 43200;

$tim = time() + $timmy;	
mysqli_query( $connection, "UPDATE accounts SET lastfugi='$tim' WHERE username='$username'");





  }
  


  echo "<meta http-equiv=refresh content=1;URL='fugi.php'><link href=style.css rel=stylesheet type=text/css />
<table align=center width=45% border=0 cellpadding=0 cellspacing=0 bordercolor=#FFFFFF><tr><td class=gradient><div align=center>Loading Target</div></td></tr><tr class=tableborder><td><div align=center><br>Your Fugitive Is Being Setup Please Wait...<br><img src=images/preloader.gif><br></p></div></td></tr></table><br /><br /></span></td></tr>" 

  

 ?>