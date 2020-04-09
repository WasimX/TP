<?php
session_start();
include "incfiles/connectdb.php";
include "incfiles/func.php";
include"incfiles/alt.php";
logincheck();
$username=$_SESSION['username'];

echo "<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />"; 

$newk= (3600*2)+time();



$betnum=mysqli_num_rows(mysqli_query( $connection, "SELECT * FROM betshop WHERE username='$username'"));

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

if ($fetch->betshopTimer > time()){
die("You need to wait ".maketime($fetch->betshopTimer)." before you can use the Betshop again..");
}

if ($fetch->casinoban > time()){
die("You cannot gamble for another ".maketime($fetch->casinoban)." because you banned yourself.");
}

?>
<SCRIPT>
function confirmJoin()   
{
  var answer = confirm("Are You Sure You Wish To Join? Once You Have Joined There Is No Turning Back");
    
  if (answer)
  {
    return true;
  }
  else
  {
    return false;
  }
	
}
</SCRIPT>

<?php


if($_GET['join']){
$join = $_GET['join'];
$b=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM betshop WHERE id='$join'"));
$tt = $b->type;
$tt1 = $b->wager;

	  $fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
	  $fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
	  
	  if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
	$betty = $fetch->$tt; 
	  }else{
	 $betty = $fetch->$tt; 
	  }
	  	  if ($fetch->userlevel == '1000'){
die("Your not allowed to do this!");
}else{
}


if($b->players == "2"){

if($b->username2 != ""){ echo"There are no places in this bet left for you to join, sorry.";
}elseif($bet->username2 == ""){ 
if($b->username == $username){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){
if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}

mysqli_query( $connection, "UPDATE betshop SET username2='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();


}}

}elseif($b->players == "3"){

if($b->username2 != ""){ echo"There are no places in this bet left for you to join, sorry.";
}elseif($b->username2 == ""){ 
if($b->username3 == $username || $b->username == $username ){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){
if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}
mysqli_query( $connection, "UPDATE betshop SET username2='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();
}}

if($b->username3 != ""){ echo"There are no places in this bet left for you to join, sorry.";
}elseif($b->username3 == ""){ 
if($b->username2 == $username || $b->username == $username ){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){

if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}
mysqli_query( $connection, "UPDATE betshop SET username3='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();
}}

}elseif($b->players == "4"){

if($b->username2 != ""){ echo"There are no places in this bet left for you to join, sorry.";
}elseif($b->username2 == ""){ 
if($b->username4 == $username || $b->username == $username || $b->username3 == $username){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){
if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}
mysqli_query( $connection, "UPDATE betshop SET username2='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();
}}

if($b->username3 != ""){
}elseif($b->username3 == ""){  echo"There are no places in this bet left for you to join, sorry.";
if($b->username2 == $username || $b->username == $username || $b->username4 == $username){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){
if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}
mysqli_query( $connection, "UPDATE betshop SET username3='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();
}}

if($b->username4 != ""){ echo"There are no places in this bet left for you to join, sorry.";
}elseif($b->username4 == ""){ 
if($b->username2 == $username || $b->username == $username || $b->username3 == $username){exit('You have already joined this bet once before.'); }
if($betty < $tt1){
echo"This bet is too much for you to afford.";
}elseif($betty >= $tt1){
if($tt == "RNL" || $tt == "fmj" || $tt == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $tt=$tt-$tt1 WHERE username='$username'");
}
mysqli_query( $connection, "UPDATE betshop SET username4='$username' WHERE id='$join'");
echo"You have entered this bet, as you had confirmed.";
exit();
}}

}}


$selectss = mysqli_query( $connection, "SELECT * FROM betshop");
while ($bet = mysqli_fetch_object($selectss)){
$won = $bet->wager * $bet->players;
$type = $bet->type;
if($bet->type == "money"){$sign = "&pound;"; $bet->type = ""; $logty = "Money"; }
if($bet->type == "credits"){$bet->type = "Credits"; $sign = "";}
if($bet->type == "fmj"){$bet->type = "fmj"; $sign = "";}
if($bet->type == "jhp"){$bet->type = "jhp"; $sign = "";}
$text1 = "You lost your bet of $sign".makecomma($bet->wager)." $bet->type.";
$text2 = "You won $sign".makecomma($won)." $bet->type from the betshop.";

if($bet->players == "2"){
if($bet->username != "" && $bet->username2 != ""){
$rand = rand(0,1);
if($rand == "0"){
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '2', '$bet->wager', '$bet->username', '$bet->username2', 'None', 'None', '$bet->type $logty', '$bet->username')");
}elseif($rand == "1"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '2', '$bet->wager', '$bet->username', '$bet->username2', 'None', 'None', '$bet->type $logty', '$bet->username2')");
}
mysqli_query( $connection, "DELETE FROM `betshop` WHERE `id`='$bet->id'");

}}elseif($bet->players == "3"){
if($bet->username != "" && $bet->username2 != "" && $bet->username3 != ""){

$rand = rand(0,2);
if($rand == "0"){
if($type == "RNL" || $type == "fmj" || $type == "lho"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '3', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', 'None', '$bet->type $logty', '$bet->username')");

}elseif($rand == "1"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '3', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', 'None', '$bet->type $logty', '$bet->username2')");
}elseif($rand == "2"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username3'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username3'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '3', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', 'None', '$bet->type $logty', '$bet->username3')");
}
mysqli_query( $connection, "DELETE FROM `betshop` WHERE `id`='$bet->id'");
}}elseif($bet->players == "4"){
if($bet->username != "" && $bet->username2 != "" && $bet->username3 != "" && $bet->username4 != ""){



$rand = rand(0,3);
if($rand == "0"){
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username4', '$bet->username4', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '4', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', '$bet->username4', '$bet->type $logty', '$bet->username')");

}elseif($rand == "1"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username2'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username4', '$bet->username4', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '4', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', '$bet->username4', '$bet->type $logty', '$bet->username2')");
}elseif($rand == "2"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username3'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username3'");
}$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username4', '$bet->username4', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '4', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', '$bet->username4', '$bet->type $logty', '$bet->username3')");
}elseif($rand == "3"){ 
if($type == "RNL" || $type == "fmj" || $type == "jhp"){
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username4'");
}else{
mysqli_query( $connection, "UPDATE accounts SET $type=$type+$won WHERE username='$bet->username4'");
}
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username', '$bet->username', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username2', '$bet->username2', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username3', '$bet->username3', '$text1', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `inbox` ( `id` , `to` , `from` , `message` , `subject` , `date` , `read`)
VALUES ('', '$bet->username4', '$bet->username4', '$text2', 'TP Betshop', '$date', '0');");
$sql = mysqli_query( $connection, "INSERT INTO `bslog` (`id`, `players`, `for_amount`, `p1`, `p2`, `p3`, `p4`, `for_type`, `winner`) VALUES ('', '4', '$bet->wager', '$bet->username', '$bet->username2', '$bet->username3', '$bet->username4', '$bet->type $logty', '$bet->username4')");
}
mysqli_query( $connection, "DELETE FROM `betshop` WHERE `id`='$bet->id'");
}}}
?>

<link href=\"style.css\" rel=\"stylesheet\" type=\"text/css\" />


<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>TP Betshop</title>
 
  </head>

<body>


<table align="center" cellpadding="0" cellspacing="0" bordercolor="#ECE9D8"  class="table1px" style="width: 90%">
  <tr>
    <td height="22" colspan='9'  class="gradient" ><div align="center">Thugs Paradise Bet Shop</div></td>
  </tr>
  <tr>
    <td class='content' colspan='9'><div align="center"><br>
    The Bet Shop - This is a new addition to the game, you pick the number of players, the bet type and how much of the bet type to bet. Then when all the players are in one player is chosen at random, so it's pure luck nothing to do with skill.<br>
    <br>
    </div></td>
  </tr>

  <tr>
    <td width="6%" align="center" class="tableborder"><b>ID</b></td>
    <td width="9%" align="center" class="tableborder"><b>Players</b></td>
    <td width="14%" align="center" class="tableborder"><b>Player 1</b></td>
    <td width="17%" align="center" class="tableborder"><b>Player 2</b></td>
    <td width="14%" align="center" class="tableborder"><b>Player 3</b></td>
    <td width="15%" align="center" class="tableborder"><b>Player 4</b></td>
    <td width="17%" align="center" class="tableborder"><b>Wager</b></td>
    <td width="8%" align="center" class="tableborder"><b>Join</b></td>
  </tr>
  <?php
  $select = mysqli_query( $connection, "SELECT * FROM betshop");
$num = mysqli_num_rows($select);
if($num == "0"){ echo"<tr><td align=\"center\" class=\"tableborder\" colspan=\"9\">No Bets Found.</td></tr>  "; }elseif($num != "0"){
while ($i = mysqli_fetch_object($select)){

   echo "  <tr>
    <td align=\"center\" class=\"tableborder\">$i->id</td>
    <td align=\"center\" class=\"tableborder\">$i->players</td>
    <td align=\"center\" class=\"tableborder\">$i->username</td>
    <td align=\"center\" class=\"tableborder\">";
	if($i->username2 != ""){ echo"$i->username2"; }else{ echo"None"; }
	 echo"</td>
     <td align=\"center\" class=\"tableborder\">";
	if($i->username3 != ""){ echo"$i->username3"; }else{ echo"None"; }
	 echo"</td>

       <td align=\"center\" class=\"tableborder\">";
	if($i->username4 != ""){ echo"$i->username4"; }else{ echo"None"; }
	 echo"</td>
	 
    <td align=\"center\" class=\"tableborder\">";
if($i->type == "money"){$sign = "&pound;"; $i->type = ""; }
if($i->type == "credits"){$i->type = "Credits"; $sign = "";}
if($i->type == "fmj"){$i->type = "fmj"; $sign = "";}
if($i->type == "jhp"){$i->type = "jhp"; $sign = "";}
if($i->type == "RNL"){$i->type = "RNL"; $sign = "";}
	echo" $sign".makecomma($i->wager)." $i->type</td>
    <td align=\"center\" class=\"tableborder\"><b><a <a onclick=\"return confirmJoin();\" href='?join=$i->id'>Join</a></b></td>
  </tr>";
  }}
  ?>
  

</table>

<br />

<form method='post'>
<table width="400" align="center" cellpadding="2" cellspacing="0" class="table1px">
  <tr>
    <td height="22" colspan='2'  class="gradient"><div align="center">Create A Bet - Can NOT Be Removed</div></td>
  </tr>
  <tr>
    <td align="right" class="tableborder"><b>Number Of Players:</b></td>

    <td align="center" class="tableborder"><b>
	<select name='players' class='textbox'>
	<option value='2'>2</option>
	<option value='3'>3</option>
	<option value='4'>4</option>
	</select></b></td>
  </tr>
  <tr>
    <td align="right" class="tableborder"><b>Bet Type:</b></td>
    <td align="center" class="tableborder"><b>
	<select name='bet' class='textbox'>
	<option value='money'>Money</option>
	<option value='credits'>Credits</option>
	<option value='fmj'>FMJ Bullets</option>
    	<option value='jhp'>JHP Bullets</option>
	</select></b></td>

  </tr>
  <tr>
    <td align="right" class="tableborder"><b>Bet Value:</b></td>
    <td align="center" class="tableborder"><b><input type='text' class='textbox' name='betvalue' /></b></td>
  </tr>
  <tr>
    <td align="center" class="tableborder" colspan="2"><input type='submit' name='create' value='Create' class='custombutton' />
      <br>
      <?php 
	  if($_POST['create']){
	  if($betnum != "0"){ echo"You've already made a bet, you cant create anymore."; }elseif($betnum == "0"){
	  $players = $_POST['players'];
	  $bet = addslashes($_POST['bet']);
	  $betvalue = $_POST['betvalue'];
	  $fetch2=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));

	  $allowed_bet_types = array('fmj', 'jhp', 'money', 'credits');
	  if(!in_array($bet, $allowed_bet_types)){
	  	die('invalid bet');
	  }
	  
	  if($bet == "RNL" || $bet  == "fmj" || $bet == "jhp"){
	  if($betvalue > 2000000){
	  exit("Sorry the limit is 2,000,000 $bet.");
	  }
	  }elseif($bet == "money"){
	  	  if($betvalue > 1000000000){
		  exit("Sorry the limit is &pound;1,000,000,000.");
	  }
	  	  }elseif($bet == "credits"){
	  	  if($betvalue > 1500){
		  exit("Sorry the limit is 1,500 Credits.");
	  }}
	  if($bet == "RNL" || $bet == "fmj" || $bet == "jhp"){
	$betty = $fetch2->$bet; 
	  }else{
	 $betty = $fetch->$bet; 
	  }
	  if ($fetch->userlevel == '10000'){
die("Your not allowed to do this!");
}else{
}
	 
	  
	 if($betty < $betvalue){ echo"Sorry you dont have enough to play this bet.";  }elseif($betty >= $betvalue){ 
	
	 if (ereg('[^0-9]', $betvalue)) {  echo"You can only have numbers in your bet.";
}elseif (!ereg('[^0-9]', $betvalue)) { 

	 if($betvalue <= '0'){ echo"You cant bet less than 0."; }elseif($betvalue > '0'){ 
	 
	  mysqli_query( $connection, "INSERT INTO `betshop` (`id` ,`username` ,`username2` ,`username3` ,`username4` ,`players` ,`wager`      ,`type`)VALUES (NULL , '$username', '', '', '', '$players', '$betvalue', '$bet')");
	  
	  if($bet == "RNL" || $bet == "fmj" || $bet == "jhp"){
	  	 mysqli_query( $connection, "UPDATE accounts SET $bet=$bet-$betvalue WHERE username='$username'");
	  }else{
	 mysqli_query( $connection, "UPDATE accounts SET $bet=$bet-$betvalue WHERE username='$username'"); 
	  }

	  echo"You successfully made the bet. You cannot get your items back. Return to this page when all players are in the bet.";
	 
	  }	}} }} ?></td>
  </tr>

</table> 
</form>
<table width="1000" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="9"><b>Last 5 Bets - <a href='bshop.php'>Refresh</a></b></td></tr>
<tr>
<td class="tableborder" align="center"><u>ID</u></td>
<td class="tableborder" align="center"><u>Players</u></td>
<td class="tableborder" align="center"><u>Amount</u></td>
<td class="tableborder" align="center"><u>Player 1</u></td>
<td class="tableborder" align="center"><u>Player 2</u></td>
<td class="tableborder" align="center"><u>Player 3</u></td>
<td class="tableborder" align="center"><u>Player 4</u></td>
<td class="tableborder" align="center"><u>Type</u></td>
<td class="tableborder" align="center"><u>Winner</u></td>
</tr>
<?php $ccc=mysqli_query( $connection, "SELECT * FROM bslog ORDER BY id DESC LIMIT 5");
while($ddd=mysqli_fetch_object($ccc)){
echo "<tr>
	  	  	  <td class='tableborder'><center>$ddd->id</center></td>
	  	  	  <td class='tableborder'><center>$ddd->players</center></td>
	  	  	  	  <td class='tableborder'><center>".makecomma($ddd->for_amount)."</center></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->p1'><b><center>$ddd->p1</center></b></a></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->p2'><b><center>$ddd->p2</center></b></a></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->p3'><b><center>$ddd->p3</center></b></a></td>
	  <td class='tableborder'><a href='profile.php?viewing=$ddd->p4'><b><center>$ddd->p4</center></b></a></td>
	  	  	  	  	  <td class='tableborder'><center>$ddd->for_type</center></td>
	  	  	  	  	  	  <td class='tableborder'><center><a href='profile.php?viewing=$ddd->winner'><b><center>$ddd->winner</center></b></a></center></td>
	</tr>"; } ?>
</table>
  </body> 