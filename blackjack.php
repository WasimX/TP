<?php
session_start();
include_once 'incfiles/func.php';
include_once 'incfiles/connectdb.php';
logincheck();
$username = $_SESSION['username'];
$time = time();

$ranking= mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM ranking WHERE rank='$fetch->rank'"));

if ($fetch->casinoban > time()){
die("You cannot gamble for another ".maketime($fetch->casinoban)." because you banned yourself.");
}

if($fetch->safehouse != "0"){
die("<link rel=stylesheet href=style.css type=text/css><link rel=stylesheet href=styleriot.php type=text/css><div id=errorMsg class=repeatable>Where do you think your going? You're meant to be in the safehouse!</div>");
}

echo "<link href=style.css rel=stylesheet type=text/css><style type=text/css>html,body{text-align:center;height:100%;padding:0;margin:0;font-family:sans-serif;}#holder{height:100%;width:100%;}#board{position:absolute;bottom:0;left:0;right:0;max-height:862px;height:100%;background:url(../images/billboard.png) no-repeat bottom center;background-size:auto 100%;}h1{margin:5px;font-family:Georgia,serif;color:#FFF;text-shadow:1px 1px #000;font-variant:small-caps;text-transform:none;font-weight:100;}#logo{margin-top:10px;}#preloader{background:url(../images/ajax-loader.gif);margin:0 auto;}</style>";
$self = "blackjack.php";
//***get info
$result = mysqli_query( $connection, "SELECT money, location, bj, password FROM accounts WHERE username='$username'");
while ($info = mysqli_fetch_row($result)) {
$pmoney = $info[0];
$currentmoney = $info[0];
$state = $info[1];
$location = $info[1];
$bj = $info[2];
$skin = $info[3];
$pass = $info[4];
}
$stff = mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='$state'"));
/////
$penis=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$cock=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM betlogs WHERE username='$username'"));
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
$ding_dong=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM bj WHERE country='$state'"));
$fat_shit=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$ding_dong->owner'"));
$fetch=mysqli_fetch_object(mysqli_query( $connection, "SELECT * FROM accounts WHERE username='$username'"));
/////
$result = mysqli_query( $connection, "SELECT bjowner, bjmaxbet, bjminbet, bjearnings FROM bj WHERE country='$state'");
while ($info = mysqli_fetch_row($result)) {
$owner = $info[0];
$max = $info[1];
$earn = $info[3];
$bjmaxbet = $info[1];
$bjminbid = $info[2];
$totalearnings = $info[3];
}
$result = mysqli_query( $connection, "SELECT id, money FROM accounts WHERE username='$owner'");
while ($info = mysqli_fetch_row($result)) {
$oid = $info[0];
$omoney = $info[1];
$otmoney = $info[1];
}
if($owner == "0"){
$mess =   "No owner";
}
$suc = 1;
if (isset($_POST['bett'])){
$bettt = $_POST['bett'];
if(ereg("[^[:digit:]]", $bettt)) {  
$mess =   "Bet amount can only contain numbers!";
$suc = 2;
unset($_SESSION['bet']);
}elseif($bettt > $pmoney){
$mess =   "You dont have enough money!";
$suc = 2;
unset($_SESSION['bet']);
}elseif($bettt > 25000000000){
$mess =   "The maximum you can bet is &pound;25,000,000,000";
exit();
}elseif($bettt == "0"){
$mess =   "The bet of &pound;0 is not allowed.";
exit();
}elseif($bettt == ""){
$mess =   "The bet of nothing is not allowed.";
exit();
}elseif($bettt > $bjmaxbet) {
$mess =   "The current maxbet is &pound;".makecomma($bjmaxbet)."!";
$suc = 2;
unset($_SESSION['bet']);
}else{
$_SESSION['bet'] = $bettt;
$money = $pmoney - $bettt;
mysqli_query( $connection, "UPDATE accounts SET money='$money', bj='$time' WHERE username='$username'");
$_SESSION['show'] = "show me";
unset($_SESSION['deck'],$_SESSION['card1'],$_SESSION['color1'],$_SESSION['card2'],$_SESSION['card3'],$_SESSION['color3'],$_SESSION['card4'],$_SESSION['color4'],$_SESSION['card5'],$_SESSION['color5'],$_SESSION['card6'],$_SESSION['color6'],$_SESSION['dcard1'],$_SESSION['dcard2'],$_SESSION['dcard3'],$_SESSION['dcard4']);
}
}
$bet = $_SESSION['bet'];
//****check if they want to hit
if ((isset($_POST['hit'])) && (isset($_SESSION['bet']))){
$deckk = $_SESSION['deck'];
if (isset($_SESSION['card6'])){
}else{
$ex = "6";
}
if (isset($_SESSION['card5'])){
}else{
$ex = "5";
}
if (isset($_SESSION['card4'])){
}else{
$ex = "4";
}
if (isset($_SESSION['card3'])){
}else{
$ex = "3";
}
if ($ex == 3){
$card3 = explode("-", $deckk[2]);
$color3 = $card3[1];
$card3 =  $card3[0];
if ($color3 == "h"){$color3 = 'heart';}
if ($color3 == "d"){$color3 = 'diamond';}
if ($color3 == "s"){$color3 = 'spade';}
if ($color3 == "c"){$color3 = 'club';}
$_SESSION['card3'] = $card3;
$_SESSION['color3'] = $color3;
}
if ($ex == 4){
$card4 = explode("-", $deckk[3]);
$color4 = $card4[1];
$card4 =  $card4[0];
if ($color4 == "h"){$color4 = 'heart';}
if ($color4 == "d"){$color4 = 'diamond';}
if ($color4 == "c"){$color4 = 'club';}
if ($color4 == "s"){$color4 = 'spade';}
$_SESSION['card4'] = $card4;
$_SESSION['color4'] = $color4;
}
if ($ex == 5){
$card5 = explode("-", $deckk[4]);
$color5 = $card5[1];
$card5 =  $card5[0];
if ($color5 == "h"){$color5 = 'heart';}
if ($color5 == "d"){$color5 = 'diamond';}
if ($color5 == "c"){$color5 = 'club';}
if ($color5 == "s"){$color5 = 'spade';}
$_SESSION['card5'] = $card5;
$_SESSION['color5'] = $color5;
}
if ($ex == 6){
$card6 = explode("-", $deckk[5]);
$color6 = $card6[1];
$card6 =  $card6[0];
if ($color6 == "h"){$color6 = 'heart';}
if ($color6 == "d"){$color6 = 'diamond';}
if ($color6 == "c"){$color6 = 'club';}
if ($color6 == "s"){$color6 = 'spade';}
$_SESSION['card6'] = $card6;
$_SESSION['color6'] = $color6;
}
}
//*****see if they stand
if ((isset($_POST['stand'])) && (isset($_SESSION['bet']))){
$bet = $_SESSION['bet'];
$dcardd1 = $_SESSION['dcard1'];
$dcardd2 = $_SESSION['dcard2'];
if (($dcardd1 == 13) || ($dcardd1 == 12) || ($dcardd1 == 11)){
$dcardd1 = 10;
}
if ($dcardd1 == 14){
$dcardd1 = 11;
}
if (($dcardd2 == 13) || ($dcardd2 == 12) || ($dcardd2 == 11)){
$dcardd2 = 10;
}
if ($dcardd2 == 14){
$dcardd2 = 11;
}
$dtotal = $dcardd1 + $dcardd2;
if (($dtotal > 21) && ($dcardd1 == 11)){
$dcardd1 = 1;
$dtotal = $dtotal - 11;
$dtotal = $dtotal + $dcardd1;
}
if (($dtotal > 21) && ($dcardd2 == 11)){
$dcardd2 = 1;
$dtotal = $dtotal - 11;
$dtotal = $dtotal + $dcardd2;
}		
$dtotal = $dcardd1 + $dcardd2;
if ($dtotal <= 16){
$deckk = $_SESSION['deck'];
$dcard3 = explode("-", $deckk[49]);
$dcolor3 =  $dcard3[1];
$dcard3 = $dcard3[0];
if ($dcolor3 == "h"){$dcolor3 = 'heart';}
if ($dcolor3 == "d"){$dcolor3 = 'diamond';}
if ($dcolor3 == "c"){$dcolor3 = 'club';}
if ($dcolor3 == "s"){$dcolor3 = 'spade';}
$_SESSION['dcard3'] = $dcard3;
$_SESSION['dcolor3'] = $dcolor3;
$dcardd3 = $dcard3;
if (($dcardd3 == 13) OR ($dcardd3 == 12) OR ($dcardd3 == 11)){
$dcardd3 = 10;
}
if ($dcardd3 == 14){
$dcardd3 = 11;
}
$dtotal = $dtotal + $dcardd3;
if (($dtotal > 21) && ($dcardd3 == 11)){
$dcardd3 = 1;
$dtotal = $dtotal - 11;
$dtotal = $dtotal + $dcardd3;
}	
}
if (($dtotal <= 16) && (isset($_SESSION['dcard3']))){
$deckk = $_SESSION['deck'];
$dcard4 = explode("-", $deckk[48]);
$dcolor4 =  $dcard4[1];
$dcard4 = $dcard4[0];
if ($dcolor4 == "h"){$dcolor4 = 'heart';}
if ($dcolor4 == "d"){$dcolor4 = 'diamond';}
if ($dcolor4 == "c"){$dcolor4 = 'club';}
if ($dcolor4 == "s"){$dcolor4 = 'spade';}
$_SESSION['dcard4'] = $dcard4;
$_SESSION['dcolor4'] = $dcolor4;
$dcardd4 = $dcard4;
if (($dcardd4 == 13) OR ($dcardd4 == 12) OR ($dcardd4 == 11)){
$dcardd4 = 10;
}
if ($dcardd4 == 14){
$dcardd4 = 11;
}
$dtotal = $dtotal + $dcardd4;
if (($dtotal > 21) && ($cardd4 == 11)){
$dcardd4 = 1;
$dtotal = $dtotal - 11;
$dtotal = $dtotal + $dcardd4;
}	
}		
$cardd1 = $_SESSION['card1'];
$cardd2 = $_SESSION['card2'];
$cardd3 = $_SESSION['card3'];
$cardd4 = $_SESSION['card4'];
$cardd5 = $_SESSION['card5'];
$cardd6 = $_SESSION['card6'];
if (($cardd1 == 13) || ($cardd1 == 12) || ($cardd1 == 11)){
$cardd1 = 10;
}
if ($cardd1 == 14){
$cardd1 = 11;
}
if (($cardd2 == 13) || ($cardd2 == 12) || ($cardd2 == 11)){
$cardd2 = 10;
}
if ($cardd2 == 14){
$cardd2 = 11;
}
if (isset($_SESSION['card3'])){
if (($cardd3 == 13) || ($cardd3 == 12) || ($cardd3 == 11)){
$cardd3 = 10;
}
if ($cardd3 == 14){
$cardd3 = 11;
}
}
if (isset($_SESSION['card4'])){
if (($cardd4 == 13) || ($cardd4 == 12) || ($cardd4 == 11)){
$cardd4 = 10;
}
if ($cardd4 == 14){
$cardd4 = 11;
}
}
if (isset($_SESSION['card5'])){
if (($cardd5 == 13) || ($cardd5 == 12) || ($cardd5 == 11)){
$cardd5 = 10;
}
if ($cardd5 == 14){
$cardd5 = 11;
}
}
if (isset($_SESSION['card6'])){
if (($cardd6 == 13) || ($cardd6 == 12) || ($cardd6 == 11)){
$cardd6 = 10;
}
if ($cardd6 == 14){
$cardd6 = 11;
}
} 
$total = $cardd1 + $cardd2;
if (isset($_SESSION['card3'])){
$total = $total + $cardd3;
}
if (isset($_SESSION['card4'])){
$total = $total + $cardd4;
}
if (isset($_SESSION['card5'])){
$total = $total + $cardd5;
}
if (isset($_SESSION['card6'])){
$total = $total + $cardd6;
}
if (($total > 21) && ($cardd1 == 11)){
$cardd1 = 1;
$total = $total - 11;
$total = $total + $cardd1;
}
if (($total > 21) && ($cardd2 == 11)){
$cardd2 = 1;
$total = $total - 11;
$total = $total + $cardd2;
}		
if (($total > 21) && ($cardd3 == 11)){
$cardd3 = 1;
$total = $total - 11;
$total = $total + $cardd3;
}	
if (($total > 21) && ($cardd4 == 11)){
$cardd4 = 1;
$total = $total - 11;
$total = $total + $cardd4;
}	
if (($total > 21) && ($cardd5 == 11)){
$cardd5 = 1;
$total = $total - 11;
$total = $total + $cardd5;
}	
if (($total > 21) && ($cardd6 == 11)){
$cardd6 = 1;
$total = $total - 11;
$total = $total + $cardd6;
}	
if (($dtotal > 21) && (isset($_SESSION['bet']))){
$hahahaha1=$bet;
$won = $hahahaha1;
$sexx = $hahahaha1 *2;
$newmoney = $omoney - $won;
$ws = "win";
if($newmoney <= 0){
mysqli_query( $connection, "UPDATE bj SET bjowner='$username', bjearnings='0', bjmaxbet='100000' WHERE bjowner='$owner' and country='$fetch->location' AND country='$location'");
mysqli_query( $connection, "UPDATE accounts SET money='0' WHERE username='$owner'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$omoney WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$omoney', 'Wiped previous owner')");
$mess = "You have taken over the blackjack table in $fetch->location, as the previous owner ran out of money!";
}else{
$mess = "You won with $total, the dealer had $dtotal. You receive &pound;".makecomma($sexx)."!";
$bet2 = $bet *2;
mysqli_query( $connection, "UPDATE accounts SET money=money+$bet2 WHERE username='$username'");
$total = $earn - $won;
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$bet2', '')");
mysqli_query( $connection, "UPDATE bj SET bjearnings='$total' WHERE bjowner='$owner' and country='$fetch->location'");	
mysqli_query( $connection, "UPDATE accounts SET money=money-$bet WHERE username='$owner'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
unset($_SESSION['deck'],$_SESSION['bet']);		
}
$_SESSION['show'] = "show them";
}
$phow = $total;
$dhow = $dtotal;
if (($total < $dtotal) && (isset($_SESSION['bet']))){
$mess =   "The dealer beat you with $dtotal. You lost your bet of &pound;".makecomma($bet)." ";
$total = $earn + $bet;
$ws = "lost";
mysqli_query( $connection, "UPDATE bj SET bjearnings='$total' WHERE bjowner='$owner' and country='$fetch->location'");	
$newmoney = $omoney + $bet;
unset($_SESSION['deck'],$_SESSION['bet']);	
$_SESSION['show'] = "show them";	
mysqli_query( $connection, "UPDATE accounts SET money=money+$bet WHERE username='$owner'");
}
//////YOU HAD MORE THAN THE DEALER/////	
if (($total > $dtotal) && (isset($_SESSION['bet']))){
$eatshit=$bet*2;
$won = $bet;
$ws = "win";
$newmoney = $omoney - $bet;
//////YOU HAD MORE THAN THE DEALER AND TOOK OVER/////
if($newmoney <= 0){	
	mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$omoney', 'Wiped previous owner')");
mysqli_query( $connection, "UPDATE bj SET bjowner='$username',bjearnings='0',bjmaxbet='100000' WHERE bjowner='$owner' and country='$fetch->location' AND country='$location'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$omoney WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
$mess2 =   "You have taken over the blackjack table in $fetch->location, as the previous owner ran out of money!";
//////YOU HAD MORE THAN THE DEALER AND TOOK OVER/////
//////YOU HAD MORE THAN THE DEALER AND WON/////
}else{
$bet2 = $bet *2;   
$mess = "You won with $total, the dealer had $dtotal. You receive &pound;".makecomma($eatshit)."!";
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$bet2', '')");
mysqli_query( $connection, "UPDATE accounts SET money=money+$bet2 WHERE username='$username'");
mysqli_query( $connection, "UPDATE bj SET bjearnings=bjearnings-$bet WHERE bjowner='$owner' and country='$fetch->location'");	
mysqli_query( $connection, "UPDATE accounts SET money=money-$bet WHERE username='$owner'");	
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
unset($_SESSION['deck'],$_SESSION['bet']);
} 
//////YOU HAD MORE THAN THE DEALER AND WON/////
$_SESSION['show'] = "show them";		
}
//////YOU HAD MORE THAN THE DEALER/////
//////PUSH/////
if (($phow == $dhow) && ($bet)){
$mess = "It was a push! Both you and the dealer had $total! Your bet of &pound;".makecomma($bet)." was returned to you";
mysqli_query( $connection, "UPDATE accounts SET money=money+$bet WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
unset($_SESSION['deck'],$_SESSION['bet']);
$_SESSION['show'] = "show them";
}	
//////PUSH/////
}
if ((!isset($_SESSION['card1'])) && (isset($_SESSION['bet']))){
$bet = $_SESSION['bet'];
//*********get cards
//make a deck
$cards = array("14-h", "14-c", "14-d", "14-s",
"2-h", "2-c", "2-d", "2-s",
"3-h", "3-c", "3-d", "3-s",
"4-h", "4-c", "4-d", "4-s",
"5-h", "5-c", "5-d", "5-s",
"6-h", "6-c", "6-d", "6-s",
"7-h", "7-c", "7-d", "7-s",
"8-h", "8-c", "8-d", "8-s",
"9-h", "9-c", "9-d", "9-s",
"10-h", "10-c", "10-d", "10-s",
"11-h", "11-c", "11-d", "11-s",
"12-h", "12-c", "12-d", "12-s",
"13-h", "13-c", "13-d", "13-s");
//shuffle
for($i = 0; $i < 52; $i++){
$count = count($cards);
$random = (rand()%$count);
if($cards[$random] == "") {
$i--;
} else{
$deck[] = $cards[$random];
$cards[$random] = "";
}
}
$_SESSION['deck'] = $deck;
$carrd1 = explode("-", $deck[0]);
$card1 =  $carrd1[0];
$color1 = $carrd1[1];
$carrd2 = explode("-", $deck[1]);
$card2 =  $carrd2[0];
$color2 = $carrd2[1];
if ($color1 == "h"){$color1 = 'heart';}
if ($color1 == "d"){$color1 = 'diamond';}
if ($color1 == "c"){$color1 = 'club';}
if ($color1 == "s"){$color1 = 'spade';}
$_SESSION['card1'] = $card1;	
$_SESSION['color1'] = $color1;
//second card
if ($color2 == "h"){$color2 = 'heart';}
if ($color2 == "d"){$color2 = 'diamond';}
if ($color2 == "c"){$color2 = 'club';}
if ($color2 == "s"){$color2 = 'spade';}
$_SESSION['card2'] = $card2;	
$_SESSION['color2'] = $color2;
//get dealer cards
$dcarrd1 = explode("-", $deck[50]);
$dcard1 =  $dcarrd1[0];
$dcolor1 = $dcarrd1[1];
$dcarrd2 = explode("-", $deck[51]);
$dcard2 =  $dcarrd2[0];
$dcolor2 = $dcarrd2[1];
if ($dcolor1 == "h"){$dcolor1 = 'heart';}
if ($dcolor1 == "d"){$dcolor1 = 'diamond';}
if ($dcolor1 == "c"){$dcolor1 = 'club';}
if ($dcolor1 == "s"){$dcolor1 = 'spade';}
$_SESSION['dcard1'] = $dcard1;	
$_SESSION['dcolor1'] = $dcolor1;
//second card
if ($dcolor2 == "h"){$dcolor2 = 'heart';}
if ($dcolor2 == "d"){$dcolor2 = 'diamond';}
if ($dcolor2 == "c"){$dcolor2 = 'club';}
if ($dcolor2 == "s"){$dcolor2 = 'spade';}
$_SESSION['dcard2'] = $dcard2;	
$_SESSION['dcolor2'] = $dcolor2;
}
//calcualte cards total to see if they have Blackjack or have bust
if (isset($_SESSION['card1'])){
$cardd1 = $_SESSION['card1'];
$cardd2 = $_SESSION['card2'];
$cardd3 = $_SESSION['card3'];
$cardd4 = $_SESSION['card4'];
$cardd5 = $_SESSION['card5'];
$cardd6 = $_SESSION['card6'];
if (($cardd1 == 13) || ($cardd1 == 12) || ($cardd1 == 11)){
$cardd1 = 10;
}
if ($cardd1 == 14){
$cardd1 = 11;
}
if (($cardd2 == 13) OR ($cardd2 == 12) OR ($cardd2 == 11)){
$cardd2 = 10;
}
if ($cardd2 == 14){
$cardd2 = 11;
}
if (isset($_SESSION['card3'])){
if (($cardd3 == 13) OR ($cardd3 == 12) OR ($cardd3 == 11)){
$cardd3 = 10;
}
if ($cardd3 == 14){
$cardd3 = 11;
}
}
if (isset($_SESSION['card4'])){
if (($cardd4 == 13) OR ($cardd4 == 12) OR ($cardd4 == 11)){
$cardd4 = 10;
}
if ($cardd4 == 14){
$cardd4 = 11;
}
}
if (isset($_SESSION['card5'])){
if (($cardd5 == 13) OR ($cardd5 == 12) OR ($cardd5 == 11)){
$cardd5 = 10;
}
if ($cardd5 == 14){
$cardd5 = 11;
}
}
if (isset($_SESSION['card6'])){
if (($cardd6 == 13) OR ($cardd6 == 12) OR ($cardd6 == 11)){
$cardd6 = 10;
}
if ($cardd6 == 14){
$cardd6 = 11;
}
} 
$total = $cardd1 + $cardd2;
if (isset($_SESSION['card3'])){
$total = $total + $cardd3;
}
if (isset($_SESSION['card4'])){
$total = $total + $cardd4;
}
if (isset($_SESSION['card5'])){
$total = $total + $cardd5;
}
if (isset($_SESSION['card6'])){
$total = $total + $cardd6;
}
if (($total > 21) && ($cardd1 == 11)){
$cardd1 = 1;
$total = $total - 11;
$total = $total + $cardd1;
}
if (($total > 21) && ($cardd2 == 11)){
$cardd2 = 1;
$total = $total - 11;
$total = $total + $cardd2;
}		
if (($total > 21) && ($cardd3 == 11)){
$cardd3 = 1;
$total = $total - 11;
$total = $total + $cardd3;
}	
if (($total > 21) && ($cardd4 == 11)){
$cardd4 = 1;
$total = $total - 11;
$total = $total + $cardd4;
}	
if (($total > 21) && ($cardd5 == 11)){
$cardd5 = 1;
$total = $total - 11;
$total = $total + $cardd5;
}	
if (($total > 21) && ($cardd6 == 11)){
$cardd6 = 1;
$total = $total - 11;
$total = $total + $cardd6;
}
//////////////BLACKJACK///////
if (($total == "21") && (!isset($_SESSION['card3'])) && (isset($_SESSION['bet']))){
$bj = round(($bet)/2);
$won=$bet+$bj+$bet;
$newmoney = $omoney - $won;
$ws = "bj";
//////////////BLACKJACK AND TOOK OVER///////////	
if($newmoney <= 0){
mysqli_query( $connection, "UPDATE bj SET bjowner='$username',bjearnings='0',bjmaxbet='100000' WHERE bjowner='$owner' and country='$fetch->location' AND country='$location'");
mysqli_query( $connection, "UPDATE accounts SET money='0' WHERE username='$owner'");
mysqli_query( $connection, "UPDATE accounts SET money=money+$omoney WHERE username='$username'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
$mess = "You got blackjack! You have taken over the blackjack table in $fetch->location, as the previous owner ran out of money!";
//////////////BLACKJACK AND TOOK OVER///////////			
//////////////BLACKJACK AND WON///////////	
}else{
$mess = "You got BlackJack! You won &pound;".makecomma($won)." plus your original bet of &pound;".makecomma($bet)."!";
mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$won', '')");
mysqli_query( $connection, "UPDATE accounts SET money=money+$won WHERE username='$username'");
$total = $earn - $won;
mysqli_query( $connection, "UPDATE bj SET bjearnings='$total' WHERE bjowner='$owner' and country='$fetch->location'");	
mysqli_query( $connection, "UPDATE accounts SET money=money-$won WHERE username='$owner'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
$_SESSION['show'] = "show them";
unset($_SESSION['deck'],$_SESSION['bet']);
}
//////////////BLACKJACK AND WON///////////	
$_SESSION['show'] = "show them";
}
//////////////BLACKJACK///////	
//////////////GOT BUST///////
if (($total > "21" ) && (isset($_SESSION['bet']))){
$lost = $bet;
$ws = "lost";
$mess =   "You had $total. You bust and lost &pound;".makecomma($lost).".";		
$total = $earn + $lost;
mysqli_query( $connection, "UPDATE bj SET bjearnings='$total' WHERE bjowner='$owner' and country='$fetch->location'");	
$newmoney = $omoney + $lost;
mysqli_query( $connection, "UPDATE accounts SET money='$newmoney' WHERE username='$owner'");
mysqli_query( $connection, "UPDATE accounts SET bj='0' WHERE username='$username'");
$_SESSION['show'] = "show them";
unset($_SESSION['deck'],$_SESSION['bet']);
$_SESSION['show'] = "show them";
}
//////////////GOT BUST///////
}





if($ws == "lost"){


	$start = $pmoney;


	$end = $pmoney-$bet;


mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Lose', '0', '')");


}elseif($ws == "win"){


	$start = $pmoney;


	$end = $pmoney+($bet*2);




}elseif($ws == "bj"){


	$start = $pmoney;


	$end = $pmoney+($bet*2)+($bet/2);

	$bwinning111 = ($bet*2)+($bet/2);


mysqli_query( $connection, "INSERT INTO `casino_logs` (`id`, `username`, `casinoType`, `stake`, `location`, `owner`, `date`, `outcome`, `winnings`, `extra`) VALUES ('', '$username', 'Blackjack', '$bet', '$fetch->location', '$owner', NOW(), 'Win', '$bwinning111', '')");


}
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
color: #FFFFFF;
font-weight: bold;
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style2 {
color: black;
font-weight: bold;
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style3 {color: #333333}
-->
</style>
<center><br />
<?php
if($stff->bjowner == "0"){
?><form method="post" action="">
<table width='50%' height='50' border='0' align="center" cellpadding='0' cellspacing='0' class='table1px'>
<tr>
<td height='33' class="gradient"><div align='center'>No Owner!</div></td>
</tr>
<tr>
<td ><div align='center'>Buy this Blackjack for &pound;10,000,000<br />
<br />    
<input name='Buy' type='submit' id="Buy" class="custombutton"  value='Buy Blackjack!' />
<br>
<br /><?php
if ($_POST['Buy']){
if($ranking->id < 9){
echo"You need to be ranked Boss or above to own a casino!";
}elseif ($ranking->id >= 9) {
if($fetch->money < 10000000){
echo"You dont have enough money, you idiot!";
}elseif($fetch->money > 10000000){
$n_money = $fetch->money - 10000000;
mysqli_query( $connection, "UPDATE accounts SET money='$n_money' WHERE username='$username'");
mysqli_query( $connection, "UPDATE bj SET bjowner='$username', bjmaxbet='100000' WHERE bjowner='0' AND country='$state'");
echo"You successfully bought the blackjack!";
}}}
?>
</div>
</td>
</tr>
</table></form>
<p>
<?php
}elseif($stff->bjowner != "0"){?> <br />
<?php
//see if person owns table
if ($owner == $username){
if ($_POST['maxbet'] && $_POST['Submit_maxbet']){ 
$maxbet = addslashes(strip_tags($_POST['maxbet']));
$newmax = $_POST['maxbet']; 
if ($newmax < 100000){
echo "The maxbet must be at least &pound;100,000.";
//in
}elseif ($newmax > 25000000000){
echo "The maxbet must be lower than &pound;25,000,000,000.";
//in
}elseif(ereg("[^[:digit:]]", $newmax)){
echo "Max bet can only contain numbers!";
//in
}else{
mysqli_query( $connection, "UPDATE bj SET bjmaxbet='$newmax' WHERE bjowner='$username' AND country='$state'");
echo "The max bet for the Blackjack in $fetch->location has been set to &pound;".makecomma($newmax).".";
}
}
if ($_POST['Submit_profit']){ 
mysqli_query( $connection, "UPDATE bj SET bjearnings='0' WHERE bjowner='$username' AND country='$state'");
echo "Your profit's have been reset.";
}
if ($_POST['Submit_drop']){ 
mysqli_query( $connection, "UPDATE bj SET bjmaxbet='100000' WHERE bjowner='$username' AND location='$location'");
mysqli_query( $connection, "UPDATE bj SET bjowner='0', bjearnings='0' WHERE bjowner='$username' AND location='$location'");
echo "You have dropped your blackjack.";
}
if ($_POST['minbid']){
$newmin = $_POST['minbid'];
if ($newmin < 100000){
echo "Minimum must be at least &pound;100,000.";
//in
exit();
}
if(ereg("[^[:digit:]]", $newmin)){
echo "Min offer can only contain numbers!";
//in
exit();
}
mysqli_query( $connection, "UPDATE bj SET bjminoffer='$newmin' WHERE bjowner='$username' AND country='$state'");
echo "Min was updated to &pound;$newmin";
}
if ($_POST['giveto'] && $_POST['Submit_transfer']){
$giveto = $_POST['giveto'];
$giveto = addslashes(strip_tags($_POST['giveto']));
$checkgiveto = mysqli_query( $connection, "SELECT username FROM accounts WHERE username='$giveto'");
$checkifexist = mysqli_num_rows($checkgiveto);
if($checkifexist <= 0){
echo "That is not a valid username.";
//in
}else{
while($giver = mysqli_fetch_row($checkgiveto)){
$giveto = $giver[0];
}
mysqli_query( $connection, "UPDATE bj SET bjowner='$giveto', bjmaxbet='100000' WHERE bjowner='$username' AND country='$state'");
echo "The blackjack has been given away to $giveto.";
}
}
?>
<form method="post" action="">
<table width="39%" border="0" align="center" cellpadding="2" cellspacing="0" class="table1px">
<tr>
<td height="30" class="gradient" colspan="2"><div align="center">Casino Options</div></td>
</tr>
<tr>
<td height="20" colspan="2" ><div align="center"><br><a href='blackjack.php'>Refresh Page</a></div><br></td>
</tr><br>
<tr>
<td height="25"  colspan="2"><div align="center">Winnings / losses: &pound;<?php echo number_format($totalearnings); ?></div><br></td>
</tr>
<tr>
<td width="100%"><div align="center">Transfer To:
<input name="giveto" type="text" class="textbox" id="giveto" /></div>
<br></label></td>
</tr>
<tr>
<td width="100%"><div align="center">Set New Maxbet: 
<input name="maxbet" type="text" class="textbox" id="maxbet" /><br></div>
</label>
</tr>
<tr>
<td height="20" colspan="2" align="center" ><br>
<input name="Submit_maxbet" type="submit" class="custombutton" id="Submit_maxbet" value="Set Maxbet" /> - <input name="Submit_transfer" type="submit" class="custombutton" id="Submit_transfer" value="Transfer Table" /> - <input name="Submit_profit" type="submit" class="custombutton" id="Submit_profit" value="Reset Profit" /> - <input name="Submit_drop" type="submit" class="custombutton" id="Submit_drop" value="Drop Casino" /><br></br></td>
</tr>
</table><br><br>
</form>
<table width="700" class="table1px" border="0" cellpadding="0" cellspacing="0" align="center">
<tr><td height="30" class="gradient" colspan="4"><b>Betlogs</b> - <a href="blackjack.php"><img src="images/refresh.png" title="Refresh" border="0" height="20" width="20"></a></td></tr>
<tr>
<td width="25%" class="tableborder" align="center"><u>Username</u></td>
<td width="25%" class="tableborder" align="center"><u>Bet</u></td>
<td width="25%" class="tableborder" align="center"><u>Won</u></td>
<td width="25%" class="tableborder" align="center"><u>Date</u></td>
</tr>
<?php $ccc=mysqli_query( $connection, "SELECT * FROM casino_logs WHERE casinoType='Blackjack' AND owner='$username' AND location='$fetch->location' ORDER BY id DESC LIMIT 15");
while($ddd=mysqli_fetch_object($ccc)){
echo "<tr>
	  <td class='tableborder' width='25%'><a href='profile.php?viewing=$ddd->username'><b><center>$ddd->username</center></b></a></td>
	  <td class='tableborder' width='25%'><center>&pound;".makecomma($ddd->stake)."</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->outcome</center></td>
	  <td class='tableborder' width='25%'><center>$ddd->date</center></td>
	</tr>"; } ?>
</table><br>
<?php
exit();
} ?><style type="text/css"><!--
.style2 {font-size: 10px; color: #0000FF; font-family: Verdana; font-weight: bold;}
.countd {
	font-size: 14px;
	color: #CC0000;
	font-family: Arial;
	font-weight: bold;
	background-color: #333333;
	text-align: center;
	padding: 5px;
	width: 250px;
	height: 30px;
	border: 2px solid #FFFFFF;
	vertical-align: middle;
}
--></style><script> 
<!-- 
//
 var milisec=0 
 var seconds=document.bj_form.timer_value.value
 var kick=" Seconds Remaining"

function display(){ 
 if (milisec<=0){ 
    milisec=9 
    seconds-=1 
 } 
 if (seconds<1){ 
    milisec=0 
    seconds=""
	kick="You were kicked from the table!"
 } 
 else 
    milisec-=1 
    document.bj_form.d2.value=seconds+kick
    setTimeout("display()",100) 
} 
display() 
--> 
</script>


<?php if ($_SESSION['bet']){ echo "<b><center> <input name='d2' type='text' value='60 Seconds Remaining' class='countd'/>
<br/><br/>"; } ?>
<?php if($mess){ echo"<b>$mess</b><br/>"; } if($mess2){ echo"<b>$mess2</b><br/>"; }?>
<table width="758" border="2" colspan="2" cellpadding="0" cellspacing="0" class="table2px" background="../images/cards/blackjack.jpg">
<tr>
<td width="46%" height='30' colspan='21' align="center" class="gradient"><strong>Blackjack Table</strong></td>
</tr>
<tr  > <td  align="center" valign=top >
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
<tr valign="top">
<td width="50%"><div align="center"><span class="table2px"><font color="blue"><b>Your Cards:</b></font> 
<br/>
<br/>
</span></td>
<td width="50%"><div align="center"><span class="table2px"><font color="blue"><b>Dealers Cards:</b></font><br/>
<br/>


</span></td>
</tr>
<tr>
<td width="50%" align="center"><?php if ($_SESSION['bet']){ ?>
<img src="images/cards/<?php if ((isset($_SESSION['card1'])) && (isset($_SESSION['show']))) {
echo $_SESSION['color1'];
}else{
echo "cardback";}
echo "/";
if ((isset($_SESSION['card1'])) && (isset($_SESSION['show']))) { 
echo $_SESSION['card1']; 
}else{
echo "cardback";}?>.png" border="0">&nbsp;
<img src="images/cards/<?php if ((isset($_SESSION['card2'])) && (isset($_SESSION['show'])))  {
echo $_SESSION['color2'];
}else{
echo "cardback";} ?>/<?php if ((isset($_SESSION['card2'])) && (isset($_SESSION['show']))){
echo $_SESSION['card2'];
}else{
echo "cardback"; }?>.png" border="0">&nbsp;
<?php if ((isset($_SESSION['card3'])) && (isset($_SESSION['show']))) {
echo "<img src=images/cards/";
echo $_SESSION['color3'];
echo "/";
echo $_SESSION['card3'];
echo ".png border='0'>"; 
echo "&nbsp;";
}
if (isset($_SESSION['card4'])) {
echo "<img src=images/cards/";
echo $_SESSION['color4'];
echo "/";
echo $_SESSION['card4'];
echo ".png border='0'>";
echo "&nbsp;";
}
if (isset($_SESSION['card5'])) {
echo "<img src=images/cards/";
echo $_SESSION['color5'];
echo "/";
echo $_SESSION['card5'];
echo ".png border='0'>";
echo "&nbsp;";
}
if (isset($_SESSION['card6'])) {
echo "<img src=images/cards/";
echo $_SESSION['color6'];
echo "/";
echo $_SESSION['card6'];
echo ".png border='0'></div></td>";
echo "&nbsp;";
}?>
<?php }else{ ?>
<img src="images/cards/back.png" border="0">&nbsp;  <img src="images/cards/back.png" border="0">
<?php } ?>
</div> </td>
<td width="50%" align="center">	  
<img src="images/cards/<?php if ((isset($_SESSION['dcard1'])) && (isset($_SESSION['show']))){
echo $_SESSION['dcolor1'];
}else{
echo "cardback";}
echo "/";
if ((isset($_SESSION['dcard1'])) && (isset($_SESSION['show']))) {
echo $_SESSION['dcard1'];
}else{
echo "cardback";}?>.png" border="0">&nbsp;  <img src=images/cards/<?php if ((isset($_SESSION['dcard2'])) && (isset($_POST['stand'])) && (isset($_SESSION['show']))) {
echo $_SESSION['dcolor2'];
}else{
echo "cardback";
}
echo "/";
if ((isset($_SESSION['dcard2'])) && (isset($_POST['stand'])) && (isset($_SESSION['show']))) {
echo $_SESSION['dcard2'];
}else{
echo "cardback";} ?>.png border="0">
<?php if ((isset($_SESSION['dcard3'])) && (isset($_POST['stand'])) && (isset($_SESSION['show']))) {
echo "<img src=images/cards/";
echo $_SESSION['dcolor3'];
echo "/";
echo $_SESSION['dcard3'];
echo ".png border='0'>"; 
echo "&nbsp;";
}
if ((isset($_SESSION['dcard4'])) && (isset($_POST['stand'])) && (isset($_SESSION['show']))) {
echo "<img src=images/cards/";
echo $_SESSION['dcolor4'];
echo "/";
echo $_SESSION['dcard4'];
echo ".png border='0'>";
echo "&nbsp;";
}?>
</span><?php if ($_SESSION['bet']){ ?>    <?php if ($_SESSION['bet']){ echo ""; } ?>
<?php }else{ ?>

<?php } ?>
</div></td>
</tr>
</table><?php  ?>
</td>
</tr>
<tr>
<td valign="middle"><div align="center" class="table2px">
<?php if ($_SESSION['bet']){?>
<tr>
<td align="center"> <font color="blue"><b>Current Bet in progress: &pound;<?php echo"$bet";?></b></font></td></tr>
<tr>
<td height="10px" width="100%" align="center"><p><form name="form4" method="post" action="<?php $_SERVER['PHP_SELF'] ?>"><input name="submit" type="submit" value="Hit Me!" class="custombutton"><input name="hit" type="hidden" value="you hit" class="custombutton"></form>
<form name="form5" method="post" action="<?php $_SERVER['PHP_SELF'] ?>"><input name="submit2" class="custombutton" type="submit"  value="Stand" /><input name="stand" type="hidden" class="custombutton" value="you stand" /></form></p>
</div></td>
</tr>

<?php  }} ?>
<form name="form4" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<?php
if (!isset($_SESSION['bet'])){
?>
<b><font color=blue>Bet:</b></font><input name=bett type=text value="<?php echo"$bet";?>" size=20 class='textbox' maxlength=10>
&nbsp; <input type=submit class=custombutton name=Submit value=Start! />
<br></br><div align="center" class="table2px"><font color=red><b>You have 10 minutes to finish your game before being kicked from the table!</font></b></div>
</form><?php }?>
</td>
</tr> 
<br />
</td>
</tr>
<tr class="style2">
<td colspan="1"><div align="center" class="table2px"><font color=blue>This BlackJack table in <b><?php if($location == "England"){$loc = "London, England";}
      if($location == "Pakistan"){$loc = "Lahore, Pakistan";}
      if($location == "Jamaica"){$loc = "Kingston, Jamaica";}
      if($location == "America"){$loc = "New York, USA";}
      if($location == "Japan"){$loc = "Tokyo, Japan";}
      if($location == "Germany"){$loc = "Berlin, Germany";}
      if($location == "China"){$loc = "Beijing, China";}
         ?><?php echo"$loc";?></b> is currently owned by <b><a href='profile.php?viewing=<?php echo"$owner";?>'><?php echo"$owner";?></a></font></b>
<br/>
<br/>
<font color=blue>The Maximum bet currently set by the owner of this table is <b>&pound;<?php echo makecomma($bjmaxbet); ?></font></b></div></td>
</tr>
</table></table>
</form>
</body>
</html>

<br>
</br>
<table width="500" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="50" height="62" class="table1px"><div align="left"><img src="../images/questionmark.jpg" width="49" height="46" /></div></td>
        <td width="450" class="tableborder"><div align="center">
          <p>The object of the <b>blackjack</b> game is to accumulate cards with point totals as close to 21 without going over 21. Face cards (<b>Jacks</b>, <b>Queens</b> and <b>Kings</b>) are worth 10 points. Aces are worth 1 or 11, whichever is preferable. Other cards are represented by their number. </p>
<p>If player and the House tie, it is a push and no one wins. <b>Ace</b> and <b>10</b> (Blackjack) on the first two cards dealt is an automatic player win at 1.5 to 1, unless the house ties. A player may stand at any time.<br/>
<br/>
</p>
<a href="../casinos.php">Gambling Policy</a> - Including information on chance &amp; fairness.
        </div></td>
      </tr>
    </table>

<?php include_once "incfiles/foot.php"; ?>